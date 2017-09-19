<?php

namespace Prerano\AST\Node\Name;

use Prerano\AST\Node;
use Prerano\AST\Node\Name;

class Qualified extends Name
{

    /**
     * Constructs an assignment node.
     *
     * @param Expr     $name  Variable
     * @param Expr[]   $args  Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Name $prefix, Node\Name $name, array $attributes = array())
    {
        parent::__construct(array_merge($prefix->parts, $name->parts), $attributes);
    }
}
