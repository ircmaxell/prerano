<?php

require __DIR__ . '/../vendor/autoload.php';

$dir = __DIR__ . '/' . ($_SERVER['argv'][1] ?? '00-basic-usage');
if (!is_dir($dir)) {
    die("Could not find directory $dir");
}

$parser = new Prerano\Parser\Parser(new Prerano\Parser\Lexer);
$generator = new Prerano\CFG\Generator;
$compiler = new Prerano\Compiler\PHP;

$it = new DirectoryIterator(__DIR__);

foreach ($it as $file) {
    if (!$file->isDir() || $file->isDot()) {
        continue;
    }
    $dir = $file->getPathname();
    $code = file_get_contents($dir . '/code.pr');

    $start = microtime(true);

    $ast = $parser->parse($code);
    $package = $generator->generatePackage($ast);
    $php = $compiler->compile($package);

    $end = microtime(true);

    file_put_contents($dir . '/out.cfg', Prerano\Debug\CFGDumper::dumpPackage($package));
    file_put_contents($dir . '/out.ast', Prerano\Debug\ASTDumper::dump($ast));
    file_put_contents($dir . '/out.php', $php);
    Prerano\Debug\CFGGrapher::graphPackage($package, $dir . '/out.png', 'png');

    echo "\n\nBuild for " . $file->getBasename() . " completed in " . ($end - $start) . " seconds\n\n";
}

