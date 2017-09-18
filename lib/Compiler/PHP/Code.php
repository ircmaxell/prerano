<?php
namespace Prerano\Compiler\PHP;

use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;
use function Prerano\Compiler\a;

use PhpParser\Node as PhpNode;

class Code
{
    public static function compile(Package $package): array
    {
        $className = '__PRERANO_CODE__';
        $parts = explode('::', $package->name);

        array_pop($parts);
        return a(
            new PhpNode\Stmt\Class_(
                $className,
                [
                    'flags' => PHP::modifier('final'),
                    'stmts' => a(
                        ...self::properties($package),
                        ...[self::init($package)],
                        ...self::functions($package),
                        ...self::expressionFunctions($package),

                        ...[]
                    ),
                ]
            ),
            PHP::staticCall('__PRERANO_CODE__', Scope::resolveInit($package))
        );
    }

    protected static function properties(Package $package): array
    {
        return a(
            new PhpNode\Stmt\Property(
                PHP::modifier('private static'),
                [
                    new PhpNode\Stmt\PropertyProperty(Scope::resolveLocal($package, 'instance')),
                ]
            )
        );
    }

    protected static function init(Package $package): PhpNode
    {
        $initStmts = [];

        return new PhpNode\Stmt\ClassMethod(
            Scope::resolveInit($package),
            [
                'flags' => PHP::modifier('public static'),
                'stmts' => [
                    PHP::if(
                        PHP::not(PHP::staticPropFetch('self', Scope::resolveLocal($package, 'instance'))),
                        a(
                            PHP::assign(
                                PHP::staticPropFetch('self', Scope::resolveLocal($package, 'instance')),
                                PHP::new('self')
                            ),
                            ...$initStmts
                        )
                    ),
                    PHP::return(PHP::staticPropFetch('self', Scope::resolveLocal($package, 'instance')))
                ],
            ]
        );
    }


    public static function compileBlock(Package $package, Block $block): array
    {
        $return = [];
        foreach ($block->getNodes() as $node) {
            switch ($node->getName()) {
                case 'Expr_Assign':
                    $return[] = PHP::assign(
                        Scope::variable($node->var),
                        Scope::variable($node->expr)
                    );
                    break;
                case 'Expr_BinaryOp_Div':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        PHP::binaryOpDiv(
                            Scope::variable($node->left),
                            Scope::variable($node->right)
                        )
                    );
                    break;
                case 'Expr_BinaryOp_Equals':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        PHP::identical(
                            Scope::variable($node->left),
                            Scope::variable($node->right)
                        )
                    );
                    break;
                case 'Expr_BinaryOp_Minus':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        PHP::binaryOpMinus(
                            Scope::variable($node->left),
                            Scope::variable($node->right)
                        )
                    );
                    break;
                case 'Expr_BinaryOp_Mod':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        PHP::binaryOpMod(
                            Scope::variable($node->left),
                            Scope::variable($node->right)
                        )
                    );
                    break;
                case 'Expr_BinaryOp_Mul':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        PHP::binaryOpMul(
                            Scope::variable($node->left),
                            Scope::variable($node->right)
                        )
                    );
                    break;
                case 'Expr_BinaryOp_Plus':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        PHP::binaryOpPlus(
                            Scope::variable($node->left),
                            Scope::variable($node->right)
                        )
                    );
                    break;
                
                case 'Expr_FuncCall':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        Scope::resolveFunctionCall($package, $node, ...$node->args)
                    );
                    break;
                case 'Expr_If':
                    $return[] = PHP::if(
                        Scope::variable($node->cond),
                        self::compileBlock($package, $block->getNextBlock('if')),
                        self::compileBlock($package, $block->getNextBlock('else'))
                    );
                    break;
                case 'Expr_Is':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        TypeCheck::compileInternalCheck(Scope::variable($node->cond), $node->type)
                    );
                    break;
                case 'Expr_PointerDereference':
                    $return[] = PHP::assign(
                        Scope::variable($node->result),
                        PHP::instanceCall(Scope::variable($node->expr), 'unwrap')
                    );
                    break;
                default:
                    throw new \LogicException("Not Implemented: " . $node->getName());
            }
        }
        if ($block->hasNextBlock('*')) {
            return array_merge($return, self::compileBlock($package, $block->getNextBlock('*')));
        }
        return $return;
    }

    protected static function functions(Package $package): array
    {
        $result = [];
        foreach ($package->functions as $visibility => $functions) {
            foreach ($functions as $name => $func) {
                if ($name === '__main__') {
                    if (count($func->parameters) !== 0) {
                        throw new \RuntimeException("__main__ functions must have exactly 0 paramters");
                    }
                    $name = '__construct';
                } else {
                    $name = Scope::resolveLocal($package, $name);
                }
                $result[] = PHP::classMethod($name, PHP::modifier('public'), self::params(...$func->parameters), a(
                    ...self::compileBlock($package, $func->body),
                    ...[PHP::return(Scope::variable($func->result))]
                ));
            }
        }
        return $result;
    }

    protected static function expressionFunctions(Package $package): array
    {
        $result = [];
        foreach ($package->expressionFunctions as $visibility => $level1) {
            foreach ($level1 as $name => $level2) {
                foreach ($level2 as list($type, $function)) {
                    $name = Scope::resolveExpressionLocal($package, $name, $type);
                    $root = new Variable\Parameter("_", 0, $type);
                    $result[] = PHP::classMethod($name, PHP::modifier('public'), self::params($root, ...$function->parameters), a(
                        ...self::compileBlock($package, $function->body),
                        ...[PHP::return(Scope::variable($function->result))]
                    ));
                }
            }
        }
        return $result;
    }

    protected static function params(Variable\Parameter ...$params): array
    {
        $results = [];
        foreach ($params as $param) {
            $results[] = PHP::param($param->name);
        }
        return $results;
    }
}
