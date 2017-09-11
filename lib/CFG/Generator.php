<?php

namespace Prerano\CFG;

use Prerano\AST\Node as AST;

use LogicException;

class Generator
{
    public function generate(array $nodes, Block $block): array
    {
        $result = new Variable\Temp;
        foreach ($nodes as $node) {
            $result = $this->generateNode($node, $block);
        }

        return [$result, $block];
    }

    protected function generateNode(AST $node, Block &$block, int $mode = Scope::MODE_RO): Variable
    {
        $scope = $block->getScope();
        switch ($node->getName()) {
            case 'Scalar_LNumber':
                return $scope->write(new Variable\Scalar($node->value));
            case 'Stmt_Namespace':
                return new Variable\Temp;
                break;
            case 'Expr_Assign':
                $expr = $this->generateNode($node->expr, $block, Scope::MODE_RO);
                $var = $this->generateNode($node->var, $block, Scope::MODE_WO);
                $block->appendNode(new Node\Expr\Assign($var, $expr, $node->getAttributes()));
                $scope->connect($var, $expr);
                return $expr;
            case 'Expr_Block':
                $newBlock = new Block\Simple;
                $block->addOutboundBlock('*', $newBlock);
                $newBlock->addInboundBlock($block);
                list($return, $resultBlock) = $this->generate($node->expr, $newBlock);
                $block = new Block\Simple;
                $resultBlock->addOutboundBlock('*', $block);
                $block->addInboundBlock($resultBlock);
                return $return;
            case 'Expr_If':
                $cond = $this->generateNode($node->if, $block, Scope::MODE_RO);
                $block->appendNode(new Node\Expr\If_($cond, $node->getAttributes()));
                $if = new Block\Simple;
                $block->addOutboundBlock('if', $if);
                $if->addInboundBlock($block);
                $ifReturn = $this->generateNode($node->if, $if, Scope::MODE_RO);
                $else = new Block\Simple;
                $block->addOutboundBlock('else', $else);
                $else->addInboundBlock($block);
                if ($node->else) {
                    $elseReturn = $this->generateNode($node->else, $else, Scope::MODE_RO);
                    $resultBlock = new Block\Simple;
                    $else->addOutboundBlock('*', $resultBlock);
                    $resultBlock->addInboundBlock($else);
                    $result = new Variable\Phi($elseReturn, $ifReturn);
                } else {
                    $resultBlock = $else;
                    $result = new Variable\Phi(new Variable\Temp, $ifReturn);
                }
                $if->addOutboundBlock('*', $resultBlock);
                $resultBlock->addInboundBlock($if);
                $else->getScope()->write($result);
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
}
