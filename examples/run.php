<?php

require __DIR__ . '/../vendor/autoload.php';

$dir = __DIR__ . '/' . ($_SERVER['argv'][1] ?? '00-basic-usage');
if (!is_dir($dir)) {
    die("Could not find directory $dir");
}


$code = file_get_contents($dir . '/code.pr');


$start = microtime(true);

$parser = new Prerano\Parser\Parser(new Prerano\Parser\Lexer);
$ast = $parser->parse($code);
$generator = new Prerano\CFG\Generator;
$package = $generator->generatePackage($ast);
$compiler = new Prerano\Compiler\PHP;
$php = $compiler->compile($package);

$end = microtime(true);

file_put_contents($dir . '/out.cfg', Prerano\Debug\CFGDumper::dumpPackage($package));
file_put_contents($dir . '/out.ast', Prerano\Debug\ASTDumper::dump($ast));
file_put_contents($dir . '/out.php', $php);

echo "\n\nBuild completed in " . ($end - $start) . " seconds\n\n";
