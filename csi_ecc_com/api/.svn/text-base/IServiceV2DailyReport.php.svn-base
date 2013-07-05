<?php
require_once(ROOT_DIR . 'lib/TencentMessage.php');

class IServiceV2DailyReport
{
	private static $APPLY_STATE = array(
		0 => '待处理',
		1 => '待处理',
		2 => '处理中',
		3 => '已处理'
	);
	private static $APPLY_TYPE = array(
		1 => "订单催办",
		2 => "订单修改",
		3 => "订单取消",
		4 => "投诉建议",
		5 => "问题咨询",
		6 => "建议反馈",
		7 => "表扬",
        8 => "预约服务",
        9 => "评论导入"
	);
	private static $ARCHIVE_TYPE = array(
		1 => array(
			'type' => '商品咨询',
			'sub'  => array(
				1001 => '商品信息',
				1002 => '预售首发商品',
				1003 => '商品信息错误',
				1004 => '价格举报'
			)
		),
		2 => array(
			'type' => '购物流问题',
			'sub'  => array(
				2001 => '预约安装及商品保养',
				2002 => '团购问题',
				2003 => '虚拟充值',
				2004 => '支付下单流程咨询',
				2005 => '邮费问题',
				2006 => '优惠卷问题',
				2007 => '积分使用问题',
				2008 => '节能补贴问题',
				2009 => '支付咨询',
				2010 => '活动咨询'
			)
		),
		3 => array(
			'type' => '订单问题',
			'sub'  => array(
				3001 => '订单信息查询',
				3002 => '订单修改',
				3003 => '贵就赔',
				3004 => '价格保护',
				3005 => '汇款到账查询',
				3006 => '订单缺货问题',
				3007 => '发票问题',
                3008 => '商品包装问题',
                3009 => '一单多包裹分开到站',
                3010 => '多件/少件/空箱',
                3011 => '配送进度查询',
                3012 => '客户催件',
                3013 => '改日送'
			)
		),
		4 => array(
			'type' => '售后',
			'sub'  => array(
				4001 => '商品使用问题',
				4002 => '怀疑假货/二手',
				4003 => '上门取件问题',
				4004 => '上门换新问题',
				4005 => '电话申请售后',
				4006 => '售后进度查询',
				4007 => '售后超期催办',
				4008 => '不认可售后结果',
				4009 => '换货、返修商品问题未解决'
			)
		),
		5 => array(
			'type' => '用户评论',
			'sub'  => array(
				5001 => '评论规则',
				5002 => '商品无法评论',
				5003 => '评论无法显示',
				5004 => '评论无故被删',
				5005 => '评论未增加积分'
			)
		),
		6 => array(
			'type' => '帐号及VIP特权',
			'sub'  => array(
				6001 => 'VIP服务特权',
				6002 => '会员特权问题',
				6003 => '帐号问题',
				6004 => '图标显示'
			)
		),
		7 => array(
			'type' => '用户投诉及其他',
			'sub'  => array(
				7001 => '投诉平台规则',
				7002 => '投诉客服态度',
				7003 => '投诉配送服务态度',
				7004 => '投诉配送速度',
				7005 => '用户建议',
				7006 => '用户表扬',
                7007 => '诈骗电话',
                7008 => '疑似信息泄漏',
                7009 => '无效咨询',
                7010 => '系统问题',
                7011 => '订单无故被取消',
                7012 => '活动投诉',
                7013 => '其他'
			)
		),
		8 => array(
			'type' => '差评导入',
			'sub'  => array(
				8001 => '商品质量',
				8002 => '配件质量',
				8003 => '物流配送',
				8004 => '性价比问题',
				8005 => '商品降价',
                8006 => '商品描述错误',
                8007 => '疑似二手',
                8008 => '疑似假货',
                8009 => '发票问题',
                8010 => '综合因素',
                8011 => '疑似广告',
                8012 => '未指明原因'
			)
		)
	);

