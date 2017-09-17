<?php

namespace Prerano\Language\Variable;

use Prerano\Language\Type;
use Prerano\Language\VariableAbstract;
use RuntimException;

class Literal extends VariableAbstract
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
        if (is_int($value)) {
            $type = new Type(Type::INT);
        } elseif (is_float($value)) {
            $type = new Type(Type::FLOAT);
        } elseif (is_string($value)) {
            $type = new Type(Type::STRING);
        } elseif (is_null($value)) {
            $type = new Type(Type::NULL);
        } elseif ($value === true) {
            $type = new Type(Type::TRUE);
        } elseif ($value === false) {
            $type = new Type(Type::FALSE);
        } else {
            throw new RuntimException("Unknown literal type provided: " . gettype($value));
        }
        parent::__construct($type);
    }
}
