<?php namespace Prerano\Examples\ExpressionFunctions;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YToxOntzOjg6Il9fbWFpbl9fIjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo4MTkyO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjE6e2k6MDtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aToxO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO319czo1OiJ2YWx1ZSI7Tjt9fX0=';
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
    private static $Prerano܃܃Examples܃܃ExpressionFunctions܃܃instance;
    public static function Prerano܃܃Examples܃܃ExpressionFunctions܃܃∫()
    {
        if (!self::$Prerano܃܃Examples܃܃ExpressionFunctions܃܃instance) {
            self::$Prerano܃܃Examples܃܃ExpressionFunctions܃܃instance = new self();
        }
        return self::$Prerano܃܃Examples܃܃ExpressionFunctions܃܃instance;
    }
    /** fn()none */
    public function __construct()
    {
        $_122 = $this->Prerano܃܃Examples܃܃ExpressionFunctions܃܃next→int(1);
        return $_122;
    }
    /** int->fn()int */
    public function Prerano܃܃Examples܃܃ExpressionFunctions܃܃next→int($_)
    {
        $_127 = $_ + 1;
        return $_127;
    }
    /** int->fn()int */
    public function Prerano܃܃Examples܃܃ExpressionFunctions܃܃prev→int($_)
    {
        $_132 = $_ - 1;
        return $_132;
    }
    /** int->fn()(true|false) */
    public function Prerano܃܃Examples܃܃ExpressionFunctions܃܃even→int($_)
    {
        $_138 = $_ % 2;
        $_140 = $_138 === 0;
        if ($_140) {
        } else {
            $_147 = $_ % 2;
            $_149 = $_147 === 1;
            if ($_149) {
            }
        }
        return $_155;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃ExpressionFunctions܃܃∫();