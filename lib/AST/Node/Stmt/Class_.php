<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Class_ extends Node\Stmt
{
    public $name;
    public $parents;
    public $body;
    public $visibility = Package::PRIVATE;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Name $name, array $parents, array $body, int $visibility = Node::PRIVATE, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->visibility = $visibility;
        $this->setBody(...$body);
        $this->setParents(...$parents);
    }

    public function getSubNodeNames()
    {
        return array('name', 'parents', 'body');
    }

    private function setParents(Node\Name ...$parents)
    {
        $this->parents = $parents;
    }

    private function setBody(Node ...$body)
    {
        $this->body = $body;
    }
}
