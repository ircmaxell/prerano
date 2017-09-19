<?php

namespace Prerano\AST;

abstract class VisitorAbstract implements Visitor
{
    public function beforeTraverse(Node\Stmt\Package $package)
    {
    }

    public function enterNode(Node $node): int
    {
        return self::NORMAL;
    }

    public function leaveNode(Node $node)
    {
    }

    public function afterTraverse(Node\Stmt\Package $package)
    {
    }
}
