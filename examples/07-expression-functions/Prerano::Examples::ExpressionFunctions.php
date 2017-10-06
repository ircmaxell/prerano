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
        $_136 = $this->Prerano܃܃Examples܃܃ExpressionFunctions܃܃next→int(1);
        return $_136;
    }
    /** int->fn()int */
    public function Prerano܃܃Examples܃܃ExpressionFunctions܃܃next→int($_)
    {
        $_141 = $_ + 1;
        return $_141;
    }
    /** int->fn()int */
    public function Prerano܃܃Examples܃܃ExpressionFunctions܃܃prev→int($_)
    {
        $_146 = $_ - 1;
        return $_146;
    }
    /** int->fn()(true|false) */
    public function Prerano܃܃Examples܃܃ExpressionFunctions܃܃even→int($_)
    {
        $_152 = $_ % 2;
        $_154 = $_152 === 0;
        if ($_154) {
        } else {
            $_161 = $_ % 2;
            $_163 = $_161 === 1;
            if ($_163) {
            }
        }
        return $_169;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃ExpressionFunctions܃܃∫();