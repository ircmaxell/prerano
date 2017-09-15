<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Variable;

class Match extends Expr
{
    public $cond;
    public $cases;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $cond, array $cases, Variable $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->result = $result;
        $this->setCases(...$cases);
    }

    public function getSubNodeNames(): array
    {
        return array('cond', 'cases', 'result');
    }

    private function setCases(MatchCase ...$cases)
    {
        $this->cases = $cases;
    }
}
