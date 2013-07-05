<?php

/*错误码定义
300:product_id不合法
301:详情类型不合法
302:新product detail为空
303:更新记录影响条数错误
*/


class IProductDetail
{
	public static $errCode = 0;
	public static $errMsg = '';

	//type=0，删除本产品对应的所有详细记录
	public static function delete($product_id, $type = 0)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		if (!isset($type) || $type < 0 || $type > 4) {
			self::$errCode = 301;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "type($type) is invalid";
			return false;
		}

		$types = array();
		if ($type != 0) {
			$types['type'] = $type;
		}

		$ret = IProductDetailTTC::remove(array('product_id'=>$product_id), $types);
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			return false;
		}
		$lines = IProductDetailTTC::getTTCAffectRows();
		if (0 != $type) {
			if (1 != $lines) {
				self::$errCode = 303;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "[delete IProductDetailTTC ($product_id,$type)] affect $lines lines" ;
				return false;
			}
		}else
		{
			if ($lines <= 0) {
				self::$errCode = 303;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "[delete IProductDetailTTC ($product_id,$type)] affect $lines lines" ;
				return false;
			}
		}
		return true;

	}

	public static function modify($product_id, $type, $detail)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		if (!isset($type) || $type < 1 || $type > 4) {
			self::$errCode = 301;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "type($type) is invalid";
			return false;
		}

		if (!isset($detail) || '' == $detail) {
			self::$errCode = 302;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "type($type) is invalid";
			return false;
		}
		$now = time();
		$ret = IProductDetailTTC::update(array('product_id'=>$product_id, 'content'=>$detail, 'updatetime'=>$now), array('type'=>$type));
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			return false;
		}
		$lines = IProductDetailTTC::getTTCAffectRows();
		if (1 != $lines) {
			self::$errCode = 303;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "[update IProductDetailTTC ($product_id,$type)] affect $lines lines" ;
			return false;
		}
		return true;
	}


	public static function add($product_id, $type, $detail)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		if (!isset($type) || $type <= 1 || $type > 4) {
			self::$errCode = 301;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "type($type) is invalid";
			return false;
		}

		if (!isset($detail) || '' == $detail) {
			self::$errCode = 302;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "type($type) is invalid";
			return false;
		}
		$now = time();
		$ret = IProductDetailTTC::insert(array('product_id'=>$product_id, 'type'=>$type, 'content'=>$detail, 'updatetime'=>$now, 'createtime'=>$now));
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			return false;
		}
		return true;
	}

	public static function getIntroduce($product_id)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		$ret = IProductDetailTTC::get($product_id, array('type'=>PRODUCT_DETAIL_INTRODUCE), array('content'));
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			return false;
		}
		return isset($ret[0])? $ret[0]['content'] : "";
	}

	public static function getAll($product_id)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		$ret = IProductDetailTTC::get($product_id, array(), array('type', 'content'));
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			return false;
		}
		return $ret;
	}

	public static function getWarranty($product_id)
	{
		$product_warranty = "";

		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		$ret = IProductDetailTTC::get($product_id, array('type'=>PRODUCT_DETAIL_WARRANTY) ,array('content'));
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			//return false;
			return $product_warranty;
		}
		if(isset($ret[0]))
		{
			$product_warranty = $ret[0]['content'];
		}

		//echo($product_warranty . "\n");

		//ixiuzeng 添加
		$c3_manufacturer_info = IProductCommonInfoTTC::get($product_id, array(), array('c3_ids','manufacturer'));
		if(false === $c3_manufacturer_info || 1 != count($c3_manufacturer_info))
		{
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[ get warranty failed]' . IProductCommonInfoTTC::$errMsg;
			//return false;
			return $product_warranty;
		}
		$c3_ids = $c3_manufacturer_info[0]['c3_ids'];
		$manufacturer = $c3_manufacturer_info[0]['manufacturer'];

		$product_service = IProductServiceTTC::get($manufacturer, array('c3_ids'=>$c3_ids), array('service_des'));
		if(false === $product_service || count($product_service) >1)
		{
			self::$errCode = IProductServiceTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[ get warranty failed]' . IProductServiceTTC::$errMsg;
			//echo(self::$errCode . "\n");
			//echo(self::$errMsg . "\n");
			//var_dump($product_service);
			//return false;
			return $product_warranty;
		}
		if(isset($product_service[0]))
		{
			$product_warranty = "<span style='font-weight:bold;font-size:13px' >".$product_warranty . "</span><br><br>" . self::text2html($product_service[0]['service_des']);
		}

		return $product_warranty;
	}

	public static function getPackingList($product_id)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		$ret = IProductDetailTTC::get($product_id, array('type'=>PRODUCT_DETAIL_PACKINGLIST),array('content'));
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			return false;
		}
		return isset($ret[0])? $ret[0]['content'] : "";
	}

	public static function getParameters($product_id)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 300;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
			return false;
		}

		$ret = IProductDetailTTC::get($product_id, array('type'=>PRODUCT_DETAIL_PARA),array('content'));
		if (false === $ret) {
			self::$errCode = IProductDetailTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IProductDetailTTC failed]' . IProductDetailTTC::$errMsg;
			return false;
		}
		return isset($ret[0])? $ret[0]['content'] : "";
	}

	public static function text2html($txt)
	{
	    $txt = str_replace("  ","　",$txt);
	    //$txt = str_replace("<","&lt;",$txt);
	    //$txt = str_replace(">","&gt;",$txt);
	    $txt = preg_replace("/[\n]{1,}/isU","<br/>\r\n",$txt);
	    return $txt;
	}
}