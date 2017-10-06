<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class Pipe extends Expr
{
    public $param;
    public $args;
    public $name;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $param, Node\Expr $name, array $args, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->param = $param;
        $this->name = $name;
        $this->addArgs(...$args);
    }

    public function addArgs(Node\Arg ...$args)
    {
        $this->args = $args;
    }

    public function getSubNodeNames()
    {
        return array('param', 'name', 'args');
    }
}
