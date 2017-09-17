<?php

namespace Prerano\Language\Variable;

use Prerano\Language\Type;
use Prerano\Language\Variable;

class Phi extends Temp
{
    public $parents = [];

    public function __construct(Phi\Entry ...$parents)
    {
        $this->parents = $parents;
        parent::__construct(new Type(Type::UNKNOWN));
    }
}
