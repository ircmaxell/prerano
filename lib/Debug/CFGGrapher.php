<?php

namespace Prerano\Debug;

use Prerano\Language\Type;
use Prerano\Language\Block;
use Prerano\CFG\Node;
use Prerano\Language\Variable;
use Prerano\Language\Package;
use Prerano\Language\Function_;

use phpDocumentor\GraphViz\Node as GVNode;
use phpDocumentor\GraphViz\Edge as GVEdge;
use phpDocumentor\GraphViz\Graph;

class CFGGrapher
{
    protected static $id = 1;
    protected static $blockMap = [];

    protected static function id(): string
    {
        return 'node_' . self::$id++;
    }

    public static function graphPackage(Package $package, string $filename, string $format = 'svg')
    {
        self::convertPackageToGraph($package)->export($format, $filename);
    }

    protected static function convertPackageToGraph(Package $package): Graph
    {
        $typeMap = [];
        $funcMap = [];
        $graph = Graph::create($package->name);
        $root = GVNode::create(self::id(), $package->name);
        $graph->setNode($root);
        foreach ($package->types as $visibility => $types) {
            $visibility = self::visibility($visibility);
            foreach ($types as $name => $type) {
                $typeMap[$name] = GVNode::create(self::id(), $visibility . " type $name\n" . $type->toString());
                $graph->setNode($typeMap[$name]);
                $graph->link(GVEdge::create($root, $typeMap[$name]));
            }
        }
        foreach ($package->functions as $visibility => $functions) {
            $visibility = self::visibility($visibility);
            foreach ($functions as $name => $func) {
                $funcMap[$name] = GVNode::create(self::id(), $visibility . " $name\nargs: " . self::extractParameters($func) . "\nreturn " . self::dumpVariable($func->result));
                $graph->setNode($funcMap[$name]);
                $graph->link(GVEdge::create($root, $funcMap[$name]));
                $graph->link(GVEdge::create($funcMap[$name], self::convertBlock($graph, $func->body)));
            }
        }
        return $graph;
    }

    protected static function visibility(int $visibility): string
    {
        switch ($visibility) {
            case Package::PUBLIC: return "public";
            case Package::PRIVATE: return "private";
            case Package::PROTECTED: return "protected";
        }
    }

    protected static function extractParameters(Function_ $func): string
    {
        $result = '(';
        $sep = '';
        foreach ($func->parameters as $param) {
            $result .= $sep . $param->getDeclaredType()->toString() . ' $' . $param->name;
            $sep = ', ';
        }
        return $result . ')';
    }

    protected static function convertBlock(Graph $graph, Block $current)
    {
        $blockId = $current->getId();
        if (isset(self::$blockMap[$blockId])) {
            return self::$blockMap[$blockId];
        }
        self::$blockMap[$blockId] = $parent = GVNode::create(self::id(), 'Block ' . $blockId);
        $graph->setNode($parent);
        foreach ($current->getNodes() as $node) {
            $new = GVNode::create(self::id(), $node->getName() . self::dumpNode($node));
            $graph->setNode($new);
            $graph->link(GVEdge::create($parent, $new));
            $parent = $new;
        }
        foreach ($current->getNextBlocks() as $reason => $block) {
            $node = self::convertBlock($graph, $block);
            $graph->link(GVEdge::create($parent, $node)->setLabel($reason));
        }
        return self::$blockMap[$blockId];
    }

    protected static function dumpNode(Node $node): string
    {
        $result = '';
        foreach ($node->getSubNodeNames() as $name) {
            $subNode = $node->$name;
            if (is_array($subNode)) {
                $result .= "\n$name: (" . self::dumpVariable(...$subNode) . ')';
            } elseif ($subNode instanceof Variable) {
                $result .= "\n$name: " . self::dumpVariable($subNode);
            } elseif ($subNode instanceof Type) {
                $result .= "\n$name: TYPE(" . $subNode->toString() . ")";
            } elseif ($subNode !== null) {
                var_dump($subNode);
                throw new \LogicException("Unknown subnode type: " . gettype($subNode));
            }
        }
        return $result;
    }

    protected static function dumpVariable(Variable ... $vars): string
    {
        $result = '';
        $sep = '';
        foreach ($vars as $var) {
            if ($var instanceof Variable\IdentifierReference) {
                $result .= $sep . $var->value;
            } elseif ($var instanceof Variable\Literal) {
                $result .= $sep . (string) $var->value;
            } elseif ($var instanceof Variable\Named) {
                $result .= $sep . '$' . $var->name;
            } elseif ($var instanceof Variable\Temp) {
                $result .= $sep . '$' . $var->getId();
            } else {
                var_dump($var);
                throw new \LogicException("Unknown variable type: " . get_class($var));
            }
            $sep = ', ';
        }
        return $result;
    }
}
