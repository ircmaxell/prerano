<?php

namespace Prerano\AST\Visitor;

use Prerano\AST\Node;
use Prerano\AST\VisitorAbstract;
use Prerano\Language\Type;

class TypeQualifier extends VisitorAbstract
{
    protected $prefix = '';

    public function beforeTraverse(Node\Stmt\Package $package)
    {
        $this->prefix = $package->name;
    }

    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Expr\Type\Named) {
            return;
        }
        if ($node->name->isQualified()) {
            return;
        }
        $type = new Type(Type::TYPE_REFERENCE, $node->name->toString());
        if ($type->type === Type::TYPE_REFERENCE) {
            $node->name = new Node\Name\Qualified($this->prefix, $node->name);
        }
    }

}
