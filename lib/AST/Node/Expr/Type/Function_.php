<?php

namespace Prerano\AST\Node\Expr\Type;

use Prerano\AST\Node\Expr\Type;

class Function_ extends Type
{
    public $parameters;
    public $result;

    /**
     * Constructs an assignment node.
     *
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(array $parameters, Type $result, array $attributes = array())
    {
        parent::__construct($attributes);
        $this->addParameters(...$parameters);
        $this->result = $result;
    }

    public function getSubNodeNames()
    {
        return array('parameters', 'result');
    }

    protected function addParameters(Type ...$parameters)
    {
        $this->parameters = $parameters;
    }
}
