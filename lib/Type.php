<?php

namespace Prerano;

use InvalidArgumentException;
use RuntimeException;

class Type
{
    const UNKNOWN       = 0b000000000000;
    const INT           = 0b000000000001;
    const FLOAT         = 0b000000000010;
    const STRING        = 0b000000000100;
    const NULL          = 0b000000001000;
    const BOOL          = 0b000000010000;
    const ARRAY         = 0b000000100000;
    const OBJECT        = 0b000001000000;
    const UNION         = 0b000010000000;
    const INTERSECTION  = 0b000100000000;

    const COMPLEX_TYPE  = self::UNION | self::INTERSECTION;
    const SIMPLE_TYPE = ~(self::ARRAY | self::COMPLEX_TYPE);


    protected $type = self::UNKNOWN;
    protected $className = '';
    protected $subTypes = [];

    public function __construct(int $type = self::UNKNOWN, string $className = null, Type ...$subTypes)
    {
        $this->type = $type;
        $this->subTypes = $subTypes;
        $this->className = $className;
        if ($this->className) {
            $this->type &= self::TYPE_OBJECT;
        }
        if (!$this->type & self::COMPLEX_TYPE && count($subTypes) > 1) {
            throw new InvalidArgumentException("Multiple sub types are only supported for complex types");
        } elseif ($this->type & self::SIMPLE_TYPE && count($subTypes) > 0) {
            throw new InvalidArgumentException("Sub Types are not supported for simple types");
        }
    }

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function set(Type $type)
    {
        $this->type = $type->type;
        $this->className = $type->className;
        $this->subTypes = [];
        foreach ($type->subTypes as $subType) {
            $st = new Type;
            $st->set($subType);
            $this->subTypes[] = $st;
        }
    }

    public function equals(Type $type): bool
    {
        if ($this->type !== $type->type) {
            return false;
        }
        if ($this->className !== $type->className) {
            return false;
        }
        // TODO: Normalize here
        foreach ($this->subTypes as $key => $subType) {
            if (!isset($type->subTypes[$key]) || !$subType->equals($type->subTypes[$key])) {
                return false;
            }
        }
        return true;
    }

    public function unionWith(Type $other): Type
    {
        return (new self(self::UNION, null, $this, $other))->simplify();
    }

    public function simplify(): Type
    {
        if ($this->type === ($this->type & self::SIMPLE_TYPE)) {
            return $this;
        }
        if ($this->type === self::UNION) {
            // check if sub-types are the same
            $subTypes = $this->subTypes;
            $first = array_pop($subTypes);
            foreach ($subTypes as $subType) {
                if (!$first->equals($subType)) {
                    // cannot be simplified
                    return $this;
                }
            }
            return $first;
        }
        throw new RuntimeException("Cannot simplify complex types yet");
    }
}
