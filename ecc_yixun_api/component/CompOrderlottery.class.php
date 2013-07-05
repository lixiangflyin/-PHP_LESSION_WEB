<?php
class CompOrderlottery
{
	public static function getConfig($id, $aid) {
		$url = 'http://event.51buy.com/json.php?mod=lotteryge&act=order&sn=' . $aid . '&order_id=';
		return $url;
	}
}