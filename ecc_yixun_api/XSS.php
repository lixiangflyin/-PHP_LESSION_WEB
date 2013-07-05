<?php
/**
 * Created by JetBrains PhpStorm.
 * User: clydechang
 * Date: 13-1-10
 * Time: 上午10:55
 * To change this template use File | Settings | File Templates.
 */

if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");

class EA_XSS
{
	private $sub_domain;

	private $mod;

	private $act;

	protected $data;

	private $baseType;

	public $errCode;

	public $errMsg;


	public function __construct($params)
	{
		// 二级域名
		$this->sub_domain = $params['sub_domain'];

		// 模块
		$this->mod = $params['mod'];

		// action
		if ($this->mod == "product" && !empty($params['cmd'])) {
			// buy中的product采用的是cmd方式表示具体调用的act
			$this->act = $params['cmd'];
		} else {
			// 其余采用 mod + act的方式
			$this->act = $params['act'];
		}

		unset($params['mod']);
		unset($params['act']);

		$this->data = $params;

		$this->baseType = array(
			'int',
			'url',
			'address',
		);
	}

	public function Init($params)
	{

	}

	public function checkPara()
	{
		// 对于每一个mod_act，读取出需要检查的参数列表
		$para_list = EA_XSSConfig::getParaList($this->sub_domain, $this->mod, $this->act);
		if (!empty($para_list)) {
			// 没有配置，直接放过
			return true;
		}

		// 检查每一个参数的值
		foreach ($para_list as $item) {
			if (!isset($this->data[$item['name']])) {
				if (false === $item['must']) {
					// 不是必须存在的参数，则放过
					continue;
				} else {
					$this->errCode = -4;
					$this->errMsg = "{$item['name']}必须存在";
					return false;
				}
			}

			// 开始检查，一旦有参数检查错，则返回错误码和错误信息
			$ret = $this->check($item);
			if ($ret === false) {
				return false;
			}
		}

		return true;
	}

	private function check($item)
	{
		// 如果有自定义的检查函数，则调用该函数检查
		if (!in_array($item['type'], $this->baseType)) {
			// 不在基本数据类型里面的，都属于自定义类型，需要在EA_XSSConfig中写自定义函数来检查

			$ret = EA_XSSConfig::checkSelfDefineType($item);
			return $ret;

		}

		// 没有的话，按照默认的配置检查
		switch ($item['type']) {
			case "int":
				$ret = self::baseIntCheck($item);
				break;
			case "url":
				$ret = self::baseUrlCheck($item);
				break;
			case "address":
				$ret = self::baseAddressCheck($item);
				break;
			default:
				$ret = false;
		}

		return $ret;
	}

	private function baseIntCheck($item)
	{
		if (!ToolUtil::checkInt($this->data[$item['name']])) {
			$this->errCode = -1;
			$this->errMsg = "{$item['name']}必须是整数";
			return false;
		}
		return true;
	}

	private function baseUrlCheck($item)
	{
		if (!ToolUtil::checkURL($this->data[$item['name']])) {
			$this->errCode = -2;
			$this->errMsg = "{$item['name']}不符合URL规则";
			return false;
		}
		return true;
	}

	private function baseAddressCheck($item)
	{
		if (!ToolUtil::checkAddress($this->data[$item['name']])) {
			$this->errCode = -3;
			$this->errMsg = "{$item['name']}地址不合法";
			return false;
		}
		return true;
	}
}

