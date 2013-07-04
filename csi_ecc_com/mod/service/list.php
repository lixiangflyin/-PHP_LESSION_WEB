<?php
require_once BIZ_DAO_ROOT . 'IServiceApplyDao.php';
require_once LIB_PATH . 'ToolUtil.php';
require_once API_PATH . 'IGroup.php';

Logger::init();

function list_export() {
	global $_flag_list, $_source_list, $_biz_list, $_state_list, $_approve_list, $_checkup_list, $_type_list, $_subtype_list, $_fields_map_whole;
	$conditions = array();
	$fields = $_GET['fields'];
	$stype = $_GET['stype'];
	//简单查询
	if ($stype == 'simple') {
		$type = $_GET['type'];
		$key  = trim($_GET['key']);
		$where = "";
		$key_array = preg_split("/[;\n]/", $key);
		if (empty($key_array)) {
			die("错误参数");
		}
		if ($type == 1) {
			if (count($key_array) == 1) {
				$where .= " id = " . intval($key_array[0]);
			} else {
				$where .= " id in(" . implode(",", $key_array) . ")";
			}
		} else {
			if (count($key_array) == 1) {
				$where .= " orderNo = '" . addslashes($key_array[0]) . "'";
			} else {
				foreach ($key_array as &$row) {
					$row = "'" . addslashes($row) . "'";
				}
				unset($row);
				$where .= " orderNo in (" . implode(",", $key_array) . ")";
			}
		}
	} else if($stype == 'advanced') {
		$where = _adv_search_where();
	} else {
		die("错误参数");
	}
	if(!empty($fields)) {
		$fields = "id," . $fields;
		$fields_array = explode(",", $fields);
		if (in_array('content', $fields_array)) {
			$fields_array[] = 'detail';
		}
	} else {
		$fields_array = array('id', 'orderNo', 'account', 'followKF', 'userPhone', 'type', 'createTime', 'state', 'content', 'detail');
	}
	
    $ret = IServiceApplyDao::findApplyList3($where, $fields_array, 1);
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
	array_to_csv($data, '工单导出');
	
	die(0);
}

//简单查询
function list_simpleSearch() {
	global $_fields_map_whole;
	$conditions = array();
	$type = $_POST['type'];
	$key  = trim($_POST['key']);
	$page  = intval($_POST['page']);
	$fields = $_POST['fields'];
	
	if (empty($page)) {
		$page = 1;
	}
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
	$key_array = preg_split("/[;\n]/", $key);
	if (empty($key_array)) {
		return array('errno' => 1);
	}
	$where = "";
	if ($type == 1) {
		if (count($key_array) == 1) {
			$where .= " id = " . intval($key_array[0]);
		} else {
			$where .= " id in(" . implode(",", $key_array) . ")";
		}
	} else {
		if (count($key_array) == 1) {
			$where .= " orderNo = '" . $key_array[0] . "'";
		} else {
			foreach ($key_array as &$row) {
				$row = "'" . $row . "'";
			}
			unset($row);
			$where .= " orderNo in (" . implode(",", $key_array) . ")";
		}
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
	} else {
		$fields_array = array('id', 'orderNo', 'account', 'followKF', 'userPhone', 'type', 'createTime', 'state', 'content');
	}
    $ret = IServiceApplyDao::findApplyList($where, $start, $page_limit, $fields_array, " " . $order_by . " " . $order_dir, 1);
	
	foreach($fields_array as $field) {
		if($field != 'detail') {
				$fields_map[$field] = $_fields_map_whole[$field];
		}
	}
		
	$data = array('list' => $ret, 'fields_map' => $fields_map, 'pages' => $page_count, 'page' => $page, 'order_by' => $order_by, 'order_dir' => $order_dir);
	return array(
			'errno' => 0,
			'data'  => $data
	);
}

function list_getInfo() {
	
	$groups = IGroup::getGroupList();
	$data['groups'] = $groups;
	return array(
			'errno' => 0,
			'data'  => $data
	);
}

//获取高级搜索的where条件

