<?php

namespace Prerano\Language;

class Package
{
    const PUBLIC = 1;
    const PROTECTED = 2;
    const PRIVATE = 3;

    protected $types = [
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
            throw new RuntimeException("Invalid type declaration, symbol already defined");
        }
        $this->types[$visibility][$name] = $type;
    }
}
