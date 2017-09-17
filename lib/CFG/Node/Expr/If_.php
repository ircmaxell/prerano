<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Variable;

class If_ extends Expr
{
    public $cond;
    public $result;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $cond, Variable $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->result = $result;
    }

    public function getSubNodeNames(): array
    {
        return array('cond', 'result');
    }
}
