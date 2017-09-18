<?php

namespace Prerano\AST\Node\Stmt;

use Prerano\AST\Node;
use Prerano\Language\Package;

class ExprFunction extends Function_
{
    /** @var null|Node\Name Name */
    public $on;

    /**
     * Constructs a namespace node.
     *
     * @param null|Node\Name $name       Name
     * @param null|Node[]    $stmts      Statements
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Expr\Type $on, Node\Name $name, array $parameters, Node\Expr\Type $returnType, array $body, int $visibility = Node::PRIVATE, array $attributes = array())
    {
        parent::__construct($name, $parameters, $returnType, $body, $visibility, $attributes);
        $this->on = $on;
    }

    public function getSubNodeNames()
    {
        return array('on', 'name', 'returnType', 'parameters', 'body');
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
