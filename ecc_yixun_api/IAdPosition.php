<?php

/*
 * 广告位管理类 -- 后台广告管理使用
 * @author railszhu
 * @version 1.0
 */
class IAdPosition{
	public static $errMsg = "";
	public static $errCode = 0;
	public static $inaccuracy = 10; //图片尺寸允许的误差
	public static $key = 1; //IAdPositionTTC的主键
	public static $status = array(1 => '启用', 2 => '未启用'); //启用状态
	public static $type = array(1 => '图片广告', 2 => '文字链接'); //广告形式
	public static $siteList = array(1 => '上海站', 1001 => '广东站', 2001 => '北京站', 3001 => '湖北站', 4001 => '重庆站');//分站点
	
	/**
	 * 
	 * 返回所有广告位信息
	 * @author railszhu
	 * @return $positions 数据数组，以Rows为key, 数据列表为value
	 */
	public static function ad_positionList() {
		$positionList = array();
		$filter = array();
		if (isset($_POST['cid']) && $_POST['cid']) {
			$filter['cid'] = intval($_POST['cid']);
		}
		if (isset($_POST['status']) && $_POST['status']) {
			$filter['status'] = intval($_POST['status']);
		}
		if (isset($_POST['name']) && $_POST['name']) {
			$filter['name'] = trim($_POST['name']);
		}
		if (isset($_POST['comment']) && $_POST['comment']) {
			$filter['comment'] = trim($_POST['comment']);
		}
		if (isset($_POST['type']) && $_POST['type']) {
			$filter['type'] = intval($_POST['type']);
		}
		$rs = IAdPositionTTC::get(self::$key, $filter);
		if ($rs === false) {
			self::$errCode = 11;
			self::$errMsg  = '获取position列表失败';
			return array('Rows' => '');
		}
		if (count($rs)) {
			foreach ($rs as $v) {
				$positionList[$v['pid']] = $v;
			}
		}
		rsort($positionList);
		foreach ($positionList as $k => $v) {
			$positionList[$k]['name'] = empty($v['name']) ? '-' : '<a title="'.$v['name'].'" onclick="modifyPosition(\''.$v['pid'].'\')">'.$v['name'].'</a>';
			$positionList[$k]['name2'] = empty($v['name']) ? '-' : '<p title="'.$v['name'].'">'.$v['name'].'</p>';;
			$rs = IAdGroup::ad_group($v['cid'],1);
			if(empty($rs)) {
				self::$errCode = 12;
				self::$errMsg  = '获取频道页面信息失败';
				continue; //未取到当前频道页面数据，则继续下一循环
			}
			$positionList[$k]['channel'] = '<p title="'.$rs['comment'].'">'.$rs['comment'].'</p>';
			$positionList[$k]['type'] = self::$type[($v['type'])];
			$positionList[$k]['size'] = (empty($v['width'])||empty($v['height'])) ? '---' : $v['width'].' x '.$v['height'];
			$positionList[$k]['size2'] = (empty($v['width2'])||empty($v['height2'])) ? '---' : $v['width2'].' x '.$v['height2'];
			$positionList[$k]['comment'] = empty($v['comment']) ? '-' : '<p title="'.$v['comment'].'">'.$v['comment'].'</p>';
			//以页面id作为select的id，并增加onChange事件触发的updateStatus函数，用于实现列表页面直接修改状态功能
			$positionList[$k]['status'] = Tools::get_select($v['pid'], self::$status, '', $v['status'], false, 'onChange="updateStatus('.$v['pid'].')"');
			$positionList[$k]['status2'] = $v['status'];
			$positionList[$k]['user_name'] = Tools::get_user_name($v['user_id']);
		}
		$positions['Rows'] = $positionList;
		return $positions;
	}
	
	/**
	 * 
	 * 根据pid返回某个广告位信息
	 * @author railszhu
	 * @param $pid 广告位的ID
	 * @return $rs 广告位信息
	 */
	public static function ad_position($pid){
		if($pid <= 0) {
			self::$errCode = 21;
			self::$errMsg  = '广告位id错误';
			return array();
		}
		$filter = array('pid' => $pid);
		$rs = IAdPositionTTC::get(self::$key, $filter);
    	if ($rs === false) {
			self::$errCode = 22;
			self::$errMsg  = '向表position读取数据失败';
			return array();
		}
		return $rs[0];
	}
	
