<?php

namespace Prerano;

class Compiler
{
    protected $parser;
    protected $generator;
    protected $compiler;
    protected $debug;

    public function __construct(bool $debug = false)
    {
        $this->debug = $debug;
        $this->parser = new Parser\Parser(new Parser\Lexer);
        $this->generator = new CFG\Generator;
        $this->compiler = new Compiler\PHP;
    }

    public function compile(string $file)
    {
        if (is_file($file) && substr($file, -3) === '.pr') {
            $package = $this->compileFile($file);
            $target = str_replace('.pr', '.php', $file);
        } elseif (is_dir($file)) {
            // compile all files
            $package = null;
            foreach (new \DirectoryIterator($file) as $sub) {
                if (!$sub->isFile() || $sub->getExtension() !== 'pr') {
                    continue;
                }
                $subPackage = $this->compileFile($sub->getPathname());
                if ($package) {
                    $package = $package->merge($subPackage);
                } else {
                    $package = $subPackage;
                }
            }
            if (!$package) {
                throw new \LogicException("No .pr files found in $file");
            }
            $target = $file . '/__PRERANO_CODE__.php';
        } else {
            throw new \LogicException("Unknown compilation target $file");
        }
        $cfg = $this->generator->generatePackage($package);
        $php = $this->compiler->compile($cfg);
        file_put_contents($target, $php);

        $this->debug($target, $package, $cfg);
    }

    protected function compileFile(string $file): Ast\Node\Stmt\Package
    {
        return $this->parser->parse(file_get_contents($file), $file);
    }

    protected function debug(string $target, Ast\Node\Stmt\Package $package, Language\Package $cfg)
    {
        if (!$this->debug) {
            return;
        }
        file_put_contents("$target.ast", Debug\ASTDumper::dump($package));
        file_put_contents("$target.cfg", Debug\CFGDumper::dumpPackage($cfg));
        Debug\CFGGrapher::graphPackage($cfg, "$target.png", 'png');
    }
}
