<?php

namespace Prerano;

class Scope
{
    protected $packageMap = [];
    protected $packages = [];

    public function addPackage(Language\Package $package)
    {
        $packageName = $package->name;
        if (isset($this->packages[$packageName])) {
            $this->packages[$packageName] = $this->packages[$packageName]->mergeWith($package);
        } else {
            $this->packages[$packageName] = $package;
        }
        foreach ($this->packages[$packageName]->types as $visibility => $types) {
            $this->packageMap[$packageName][$visibility] = [];
            foreach ($types as $name => $type) {
                $this->packageMap[$packageName][$visibility][$name] = $type;
            }
        }
    }

    public function getPackage(string $name): Language\Package
    {
        if (!isset($this->packages[$name])) {
            throw new \RuntimeException("Could not find package $name");
        }
        return $this->packages[$name];
    }
}
