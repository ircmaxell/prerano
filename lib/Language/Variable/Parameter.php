<?php

namespace Prerano\Language\Variable;

use Prerano\Language\Type;

class Parameter extends Named
{
    public $position;

    public function __construct(string $name, int $position, Type $type)
    {
        $this->position = $position;
        parent::__construct($name, $type);
    }
}
