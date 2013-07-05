<?php

/*
 * 广告投放关系类 -- 后台广告管理使用
 * @author railszhu
 * @version 1.0
 */

class IAdMap{
	public static $key = 1; 	    //TTC主键
	public static $errMsg = "";     //错误信息
	public static $errCode = 0;     //错误代号
	public static $inaccuracy = 10; //图片尺寸允许的误差
		
	/*
	 * 获得某广告所投放的所有广告位ID
	 * @param  $aid => 广告ID
	 * @return $pid => 投放的广告位ID数组
	 * @author railszhu
	 */
	public static function get_pid($aid) {
		$filter = array('aid' => $aid, 'status' => 1 ); //只取状态为启用的广告位
		$rs = IAdMapTTC::get(self::$key, $filter);
		if ($rs === false) {
			self::$errCode = 11;
			self::$errMsg  = '获取投放的广告位失败';
			return '';
		}
		$pid = array();
		if (count($rs)) {
			foreach ($rs as $v) {
				$pid[] = $v['pid'];
			}
		}
		return $pid;
	}
	
	/*
	 * 投放广告，一个广告投放到多个广告位
	 * @param  $para = array(
	 *			'pid' => 目标广告位ID数组,
	 *			'aid' => 待投放广告ID,
	 *			'user_id' => 用户ID,
	 *			'status' => 1
	 *			);
	 * @return $msg => array('msg' => '错误信息');
	 * @author railszhu
	 */
    public static function uploadMap($para) {
    	//首先取得广告信息，用来判断图片是否符合要求
    	$filter_ad = array('aid' => $para['aid']);
		$rs_ad = IAdInfoTTC::get(IAdInfo::$key, $filter_ad);
		if($rs_ad === false) {
			self::$errCode = 21;
			self::$errMsg  = '向表info读取广告信息失败';
			return array('msg' => '获取广告信息失败！');
		}
		$ad_info = $rs_ad[0];
		$start_time = $ad_info['starttime']; //获得广告有效时间
		$end_time = $ad_info['endtime'];
		if(!empty($ad_info['content'])) { //获得广告类型
			$type = 2;
		} else {
			$type = 1;
			//取出宽屏图片大小
			$arr = ToolUtil::getImageSize($ad_info['adurl']);
			if(!$arr) {
				return array('msg' => '获取宽屏图片信息失败！');
			} else{
				$w_width = $arr['width'];
				$w_height = $arr['height'];
			}
			//若已上传窄屏图片，取出窄屏图片大小
			if(!empty($ad_info['adurl2'])) {
				$brr = ToolUtil::getImageSize($ad_info['adurl2']);
				if(!$brr) {
					return array('msg' => '获取窄屏图片信息失败！');
				} else {
					$n_width = $brr['width'];
					$n_height = $brr['height'];
				}
			}
		}
		foreach ($para['pid'] as $pid) {
			//先判断该广告位上已投放的广告与待投放的广告时间是否有重叠
			/*$filter_m = array('pid' => $pid, 'status' => 1, 'site_id' => $para['site_id']);
			$rs_aid = IAdMapTTC::get(IAdMap::$key, $filter_m);
			if($rs_aid === false) {
				self::$errCode = 22;
				self::$errMsg  = '向表map读取广告位上的广告信息失败';
				return array('msg' => '获取广告位'.$pid.'上投放的广告信息失败！');
			}
			$aid_list = array();
			if(count($rs_aid)) {
				foreach($rs_aid as $k => $v) {
					$aid_list[] = $v['aid'];
				}
			}
			foreach($aid_list as $aid_2) {
				$filter_ad2 = array('aid' => $aid_2);
				$rs_ad2 = IAdInfoTTC::get(IAdInfo::$key, $filter_ad2);
				if($rs_ad2 === false) {
					self::$errCode = 23;
					self::$errMsg  = '向表info读取广告信息失败';
					return array('msg' => '获取广告'.$aid_2.'信息失败！');
				}
				$ad_info2 = $rs_ad2[0];
				$start_time2 = $ad_info2['starttime'];
				$end_time2 = $ad_info2['endtime'];
				if(!($start_time > $end_time2 || $end_time < $start_time2)) {
					return array('msg' => '广告投放时间与广告位'.$pid.'上的广告'.$aid_2.'有重叠！');
				}
			}	*/		 
			//若是图片广告，则首先判断该广告图片大小能否满足要求
			if($type == 1) {
				$filter_p = array('pid' => $pid);
				$rs_p = IAdPositionTTC::get(IAdPosition::$key, $filter_p);
				if($rs_p === false) {
					self::$errCode = 22;
					self::$errMsg  = '向表position读取广告位信息失败';
					return array('msg' => '获取广告位'.$pid.'信息失败！');
				}
				$position_info = $rs_p[0];
				$p_width = $position_info['width'];
				$p_height = $position_info['height'];
				$p_width2 = $position_info['width2'];
				$p_height2 = $position_info['height2'];
				if($w_width < ($p_width-self::$inaccuracy)) {
					return array('msg' => '该广告无法满足广告位'.$pid.'的宽屏图片尺寸要求，宽度偏小！');
				} else if($w_width > ($p_width+self::$inaccuracy)) {
					return array('msg' => '该广告无法满足广告位'.$pid.'的宽屏图片尺寸要求，宽度偏大！');
				} else if($w_height < ($p_height-self::$inaccuracy)) {
					return array('msg' => '该广告无法满足广告位'.$pid.'的宽屏图片尺寸要求，高度偏小！');
				} else if($w_height > ($p_height+self::$inaccuracy)) {
					return array('msg' => '该广告无法满足广告位'.$pid.'的宽屏图片尺寸要求，高度偏大！');
				} else if(!empty($ad_info['adurl2'])) { 
					if($n_width < ($p_width2-self::$inaccuracy)) {
						return array('msg' => '该广告无法满足广告位'.$pid.'的窄屏图片尺寸要求，宽度偏小！');
					} else if($n_width > ($p_width2+self::$inaccuracy)) {
						return array('msg' => '该广告无法满足广告位'.$pid.'的窄屏图片尺寸要求，宽度偏大！');
					} else if($n_height < ($p_height2-self::$inaccuracy)) {
						return array('msg' => '该广告无法满足广告位'.$pid.'的窄屏图片尺寸要求，高度偏小！');
					} else if($n_height > ($p_height2+self::$inaccuracy)) {
						return array('msg' => '该广告无法满足广告位'.$pid.'的窄屏图片尺寸要求，高度偏大！');
					}
				}
			}
			$filter = array('pid' => $pid, 'aid' => $para['aid'], 'site_id' => $para['site_id']);
			$rs = IAdMapTTC::get(self::$key, $filter); //首先判断该广告是否曾经投放过该广告位
			if($rs) {//投放过
				if($rs[0]['status'] == 0) { //已经撤销，则再次投放，更新status即可
					$data = array('updatetime' => date('Y-m-d'), 'status' => 1, 'mid' => self::$key);
					$rs = IAdMapTTC::update($data, $filter);
					if ($rs === false) {
						self::$errCode = 23;
						self::$errMsg  = '获取投放信息失败';   
						return array('msg' => IAdMapTTC::$errMsg);
					}	
				} else { //若并未删除，则提示错误信息
						return array('msg' => '当前广告已投入在该广告位，请重新选择!');
				}
			} else { //未投放过，则新建数据插入
				$data = array(
						'pid' => $pid,
						'aid' => $para['aid'],
						'seq' => 1,    //TODO
						'createtime' => date('Y-m-d'),
						'updatetime' => date('Y-m-d'),	
					   	'user_id' => $para['user_id'],
						'status' => $para['status'],
						'mid' => self::$key,
						'site_id' => $para['site_id']  
				);
				$rs = IAdMapTTC::insert($data);
				if ($rs === false) {
					self::$errCode = 24;
					self::$errMsg  = '投放广告失败';
					return array('msg' => IAdMapTTC::$errMsg);
				}
			}
		} 		
		return array('msg' => 'success!!');
    }
    /*
	 * 取消投放广告
	 * @param  $para = array(
	 *			'pid' => 目标广告位ID数组,
	 *			'aid' => 待取消投放广告ID,
	 *			'user_id' => 用户ID,
	 *			'status' => 0
	 *			);
	 * @return $msg => array('msg' => '错误信息');
	 * @author railszhu
	 */
    public static function updateMap($para) {
    	foreach($para['pid'] as $pid) {
	    	$filter = array('pid' => $pid, 'aid' => $para['aid']);
	    	$data = array(
					'updatetime' => date('Y-m-d'),	
					'mid' => self::$key
			);
	    	foreach ($para as $k => $v) {
	    		if($k != 'pid' && $k !='aid') {
	    			$data[$k] = $v;
	    		}
	    	}
			$rs = IAdMapTTC::update($data, $filter);
			if ($rs === false) {
				self::$errCode = 31;
				self::$errMsg  = '取消投放广告失败';
				return array('msg' => IAdMapTTC::$errMsg);
			}
    	}		
		return array('msg' => 'success!!');
    }
    
