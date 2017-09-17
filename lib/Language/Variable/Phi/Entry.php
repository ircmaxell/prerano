<?php

namespace Prerano\Language\Variable\Phi;

use Prerano\Language\Block;
use Prerano\Language\Type;
use Prerano\Language\Variable;

class Entry
{
    public $block;
    public $var;

    public function __construct(Block $block, Variable $var)
    {
        $this->block = $block;
        $this->var = $var;
    }
}
