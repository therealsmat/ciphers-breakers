<?php

namespace App\Http\Controllers;

use App\Kasiski;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $kasiski;

    public function __construct(Request $request)
    {
        $this->kasiski = new Kasiski($request->get('cipher'));
    }
    public function findRepeating()
    {
        return $this->kasiski->iterateString(request('length'))->getResult();
    }

    public function getDifferenceInPositions()
    {
        $difference = $this->kasiski->getStringPositions(request('needle'));
        $gcd = $this->kasiski->getGCD($difference);
        return compact('difference', 'gcd');
    }

    public function showTransposedText()
    {
        $positions = $this->kasiski->getStringPositions(request('needle'));

        return $this->kasiski->transposeString($positions);
    }

    public function getDecryptionKey()
    {
        $this->showTransposedText();
        $keys = $this->kasiski->extractBestKeys();
        return implode("", $keys);
    }

    public function displayPlainText()
    {
        $this->showTransposedText();
        $key = request('key');
        $keys = isset($key) ? str_split($key) : null;
        return $this->kasiski->getPlainText($keys);
    }
}
