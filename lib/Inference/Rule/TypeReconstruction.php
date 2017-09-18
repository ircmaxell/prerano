<?php

namespace Prerano\Inference\Rule;

use Prerano\Inference\RuleAbstract;
use Prerano\Language\Block;
use Prerano\Language\Variable;

use Prerano\Language\Type;

class TypeReconstruction extends RuleAbstract
{
    public function processBlock(Block $block): int
    {
        $return = self::NORMAL;
        $vars = $block->getVariables();
        foreach ($block->getEdges() as $destId => $sources) {
            $dest = $vars[$destId];
            $origType = $dest->getDeclaredType();
            if ($origType->type !== Type::UNKNOWN) {
                continue;
            }
            if (count($sources) > 1) {
                $dest->setDeclaredType($this->union(...$sources));
            } else {
                $dest->setDeclaredType($sources[0]->getDeclaredType());
            }
            if (!$dest->getDeclaredType()->equals($origType)) {
                $return |= self::RERUN;
            }
        }

        return $return;
    }

    protected function union(Variable ...$vars)
    {
        $subTypes = [];
        foreach ($vars as $var) {
            $subTypes[] = $var->getDeclaredType();
        }
        return (new Type(Type::UNION, null, ...$subTypes))->simplify();
    }
}
