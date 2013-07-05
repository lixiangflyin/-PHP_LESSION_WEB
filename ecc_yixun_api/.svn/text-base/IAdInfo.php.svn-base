<?php

/*
 * 广告页面管理类 -- 后台广告管理使用
 * @author railszhu
 * @version 1.0
 */
class IAdInfo{
	public static $errMsg = "";
	public static $errCode = 0;
	public static $inaccuracy = 10; //图片尺寸允许的误差
	public static $key = 1; //IAdInfoTTC的主键
	public static $status = array(1 => '启用', 2 => '未启用'); //启用状态
	public static $type = array(1 => '图片广告', 2 => '文字链接'); //广告形式
	public static $siteList = array(1 => '上海站', 1001 => '广东站', 2001 => '北京站', 3001 => '湖北站', 4001 => '重庆站');//分站点
	
	/**
	 * 
	 * 返回所有广告信息
	 * @author railszhu
	 * @return $infos 数据数组，以Rows为key, 数据列表为value
	 */
	public static function ad_infoList() {
		$filter_channel = array();  //频道页面的筛选条件
		$filter_position = array(); //广告位的筛选条件
		$filter_map = array();      //投放关系的筛选条件
		$filter_info = array();     //广告信息的筛选条件
		$ad_list = array();         //符合所有筛选条件的广告
		$flag_map = 0; 				//供向表map提取aid使用
		$flag = 0; 					//供向表position提取pid使用
		//得到筛选广告的条件信息
		if(isset($_POST['status']) && $_POST['status']) {
			$filter_info['status'] =  intval($_POST['status']);
		}
		if(isset($_POST['gid']) && $_POST['gid']) {
			$filter_info['gid'] =  intval($_POST['gid']);
		}
		if(isset($_POST['name']) && $_POST['name']) {
			$filter_info['name'] =  trim($_POST['name']);
		}
		//根据其他筛选条件获得广告
		if(isset($_POST['pid']) && $_POST['pid']) { //若已选择广告位，则直接根据pid提取广告
			$filter_map['status'] = 1;
			$filter_map['pid'] = intval($_POST['pid']);
			$rs_map = IAdMapTTC::get(IAdMap::$key, $filter_map);
			if ($rs_map === false) {
				self::$errCode = 11;
				self::$errMsg  = '向表map读取数据失败';
				return array('Rows' => '');
			}
			if(count($rs_map)) {
				foreach ($rs_map as $v_map) {
					$filter_info['aid'] = $v_map['aid'];
					$rs_info = IAdInfoTTC::get(self::$key, $filter_info);
					if ($rs_info === false) {
						self::$errCode = 12;
						self::$errMsg  = '向表info读取数据失败';
						return array('Rows' => '');
					}
					if(count($rs_info)) {
						foreach ($rs_info as $v_info) {
							$ad_list[$v_info['aid']] = $v_info;
						}
					}
				}
			}
		} else if(isset($_POST['cid']) && $_POST['cid']){ //若未选择广告位，但是选择频道页面，则根据cid去提取广告位
			$filter_position['cid'] = intval($_POST['cid']);
			$flag = 1;
		} else {
			$rs_info = IAdInfoTTC::get(self::$key, $filter_info);
			if ($rs_info === false) {
				self::$errCode = 13;
				self::$errMsg  = '向表info读取数据失败';
				return array('Rows' => '');
			}
			if(count($rs_info)) {
				foreach ($rs_info as $v_info) {
					$ad_list[$v_info['aid']] = $v_info;
				}
			}
		}
		if($flag) { //若选择了频道页面或站点，则先提取广告位，再根据广告位提取广告
			$rs_position = IAdPositionTTC::get(IAdPosition::$key, $filter_position);
			if ($rs_position === false) {
				self::$errCode = 14;
				self::$errMsg  = '向表map读取数据失败';
				return array('Rows' => '');
			}
			if(count($rs_position)) {
				foreach ($rs_position as $v_position) {
					$filter_map['pid'] = $v_position['pid'];
					$filter_map['status'] = 1;
					$rs_map = IAdMapTTC::get(IAdMap::$key, $filter_map);
					if ($rs_map === false) {
						self::$errCode = 15;
						self::$errMsg  = '向表map读取数据失败';
						return array('Rows' => '');
					}
					if(count($rs_map)) {
						foreach ($rs_map as $v_map) {
							$filter_info['aid'] = $v_map['aid'];
							$rs_info = IAdInfoTTC::get(self::$key, $filter_info);
							var_dump($rs_info);
							if ($rs_info === false) {
								self::$errCode = 16;
								self::$errMsg  = '向表info读取数据失败';
								return array('Rows' => '');
							}
							if(count($rs_info)) {
								foreach ($rs_info as $v_info) {
									$ad_list[$v_info['aid']] = $v_info;
								}
							}
						}
					}
				}
			}
		}
		rsort($ad_list);
		foreach($ad_list as $k => $v) {
			$ad_list[$k]['name'] =  empty($v['name']) ? '-' : '<a title="'.$v['name'].'" onclick="modifyInfo(\''.$v['aid'].'\')">'.$v['name'].'</a>';
			$ad_list[$k]['user_name'] = Tools::get_user_name($v['user_id']);
			if(!empty($v['gid'])) {
				$group = IAdGroup::ad_group($v['gid'],IAdGroup::$group_type['group']);
				$ad_list[$k]['group'] = '<p title="'.$group['comment'].'">'.$group['comment'].'</p>';
			} else {
				$ad_list[$k]['group'] = '-';
			}
			$ad_list[$k]['status'] = Tools::get_select($v['aid'], self::$status, '', $v['status'], false, 'onChange="updateStatus('.$v['aid'].')"');
			$ad_list[$k]['date'] = date("Y-m-d H:i",strtotime($v['starttime'])).' - '.date("Y-m-d H:i",strtotime($v['endtime']));
			$ad_list[$k]['content'] =  empty($v['content']) ? '-' : '<p title="'.$v['content'].'">'.$v['content'].'</p>';
			/*if(empty($v['content'])) { //获得图片广告宽度和高度
				if(!empty($v['adurl'])) {
					//取出宽屏图片大小
					$img_info = getimagesize($v['adurl']);
					if($img_info === false) {
						self::$errCode = 101;
						self::$errMsg = "Failed to get image information. [{$v['adurl']}]";
						Logger::err(self::$errCode . ' : ' . self::$errMsg);
						return array('Rows' => '');
					}
					$width = $img_info[0];
					$height = $img_info[1];
				}
				//若已上传窄屏图片，取出窄屏图片大小
				if(!empty($v['adurl2'])) {
					$img_info2 = getimagesize($v['adurl2']);
					if($img_info2 === false) {
						self::$errCode = 102;
						self::$errMsg = "Failed to get image information. [{$v['adurl2']}]";
						Logger::err(self::$errCode . ' : ' . self::$errMsg);
						return array('Rows' => '');
					}
					$width2 = $img_info2[0];
					$height2 = $img_info2[1];
				}
			}*/
			$ad_id =  'k'.$v['aid'];
			$ad_id2 = 'z'.$v['aid'];
			$ad_list[$k]['adurl'] = $v['adurl'];
			$ad_list[$k]['adurl2'] = $v['adurl2'];
			$ad_list[$k]['url'] = empty($v['url']) ? '-' : '<a title="' . $v['url'] . '" target="_blank" href="' . $v['url'] . '">' . $v['url'] . '</a>';
			$ad_list[$k]['user_name'] = Tools::get_user_name($v['user_id']);
			//获得该广告所在的所有站点id以及所属广告位
			$pid = IAdMap::get_pid($v['aid']);
			if(!empty($pid)) {
					$ad_list[$k]['site'] = '<a onclick="showSite('.$v['aid'].')" >【查看】</a>';
					$ad_list[$k]['position'] = '<a onclick="showPosition('.$v['aid'].')">【查看】</a>';
			} else {
				$ad_list[$k]['site'] = '-';
				$ad_list[$k]['position'] = '-';
			}
		}
		$infos['Rows'] = $ad_list;
		return $infos;
	}
	
