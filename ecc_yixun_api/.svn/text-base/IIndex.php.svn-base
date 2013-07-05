<?php

class IIndex {
	public static $errCode = 0;
	public static $errMsg = '';

	public static $dbMap = array();
	public static $dbName = '';
	public static $msSQL = null;
	public static $whId = null;

	private static $isNewDB = true;

	public static function setDataBase($name) {
		$name = str_replace("ERP_BAK_", "ERP_", $name);
		self::$dbName = $name;

		//ixiuzeng添加，多分仓项目中，需要获取分站id
		global $_WEBSITE_CFG;
		foreach($_WEBSITE_CFG as $whInfo)
		{
			if($whInfo['connectionName'] == $name)
			{
				self::$whId = $whInfo['site_id'];
				break;
			}
		}
	}

	public static function init() {
		self::$msSQL = Config::getMSDB(self::$dbName);

		if (false === self::$msSQL) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		return self::$msSQL;
	}

	public static function getCache($key) {
		$ret = IPageCacheTTC::get($key);

		if ($ret === false) {
			self::$errCode = IPageCacheTTC::$errCode ;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "IPageCacheTTC get faild " . IPageCacheTTC::$errMsg;
			return false;
		}

		return count($ret) > 0 ? $ret[0]['content'] : '';
	}

	public static function setCache($key, $value) {
		$v = IPageCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg =  IPageCacheTTC::$errMsg;
			return false;
		}

		$now = time();
		$item = array (
			'cid' => $key,
			'content' => $value,
			'expiretime' => $now+300,
			'updatetime' => $now,
		);

