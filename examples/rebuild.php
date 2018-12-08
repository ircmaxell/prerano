<?php

require __DIR__ . '/../vendor/autoload.php';


$it = new DirectoryIterator(__DIR__);

foreach ($it as $file) {
    if (!$file->isDir() || $file->isDot()) {
        continue;
    }
    $dir = $file->getPathname();
    
    echo "Building " . $dir . "\n";

    (new Prerano\Compiler(true))->compile($dir);
}

