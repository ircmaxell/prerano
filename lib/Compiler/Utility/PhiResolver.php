<?php

namespace Prerano\Compiler\Utility;

use Prerano\CFG\Node as CFG;
use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;

class PhiResolver
{
    protected $seen = [];

    protected function reset()
    {
        $this->seen = [];
    }

    public function resolve(Package $package)
    {
        $this->reset();
        foreach ($package->functions as $visibility => $functions) {
            foreach ($functions as $function) {
                $this->findAndResolveBlocks($function->body);
                $function->setResult($this->resolveNode($function->result));
                $this->reset();
            }
        }
    }

    public function findAndResolveBlocks(Block $block)
    {
        if (isset($this->seen[$block->getId()])) {
            return;
        }
        $this->seen[$block->getId()] = true;
        foreach ($block->getNodes() as $node) {
            foreach ($node->getSubNodeNames() as $name) {
                $node->$name = $this->resolveNode($node->$name);
            }
        }
        foreach ($block->getNextBlocks() as $child) {
            $this->findAndResolveBlocks($child);
        }
    }

    protected function resolveNode($node)
    {
        if ($node instanceof Variable\Phi) {
            return $this->resolveOutPhiNode($node);
        } elseif (is_array($node)) {
            return array_map(function ($child) {
                return $this->resolveNode($child);
            }, $node);
        }
        return $node;
    }

    protected function resolveOutPhiNode(Variable\Phi $phi): Variable
    {
        $newVar = new Variable\Temp($phi->getDeclaredType());
        foreach ($phi->parents as $parent) {
            $parent->block->appendNode(new CFG\Expr\Assign($newVar, $parent->var));
        }
        return $newVar;
    }
}
