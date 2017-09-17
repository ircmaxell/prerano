<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Variable;
use Prerano\Language\Type;

class Is extends Expr
{
    public $cond;
    public $type;
    public $result;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Variable $cond, Type $type, Variable $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->type = $type;
        $this->result = $result;
    }

    public function getSubNodeNames(): array
    {
        return array('cond', 'type', 'result');
    }
}
