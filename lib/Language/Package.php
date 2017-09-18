<?php

namespace Prerano\Language;

use RuntimeException;

class Package
{
    const PUBLIC = 1;
    const PROTECTED = 2;
    const PRIVATE = 3;

    const VISIBILITY_MAP = [
        self::PUBLIC => 'public',
        self::PROTECTED => 'protected',
        self::PRIVATE => 'private',
    ];

    protected $types = [
        self::PUBLIC => [],
        self::PROTECTED => [],
        self::PRIVATE => [],
    ];

    protected $functions = [
        self::PUBLIC => [],
        self::PROTECTED => [],
        self::PRIVATE => [],
    ];

    protected $expressionFunctions = [
        self::PUBLIC => [],
        self::PROTECTED => [],
        self::PRIVATE => [],
    ];

    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function addTypeDeclaration(string $name, Type $type, int $visibility)
    {
        if (isset($this->types[$visibility][$name])) {
            throw new RuntimeException("Invalid type declaration for $name, symbol already defined");
        }
        $this->types[$visibility][$name] = $type;
    }

    public function addFunctionDeclaration(string $name, Function_ $function, int $visibility)
    {
        $this->addTypeDeclaration($name, $function->getSignature(), $visibility);
        if (isset($this->functions[$visibility][$name])) {
            throw new RuntimeException("Invalid function declaration for $name, symbol already defined");
        }
        $this->functions[$visibility][$name] = $function;
    }

    public function addExpressionFunctionDeclaration(Type $on, string $name, Function_ $function, int $visibility)
    {
        $this->addTypeDeclaration($on->toString() . '->' . $name, $function->getSignature(), $visibility);
        if (isset($this->functions[$visibility][$name])) {
            throw new RuntimeException("Invalid function declaration for $name, symbol already defined");
        }
        $this->expressionFunctions[$visibility][$name] = $function;
    }
}
