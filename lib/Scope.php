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

    public function lookup(string $name, string $fromName)
    {
        $parts = explode('::', $name);
        $identifier = array_pop($parts);
        $package = implode('::', $parts);

        if (!isset($this->packages[$package])) {
            return;
        }

        $flag = Language\Package::PUBLIC;
        if ($package === $fromName) {
            $flag = Language\Package::PRIVATE;
        } elseif (strpos($fromName, $package . '::') === 0) {
            $flag = Language\Package::PROTECTED;
        }

        for ($i = Language\Package::PUBLIC; $i <= $flag; $i++) {
            if (isset($this->packageMap[$package][$i][$identifier])) {
                return $this->packageMap[$package][$i][$identifier];
            }
        }
    }

    public function addSignatures(array $signatures)
    {
        var_dump($signatures);
        die();
    }
}
