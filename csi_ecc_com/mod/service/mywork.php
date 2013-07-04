<?php
require_once BIZ_DAO_ROOT . 'IServiceApplyDao.php';
require_once LIB_PATH . 'ToolUtil.php';
require_once BIZ_DAO_ROOT . 'IMessageDao.php';
require_once BIZ_DAO_ROOT . 'IAssignmentDao.php';
require_once API_PATH . 'IGroup.php';

Logger::init();

//导出待处理工单

function mywork_unsolvedExport() {
	
	$conditions = _get_conditions();
	$fields = $_GET['fields'];
	
	$kf = $_COOKIE['rtx'];
	$where = " followKF='" . $kf . "' AND ";
	if(!empty($conditions)) {
		$where .= implode(" AND ", $conditions);
	}
	_export($where, $fields, 1);
	
	die(0);
}

//超时告警导出

function mywork_overtimeExport() {
	
	$conditions = _get_conditions();
	$fields = $_GET['fields'];
	$kf = $_COOKIE['rtx'];
	if (empty($kf)) {
		return array(
			'errno' => 1,
			'msg'  => '请登录'
		);
	}
	$ret = IAssignmentDao::findByKF($kf);
	$ids = array(0);
	if(!empty($ret)) {
		foreach($ret as $r) {
			$ids[] = $r['complaint_id'];
		}
	}
	
	$where = " id in(" . implode(",", $ids) . ") and ";
	if(!empty($conditions)) {
		$where .= implode(" AND ", $conditions);
	}
	_export($where, $fields, 1);
	
	die(0);
}

//抽取出请求处理function

function _get_conditions() {
	$type = $_GET['type'];
	$flag = $_GET['flag'];
	$expire = $_GET['expire'];
	$reply_state = $_GET['reply_state'];
	$state = intval($_GET['state']);
	$conditions = array();
	if (empty($state)) {
		$conditions[] = ' state != 3';
	} else if(in_array($state, array('1', '2'))) {
		$conditions[] = ' state = ' . $state;
	}
	if (!empty($type)) {
		$type_arr = explode(",", $type);
		$type_condition = array();
		foreach ($type_arr as $r) {
			if ($r > 100) {
				$type_condition[] = ' subtype = ' . intval($r);
			} else {
				$type_condition[] = ' type = ' . intval($r);
			}
		}
		$conditions[] = " ( " . implode(" or ", $type_condition) . ")";
	}
	if (!empty($flag)) {
		$conditions[] = ' flag=' . intval($flag);
	}
	if ($expire) {
		$conditions[] = 'nextTime <=' . time();
	}
	if (!empty($reply_state) && $reply_state == 1) {
		$conditions[] = 'hasReply = 1';
	} else if (!empty($reply_state) && $reply_state == 2) {
		$conditions[] = 'hasReply = 0';
	}
	return $conditions;
}
//导出数据公共部分

function _export($where, $fields, $subtype = 0) {
	
	global $_flag_list, $_source_list, $_biz_list, $_state_list, $_approve_list, $_checkup_list, $_type_list, $_subtype_list, $_fields_map_whole ;
	
	if(!empty($fields)) {
		$fields = "id," . $fields;
		$fields_array = explode(",", $fields);
		if (in_array('content', $fields_array)) {
			$fields_array[] = 'detail';
		}
	} else {
		$fields_array = array('id', 'orderNo', 'userName', 'userPhone', 'type', 'createTime', 'state', 'content', 'detail');
	}
    $ret = IServiceApplyDao::findApplyList3($where,$fields_array, $subtype);
	foreach($fields_array as $f) {
		$fields_arr[] = $_fields_map_whole[$f];
	}
	$data[0] = $fields_arr;
	foreach($ret as &$row) {
		if(!empty($row['createTime'])) {
			$row['createTime'] = date("Y-m-d H:i:s", $row['createTime']);
		}
		if(!empty($row['finishTime'])) {
			$row['finishTime'] = date("Y-m-d H:i:s", $row['finishTime']);
		}
		if(!empty($row['acceptTime'])) {
			$row['acceptTime'] = date("Y-m-d H:i:s", $row['acceptTime']);
		}
		if(!empty($row['state'])) {
			$row['state'] = $_state_list[$row['state']];
		}
		if(!empty($row['type'])) {
			if ($row['type'] > 100) {
				$row['type'] = $_subtype_list[$row['type']];
			} else {
				$row['type'] = $_type_list[$row['type']];
			}
		}
		if(!empty($row['flag'])) {
			$row['flag'] = $_flag_list[$row['flag']];
		}
		if(isset($row['isVip']) && $row['isVip'] == 1) {
			$row['isVip'] = '是';
		}
		if(isset($row['isVip']) && $row['isVip'] == 0) {
			$row['isVip'] = '否';
		}
		if(!empty($row['approve'])) {
			$row['approve'] = $_approve_list[$row['approve']];
		}
		if(!empty($row['checkup'])) {
			$row['checkup'] = $_checkup_list[$row['checkup']];
		}
	}
	unset($row);
	foreach($ret as $r) {
		$data[] = $r;
	}
	array_to_csv($data, '工单');
}

