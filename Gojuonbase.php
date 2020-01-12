<?php

Class Gojuonbase
{
    protected $gojuon = array("あ","い","う","え","お","か","き","く","け","こ","さ","し","す","せ","そ","た","ち","つ","て","と","な","に","ぬ","ね","の","は","ひ","ふ","へ","ほ","ま","み","む","め","も","や","ゆ","よ","ら","り","る","れ","ろ","わ","ゐ","ゑ","を","ん");

    protected $decimal;

    public function __construct($input)
    {
        if(is_string($input))
        {
            $this->decimal = $this->__load_hiragana($input);
        }
        elseif(is_int($input))
        {
           $this->decimal = $input;
        }
        else
        {
            trigger_error('input type is Invalid', E_USER_ERROR);
        }
    } 

    protected function __load_hiragana($input)
    {
        // str_splitはマルチバイト非対応のため使用できなかった。
        // こちらから借用：http://scrap.php.xdomain.jp/php_str_split/
        // mb_str_splitがphpで採用されたら乗り換えよう
        // https://wiki.php.net/rfc/mb_str_split
        $multibyte_array = preg_split("//u" , $input, -1, PREG_SPLIT_NO_EMPTY);
        $reversed_input = array_reverse($multibyte_array, false); 

        $sum_decimal = 0;
        foreach($reversed_input as $seq => $word)
        {
            $match_word_seq = array_search($word, $this->gojuon);
            // match_word_seqかmatch_word_numか迷う
            if($match_word_seq === False){
                // !$match_word_seqだと、[0 => 'あ']の時にFalseになってしまう
                trigger_error('Char is Invalid', E_USER_ERROR);
            }
            $sum_decimal = $sum_decimal + (int)$match_word_seq * (count($this->gojuon) ** (int)$seq);
        }

        return $sum_decimal;
    }

    public function decimal()
    {
        return $this->decimal;
    }
}

$aaa = new Gojuonbase('ああああ');
print_r($aaa->decimal());
