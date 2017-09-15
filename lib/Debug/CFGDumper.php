<?php

namespace Prerano\Debug;

use Prerano\Language\Type;
use Prerano\Language\Block;
use Prerano\CFG\Node;
use Prerano\Language\Variable;
use Prerano\Language\Package;

class CFGDumper
{
    public static function dumpPackage(Package $package): string
    {
        $result = "Package: " . $package->name . "\n";
        $result .= "  Public:\n";
        $result .= self::dumpPackageFlag($package, Package::PUBLIC);
        $result .= "  Protected:\n";
        $result .= self::dumpPackageFlag($package, Package::PROTECTED);
        $result .= "  Private:\n";
        $result .= self::dumpPackageFlag($package, Package::PRIVATE);
        return $result;
    }

    protected static function dumpPackageFlag(Package $package, int $flag): string
    {
        $result = "    Types:\n";
        foreach ($package->types[$flag] as $name => $type) {
            $result .= "      $name => " . $type->toString() . "\n";
        }
        $result .= "    Functions:\n";
        foreach ($package->functions[$flag] as $name => $function) {
            $result .= "      $name:\n";
            $result .= "        result: " . self::dumpVariable($function->result) . "\n";
            $result .= "        blocks: \n";
            $result .= self::dumpBlock($function->body);
        }
        return $result;
    }

    public static function dumpBlocks(array $blocks, array &$seen = []): string
    {
        $result = '';
        foreach ($blocks as $block) {
            $result .= self::dumpBlock($block, $seen);
        }
        return $result;
    }

    public static function dumpBlock(Block $block, array &$seen = []): string
    {
        $id = $block->getId();
        if (isset($seen[$id])) {
            return '';
        }
        $seen[$id] = true;
        $result = "          Block #$id(";
        $sep = '';
        foreach ($block->getInput() as $name => $variable) {
            $result .= $sep . '$' . $variable->getId() . '<' . $name . ">";
            $sep = ', ';
        }
        $result .= ")\n";
        foreach ($block->getNodes() as $node) {
            $result .= "            " . $node->getName() . ":\n";
            foreach ($node->getSubNodeNames() as $name) {
                $children = [$node->$name];
                if (is_array($node->$name)) {
                    $children = $node->$name;
                }
                foreach ($children as $key => $subNode) {
                    if ($subNode instanceof Variable) {
                        $result .= "                $name: " . self::dumpVariable($node->$name) . "\n";
                    } elseif ($subNode instanceof Node\Expr\MatchCase) {
                        $result .= "                match_{$subNode->id} (" . self::dumpVariable($subNode->cond) . ")\n";
                    } else {
                        var_dump($subNode);
                        throw new \LogicException("Nodes can only have variables as children for node $name: " . $node->getName());
                    }
                }
            }
        }
        foreach ($block->getNextBlocks() as $reason => $new) {
            $result .= "             {$reason}->Block #" . $new->getId() . "\n";
        }
        $result .= "\n";

        return $result . self::dumpBlocks($block->getNextBlocks(), $seen);
    }

    public static function dumpVariable($variable): string
    {
        $result = '';
        if ($variable instanceof Variable) {
            $result = $variable->getDeclaredType()->toString() . ' ';
            $result .= '$' . $variable->getId();
            if ($variable instanceof Variable\Named) {
                $result .= '<' . $variable->name . '>';
            } elseif ($variable instanceof Variable\Literal) {
                $result .= ' = ' . $variable->value;
            } elseif ($variable instanceof Variable\Phi) {
                $result .= '{' . implode(', ', array_map(self::class . '::dumpVariable', $variable->parents)) . '}';
            }
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
