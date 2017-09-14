<?php

namespace Prerano\AST\Node\Expr\Type;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr\Type;

class Value extends Type
{
    public $value;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $value = null, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->value = $value;
    }

    public function getSubNodeNames()
    {
        return array('value');
    }
}
