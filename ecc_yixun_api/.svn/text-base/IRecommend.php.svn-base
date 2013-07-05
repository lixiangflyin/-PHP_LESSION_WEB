<?php
/**
 * 页面推荐商品信息类
 * @author kunjiang
 * @version 1.0
 */

class IRecommend{


	public  $errCode = 0;
	public  $errMsg = '';
	private  $siteId = '';
	private  $channelId = '';
	private  $dataList = array();

	public function __construct($siteId, $channleId){
		global $_WEBSITE_CFG;

		$this->channelID = $channleId;
		$this->siteId = $siteId; //武汉站 - 拉去推荐商品的时候，TTC 不支持3001还。

		if(!isset($_WEBSITE_CFG[$siteId])){
			$this->errCode = 100;
			$this->errMsg = "site_id is invalide - " . $siteId;
			return;
		}

		IIndex::setDataBase("ERP_" . $siteId);
		$this->dataList = $this->getRecommendProducts($channleId);
	}

	//推荐商品
	private function getRecommendProducts($channelID, $placeID = '', $count = 0){
		return IIndex::getRecommendProducts($this->siteId, $channelID, $placeID, $count);
		/*
		global $_StockTips, $_WEBSITE_CFG;

		$dbName = $_WEBSITE_CFG[$this->siteId]['connectionName'];
		$msSQL = Config::getMSDB($dbName);
		if( false === $msSQL ){
			$this->errCode = Config::$errCode;
			$this->errMsg = Config::$errMsg;
			return false;
		}


		$sqlCount = empty($count) ? '' : ( 'top ' . ( $count + 10 )  . ' ');
		$channelID = empty($channelID) ? '' : ( " AND C.channelID in ('" . ( is_array($channelID) ? implode("','", $channelID)  :   $channelID ) . "')" );
		$placeID = empty($placeID) ? '' : ( " AND B.placeID in('" . ( is_array($placeID) ? implode("','", $placeID) : $placeID ) . "')" );

		//promo_name 首页显示商品名字； promo_intro 首页显示商品介绍
		$sql = "SELECT $sqlCount
							C.channelID as channel_id,
							B.PLACEID as place_id,
							A.ProductHomePageName AS promo_name,
							A.ProductPromotion AS promo_intro,
							Isnull(D.ReviewStart, 0) score,
							Isnull(D.ReviewCount, 0) review_count,
							D.ProductSaleType AS sale_type,
							A.PRODUCTSYSNO AS product_id,
							B.PlaceName
				FROM RECOMMENDPRODUCT AS A,
							RECOMMENDPRODUCT_PLACE AS B,
							RECOMMENDPRODUCT_CHANNEL AS C,
							PRODUCT AS D
					WHERE B.CHANNELSYSNO = C.SYSNO
						AND A.PLACESYSNO = B.SYSNO
						AND B.STATUS = 0 AND C.STATUS = 0
						AND D.SYSNO = A.PRODUCTSYSNO
						AND D.Status = 1
						$channelID
						$placeID
				ORDER BY A.SORTNUM ASC";

		$list = $msSQL->getRows($sql);
		if (false === $list) {
			$this->errCode = $msSQL->errCode;
			$this->errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "getRows  faild " . $msSQL->errMsg;
			return false;
		}
		if(empty($list)){
			return array();
		}

		$product_ids = array();
		foreach($list as $item){
			$product_ids[] = $item['product_id'];
		}

		$whInfo = IProduct::getProductsInfo($product_ids, $this->siteId);
		if( false === $whInfo ){
			$this->errCode = IProduct::$errCode;
			$this->errMsg = IProduct::$errMsg;
			return false;
		}
		if(empty($whInfo)){
			return array();
		}

		$ret = array();
		foreach($list as $item){
			$product_id = $item['product_id'];

			if(!isset($whInfo[$product_id])){
				continue;
			}

			$wi = $whInfo[$product_id];
			if( $wi['status'] != PRODUCT_STATUS_NORMAL || $wi['stock'] == $_StockTips['not_available']){
				continue;
			}

			$giftInfo = IProduct::getGift($product_id, $this->siteId);
			if( false === $giftInfo ){
				self::$errCode = IProduct::$errCode;
				self::$errMsg = IProduct::$errMsg;
				return false;
			}

			$ret[] = array_merge($wi, $item,  array('gift_count' => count($giftInfo)));
		}

		return empty($count) ? $ret : array_slice($ret, 0, $count);*/
	}

	public function filter($placeId = '', $count = 0) {
		$ret = array();

		if (!empty($this->dataList)) {
			$index = 0;

			foreach ($this->dataList as $item) {
				if (isset($item['place_id']) && $item['place_id'] == $placeId) {
					if (!empty($count) && $index >= $count) {
						break;
					}

					$ret[$index++] = $item;
				}
			}
		}

		return $ret;
	}
}
