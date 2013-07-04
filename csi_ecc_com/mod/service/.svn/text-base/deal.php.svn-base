<?php
require_once BIZ_DAO_ROOT . 'IServiceApplyDao.php';
require_once BIZ_DAO_ROOT . 'IServiceReplyDao.php';
require_once BIZ_DAO_ROOT . 'IWorkflowDao.php';
require_once BIZ_DAO_ROOT . 'IMessageDao.php';
require_once BIZ_DAO_ROOT . 'IStatDao.php';
require_once API_PATH . 'IUser.php';
require_once API_PATH . 'IGroup.php';
require_once API_PATH . 'ISMS.php';
require_once LIB_PATH . 'ToolUtil.php';

Logger::init();
IUser::init();
// if(IUser::checkLogin() === false){
	// return array('errno' => 500, 'msg' => '请重新登录');
// }

function deal_getApplyDetail() {
	global $_source_list, $_approve_list, $_biz_list, $_checkup_list,$_QUICK_REPLY_LIST, $_workflow_list,$_ARCHIVE_LIST;
	$id = intval($_GET['id']);
 	if($id){
		$ret = IServiceApplyDao::getList(array(), 'id=' . $id, 0, 1);
		if ($ret === false){
			Logger::err("IServiceApplyDao::getApply failed, code:" . IServiceApplyDao::$errCode . ", msg:" . IServiceApplyDao::$errMsg);
			return array('errno' => 1);
		}
		if (empty($ret)) {
			return array('errno' => 1);
		}
		//处理归档信息
		if (!empty($ret[0]['archive'])) {
			$temp_array = explode(":", $ret[0]['archive']);
			if(!empty($temp_array)) {
				$archive['selected_id'] = $temp_array[1];
				$archive['name'] = $temp_array[0];
				$archive['level1'] = floor($temp_array[1] / 1000);
				foreach($_ARCHIVE_LIST as $key => $v) {
					if (floor($key / 1000) == $archive['level1']) {
						$temp_row['id'] = $key;
						$temp_row['name'] = $v['name'];
						$archive['level2'][] = $temp_row;
						unset($temp_row);
					}
				} 
			}
		} else {
			$archive = array();
 		}
		$used_archive_id = $_COOKIE['used_archive_id'];
		$used_archive_arr = array();
		if (!empty($used_archive_id)) {
			$used_archive_id_arr = explode(",", $used_archive_id);
			foreach ($used_archive_id_arr as $temp_id) {
				$temp_row['id'] = $temp_id;
				$temp_row['text'] = $_ARCHIVE_LIST[floor($temp_id / 1000)]['name'] . "--" . $_ARCHIVE_LIST[$temp_id]['name'] ;
				$used_archive_arr[] = $temp_row;
				unset($temp_row);
			}
		}
		//处理最新回复
		$latest_reply = IServiceReplyDao::getLatestReply($id);
		$ret[0]['latest_reply'] = $latest_reply;
		
		//工作流信息
		$workflows = IWorkflowDao::getWorkflows($id);
		if (count($workflows) > 0) {
			foreach($workflows as &$row) {
				$row['workflow_type_map'] = $_workflow_list[$row['workflow_type']];
			}
		}
		$ret[0]['workflows'] = $workflows;
		//备注信息
		$memo_count = IServiceReplyDao::getCount("complaint_id=" . $id ." and reply_type = 2");
		if ($memo_count > 0) {
			$ret[0]['hasMemo'] = 1;
		} else {
			$ret[0]['hasMemo'] = 0;
		}
		//可以和前面合并一个查询， todo
		$reply_count = IServiceReplyDao::getCount("complaint_id=" . $id ." and reply_type = 1");
		$ret[0]['reply_count'] = $reply_count;
		//if(!empty($ret[0]['approve'])) {
			$ret[0]['approve'] = $_approve_list[$ret[0]['approve']];
		//}
		//if(!empty($ret[0]['checkup'])) {
			$ret[0]['checkup'] = $_checkup_list[$ret[0]['checkup']];
		//}
		$ret[0]['week_total'] = IServiceApplyDao::getCount("account='" . $ret[0]['account'] ."' and createTime > " . (time() - 7*24*3600));
		$ret[0]['biz'] = $_biz_list[$ret[0]['biz']];
		//权限操作
		
		$auth = IUser::getAuth();
		$ret[0]['privileges'] = array();
		if (in_array(AUTH_QA, $auth)) {
			$ret[0]['privileges'][] = 'QA';
		} 
		
		//是否有加急工单权限
		if (in_array(AUTH_SERVICE_SET, $auth)) {
			$ret[0]['privileges'][] = 'URGE';
		} 
		
		$ret[0]['archive'] = $archive;
		$ret[0]['used_archive'] = $used_archive_arr;
		//$ret[0]['quick_reply_list'] = $_QUICK_REPLY_LIST;
	 	return array(
			'errno' => 0,
			'data'  => $ret[0]
		);
	}else{
		return array('errno' => 1);
	}
}

//工单状态处理

