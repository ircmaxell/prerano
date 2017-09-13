<?php

namespace Prerano\AST\Node\Expr\Type;

use Prerano\AST\Node\Expr\Type;

class Union extends Type
{
    public $left;
    public $right;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Type $left, Type $right, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->left = $left;
        $this->right = $right;
    }

    public function getSubNodeNames()
    {
        return array('left', 'right');
    }
}
