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

    const FIELDS = [
        "types",
        "functions",
        "expressionFunctions",
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
        $onString = $on->toString();
        $this->addTypeDeclaration($onString . '->' . $name, $function->getSignature(), $visibility);
        $this->expressionFunctions[$visibility][$name][] = [$on, $function];
    }

    public function mergeWith(Package $other): Package
    {
        if ($this->name !== $other->name) {
            throw new \RuntimeException("Atempting to merge unlike packages");
        }
        $new = new static($this->name);
        $this->addAllTo($new);
        $other->addAllTo($new);
        return $new;
    }

    protected function addAllTo(Package $other)
    {
        foreach ($this->types as $visibility => $typeMap) {
            foreach ($typeMap as $name => $type) {
                $other->addTypeDeclaration($name, $type, $visibility);
            }
        }
        foreach ($this->functions as $visibility => $functionMap) {
            foreach ($functionMap as $name => $function) {
                // bypass addFunctionDeclaration since type is already extracted
                $other->functions[$visibility][$name] = $function;
            }
        }
        foreach ($this->expressionFunctions as $visibility => $functionMap) {
            foreach ($functionMap as $name => $exprMap) {
                foreach ($exprMap as $onSpec) {
                    $other->expressionFunctions[$visibility][$name][] = $onSpec;
                }
            }
        }
    }
}
