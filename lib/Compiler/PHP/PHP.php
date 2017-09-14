<?php
namespace Prerano\Compiler\PHP;

use Prerano\Language\{
    Package,
    Type
};
use PhpParser\Node as PhpNode;

class PHP
{

    public static function args(PhpNode ...$args): array
    {
        return array_map(function($param) {
            return new PhpNode\Arg($param);
        }, $args);
    }

    public static function array(array $items): PhpNode
    {
        $result = [];
        $i = 0;
        foreach ($items as $key => $value) {
            if ($key !== $i) {
                $result[] = new PhpNode\Expr\ArrayItem(
                    $value,
                    self::scalar($key)
                );
            } else {
                $result[] = new PhpNode\Expr\ArrayItem($value);
            }
        }
        return new PhpNode\Expr\Array_($result);
    }

    public static function assign(PhpNode $var, PhpNode $value)
    {
        return new PhpNode\Expr\Assign($var, $value);
    }

    public static function binaryOpPlus(PhpNode $left, PhpNode $right): PhpNode
    {
        return new PhpNode\Expr\BinaryOp\Plus($left, $right);
    }

    public static function classMethod(string $name, int $modifier, array $params, array $stmts)
    {
        return new PhpNode\Stmt\ClassMethod($name, [
            'flags' => $modifier,
            'params' => $params,
            'stmts' => $stmts,
        ]);
    }

    public static function const(string $name, PhpNode $value): PhpNode
    {
        return new PhpNode\Stmt\Const_([
            new PhpNode\Const_($name, $value)
        ]);
    }

    public static function empty(PhpNode $expr): PhpNode
    {
        return new PhpNode\Expr\Empty_($expr);
    }

    public static function funcCall(string $func, PhpNode ...$params): PhpNode
    {
        return new PhpNode\Expr\FuncCall(self::name($func), array_map(function($param) {
            return new PhpNode\Arg($param);
        }, $params));
    }

    public static function if(PhpNode $cond, array $yes, array $no = null): PhpNode
    {
        if ($no) {
            return new PhpNode\Stmt\If_($cond, ['stmts' => $yes, 'else' => $no]);
        }
        return new PhpNode\Stmt\If_($cond, ['stmts' => $yes]);
    }

    public static function int(int $item): PhpNode
    {
        return new PhpNode\Scalar\LNumber($item);
    }

    public static function instanceCall(PhpNode $object, string $method, PhpNode...$args): PhpNode
    {
        return new PhpNode\Expr\MethodCall($object, $method, self::args(...$args));
    }

    public static function packageToModifier(int $modifier): int
    {
        switch ($modifier) {
            case Package::PUBLIC: return PhpNode\Stmt\Class_::MODIFIER_PUBLIC;
            case Package::PROTECTED: return PhpNode\Stmt\Class_::MODIFIER_PROTECTED;
            case Package::PRIVATE: return PhpNode\Stmt\Class_::MODIFIER_PRIVATE;
        }

    }

    public static function modifier(string $modifier): int
    {
        switch ($modifier) {
            case 'public': return PhpNode\Stmt\Class_::MODIFIER_PUBLIC;
            case 'protected': return PhpNode\Stmt\Class_::MODIFIER_PROTECTED;
            case 'private': return PhpNode\Stmt\Class_::MODIFIER_PRIVATE;
            case 'static': return PhpNode\Stmt\Class_::MODIFIER_STATIC;
            case 'abstract': return PhpNode\Stmt\Class_::MODIFIER_ABSTRACT;
        }
        $parts = explode(' ', $modifier);
        if (count($parts) > 1) {
            $result = 0;
            foreach ($parts as $part) {
                $result |= self::modifier($part);
            }
            return $result;
        }
        $parts = explode(',', $modifier);
        if (count($parts) > 1) {
            $result = 0;
            foreach ($parts as $part) {
                $result |= self::modifier($part);
            }
            return $result;
        }
        throw new \LogicException("Unknown modifier: " . $modifier);
    }

    public static function name(string $value): PhpNode
    {
        if (strpos('\\', $value !== false)) {
            return new PhpNode\Name\FullyQualified($value);
        }
        return new PhpNode\Name($value);
    }

    public static function nativeType(Type $type)
    {
        switch ($type->type) {
            case Type::INT:
                return 'int';
            case Type::FLOAT:
                return 'float';
            case Type::STRING:
                return 'string';
        }
        return null;
    }

    public static function new(string $class, PhpNode ...$args)
    {
        return new PhpNode\Expr\New_(self::name($class), self::args(...$args));
    }

    public static function param(string $name): PhpNode
    {
        return new PhpNode\Param($name);
    }

    public static function propFetch(PhpNode $var, string $prop): PhpNode
    {
        return new PhpNode\Expr\PropertyFetch($var, $prop);
    }

    public static function return(PhpNode $var): PhpNode
    {
        return new PhpNode\Stmt\Return_($var);
    }

    public static function scalar($item): PhpNode
    {
        if (is_string($item)) {
            return self::string($item);
        } elseif (is_int($item)) {
            return self::int($item);
        } elseif (is_float($item)) {
            return self::float($item);
        }
        var_dump($item);
    }

    public static function staticCall(string $class, string $func, PhpNode ...$params): PhpNode
    {
        return new PhpNode\Expr\StaticCall(self::name($class), $func, self::args(...$params));
    }

    public static function staticPropFetch(string $class, string $prop): PhpNode
    {
        return new PhpNode\Expr\StaticPropertyFetch(self::name($class), $prop);
    }

    public static function string(string $value): PhpNode
    {
        return new PhpNode\Scalar\String_($value);
    }

    public static function var(string $name): PhpNode
    {
        return new PhpNode\Expr\Variable($name);
    }

} 