<?php

namespace Prerano\Debug;

use Prerano\AST\Node;
use Prerano\AST\Node\Stmt\Package;

class ASTDumper
{
    public static function dump(Package $package)
    {
        echo "Package " . $package->name->toString() . "\n";
        self::dumpNodes($package->stmts, '  ');
    }

    public static function dumpNodes(array $nodes, string $indent = '')
    {
        foreach ($nodes as $node) {
            if ($node instanceof $node) {
                self::dumpNode($node, $indent);
            } else {
                echo $indent . $node . "\n";
            }
        }
    }

    public static function dumpNode(Node $node, string $indent)
    {
        echo $indent . $node->getName() . "\n";
        $indent .= "  ";
        foreach ($node->getSubNodeNames() as $name) {
            $subNodes = $node->$name;
            if (is_array($subNodes)) {
                echo $indent . $name . " [\n";
                self::dumpNodes($subNodes, $indent . '  ');
                echo $indent . "]\n";
            } elseif ($subNodes instanceof Node) {
                echo $indent . $name . ":\n";
                self::dumpNode($subNodes, $indent . '  ');
            } else {
                echo $indent . $name . '(' . $subNodes . ")\n";
            }
        }
    }
}
