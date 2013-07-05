<?php
class ISearch
{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $c2BaseNum = 10000;
	public static $c3BaseNum = 100000000;

	public static $clicks;
	public static $policyId;

	public static function gbk_decode($data, $url) {
		$data = str_replace("\r\n", "", $data);
		$data = str_replace("\t", "", $data);
		$data = mb_convert_encoding($data, 'UTF-8', 'GBK');
		$data = json_decode($data, true);
		
		if( null === $data ){
			self::$errCode = 100;
			self::$errMsg = "json data format is error, url-" . $url;
			return false;
		}
	
		return  self::decode( $data );
	}
	public static function decode( $data ){
		if( is_array( $data) ){
			$res = array();

			foreach( $data as $key => $value)
				$res[$key] = self::decode( $value );
			return $res;
		}
		else
			return mb_convert_encoding($data, 'GBK', 'UTF-8');
	}

	//��ȡ����ip
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
	 * ����Զ�̲�ѯ����
	 * @param array $input ��ѯ����
	 * @tutorial areacode, uid ��Ϊ�˱��� IUser �ĵ���
	 * @return mixed false ��ѯʧ��; array ��ѯ���
	 */
	public static function gets($input){
		$price = 0;
		if( !empty($input['price']) && count( explode("t", $input['price'])) == 2){
			$price = explode("t", $input['price']);
			$price = ( $price[0] * 100 ) . 't' . ( $price[1] * 100 );

		}
		$paipaiParams = array(
			"page" => $input['currentPage'] - 1, // �ӵ�0ҳ��ʼ
			"pagecount" => $input['pageSize'] ? intval($input['pageSize']):24, // $input['pageSize'],
			"sort" => $input['sort'],
			"desc" => $input['desc'],
			"day" => $input['day'] == 1 ? '1t1' : '0',
			"attrinfo" => $input['option'],
			"price" => $price,
			"areacode" => isset($input['areacode']) ? $input['areacode'] : IUser::getSiteId()
			//"areacode" => 1
		);

		//����
		if( isset( $input['key'] )){
			//����ͬ���
			$input['key'] = ISearchWord::getSearchWordsForS($input['key']);				
			$paipaiParams['key'] = str_replace('+', '%20', urlencode($input['key']) );
		}
	
		// Ʒ��
		if( isset( $input['hotclass'])){
			$paipaiParams['hotclass'] = $input['hotclass'] + self::$c3BaseNum;
		}

		//������Ŀ
		if( isset( $input['manufacturer'])){
			$paipaiParams['manufacturer'] = $input['manufacturer'];
		}
			
		//���Ծ���
		if(isset( $input['attrcluster'])){
			$paipaiParams['attrcluster'] = $input['attrcluster'];
		}
		
		//�������  ���һ������Ŀ¼��������			
		if( isset($input['classId']) && isset($input['categorylevel']) )
		{
			switch(intval($input['categorylevel']))
			{
				case '3':
					$tmp = self::$c3BaseNum;
					break;
				case '2':
					$tmp = self::$c2BaseNum;
					break;
				default:
					$tmp =0;						
			}
			$paipaiParams['classid'] = $input['categorylevel']."-". ( $tmp + $input['classId'] );
			
		} else if(isset($input['classId'])) {
			
			if( !empty( $input['classId'] ))
				$paipaiParams['classid'] = "3-". ( self::$c3BaseNum + $input['classId'] );
			
			if( $input['classId']==0 )
				$paipaiParams['classid'] = "3-0";			

		}
		global $_IP_CFG;

		$url = "http://" . self::getSearchUrl() . "/huangpu/json?";
		$urlParams = array();
		foreach ($paipaiParams as $key=>$value){
			$urlParams[] = "$key=$value";
		}
		$url.= join("&", $urlParams);
		
		
		$res = NetUtil::cURLHTTPGet($url, 15, 'searchex.paipai.com');
		
		
		$uid = isset($input['uid']) ? $input['uid'] : IUser::getLoginUid();
		if( 7473968 == $uid || 30558317 == $uid ){
			$url =  str_replace(self::getSearchUrl(), 'searchex.paipai.com', $url);
			$url = $url . '</br>';
			echo $url;
		}
		
		if( false === $res ){
			self::$errCode = NetUtil::$errCode;
			self::$errMsg =  NetUtil::$errMsg;
			return false;
		}
		
		return self::gbk_decode($res, $url);
	}


