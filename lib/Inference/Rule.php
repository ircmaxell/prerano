<?php

namespace Prerano\Inference;

use Prerano\Language\Block;
use Prerano\Language\Function_;

use Prerano\Language\Package;

interface Rule
{
    public function beforePackage(Package $package);
    public function beforeFunction(Function_ $function);
    public function processBlock(Block $block);
    public function afterFunction(Function_ $function);
    public function afterPackage(Package $package);
}
