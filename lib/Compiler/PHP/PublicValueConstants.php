<?php
namespace Prerano\Compiler\PHP;

use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;
use function Prerano\Compiler\a;

use PhpParser\Node as PhpNode;

class PublicValueConstants
{
    public static function compile(Package $package): array
    {
        $result = [];
        foreach ($package->types[Package::PUBLIC] as $name => $type) {
            if ($type->value !== null) {
                $result[] = PHP::const($name, PHP::scalar($type->value));
            }
        }
        return $result;
    }
}
