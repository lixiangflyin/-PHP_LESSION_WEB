<?php
class IClickFlow
{
	public static $errCode = 0;
    public static $errMsg = "";

    const PERIOD_TYPE_10MINUTELY = 1;
    const PERIOD_TYPE_HOURLY     = 2;
    const PERIOD_TYPE_DAILY      = 3;

    /*
    获取单天页面核心指标数据
    输入：$day：日期（2012-02-12），无需时分秒数据
    	 $wh_id：分站id
    	 $page_id:页面id
    */
    public static function getPageKeyDataSingleDay( $day, $page_id, $wh_id = 1 )
    {
    	$dayStamp = strtotime($day);
    	if (FALSE == $dayStamp) {
    		self::$errCode = -100;
    		self::$errMsg = "day($day) is not valid";
    		return false;
    	}

        $day = date("Y-m-d", $dayStamp);

    	$sevenDaysAgo = date("Y-m-d", $dayStamp - 7 * 24 * 3600);
    	$sixDaysAgo = date("Y-m-d", $dayStamp - 6 * 24 * 3600);
    	$oneDayAgo = date("Y-m-d", $dayStamp - 24 * 3600);
    	$oneDayAfter = date("Y-m-d", $dayStamp + 24 * 3600);

    	$clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;
    		return false;
    	}

    	$result = array();
    	$result['timespan'] = "{$day} 00:00:00 至 {$oneDayAfter} 00:00:00";

    	$sql = "SELECT convert(varchar(19), s_date, 120) as s_date, click_num, pv, uv, order_num FROM t_aggregation_10minutely_page_keydata
    			WHERE warehouse_id=$wh_id AND page_id=$page_id AND ((s_date >= '$sevenDaysAgo' AND s_date < '$sixDaysAgo') OR
    				  (s_date >= '$oneDayAgo' AND s_date < '$day') OR
    				  (s_date >= '$day' AND s_date < '$oneDayAfter')) ORDER BY s_date ASC";

    	$rows = $clickFlowDB->getRows($sql);
    	if (false === $rows) {
    		self::$errCode = $clickFlowDB->errCode;
    		self::$errMsg = $clickFlowDB->errMsg;
    		return false;
    	}
    	$pv = 0;
    	$click_num = 0;
    	$order_num = 0;

        $data_7daysAgo = array();
        $data_1daysAgo = array();
        $data_request_day = array();
    	foreach ($rows as $row)
    	{
    		if (strncmp($row['s_date'], $sevenDaysAgo, 10) == 0) {
    			$data_7daysAgo[] = $row;
    		}else if (strncmp($row['s_date'], $oneDayAgo , 10) == 0) {
    			$data_1daysAgo[] = $row;
    		}else if (strncmp($row['s_date'], $day, 10) == 0) {
    			$data_request_day[] = $row;
    			$pv += $row['pv'];
    			$click_num += $row['click_num'];
    			$order_num += $row['order_num'];
    		}
    	}

        // 获取连续的线图
        $null_row = array(
                's_date' => '1970-01-01 00:00:00',
                'click_num' => 0,
                'pv' => 0,
                'uv' => 0,
                'order_num' => 0,
            );
        $start_time = $sevenDaysAgo . " 00:00:00";
        $end_time = $sevenDaysAgo . " 23:50:00";
        $result['7daysAgo'] = self::_getSequentialCharts($start_time, $end_time, self::PERIOD_TYPE_10MINUTELY, $data_7daysAgo, $null_row);

        $start_time = $oneDayAgo . " 00:00:00";
        $end_time = $oneDayAgo . " 23:50:00";
        $result['1daysAgo'] = self::_getSequentialCharts($start_time, $end_time, self::PERIOD_TYPE_10MINUTELY, $data_1daysAgo, $null_row);

        $start_time = $day . " 00:00:00";
        $end_time = $day . " 23:50:00";
        $result['request_day'] = self::_getSequentialCharts($start_time, $end_time, self::PERIOD_TYPE_10MINUTELY, $data_request_day, $null_row);

    	//如果选择的不是当日，则去以日为单位的表中去获取当日PV,UV,点击数
    	$today = strtotime(date('Y') . "-" . date('m') . "-" . date('d'));
    	if ($today != $dayStamp) {
    		$sql = "SELECT convert(varchar(19), s_date, 120) as s_date, click_num, pv, uv, order_num FROM t_aggregation_daily_page_keydata where s_date='$day' AND warehouse_id=$wh_id AND page_id=$page_id";
    		$total_rows = $clickFlowDB->getRows($sql);
    		if (false === $total_rows) {
	    		self::$errCode = $clickFlowDB->errCode;
	    		self::$errMsg = $clickFlowDB->errMsg;
	    		return false;
	    	}

	    	$result['pv'] = isset($total_rows[0])?$total_rows[0]['pv']:0;
	    	$result['uv'] = isset($total_rows[0])?$total_rows[0]['uv']:0;
	    	$result['click_num'] = isset($total_rows[0])?$total_rows[0]['click_num']:0;
	    	$result['order_num'] = isset($total_rows[0])?$total_rows[0]['order_num']:0;
    	}else
    	{
    		$result['pv'] = $pv;
	    	$result['uv'] = "-";
	    	$result['click_num'] = $click_num;
	    	$result['order_num'] = $order_num;
    	}

