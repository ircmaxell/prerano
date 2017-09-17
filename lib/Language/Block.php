<?php

namespace Prerano\Language;

use Prerano\CFG\Node;

interface Block
{
    const MODE_RO = 0b0001;
    const MODE_WO = 0b0010;
    const MODE_RW = 0b0011;

    public function getId(): int;

    public function addInboundBlock(Block $inbound);
    public function addOutboundBlock(string $when, Block $output);
    public function appendNode(Node ...$nodes);

    public function getPreviousBlocks(): array;
    public function getNodes(): array;
    public function getNextBlocks(): array;

    public function getNextBlock(string $name): Block;
    public function hasNextBlock(string $name): bool;

    public function write(Variable $variable, Variable $value = null): Variable;

    public function read(string $name): Variable;
}
