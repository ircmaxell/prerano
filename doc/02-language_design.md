# Language Design

Prerano is a strongly typed language. This means that every variable has a computed type (even if that computed type is a union of other types, for example a `string` or an `integer`). If you call a normal PHP function, the return type will default to `mixed` *unless* the PHP function includes a return type declaration.

## Types

Types are a huge part of Prerano. 

### Built-In Types

Prerano comes with a bunch of types baked in.

Primitive Types (identical to PHP's version):

 * `null`
 * `string`
 * `int`
 * `float`
 * `true`
 * `false`

Complex Types:

 * `array<T>` <-- A nummerically indexed array
 * `dict<T>`  <-- A string index php array
 * `object<key:T>` <-- A php StdClass object, with types specified on keys
 * `tuple<T,U,...>` <-- an immutable collection of multiple items
 * `fn<P1,P2,...,R>` <-- A callable function, lambda or closure with the signature (P1, P2, ...): R

Meta Types:

 * `any` <-- matches all types (similar to `mixed`)
 * `bool` <-- defined as `true|false`
 * `numeric` <-- defined as `int|float`
 * `none` <-- causes an error if assignment is attempted. Defined as `~any`

### Named Types

You can define a named type by using the `type` operator:

    type numeric = int|float;

Like with the rest of Prerano, types are defined private by default. You must make them `public` or `protected`:

    type public strings = array<string>;

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

You can also let inference try to infer the types involved. For example:

    $a = [1, 2]; // A is inferred as array<int>

    def identity<T>(array<T> $a): array<T> = $a; // Explicit version
    def identity(array $a) = $a; // type parameterization will be retained

    $b = identity($a); // no need to parameterize, as it's inferable

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
    $object = Object(name: "a"); // type object<name:string> inferred
    var array? $items; // Can't infer, so declare

### Parameters

**All** parameters must have type declarations. Just like PHP types come before the variable:

    def identity(any $item) /*...*/

However, parameterized types don't need to be implied and can be inferred if necessary:

    def foo(array $a) = $a;

Here, the sub-type of `$a` isn't needed. In general, the only time you need to specify the parameterization is if it matters to your operation:

    def concat(array<string> $a): string = /*...*/

Therefore, the following two are identical and both type-system legal:

    def foo(array $b) = $b[0]; // when called with array<string> returns string

    def foo<T>(array<T> $b): T = $b[0];


### Return Types

Return types *may* be omitted if the type can be inferred from the body of the function. For example: 

    def identity(any $item) = $item;

This simple (and pointless) function can be proven to return the explicit type `any` because the type of `$item` is well defined. Here are a few more examples

    def add(int $a, float $b) = $a + $b; // Well defined, because int + float is always float

    def namedPerson(string $name) = Person(name: $name); // Well defined, because it *always* returns a `Person` object

    def getPrice(string $item) = match($item) {
        "cake" -> 5;
        "pie" -> 5.5; // This is OK, since we can "widen" int to float and cover all bases
        else -> 10;
    }

Here's a problematic example:

    def getId(string $item) = match($item) {
        "cake" -> 42;
        "pie" -> "pie"; // Compile error, union types are not inferred automatically and must be explicit
    }

This can be solved by declaring the union explicitly:

    def getId(string $item): int|string = match($item) {
        "cake" -> 42;
        "pie" -> "pie"; // Compile error, union types are not inferred automatically and must be explicit
    }

## Type Safety

By design, type unsafe operations are not allowed in Prerano. The compiler will identify unsafe operations and prevent you from calling them. For example:

    def length(any $item) = strlen($item);

Would result in a compile error, as `strlen` expects a `string` argument, and you may have passed a non-string. The correct way of handling that is to use type expressions to determine the real type:

    def length(any $item) = match($item) {
        string -> strlen($item);
        array, \Countable -> count($item);
        default: 0;
    };

The compiler will also detect when type restrictions occur and infer the type properly based on that information. For example:

    def length(any $item) {
        if ($item is string) {
            return strlen($item); // Works because we can infer that item must be a string
        }
        return 0;
    }

## Functions and Methods

Named Functions and methods are declared using the following syntax:

    def [visibility] methodName[<typeParameters...>]([parameters...]) [:returnType]

Note that functions and methods are private by default and must be made explicitly `protected` or `public`. For functions, `private` means private to the file, and `protected` means only exposed to the package.

The body of functions and methods can be a single expression using `=`:

    def foo() = "bar";

Or they can be blocks. If a block is used, the return value is the last executed expression:

    def foo() {
        "bar"; // returns "bar"
    }

You can also use explicit returns:

    def foo() {
        return "bar";
    }

### Anonymous Functions (Lambdas)

Lambdas are declard using the `fn` type:

    fn 1;

This declares a lambda of no arguments which returns the value 1

    fn($a) $a * 2;

Declares a lambda of 1 argument which squares the argument.

Other examples:

    fn($a, $b) { $a++; $b++; $a + $b; } // Adds 1 to $a, $b and then adds $a + $b

    fn($a) $a * 2; // Type inference makes the function fn<numeric,numeric>

    fn($a) strlen($a) + 1; // Type inference makes the function fn<string,int>

    fn(int $a): int $a + 1; // explicit typing


### Expression Methods

Prerano lets you declare functions that "look" like methods, but are external to the class. This is useful for primitive types (non-classes) as well as convinence functions. You simply prefix the function's name with the type you're decorating:

    def [visibility] typeName.methodName[<typeParamters...>]([parameters...]) [:returnType]

The body will be called with `$this` set to the value of type (NOTE: `$this` will NOT ALWAYS BE AN OBJECT)

For example:

    def array<T>.map(fn<T,V> $fn): array<V> = array_map($this, $fn);

That looks a bit gross, but it's explicit and safe. Since `array_map` is a "core" function, we can infer the type of the result. So we can simplify:

    def array.map(fn $fn) = array_map($this, $fn);

## Classes and Objects


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

    var [type] $propertyName [= propertyInitializer] [{
        [[getterVisibility] get [= getter];]
        [[setterVisibility] set [([type] $value) = setter];]
    }]

A few examples:

    var $age = 0  {     // type inferred to int
        public get;      // public getAge(): int generated
        public set;     // public setAge(int $age) { $this->age = $age; }

    var $count = 1;     // type inferred to int, private only

    var $person = Person() {
        public get = clone $this->person;
        public set;     // public setPerson(Person $value)
    }

    var $template = "" {
        public get;
        public set(string|array $value) = /* build template as string */;
    }

### Method overloading

Classes can contain multiple methods of the same name:

    class Person {
        def method(string $firstName): Person = /*...*/
        def method(string $firstName, $lastName): Person = /*...*/
    }

When the class contains a single method, it will be compiled as the method name in PHP code. When the class contains multiple methods, a match block will be generated, similar to this:

    class Person {
        def method(any ...$args): Person = match($args) {
            tuple<string> -> { /* method1's body */ };
            tuple<string, string> -> { /* method2's body */ };
            else -> throw BadMethodCallException("Non-existant method called")
        }
    }

Additionally, if the types are different, the return value of the generated method will be based on the union of the types.

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

### Match

You've seen `match` used before in this document. It is used as a "pattern matching" tool. The idea is a cross between a `switch` and a type recognizer. And you can mix and match:

    match($variable>) {
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

    def test(): int|string = /* something */;

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

### Passing lambdas and blocks

Any function that accepts a `fn` as its final argument can be called without it, but specifying a block (if no parameters) or a lambda immediately following the call.

For example:

    def array<T>.map(fn<T,V>): array<V> {
        var array<V> $result = [];
        for ($value in $this) $result[] = fn($value);
        $result;
    }

    [1,2].each() fn($el) $el + 1;

## Other

yeah... A ton more to do...