	/**
	 * 
	 * 上传广告位
	 * @author railszhu
	 * @param $key TTC主键
	 * @param $para 上传广告位信息
	 * @return array('msg' => 成功或错误信息);
	 */
	public static function uploadPosition($key, $para){
		if($key != self::$key) {
			self::$errCode = 31;
			self::$errMsg = '上传失败，TTC主键不正确';
			return array('msg' => 'TTC主键不正确');
		}
		$data = array(
				'cid' => $para['cid'],
				'name' => $para['name'],
				'type' => $para['type'],
				'width' => $para['width'],
				'height' => $para['height'],
				'width2' => $para['width2'],
				'height2' => $para['height2'],  				
				'status' => $para['status'],  
				'comment' => $para['comment'],  
				'createtime' => date('Y-m-d'),
				'updatetime' => date('Y-m-d'),	
			   	'user_id' => $para['user_id'],
				'mid' => $key
		);
		$rs = IAdPositionTTC::insert($data);
		if ($rs === false) {
			self::$errCode = 33;
			self::$errMsg = '向表position插入数据失败';
			return array('msg' => IAdPositionTTC::$errMsg);
		}			
		return array('msg' => 'success!!');
	}
	
    /**
	 * 
	 * 更新position数据
	 * @author railszhu
	 * @param $key TTC主键
	 * @param $para 所要修改的内容
	 * @return array('msg' => 成功或错误信息)
	 */
    public static function updatePosition($key, $para) {
    	if($key != self::$key) {
			self::$errCode = 41;
			self::$errMsg = '上传失败，TTC主键不正确';
			return array('msg' => 'TTC主键不正确');
		}
		$pid = $para['pid'];
	    $data = array(
			'mid' => $key,   
			'updatetime' => date('Y-m-d')
		);	
		foreach($para as $k => $v) {
			if($k != 'pid') {
				$data[$k] = $v;
			}
		}
		$filter = array('pid' => $para['pid']);
		$rs = IAdPositionTTC::update($data, $filter);
		if ($rs === false) {
			self::$errCode = 33;
			self::$errMsg = '向表position更新数据失败';
			return array('msg' => IAdPositionTTC::$errMsg);
		}
		return array('msg' => 'success!!');	
    }
    
     /**
	 * 
	 * 返回某站点或频道页面下的所有广告位
	 * @author railszhu
	 * @param $wid 频道所属站点ID
	 * @param $cid 频道页面ID
	 * @return 所有广告位
	 */
     public static function ad_positionName($cid) {
        if($cid < 0)
		{
			self::$errCode = 52;
			self::$errMsg  = '指定广告位ID不符合要求';
			return '';
		}
		if($cid != 0){
			$filter = array('cid' => $cid);
		} else {
			return array();
		}	
		$rs = IAdPositionTTC::get(self::$key, $filter);
		if ($rs === false) {
			self::$errCode = 53;
			self::$errMsg  = '向表position读取数据失败';
			return '';
		}
		$name = array();
		if (count($rs)) {
			foreach ($rs as $v) {
				$name[$v['pid']] = $v;
			}
		}
		return $name;	
     }
   
