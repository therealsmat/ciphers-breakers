<?php

namespace App;

class ChiSquare
{
    public $string;

    public $calculatedChars;

    private $key = 0;
    private $stringLength;

    private $englishCharFrequencies = ['e' => 0.127, 't' => 0.091, 'a' => 0.082, 'o' => 0.075, 'i' => 0.070, 'n' => 0.067, 's' => 0.063, 'h' => 0.061, 'r' => 0.06, 'd' => 0.043, 'l' => 0.04, 'c' => 0.028, 'u' => 0.028, 'm' => 0.024, 'w' => 0.024, 'f' => 0.022, 'g' => 0.02, 'y' => 0.02, 'p' => 0.019, 'b' => 0.015, 'v' => 0.01, 'k' => 0.008, 'j' => 0.0015, 'x' => 0.0015, 'q' => 0.001, 'z' => 0.0007];

    public function findChiSquare($string, $chars, $index)
    {
        $this->string = $string;
        $this->calculatedChars = $chars;
        $this->stringLength = strlen($this->string);
        $this->key = $index;

        return $this->computeStringValues();

        // return array_sum(array_values($this->englishCharFrequencies));
    }

    public function computeStringValues()
    {
        $length = $this->stringLength;
        $totalChi = 0;
        foreach ($this->calculatedChars as $chars) {
            if (!$chars || count($chars) == 0) continue;
            $key = array_keys($chars)[0];
            $value = $chars[$key];
            $alphabet_frequency = $this->englishCharFrequencies[strtolower($key)];
            $frequency_in_string = ($length * $alphabet_frequency);

            $chi_value = (($value - $frequency_in_string) ^ 2) / $frequency_in_string;

            $totalChi += $chi_value;
        }
        $response['key'] = $this->key;
        $response['string'] = $this->string;
        $response['chi_value'] = round($totalChi, 2);

        return $response;
    }
}
