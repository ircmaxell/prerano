<?php

namespace Prerano\AST\Node\Expr;

use Prerano\AST\Node;
use Prerano\AST\Node\Expr;

class Match extends Expr
{
    public $entries;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Node\Expr $cond, array $entries, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->entries = $this->addEntries(...$entries);
    }

    public function getSubNodeNames()
    {
        return array('cond', 'entries');
    }

    protected function addEntries(Node\Stmt\Match ...$match): array
    {
        return $match;
    }
}
