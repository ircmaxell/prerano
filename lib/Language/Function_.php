<?php

namespace Prerano\Language;

class Function_
{
    private $parameters = [];
    private $returnType;
    private $body;
    private $result;

    public function __construct(array $parameters, Type $returnType, Block $body, Variable $result)
    {
        $this->setParameters(...$parameters);
        $this->returnType = $returnType;
        $this->body = $body;
        $this->result = $result;
    }

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function setResult(Variable $result)
    {
        $this->result = $result;
    }

    public function getSignature(): Type
    {
        return new Type(
            Type::CALLABLE,
            null,
            ...array_map(function (Variable\Parameter $param) {
                return $param->getDeclaredType();
            }, $this->parameters),
            ...[$this->returnType]
        );
    }

    private function setParameters(Variable\Parameter ...$parameters)
    {
        $this->parameters = $parameters;
    }
}
