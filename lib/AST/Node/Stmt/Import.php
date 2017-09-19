<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Import extends Node\Stmt
{
    public $name;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
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
