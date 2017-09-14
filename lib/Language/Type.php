<?php

namespace Prerano\Language;

use InvalidArgumentException;
use RuntimeException;

class Type
{
    const UNKNOWN        = 0b00000000000000;

    const NONE           = 0b00000000000001;
    const NULL           = 0b00000000000010;
    const INT            = 0b00000000000100;
    const FLOAT          = 0b00000000001000;
    const STRING         = 0b00000000010000;
    const TRUE           = 0b00000000100000;
    const FALSE          = 0b00000001000000;
    const ARRAY          = 0b00000010000000;
    const OBJECT         = 0b00000100000000;
    const UNION          = 0b00001000000000;
    const INTERSECTION   = 0b00010000000000;
    const POINTER        = 0b00100000000000;
    const TYPE_REFERENCE = 0b01000000000000;
    const CALLABLE       = 0b10000000000000;

    const COMPLEX_TYPE  = self::UNION | self::INTERSECTION;
    const SIMPLE_TYPE = ~(self::ARRAY | self::COMPLEX_TYPE | self::POINTER | self::TYPE_REFERENCE | self::CALLABLE);

    const _MAP = [
        self::UNKNOWN  => 'unknown',
        self::NONE     => 'none',
        self::NULL     => 'null',
        self::INT      => 'int',
        self::FLOAT    => 'float',
        self::STRING   => 'string',
        self::TRUE     => 'true',
        self::FALSE    => 'false',
        self::OBJECT   => 'object',
        self::CALLABLE => 'fn'
    ];

    protected $type = self::UNKNOWN;
    protected $className = '';
    protected $subTypes = [];

    public function __construct(int $type = self::UNKNOWN, $value = null, Type ...$subTypes)
    {
        $this->type = $type;
        $this->subTypes = $subTypes;
        $this->value = $value;

        $this->normalizeReferences();

        if (($this->type & self::COMPLEX_TYPE) && count($subTypes) < 2) {
            throw new InvalidArgumentException("Complex types require at least 2 types");
        } elseif ($this->type & self::SIMPLE_TYPE && count($subTypes) !== 0) {
            throw new InvalidArgumentException("Sub Types are not supported for simple types");
        } elseif ($this->type & (self::POINTER | self::ARRAY) && count($subTypes) !== 1) {
            throw new InvalidArgumentException("Type array must specify child type");
        } elseif (!$this->validate($type)) {
            throw new InvalidArgumentException("Type value must specify exactly one type");
        } elseif ($this->type & self::TYPE_REFERENCE && (!is_string($value) || empty($value))) {
            throw new InvalidArgumentException("Type reference must specify the referenced type");
        }
    }

    protected function normalizeReferences()
    {
        if (!($this->type & self::TYPE_REFERENCE)) {
            return;
        }
        $key = array_search($this->value, self::_MAP);
        if ($key !== false) {
            $this->type = $key;
            $this->value = null;
        }
    }

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function toString(): string
    {
        if ($this->type & self::UNION) {
            return '(' . implode('|', array_map(function (Type $t) {
                return $t->toString();
            }, $this->subTypes)) . ')';
        } elseif ($this->type & self::INTERSECTION) {
            return '(' . implode('&', array_map(function (Type $t) {
                return $t->toString();
            }, $this->subTypes)) . ')';
        } elseif ($this->type & self::CALLABLE) {
            return 'fn(' . implode(',', array_map(function (Type $t) {
                return $t->toString();
            }, array_slice($this->subTypes, 0, -1))) . '):' . end($this->subTypes)->toString();
        } elseif ($this->type & self::POINTER) {
            return 'pointer<' . $this->subTypes[0]->toString() . '>';
        } elseif ($this->type & self::ARRAY) {
            return 'array<' . $this->subTypes[0]->toString() . '>';
        } elseif ($this->type & self::TYPE_REFERENCE) {
            return $this->value;
        }
        if ($this->value !== null) {
            if (is_string($this->value)) {
                return addcslashes($this->value, "'");
            }
            return (string) $this->value;
        }
        if (!isset(self::_MAP[$this->type])) {
            throw new RuntimeException("Unknown type to cast to string: {$this->type}");
        }
        return self::_MAP[$this->type] ?? 'unknown';
    }

