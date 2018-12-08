<?php namespace Prerano\Examples\PublicFunctions;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YToxOntzOjY6ImdldE9uZSI7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6ODE5MjtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YToxOntpOjA7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6NDtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTowOnt9czo1OiJ2YWx1ZSI7Tjt9fXM6NToidmFsdWUiO047fX1zOjk6InByb3RlY3RlZCI7YTowOnt9czo3OiJwcml2YXRlIjthOjI6e3M6MzoiaW5jIjtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo4MTkyO3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjI6e2k6MDtPOjIxOiJQcmVyYW5vXExhbmd1YWdlXFR5cGUiOjQ6e3M6NzoiACoAdHlwZSI7aTo0O3M6MTI6IgAqAGNsYXNzTmFtZSI7czowOiIiO3M6MTE6IgAqAHN1YlR5cGVzIjthOjA6e31zOjU6InZhbHVlIjtOO31pOjE7TzoyMToiUHJlcmFub1xMYW5ndWFnZVxUeXBlIjo0OntzOjc6IgAqAHR5cGUiO2k6NDtzOjEyOiIAKgBjbGFzc05hbWUiO3M6MDoiIjtzOjExOiIAKgBzdWJUeXBlcyI7YTowOnt9czo1OiJ2YWx1ZSI7Tjt9fXM6NToidmFsdWUiO047fXM6ODoiX19tYWluX18iO086MjE6IlByZXJhbm9cTGFuZ3VhZ2VcVHlwZSI6NDp7czo3OiIAKgB0eXBlIjtpOjgxOTI7czoxMjoiACoAY2xhc3NOYW1lIjtzOjA6IiI7czoxMToiACoAc3ViVHlwZXMiO2E6MTp7aTowO086MjE6IlByZXJhbm9cTGFuZ3VhZ2VcVHlwZSI6NDp7czo3OiIAKgB0eXBlIjtpOjE7czoxMjoiACoAY2xhc3NOYW1lIjtzOjA6IiI7czoxMToiACoAc3ViVHlwZXMiO2E6MDp7fXM6NToidmFsdWUiO047fX1zOjU6InZhbHVlIjtOO319fQ==';
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
    /** fn()int */
    public function Prerano܃܃Examples܃܃PublicFunctions܃܃getOne()
    {
        return 1;
    }
    /** fn(int)int */
    public function Prerano܃܃Examples܃܃PublicFunctions܃܃inc($a)
    {
        $_207 = $a + 1;
        return $_207;
    }
    /** fn()none */
    public function __construct()
    {
        $_212 = $this->Prerano܃܃Examples܃܃PublicFunctions܃܃getOne();
        $_214 = $this->Prerano܃܃Examples܃܃PublicFunctions܃܃inc($_212);
        return $_214;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃PublicFunctions܃܃∫();
function getOne() : int
{
    $__result__ = \Prerano\Examples\PublicFunctions\__PRERANO_CODE__::Prerano܃܃Examples܃܃PublicFunctions܃܃∫()->Prerano܃܃Examples܃܃PublicFunctions܃܃getOne();
    return $__result__;
}