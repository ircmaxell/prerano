<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Variable;

class MatchCase extends Expr
{
    public $cond;
    public $result;
    public $id;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $cond, int $id, Variable $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->result = $result;
        $this->id = $id;
    }

    public function getSubNodeNames(): array
    {
        return array('cond', 'cases', 'result');
    }
}
