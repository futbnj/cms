<?php

namespace Engine\Helper;

class Common
{

    static function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return false|mixed|string
     */
    static function getPathUrl()
    {
        $pathUrl = $_SERVER['REQUEST_URI'];

        if ($position = strpos($pathUrl, '?'))
        {
            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }

    function searchMatchString($string, $find)
    {
        if (strripos($string, $find) !== false){
            return true;
        }

        return false;
    }

    static function isLinkActive($key)
    {
        if (self::searchMatchString($_SERVER['REQUEST_URI'], $key)) {
            return true;
        }

        return false;
    }
}