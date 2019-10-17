<?php

use App\IndexOfCoincidence;
use App\Kasiski;

Route::get('/', function () {
    $kasiski = new Kasiski();
    // return $kasiski->iterateString()->getResult();

    // return $kasiski->getStringPositions('OSJB');

    // $transposed = $kasiski->transposeString(4);

    // print_r($transposed);

    $string = $kasiski->transposeString(4);
    $gcd = 4;
    return view('welcome', compact('string', 'gcd'));
});

Route::get('ioc', function () {
    $ioc = new IndexOfCoincidence("VGOBFZPOBJRQIPFVOABHGUSWCBQOSRGBCOHHHHJOMVFCOGBHOFPZRVGWFFSSGSCFCFKMZBOOAGGFACSCOKAGSCFRRHCSSOHHHJESJZFDSFOFBCZIWSMHBGHBWWZVSVSZOSVQFQBFGQKVFZKSPOFTGCSSSSMSCTGWFZSJSWFWHIAMVORVZJSFVZOBUVSSSBQWWVHQBOBWZOBSWOUQSSQDCSCSCCBRMBGAHCWWCAHCNGSMHOAFSVQMCPVOHBQMCPVVRFGBBUTHWQZFRRZHOICHOFPIVGFWGSSSOUHCTM");

    // return $ioc->calculateIndex();
    return $ioc->getChiSquare();
});
