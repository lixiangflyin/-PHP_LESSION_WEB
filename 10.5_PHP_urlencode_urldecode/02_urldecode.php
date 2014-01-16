<?php

$url_enc = 'http%3A%2F%2Fwww.nowamagic.net%2F%E4%B8%AD%E6%96%87.rar';

//解码
$url = urldecode($url_enc);  //'http://www.nowamagic.net/中文.rar'

var_dump($url);

