<?php

namespace Prerano\Inference;

use Prerano\Language\Block;
use Prerano\Language\Function_;

use Prerano\Language\Package;

class RuleAbstract implements Rule
{
    public function beforePackage(Package $package): int
    {
        return self::NORMAL;
    }

    public function beforeFunction(string $name, Function_ $function): int
    {
        return self::NORMAL;
    }
    
    public function processBlock(Block $block): int
    {
        return self::NORMAL;
    }
    
    public function afterFunction(string $name, Function_ $function): int
    {
        return self::NORMAL;
    }
    
    public function afterPackage(Package $package): int
    {
        return self::NORMAL;
    }
}
