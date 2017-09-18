<?php

namespace Prerano\Inference\Rule;

use Prerano\Inference\RuleAbstract;
use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;
use Prerano\Scope;

class FunctionCallResolver extends RuleAbstract
{
    protected $packageName = '';

    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
    }

    public function beforePackage(Package $package): int
    {
        $this->packageName = $package->name;
        return self::NORMAL;
    }

    public function processBlock(Block $block): int
    {
        foreach ($block->getNodes() as $node) {
            if ($node->getName() !== 'Expr_FuncCall') {
                continue;
            }
            if ($node->signature) {
                continue;
            }
            if ($node->name instanceof Variable\IdentifierReference) {
                $type = $this->resolveType($node->name->value);
                if (!$type) {
                    if (substr($node->name->value, 0, 5) === 'php::') {
                        // Do something to handle this
                    }
                    throw new \RuntimeException("Unknown function call: {$node->name->value}");
                } else {
                    $node->signature = $type;
                    $node->result->setDeclaredType(array_slice($type->subTypes, -1)[0]);
                    return self::RERUN;
                }
            } else {
                throw new \LogicException("Not implemented: support for " . get_class($node->name));
            }
        }

        return self::NORMAL;
    }

    protected function resolveType(string $name)
    {
        if (strpos($name, '::') !== false) {
            return $this->scope->lookup($name, $this->packageName);
        }
        return $this->scope->lookup($this->packageName . '::' . $name, $this->packageName);
    }
}
