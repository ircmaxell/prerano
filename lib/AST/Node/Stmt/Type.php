<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Type extends Node\Stmt
{
    /** @var null|Node\Name Name */
    public $name;
    /** @var Node[] Statements */
    public $type;
    public $visibility = Package::PRIVATE;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Name $name, Node\Expr\Type $type, int $visibility = Node::PRIVATE, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->type = $type;
        $this->visibility = $visibility;
    }

    public function getSubNodeNames()
    {
        return array('name', 'type');
    }
}
