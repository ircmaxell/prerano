<?php

namespace Prerano\Compiler;

use Prerano\Language\Package;

interface Compiler
{
    public function compile(Package $package): string;
}
