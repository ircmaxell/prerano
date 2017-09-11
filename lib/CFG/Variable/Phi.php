<?php

namespace Prerano\CFG\Variable;

use Prerano\Type;

use Prerano\CFG\Variable;

class Phi extends Temp
{
    public $parents = [];

    public function __construct(Variable ...$parents)
    {
        $this->parents = $parents;
        parent::__construct($this->getType());
    }

    protected $processing = false;

    public function getType(): Type
    {
        if ($this->processing) {
            return new Type;
        }
        $parents = $this->parents;
        $first = array_pop($parents);
        $type = $first->getType();
        $this->processing = true;
        foreach ($this->parents as $parent) {
            $type = $parent->getType()->unionWith($type);
        }
        $this->processing = false;

        return $type;
    }
}
