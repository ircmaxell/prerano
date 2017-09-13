<?php

namespace Prerano\Language;

abstract class VariableAbstract implements Variable
{
    protected $id;
    protected $declaredType;
    protected $inferredType;
    protected static $counter = 1;

    public function __construct(Type $declaredType)
    {
        $this->id = self::$counter++;
        $this->declaredType = $declaredType;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDeclaredType(): Type
    {
        return $this->declaredType;
    }

    public function getInferredType(): Type
    {
        return $this->inferredType ?? $this->declaredType;
    }

    public function setInferredType(Type $type = null)
    {
        $this->inferredType = $type;
    }
}