//组内未分配工单导出

function mywork_unassignExport() {
	$conditions = _get_conditions();
	$fields = $_GET['fields'];
	$current_user = $_COOKIE['rtx'];
	$group_id = $_GET['group_id'];
	$groups = IGroup::getGroup4Leader($current_user);
	$types = array();
	if(empty($group_id)) {
		foreach($groups as $g) {
			if(!empty($g['biz_ids'])) {
				foreach($g['biz_ids'] as $bid) {
					//$types[] = floor($bid / 10000);
					if ($bid % 10000 != 0) {
						$types[] = " (type=" . floor($bid / 10000) . " and subtype=" . ($bid % 1000) . " ) ";
					} else {
						$types[] = " (type=" . floor($bid / 10000) . ")";
					}
		 		}
			}
		}
	} else {
		foreach($groups as $g) {
			if(!empty($g['biz_ids']) && $g['gid'] == $group_id) {
				foreach($g['biz_ids'] as $bid) {
					if ($bid % 10000 != 0) {
						$types[] = " (type=" . floor($bid / 10000) . " and subtype=" . ($bid % 1000) . " ) ";
					} else {
						$types[] = " (type=" . floor($bid / 10000) . ")";
					}
				}
			}
		}
	}
	$types = array_unique($types);
	if (!empty($types)) {
		$conditions[] = " ( " . implode(" or ", $types) . " )";
	}
	
	$where = " followKF = '' AND ";
	if(!empty($conditions)) {
		$where .= implode(" AND ", $conditions);
	}
	_export($where, $fields, 1);
	die(0);
}

//组内待处理工单

