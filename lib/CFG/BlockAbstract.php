<?php

namespace Prerano\CFG;

abstract class BlockAbstract implements Block
{
    protected $inbound = [];
    protected $outbound = [];
    protected $nodes = [];
    protected $scope;
    protected $id;
    protected static $counter = 1;


    public function __construct(Scope $scope = null)
    {
        $this->scope = $scope ?: new Scope;
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

    public function getScope(): Scope
    {
        return $this->scope;
    }
}
