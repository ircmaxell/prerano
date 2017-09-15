<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Enum extends Node\Stmt
{
    /** @var null|Node\Name Name */
    public $name;
    /** @var Node[] Statements */
    public $subTypes;
    public $visibility = Package::PRIVATE;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Name $name, array $subTypes, int $visibility = Node::PRIVATE, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->addSubTypes(...$subTypes);
        $this->visibility = $visibility;
    }

    public function getSubNodeNames()
    {
        return array('name', 'subTypes');
    }

    private function addSubTypes(Node\Stmt\Type ...$subTypes)
    {
        $this->subTypes = $subTypes;
    }
}
