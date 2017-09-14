<?php
namespace Prerano\Compiler\PHP;

use Prerano\Language\{
    Block,
    Function_,
    Package,
    Type,
    Variable
};
use function Prerano\Compiler\a;

use PhpParser\Node as PhpNode;

class PublicFunctions 
{
    public static function compile(Package $package): array
    {
        $result = [];
        foreach ($package->functions[Package::PUBLIC] as $name => $func) {
            $params = [];
            foreach ($func->parameters as $name => $parameter) {
                $params[] = self::param($name, $parameter);
            }
            $stmts = a(
                ...self::guards($func),
                ...[PHP::assign(PHP::var('__result__'), PHP::instanceCall(Scope::resolvePackage($package), Scope::resolveLocal($package, $name), ...self::params($func)))],
                ...self::postConditions($func)
            );
            
            $result[] = new PhpNode\Stmt\Function_(
                PHP::name($name),
                [
                    'stmts' => $stmts,
                    'params' => $params,
                    'returnType' => PHP::nativeType($func->returnType),
                ]
            );
        }
        return $result;
    }

    protected static function guards(Function_ $function): array
    {
        // Not Implemented Yet
        return [];
    }

    protected static function postConditions(Function_ $function): array
    {
        // Not Implemented Yet
        return [
            // Implement a bunch of checks/value maps


            PHP::return(PHP::var('__result__')),
        ];
    }

    protected static function params(Function_ $function): array
    {
        // Not Implemented Yet
        return [
            
        ];
    }


}