    public static function findAdMaps($conditions) {
    	$filter = array();
    	if(is_array($conditions)) {
    		if(isset($conditions['pid']) && !empty($conditions['pid'])) {
    			$filter['pid'] = $conditions['pid'];
    		}
    		
    		if(isset($conditions['aid']) && !empty($conditions['aid'])) {
    			$filter['aid'] = $conditions['aid'];
    		}
    		
    		if(isset($conditions['site_id']) && !empty($conditions['site_id'])) {
    			$filter['site_id'] = $conditions['site_id'];
    		}
    		
    		if(isset($conditions['status']) && !empty($conditions['status'])) {
    			$filter['status'] = $conditions['status'];
    		}
    	} else 
    		throw new BaseException(101, 'Unexpect search condition.');
    	$res = IAdMapTTC::get(self::$key, $filter);
    	if($res === false)
    		throw new BaseException(102, 'Failed to find advertise maps.');
    	return $res;
    }
    
    public static function modifyAdMap($aid, $pid, $site_id, $properties) {
    	$filter = array( 'aid' => $aid, 'pid' => $pid, 'site_id' => $site_id );
    	$properties['mid'] = self::$key;
    	$res = IAdMapTTC::update($properties, $filter);
    	if($res === false) {
    		throw new BaseException(101, 'Failed to modify advertise map.');
    	}
    }
    
    public static function removeAdMap($aid, $pid, $site_id) {
    	$filter = array( 'aid' => $aid, 'pid' => $pid, 'site_id' => $site_id );
    	$res = IAdMapTTC::remove(self::$key, $filter);
    	if($res === false) {
    		throw new BaseException(101, 'Failed to remove advertise map.');
    	}
    }
}