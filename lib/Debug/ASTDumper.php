<?php

namespace Prerano\Debug;

use Prerano\AST\Node;
use Prerano\AST\Node\Stmt\Package;

class ASTDumper
{
    public static function dump(Package $package): string
    {
        $result = "Package " . $package->name->toString() . "\n";
        $result .= self::dumpNodes($package->stmts, '  ');
        return $result;
    }

    public static function dumpNodes(array $nodes, string $indent = ''): string
    {
        $result = '';
        foreach ($nodes as $node) {
            if ($node instanceof $node) {
                $result .= self::dumpNode($node, $indent);
            } else {
                $result .= $indent . $node . "\n";
            }
        }
        return $result;
    }

    public static function dumpNode(Node $node, string $indent): string
    {
        $result = $indent . $node->getName() . "\n";
        $indent .= "  ";
        foreach ($node->getSubNodeNames() as $name) {
            $subNodes = $node->$name;
            if (is_array($subNodes)) {
                $result .= $indent . $name . " [\n";
                $result .= self::dumpNodes($subNodes, $indent . '  ');
                $result .= $indent . "]\n";
            } elseif ($subNodes instanceof Node) {
                $result .= $indent . $name . ":\n";
                $result .= self::dumpNode($subNodes, $indent . '  ');
            } else {
                $result .= $indent . $name . '(' . $subNodes . ")\n";
            }
        }
        return $result;
    }
}
