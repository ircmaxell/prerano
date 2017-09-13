<?php

namespace Prerano\Language\Variable;

use Prerano\Language\Type;
use Prerano\Language\Variable;

class Phi extends Temp
{
    public $parents = [];

    public function __construct(Variable ...$parents)
    {
        $this->addParent(...$parents);
        parent::__construct(new Type(Type::UNKNOWN));
    }

    public function addParent(Variable ...$variable)
    {
        foreach ($variable as $parent) {
            $this->parents[$parent->getId()] = $parent;
        }
    }
}
