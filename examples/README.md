# Examples

Each folder contains one or more `*.pr` files which contain Prerano code.

It also contains several other files which are results of various stages of the compilation process.

## out.ast

This contains the first step of compilation: an abstract syntax tree. Nothing has been modified yet nor any types resolved.

## out.cfg

This contains the primitive CFG (Control Flow Graph). At this point, types are resolved, yet not inferred yet.

This means that if the result of an expression from declared types is known, then the expression's result will have a type. 

Example:

    int + int -> int
    int + string -> error
    int + unknown -> unknown

Additionally, at this point temporary variables are resolved. This means that you'll start to see weird variables like `$1`. These are internal variables that are implied by the structure of the AST.

## out.png

This contains a graphical representation of the CFG (Control Flow Graph). This contains the same information as `out.cfg` but in a graphical form

## out.php

This contains the compiled "PHP" from the original code. 

There are two primary classes in the file:

 * `__PRERANO_METADATA__` - contains methods to access exported types and function bodies (serailized). This is used internally by the compiler to link compiled packages together.
 * `__PRERANO_CODE__` - contains compiled functions. Also, `__main__` if it exists is compiled into the constructor of this class (implementation detail).

Further, any "public" code (value types, functions, etc) are exported into this file as well. It's worth noting that these "public" exports are merely proxies into the internal compiled result. This is to support type assertions and boxing required for interacting safely with compiled code.