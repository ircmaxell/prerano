<?php namespace Prerano\Examples\BasicUsage;

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
    private static $Prerano܃܃Examples܃܃BasicUsage܃܃instance;
    public static function Prerano܃܃Examples܃܃BasicUsage܃܃∫()
    {
        if (!self::$Prerano܃܃Examples܃܃BasicUsage܃܃instance) {
            self::$Prerano܃܃Examples܃܃BasicUsage܃܃instance = new self();
        }
        return self::$Prerano܃܃Examples܃܃BasicUsage܃܃instance;
    }
    /** fn()none */
    public function __construct()
    {
        return $_1;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃BasicUsage܃܃∫();