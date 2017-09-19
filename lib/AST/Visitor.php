<?php

namespace Prerano\AST;

interface Visitor
{
    const NORMAL        = 0b000001;
    const SKIP_CHILDREN = 0b000010;
    const REMOVE_NODE   = 0b000100;
    
    public function beforeTraverse(Node\Stmt\Package $package);

    public function enterNode(Node $node): int;

    public function leaveNode(Node $node);

    public function afterTraverse(Node\Stmt\Package $package);
}
