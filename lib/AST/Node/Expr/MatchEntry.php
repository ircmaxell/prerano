<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class MatchEntry extends Expr
{
    public $cond;
    public $stmts;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $cond = null, array $stmts, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->stmts = $this->addNodes(...$stmts);
    }

    public function getSubNodeNames()
    {
        return array('cond', 'stmts');
    }

    protected function addNodes(Node\Expr ...$items): array
    {
        return $items;
    }
}
