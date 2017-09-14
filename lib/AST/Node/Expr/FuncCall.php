<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class FuncCall extends Expr
{
    public $name;

    /**
     * Constructs an assignment node.
     *
     * @param Expr     $name  Variable
     * @param Expr[]   $args  Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $name, array $args, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->setArguments(...$args);
    }

    public function getSubNodeNames()
    {
        return array('name', 'args');
    }

    private function setArguments(Node\Arg ...$args)
    {
        $this->args = $args;
    }
}
