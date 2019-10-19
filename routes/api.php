<?php

use Illuminate\Http\Request;

Route::post('repeating-strings', 'ApiController@findRepeating');
Route::post('difference-positions', 'ApiController@getDifferenceInPositions');
Route::post('transposed-text', 'ApiController@showTransposedText');
Route::post('decryption-key', 'ApiController@getDecryptionKey');
Route::post('plain-text', 'ApiController@displayPlainText');
