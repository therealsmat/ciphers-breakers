<?php

namespace App;

class IndexOfCoincidence
{
    // find unique characters
    // find characters having frequency greater than one
    // compute IC

    public $string;

    private $stringLength;

    public function __construct($string)
    {
        $this->string = $string;
        $this->getStringLength();
    }

    public function getStringLength()
    {
        $this->stringLength = strlen($this->string);
    }

    public function grabUniqueChars()
    {
        return $unique = array_unique(str_split($this->string));
    }

    private function getCharsCount($unique = null)
    {
        $unique = $unique ?? $this->grabUniqueChars();

        return collect($unique)->map(function ($value) {
            $count = substr_count($this->string, $value);
            $res = [];
            if ($count > 1) {
                $res[$value] = $count;
            }
            return $res;
        })->values();
    }

    public function calculateIndex()
    {
        $chars = json_decode($this->getCharsCount(), true);
        $values = [];
        foreach ($chars as $char) {
            $values[] = array_values($char);
        }
        $numerator = 0;
        $denominator = $this->stringLength * ($this->stringLength - 1);
        foreach ($values as $key => $value) {
            $value = $value[0] ?? 0;
            $numerator += $value * ($value - 1);
        }
        return round(($numerator / $denominator), 5);
    }

    public function getChiSquare()
    {
        $chiSquare = new ChiSquare();
        $result = [];

        for ($x = 0; $x < 26; $x++) {
            $this->string = $this->getAppropriateString($this->string, $x);
            $chars = $this->getCharsCount();
            $result[] = $chiSquare->findChiSquare($this->string, $chars, $x);
        }
        return $result;
    }

    private function getAppropriateString($string, $index)
    {
        if ($index == 0) return $string;

        $str_arr = str_split($string);
        $newArray = collect($str_arr)->map(function ($str) use ($index) {
            $ascii = ord($str) - 1;
            if ($ascii < 65) {
                $noise = 65 - $ascii;
                $ascii = 90 - ($noise - 1);
            }
            return chr($ascii);
        });
        return $newString = implode("", $newArray->toArray());
    }
}
