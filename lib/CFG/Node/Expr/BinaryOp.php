<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Variable;

abstract class BinaryOp extends Expr
{
    public $left;
    public $right;
    public $result;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $left, Variable $right, Variable $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->left = $left;
        $this->right = $right;
        $this->result = $result;
    }

    public function getSubNodeNames(): array
    {
        return array('left', 'right', 'result');
    }
}
