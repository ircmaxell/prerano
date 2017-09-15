# Language Design

Prerano is a strongly typed language. This means that every variable has a computed type (even if that computed type is a union of other types, for example a `string` or an `integer`). If you call a normal PHP function, the return type will default to `mixed` *unless* the PHP function includes a return type declaration.

## Types

Types are a huge part of Prerano. 

### Built-In Types

Prerano comes with a bunch of types baked in.

Primitive Types (identical to PHP's version):


 * `string`
 * `int`
 * `float`


Complex Types:

 * `array<T>` <-- A nummerically indexed array
 * `dict<T>`  <-- A string index php array
 * `tuple<T,U,...>` <-- an immutable collection of multiple items
 * `fn(P1,P2)R` <-- A callable function, lambda or closure
 * `pointer<T>` <-- A pointer to a type (generated as a PHP reference for public functions)


Meta Types:

 * `any` <-- matches all types (similar to `mixed`)
 * `bool` <-- defined as `true|false`
 * `numeric` <-- defined as `int|float`
 * `none` <-- causes an error if assignment is attempted. Defined as `~any`
 * `null`
 * `true`
 * `false`

### Named Types

You can define a named type by using the `type` operator:

    [modifier] type typeName = typeValue

Example:

    type numeric = int|float;

Like with the rest of Prerano, types are defined private by default. You must make them `public` or `protected`:

    public type strings = array<string>;

### Type Algebra

Prerano supports union, intersection and negated types.

Union Types are types that allow values to match either type:

 * `int|string` matches `1`, `"foo"`, but not `1.5`.
 * `array|Traversable` matches `[]`, `ArrayIterator` but not `StdClass`

Intersection Types are types that allow values to match **all** types:

 * `ArrayAccess&Countable` matches only objects that use both interfaces `ArrayAccess` and `Countable`

Negated types are types that allow values to match any type other than the listed:

 * `~int` matches any type **except** integers
 * `~any` matches no type, making any operation an error

Complex Algebra is supported using `()`:

 * `array|(Traversable&Countable)` matches an array or an object that is both traversable and countable

etc...

### Type Modifiers

Prerano supports a few types of type "modifiers":

#### Nullable modifier:

Any type can be made *nullable* by appending a `?` to the type declaration:

    string?

The `any` type already includes `null`, so `any?` is redundant though allowed.

You may notice that this is also possible by declaring `string|null`. `?` is simply short-hand for that (and results in the identical type expression).

#### Pointer Modifier

Pointers can be created by appending a `*` to the type declaration.

    string*

When this code is generated to PHP, it will be compiled as a PHP reference for outside calls. Inside of Prerano code, it will be implemented using an object to preserve type safety.

#### Type Parameterization

Some types (specifically complex types and classes) can support type parameterization. Type parameters are defined using `<>`. A few examples:

    array<int> # an array of integers

    dict<string?> # a dictionary of nullable strings

    Collection<Item> # A collection class using the Item class as a parameter type

When defining classes you can paramterize the class along with the methods:

    class Collection<T> {
        def add(T $item) = /*...*/
        def get(int $offset): T = /*..*/
    }

#### Variance Support

TODO

## Type Declarations

### Variables and Properties

Variables and Properties must have a type except when the type can be inferred from the default expression:

    var $foo = 0; // Type int inferred
    var $bar = "something"; // type string inferred
    var $object = Object(name: "a"); // type object<name:string> inferred
    var array? $items; // Can't infer, so declare

And the same holds true for local variables:

    $foo = 0; // Type int inferred
    $bar = "something"; // type string inferred
    var array? $items; // Can't infer, so declare

### Parameters

**All** parameters must have type declarations. Just like PHP types come before the variable:

    fn identity(any $item) /*...*/


### Return Types

Return types must always be included as well:

    fn identity(any $item) any = $item

## Type Safety

By design, type unsafe operations are not allowed in Prerano. The compiler will identify unsafe operations and prevent you from calling them. For example:

    fn length(any $item) int = php::strlen($item); // Compile error

Would result in a compile error, as `php::strlen` expects a `string` argument, and you may have passed a non-string. The correct way of handling that is to use type expressions to determine the real type:

    fn length(any $item) int = match($item) {
        string -> strlen($item);
        array, \Countable -> count($item);
        default: 0;
    }

The compiler will also detect when type restrictions occur and infer the type properly based on that information. For example:

    fn length(any $item) int {
        if ($item is string) {
            return php::strlen($item); // Works because we can infer that item must be a string
        }
        return 0;
    }

    
### Assignment Semantics

You can only change the type of variable at declaration time. Once a variable is declared, its type cannot be changed. For purposes of this rule, a variable is considered a variable anywhere the scope is defined (it uses the same name).

For example, this is illegal:

    $name = "foo";
    $name = 1; // CompileError as type changed from string to int
    
However, once you define a type, you can assign a value as long as that value is allowed by the type:

    var string|int $foo = 123;
    $foo = "test";
    $foo = 542; // All legal, as the type of $foo is string|int
    
This is known as "resolving":

### Resolving semantics

We can say that `A` **resolves** `B` if the following conditions are met:

 * If `A == B`
 * If `A` is a union, all sub-types of `A` must resolve `B`
 * If `A` is an intersection, at least one sub-type of `A` must resolve `B`
 * If `A` is a value type, it resolves `B` if `A` without value resolve `B` (value of `int(1)` resolves `int`)
 * If `B` is a union, at least one sub-type of `B` must be resolved by `A`
 * If `B` is an intersection, all sub-types of `B` must be resolved by `A`
 * If `A` is a sub-type of `B` (for these purposes, `int` is a sub-type of `float`)

Let's look at a few examples:

 * `int` resolves `int` <- Because they are equal
 * `int|string` does not resolve `int` <-- because string doesn't resolve int
 * `int&string` resolves `int` <-- because at least one of the intersection resolves it
 * `1` resolves `int` <-- because the value 1 is of type int
 * `int` resolves `int|string` <- Because at least one of the union matches
 * `int` does not resolve `int&string` <- Because `int` doesn't resolve `string`
 * `int` resolves `float` <-- Because int is a sub-type of float

This is used to support "variance":

Types `A` and `B` are said to be:

 * **invariant** if `A == B`
 * **covariant** if `A resolves B`
 * **contravariant** if `B resolves A`

Some common situations:

 * Assignment - `RESULT = EXPR` is covariant across the type of `EXPR` and `RESULT`


        // Covariant because "1" resolves "int|string"
        var int|string $a = 1;

 * Passing Arguments - `(ARG)` is covariant to the declared type of the parameter

        fn foo(int|string $a) none {}
        // Covariant because "1" resolves the declaration's type "int|string"
        foo(1);

 * etc

### Types Can Narrow Over Time

The compiler will also detect when type restrictions occur and infer the type properly based on that information. For example:

    fn length(any $item) int {
        if ($item is string) {
            // `is` is like instanceof, but for generic types
            return php::strlen($item); // Works because we can infer that item must be a string
        }
        0;
    }
    
The compiler will detect at each point which possibilities exist for a type and use the inferred type wherever possible.

This means, as long as the compiler can prove the type is narrowed, type expressions can be avoided. For example:

    fn foo(): string { /*...*/ }
    
    var string|int $abc = 1;
    $abc = foo();
    $length = php::strlen($abc); // works, because we can prove $abc must be a string here due to foo() returning a string
    
While sometimes it may not be as obvious why the type didn't narrow:

    def foo(): string|int { /*...*/ }
    
    var string|int $abc = "test";
    php::strlen($abc); // works fine as even though abc is declared to be string|int
    // It's inferred to be string here for this usage, since it can't be anything else due to the initalization to "test"
    do {
        php::strlen($abc); // This is not safe, as one branch has it being a string, another being string|int
        $abc = foo();
    } while (true);
    

## Enums

It's worth talking about ENUMs here, as they are easy to talk about once we understand types.

An enum is just a type that has a set of values it could be.

We could define an enum of `STATUS` using type expressions:

    type GOOD = 1;
    type BAD = 2;
    type STATUS = GOOD|BAD;

And we have our enum!

However, that's an aweful lot to type. So we have a short-hand for that exact thing:

    enum STATUS {
        GOOD,
        BAD
    }

If you want to assign values to the entry's you can:

    enum STATUS {
        GOOD = 1,
        BAD = 2
    }

Enums generate a type under the hood, and as such are interchangable with types above.

## Functions and Methods

Named Functions and methods are declared using the following syntax:

    [visibility] fn methodName[<typeParameters...>]([parameters...]) returnType

Note that functions and methods are private by default and must be made explicitly `protected` or `public`. For functions, `private` means private to the file, and `protected` means only exposed to the package.

The body of functions and methods can be a single expression using `=`:

    fn foo() string = "bar";

Or they can be blocks. If a block is used, the return value is the last executed expression:

    fn foo() string {
        "bar"; // returns "bar"
    }

You can also use explicit returns:

    def foo() {
        return "bar";
    }

### Expression Methods

Prerano lets you declare functions that "look" like methods, but are external to the class. This is useful for primitive types (non-classes) as well as convinence functions. You simply prefix the function's name with the type you're decorating:

    [visibility] on typeName fn methodName[<typeParamters...>]([parameters...]) returnType

The body will be called with `$this` set to the value of type (NOTE: `$this` will NOT ALWAYS BE AN OBJECT)

For example:

    on array<T> fn map(fn<T,V> $fn) array<V> = php::array_map($this, $fn);

That looks a bit gross, but it's explicit and safe. Looking into how to make it less-gross without compromising type safety.

One option is to use inference to tell:

    on array fn map(fn $fn) array = php::array_map($this, $fn);

This would still result in the same type signatures for the parameter and the array, but instead would be inferred through the body/block. Still in the air

## Classes and Objects


TODO A LOT IN HERE: **NOT CORRECT**

### Classes

Classes are defined using the `class` keyword:

    class Foo {

    }

Constructors are declared within the class body using the `constructor` keyword:

    class Person {
        constructor(string $firstName) = /*...*/
    }

### Properties

Properties are declared **private** and cannot be made public or protected. However, getters and setters can be generated (protected visibility by default).

    var [type] $propertyName [{
        [= propertyInitializer] 
        [[getterVisibility] get [= getter];]
        [[setterVisibility] set [([type] $value) = setter];]
    }]

A few examples:

    var $age {     // type inferred to int
        = 0;
        public get;      // public getAge(): int generated
        public set;     // public setAge(int $age) { $this->age = $age; }

    var $count = 1;     // type inferred to int, private only

    var $person { // Type inferred to result of person function
        = person();
        public get = clone $this->person;
        public set;     // public setPerson(Person $value)
    }

    var $template {
        = "";
        public get;
        public set(string|array $value) = /* build template as string */;
    }

### AutoProperties

You can assign to a property in a parameter block (any method parameter block, even non-constructors) just by prefixing with `$this->`.

For example:

    class Person {
        var string $firstName;
        constructor(string $this->firstName) = /*...*/
    }
    
For constructors only, you can omit the property declaration if it has no getter/setter and is private. For example, the following is identical to the preceeding:

    class Person {
        constructor(string $this->firstName) = /*...*/
    }
    
If the property was predefined, you can use the type of the property instead of duplicating it. For example:

    class Person {
        var string $firstName;
        constructor($this->firstName) = /*...*/
    }

Auto properties are assigned prior to the method execution.

## Control Flow

There are a few built-in control flow systems. All can be used as expressions (meaning they return a value):

### If

If works similar to PHP, but are way more flexible.

    $result = if expr yes [else no];

This means that you can use any arbitrary expression in the `expr`, `yes` and `no` slots:

    $result = if $a 2 else 3;

Is equivilant to writing `$result = $a ? 2 : 3;`

Additionally, since blocks are expressions, you can make normal-looking if statements:

    if ($a) {
        doSomething();
    } else {
        doSomethingElse();
    }

Behind the scenes, the result of the `if` is the result of those two function calls. So, if your function returns, you can skip the `return` keyword and simply let the result of the if pass:

    fn boolToInt(bool $a) int {
        if ($a) { // Since the IF is the last expression, the result is passed to the return of the function
            1;
        } else {
            0;
        }
    }

Thereby, when you call `foo(true);` then the true block is executed, and its result passed back as the result of the function.

Additionally, since this block is only executing a single expression (`if`), we could define `bool.toInt()` as:

    on bool fn toInt() int = if ($this) 1 else 0;

### Match

You've seen `match` used before in this document. It is used as a "pattern matching" tool. The idea is a cross between a `switch` and a type recognizer. And you can mix and match:

    match($variable) {
        when, when -> then;
        when -> then;
        else -> then;
    }

Like the rest of Prerano, the `then` block can be a single expression or a block, with the last element used as its value.

The `when` block can be a few different cases:

 * *Type* - executes when the variable matches the passed in type expression
 * *Value* - executes when the variable matches the value exactly
 * *Expr* - executes when the expression with the variable is true

For example:

    $integerified = match($foo) {
        int -> $foo;
        is_numeric($foo) -> (int) $foo; // matches "1", "1.5", 0, 1.5, etc
        string -> strlen($foo);
        array -> count($foo);
        else -> 0
    };

You may omit `else` **ONLY** if the compiler can ensure that all possible cases are accounted for. (Note, `else` is simply sugar for saying `any`).

The following example should illustrate when else is not needed:

    fn test(): int|string = /* something */;

    match ($tmp = test()) {
        int -> $tmp;
        string -> doSomething($tmp);
    } // else is not needed here because the compiler can ensure all possibilities are met

### For

Prerano uses `for` very similar to `foreach` in PHP. 

    for ($value in $iterable) expr

And you can get the key as well:

    for ($key:$value in $iterable) expr

A for loop returns the value of the last expression it executes.

### While

Prerano brings in the two flavors of while:

    while ($bool) expr;

And

    do expr while($bool);


## Packages

Everything in Prerano revolves around packages. When Prerano is compiled, it is compiled a package at a time. A package is considered everything inside of a folder (all `*.pr` files in the folder). The file must declare the package it belongs to.

    package Foo\Bar;
    
Every file **must** start with a package declaration (first non-comment token must be package). And every file must have exactly one package declaration.

At compile time, each package is compiled as a single unit. Meaning that all files in the directory are loaded, parsed and compiled together (if multiple packages exist in a single directory, they will be compiled appropriately as separate packages).

### Compilation

Compilation will be triggered via three methods. One is intended to be used in development, one in test, and another in production:

#### Development Mode

In development mode an autoloader will be used to trigger compilation. Whenver a symbol is requested for an unseen namespace *within configured namespace prefixes*, PHP will trigger the Prerano autoloader. If a `__prerano_package.php` file exists in the directory, the autoloader will load it and return. If it does not, it will start the compiler for that directory and scan for `*.pr` files at least one is found, the entire set will be compiled and the generated code passed to PHP via `eval()`.

#### Test Mode

In test mode, the code's test methods are rendered using a configured test runner, and executed. This means that unit tests are built right into the language.

#### Production Mode

In production mode, a compiler will iterate through a directory (or set) and compile every package found. In each folder, the compiler will output a `__prerano_package.php` file with the compiled package. From here, the file can be checked into source control or deployed to production.

This allows distribution of compiled code without having to need for end-users to use prerano. So library authors can author in prerano, and distribute (target) PHP.

### Interacting with PHP.

PHP uses namespaces. Prerano packages are similar in that public constants/functions/classes are declared using PHP's namespaces.

In addition, a `__PRERANO_METADATA__` class will be defined in each prerano package compilation result, which houses metadata (used for compiling other packages).

Finally, a `__PRERANO_CODE__` class will be defined which contains all compiled code.

Additionally, the file will contain all public functions and classes (and interfaces, and traits) compiled into the PHP version. These compiled blocks will "proxy" inside of the `__PRERANO_CODE__` object doing type validation and conversion where necessary to ensure type safety

### "Global" code

Prerano has no concept of global code. For example:

    package Foo\Bar;
    $a = 1; // Compile error, code here is not allowed

The only code allowed in the root are definitions (type, class, function, etc).

But sometimes you want to run code when loading a package. For this reason, you can declare a named function `main()` which will be called when the package is loaded:

    package Foo\Bar;
    fn __main__() none {
        setup();
    }
    fn setup() none {
        // Do some setup!
    }

Would be compiled to PHP similar to:

    <?php
    namespace Foo\Bar;

    class __PRERANO_CODE__ {
        private static $instance;
        private function __construct() {
            $this->setup();
        }
        public static function boot() {
            if (!self::$instance) {
                self::$instance = new self;
            }
            return self::instance();
        }
        private function setup() {
            // Do some setup!
        }
    }
    __PRERANO_CODE__::boot();

### "Global" Variables

Prerano has no concept of global variables either. Attempting to use a super-global from PHP will result in a compiler error.

Instead, to access them, either take arguments, or call functions to get the data.

## Differences From PHP

It’s worth talking about the differences from PHP that are aimed at simplifying and unifying the language.

### Lack of Constants
Prerano has no concept of “constant”. This is because it uses types heavily it doesn’t need constants (you can just define types instead).

However, Prerano is designed to interact with PHP. For this reason, there is an “adapter”. Public value types will generate constants where they are defined. For example:

    class HTTP {
        type public MODE_HTTP1 = "http/1.0";
        type public MODE_HTTP11 = "http/1.1";
        type public MODE_HTTP2 = "http/2";
        type MODES = MODE_HTTP1|MODE_HTTP11|MODE_HTTP2;
    }

When compiled into PHP, this will generate 3 class constants:

    class HTTP {
        const MODE_HTTP1 = "http/1.0";
        const MODE_HTTP11 = "http/1.1";
        const MODE_HTTP2 = "http/2";
    }

Note that only value types are supported for export.

To read constants, you will need to use a special construct to fetch the constant:

    $value = const(__DIR__);
    $value = const(PHPClass::CONST);
    

## Other

yeah... A ton more to do...