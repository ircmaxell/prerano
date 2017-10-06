<?php namespace Prerano\Examples\PipeOperator;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YToyOntzOjM6ImFkZCI7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6ODE5MjtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTozOntpOjA7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6NDtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTowOnt9czo1OiJ2YWx1ZSI7Tjt9aToxO086MjE6IlByZXJhbm9cTGFuZ3VhZ2VcVHlwZSI6NDp7czo3OiIAKgB0eXBlIjtpOjQ7czoxMjoiACoAY2xhc3NOYW1lIjtzOjA6IiI7czoxMToiACoAc3ViVHlwZXMiO2E6MDp7fXM6NToidmFsdWUiO047fWk6MjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo0O3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO319czo1OiJ2YWx1ZSI7Tjt9czo0OiJ0ZXN0IjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo4MTkyO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjE6e2k6MDtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aToxO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO319czo1OiJ2YWx1ZSI7Tjt9fX0=';
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
    private static $Prerano܃܃Examples܃܃PipeOperator܃܃instance;
    public static function Prerano܃܃Examples܃܃PipeOperator܃܃∫()
    {
        if (!self::$Prerano܃܃Examples܃܃PipeOperator܃܃instance) {
            self::$Prerano܃܃Examples܃܃PipeOperator܃܃instance = new self();
        }
        return self::$Prerano܃܃Examples܃܃PipeOperator܃܃instance;
    }
    /** fn(int,int)int */
    public function Prerano܃܃Examples܃܃PipeOperator܃܃add($a, $b)
    {
        $_7 = $a + $b;
        return $_7;
    }
    /** fn()none */
    public function Prerano܃܃Examples܃܃PipeOperator܃܃test()
    {
        $_12 = $this->Prerano܃܃Examples܃܃PipeOperator܃܃add(1, 2);
        $_15 = $this->Prerano܃܃Examples܃܃PipeOperator܃܃add($_12, 3);
        return $_15;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃PipeOperator܃܃∫();