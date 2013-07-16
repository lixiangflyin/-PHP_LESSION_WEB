<?php
$str = 'English';
echo mb_detect_encoding($str);//ASCII

$str2 = '中文';
echo mb_detect_encoding($str2);//UTF-8

/**
(因为ASCII表示英文的时候,与UTF-8是兼容的,故可以说PHP是用统一用UTF-8编码的)
 */
?>
