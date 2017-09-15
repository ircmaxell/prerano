<?php namespace Prerano\Examples\DefiningTypes;

final class __PRERANO_METADATA__
{
    const HEADERS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YTowOnt9fQ==';
    const FUNCTIONS = 'YTozOntzOjY6InB1YmxpYyI7YTowOnt9czo5OiJwcm90ZWN0ZWQiO2E6MDp7fXM6NzoicHJpdmF0ZSI7YTowOnt9fQ==';
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
    private static $Prerano܃܃Examples܃܃DefiningTypes܃܃instance;
    public static function Prerano܃܃Examples܃܃DefiningTypes܃܃∫()
    {
        if (!self::$Prerano܃܃Examples܃܃DefiningTypes܃܃instance) {
            self::$Prerano܃܃Examples܃܃DefiningTypes܃܃instance = new self();
        }
        return self::$Prerano܃܃Examples܃܃DefiningTypes܃܃instance;
    }
}
__PRERANO_CODE__::Prerano܃܃Examples܃܃DefiningTypes܃܃∫();
const GOOD = 0;
const BAD = 1;