function mywork_groupunassign() {
	global  $_fields_map_whole;
	$current_user = $_COOKIE['rtx'];
	$groups = IGroup::getGroup4Leader($current_user);
	$conditions = array();
	$page  = intval($_POST['page']);
	$fields = $_POST['fields'];
	//$type = $_POST['type'];
	$flag = $_POST['flag'];
	$group_id = $_POST['group_id'];
	$expire = $_POST['expire'];
	$reply_state = $_POST['reply_state'];
	$state = intval($_POST['state']);
	$order_by = $_POST['order_by'];
	$order_dir = $_POST['order_dir'];
	
	if (empty($order_by)) {
		$order_by = "createTime";
	}
	if (empty($order_dir)) {
		$order_dir = "DESC";
	} else {
		$order_dir = strtoupper($order_dir);
	}
	if (empty($page)) {
		$page = 1;
	}
	
	$types = array();
	if(empty($group_id)) {
		foreach($groups as $g) {
			if(!empty($g['biz_ids'])) {
				foreach($g['biz_ids'] as $bid) {
					//$types[] = floor($bid / 10000);
					if ($bid % 10000 != 0) {
						$types[] = " (type=" . floor($bid / 10000) . " and subtype=" . ($bid % 1000) . " ) ";
					} else {
						$types[] = " (type=" . floor($bid / 10000) . ")";
					}
		 		}
			}
		}
	} else {
		foreach($groups as $g) {
			if(!empty($g['biz_ids']) && $g['gid'] == $group_id) {
				foreach($g['biz_ids'] as $bid) {
					if ($bid % 10000 != 0) {
						$types[] = " (type=" . floor($bid / 10000) . " and subtype=" . ($bid % 1000) . " ) ";
					} else {
						$types[] = " (type=" . floor($bid / 10000) . ")";
					}
				}
			}
		}
	}
	$types = array_unique($types);
	if (!empty($types)) {
		$conditions[] = " ( " . implode(" or ", $types) . " )";
	}
	if (empty($state)) {
		$conditions[] = ' state != 3';
	} else if(in_array($state, array('1', '2'))) {
		$conditions[] = ' state = ' . $state;
	}
	if (!empty($flag)) {
		$conditions[] = ' flag=' . intval($flag);
	}
	if ($expire) {
		$conditions[] = 'nextTime <=' . time();
	}
	if (!empty($reply_state) && $reply_state == 1) {
		$conditions[] = 'hasReply = 1';
	} else if (!empty($reply_state) && $reply_state == 2) {
		$conditions[] = 'hasReply = 0';
	}
	$where = " followKF = '' AND ";
	if(!empty($conditions)) {
		$where .= implode(" AND ", $conditions);
	} 
	$count = IServiceApplyDao::getCount($where);
	$page_limit = 30;
	$page_count = ceil($count / $page_limit);
	if ($page < 1 || $page > $page_count) {
		$page = 1;
	}
	$start = ($page - 1) * 	$page_limit;
	if(!empty($fields)) {
		$fields = "id," . $fields;
		$fields_array = explode(",", $fields);
		if (in_array('content', $fields_array)) {
			$fields_array[] = 'detail';
		}
	} else {
		$fields_array = array('id', 'orderNo', 'account', 'userPhone', 'type', 'createTime', 'state', 'content', 'detail');
	}
	
    $ret = IServiceApplyDao::findApplyList($where, $start, $page_limit, $fields_array, " " . $order_by . " " .  $order_dir, 1);
	
	foreach($fields_array as $field) {
		if($field != 'detail') {
				$fields_map[$field] = $_fields_map_whole[$field];
		}
	}
	
	$data = array('list' => $ret, 'fields_map' => $fields_map, 'pages' => $page_count, 'page' => $page, 'groups' => $groups, 'order_by' => $order_by, 'order_dir' => $order_dir);
	return array(
			'errno' => 0,
			'data'  => $data
	);
}
//未处理工单
function mywork_unsolved() {
	global $_fields_map_whole;
	$conditions = array();
	$page  = intval($_POST['page']);
	$fields = $_POST['fields'];
	$type = $_POST['type'];
	$flag = $_POST['flag'];
	$expire = $_POST['expire'];
	$reply_state = $_POST['reply_state'];
	$state = intval($_POST['state']);
	$order_by = $_POST['order_by'];
	$order_dir = $_POST['order_dir'];
	if (empty($page)) {
		$page = 1;
	}
	if (empty($order_by)) {
		$order_by = "createTime";
	}
	if (empty($order_dir)) {
		$order_dir = "DESC";
	} else {
		$order_dir = strtoupper($order_dir);
	}
	
	if (empty($state)) {
		$conditions[] = ' state != 3';
	} else if(in_array($state, array('1', '2'))) {
		$conditions[] = ' state = ' . $state;
	}
	if (!empty($type)) {
		$type_arr = explode(",", $type);
		$type_condition = array();
		foreach ($type_arr as $r) {
			if ($r > 100) {
				$type_condition[] = ' subtype = ' . intval($r);
			} else {
				$type_condition[] = ' type = ' . intval($r);
			}
		}
		$conditions[] = " ( " . implode(" or ", $type_condition) . ")";
	}
	
	if (!empty($flag)) {
		$conditions[] = ' flag=' . intval($flag);
	}
	if ($expire) {
		if ($exprie == 1) {
			$conditions[] = ' nextTime > 0 and nextTime <=' . time();
		} else {
			$conditions[] = ' nextTime >=' . time();
		}
	}
	if (!empty($reply_state) && $reply_state == 1) {
		$conditions[] = 'hasReply = 1';
	} else if (!empty($reply_state) && $reply_state == 2) {
		$conditions[] = 'hasReply = 0';
	}
	$kf = $_COOKIE['rtx'];
	$where = " followKF='" . $kf . "' AND ";
	if(!empty($conditions)) {
		$where .= implode(" AND ", $conditions);
	} 
	$count = IServiceApplyDao::getCount($where);
	$page_limit = 10;
	$page_count = ceil($count / $page_limit);
	if ($page < 1 || $page > $page_count) {
		$page = 1;
	}
	$start = ($page - 1) * 	$page_limit;
	if(!empty($fields)) {
		$fields = "id," . $fields;
		$fields_array = explode(",", $fields);
		if (in_array('content', $fields_array)) {
			$fields_array[] = 'detail';
		}
	} else {
		$fields_array = array('id', 'orderNo',  'type', 'content', 'createTime', 'state','detail');
	}
	
    $ret = IServiceApplyDao::findApplyList($where, $start, $page_limit, $fields_array, " " . $order_by . " " .  $order_dir, 1);
	if (empty($fields_array)) {
		$fields_map = array('id' => '单据号', 'orderNo' => '订单号',  'userName' => '用户帐号', 'userPhone' => '用户电话',  'createTime' => '创建时间', 'type'=> '单据类型', 'state' => '单据状态', 'content' => '问题详情');
	} else {
		foreach($fields_array as $field) {
			if($field != 'detail') {
				$fields_map[$field] = $_fields_map_whole[$field];
			}
		}
	}
	$data = array('list' => $ret, 'fields_map' => $fields_map, 'pages' => $page_count, 'page' => $page, 'order_by' => $order_by, 'order_dir' => $order_dir);
	return array(
			'errno' => 0,
			'data'  => $data
	);
}
//消息删除
function mywork_msgDel() {
	$id = $_POST['id'];
	if (empty($id)) {
		return array(
			'errno' => 1,
			'data'  => '参数错误'
		);
	}
	$current_user = $_COOKIE['rtx'];
	if (empty($current_user)) {
		return array(
			'errno' => 2,
			'data'  => '未登录'
		);
	}
	$where = " target_user='" . $current_user . "' and id in(" . $id . ")";
	$count = IMessageDao::getCount($where);
	if ($count != count(explode(",", $id))) {
		return array(
			'errno' => 3,
			'data'  => '非法参数'
		);
	}
	IMessageDao::remove($where);
	$ret = explode(",", $id);
	return array(
			'errno' => 0,
			'data'  => $ret
	);
}