	public static function sendDailyReport(){
		$receivers = array(
            /*
			'jeremywu@tencent.com',
			'hermeswang@tencent.com',
			'paulxiong@tencent.com',
			'loadingliu@tencent.com',
			'ianmeng@tencent.com',
			'mansonzhang@tencent.com',
			'cs-supervisor@51buy.com',
			'simonmzhang@51buy.com',
			'kylinliu@51buy.com',
			'jameszhou@51buy.com',
           	'ninaluo@tencent.com',
           	'lilyyili@tencent.com',
           	'nydialuo@tencent.com',
            */
			'kevazhang@tencent.com'
		);

		$tmsg = new TencentMessage();
		$body = self::generateDailyReportBody();
		
		foreach($receivers as $r){
			$tmsg->send(array(
				'msg'       => $body,
				'sender'    => 'kevazhang@tencent.com',
				'title'     => '易迅服务中心日报',
				'recvuser'  => $r 
			), 3);
		}

		die();
	}

	private static function generateDailyReportBody(){
		error_reporting(E_ERROR);
		$time = time();
		$day1 = date('Y-m-d', $time - 3600 * 24 * 2);
		$day2 = date('Y-m-d', $time - 3600 * 24);
		$stime1 = strtotime($day1);
		$etime1 = $stime1 + 3600 * 24;
		$stime2 = strtotime($day2);
		$etime2 = $stime2 + 3600 * 24;

		$db = Config::getDB('b2b2c_kf_stat');

		if($db === false){
			return false;
		}

		/*工单基本数据统计*/
		//总量
		$totalCount = $db->getRowsCount("base_stat", "createTime>=" . $stime1 . " and createTime<" . $etime2);
		$data1 = array();
		foreach(self::$APPLY_TYPE as $key => $type){
			$totalCondition1 = "createTime>=" . $stime1 . " and createTime<" . $etime1 . " and type=" . $key;
			$totalCondition2 = "createTime>=" . $stime2 . " and createTime<" . $etime2 . " and type=" . $key;
			$total1 = $db->getRowsCount("base_stat", $totalCondition1);
			$total2 = $db->getRowsCount("base_stat", $totalCondition2);
			
			$condition1 = "modifyTime>=" . $stime1 . " and modifyTime<" . $etime1 . " and type=" . $key;
			$condition2 = "modifyTime>=" . $stime2 . " and modifyTime<" . $etime2 . " and type=" . $key;
			$ret1 = $db->getRows2("base_stat", array(), $condition1, 0, 99999999);
			$ret2 = $db->getRows2("base_stat", array(), $condition2, 0, 99999999);

			//半小时超时量
			$passed1Count1 = 0;
			$passed1Count2 = 0;

			if($ret1){
				foreach($ret1 as $row){
					//1.受理时间>半小时
					$time_firstreply = $row['acceptTime'] ? (int)$row['acceptTime'] : time();
					if(self::isHalfHourTimePassed((int)$row['createTime'], $time_firstreply)){
						$passed1Count1 ++;
					}
				}
			}
			if($ret2){
				foreach($ret2 as $row){
					//1.受理时间>半小时
					$time_firstreply = $row['acceptTime'] ? (int)$row['acceptTime'] : time();
					if(self::isHalfHourTimePassed((int)$row['createTime'], $time_firstreply)){
						$passed1Count1 ++;
					}
				}
			}

			//12小时超时量
			$passed2Count1 = 0;
			$passed2Count2 = 0;

			if($ret1){
				foreach($ret1 as $row){
					//2.工单最终处理时间>12小时(除去非工作时间)
					$time_modify_state = $row['finishTime'] ? $row['finishTime'] : time();
					if(self::isFinalDealTimePassed($row['createTime'], $time_modify_state)){
						$passed2Count1 ++;
					}
				}
			}
			if($ret2){
				foreach($ret2 as $row){
					//2.工单最终处理时间>12小时(除去非工作时间)
					$time_modify_state = $row['finishTime'] ? $row['finishTime'] : time();
					if(self::isFinalDealTimePassed($row['createTime'], $time_modify_state)){
						$passed2Count2 ++;
					}
				}
			}
	
			$data1[$type] = array(
				$day1 => array(
					'total'        => $total1,
					'proportion'   => number_format($total1 * 100 / $totalCount),
					'passCount1'   => $passed1Count1,
					'passPortion1' => number_format($passed1Count1 * 100 / $total1),
					'passCount2'   => $passed2Count1,
					'passPortion2' => number_format($passed2Count1 * 100 / $total1)
				),
				$day2 => array(
					'total'      => $total2,
					'proportion' => number_format($total2 * 100 / $totalCount),
					'passCount1' => $passed1Count2,
					'passPortion1' => number_format($passed1Count2 * 100 / $total2),
					'passCount2' => $passed2Count2,
					'passPortion2' => number_format($passed2Count2 * 100 / $total2)
				)
			);
		}

		/*归档分类统计*/
		//总量
		$totalCount = $db->getRowsCount("base_stat", "finishTime>=" . $stime1 . " and finishTime<" . $etime2 . " and archive!=''");
		$data3 = array(
			$day1   => array(),
			$day2   => array(),
			'total' => $totalCount
		);
		
		foreach(self::$ARCHIVE_TYPE as $kkk => $types){
			$data3[$day1][$kkk] = array();
			$data3[$day2][$kkk] = array();
			$data3[$day1][$kkk]['data'] = array();
			$data3[$day2][$kkk]['data'] = array();
			
			$types = $types['sub'];

			$day1TypeTotal = 0;
			$day2TypeTotal = 0;
			foreach($types as $type_key => $type){
				$condition1 = "modifyTime >= " . $stime1 . " and modifyTime < " . $etime1 . " and archive like '%:" . $type_key . "'";
				$condition2 = "modifyTime >= " . $stime2 . " and modifyTime < " . $etime2 . " and archive like '%:" . $type_key . "'";

				$total1 = $db->getRowsCount("base_stat", $condition1);
				$total2 = $db->getRowsCount("base_stat", $condition2);

				$data3[$day1][$kkk]['data'][$type_key] = $total1;
				$data3[$day2][$kkk]['data'][$type_key] = $total2;

				$day1TypeTotal += $total1;
				$day2TypeTotal += $total2;
			}

			$arr1 = $data3[$day1][$kkk]['data'];
			$arr1 = self::_arraySort($arr1);
			$data3[$day1][$kkk]['data'] = $arr1;
			$arr2 = $data3[$day2][$kkk]['data'];
			$arr2 = self::_arraySort($arr2);
			$data3[$day2][$kkk]['data'] = $arr2;

			$data3[$day1][$kkk]['total'] = $day1TypeTotal;
			$data3[$day2][$kkk]['total'] = $day2TypeTotal;
		}

		/*员工工作统计*/
		$data2 = array();

		$kf_users = require_once('../etc/service/users.php');
		$rets = $db->getRows("select distinct followKF as kf from base_stat where followKF!=66108 and followKF!=66084");
		foreach($rets as $k => $v){
			$kf = $v['kf'];
			$user = $kf_users[$kf] ? $kf_users[$kf] : $kf;
			if($user){
				$data2[$user] = array();

				$condition1 = "modifyTime >= " . $stime1 . " and modifyTime < " . $etime1 . " and followKF='" . $kf . "'";
				$condition2 = "modifyTime >= " . $stime2 . " and modifyTime < " . $etime2 . " and followKF='" . $kf . "'";
				$total1 = $db->getRowsCount("base_stat", $condition1);
				$total2 = $db->getRowsCount("base_stat", $condition2);
				
				if($total1 > 0){
					$data2[$user][$day1] = array();
					
					foreach(self::$APPLY_TYPE as $key => $type){
						$ret = $db->getRowsCount("base_stat", $condition1 . " and type=" . $key);
						
						$data2[$user][$day1][$type] = $ret;
					}
				}

				if($total2 > 0){
					$data2[$user][$day2] = array();

					foreach(self::$APPLY_TYPE as $key => $type){
						$ret = $db->getRowsCount("base_stat", $condition2 . " and type=" . $key);
						
						$data2[$user][$day2][$type] = $ret;
					}
				}
			}
		}
		
		//Build Email Body
		$body = self::buildEmailBody($data1, $data2, $data3, $day1, $day2);
		return $body;
	}

