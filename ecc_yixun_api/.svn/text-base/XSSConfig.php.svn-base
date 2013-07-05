<?php
/**
 * Created by JetBrains PhpStorm.
 * User: clydechang
 * Date: 13-1-10
 * Time: 上午11:08
 * To change this template use File | Settings | File Templates.
 */


if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");

class EA_XSSConfig
{
	private static $para_list = array(
		"buy" => array(
			'order_succ'  => array(
				array(
					'name' => 'order_id',
					'type' => 'int',
					'must' => true,
				),
				array(
					'name' => 'uid',
					'type' => 'int',
					'must' => true,
				),
			),
			'order_new'   => array(
				array(
					'name' => 'receiveAddrDetail',
					'type' => 'address',
					'must' => true,
				),
			),
			'product_603' => array(
				array(
					'name' => 'whId',
					'type' => 'int',
					'must' => true,
				),
				array(
					'name' => 'uid',
					'type' => 'int',
					'must' => true,
				),
				array(
					'name' => 'district',
					'type' => 'int',
					'must' => false,
				),
				array(
					'name' => 'ism',
					'type' => 'int',
					'must' => false,
				),
			)
		)
	);


	/**
	 * 获取需要检查的参数列表
	 * @return array
	 */
	public static function getParaList($sub_domain, $mod, $act)
	{
		$key = "{$mod}_{$act}";
		if (!isset(self::$para_list[$sub_domain][$key])) {
			return array();
		}
		return self::$para_list[$sub_domain][$key];
	}

	public static function checkSelfDefineType($item)
	{

		return true;

	}

}