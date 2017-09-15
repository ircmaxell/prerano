# About Prerano

Prerano is an attempt at building a simplified programming language that's completely interoperable with PHP.

## The Concept

Prerano is "compiled" to native PHP and run by a normal PHP runtime. For these reasons it retains the basic advantages of PHP in that it's easy to depoly, portable and simple to use.

Within the language however come several important differences from normal PHP. Prerano uses a compile step to ensure type safety. This means that Prerano code can use PHP code just like normal (with a few important limitations). And since Prerano generates PHP code, normal PHP code can use Prerano code just fine.

## Compilation Strategies

There are three main modes of compiling:

 * Debug
 * Test
 * Production

Debug compiles on-demand inside of a request, just like normal PHP. It uses `eval()` to turn the compiled code into PHP code.

Test and Production generate files in the filesystem along side of the Prerano packages. This allows "building" inside of a folder and simply 'committing' the result. This allows library authors to write Prerano, but ship both Prerano and compiled PHP which has no dependencies on Prerano.

The prime difference between Test and Production is the amount of "checks" generated in the compiled code. Test will include a multitude of assertions, as well as *potentially* generated unit tests.

## Interaction with PHP

A custom autoloader will be built for Prerano code. Instead of trying to load the class itself, it will look at folders. If the folder exists, and has a `__PRERANO__.php` file, it will load the file and return. Otherwise, it will attempt to compile the folder and generate the appropriate code.

TODO: A lot...