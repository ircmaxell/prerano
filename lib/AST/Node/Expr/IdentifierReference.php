<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class IdentifierReference extends Expr
{
    public $name;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Name $name, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
    }

    public function getSubNodeNames()
    {
        return array('name');
    }
}