    	return $result;
    }

    /*
    获取单天页面核心指标数据
    输入：$startDate：日期（2012-02-12），无需时分秒数据
    	 $endDate：  日期（2012-02-12），无需时分秒数据
    	 $wh_id：分站id
    	 $page_id:页面id

   	注意：本函数不会校验$startDate， $endDate的大小关系，需要调用方保证
   		 时间有效区间为左闭右开  [$startDate, $endDate)
    */
    public static function getPageKeyDataMultiDays($page_id , $startDate, $endDate, $wh_id = 1 )
    {

    	$clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;
    		return false;
    	}

    	$result = array();
    	$result['timespan'] = "{$startDate} 至 {$endDate}";

    	$sql = "SELECT convert(varchar(10), s_date, 120) as s_date, click_num, pv, uv, order_num FROM t_aggregation_daily_page_keydata
    			WHERE warehouse_id=$wh_id AND page_id=$page_id AND s_date >= '$startDate' AND s_date <= '$endDate' ORDER BY s_date ASC";

    	$rows = $clickFlowDB->getRows($sql);
    	if (false === $rows) {
    		self::$errCode = $clickFlowDB->errCode;
    		self::$errMsg = $clickFlowDB->errMsg;
    		return false;
    	}
    	$pv = 0;
    	$click_num = 0;
    	$order_num = 0;
        $uv = 0;

    	foreach ($rows as &$row)
    	{
			$pv += $row['pv'];
			$click_num += $row['click_num'];
			$order_num += $row['order_num'];
            $uv += $row['uv'];
    	}

        // 获取连续的线图
        $null_row = array(
                's_date' => '1970-01-01',
                'click_num' => 0,
                'pv' => 0,
                'uv' => 0,
                'order_num' => 0,
            );
        $start_time = $startDate;
        $end_time = $endDate;
        $data_charts = self::_getSequentialCharts($start_time, $end_time, self::PERIOD_TYPE_DAILY, $rows, $null_row);

		$result['pv'] = $pv;
		//$result['uv'] = "-";
        $result['uv'] = $uv;    //多日UV相加 update by mandyzhou at 20120713
		$result['click_num'] = $click_num;
		$result['order_num'] = $order_num;
		$result['data'] = &$data_charts;
    	return $result;
    }

    /*
    获取单天页面核心指标数据
    输入：$wh_id：分站id
    	 $page_id:页面id
    	 $n: 最近n分钟 (10的整数倍,例如：10，20，30)
    */
    public static function getPageKeyDataRecentNMins($page_id , $n_mins, $wh_id = 1 )
    {

    	$clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;
    		return false;
    	}

        $rencent_end_time = self::_getClickFlowLatestTime(self::PERIOD_TYPE_10MINUTELY);
        if (false === $rencent_end_time) {
            return false;
        }

        $recent_start_time = date("Y-m-d H:i:s", strtotime($rencent_end_time) - 60 * ($n_mins - 10));

	    $sql = "SELECT convert(varchar(19), s_date, 120) as s_date, click_num, pv, uv, order_num FROM t_aggregation_10minutely_page_keydata
    	        WHERE warehouse_id=$wh_id AND page_id=$page_id and s_date >= '{$recent_start_time}' and s_date <= '{$rencent_end_time}' ORDER BY s_date ASC";
    	$result = array();
    	$rows = $clickFlowDB->getRows($sql);
    	if (false === $rows) {
    		self::$errCode = $clickFlowDB->errCode;
    		self::$errMsg = $clickFlowDB->errMsg;
    		return false;
    	}

        $show_rencent_end_time = date('Y-m-d H:i:s', strtotime($rencent_end_time) + 600);
        $result['timespan'] = "{$recent_start_time} 至 {$show_rencent_end_time}";
        $pv = 0;
        $click_num = 0;
        $order_num = 0;
        foreach ($rows as &$row)
        {
            $pv += $row['pv'];
            $click_num += $row['click_num'];
            $order_num += $row['order_num'];
        }

        // 获取连续的线图
        $null_row = array(
                's_date' => '1970-01-01 00:00:00',
                'click_num' => 0,
                'pv' => 0,
                'uv' => 0,
                'order_num' => 0,
            );
        $start_time = $recent_start_time;
        $end_time = $rencent_end_time;
        $data_charts = self::_getSequentialCharts($start_time, $end_time, self::PERIOD_TYPE_10MINUTELY, $rows, $null_row);

        $result['data'] = &$data_charts;
        $result['pv'] = $pv;
        $result['uv'] = "-";
        $result['click_num'] = $click_num;
        $result['order_num'] = $order_num;

    	return $result;
    }

    private static function _getSequentialCharts( $start_time, $end_time, $period_type, &$source_data, $null_row )
    {
        $seconds_increment = 600;
        $time_format = "Y-m-d H:i:s";
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $seconds_increment = 600;
            $time_format = "Y-m-d H:i:s";
        }
        else if ($period_type == self::PERIOD_TYPE_HOURLY) {
            $seconds_increment = 3600;
            $time_format = "Y-m-d H:i:s";
        }
        else if ($period_type == self::PERIOD_TYPE_DAILY) {
            $seconds_increment = 3600 * 24;
            $time_format = "Y-m-d";
        }
        else {
            self::$errCode = -1000;
            self::$errMsg = "Wrong period type!";

            return false;
        }

        $stats = array();
        foreach ($source_data as $row) {
            $stats[$row['s_date']] = $row;
        }

        $charts = array();
        $start_stamp = strtotime($start_time);
        $end_stamp = strtotime($end_time);
        for ($stamp_iter = $start_stamp; $stamp_iter <= $end_stamp; $stamp_iter += $seconds_increment) {
            $time_str = date($time_format, $stamp_iter);
            $row = null;
            if (isset($stats[$time_str])) {
                $row = $stats[$time_str];
            }
            else {
                $row = $null_row;
                $row['s_date'] = $time_str;
            }

            $charts[] = $row;
        }

        return $charts;
    }

    /*
     * 获取某个页面的 -日期时间范围内- 所有可点击位置的点击量数据
     * 每个数据为所选时间范围的汇总数据
     * 用于页面热力图展示
     *
     * @param $start_date, $end_date string 日期（2012-02-12），无需时分秒数据
     * @param $page_id int 页面ID
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getPageClickDataDays( $start_date, $end_date, $page_id, $wh_id = 1 )
    {
        return self::_getPageClickData($start_date, $end_date, self::PERIOD_TYPE_DAILY, $page_id, $wh_id);
    }

    /*
     * 获取某个页面的 -当天- 所有可点击位置的点击量数据
     * 每个数据为 -当天的分钟时间范围- 的汇总数据
     * 用于页面热力图展示
     *
     * @param $page_id: int 页面id
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getPageClickDataToday( $page_id, $wh_id = 1 )
    {
        $today = date("Y-m-d");
        $today_start = $today . " 00:00:00";
        $today_end = $today . " 23:50:00";

        return self::_getPageClickData($today_start, $today_end, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id);
    }

    /*
     * 获取某个页面的 -最近几个10分钟内- 所有可点击位置的点击量数据
     * 每个数据为所选时间范围的汇总数据
     * 用于页面热力图展示
     *
     * @param $page_id: int 页面id
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getPageClickDataRecentMins( $n_mins, $page_id, $wh_id = 1 )
    {
        $rencent_end_time = self::_getClickFlowLatestTime(self::PERIOD_TYPE_10MINUTELY);
        if (false === $rencent_end_time) {
            return false;
        }

        $recent_start_time = date("Y-m-d H:i:s", strtotime($rencent_end_time) - 60 * ($n_mins - 10));

        return self::_getPageClickData($recent_start_time, $rencent_end_time, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id);
    }

    /*
     * 获取最早的统计时间
     *
     * @param $period_type 统计周期类型
     *
     * @return
     */
    private static function _getClickFlowLatestTime( $period_type )
    {
        $now = time();
        $latest_time = false;
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $latest_time = date("Y-m-d H", $now - 600);
            $min = date("i", $now - 600);
            $min = 10 * intval($min / 10);
            $latest_time .= ":" . sprintf("%02d", $min) . ":00";
        }
        else if ($period_type == self::PERIOD_TYPE_HOURLY) {
            $latest_time = date("Y-m-d H", $now - 3600);
        }
        else if ($period_type == self::PERIOD_TYPE_DAILY) {
            $latest_time = date("Y-m-d", $now - 3600 * 24);
        }
        else {
            self::$errCode = -1000;
            self::$errMsg = "Wrong period type!";

            return false;
        }

