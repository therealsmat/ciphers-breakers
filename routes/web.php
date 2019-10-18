<?php

use App\Alphabet;
use App\IndexOfCoincidence;
use App\Kasiski;

Route::get('/', function () { });

Route::get('cipher', function () {
    $string = "";
    $kasiski = new Kasiski($string);
    // return $kasiski->iterateString()->getResult();

    $positions = $kasiski->getStringPositions('EYY');
    $string = $kasiski->transposeString($positions);
    $gcd = $kasiski->getGCD();
    return $kasiski->getPlainText();

    return view('welcome', compact('string', 'gcd'));
});

// Route::get('ioc', function () {
//     $string = "EDELLMELTNANKLZTPRCRNNEZCYEPPEZYWSLLPYSRQWMTQCLETPFLZHCKSLLPZXOOSHLYCCZSWPCYPEPTLWXPZLEPLFYDPYEPXTWXEPOTENLTTDPTLWSPDCWEAPEPVZEWDWMESCDPZJPENWPPEWYQHPSSLTNTLYYTLLLTXRPZZAWANZXPMYEPETDWDZOYPEWVCSLXTSVNTJDPDOESLRTYLWDGWEWDNLLNEDFRCPLSDZDY";

//     $ioc = (new IndexOfCoincidence())->setString($string);

//     return $ioc->calculateIndex();
//     return $ioc->getChiSquare();
// });
