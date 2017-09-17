<?php

require __DIR__ . '/../vendor/autoload.php';

$dir = __DIR__ . '/' . ($_SERVER['argv'][1] ?? '00-basic-usage');
if (!is_dir($dir)) {
    die("Could not find directory $dir");
}

$compiler = new Prerano\Compiler(true);

$it = new DirectoryIterator(__DIR__);

foreach ($it as $file) {
    if (!$file->isDir() || $file->isDot()) {
        continue;
    }
    $dir = $file->getPathname();
    
    echo "Building " . $dir . "\n";

    $compiler->compile($dir);
}

