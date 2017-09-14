<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

abstract class BinaryOp extends Expr
{

    public $left;
    public $right;

    /**
     * Constructs an assignment node.
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(Expr $left, Expr $right, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->left = $left;
        $this->right = $right;
    }

    public function getSubNodeNames()
    {
        return array('left', 'right');
    }
}
