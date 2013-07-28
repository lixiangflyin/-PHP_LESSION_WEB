<?php
/**
http://blog.csdn.net/21aspnet/article/details/6972970
首先，Zend/zend_language_scanner.c 会根据Zend/zend_language_scanner.l(Lex
文件)，来对输入的 PHP代码进行词法分析，从而得到一个一个的“词”，
PHP4.2+开始提供了一个函数叫token_get_all ，
这个函数就可以将一段PHP代码 Scanning成Tokens；
 */

$php_file =
'<?php
echo "Hello World";
$a = 1 + 1;
echo $a;
?>';

//词法分析
$tokens = token_get_all($php_file);

var_dump($tokens);