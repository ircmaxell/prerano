<?php

namespace Prerano\CFG\Node\Expr;

use Prerano\CFG\Node\Expr;
use Prerano\Language\Type;
use Prerano\Language\Variable;

class ExpressionCall extends Expr
{
    public $rootType;
    public $obj;
    public $name;
    public $args;
    public $result;
    public $signature;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Type $rootType, Variable $obj, string $name, array $args, Variable $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->rootType = $rootType;
        $this->obj = $obj;
        $this->name = $name;
        $this->result = $result;
        $this->setArgs(...$args);
    }

    public function getSubNodeNames(): array
    {
        return array('rootType', 'obj', 'name', 'args', 'result');
    }

    private function setArgs(Variable ...$args)
    {
        $this->args = $args;
    }
}
