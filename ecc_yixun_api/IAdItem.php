<?php
/*错误码定义
 * 21 => 所查询的广告位类型或广告位id为空
 * 22 => 未找到指定广告位类型
 * 31 => 需要删除广告的广告位类型不能为空
 * 32 => 需要删除广告的ID不能为空
 * 33 => 删除广告失败
 */
class IAdItem{
	public static $errMsg = "";
	public static $errCode = 0;
	public static $bizType = array(1 => '全部商品', 2 => '某商品', 3 => '某小类中的某品牌', 4 => '某小类', 5 => '某品牌 ', 
								   6 => '某大类', 7 => '某中类', 8 => '广告组');
	public static $siteList = array(1 => '上海站', 1001 => '深圳站', 2001 => '北京站', 3001 => '武汉站', 4001 => '重庆站', 5001 => '西安站'); 
	
	/**
	 * json - 返回指定广告位类型的广告
	 * @author railszhu
	 * @param $biz 广告位类型数组
	 */
	public static function ad_itemlist($bizArr) {
		$itemList = array();
		$filter = array('status' => 1, 'fid' => 0);
		if (isset($_POST['wid']) && $_POST['wid']) {
			$filter['wid'] = intval($_POST['wid']);
		}
		if (isset($_POST['bid']) && $_POST['bid']) {
			$filter['bid'] = intval($_POST['bid']);
		}
		if (isset($_POST['pid']) && $_POST['pid']) {
			$filter['pid'] = intval($_POST['pid']);
		}
		if (isset($_POST['cid']) && $_POST['cid']) {
			$filter['cid'] = intval($_POST['cid']);
		}
		foreach ($bizArr as $biz) {
			$rs = IAdItemDetailTTC::get($biz, $filter);
			if ($rs === false) {
				return array('Rows' => '');
			}
			if (count($rs)) {
				foreach ($rs as $v) {
					$itemList[$v['id']] = $v;
				}
			}
		}
		rsort($itemList);
		foreach ($itemList as $k => $v) {
			$itemList[$k]['wid_name'] = self::$siteList[$v['wid']];
			$itemList[$k]['biz_name'] = empty(self::$bizType[$v['biz']]) ? '-' : '<a title="' . self::$bizType[$v['biz']] . '">' . self::$bizType[$v['biz']] . '</a>';
			$baseInfo = @IProduct::getBaseInfo($v['pid'], $v['wid']);
			$pdName = ($baseInfo === false) ? '' : $baseInfo['name'];
			$itemList[$k]['pd_name'] = empty($pdName) ? '-' : '<a title="' . $pdName . '">' . $pdName . '</a>';
			$itemList[$k]['brand_name'] = getBrandName($v['bid']);
			$itemList[$k]['cate_name'] = getCName($v['biz'], $v['cid']);
			$itemList[$k]['ad_url'] = empty($v['adurl']) ? '-' : '<a title="' . $v['adurl'] . '" href="' . $v['adurl'] . '">' . $v['adurl'] . '</a>';
			$itemList[$k]['ad_url2'] = empty($v['adurl2']) ? '-' : '<a title="' . $v['adurl2'] . '" href="' . $v['adurl2'] . '">' . $v['adurl2'] . '</a>';
			$itemList[$k]['link_url'] = empty($v['turl']) ? '-' : '<a title="' . $v['turl'] . '" href="' . $v['turl'] . '">' . $v['turl'] . '</a>';
			$itemList[$k]['user_name'] = Tools::get_user_name($v['user_id']);
		}
		$items['Rows'] = $itemList;
		return $items;
	}

	/**
	 * json - 返回某个广告
	 * @author railszhu
	 * @param $biz 广告位类型
	 * @param $id  广告信息id
	 * @return $item 广告信息hash数组
	 */
	public static function ad_item($biz, $id) {
		if (!$biz || !$id) {
			self::$errMsg = '所查询的广告位类型或广告位id为空';
			self::$errCode = 21;
			return '';
		}
		$filter = array('status' => 1, 'id' => $id);
		$rs = IAdItemDetailTTC::get($biz, $filter);
		if ($rs === false) {
			self::$errMsg = '未找到指定广告位类型';
			self::$errCode = 22;
			return '';
		}
		$v = $rs[0];
		$v['starttime'] = date("Y-m-d",strtotime($v['starttime']));//只显示日期
		$v['endtime'] = date("Y-m-d",strtotime($v['endtime']));
		$biz = $v['biz'];
		$cid = $v['cid'];
		$DB = Config::getMSDB('ERP_1'); //获取各类目ID
		if($biz == 3 || $biz == 4) {
			$c3id = $cid;
			$rs = $DB->getRows("select C2SysNo from dbo.Category3 where SysNo=". $c3id);
			$c2id =  $rs == false ? '0' : $rs[0]['C2SysNo'];
			$rs = $DB->getRows("select C1SysNo from dbo.Category2 where SysNo=". $c2id);
			$c1id =  $rs == false ? '0' : $rs[0]['C1SysNo'];
			$v['c1id'] = $c1id;
			$v['c2id'] = $c2id;
			$v['c3id'] = $c3id;
		} else if($biz == 6) {
			$c1id = $cid;
			$v['c1id'] = $c1id;
			$v['c2id'] = 0;
			$v['c3id'] = 0;
		} else if($biz == 7) {
			$c2id = $cid;
			$rs = $DB->getRows("select C1SysNo from dbo.Category2 where SysNo=". $c2id);
			$c1id =  $rs == false ? '0' : $rs[0]['C1SysNo'];
			$v['c1id'] = $c1id;
			$v['c2id'] = $c2id;
			$v['c3id'] = 0;
		}
		return $v;	
	}

