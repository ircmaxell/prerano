<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class MethodCall extends Expr
{
    public $obj;
    public $name;

    /**
     * Constructs an assignment node.
     *
     * @param Expr     $name  Variable
     * @param Expr[]   $args  Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $obj, Node $name, array $args, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->obj = $obj;
        $this->name = $name;
        $this->setArguments(...$args);
    }

    public function getSubNodeNames()
    {
        return array('obj', 'name', 'args');
    }

    private function setArguments(Node\Arg ...$args)
    {
        $this->args = $args;
    }
}