function deal_setFlag() {
	global $_flag_list;
	$current_user = $_COOKIE['rtx'];
 	if(!empty($_POST['id'])) {
		 $id = intval($_POST['id']);
	} else {
		 return array(
			 'errno' => 1,
			  'msg'   => '缺少投诉单数据'
		 );
	}
	if(IUser::checkLogin() === false){
		return array('errno' => 500, 'msg' => '请重新登录');
	}
	// if (!IUser::checkAuth(AUTH_SERVICE_SET)) {
		// return array(
			 // 'errno' => 2,
			  // 'msg'   => '无权限进行此操作'
		 // );
	// }
	$count = IServiceApplyDao::getCount('id=' . $id) ;
	if ($count < 1) {
		return array(
			 'errno' => 1,
			 'msg'   => '投诉单不存在'
		);
	}
	if (!array_key_exists($_POST['flag'], $_flag_list)) {
		return array(
			 'errno' => 1,
			 'msg'   => '单据标识id不在许可范围'
		);
	}
	$apply_data = array('flag' => $_POST['flag']);
	$ret = IServiceApplyDao::getList(array('followKF'), 'id=' . $id, 0, 1);
	if (IServiceApplyDao::update($apply_data, 'id=' . $id)) {
		if ($_POST['flag'] == 1) {
			//加急 插入workflow
			$workflow_data = array(
									'complaint_id' => $id,
									'create_time' => time(),
									'create_by'  => $current_user,
									'workflow_type' => 8,
									'workflow_detail' => '订单加急'
			);
			IWorkflowDao::insert($workflow_data);
			if (!empty($ret[0]['followKF'])) {
				$msg = array( 'create_by' => $current_user,
							  'create_time' => time(),
							  'msg_type' => 2,
							  'msg_detail' => '工单<a href="/index.php?biz=service&mod=deal&act=detail&id='. $id  . '">' . $id ."</a> 被加急，催办人：" . $kf,
							  'target_user' => $ret[0]['followKF']);
				IMessageDao::insert($msg);
			}
			$tm = Config::getTMem('service_statistic');
            if($tm){
                    $key = $id . "_" . $ret[0]['account'] . "_tip_view";
                    $tm->set(TMEM_BID_SERVICE_STATISTIC, $key, 0);
            } 
		}
		return array(
			 'errno' => 0
		);
	} else {
		return array(
			 'errno' => 1,
			 'msg'   => '更新失败'
		);
	}
}

//质量检查
function deal_checkup() {
	global $_checkup_list;
	if(!empty($_POST['id'])) {
		 $id = intval($_POST['id']);
	} else {
		 return array(
			 'errno' => 1,
			  'msg'   => '缺少投诉单数据'
		 );
	}
	if(IUser::checkLogin() === false){
		return array('errno' => 500, 'msg' => '请重新登录');
	}
	if (!IUser::checkAuth(AUTH_QA)) {
		return array(
			 'errno' => 2,
			  'msg'   => '无权限进行此操作'
		 );
	}
	$count = IServiceApplyDao::getCount('id=' . $id) ;
	if ($count < 1) {
		return array(
			 'errno' => 1,
			 'msg'   => '投诉单不存在'
		);
	}
	
	$kf = $_COOKIE['rtx'];
	if(!$kf){
		return array(
			'errno' => 1,
			'msg'   => '缺少用户数据'
		);
	}
	
	if(!array_key_exists($_POST['checkup'], $_checkup_list)) {
		return array(
			'errno' => 1,
			'msg'   => '非法参数'
		);
	}
	
	$current_time = time();
	$apply_data = array(
						'checkupTime' => $current_time,
						'censor' 	=> $kf,
						'checkup'	=> $_POST['checkup']
						);
	
	if (IServiceApplyDao::update($apply_data, 'id=' . $id)) {
		if(!empty($_POST['content'])) {
			$content = ToolUtil::transXSSContent(trim($_POST['content']));
			$reply_type = 3;
		
			$current_time = time();
			$reply_data = array(
						'complaint_id' => $id,
						'reply_type' => $reply_type,
						'replyer_id' => $kf,
						'replyer_type' => 1,
						'time_reply' => $current_time,
						'content'	=> $content
					);
			IServiceReplyDao::insert($reply_data);
		}
		$workflow_detail = ToolUtil::transXSSContent(trim($_POST['content'])) . "<br/>" . "质检结果:". $_checkup_list[$_POST['checkup']]  ;
		$workflow_data = array(
							'complaint_id' => $id,
							'create_time' => $current_time,
							'create_by'  => $kf,
							'workflow_type' => 9,
							'workflow_detail' => $workflow_detail
		);
		IWorkflowDao::insert($workflow_data);
		$apply_data['id'] = $id;
		_sync_stat($apply_data, 2);
	} else {
		return array(
			 'errno' => 1,
			 'msg'   => '更新失败'
		);
	}
	
	
	return array(
			 'errno' => 0
	);
}

//获取归档
function deal_getArchive() {
	global $_ARCHIVE_LIST;
 	if(!empty($_POST['id'])) {
		$id = intval($_POST['id']);
		$level = $_POST['level'];
		if(empty($level)) {
			$level = 1;
		}
		$ret = array();
		if($level == 1) {
			foreach($_ARCHIVE_LIST as $key => $v) {
				if (floor($key / 1000) == $id) {
					$temp_row['id'] = $key;
					$temp_row['name'] = $v['name'];
					$ret[] = $temp_row;
					unset($temp_row);
				}
			} 
		} else if ($level == 2) {
			foreach($_ARCHIVE_LIST as $key => $v) {
				if (floor($id / 1000) == $key) {
					$temp_row['id'] = $key;
					$temp_row['name'] = $v['name'];
					$ret[] = $temp_row;
					unset($temp_row);
					break;
				}
			}
		}
	} else if(!empty($_POST['key'])) {
		$key = $_POST['key'];
		$ret = array();
		foreach($_ARCHIVE_LIST as $k => $v) {
			if (preg_match("/". $key . "/", $v['name']) || preg_match("/". $key . "/", $v['py'])) {
				$temp_row['id'] = $k;
				$temp_row['name'] = $v['name'];
				$ret[] = $temp_row;
				unset($temp_row);
			}
		} 
	} else {
		return array(
			'errno' => 1,
			'data'  => 'error'
		);
	}
	return array(
			'errno' => 0,
			'data'  => $ret
	);
}

