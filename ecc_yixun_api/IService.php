<?php

error_reporting(E_ALL ^ E_NOTICE);

require_once(PHPLIB_ROOT . 'api/inc/IServiceApplyTTC.php');
require_once(PHPLIB_ROOT . 'api/inc/IServiceReplyTTC.php');
require_once(PHPLIB_ROOT . 'api/IOrder.php');
require_once(PHPLIB_ROOT . 'api/IProduct.php');
require_once(PHPLIB_ROOT . 'api/IVirtualPay.php');

class IService{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static function applyDelete($uid, $id){
		IServiceApplyTTC::remove($uid, array('id' => $id));
		IServiceReplyTTC::remove($uid, array('complaint_id' => $id));
	}
	
	public static function addToApply($uid, $type, $subtype, $orderId, $postsaleId, $mobile, $telephone, $title, $content, $attachment, $isOrderApply = true){
		/*��ˢ�� - ÿ��ÿ������15��*/
		$today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$tm = Config::getTMem('service_statistic');
		if($tm){
			$applyTodayCount = $tm->get(TMEM_BID_SERVICE_STATISTIC, $uid . '_' . $today . '_count');
			if(false === $applyTodayCount) $applyTodayCount = 0;

			if($applyTodayCount > 15){
				return array(
					'errno' => 2,
					'msg'   => '�𾴵��û���������Ϣһ�£��Ժ��ύ��'
				);
			}
			$tm->set(TMEM_BID_SERVICE_STATISTIC, $uid . '_' . $today . '_count', (int)($applyTodayCount + 1));
		}

		$id = self::getNewId(false);
		if(!$id){
			return array(
					'errno'	=> 1,
					'msg'	=> 'ϵͳ��æ��������'
			);
		}
		if($isOrderApply && $orderId){
			$ret = self::checkAppliable($uid, $orderId, $type);
			if(!$ret){
				return array(
						'errno'	=> 2,
						'msg'	=> '�ö����ķ������뻹δ������ɣ������ظ��ύ'
				);
			}
			$ret = IOrder::getOneOrderDetail($uid, $orderId);
			if($ret === false){
				$ret = IVirtualPay::getVirtualOrder($uid, $orderId);
				if($ret === false){
					return array(
							'errno'	=> 2,
							'msg'	=> 'δ�ҵ��˶���'
					);
				}
			}
		}
		if($isOrderApply && $postsaleId){
			$ret = self::checkAppliable($uid, $postsaleId);
			if(!$ret){
				return array(
						'errno'	=> 2,
						'msg'	=> '���ۺ�ķ������뻹δ������ɣ������ظ��ύ'
				);
			}
		}
		if($mobile){
			if(!is_numeric($mobile)){
				return array(
						'errno'	=> 2,
						'msg'	=> '�ֻ�������������'
				);
			}
		}
		if($telephone){
			if(!is_numeric(str_replace('-', '', $telephone))){
				return array(
						'errno'	=> 2,
						'msg'	=> '�ֻ�������������'
				);
			}
		}
		$data = array(
			'id'			=> $id,
			'type'			=> $type,
			'subtype'		=> $subtype,
			'order_id'		=> $orderId,
			'postsale_id'	=> $postsaleId,
			'buyer_id'		=> $uid,
			'mobile'		=> $mobile,
			'telephone'		=> $telephone,
			'title'			=> $title,
			'content'		=> $content,
			'attachment'	=> $attachment,
			'time_create'	=> time()
		);
		
		$ret = IServiceApplyTTC::insert($data);
		if($ret === false){
			return array(
					'errno'		=> 2,
					'error1'	=> IServiceApplyTTC::$errCode,
					'error2'	=> IServiceApplyTTC::$errMsg,
					'msg'		=> '�ڲ�����������'
			);
		}
		
		return array(
				'errno'	=> 0
		);
	}
	
