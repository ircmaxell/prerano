<?php

require __DIR__ . '/vendor/autoload.php';

$code = '
namespace Foo;

$bar = 1;
$foo = $bar;

$a = if $bar {
    $b = 1;
    2;
} else {
    $b = 2;
    3;
};

$b = 2;
';



$parser = new Prerano\Parser\Parser(new Prerano\Parser\Lexer);

$code = '
package Foo\Bar;

type foo = string|int;
type fooptr = foo*;
type bar = union<string,int>;

';

$ast = $parser->parse($code);
Prerano\Debug\ASTDumper::dump($ast);

$generator = new Prerano\CFG\Generator;
$package = $generator->generatePackage($ast);
Prerano\Debug\CFGDumper::dumpPackage($package);

die();

$ast = $parser->parse($code);
Prerano\Debug\ASTDumper::dump($ast);

$block = new Prerano\CFG\Block\Simple;
$generator->generate($ast, $block);
echo "\n\n";

Prerano\Debug\CFGDumper::dump([$block]);

$compiler = new Prerano\Compiler\Compiler;

var_dump($compiler->compile([$block]));