	/**
	 * 
	 * 上传广告
	 * @param $para = array(
	 *	'name'      => 广告名称,
	 *	'gid'       => 所属活动系列ID,
	 *	'starttime' => 开始时间,
	 *	'endtime'   => 结束时间,
	 *	'url'       => 广告页面地址url,
	 *	'content'   => 文字广告内容,
	 *	'adurl'     => 图片广告宽屏图片地址,
	 *	'adurl2'    => 图片广告窄屏图片地址,
	 *	'status'    => 启用状态,
	 *	'comment'   => 备注内容,
	 *	'user_id'   => 创建者id,
	 *	'mid'       => 1(TTC主键)
	 *	);
	 * @author railszhu
	 * @return array('msg' => '上传成功或错误信息')
	 */
	public static function ad_uploadInfo($para) {
		$data = array(
			'name' => $para['name'],
			'gid' => $para['gid'],
			'starttime' => $para['starttime'],
			'endtime' => $para['endtime'],
			'url' => $para['url'],
			'adurl' => $para['adurl'],
			'adurl2' => $para['adurl2'],
			'status' =>	$para['status'],
			'content' => $para['content'],
			'comment' => $para['comment'],
			'createtime' => date('Y-m-d H:m'),
			'updatetime' => date('Y-m-d H:m'),	
			'user_id' => $para['user_id'],
			'mid' => $para['mid']
		);
		$rs = IAdInfoTTC::insert($data);
		if ($rs === false) {
			return array('msg' => IAdInfoTTC::$errMsg);
		}		
		return array('msg' => 'success!!');
	}
	
