<?php

namespace Prerano\Inference;

use Prerano\Language\Function_;
use Prerano\Language\Package;
use Prerano\Scope;

class Engine
{
    protected $rules = [];
    protected $scope;

    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
        $this->addRule(
            new Rule\TypeResolver($scope),
            new Rule\TypeReconstruction,
            new Rule\FunctionCallResolver($scope),
            new Rule\ExpressionFunctionResolver($scope)
        );
    }

    public function addRule(Rule ...$rule)
    {
        $this->rules = array_merge($this->rules, $rule);
    }

    public function process(Package $package)
    {
        $this->fire('beforePackage', $package);

        foreach ($package->functions as $functionList) {
            foreach ($functionList as $name => $function) {
                $this->fire('beforeFunction', $name, $function);
                $this->walkBlocks($function);
                $this->fire('afterFunction', $name, $function);
            }
        }

        $this->fire('afterPackage', $package);
    }

    protected function fire(string $cmd, ...$args): int
    {
        $return = 0;
        foreach ($this->rules as $rule) {
            $return |= $rule->$cmd(...$args);
        }
        return $return;
    }

    protected function walkBlocks(Function_ $function)
    {
        start:
        do {
            $seen = [];
            $toSee = [$function->body];
            $result = 0;
            while (!empty($toSee)) {
                $block = array_shift($toSee);
                if (isset($seen[$block->getId()])) {
                    continue;
                }
                $seen[$block->getId()] = true;
                $result |= $this->fire('processBlock', $block);
                if ($result & Rule::SKIP_CHILDREN) {
                    // Clear flag
                    $result &= ~Rule::SKIP_CHILDREN;
                } else {
                    $toSee = array_merge($toSee, $block->getNextBlocks());
                }
            }
        } while ($result & Rule::RERUN);
    }
}
