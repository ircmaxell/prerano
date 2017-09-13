<?php

namespace Prerano\Debug;

use Prerano\Type;
use Prerano\CFG\Block;
use Prerano\CFG\Node;
use Prerano\CFG\Variable;
use Prerano\Language\Package;

class CFGDumper
{
    public static function dumpPackage(Package $package)
    {
        echo "Package: " . $package->name . "\n";
        echo "  Public:\n";
        self::dumpPackageFlag($package, Package::PUBLIC);
        echo "  Protected:\n";
        self::dumpPackageFlag($package, Package::PROTECTED);
        echo "  Private:\n";
        self::dumpPackageFlag($package, Package::PRIVATE);
    }

    protected static function dumpPackageFlag(Package $package, int $flag)
    {
        echo "    Types:\n";
        foreach ($package->types[$flag] as $name => $type) {
            echo "      $name => " . $type->toString() . "\n";
        }
    }
    public static function dump(array $blocks, array &$seen = [])
    {
        foreach ($blocks as $block) {
            self::dumpBlock($block, $seen);
        }
    }

    public static function dumpBlock(Block $block, array &$seen = [])
    {
        $scope = $block->getScope();
        $id = $block->getId();
        if (isset($seen[$id])) {
            return;
        }
        $seen[$id] = true;
        echo "Block #$id(";
        $sep = '';
        foreach ($scope->getInput() as $name => $variable) {
            echo $sep . '$' . $variable->getId() . '<' . $name . ">";
            $sep = ', ';
        }
        echo ")\n";
        foreach ($block->getNodes() as $node) {
            echo "  " . $node->getName() . ":\n";
            foreach ($node->getSubNodeNames() as $name) {
                if (!$node->$name instanceof Variable) {
                    throw new \LogicException("Nodes can only have variables as children");
                }
                echo "    $name: " . self::dumpVariable($node->$name) . "\n";
            }
        }
        foreach ($block->getNextBlocks() as $reason => $new) {
            echo "  {$reason}->Block #" . $new->getId() . "\n";
        }
        echo "\n";

        self::dump($block->getNextBlocks(), $seen);
    }

    public static function dumpVariable($variable): string
    {
        $result = '';
        if ($variable instanceof Variable) {
            $result .= '$' . $variable->getId();
            if ($variable instanceof Variable\Named) {
                $result .= '<' . $variable->name . '>';
            } elseif ($variable instanceof Variable\Scalar) {
                $result .= '=' . $variable->value;
            } elseif ($variable instanceof Variable\Phi) {
                $result .= '{' . implode(', ', array_map(self::class . '::dumpVariable', $variable->parents)) . '}';
            }
            $result .= '@' . self::dumpType($variable->getType());
        } elseif (is_array($variable)) {
            $result .= '[';
            $sep = '';
            foreach ($variable as $var) {
                $result .= $sep . self::dumpVariable($var);
                $sep = ', ';
            }
            $result .= ']';
        }
        return $result;
    }

    public static function dumpType(Type $type): string
    {
        switch ($type->type) {
            case Type::INT:
                return 'int';
            case Type::STRING:
                return 'string';
            case Type::UNKNOWN:
                return 'unknown';
            case Type::UNION:
                return 'union(' . implode(', ', array_map(self::class . '::dumpType', $type->subTypes)) . ')';
        }
        throw new \LogicException("Type not implemented: {$type->type}");
    }
}
