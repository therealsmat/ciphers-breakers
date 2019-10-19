# Vigenere Cipher Breaker
This program takes a single vigenere cipher text as input, traverses through the string, and attempts to produce the plain text, while revealing the encryption key. This program is useful when the key is unknown. Traditionally, vigenere ciphers are decrypted with the Kasiski's examination.

### Requirements
Composer, PHP7+ is required to run this program.

### Usage
- Initialize a new `App\Kasiski` class
  ```php
    $string = '******';
    $kasiski = new Kasiski($string);
  ```

- Compute a breakdown of possible repeating string
  ```php
    $results = $kasiski->iterateString()->getResult();
  ```
  ![](https://tosinsoremekun.s3.eu-central-1.amazonaws.com/Screen+Shot+2019-10-18+at+9.02.19+PM.png)

Clearly, `EYY` is the most occuring substring in the cipher text.

- Get the difference in positions of the substring e.g (`EYY`)
  ```php
    $positions = $kasiski->getStringPositions('EYY');
  ```

- Get the GCD of the difference in positions.
  ```php
    $gcd = $kasiski->getGCD($positions);
  ```
  The positions parameter is optional, if you have passed it as a parameter to any other method in the class.
<br/>

- Get the transposed string.
  ```php
    $gcd = $kasiski->transposeString($positions);
  ```
  The positions parameter is optional, if you have passed it as a parameter to any other method in the class.

<br/>
#### Getting our decryption keys;

- To get the raw values for decrytion keys,
  ```php
    $keys = $kasiski->getBestKeys();
  ```
<br/>

- To get the string values for decrytion keys,
  ```php
    $keys = $kasiski->extractBestKeys();
  ```
<br/>

- To get the plain text,
  ```php
    $plainText = $kasiski->getPlainText();
  ```
<br/>

#### Putting it all together with an example
```php
$string = "GVUCRGYDHOJSBBIKFFUMNZBOQPOZYOJYNBTKFJYFVRBINQJOQIFYAPOMBFJOMVQFROSYZAEXNBTSAHUBRGJSAUKXQSHVLWDQYCWSPBEDVQUDUOJDUSIYYRYOEGQBRBEDZCJSIOJOQHEBRHHONHZEFHEBRJUXZOYXYMRIGVUSEFQDVCDKYOICRGIWRBJYSHXOQODQRFIYSPQDGZUKARRIGVUSEGUVSWDDRFUCGFQDUSHDUSONVGSYISHKFCKXQFUKFCDDBFKXNKQIOMHONZYJVBWDUOJGUOJSGAQURGIOAGUPBFJRRAJYQCTOCSDNFCDGUOJSGKYVYAQURGUXFSVYECJRRFIDBREKARJRNHQVYCVDUSEDUSHCPODXBHYMRHXSFHEYRJUXNEKSGSRBNJUCBZTSRFCKLDHOSSHDBFKXEOJRRFJRNBXOECYMNZBIOIJZBWDDYSICYMTSRHHIVBWDBGJOZHXOBBSYZWDQGWTONZBLLVYWFSBPGVKCJSSYHZTSZOWSASMSGVEEGQEXGFQNVQJSBBQMVFSEZGJKAQUSAKXSPVQXNFCINZBYSKXYFSCOZPUBFOHOOFQFRTBORGQDGCFCCSUNOSVYESJRRSDOZMCKXSIKZCLOVTJRRGEVQWUBFFUKYZOKESRBNJUDUSDDUWICHFUVLWIXGHXOBIJMBAUKAMEPGVUWJODDRRUKPVMYHZTRNJUZESVOEFUNGVQDNZBCGODNNBTPVUXDJVQDJSXKISXOESJRRBYCNQQCRWDGUWSRGVUSAHUBNQJSBBEPZODIVBTSIWTENZBIEOJSBBQVQSSSFWEXZOASAUFBBQUCFSIYASFBBQUCFDUBFCBNVSHZECTEPSIKACKDPCCOVBJOARUNOMDYBBUWBGJKEAYOFHHIGCQFBWTDUWIZECRVRAZEFHQCPCHDRNTSQGYXPSJRRMSKAHKCHOBVLAQURFUDESQDCVOCVQQVYMYWCCICVPBOGVUIZOAOVHUMBBEWVQQVYMYWCCICVPBOGVUIFVEYGRUCRFJOEGJRRBIDNBTSAUQXQTYQUHYXTWIONQXCBZTSRFISARYFVRKKYZOBNHYYAOBMBIHCRCVKPHYYAOVDRFQVYPUMNIIOGVUMBGJYSFKXAWDQVGIEESJYOSQDYSQCGOIRVUXKFHXOPCIDBTIDNMYXT";

$kasiski = new Kasiski($string);

//$strings = $kasiski->iterateString()->getResult();

$positions = $kasiski->getStringPositions('GVU');

// $string = $kasiski->transposeString($positions);
// $gcd = $kasiski->getGCD();
// $string = $kasiski->getBestKeys();
// $gcd = $kasiski->extractBestKeys();

return $kasiski->getPlainText();
```