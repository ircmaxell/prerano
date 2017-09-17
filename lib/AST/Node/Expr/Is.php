<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class Is extends Expr
{
    public $cond;
    public $type;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $cond, Type $type, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->type = $type;
    }

    public function getSubNodeNames()
    {
        return array('cond', 'type');
    }
}
