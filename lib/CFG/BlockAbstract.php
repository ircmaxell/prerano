<?php

namespace Prerano\CFG;

abstract class BlockAbstract implements Block
{
    protected $inbound = [];
    protected $outbound = [];
    protected $nodes = [];
    private $id;
    private static $counter = 1;


    public function __construct()
    {
        $this->id = self::$counter++;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addInboundBlock(Block $inbound)
    {
        $this->inbound[] = $inbound;
    }


    public function addOutboundBlock(string $when, Block $output)
    {
        $this->outbound[$when] = $output;
        $output->addInboundBlock($this);
    }

    public function getNextBlocks(): array
    {
        return $this->outbound;
    }

    public function appendNode(Node ...$nodes)
    {
        foreach ($nodes as $node) {
            $this->nodes[] = $node;
        }
    }
    
    public function getPreviousBlocks(): array
    {
        return $this->inbound;
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function getInput(): array
    {
        return $this->input;
    }

    public function write(Variable $variable, Variable $value = null): Variable
    {
        $this->addVariable($variable);
        if ($value) {
            $this->connect($variable, $value);
        }
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
        if (!isset($this->names[$name])) {
            if (!isset($this->input[$name])) {
                $this->input[$name] = new Variable\Named($name, new Type(Type::UNKNOWN));
                $this->write($this->input[$name]);
            } else {
                throw new LogicException("Not possible, since write adds to names");
            }
            // Fall through here is fine, since write adds the variable to names
        }
        $this->connect($variable, $this->names[$name]);
        return $variable;
    }

    protected function connect(Variable $destination, Variable $source)
    {
        $destId = $destination->getId();
        if (!isset($this->edges[$destId])) {
            $this->edges[$destId] = [];
        }
        $this->edges[$destId][] = $source;
    }
}
