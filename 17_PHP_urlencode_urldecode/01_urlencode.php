<?php
//10.24.68.7:8040/Account/Logon?ReturnUrl=http://zhishi.ecc.com/index.php?c=Base&m=setcookie

$ReturnUrl = urlencode('http://zhishi.ecc.com/index.php?c=Base&m=setcookie');

echo $ReturnUrl;//http%3A%2F%2Fzhishi.ecc.com%2Findex.php%3Fc%3DBase%26m%3Dsetcookie

$orginal_url = urldecode($ReturnUrl);

echo $orginal_url;//http://zhishi.ecc.com/index.php?c=Base&m=setcookie