<?php

namespace Prerano\AST;

class Traverser
{
    protected $visitors = [];

    public function addVisitor(Visitor ...$visitors)
    {
        $this->visitors = array_merge($this->visitors, $visitors);
    }
    
    public function traverse(Node\Stmt\Package $package)
    {
        foreach ($this->visitors as $visitor) {
            $visitor->beforeTraverse($package);
        }
        $package->stmts = $this->traverseNode(...$package->stmts);
        foreach ($this->visitors as $visitor) {
            $visitor->afterTraverse($package);
        }
    }

    protected function traverseNode(Node ...$nodes)
    {
        $toChange = [];
        foreach ($nodes as $key => $node) {
            $mode = Visitor::NORMAL;
            foreach ($this->visitors as $visitor) {
                $mode |= $visitor->enterNode($node);
            }
            if ($mode & Visitor::SKIP_CHILDREN) {
                continue;
            }
            foreach ($node->getSubNodeNames() as $name) {
                $subNode = $node->$name;
                if ($subNode instanceof Node) {
                    $result = $this->traverseNode($subNode);
                    if ($result) {
                        $node->$name = $result[0];
                    } else {
                        $node->$name = null;
                    }
                } elseif (self::isNodeArray($subNode)) {
                    $node->$name = $this->traverseNode(...$subNode);
                }
            }
            foreach ($this->visitors as $visitor) {
                $status = $visitor->leaveNode($node);
                if ($status instanceof Node) {
                    $toChange[] = [$key, [$status]];
                } elseif (is_array($status)) {
                    $toChange[] = [$key, $status];
                } elseif ($status === Visitor::REMOVE_NODE) {
                    $toChange[] = [$key, []];
                }
            }
        }
        foreach (array_reverse($toChange) as list($key, $new)) {
            array_splice($nodes, $key, 1, $new);
        }
        return $nodes;
    }

    protected static function isNodeArray($array): bool
    {
        if (!is_array($array)) {
            return false;
        }
        foreach ($array as $value) {
            if (!$value instanceof Node) {
                return false;
            }
        }
        return true;
    }
}
