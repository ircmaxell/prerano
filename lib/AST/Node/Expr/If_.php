<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node\Expr;

class If_ extends Expr
{
    /** @var Expr Expression */
    public $cond;
    public $if;
    public $else;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Expr $cond, Expr $if, Expr $else = null, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->if = $if;
        $this->else = $else;
    }

    public function getSubNodeNames()
    {
        return array('cond', 'if', 'else');
    }
}
