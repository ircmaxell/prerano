<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node\Expr;

class Block extends Expr
{
    /** @var Expr Expression */
    public $expr;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(array $expr, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->expr = $expr;
    }

    public function getSubNodeNames()
    {
        return array('expr');
    }
}
