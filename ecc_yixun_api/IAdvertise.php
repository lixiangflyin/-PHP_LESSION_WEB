<?php
/**
 * 页面获得频道广告信息类
 * @author kunjiang
 * @version 1.0
 */
class IAdvertise {
	public  $errCode = 0;
	public  $errMsg = '';

	private  $siteId = '';
	private  $channelId = '';
	private  $placeId = '';

	private  $dataList = array();

    private static $PLACE_TO_YTAG = array(
        'index' => array(
            'top-brand'             => 21000,
            'like_4'                => 21100,
            'mobile-4'              => 21200,
            'mobile-yi'             => 21300,
            'mobile-left'           => 21400,
            'mobile-brand'          => 21500,
            'notebook-4'            => 21600,
            'notebook-yi'           => 21700,
            'notebook-left'         => 21800,
            'notebook-right'        => 21900,
            'notebook-brand'        => 22000,
            'household-4'           => 22100,
            'household-yi'          => 22200,
            'household-left'        => 22300,
            'household-right'       => 22400,
            'household-brand'       => 22500,
            'auto-left'             => 22600,
            'auto-brand'            => 22700,
            'daily-left'            => 22800,
            'daily-brand'           => 22900,
            'discount'              => 23000,
            'new_product'           => 23100,
            'mobile'                => 23200,
            'notebook'              => 23300,
            'household'             => 23400,
            'auto'                  => 23500,
            'daily'                 => 23600,
			'floor-B&F-B'			=> 23700,
			'floor-B&F-L'			=> 23800,
			'bus-comm'				=> 23900,
        ),
    );

	public function __construct($siteId, $channleId, $placeId=NULL) {
		global $_WEBSITE_CFG;

		$this->siteId = $siteId; //分站ID
		$this->channelId = $channleId; //广告频道
		$this->placeId = $placeId; //广告位ID

		if (!isset($_WEBSITE_CFG[$siteId])) {
			$this->errCode = 100;
			$this->errMsg = "site_id is invalide - " . $siteId;
			return;
		}

		$this->dataList = &$this->getAdvertise($this->channelId, $this->placeId);
	}

	//广告位
	private function getAdvertise($channelID, $placeID='') {
		global $_IP_CFG, $_WEBSITE_CFG;

		$dbName = $_WEBSITE_CFG[$this->siteId]['connectionName'];

		$msSQL = Config::getMSDB($dbName);

		if ( false === $msSQL ) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		$channelID = empty($channelID) ? '' : ( " AND A.channelID in ('" . ( is_array($channelID) ? implode("','", $channelID)  :   $channelID ) . "')" );
		$placeID = empty($placeID) ? '' : ( " AND B.placeID in('" . ( is_array($placeID) ? implode("','", $placeID) : $placeID ) . "')" );

		$sql = "SELECT
						C.sysno as id,
						A.channelID as channel_id,
						B.placeID  as place_id,
						C.OPENMODE AS OPENMODE,
						C.ADTITLE AS title,
						C.LINKHREF AS href,
						C.AdImageUrl AS src,
						B.WIDTH as width,
						B.HEIGHT as height,
						C.AdSmallImageUrl AS smallsrc,
						B.SmallWIDTH as smallwidth,
						B.SmallHEIGHT as smallheight,
						B.TYPE as type
					FROM Advertising_Channel AS A, Advertising_Place AS B, Advertising_Ad AS C
					WHERE A.SysNo = B.ChannelSysNo
						AND B.SysNo = C.PlaceSysNo
						AND A.Status = 0
						AND B.Status = 0
						AND C.Status = 0
						$channelID
						$placeID
				ORDER BY C.SortNum ASC";

		$list = $msSQL->getRows($sql);

		if (false === $list) {
			$this->errCode = $msSQL->errCode;
			$this->errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "getRows  faild " . $msSQL->errMsg;
			return false;
		}

		$ret = array();
		$srcPre = isset($_IP_CFG['ADVERTISE_PRE'][$dbName]) ? $_IP_CFG['ADVERTISE_PRE'][$dbName] : '';

		foreach($list as $item) {
			$ret[] = array(
				"id" => $item['id'],
				"open_mode" => $item['OPENMODE'],
				"title" => $item['title'],
				"href" => $item['href'],
				"width" => $item['width'],
				"height" => $item['height'],
				"src" => $srcPre . $item['src'],
				"smallwidth" => $item['smallwidth'],
				"smallheight" => $item['smallheight'],
				"smallsrc" => $srcPre . $item['smallsrc'],
				"type" => $item['type'],
				"place_id" => $item["place_id"]
			);
		}

		return 	$ret;
	}

	private function _filter_append_ytag($placeId = '', &$list = array()){
		if (!isset(self::$PLACE_TO_YTAG[$this->channelId])) return;

		if(isset(self::$PLACE_TO_YTAG[$this->channelId][$placeId])){
			$placeYTagConfig = self::$PLACE_TO_YTAG[$this->channelId][$placeId];
			foreach ($list as $i => $item){
				$list[$i]['ytag'] = $placeYTagConfig + $i;
			}
		}
	}

	public function filter($placeId = '', $count = 0) {
		if (!empty($this->dataList)) {
			$ret = array();
			$index = 0;

			foreach($this->dataList as $item) {
				if (isset($item['place_id']) && $item['place_id'] == $placeId) {
					$item['hotName'] = strtoupper("{$this->channelId}I.{$placeId}___{$this->siteId}___{$index}"); //增加 hotName 属性, 统计点击
					$ret[] = $item;

					if (!empty($count) && ++$index === $count) {
						break;
					}
				}
			}

			self::_filter_append_ytag($placeId, $ret);
			return $ret;
		}

		return array();
	}
}