//消息全部标识为已读
function mywork_msgReadAll() {
	$username = $_POST['username'];

	$current_user = $_COOKIE['rtx'];
	if (empty($current_user) && $username != $current_user) {
		return array(
			'errno' => 2,
			'data'  => '未登录或者非法用户'
		);
	}
	$where = " target_user='" . $current_user . "'";
	$data = array('has_read' => 1, 'read_time' => time());
	IMessageDao::update($data, $where);
	
	return array(
			'errno' => 0,
			'data'  => $ret
	);
}

//设置消息已读
function mywork_setFlag() {
	$id = $_POST['id'];
	if (empty($id)) {
		return array(
			'errno' => 0,
			'data'  => '参数错误'
		);
	}
	
	$current_user = $_COOKIE['rtx'];
	if (empty($current_user)) {
		return array(
			'errno' => 1,
			'data'  => '未登录'
		);
	}
	
	$where = " target_user='" . $current_user . "' and id in(" . $id . ")";
	$count = IMessageDao::getCount($where);
	if ($count != count(explode(",", $id))) {
		return array(
			'errno' => 2,
			'data'  => '非法参数'
		);
	}
	
	$data = array('has_read' => 1, 'read_time' => time());
	IMessageDao::update($data, $where);
	$ret = explode(",", $id);
	return array(
			'errno' => 0,
			'data'  => $ret
	);
}
//我的消息
function mywork_message() {
	global $_MESSAGE_LIST;
	$page  = intval($_POST['page']);
	if (empty($page)) {
		$page = 1;
	}
	if (!empty($_POST['filter'])) {
		$filter = 1;
	} else {
		$filter = 0;
	}
	$current_user = $_COOKIE['rtx'];
	if (empty($current_user)) {
		return array(
			'errno' => 0,
			'data'  => '未登录'
		);
	}
	$where = " target_user='" . $current_user . "'";
	if ($filter) {
		$total_where = $where;
		$where .= ' and has_read=0 ';
	}
	$count = IMessageDao::getCount($where);
	if ($filter) {
		$total_count = IMessageDao::getCount($total_where);
	} else {
		$total_count = $count;
	}
	$unread_count = IMessageDao::getCount($where . " and has_read=0");
	$page_limit = 10;
	$page_count = ceil($count / $page_limit);
	if ($page < 1 || $page > $page_count) {
		$page = 1;
	}
	$start = ($page - 1) * 	$page_limit;
	
	$ret = IMessageDao::getList(array(), $where, $start, $page_limit);
	if(!empty($ret)) {
		foreach($ret as &$row) {
			$row['title'] = $_MESSAGE_LIST[$row['msg_type']];
		}
		unset($row);
	}
	$data = array('list' => $ret, 'pages' => $page_count, 'page' => $page, 'total' => $total_count, 'unread_total' => $unread_count);
	
	return array(
			'errno' => 0,
			'data'  => $data
	);
}

