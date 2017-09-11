<?php

namespace Prerano\CFG;

interface Block
{
    public function getId(): int;

    public function addInboundBlock(Block $inbound);
    public function addOutboundBlock(string $when, Block $output);
    public function appendNode(Node ...$nodes);

    public function getPreviousBlocks(): array;
    public function getNodes(): array;
    public function getNextBlocks(): array;

    public function getScope(): Scope;
}
