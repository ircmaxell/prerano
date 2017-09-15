<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class PointerDereference extends Expr
{
    public $expr;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $expr, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->expr = $expr;
    }

    public function getSubNodeNames()
    {
        return array('expr');
    }
}
