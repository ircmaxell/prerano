<?php

namespace Prerano\AST\Node\Expr\Type;

use Prerano\AST\Node\Expr\Type;

class Pointer extends Type
{
    public $type;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Type $type, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->type = $type;
    }

    public function getSubNodeNames()
    {
        return array('type');
    }
}