	//ģ���������
	public static function getSearchResult($wh_id, $keyWord){
		global $_IP_CFG;
		
		$URL = 'http://' . self::getSearchUrl() . '/cgi-bin/isuggest_yixun?AreaCode=' . $wh_id . '&KeyWord='. urlencode( $keyWord );

		$res = NetUtil::cURLHTTPGet($URL, 15, 'search.paipai.com');
		
		if( false === $res ){
			self::$errCode = NetUtil::$errCode;
			self::$errMsg =  NetUtil::$errMsg;
			return false;
		}
		
		$res = preg_replace('/^\s*try{BBC\.head\.smartBoxCallback\((.*)\)}catch\(e\){\s*}/', '$1', $res);
		
		return $res;
	}
	
	//���Ի���Ʒ�Ƽ�
	
	public static function getRecommendProducts($param, $site_id, $count = 10, $needReview = true, $checkStatus = true, $timeout = 2){
		global $_StockTips, $_IP_CFG;
		
/*     �����Ƽ��ӿڽ��ܣ�
  
  		$param = array(
			"num" => 1,	//���صĸ��� 
			"complement" => 1, 	//�Ƿ��Զ�����
			"top" => 1, 		//��������
			"type" => 1, 		// 1�������Ƽ��� 2�������¼�Ƽ� 
			"commodityIDs" => 2001-22003		//�û������¼��ƷID
		);		
*/
		
		$url = "http://" . self::getSearchUrl() . "/huangpu/RecommendationCgi?" . $param;
	
//    	echo str_replace($_IP_CFG['SEARCH_PAIPAI'], 'searchex.paipai.com', $url) . "<br/>";

		$response = NetUtil::cURLHTTPGet($url, $timeout, 'searchex.paipai.com');
		
		if( false === $response ){
			self::$errCode = NetUtil::$errCode;
			self::$errMsg =  NetUtil::$errMsg;
			return false;
		}
		
		$res = preg_replace("/^\s*var\s+recommendationCommodityID\=(.*)$/","$1", $response);
		$res = ToolUtil::gbJsonDecode($res);
		
		if( "" == $res ){
			self::$errCode = 100;
			self::$errMsg =  "ToolUtil::gbJsonDecode error: " . $url . " ; response: " . $response;			
		 	return false;
		}
		
		$product_ids = array();
		
		foreach($res as $item){
			$product_ids[] = $item["id"]; 
		}
		
		if( count( $product_ids ) < $count){
			self::$errCode = 101;
			self::$errMsg =  "records count returned from searchex are not enought: " . $url;
			
			return false;
		}
		
		$info = IProduct::getProductsInfo($product_ids, $site_id, false);
		
		if( false === $info ){
			self::$errCode = IProduct::$errCode;
			self::$errMsg =  IProduct::$errMsg;

			return false;
		}
		
		$items = array();
		$dirtyIds = array();
		$item_filter = array();
		foreach ($product_ids as $product_id) {
			if (isset($info[ $product_id ])) {
				$item = $info[ $product_id ];

				if ((false === $checkStatus) || ($item['status'] === 1 && $item['stock'] !== $_StockTips['not_available'])) {
					//���˵��۸��ظ�����Ʒ
					if (array_key_exists($item['show_price'], $item_filter)) {
						$item_filter[$item['show_price']][] = $item; //��¼�۸��ظ�����Ʒ��Ϣ
					}
					else {
						$item_filter[$item['show_price']] = array();

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

		//ȥ����Ʒ�۸���ͬ��,���ֲ������Ҫ��ȫ
		if (count($items) < $count) {
			foreach($item_filter as $_filter => &$_vals) {
				foreach($_vals as &$_val) {
					$items[] = $_val;
				}
			}
		}
		
		if( count( $items ) < $count && stripos( $param, "complement=1" ) != false  ){
			self::$errCode = 102;
			self::$errMsg =  "records count after filtered by local are not enought: " . $url . '; drity ids is : ' . implode(",", $dirtyIds);
			
			return false;
		}
		
		
		if(true === $needReview){
			$product_ids = array();
			
			foreach($items as $item){
				$product_ids[] = $item["product_id"];
			}
			
			$reviews = IReviews::getProductsReviewCount($product_ids, false);
		
			foreach($items as &$item){
				
				$product_id = $item['product_id'];
				if( false !== $reviews &&  isset( $reviews[$product_id] ) ) {
					$review = $reviews[$product_id];
					
					$item['review_length'] = $review['experience_number'] == 0 ? 100 : round( $review['satisfaction'] * 20 / $review['experience_number'], 0)  ;
					$item['review_count'] = $review['total']; 
				}
				else{
					$item['review_length'] = 0;
					$item['review_count'] = 0;
				}
			}
		}
		
		return $items;
	}
	
	/**
	 * ���ﳵ����һ�������Ʒ
	 * @param int $siteId
	 * @param int $count
	 * @param array $product_ids
	 * @param array $c3_ids
	 */
	public static function getCartAlwaysRecommend($siteId, $count, $product_ids, $c3_ids) {
		global $_StockTips, $_IP_CFG;
		$data_count = $count + 10; //��������ݶ��ȡ10������ֹ�޳��޻���Ʒ��������ʾ����
		$uid = IUser::getLoginUid();

		if (empty($uid)) {
			$uid = 0;
		}
		
		$product_ids = IItemRecommend::getData($uid, $siteId, $data_count, $product_ids, $c3_ids, $type=1);
		
		IItemRecommend::$status = 0;
		if ($product_ids === false) {
			IItemRecommend::$status = 1;
		} else if (empty($product_ids)) {
			IItemRecommend::$status = 2;
		}
		
		if (count($product_ids) < $data_count) {
			Logger::info("records count returned from searchex are not enought. count(product_ids):".count($product_ids));
		}
		
		if(count($product_ids) < $count){
			self::$errCode = 101;
			self::$errMsg = "records count returned from searchex are not enought. count(product_ids):".count($product_ids);
			return false;
		}
		
		$info = IProduct::getProductsInfo($product_ids, $siteId, false);
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
				if ( $item['status'] === 1 && $item['stock'] != $_StockTips['not_available'] && $item['stock'] != $_StockTips['not_enough'] ) {
					//���˵��۸��ظ�����Ʒ
					if (array_key_exists($item['show_price'], $item_filter)) {
						$item_filter[$item['show_price']][] = $item; //��¼�۸��ظ�����Ʒ��Ϣ
					}
					else {
						$item_filter[$item['show_price']] = array();

						$item['title'] = strip_tags($item['name']);
						$items[] = $item;
						if (count($items) == $data_count) {
							break;
						}
					}

				}
				else {
					$dirtyIds[] = $product_id;
				}
			}
			else {
				$dirtyIds[] = $product_id;
			}
		}
		
		//ȥ����Ʒ�۸���ͬ��,���ֲ������Ҫ��ȫ
		if (count($items) < $count) {
			foreach($item_filter as $_filter => &$_vals) {
				foreach($_vals as &$_val) {
					$items[] = $_val;
				}
			}
		}
		
		if (count($items) < $count) {
			self::$errCode = 102;
			self::$errMsg = "records count after filtered by local are not enought drity ids is : " . implode(',', $dirtyIds) . ' count:' . $count . ' count($items):' . count($items) . ' items:' . var_export($items, true);
			return false;
		}

		$click = IItemRecommend::$clickParams;
		$policyId = IItemRecommend::$policyId;
		$newItems = array();
		$i = 1;
		foreach ($items as $item) {
			if ($i > $count) break;
			$data[] = $item['product_id'];
			$newItems[] = $item;
			$i++;
		}
		$curUrl = 'http://www.51buy.com';
		if(!empty($data)){
			IItemRecommend::pvUp(implode(",", $data), $curUrl, $uid, 0, 0, $click, $policyId, $type=1);
			self::$clicks = $click;
			self::$policyId = $policyId;
		}
		
		return $newItems;
	}

	//����ҳ��������+�����ֿ�
	public static function getBoughtAndReviewProducts($siteId, $count, $product_id, $c3_id) {
		$data_count = $count + 15; //��������ݶ��ȡ15������ֹ�޳��޻���Ʒ��������ʾ����
		global $_IP_CFG;
		$uid = IUser::getLoginUid();

		if (empty($uid)) {
			$uid = 0;
		}

		$product_ids = IItemRecommend::getData($uid, $siteId, $data_count, $product_id, $c3_id);
		IItemRecommend::$status = 0;
		if ($product_ids === false) {
			IItemRecommend::$status = 1;
		} else if (empty($product_ids)) {
			IItemRecommend::$status = 2;
		}
		if (count($product_ids) < $data_count) {
			self::$errCode = 101;
			self::$errMsg = "records count returned from searchex are not enought. count(product_ids):".count($product_ids);
			return false;
		}

		//���ص�$product_ids,�ӵ�1����ʼ��$data_count(�������)��:���������Ʒ���û�������
		$Review_items = self::BoughtAndReviewProductsReturn($product_ids, $siteId, $count, 0, $data_count);
		if (false === $Review_items) {
			self::$errCode = 102;
			self::$errMsg = 'call BoughtAndReviewProductsReturn return Review_items failed.';
			return false;
		}

		//���ص�$product_ids,��$data_count(�������)�������:���������Ʒ���û�������
		$Bought_items = self::BoughtAndReviewProductsReturn($product_ids, $siteId, $count, $data_count, (count($product_ids) -1));
		if (false === $Bought_items) {
			self::$errCode = 103;
			self::$errMsg = 'call BoughtAndReviewProductsReturn return Bought_items failed.';
			return false;
		}

		return array('Review_items' => $Review_items, 'Bought_items' => $Bought_items);
	}

	/**
	 * ����ҳ��������+�����ֿ� ��Ʒ��ŷ���
	 * ���ص�$product_ids,�ӵ�1����ʼ��$data_count(�������)��:���������Ʒ���û�������
	 * ���ص�$product_ids,��$data_count(�������)�������:���������Ʒ���û�������
	 * @param $product_ids ��Ʒ���
	 * @param $siteId ����id
	 * @param $count �������
	 * @param $beginNum ��ʼ�±�
	 * @param $endNum �����±�
	 */
	public static function BoughtAndReviewProductsReturn($product_ids, $siteId, $count, $beginNum, $endNum){
		$product_ids = array_slice($product_ids, $beginNum, $endNum);
		$info = IProduct::getProductsInfo($product_ids, $siteId, false);
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

				if ( ($item['status'] === 1 && $item['stock'] !== $_StockTips['not_available'])) {
					//���˵��۸��ظ�����Ʒ
					if (array_key_exists($item['show_price'], $item_filter)) {
						$item_filter[$item['show_price']][] = $item; //��¼�۸��ظ�����Ʒ��Ϣ
					}
					else {
						$item_filter[$item['show_price']] = array();

						$item['title'] = strip_tags($item['name']);
						$items[] = $item;
						if (count($items) == $data_count) {
							break;
						}
					}

				}
				else {
					$dirtyIds[] = $product_id;
				}
			}
			else {
				$dirtyIds[] = $product_id;
			}
		}
		//ȥ����Ʒ�۸���ͬ��,���ֲ������Ҫ��ȫ
		if (count($items) < $count) {
			foreach($item_filter as $_filter => &$_vals) {
				foreach($_vals as &$_val) {
					$items[] = $_val;
				}
			}
		}
		if (count($items) < $count) {
			self::$errCode = 102;
			self::$errMsg = "records count after filtered by local are not enought drity ids is : " . implode(',', $dirtyIds) . ' count:' . $count . ' count($items):' . count($items) . ' items:' . var_export($items, true);
			return false;
		}

		$click = IItemRecommend::$clickParams;
		$policyId = IItemRecommend::$policyId;
		$newItems = array();
		$i = 1;
		foreach ($items as $item) {
			if ($i > $count) break;
			$data[] = $item['product_id'];
			$newItems[] = $item;
			$i++;
		}
		$curUrl = 'http://www.51buy.com';
		if(!empty($data)){
			IItemRecommend::pvUp(implode(",", $data), $curUrl, $uid, 0, 0, $click, $policyId);
			self::$clicks = $click;
			self::$policyId = $policyId;
		}

		return $newItems;
	}