/**
        $table_name = self::_getClickDataTableName($period_type);
        if (false === $table_name) {
            return $latest_time;
        }

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return $latest_time;
    	}

        $sql_stmt = "SELECT top 1 CONVERT(VARCHAR(19), s_date, 120) as s_date FROM {$table_name} ORDER BY s_date DESC";
        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows || empty($rows)) {
            return $latest_time;
        }
        else {
            $latest_time = $rows[0]['s_date'];
        }
**/
        return $latest_time;
    }

    private static function _getClickDataTableName( $period_type )
    {
        $table_name = "";
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $table_name = "t_aggregation_10minutely_page_clickdata";
        } else if ($period_type == self::PERIOD_TYPE_HOURLY) {
            $table_name = "t_aggregation_hourly_page_clickdata";
        }
        else if ($period_type == self::PERIOD_TYPE_DAILY) {
            $table_name = "t_aggregation_daily_page_clickdata";
        }
        else {
            self::$errCode = -1000;
            self::$errMsg = "[Get page click data table name]: Wrong period type!";

            return false;
        }

        return $table_name;
    }

    private static function _getPageClickData( $start_time, $end_time, $period_type, $page_id, $wh_id = 1 )
    {
        $table_name = self::_getClickDataTableName($period_type);
        if (false === $table_name) {
            return false;
        }

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $order_by = "ORDER BY click_num DESC";
        $sql_stmt = <<<SQL_STMT
            SELECT * FROM
            (
                SELECT booth_tag,
                       SUM(click_num) as click_num,
                       SUM(order_num) as order_num
                FROM {$table_name}
                WHERE s_date >= '{$start_time}' and s_date <= '{$end_time}'
                    AND warehouse_id = {$wh_id} AND page_id = {$page_id}
                GROUP BY booth_tag
            ) as t {$order_by}
SQL_STMT;

        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        foreach ($rows as &$row) {
            //$row['page_tag'] = intval($page_id) * 100000 + intval($row['booth_tag']);
            $row['page_tag'] = sprintf("%05d", intval($row['booth_tag']));
            unset($row['booth_tag']);

            $click_trans_rate = ($row['click_num'] == 0) ? 0 : ($row['order_num'] * 100) / $row['click_num'];
            $row['click_trans_rate'] = number_format((float) $click_trans_rate, 2, '.', '');
        }

        $result = array();
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $show_end_time = date('Y-m-d H:i:s', strtotime($end_time) + 600);
        }
        else {
            $show_end_time = $end_time;
        }
        $result['timespan'] = "{$start_time} 至 {$show_end_time}";
        $result['period_type'] = $period_type;
        $result['page_id'] = $page_id;
        $result['data'] = &$rows;

        return $result;
    }

    /*
     * 获取某个页面的 -日期时间范围内- 展位的下单笔数TOP N排行榜数据
     * 每个数据为所选时间范围的汇总数据
     *
     * @param $start_date, $end_date string 日期（2012-02-12），无需时分秒数据
     * @param $page_id int 页面ID
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getTopBoothClickDataDays( $start_date, $end_date, $page_id, $wh_id = 1, $top_num = 10 )
    {
        return self::_getTopBoothClickData($start_date, $end_date, self::PERIOD_TYPE_DAILY, $page_id, $wh_id, $top_num);
    }

    public static function getTopBoothClickDataToday( $page_id, $wh_id = 1, $top_num = 10 )
    {
        $today = date("Y-m-d");
        $today_start = $today . " 00:00:00";
        $today_end = $today . " 23:50:00";

        return self::_getTopBoothClickData($today_start, $today_end, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id, $top_num);
    }

    public static function getTopBoothClickDataRecentMins( $n_mins, $page_id, $wh_id = 1, $top_num = 10 )
    {
        $rencent_end_time = self::_getClickFlowLatestTime(self::PERIOD_TYPE_10MINUTELY);
        if (false === $rencent_end_time) {
            return false;
        }

        $recent_start_time = date("Y-m-d H:i:s", strtotime($rencent_end_time) - 60 * ($n_mins - 10));

        return self::_getTopBoothClickData($recent_start_time, $rencent_end_time, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id, $top_num);
    }

    private static function _getTopBoothClickData( $start_time, $end_time,
                                                    $period_type, $page_id,
                                                    $wh_id = 1, $top_num = 10 )
    {
        $table_name = self::_getClickDataTableName($period_type);
        if (false === $table_name) {
            return false;
        }

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $top = "TOP {$top_num}";
        $order_by = "ORDER BY order_num DESC";
        $sql_stmt = <<<SQL_STMT
            SELECT {$top} * FROM
            (
                SELECT booth_tag as booth_id,
                       SUM(click_num) as click_num,
                       SUM(order_num) as order_num,
                       SUM(order_product_num) as order_product_num,
                       SUM(order_fee) as order_fee
                FROM {$table_name}
                WHERE s_date >= '{$start_time}' and s_date <= '{$end_time}'
                    AND warehouse_id = {$wh_id} AND page_id = {$page_id}
                GROUP BY booth_tag
            ) as t {$order_by}
SQL_STMT;

        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        foreach ($rows as &$row) {
            //$row['page_tag'] = intval($page_id) * 100000 + intval($row['booth_id']) * 10;
            $row['page_tag'] = sprintf("%05d", intval($row['booth_id']));
            unset($row['booth_id']);

            $row['order_fee'] = number_format((float) $row['order_fee'], 2, '.', '');

            $click_trans_rate = ($row['click_num'] == 0) ? 0 : ($row['order_num'] * 100) / $row['click_num'];
            $row['click_trans_rate'] = number_format((float) $click_trans_rate, 2, '.', '');

            $unit_product_num = ($row['order_num'] == 0) ? 0 : $row['order_product_num'] / $row['order_num'];
            $row['unit_product_num'] = number_format((float) $unit_product_num, 2, '.', '');

            $unit_product_price = ($row['order_num'] == 0) ? 0 : $row['order_fee'] / $row['order_num'];
            $row['unit_product_price'] = number_format((float) $unit_product_price, 2, '.', '');
        }

        $result = array();
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $show_end_time = date('Y-m-d H:i:s', strtotime($end_time) + 600);
        }
        else {
            $show_end_time = $end_time;
        }
        $result['timespan'] = "{$start_time} 至 {$show_end_time}";
        $result['period_type'] = $period_type;
        $result['page_id'] = $page_id;
        $result['data'] = &$rows;

        return $result;
    }

    /*
     * 获取某个页面的 -日期时间范围内- 商品的下单笔数TOP N排行榜数据
     * 每个数据为所选时间范围的汇总数据
     *
     * @param $start_date, $end_date string 日期（2012-02-12），无需时分秒数据
     * @param $page_id int 页面ID
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getTopProductClickDataDays( $start_date, $end_date, $page_id, $wh_id = 1, $top_num = 10 )
    {
        return self::_getTopProductClickData($start_date, $end_date, self::PERIOD_TYPE_DAILY, $page_id, $wh_id, $top_num);
    }

    public static function getTopProductClickDataToday( $page_id, $wh_id = 1, $top_num = 10 )
    {
        $today = date("Y-m-d");
        $today_start = $today . " 00:00:00";
        $today_end = $today . " 23:50:00";

        return self::_getTopProductClickData($today_start, $today_end, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id, $top_num);
    }

    public static function getTopProductClickDataRecentMins( $n_mins, $page_id, $wh_id = 1, $top_num = 10 )
    {
        $rencent_end_time = self::_getClickFlowLatestTime(self::PERIOD_TYPE_10MINUTELY);
        if (false === $rencent_end_time) {
            return false;
        }

        $recent_start_time = date("Y-m-d H:i:s", strtotime($rencent_end_time) - 60 * ($n_mins - 10));

        return self::_getTopProductClickData($recent_start_time, $rencent_end_time, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id, $top_num);
    }

    private static function _getTopProductClickData( $start_time, $end_time,
                                                      $period_type, $page_id,
                                                      $wh_id = 1, $top_num = 10 )
    {
        $table_name = self::_getClickDataTableName($period_type);
        if (false === $table_name) {
            return false;
        }

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $top = "TOP {$top_num}";
        $order_by = "ORDER BY order_num DESC";
        $sql_stmt = <<<SQL_STMT
            SELECT {$top} t.* FROM
            (
                SELECT product_id,
                       SUM(click_num) as click_num,
                       SUM(order_num) as order_num,
                       SUM(order_product_num) as order_product_num,
                       SUM(order_fee) as order_fee
                FROM {$table_name}
                WHERE s_date >= '{$start_time}' and s_date <= '{$end_time}'
                    AND warehouse_id = {$wh_id} AND page_id = {$page_id} AND product_id > 0
                GROUP BY product_id
            ) as t
            {$order_by}
SQL_STMT;

        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        // 获取商品名
        $product_ids_array = array();
        foreach ($rows as &$row) {
            $product_ids_array[] = $row['product_id'];
        }
        $product_names = self::_getProductNames($product_ids_array, $wh_id);
        if (false === $product_names) {
            return false;
        }

        foreach ($rows as &$row) {
            //$row['product_name'] = isset($product_names[$row['product_id']]) ? $product_names[$row['product_id']] : '';
            if(isset($product_names[$row['product_id']])){
                $arr_name_code = explode('||', $product_names[$row['product_id']]);
                $row['product_name'] = $arr_name_code[0];
                $row['product_code'] = $arr_name_code[1];
            }else{
                $row['product_name'] = '';
                $row['product_code'] = '';
            }

            $row['order_fee'] = number_format((float) $row['order_fee'], 2, '.', '');

            $click_trans_rate = ($row['click_num'] == 0) ? 0 : ($row['order_num'] * 100) / $row['click_num'];
            $row['click_trans_rate'] = number_format((float) $click_trans_rate, 2, '.', '');

            $unit_product_num = ($row['order_num'] == 0) ? 0 : $row['order_product_num'] / $row['order_num'];
            $row['unit_product_num'] = number_format((float) $unit_product_num, 2, '.', '');

            $unit_product_price = ($row['order_num'] == 0) ? 0 : $row['order_fee'] / $row['order_num'];
            $row['unit_product_price'] = number_format((float) $unit_product_price, 2, '.', '');
        }

        $result = array();
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $show_end_time = date('Y-m-d H:i:s', strtotime($end_time) + 600);
        }
        else {
            $show_end_time = $end_time;
        }
        $result['timespan'] = "{$start_time} 至 {$show_end_time}";
        $result['period_type'] = $period_type;
        $result['page_id'] = $page_id;
        $result['data'] = &$rows;

        return $result;
    }

    private static function _getProductNames( &$product_ids_array, $wh_id = 1 )
    {
        $product_ids_str = join(",", $product_ids_array);

        //$erp_db_name = "ERP_{$wh_id}";
		$erp_db_name = "ICSON_Product";

        $erpDB = ToolUtil::getMSDBObj($erp_db_name);
    	if (false === $erpDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $sql_stmt = <<<SQL_STMT
            SELECT SysNo as product_id,
                   ProductName as product_name,
                   ProductID as product_code
            FROM Product
            WHERE SysNo IN ($product_ids_str)
SQL_STMT;

        $rows = $erpDB->getRows($sql_stmt);
         if (false === $rows) {
            self::$errCode = $erpDB->errCode;
            self::$errMsg = $erpDB->errMsg;

            return false;
        }

        $result = array();
        foreach ($rows as &$row) {
            $result[$row['product_id']] = $row['product_name'].'||'.$row['product_code'];
        }

        return $result;
    }

    /*
     * 获取某个页面的 -日期时间范围内- 被框住的页面点击位置的汇总点击数据
     * 每个数据为所选时间范围的汇总数据
     *
     * @param $start_date, $end_date string 日期（2012-02-12），无需时分秒数据
     * @param $page_id int 页面ID
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getBoothClickDataDays( $start_date, $end_date, $page_id, $page_tag_array, $wh_id = 1 )
    {
        return self::_getBoothClickData($start_date, $end_date, self::PERIOD_TYPE_DAILY, $page_id, $page_tag_array, $wh_id);
    }

    public static function getBoothClickDataToday( $page_id, $page_tag_array, $wh_id = 1 )
    {
        $today = date("Y-m-d");
        $today_start = $today . " 00:00:00";
        $today_end = $today . " 23:50:00";

        return self::_getBoothClickData($today_start, $today_end, self::PERIOD_TYPE_10MINUTELY, $page_id, $page_tag_array, $wh_id);
    }

    public static function getBoothtClickDataRecentMins( $n_mins, $page_id, $page_tag_array, $wh_id = 1 )
    {
        $rencent_end_time = self::_getClickFlowLatestTime(self::PERIOD_TYPE_10MINUTELY);
        if (false === $rencent_end_time) {
            return false;
        }

        $recent_start_time = date("Y-m-d H:i:s", strtotime($rencent_end_time) - 60 * ($n_mins - 10));

        return self::_getBoothClickData($recent_start_time, $rencent_end_time, self::PERIOD_TYPE_10MINUTELY, $page_id, $page_tag_array, $wh_id);
    }

    private static function _getBoothClickData( $start_time, $end_time,
                                                 $period_type,
                                                 $page_id, $page_tag_array,
                                                 $wh_id = 1 )
    {
        $booth_tag_array = array();
        foreach ($page_tag_array as $page_tag) {
            //$booth_tag_array[] = intval(intval($page_tag) % 100000);
            $booth_tag_array[] = intval($page_tag);
        }

        $booth_tag_string = join(",", $booth_tag_array);

        $table_name = self::_getClickDataTableName($period_type);
        if (false === $table_name) {
            return false;
        }

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $sql_stmt = <<<SQL_STMT
            SELECT ISNULL(click_num, 0) as click_num,
                   ISNULL(order_num, 0) as order_num
            FROM
            (
                SELECT SUM(ISNULL(click_num, 0)) as click_num,
                       SUM(ISNULL(order_num, 0)) as order_num
                FROM {$table_name}
                WHERE s_date >= '{$start_time}' and s_date <= '{$end_time}'
                    AND warehouse_id = {$wh_id} AND page_id = {$page_id}
                    AND booth_tag in ({$booth_tag_string})
            ) as t
SQL_STMT;

        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        foreach ($rows as &$row) {
            $click_trans_rate = ($row['click_num'] == 0) ? 0 : ($row['order_num'] * 100) / $row['click_num'];
            $row['click_trans_rate'] = number_format((float) $click_trans_rate, 2, '.', '');
        }

        // 获取页面总点击量
        $sql_stmt = <<<SQL_STMT
            SELECT SUM(click_num) as click_num
            FROM {$table_name}
            WHERE s_date >= '{$start_time}' and s_date <= '{$end_time}'
                AND warehouse_id = {$wh_id} AND page_id = {$page_id}
SQL_STMT;

        $page_rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $page_rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        $page_total_clickdata = 0;
        if (isset($page_rows[0])) {
            $page_total_clickdata = intval($page_rows[0]['click_num']);
        }

        if (isset($rows[0])) {
            $click_num_rate = ($page_total_clickdata == 0) ? 0 : ($rows[0]['click_num'] * 100) / $page_total_clickdata;
            $rows[0]['click_num_rate'] = number_format((float) $click_num_rate, 2, '.', '');
        }

        $result = array();
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $show_end_time = date('Y-m-d H:i:s', strtotime($end_time) + 600);
        }
        else {
            $show_end_time = $end_time;
        }
        $result['timespan'] = "{$start_time} 至 {$show_end_time}";
        $result['period_type'] = $period_type;
        $result['page_id'] = $page_id;
        $result['data'] = &$rows;

        return $result;
    }

    /*
     * 获取某个可点击位置$day_num天内的点击数据趋势
     *
     * @param $page_id int 页面ID
     * @paran $page_tag int 可点击位置的TAG
     * @param $wh_id int 分站id
     * @param #day_num int 天数
     *
     * @return
     */
    public static function getBoothClickDataTrendsDays ( $page_id, $page_tag, $wh_id = 1, $day_num = 30 )
    {
        $yesterday = date("Y-m-d", strtotime("-1 day"));

        return self::_getBoothClickDataTrends($yesterday, $page_id, $page_tag, $wh_id, $day_num);
    }

    private static function _getBoothClickDataTrends( $trends_end_date, $page_id, $page_tag, $wh_id = 1, $day_num = 30 )
    {
        $trends_start_date = date("Y-m-d", strtotime($trends_end_date) - ($day_num - 1) * 3600 * 24);
        //$booth_tag = intval(intval($page_tag) % 100000);
        $booth_tag = intval($page_tag);

        $table_name = self::_getClickDataTableName(self::PERIOD_TYPE_DAILY);
        if (false === $table_name) {
            return false;
        }

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $order_by = "ORDER BY s_date ASC";
        $sql_stmt = <<<SQL_STMT
            SELECT * FROM
            (
                SELECT CONVERT(VARCHAR(10), s_date, 120) AS s_date,
                       SUM(click_num) as click_num,
                       SUM(order_num) as order_num
                FROM {$table_name}
                WHERE s_date >= '{$trends_start_date}' and s_date <= '{$trends_end_date}'
                    AND warehouse_id = {$wh_id} AND page_id = {$page_id} AND booth_tag = {$booth_tag}
                GROUP BY s_date
            ) as t {$order_by}
SQL_STMT;

        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        $stats = array();
        foreach ($rows as $row) {
            $stats[$row['s_date']] = $row;
        }

        $charts = array();
        $null_row = array(
                's_date' => '',
                'click_num' => 0,
                'order_num' => 0,
            );
        $start_stamp = strtotime($trends_start_date);
        $end_stamp = strtotime($trends_end_date);
        for ($day_iter = $start_stamp; $day_iter <= $end_stamp; $day_iter = strtotime("+1 day", $day_iter)) {
            $date_str = date("Y-m-d", $day_iter);
            $row = null;
            if (isset($stats[$date_str])) {
                $row = $stats[$date_str];
            }
            else {
                $row = $null_row;
                $row['s_date'] = $date_str;
            }

            $charts[] = $row;
        }

        foreach ($charts as &$row) {
            $click_trans_rate = ($row['click_num'] == 0) ? 0 : ($row['order_num'] * 100) / $row['click_num'];
            $row['click_trans_rate'] = number_format((float) $click_trans_rate, 2, '.', '');
        }

        $result = array();
        $result['timespan'] = "{$trends_start_date} 至 {$trends_end_date}";
        $result['page_id'] = $page_id;
        $result['page_tag'] = $page_tag;
        $result['data'] = &$charts;

        return $result;
    }


    /*
     * 获取某个页面的 -日期时间范围内- 来源分布数据
     * 每个数据为所选时间范围的汇总数据
     * 用于页面热力图展示
     *
     * @param $start_date, $end_date string 日期（2012-02-12），无需时分秒数据
     * @param $column_name string 要获取的指标
     * @param $page_id int 页面ID
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getPageSourceDataDays( $start_date, $end_date, $column_name, $page_id, $wh_id = 1 )
    {
        return self::_getPageSourceData($start_date, $end_date, $column_name, self::PERIOD_TYPE_DAILY, $page_id, $wh_id);
    }

    /*
     * 获取某个页面的 -当天- 来源分布数据
     * 每个数据为 -当天的分钟时间范围- 的汇总数据
     * 用于页面热力图展示
     *
     * @param $column_name string 要获取的指标
     * @param $page_id: int 页面id
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getPageSourceDataToday( $column_name, $page_id, $wh_id = 1 )
    {
        $today = date("Y-m-d");
        $today_start = $today . " 00:00:00";
        $today_end = $today . " 23:50:00";

        return self::_getPageSourceData($today_start, $today_end, $column_name, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id);
    }

    /*
     * 获取某个页面的 -最近几个10分钟内- 来源分布数据
     * 每个数据为所选时间范围的汇总数据
     * 用于页面热力图展示
     *
     * @param $column_name string 要获取的指标
     * @param $page_id: int 页面id
     * @param $wh_id int 分站id
     *
     * @return
     */
    public static function getPageSourceDataRecentMins( $n_mins, $column_name, $page_id, $wh_id = 1 )
    {
        $rencent_end_time = self::_getClickFlowLatestTime(self::PERIOD_TYPE_10MINUTELY);
        if (false === $rencent_end_time) {
            return false;
        }

        $recent_start_time = date("Y-m-d H:i:s", strtotime($rencent_end_time) - 60 * ($n_mins - 10));

        return self::_getPageSourceData($recent_start_time, $rencent_end_time, $column_name, self::PERIOD_TYPE_10MINUTELY, $page_id, $wh_id);
    }

    private static function _getPageSourceTableName( $period_type )
    {
        $table_name = "";
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $table_name = "t_aggregation_10minutely_page_source";
        } else if ($period_type == self::PERIOD_TYPE_HOURLY) {
            $table_name = "t_aggregation_hourly_page_source";
        }
        else if ($period_type == self::PERIOD_TYPE_DAILY) {
            $table_name = "t_aggregation_daily_page_source";
        }
        else {
            self::$errCode = -1000;
            self::$errMsg = "[Get page source table name]: Wrong period type!";

            return false;
        }

        return $table_name;
    }

    private static function _getPageSourceData( $start_time, $end_time,
                                                 $column_name,
                                                 $period_type,
                                                 $page_id, $wh_id = 1 )
    {
        if ($column_name != '') {
            $columns_config = array(
                    'pv',
                    'uv',
                    'order_num',
                );
            if (!in_array($column_name, $columns_config)) {
                self::$errCode = -1001;
                self::$errMsg = "[Get page source data]: Invalid column name!";

                return false;
            }

            $select_list = "SUM({$column_name}) as {$column_name}";
        }
        else {
            $select_list = "SUM(pv) as pv," .
                            "SUM(uv) as uv," .
                            "SUM(order_num) as order_num";
        }

        $table_name = self::_getPageSourceTableName($period_type);
        if (false === $table_name) {
            return false;
        }

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        // 外部来源ID的格式如下:
        // +———————————————————————————————————————————————————————————————————+
        // |      XX        |      XX        |     XXXXX      |       X        |
        // +----------------+----------------+----------------+----------------+
        // | 一级来源ID两位 | 二级来源ID两位 | 三级来源ID五位 | 来源类型ID一位 |
        // +———————————————————————————————————————————————————————————————————+
        // 来源类型ID:
        // -2 : 其它，比如从京东跳转过来的
        // -1 : 内部调整
        //  0 : 直接数据
        //  3 : 外部推广渠道
        //  4 : 外部自然渠道(搜索引擎)
        //
        // 来源ID:
        // -2 : 其它，比如从京东跳转过来的
        // -1 : 内部调整
        //  0 : 直接数据
        // -3 : 自然来源
        $sql_stmt = <<<SQL_STMT
            SELECT * FROM
            (
                SELECT (CASE WHEN source_id <= 0 THEN source_id
                             WHEN (source_id % 10) = 4 THEN -3
                             ELSE source_id / 1000000
                        END) AS source_tag_id,
                       (CASE WHEN source_id <= 0 THEN source_id
                             ELSE source_id % 10
                        END) AS source_type,
                       {$select_list}
                FROM {$table_name}
                WHERE s_date >= '{$start_time}' and s_date <= '{$end_time}'
                    AND warehouse_id = {$wh_id} AND page_id = {$page_id}
                GROUP BY (CASE WHEN source_id <= 0 THEN source_id
                               WHEN (source_id % 10) = 4 THEN -3
                               ELSE source_id / 1000000
                          END),
                         (CASE WHEN source_id <= 0 THEN source_id
                               ELSE source_id % 10
                          END)
            ) as t
SQL_STMT;


        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        $source_names = self::_getAllExtSourceNames();
        foreach ($rows as &$row) {
            $row['source_name'] = isset($source_names[$row['source_tag_id']]) ?
                                    $source_names[$row['source_tag_id']] : "";
        }

        $result = array();
        if ($period_type == self::PERIOD_TYPE_10MINUTELY) {
            $show_end_time = date('Y-m-d H:i:s', strtotime($end_time) + 600);
        }
        else {
            $show_end_time = $end_time;
        }
        $result['timespan'] = "{$start_time} 至 {$show_end_time}";
        $result['period_type'] = $period_type;
        $result['page_id'] = $page_id;
        $result['data'] = &$rows;

        return $result;
    }

    private static function _getAllExtSourceNames()
    {
        $mysql = ToolUtil::getDBObj('icson');
    	if (false === $mysql) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $table_name = "t_tag_source";
        $sql_stmt = <<<SQL_STMT
            SELECT tag_id AS source_id,
                   s_name AS source_name,
                   tag_fid AS source_fid
            FROM {$table_name}
            WHERE s_level = 2
SQL_STMT;

        $rows = $mysql->getRows($sql_stmt);
        if (false === $rows) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        /****添加一级渠道名称 @update by mandyzhou start****/
        $sql_stmt_fid = <<<SQL_STMT
            SELECT tag_id AS source_fid,
                   s_name AS source_fname
            FROM {$table_name}
            WHERE s_level = 1
SQL_STMT;
        $items = $mysql->getRows($sql_stmt_fid);
        if (false === $items) {
            self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
        }
        $source_fnames = array();
        foreach ($items as $item){
            $source_fnames[$item['source_fid']] = $item['source_fname'];
        }
        /****添加一级渠道名称 @update by mandyzhou end****/

        $source_names = array();
        $source_names['-2'] = "其它";
        $source_names['-1'] = "站内跳转";
        $source_names['0'] = "直接输入";
        $source_names['-3'] = "自然";
        foreach ($rows as $row) {
            $source_names[$row['source_id']] = $source_fnames[$row['source_fid']].'-'.$row['source_name'];
        }

        return $source_names;
    }

    public function getChannelOrderTraceData( $start_date, $end_date, $column_name, $channel_id, $wh_id = 1 )
    {
        $columns_config = array(
                    'pv',
                    'uv',
                    'order_num',
                    'order_product_num',
                    'order_fee',
                    'out_num',
                    'out_product_num',
                    'out_fee',
                );
        if ($column_name != '') {
            if (!in_array($column_name, $columns_config)) {
                self::$errCode = -1001;
                self::$errMsg = "[getChannelOrderTraceData]: Invalid column name:[{$column_name}]!";

                return false;
            }

            $select_list = "{$column_name}";
            $null_row = array(
                    's_date' => '1970-01-01',
                    $column_name => 0,
                );
        }
        else {
            $select_list = join(",", $columns_config);
            $null_row = array(
                    's_date' => '1970-01-01',
                    'pv' => 0,
                    'uv' => 0,
                    'order_num => 0',
                    'order_product_num' => 0,
                    'order_fee' => 0.00,
                    'out_num' => 0,
                    'out_product_num' => 0,
                    'out_fee' => 0.00,
                );
        }

        $table_name = "t_aggregation_daily_channel_order_trace";

        $clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
    	if (false === $clickFlowDB) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;

    		return false;
    	}

        $order_by = "ORDER BY s_date ASC";
        $sql_stmt = <<<SQL_STMT
            SELECT CONVERT(VARCHAR(10), s_date, 120) AS s_date,
                   {$select_list}
            FROM {$table_name}
            WHERE s_date >= '{$start_date}' and s_date <= '{$end_date}'
                AND warehouse_id = {$wh_id} AND channel_id = {$channel_id}
            {$order_by}
