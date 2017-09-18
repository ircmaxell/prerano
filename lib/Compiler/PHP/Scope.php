<?php

namespace Prerano\Compiler\PHP;

use PhpParser\Node as PhpNode;
use Prerano\CFG\Node\Expr\FuncCall;
use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;

class Scope
{
    const INIT_SYMBOL = "\xe2\x88\xab";
    const FROM_SEPARATOR = "::";
    const SEPERATOR = "\xdc\x83\xdc\x83";
    const EXPRESSION_SEPARATOR = "\xe2\x86\x92";

    public static function join(string ...$parts): string
    {
        return implode(self::SEPERATOR, $parts);
    }

    public static function resolvePackage(Package $package): PhpNode
    {
        $parts = explode(self::FROM_SEPARATOR, $package->name);
        return PHP::staticCall(self::joinPHP(...$parts, ...['__PRERANO_CODE__']), self::resolveLocal($package, self::INIT_SYMBOL));
    }

    public static function resolvePackageName(Package $package): string
    {
        return implode(self::SEPERATOR, explode(self::FROM_SEPARATOR, $package->name));
    }

    public static function resolveInit(Package $package): string
    {
        return self::resolveLocal($package, self::INIT_SYMBOL);
    }

    public static function resolveLocal(Package $package, string $scope): string
    {
        $parts = explode(self::SEPERATOR, $scope);
        $prefix = explode('::', $package->name);
        return self::join(...$prefix, ...$parts);
    }

    public static function resolveExpressionLocal(Package $package, string $scope, Type $type): string
    {
        $parts = explode(self::SEPERATOR, $scope);
        $end = array_pop($parts);
        $end .= self::EXPRESSION_SEPARATOR . self::sanitize($type->toString());
        $prefix = explode('::', $package->name);

        return self::join(...$prefix, ...$parts, ...[$end]);
    }

    public static function resolveFunctionCall(Package $package, FuncCall $call, Variable ...$args): PhpNode
    {
        if (!$call->name instanceof Variable\IdentifierReference) {
            throw new \LogicException("Dynamic function calls are not supported yet");
        }
        $args = self::variables(...$args);
        $parts = explode(self::FROM_SEPARATOR, $call->name->value);
        $func = array_pop($parts);
        if (empty($parts) || self::join(...$parts) === self::resolvePackageName($package)) {
            // short-circuit, local call:
            return PHP::instanceCall(
                PHP::var('this'),
                Scope::resolveLocal($package, $func),
                ...$args
            );
        } elseif ($parts[0] === 'php') {
            array_shift($parts);
            $parts[] = $func;
            return PHP::funcCall(implode('\\', $parts), ...$args);
        }

        var_dump($parts, $package->name);
        throw new \Logic("Unknown how to resolve {$call->name->value}");
    }

    public static function joinPHP(string ...$parts): string
    {
        return '\\' . implode('\\', $parts);
    }

    public static function variable(Variable $var): PhpNode
    {
        if ($var instanceof Variable\Named) {
            return PHP::var($var->name);
        } elseif ($var instanceof Variable\Literal) {
            return PHP::scalar($var->value);
        } elseif ($var instanceof Variable\IdentifierReference) {
            return PHP::name($var->value);
        }
        return PHP::var('_' . $var->getId());
    }

    public static function variables(Variable ...$vars): array
    {
        $result = [];
        foreach ($vars as $var) {
            $result[] = self::variable($var);
        }
        return $result;
    }

    public static function sanitize(string $item): string
    {
        $from = [
            '<',
            '>',
            '*',
            '(',
            ')',
            '{',
            '}',
            ','
        ];
        $to = [
            "\xe2\x89\xba",
            "\xe2\x89\xbb",
            "\xe2\x8b\x86",
            "\xe2\x9d\xa8",
            "\xe2\x9d\xa9",
            "\xe2\x9d\xb4",
            "\xe2\x9d\xb5",
            "\xcc\xa6",
        ];
        return str_replace($from, $to, $item);
    }
}
