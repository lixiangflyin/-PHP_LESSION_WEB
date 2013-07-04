<?php
require_once BIZ_DAO_ROOT . 'IServiceApplyDao.php';
require_once BIZ_DAO_ROOT . 'IWorkflowDao.php';
require_once LIB_PATH . 'ToolUtil.php';
require_once API_PATH . 'IGroup.php';
require_once API_PATH . 'IUser.php';
require_once API_PATH . 'IMember.php';

Logger::init();
IUser::init();
if(IUser::checkLogin() === false){
	return array('errno' => 500, 'msg' => '请重新登录');
}

function team_init() {
	$current_user = IUser::$rtx;
	$page  = intval($_POST['page']);
	$groups = IGroup::getGroup4Leader($current_user);
	if (empty($page)) {
		$page = 1;
	}
	$group_id = $_POST['group_id'];
	if (empty($group_id)) {
		foreach($groups as $g) {
			$group_id[] = $g['gid'];
		}
		$selected_group = 0;
	} else {
		$selected_group = $group_id;
	}
	
	$page_count = 1;
	$members = IMember::getMemberByGroup($group_id);
	$ret = array();
	$rtx_str = '';
	if (count($members) > 0 ) {
		foreach($members as $m) {
			$ret[$m['rtx_id']]['rtx_id'] = $m['rtx_id'];
			$ret[$m['rtx_id']]['uid'] = $m['uid'];
			$rtx_str .= "'" . $m['rtx_id'] . "',";
		}
	} else {
		return array(
			'errno' => 1
		);
	}
	$where = " followKF in(" . substr($rtx_str, 0, -1) .")";
	$undeal = IServiceApplyDao::getCount2( $where . " and state=1");
	$dealing = IServiceApplyDao::getCount2($where . " and state=2 and hasReply=1");
	$dealing2 = IServiceApplyDao::getCount2($where . "  and state=2 and hasReply=0");
	$dealed = IServiceApplyDao::getCount2($where . "  and state=3");
	$urge_deal = IServiceApplyDao::getCount2($where . "  and flag = 1");
	foreach($ret as &$row) {
		$row['undeal_count'] = 0;
		foreach($undeal as $ud) {
			if ($ud['followKF'] == $row['rtx_id']) {
				$row['undeal_count'] = $ud['total'];
			}
		}
		$row['dealing_count'] = 0;
		foreach($dealing as $ud) {
			if ($ud['followKF'] == $row['rtx_id']) {
				$row['dealing_count'] = $ud['total'];
			}
		}
		$row['dealing_count2'] = 0;
		foreach($dealing2 as $ud) {
			if ($ud['followKF'] == $row['rtx_id']) {
				$row['dealing_count2'] = $ud['total'];
			}
		}
		$row['dealed_count'] = 0;
		foreach($dealed as $ud) {
			if ($ud['followKF'] == $row['rtx_id']) {
				$row['dealed_count'] = $ud['total'];
			}
		}
		$row['urge_deal_count'] = 0;
		foreach($urge_deal as $ud) {
			if ($ud['followKF'] == $row['rtx_id']) {
				$row['urge_deal_count'] = $ud['total'];
			}
		}
		$row['deal_expire_count'] = 0;
		$row['finish_expire_count'] = 0;
	}
	unset($row);
	$return_arr = array();
	foreach($ret as $r) {
		$return_arr[] = $r;
	}
	$data = array('list' => $return_arr, 'pages' => $page_count, 'page' => $page, 'groups' => $groups, 'selected_group' => $selected_group);
	
	return array(
			'errno' => 0,
			'data'  => $data
	);
}

//组内员工的工作流水
function team_memberWork() {
	global $_workflow_list;
	$today = date("Y-m-d");
	$start_time = strtotime($today);
	$end_time = $start_time + 3600 * 24;
	$page_start = 0;
	$limit = 20;
	$kf = $_POST['kf'];
	$page = $_POST['page'];
	if(empty($page)) {
		$page = 1;
 	}
	$where = " create_by='" . $kf ."' and create_time>" . $start_time . " and create_time < " . $end_time;
	
	$count = IWorkflowDao::getCount($where);
	$page_limit = 10;
	$page_count = ceil($count / $page_limit);
	if ($page < 1 || $page > $page_count) {
		$page = 1;
	}
	$start = ($page - 1) * 	$page_limit;
	$workflows = IWorkflowDao::getList(array('create_time', 'complaint_id', 'workflow_type'), $where, $start, $page_limit);
	if(!empty($workflows)) {
		foreach($workflows as &$row) {
			$row['create_time'] = date("H:i:s", $row['create_time']);
			if (!in_array($row['workflow_type'], array(10, 11))) {
				$row['detail'] = $_workflow_list[$row['workflow_type']] . '&nbsp;<a href="/page.php?biz=service&mod=deal&act=detail&id=' . $row['complaint_id'] . '">工单' . $row['complaint_id'] .'</a>';
			} else {
				$row['detail'] = $_workflow_list[$row['workflow_type']] ;
			}
		}
		unset($row);
	}
	$data = array('list' => $workflows, 'pages' => $page_count, 'page' => $page);
	return array(
			'errno' => 0,
			'data'  => $data
	);
}