//超时预警工单

function mywork_overtime() {
	global $_fields_map_whole;
	$conditions = array();
	$page  = intval($_POST['page']);
	$fields = $_POST['fields'];
	$type = $_POST['type'];
	$flag = $_POST['flag'];
	$expire = $_POST['expire'];
	$reply_state = $_POST['reply_state'];
	$state = intval($_POST['state']);
	$order_by = $_POST['order_by'];
	$order_dir = $_POST['order_dir'];
	if (empty($order_by)) {
		$order_by = "createTime";
	}
	if (empty($order_dir)) {
		$order_dir = "DESC";
	} else {
		$order_dir = strtoupper($order_dir);
	}
	
	$kf = $_COOKIE['rtx'];
	if (empty($kf)) {
		return array(
			'errno' => 1,
			'msg'  => '请登录'
		);
	}
	$ret = IAssignmentDao::findByKF($kf);
	$ids = array(0);
	if(!empty($ret)) {
		foreach($ret as $r) {
			$ids[] = $r['complaint_id'];
		}
	}
 	if (empty($page)) {
		$page = 1;
	}
	if (empty($state)) {
		$conditions[] = ' state != 3';
	} else if(in_array($state, array('1', '2'))) {
		$conditions[] = ' state = ' . $state;
	}
	if (!empty($type)) {
		$type_arr = explode(",", $type);
		$type_condition = array();
		foreach ($type_arr as $r) {
			if ($r > 100) {
				$type_condition[] = ' subtype = ' . intval($r);
			} else {
				$type_condition[] = ' type = ' . intval($r);
			}
		}
		$conditions[] = " ( " . implode(" or ", $type_condition) . ")";
	}
	
	if (!empty($flag)) {
		$conditions[] = ' flag=' . intval($flag);
	}
	if ($expire) {
		$conditions[] = 'nextTime <=' . time();
	}
	if (!empty($reply_state) && $reply_state == 1) {
		$conditions[] = 'hasReply = 1';
	} else if (!empty($reply_state) && $reply_state == 2) {
		$conditions[] = 'hasReply = 0';
	}
	
	$where = " id in(" . implode(",", $ids) . ") and ";
	if(!empty($conditions)) {
		$where .= implode(" AND ", $conditions);
	} 
	$count = IServiceApplyDao::getCount($where);
	$page_limit = 10;
	$page_count = ceil($count / $page_limit);
	if ($page < 1 || $page > $page_count) {
		$page = 1;
	}
	$start = ($page - 1) * 	$page_limit;
	if(!empty($fields)) {
		$fields = "id," . $fields;
		$fields_array = explode(",", $fields);
		if (in_array('content', $fields_array)) {
			$fields_array[] = 'detail';
		}
	} else {
		$fields_array = array('id', 'orderNo',  'type', 'content', 'createTime', 'state', 'detail');
	}
	
    $ret = IServiceApplyDao::findApplyList($where, $start, $page_limit, $fields_array, " " . $order_by . " " . $order_dir, 1);
	if (empty($fields_array)) {
		$fields_map = array('id' => '单据号', 'orderNo' => '订单号',  'userName' => '用户帐号', 'userPhone' => '用户电话',  'createTime' => '创建时间', 'type'=> '单据类型', 'state' => '单据状态', 'content' => '问题详情');
	} else {
		foreach($fields_array as $field) {
			if ($field != 'detail') {
				$fields_map[$field] = $_fields_map_whole[$field];
			}
		}
	}
	$data = array('list' => $ret, 'fields_map' => $fields_map, 'pages' => $page_count, 'page' => $page, 'order_by' => $order_by, 'order_dir' => $order_dir);
	return array(
			'errno' => 0,
			'data'  => $data
	);
}
