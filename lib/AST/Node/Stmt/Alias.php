<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Alias extends Node\Stmt
{
    /** @var null|Node\Name Name */
    public $name;
    /** @var Node[] Statements */
    public $as;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Name $name, Node\Name $as, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->as = $as;
    }

    public function getSubNodeNames()
    {
        return array('name', 'as');
    }
}