	/**
	 * 删除某个广告
	 * @author railszhu
	 * @param $biz 广告位类型
	 * @param $id  广告信息id
	 * @return 删除结果信息
	 */
	public static function delete_item($biz, $id) {
		if (!$biz) {
			self::$errCode = 31;
			self::$errMsg = "需要删除广告的广告位类型不能为空";
			return array('result' => false, 'errMsg' => 'BIZ不能为空');
		}
		if (!$id) {
			self::$errCode = 32;
			self::$errMsg = "需要删除广告的ID不能为空";
			return array('result' => false, 'errMsg' => 'ID不能为空');
		}
		
		$data = array(
			'biz' => $biz,
			'status' => 0,
			'updatetime' => date('Y-m-d')
		);
		$filter = array('id' => $id);
		$rs = IAdItemDetailTTC::update($data, $filter);
		if ($rs === false) {
			self::$errCode = 33;
			self::$errMsg = "删除广告失败";			
			return array('result' => false, 'errMsg' => IAdItemDetailTTC::$errMsg);
		} else {
				if($biz == 8) { //当更新对象为广告组时，需要同时把组内成员数据进行更新
					$bizArr = array(1, 2, 3, 4, 5, 6, 7);
					$items =self::ad_member($bizArr, $id); //获得广告组内成员
					$member_list = $items['Rows'];
					foreach ($member_list as $member) {
						$member_biz = $member['biz'];
						$member_id = $member['id'];
						$filter = array('id' => $member_id);
						$data = array(
							'biz' => $member_biz,
							'status' => 0,
							'updatetime' => date('Y-m-d')
						);
						
						$rs = IAdItemDetailTTC::update($data, $filter);
						if ($rs === false) {
							self::$errCode = 34;
							self::$errMsg = "删除广告组成员失败";			
							return array('result' => false, 'errMsg' => IAdItemDetailTTC::$errMsg);
						}					
					}				
				}	
				return array('result' => true);
		}
	}
	/**
	 * 返回所有某组成员广告
	 * @author railszhu
	 * @param $bizArr 广告位类型数组
	 * @param $fid 组id
	 * @return 组成员信息
	 */
	public static function ad_member($bizArr, $fid) {
		if (!$bizArr) {
			self::$errMsg = '广告位类型数组为空';
			self::$errCode = 41;
			return '';
		}
		if (!$fid) {
			self::$errMsg = '所查询的广告组id为空';
			self::$errCode = 42;
			return '';
		}
		$filter = array('status' => 1, 'fid' => $fid);
		$itemList = array();
		foreach ($bizArr as $biz) {
			$rs = IAdItemDetailTTC::get($biz, $filter);
			if ($rs === false) {
				self::$errMsg = '广告组查询失败';
				self::$errCode = 43;
				return array('Rows' => '');
			}
			if (count($rs)) {
				foreach ($rs as $v) {
					$itemList[$v['id']] = $v;
				}
			}
		}
		rsort($itemList);
		foreach ($itemList as $k => $v) {
			$itemList[$k]['wid_name'] = self::$siteList[$v['wid']];
			$itemList[$k]['biz_name'] = empty(self::$bizType[$v['biz']]) ? '-' : '<a title="' . self::$bizType[$v['biz']] . '">' . self::$bizType[$v['biz']] . '</a>';
			$baseInfo = @IProduct::getBaseInfo($v['pid'], $v['wid']);
			$pdName = ($baseInfo === false) ? '' : $baseInfo['name'];
			$itemList[$k]['pd_name'] = empty($pdName) ? '-' : '<a title="' . $pdName . '">' . $pdName . '</a>';
			$itemList[$k]['brand_name'] = getBrandName($v['bid']);
			$itemList[$k]['cate_name'] = getCName($v['biz'], $v['cid']);
			$itemList[$k]['ad_url'] = empty($v['adurl']) ? '-' : '<a title="' . $v['adurl'] . '" href="' . $v['adurl'] . '">' . $v['adurl'] . '</a>';
			$itemList[$k]['ad_url2'] = empty($v['adurl2']) ? '-' : '<a title="' . $v['adurl2'] . '" href="' . $v['adurl2'] . '">' . $v['adurl2'] . '</a>';
			$itemList[$k]['link_url'] = empty($v['turl']) ? '-' : '<a title="' . $v['turl'] . '" href="' . $v['turl'] . '">' . $v['turl'] . '</a>';
			$itemList[$k]['user_name'] = Tools::get_user_name($v['user_id']);
		}
		$items['Rows'] = $itemList;
		return $items;
	}

}