SQL_STMT;

        $rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;

            return false;
        }

        $start_time = $start_date;
        $end_time = $end_date;
        $data_charts = self::_getSequentialCharts($start_time, $end_time, self::PERIOD_TYPE_DAILY, $rows, $null_row);

        foreach ($data_charts as &$one_line) {
            if ($column_name == '') {
                $one_line['order_fee'] = number_format((float) $one_line['order_fee'], 2, '.', '');
                $one_line['out_fee'] = number_format((float) $one_line['out_fee'], 2, '.', '');
            }
            else if ($column_name == 'order_fee' || $column_name == 'out_fee') {
                $one_line[$column_name] = number_format((float) $one_line[$column_name], 2, '.', '');
            }
        }

        $result = array();
        $result['timespan'] = "{$start_date} 至 {$end_date}";
        $result['channel_id'] = $channel_id;
        $result['data'] = &$data_charts;

        return $result;
    }
	
	/*
     * 判断用户权限
     *
     * @param $uid int 用户sysno
     *
     * @return 拥有权限返回true，否则返回false
     */	
	public static function checkUserPrivilege($sysno)
	{
		$clickFlowDB = ToolUtil::getMSDBObj('ICSON_STATISTICS_CLICKFLOW');
		if (false === $clickFlowDB) 
		{
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;
    		return false;
    	}
		
		$sql_stmt = 'select COUNT(*) AS num from [t_config_clickflow_user] where sys_no = ' . $sysno;
		$rows = $clickFlowDB->getRows($sql_stmt);
        if (false === $rows) {
            self::$errCode = $clickFlowDB->errCode;
            self::$errMsg = $clickFlowDB->errMsg;
            return false;
        }

		if (!isset($rows[0]['num']) || (0 === $rows[0]['num']))
		{	
			return false;
		}
		return true;
	}
}