//转单功能
function deal_reassign() {
	if(!empty($_POST['id'])) {
		$id = addslashes($_POST['id']);
	} else {
		return array(
			'errno' => 1,
			 'msg'   => '缺少投诉单数据'
		);
	}
	$kf = $_COOKIE['rtx'];
	if(!$kf){
		return array(
			'errno' => 1,
			'msg'   => '缺少用户数据'
		);
	}
	if(IUser::checkLogin() === false){
		return array('errno' => 500, 'msg' => '请重新登录');
	}
	if (!IUser::checkAuth(AUTH_SERVICE_REASSGIN)) {
		return array(
			 'errno' => 2,
			  'msg'   => '无权限进行此操作'
		 );
	}
	$type = $_POST['type'];
	$flag = $_POST['flag'];
	$assign_target = $_POST['assign_target'];
	$current_time = time();
	
	$apply_data = array();
	if($type == 1) {
		$apply_data['followKF'] = $assign_target;
		if (!IUser::checkRtxUserExist($assign_target)) {
			return array(
				'errno' => 5,
				'msg' => "要转单的用户不存在"
			);
		}
	} else {
		$apply_data['followKF'] = '';
		$apply_data['optTeam'] = $assign_target;
		$group_info = IGroup::findGroupById($assign_target);
		$assign_target = $group_info['name'];
	}
	if (!empty($flag)) {
		$apply_data['flag'] = 1;
	}
	$apply_data['modifyTime'] = $current_time;
	IServiceApplyDao::update($apply_data, 'id in (' . $id . ") ");
	$workflow_detail = "转单:";
	$id_array = explode(",", $id);
	foreach($id_array as $v) {
		$workflow_data = array(
						'complaint_id' => $v,
						'create_time' => $current_time,
						'create_by'  => $kf,
						'workflow_type' => 4,
						'target_user' => $assign_target,
						'workflow_detail' => $workflow_detail
		);
		IWorkflowDao::insert($workflow_data);
		
		if ($type == 1) {
			$msg = array('create_by' => $kf,
						  'create_time' => $current_time,
						  'msg_type' => 1,
						  'msg_detail' => '工单<a href="/index.php?biz=service&mod=deal&act=detail&id='. $v  . '">' . $v ."</a> 转单人：" . $kf,
						  'target_user' => $assign_target);
			IMessageDao::insert($msg);
			_update_assgin_data($v, $assign_target);
		} else {
			_cleaner($v);
		}
	}
	
	return array(
			'errno' => 0
	);
}

//归档逻辑

function deal_setArchive() {
	global $_ARCHIVE_LIST,$_type_list, $_checkup_list;
 	if(!empty($_POST['id'])) {
		$id = intval($_POST['id']);
	} else {
		return array(
			'errno' => 1,
			 'msg'   => '缺少投诉单数据'
		);
	}
	if (!IUser::checkAuth(AUTH_SERVICE_REPLY)) {
		return array(
			 'errno' => 2,
			  'msg'   => '无权限进行此操作'
		 );
	}
	if (!empty($_POST['archive_id']) && $_POST['archive_id'] > 1000) {
		$archive_id = $_POST['archive_id'];
	} else {
		return array(
			'errno' => 1,
			 'msg'   => '归档id参数错误'
		);
	}
	$kf = $_COOKIE['rtx'];
	if(!$kf){
		return array(
			'errno' => 1,
			'msg'   => '缺少用户数据'
		);
	}
	//cookie操作
	$used_archive_id = $_COOKIE['used_archive_id'];
	if (!empty($used_archive_id)) {
		$used_archive_id_arr = explode("," , $used_archive_id);
	} else {
		$used_archive_id_arr = array();
	}
	array_unshift($used_archive_id_arr, $archive_id);
	$used_archive_id_arr = array_slice(array_unique($used_archive_id_arr), 0, 5);
	setcookie("used_archive_id", implode(",", $used_archive_id_arr), time() + 3600 * 24 * 15);
	
	
	$rows = IServiceApplyDao::getList(array('id', 'account', 'type', 'userPhone', 'hasReply', 'acceptTime', 'followKF', 'orderNo'), "id='{$id}'", 0, 1);
	
	if (!empty($rows)) {
		$complaint = $rows[0];
	} else {
		return array(
			'errno' => 1,
			'msg'   => '投诉单不存在'
		);
	}
	$current_time = time();
	if(!empty($_POST['content'])) {
		$content = ToolUtil::transXSSContent(trim($_POST['content']));
		$content = iconv('UTF-8', 'GBK', $content);
	}
	
	if (!empty($content)) {
		if(!empty($_POST['is_censor'])) {
			$reply_type = 3;
		} else {
			$reply_type = 1;
		}
		$reply_data = array(
				'complaint_id' => $id,
				'reply_type' => $reply_type,
				'replyer_id' => $kf,
				'replyer_type' => 1,
				'time_reply' => $current_time,
				'content'	=> $content
		);
		$has_reply = 1;
		IServiceReplyDao::insert($reply_data);
	} else {
		$has_reply = 0;
	}
	$archive_detail = $_ARCHIVE_LIST[floor($archive_id / 1000)]['name'] . '--' .  $_ARCHIVE_LIST[$archive_id]['name'];
	
	if(!empty($_POST['is_censor'])) { //质检的工作流
		$workflow_detail = "<strong>回复内容：</strong>" . ToolUtil::transXSSContent(trim($_POST['content'])) . "<br/>" . "质检结果:". $_checkup_list[$_POST['checkup']]  ;
		$workflow_data = array(
							'complaint_id' => $id,
							'create_time' => $current_time,
							'create_by'  => $kf,
							'workflow_type' => 9,
							'workflow_detail' => $workflow_detail
		);
	} else {
		$workflow_detail = "<strong>回复内容：</strong>" . ToolUtil::transXSSContent(trim($_POST['content'])) . "<br/><br/>" . "<strong>归档路径：</strong>" . $archive_detail;
		$workflow_data = array(
						'complaint_id' => $id,
						'create_time' => $current_time,
						'create_by'  => $kf,
						'workflow_type' => 7,
						'workflow_detail' => $workflow_detail
		);
	}
	IWorkflowDao::insert($workflow_data);
	$apply_data = array(
						'followKF' => $kf,
						'modifyTime' => $current_time,
	);
	if($has_reply) {
		$apply_data['hasReply'] = 1;
	}
	
	$apply_data['archive'] = iconv('utf8', 'gbk', $archive_detail) . ":" . $archive_id;
	//处理关闭
	if (!empty($_POST['isclose'])) {
		if(!empty($_POST['is_censor'])) { //质检
			$apply_data['checkupTime'] =  $current_time;
			$apply_data['censor'] = $kf;
			$apply_data['checkup']	= $_POST['checkup'];
		} else {
			$apply_data['finishTime'] = $current_time;
			$apply_data['dealTime'] = $current_time - (!empty($complaint['acceptTime']) ? $complaint['acceptTime'] : $complaint['distributeTime']);
		}
		if (empty($complaint['acceptTime'])) {
			$apply_data['acceptTime'] = $current_time;
		}
		$apply_data['file_time'] = $current_time;
		$apply_data['file_kf'] = $kf;
		$apply_data['state'] = 3;
	}
	IServiceApplyDao::update($apply_data, 'id=' . $id);
	if (!empty($_POST['isclose'])) {
		_cleaner($id) ;
	}
	//更新tmem数据,质检不需要更新tmem
	if (empty($complaint['hasReply']) && $has_reply && empty($_POST['is_censor'])) {
		$tm = Config::getTMem('service_center_unread_message');
		if ($tm) {
			$unreadCount = $tm->get(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $complaint['account'] . "_" . "unread_message_" . $complaint['type']);
			if(false === $unreadCount) {
				$unreadCount = 0;
			}
			//echo $unreadCount;
			$tm->set(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $complaint['account']. "_" . "unread_message_" . $complaint['type'], (intval($unreadCount) +1 ));
		} else {
			return array(
					//'errno' => 1,
					'errno' => 0, //防止两边发布不一致，暂时设为0
					'msg'   => '设置TMem失败'
			);
		}
	}
	//同步到stat数据库
	$sync_data = array_merge($complaint, $apply_data);
	if (!empty($_POST['is_censor'])) {
		_sync_stat($sync_data, 2);
	} else {
		_sync_stat($sync_data, 1);
	}
	//如果是取消订单并结单时下发短信
	//if (!empty($_POST['isclose'])) {
		if (!empty($_POST['need_sms']) && !empty($complaint['userPhone']) && ToolUtil::checkMobilePhone($complaint['userPhone'])) {
			$msg = "您在易迅服务中心" . $_type_list[$complaint['type']] . "服务有新客服回复：" . $_POST['content'];
			//短信接口不能用
			ISMS::sendSingleSMS($complaint['userPhone'], $msg);
		}
	//}
	
	return array(
			'errno' => 0
	);
}


//添加回复/备注逻辑

function deal_addReply() {
	global $_ARCHIVE_LIST,$_type_list, $_checkup_list;
	if(!empty($_POST['id'])) {
		$id = intval($_POST['id']);
	} else {
		return array(
			'errno' => 1,
			 'msg'   => '缺少投诉单数据'
		);
	}
	if(IUser::checkLogin() === false){
		return array('errno' => 500, 'msg' => '请重新登录');
	}
	if (!IUser::checkAuth(AUTH_SERVICE_REPLY)) {
		return array(
			 'errno' => 2,
			  'msg'   => '无权限进行此操作'
		 );
	}
	$rows = IServiceApplyDao::getList(array('account', 'type', 'userPhone', 'hasReply', 'acceptTime'), "id='{$id}'", 0, 1);
	
	if (!empty($rows)) {
		$complaint = $rows[0];
	} else {
		return array(
			'errno' => 1,
			'msg'   => '投诉单不存在'
		);
	}
	
	$kf = $_COOKIE['rtx'];
	if(!$kf){
		return array(
			'errno' => 1,
			'msg'   => '缺少用户数据'
		);
	}
	
	if(empty($_POST['content'])) {
		return array(
			'errno' => 1,
			'msg'   => '缺少回复内容'
		);
	} else {
		$content = ToolUtil::transXSSContent(trim($_POST['content']));
		$content = iconv('UTF-8', 'GBK', $content);
	}
	
	if (empty($_POST['is_memo'])) {
		$reply_type = 1;
	} else {
		$reply_type = 2;
	}
	
	$current_time = time();
	$reply_data = array(
				'complaint_id' => $id,
				'reply_type' => $reply_type,
				'replyer_id' => $kf,
				'replyer_type' => 1,
				'time_reply' => $current_time,
				'content'	=> $content
			);
	IServiceReplyDao::insert($reply_data);
	$workflow_detail = ($reply_type == 1 ? "回复内容：" : "备注内容：") . ToolUtil::transXSSContent(trim($_POST['content']));
	$workflow_data = array(
									'complaint_id' => $id,
									'create_time' => $current_time,
									'create_by'  => $kf,
									'workflow_type' => ($reply_type == 1 ? 2 : 5),
									'workflow_detail' => $workflow_detail
			);
	IWorkflowDao::insert($workflow_data);
	
	if ($reply_type == 1) {
		$apply_data = array(
							'hasReply' => 1,
							'followKF' => $kf,
							'modifyTime' => $current_time,
		);
		if (empty($complaint['acceptTime'])) {
			$apply_data['acceptTime'] = $current_time;
		}
		//处理回复并关闭
		if (!empty($_POST['isclose'])) {
			$apply_data['state'] = 3;
			$apply_data['finishTime'] = $current_time;
			$apply_data['dealTime'] = $current_time - $complaint['acceptTime'];
		} else {
			$apply_data['state'] = 2;
			$apply_data['modifyTime'] = $current_time;
			if (!empty($_POST['nextTime'])) {//设置下次到期时间
				$apply_data ['nextTime'] = $current_time + intval($_POST['nextTime']) * 60;
			}
		}
		$tm = Config::getTMem('service_statistic');
        if($tm){
                $key = $id . "_" . $complaint['account'] . "_tip_view";
                $tm->set(TMEM_BID_SERVICE_STATISTIC, $key, 0);
        } 
	} else {
		$apply_data = array(
							'modifyTime' => $current_time
		);
	}
	IServiceApplyDao::update($apply_data, 'id=' . $id);
	
	$sync_data = array('id' => $id);
	_sync_stat($sync_data, 3);
	if (!empty($_POST['isclose'])) {
		_cleaner($id) ;
	} else {
		_update_assgin_data($id, $kf);
	}
	
	//更新tmem数据
	if (empty($complaint['hasReply'])) {
		$tm = Config::getTMem('service_center_unread_message');
		if ($tm) {
			//print $complaint['account'] . "_" . "unread_message_" . $complaint['type'];
			$unreadCount = $tm->get(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $complaint['account'] . "_" . "unread_message_" . $complaint['type']);
			if(false === $unreadCount) {
				$unreadCount = 0;
			}
			$tm->set(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $complaint['account']. "_" . "unread_message_" . $complaint['type'], (intval($unreadCount) +1 ));
			//echo $unreadCount;die(0);
		} else {
			//print "here2";
			return array(
					//'errno' => 1,
					'errno' => 0, //防止两边发布不一致，暂时设为0
					'msg'   => '设置TMem失败'
			);
		}
	}
	
	//如果是取消订单并结单时下发短信
	//if (!empty($_POST['isclose'])) {
		if (!empty($_POST['need_sms'])  && !empty($complaint['userPhone']) && ToolUtil::checkMobilePhone($complaint['userPhone'])) {
			$msg = "您在易迅服务中心" . $_type_list[$complaint['type']] . "服务有新客服回复：" . $_POST['content'];
			//短信接口不能用
			ISMS::sendSingleSMS($complaint['userPhone'], $msg);
		}
	//}
	
	return array(
			'errno' => 0
	);
}

//工单详情页面

