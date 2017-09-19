<?php namespace Prerano\Examples\PublicFunctions;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YToyOntzOjI6ImlkIjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo4MTkyO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjM6e2k6MDtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo0O3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO31pOjE7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6ODtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTowOnt9czo1OiJ2YWx1ZSI7Tjt9aToyO086MjE6IlByZXJhbm9cTGFuZ3VhZ2VcVHlwZSI6NDp7czo3OiIAKgB0eXBlIjtpOjQ7czoxMjoiACoAY2xhc3NOYW1lIjtzOjA6IiI7czoxMToiACoAc3ViVHlwZXMiO2E6MDp7fXM6NToidmFsdWUiO047fX1zOjU6InZhbHVlIjtOO31zOjY6ImRlY29kZSI7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6ODE5MjtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YToyOntpOjA7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6NTEyO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjI6e2k6MDtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo0O3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtpOjA7fWk6MTtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo0O3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtpOjE7fX1zOjU6InZhbHVlIjtOO31pOjE7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6NDtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTowOnt9czo1OiJ2YWx1ZSI7Tjt9fXM6NToidmFsdWUiO047fX1zOjk6InByb3RlY3RlZCI7YTowOnt9czo3OiJwcml2YXRlIjthOjA6e319';
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
    private static $Prerano܃܃Examples܃܃PublicFunctions܃܃instance;
    public static function Prerano܃܃Examples܃܃PublicFunctions܃܃∫()
    {
        if (!self::$Prerano܃܃Examples܃܃PublicFunctions܃܃instance) {
            self::$Prerano܃܃Examples܃܃PublicFunctions܃܃instance = new self();
        }
        return self::$Prerano܃܃Examples܃܃PublicFunctions܃܃instance;
    }
    /** fn(int,float)int */
    public function Prerano܃܃Examples܃܃PublicFunctions܃܃id($a, $b)
    {
        return $a;
    }
    /** fn((0|1))int */
    public function Prerano܃܃Examples܃܃PublicFunctions܃܃decode($status)
    {
        return $status;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃PublicFunctions܃܃∫();
function id($a, $b) : int
{
    if (!is_int($a)) {
        throw new \TypeException('Function id() expects parameter 1 to be int');
    }
    if (!(is_float($b) || is_int($b))) {
        throw new \TypeException('Function id() expects parameter 2 to be float');
    }
    $__result__ = \Prerano\Examples\PublicFunctions\__PRERANO_CODE__::Prerano܃܃Examples܃܃PublicFunctions܃܃∫()->Prerano܃܃Examples܃܃PublicFunctions܃܃id($a, $b);
    return $__result__;
}
function decode($status) : int
{
    if (!($status === 0 || $status === 1)) {
        throw new \TypeException('Function decode() expects parameter 1 to be (0|1)');
    }
    $__result__ = \Prerano\Examples\PublicFunctions\__PRERANO_CODE__::Prerano܃܃Examples܃܃PublicFunctions܃܃∫()->Prerano܃܃Examples܃܃PublicFunctions܃܃decode($status);
    return $__result__;
}
const GOOD = 0;
const BAD = 1;