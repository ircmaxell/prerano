<?php namespace Prerano\Examples\BasicUsage;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YToxOntzOjg6Il9fbWFpbl9fIjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo4MTkyO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjE6e2k6MDtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aToxO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO319czo1OiJ2YWx1ZSI7Tjt9fX0=';
    const FUNCTIONS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YToxOntzOjg6Il9fbWFpbl9fIjtPOjI2OiJQcmVyYW5vXExhbmd1YWdlXEZ1bmN0aW9uXyI6NDp7czozODoiAFByZXJhbm9cTGFuZ3VhZ2VcRnVuY3Rpb25fAHBhcmFtZXRlcnMiO2E6MDp7fXM6Mzg6IgBQcmVyYW5vXExhbmd1YWdlXEZ1bmN0aW9uXwByZXR1cm5UeXBlIjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aToxO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO31zOjMyOiIAUHJlcmFub1xMYW5ndWFnZVxGdW5jdGlvbl8AYm9keSI7TzoyOToiUHJlcmFub1xMYW5ndWFnZVxCbG9ja1xTaW1wbGUiOjc6e3M6MTI6IgAqAHZhcmlhYmxlcyI7YTowOnt9czo4OiIAKgBuYW1lcyI7YTowOnt9czo4OiIAKgBpbnB1dCI7YTowOnt9czoxMDoiACoAaW5ib3VuZCI7YTowOnt9czoxMToiACoAb3V0Ym91bmQiO2E6MDp7fXM6ODoiACoAbm9kZXMiO2E6MDp7fXM6MzQ6IgBQcmVyYW5vXExhbmd1YWdlXEJsb2NrQWJzdHJhY3QAaWQiO2k6MTt9czozNDoiAFByZXJhbm9cTGFuZ3VhZ2VcRnVuY3Rpb25fAHJlc3VsdCI7TzozMDoiUHJlcmFub1xMYW5ndWFnZVxWYXJpYWJsZVxUZW1wIjozOntzOjU6IgAqAGlkIjtpOjE7czoxNToiACoAZGVjbGFyZWRUeXBlIjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aToxO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO31zOjE1OiIAKgBpbmZlcnJlZFR5cGUiO047fX19fQ==';
    private static $instance;
    private $headers = null, $functions = null;
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
    public function functions()
    {
        if (null === $this->functions) {
            $this->functions = unserialize(base64_decode(self::FUNCTIONS));
        }
        return $this->functions;
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
    public function __construct()
    {
        return $_1;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃BasicUsage܃܃∫();