		if (count($v) > 0 ) {
			$v = IPageCacheTTC::update($item);
		}
		else { //尽量原子化
			IPageCacheTTC::remove($key);
			$v = IPageCacheTTC::insert($item);
		}

		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg =  IPageCacheTTC::$errMsg;
			return false;
		}

		return true;
	}

	//查询
	public function getRows($sql) {
		$ret = self::init();
		if (false === $ret) {
			return false;
		}

		$list = self::$msSQL->getRows($sql);
		if (false === $list) {
			self::$errCode = self::$msSQL->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "getRows  faild " . self::$msSQL->errMsg;
			return false;
		}

		return $list;
	}

	//执行
	public function executeSQL($sql) {
		$ret = self::init();

		if (false === $ret) {
			return false;
		}

		$ret = self::$msSQL->execSql($sql);
		if (false === $ret) {
			self::$errCode = self::$msSQL->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "execSql  faild " . self::$msSQL->errMsg;
			return false;
		}

		return self::$msSQL->getAffectedRows();
	}

	//添加投票
	public function addInvestigate($vote_id, $itemIds) {
		if (empty($itemIds)) {
			return false;
		}

		$sql = "UPDATE POLL_ITEM
							SET ITEMCOUNT = ITEMCOUNT + 1
					WHERE POLLSYSNO={$vote_id}
						AND SYSNO IN({$itemIds});
					UPDATE POLL
							SET POLLCOUNT = POLLCOUNT + 1
					WHERE SysNo={$vote_id}";

		return self::executeSQL($sql);
	}

	//查看投票结果
	public function investigateResult($void_id) {
		$sql = "SELECT '1' as newopen,
							A.SYSNO AS POLLID,
							A.POLLNAME,
							A.POLLCOUNT,
							B.ITEMCOUNT,
							B.ITEMNAME
					FROM POLL AS A INNER JOIN POLL_ITEM AS B ON A.SYSNO = B.POLLSYSNO
				WHERE A.STATUS = 0
					AND A.C1SYSNO = 0
					AND A.SYSNO={$void_id}
			ORDER BY A.SYSNO DESC, B.SYSNO DESC";

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		if (count($list) == 0) {
			return array();
		}

		$ret = array(
			'name' => $list[0]['POLLNAME'],
			'total' => $list[0]['POLLCOUNT'],
			'items' => array()
		);
		foreach($list as &$item) {
			$ret['items'][] = array(
				'name' => $item['ITEMNAME'],
				'count' => $item['ITEMCOUNT']
			);
		}
		return $ret;
	}

	//调查
	public function getInvestigateData() {
		$sql = 'SELECT A.SysNo AS POLLID,
							A.POLLNAME,
							B.SYSNO AS ITEMID,
							B.ITEMNAME
					FROM POLL AS A INNER JOIN POLL_ITEM AS B ON A.SYSNO = B.POLLSYSNO
					WHERE A.STATUS = 0
						AND A.C1SYSNO = 0
				ORDER BY A.SYSNO DESC, B.SYSNO DESC';

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		$res = array();
		foreach ($list as $item) {
			if (!isset($res[ $item['POLLID'] ])) {
				$res[ $item['POLLID'] ] = array(
					'minSelect' => 1,
					'id' => $item['POLLID'],
					'question' => $item['POLLNAME'],
					'items' => array()
				);
			}
			$res[ $item['POLLID'] ]['items'][] = array(
				'id' =>  $item['ITEMID'],
				'text' =>  $item['ITEMNAME']
			);
		}

		$ret = array();
		if (!empty($res)) {
			foreach($res as $item);
			$ret[] = $item;
		}

		return 	$ret;
	}

	//广告位
	public static function getAdvertise($channelId, $placeId = '', $count = 0) {
		global $_IP_CFG;

		$channelID = empty($channelId) ? '' : (" AND A.channelID in ('" . (is_array($channelId) ? implode("','", $channelId) : $channelId) . "')");
		$placeID = empty($placeId) ? '' : (" AND B.placeID in('" . (is_array($placeId) ? implode("','", $placeId) : $placeId) . "')");

		$sql = "SELECT
						A.channelID as channel_id,
						B.placeID as place_id,
						C.OPENMODE AS OPENMODE,
						C.ADTITLE AS title, C.LINKHREF AS href,
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

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		$ret = array();
		$srcPre = isset($_IP_CFG['ADVERTISE_PRE'][self::$dbName]) ? $_IP_CFG['ADVERTISE_PRE'][self::$dbName] : '';

		$index = 0;
		foreach($list as $item) {
			$ret[] = array(
				'open_mode' => $item['OPENMODE'],
				'title' => $item['title'],
				'href' => $item['href'],
				'width' => $item['width'],
				'height' => $item['height'],
				'src' => $srcPre . $item['src'],
				'smallwidth' => $item['smallwidth'],
				'smallheight' => $item['smallheight'],
				'smallsrc' => $srcPre . $item['smallsrc'],
				'type' => $item['type'],
				'place_id' => $item['place_id']
			);

			if ($count != 0) {
				if (++$index == $count) {
					break;
				}
			}
		}

		$realCt = count($ret);

		return 	$ret;
	}

	public function mapMultiSliceSlide($item) {
		global $_IP_CFG;
		$srcPre = isset($_IP_CFG['ADVERTISE_PRE'][self::$dbName]) ? $_IP_CFG['ADVERTISE_PRE'][self::$dbName] : '';

		$ret = array(
			'surl' => $srcPre . $item['surl'],
			'swidth' => $item['swidth'],
			'sheight' => $item['sheight'],
			'open_mode' => $item['OPENMODE'],
			'title' => $item['title'],
			'href' => $item['href'],
			'src' => $srcPre . $item['src'],
			'width' => $item['width'],
			'height' => $item['height'],
			'type' => $item['type'],
			'hotName' => 'NA',
		);

		return 	$ret;
	}

	/**
	 *
	 * 轮播一帧多图
	 * 每一帧用一个频道标识，slideplay-x (slideplay-0, slideplay-1, slideplay-2, ...)
	 * 帧内图片位标识：block/left/middle-top/middle-bottom/middle-block/right-block/right-top/right-bottom/top-bock/bottom-block
	 * 组合情况：
	 * 1. block
	 * 2. left / middle-block / right-block
	 * 3. left / middle-top   / middle-bottom / right-block
	 * 4. left / middle-block / right-top     / right-bottom
	 * 5. left / top-bock     / middle-bottom / right-bottom
	 * 6. left / middle-top   / right-top     / bottom-bock
	 * 7. left / top-bock     / bottom-bock
	 * 8. left / middle-top   / middle-bottom / right-top    / right-bottom
	 * @param $count
	 * @param $isWuhan 武汉站与上海站共用ERP，如果广告标题以'-上海'结尾, 则不显示在武汉站
	 */
	public function getMultiSliceSlide($count = 6, $isWuhan = false) {
		$ret = array();
		$slideBitmap = array();
		$channelPrefix = 'slideplay-';
		$channelID = '';
		$filterForWuhan = $isWuhan ? "AND C.ADTITLE NOT LIKE '%-上海'" : '';
		$i = 0;
		$j = 0;

		$matchConfig = array(
						5 => array('block'),
						1 => array('left', 'middle-block', 'right-block'),
						3 => array('left', 'middle-block', 'right-top',     'right-bottom'),
						2 => array('left', 'top-block',    'middle-bottom', 'right-bottom'),
						0 => array('left', 'middle-top',   'right-top',     'bottom-block'),
						4 => array('left', 'middle-top',   'right-top',     'middle-bottom', 'right-bottom')
						//3 => array('left', 'middle-top',   'middle-bottom', 'right-block'),
						//6 => array('left', 'top-block',     'bottom-block')
					);

		for ($i = 0; $i < $count; $i++) {
			$channelID = $channelPrefix . $i;

			$sql = "SELECT C.AdSmallImageUrl as surl,
									B.placeID as placeID,
									B.SmallWidth as swidth,
									B.SmallHeight as sheight,
									C.OPENMODE AS OPENMODE,
									C.ADTITLE AS title,
									C.LINKHREF AS href,
									C.AdImageUrl AS src,
									B.WIDTH as width,
									B.HEIGHT as height,
									B.TYPE as type
						FROM Advertising_Channel AS A, Advertising_Place AS B, Advertising_Ad AS C
					WHERE A.SysNo = B.ChannelSysNo
						AND B.SysNo = C.PlaceSysNo
						AND A.Status = 0 AND B.Status = 0
						AND C.Status = 0
						AND A.channelID = '{$channelID}' {$filterForWuhan}
				ORDER BY C.SortNum ASC";

			// 一次拉取本帧所有广告位
			$list = self::getRows($sql);
			if (empty($list)) {
				continue;
			}

			// 按位标识填充
			$slideBitmap = array();
			foreach ($list as $item) {
				if (isset($item['placeID']) && !isset($slideBitmap[$item['placeID']])) {
					$slideBitmap[$item['placeID']] = $item;
				}
			}

			// 寻找匹配的广告位匹配模式
			$tmpItem = array();
			foreach ($matchConfig as $matchConfigKey => $matchConfigItem) {
				$matchSuccess = true;
				foreach ($matchConfigItem as $p) {
					if (!isset($slideBitmap[$p])) {
						$matchSuccess = false;
						break;
					}
				}

				if ($matchSuccess) {
					$tmpItem['type'] = $matchConfigKey;
					// 更改key
					$j = 0;
					foreach ($matchConfigItem as $cfgItem) {
						$tmpItem['slice' . $j] = self::mapMultiSliceSlide($slideBitmap[$cfgItem]);
						$j++;
					}

					$ret[] = $tmpItem;
					unset($slideBitmap);
					break;
				}
			}
		}

		// 如果拉不到多图多链接数据，拉取老的广告位
		$lackCount = $count - count($ret);
		$tmpItem = array();
		if ($lackCount > 0) {
			$oldSlideData = self::getSlidePlay(($isWuhan ? 'wuhan' : 'index'), 'slide_play_new', $lackCount);
			if (!empty($oldSlideData)) {
				foreach ($oldSlideData as $oldItem) {
					$tmpItem['type'] = 5;
					$tmpItem['slice0'] = $oldItem;
					$ret[] = $tmpItem;
				}
			}
		}
		//echo 'getslide:';
		//var_export($ret);
		return $ret;
	}

	//轮播
	public function getSlidePlay($channelID, $placeID, $count = 12) {
		global $_IP_CFG;
		$sql = "SELECT C.AdSmallImageUrl as surl,
								B.SmallWidth as swidth,
								B.SmallHeight as sheight,
								C.OPENMODE AS OPENMODE,
								C.ADTITLE AS title,
								C.LINKHREF AS href,
								C.AdImageUrl AS src,
								B.WIDTH as width,
								B.HEIGHT as height,
								B.TYPE as type
					FROM Advertising_Channel AS A, Advertising_Place AS B, Advertising_Ad AS C
				WHERE A.SysNo = B.ChannelSysNo
					AND B.SysNo = C.PlaceSysNo
					AND A.Status = 0 AND B.Status = 0
					AND C.Status = 0
					AND B.placeID = '{$placeID}'
					AND A.channelID = '{$channelID}'
			ORDER BY C.SortNum ASC";

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		$ret = array();
		$srcPre = isset($_IP_CFG['ADVERTISE_PRE'][self::$dbName]) ? $_IP_CFG['ADVERTISE_PRE'][self::$dbName] : '';
		$index = 0;
		foreach($list as $item) {
			$ret[] = array(
				'surl' => $srcPre . $item['surl'],
				'swidth' => $item['swidth'],
				'sheight' => $item['sheight'],
				'open_mode' => $item['OPENMODE'],
				'title' => $item['title'],
				'href' => $item['href'],
				'src' => $srcPre . $item['src'],
				'width' => $item['width'],
				'height' => $item['height'],
				'type' => $item['type'],
				'hotName' => "{$channelID}_{$placeID}",
			);

			if (++$index == $count) {
				break;
			}
		}

		$realCt = count($ret);

		return 	$ret;
	}

	//公告列表
	public function getBulletinList($start, $pageSize = 10, $domain=1) {
		$count = $start * $pageSize;
		$sql = "select TOP {$pageSize}
						sysno,
						title,
						Content as content,
						convert(varchar(20),
						rowcreateDate,120) as uptime
					from WebBulletin(nolock)
				where (sysno not in(
								select top {$count} sysno
								from WebBulletin(nolock)
								where status = 0 and Domain={$domain} order by ordernum asc ))
					and Status=0
					and Domain={$domain}
			order by ordernum asc";

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		return 	$list;
	}

	//公告条数
	public function getBulletinCount($domain=1) {
		$sql = "select count(sysno) as count from WebBulletin(nolock) where status = 0 and domain={$domain}";

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		return $list[0]['count'];
	}

	//具体公告
	public function getBulletinInfo($id) {
		$id = $id + 0;

		$sql = "select content from WebBulletin(nolock) where sysno = $id";
		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		return 	$list;
	}


	/**
	 *
	 * 根据大类过滤商品
	 * @param $list
	 * @param $excludeC1Ids 默认排除掉百货、个护类商品
	 * @param $includeC1Ids
	 */
	public function filterProductByC1ID($list, $excludeC1Ids = array(1544, 1545, 1563, 1548, 1721), $includeC1Ids = array()){
		if (empty($list))
			return false;

		$ret = array();
		$c1Id = false;
		foreach ($list as $item){
			$c1Id = IProductRelativity::getC1ByC3Id($item['c3Id']);
			$c1Id = $c1Id[$item['c3Id']];

			if (false == $c1Id) {
				continue;
			}

			if (!empty($excludeC1Ids) && in_array($c1Id, $excludeC1Ids)) {
				continue;
			}

			if (!empty($includeC1Ids) && !in_array($c1Id, $includeC1Ids)) {
				continue;
			}

			$ret[] = $item;
		}

		return $ret;
	}

	//改版之后的获取抢购商品信息的函数
	public function getSaleCountDownInfos($count, $ployType, $str = '', $order = 'ORDER BY SORTNUM DESC') {

		$_backup = self::$dbName;

		if (self::$isNewDB) {
			self::setDataBase("ICSON_Product");
			$siteStr = "SubStationSysNo = " . self::$whId . " AND";
		}
		
		//获取抢购信息
		$sql = "SELECT productsysno, 
					HomeRushTitle as rush_title, 
					CountDownCurrentPrice, 
					CountDownCashRebate, 
					SnapShotCurrentPrice, 
					SnapShotCashRebate, 
					CountDownQty as countDownQty,
					OldQty as countQty,
					CONVERT(varchar, StartTime, 120) as begin_time,
        			CONVERT(varchar, EndTime, 120) as end_time,
        			CONVERT(varchar, rowModifyDate, 120) as modify_time,
        			status
        			FROM Sale_CountDown 
					WHERE {$siteStr} PloyType = {$ployType} {$str} {$order}";
		$rst = self::getRows($sql);

		self::setDataBase($_backup);

		if (false === $rst) {
			return false;
		}

		$productIds = array();
		foreach ($rst as $rt) {
			$productIds[] = $rt['productsysno'];
		}

		if (empty($productIds)) {
			return false;
		}

		//获取商品详细信息
		$scInfos = array();
		$productInfos = IProduct::getProductsInfo($productIds, self::$whId, true);
		$i = 0;
		global $_StockTips;
		foreach ($rst as $rt) {
			if ($i > $count && $count > 0) break;
			$productId = $rt['productsysno'];
			$productInfo = $productInfos[$productId];
			if ($ployType == 5 || $ployType == 4 || $ployType == 6 || $ployType == 7) {
				if ($productInfos[$productId]['status'] != PRODUCT_STATUS_NORMAL ) continue;
			} else {
				if ($productInfos[$productId]['status'] != PRODUCT_STATUS_NORMAL || $productInfos[$productId]['stock'] == $_StockTips['not_available'] ) continue;
			}
			
			$scInfo = array();
			$scInfo['sysno'] = $productId;
			$scInfo['parentProductID'] = 0;
			$scInfo['ProductID'] = $productInfo['product_char_id'];
			$scInfo['ProductName'] = $productInfo['name'];
			$scInfo['c3Id'] = $productInfo['c3_ids'];
			$scInfo['c3id'] = $productInfo['c3_ids'];
			$scInfo['rush_title'] = $rt['rush_title'];
			$scInfo['BriefName'] = $productInfo['name'];
			$scInfo['BasicPrice'] = $productInfo['show_price'];
			$scInfo['CashRebate'] = 0;
			$scInfo['CountDownCurrentPrice'] = $rt['CountDownCurrentPrice'];
			$scInfo['CountDownCashRebate'] = $rt['CountDownCashRebate'];
			$scInfo['SnapShotCurrentPrice'] = $rt['SnapShotCurrentPrice'];
			$scInfo['SnapShotCashRebate'] = $rt['SnapShotCashRebate'];
			$scInfo['icsonprice'] = $rt['CountDownCurrentPrice'] + $rt['CountDownCashRebate'];
			$scInfo['tuanprice'] = $rt['SnapShotCurrentPrice'] + $rt['SnapShotCashRebate'];
			$scInfo['modify_time'] = $rt['modify_time'];
			$scInfo['countDownQty'] = $rt['countDownQty'];
			$scInfo['onlineQty'] = $productInfo['virtual_num'] + $productInfo['num_available'];
			$scInfo['countQty'] = $rt['countQty'];
			$scInfo['ProductSaleType'] = $productInfo['product_sale_type'];
			$scInfo['PromotionWord'] = $productInfo['promotion_word'];
			$result = ICategoryTTC::get($productInfo['c3_ids'], array('level'=>3), array('id', 'parent_id'));
			$scInfo['c2id'] = $result[0]['parent_id'];
			$result = ICategoryTTC::get($scInfo['c2id'] , array('level'=>2), array('id', 'parent_id'));
			$scInfo['c1id'] = $result[0]['parent_id'];
			$scInfo['begin_time'] = $rt['begin_time'];
			$scInfo['end_time'] = $rt['end_time'];
			$scInfo['status'] = $productInfos[$productId]['status'];
			$scInfo['ploy_status'] = $rt['status'];
			$reviews = ToolUtil::gbJsonDecode(IReviews::getProductReviewCount($productId));
			$scInfo['review_count'] = (empty($reviews['total']) ? 0 : $reviews['total']);;
			$scInfos[] = $scInfo;
			$i++;
		}
		return $scInfos;
	}

	/**
	 *
	 * 获取其它抢购数据，用于补充首页抢购数据不足的情况
	 * @param $count 期望获取的数量
	 * @param $ployType 抢购类型
	 *		0:天黑黑-限时抢购
	 *		1:周末清仓
	 *		2:其它
	 *		3:首页抢购
	 *		4:早市-限时抢购
	 *		5:List页团购
	 *		6:早市-特价秒杀
	 *		7:早市-爆款热卖
	 *		8:湖北站-首页抢购
	 *		9:湖北站-早市-特价秒杀
	 *		10:湖北站-早市-爆款热卖
	 *		11:湖北站-早市-限时抢购
	 *		12:天黑黑-爆款热卖
	 * @param $excludeC1Ids 排除所在大类的商品
	 * @param $includeC1Ids 包含于所在大类的商品
	 *
	 * NOTE:
	 *	抢购状态(Sale_CountDown.status)定义
	 *		-2 : 中止
	 *		-1 : 作废
	 *		 0 : 就绪    明日抢购可以是就绪或运行状态
	 *		 1 : 运行    今日抢购必须是运行状态
	 *		 2 : 完成
	 *		 3 : 待审核
	 *
	 *	商品状态(Product.Status)定义
	 *		-1 : Abandon
	 *		 0 : Valid
	 *		 1 : Show   只有此状态的商品才能在前台展示
	 */
	public function getCountDown($count = 6, $ployType = 2, $excludeC1Ids = array(), $includeC1Ids = array()){
		$list = self::getSaleCountDownInfos($count, $ployType);

		$list = self::filterProductByC1ID($list, $excludeC1Ids, $includeC1Ids);

		return $list;
	}

	//抢购
	public function getQiangGou($count = 5, $isHubei = false) {
		$curTime = date('Y-m-d H:i:s');
		$ployType = $isHubei ? 8 : 3; //武汉站

		$str = "AND status = 1";
		$list = self::getSaleCountDownInfos($count, $ployType, $str);

		// 如果首页抢购数据不足，用其它抢购补充
		$lackNum = $count - count($list);
		if ($lackNum > 0){
			$otherQiangGou = self::getCountDown($lackNum);
			if ($otherQiangGou) {
				$list = array_merge($list, $otherQiangGou);
			}
		}

		$ret = array();
		if (!empty($list)) {
			foreach($list as $item) {
				$ret[] = array(
					'product_id' => $item['sysno'],
					'parent_product_id' => $item['parentProductID'],
					'product_char_id' => $item['ProductID'],
					'name' => empty($item['rush_title'])?  $item['ProductName'] : $item['rush_title'],
					'product_name' => $item['ProductName'],
					'brief_name' => $item['BriefName'],
					'market_price' => $item['BasicPrice'],
					'show_price' => $item['CountDownCurrentPrice'] + $item['CountDownCashRebate'],
					'snap_price' => $item['SnapShotCurrentPrice'] + $item['SnapShotCashRebate'],
					'online_qty' => $item['onlineQty'],
					'old_qty' => $item['countDownQty']
				);
			}
		}

		return $ret;
	}

	//明日抢购
	public function getQiangGouTomorrow($count = 5, $isHubei = false) {
		// 0~9点下期抢购时间为今日九点到明日九点
		$hour = date('G');
		if (($hour >= '0') && ($hour < '9'))
		{
			$tomorrowTime = date('Y-m-d 09:00:00', time()); //今日九时
			$dayAfterTomorrowTime = date('Y-m-d 09:00:00', time()+86400); //明日九时
		}
		else
		{
			$tomorrowTime = date('Y-m-d 09:00:00', time()+86400); //明日九时
			$dayAfterTomorrowTime = date('Y-m-d 09:00:00', time()+172800); //后日九时
		}

		$ployType = $isHubei ? 8 : 3; //武汉站

		$str = "AND status in (0, 1) and StartTime<='{$tomorrowTime}'	and EndTime >= '{$dayAfterTomorrowTime}'";
		$list = self::getSaleCountDownInfos($count, $ployType, $str);

		$ret = array();
		if (!empty($list)) {
			foreach($list as $item) {
				$ret[] = array(
					'product_id' => $item['sysno'],
					'parent_product_id' => $item['parentProductID'],
					'product_char_id' => $item['ProductID'],
					'name' => empty($item['rush_title'])?  $item['ProductName'] : $item['rush_title'],
					'product_name' => $item['ProductName'],
					'brief_name' => $item['BriefName'],
					'market_price' => $item['BasicPrice'],
					'show_price' => $item['CountDownCurrentPrice'] + $item['CountDownCashRebate'],
					'snap_price' => $item['SnapShotCurrentPrice'] + $item['SnapShotCashRebate'],
					'online_qty' => $item['onlineQty'],
					'old_qty' => $item['countDownQty']
				);
			}
		}

		return $ret;
	}

	//推荐商品
	public static function getRecommendProducts($whId, $channelId, $placeId = '', $count = 0) {
		global $_StockTips;

		$channelID = empty($channelId) ? '' : (" AND C.channelID in ('" . (is_array($channelId) ? implode("','", $channelId)  :   $channelId) . "')");
		$placeID = empty($placeId) ? '' : (" AND B.placeID in('" . (is_array($placeId) ? implode("','", $placeId) : $placeId) . "')");

		$sql = "SELECT C.channelID as channel_id,
						B.PLACEID as place_id,
						A.PRODUCTSYSNO AS product_id,
						B.PlaceName,
						A.ProductHomePageName AS promo_name,
						A.ProductPromotion AS promo_intro
					FROM RECOMMENDPRODUCT AS A, 
							RECOMMENDPRODUCT_PLACE AS B, 
							RECOMMENDPRODUCT_CHANNEL AS C
				WHERE B.CHANNELSYSNO = C.SYSNO
					AND A.PLACESYSNO = B.SYSNO
					AND  B.STATUS = 0 AND C.STATUS = 0
					$channelID
					$placeID
			ORDER BY A.SORTNUM ASC";

		$rst = self::getRows($sql);
		if (false === $rst) {
			return false;
		}

		$productIds = array();
		foreach($rst as $item) {
			$productIds[] = $item['product_id'];
		}

		$productInfos = IProduct::getProductsInfo($productIds, $whId);
		if (false === $productInfos) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = IProduct::$errMsg;
			return false;
		}

		$lists = array();
		$i = 0;
		foreach ($rst as $rt) {
			if ($i > $count && $count > 0) break;
			$list = array();
			$productId = $rt['product_id'];
			if ($productInfos[$productId]['status'] != PRODUCT_STATUS_NORMAL || $productInfos[$productId]['stock'] == $_StockTips['not_available'] ) continue;
			$list['channel_id'] = $rt['channel_id'];
			$list['place_id'] = $rt['place_id'];
			$reviews = ToolUtil::gbJsonDecode(IReviews::getProductsReviewCount(array($productId)));
			$list['score'] = (isset($reviews) && $reviews[$productId]['experience_number'] != 0) ? ($reviews[$productId]['satisfaction'] / $reviews[$productId]['experience_number']) : 0;
			$list['review_count'] = (empty($reviews[$productId]['total']) ? 0 : $reviews[$productId]['total']);;
			$list['sale_type'] = $productInfos[$productId]['product_sale_type'];
			$list['product_id'] = $productId;
			$list['PlaceName'] = $rt['PlaceName'];
			$list['promo_name'] = $rt['promo_name'];
			$list['promo_intro'] = $rt['promo_intro'];

            foreach ($productInfos[$productId] as $key => $value) {
                $list[$key] = $value;
            }
			$giftInfo = IProduct::getGift($productId, $whId);
			if (false === $giftInfo) {
				self::$errCode = IProduct::$errCode;
				self::$errMsg = IProduct::$errMsg;
				return false;
			}

			foreach($giftInfo as $key => $gift) {
				//滤去组件
				if ($gift['type'] === 1) {
					unset($giftInfo[$key]);
				}
			}

			$list['gift_count'] = count($giftInfo);

			$lists[] = $list;
			$i++;
		}

		return empty($count) ? $lists : array_slice($lists, 0, $count);
	}

	//热门关键字
	public function getIasConfig($key) {
		$sql = "SELECT Content as html FROM dbo.Config WHERE keypage='" . $key . "' AND status=1";
		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		return !empty($list) ? $list[0]['html'] : '';
	}

	//专题列表
	public function getArticleList($start, $pageSize = 10) {

		$sql = "select * from (select top " . (($start + 1) * $pageSize) . " sysno as id, question as title, answer  as content, convert(varchar(20),createtime,120) as uptime,viewcount,  ROW_NUMBER() OVER (order by OrderNum desc) as row from  qa(nolock) where status =0) as A where row > " . ($start * $pageSize);

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}
		return  $list;
	}

	public function getQuestionList($condtion, $start = 0, $pageSize = 5) {
		$sql = "select top  " . (($start + 1) * $pageSize) . " * from (select  B.Question as title, B.SysNo as id, ROW_NUMBER() OVER (order by A.createtime desc) as row  from OnlineListQA AS A inner join QA AS B ON A.QASYSNO = B.SysNo " . (empty($condtion) ? "" : (" where " . $condtion)) . ") as a where row > " . ($start * $pageSize);
		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}
		return  $list;
	}

	//专题条数
	public function getArticleCount() {
		$sql = "select count(sysno) as count  from  qa(nolock)  where  status=0";
		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}
		return  $list[0]['count'];
	}

	//专题
	public function getAritlce($id) {
		$id = $id + 0;
		$sql = "select sysno as id, question as title, answer  as content, convert(varchar(20),createtime,120) as uptime,viewcount  from  qa(nolock)  where  sysno=$id";
		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}
		return  $list;
	}

	public static function getHotCommentProducts($wh_id, $c3idorc2id, $count) {
		if(is_array($c3idorc2id) ){
			$c2id = implode(',', $c3idorc2id);
			$cond = 'c2.C2ID in( '.$c2id .')';
		}else{
			$c3id = $c3idorc2id + 0;
			$cond = 'c2.c1sysno ='.$c3id;
		}

		$_backup = self::$dbName;

		self::setDataBase("ERP_1");

		$sql = "SELECT TOP 30
							product.sysno AS product_id,
							rm.content1 review_title,
							rm.NickName AS nick_name,
							Isnull(Product.ReviewStart,0) score,
							Isnull(Product.ReviewCount,0) review_count
					FROM Review_master rm(nolock)
			LEFT JOIN product(nolock) ON ReferenceSysno=product.sysno
			LEFT JOIN category3 c3(nolock) ON c3.sysno=product.c3sysno
			LEFT JOIN category2 c2(nolock) ON c2.sysno=c3.c2sysno
				WHERE {$cond}
					AND rm.isgood=1
					AND rm.status<> -2
					AND product.status=1
			ORDER BY rm.LastEditDate DESC";
		
		
		$reviews = self::getRows($sql);
		
		if (false === $reviews) {
			return false;
		}

		$result = array();
		$product_ids = array();
		foreach($reviews as $review) {
			$product_ids[] = $review['product_id'];
			$result[$review['product_id']] = $review;
		}

		$products = IProduct::getProductsInfo($product_ids, $wh_id);
		if (false === $products) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = IProduct::$errMsg;
			return false;
		}

		$ret = array();
		foreach($products as &$product) {
			$product_id = $product['product_id'];

			if (isset($result[$product_id]) && $product['status'] === 1) {
				if (count($ret) == $count) {
					break;
				}
				$tmpRet = IReviews::getProductReviewProperty($product_id, false);
				if ($tmpRet == false) {
					self::$errCode = IReviews::$errCode;
					self::$errMsg = IReviews::$errMsg;
					return false;
				}

				$result['review'] = $tmpRet;
				if ($tmpRet['experience_number'] != 0) {
					$result[$product_id]['score'] = $tmpRet['satisfaction'] / $tmpRet['experience_number'];
				}
				else {
					$result[$product_id]['score'] = 0;
				}

				$ret[] = array_merge($product, $result[$product_id]);
			}
		}

		self::setDataBase($_backup);

		$realCt = count($ret);

		return $ret;
	}

	// 热销榜，直接取db
	public static function getSideSaleTop($wh_id, $c3ids = array(), $c2ids = array(), $c1ids = array(), $num = 10) {
		//@TODO 重庆站暂时取上海站的热销榜
		if ($wh_id == 4001 || $wh_id == 3001 || $wh_id == 5001) {
			$wh_id = 1;
		}
		$where = "ptype=0 and state=1 AND wh_id={$wh_id}";
		$cateWhere = array();
		if (!empty($c3ids)) {
			$cateWhere[] = "cate3 in (" . implode(",", $c3ids) . ")";
		}

		if (!empty($c2ids)) {
			$cateWhere[] = "cate2 in (" . implode(",", $c2ids) . ")";
		}

		if (!empty($c1ids)) {
			$cateWhere[] = "cate1 in (" . implode(",", $c1ids) . ")";
		}

		if (!empty($cateWhere)) {
			$where .= " AND (" . implode(" OR ", $cateWhere) . ")";
		}

		$where .= " ORDER BY w1 DESC";
		$idList = IProductHeapListDao::getRows(array('distinct prod_id'), $where, 0, $num);
		if ($idList === false) {
			self::$errCode = 11;
			self::$errMsg = "IProductHeapListDao::getRows error: " . IProductHeapListDao::$errCode . "; " . IProductHeapListDao::$errMsg;
			return false;
		}

		$sideHotSell = array();
		$items = array();
		foreach ($idList as $v) {
			$items[] = $v['prod_id'];
		}

		if (!empty($items)) {
			$sideHotSell = IProduct::getProductsInfo($items, $wh_id);
			if ($sideHotSell === false) {
				self::$errCode = 12;
				self::$errMsg = "IProduct::getProductsInfo error: " . IProduct::$errCode . "; " . IProduct::$errMsg;
				return false;
			}
		}

		return $sideHotSell;
	}

	// public static function getNewestProduct($wh_id, $num = 5) {
	// 	$num -= 0;
	// 	if ($num <= 0) $num = 5;

	// 	$pTime = date('Y-m-d H:i:s', time() - 1800);
	// 	$idList = self::getRows("SELECT TOP $num SysNo FROM Product WHERE SysNo IN (
	// 			SELECT MAX(a.SysNo) FROM Product a LEFT JOIN Category3 b ON a.C3SysNo=b.SysNo LEFT JOIN Category2 c ON b.C2SysNo=c.SysNo LEFT JOIN Category1 d ON c.C1SysNo=d.SysNo WHERE d.Status=0 AND a.Status=1 AND a.ProductType=0 AND a.CreateTime<='$pTime' GROUP BY c.C1SysNo
	// 		) ORDER BY CreateTime DESC");

	// 	if ($idList === false) {
	// 		return false;
	// 	}

	// 	$items = array();
	// 	foreach ($idList as $v) {
	// 		$items[] = $v['SysNo'];
	// 	}

	// 	$newestProduct = array();
	// 	if (!empty($items)) {
	// 		$newestProduct = IProduct::getProductsInfo($items, $wh_id);
	// 		if ($newestProduct === false) {
	// 			self::$errCode = 12;
	// 			self::$errMsg = "IProduct::getProductsInfo error: " . IProduct::$errCode . "; " . IProduct::$errMsg;
	// 			return false;
	// 		}
	// 	}

	// 	return $newestProduct;
	// }

	public static function getBuyCount($ids, $begin, $end, $new = false) {
		// 客服系统解耦，修改了数据库
		self::$dbName = 'SO_BAK';
		$site_cond = " and b.SiteNo='" . self::$whId . "' ";
		
		if ($new) {
			$sql = "select ProductSysNo, quantity from so_item where ProductSysNo in (" . implode($ids, ",") . ") and rowCreateDate  >='{$begin}' and  rowCreateDate  <='$end';";
			$lists = self::getRows($sql);
			$ret = array();
			foreach ($lists as $lt) {
				$productId = $lt['ProductSysNo'];
				$total = $lt['quantity'];
				if (!isset($ret[$productId])) {
					$ret[$productId] = $total;
				} else {
					$ret[$productId] = $ret[$productId] + $total;
				}
			}

			$rst = array();
			foreach ($ids as $id) {
				$rt['product_id'] = $id;
				$rt['total'] = (isset($ret[$id]) ? $ret[$id] : 0);
				$rst[] = $rt;
			}
			return $rst;

		}

		$sql = "select a.ProductSysNo as product_id, sum(a.quantity) as total from so_item as a , so_master  as b where a.sosysno  = b.sysno and a.ProductSysNo  in(". implode($ids, ',')  . ")   and b.orderdate >='$begin' and b.orderdate <='$end' $site_cond GROUP by  a.ProductSysNo";
		$i = 0;
		do {
			if ($i > 9) break;
			if ($i > 0) sleep(20);
			$list = self::getRows($sql);
			$i++;
		} while ($list === false);

		if( false === $list){
			return false;
		}

		$ret = array();
		if(!empty($list)){
			$ret = $list;
		}

		Global $_OrderState;
		$sql = "select a.ProductSysNo as product_id, sum(a.quantity) as total from so_item as a , so_master  as b where a.sosysno  = b.sysno and a.ProductSysNo  in(". implode($ids, ',')  . ")   and b.orderdate >='$begin' and b.orderdate <='$end' and b.Status = " . $_OrderState['OutStock']['value']  . " $site_cond GROUP by  a.ProductSysNo";
		$i = 0;
		do {
			if ($i > 9) break;
			if ($i > 0) sleep(20);
			$list = self::getRows($sql);
			$i++;
		} while ($list === false);

		if( false === $list){
			return false;
		}

		$i = 0;
		foreach ($ret as $rt) {
			$ret[$i]['total_out'] = (isset($list[$i]['total']) ? $list[$i]['total'] : $ret[$i]['total']);
			$i++;
		}
		return $ret;
	}

	public static function getQty($ids) {
		/* $sql = "select (inventory.AvailableQty + inventory.VirtualQty) as onlineQty, SysNo from Inventory where SysNo IN(". implode($ids, ',')  . ");";
		$list = self::getRows($sql);
		if( false === $list){
			return false;
		}

		$ret = array();
		if(!empty($list)){
			$ret = $list;
		}
		 */

		//ixiuzeng添加，多分仓项目中，获取库存的逻辑
		$ret = array();
		$productsInventoryInfo = IProductInventory::getProductsInventeory(array_unique($ids), self::$whId);
		if (false === $productsInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;

			foreach ($ids as $key => $id)
			{
				$ret[$key]['onlineQty'] = 0;
				$ret[$key]['SysNo'] = $id;
			}
		}
		else
		{
			foreach ($ids as $key => $id)
			{
				foreach ($productsInventoryInfo as $psii)
				{
					if ($psii['product_id'] == $id)
					{
						$ret[$key]['onlineQty'] = $psii['virtual_num'] + $psii['num_available'];
						$ret[$key]['SysNo'] = $id;
						break;
					}
				}
			}
		}

		return $ret;
	}

	//当前团购
	public static function currentTuan($count = 0) {
		$now = date("Y-m-d H:i:s", time());
		$count = ($count === 0 ? '' : " top $count ");

		$str = "AND status in(0,1) AND StartTime<= '$now' AND EndTime>= '$now'";
		$order = "ORDER BY StartTime ASC";
		$list = self::getSaleCountDownInfos(200, 5, $str, $order);
		$list = ITuans::filterByProductPool($list, self::$whId);

		return $list;
	}

	//下期团购
	public static function nextTuan($count = 0) {
		$now =  date("Y-m-d H:i:s", time());
		$next = date("Y-m-d H:i:s", time() + 20*60*60);
		$count = ($count === 0 ? '' : " top $count ");

		$str = "AND status in(0,1) AND StartTime<= '$next' AND StartTime>= '$now'";
		$order = "ORDER BY StartTime DESC";
		$list = self::getSaleCountDownInfos(200, 5, $str, $order);

		return $list;
	}

	//早市
	public static function morning($beginTime, $endTime, $count = 0, $ployType) {
	/*	if (self::$whId == 1001 || self::$whId == 3001) {
			$beginTime = date('Y-m-d H:i:s', $beginTime);
			$endTime = date('Y-m-d H:i:s', $endTime);

			//$count = ($count === 0 ? '' : " top $count ");

			$str = "AND (Status = 0 OR Status = 1 OR Status = 2)
			        AND ((StartTime>='$beginTime' AND StartTime<='$endTime')
			        OR (EndTime<='$endTime' AND EndTime>='$beginTime')
			        OR (StartTime<='$beginTime' AND EndTime>='$endTime'))";
			$order = "ORDER BY SortNum ASC";
			$list = self::getSaleCountDownInfos($count, $ployType, $str, $order);

			if (!empty($list)) {
				foreach($list as $item) {
					$ret[] = array(
								"product_id" => $item['sysno'],
								"parent_product_id" => $item['parentProductID'],
								"product_char_id" => $item['ProductID'],
								"name" => $item['ProductName'],
								"brief_name" => $item['BriefName'],
								"market_price" => $item['BasicPrice'],
								"show_price" => $item['CountDownCurrentPrice'] + $item['CountDownCashRebate'],
								"snap_price" => $item['SnapShotCurrentPrice'] + $item['SnapShotCashRebate'],
								"online_qty" => $item['onlineQty'],
								"old_qty" => $item['countDownQty'],
								"start_time" => $item['begin_time'],
								"end_time" => $item['end_time'],
								"review_count" => $item['review_count'],
								"status" => $item['status'],
								"word" => $item['PromotionWord'],
					);
				}
			}
			return $ret;
		}
  */
		$beginTime = date('Y-m-d H:i:s', $beginTime);
		$endTime = date('Y-m-d H:i:s', $endTime);

		$rst = IEventInfo::getMorningInfo(self::$whId);
		$lists = $rst['pblock'];

		$currentLists = array();
		if ($ployType == 6) {
			$currentLists = $lists[0]['list'];
		} else if ($ployType == 7) {
			$currentLists = $lists[1]['list'];
		} else if ($ployType == 4) {
			$currentLists = $lists[2]['list'];
		}

		$productIds = array();
		foreach ($currentLists as $lt) {
			$productIds[] = $lt['product_id'];
		}



		//$buyCounts = self::getBuyCount($productIds, $beginTime, $endTime, true);
		$rst = IProductInventory::getProductsInventeory($productIds, self::$whId);

		$buyCounts = array();
		foreach ($rst as $rt) {
			$buyCounts[$rt['product_id']]['total'] = $rt['account_num'];
		}

		foreach ($currentLists as $list) {
			$buyCount = (isset($buyCounts[$list['product_id']]['total']) ? $buyCounts[$list['product_id']]['total'] : 0);
			$ret[] = array(
							"product_id" => $list['product_id'],
							"parent_product_id" => $list['product_id'],
							"product_char_id" => $list['product_char_id'],
							"name" => $list['name'],
							"brief_name" => $list['name'],
							"market_price" => sprintf("%0.2f", $list['market_price']/100),
							"show_price" => (empty($list['m_price']) ? sprintf("%0.2f", $list['show_price']/100) : sprintf("%0.2f", $list['m_price']/100)),
							"snap_price" => sprintf("%0.2f", $list['show_price']/100),
							"online_qty" => $list['num_available'] + $list['virtual_num'],
							"old_qty" => $buyCount,
							"start_time" => $beginTime,
							"end_time" => $endTime,
							"review_count" => $list['review_count'],
							"status" => $list['status'],
							"word" => $list['promotion_word'],
				);
		}

		return $ret;
	}

	//早市抢购
	public static function morningQiangGou($beginTime, $endTime, $count = 0) {
	 /*	if (self::$whId == 1001 || self::$whId == 3001) {
			$beginTime = date('Y-m-d H:i:s', $beginTime);
			$endTime = date('Y-m-d H:i:s', $endTime);

			//$count = ($count === 0 ? '' : " top $count ");

			$str = "AND StartTime<='$beginTime'
			        AND EndTime>='$endTime'";
			$order = "ORDER BY SortNum ASC";
			$list = self::getSaleCountDownInfos(200, 4, $str, $order);

			$ret = array();
			if (!empty($list)) {
				foreach($list as $item) {
					$ret[] = array(
						"product_id" => $item['sysno'],
						"parent_product_id" => $item['parentProductID'],
						"product_char_id" => $item['ProductID'],
						"name" => $item['ProductName'],
						"brief_name" => $item['BriefName'],
						"market_price" => $item['BasicPrice'],
						"show_price" => $item['CountDownCurrentPrice'] + $item['CountDownCashRebate'],
						"snap_price" => $item['SnapShotCurrentPrice'] + $item['SnapShotCashRebate'],
						"online_qty" => $item['onlineQty'],
						"old_qty" => $item['countDownQty'],
						"start_time" => $item['begin_time'],
						"end_time" => $item['end_time'],
						"review_count" => $item['review_count']
					);
				}
			}
			return $ret;
		}*/
		
		$beginTime = date('Y-m-d H:i:s', $beginTime);
		$endTime = date('Y-m-d H:i:s', $endTime);

		$rst = IEventInfo::getMorningInfo(self::$whId);
		$lists = $rst['pblock'];

		$currentLists = array();
		$currentLists = $lists[2]['list'];

		$productIds = array();
		foreach ($currentLists as $lt) {
			$productIds[] = $lt['product_id'];
		}

		$buyCounts = self::getBuyCount($productIds, $beginTime, $endTime, true);

		foreach ($currentLists as $list) {
			$buyCount = (isset($buyCounts[$list['product_id']]['total']) ? $buyCounts[$list['product_id']]['total'] : 0);
			$ret[] = array(
							"product_id" => $list['product_id'],
							"parent_product_id" => $list['product_id'],
							"product_char_id" => $list['product_char_id'],
							"name" => $list['name'],
							"brief_name" => $list['name'],
							"market_price" => sprintf("%0.2f", $list['market_price']/100),
							"show_price" => (empty($list['m_price']) ? sprintf("%0.2f", $list['show_price']/100) : sprintf("%0.2f", $list['m_price']/100)),
							"snap_price" => sprintf("%0.2f", $list['show_price']/100),
							"online_qty" => $list['num_available'] + $list['virtual_num'],
							"old_qty" => $list['num_available'] + $list['virtual_num'] + $buyCount,
							"start_time" => $beginTime,
							"end_time" => $endTime,
							"review_count" => $list['review_count'],
							"status" => $list['status'],
							"word" => $list['promotion_word'],
				);
		}

		return $ret;
	}

	//资讯
	public static function getNews($c1Id, $count = 5) {
		if (is_array($c1Id)) {
			$c1Id = implode(',', $c1Id);
		}
		else {
			$c1Id = $c1Id +0;
		}

		$sql = "
			select top $count
					B.SysNo as sysno,
					B.Question as title
			from OnlineListQA A,
					QA B
			where B.Status = 0
				and A.QASysNo = B.sysno
				and A.CategorySysNo in($c1Id)
		order by A.ListOrder asc, A.rowCreateDate desc";

		$list = self::getRows($sql);
		if (false === $list) {
			return false;
		}

		return $list;
	}


	/**
	 * 将页面“顶部搜索”的数据序列化后存在PageCacheTTC中
	 * @param int $siteId 分站id，如果没有，则用上海的代替
	 * @return array
	 */
	public static function getTopSearch($siteId=null) {
		global $_WEBSITE_CFG;
		if (empty($siteId) || (! array_key_exists($siteId, $_WEBSITE_CFG))) { //使用上海的
			$key = 'page-shanghai-index-top-search';
		}
		else { //使用分站自己的
			$siteInfo = $_WEBSITE_CFG[$siteId];
			$key = 'page-' . $siteInfo['name'] . '-index-top-search';
		}

		$ad = IPageCahce::getCacheDataFromKey($key);
		if ($ad === false) {
			Logger::err("IPageCahce::getCacheDataFromKey [{$key}] FAILED, errCode is " . IPageCahce::$errCode . ', errMsg is ' . IPageCahce::$errMsg);
			return false;
		}

		return $ad;
	}

	//获取最新商品
	public static function getListNew($date) {
		$_backup = self::$dbName;

		if (self::$isNewDB) {
			self::setDataBase("ICSON_Product");
			$sql = "SELECT Product_SubStation.ProductSysNo as SYsNo FROM Product_SubStation, Product WHERE Product_SubStation.ProductSysNo = Product.SysNo AND Product.ProductType = 0 AND Product_SubStation.Status = 1 AND Product_SubStation.SaleTime >= '" . $date . "' AND Product_SubStation.SubStationSysNo = " . self::$whId . " ORDER BY Product_SubStation.SaleTime DESC";
		} else {
			$sql = "SELECT SYsNo FROM product WHERE Status = 1 AND ProductType = 0 and CreateTime >= '" . $date . "' ORDER BY CreateTime DESC;";
		}

		$list = self::getRows($sql);
		self::setDataBase($_backup);
		if (false === $list) {
			return false;
		}

		$productIds = array();
		foreach ($list as $lt) {
			$productIds[] = $lt['SYsNo'];
		}

		$productInfos = IProduct::getProductsInfo($productIds, self::$whId);
		$rsts = array();
		foreach ($list as $lt) {
			$rst = array();
			$productId = $lt['SYsNo'];
			$productInfo = $productInfos[$productId];
			$rst['C3SysNo'] = $productInfo['c3_ids'];
			$rst['SYsNo'] = $productId;
			if ($productInfos[$productId]['status'] != PRODUCT_STATUS_NORMAL || $productInfos[$productId]['stock'] == $_StockTips['not_available'] ) continue;
			$rsts[] = $rst;
		}

		return $rsts;
	}

	//获取c3ids
	public static function getC3Ids() {
		$_backup = self::$dbName;

		if (self::$isNewDB) {
			self::setDataBase("ICSON_Product");
		}
		$sql = "select distinct C3SysNo from product WHERE ProductType = 0;";

		$list = self::getRows($sql);
		self::setDataBase($_backup);
		if (false === $list) {
			return false;
		}

		$c3Ids = array();
		foreach ($list as $lt) {
			$c3Ids[] = $lt['C3SysNo'];
		}

		return $c3Ids;
	}

	//获取最新上架的二手商品
	public static function getNewSecond() {
		$_backup = self::$dbName;

		if (self::$isNewDB) {
			self::setDataBase("ICSON_Product");
			$sql = "SELECT top 100 ps.ProductSysNo AS SysNo FROM Product_SubStation AS ps
			,Product AS p WHERE p.SysNo = ps.ProductSysNo 
			 AND ps.SubStationSysNo = " . self::$whId . " AND p.ProductType = 1 AND ps.Status = 1 ORDER BY ps.SaleTime DESC ";
		} else {
			$sql = "SELECT top 100 SysNo FROM product WHERE status = 1 AND ProductType = 1 AND IsCanPurchase = 1 ORDER BY SaleTime DESC;";
		}
		
		$list = self::getRows($sql);
		//self::setDataBase($_backup);
		$i = 0;
		do {
			if ($i > 9) break;
			if ($i > 0) sleep(20);
			$list = self::getRows($sql);
			$i++;
		} while ($list === false);

		return $list;
	}

	//获取最早上架的二手商品180前
	public static function getKeepSecond() {
		$date = date("Y-m-d H:i:s", time() - 180*86400);
		$_backup = self::$dbName;

		if (self::$isNewDB) {
			self::setDataBase("ICSON_Product");
			$sql = "select  product.SysNo,product_price.CurrentPrice,product_price.UnitCost from product,product_price,product_substation 
					WHERE product.SysNo = product_price.ProductSysNo and product_substation.ProductSysNo = product.SysNo and
					product_substation.status = 1 and  
					product.ProductType = 1 and  
					product_substation.SaleTime <= '$date'  and 
					product_substation.IsCanPurchase = 1
					ORDER BY  product_substation.SaleTime asc;";
		} else {
			$sql = "select  product.SysNo,product_price.CurrentPrice,product_price.UnitCost from product,product_price 
				WHERE product.SysNo = product_price.OldSysNo and
				product.status = 1 and  
				product.ProductType = 1 and  
				product.SaleTime <= '$date'  and 
				product.IsCanPurchase = 1
				ORDER BY  product.SaleTime asc;";
		}
		
		$list = self::getRows($sql);
		//self::setDataBase($_backup);
		$i = 0;
		do {
			if ($i > 9) break;
			if ($i > 0) sleep(20);
			$list = self::getRows($sql);
			$i++;
		} while ($list === false);

		$seconds = array();
		global $_StockTips;
		foreach ($list as $lt) {
			$unitCost = intval($lt['UnitCost']);
			if (empty($unitCost)) continue;
			if (intval($lt['CurrentPrice']*10/$lt['UnitCost']) <= 6) continue;
			$seconds[] = $lt;
		}

		$secondsList = array();
		$count = count($seconds);
		$rand = 0;
		if ($count >= 30)
		$rand = rand(0, $count - 16);

		for ($i = $rand;$i < ($rand + 15);$i++) {
			$secondsList[] = $seconds[$i];
		}

		return $secondsList;
	}

	//获取二手商品的分类
	public static function getSecondCategory() {
		$input = array(
			'currentPage' => 1,  //当前页
			'pageSize' => 1, //empty( $_GET['pagesize'] ) ? 20 : $_GET['pagesize'] + 0, //页大小
			'sort' => 6,  //排序字段
			'desc' => 1, //排序方式
			'day' => 0, //是否当日配货
			'attrInfo' => '', //属性信息
			'classId' => '',
			'key' =>  '二手',
			'price' => 0, //价格
			'viewMode' => 1, //查看模式
			'option' => '',
			'areacode' => self::$whId
		);
		$response = ISearch::gets($input);
		$classes = $response['classes'];
		foreach ($classes as $ct) {
			if ($ct['pid'] != 0) {
				$c3id = $ct['id'];
				if ($c3id > 100000000) {
					$c3ids[] = $ct['id'] - 100000000;
				}
				
			}
		}

		$_backup = self::$dbName;
		self::setDataBase("ICSON_Product");
		$sql = "select
					distinct
					c3.sysno as c3id,
					c3.C3Name as c3name,
					c1.sysno  as c1id,
					c2.SysNo as c2id,
					c2.C2Name as c2name
				from product as A
				left join Category3 as c3 on  A.C3SysNo = c3.SysNo
				left join Category2 as c2 on c3.C2SysNo = c2.SysNo
				left join Category1 as c1 on c2.C1SysNo = c1.SysNo
				WHERE A.ProductType = 1 AND c3.sysno IN (" . implode(",", $c3ids) . ") order by c1id asc,c3id asc;";
		$list = self::getRows($sql);
		
		$i = 0;
		do {
			if ($i > 9) break;
			if ($i > 0) sleep(20);
			$list = self::getRows($sql);
			$i++;
		} while ($list === false);
		self::setDataBase($_backup);

		return $list;
	}
	
	
	// 获取小类的一周的销量，直接取db
	public static function getWeekSaleNum($wh_id, $c3ids = array()) {
		$weekSaleNum = array();
		//@TODO 重庆站暂时取上海站的热销榜
		if ($wh_id == 4001 || $wh_id == 3001 || $wh_id == 5001) {
			$wh_id = 1;
		}
		$where = "ptype=0 AND state=1 AND wh_id={$wh_id}";
		if (empty($c3ids)) {
			return $weekSaleNum;
		} else {
			$where .= " AND cate3 in (" . implode(",", $c3ids) . ")";
		}

		$where .= " GROUP BY cate3 ORDER BY wsum desc";
		$weekSaleNum = IProductHeapListDao::getRows(array('cate3', 'sum(w1) as wsum'), $where, 0, 0);
		if ($weekSaleNum === false) {
			self::$errCode = 11;
			self::$errMsg = "IProductHeapListDao::getRows error: " . IProductHeapListDao::$errCode . "; " . IProductHeapListDao::$errMsg;
			return false;
		} else if (count($weekSaleNum)) {
			foreach ($weekSaleNum as $k => $v) {
				$tmp[$v['cate3']] = $v['wsum'];
			}
			$weekSaleNum = $tmp;
		}

		return $weekSaleNum;
	}


	//已不使用以下
		//最新商品评分
	// public function getTopScoreList($siteId, $count = 4) {
	// 	//体验评论始终在上海库
	// 	$count = intval($count);

	// 	$_backup = self::$dbName;
	// 	self::setDataBase("ERP_1");

	// 	$TRY_COUNT = 1;   //尝试次数
	// 	$PAGESIZE = 5000;  //每次分析的数据条数
	// 	$tryIndex = 0;
	// 	$resultLen = 0;

	// 	$ret = array();
	// 	while ( $tryIndex < $TRY_COUNT && $resultLen < $count ) {
	// 		$subSql = $tryIndex > 0 ? ' AND sysno NOT IN (
	// 			SELECT  TOP ' . $PAGESIZE * $tryIndex . ' SysNo
	// 			FROM (SELECT SysNo,
	// 								CreateDate,
	// 								ROW_NUMBER() OVER (PARTITION BY ReferenceSysNo ORDER BY CreateDate DESC) AS rn
	// 						FROM Review_Master rm
	// 						WHERE rm.Status <> -2
	// 							AND rm.ReferenceType = 0
	// 							AND rm.ReviewType = 1
	// 							AND CreateDate > DATEADD(day, -1, getdate())
	// 						) t
	// 			WHERE rn = 1
	// 			ORDER BY t.CreateDate DESC
	// 			) ' : '';

	// 		$sql = "SELECT TOP " . $PAGESIZE . "
	// 								p.reviewcount,
	// 								product_id,
	// 								score
	// 					FROM (SELECT SysNo,
	// 											ReferenceSysNo as product_id,
	// 											CreateDate,
	// 											score,
	// 											ROW_NUMBER() OVER (PARTITION BY ReferenceSysNo ORDER BY CreateDate DESC) AS rn
	// 								FROM Review_Master rm
	// 								WHERE rm.Status <> -2
	// 									AND rm.ReferenceType = 0
	// 									AND rm.ReviewType = 1
	// 									AND CreateDate > DATEADD(day, -1, getdate())
	// 							) t  LEFT JOIN product AS p ON t.product_id = p.sysno
	// 					WHERE rn = 1 " .  $subSql . "
	// 					ORDER BY t.CreateDate DESC";

	// 		$msSqlRes = self::getRows($sql);
	// 		if (false === $msSqlRes) {
	// 			return false;
	// 		}

	// 		$product_ids = array();
	// 		$product_scores = array();
	// 		$product_review = array();

	// 		foreach($msSqlRes as $item) {
	// 			$product_ids[] = $item['product_id'];
	// 			$product_scores[ $item['product_id'] ] = $item['score'];
	// 			$product_review[ $item['product_id'] ] = $item['reviewcount'];
	// 		}

	// 		$mysqlRes = IProduct::getProductsInfo($product_ids, $siteId);
	// 		if (false === $mysqlRes) {
	// 			self::$errCode = IProduct::$errCode;
	// 			self::$errMsg = IProduct::$errMsg;
	// 			return false;
	// 		}
	// 		foreach($mysqlRes as &$item) {
	// 			if ($item['status'] === 1) {
	// 				$tmpRet = IReviews::getProductReviewProperty($item['product_id'], false);
	// 				if ($tmpRet == false) {
	// 					return false;
	// 				}
	// 				if ($tmpRet['experience_number']!=0) {
	// 					$item['score'] = $tmpRet['satisfaction']/$tmpRet['experience_number'];
	// 				}
	// 				else {
	// 					$item['score'] = 0;
	// 				}

	// 				//$item['score'] = $product_scores[ $item['product_id'] ] ;
	// 				$item['reviewcount'] = $product_review[ $item['product_id']  ] ;
	// 				$ret[] = $item;
	// 				$resultLen++;

	// 				if ($resultLen >= $count) {
	// 					break;
	// 				}
	// 			}
	// 		}

	// 		$tryIndex++;
	// 	}

	// 	self::setDataBase($_backup);

	// 	return $ret;
	// }

	//热卖榜

	/*
	 public function getHotSell($wh_id, $c3id, $count = 10) {
		$sql = "select  top $count
		Product.SysNo as SysNo,Product.C3SysNo as C3SysNo,Product.ProductId, ProductName, Product.BriefName,w1 as w,PromotionWord,Product.ProductID,
		left(ProductDesc.productdesc,150) as productdescription, AvailableQty+VirtualQty as OnlineQty, Product.Status,
		Product_Price.CurrentPrice+Product_Price.CashRebate as CurrentPrice
		from
		Product with (nolock)
		inner join ProductDesc   with(nolock)  on Product.sysno=ProductDesc.sysno
		inner join
		Product_Price with (nolock) on Product.SysNo = Product_Price.ProductSysNo
		inner join Inventory with (nolock) on Inventory.ProductSysNo = Product.SysNo
		inner join Product_SaleTrend with (nolock) on Product.SysNo = Product_SaleTrend.ProductSysNo
		where 1=1
		and Product.C3SysNo in ($c3id)
		and Product_Price.CurrentPrice >=50
		and w1>=0
		and Product.Status = 1
		and AvailableQty+VirtualQty>0
		order by w1 desc ";

		$list = self::getRows($sql);
		if (false === $list) {
		return false;
		}

		$ret = array();

		foreach($list as $item) {
		$ret[] = array(
		"name" => $item['ProductName'],
		"product_char_id" => $item['ProductId'],
		"product_id" => $item['SysNo'],
		"price" => $item['CurrentPrice']
		);
		}

		return  $ret;
		}

		*/

	// //一级首页限时抢购
	// public function subIndexGiangGou($c1id) {
	// 	$sql = "select   top 10
 //            Product.SysNo as SysNo,Product.SysNo as ProductSysNo,Product.ProductID, ProductName,
 //            Product.BriefName,Product_Price.BasicPrice,Product_Price.CurrentPrice+isnull(Product_Price.CashRebate,0) as show_price,Product.PromotionWord,
 //            Isnull(Product.ReviewStart,0) ScoreAVG,Isnull(Product.ReviewCount,0) ReviewCount
	// 		from
	// 		OnlineListProduct(nolock)
	// 		inner join Product(nolock)
	// 		on OnlineListProduct.productsysno = Product.sysno
	// 		inner join Product_Price(nolock)
	// 		on OnlineListProduct.ProductSysNo = Product_Price.ProductSysNo
	// 		where Product.Status = 1
	// 		 and OnlineListProduct.CategorySysNo=$c1id
	// 		 and OnlineListProduct.OnlineRecommendType=13 and OnlineListProduct.OnlineAreaType=2
	// 		 group by  Product.SysNo,ProductName, Product.ProductID,Product.BriefName,Product.PromotionWord,
	// 		 Product_Price.BasicPrice, Product_Price.CurrentPrice+isnull(Product_Price.CashRebate,0),
	// 		Product.ReviewStart,Product.ReviewCount  order by newid()
	// 	";

	// 	$list = self::getRows($sql);
	// 	if (false === $list || !is_array($list)) {
	// 		return false;
	// 	}
	// 	$ret = array();

	// 	//ixiuzeng添加，多分仓项目库存获取
	// 	if (count($list) == 0)
	// 	{
	// 		return $ret;
	// 	}

	// 	$pids = array();
	// 	foreach($list as $rt)
	// 	{
	// 		$pids[] = $rt['ProductSysNo'];
	// 	}

	// 	$productsInventoryInfo = IProductInventory::getProductsInventeory(array_unique($pids), self::$whId);
	// 	if (false === $productsInventoryInfo)
	// 	{
	// 		self::$errCode = IProductInventory::$errCode;
	// 		self::$errMsg = IProductInventory::$errMsg;

	// 		return $ret;
	// 	}
	// 	else
	// 	{
	// 		foreach ($list as $key => $wi)
	// 		{
	// 			foreach ($productsInventoryInfo as $psii)
	// 			{
	// 				if ($psii['product_id'] == $wi['ProductSysNo'])
	// 				{
	// 					if(($psii['virtual_num'] + $psii['num_available']) > 0)
	// 					{
	// 						$ret[] = array(
	// 							"name" => $wi['ProductName'],
	// 							"product_char_id" => $wi['ProductID'],
	// 							"product_id" => $wi['SysNo'],
	// 							"show_price" => $wi['show_price'],
	// 							"market_price" => $wi['BasicPrice'],
	// 							"score" => $wi['ScoreAVG'],
	// 							"review_count" => $wi['ReviewCount'],
	// 							"qty" => $psii['virtual_num'] + $psii['num_available']
	// 						);
	// 					}
	// 					break;
	// 				}
	// 			}
	// 		}
	// 	}

	// 	return  $ret;
	// }

