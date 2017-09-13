<?php

namespace Prerano\AST\Node\Expr\Type;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr\Type;

class Specification extends Type
{
    public $root;
    public $subTypes;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Type $root, array $subTypes, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->root = $root;
        $this->addSubTypes(...$subTypes);
    }

    public function getSubNodeNames()
    {
        return array('root', 'subTypes');
    }

    private function addSubTypes(Type ...$subTypes)
    {
        $this->subTypes = $subTypes;
    }
}