	public static function addToReply($isKF = false, $uid, $id, $oper, $content, $attachment){
		$rid = self::getNewId(true);
		if(!$rid){
			return array(
					'errno'	=> 1,
					'msg'	=> 'ϵͳ��æ��������'
			);
		}
		$rows	= IServiceApplyTTC::get($uid, array('id' => $id), array('id'), 0, 0);
		if(count($rows) == 0){
			return array(
					'errno'	=> 2,
					'msg'	=> '�ظ���������'
			);
		}
		$data = array(
			'id'				=> $rid,
			'complaint_id'		=> $id,
			'replyer_id'		=> $oper,
			'replyer_type'		=> $isKF ? 1 : 2,
			'content'			=> $content,		
			'time_reply'		=> time(),
			'attachment'		=> $attachment
		);
		
		$ret = IServiceReplyTTC::insert($data);
		if($ret === false){
			return array(
					'errno'		=> 2,
					'error1'	=> IServiceReplyTTC::$errCode,
					'error2'	=> IServiceReplyTTC::$errMsg,
					'msg'		=> '�ڲ�����������'
			);
		}
		
		//�޸������
		$filter = array(
				'id'		=> $id
		);
		$data = array(
				'buyer_id'			=> $uid,
				'role_lastreply'	=> $isKF ? 1 : 2,
				'time_lastreply'	=> time(),
				'time_modify_state'	=> time(),
				'isfollow'			=> 0
		);
		
		$ret = IServiceApplyTTC::update($data, $filter);
		if($ret === false){
			return array(
					'errno'		=> 3,
					'error1'	=> IServiceReplyTTC::$errCode,
					'error2'	=> IServiceReplyTTC::$errMsg,
					'msg'		=> '�ڲ�����������'
			);
		}
		
		return array(
				'errno'		=> 0
		);
	}
	
	//�����б�
	public static function getApplyList($uid, $type, $page = 1, $pageSize = 10){
		$condition	= array('type' => $type);
		$alllist	= IServiceApplyTTC::get($uid, $condition, array('id'), 0, 0);
		
		if($alllist === false){
			Logger::err("IServiceApplyTTC get all failed, code:" . IServiceApplyTTC::$errCode . ', msg:' . IServiceApplyTTC::$errMsg . ', uid:' . $uid);
			return array(
					'errno' 	=> 1,
					'error1'	=> IServiceApplyTTC::$errCode,
					'error2'	=> IServiceApplyTTC::$errMsg,
					'msg'		=> 'ϵͳ��æ�����Ժ����ԣ�'
			);
		}
		
		$count		= count($alllist);
		$start		= ($page - 1) * $pageSize;
		$list		= IServiceApplyTTC::get($uid, $condition, array(), $pageSize, $start);
		
		if($list === false){
			Logger::err("IServiceApplyTTC get some failed, code:" . IServiceApplyTTC::$errCode . ', msg:' . IServiceApplyTTC::$errMsg . ', uid:' . $uid);
			return array(
					'errno' 	=> 1,
					'error1'	=> IServiceApplyTTC::$errCode,
					'error2'	=> IServiceApplyTTC::$errMsg,
					'msg'		=> 'ϵͳ��æ�����Ժ����ԣ�'
			);
		}

		return array(
				'errno'		=> 0,
				'total'		=> $count,
				'list'		=> $list
		);
	}
	
	//�ظ��б�
	public static function getReplyList($uid, $id){
		$rows	= IServiceApplyTTC::get($uid, array('id' => $id), array('id', 'ext4', 'type'), 0, 0);
		if(count($rows) == 0){
			return array(
					'errno'	=> 1,
					'msg'	=> '�ظ���������'
			);
		}
		
		$list = IServiceReplyTTC::get($id, array(), array(), 0, 0);
		
		//�����δ����Ϣ
		if($rows[0]['ext4'] == 1){
			IServiceApplyTTC::update(array('buyer_id' => $uid, 'ext4' => 0), array('id' => $id));
			//��Ͷ�ߵļ�����һ����
			$tm = Config::getTMem('service_center_unread_message');
			if ($tm) {
				$count = $tm->get(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $uid . "_" . "unread_message_" . $rows[0]['type']);
				if(false === $count) {
					$count = 0;
				}
				$count = $count - 1;
				$count = $count > 0 ? intval($count) : 0;
				$tm->set(TMEM_BID_SERVICE_CENTER_UNREAD_MESSAGE, $uid . "_" . "unread_message_" . $rows[0]['type'], $count);
			}
		}
		
		return array(
				'errno'		=> 0,
				'list'		=> $list
		);
	}
	