function _adv_search_where() {
	$conditions = array();
	$type = $_REQUEST['type'];
	if ($type == 'undefined') {
		$type = null;
	}
	$key  = trim($_REQUEST['key']);
	$state = intval($_REQUEST['state']);
	$reply_state = intval($_REQUEST['reply_state']);
	$userPhone = addslashes($_REQUEST['userPhone']);
	$account = addslashes($_REQUEST['account']);
	$flag = intval($_REQUEST['flag']);
	$approve = intval($_REQUEST['approve']);
	$checkup = intval($_REQUEST['checkup']);
	$isVip = intval($_REQUEST['isVip']);
	$archive = addslashes($_REQUEST['archive']);
	$source = intval($_REQUEST['source']);
	$accept_expire = intval($_REQUEST['accept_expire']);
	$finish_expire = intval($_REQUEST['finish_expire']);
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
	
	if (!empty($state)) {
		$conditions[] = " state = " . $state;
	}
	
	if (!empty($approve)) {
		if ($approve == 3) {
			$conditions[] = " approve = 0";
		} else {
			$conditions[] = " approve = " . $approve;
		}
	}
	
	if (!empty($reply_state)) {
		if ($reply_state == 2) {
			$conditions[] = " hasReply = 1";
		} else {
			$conditions[] = " hasReply = 0";
		}
	}
	
	if (!empty($checkup)) {
		$conditions[] = " checkup = " . $checkup;
	}
	
	if (!empty($state)) {
		$conditions[] = " state = " . $state;
	}
	
	if (!empty($flag)) {
		$conditions[] = " flag = " . $flag;
	}
	
	if (!empty($isVip)) {
		if($isVip == 1) {
			$conditions[] = " isVip = 1 ";
		} else {
			$conditions[] = " isVip = 0 ";
		}
	}
	
	if (!empty($source)) {
		$conditions[] = " source = " . $source;
	}
	
	if (!empty($account)) {
		$conditions[] = " account = '" . $account . "'";
	}

	if (!empty($userPhone)) {
		$conditions[] = " userPhone = '" . $userPhone . "'";
	}
	
	if (!empty($archive)) {
		$conditions[] = " archive = '" . $archive . "'";
	}
	
	if (!empty($_REQUEST['start_time']) && ToolUtil::checkDateTime($_REQUEST['start_time'] . ":00")) {
		$conditions[] = " createTime >= " . strtotime($_REQUEST['start_time']);
	}
	
	if (!empty($_REQUEST['end_time']) && ToolUtil::checkDateTime($_REQUEST['end_time'] . ":00")) {
		$conditions[] = " createTime <= " . strtotime($_REQUEST['end_time']);
	}
	if (!empty($accept_expire)) {
		if($accept_expire == 1) {
			$conditions[] = " ext1 = 1 ";
		} else {
			$conditions[] = " ext1 = 0 ";
		}
	}
	if (!empty($finish_expire)) {
		if($finish_expire == 1) {
			$conditions[] = " ext3 = 1 ";
		} else {
			$conditions[] = " ext3 = 0 ";
		}
	}
	if (!empty($key)) {
		$key_array = preg_split("/[;\n]/", $key);
	}
	$where = "";
	if(!empty($conditions)) {
		$where .= implode(" AND ", $conditions);
	} else {
		$where = " 1 ";
	}
	if (!empty($key_array)) {
		foreach ($key_array as &$row) {
			$row = "'" . addslashes($row) . "'";
		}
		unset($row);
		$where .= (empty($where) ? '' : ' AND') . " followKF in (" . implode(",", $key_array) . ")";
	}
	return $where;
}

//高级查询

function list_advancedSearch() {
	global $_fields_map_whole;
	$page  = intval($_POST['page']);
	$fields = addslashes($_POST['fields']);
	if(!empty($fields)) {
		$fields = "id," . $fields;
		$fields_array = explode(",", $fields);
	} else {
		$fields_array = array();
	}	
	if (empty($page)) {
		$page = 1;
	}
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
	
	$where = _adv_search_where();
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
		$fields_array = array('id', 'orderNo', 'account', 'followKF', 'userPhone', 'type', 'createTime', 'state', 'content', 'detail');
	}
    $ret = IServiceApplyDao::findApplyList($where, $start, $page_limit, $fields_array, " " . $order_by . " " . $order_dir, 1);
	foreach($fields_array as $field) {
		if($field != 'detail') {
				$fields_map[$field] = $_fields_map_whole[$field];
		}
	}
	$data = array('list' => $ret, 'fields_map' => $fields_map, 'pages' => $page_count, 'page' => $page, 'order_by' => $order_by, 'order_dir' => $order_dir);
	return array(
			'errno' => 0,
			'data'  => $data
	);
}

