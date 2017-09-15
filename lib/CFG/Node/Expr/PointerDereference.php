<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Variable;

class PointerDereference extends Expr
{
    public $expr;
    public $result;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $expr, Variable $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->expr = $expr;
        $this->result = $result;
    }

    public function getSubNodeNames(): array
    {
        return array('expr', 'result');
    }
}
