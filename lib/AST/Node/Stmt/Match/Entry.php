<?php

namespace Prerano\AST\Node\Stmt\Match;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Entry extends Node\Stmt\Match
{
    /** @var null|Node\Name Name */
    public $cond;
    /** @var Node[] Statements */
    public $stmts;
    public $visibility = Package::PRIVATE;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(array $cond, array $stmts, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->cond = $this->addSubNodes(...$cond);
        $this->stmts = $this->addSubNodes(...$stmts);
    }

    public function getSubNodeNames()
    {
        return array('cond', 'stmts');
    }

    private function addSubNodes(Node\Expr ...$subNodes): array
    {
        return $subNodes;
    }
}
