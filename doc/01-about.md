# About Prerano

Prerano is an attempt at building a simplified programming language that's completely interoperable with PHP.

## The Concept

Prerano is "compiled" to native PHP and run by a normal PHP runtime. For these reasons it retains the basic advantages of PHP in that it's easy to deply, portable and simple to use.

Within the language however come several important differences from normal PHP. Prerano uses a compile step to ensure type safety. This means that Prerano code can use PHP code just like normal (with a few important limitations). And since Prerano generates PHP code, normal PHP code can use Prerano code just fine.
