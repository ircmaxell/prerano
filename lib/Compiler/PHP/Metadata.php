<?php
namespace Prerano\Compiler\PHP;

use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;
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
                    'flags' => PHP::modifier('final'),
                    'stmts' => a(
                        ...self::properties($package),
                        ...[self::init($package)],
                        ...[self::getHeadersFunction($package)]
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
                        PHP::not(PHP::staticPropFetch('self', 'instance')),
                        [PHP::assign(
                            PHP::staticPropFetch('self', 'instance'),
                            PHP::new('self')
                        )]
                    ),
                    PHP::return(PHP::staticPropFetch('self', 'instance')),
                ],
            ]
        );
    }

    protected static function getHeadersFunction(Package $package): PhpNode
    {
        return new PhpNode\Stmt\ClassMethod(
            'headers',
            [
                'flags' => PHP::modifier('public'),
                'stmts' => a(
                    PHP::if(
                        PHP::identical(PHP::null(), PHP::propFetch(PHP::var('this'), 'headers')),
                        a(
                            PHP::assign(
                                PHP::propFetch(PHP::var('this'), 'headers'),
                                PHP::funcCall('unserialize', PHP::funcCall('base64_decode', PHP::classConstFetch('self', 'HEADERS')))
                            )
                        )
                    ),
                    PHP::return(PHP::propFetch(PHP::var('this'), 'headers'))
                ),
            ]
        );
    }

    protected static function properties(Package $package): array
    {
        return a(
            PHP::classConst('HEADERS', self::functionHeaders($package)),
            new PhpNode\Stmt\Property(
                PHP::modifier('private static'),
                [
                    new PhpNode\Stmt\PropertyProperty('instance'),
                ]
            ),
            new PhpNode\Stmt\Property(
                PHP::modifier('private'),
                [
                    new PhpNode\Stmt\PropertyProperty('headers', PHP::null()),
                ]
            )
        );
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