    protected function validate(int $type): bool
    {
        return $type === self::UNKNOWN || $type === ($type & (-1 * $type));
    }

    public function equals(Type $type): bool
    {
        return 0 === $this->compare($type);
    }

    public function withSubTypes(Type ...$subTypes): Type
    {
        return new self($this->type, $this->value, ...$this->subTypes, ...$subTypes);
    }

    public function normalize(): Type
    {
        $new = $this->simplify();
        $result = [];
        foreach ($new->subTypes as $subType) {
            $result[] = $subType->normalize();
        }
        usort($result, function (Type $a, Type $b) {
            return $a->compare($b);
        });
        return new Type($new->type, $new->value, ...$result);
    }

    public function compare(Type $other): int
    {
        if ($other->type !== $this->type) {
            return $other->type - $this->type;
        }
        if ($this->value !== $other->value) {
            return $this->value <=> $other->value;
        }
        if (count($this->subTypes) !== count($other->subTypes)) {
            return count($this->subTypes) !== count($other->subTypes);
        }
        foreach ($this->subTypes as $key => $value) {
            $tmp = $value->compare($other->subTypes[$key]);
            if ($tmp !== 0) {
                return $tmp;
            }
        }
        return 0;
    }

    public function simplify(): Type
    {
        if ($this->type === ($this->type & self::SIMPLE_TYPE)) {
            return $this;
        }
        if ($this->type === self::UNION) {
            return $this->simplifyComplexTypes(self::UNION);
        }
        if ($this->type === self::INTERSECTION) {
            $type = $this->simplifyComplexTypes(self::INTERSECTION);
            // Final check to favor union of intersections over intersection of union
            foreach ($type->subTypes as $key => $subType) {
                if (!($subType->type & self::UNION)) {
                    continue;
                }
                return $this->favorUnionFromIntersection($type, $key);
            }
            return $type;
        }
        if ($this->type === self::ARRAY) {
            if ($this->subTypes) {
                return new self(self::ARRAY, null, $this->subTypes[0]->simplify());
            }
            return $this;
        }
        var_dump($this);
        throw new RuntimeException("Cannot simplify complex types yet: " . $this->toString());
    }

    protected function favorUnionFromIntersection(Type $type, int $index): Type
    {
        assert($type->type & self::INTERSECTION);

        $result = [];
        $union = $type->subTypes[$index];
        assert($union->type & self::UNION);
        if ($index === 0) {
            $first = $type->subTypes[1];
            $rest = array_slice($type->subTypes, 2);
        } elseif ($index === 1) {
            $first = $type->subTypes[0];
            $rest = array_slice($type->subTypes, 2);
        } else {
            $first = $type->subTypes[0];
            $rest = array_merge(
                array_slice($type->subTypes, 1, $index - 1),
                array_slice($type->subTypes, $index + 1)
            );
        }
        $newUnion = (new self(self::UNION, null, ...array_map(function (Type $type) use ($first): Type {
            return new self(self::INTERSECTION, null, $type, $first);
        }, $union->subTypes)))->simplify();
        if (empty($rest)) {
            return $newUnion;
        }
        return (new self(self::INTERSECTION, null, $newUnion, ...$rest))->simplify();
    }

    protected function simplifyComplexTypes(int $type): Type
    {
        // check if sub-types are the same
        $subTypes = $this->subTypes;

        foreach ($subTypes as $key => $subType) {
            $subTypes[$key] = $subType = $subType->simplify();
            if ($subType->type === $type) {
                // we can combine the unions!!!
                $start = array_slice($subTypes, 0, $key);
                $end = array_slice($subTypes, $key + 1);
                return (new self($type, null, ...$start, ...$subType->subTypes, ...$end))->simplify();
            }
        }
        $this->subTypes = $subTypes;

        $first = array_pop($subTypes);
        foreach ($subTypes as $subType) {
            if ($first->equals($subType)) {
                if (count($subTypes) > 1) {
                    // Drop duplicate and simplify
                    return (new self($type, null, ...$subTypes))->simplify();
                } else {
                    // A union of 1 is just the child
                    return $first;
                }
            }
        }
        return $this;
    }
}
