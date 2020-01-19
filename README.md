# Gojuonbase
五十音進数のClassです。

```sample.php
// 文字列での初期化
$hiragana = new Gojuonbase('なのやつ');
// 数字での初期化
$suuji = new Gojuonbase(2379425);

// 10進数での出力 
var_dump($hiragana->decimal());
var_dump($suuji->decimal());
-> int(2268833)
-> int(2379425)

// 五十音の出力 
var_dump($hiragana->gojuon());
var_dump($suuji->gojuon());
-> string(12) "なのやつ"
-> string(12) "にのやつ"

// 計算
$keisan = $hiragana->decimal() + $suuji->decimal();
$goukei = new Gojuonbase($keisan);
var_dump($goukei->gojuon());
-> string(12) "ろいぬも"
```
