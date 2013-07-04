<?php
require_once LIB_PATH . 'ToolUtil.php';
require_once LIB_PATH . 'Template.php';
require_once API_PATH . 'IUser.php';
require_once BIZ_DAO_ROOT . 'IStatDao.php';

Logger::init();
IUser::init();
if(IUser::checkLogin() === false){
	 ToolUtil::redirect("http://csi.ecc.com");
}
//stat type 1=>每日分类统计，2=>每日不满意统计 , 3=>每日总量统计,4=>投诉归档, 5=>工作量统计
function page_kanban_page() {
	global $_type_list, $_ARCHIVE_LIST;
	$TPL = new Template(ROOT_DIR . "tpl");
	$yesterday_time = time() - (24 * 3600);
	$yesterday_date = date("Y-m-d", $yesterday_time);
	$before_yesterday_date = date("Y-m-d", time() - 2 *24 *3600);
	$month = date("n",$yesterday_time);
	$year = date("Y", $yesterday_time );
	$day  = date("d", $yesterday_time );
	$last_week_date = date("Y-m-d", time() - 8 * 24 *3600);
	$two_weeks_ago = date("Y-m-d", time()- 15 * 24 * 3600);
	$month_start_time = mktime(0, 0, 0, $month, 1, $year);
	$month_time_end = strtotime(date("Y-m-d"));
	$last_month_start_time = mktime(0, 0, 0, $month -1, 1, $year);
	$last_month_time_end = mktime(0, 0, 0, $month -1, $day, $year);
	$month_count = IStatDao::getCount("createTime < " . $month_time_end . " and createTime>" . $month_start_time);

	$last_month_count = IStatDao::getCount("createTime < " . $last_month_time_end . " and createTime>" . $last_month_start_time);
	if ($last_month_count == 0) {
		$last_month_count = 1;
	}
	$tb_percent = round(($month_count - $last_month_count) / $last_month_count, 3) * 100;
 	$total_count = IStatDao::getCount("createTime < " . $month_time_end);
	$dealed_count = IStatDao::getCount("createTime < " . $month_time_end . " and state>1");
	$dealed_percent = round($dealed_count/$total_count, 3) * 100;
	$trend_str = $tb_percent > 0 ? 'trend_arrow_up' : 'trend_arrow_down';
	$live_d = IStatDao::findLiveData();
	
	$live_data = json_decode($live_d['stat_value'], true);
	//$live_d['stat_key'] = '1958';
	$live_d_yesterday = json_decode(IStatDao::findLiveData2($yesterday_date, $live_d['stat_key']), ture);
	$yesterday_st_total = 0;
	if (!empty($live_d_yesterday)) {
		foreach($live_d_yesterday as $k => $v) {
			if (in_array($k, array('1', '2', '3'))) {
				foreach($v as $kk => $vv) {
					$yesterday_st_total += $vv;
				}
			}
		}
	}
	$today_total = 0;
	$today_array = array('1' => 0, '2' => 0, '3' => 0);
	$average_accept_time = time2hour($live_data['acceptTime']);
	$average_deal_time = time2hour($live_data['dealTime']);
	$exprie_data = array();
	foreach($_type_list as $k => $v) {
		$exprie_data[$k] = 0;
	}
	$expire = $live_data['expire'];
	foreach($live_data as $k => $v) {
		if (in_array($k, array('1', '2', '3'))) {
			foreach($v as $kk => $vv) {
				$today_total += $vv;
				$today_array[$k] += $vv;
			}
		}
	}
	if (!empty($expire)) {
		foreach($expire as $row) {
			$exprie_data[$row['type']] = round($row['total'] / $today_total, 2) * 100;
		}
	}
	ksort($exprie_data);
	if ($yesterday_st_total == 0) {
		$yesterday_st_total = 1;
	}
	$trend_st_percent = round(($today_total - $yesterday_st_total) / $yesterday_st_total, 2) * 100;
	$trend_st_str = '<div class="trend_per_wrap ' . ($trend_st_percent > 0 ? 'trend_up_wrap' : 'trend_down_wrap') . '"><span>' . abs($trend_st_percent) . '%</span></div>';
	$data_expire_arr_str = implode(",", $exprie_data);
	$data_undeal_arr_str = implode(",", $live_data[2]);
	$data_dealed_arr_str = implode(",", $live_data[3]);
	$data_dealing_arr_str = implode(",", $live_data[1]);
	
	$today_dealed_precent = round($today_array[3] / ($today_total + 1), 3) * 100;
	$today_dealing_precent = round($today_array[2] / ($today_total + 1), 3) * 100;
	$data = array('month' => $month, 'rtx'=> IUser::$rtx, 'month_count' => $month_count,'tb_percent' => $tb_percent,
					'total_count' => $total_count, 'dealed_count' => $dealed_count, 'dealed_percent' => $dealed_percent,
					'trend_str' => $trend_str, 'today_dealed_precent' => $today_dealed_precent, 'today_dealing_precent' => $today_dealing_precent,
					'today_total' => $today_total, 'average_accept_time' => $average_accept_time);
	$data += array('data_undeal_arr_str' => $data_undeal_arr_str, 'data_dealed_arr_str' => $data_dealed_arr_str, 'data_dealing_arr_str' => $data_dealing_arr_str);
	$data += array('data_expire_arr_str' => $data_expire_arr_str, 'trend_st_str' => $trend_st_str, 'average_deal_time' => $average_deal_time);
	//不满意度统计
	$approve_arr = array();
	$approve_data = IStatDao::findApproveData($yesterday_date);
	$approve_total = 0;
	if (!empty($approve_data)) {
		foreach ($approve_data as $row) {
			if ($row['stat_key'] == 'total') {
				$yesterday_total = $row['stat_value'];
			} else if($row['stat_key'] != 'unapprove_precent'){
				$approve_arr[$row['stat_key']] = $row['stat_value'];
				$approve_total += $row['stat_value'];
			}
		}
	}
	ksort($approve_arr);
	//print_r($approve_arr);die(0);
	$data_approve_arr_str = implode(",", $approve_arr);
	$approve_precent = round($approve_total / $yesterday_total, 3) * 100;
	$last_week_approve_precent = IStatDao::findApprovePrecent($last_week_date );
	$approve_trend = $approve_precent - $last_week_approve_precent;
	$approve_trend_str = '<div class="trend_per_wrap ' . ($approve_trend > 0 ? 'trend_up_wrap' : 'trend_down_wrap') . '"><span>' . $approve_trend . '%</span></div>';
	
 	$data += array('approve_precent' => $approve_precent, 'yesterday_total' => $yesterday_total, 'data_approve_arr_str' => $data_approve_arr_str,
					'approve_trend_str' => $approve_trend_str);
	//昨日完成情况
	$data_s = IStatDao::findStateData($yesterday_date);
	$data_state = array('2' => 0, '3' => 0);
	if (!empty($data_s)) {
		foreach($data_s as $row) {
			$data_state[$row['stat_key']] = $row['stat_value'];
		}
	}
	$yesterday_dealing_percent = round($data_state[2] / $yesterday_total, 2) * 100;	
	$yesterday_dealed_percent = round($data_state[3] / $yesterday_total, 2) * 100;
	$data += array('yesterday_dealing_percent' => $yesterday_dealing_percent, 'yesterday_dealed_percent' => $yesterday_dealed_percent);				
	//每日数据统计
	$daily_data = IStatDao::findDailyData($two_weeks_ago);
	$data_daily_x_arr = array();
	$data_daily_y_arr = array();
	if (!empty($daily_data)) {
		foreach($daily_data as $row) {
			$data_daily_x_arr[] = "'" . substr($row['stat_date'],8) . "'";
			$data_daily_y_arr[] = $row['stat_value'];
		}
		$data_daily_x_arr_str = implode(",", $data_daily_x_arr);
		$data_daily_y_arr_str = implode(",", $data_daily_y_arr);
	}
	$data += array('data_daily_x_arr_str' => $data_daily_x_arr_str, 'data_daily_y_arr_str' => $data_daily_y_arr_str);
	
	//工作量统计
	$wk_data = IStatDao::findWorkloadAvgData($two_weeks_ago);
	$data_wk_x_arr = array();
	$data_wk_y_arr = array();
	if (!empty($wk_data)) {
		foreach($wk_data as $row) {
			$data_wk_x_arr[] = "'" . substr($row['stat_date'],8) . "'";
			$data_wk_y_arr[] = $row['stat_value'];
		}
		$data_wk_x_arr_str = implode(",", $data_wk_x_arr);
		$data_wk_y_arr_str = implode(",", $data_wk_y_arr);
	}
	$data += array('data_daily_x_arr_str' => $data_daily_x_arr_str, 'data_daily_y_arr_str' => $data_daily_y_arr_str,
				'data_wk_x_arr_str' => $data_wk_x_arr_str, 'data_wk_y_arr_str' => $data_wk_y_arr_str);
	
	//工作量排行
	$work_rank_data = IStatDao::findWorkloadData($yesterday_date, true);
	$work_rank_data1 = IStatDao::findWorkloadData($before_yesterday_date);
	$wk_arr = array();
	if(!empty($work_rank_data1)) {
		foreach($work_rank_data1 as $row) {
			$wk_arr[$row['stat_key']] = $row['stat_value'];
		}
	}
	
	$work_rank_str = '';
	if(!empty($work_rank_data)) {
		foreach($work_rank_data as $row) {
			$work_rank_str .= '<tr>
										<td class="partment_col">' . $row['stat_key'] . '</td>
										<td class="per_col">' . $row['stat_value'] . '</td>
										<td class="trend_col"><i class="' . (!empty($wk_arr[$row['stat_key']]) && $wk_arr[$row['stat_key']] > $row['stat_value'] ? 'icon_trend_down' : 'icon_trend_up')  . '"></i></td>
								</tr>';
			$i++;
		}
	}
	$data += array('work_rank_str' => $work_rank_str);
	
	//归档排行
	$archive_rank = IStatDao::findArchiveData($yesterday_date, 4);
	$archive_rank1 = IStatDao::findArchiveData($before_yesterday_date, 4);
	$arch_arr = array();
	if(!empty($archive_rank1)) {
		foreach($archive_rank1 as $row) {
			$arch_arr[$row['stat_key']] = $row['stat_value'];
		}
	}
	$archive_rank_str = '';
	if(!empty($archive_rank)) {
		
		foreach($archive_rank as $row) {
			$archive_rank_str .= '<tr>
										<td class="partment_col" style="overflow:hidden;white-space:nowrap;">' . $_ARCHIVE_LIST[$row['stat_key']]['name'] . '</td>
										<td class="per_col">' . $row['stat_value'] . '</td>
										<td class="trend_col"><i class="'. (!empty($arch_arr[$row['stat_key']]) && $arch_arr[$row['stat_key']] > $row['stat_value'] ? 'icon_trend_down' : 'icon_trend_up') . '"></i></td>
								</tr>';
		}
	}
	$data += array('archive_rank_str' => $archive_rank_str);
	//后续考虑动态加载
	//咨询归档统计
	$archive_rank_zx = IStatDao::findArchiveData($yesterday_date, 8);
	$archive_rank_zx1 = IStatDao::findArchiveData($before_yesterday_date, 8);
	$arch_arr = array();
	if(!empty($archive_rank_zx1)) {
		foreach($archive_rank_zx1 as $row) {
			$arch_arr[$row['stat_key']] = $row['stat_value'];
		}
	}
	$archive_rank_zx_str = '';
	if(!empty($archive_rank_zx)) {
		foreach($archive_rank_zx as $row) {
			$archive_rank_zx_str .= '<tr>
										<td class="partment_col" style="overflow:hidden;white-space:nowrap;">' . $_ARCHIVE_LIST[$row['stat_key']]['name'] . '</td>
										<td class="per_col">' . $row['stat_value'] . '</td>
										<td class="trend_col"><i class="'. (!empty($arch_arr[$row['stat_key']]) && $arch_arr[$row['stat_key']] > $row['stat_value'] ? 'icon_trend_down' : 'icon_trend_up') . '"></i></td>
								</tr>';
		}
	}
	$data += array('archive_rank_zx_str' => $archive_rank_zx_str);
	
	//数据输出
	$TPL->set_file("contentHandler", 'kanban.tpl');
	$TPL->set_var($data);
	$TPL->pparse("output", "contentHandler");
}