//var_dump(IClickFlow::getPageKeyDataSingleDay('2012-04-11', 1000, 1));
//var_dump(IClickFlow::getPageKeyDataRecentNMins(6549827, 60, 1));
//var_dump(IClickFlow::getPageKeyDataRecentNMins(1000, 60, 1));
//var_dump(IClickFlow::getPageKeyDataMultiDays(6549827, '2012-03-13', '2012-04-01', 1));

//var_dump(IClickFlow::_getPageClickData('2012-03-14 16:40:00', '2012-03-14 17:40:00', 1, 1234, 1));
//var_dump(IClickFlow::_getPageClickData('2012-03-14 16:00:00', '2012-03-14 17:00:00', 2, 1234, 1));
//var_dump(IClickFlow::_getPageClickData('2012-03-14', '2012-03-15', 3, 1234, 1));

//var_dump(IClickFlow::getPageClickDataDays('2012-03-14', '2012-03-15', 1234, 1));
//var_dump(IClickFlow::getPageClickDataToday(1234, 1));
//var_dump(IClickFlow::getPageClickDataRecentMins(10, 1000, 1));

//var_dump(IClickFlow::_getTopBoothClickData('2012-04-17 15:10:00', '2012-04-17 15:10:00', 1, 1000, 1));
//var_dump(IClickFlow::_getTopBoothClickData('2012-03-14 16:00:00', '2012-03-14 17:00:00', 2, 1234, 1));
//var_dump(IClickFlow::_getTopBoothClickData('2012-03-14', '2012-03-15', 3, 1234, 1));

