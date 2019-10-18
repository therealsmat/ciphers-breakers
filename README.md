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
  You should get a response like this;
  ![](https://tosinsoremekun.s3.eu-central-1.amazonaws.com/Screen+Shot+2019-10-18+at+9.02.19+PM.png)
  Clearly, `EYY` is the most occuring substring in the cipher text.

- Get the difference in positions of the substring e.g (`EYY`)
  ```php
    $positions = $kasiski->getStringPositions('EYY');
  ```

- Get the GCD of the difference in positions. The GCD is the encryption key length. Then, transpose the text into strings of the lenght of GCD
  ```php
    $string = $kasiski->transposeString($positions);
    $gcd = $kasiski->getGCD();
  ```