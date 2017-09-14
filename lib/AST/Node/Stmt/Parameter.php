<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Parameter extends Node\Stmt
{
    /** @var null|Node\Name Name */
    public $name;
    /** @var Node[] Statements */
    public $type;
    public $default;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(string $name, Node\Expr\Type $type, Node\Expr $default = null, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->type = $type;
        $this->default = $default;
    }

    public function getSubNodeNames()
    {
        return array('name', 'type', 'default');
    }

    
}
