<?php

namespace App;

class GCD
{
    protected $input_values;
    protected $gcd_value;

    public function __construct(array $values)
    {
        $this->input_values = $values;
    }

    public function compute()
    {
        $result = $this->input_values[0];
        $arr_len = count($this->input_values);
        for ($x = 1; $x < $arr_len; $x++) {
            if (!$this->isPrime($this->input_values[$x])) {
                $result = $this->gcd($this->input_values[$x], $result);
            }
            continue;
        }
        return $result;
    }

    public function gcd($one, $two)
    {
        $gcd = \gmp_gcd($one, $two);
        return \gmp_strval($gcd);
    }

    public function isPrime($number)
    {
        if ($number == 1)
            return false;
        for ($i = 2; $i <= $number / 2; $i++) {
            if ($number % $i == 0)
                return false;
        }
        return true;
    }
}
