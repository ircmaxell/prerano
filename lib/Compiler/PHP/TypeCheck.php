<?php

namespace Prerano\Compiler\PHP;

use PhpParser\Node as PhpNode;
use Prerano\CFG\Node\Expr\FuncCall;
use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;

class TypeCheck
{
    public static function compileExternalCheck(PhpNode $var, Type $type): PhpNode
    {
        if ($type->value !== null) {
            return PHP::identical($var, PHP::scalar($type->value));
        }
        switch ($type->type) {
            case Type::ANY: return PHP::constFetch('true');
            case Type::INT: return PHP::funcCall('is_int', $var);
            case Type::FLOAT: return PHP::or(PHP::funcCall('is_float', $var), PHP::funcCall('is_int', $var));
            case Type::STRING: return PHP::funcCall('is_string', $var);
            case Type::UNION:
                $types = $type->subTypes;
                $node = self::compileExternalCheck($var, array_shift($types));
                for ($i = 0, $n = count($types); $i < $n; $i++) {
                    $node = PHP::or($node, self::compileExternalCheck($var, $types[$i]));
                }
                return $node;
            case Type::ARRAY:
                $root = PHP::funcCall('is_array', $var);
                if ($type->subTypes[0]->type === Type::ANY) {
                    // Skiip
                    return $root;
                }
                throw new \LogicException("Arrays with subtypes not implemented yet");
        }
        throw new \LogicException("Compilation for external check of " . $type->toString() . " not implemented");
    }

    public static function compileInternalCheck(PhpNode $var, Type $type): PhpNode
    {
        return self::compileExternalCheck($var, $type);
    }
}
