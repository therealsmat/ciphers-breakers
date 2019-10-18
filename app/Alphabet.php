<?php

namespace App;

class Alphabet
{
    private static $chars = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    public static function getFromIndex($index)
    {
        return static::$chars[$index];
    }

    public static function getIndex($alphabet)
    {
        return array_search($alphabet, static::$chars);
    }
}
