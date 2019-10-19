<?php

namespace App;

class Kasiski
{
    /**
     * The cipher text
     */
    public $string = '';

    /** 
     * Holds the splitted string
     */
    public $strArray = [];

    /** 
     * The frequency of occurrences of the
     * substring under inspection
     */
    public $substrCount = 0;
    /**
     * Holds the position of occurrences
     * of searches found
     */
    private $positions = [];

    /** 
     * Holds the results of the occurrences
     * of a substring in the entire string
     * 
     */
    public $strSearchResults = [];

    /**
     * The length of string to
     * be used as a needle
     */
    public $needleLength = 3;

    /**
     * The transposed text,after
     * finding the GCD
     */
    public $transposedText = [];

    /**
     * Holds the Derived GCD
     */
    public $gcd = 0;

    public function __construct($string = null)
    {
        $this->string = $string;

        $this->splitStrings();
    }

    public function splitStrings()
    {
        $this->strArray = str_split($this->string);
    }

    /**
     * Iterate through the string
     */
    public function iterateString()
    {
        $arr_len = count($this->strArray);
        for ($x = 0; $x < $arr_len; $x++) {
            $string = $this->selectStrings($x, $arr_len);

            if ($string) {
                $this->substrCount = substr_count($this->string, $string);
                $this->strSearchResults[$string] = $this->substrCount;
            }
        }

        return $this;
    }

    /** 
     * Return search results 
     */
    public function getResult()
    {
        arsort($this->strSearchResults);
        return $this->strSearchResults;
    }

    /** 
     * Select strings to be used as needle
     */
    private function selectStrings($index, $maxLen)
    {
        if ($maxLen > $index + $this->needleLength - 1) {
            $pool = [];
            for ($x = 0; $x < $this->needleLength; $x++) {
                $pool[] = $x == 0 ? $this->strArray[$index] : $this->strArray[++$index];
            }
            return implode("", $pool);
        }
    }

    /**
     *  Find all positions of a needle match in an haystack
     */
    private function strpos_all($haystack, $needle)
    {
        $offset = 0;
        $allpos = array();
        while (($pos = strpos($haystack, $needle, $offset)) !== FALSE) {
            $offset   = $pos + 1;
            $allpos[] = $pos;
        }
        return $allpos;
    }

    /** 
     * Get the positions where the matches were made 
     */
    public function getStringPositions($needle)
    {
        return $this->strpos_all($this->string, $needle);
    }

    /**
     * Calculate the GCD of the difference in positions
     */
    public function getGCD($positions = null)
    {
        $positions = $positions ?? $this->positions;

        return (new GCD($positions))->compute();
    }

    /** 
     * Transpose the string into a new sequence of rows,
     * based on the gcd of the difference in match positions
     */
    public function transposeString($positions)
    {
        $this->positions = $positions;
        $gcd = $this->getGCD();

        $arr_len = count($this->strArray);
        $transposed = [];

        for ($y = 0; $y < $gcd; $y++) {
            $entropy = 0 + $y;
            for ($x = 0; $x < $arr_len; $x++) {
                $aggr[] = $this->strArray[$entropy] ?? null;
                $entropy += $gcd;
            }
            $transposed[] = implode(array_filter($aggr));
            $aggr = [];
        }
        return $this->transposedText = $transposed;
    }

    /**
     * Get the best keys from the kasiski examination
     */
    public function getBestKeys()
    {
        $ioc = new IndexOfCoincidence();
        $keys = $this->transposedText;
        $bestKeys = [];
        foreach ($keys as $key) {
            $bestKeys[] = $ioc->setString($key)->getChiSquare();
        }
        return $bestKeys;
    }

    /**
     * Extract the keycodes, and map them
     * to their corresponding alphabets
     */
    public function extractBestKeys()
    {
        $bestKeys = $this->getBestKeys();
        $bestKeyChar = [];
        foreach ($bestKeys as $keys) {
            $bestKeyChar[] = Alphabet::getFromIndex($keys[0]['key']);
        }
        return $bestKeyChar;
    }

    /**
     * Extract the plain text
     */
    public function getPlainText()
    {
        $keys = $this->extractBestKeys();
        $strArray = $this->strArray;
        $detectedString = [];
        $x = 0;
        foreach ($strArray as $cipher) {
            if ($x == $this->getGCD()) $x = 0;
            $cipherPos = Alphabet::getIndex($cipher);
            $keyPos = Alphabet::getIndex($keys[$x]);
            $modulo =  (int) $this->getMod(($cipherPos - $keyPos));
            $detectedString[] = Alphabet::getFromIndex((int) $modulo);
            $x++;
        }
        return $gluedString = implode("", $detectedString);
    }

    /**
     * Get the Modulo of a number
     */
    private function getMod($value, $n = 26)
    {
        return gmp_strval(gmp_mod($value, $n));
    }
}