//var_dump(IClickFlow::getTopBoothClickDataRecentMins(10, 1000));

//var_dump(IClickFlow::_getTopProductClickData('2012-04-09 09:40:00', '2012-04-10 17:40:00', 1, 1000, 1));
//var_dump(IClickFlow::_getTopProductClickData('2012-03-14 16:00:00', '2012-03-14 17:00:00', 2, 1000, 1));
//var_dump(IClickFlow::_getTopProductClickData('2012-04-01', '2012-04-09', 3, 1000, 1));

//var_dump(IClickFlow::getTopProductClickDataDays('2012-03-14', '2012-03-19', 568, 1));

//var_dump(IClickFlow::_getBoothClickData('2012-03-14 16:40:00', '2012-03-14 17:40:00', 1, 1234, array(56789,), 1));
//var_dump(IClickFlow::_getBoothClickData('2012-03-14 16:00:00', '2012-03-14 17:00:00', 2, 1234, array(56789,), 1));
//var_dump(IClickFlow::_getBoothClickData('2012-03-14', '2012-03-15', 3, 1234, array(56789,), 1));
//var_dump(IClickFlow::getBoothClickDataDays('2012-03-14', '2012-03-15', 123444, array(56789,), 1));

//var_dump(IClickFlow::getBoothClickDataTrendsDays(1234, 56789, 1, 30));

//var_dump(IClickFlow::getPageSourceDataDays('2012-03-20', '2012-03-22', 'pv', 1000, 1));
//var_dump(IClickFlow::getPageSourceDataToday('pv', 1000, 1));
//var_dump(IClickFlow::getPageSourceDataRecentMins(60, 'pv', 1000, 1));

//var_dump(IClickFlow::getPageSourceDataDays('2012-03-20', '2012-03-29', '', 1000, 1));
//var_dump(IClickFlow::getPageSourceDataToday('', 1000, 1));
//var_dump(IClickFlow::getPageSourceDataRecentMins(60, '', 1000, 1));

//var_dump(IClickFlow::getChannelOrderTraceData('2012-03-20', '2012-03-26', '', 1000, 1));
//var_dump(IClickFlow::getChannelOrderTraceData('2012-03-20', '2012-03-26', 'pv', 1000, 1));
//var_dump(IClickFlow::getChannelOrderTraceData('2012-03-20', '2012-03-26', 'order_fee', 1000, 1));