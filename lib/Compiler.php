<?php

namespace Prerano;

class Compiler
{
    protected $parser;
    protected $generator;
    protected $compiler;
    protected $debug;
    protected $scope;
    protected $engine;

    public function __construct(bool $debug = false)
    {
        $this->debug = $debug;
        $this->parser = new Parser\Parser(new Parser\Lexer);
        $this->traverser = new AST\Traverser;
        $this->traverser->addVisitor(new AST\Visitor\AliasResolver);
        $this->traverser->addVisitor(new AST\Visitor\TypeQualifier);
        $this->generator = new CFG\Generator;
        $this->compiler = new Compiler\PHP;
        $this->scope = new Scope;
        $this->engine = new Inference\Engine($this->scope);
        $this->addPHPPackage();
    }

    public function compile(string $file)
    {
        if (is_file($file) && substr($file, -3) === '.pr') {
            $package = $this->compileFile($file);
            $target = str_replace('.pr', '.php', $file);
        } elseif (is_dir($file)) {
            // compile all files
            $packages = [];
            foreach (new \DirectoryIterator($file) as $sub) {
                if (!$sub->isFile() || $sub->getExtension() !== 'pr') {
                    continue;
                }
                $filename = $sub->getPathname();
                $package = $this->compileFile($filename);
                $this->debugAST($filename, $package);
                $this->traverser->traverse($package);
                $this->debugAST($filename . '.processed', $package);
                $packages[] = $package;
            }
            $target = $file . '/';
        } else {
            throw new \LogicException("Unknown compilation target $file");
        }

        $toCompile = [];
        foreach ($packages as $package) {
            $cfg = $this->generator->generatePackage($package);
            $toCompile[] = $cfg->name;
            $this->scope->addPackage($cfg);
        }
        $toCompile = array_unique($toCompile);

        foreach ($toCompile as $name) {
            $package = $this->scope->getPackage($name);
            $this->engine->process($package);
            $this->debugCFG($target . $name, $package);
            $php = $this->compiler->compile($package);
            file_put_contents($target . $name . '.php', $php);
        }
    }

    protected function addPHPPackage()
    {
        $dir = __DIR__ . '/php';
        $packages = [];
        foreach (new \DirectoryIterator($dir) as $sub) {
            if (!$sub->isFile() || $sub->getExtension() !== 'pr') {
                continue;
            }
            $filename = $sub->getPathname();
            $packages[] = $tmp = $this->compileFile($filename);
        }
        foreach ($packages as $package) {
            $cfg = $this->generator->generatePackage($package);
            $this->scope->addPackage($cfg);
        }
    }

    protected function compileFile(string $file): Ast\Node\Stmt\Package
    {
        return $this->parser->parse(file_get_contents($file), $file);
    }

    protected function debugAST(string $target, Ast\Node\Stmt\Package $package)
    {
        if (!$this->debug) {
            return;
        }
        file_put_contents("$target.ast", Debug\ASTDumper::dump($package));
    }

    protected function debugCFG(string $target, Language\Package $cfg)
    {
        if (!$this->debug) {
            return;
        }
        file_put_contents("$target.cfg", Debug\CFGDumper::dumpPackage($cfg));
        Debug\CFGGrapher::graphPackage($cfg, "$target.png", 'png');
    }
}
