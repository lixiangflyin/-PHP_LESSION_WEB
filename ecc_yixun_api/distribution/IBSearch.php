<?php

class IBSearch {
	public static $errCode = 0;
	public static $errMsg = '';
	public static $c2BaseNum = 10000;
	public static $c3BaseNum = 100000000;

	public static function gbk_decode($data, $url) {
		$data = str_replace("\r\n", "", $data);
		$data = str_replace("\t", "", $data);
		$data = mb_convert_encoding($data, 'UTF-8', 'GBK');

		$data = json_decode($data, true);
		if (null === $data) {
			self::$errCode = 100;
			self::$errMsg = "json data format is error, url-{$url}";
			return false;
		}

		return self::decode($data);
	}

	public static function decode($data) {
		if (is_array($data)) {
			$res = array();
			foreach ($data as $key => $value) {
				$res[$key] = self::decode($value);
			}
			return $res;
		}
		else {
			return mb_convert_encoding($data, 'GBK', 'UTF-8');
		}
	}

    //获取搜索ip
	public static function getSearchUrl($name = 'SEARCH_PAIPAI') {
		global $_IP_CFG;
		if (is_array($_IP_CFG[$name])) {
			$ip_key = array_rand($_IP_CFG[$name], 1);
			$ip = $_IP_CFG[$name][$ip_key];
		} else {
			$ip = $_IP_CFG[$name];
		}

		return $ip;
	}

	/**
	 * 发送远程查询请求
	 * @param array $input 查询参数
	 * @tutorial areacode, uid 是为了避免 IUser 的调用
	 * @return mixed false 查询失败; array 查询结果
	 */
	public static function gets($input) {
		$price = 0;
		if (!empty($input['price']) && count(explode('t', $input['price'])) == 2) {
			$price = explode('t', $input['price']);
			$price = ($price[0] * 100) . 't' . ($price[1] * 100);
		}

		$paipaiParams = array (
			'page' => $input['currentPage'] - 1, // 从第0页开始
			'pagecount' => $input['pageSize'] ? intval($input['pageSize']):24, // $input['pageSize'],
			'sort' => $input['sort'],
			'desc' => $input['desc'],
			'day' => $input['day'] == 1 ? '1t1' : '0',
			'attrinfo' => $input['option'],
			'price' => $price,
			'areacode' => isset($input['areacode']) ? $input['areacode'] : ToolUtil::getSiteId()
			//'areacode' => 1
		);
	    //指定分销商
		if (isset($input['uid'])) {
			$paipaiParams['parentId'] = $input['uid'];
		}

		//搜索
		if (isset($input['key'])) {
			$paipaiParams['key'] = str_replace('+', '%20', urlencode($input['key']));
		}

		//热门类目
		if (isset($input['hotclass'])) {
			$paipaiParams['hotclass'] = $input['hotclass'] + self::$c3BaseNum;
		}

		// 品牌
		if (isset($input['manufacturer'])) {
			$paipaiParams['manufacturer'] = $input['manufacturer'];
		}

		//属性聚类
		if (isset($input['attrcluster'])) {
			$paipaiParams['attrcluster'] = $input['attrcluster'];
		}

		//增加多类目和品牌的搜索支持
		if (isset($input['classIds']) && is_array($input['classIds'])) {
		    $class_filters = array();
		    foreach ($input['classIds'] as $v) {
		        if (!isset($v['categorylevel']) || !isset($v['classId'])) {
		            continue;
		        }
		        switch ($v['categorylevel']) {
    				case '3':
    					$tmp = self::$c3BaseNum;
    					break;
    				case '2':
    					$tmp = self::$c2BaseNum;
    					break;
    				default:
    					$tmp =0;
    			}
    			$class_filters[] = $v['categorylevel'].'-'. ($tmp + $v['classId']);;
		    }
		    $class_filters && $paipaiParams['classid'] = implode('o', $class_filters);
		}

		//分类进入 添加一个参数目录级别设置
		else if (isset($input['classId']) && isset($input['categorylevel'])) {
			switch (intval($input['categorylevel'])) {
				case '3':
					$tmp = self::$c3BaseNum;
					break;
				case '2':
					$tmp = self::$c2BaseNum;
					break;
				default:
					$tmp =0;
			}
			$paipaiParams['classid'] = $input['categorylevel'].'-'. ($tmp + $input['classId']);
		}
		else if (isset($input['classId'])) {
			if (!empty($input['classId'])) {
				$paipaiParams['classid'] = '3-'. (self::$c3BaseNum + $input['classId']);
			}

			if ($input['classId']==0) {
				$paipaiParams['classid'] = '3-0';
			}
		}
		$url = "http://" . self::getSearchUrl() . "/huangpu/json?";
		$urlParams = array();
		foreach ($paipaiParams as $key=>$value) {
			$urlParams[] = "{$key}={$value}";
		}
		$url.= join('&', $urlParams);

		$res = NetUtil::cURLHTTPGet($url, 15, 'searchex.paipai.com');
		if (false === $res) {
		    throw new BaseException(NetUtil::$errCode, NetUtil::$errMsg);
		}
		return self::gbk_decode($res, $url);
	}

