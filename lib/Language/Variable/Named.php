<?php

namespace Prerano\Language\Variable;

use Prerano\Language\Type;
use Prerano\Language\VariableAbstract;

class Named extends VariableAbstract
{
    public $name;

    public function __construct(string $name, Type $type)
    {
        $this->name = $name;
        parent::__construct($type);
    }
}
