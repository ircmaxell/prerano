<?php

namespace Prerano\Language;

use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    public static function provideSimpleTypes(): array
    {
        return [
            [Type::INT],
            [Type::FLOAT],
            [Type::STRING],
            [Type::NONE],
            [Type::NULL],
            [Type::OBJECT],
            [Type::TRUE],
            [Type::FALSE],
        ];
    }

    public static function provideValidStringTypes()
    {
        return [
            [new Type(Type::UNKNOWN), 'unknown'],
            [new Type(Type::NONE), 'none'],
            [new Type(Type::NULL), 'null'],
            [new Type(Type::INT), 'int'],
            [new Type(Type::FLOAT), 'float'],
            [new Type(Type::STRING), 'string'],
            [new Type(Type::TRUE), 'true'],
            [new Type(Type::FALSE), 'false'],
            [new Type(Type::ARRAY, null, new Type(Type::INT)), 'array<int>'],
            [new Type(Type::OBJECT), 'object'],
            [new Type(Type::UNION, null, new Type(Type::INT), new Type(Type::FLOAT)), '(int|float)'],
            [new Type(Type::INTERSECTION, null, new Type(Type::INT), new Type(Type::FLOAT)), '(int&float)'],
            [new Type(Type::POINTER, null, new Type(Type::INT)), 'pointer<int>'],
            [new Type(Type::TYPE_REFERENCE, 'bool'), 'bool'],
        ];
    }

    public static function provideNormalization()
    {
        return [
            [new Type(Type::INT), 'int'],
            [new Type(Type::FLOAT), 'float'],
            [new Type(Type::UNION, null, new Type(Type::FLOAT), new Type(Type::INT)), '(float|int)'],
            [new Type(Type::UNION, null, new Type(Type::INT), new Type(Type::FLOAT)), '(float|int)'],
            [new Type(Type::UNION, null, new Type(Type::UNION, null, new Type(Type::INT), new Type(Type::FLOAT)), new Type(Type::FLOAT)), '(float|int)'],
            [new Type(Type::INTERSECTION, null, new Type(Type::INTERSECTION, null, new Type(Type::INT), new Type(Type::FLOAT)), new Type(Type::FLOAT)), '(float&int)'],
            [new Type(Type::INTERSECTION, null, new Type(Type::UNION, null, new Type(Type::INT), new Type(Type::FLOAT)), new Type(Type::FLOAT)), '((float&int)|float)'],

        ];
    }

    /**
     * @dataProvider provideValidStringTypes
     */
    public function testValidStringTypes(Type $type, string $expected)
    {
        $this->assertEquals($expected, $type->toString());
    }

    /**
     * @dataProvider provideSimpleTypes
     * @expectedException InvalidArgumentException
     */
    public function testThatSimpleTypeWithSingleSubtypeFails(int $type)
    {
        new Type($type, null, new Type(Type::UNKNOWN));
    }

    /**
     * @dataProvider provideSimpleTypes
     * @expectedException InvalidArgumentException
     */
    public function testThatSimpleTypeWithTwoSubtypesFails(int $type)
    {
        new Type($type, null, new Type(Type::UNKNOWN), new Type(Type::UNKNOWN));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSettingMultipleTypesFails()
    {
        new Type(Type::INT | Type::FLOAT);
    }

    /**
     * @dataProvider provideSimpleTypes
     */
    public function testThatSimpleTypeWorksAndStoresType(int $type)
    {
        $new = new Type($type);
        $this->assertEquals($type, $new->type);
    }

    /**
     * @dataProvider provideNormalization
     */
    public function testNormalize(Type $type, string $expected)
    {
        $this->assertEquals($expected, $type->normalize()->toString());
    }
}
