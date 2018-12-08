<?php

namespace Prerano\Inference\Rule;

use Prerano\Inference\RuleAbstract;
use Prerano\Language\Block;
use Prerano\Language\Variable;
use Prerano\Language\Package;
use Prerano\Language\Function_;

use Prerano\Scope;
use Prerano\Language\Type;

class TypeResolver extends RuleAbstract
{

    protected $package;

    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
    }

    public function beforePackage(Package $package): int
    {
        $this->package = $package;
        return self::NORMAL;
    }

    public function beforeFunction(string $name, Function_ $function): int
    {
        $return = self::NORMAL;
        $return |= $this->resolveVariables($function->parameters);
        $return |= $this->resolveVariables([$function->result]);

        return $return;
    }


    public function processBlock(Block $block): int
    {
        $vars = $block->getVariables();
        return self::resolveVariables($vars);
    }

    protected function resolveVariables(array $vars): int
    {
        $return = self::NORMAL;
        foreach ($vars as $var) {
            $origType = $var->getInferredType();
            $type = $this->resolveType($origType);
            if ($type !== $origType) {
                $var->setInferredType($type);
                $return |= self::RERUN;
            }
        }
        return $return;
    }

    protected function resolveType(Type $type): Type
    {
        if ($type->type === Type::TYPE_REFERENCE) {
            return $this->scope->lookup($type->value, $this->package->name);
        }
        return $type;
    }

}
