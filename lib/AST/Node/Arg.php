<?php

namespace Prerano\AST\Node;

use Prerano\AST\Node;
use Prerano\AST\NodeAbstract;

class Arg extends NodeAbstract
{
    public $value;
    public $name;

    /**
     * Constructs a name node.
     *
     * @param string|array|self $name       Name as string, part array or Name instance (copy ctor)
     * @param array             $attributes Additional attributes
     */
    public function __construct(Node\Expr $value, string $name = null, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->value = $value;
        $this->name = $name;
    }

    /**
     * Gets the names of the sub nodes.
     *
     * @return array Names of sub nodes
     */
    public function getSubNodeNames()
    {
        return ['value', 'name'];
    }
}
