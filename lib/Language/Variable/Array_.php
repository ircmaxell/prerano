<?php

namespace Prerano\Language\Variable;

use Prerano\Language\Type;
use Prerano\Language\Variable;
use Prerano\Language\VariableAbstract;
use RuntimException;

class Array_ extends VariableAbstract
{
    public $items;

    public function __construct(Variable ...$items)
    {
        $this->items = $items;
        parent::__construct(new Type(Type::ARRAY, null, new Type(Type::ANY)));
    }
}
