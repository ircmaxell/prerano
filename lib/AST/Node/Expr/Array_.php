<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class Array_ extends Expr
{
    public $items;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(array $items, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->addItems(...$items);
    }

    public function getSubNodeNames()
    {
        return array('items');
    }

    protected function addItems(Expr ...$items)
    {
        $this->items = $items;
    }
}
