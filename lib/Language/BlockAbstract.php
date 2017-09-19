<?php

namespace Prerano\Language;

use Prerano\CFG\Node;

abstract class BlockAbstract implements Block
{
    protected $variables = [];
    protected $names = [];
    protected $input = [];
    protected $edges = [];
    
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

    public function getNextBlock(string $name): Block
    {
        if (!isset($this->outbound[$name])) {
            throw new \InvalidArgumentException("Unknown next block $name");
        }
        return $this->outbound[$name];
    }


    public function hasNextBlock(string $name): bool
    {
        return isset($this->outbound[$name]);
    }

    public function replaceNodeWith(Node $old, Node $new)
    {
        $key = array_search($old, $this->nodes, true);
        if ($key !== false) {
            $this->nodes[$key] = $new;
        } else {
            throw new \RuntimeException('Could not find node to replace');
        }
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

    public function namedVariable(string $name, int $mode): Variable
    {
        switch ($mode) {
            case Block::MODE_RO:
                return $this->read($name);
            case Block::MODE_WO:
                return $this->write(new Variable\Named($name, new Type(Type::UNKNOWN)));
            default:
                throw new \LogicException("Unsupported mode: $mode");
        }
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
        if (isset($this->variables[$name])) {
            return $this->variables[$name];
        }
        $variable = new Variable\Named($name, new Type(Type::UNKNOWN));
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
        } elseif ($this->edges[$destId][0]->getId() !== $source->getId() && !$destination instanceof Variable\Phi) {
            throw new \LogicException("Non-Phi variable with multiple edges");
        }
        $this->edges[$destId][] = $source;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function getEdges(): array
    {
        return $this->edges;
    }

    protected function addVariable(Variable $variable)
    {
        $this->variables[$variable->getId()] = $variable;
    }
}
