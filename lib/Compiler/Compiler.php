<?php

namespace Prerano\Compiler;

use Prerano\CFG\Block;
use Prerano\CFG\Node;

use PhpParser\Node as PhpNode;

class Compiler
{
    public function compile(array $blocks, Scope $scope = null): array
    {
        $scope = $scope ?: new Scope;
        $result = [];
        foreach ($blocks as $block) {
            $result = array_merge($result, $this->compileBlock($block, $scope));
        }
        return $result;
    }

    protected function compileBlock(Block $block, Scope $scope): array
    {
        foreach ($block->getNodes() as $node) {
            switch ($node->getName()) {
                case 'Expr_Assign':
                default:
                    throw new \LogicException("Compilation for " . $node->getName() . " Not supported yet");
            }
        }
    }
}
