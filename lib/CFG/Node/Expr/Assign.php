<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Variable;

class Assign extends Expr
{
    public $var;
    public $expr;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $var, Variable $expr, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->var = $var;
        $this->expr = $expr;
    }

    public function getSubNodeNames(): array
    {
        return array('var', 'expr');
    }
}
