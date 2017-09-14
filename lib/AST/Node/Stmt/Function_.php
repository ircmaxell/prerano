<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class Function_ extends Node\Stmt
{
    /** @var null|Node\Name Name */
    public $name;
    /** @var Node[] Statements */
    public $returnType;
    public $body;
    public $parameters;
    public $visibility = Package::PRIVATE;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Name $name, array $parameters, Node\Expr\Type $returnType, array $body, int $visibility = Node::PRIVATE, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->returnType = $returnType;
        $this->visibility = $visibility;
        $this->setParameters(...$parameters);
        $this->setBody(...$body);
    }

    public function getSubNodeNames()
    {
        return array('name', 'returnType', 'parameters', 'body');
    }

    private function setParameters(Parameter ...$parameters)
    {
        $this->parameters = $parameters;
    }

    private function setBody(Node ...$body)
    {
        $this->body = $body;
    }
}
