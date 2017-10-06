<?php namespace Prerano\Examples\Arrays;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YToxOntzOjQ6InRlc3QiO086MjE6IlByZXJhbm9cTGFuZ3VhZ2VcVHlwZSI6NDp7czo3OiIAKgB0eXBlIjtpOjgxOTI7czoxMjoiACoAY2xhc3NOYW1lIjtzOjA6IiI7czoxMToiACoAc3ViVHlwZXMiO2E6MTp7aTowO086MjE6IlByZXJhbm9cTGFuZ3VhZ2VcVHlwZSI6NDp7czo3OiIAKgB0eXBlIjtpOjEyODtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YToxOntpOjA7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6MTYzODQ7czoxMjoiACoAY2xhc3NOYW1lIjtzOjA6IiI7czoxMToiACoAc3ViVHlwZXMiO2E6MDp7fXM6NToidmFsdWUiO047fX1zOjU6InZhbHVlIjtOO319czo1OiJ2YWx1ZSI7Tjt9fX0=';
    private static $instance;
    private $headers = null;
    public static function init()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function headers()
    {
        if (null === $this->headers) {
            $this->headers = unserialize(base64_decode(self::HEADERS));
        }
        return $this->headers;
    }
}
final class __PRERANO_CODE__
{
    private static $Prerano܃܃Examples܃܃Arrays܃܃instance;
    public static function Prerano܃܃Examples܃܃Arrays܃܃∫()
    {
        if (!self::$Prerano܃܃Examples܃܃Arrays܃܃instance) {
            self::$Prerano܃܃Examples܃܃Arrays܃܃instance = new self();
        }
        return self::$Prerano܃܃Examples܃܃Arrays܃܃instance;
    }
    /** fn()array<any> */
    public function Prerano܃܃Examples܃܃Arrays܃܃test()
    {
        $_111 = $this->Prerano܃܃Examples܃܃Arrays܃܃count→array≺any≻(array(1, 2, 3));
        $_118 = $this->Prerano܃܃Examples܃܃Arrays܃܃slice→array≺any≻(array(1, 2, 3), 1, 2);
        return $_118;
    }
    /** array<any>->fn()int */
    public function Prerano܃܃Examples܃܃Arrays܃܃count→array≺any≻($_)
    {
        $_123 = count($_);
        return $_123;
    }
    /** array<any>->fn(int,int)array<any> */
    public function Prerano܃܃Examples܃܃Arrays܃܃slice→array≺any≻($_, $offset, $length)
    {
        $_132 = array_slice($_, $offset, $length);
        return $_132;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃Arrays܃܃∫();