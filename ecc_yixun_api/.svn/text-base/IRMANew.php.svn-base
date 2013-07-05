<?php
class IRMANew
{
	public static $errMsg = "";
	public static $errCode = 0;
	private static $_MSDB = false;

    private static function getMSDB($wh_id_ = 1)
    {
        $wh_name = 'ERP_' . $wh_id_;
        self::$_MSDB = config::getMSDB($wh_name);
        if (false === self::$_MSDB)
        {
            self::$errMsg = config::$errMsg;
            self::$errCode = config::$errCode;
        }
        return self::$_MSDB;
    }

	//售前退款申请
	public static function addRefund($refund_info, $wid){
		$check = IRMANew::checkRefundInfo($refund_info);
		if(false === $check){
			return false;
		}

		$new_id = IIdGenerator::getNewId('presale_refund_sequence');
		if(false === $new_id || $new_id <= 0){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		$order_id = intval(substr($refund_info['order_id'], -8));

		$new_refund_id = sprintf("%s%09d", "U", $new_id);

		$new_refund = array();
		$new_refund['SysNo']			= $new_id;
		$new_refund['RequestSysNo']		= $new_refund_id;
		$new_refund['SOSysNo']			= $order_id;
		$new_refund['SOID']				= $refund_info['order_id'];
		$new_refund['SoPayTypeSysNo']	= $refund_info['pay_type'];//订单支付方式
		$new_refund['RequestFormType']	= 1;//申请单类型-->售前申请单:1,售后申请单:2
		$new_refund['CustomerSysNo']	= $refund_info['user_id'];
		$new_refund['Whid']				= $wid;
		$new_refund['RefundTypeSysNo']	= $refund_info['refund_type'];
		$new_refund['ProductDesc']		= $refund_info['product_desc'];
		$new_refund['Status']			= 1;//初始值为
		$new_refund['Source']			= 1;//申请单来源 0:内部员工创建	1:易迅网客户申请	  2:QQ网购客户申请
		$new_refund['RequestDate']		= date('Y-m-d H:i:s', time());
		$new_refund['rowCreateDate']	= date('Y-m-d H:i:s', time());
		$new_refund['rowModifyDate']	= date('Y-m-d H:i:s', time());
		$new_refund['RequestReason']	= 9;//退款原因.统一填9(其它)
		$new_refund['RequestAmt']		= 0;//退款金额.初始值是0
		if(2 == $refund_info['refund_type']){//退款至银行卡
			$new_refund['RefundBank']				= $refund_info['sel_online_pay'];
			$new_refund['RefundBankCity']			= $refund_info['area_id'];
			$new_refund['RefundBankSubBranchSysNo']	= intval($refund_info['refund_bank']);
			$new_refund['RefundAccountName']		= $refund_info['account_name'];
			$new_refund['RefundAccountNo']			= $refund_info['account_no'];
			$new_refund['AccounterMobilephone']		= $refund_info['mobile_phone'];
			$new_refund['ProvinceName']			= $refund_info['bank_cityName'];//开户城市
			$new_refund['CityName']		= $refund_info['refund_bankName'];//支行名称
		}else{
			if(isset($refund_info['pay_type']) && !empty($refund_info['pay_type'])){
				$refund_payType = $refund_info['pay_type'];
				if($refund_payType == 15){//退款至联华OK卡
					$new_refund['RefundAccountNo']	= $refund_info['lianhua_ok_id'];
				}
				if($refund_payType == 32){//退款至一城卡
					$new_refund['RefundAccountNo']	= $refund_info['yicheng_id'];
				}
			}
		}
		$ret = IRMARequestTTC::insert($new_refund);
		if(false === $ret){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC insert failed" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}

		$new_refund_item = array();
		foreach($refund_info['product_ids'] as &$product_id){
			$new_id_item = IIdGenerator::getNewId('rma_request_item_sequence');
			if(false === $new_id_item || $new_id_item <= 0){
				self::$errCode = IIdGenerator::$errCode;
				self::$errMsg = IIdGenerator::$errMsg;
				return  false;
			}

			$new_refund_item['SysNo']				= $new_id_item;
			$new_refund_item['RequestSysNo']		= $new_id;
			$new_refund_item['ProductSysNo'] 		= $product_id;
			$new_refund_item['RequestFormType'] 	= 1;
			$new_refund_item['Whid'] 				= $wid;
			$new_refund_item['Status'] 				= 0;
			$new_refund_item['rowCreateDate']		= date('Y-m-d H:i:s', time());
			$new_refund_item['rowModifyDate']		= date('Y-m-d H:i:s', time());
			//$new_refund_item['Source']				= 1;//来源 0:内部员工创建	1:易迅网客户申请	  2:QQ网购客户申请
			$ret_item = IRMARequestItemTTC::insert($new_refund_item);
			if(false === $ret_item){
				self::$errCode = IRMARequestItemTTC::$errCode;
				self::$errMsg = IRMARequestItemTTC::$errMsg;
				Logger::err("IRMARequestItemTTC insert failed" . " errMsg: " .IRMARequestItemTTC::$errMsg ." errCode: " .IRMARequestItemTTC::$errCode);
				return false;
			}
		}

		$new_register = array();
		foreach($refund_info['product_ids'] as $product_id => $count){
			$new_id_reg = IIdGenerator::getNewId('rma_register_sequence');
			if(false === $new_id_reg || $new_id_reg <= 0){
				self::$errCode = IIdGenerator::$errCode;
				self::$errMsg = IIdGenerator::$errMsg;
				return  false;
			}

			$new_register['SysNo']				= $new_id_reg;
			$new_register['RequestSysNo']		= $new_id;
			$new_register['ProductSysNo'] 		= $product_id;
			$new_register['RequestType']		= 3;//处理类型:退款(售前)
			$new_register['CustomerSysNo'] 		= $refund_info['user_id'];;
			$new_register['Whid'] 				= $wid;
			$new_register['Status'] 			= 0;
			$new_register['rowCreateDate']		= date('Y-m-d H:i:s', time());
			$new_register['rowModifyDate']		= date('Y-m-d H:i:s', time());
			$new_register['RequestFormType']	= 1;//售前处理单:1,售后处理单:2.
			$new_register['RefundStatus']		= 0;//退款状态
			//处理单主表
			$ret_item = IRMARegisterTTC::insert($new_register);
			if(false === $ret_item){
				self::$errCode = IRMARegisterTTC::$errCode;
				self::$errMsg = IRMARegisterTTC::$errMsg;
				Logger::err("IRMARegisterTTC insert failed" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
				return false;
			}
		}
		return true;
	}

	//售前退款申请--查看
	public static function getRefundInfo($uid, $wid, $pageSize, $page){
		$total = IRMARequestTTC::get($uid, array('RequestFormType'=>1), array('SysNo'));
		if (false === $total) {
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARegisterTTC get failed" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
			return false;
		}
		$total = count($total);
		if ($total == 0) {
			return array('total'=>$total, 'data'=>array());
		}

		$last_data = array();
		$data = IRMARequestTTC::get($uid, array('RequestFormType'=>1),
										  array('SysNo', 'RequestSysNo', 'SOSysNo', 'SOID','RequestAmt',
												'RequestPoint','RefundTypeSysNo','Status','RequestDate'),
									$pageSize , $page*$pageSize);
		if(false === $data){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARegisterTTC get failed" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
			return false;
		}

		if(!empty($data) && count($data) > 0){
			foreach($data as &$value){
				$val = array();
				$val['SysNo'] 			= $value['SysNo'];
				$val['RequestSysNo'] 	= $value['RequestSysNo'];
				$val['SOSysNo'] 		= $value['SOSysNo'];
				$val['SOID'] 			= $value['SOID'];
				$val['RequestAmt'] 		= $value['RequestAmt'];
				$val['RequestPoint'] 	= $value['RequestPoint'];
				$val['RefundTypeSysNo'] = $value['RefundTypeSysNo'];
				$val['Status'] 			= $value['Status'];
				$val['RequestDate'] 	= $value['RequestDate'];

				//,'RequestFormType','Whid','Status','rowCreateDate','rowModifyDate'
				$data_item = IRMARequestItemTTC::get($value['SysNo'],array('RequestFormType'=>1),array('SysNo','RequestSysNo',
												'RegistSysNo','ProductSysNo'));
				if(false === $data_item){
					self::$errCode = IRMARequestItemTTC::$errCode;
					self::$errMsg = IRMARequestItemTTC::$errMsg;
					Logger::err("IRMARequestItemTTC get failed" . " errMsg: " .IRMARequestItemTTC::$errMsg ." errCode: " .IRMARequestItemTTC::$errCode);
					return false;
				}else if(!empty($data_item) && count($data_item) > 0){
					foreach($data_item as &$item_value){
						$val_item = array();
						$val_item['I_SysNo'] 			= $item_value['SysNo'];
						$val_item['I_RequestSysNo'] 	= $item_value['RequestSysNo'];
						$val_item['I_RegistSysNo'] 		= $item_value['RegistSysNo'];
						$val_item['I_ProductSysNo'] 	= $item_value['ProductSysNo'];
						$val['Iproducts'][] 			= $val_item;
					}
				}else{
					$val['Iproducts'] = array();
				}

				//处理信息
				$data_reg = IRMARegisterTTC::get($uid, array('RequestSysNo'=>$value['SysNo'],'RequestFormType'=>1),
										  array('CustomerSysNo', 'RequestSysNo', 'ProductSysNo', 'RequestType','SysNo','Whid',
												'RequestAmt','RequestPoint','Status','rowCreateDate','rowModifyDate'),
									$pageSize , $page*$pageSize);
				if(false === $data_reg){
					self::$errCode = IRMARegisterTTC::$errCode;
					self::$errMsg = IRMARegisterTTC::$errMsg;
					Logger::err("IRMARegisterTTC get failed" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
					return false;
				}

				if(!empty($data_reg) && count($data_reg) > 0){
					foreach($data_reg as &$reg){
						$val_reg = array();
						$val_reg['R_RequestSysNo'] 	= $reg['RequestSysNo'];
						$val_reg['R_SysNo'] 		= $reg['SysNo'];
						$val_reg['R_Status'] 		= $reg['Status'];
						$val['RRegister'][] 		= $val_reg;
					}
				}else{
					$val['RRegister'] = array();
				}
				$last_data[] = $val;
			}
		}

		if(count($data) == 0){
			return array('total'=>$total, 'data'=>array());
		}
		return array('total'=>$total, 'data'=>$last_data);

	}

	//售前退款 产看详情
	public static function getCustomerRefund_detail($uid, $rma_CustomerRequestID, $request_sysno){
		$last_data = array();
		//申请单填写信息
		$data = IRMARequestTTC::get($uid, array('SysNo'=>$rma_CustomerRequestID, 'RequestFormType'=>1),
										  array('CustomerSysNo', 'RequestSysNo', 'SOSysNo', 'SOID','SoPayTypeSysNo',
												'RequestFormType','SysNo','StockSysNo','Whid','RequestReason',
												'ProductDesc','RequestType','RefundTypeSysNo','RefundBank','RefundAccountName',
												'RefundAccountNo','RefundBankCity','ProvinceName','CityName','RefundBankSubBranchSysNo',
												'AccounterTelephone','AccounterMobilephone','PickupMan','PickupTelephone','PickupMobilephone',
												'PickupAreaSysNo','PickupAddress','PickupZip','PickupType','ETakeDate',
												'ETakeTimeSpan','DoorGetFee','IsRevertAddress','RevertContact','RevertTelephone',
												'RevertMobilephone','RevertAreaSysNo','RevertAddress','RevertZip','RequestAmt',
												'RequestPoint','RequestDate','rowCreateDate','rowModifyDate','Status'));
		if(false === $data){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC get failed" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}

		global $_District, $_Province, $_City;
		if(!empty($data) && count($data) > 0){
			foreach($data as &$value){
				$val = array();
				$val['CustomerSysNo'] 		= $value['CustomerSysNo'];
				$val['RequestSysNo'] 		= $value['RequestSysNo'];
				$val['SOSysNo'] 			= $value['SOSysNo'];
				$val['SOID'] 				= $value['SOID'];
				$val['SoPayTypeSysNo'] 		= $value['SoPayTypeSysNo'];

				$val['RequestFormType'] 	= $value['RequestFormType'];
				$val['SysNo'] 				= $value['SysNo'];
				$val['StockSysNo'] 			= $value['StockSysNo'];
				$val['Whid'] 				= $value['Whid'];
				$val['RequestReason'] 		= $value['RequestReason'];

				$val['ProductDesc'] 		= $value['ProductDesc'];
				$val['RequestType'] 		= $value['RequestType'];
				$val['RefundTypeSysNo'] 	= $value['RefundTypeSysNo'];
				$val['RefundBank'] 			= $value['RefundBank'];
				$val['RefundAccountName'] 	= $value['RefundAccountName'];

				$val['RefundAccountNo'] 	= $value['RefundAccountNo'];
				$val['RefundBankCity'] 		= $value['RefundBankCity'];
				$val['ProvinceName'] 		= $value['ProvinceName'];
				$val['CityName'] 			= $value['CityName'];
				$val['RefundBankSubBranchSysNo'] = $value['RefundBankSubBranchSysNo'];

				$val['AccounterTelephone'] 	= $value['AccounterTelephone'];
				$val['AccounterMobilephone']= $value['AccounterMobilephone'];
				$val['PickupMan'] 			= $value['PickupMan'];
				$val['PickupTelephone'] 	= $value['PickupTelephone'];
				$val['PickupMobilephone'] 	= $value['PickupMobilephone'];

				$val['PickupAreaSysNo'] 	= $value['PickupAreaSysNo'];
				@$val['PickupAddress'] =  ($_Province[$_District[$value['PickupAreaSysNo']]['province_id']] . $_City[$_District[$value['PickupAreaSysNo']]['city_id']]['name'] . $_District[$value['PickupAreaSysNo']]['name'] . $value['PickupAddress']);
				//$val['PickupAddress'] 		= $value['PickupAddress'];
				$val['PickupZip'] 			= $value['PickupZip'];
				$val['PickupType'] 			= $value['PickupType'];
				$val['ETakeDate'] 			= $value['ETakeDate'];

				$val['ETakeTimeSpan'] 		= $value['ETakeTimeSpan'];
				$val['DoorGetFee'] 			= $value['DoorGetFee'];
				$val['IsRevertAddress'] 	= $value['IsRevertAddress'];
				$val['RevertContact'] 		= $value['RevertContact'];
				$val['RevertTelephone'] 	= $value['RevertTelephone'];

				$val['RevertMobilephone'] 	= $value['RevertMobilephone'];
				$val['RevertAreaSysNo'] 	= $value['RevertAreaSysNo'];
				@$val['RevertAddress'] =  ($_Province[$_District[$value['RevertAreaSysNo']]['province_id']] . $_City[$_District[$value['RevertAreaSysNo']]['city_id']]['name'] . $_District[$value['RevertAreaSysNo']]['name'] . $value['RevertAddress']);
				//$val['RevertAddress'] 		= $value['RevertAddress'];
				$val['RevertZip'] 			= $value['RevertZip'];
				$val['RequestAmt'] 			= $value['RequestAmt'];

				$val['RequestPoint'] 		= $value['RequestPoint'];
				$val['RequestDate'] 		= $value['RequestDate'];
				$val['rowCreateDate'] 		= $value['rowCreateDate'];
				$val['rowModifyDate'] 		= $value['rowModifyDate'];
				$val['Status'] 				= $value['Status'];

				$data_item = IRMARequestItemTTC::get($rma_CustomerRequestID,array('RequestFormType'=>1),array('SysNo','RequestSysNo',
												'RegistSysNo','ProductSysNo'));
				if(false === $data_item){
					self::$errCode = IRMARequestItemTTC::$errCode;
					self::$errMsg = IRMARequestItemTTC::$errMsg;
					Logger::err("IRMARequestItemTTC get failed" . " errMsg: " .IRMARequestItemTTC::$errMsg ." errCode: " .IRMARequestItemTTC::$errCode);
					return false;
				}else if(!empty($data_item) && count($data_item) > 0){
					foreach($data_item as &$item_value){
						$val_item = array();
						$val_item['I_SysNo'] 			= $item_value['SysNo'];
						$val_item['I_RequestSysNo'] 	= $item_value['RequestSysNo'];
						$val_item['I_RegistSysNo'] 		= $item_value['RegistSysNo'];
						$val_item['I_ProductSysNo'] 	= $item_value['ProductSysNo'];
						$val['Iproducts'][] 			= $val_item;
					}
				}else{
					$val['Iproducts'] = array();
				}
				$last_data[] = $val;
			}
		}
		return $last_data;
	}

	//售前退款申请--取消操作
	public static function cancel_refund($uid, $refund_sysno){
		$newRecord = array(
			'CustomerSysNo' => $uid,
			'Status' => -1,
			'rowModifyDate' => date('Y-m-d H:i:s', time()),
		);
		$ret = IRMARequestTTC::update($newRecord, array('SysNo'=>$refund_sysno, 'RequestFormType'=>1,'CustomerSysNo' => $uid));
		if(false === $ret){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC update" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}

		return true;
	}

	//售前退款检查属性值
	private static function checkRefundInfo($refund_info){
		if(!isset($refund_info)){
			self::$errCode = 1;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'refund_info is null';
			return false;
		}

		if(!isset($refund_info['order_id']) || $refund_info['order_id'] <= 0){
			self::$errCode = 2;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'order_id is invalid';
			return false;
		}

		if(!isset($refund_info['user_id']) || $refund_info['user_id'] <= 0){
			self::$errCode = 3;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'user_id is invalid';
			return false;
		}

		if(!isset($refund_info['product_ids']) || count($refund_info['product_ids']) == 0){
			self::$errCode = 4;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'product_ids is invalid';
			return false;
		}

		if(!isset($refund_info['refund_type']) || $refund_info['refund_type'] <= 0){
			self::$errCode = 5;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'refund_type is invalid';
			return false;
		}

		if($refund_info['refund_type'] == 2){//退款至银行卡
			if(!isset($refund_info['sel_online_pay']) || $refund_info['sel_online_pay'] <= 0){
				self::$errCode = 6;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'sel_online_pay is invalid';
				return false;
			}

			if(!isset($refund_info['area_id']) || $refund_info['area_id'] <= 0){
				self::$errCode = 7;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'area_id is invalid';
				return false;
			}

			if(!isset($refund_info['refund_bank'])){
				self::$errCode = 8;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'refund_bank is invalid';
				return false;
			}

			if(!isset($refund_info['account_name'])){
				self::$errCode = 9;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'account_name is invalid';
				return false;
			}

			if(!isset($refund_info['account_no']) || $refund_info['account_no'] <= 0){
				self::$errCode = 10;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'account_no is invalid';
				return false;
			}

			if(!isset($refund_info['mobile_phone']) || $refund_info['mobile_phone'] <= 0){
				self::$errCode = 11;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'mobile_phone is invalid';
				return false;
			}
		}

		if(isset($refund_info['pay_type']) && $refund_info['pay_type'] == 15){//退款至联华OK卡
			if(!isset($refund_info['lianhua_ok_id']) || $refund_info['lianhua_ok_id'] <= 0){
				self::$errCode = 12;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'mobile_phone is invalid';
				return false;
			}
		}

		if(isset($refund_info['pay_type']) && $refund_info['pay_type'] == 32){//退款至一城卡
			if(!isset($refund_info['yicheng_id']) || $refund_info['yicheng_id'] <= 0){
				self::$errCode = 13;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'yicheng_id is invalid';
				return false;
			}
		}
		return true;
	}

	//售后退款申请
	public static function addRequest($request_info, $wid){
		$check = IRMANew::checkRequestInfo($request_info);
		if(false === $check){
			return false;
		}

		$new_id = IIdGenerator::getNewId('rma_request_sequence');
		if(false === $new_id || $new_id <= 0){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}

		//RMA_Request_Receive表SysNo
		$ReceiveSysNo = IIdGenerator::getNewId('rma_request_receive_sequence');
		if(false === $ReceiveSysNo || $ReceiveSysNo <= 0){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}

		//RMA_Request_Revert表SysNo
		$RevertSysNo = IIdGenerator::getNewId('rma_request_revert_sequence');
		if(false === $RevertSysNo || $RevertSysNo <= 0){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}

		//RMA_Request_Refund表SysNo
		$RefundSysNo = IIdGenerator::getNewId('rma_request_refund_sequence');
		if(false === $RefundSysNo || $RefundSysNo <= 0){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}

		$order_id = intval(substr($request_info['order_id'], -8));
		$new_request_id = sprintf("%s%09d", "U", $new_id);

		$new_request = array();
		$new_request['SysNo']			= $new_id;
		$new_request['RequestSysNo']	= $new_request_id;
		$new_request['SOSysNo']			= $order_id;
		$new_request['SOID']			= $request_info['order_id'];
		$new_request['SoPayTypeSysNo']	= $request_info['pay_type'];//订单支付方式
		$new_request['RequestFormType']	= 2;//申请单类型-->售前申请单:1,售后申请单:2
		$new_request['CustomerSysNo']	= $request_info['user_id'];
		$new_request['Whid']			= $wid;
		$new_request['RequestReason']	= ToolUtil::transXSSContent($request_info['reason']);//申请原因
		$new_request['ProductDesc']		= ToolUtil::transXSSContent($request_info['description']);
		$new_request['RequestType']		= $request_info['request_type'];//期望处理方式:报修,换货,退货
		$new_request['Status']			= 0;
		$new_request['Source']			= 1;//申请单来源 0:内部员工创建	1:易迅网客户申请	  2:QQ网购客户申请
		$new_request['ReceiveSysNo']	= $ReceiveSysNo;//RMA_Request_Receive表SysNo
		$new_request['RevertSysNo']		= $RevertSysNo;//RMA_Request_Revert表SysNo
		$new_request['RefundSysNo']		= $RefundSysNo;//RMA_Request_Refund表SysNo
		$new_request['PicUrls']			= $request_info['pictures'];
		//取货信息
		$new_request['PickupMan']			= ToolUtil::transXSSContent($request_info['contact_info']['contact']);
		$new_request['PickupMobilephone']	= ToolUtil::transXSSContent($request_info['contact_info']['cellphone']);
		$new_request['PickupTelephone']		= ToolUtil::transXSSContent($request_info['contact_info']['phone']);
		$new_request['PickupAreaSysNo']		= $request_info['contact_info']['area_id'];
		$new_request['PickupAddress']		= ToolUtil::transXSSContent($request_info['contact_info']['address']);
		$new_request['PickupZip']			= ToolUtil::transXSSContent($request_info['contact_info']['zip']);
		$new_request['PickupType']			= $request_info['contact_info']['fetchgoods_way'];//取货方式:上门取货,邮寄,送修
		if(1 == $request_info['contact_info']['fetchgoods_way'] || 7 == $request_info['contact_info']['fetchgoods_way']){//易迅快递上门取货
			$new_request['ETakeDate']		= $request_info['contact_info']['etake_date'];
			$new_request['ETakeTimeSpan']	= $request_info['contact_info']['etake_time_span'];
			$new_request['DoorGetFee']		= $request_info['contact_info']['door_get_fee'];
		}
		//收货信息
		$new_request['IsRevertAddress']		= $request_info['is_revert_address'];//是否与收货地区相同
		if(0 == $request_info['is_revert_address']){//自定义收货信息
			$new_request['RevertContact']		= ToolUtil::transXSSContent($request_info['revert_contact_info']['contact']);
			$new_request['RevertMobilephone']	= ToolUtil::transXSSContent($request_info['revert_contact_info']['mobile']);
			$new_request['RevertTelephone']		= ToolUtil::transXSSContent($request_info['revert_contact_info']['phone']);
			$new_request['RevertAreaSysNo']		= ToolUtil::transXSSContent($request_info['revert_contact_info']['area_id']);
			$new_request['RevertAddress']		= ToolUtil::transXSSContent($request_info['revert_contact_info']['address']);
			$new_request['RevertZip']			= ToolUtil::transXSSContent($request_info['revert_contact_info']['zip']);
		}else{//与取货地址相同时 把取货信息写入收货信息
			$new_request['RevertContact']		= ToolUtil::transXSSContent($request_info['contact_info']['contact']);
			$new_request['RevertMobilephone']	= ToolUtil::transXSSContent($request_info['contact_info']['cellphone']);
			$new_request['RevertTelephone']		= ToolUtil::transXSSContent($request_info['contact_info']['phone']);
			$new_request['RevertAreaSysNo']		= ToolUtil::transXSSContent($request_info['contact_info']['area_id']);
			$new_request['RevertAddress']		= ToolUtil::transXSSContent($request_info['contact_info']['address']);
			$new_request['RevertZip']			= ToolUtil::transXSSContent($request_info['contact_info']['zip']);
		}

		$new_request['RequestDate']		= date('Y-m-d H:i:s', time());
		$new_request['rowCreateDate']	= date('Y-m-d H:i:s', time());
		$new_request['rowModifyDate']	= date('Y-m-d H:i:s', time());

		if(3 == $request_info['request_type']){//选择退货(退款)
			$new_request['RefundTypeSysNo']	= $request_info['refund_type'];//退款方式
			if(2 == $request_info['refund_type']){//退款至银行卡
				$new_request['RefundBank']					= $request_info['sel_online_pay'];
				$new_request['RefundBankCity']				= $request_info['area_id_bank'];
				$new_request['RefundBankSubBranchSysNo']	= intval($request_info['refund_bank']);
				$new_request['RefundAccountName']			= ToolUtil::transXSSContent($request_info['account_name']);
				$new_request['RefundAccountNo']				= ToolUtil::transXSSContent($request_info['account_no']);
				$new_request['AccounterMobilephone']		= ToolUtil::transXSSContent( $request_info['mobile_phone_bank']);
				$new_request['ProvinceName']				= ToolUtil::transXSSContent($request_info['bank_cityName']);//开户城市
				$new_request['CityName']					= ToolUtil::transXSSContent($request_info['refund_bankName']);//支行名称
			}else{
				if(isset($request_info['pay_type']) && !empty($request_info['pay_type'])){
					$refund_payType = $request_info['pay_type'];//支付方式
					if($refund_payType == 15){//退款至联华OK卡
						$new_request['RefundAccountNo']	= ToolUtil::transXSSContent($request_info['lianhua_ok_id']);
					}
					if($refund_payType == 32){//退款至一城卡
						$new_request['RefundAccountNo']	= ToolUtil::transXSSContent($request_info['yicheng_id']);
					}
				}
			}
		}

		//申请单主表
		$ret = IRMARequestTTC::insert($new_request);
		if(false === $ret){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC insert" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}

		$new_request_item = array();
		foreach($request_info['product_ids'] AS $product_id => $product_count){
			$new_id_item = IIdGenerator::getNewId('rma_request_item_sequence');
			if(false === $new_id_item || $new_id_item <= 0){
				self::$errCode = IIdGenerator::$errCode;
				self::$errMsg = IIdGenerator::$errMsg;
				return  false;
			}

			$new_id_reg = IIdGenerator::getNewId('rma_register_sequence');
			if(false === $new_id_reg || $new_id_reg <= 0){
				self::$errCode = IIdGenerator::$errCode;
				self::$errMsg = IIdGenerator::$errMsg;
				return  false;
			}

			$new_request_item['SysNo']				= $new_id_item;
			$new_request_item['RequestSysNo']		= $new_id;
			$new_request_item['RegistSysNo']		= $new_id_reg;//RMA_Registr表SysNo
			$new_request_item['ProductSysNo'] 		= $product_id;
			$new_request_item['RequestNum'] 		= $product_count;
			$new_request_item['RequestFormType'] 	= 2;
			$new_request_item['Whid'] 				= $wid;
			$new_request_item['Status'] 			= 0;
			$new_request_item['rowCreateDate']		= date('Y-m-d H:i:s', time());
			$new_request_item['rowModifyDate']		= date('Y-m-d H:i:s', time());
			$new_request_item['UserDays']			= $request_info['useDays'];//用户使用天数
			//$new_request_item['Source']				= 1;//来源 0:内部员工创建	1:易迅网客户申请	  2:QQ网购客户申请
			//申请单子表
			$ret_item = IRMARequestItemTTC::insert($new_request_item);
			if(false === $ret_item){
				self::$errCode = IRMARequestItemTTC::$errCode;
				self::$errMsg = IRMARequestItemTTC::$errMsg;
				Logger::err("IRMARequestItemTTC insert" . " errMsg: " .IRMARequestItemTTC::$errMsg ." errCode: " .IRMARequestItemTTC::$errCode);
				return false;
			}

			/*$new_register = array();
			$new_register['SysNo']				= $new_id_reg;
			$new_register['RequestSysNo']		= $new_id;
			$new_register['ProductSysNo'] 		= $product_id;
			$new_register['RequestType']		= $request_info['request_type'];
			$new_register['CustomerSysNo'] 		= $request_info['user_id'];;
			$new_register['Whid'] 				= $wid;
			$new_register['Status'] 			= 0;
			$new_register['rowCreateDate']		= date('Y-m-d H:i:s', time());
			$new_register['rowModifyDate']		= date('Y-m-d H:i:s', time());
			$new_register['RequestFormType']	= 2;//售前处理单:1,售后处理单:2.
			$new_register['RefundStatus']		= ($request_info['request_type'] == 3) ? 0 : -999999;//退款状态
			//处理单主表
			$ret_item = IRMARegisterTTC::insert($new_register);
			if(false === $ret_item){
				self::$errCode = IRMARegisterTTC::$errCode;
				self::$errMsg = IRMARegisterTTC::$errMsg;
				Logger::err("IRMARegisterTTC insert" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
				return false;
			}*/
		}
		return true;
	}

	//售后退款 报修申请查询
	public static function getRmaApplies($uid, $wid, $pageSize, $page){
		$total = IRMARequestTTC::get($uid, array('RequestFormType'=>2), array('SysNo', 'Source'));
		if (false === $total) {
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC get failed" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}

		$filter_source = array(0, 1);
		if (count($total) == 0) {
			return array('total'=>0, 'data'=>array());
		}else{
			foreach($total as $t){
				if(in_array($t['Source'], $filter_source) == false){
					unset($total);
				}
			}
			$total = count($total);
			if($total <= 0 ){
				return array('total'=>0, 'data'=>array());
			}
		}

		$last_data = array();
		$data = IRMARequestTTC::get($uid, array('RequestFormType'=>2),
										  array('SysNo', 'RequestSysNo', 'SOSysNo', 'SOID','RequestAmt',
												'RequestPoint','RefundTypeSysNo','Status','RequestDate', 'Source'),
									$pageSize , $page*$pageSize);
		if(false === $data){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC get failed" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}

		if(!empty($data) && count($data) > 0){
			foreach($data as &$value){
				if(in_array($value['Source'], $filter_source) == false){
					unset($data);
				}

				$val = array();
				$val['SysNo'] 			= $value['SysNo'];
				$val['RequestSysNo'] 	= $value['RequestSysNo'];
				$val['SOSysNo'] 		= $value['SOSysNo'];
				$val['SOID'] 			= $value['SOID'];
				$val['RequestAmt'] 		= $value['RequestAmt'];
				$val['RequestPoint'] 	= $value['RequestPoint'];
				$val['RefundTypeSysNo'] = $value['RefundTypeSysNo'];
				$val['Status'] 			= $value['Status'];
				$val['RequestDate'] 	= $value['RequestDate'];
				$val['Source'] 			= $value['Source'];

				$data_item = IRMARequestItemTTC::get($value['SysNo'],array('RequestFormType'=>2),array('SysNo','RequestSysNo',
												'RegistSysNo','ProductSysNo'));
				if(false === $data_item){
					self::$errCode = IRMARequestItemTTC::$errCode;
					self::$errMsg = IRMARequestItemTTC::$errMsg;
					Logger::err("IRMARequestItemTTC get failed" . " errMsg: " .IRMARequestItemTTC::$errMsg ." errCode: " .IRMARequestItemTTC::$errCode);
					return false;
				}else if(!empty($data_item) && count($data_item) > 0){
					foreach($data_item as &$item_value){
						$val_item = array();
						$val_item['I_SysNo'] 			= $item_value['SysNo'];
						$val_item['I_RequestSysNo'] 	= $item_value['RequestSysNo'];
						$val_item['I_RegistSysNo'] 		= $item_value['RegistSysNo'];
						$val_item['I_ProductSysNo'] 	= $item_value['ProductSysNo'];
						$val['Iproducts'][] 			= $val_item;
					}
				}else{
					$val['Iproducts'] = array();
				}

				//留言模块
				$data_note = IRMACustomerRequestNoteTTC::get($value['SysNo'], array(),array('SysNo','CustomerRequestSysNo',
												'Content','Type','Status','CreateUserSysNo','CreateDate'));
				if(false === $data_note){
					self::$errCode = IRMACustomerRequestNoteTTC::$errCode;
					self::$errMsg = IRMACustomerRequestNoteTTC::$errMsg;
					Logger::err("IRMACustomerRequestNoteTTC get failed" . " errMsg: " .IRMACustomerRequestNoteTTC::$errMsg ." errCode: " .IRMACustomerRequestNoteTTC::$errCode);
					return false;
				}else if(!empty($data_note) && count($data_note) > 0){
					foreach($data_note as &$note_value){
						$val_note = array();
						$val_note['N_SysNo'] 					= $note_value['SysNo'];
						$val_note['N_CustomerRequestSysNo'] 	= $note_value['CustomerRequestSysNo'];
						$val_note['N_Content'] 					= ToolUtil::transXSSContent($note_value['Content']);
						$val_note['N_Type'] 					= $note_value['Type'];
						$val_note['N_CreateUserSysNo'] 			= $note_value['CreateUserSysNo'];
						$val_note['N_CreateDate'] 				= $note_value['CreateDate'];
						$val['Nnotes'][] 						= $val_note;
					}
				}else{
					$val['Nnotes'] = array();
				}

				$last_data[] = $val;
			}
		}

		if(count($data) == 0){
			return array('total'=>$total, 'data'=>array());
		}
		return array('total'=>$total, 'data'=>$last_data);

	}


	//处理情况查询log TTC查询
	public static function getRmaRegisterLog($uid, $wid, $registerSysno){
		global $_myrepairLogState;
		if(empty($registerSysno)){
			return false;
		}

		$empty_data = IRMARegisterTTC::get($uid, array('SysNo'=>$registerSysno), array('rowCreateDate', 'SysNo', 'RequestSysNo'));
		if(false === $empty_data){
			self::$errCode = IRMARegisterTTC::$errCode;
			self::$errMsg = IRMARegisterTTC::$errMsg;
			Logger::err("IRMARegisterTTC get failed" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
			return false;
		}

		$empty_date = '';
		if(!empty($empty_data)){
			foreach($empty_data as $val){
				$empty_date = $val['rowCreateDate'];
			}
		}
		$data = IRMARegisterLogTTC::get($registerSysno, array(),
										  array('RegisterSysNo', 'SysNo', 'RequestSysNo', 'Whid','SOID','Status',
												'Description','CreateDate','rowCreateDate'));
		if(false === $data){
			self::$errCode = IRMARegisterLogTTC::$errCode;
			self::$errMsg = IRMARegisterLogTTC::$errMsg;
			Logger::err("IRMARegisterLogTTC get failed" . " errMsg: " .IRMARegisterLogTTC::$errMsg ." errCode: " .IRMARegisterLogTTC::$errCode);
			return false;
		}
		if(empty($data)){
			self::$errCode = 1;
			self::$errMsg = 'get IRMARegisterLogTTC 记录为空';
			$logs[] = array(
				'time' => $empty_date,
				'content' => '待审核',
			);
		}else{
			$data = array_reverse($data,true);
			foreach($data as &$value){
				$logs[] = array(
					'time' => $value['rowCreateDate'],
					'content' => ToolUtil::transXSSContent($value['Description']),
				);
			}
		}
		return $logs;
	}

	//获取处理查询最终状态   TTC查询
	public static function getRmaReqestStatus_Last($wid, $registerSysno){
		global $_myrepairLogState;
		$des_status = '待审核';
		if(empty($registerSysno)){
			return false;
		}
		$data = IRMARegisterLogTTC::get($registerSysno, array(),
										  array('RegisterSysNo', 'SysNo', 'RequestSysNo', 'Whid','SOID','Status',
												'Description','CreateDate','rowCreateDate'));
		if(false === $data){
			self::$errCode = IRMARegisterLogTTC::$errCode;
			self::$errMsg = IRMARegisterLogTTC::$errMsg;
			Logger::err("IRMARegisterLogTTC get failed" . " errMsg: " .IRMARegisterLogTTC::$errMsg ." errCode: " .IRMARegisterLogTTC::$errCode);
			return false;
		}
		if(empty($data)){
			self::$errCode = 1002;
			self::$errMsg = 'get IRMARegisterLogTTC 记录为空';
			return $des_status;
		}
		//处理状态
		$status = 0;
		$data = array_reverse($data,true);
		foreach($data as $rs){
			$status = $rs['Status'];
			$des_status = isset($_myrepairLogState[$status]) ? $_myrepairLogState[$status] : '';
		}
		return $des_status;
	}


	/**
	 * 售后退款 产看详情
	 * @param int $uid 用户ID
	 * @param int $rma_CustomerRequestID 申请单系统编号
	 * @return 错误返回:false, 正确:返回array()
	 */
	public static function getCustomerRequest_detail($uid, $rma_CustomerRequestID){
		$last_data = array();
		//申请单填写信息
		$data = IRMARequestTTC::get($uid, array('SysNo'=>$rma_CustomerRequestID,'RequestFormType'=>2),
										  array('CustomerSysNo', 'RequestSysNo', 'SOSysNo', 'SOID','SoPayTypeSysNo',
												'RequestFormType','SysNo','StockSysNo','Whid','RequestReason',
												'ProductDesc','RequestType','RefundTypeSysNo','RefundBank','RefundAccountName',
												'RefundAccountNo','RefundBankCity','ProvinceName','CityName','RefundBankSubBranchSysNo',
												'AccounterTelephone','AccounterMobilephone','PickupMan','PickupTelephone','PickupMobilephone',
												'PickupAreaSysNo','PickupAddress','PickupZip','PickupType','ETakeDate',
												'ETakeTimeSpan','DoorGetFee','IsRevertAddress','RevertContact','RevertTelephone',
												'RevertMobilephone','RevertAreaSysNo','RevertAddress','RevertZip','RequestAmt',
												'RequestPoint','RequestDate','rowCreateDate','rowModifyDate','Status'));

		if(false === $data){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC get failed" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}

		global $_District, $_Province, $_City;
		if(!empty($data) && count($data) > 0){
			foreach($data as &$value){
				$val = array();
				$val['CustomerSysNo'] 		= $value['CustomerSysNo'];
				$val['RequestSysNo'] 		= $value['RequestSysNo'];
				$val['SOSysNo'] 			= $value['SOSysNo'];
				$val['SOID'] 				= $value['SOID'];
				$val['SoPayTypeSysNo'] 		= $value['SoPayTypeSysNo'];

				$val['RequestFormType'] 	= $value['RequestFormType'];
				$val['SysNo'] 				= $value['SysNo'];
				$val['StockSysNo'] 			= $value['StockSysNo'];
				$val['Whid'] 				= $value['Whid'];
				$val['RequestReason'] 		= $value['RequestReason'];

				$val['ProductDesc'] 		= ToolUtil::transXSSContent($value['ProductDesc']);
				$val['RequestType'] 		= $value['RequestType'];
				$val['RefundTypeSysNo'] 	= $value['RefundTypeSysNo'];
				$val['RefundBank'] 			= ToolUtil::transXSSContent($value['RefundBank']);
				$val['RefundAccountName'] 	= ToolUtil::transXSSContent($value['RefundAccountName']);

				$val['RefundAccountNo'] 	= ToolUtil::transXSSContent($value['RefundAccountNo']);
				$val['RefundBankCity'] 		= ToolUtil::transXSSContent($value['RefundBankCity']);
				$val['ProvinceName'] 		= ToolUtil::transXSSContent($value['ProvinceName']);
				$val['CityName'] 			= ToolUtil::transXSSContent($value['CityName']);
				$val['RefundBankSubBranchSysNo'] = ToolUtil::transXSSContent($value['RefundBankSubBranchSysNo']);

				$val['AccounterTelephone'] 	= ToolUtil::transXSSContent($value['AccounterTelephone']);
				$val['AccounterMobilephone']= ToolUtil::transXSSContent($value['AccounterMobilephone']);
				$val['PickupMan'] 			= ToolUtil::transXSSContent($value['PickupMan']);
				$val['PickupTelephone'] 	= ToolUtil::transXSSContent($value['PickupTelephone']);
				$val['PickupMobilephone'] 	= ToolUtil::transXSSContent($value['PickupMobilephone']);

				$val['PickupAreaSysNo'] 	= ToolUtil::transXSSContent($value['PickupAreaSysNo']);
				//$val['PickupAddress'] 		= $value['PickupAddress'];
				@$val['PickupAddress'] =  ($_Province[$_District[$value['PickupAreaSysNo']]['province_id']] . $_City[$_District[$value['PickupAreaSysNo']]['city_id']]['name'] . $_District[$value['PickupAreaSysNo']]['name'] . $value['PickupAddress']);
				$val['PickupZip'] 			= ToolUtil::transXSSContent($value['PickupZip']);
				$val['PickupType'] 			= $value['PickupType'];
				$val['ETakeDate'] 			= $value['ETakeDate'];

				$val['ETakeTimeSpan'] 		= $value['ETakeTimeSpan'];
				$val['DoorGetFee'] 			= $value['DoorGetFee'];
				$val['IsRevertAddress'] 	= $value['IsRevertAddress'];
				$val['RevertContact'] 		= ToolUtil::transXSSContent($value['RevertContact']);
				$val['RevertTelephone'] 	= ToolUtil::transXSSContent($value['RevertTelephone']);

				$val['RevertMobilephone'] 	= ToolUtil::transXSSContent($value['RevertMobilephone']);
				$val['RevertAreaSysNo'] 	= ToolUtil::transXSSContent($value['RevertAreaSysNo']);
				//$val['RevertAddress'] 		= $value['RevertAddress'];
				@$val['RevertAddress'] =  ($_Province[$_District[$value['RevertAreaSysNo']]['province_id']] . $_City[$_District[$value['RevertAreaSysNo']]['city_id']]['name'] . $_District[$value['RevertAreaSysNo']]['name'] . $value['RevertAddress']);
				$val['RevertZip'] 			= ToolUtil::transXSSContent($value['RevertZip']);
				$val['RequestAmt'] 			= $value['RequestAmt'];

				$val['RequestPoint'] 		= $value['RequestPoint'];
				$val['RequestDate'] 		= $value['RequestDate'];
				$val['rowCreateDate'] 		= $value['rowCreateDate'];
				$val['rowModifyDate'] 		= $value['rowModifyDate'];
				$val['Status'] 				= $value['Status'];

				//申请单处理信息
				$data_reg = IRMARegisterTTC::get($uid,array('RequestSysNo'=>$rma_CustomerRequestID,'RequestFormType'=>2),array('CustomerSysNo','RequestSysNo','ProductSysNo',
												'RequestType','SysNo','Whid','RequestAmt','RequestPoint','Status','rowCreateDate','rowModifyDate'));
				if(false === $data_reg){
					self::$errCode = IRMARegisterLogTTC::$errCode;
					self::$errMsg = IRMARegisterLogTTC::$errMsg;
					Logger::err("IRMARegisterLogTTC get failed" . " errMsg: " .IRMARegisterLogTTC::$errMsg ." errCode: " .IRMARegisterLogTTC::$errCode);
					//return false;//忽略错误
				}else if(!empty($data_reg) && count($data_reg) > 0){
					foreach($data_reg as &$reg_value){
						$val_item = array();
						$val_item['R_RequestAmt'] 		= $reg_value['RequestAmt'];
						$val_item['R_RequestPoint'] 	= $reg_value['RequestPoint'];
						$val_item['R_ProductSysNo'] 	= $reg_value['ProductSysNo'];
						$val['Register'][] 				= $val_item;
					}
				}else{
					$data_item = IRMARequestItemTTC::get($rma_CustomerRequestID,array('RequestFormType'=>2),array('SysNo','RequestSysNo',
												'RegistSysNo','ProductSysNo'));
					if(false === $data_item){
						self::$errCode = IRMARequestItemTTC::$errCode;
						self::$errMsg = IRMARequestItemTTC::$errMsg;
						Logger::err("IRMARequestItemTTC get failed" . " errMsg: " .IRMARequestItemTTC::$errMsg ." errCode: " .IRMARequestItemTTC::$errCode);
					}else if(!empty($data_item) && is_array($data_item)){
						foreach($data_item as &$item_value){
							$val_item = array();
							$val_item['R_RequestAmt'] 		= 0;
							$val_item['R_RequestPoint'] 	= 0;
							$val_item['R_ProductSysNo'] 	= $item_value['ProductSysNo'];
							$val['Register'][] 				= $val_item;
						}
					}else{
						$val['Register'] = array();
					}
				}
				$last_data[] = $val;
			}
		}

		return $last_data;
	}

	//售后留言查询(新增后重新异步拉取时调用)
	public static function getRmaNotes($rma_id, $wid){
		/*$data =IRMACustomerRequestNoteTTC::get($rma_id, array(), array('CustomerRequestSysNo','SysNo','Whid','Content','Type',
															'Status','CreateUserSysNo','CreateDate','rowCreateDate','rowModifyDate'));*/
		$data =IRMACustomerRequestNoteTTC::get($rma_id, array(), array('Content','Type', 'CreateDate'));
		if(false === $data){
			self::$errCode = IRMACustomerRequestNoteTTC::$errCode;
			self::$errMsg = IRMACustomerRequestNoteTTC::$errMsg;
			Logger::err("IRMACustomerRequestNoteTTC get failed" . " errMsg: " .IRMACustomerRequestNoteTTC::$errMsg ." errCode: " .IRMACustomerRequestNoteTTC::$errCode);
			return false;
		}

		if(count($data) == 0){
			return array();
		}

		return $data;
	}

	//售后留言添加
	public static function addRmaComments($uid, $whid, $rma_comments){
		$check = self::checkRmaComments($rma_comments);
		if(false === $check){
			return false;
		}

		$new_id = IIdGenerator::getNewId('RMA_CustomerRequestNote_Sequence');
		if(false == $new_id || $new_id <= 0){
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}

		$new_note = array();
		$new_note['CustomerRequestSysNo']	= $rma_comments['rma_id'];
		$new_note['SysNo']	= $new_id;
		$new_note['Whid']	= $whid;
		$new_note['Content']	=  iconv("UTF-8", "GB2312//IGNORE", $rma_comments['comments']);
		$new_note['Type']	= 1;
		$new_note['Status']	= 0;
		$new_note['CreateUserSysNo'] = $uid;
		$new_note['CreateDate']	= date('Y-m-d H:i:s', time());
		$new_note['rowCreateDate']	= date('Y-m-d H:i:s', time());
		$new_note['rowModifyDate']	= date('Y-m-d H:i:s', time());

		$ret_note = IRMACustomerRequestNoteTTC::insert($new_note);
		if(false === $ret_note){
			self::$errCode = IRMACustomerRequestNoteTTC::$errCode;
			self::$errMsg = IRMACustomerRequestNoteTTC::$errMsg;
			Logger::err("IRMACustomerRequestNoteTTC insert" . " errMsg: " .IRMACustomerRequestNoteTTC::$errMsg ." errCode: " .IRMACustomerRequestNoteTTC::$errCode);
			return false;
		}

		return true;
	}

	//添加留言属性检查
	private static function checkRmaComments($rma_comments_){
		if(!isset($rma_comments_)){
			self::$errCode = 1;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'rma comments is null';
		}

		if(!isset($rma_comments_['rma_id']) || $rma_comments_['rma_id'] <= 0){
			self::$errCode = 2;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'rma id is invalid';
		}

		if(!isset($rma_comments_['user_id']) || $rma_comments_['user_id'] <= 0){
			self::$errCode = 3;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'user_id is invalid';
		}

		if(!isset($rma_comments_['comments'])){
			self::$errCode = 4;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'comments is invalid';
		}
	}

	//售后退款检查属性值
	private static function checkRequestInfo($request_info){
		if(!isset($request_info)){
			self::$errCode = 1;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'request_info is null';
			return false;
		}

		if(!isset($request_info['order_id']) || $request_info['order_id'] <= 0){
			self::$errCode = 2;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'order id is invalid';
			return false;
		}

		if(!isset($request_info['user_id']) || $request_info['user_id'] <= 0){
			self::$errCode = 3;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'user id is invalid';
			return false;
		}

		if(!isset($request_info['description'])){
			self::$errCode = 4;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'description is invalid';
			return false;
		}

		if(!isset($request_info['product_ids']) || count($request_info['product_ids']) == 0){
			self::$errCode = 5;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'product_ids id is invalid';
			return false;
		}

		if(!isset($request_info['contact_info']) || count($request_info['contact_info']) == 0){
			self::$errCode = 6;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'contact_info id is invalid';
			return false;
		}

		if(!isset($request_info['contact_info']['address'])){
			self::$errCode = 7;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'address id is invalid';
			return false;
		}

		if(!isset($request_info['contact_info']['area_id']) || $request_info['contact_info']['area_id'] <= 0){
			self::$errCode = 8;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'area_id id is invalid';
			return false;
		}

		if(!isset($request_info['contact_info']['zip'])){
			self::$errCode = 9;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'zip id is invalid';
			return false;
		}

		if(!isset($request_info['contact_info']['contact'])){
			self::$errCode = 10;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'contact id is invalid';
			return false;
		}

		if(!isset($request_info['contact_info']['phone'])){
			self::$errCode = 11;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'phone id is invalid';
			return false;
		}

		if(!isset($request_info['is_revert_address']) || $request_info['is_revert_address'] < 0 || $request_info['is_revert_address'] > 1){
			self::$errCode = 12;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'is_revert_address id is invalid';
			return false;
		}

		if (0 == $request_info['is_revert_address']){//自定义收货信息
			if(!isset($request_info['revert_contact_info']) || count($request_info['revert_contact_info']) == 0){
				self::$errCode = 13;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert contact info is invalid';
				return false;
			}

			if(!isset($request_info['revert_contact_info']['address'])){
				self::$errCode = 14;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert address is invalid';
				return false;
			}

			if(!isset($request_info['revert_contact_info']['area_id']) || $request_info['revert_contact_info']['area_id'] <= 0){
				self::$errCode = 15;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert area_id is invalid';
				return false;
			}

			if(!isset($request_info['revert_contact_info']['zip'])){
				self::$errCode = 16;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert zip is invalid';
				return false;
			}

			if(!isset($request_info['revert_contact_info']['contact'])){
				self::$errCode = 17;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert contact is invalid';
				return false;
			}

			if(!isset($request_info['revert_contact_info']['phone'])){
				self::$errCode = 18;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert phone is invalid';
				return false;
			}
		}

		//选择取货方式
		if(isset($request_info['fetchgoods_way']) && $request_info['fetchgoods_way'] == 3){//退货
			if(!isset($request_info['refund_type']) || $request_info['refund_type'] <= 0){
				self::$errCode = 19;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'refund_type is invalid';
				return false;
			}

			if($request_info['refund_type'] == 2){//退款至银行卡
				if(!isset($request_info['sel_online_pay']) || $request_info['sel_online_pay'] <= 0){
					self::$errCode = 20;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'sel_online_pay is invalid';
					return false;
				}

				if(!isset($request_info['area_id']) || $request_info['area_id'] <= 0){
					self::$errCode = 21;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'area_id is invalid';
					return false;
				}

				if(!isset($request_info['refund_bank'])){
					self::$errCode = 22;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'refund_bank is invalid';
					return false;
				}

				if(!isset($request_info['account_name'])){
					self::$errCode = 23;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'account_name is invalid';
					return false;
				}

				if(!isset($request_info['account_no']) || $request_info['account_no'] <= 0){
					self::$errCode = 24;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'account_no is invalid';
					return false;
				}

				if(!isset($request_info['mobile_phone']) || $request_info['mobile_phone'] <= 0){
					self::$errCode = 25;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'mobile_phone is invalid';
					return false;
				}
			}

			if(isset($request_info['pay_type']) && $request_info['pay_type'] == 15){//退款至联华OK卡
				if(!isset($request_info['lianhua_ok_id']) || $request_info['lianhua_ok_id'] <= 0){
					self::$errCode = 26;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'mobile_phone is invalid';
					return false;
				}
			}

			if(isset($request_info['pay_type']) && $request_info['pay_type'] == 32){//退款至一城卡
				if(!isset($request_info['yicheng_id']) || $request_info['yicheng_id'] <= 0){
					self::$errCode = 27;
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . 'yicheng_id is invalid';
					return false;
				}
			}
		}
	}

	//查询支行名称
	public static function getBas_banks($query_banks){
		$data = IBASBankSubBranchTTC::get($query_banks,array('Status' =>0),array('SysNo', 'BankSysNo', 'SubBranchID', 'SubBranchName', 'EBankID'));
		if(false === $data){
			self::$errCode = IBASBankSubBranchTTC::$errCode;
			self::$errMsg = IBASBankSubBranchTTC::$errMsg;
			Logger::err("IBASBankSubBranchTTC get failed" . " errMsg: " .IBASBankSubBranchTTC::$errMsg ." errCode: " .IBASBankSubBranchTTC::$errCode);
			return false;
		}

		if(!empty($data)){
			foreach($data as &$value){
				$val = array();
				$val['SysNo']			= $value['SysNo'];
				$val['BankSysNo'] 		= $value['BankSysNo'];
				$val['SubBranchID'] 	= $value['SubBranchID'];
				$val['SubBranchName'] 	= $value['SubBranchName'];
				$val['EBankID'] 		= $value['EBankID'];
			}
		}

		if(count($data) == 0){
			return array();
		}
		return $data;
	}

	//检查订单里的商品是否能够报修/退换货
	public static function getAvaliableOrderProducts($uid, $order_id, $product_ids, $wh_id,$type){
		if(!isset($order_id) || $order_id <= 0){
			self::$errCode = 1;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'order id is invalid';
			return false;
		}

		if(!isset($product_ids) || count($product_ids) === 0){
			self::$errCode = 2;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'product ids is invalid';
			return false;
		}

		$ret = array();
		foreach($product_ids AS $product_id){
			$ret[$product_id] = true;
		}

		$SOSysNo = intval(substr($order_id, -8));
		$ids_str = implode(",", $product_ids);
		$data = IRMARequestTTC::get($uid, array('SOSysNo'=>$SOSysNo),
									array('CustomerSysNo', 'RequestSysNo', 'SOSysNo', 'SOID','RequestFormType','SysNo','Status'));

		$rma_requestSysnos = array();
		$RequestStatus_array = array(0,1);
		if(false === $data){
			self::$errCode = IRMARequestTTC::$errCode;
			self::$errMsg = IRMARequestTTC::$errMsg;
			Logger::err("IRMARequestTTC get failed" . " errMsg: " .IRMARequestTTC::$errMsg ." errCode: " .IRMARequestTTC::$errCode);
			return false;
		}
		if(!empty($data)){
			foreach($data as $val){
				 $rma_requestSysnos[] = $val['SysNo'];
				 $data_item = IRMARequestItemTTC::get($val['SysNo'], array('Whid'=>$wh_id, 'RequestFormType'=>2),
				 													array('SysNo', 'RegistSysNo', 'ProductSysNo', 'Status'));
				if(false === $data_item){
					self::$errCode = IRMARequestItemTTC::$errCode;
					self::$errMsg = IRMARequestItemTTC::$errMsg;
					Logger::err("IRMARequestItemTTC get failed" . " errMsg: " .IRMARequestItemTTC::$errMsg ." errCode: " .IRMARequestItemTTC::$errCode);
					return false;
				}else if(!empty($data_item)){
					foreach($data_item as $item_val){
						if(in_array($val['Status'], $RequestStatus_array)
							&& $item_val['Status'] == 0
							&& in_array($item_val['ProductSysNo'], $product_ids)){
								$ret[$item_val['ProductSysNo']] = false;
						}
					}
				}
			}
		}

//, array('RefundStatus'=>array(0,1,2,3,4), 'ProductSysNo'=> array($ids_str), 'RequestSysNo'=>array($rma_requestSysnos)), array('ProductSysNo')
		$RefundStatus_array = array(0,1,2,3,4);
		$data_reg = IRMARegisterTTC::get($uid, array('Whid'=>$wh_id),array('RequestSysNo', 'RefundStatus', 'ProductSysNo', 'Status'));
		if(false === $data_reg){
			self::$errCode = IRMARegisterTTC::$errCode;
			self::$errMsg = IRMARegisterTTC::$errMsg;
			Logger::err("IRMARegisterTTC get failed" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
			return false;
		}else if(!empty($data_reg)){
			foreach($data_reg as $reg_val){
				if(in_array($reg_val['RequestSysNo'], $rma_requestSysnos)
					&& in_array($reg_val['RefundStatus'], $RefundStatus_array)
					&& in_array($reg_val['ProductSysNo'], $product_ids)){
						$ret[$reg_val['ProductSysNo']] = false;
				}
			}
		}

		//再判断是否能够报修
		if(2 == $type){//售后退款
			$Status = array(0,1,3);
			foreach($data_reg as $reg_val){
				if( $reg_val['RefundStatus'] == -999999
					&& in_array($reg_val['Status'], $Status)
					&& in_array($reg_val['ProductSysNo'], $product_ids)
					&& in_array($reg_val['RequestSysNo'], $rma_requestSysnos) ){//报修,换货处理单
						$ret[$reg_val['ProductSysNo']] = false;
				}
			}
		}

		return $ret;
	}


	/**
	 * 获取RMA单件日志流水信息
	 * add by allenzhou  新的流水日志接口,新建了一个TTC
	 * @param $uid 用户id
	 * @param $wid 分站id
	 * @param $req_sysno 申请单系统编号
	 * @param $regist_id 处理单单件号
	 * @return 错误返回:false, 成功返回:流水日志信息
	 */
	public static function getRmaFlowLog($uid, $wid, $req_sysno, $regist_id){
		if(empty($regist_id) || empty($req_sysno)){
			return false;
		}

		$empty_date = '';
		$empty_data = IRMARegisterTTC::get($uid, array('SysNo'=>$regist_id), array('rowCreateDate', 'SysNo', 'RequestSysNo'));
		if(false === $empty_data){
			self::$errCode = IRMARegisterTTC::$errCode;
			self::$errMsg = IRMARegisterTTC::$errMsg;
			Logger::err("IRMARegisterTTC get failed" . " errMsg: " .IRMARegisterTTC::$errMsg ." errCode: " .IRMARegisterTTC::$errCode);
		}

		if(!empty($empty_data)){
			foreach($empty_data as $val){
				$empty_date = $val['rowCreateDate'];
			}
		}

		$data = IRMACusLogTTC::get($req_sysno);
		if(false === $data){
			self::$errCode = IRMACusLogTTC::$errCode;
			self::$errMsg = IRMACusLogTTC::$errMsg;
			Logger::err("IRMACusLogTTC get failed" . " errMsg: " .IRMACusLogTTC::$errMsg ." errCode: " .IRMACusLogTTC::$errCode);
			return false;
		}

		if(empty($data)){
			self::$errCode = 1;
			self::$errMsg = 'get IRMACusLogTTC 记录为空';
			$logs[] = array(
				'time' => $empty_date,
				'content' => '待审核',
			);
		}else{
			//剔除不符合要求的
			foreach($data as $key => &$value){
				if(($value['RegisterSysNo'] != -999999) && ($value['RegisterSysNo'] != $regist_id) ){
					//unset($data[$key]);
				}
			}

			if(empty($data)){
				$logs[] = array(
					'time' => $empty_date,
					'content' => '待审核',
				);
			}else{
				foreach($data as $key => &$value){
					$logs[] = array(
						'time' => $value['rowCreateDate'],
						'content' => ToolUtil::transXSSContent($value['OpContent']),
					);
				}
			}
		}
		return $logs;
	}

	/**
	 * 当申请单审核不通过，显示申请单审核不通过的客服备注内容，无流水
	 * @param int $sysNo 申请单系统编号
	 * @param int $wh_id 分站ID
	 * @return 状态描述
	 */
	public static function getRmaStatusNotPass_Last($sysNo, $wh_id){
		$wh_id = intval($wh_id);
		$MSDB = ToolUtil::getMSDBObj("ERP_" . $wh_id);
		if(false === $MSDB){
			Logger::err("connect ERP_" .$wh_id. " MSDB error:".ToolUtil::$errMsg);
			continue;
		}

		$sql = "select SysNo,RequestSysNo,AuditReason,ReturnDescription from RMA_Request_OnlineAudit where RequestSysNo = {$sysNo} order by rowCreateDate desc";
		$result = $MSDB->getRows($sql);
		if($result === false){
			Logger::err ("ERP_" .$wh_id. " RMA_Request_OnlineAudit error:". $MSDB->errMsg .",line:". __LINE__ ."\n");
			continue;
		}
		$des_status = '';
		if(isset($result) && (empty($result))){
			self::$errCode = $MSDB->errCode;
			self::$errMsg="ERP_" .$wh_id. " query RMA_Request_OnlineAudit empty" . $MSDB->errMsg;
			$des_status = '';
		}
		//处理状态
		foreach($result as $rs){
			$des_status = empty($rs['AuditReason']) ? $rs['ReturnDescription'] : $rs['AuditReason'];
		}
		return $des_status;
	}

	/**
	 * 当申请单审核通过，显示流水表的最新状态 限2012-11-21 19:00:00 之前的单件
	 * @param int $sysNo 申请单系统编号
	 * @param int $wh_id 分站ID
	 * @return 状态描述
	 */
	public static function getOldRmaStatus_Last($registsysno){
		global $_myrepairLogState;
		$des_status = '待审核';
		$data = IRMARegisterLogTTC::get($registsysno, array(), array('Status'));
		if(false === $data){
			self::$errCode = IRMARegisterLogTTC::$errCode;
			self::$errMsg = IRMARegisterLogTTC::$errMsg;
			Logger::err("IRMARegisterLogTTC get failed" . " errMsg: " .IRMARegisterLogTTC::$errMsg ." errCode: " .IRMARegisterLogTTC::$errCode);
			return $des_status;
		}
		if(empty($data)){
			self::$errCode = 1002;
			self::$errMsg = 'get IRMARegisterLogTTC 记录为空';
			return $des_status;
		}
		//处理状态
		$status = 0;
		$data = array_reverse($data,true);
		foreach($data as $rs){
			$status = $rs['Status'];
			$des_status = isset($_myrepairLogState[$status]) ? $_myrepairLogState[$status] : '待审核';
		}

		return $des_status;
	}

	/**
	 * 新状态:获取RMA单件最后一条日志流水信息
	 * add by allenzhou  新的接口,新建了一个TTC
	 * @param $requestsysno 申请单系统编号
	 * @param $registsysno 处理单单号
	 * @param $wid 分站id
	 * @return 返回:流水日志信息
	 */
	public static function getRmaStatus_Last($requestsysno, $registsysno, $wid){
		global $_myrepairLogState;
		$des_status = '待审核';
		if(empty($registsysno)){
			Logger::err("registsysno is empty");
		}

		//$data = IRMACusLogTTC::get($requestsysno, array('RegisterSysNo' => $registsysno), array('LogType', 'SysNo'));
		$data = IRMACusLogTTC::get($requestsysno);
		if(false === $data){
			self::$errCode = IRMACusLogTTC::$errCode;
			self::$errMsg = IRMACusLogTTC::$errMsg;
			Logger::err("IRMACusLogTTC get failed" . " errMsg: " .IRMACusLogTTC::$errMsg ." errCode: " .IRMACusLogTTC::$errCode);
			return $des_status;
		}
		if(empty($data)){
			self::$errCode = 1002;
			self::$errMsg = 'get IRMACusLogTTC 记录为空';
			return $des_status;
		}
		//处理状态
		$status = 0;

		//剔除不符合要求的
		foreach($data as $key => &$value){
			if(($value['RegisterSysNo'] != -999999) && ($value['RegisterSysNo'] != $registsysno) ){
				unset($data[$key]);
			}
		}

		if(empty($data)){
			self::$errCode = 1002;
			self::$errMsg = 'get IRMACusLogTTC 记录为空';
			return $des_status;
		}else{
			foreach($data as $key => &$value){
				$status = $value['LogType'];
			}
			$des_status = self::retunStatusDesc($status);
		}

		return $des_status;
	}

	/**
	 * 根据日志流水类型编号区间返回对应状态描述
	 * @param int $logtype 类型编号
	 * @param $wid 分站id
	 * @return 返回类型编号对应的状态描述
	 */
	private static function retunStatusDesc($logtype){
		$case = intval($logtype /10);
		switch ($case){
			case 1:$desc = '审核通过';break;
 			case 2:$desc = '审核不通过';break;
 			case 3:$desc = '审核通过';break;
 			case 4:$desc = '申请单已作废';break;
 			case 5:$desc = '待上门取件';break;
 			case 6:$desc = '待上门换新';break;
 			case 7:$desc = '待用户邮寄商品';break;
 			case 8:$desc = '待商品送至门店';break;
 			case 9:$desc = '取消取件';break;
 			case 10:$desc = '待上门取件';break;
 			case 14:$desc = '商品已收到，待处理';break;
 			case 15:$desc = '上门换新完毕';break;
 			case 16:$desc = '已收到商品';break;
 			case 17:$desc = '已出检测结果';break;
 			case 18:$desc = '已送至供应商处理';break;
 			case 19:$desc = '正在复测';break;
 			case 20:$desc = '等待发还';break;
 			case 21:$desc = '待退款';break;
 			case 23:$desc = '退款成功';break;
 			case 25:$desc = '商品待发出';break;
 			case 26:$desc = '待配送';break;
 			case 27:$desc = '商品已发出';break;
 			default:$desc = '';break;
		}

		return $desc;
	}
}