	//�����б�
	public static function getOrderList($uid, $orderType = 1, $monthAgo = 1, $page = 0, $pageSize = 10){
		global $_OrderState, $_PAY_MODE, $_OrderDelayStock, $_OrderProcessId, $_VP_MobileOrderState;
		$page -= 1;
		if($page < 0){
			$page = 0;
		}
		if($orderType === 1){	//��ͨ����
			if($monthAgo === 2){	//һ������ǰ
				$list = IOrder::getUserOrdersOneMonthAgo($uid, $page, $pageSize);
			}else{
				$list = IOrder::getUserOrdersInOneMonth($uid, $page, $pageSize);
			}
		}else{	//��ֵ����
			if($monthAgo === 2){
				$list = IVirtualPay::getUserOrdersOneMonthAgo($uid, $page, $pageSize);
			}else{
				$list = IVirtualPay::getUserOrdersInOneMonth($uid, $page, $pageSize);
			}
		}
		
		if(count($list['orders']) > 0){
			foreach($list['orders'] AS $n => $row){
				if($orderType === 2){	//��ֵ����
					$status = $_VP_MobileOrderState[$row['status']];
					$list['orders'][$n]['status'] = $status ? $status[0] : "δ֪";
				}else{
					//����״̬
					$order_detail = IOrder::getOneOrderDetail($uid, $row['order_char_id']);
					if ($order_detail === false){
						continue; //TODO ��ȡ������¼ʧ��
					}
					$_order_state_str = "";
					if ( in_array($order_detail['status'], array($_OrderState['Origin']['value'], $_OrderState['WaitingPay']['value'], $_OrderState['WaitingManagerAudit']['value'], ))
						&& $_PAY_MODE[$order_detail['hw_id']][$order_detail['pay_type']]['IsNet'] == 1
						&& $order_detail['isPayed'] == 1) { //����֧�� && ״̬Ϊ����˻��֧�� && �Ѹ�����

						$_order_state_str = '��֧����������';
					}
					else {
						foreach ($_OrderState as $key => $arr) {
							if ($order_detail['status'] == $arr['value']) {
								$_order_state_str = $arr['siteName'];
								break;
							}
						}
					}
					$list['orders'][$n]['status'] = $_order_state_str;
				}
			}
		}
		return $list;
	}
	
