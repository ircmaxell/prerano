<?php

namespace Prerano\Inference\Rule;

use Prerano\CFG\Node\Expr\ExpressionCall;
use Prerano\Inference\RuleAbstract;
use Prerano\Language\Block;
use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Language\Type;
use Prerano\Language\Variable;
use Prerano\Scope;

class ExpressionFunctionResolver extends RuleAbstract
{
    protected $packageName = '';
    protected $package;

    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
    }

    public function beforePackage(Package $package): int
    {
        $this->packageName = $package->name;
        $this->package = $package;
        return self::NORMAL;
    }

    public function processBlock(Block $block): int
    {
        $result = self::NORMAL;
        foreach ($block->getNodes() as $node) {
            if ($node->getName() !== 'Expr_MethodCall') {
                continue;
            }
            if ($node->signature) {
                continue;
            }
            // Attempt to look up method call
            $type = $node->obj->getInferredType();
            $name = $node->name;
            $rootOn = $this->package->lookupExpressionFunction($type, $name);
            if ($rootOn) {
                $block->replaceNodeWith($node, new ExpressionCall($rootOn, $node->obj, $node->name, $node->args, $node->result, $node->getAttributes()));
                $result |= self::RERUN;
            }
        }

        return $result;
    }

    protected function resolveType(string $name)
    {
        if (strpos($name, '::') !== false) {
            return $this->scope->lookup($name, $this->packageName);
        }
        return $this->scope->lookup($this->packageName . '::' . $name, $this->packageName);
    }
}
