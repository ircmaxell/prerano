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

class Metadata 
{
    public static function compile(Package $package): array
    {
        $className = '__PRERANO_METADATA__';
        return a(
            new PhpNode\Stmt\Class_(
                $className,
                [
                    'stmts' => a(
                        ...self::properties($package),
                        ...[self::init($package)],
                        ...[self::headers($package)]
                    ),
                ]
            )
        );
    }

    protected static function init(Package $package): PhpNode
    {
        return new PhpNode\Stmt\ClassMethod(
            'init',
            [
                'flags' => PHP::modifier('public static'),
                'stmts' => [
                    PHP::if(
                        PHP::staticPropFetch('self', 'instance'),
                        [PHP::return(PHP::staticPropFetch('self', 'instance'))]
                    ),
                    PHP::assign(
                        PHP::staticPropFetch('self', 'instance'),
                        PHP::new('self')
                    ),
                ],
            ]
        );
    }

    protected static function headers(Package $package): PhpNode
    {
        return new PhpNode\Stmt\ClassMethod(
            'headers',
            [
                'flags' => PHP::modifier('public'),
                'stmts' => a(
                    PHP::if(PHP::empty(PHP::propFetch(PHP::var('this'), 'headers')), a(
                        PHP::assign(
                            PHP::propFetch(PHP::var('this'), 'headers'),
                            PHP::funcCall('unserialize', PHP::funcCall('base64_decode', PHP::staticPropFetch('self', 'headerDefinitions')))
                        )
                    )),
                    PHP::return(PHP::propFetch(PHP::var('this'), 'headers'))
                ),
            ]
        );
    }

    protected static function properties(Package $package): array
    {
        return a(
            new PhpNode\Stmt\Property(
                PHP::modifier('protected static'),
                [
                    new PhpNode\Stmt\PropertyProperty('instance'),
                    new PhpNode\Stmt\PropertyProperty('headerDefinitions', self::functionHeaders($package)),
                    new PhpNode\Stmt\PropertyProperty('functionDefinitions', self::functions($package)),
                ]
            ),
            new PhpNode\Stmt\Property(
                PHP::modifier('protected'),
                [
                    new PhpNode\Stmt\PropertyProperty('headers', PHP::array([])),
                    new PhpNode\Stmt\PropertyProperty('functions', PHP::array([])),
                ]
            )
        );
    }

    protected static function functions(Package $package): PhpNode
    {
        $result = [];
        foreach (Package::VISIBILITY_MAP as $visibility => $visibilityName) {
            $result[$visibilityName] = [];
            foreach ($package->functions[$visibility] as $name => $fn) {
                $result[$visibilityName][$name] = $fn;
            }
        }
        return PHP::string(base64_encode(serialize($result)));
    }

    protected static function functionHeaders(Package $package): PhpNode
    {
        $result = [];
        foreach (Package::VISIBILITY_MAP as $visibility => $visibilityName) {
            $result[$visibilityName] = [];
            foreach ($package->functions[$visibility] as $name => $fn) {
                $result[$visibilityName][$name] = $fn->getSignature();
            }
        }
        return PHP::string(base64_encode(serialize($result)));
    }
}