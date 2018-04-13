<?php

namespace Magentor\Framework\Magento\Info;

class Version
{

    public static function version()
    {
        if (self::isMagento2()) {

        }
    }


    public static function isMagento1()
    {

    }


    public static function isMagento2()
    {
        $autoload = getcwd() . '/vendor/autoload.php';

        if (!file_exists($autoload) || !is_readable($autoload)) {
            return false;
        }

        return true;
    }
}