     /**
	 * 
	 * 返回某广告位下的所有广告
	 * @author railszhu
	 * @param $pid 广告位ID
	 * @return 所有广告
	 */
     public static function ad_showAd($pid, $st = 1) {
        if($pid <= 0)
		{
			self::$errCode = 61;
			self::$errMsg  = '指定广告位ID不符合要求';
			return '';
		}
		$filter_info = array();
     	if (isset($_POST['status']) && $_POST['status'] && $st == 1) {
			$filter_info['status'] = intval($_POST['status']);
		}
		$starttime = '';
		$endtime = '';
        if (isset($_POST['starttime']) && $_POST['starttime']) {
			$starttime = date("Y-m-d H:i",strtotime($_POST['starttime']));//只显示日期
		}
        if (isset($_POST['endtime']) && $_POST['endtime']) {
			$endtime = date("Y-m-d H:i",strtotime($_POST['endtime']));//只显示日期
		}		
		$filter = array('pid' => $pid, 'status' => 1);
		$rs = IAdMapTTC::get(IAdMap::$key, $filter);
		if($rs === false) {
			self::$errCode = 62;
			self::$errMsg  = '从Map表中提取投放信息失败';
			return '';
		}			
		$ad_list = array();
		$ad_info = array();
		if(count($rs)) {
			global $_Wh_id;
			foreach($rs as $k => $v) {
				$ad_list[] = $v['aid'];
			}
			rsort($ad_list);
			$k = 0;
			foreach ($rs as $r) {
				$filter_info['aid'] = $r['aid'];
				$rs_info = IAdInfoTTC::get(IAdInfo::$key, $filter_info);
				if($rs_info === false) {
					self::$errCode = 63;
					self::$errMsg  = '从info表中提取广告信息失败';
					return '';
				}
				if(count($rs_info)) {
					$v = $rs_info[0];
				} else {
					continue;
				}
				//筛选时间
				if($starttime) {
					if(date("Y-m-d H:i",strtotime($v['starttime'])) > $starttime) {
						continue;
					} 					
				}
				if($endtime) {
					if(date("Y-m-d H:i",strtotime($v['endtime'])) < $endtime) {
						continue;
					} else if(!$starttime) {
						if(date("Y-m-d H:i",strtotime($v['starttime'])) > $endtime) {
							continue;
						}
					}					
				}
				//$ad_info[$k] = $v;
				$ad_info[$k]['aid'] = $v['aid'];
				$ad_info[$k]['name'] =   empty($v['name']) ? '-' : '<a title="'.$v['name'].'">'.$v['name'].'</a>';
				$ad_info[$k]['status'] = Tools::get_select($v['aid'], self::$status, '', $v['status'], false, 'onChange="updateStatus('.$v['aid'].')"');
				$ad_info[$k]['date'] = date("Y-m-d H:i",strtotime($v['starttime'])).' - '.date("Y-m-d H:i",strtotime($v['endtime']));
				$ad_info[$k]['content'] =  empty($v['content']) ? '-' : '<p title="'.$v['content'].'">'.$v['content'].'</p>';
				$ad_id =  'k'.$v['aid'];
				$ad_id2 = 'z'.$v['aid'];
				$ad_info[$k]['adurl'] = $v['adurl'];
				$ad_info[$k]['adurl2'] = $v['adurl2'];
				$ad_info[$k]['adurl_'] = $v['adurl'];
				$ad_info[$k]['adurl2_'] = $v['adurl2'];
				$ad_info[$k]['url'] = empty($v['url']) ? '-' : '<a title="' . $v['url'] . '" target="_blank" href="' . $v['url'] . '">' . $v['url'] . '</a>';
				$ad_info[$k]['user_name'] = Tools::get_user_name($v['user_id']);
				$ad_info[$k]['site_id'] = $r['site_id'];
				$ad_info[$k]['site'] = $_Wh_id[$r['site_id']];
				$k++;
			}				
		}
		$ad_infos['Rows'] = $ad_info;
		echo self::$errMsg;
		return $ad_infos;
     }
     
     /**
	 * 
	 * 返回某广告未投递的所有广告
	 * @author railszhu
	 * @param $aid 广告ID
	 * @return 所有未投放的广告位
	 */
      public static function ad_notPositionList($aid) {
      	$pid_delivery = IAdMap::get_pid($aid); //获得已经投放的广告位
      	$filter = array('aid' => $aid);
      	$rs = IAdInfoTTC::get(IAdInfo::$key, $filter);
      	if($rs === false) {
			self::$errCode = 71;
			self::$errMsg  = '从info表中提取广告信息失败';
			return '';
		}
      	$ad = $rs[0];
      	if(empty($ad['content'])) {
      		$ad_type = 1;
      	} else {
      		$ad_type = 2;
      	}
      	$pid_row = self::ad_positionList(); 
      	$pid_all = $pid_row['Rows'];//获得所有广告位
      	$pid_list = array();
      	$i = 0;
      	foreach($pid_all as $k => $v) {
      		if(!in_array($v['pid'], $pid_delivery) && $v['type'] == self::$type[$ad_type] && $v['status2'] == 1) {
      			$pid_list[$i] = $v; //获得未投放并且类型与广告一致的广告位
      			$i++;
      		}
      	}
      	$pid['Rows'] =  $pid_list;
      	return $pid;
      }
      
      public static function getPosition($id) {
		$filter = array('pid' => $id);
		$rs = IAdPositionTTC::get(self::$key, $filter);
    	if (empty($rs)) {
			throw new BaseException(101, "Failed to get position with $id.");
		}
		return $rs[0];
      }
      
      public static function findPositions($conditions) {
      	$filter = array();
      	if(is_array($conditions)) {
      		if(isset($conditions['cid']) && !empty($conditions['cid'])) {
      			$filter['cid'] = $conditions['cid'];
      		}
      		
      		if(isset($conditions['name']) && !empty($conditions['name'])) {
      			$filter['name'] = $conditions['name'];
      		}
      		
      		if(isset($conditions['comment']) && !empty($conditions['comment'])) {
      			$filter['comment'] = $conditions['comment'];
      		}
      		
      		if(isset($conditions['type']) && !empty($conditions['type'])) {
      			$filter['type'] = $conditions['type'];
      		}
      	
      		if(isset($conditions['status']) && !empty($conditions['status'])) {
      			$filter['status'] = $conditions['status'];
      		}
      	} else 
      		throw new BaseException(102, 'Unexpect search condition.');
      	$res = IAdPositionTTC::get(self::$key, $filter);
      	if($res === false)
      		throw new BaseException(101, 'Failed to find positions.');
      	return $res;
      }
}