	//�����б�
	public static function getOrderDetailList($uid, $monthAgo = 1, $page = 0, $pageSize = 10){
		global $_OrderState, $_PAY_MODE, $_OrderDelayStock, $_OrderProcessId, $_VP_MobileOrderState;
		$page -= 1;
		if($page < 0){
			$page = 0;
		}
		if($monthAgo === 2){	//һ������ǰ
			$list = IOrder::getUserOrdersOneMonthAgo($uid, $page, $pageSize);
		}else{
			$list = IOrder::getUserOrdersInOneMonth($uid, $page, $pageSize);
		}
		
		if(count($list['orders']) > 0){
			foreach($list['orders'] AS $n => $row){
				//����״̬
				$order_detail = IOrder::getOneOrderDetail($uid, $row['order_char_id']);
				//var_dump($order_detail);
				if ($order_detail === false){
					continue; //TODO ��ȡ������¼ʧ��
				}
				$_order_state_str = "";
				if ( in_array($order_detail['status'], array($_OrderState['Origin']['value'], $_OrderState['WaitingPay']['value'], $_OrderState['WaitingManagerAudit']['value'], ))
					&& $_PAY_MODE[$order_detail['hw_id']][$order_detail['pay_type']]['IsNet'] == 1
					&& $order_detail['isPayed'] == 1) { //����֧�� && ״̬Ϊ����˻��֧�� && �Ѹ�����

					$_order_state_str = '��֧����������';
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
				$list['orders'][$n]['status_int'] = $list['orders'][$n]['status'];
				$list['orders'][$n]['status'] = $_order_state_str;
			}
		}
		return $list;
	}

	//��ȡָ���Ķ���
	public static function getOneOrder($uid, $orderId){
		global $_OrderState, $_PAY_MODE, $_OrderDelayStock, $_OrderProcessId, $_VP_MobileOrderState;
		
		$order_detail = IOrder::getOneOrderDetail($uid, $orderId);
		if ($order_detail === false){
			return false;
		}
		
		$_order_state_str = "";
		if ( in_array($order_detail['status'], array($_OrderState['Origin']['value'], $_OrderState['WaitingPay']['value'], $_OrderState['WaitingManagerAudit']['value'], ))
			&& $_PAY_MODE[$order_detail['hw_id']][$order_detail['pay_type']]['IsNet'] == 1
			&& $order_detail['isPayed'] == 1) { //����֧�� && ״̬Ϊ����˻��֧�� && �Ѹ�����
			$_order_state_str = '��֧����������';
		}
		else {
			foreach ($_OrderState as $key => $arr) {
				if ($order_detail['status'] == $arr['value']) {
					$_order_state_str = $arr['siteName'];
					break;
				}
			}
		}
		$order_detail['status'] = $_order_state_str;
		
		return $order_detail;
	}
	
	//�ۺ��б�
	public static function getPostsaleList($uid, $whId, $page = 1, $pageSize = 10){
		$rmaList = IRMANew::getRmaApplies($uid, $whId, $pageSize, ($page-1));
		if($rmaList === false){
			Logger::err( "IRMANew::getRmaApplies failed, code:" . IRMANew::$errCode . ', msg:' . IRMANew::$errMsg . ', uid:' . $uid . ', whid:' . $whId);
			return array(
					'errno' 	=> 1,
					'error1'	=> IRMANew::$errCode,
					'error2'	=> IRMANew::$errMsg,
					'msg'		=> 'ϵͳ��æ�����Ժ����ԣ�'
			);
		}
		
		$data = array(
				'total'	=> $rmaList['total'],
				'list'	=> array()
		);
		if(!empty($rmaList['data']) && count($rmaList['data']) >0){
			foreach($rmaList['data'] as $rma){
				//��Ʒ��Ϣ
				$row = array();
				$row['postsale_id'] = $rma['RequestSysNo'];
				$row['time_create'] = strtotime($rma['RequestDate']);
				$row['items']	= array();
				if(empty($rma['Iproducts'])){ //exception
					continue;
				}else {					
					//��Ʒ��Ϣ
					foreach($rma['Iproducts'] as $rmaProduct) {
						//��Ʒ��Ϣ
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
	
	//δ�������ӿ�
	public static function getNoticeMsg($uid){
		$msgs = array(
				1	=> array('name' => '�����߰�', 'count' => 0, 'url' => 'http://service.51buy.com/orderurge.html'),
				2	=> array('name' => '�����޸�', 'count' => 0, 'url' => 'http://service.51buy.com/ordermodify.html'),
				3	=> array('name' => '����ȡ��', 'count' => 0, 'url' => 'http://service.51buy.com/ordercancel.html'),
				4	=> array('name' => 'Ͷ�߽���', 'count' => 0, 'url' => 'http://service.51buy.com/complaint.html'),
				5	=> array('name' => '������ѯ', 'count' => 0, 'url' => 'http://service.51buy.com/question.html'),
				6	=> array('name' => '����', 'count' => 0, 'url' => 'http://service.51buy.com/suggest.html'),
				7	=> array('name' => '����', 'count' => 0, 'url' => 'http://service.51buy.com/praise.html')
		);
		$rows = IServiceApplyTTC::get($uid, array('ext4' => 1), array('id', 'type'), 1000, 0);

		if($rows === false){
			return array(
					'errno' => 2,
					'msg'	=> '�ڲ��������Ժ�����'
			);
		}
		if($rows){
			foreach ($rows AS $row){
				$type = intval($row['type']);
				$msgs[$type]['count'] ++;
			}
		}
		$data = array();
		foreach($msgs AS $msg){
			$data[] = $msg;
		}
		
		return array(
				'errno'	=> 0,
				'data'	=> $data
		);
	}
	
	//����Ƿ���ύ
	public static function checkAppliable($uid, $orderid, $type = ''){
		$con	= $orderid{0} === 'U' ? array('postsale_id' => $orderid) : array('order_id' => $orderid);
		if($type) $con['type'] = $type;
		$rows	= IServiceApplyTTC::get($uid, $con, array('buyer_id', 'state'), 0, 0);
		if(count($rows) > 0){
			foreach($rows AS $row){
				if($row['state'] != 3){	//δ���
					return false;
				}
			}
		}
		return true;
	}

	//�ͷ������
	public static function addToSatisfation($uid, $aid, $type, $unsatisfaction_types, $detail){
		$filter = array(
			'id'	=> $aid
		);
		$data = array(
			'buyer_id'	=> $uid,
			'ext6' 		=> $type
		);
		if($unsatisfaction_types) $data['ext5'] = trim($unsatisfaction_types);
		if($detail)               $data['ext7'] = trim($detail);
		
		$ret = IServiceApplyTTC::update($data, $filter);
		if($ret === false){
			return array(
				'errno'		=> 3,
				'error1'	=> IServiceReplyTTC::$errCode,
				'error2'	=> IServiceReplyTTC::$errMsg,
				'msg'		=> '�ڲ�����������'
			);
		}
		
		return array(
			'errno'	=> 0
		);
	}
	
	//��id
	public static function getNewId($forReply = false){
		$bizid = $forReply ? 'service_reply' : 'service_apply';
		$newId = IIdGenerator::getNewId($bizid);
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}
		return $newId;
	}
	
	private static function _getPostsaleStatus($requestsysno, $registsysno, $wid, $requestdate,  $status){
		//״ֵ̬
		$val['php_status_desc'] = '�����';
		$request_date = strtotime($requestdate);
		$wid = intval($wid);
		if($request_date <= 1353495600){//2012-11-21 19:00:00 ֮ǰ��Ϊ ��ʷ״̬
			if($status == 0){//�����뵥δ��ˣ���ʾ״̬���Ǵ���ˣ�����ˮ
				$val['php_status_desc'] = '�����';
			}else if(in_array($status, array(-1, 4))){//�����뵥��˲�ͨ������ʾ���뵥��˲�ͨ���Ŀͷ���ע���ݣ�����ˮ��
				$val['php_status_desc'] =  IRMANew::getRmaStatusNotPass_Last($requestsysno, $wid);
			}else{//�����뵥���ͨ������ʾ��ˮ�������״̬
				$val['php_status_desc'] = IRMANew::getOldRmaStatus_Last($registsysno);
			}
		}else{//��״̬:�������ȡ�´�����ˮ�������
			$val['php_status_desc'] = IRMANew::getRmaStatus_Last($requestsysno, $registsysno, $wid);
		}
	
		return $val['php_status_desc'];
	}

	public static function test_mod($uid, $id, $state){
                $rid = self::getNewId(true);
                if(!$rid){
                        return array(
                                        'errno' => 1,
                                        'msg'   => 'ϵͳ��æ��������'
                        );
                }
                $rows   = IServiceApplyTTC::get($uid, array('id' => $id), array('id'), 0, 0);
                if(count($rows) == 0){
                        return array(
                                        'errno' => 2,
                                        'msg'   => '�ظ���������'
                        );
                }
                $data = array(
                        'id'                    => $rid,
                        'complaint_id'          => $id,
                        'replyer_id'            => 106728726,
                        'replyer_type'          => 1,
                        'content'               => '�Զ��ظ�',
                        'time_reply'            => time(),
                        'attachment'            => ''
                );

                $ret = IServiceReplyTTC::insert($data);
                if($ret === false){
                        return array(
                                        'errno'         => 2,
                                        'error1'        => IServiceReplyTTC::$errCode,
                                        'error2'        => IServiceReplyTTC::$errMsg,
                                        'msg'           => '�ڲ�����������'
                        );
                }
		//�޸������
                $filter = array(
                                'id'            => $id
                );
                $data = array(
                                'buyer_id'              => $uid,
                                'state'                 => $state,
                                'role_lastreply'        => 2,
                                'time_lastreply'        => time(),
                                'time_modify_state'     => time(),
                                'isfollow'              => 0,
                                'ext4'                  => 1
                );

                $ret = IServiceApplyTTC::update($data, $filter);
                if($ret === false){
                        return array(
                                        'errno'         => 3,
                                        'error1'        => IServiceReplyTTC::$errCode,
                                        'error2'        => IServiceReplyTTC::$errMsg,
                                        'msg'           => '�ڲ�����������'
                        );
                }

                return array(
                                'errno'         => 0
                );
        }
}
