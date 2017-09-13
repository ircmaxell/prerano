<?php

namespace Prerano\CFG;

use Prerano\AST\Node as AST;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;

use LogicException;

class Generator
{
    public function generatePackage(AST\Stmt\Package $package): Package
    {
        $result = new Package($package->name->toString());
        $this->generateDeclarations($package->stmts, $result);
        return $result;
    }

    protected function generateDeclarations(array $nodes, Package $package)
    {
        foreach ($nodes as $node) {
            switch ($node->getName()) {
                case 'Stmt_Type':
                    $package->addTypeDeclaration($node->name->toString(), $this->generateType($node->type), $node->visibility);
                    break;
                default:
                    throw new LogicException("Node generation for node type " . $node->getName() . " not implemented yet");
            }
        }
    }

    public function generate(array $nodes, Block $block): array
    {
        $result = new Variable\Temp(new Type(Type::NONE));
        foreach ($nodes as $node) {
            $result = $this->generateNode($node, $block);
        }

        return [$result, $block];
    }

    protected function generateNode(AST $node, Block &$block, int $mode = Scope::MODE_RO): Variable
    {
        switch ($node->getName()) {
            case 'Scalar_LNumber':
                return $scope->write(new Variable\Scalar($node->value));
            case 'Stmt_Namespace':
                return new Variable\Temp(new Type(Type::NONE));
                break;
            case 'Expr_Assign':
                $expr = $this->generateNode($node->expr, $block, Scope::MODE_RO);
                $var = $this->generateNode($node->var, $block, Scope::MODE_WO);
                $block->write($var, $expr);
                return $expr;
            case 'Expr_Block':
                $newBlock = new Block\Simple;
                $block->addOutboundBlock('*', $newBlock);
                list($return, $resultBlock) = $this->generate($node->expr, $newBlock);
                $block = new Block\Simple;
                $resultBlock->addOutboundBlock('*', $block);
                return $return;
            case 'Expr_If':
                $cond = $this->generateNode($node->if, $block, Scope::MODE_RO);
                $block->appendNode(new Node\Expr\If_($cond, $node->getAttributes()));
                $if = new Block\Simple;
                $block->addOutboundBlock('if', $if);
                $ifReturn = $this->generateNode($node->if, $if, Scope::MODE_RO);
                $else = new Block\Simple;
                $block->addOutboundBlock('else', $else);
                if ($node->else) {
                    $elseReturn = $this->generateNode($node->else, $else, Scope::MODE_RO);
                    $resultBlock = new Block\Simple;
                    $else->addOutboundBlock('*', $resultBlock);
                    $result = new Variable\Phi($elseReturn, $ifReturn);
                } else {
                    $resultBlock = $else;
                    $result = new Variable\Phi(new Variable\Literal(null), $ifReturn);
                }
                $if->addOutboundBlock('*', $resultBlock);
                $else->write($result);
                $block = $resultBlock;
                return $result;
            case 'Expr_Variable':
                if (is_string($node->name)) {
                    return $scope->namedVariable($node->name, $mode);
                } else {
                    throw new LogicException("Expression based variables are not supported yet");
                }
                break;
            default:
                throw new LogicException("Node generation for node type " . $node->getName() . " not implemented yet");
        }
    }

    protected function generateType(AST\Expr\Type $type)
    {
        switch ($type->getName()) {
            case 'Expr_Type_Intersection':
                return (new Type(Type::INTERSECTION, null, $this->generateType($type->left), $this->generateType($type->right)))->simplify();
            case 'Expr_Type_Named':
                return (new Type(Type::TYPE_REFERENCE, $type->name->toString()));
            case 'Expr_Type_Pointer':
                return (new Type(Type::POINTER, null, $this->generateType($type->type)));
            case 'Expr_Type_Union':
                return (new Type(Type::UNION, null, $this->generateType($type->left), $this->generateType($type->right)))->simplify();
            case 'Expr_Type_Specification':
                if ($type->root->getName() === 'Expr_Type_Named') {
                    // Skip generating the named reference without subtypes
                    $name = $type->root->name->toString();
                    $subTypes = array_map(function ($node) {
                        return $this->generateType($node);
                    }, $type->subTypes);
                    switch ($name) {
                        case 'array':
                            $return = (new Type(Type::ARRAY, $name, ...$subTypes));
                            break;
                        case 'union':
                            $return = (new Type(Type::UNION, $name, ...$subTypes));
                            break;
                        case 'intersection':
                            $return = (new Type(Type::INTERSECTION, $name, ...$subTypes));
                            break;
                        default:
                            $return = (new Type(Type::TYPE_REFERENCE, $name, ...$subTypes));
                    }
                    return $return->simplify();
                }
                // no break
            default:
                throw new LogicException("Node generation for node type " . $type->getName() . " not implemented yet");
        }
    }
}