	private function buildEmailBody($data1, $data2, $data3, $day1, $day2){
		$pdata1 = array();
		$pdata2 = array();
		$pdata3 = array();
		foreach($data1 as $type => $v){
			$pdata1[] = $v[$day1]['total'];
			$pdata2[] = $v[$day2]['total'];
		}
		foreach($data2  as $user => $v){
			foreach($v as $day => $vv){
				$total = 0;
				foreach($vv as $value){
					$total += $value;
				}
				if(!isset($pdata3[$day])){
					$pdata3[$day] = array();
				}else{
					$pdata3[$day][] = $total;
				}
			}
		}
		
		$html = '<table width="100%">
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td colspan=2>&nbsp;</td>
						</tr>
						<tr>
							<td width="100%" align="left" nowrap="nowrap" style="font-size: 18pt;font-weight: bold;color:#333;">易迅服务中心日报(' . date('m/d') . ')</td>
						</tr>
						<tr>
							<td colspan=2>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<table width="100%" bgcolor="#8DBF5A" cellpadding=1 cellspacing=2>
									<tr>
										<td></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan=2>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<strong>数据说明：</strong>
							</td>
						</tr>
						<tr>
							<td>
								<ul>
									<li>
										标红数值表示前后两天差值>=50
									</li>
									<li>
                          				标红占比值表示前后两天占比值>=3%
                          			</li>
                          			<li>
                          				IVR数据目前无法在后台提取到，IVR相关数据呼叫中心统计功能做好后会尽快迭代上，典型案例及IVR数据请kylin手动补充。
									</li>
								</ul>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>';
		
		/*Table*/
		$table1 = '<table width="100%" style="margin:10px 10px; border-left:1px solid #999999; border-top:1px solid #999999;" align="left" cellpadding="5" cellspacing="0">
						<tr>
							<td style="border-right:1px solid #999999;border-bottom:1px solid #999999; color:white; background:#0066cc; font-size:14pt; font-weight:bold; height:40px;" align="center" colspan=8>
								工单基本数据统计
							</td>
						</tr>';
		$table1 .= '<tr>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">数据指标</td>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">日期</td>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">总量</td>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">占比</td>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">半小时超时量</td>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">占比</td>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">12小时超时量</td>
						<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">占比</td>
					</tr>';
		
		foreach($data1 as $type => $v){
			$bool = false;
			
			$_count = 0;
			$preTotal = false;         //记录上一天总量
			$prePortion1 = false;      //记录上一天超时（半小时）占比
			$prePortion2 = false;      //记录上一天超时（12小时）占比
			foreach($v as $day => $row){
				$_count ++;
				
				if($_count % 2 == 0){
					$bgcolor = '#DEDEDE';
				}else{
					$bgcolor = '#ffffff';
				}
				
				if(!$bool){
					$table1 .= '<tr><td bgcolor=' . $bgcolor . ' rowspan=2 style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $type . '</td>';
					$bool = true;
				}else{
					$table1 .= "<tr>";
				}
				$table1 .= '<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $day . "</td>";
				
				$totalColor = '#000';
				if(false !== $preTotal){
					if(abs($row['total'] - $preTotal) >= 50){
						$totalColor = 'red';
					}
				}
				$preTotal = $row['total'];
				
				$table1 .= '<td bgcolor=' . $bgcolor . ' style="color:' . $totalColor . ';border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $row['total'] . "</td>";
				$table1 .= '<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $row['proportion'] . "%</td>";
				$table1 .= '<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $row['passCount1'] . "</td>";
				
				$portion1Color = '#000';
				if(false !== $prePortion1){
					if(abs($row['passPortion1'] - $prePortion1) >= 3){
						$portion1Color = 'red';	
					}
				}
				$prePortion1 = $row['passPortion1'];
				
				$table1 .= '<td bgcolor=' . $bgcolor . ' style="color:' . $portion1Color . ';border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $row['passPortion1'] . "%</td>";
				$table1 .= '<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $row['passCount2'] . "</td>";
				
				$portion2Color = '#000';
				if(false !== $prePortion2){
					if(abs($row['passPortion2'] - $prePortion2) >= 3){
						$portion2Color = 'red';	
					}
				}
				$prePortion2 = $row['passPortion2'];
				
				$table1 .= '<td bgcolor=' . $bgcolor . ' style="color: ' . $portion2Color . ' ;border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $row['passPortion2'] . "%</td>";
				$table1 .= '</tr>';
			}
		}
		$table1 .= "</table>";

		$html .= $table1 . '</td></tr><tr><td>';

		$table3 = '<table width="100%" style="margin:10px 10px; border-left:1px solid #999999; border-top:1px solid #999999;" align="left" cellpadding="5" cellspacing="0">
						<tr>
							<td colspan="6" style="border-right:1px solid #999999;border-bottom:1px solid #999999; color:white; background:#0066cc; font-size:14pt; font-weight:bold; height:40px;" align="center">问题归档分类统计</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">一级类目</td>
							<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">二级类目</td>
							<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">' . $day1 . '总量 ▼</td>
							<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">' . $day1 . '占比 ▼</td>
							<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">' . $day2 . '总量</td>
							<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">' . $day2 . '占比</td>
						</tr>	
					';

		$total = $data3['total'];
		foreach(self::$ARCHIVE_TYPE as $k => $v){
			$type = $v['type'];
			$subCount = count($v['sub']);

			$subTypeCount = 0;
			foreach($data3[$day1][$k]['data'] as $kk => $vv){
				if(substr($kk, 0, 1) == ($k + 1)){
					$subTypeCount ++;
					if($subTypeCount % 2 == 0){
						$bgcolor = '#DEDEDE';
					}else{
						$bgcolor = '#ffffff';
					}

					$d1 = $data3[$day1][$k]['data'][$kk] ? $data3[$day1][$k]['data'][$kk] : 0;
					$d2 = $data3[$day2][$k]['data'][$kk] ? $data3[$day2][$k]['data'][$kk] : 0;
					$p1 = $d1 ? number_format($d1 * 100 / $total) : 0;
					$p1 .= '%';
					$p2 = $d2 ? number_format($d2 * 100 / $total) : 0;
					$p2 .= '%';

					if($subTypeCount == 1){
						$table3 .= '<tr style="vertical-align:middle;">
										<td rowspan=' . $subCount . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . ($k + 1) . '.' . $type . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $v['sub'][$kk] . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $d1 . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $p1 . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $d2 . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $p2 . '</td>
									</tr>';
					}else{
						$table3 .= '<tr style="vertical-align:middle;">
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $v['sub'][$kk] . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $d1 . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $p1 . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $d2 . '</td>
										<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $p2 . '</td>
									</tr>';
						if($subTypeCount == $subCount){
							$t1 = $data3[$day1][$k]['total'] ? $data3[$day1][$k]['total'] : 0;
							$t2 = $data3[$day2][$k]['total'] ? $data3[$day2][$k]['total'] : 0;
							$pt1 = $t1 ? number_format($t1 * 100 / $total) : 0;
							$pt1 .= '%';
							$pt2 = $t2 ? number_format($t2 * 100 / $total) : 0;
							$pt2 .= '%';
							$table3 .= '<tr style="background:#999;">
											<td colspan="2" style="text-align:center;border-right:1px solid #999999;border-bottom:1px solid #999999;">总量</td>
											<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $t1 . '</td>
											<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $pt1 . '</td>
											<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $t2 . '</td>
											<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $pt2 . '</td>
										</tr>';
						}
					}	
				}
			}
		}			
		$table3 .= '</table>';

		$html .= $table3 . '</td></tr><tr><td>';

		$tdCol = 3 + count(self::$APPLY_TYPE);
		$table2 = '<table width="100%" style="margin:10px 10px; border-left:1px solid #999999; border-top:1px solid #999999;" align="left" cellpadding="5" cellspacing="0">
			<tr>
				<td colspan=' . $tdCol . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999; color:white; background:#0066cc; font-size:14pt; font-weight:bold; height:40px;" align="center">
					员工工作统计
				</td>
			</tr>';
		$table2 .= '<tr>
			<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">
				员工姓名
			</td>
			<td style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">
				时间
			</td>';
		foreach(self::$APPLY_TYPE as $type){
			$table2 .= '<td  style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">' . $type . "</td>";
		}
        //$table2 .= '<td  style="border-right:1px solid #999999;border-bottom:1px solid #999999;font-weight:bold;">总量</td>';
		$table2 .= "</tr>";
		foreach($data2 as $user => $v){
			$bool = false;
			
			$_count = 0;
			foreach($v as $day => $row){
				$_count ++;
				
				if($_count % 2 == 0){
					$bgcolor = '#DEDEDE';
				}else{
					$bgcolor = '#ffffff';		
				}
				
				if(!$bool){
					if(count($v) > 1){
						$table2 .= '<tr>
							<td bgcolor=' . $bgcolor . ' rowspan=2  style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $user . '</td>
							<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $day . '</td>';
					}else{
						$table2 .= '<tr>
							<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $user . '</td>
							<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $day . '</td>';
					}
					$bool = true;
				}else{
					$table2 .= '<tr><td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $day . '</td>';
				}

				if(count($row) > 0){
					foreach($row as $t => $num){
						$num = $num ? $num : 0;
						$table2 .= '<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">' . $num . "</td>";
					}
				}else{
					for($i = 0; $i < count(self::$APPLY_TYPE); $i ++){
						$table2 .= '<td bgcolor=' . $bgcolor . ' style="border-right:1px solid #999999;border-bottom:1px solid #999999;">0</td>';
					}
				}

				$table2 .= "</tr>";
			}
		}
		$talbe2 .= "</table>";
		
		$html .= $table2 . "</td></tr></table>";

		return $html;
	}
	
