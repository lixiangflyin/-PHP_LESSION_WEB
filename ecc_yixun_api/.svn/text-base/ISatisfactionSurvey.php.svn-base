<?php
/**
 *
 * 满意度调查
 * @author allenzhou
 *
 */
class ISatisfactionSurvey
{
	public static $errMsg = "";
	public static $errCode = 0;


	/**
	 * 新增满意度调查
	 * @param $uid int 用户编号
	 * @param $post_data array 用户提交数据
		$_Satisfaction = array(
			'1'  => '满意',
			'2'  => '一般',
			'3'  => '不满意',
		);
	 */
	public static function addSatisfactionSurvey($uid, $post_data){
		$new_id = IIdGenerator::getNewId('satisfaction_survey_Sequence');
		if(false == $new_id || $new_id <= 0){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}

		$orders = IOrdersTTC::get($uid, array('order_char_id'=> $post_data['OrderId']), array('hw_id','stockNo'));
		if (false === $orders) {
				self::$errCode = IOrdersTTC::$errCode;
				self::$errMsg = IOrdersTTC::$errMsg;
				return false;
		}
		if (count($orders) == 0) {
			self::$errCode = -999;
			self::$errMsg = "订单不存在";
			return false;
		}
		$order = &$orders[0];

		global $_StockToStation;//出货仓所在站点
		$stockNo = empty($order['stockNo']) ? $order['hw_id'] : $order['stockNo'];
		@$stock_wh_id = $_StockToStation[$stockNo];

		$insert_data = array(
			'RequestSysNo' => $post_data['RequestSysNo'],
			'SysNo' =>  $new_id,
			'ModelSysNo' => $post_data['ModelSysNo'],
			'Uid' => $uid,
			'OrderId' => $post_data['OrderId'],
			'OrderSource' => @$stock_wh_id,
			'Question' => $post_data['Question'],
			'Answer' => $post_data['Answer'],
			'MakeBetter' => $post_data['MakeBetter'],
			'Suggestions' => $post_data['Suggestions'],
			'Remark' => $post_data['Remark'],
			'Status' => $post_data['Status'],
			'Whid' => $post_data['Whid'],
			'rowCreateDate' => date('Y-m-d H:i:s', time()),
			'rowModifyDate' => date('Y-m-d H:i:s', time()),
		);

		$ret = ISatisfactionSurveyTTC::insert($insert_data);
		if(false === $ret){
			self::$errCode = ISatisfactionSurveyTTC::$errCode;
			self::$errMsg = ISatisfactionSurveyTTC::$errMsg;
			return false;
		}

		return true;
	}

	/**
	 *
	 * 是否显示满意度调查链接
	 * @param int $request_sysno 申请单系统编号
	 * @param int $request_sysno 处理单系统编号
	 * @param string $request_date 申请时间
	 */
	public static function displaySurvey($request_sysno, $register_sysno, $request_date){
		//2012-11-21 19:00:00 (1353495600)
		$link = false;
		$has_survey = ISatisfactionSurveyTTC::get($request_sysno, array(), array('SysNo', 'RequestSysNo'));
		if(false === $has_survey){
			self::$errCode = ISatisfactionSurveyTTC::$errCode;
			self::$errMsg = ISatisfactionSurveyTTC::$errMsg;
			Logger::err('ISatisfactionSurveyTTC get failed. ' . ' errMsg: ' .ISatisfactionSurveyTTC::$errMsg .' errCode: ' .ISatisfactionSurveyTTC::$errCode . ' request_sysno:'.$request_sysno .' request_date: ' .$request_date . ' register_sysno:' . $register_sysno);
			return false;
		}else if(count($has_survey) >= 1){//如果提交过此记录
			return false;
		}else{
			if( $request_date <= 1353495600 ){//拉老的流水
				if(empty($register_sysno)){
					Logger::err("register_sysno is empty" . " request_sysno: " .$request_sysno ." request_date: " .$request_date);
				}else{
					$data = IRMARegisterLogTTC::get($register_sysno, array(), array('Status'));
					if(false === $data){
						self::$errCode = IRMARegisterLogTTC::$errCode;
						self::$errMsg = IRMARegisterLogTTC::$errMsg;
						Logger::err('IRMARegisterLogTTC get failed' . ' errMsg: ' .IRMARegisterLogTTC::$errMsg .' errCode: ' .IRMARegisterLogTTC::$errCode . ' request_sysno:'.$request_sysno .' request_date: ' .$request_date . ' register_sysno:' . $register_sysno);
					}
					if(empty($data)){
						self::$errCode = 1001;
						self::$errMsg = 'get IRMARegisterLogTTC empty. request_sysno: ' .$request_sysno .' request_date: ' .$request_date . ' register_sysno:' . $register_sysno;
						Logger::err('get IRMARegisterLogTTC empty. ' . ' errMsg: ' .IRMARegisterLogTTC::$errMsg .' errCode: ' .IRMARegisterLogTTC::$errCode . ' request_sysno:'.$request_sysno .' request_date: ' .$request_date . ' register_sysno:' . $register_sysno);
					}

					$log_status = array('5', '13', '14');//参考$_myrepairLogState
					if(is_array($data) && count($data) > 0){
						foreach($data as $v){
							if ($link = in_array($v['Status'], $log_status) ) {
								break;
							}
						}
					}
				}
			}else{//拉新的流水
				$data = IRMACusLogTTC::get($request_sysno);
				if(false === $data){
					self::$errCode = IRMACusLogTTC::$errCode;
					self::$errMsg = IRMACusLogTTC::$errMsg;
					Logger::err("IRMACusLogTTC get failed" . " errMsg: " .IRMACusLogTTC::$errMsg ." errCode: " .IRMACusLogTTC::$errCode . ' request_sysno:'.$request_sysno .' request_date: ' .$request_date . ' register_sysno:' . $register_sysno);
				}
				if(empty($data)){
					self::$errCode = 1002;
					self::$errMsg = 'get IRMACusLogTTC empty. request_sysno: ' .$request_sysno .' request_date: ' .$request_date . ' register_sysno:' . $register_sysno;
					Logger::err('get IRMACusLogTTC empty. ' . ' errMsg: ' .IRMARegisterLogTTC::$errMsg .' errCode: ' .IRMARegisterLogTTC::$errCode . ' request_sysno:'.$request_sysno .' request_date: ' .$request_date . ' register_sysno:' . $register_sysno);
				}

				$log_status = array('230', '260', '270');
				if(is_array($data) && count($data) > 0){
					foreach($data as $v){
						if ($link = in_array($v['LogType'], $log_status) ) {
							break;
						}
					}
				}
			}
		}

		return $link;
	}
}
?>
