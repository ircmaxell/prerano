<?php

namespace Prerano\CFG;

class Scope
{
    const MODE_RO = 0b0001;
    const MODE_WO = 0b0010;
    const MODE_RW = 0b0011;

    protected $variables = [];
    protected $edges = [];
    protected $names = [];
    protected $input = [];

    public function getInput(): array
    {
        return $this->input;
    }

    public function write(Variable $variable): Variable
    {
        $this->addVariable($variable);
        if (!$variable instanceof Variable\Named) {
            return $variable;
        }
        $this->names[$variable->name] = $variable;
        return $variable;
    }

    public function read(string $name): Variable
    {
        $variable = new Variable\Named($name);
        $this->addVariable($variable);
        if (isset($this->names[$name])) {
            $this->connect($variable, $this->names[$name]);
        } else {
            if (!isset($this->input[$name])) {
                $this->input[$name] = new Variable\Temp;
            }
            $this->connect($variable, $this->input[$name]);
        }
        return $variable;
    }

    public function namedVariable(string $name, int $mode): Variable
    {
        switch ($mode) {
            case self::MODE_RO:
                return $this->read($name);
            case self::MODE_WO:
                return $this->write(new Variable\Named($name));
            default:
                throw new \LogicException("No support for read/write variables yet");
        }
    }

    public function connect(Variable $destination, Variable $source)
    {
        $destId = $destination->getId();
        if (!isset($this->edges[$destId])) {
            $this->edges[$destId] = [];
        }
        $this->edges[$destId][] = $source;
    }

    public function resolveTypes()
    {
        do {
            $changed = false;
            foreach ($this->variables as $variable) {
                $id = $variable->getId();
                if (empty($this->edges[$id])) {
                    continue;
                }
                $type = $variable->getType();
                $edges = $this->edges[$id];
                if (count($edges) === 1) {
                    $edgeType = $edges[0]->getType();
                    if (!$edgeType->equals($type)) {
                        $type->set($edgeType);
                        $changed = true;
                    }
                } else {
                    throw new \LogicException("Not implemented yet multiple inbound edges");
                }
            }
        } while ($changed);
    }

    protected function addVariable(Variable $variable): self
    {
        $this->variables[$variable->getId()] = $variable;
        return $this;
    }
}
