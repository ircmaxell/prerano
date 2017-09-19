<?php

namespace Prerano\CFG;

use Prerano\AST\Node as AST;
use Prerano\Language\Block;
use Prerano\Language\Function_;
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
                case 'Stmt_Enum':
                    $i = 0;
                    $subTypes = [];
                    foreach ($node->subTypes as $subType) {
                        $subType->visibility = $node->visibility;
                        $subTypes[] = new Type(Type::TYPE_REFERENCE, $subType->name->toString());
                        if (is_null($subType->type->value)) {
                            $subType->type->value = $i++;
                        } elseif (!is_int($subType->type->value)) {
                            // pass
                        } elseif ($subType->type->value > $i) {
                            $i = $subType->type->value + 1;
                        } elseif ($subType->type->value <= $i) {
                            throw new RuntimeException("Invalid enum, positional type " . $subType->name->toString() . " conflicts with prior type");
                        }
                    }
                    $this->generateDeclarations($node->subTypes, $package);
                    $package->addTypeDeclaration($node->name->toString(), new Type(Type::UNION, null, ...$subTypes), $node->visibility);
                    break;
                case 'Stmt_ExprFunction':
                    $package->addExpressionFunctionDeclaration(
                        $this->generateType($node->on),
                        $node->name->toString(),
                        $this->generateFunction($node),
                        $node->visibility
                    );
                    break;
                case 'Stmt_Function':
                    if ($node->name->toString() === '__main__' && $node->visibility !== Package::PRIVATE) {
                        throw new RuntimeException("__main__ functions **must** be private");
                    }
                    $package->addFunctionDeclaration($node->name->toString(), $this->generateFunction($node), $node->visibility);
                    break;
                case 'Stmt_Type':
                    $package->addTypeDeclaration($node->name->toString(), $this->generateType($node->type), $node->visibility);
                    break;
                
                default:
                    throw new LogicException("Type generation for node type " . $node->getName() . " not implemented yet");
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

    protected function generateNode(AST $node, Block &$block, int $mode = Block::MODE_RO): Variable
    {
        switch ($node->getName()) {
            case 'Arg':
                if ($node->name) {
                    throw new \LogicException("Named parameters not supported yet!");
                }
                return $this->generateNode($node->value, $block, Block::MODE_RO);
            case 'Expr_Assign':
                $expr = $this->generateNode($node->expr, $block, Block::MODE_RO);
                $var = $this->generateNode($node->var, $block, Block::MODE_WO);
                $block->write($var, $expr);
                return $expr;
            case 'Expr_BinaryOp_Div':
                $left = $this->generateNode($node->left, $block, Block::MODE_RO);
                $right = $this->generateNode($node->right, $block, Block::MODE_RO);
                $result = new Variable\Temp($this->determineGeneratedBinaryOpType($left->getDeclaredType(), $right->getDeclaredType()));
                $block->appendNode(new Node\Expr\BinaryOp\Div($left, $right, $result));
                return $result;
            case 'Expr_BinaryOp_Equals':
                $left = $this->generateNode($node->left, $block, Block::MODE_RO);
                $right = $this->generateNode($node->right, $block, Block::MODE_RO);
                $result = new Variable\Temp(new Type(Type::TYPE_REFERENCE, 'bool'));
                $block->appendNode(new Node\Expr\BinaryOp\Equals($left, $right, $result));
                return $result;
            case 'Expr_BinaryOp_Minus':
                $left = $this->generateNode($node->left, $block, Block::MODE_RO);
                $right = $this->generateNode($node->right, $block, Block::MODE_RO);
                $result = new Variable\Temp($this->determineGeneratedBinaryOpType($left->getDeclaredType(), $right->getDeclaredType()));
                $block->appendNode(new Node\Expr\BinaryOp\Minus($left, $right, $result));
                return $result;
            case 'Expr_BinaryOp_Mod':
                $left = $this->generateNode($node->left, $block, Block::MODE_RO);
                $right = $this->generateNode($node->right, $block, Block::MODE_RO);
                $result = new Variable\Temp($this->determineGeneratedBinaryOpType($left->getDeclaredType(), $right->getDeclaredType()));
                $block->appendNode(new Node\Expr\BinaryOp\Mod($left, $right, $result));
                return $result;
            case 'Expr_BinaryOp_Mul':
                $left = $this->generateNode($node->left, $block, Block::MODE_RO);
                $right = $this->generateNode($node->right, $block, Block::MODE_RO);
                $result = new Variable\Temp($this->determineGeneratedBinaryOpType($left->getDeclaredType(), $right->getDeclaredType()));
                $block->appendNode(new Node\Expr\BinaryOp\Mul($left, $right, $result));
                return $result;
            case 'Expr_BinaryOp_Plus':
                $left = $this->generateNode($node->left, $block, Block::MODE_RO);
                $right = $this->generateNode($node->right, $block, Block::MODE_RO);
                $result = new Variable\Temp($this->determineGeneratedBinaryOpType($left->getDeclaredType(), $right->getDeclaredType()));
                $block->appendNode(new Node\Expr\BinaryOp\Plus($left, $right, $result));
                return $result;
            case 'Expr_Block':
                $newBlock = new Block\Simple;
                $block->addOutboundBlock('*', $newBlock);
                list($return, $resultBlock) = $this->generate($node->expr, $newBlock);
                $block = new Block\Simple;
                $resultBlock->addOutboundBlock('*', $block);
                return $return;
            case 'Expr_FuncCall':
                return $this->generateFuncCall($node, $block, $mode);
            case 'Expr_IdentifierReference':
                return new Variable\IdentifierReference($node->name->toString());
            case 'Expr_If':
                $cond = $this->generateNode($node->if, $block, Block::MODE_RO);
                $block->appendNode(new Node\Expr\If_($cond, $node->getAttributes()));
                $if = new Block\Simple;
                $block->addOutboundBlock('if', $if);
                $ifReturn = $this->generateNode($node->if, $if, Block::MODE_RO);
                $else = new Block\Simple;
                $block->addOutboundBlock('else', $else);
                if ($node->else) {
                    $elseReturn = $this->generateNode($node->else, $else, Block::MODE_RO);
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
            case 'Expr_Is':
                $cond = $this->generateNode($node->cond, $block, Block::MODE_RO);
                $type = $this->generateType($node->type);
                $result = new Variable\Temp(new Type(Type::TYPE_REFERENCE, 'bool'));
                $block->write($result);
                $block->appendNode(new Node\Expr\Is($cond, $type, $result));
                return $result;
            case 'Expr_Match':
                $cond = $this->generateNode($node->cond, $block, Block::MODE_RO);
                $nextBlock = new Block\Simple;
                $results = [];
                foreach ($node->entries as $entry) {
                    if (is_null($entry->cond)) {
                        list($result, $endBlock) = $this->generate($entry->stmts, $block);
                        $results[] = new Variable\Phi\Entry($endBlock, $result);
                        $endBlock->addOutboundBlock('*', $nextBlock);
                        continue;
                    } elseif ($entry->cond instanceof AST\Expr\IdentifierReference) {
                        // generate IS condition
                        $type = (new Type(Type::TYPE_REFERENCE, $entry->cond->name->toString()));
                        $var = new Variable\Temp(new Type(Type::TYPE_REFERENCE, 'bool'));
                        $block->write($var);
                        $block->appendNode(new Node\Expr\Is($cond, $type, $var));
                    } elseif ($entry->cond instanceof AST\Scalar) {
                        $tmp = $this->generateNode($entry->cond, $block, Block::MODE_RO);
                        $var = new Variable\Temp(new Type(Type::TYPE_REFERENCE, 'bool'));
                        $block->appendNode(new Node\Expr\BinaryOp\Equals($cond, $tmp, $var));
                    } elseif ($entry->cond instanceof AST\Expr) {
                        $var = $this->generateNode($entry->cond, $block, Block::MODE_RO);
                    } else {
                        throw new \LogicException("No idea how to implement: " . $entry->cond->getName());
                    }
                    $if = new Block\Simple;
                    $block->addOutboundBlock('if', $if);
                    list($result, $endBlock) = $this->generate($entry->stmts, $if);
                    $results[] = new Variable\Phi\Entry($endBlock, $result);
                    $endBlock->addOutboundBlock('*', $nextBlock);
                    $tmp = new Block\Simple;
                    $block->addOutboundBlock('else', $tmp);
                    $block->appendNode(new Node\Expr\If_($var, new Variable\Temp(new Type(Type::UNKNOWN))));
                    $block = $tmp;
                }
                $block = $nextBlock;
                if (count($results) === 0) {
                    throw new \RuntimeException("Match expressions must have at least one case");
                } elseif (count($results) === 1) {
                    return $results[0]->var;
                }

                return new Variable\Phi(...$results);
            case 'Expr_MethodCall':
                return $this->generateMethodCall($node, $block, $mode);
            case 'Expr_PointerDereference':
                $expr = $this->generateNode($node->expr, $block, Block::MODE_RO);
                $isPtr = $expr->getDeclaredType()->type === Type::POINTER;
                $result = new Variable\Temp($isPtr ? $expr->getDeclaredType()->subTypes[0] : new Type(Type::UNKNOWN));
                $block->appendNode(new Node\Expr\PointerDereference($expr, $result));
                return $result;
            case 'Expr_Variable':
                if (is_string($node->name)) {
                    $name = $node->name;
                } elseif ($node->name instanceof AST\Name) {
                    $name = $node->name->toString();
                } else {
                    throw new \LogicException("Not implemented yet for other variable names");
                }
                if ($mode === Block::MODE_RO) {
                    return $block->read($name);
                }
                var_dump($node);

                throw new LogicException("Writing variables not implemented as type is unknown");
                return $block->write(new Variable\Named($name));
            case 'Scalar_LNumber':
                return $block->write(new Variable\Literal($node->value));
            default:
                throw new LogicException("Node generation for node type " . $node->getName() . " not implemented yet");
        }
    }

    protected function generateFunction(AST\Stmt\Function_ $function): Function_
    {
        $parameters = [];
        $block = new Block\Simple;
        $i = 0;
        foreach ($function->parameters as $param) {
            $parameters[] = $block->write(new Variable\Parameter($param->name, $i++, $this->generateType($param->type)));
        }
        $returnType = $this->generateType($function->returnType);
        list($result, $endBlock) = $this->generate($function->body, $block);
        return new Function_($parameters, $returnType, $block, $result);
    }

    protected function generateFuncCall(AST\Expr\FuncCall $node, Block &$block, int $mode = Block::MODE_RO): Variable
    {
        $args = [];
        foreach ($node->args as $arg) {
            $args[] = $this->generateNode($arg, $block, Block::MODE_RO);
        }
        $call = $this->generateNode($node->name, $block, Block::MODE_RO);
        $result = new Variable\Temp(new Type(Type::UNKNOWN));
        $block->appendNode(new Node\Expr\FuncCall($call, $args, $result, $node->getAttributes()));
        $block->write($result);
        return $result;
    }

    protected function generateMethodCall(AST\Expr\MethodCall $node, Block &$block, int $mode = Block::MODE_RO): Variable
    {
        $args = [];
        foreach ($node->args as $arg) {
            $args[] = $this->generateNode($arg, $block, Block::MODE_RO);
        }
        $obj = $this->generateNode($node->obj, $block, Block::MODE_RO);
        $result = new Variable\Temp(new Type(Type::UNKNOWN));
        $block->appendNode(new Node\Expr\MethodCall($obj, $node->name->toString(), $args, $result, $node->getAttributes()));
        $block->write($result);
        return $result;
    }

    protected function generateTypes(Ast\Expr\Type ...$types): array
    {
        $result = [];
        foreach ($types as $type) {
            $result[] = $this->generateType($type);
        }
        return $result;
    }

    protected function generateType(AST\Expr\Type $type): Type
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
            case 'Expr_Type_Function':
                return (new Type(Type::CALLABLE, null, ...$this->generateTypes(...$type->parameters), ...[$this->generateType($type->result)]))->simplify();
            case 'Expr_Type_Value':
                if ($type->value instanceof AST\Scalar) {
                    $type->value = $type->value->value;
                }
                switch (gettype($type->value)) {
                    case 'integer': return new Type(Type::INT, $type->value);
                    case 'float': return new Type(Type::FLOAT, $type->value);
                    case 'string': return new Type(Type::STRING, $type->value);
                    default:
                        throw new LogicException("Value types not supported yet for " . getType($type->value));
                }
                // no break
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

    protected function determineGeneratedBinaryOpType(Type $left, Type $right): Type
    {
        switch ($left->toString() . '_' . $right->toString()) {
            case 'int_int':
                return new Type(Type::INT);
            case 'float_int':
            case 'int_float':
            case 'float_float':
                return new Type(Type::FLOAT);
        }
        // Inference will try later to determine the type
        return new Type(Type::UNKNOWN);
    }
}
