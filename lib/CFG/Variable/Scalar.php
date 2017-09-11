<?php

namespace Prerano\CFG\Variable;

use Prerano\Type;
use Prerano\CFG\VariableAbstract;

class Scalar extends VariableAbstract
{
    public $name;

    public function __construct($value)
    {
        $this->value = $value;
        if (is_int($value)) {
            $type = new Type(Type::INT);
        } elseif (is_float($value)) {
            $type = new Type(Type::FLOAT);
        } elseif (is_string($value)) {
            $type = new Type(Type::STRING);
        }
        parent::__construct($type);
    }
}
