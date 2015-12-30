<?php

class FunctionLibrary
{
    public static function clearStr($value)
    {
        return trim(strip_tags($value));
    }

    public static function clearInt($value)
    {
        return abs((int)$value);
    }

    public static function clearFloat($value)
    {
        return abs((float)$value);
    }

    public static function redirectTo($location = false)
    {
        if ($location) {
            header("Location: $location");
            exit;
        }
    }
}