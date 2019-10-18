<?php

use App\IndexOfCoincidence;
use App\Kasiski;

Route::get('/', function () {
    $kasiski = new Kasiski();
    // return $kasiski->iterateString()->getResult();

    $positions = $kasiski->getStringPositions('EYY');
    $string = $kasiski->transposeString($positions);
    $gcd = $kasiski->getGCD();

    return view('welcome', compact('string', 'gcd'));
});

Route::get('ioc', function () {
    $string = "EDELLMELTNANKLZTPRCRNNEZCYEPPEZYWSLLPYSRQWMTQCLETPFLZHCKSLLPZXOOSHLYCCZSWPCYPEPTLWXPZLEPLFYDPYEPXTWXEPOTENLTTDPTLWSPDCWEAPEPVZEWDWMESCDPZJPENWPPEWYQHPSSLTNTLYYTLLLTXRPZZAWANZXPMYEPETDWDZOYPEWVCSLXTSVNTJDPDOESLRTYLWDGWEWDNLLNEDFRCPLSDZDY";

    $ioc = new IndexOfCoincidence($string);

    // return $ioc->calculateIndex();
    return $ioc->getChiSquare();
});
