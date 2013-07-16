<?php
//抓取页面的内容
require_once 'NetUtil.php';

$html = NetUtil::cURLHTTPGet('http://mp3.sogou.com/music.so?query=love');

preg_match_all('/<tr\sid="musicmc_\d*".*>.*<\/td>/',$html,$matches, PREG_PATTERN_ORDER);


foreach ($matches[0] as $str)
{
	echo $str . '</br>';
}