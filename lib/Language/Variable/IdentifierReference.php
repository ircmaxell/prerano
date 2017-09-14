<?php

namespace Prerano\Language\Variable;

use Prerano\Language\Type;
use Prerano\Language\VariableAbstract;
use RuntimException;

class IdentifierReference extends VariableAbstract
{
    public $value;

    public function __construct(string $value)
    {
        $this->value = $value;
        parent::__construct(new Type(Type::TYPE_REFERENCE, $value));
    }
}
