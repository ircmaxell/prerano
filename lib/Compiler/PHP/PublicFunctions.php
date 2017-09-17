<?php
namespace Prerano\Compiler\PHP;

use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;
use function Prerano\Compiler\a;

use PhpParser\Node as PhpNode;

class PublicFunctions
{
    public static function compile(Package $package): array
    {
        $result = [];
        foreach ($package->functions[Package::PUBLIC] as $name => $func) {
            $params = self::params($func);
            $stmts = a(
                ...self::guards($name, $func),
                ...[PHP::assign(PHP::var('__result__'), PHP::instanceCall(Scope::resolvePackage($package), Scope::resolveLocal($package, $name), ...self::args($func)))],
                ...self::postConditions($func)
            );
            
            $result[] = new PhpNode\Stmt\Function_(
                PHP::name($name),
                [
                    'stmts' => $stmts,
                    'params' => $params,
                    'returnType' => PHP::nativeType($func->returnType),
                ]
            );
        }
        return $result;
    }

    protected static function guards(string $name, Function_ $function): array
    {
        // Not Implemented Yet
        $results = [];
        foreach ($function->parameters as $key => $parameter) {
            $key++;
            $results[] = PHP::if(
                PHP::not(TypeCheck::compileExternalCheck(PHP::var($parameter->name), $parameter->getDeclaredType())),
                [
                    PHP::throw("\TypeException", "Function {$name}() expects parameter {$key} to be " . $parameter->getDeclaredType()->toString())
                ]
            );
        }
        return $results;
        ;
    }

    protected static function postConditions(Function_ $function): array
    {
        // Not Implemented Yet
        return [
            // Implement a bunch of checks/value maps


            PHP::return(PHP::var('__result__')),
        ];
    }

    protected static function args(Function_ $function): array
    {
        // Not Implemented Yet
        $result = [];
        foreach ($function->parameters as $param) {
            $result[] = PHP::var($param->name);
        }
        return $result;
    }

    protected static function params(Function_ $function): array
    {
        $params = [];
        foreach ($function->parameters as $parameter) {
            if ($parameter->getDeclaredType()->type === Type::POINTER) {
                // handle reference

                $params[] = PHP::paramRef($parameter->name);
            } else {
                $params[] = PHP::param($parameter->name);
            }
        }
        return $params;
    }
}
