<?php namespace Prerano\Examples\CallingPHPFunctions;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YToyOntzOjY6ImludGRpdiI7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6ODE5MjtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTozOntpOjA7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6NDtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTowOnt9czo1OiJ2YWx1ZSI7Tjt9aToxO086MjE6IlByZXJhbm9cTGFuZ3VhZ2VcVHlwZSI6NDp7czo3OiIAKgB0eXBlIjtpOjQ7czoxMjoiACoAY2xhc3NOYW1lIjtzOjA6IiI7czoxMToiACoAc3ViVHlwZXMiO2E6MDp7fXM6NToidmFsdWUiO047fWk6MjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo0O3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO319czo1OiJ2YWx1ZSI7Tjt9czo4OiJfX21haW5fXyI7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6ODE5MjtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YToxOntpOjA7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6MTtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTowOnt9czo1OiJ2YWx1ZSI7Tjt9fXM6NToidmFsdWUiO047fX19';
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
    private static $Prerano܃܃Examples܃܃CallingPHPFunctions܃܃instance;
    public static function Prerano܃܃Examples܃܃CallingPHPFunctions܃܃∫()
    {
        if (!self::$Prerano܃܃Examples܃܃CallingPHPFunctions܃܃instance) {
            self::$Prerano܃܃Examples܃܃CallingPHPFunctions܃܃instance = new self();
        }
        return self::$Prerano܃܃Examples܃܃CallingPHPFunctions܃܃instance;
    }
    /** fn(int,int)int */
    public function Prerano܃܃Examples܃܃CallingPHPFunctions܃܃intdiv($dividend, $divisor)
    {
        $_8 = intdiv($dividend, $divisor);
        return $_8;
    }
    /** fn()none */
    public function __construct()
    {
        $_13 = $this->Prerano܃܃Examples܃܃CallingPHPFunctions܃܃intdiv(3, 2);
        return $_13;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃CallingPHPFunctions܃܃∫();