// 			public static function thh($count = 0, $ployType = 12) {
// 		$count = ($count === 0 ? '' : " top $count ");
// 		$start = date("Y-m-d 18:00:00");
// 		$end = date("Y-m-d 23:59:59");

// 		$sql = "select
// 		product.PromotionWord,
//         product.sysno,
//         c1.sysno  as c1id,
//         c3.SysNo as c3id,
//         product.ProductTypeMasterID as parentProductID,
//         product.ProductID as ProductID,
//         product.ProductName,
//         sc.HomeRushTitle as rush_title,
//         CONVERT(varchar, sc.StartTime, 120) as begin_time,
//         CONVERT(varchar, sc.EndTime, 120) as end_time,
//         Product.BriefName,
//         pp.BasicPrice as BasicPrice,
//         pp.CashRebate as CashRebate,
//         sc.CountDownCurrentPrice,
//         sc.CountDownCashRebate,
//         sc.SnapShotCurrentPrice,
//         sc.SnapShotCashRebate,
//         sc.OldQty  as countQty
// from    Sale_CountDown sc (nolock)
//         left join Product(nolock) on sc.productsysno = product.sysno
//         left join Product_price pp (nolock) on pp.productsysno = sc.productsysno
//         left join Category3 as c3 on  Product.C3SysNo = c3.SysNo
//         left join Category2 as c2 on c3.C2SysNo = c2.SysNo
//         left join Category1 as c1 on c2.C1SysNo = c1.SysNo