	//����ϲ��
	public static function getPersonalProducts($siteId, $count, $isall = false) {
		global $_IP_CFG;
		$_IP_CFG['PERSONAL_GETDATA'] = $_IP_CFG['PERSONAL_LIKEGETDATA'];
		if ($isall) {
			if (isset($_IP_CFG['PERSONAL_LIKEGETDATA_EVENT'])) {
				//ÿ�վ�ѡ��ѡ�����Ҫ��������㷨
				$_IP_CFG['PERSONAL_GETDATA'] = $_IP_CFG['PERSONAL_LIKEGETDATA_EVENT'];
			}
		}
		$uid = IUser::getLoginUid();

		if (empty($uid)) {
			$uid = 0;
		}

		$scenceID = $siteId . 4;
		IPersonal::$darkNightType = 1003;
		if ($isall) IPersonal::$darkNightType = 1007;
		$product_ids = IPersonal::getData($uid, $scenceID, $siteId, $count);

		IPersonal::$status = 0;
		if ($data === false) {
			IPersonal::$status = 1;
		} else if (empty($data)) {
			IPersonal::$status = 2;
		}

		if (count($product_ids) < $count) {
			self::$errCode = 101;
			self::$errMsg = "records count returned from searchex are not enought: {$url}";
			return false;
		}

		$info = IProduct::getProductsInfo($product_ids, $siteId, false);
		if (false === $info) {
			self::$errCode = IProduct::$errCode;
			self::$errMsg = IProduct::$errMsg;
			return false;
		}

		$items = array();
		$dirtyIds = array();
		$item_filter = array();
		global $_StockTips;

		foreach ($product_ids as $product_id) {
			if (isset($info[ $product_id ])) {
				$item = $info[ $product_id ];

				if (($item['status'] === 1 && $item['stock'] !== $_StockTips['not_available'])) {
					//���˵��۸��ظ�����Ʒ
					if (array_key_exists($item['show_price'], $item_filter)) {
						$item_filter[$item['show_price']][] = $item; //��¼�۸��ظ�����Ʒ��Ϣ
					}
					else {
						$item_filter[$item['show_price']] = array();

						$item['title'] = strip_tags($item['name']);
						$items[] = $item;
						if (count($items) == $count) {
							break;
						}
					}

				}
				else {
					$dirtyIds[] = $product_id;
				}
			}
			else {
				$dirtyIds[] = $product_id;
			}
		}

		//ȥ����Ʒ�۸���ͬ��,���ֲ������Ҫ��ȫ
		if (count($items) < $count) {
			foreach($item_filter as $_filter => &$_vals) {
				foreach($_vals as &$_val) {
					$items[] = $_val;
				}
			}
		}

		if (count($items) < $count) {
			self::$errCode = 102;
			self::$errMsg = "records count after filtered by local are not enought: {$url}; drity ids is : " . implode(',', $dirtyIds);
			//return false;
		}


		$click = IPersonal::$clickParams;
		$policyId = IPersonal::$policyId;

		$newItems = array();
		$i = 0;
		foreach ($items as $item) {
			if ($i > 5 && $isall == false) break;
			$data[] = $item['product_id'];
			$newItems[] = $item;
			$i++;
		}

		$curUrl = 'http://www.51buy.com';
		IPersonal::pvUp(implode(",", $data), $curUrl, $uid, $scenceID, 0, 0, $click, $policyId);
		self::$clicks = $click;
		self::$policyId = $policyId;
		return $newItems;
	}
}