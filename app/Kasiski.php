<?php

namespace App;

class Kasiski
{
    // public $string = 'GVUCRGYDHOJSBBIKFFUMNZBOQPOZYOJYNBTKFJYFVRBINQJOQIFYAPOMBFJOMVQFROSYZAEXNBTSAHUBRGJSAUKXQSHVLWDQYCWSPBEDVQUDUOJDUSIYYRYOEGQBRBEDZCJSIOJOQHEBRHHONHZEFHEBRJUXZOYXYMRIGVUSEFQDVCDKYOICRGIWRBJYSHXOQODQRFIYSPQDGZUKARRIGVUSEGUVSWDDRFUCGFQDUSHDUSONVGSYISHKFCKXQFUKFCDDBFKXNKQIOMHONZYJVBWDUOJGUOJSGAQURGIOAGUPBFJRRAJYQCTOCSDNFCDGUOJSGKYVYAQURGUXFSVYECJRRFIDBREKARJRNHQVYCVDUSEDUSHCPODXBHYMRHXSFHEYRJUXNEKSGSRBNJUCBZTSRFCKLDHOSSHDBFKXEOJRRFJRNBXOECYMNZBIOIJZBWDDYSICYMTSRHHIVBWDBGJOZHXOBBSYZWDQGWTONZBLLVYWFSBPGVKCJSSYHZTSZOWSASMSGVEEGQEXGFQNVQJSBBQMVFSEZGJKAQUSAKXSPVQXNFCINZBYSKXYFSCOZPUBFOHOOFQFRTBORGQDGCFCCSUNOSVYESJRRSDOZMCKXSIKZCLOVTJRRGEVQWUBFFUKYZOKESRBNJUDUSDDUWICHFUVLWIXGHXOBIJMBAUKAMEPGVUWJODDRRUKPVMYHZTRNJUZESVOEFUNGVQDNZBCGODNNBTPVUXDJVQDJSXKISXOESJRRBYCNQQCRWDGUWSRGVUSAHUBNQJSBBEPZODIVBTSIWTENZBIEOJSBBQVQSSSFWEXZOASAUFBBQUCFSIYASFBBQUCFDUBFCBNVSHZECTEPSIKACKDPCCOVBJOARUNOMDYBBUWBGJKEAYOFHHIGCQFBWTDUWIZECRVRAZEFHQCPCHDRNTSQGYXPSJRRMSKAHKCHOBVLAQURFUDESQDCVOCVQQVYMYWCCICVPBOGVUIZOAOVHUMBBEWVQQVYMYWCCICVPBOGVUIFVEYGRUCRFJOEGJRRBIDNBTSAUQXQTYQUHYXTWIONQXCBZTSRFISARYFVRKKYZOBNHYYAOBMBIHCRCVKPHYYAOVDRFQVYPUMNIIOGVUMBGJYSFKXAWDQVGIEESJYOSQDYSQCGOIRVUXKFHXOPCIDBTIDNMYXT';
    public $string = "OVZCZGDDPOOSJBNKNFZMVZGOYPTZGOOYVBYKNJDFDRGIVQOOYIKYIPTMJFOOUVVFZOXYHAJXVBYSIHZBZGOSIUPXYSMVTWIQGCBSXBJDDQZDCOODCSNYGRDOMGVBZBJDHCOSQOOOYHJBZHMOVHEENHJBZJZXHODXGMWIOVZSMFVDDCIKGONCZGNWZBOYAHCOYOIQZFNYAPVDOZZKIRWIOVZSMGZVAWIDZFZCOFVDCSMDCSTNDGXYQSMKNCPXYFZKNCIDJFPXVKVIWMMOVZDJDBBDCOOGCOOSOAVUZGNOIGZPJFORZAOYYCYOKSINNCIGCOOSOKDVGAVUZGZXNSAYMCORZFNDJRJKIRORVHVVGCADCSJDCSMCXOIXJHDMZHCSNHJYZJZXVEPSOSWBVJZCJZYSZFHKTDMOASMDJFPXMOORZFORVBCOMCDMVZGIWIOZJWIDGSNCGMYSZHMIDBBDJGOOHHCOJBXYHWIQOWYOVZGLTVDWNSGPOVPCRSXYPZYSHOBSISRSOVJEOQJXOFVNDQOSJBVMDFXEHGOKIQZSIKCSXVVXVFHIVZGYAKCYNSHOHPZBNOMOWFVFZTGOZGVDOCKCKSZNWSAYMSORZSIOHMHKFSNKHCQODTORZGJVYWZBNFZKGZTKMSWBVJZDCSIDCWNCPFZVTWNXOHCOJIOMJAZKIMJPOVZWROIDZRZKXVRYPZYRVJZZMSAOMFZNOVVDVZGCOOINVBYPDUCDRVVDRSCKQSCOMSORZBDCVQVCZWIGCWXROVZSIHZBVQOSJBJPHOIIDBYSQWYEVZGIMOOSJBVVYSXSNWJXHOFSIUKBJQZCNSNYISKBJQZCNDZBNCGNDSMZMCYEXSNKICPDXCHODBOOIRZNWMIYJBZWJGOKMADONHMIOCVFJWYDCWNZMCWVZAEENHVCXCMDZNYSYGDXXSORZMXKIHPCPOGVTAVUZFZDMSVDKVTCDQVVGMDWKCNCDPGOOVZIHOFODHZMJBJWDQVVGMDWKCNCDPGOOVZINVJYORZCZFOOMGORZBNDVBYSIUVXYTDQCHDXBWNOVQCCJZYSZFNSIRDFDRPKGZTBVHDYIOGMJIMCZCAKXHDYIOADZFVVGPZMVINOOVZMJGOYAFPXIWIQDGNEMSOYWSVDGSVCOONRDUCKNHCOXCNDJTNDVMDXB";

    public $strArray = [];

    public $substrCount = 0;

    public $result;

    public $strSearchResults = [];

    public $needleLength = 4;

    public $transposedText = [];

    public function __construct()
    {
        $this->splitStrings();
    }

    public function splitStrings()
    {
        $this->strArray = str_split($this->string);
    }

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

    /** Return search results */
    public function getResult()
    {
        arsort($this->strSearchResults);
        return $this->strSearchResults;
    }

    /** Select strings to be used as needle */
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

    /** Find all positions of a needle match in an haystack */
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

    /** Get the positions where the matches were made */
    public function getStringPositions($needle)
    {
        return $this->strpos_all($this->string, $needle);
    }

    /** 
     * Transpose the string into a new sequence
     * of rows,based on the gcd of the
     * difference in match positions
     */
    public function transposeString($gcd)
    {
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
        return $transposed;
    }
}