	private static function _arraySort($arr, $order='desc'){
        if($order == 'desc'){
            arsort($arr);
            return $arr;
        }else{
            asort($arr);
            return $arr;
        }
    }

	private static function isHalfHourTimePassed($stime, $etime, $work_shour = 9, $work_ehour = 0){
		$shour = date('G', $stime);
		if($shour < $work_shour && $shour >= $work_ehour){
			//非工作时间，将$stime归为9点
			$d = date("d", $stime);
			$m = date("m", $stime);
			$y = date("Y", $stime);
			$stime = mktime(9, 0, 0, $m, $d, $y);
		}else{
			$temp = strtotime("+30 minute", $stime);
			$d1 = date("d", $stime);
			$d2 = date("d", $temp);
			if($d2 != $d1){
				//23:30<$stime<=23:59,
				$stime = strtotime("+10 hour", $stime);
				$etime = strtotime("+1 hour", $etime);
			}
		}

		return ($etime - $stime) > (60 * 30);
	}

	private static function isFinalDealTimePassed($stime, $etime, $work_shour = 9, $work_ehour = 0){
		$shour = date('G', $stime);
		$diffHours = ($etime - $stime) / 3600;
		$count = 0;
		for($i = $shour; $i < $shour + $diffHours; $i ++){
			$h = $i % 24;
			if($h < $work_shour && $h >= $work_ehour) continue;

			$count ++;
		}

		return $count > 12;
	}
}
