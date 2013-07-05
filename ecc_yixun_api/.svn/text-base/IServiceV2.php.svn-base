<?php
/*
 * “◊—∏∑˛ŒÒ÷––ƒ(service.51buy.com)
 * @author kvazhang
 * @modified 2013/05/10 
 */

error_reporting(E_ALL ^ E_NOTICE);

require_once(PHPLIB_ROOT . 'api/IOrder.php');
require_once(PHPLIB_ROOT . 'api/inc/IServiceIdGenerator.php');
require_once(PHPLIB_ROOT . 'api/appplatform/dao_51buy_vipuser_php5_stub.php');
require_once(PHPLIB_ROOT . 'api/appplatform/dao_51buy_servicecenter_php5_stub.php');
require_once(PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php');

class IServiceV2{
	public static $errCode = 0;
	public static $errMsg = '';
	
	/*
	 * 1.Œ¥∂¡œ˚œ¢ ˝¡ø - ªÒ»°÷∏∂®µ«¬º”√ªßµƒŒ¥∂¡œ˚œ¢ ˝¡ø(¥”TMEM÷–ªÒ»°)
	 * @params
	 *     $uid
	 * @output
	 *     array('errno' => *, 'count' => *)    
	 */
	public static function newMsgCount($uid){
		if(!$uid){
			return array(
				'errno' => 1011,
				'msg'   => '»±…Ÿ≤Œ ˝'		
			);
		}
		
		$count = 0;
		$tm = Config::getTMem('service_center_unread_message');
		if(!$tm){
			return array(
				'errno' => 1012,
				'msg'   => 'TMEM≈‰÷√¥ÌŒÛ'		
			);
		}

		//π§µ•¿‡–Õ¥”1-8
		for($i = 1; $i <= 8; $i ++){
			$tmem_key = $uid . "_unread_message_" . $i;
			$_item_count = $tm->get(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $tmem_key);
			if($_item_count){
				$count += intval($_item_count);
			}
		}
		
		return array(
			'errno' => 0,
			'msg'   => 'ªÒ»°≥…π¶',
			'count' => $count		
		);
	}
	
	/*
	 * 2.VIP–≈œ¢≤È—Ø - ∏˘æ›÷∏∂®”√ªßµƒVIP–≈œ¢
	 * @params
	 *     $uid
	 * @output
	 *     array('errno' => *, 'data' => array())
	 */
	public static function getVipUserInfo($uin){
		$req = new icson\vipuser\dao\getUserInfoReq();
		$req->flag = 1;
		$req->id   = floatval($uin);
		
		$resp = new icson\vipuser\dao\getUserInfoResp();
		
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
		
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			//self::setERR(9033, 'invoke failed', 0, $stub->last_err_msg);
			return false;
		}
		
		if($resp->result != 0){
			//self::setERR(8702, 'result error', $resp->result, '');
			//$msg = $resp->errMsg;
			return false;
		}
		
		if(!$resp->userInfo){
			//self::setERR(9035, 'userInfo not found');
			return false;
		}
		
		$baseInfo = $resp->userInfo['baseInfo'];
		$kfInfo   = $resp->userInfo['kfInfo'];
		$isVip    = $resp->userInfo['isVip'];
		
		$data = array(
			'uid'      => $uin,
			'uname'    => $baseInfo['uname'],
			'mobile'   => $baseInfo['mobile'],
			'email'    => $baseInof['email'],
			'class'    => $baseInfo['level'],
			'qq'       => $baseInfo['qq'],
			'birthday' => $baseInfo['birthday'],
			'address'  => $baseInfo['address'],
			'is_vip'   => intval($isVip),
			'kf_name'  => iconv('UTF-8', 'GBK', $kfInfo['name']),
			'kf_phone' => $kfInfo['mobile'],
			'kf_qq'    => $kfInfo['qq']
		);
		
		return array(
			'errno' => 0,
			'msg'   => "",
			'data'  => $data
		);
	}
	
	/*
	 * 3.ªÒ»°÷∏∂®”√ªß◊ÓΩ¸“ª∏ˆ∂©µ•–≈œ¢
	 * @params
	 *     $uid
	 * @output
	 *     array('errno' => *,)
	 */
	public static function getUserLastOrderInfo($uid){
		if(!$uid){
			return array(
				'errno' => 1031,
				'msg'   => '»±…Ÿ≤Œ ˝'
			);
		}
		
		$ret = IOrder::getRecentOrder($uid, 1);
		$total = $ret['total'];
		if($total == 0 || !$total){
			return array(
				'errno' => 1032,
				'msg'	=> '√ª”–∂©µ•'	
			);
		}
		
		$order = $ret['orders'][0];
		if(!$order){
			return array(
				'errno' => 1033,
				'msg'   => '√ª”–∂©µ•'
			);
		}

		$orderId = $order['order_char_id'];
		$orderDetailInfo = IOrder::getOneOrderDetail($uid, $orderId);
		if(false === $orderDetailInfo || !$orderDetailInfo){	
			return array(
				'errno' => 1034,
				'msg'   => '√ª”–∂©µ•'
			);
		}

		/*
		//¡˜ÀÆº«¬º
		$order_id  = $order['order_char_id'];
		var_dump($order_id);
		$orderFlow = IOrder::geOrderFlow($uid, $order_id);
		var_dump($orderFlow);
		*/

		return array(
			'errno' => 0,
			//'order' => $order,
			'order' => $orderDetailInfo
		);
	}
	
	/*
	 * 4.Õ≥º∆∑˛ŒÒµ• ˝¡ø
	 * @params
	 * 
	 * @output
	 * array('errno' => *, 'msg' => *, 'count' => *)
	 */
	public static function getApplyCount(){
		//¥”TMEM÷–ªÒ»°
		$tm = Config::getTMem('service_statistic');
		if(!$tm){
			return array(
				'errno' => 1041,
				'msg'   => 'TMEM≈‰÷√¥ÌŒÛ'
			);
		}
		
		$count = $tm->get(TMEM_BID_SERVICE_STATISTIC, 'service_count');
		if(!$count){
			return array(
				'errno' => 1042,
				'msg'   => ' ˝æ›≤ª¥Ê‘⁄',
				'count' => 0		
			);
		}
		
		return array(
			'errno' => 0,
			'count' => intval($count)		
		);
	}
	
	/*
	 * 5.ªÒ»°∑˛ŒÒµ•¡–±Ì
	 * @params
	 *     $uid
	 *     $type
	 *     $page
	 *     $pageSize
	 * @output
	 *     array('errno' => *, 'msg' => *, 'list' => array())
	 */
	public static function getApplyList($uin, $page = 1, $pageSize = 10, $type = 0){
		$req = new icson\servicecenter\dao\getApplyInfoListReq();
		$req->account  = floatval($uin);
		$req->page     = $page;
		$req->pageSize = $pageSize;
		if($type) $req->type = $type;
		
		$resp = new icson\servicecenter\dao\getApplyInfoListResp();
		
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
		
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			return array(
				'errno' => 1051,
				'msg'   => 'getApplyInfoListReq invoke failed'
			);
		}
		
		if($resp->result != 0){
			return array(
				'errno' => 1052,
				'msg'   => $msg
			);
		}
		
		if(!$resp->applyInfoList){
			return array(
				'errno' => 1053,
				'msg'   => 'getApplyInfoListResp failed'
			);
		}

		return array(
			'errno' => 0,
			'count' => (int)$resp->total,
			'list'  => (array)$resp->applyInfoList
		);
	}

	/*
	 * 6.∏˘æ›∂©µ•≤È’“…Ã∆∑
	 * @params
	 *     $uid
	 *     $orderId
	 * @output
	 *     array('errno' => *, 'msg' => *, 'data' => array())
     */
	public static function getOneOrderInfo($uid, $orderId){
		$ret = IOrder::getOneOrderDetail($uid, $orderId);
		if(false === $ret){
			return array(
				'errno' => 1061,
				'msg'   => '≤È’“∂©µ•…Ã∆∑ ß∞‹'
			);
		}
		
		return array(
			'errno' => 0,
			'data'  => $ret
		);
	}

	/*
	 * 7.ªÒ»°∂©µ•¡–±Ì
	 * @params 
	 *	   $uid
	 *	   $orderType: 1=∆’Õ®∂©µ•   2=≥‰÷µ∂©µ•
	 *     $monthAgo : 1=“ª∏ˆ‘¬÷Æƒ⁄ ∞ 2=“ª‘¬÷Æ«∞
	 *	   $page
	 *     $pageSize
	 * @output
	 *     array()
     */
	public static function getOrderList($uid, $orderType = 1, $monthAgo = 1, $page = 0, $pageSize = 10){
		global $_OrderState, $_PAY_MODE, $_OrderDelayStock, $_OrderProcessId, $_VP_MobileOrderState;

		$page -= 1;
		if($page < 0){
			$page = 0;
		}

		if($orderType === 1){	//∆’Õ®∂©µ•
			if($monthAgo === 2){	//“ª∏ˆ‘¬“‘«∞
				$list = IOrder::getUserOrdersOneMonthAgo($uid, $page, $pageSize);
			}else{
				$list = IOrder::getUserOrdersInOneMonth($uid, $page, $pageSize);
			}
		}else{	//≥‰÷µ∂©µ•
			if($monthAgo === 2){
				$list = IVirtualPay::getUserOrdersOneMonthAgo($uid, $page, $pageSize);
			}else{
				$list = IVirtualPay::getUserOrdersInOneMonth($uid, $page, $pageSize);
			}
		}
		
		if(count($list['orders']) > 0){
			foreach($list['orders'] AS $n => $row){
				if($orderType === 2){	//≥‰÷µ∂©µ•
					$status = $_VP_MobileOrderState[$row['status']];
					$list['orders'][$n]['status'] = $status ? $status[0] : "Œ¥÷™";
				}else{
					//∂©µ•◊¥Ã¨
					$order_detail = IOrder::getOneOrderDetail($uid, $row['order_char_id']);
					if ($order_detail === false){
						continue; //TODO ªÒ»°µ•Ãıº«¬º ß∞‹
					}
					$_order_state_str = "";
					if(in_array($order_detail['status'], array($_OrderState['Origin']['value'], $_OrderState['WaitingPay']['value'], $_OrderState['WaitingManagerAudit']['value'], ))
						&& $_PAY_MODE[$order_detail['hw_id']][$order_detail['pay_type']]['IsNet'] == 1
						&& $order_detail['isPayed'] == 1) { //‘⁄œﬂ÷ß∏∂ && ◊¥Ã¨Œ™¥˝…Û∫ÀªÚ¥˝÷ß∏∂ && “—∏∂π˝øÓ

						$_order_state_str = '“—÷ß∏∂£¨¥˝¥¶¿Ì';
					}
					else {
						foreach ($_OrderState as $key => $arr) {
							if ($order_detail['status'] == $arr['value']) {
								$_order_state_str = $arr['siteName'];
								break;
							}
						}
					}
					$list['orders'][$n]['detail'] = $order_detail;
					$list['orders'][$n]['status'] = $_order_state_str;
					$list['orders'][$n]['status_int'] = $order_detail['status'];
				}
			}
		}
		return $list;
	}

	/*
	 * 8.ÃÌº”“ª∏ˆ∑˛ŒÒµ•
	 * @params
	 *     $data(Array)
	 * @output 
	 *     array('errno' => *, 'msg' => *)
     */
	public static function addToApply($uin, $baseInfo, $applyInfo){
		$id = IServiceIdGenerator::getNewId('service_apply');
		if(!$id){
			return array(
				'errno' => 1081,
				'msg'   => 'œµÕ≥∑±√¶£¨«Î÷ÿ ‘'
			);
		}

		/*ª˘¥°Õ≥º∆ ˝æ›*/
		$baseInfo['billNo'] = $id;

		/*ÃÌº”µΩª˘¥°Õ≥º∆±Ì - S*/
		$req = new icson\servicecenter\dao\addBaseStatInfoReq();
		$req->baseInfo  = $baseInfo;
		
		$resp = new icson\servicecenter\dao\addBaseStatInfoResp();
		
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
		
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			return array(
				'errno' => 1082,
				'msg'   => 'addBaseStatInfoReq invoke failed'
			);
		}
		
		if($resp->result != 0){
			return array(
				'errno' => 1083,
				'msg'   => $resp->errMsg
			);
		}
		/*ÃÌº”µΩª˘¥°Õ≥º∆±Ì - E*/

		/*ÃÌº”µΩ“µŒÒ±Ì - S*/
		$req = new icson\servicecenter\dao\addApplyInfoReq();
		$applyInfo['baseInfo'] = $baseInfo;
		$req->applyInfo = $applyInfo;

		$resp = new icson\servicecenter\dao\addApplyInfoResp();

		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));

		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			return array(
				'errno' => 1084,
				'msg'   => 'addApplyInfoReq invoke failed'
			);
		}
		
		if($resp->result != 0){
			return array(
				'errno' => 1085,
				'msg'   => $resp->errMsg
			);
		}
		/*ÃÌº”µΩ“µŒÒ±Ì - E*/

		//∑˛ŒÒµ•Õ≥º∆+1
		$tm = Config::getTMem('service_statistic');
		if($tm){
			$count = $tm->get(TMEM_BID_SERVICE_STATISTIC, 'service_count');
			if($count){
				$count += 1;
				$tm->set(TMEM_BID_SERVICE_STATISTIC, 'service_count', $count);
			}
		}

		return array(
			'errno' => 0,
			'id'	=> $id
		);
	}

	/*
	 * 9.ªÒ»° €∫Ûµ•¡–±Ì
	 * @params
	 *     $uid
	 *     $whId
	 *     $page
	 *     $pageSize
	 * @output
	 *     array('errno' => *, 'msg' => *, 'total' => *, 'list' => array())
	 */
	public static function getPostsaleList($uid, $whId, $page = 1, $pageSize = 10){
		$rmaList = IRMANew::getRmaApplies($uid, $whId, $pageSize, ($page-1));
		if($rmaList === false){
			Logger::err( "IRMANew::getRmaApplies failed, code:" . IRMANew::$errCode . ', msg:' . IRMANew::$errMsg . ', uid:' . $uid . ', whid:' . $whId);
			return array(
				'errno' 	=> 1,
				'msg'		=> 'œµÕ≥∑±√¶£¨«Î…‘∫Ú‘Ÿ ‘£°'
			);
		}
		
		$data = array(
			'total'	=> $rmaList['total'],
			'list'	=> array()
		);
		if(!empty($rmaList['data']) && count($rmaList['data']) >0){
			foreach($rmaList['data'] as $rma){
				//…Ã∆∑–≈œ¢
				$row = array();
				$row['postsale_id'] = $rma['RequestSysNo'];
				$row['time_create'] = strtotime($rma['RequestDate']);
				$row['items']	= array();
				if(empty($rma['Iproducts'])){ //exception
					continue;
				}else {					
					//…Ã∆∑–≈œ¢
					foreach($rma['Iproducts'] as $rmaProduct) {
						//…Ã∆∑–≈œ¢
						$pid =  $rmaProduct['I_ProductSysNo'];
						$pinfo = IProduct::getBaseInfo($pid, $whId, true);
						if($pinfo === false){
							continue;
						}else if(empty($pinfo) || count($pinfo) <0){
							continue;
						}else{
							$product_title = strip_tags($pinfo['name']);
							$product_title = empty($product_title) ? "" : htmlspecialchars($product_title, ENT_QUOTES);
							$php_pic = '<img src="' . IProduct::getPic($pinfo['product_char_id'], 'small') . '" alt="'.$product_title.'" title="'.$product_title.'">';
							$vars['php_pic'] = $php_pic;
							
							$row['items'][] = array(
									'name'				=> $product_title,
									'product_id'		=> $pid,
									'product_char_id'	=> $pinfo['product_char_id'],
							);
						}
					}
				}
				$row['status'] = self::_getPostsaleStatus($rma['SysNo'], $rmaProduct['I_RegistSysNo'], $whId, $rma['RequestDate'],  $rma['Status']);
				$data['list'][] = $row;
			}
		}
		
		return $data;
	}

	/*
	 * 10.ºÏ≤È «∑Òø…Ã·Ωª
	 * @params 
	 */
	public static function checkAppliable($uin, $orderid, $type = ''){
		$req = new icson\servicecenter\dao\getApplyInfoListReq();
		$req->account  = floatval($uin);
		$req->page     = 1;
		$req->pageSize = 999999;
		if($type) $req->type = $type;
		
		$resp = new icson\servicecenter\dao\getApplyInfoListResp();
		
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
		
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			//self::setERR(9033, 'invoke failed', 0, $stub->last_err_msg);
			return true;
		}
		
		if($resp->result != 0){
			//self::setERR(8702, 'result error', $resp->result, '');
			//$msg = $resp->errMsg;
			return true;
		}
		
		if(!$resp->applyInfoList){
			//self::se	tERR(9035, 'userInfo not found');
			return true;
		}
	
		//ºÏ≤È «∑Ò“—æ≠¥Ê‘⁄π˝∏√∂©µ•∫≈∂‘”¶µƒ…Í«Îµ•£¨«“◊¥Ã¨Œ™Œ¥ÕÍ≥…
		$applyList = (array)$resp->applyInfoList;
		//var_dump($applyList);
		if(count($applyList) > 0){
			foreach($applyList as $apply){
				$type  = $apply['baseInfo']['type'];
				if($type != $type) continue;

				$state = $apply['baseInfo']['state'];
				$orderNo = $apply['baseInfo']['orderNo'];
				if($orderNo == $orderid && $state != 3) return false;
			}
		}

		return true;
	}

	/*
	 * 11.ªÒ»°ªÿ∏¥¡–±Ì
	 * @params 
	 *     $uid
	 *	   $id
	 * @output
	 *     array('errno' => *, 'list' => array, 'msg' => *)
	 */
	public static function getReplyList($uin, $id){
		$req = new icson\servicecenter\dao\getReplyListReq();
		$req->complaint_id  = intval($id);
		
		$resp = new icson\servicecenter\dao\getReplyListResp();
		
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
		
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			//self::setERR(9033, 'invoke failed', 0, $stub->last_err_msg);
			return false;
		}
		
		if($resp->result != 0){
			//self::setERR(8702, 'result error', $resp->result, '');
			//$msg = $resp->errMsg;
			return false;
		}
		
		if(!$resp->replyInfoList){
			//self::se	tERR(9035, 'userInfo not found');
			return false;
		}

		return array(
			'errno' => 0,
			'list'  => (array)$resp->replyInfoList
		);
	}

	/*
	 * 12.ÃÌº”ªÿ∏¥
	 * @params
	 *     
	 */
	public static function addReply($uin, $replyData){
		$rid = IServiceIdGenerator::getNewId('service_reply');
		if(!$rid){
			return array(
				'errno' => 1201,
				'msg'   => 'œµÕ≥∑±√¶£¨«Î÷ÿ ‘'
			);
		}
		$replyData['rid'] = $rid;

		$req = new icson\servicecenter\dao\addReplyInfoReq();
		$req->replyInfo  = $replyData;
		
		$resp = new icson\servicecenter\dao\addReplyInfoResp();
		
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
		
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			//self::setERR(9033, 'invoke failed', 0, $stub->last_err_msg);
			return false;
		}
		
		if($resp->result != 0){
			//self::setERR(8702, 'result error', $resp->result, '');
			//$msg = $resp->errMsg;
			return array(
				'errno' => 1202,
				'msg'   => $resp->errMsg
			);
		}

		return array(
			'errno' => 0
		);
	}

	/*
	 * 13.ªÒ»°“ª∏ˆ∑˛ŒÒµ•–≈œ¢
	 */
	public static function getOneApplyInfo($uin, $id){
		$req = new icson\servicecenter\dao\getApplyInfoOneReq();
		$req->id  = $id;
		
		$resp = new icson\servicecenter\dao\getApplyInfoOneResp();
		
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
		
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			return array(
				'errno' => 1301,
				'msg'   => 'getApplyInfoOneReq invoke failed'
			);
		}
		
		if($resp->result != 0){
			return array(
				'errno' => 1302,
				'msg'   => $resp->errMsg
			);
		}
	
		if(!$resp->applyInfo){
			return array(
				'errno' => 1303,
				'msg'   => 'getApplyInfoOneResp failed'
			);
		}

		return $resp->applyInfo;
	}

	/*
	 * 14.∏¸–¬…Í«Îµ•
	 */
	public static function updateApply($uin, $baseData, $applyData){
		//∏¸–¬ª˘¥°±Ì
		if(count($baseData) > 0){
			$req = new icson\servicecenter\dao\updateBaseStatInfoReq();
			$req->modStatInfo = $baseData;
		
			$resp = new icson\servicecenter\dao\updateBaseStatInfoResp();
		
			$stub = new WebStubCntl();
			$stub->setCallerName(floatval($uin));
			//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
			$stub->setDwOperatorId(floatval($uin));
			$stub->setDwUin(floatval($uin));
		
			$ret = $stub->invoke($req, $resp);
			if($ret != 0){
				//self::setERR(9033, 'invoke failed', 0, $stub->last_err_msg);
				return false;
			}
		
			if($resp->result != 0){
				//self::setERR(8702, 'result error', $resp->result, '');
				//$msg = $resp->errMsg;
				return array(
					'errno' => 1402,
					'msg'   => $resp->errMsg
				);
			}
		}

		//∏¸–¬“µŒÒ±Ì	
		$req = new icson\servicecenter\dao\updateApplyInfoReq();
		$req->applyInfo  = $applyData;
		
		$resp = new icson\servicecenter\dao\updateApplyInfoResp();
	
		$stub = new WebStubCntl();
		$stub->setCallerName(floatval($uin));
		//$stub->setPeerIPPort('10.6.207.224', 53101);///////////////////////////////////////////////////////////
		$stub->setDwOperatorId(floatval($uin));
		$stub->setDwUin(floatval($uin));
	
		$ret = $stub->invoke($req, $resp);
		if($ret != 0){
			//self::setERR(9033, 'invoke failed', 0, $stub->last_err_msg);
			return false;
		}
		
		if($resp->result != 0){
			//self::setERR(8702, 'result error', $resp->result, '');
			//$msg = $resp->errMsg;
			return array(
				'errno' => 1401,
				'msg'   => $resp->errMsg
			);
		}

		return array(
			'errno' => 0
		);
	}
	
	/*
	 * 16.ªÒ»°÷∏∂®µƒ∂©µ•
	 */
	public static function getOneOrder($uid, $orderId){
		global $_OrderState, $_PAY_MODE, $_OrderDelayStock, $_OrderProcessId, $_VP_MobileOrderState;
		
		$order_detail = IOrder::getOneOrderDetail($uid, $orderId);
		if ($order_detail === false){
			return false;
		}
		
		return $order_detail;
	}

	/*
	 * ªÒ»°Œ¥∂¡œ˚œ¢Ω”ø⁄
	 */
	public static function getUnreadMsgCount($uid){
		if(!$uid){
			return array(
				'errno' => 1011,
				'msg'   => '»±…Ÿ≤Œ ˝'		
			);
		}
		
		$tm = Config::getTMem('service_center_unread_message');
		if(!$tm){
			return array(
				'errno' => 1012,
				'msg'   => 'TMEM≈‰÷√¥ÌŒÛ'		
			);
		}

		//π§µ•¿‡–Õ¥”1-8
		$result = array();
		for($i = 1; $i <= 8; $i ++){
			$tmem_key = $uid . "_unread_message_" . $i;
			$_item_count = $tm->get(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $tmem_key);
			if($_item_count){
				$result[$i] = intval($_item_count);
			}
		}

		return array(
			'errno' => 0,
			'list'  => $result		
		);
	}

	/*
	 * ªÒ»°ª˘¥°Õ≥º∆ ˝æ›
	 */
	private static function _getBaseStatInfo($data){
		$baseInfoIndexArr = array(
			'source', 'biz', 'siteID', 'type', 'billNo', 'orderNo', 'account', 'userType', 'userName', 'isVip', 'optTeam', 'creator', 'followKF', 'censor', 'state', 'flag', 'approve', 'checkup', 'productdCate', 'archive', 'createTime', 'distributeTime', 'acceptTime', 'nextTime', 'finishTime', 'checkupTime', 'modifyTime', 'sumTime', 'dealTime'
		);

		$baseInfo = array();
		foreach($data as $k => $v){
			if(in_array($k, $baseInfoIndexArr)) $baseInfo[$k] = $v;
		}

		return $baseInfo;
	}

	/*
	 * ªÒ»° €∫Ûµ•◊¥Ã¨
	 */
	private static function _getPostsaleStatus($requestsysno, $registsysno, $wid, $requestdate,  $status){
		//◊¥Ã¨÷µ
		$val['php_status_desc'] = '¥˝…Û∫À';
		$request_date = strtotime($requestdate);
		$wid = intval($wid);
		if($request_date <= 1353495600){//2012-11-21 19:00:00 ÷Æ«∞µƒŒ™ ¿˙ ∑◊¥Ã¨
			if($status == 0){//µ±…Í«Îµ•Œ¥…Û∫À£¨œ‘ æ◊¥Ã¨ªπ «¥˝…Û∫À£¨Œﬁ¡˜ÀÆ
				$val['php_status_desc'] = '¥˝…Û∫À';
			}else if(in_array($status, array(-1, 4))){//µ±…Í«Îµ•…Û∫À≤ªÕ®π˝£¨œ‘ æ…Í«Îµ•…Û∫À≤ªÕ®π˝µƒøÕ∑˛±∏◊¢ƒ⁄»›£¨Œﬁ¡˜ÀÆ£ª
				$val['php_status_desc'] =  IRMANew::getRmaStatusNotPass_Last($requestsysno, $wid);
			}else{//µ±…Í«Îµ•…Û∫ÀÕ®π˝£¨œ‘ æ¡˜ÀÆ±Ìµƒ◊Ó–¬◊¥Ã¨
				$val['php_status_desc'] = IRMANew::getOldRmaStatus_Last($registsysno);
			}
		}else{//–¬◊¥Ã¨:…Í«Î±Ìµ•¿≠»°–¬¥¶¿Ì¡˜ÀÆ±Ìµƒƒ⁄»›
			$val['php_status_desc'] = IRMANew::getRmaStatus_Last($requestsysno, $registsysno, $wid);
		}
	
		return $val['php_status_desc'];
	}
}
