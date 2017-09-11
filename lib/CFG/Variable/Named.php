<?php

namespace Prerano\CFG\Variable;

use Prerano\Type;
use Prerano\CFG\VariableAbstract;

class Named extends VariableAbstract
{
    public $name;

    public function __construct(string $name, Type $type = null)
    {
        $this->name = $name;
        parent::__construct($type);
    }
}
