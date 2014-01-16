<?php
/**
urlencode函数将传入的字符串参数进行URL编码。其返回的字符串中除了“ˉ—.”之外，
所有非字母数字字符都被替换成百分号（%）后跟两位十六进制数，空格则编码为加号（+）。
PS: php的urlencode是基于UTF-8的
 */
$url = 'http://www.nowamagic.net/中文.rar';

//编码
$url_enc = urlencode($url);//"http%3A%2F%2Fwww.nowamagic.net%2F%E4%B8%AD%E6%96%87.rar"

var_dump($url_enc);

