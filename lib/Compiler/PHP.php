<?php

namespace Prerano\Compiler;

use Prerano\Language\{
    Block,
    Function_,
    Package,
    Type,
    Variable
};

use PhpParser\Node as PhpNode;
use PhpParser\PrettyPrinterAbstract;
use PhpParser\PrettyPrinter\Standard;

class PHP
{

    public function __construct(PrettyPrinterAbstract $printer = null)
    {
        $this->printer = $printer ?: new Standard;
    }

    public function compile(Package $package): string
    {
        $result = a(
            ...$this->compileMetadata($package),
            ...[]
        );

        return '<?php ' . $this->printer->prettyPrint($result);
    }

    protected function compileMetadata(Package $package): array
    {
        return a(
            new PhpNode\Stmt\Namespace_(new PhpNode\Name(str_replace('::', '\\', $package->name))),
            ...PHP\Metadata::compile($package),
            ...PHP\Code::compile($package),
            ...PHP\PublicFunctions::compile($package),
            ...PHP\PublicValueConstants::compile($package),
            ...[]
        );
    }

}

function a(...$any): array
{
    return $any;
}