function page_deal_detail() {
	require_once LIB_PATH . 'Template.php';
	global $_source_list,$_state_list , $_ORDER_CANCEL_REASON_TYPE, $_subtype_list, $_approve_list, $_type_list , $_biz_list, $_checkup_list,$_QUICK_REPLY_LIST, $_workflow_list,$_ARCHIVE_LIST;
	$id = intval($_GET['id']);
 	if($id){
		$ret = IServiceApplyDao::getList(array(), 'id=' . $id, 0, 1);
		if (empty($ret)) {
			ToolUtil::redirect("http://csi.ecc.com/");
		}
		if (preg_match("/^[1-8]:/", $ret[0]['content']) && $ret[0]['type'] == 3) {
			$k = intval(substr($ret[0]['content'], 0, 1));
			$ret[0]['content'] = "取消原因:" . $_ORDER_CANCEL_REASON_TYPE[$k] . " &nbsp;" . substr($ret[0]['content'], 2);
		}
		$ret[0]['order_id_str'] = '<a href="http://ias.icson.com/Sale/SODetail.aspx?SysNo=' . substr($ret[0]['orderNo'],2) . '" target="_blank">' . $ret[0]['orderNo'] . '</a>';
		//常用归档路径
		$used_archive_id = $_COOKIE['used_archive_id'];
		$used_archive_arr = array();
		if (!empty($used_archive_id)) {
			$used_archive_id_arr = explode(",", $used_archive_id);
			$used_archive_id_arr = array_unique($used_archive_id_arr);
			$archive_option_str = '';
			foreach ($used_archive_id_arr as $temp_id) {
				$temp_text = $_ARCHIVE_LIST[floor($temp_id / 1000)]['name'] . "--" . $_ARCHIVE_LIST[$temp_id]['name'] ;
				$archive_option_str .= '<option value="' . $temp_id.  '">' . $temp_text .  '</option>';
			}
		} else {
			$archive_option_str = '<option value="">暂无常用归档</option>';
		}
		$ret[0]['archive_option_str'] = $archive_option_str;
		//处理最新回复
 		$latest_reply = IServiceReplyDao::getLatestReply($id);
		if (!empty($latest_reply)) {
			$ret[0]['latest_reply_str'] = '<h4 class="ecc_mod_box_stit">用户新回复信息：</h4>' .
											"<textarea disabled>" .$latest_reply['content'] .  "</textarea>";
		} else {
			$ret[0]['latest_reply_str'] = '';
		}
		
		//工作流信息
	 	$workflows = IWorkflowDao::getWorkflows($id);
		if (count($workflows) > 0) {
			foreach($workflows as &$row) {
				$row['workflow_type_map'] = $_workflow_list[$row['workflow_type']];
			}
			
			$workflow_str = '<h4 class="ecc_mod_box_stit">工单工作流：</h4>';
			for($i = 0; $i < count($workflows); $i++){
				if ($i == 0) {
					$workflow_str .= '<div class="ecc_mod_reply ecc_mod_reply_selected">';
				} else {
					$workflow_str .=  '<div class="ecc_mod_reply">';
				}
				$target_user_html = '';
				if (!empty($workflows[$i]['target_user'])) {
					$target_user_html = '<span class="user"><strong>目标人：</strong>'. $workflows[$i]['target_user'] . '</span>';
				}
				$workflow_str .= '<div class="ecc_mod_reply_hd">' .
								'<span class="tit">' . ($i + 1) . '、' . $workflows[$i]['workflow_type_map'] . '</span>' .
								'<span class="user"><strong>操作人：</strong>' . ($workflows[$i]['workflow_type'] == 3 ? $ret[0]['userName'] : $workflows[$i]['create_by']) . '</span>' .
								 $target_user_html .
								'<span class="time"><strong>时间：</strong>'. date("Y-m-d H:i:s", $workflows[$i]['create_time']) .'</span>' .
								'<a href="##" class="up" ' . ($i == 0 ? ' style="display:none;" ': ' style="display:block;" ') . '>展开</a>' .
								'<a href="##" class="down"' . ($i != 0 ? ' style="display:none;" ': ' style="display:block;" ') . '>收起</a>' .
							'</div>' .
							'<div class="ecc_mod_reply_bd">' .
								'<p>' .$workflows[$i]['workflow_detail'] .'</p>' .
						'</div>';
				$workflow_str .= '</div>';
			}
		} else {
			$workflow_str = '';
		}
		$ret[0]['workflow_str'] = $workflow_str;
		$ret[0]['quick_reply_str'] = '';
		foreach($_QUICK_REPLY_LIST as $k => $quick_reply) {
			if (floor($k / 1000) == $ret[0]['type']) {
				$ret[0]['quick_reply_str'] .= '<option value="' . $quick_reply['txt'] . '">' . $quick_reply['key']  . '</option>';
			}
		}
		//备注信息
		$memo_count = IServiceReplyDao::getCount("complaint_id=" . $id ." and reply_type = 2");
		if ($memo_count > 0) {
			$ret[0]['memo_str'] = '<p class="ecc_mod_icon ecc_mod_icon5" id="cl_flag_memo_icon" title="已备注"></p>';
		} else {
			$ret[0]['memo_str'] = '';
		}
		$ret[0]['createTime_str'] = date("Y-m-d H:i:s", $ret[0]['createTime']);
		$ret[0]['est_comp_time_str'] = date("Y-m-d H:i:s", $ret[0]['est_comp_time']);
		$ret[0]['biz'] = $_biz_list[$ret[0]['biz']];
	
		if ($ret[0]['isVip'] == 1) {
			$ret[0]['vip_str'] = "VIP用户";
			$ret[0]['vip_icon_str'] = '<p title="" class="ecc_mod_icon ecc_mod_icon2"></p>';
		} else {
			$ret[0]['vip_str'] = "普通用户";
			$ret[0]['vip_icon_str'] = '';
		}
		if (!empty($ret[0]['detail'])) {
			$detail_array = json_decode($ret[0]['detail'], true);
		}
		$ret[0]['type_str'] = $_type_list[$ret[0]['type']];
		if (!empty($ret[0]['subType'])) {
			$ret[0]['subtype_str'] = $_subtype_list[$ret[0]['subType']];
			if ($ret[0]['state'] == 3) {
				$ret[0]['type_str'] = $ret[0]['subtype_str'] ;
			}
		} 
		if ($ret[0]['type'] == 2) {
			$ret[0]['deal_detail_str'] = '<ul class="deal_content1">
									<li><span>服务类型：</span>' . $ret[0]['subtype_str']. '</li>
									<li><span>订单状态：</span>' . $ret[0]['order_state']. '</li>
									<li><span>联系方式：</span>' . $ret[0]['userPhone']. '</li>
									</ul><ul class="deal_content2">';
			if ($ret[0]['subType'] == '203') {
				$ret[0]['deal_detail_str'] .= '<li><span>新时间：</span>' . urldecode($detail_array['postTime']) . "</li>";							 
			} else if ($ret[0]['subType'] == '202') {
				$ret[0]['deal_detail_str'] .= '<li><span>发票台头：</span>' . urldecode($detail_array['check'])   . "</li>";							 
				
			} else if ($ret[0]['subType'] == '201') {		
				$ret[0]['deal_detail_str'] .= '<li><span>新地区：</span>' . urldecode($detail_array['area'])  . "</li>";
				$ret[0]['deal_detail_str'] .= '<li><span>详细地址：</span>' . urldecode($detail_array['address'])  ."</li>";
				$ret[0]['deal_detail_str'] .= '<li><span>收货人：</span>' . urldecode($detail_array['consignee']) . "</li>";
				$ret[0]['deal_detail_str'] .= '<li><span>收货人电话：</span>' . urldecode($detail_array['order_mobile']) . "</li>";
			}
			$ret[0]['deal_detail_str'] .= '<li class="deal_content_msgcon"><span>留言内容：</span>' .  urldecode($detail_array['comment']) . "</li>";
		} else  if ($ret[0]['type'] == 8) {
			$ret[0]['deal_detail_str'] = '<ul class="deal_content1">
									<li><span>服务类型：</span>' . $ret[0]['type_str']. '</li>
									<li><span>订单状态：</span>' . $ret[0]['order_state']. '</li>
									<li><span>联系方式：</span>' . $ret[0]['userPhone']. '</li>
									</ul><ul class="deal_content2">';
			$ret[0]['deal_detail_str'] .= '<li><span>预约时间：</span>' . date("Y-m-d H:i", intval(urldecode($detail_array['vipuser_apply_time'])))  . "</li>";
			$ret[0]['deal_detail_str'] .= '<li><span>预约人：</span>' . urldecode($detail_array['connecter'])  ."</li>";
			$ret[0]['deal_detail_str'] .= '<li class="deal_content_msgcon"><span>预约内容：</span>' .  $ret[0]['content'] . "</li>";
		} else {
			if ($ret[0]['type'] == 4) {
				$ret[0]['deal_detail_str'] = '<ul class="deal_content1">
									<li><span>服务类型：</span>' . $ret[0]['subtype_str']. '</li>
									<li><span>订单状态：</span>' . $ret[0]['order_state']. '</li>
									<li><span>联系方式：</span>' . $ret[0]['userPhone']. '</li>
									</ul>';
			} else {
				$ret[0]['deal_detail_str'] = '<ul class="deal_content1">
									<li><span>服务类型：</span>' . $ret[0]['type_str']. '</li>
									<li><span>订单状态：</span>' . $ret[0]['order_state']. '</li>
									<li><span>联系方式：</span>' . $ret[0]['userPhone']. '</li>
									</ul>';
			}
			$ret[0]['deal_detail_str'] .= '<ul class="deal_content2"><li class="deal_content_msgcon"><span>留言内容：</span>' . $ret[0]['content'] . "</li></ul>";
		}
		
		
	 	if ($ret[0]['attachment']) {
		 	$att_array = preg_split("/[,;\n]/", $ret[0]['attachment']);
			$attachment_str = '';
			foreach($att_array as $row) {
				$attachment_str .= '<a href="' . $row  . '" class="ecc_detail_img fancybox"><img src="' . $row . '" target="_blank" /><i></i></a>';
			}
			$ret[0]['attachment_str'] = $attachment_str;
		}
		$ret[0]['week_ago_str'] = date("Y-m-d H:i:s", (time() - 7 * 24 *3600));
		$auth = IUser::getAuth();
		$ret[0]['privileges'] = array();
		if (in_array(AUTH_QA, $auth)) {
			$ret[0]['privileges'][] = 'QA';
		} 
		//是否有加急工单权限
		if (in_array(AUTH_SERVICE_SET, $auth)) {
			$ret[0]['privileges'][] = 'URGE';
		} 
		if ($ret[0]['state'] != 3) {
			$current_time = time();
			if ($current_time > $ret[0]['est_comp_time']) {
			 	$ret[0]['expire_time_str'] = '<span class="tc_1">当前与用户预期处理时间已超时'  . time2hour(($current_time - $ret[0]['est_comp_time']), 0) . '</span>';
			}
			$reply_count = IServiceReplyDao::getCount("complaint_id=" . $id ." and reply_type = 1");
			$ret[0]['reply_count'] = $reply_count;
			$ret[0]['apply_count'] = IServiceApplyDao::getCount("account='" . $ret[0]['account'] ."' and createTime > " . (time() - 7*24*3600));
			$tm = Config::getTMem('service_statistic');
			if ($tm) {
				$readCount = $tm->get(TMEM_BID_SERVICE_STATISTIC, $id . '_' . $ret[0]['account'] . "_view_count");;
				if(false === $readCount) {
					$readCount = 0;
				}
			}
			if ($readCount >= 2) {
				$ret[0]['readcount_str'] = '<p class="ecc_mod_inline ecc_mod_txt2">用户前台查看' . $readCount . '次，请加快受理</p>';
			}
			
		} else {
			$ret[0]['state_str'] = $_state_list[$ret[0]['state']];
			$ret[0]['approve_str'] = $_approve_list[$ret[0]['approve']];
			$ret[0]['checkup_str'] = $_checkup_list[$ret[0]['checkup']];
			$dt = $ret[0]['finishTime'] - $ret[0]['createTime'];
			$ret[0]['deal_time_str'] = time2hour($dt);
 			$ret[0]['finishTime_str'] = date("Y-m-d H:i:s", $ret[0]['finishTime']);
			$ret[0]['est_comp_time_str'] = date("Y-m-d H:i:s", $ret[0]['est_comp_time']);
			if (in_array(AUTH_QA, $auth)) {
				$ret[0]['censor_box_str'] = '<div class="ecc_fix_content grid_c1" id="kf_censor_zone">
											<!-- S 客户回复区 -->
												<div class="ecc_mod_box">
													<div class="ecc_mod_box_bd">
														<div class="ecc_mod_tit">
															<h4 class="tit">质检</h4>
														</div>
														<div class="ecc_editor">
															<!-- 文件编辑器放这里 -->
															<textarea cols="80" rows="6" id="kf_censor"></textarea>
														</div>
														<div class="ecc_mod_form_group" style="margin-top:10px;">
															<input type="radio" name="checkup" value="1" id="censor_radio1"><label for="censor_radio1">优</label>
															<input type="radio" name="checkup" value="2" id="censor_radio2"><label for="censor_radio2">良</label>
															<input type="radio" name="checkup" value="3" id="censor_radio3"><label for="censor_radio3">差</label>
														</div>
														<div class="ecc_box_action">
															<a class="mod_btn" id="normal_censor_submit" href="#">提交质检结果</a>
															<a class="mod_btn3" id="censor_submit" href="#">提交质检并重新归档</a>
														</div>
													</div>
												</div>
												<!-- S 质检-->
											</div>';
			} 
		}
		//处理加急
		if ($ret[0]['flag'] == 1) {
			$ret[0]['flag_str'] = "";
			$ret[0]['urge_btn_str'] = '<a class="mod_btn_disabled urge_button_disabled" href="#" urge="1" id="flag_1_btn" >该单已催办</a>';
		} else {
			$ret[0]['flag_str'] = ' style="display:none;"';
			$ret[0]['urge_btn_str'] = '<a class="mod_btn" href="#" urge="0" id="flag_1_btn" >加急催单</a>';
			
		}
		//处理归档信息
		if (!empty($ret[0]['archive'])) {
			$temp_array = explode(":", $ret[0]['archive']);
			if(!empty($temp_array)) {
				$archive['selected_id'] = $temp_array[1];
				$archive['name'] = $temp_array[0];
				$archive['level1'] = floor($temp_array[1] / 1000);
				$archive_level_1_str = '';
				$archive_level_2_str = '';
			 	foreach($_ARCHIVE_LIST as $key => $v) {
					if (floor($key / 1000) == $archive['level1']) {
						$archive_level_2_str .= '<li><a href="##" archive_id="' . $key . '" class="level-2 ' .($key == $archive['selected_id'] ? 'selected' : '') . '">' . $v['name'] .'</a></li>';
					} else if ($key < 1000) {
						$archive_level_1_str .= '<li><a href="##" archive_id="' . $key . '" class="level-1 ' .($key == $archive['level1'] ? 'selected' : '') . '">' . $v['name'] .'</a></li>';
					}
				}
				$ret[0]['archive_str'] = $archive['name'];
				$ret[0]['archive_level_1_str'] = $archive_level_1_str; 
				$ret[0]['archive_level_2_str'] = $archive_level_2_str;
			}
			
		} else {
			$archive = array();
			$archive_level_1_str = '<li><a href="##" archive_id="1" class="level-1 selected">商品咨询</a></li>
											<li><a href="##" archive_id="2" class="level-1">购物流问题</a></li>
											<li><a href="##" archive_id="3" class="level-1">订单问题</a></li>
											<li><a href="##" archive_id="4" class="level-1">售后</a></li>
											<li><a href="##" archive_id="5" class="level-1">用户评论</a></li>
											<li><a href="##" archive_id="6" class="level-1">账号及VIP特权</a></li>
											<li><a href="##" archive_id="7" class="level-1">用户投诉及其他</a></li>';
			$archive_level_2_str = '<li><a href="##" archive_id="1001" class="level-2">商品信息</a></li>
											<li><a href="##" archive_id="1002" class="level-2">预售首发商品</a></li>
											<li><a href="##" archive_id="1003" class="level-2">商品信息错误</a></li>
											<li><a href="##" archive_id="1004" class="level-2">价格举报</a></li>';
 		}
		$ret[0]['used_archive'] = $used_archive_arr;
		
	} else {
		ToolUtil::redirect("http://csi.ecc.com/");
	}
	
	$deal = $ret[0];
 	$TPL = new Template(ROOT_DIR . "tpl");
	if ($deal['state'] != 3) {
		$TPL->set_file("contentHandler", 'detail.tpl');
	} else {
		$TPL->set_file("contentHandler", 'detail_close.tpl');
	}
	$TPL->set_var($deal);
	$TPL->pparse("output", "contentHandler");
	
}
//清理未分配工单，预警工单，当工单结单时
function _cleaner($id) {
	$db = Config::getDB('b2b2c_kf_admin');
	$sql = "delete from spf_assign_unsolved where biz_id=" . $id . " limit 1";
	$db->execSql($sql);
	$sql = "delete from spf_assign_overtime where complaint_id=" . $id . " limit 1";
	$db->execSql($sql);
	return true;
}

