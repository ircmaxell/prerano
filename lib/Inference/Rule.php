<?php

namespace Prerano\Inference;

use Prerano\Language\Block;
use Prerano\Language\Function_;

use Prerano\Language\Package;

interface Rule
{
    const NORMAL        = 0b000001;
    const SKIP_CHILDREN = 0b000010;
    const RERUN         = 0b000100;

    public function beforePackage(Package $package): int;
    public function beforeFunction(string $name, Function_ $function): int;
    public function processBlock(Block $block): int;
    public function afterFunction(string $name, Function_ $function): int;
    public function afterPackage(Package $package): int;
}
