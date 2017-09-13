<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;

class Package extends Node\Stmt
{
    /** @var null|Node\Name Name */
    public $name;
    /** @var Node[] Statements */
    public $stmts;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Name $name = null, $stmts = array(), array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->stmts = $stmts;
    }

    public function getSubNodeNames()
    {
        return array('name', 'stmts');
    }

    public function merge(Package $other): Package
    {
        if ($this->name->toString() !== $other->name->toString()) {
            throw new \RuntimneException("Attempting to merge different packages");
        }
        return new self($this->name, array_merge($this->stmts, $other->stmts), $this->attributes);
    }
}