// where   sc.PloyType = " . $ployType . "
//         and Product.Status = 1
//         and sc.status in(0,1)
//         and sc.StartTime<= '$end'
//         and sc.EndTime>= '$start'
//         order by sc.SortNum ASC";

// 		$list = self::getRows($sql);
// 		if (false === $list) {
// 			return false;
// 		}

// 		$ret = array();
// 		if (!empty($list)) {
// 			$ret = $list;

// 			//ixiuzeng添加，多分仓项目中，获取库存的逻辑
// 			$pids = array();
// 			foreach($ret as $rt)
// 			{
// 				$pids[] = $rt['sysno'];
// 			}
// 			$productsInventoryInfo = IProductInventory::getProductsInventeory(array_unique($pids), self::$whId);
// 			if (false === $productsInventoryInfo)
// 			{
// 				self::$errCode = IProductInventory::$errCode;
// 				self::$errMsg = IProductInventory::$errMsg;

// 				foreach ($ret as $key => $wi)
// 				{
// 					$ret[$key]['onlineQty'] = 0;
// 				}
// 			}
// 			else
// 			{
// 				foreach ($ret as $key => $wi)
// 				{
// 					foreach ($productsInventoryInfo as $psii)
// 					{
// 						if ($psii['product_id'] == $wi['sysno'])
// 						{
// 							$ret[$key]['onlineQty'] = $psii['virtual_num'] + $psii['num_available'];
// 							break;
// 						}
// 					}
// 				}
// 			}
// 		}
// 		return $ret;
// 	}
	// //本周DIY商品信息
	// public static function DIY_info($sysno) {
	// 	$sql = "select  d.BriefName,DefaultProductSysNo,isshowpic,productid,g.Name
	// 		from dbo.Prj_Master b(nolock)
	// 		inner join dbo.Prj_Item c(nolock) on c.PrjSysNo = b.SysNo
	// 		inner join Product d(nolock) on c.DefaultProductSysNo = d.SysNo
	// 		inner join Product_Price e(nolock) on d.SysNo = e.ProductSysNo
	// 		inner join Sln_Master f (nolock) on b.SlnSysNo=f.SysNo
	// 		inner join Sln_Item g (nolock) on f.SysNo=g.SlnSysNo and g.SysNo= c.SlnItemSysNo
	// 		where c.Status = 0 and b.SysNo = $sysno order by g.OrderNum ";

	// 	$list = self::getRows($sql);

	// 	if (false === $list) {
	// 		return false;
	// 	}

	// 	return $list;
	// }

	// //本周DIY总价格
	// public static function DIY_price($sysno) {
	// 	$sql = "select   m.SlnSysNo,m.sysno,m.name,pt.OrderNum,sum(i.defaultqty * p.currentprice) as totalPrice
	// 		from prj_master m(nolock) inner join prj_item i(nolock) on m.sysno=i.prjsysno
	// 		inner join product_price p(nolock) on i.defaultproductsysno = p.productsysno
	// 		left join prj_type pt(nolock) on pt.SysNo = m.PrjTypeSysNo
	// 		where  m.status=0 and i.status=0 and m.sysno= $sysno
	// 		group by  m.SlnSysNo,m.sysno,m.name,pt.OrderNum";

	// 	$list = self::getRows($sql);

	// 	if (false === $list) {
	// 		return false;
	// 	}

	// 	return $list;
	// }

	// //本周DIY评论
	// public static function DIY_comment($sysno) {
	// 	$sql = "select Description as comment from prj_master where SysNo=sysno";

	// 	$list = self::getRows($sql);
	// 	if (false === $list) {
	// 		return false;
	// 	}

	// 	return $list;
	// }

}

