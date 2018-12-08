<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class Assign extends Expr
{
    public $var;
    public $value;

    /**
     * Constructs an assignment node.
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(Expr $var, Expr $value, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->var = $var;
        $this->value = $value;
    }

    public function getSubNodeNames()
    {
        return array('var', 'value');
    }
}
