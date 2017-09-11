<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\CFG\Variable;

class If_ extends Expr
{
    public $cond;
    public $if;
    public $else;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $cond, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
    }

    public function getSubNodeNames(): array
    {
        return array('cond');
    }
}