	//模糊搜索结果
	public static function getSearchResult($wh_id, $keyWord) {
		global $_IP_CFG;

		$url = "http://" . self::getSearchUrl() . "/huangpu/suggest?AreaCode={$wh_id}&KeyWord=" . urlencode($keyWord);
		$res = NetUtil::cURLHTTPGet($url, 15, 'searchex.paipai.com');
		if (false === $res) {
			self::$errCode = NetUtil::$errCode;
			self::$errMsg = NetUtil::$errMsg;
			return false;
		}

		$res = preg_replace('/^\s*try{_[^_]*_head_callback\((.*)\)}catch\(e\){\s*}/', '$1', $res);
		return $res;
	}

	//个性化商品推荐
	public static function getRecommendProducts($param, $site_id, $count = 10, $needReview = true, $checkStatus = true, $timeout = 2) {
		global $_StockTips, $_IP_CFG;

/* 个性推荐接口介绍：
		$param = array(
			'num' => 1,				//返回的个数
			'complement' => 1, 	//是否自动补齐
			'top' => 1, 				//热销个数
			'type' => 1, 				// 1：订单推荐， 2：浏览记录推荐
			'commodityIDs' => 2001-22003		//用户浏览记录商品ID
		);
*/

		$url = "http://" . self::getSearchUrl() . "/huangpu/RecommendationCgi?{$param}"; //开发环境
		//$url = "http://180.153.82.44/huangpu/RecommendationCgi?{$param}"; //线上环境
		$response = NetUtil::cURLHTTPGet($url, $timeout, 'searchex.paipai.com');
		if (false === $response) {
			self::$errCode = NetUtil::$errCode;
			self::$errMsg = NetUtil::$errMsg;
			return false;
		}

		$res = preg_replace('/^\s*var\s+recommendationCommodityID\=(.*)$/', '$1', $response);
		$res = ToolUtil::gbJsonDecode($res);
		if ('' == $res) {
			return array();
		}

		$product_ids = array();
		foreach ($res as $item) {
			$product_ids[] = $item['id'];
		}

		if (count($product_ids) < $count) {
			self::$errCode = 101;
			self::$errMsg = "records count returned from searchex are not enought: {$url}";
			return false;
		}

		$info = IProduct::getProductsInfo($product_ids, $site_id, false);
		if (false === $info) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = IProduct::$errMsg;
			return false;
		}

		$items = array();
		$dirtyIds = array();
		$item_filter = array();
		foreach ($product_ids as $product_id) {
			if (isset($info[ $product_id ])) {
				$item = $info[ $product_id ];

				if ((false === $checkStatus) || ($item['status'] === 1 && $item['stock'] !== $_StockTips['not_available'])) {
					//过滤掉价格重复的商品
					if (array_key_exists($item['price'], $item_filter)) {
						$item_filter[$item['price']][] = $item; //记录价格重复的商品信息
					}
					else {
						$item_filter[$item['price']] = array();

						$item['title'] = strip_tags($item['name']);
						$items[] = $item;
						if (count($items) == $count) {
							break;
						}
					}
					/*$item['title'] = strip_tags($item['name']);
					$items[] = $item;
					if (count($items) == $count) {
						break;
					}*/
				}
				else {
					$dirtyIds[] = $product_id;
				}
			}
			else {
				$dirtyIds[] = $product_id;
			}
		}

		//去掉商品价格相同后,发现不足的需要补全
		if (count($items) < $count) {
			foreach($item_filter as $_filter => &$_vals) {
				foreach($_vals as &$_val) {
					$items[] = $_val;
				}
			}
		}

		if (count($items) < $count && stripos($param, 'complement=1') != false) {
			self::$errCode = 102;
			self::$errMsg = "records count after filtered by local are not enought: {$url}; drity ids is : " . implode(',', $dirtyIds);
			return false;
		}

		if (true === $needReview) {
			$product_ids = array();

			foreach ($items as $item) {
				$product_ids[] = $item['product_id'];
			}

			$reviews = IReviews::getProductsReviewCount($product_ids, false);
			foreach ($items as &$item) {
				$product_id = $item['product_id'];
				if (false !== $reviews && isset($reviews[$product_id])) {
					$review = $reviews[$product_id];
					$item['review_length'] = $review['experience_number'] == 0 ? 100 : round($review['satisfaction'] * 20 / $review['experience_number'], 0);
					$item['review_count'] = $review['total'];
				}
				else {
					$item['review_length'] = 0;
					$item['review_count'] = 0;
				}
			}
		}

		return $items;
	}
}