    /**
	 * 
	 * 修改广告
	 * @author railszhu
	 * @param $key  TTC主键
	 * @param $para 所要修改的内容
	 * @return array('msg' => '修改成功或错误信息')
	 */
    public static function ad_updateInfo($key, $para) {
    	if($key != self::$key) {
			self::$errCode = 41;
			self::$errMsg = '上传失败，TTC主键不正确';
			return array('msg' => 'TTC主键不正确');
		}
		$pid = IAdMap::get_pid($para['aid']);
		$filter_ad = array('aid' => $para['aid']);
		$rs_ad = IAdInfoTTC::get(self::$key, $filter_ad);
    	if($rs_ad === false) {
			self::$errCode = 42;
			self::$errMsg  = '向表info读取修改前的广告信息失败';
		}
		$ad_info = $rs_ad[0];
		if(!empty($pid)) {
			if($ad_info['status'] == 1 && $para['status'] == 2) {
				return array('msg' => '该广告已经投放到广告位上，不能取消启用！');
			}
			if(isset($para['content'])) { //若只是更新启用状态，则跳过下面的验证
				rsort($pid);
		    	if(!$para['content']) {
					if(!empty($para['adurl'])) {
						//取出宽屏图片大小
						/*$img_info =  explode('/',$para['adurl']);
						$img_name = end($img_info);
						$date = array_slice($img_info,-2,1);
					    $time = $date[0];
						$str=getimagesize(PUBLISH_IMAGE_ROOT . 'ad/adinfo/'.$time.'/'.$img_name);
						$mode="/width=\"(.*)\" height=\"(.*)\"/";
						preg_match($mode,$str[3],$arr);*/
						$img_info = ToolUtil::getImageSize($para['adurl']);
						if($img_info === false) {
							self::$errCode = 101;
							self::$errMsg = "Failed to get image information. [{$para['adurl']}]";
							Logger::err(self::$errCode . ' : ' . self::$errMsg);
							return array( 'msg' => '获取宽频图片信息失败' );
						}
						$width = $img_info['width'];
						$height = $img_info['height'];
					}
					//若已上传窄屏图片，取出窄屏图片大小
					if(!empty($para['adurl2'])) {
						/*$img_info2 =  explode('/',$para['adurl2']);
						$img_name2 = end($img_info2);
						$date2 = array_slice($img_info2,-2,1);
						$time2 = $date2[0];
						$str2=getimagesize(PUBLISH_IMAGE_ROOT . 'ad/adinfo/'.$time2.'/'.$img_name2);
						preg_match($mode,$str2[3],$brr);*/
						$img_info2 = ToolUtil::getImageSize($para['adurl2']);
						if($img_info2 === false) {
							self::$errCode = 102;
							self::$errMsg = "Failed to get image information. [{$para['adurl2']}]";
							Logger::err(self::$errCode . ' : ' . self::$errMsg);
							return array( 'msg' => '获取窄屏图片信息失败' );
						}
						$width2 = $img_info2['width'];
						$height2 = $img_info2['height'];
					}
		    	}
				foreach($pid as $p) {
					//首先需要判断，该广告投放时间是否与已投放广告位的所有广告的投放时间有重叠
					/*$filter_m = array('pid' => $p, 'status' => 1);
					$rs_aid = IAdMapTTC::get(IAdMap::$key, $filter_m);
					if($rs_aid === false) {
						self::$errCode = 42;
						self::$errMsg  = '向表map读取广告位上的广告信息失败';
						return array('msg' => '获取广告位'.$p.'上投放的广告信息失败！');
					}
					$aid_list = array();
					if(count($rs_aid)) {
						foreach($rs_aid as $k => $v) {
							if($v['aid'] != $para['aid']) {
								$aid_list[] = $v['aid'];
							}
						}
					}
					foreach($aid_list as $aid_2) {
						$filter_ad2 = array('aid' => $aid_2);
						$rs_ad2 = IAdInfoTTC::get(IAdInfo::$key, $filter_ad2);
						if($rs_ad2 === false) {
							self::$errCode = 43;
							self::$errMsg  = '向表info读取广告信息失败';
							return array('msg' => '获取广告'.$aid_2.'信息失败！');
						}
						$ad_info2 = $rs_ad2[0];
						var_dump($ad_info2);
						$start_time2 = $ad_info2['starttime'];
						$end_time2 = $ad_info2['endtime'];
						if(!($para['starttime'] > $end_time2 || $para['endtime'] < $start_time2)) {
							return array('msg' => '广告投放时间与广告位'.$p.'上的广告'.$aid_2.'有重叠！');
						}
					}	*/		 
					//若是图片广告，则需判断该图片是否满足已投放的广告位的尺寸要求
					if(!$para['content']) {
						$position = IAdPosition::ad_position($p);
						$p_width = $position['width'];
						$p_height = $position['height'];
						$p_width2 = $position['width2'];
						$p_height2 = $position['height2'];
						if(!empty($para['adurl'])) {
							if($arr[1] < ($p_width-self::$inaccuracy)) {
								return array('msg' => '新上传广告无法满足广告位'.$p.'的宽屏图片尺寸要求，宽度偏小！');
							} else if($arr[1] > ($p_width+self::$inaccuracy)) {
								return array('msg' => '新上传无法满足广告位'.$p.'的宽屏图片尺寸要求，宽度偏大！');
							} else if($arr[2] < ($p_height-self::$inaccuracy)) {
								return array('msg' => '新上传无法满足广告位'.$p.'的宽屏图片尺寸要求，高度偏小！');
							} else if($arr[2] > ($p_height+self::$inaccuracy)) {
								return array('msg' => '新上传无法满足广告位'.$p.'的宽屏图片尺寸要求，高度偏大！');
							} else if(!empty($para['adurl2'])) { 
								if($brr[1] < ($p_width2-self::$inaccuracy)) {
									return array('msg' => '新上传无法满足广告位'.$p.'的窄屏图片尺寸要求，宽度偏小！');
								} else if($brr[1] > ($p_width2+self::$inaccuracy)) {
									return array('msg' => '新上传无法满足广告位'.$p.'的窄屏图片尺寸要求，宽度偏大！');
								} else if($brr[2] < ($p_height2-self::$inaccuracy)) {
									return array('msg' => '新上传无法满足广告位'.$p.'的窄屏图片尺寸要求，高度偏小！');
								} else if($brr[2] > ($p_height2+self::$inaccuracy)) {
									return array('msg' => '新上传无法满足广告位'.$p.'的窄屏图片尺寸要求，高度偏大！');
								}
							}
						}
					}		
				}
			}
		}
		$data = array(
				'mid' => $key,   
				'updatetime' => date('Y-m-d H:m')
		);	
		foreach($para as $k => $v) {
			if($k != 'aid') {
				$data[$k] = $v;
			}
		}
		$filter = array('aid' => $para['aid']);
		$rs = IAdInfoTTC::update($data, $filter);
		if ($rs === false) {
			return array('msg' => IAdInfoTTC::$errMsg);
		}			
		return array('msg' => 'success!!');	
    }
    
    public static function getAdvertise($id) {
    	$filter = array('aid' => $id);
		$rs = IAdInfoTTC::get(self::$key, $filter);
    	if (empty($rs)) {
			throw new BaseException(101, "Failed to get advertise with $id.");
		}
		return $rs[0];
    }
}