<?php

namespace Prerano\AST\Visitor;

use Prerano\AST\Node;
use Prerano\AST\VisitorAbstract;

class AliasResolver extends VisitorAbstract
{
    protected $imports = [];

    public function beforeTraverse(Node\Stmt\Package $package)
    {
        foreach ($package->stmts as $stmt) {
            // All imports are root level, find all of them
            if ($stmt instanceof Node\Stmt\Alias) {
                $asString = $stmt->as->toString();
                if (isset($this->imports[$asString])) {
                    throw new \RuntimeException("Duplicate import for $asString found");
                }
                $this->imports[$asString] = [$stmt->as, $stmt->name];
            }
        }
    }

    public function leaveNode(Node $node)
    {
        if (empty($this->imports)) {
            return;
        }
        if ($node instanceof Node\Name) {
            foreach ($this->imports as $string => list($as, $name)) {
                if ($node->isPrefixedBy($string)) {
                    // Replace prefix with nothing
                    $suffix = $node->getSuffix($string);
                    $return = new Node\Name\Qualified($name, new Node\Name($suffix));
                    return $return;
                }
            }
        } elseif ($node instanceof Node\Stmt\Alias) {
            return self::REMOVE_NODE;
        }
    }

    public function afterTraverse(Node\Stmt\Package $package)
    {
        $this->imports = [];
    }
}
