<?php

namespace Prerano\CFG;

use Prerano\Type;

abstract class VariableAbstract implements Variable
{
    protected $id;
    protected $type;
    protected static $counter = 1;

    public function __construct(Type $type = null)
    {
        $this->id = self::$counter++;
        $this->type = $type ?: new Type;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): Type
    {
        return $this->type;
    }
}