//对分配任务的表和超时表进行更新
function _update_assgin_data($id, $rtx) {
	$db = Config::getDB('b2b2c_kf_admin');
	$sql = "delete from spf_assign_overtime where complaint_id=" . $id . " limit 1";
	$db->execSql($sql);
	$sql_count = " select count(*) as total  from spf_assign_unsolved where biz_id=" . $id;
	//print $sql_count;
	$ret = $db->getRows($sql_count);
	//print_r($ret);die(0);
	if ($ret[0]['total'] > 0) {
		$sql = "update spf_assign_unsolved set assign_kf='" . $rtx . "' where biz_id=" . $id . " limit 1";
		$db->execSql($sql);
	} else {
		$ret = IServiceApplyDao::getList(array(), 'id=' . $id, 0, 1);
		if (!empty($ret)) {
			$db = Config::getDB('b2b2c_kf_admin');
			$sql = "insert into spf_assign_unsolved set assign_kf='" . $rtx . "' , biz_id=" . $id . ", assign_time=" . time() 
				 . ", business='service', business_type=" . $ret[0]['type'] . ", business_subtype=" .$ret[0]['subType'].
				 ",source=" . $ret[0]['source'];
			$db->execSql($sql);
		}
	}
	
	return true;
}

//更新到统计表，归档和质检的结果
function _sync_stat($data, $type = 1) {
	$update_stat = array();
	if ($type == 1) {
		$update_stat['followKF'] = $data['followKF'];
		$update_stat['orderNo'] = $data['orderNo'];
		$update_stat['archive'] = $data['archive'];
		$update_stat['flag'] = $data['flag'];
		$update_stat['dealTime'] = $data['dealTime'];
		$update_stat['finishTime'] = $data['finishTime'];
		$update_stat['state'] = $data['state'];
		$update_stat['acceptTime'] = $data['acceptTime'];
	} else if ($type == 2) {
		//$update_stat['approve'] = $data['approve'];
		if (!empty($data['archive'])) {
			$update_stat['archive'] = $data['archive'];
		}
		$update_stat['censor'] = $data['censor'];
		$update_stat['checkup'] = $data['checkup'];
		$update_stat['checkupTime'] = $data['checkupTime'];
	}  else if ($type ==3) {
		$update_stat['state'] = 2;
	}else {
		return false;
	}
	$where = " billNo = " . intval($data['id']) . " and biz=1 ";
	return IStatDao::update($update_stat, $where);
	
}

