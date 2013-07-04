<?php

/*
 * 分单
 * ninojiang 2013-05-16
 */

 
require_once ROOT_DIR . 'dao/service/IServiceApplyDao.php';
 
class IAssign{
	
	//工单权重
	/*
	 * vip 0
	 * 升级工单 1
	 * 自动催单 2
	 * 手动催单 3
	 */
	private static function _getDealWeights($data, $biz = 'serivce'){
		if($biz === 'service'){
			if($data['isVip'] == 1){
				return 0;
			}
			if($data['flag'] == 2){
				return 2;
			}
			if($data['flag'] == 1){
				return 3;
			}
			
		}
		
		return 100;
	}
	
	//找出可分单的客服
	public static function getKF(){
		$db = Config::getDB("b2b2c_kf_admin");
		if($db === false){
			return false;
		}
		
		$kf_data = array();
		
		//找出签入的客服
		$last_active_time = TIMESTAMP - KF_NOT_ACTIVE_TIME;
		$kfs = $db->getRows2('spf_users', array('uid', 'rtx_id'), '`is_working`=1 AND `last_time` >' .$last_active_time, 0, 99999, '');
		
		if(count($kfs) === 0){
			return array();	
		}
		
		//分单顺序
		$seque	= array();
		$seqs	= $db->getRows('SELECT `kf` FROM spf_assign_kf_sequence ORDER BY `time` ASC;');
		if($seqs){
			$n = 1;
			foreach($seqs AS $seq){
				$seque[$seq['kf']] = $n;
				$n ++;
			}
		}
		
		$kf_uid = array();
		$kf_rtx = array();
		foreach($kfs AS $kf){
			$kf_uid[] = $kf['uid'];
			$kf_rtx[] = '\'' .$kf['rtx_id'] . '\'';
			
			$kf_data[$kf['rtx_id']] = array(
						'uid'			=> $kf['uid'],
						'rtx'			=> $kf['rtx_id'],
						'assigned'		=> 0,						//已分配单数
						'processing'	=> 0,						//正在处理中的单数
						'business'		=> array(),					//签入可处理的业务
						'seq'			=> $seque[$kf['rtx_id']] ? $seque[$kf['rtx_id']] : 0
			);
		}
		
		//找出客服签入组所负责的业务
		$busniss = self::_getGroupBusiness();
		$sql	= 'SELECT * FROM spf_user_group WHERE `user_id` IN (' .implode(', ', $kf_uid) .');';
		$rows	= $db->getRows($sql);

		foreach($rows AS $row){
			foreach($kf_data AS &$kf){
				if($kf['uid'] == $row['user_id']){
					$kf['business'] = array_merge($kf['business'], $busniss[$row['group_id']]);
				}
			}
		}
		
		
		//找出这些客服正在处理的单
		$sql	= 'SELECT * FROM spf_assign_unsolved WHERE `assign_kf` IN (' .implode(', ', $kf_rtx) .');';
		$rows	= $db->getRows($sql);
		
		if($rows){
			$service_bids = array();
			foreach($rows AS $row){
				if($row['business'] === 'service'){
					$service_bids[] = $row['biz_id'];
				}
			}
			
			//在处理的售后单状态
			if($service_bids){
				$statuses = self::_getServiceDealStatusBatch($service_bids);

				foreach($rows AS $row){
					$kf_data[$row['assign_kf']]['assigned'] ++;
					//处理中的售后单
					if($statuses[$row['biz_id']] == 2){
						$kf_data[$row['assign_kf']]['processing'] ++;
					}
				}

			}
		}
		
		if($kf_data){
			foreach($kf_data AS $key => $val){
				if($val['assigned'] >= ASSIGN_KF_HANDLE_COUNT && $val['assigned'] >= ASSIGN_KF_PROCESSING_COUNT){
					unset($kf_data[$key]);
				}
			}
		}

		usort($kf_data, 'cmpkf');
		
		return $kf_data;
	}


	
	//所有待分配的单
	public static function getUnassigned(){
		$db = Config::getDB("b2b2c_kf_admin");
		if($db === false){
			return false;
		}
		
		//所有已分配的待解决的单
		$unsolved_assign = $db->getRows2('spf_assign_unsolved', array('business', 'business_type', 'business_subtype', 'assign_kf', 'biz_id'), '', 0, 99999, '');
		$unsolved_new = array(
				'service'	=> array(),		//服务中心工单
		);
		
		if(count($unsolved_assign) > 0){
			foreach($unsolved_assign AS $row){
				$unsolved_new[$row['business']][] = $row['biz_id'];
			}
		}

		//待处理的单
		$unassigned = array();
		
		$db = Config::getDB("b2b2c_kf_web");
		//服务单
		
		$where = count($unsolved_new['service']) > 0 ? '`id` NOT IN (' .implode(',', $unsolved_new['service']) .')' : '1=1';
		$unassigned_service = $db->getRows('SELECT * FROM service_apply WHERE '.$where .' AND `state` <= 1 ORDER BY `createTime` ASC;');
		if($unassigned_service){
			foreach($unassigned_service AS $row){
				$data = self::_getUnassignedFormatData($row, 'service');
				if($data){
					$unassigned[] = $data;
				}
			}
		}
		
		
		usort($unassigned, 'cmpua');
		
		return $unassigned;
	}
	
	
	//分单给客服
	public static function assignToKF($rtx, $data, $source = 1){
		
		$db = Config::getDB("b2b2c_kf_admin");
		if($db === false){
			return false;
		}
		
		$unsolved = array();
		$unsolved['business']		= $data['business'];
		$unsolved['business_type']	= $data['business_type'];
		$unsolved['business_subtype']	= $data['business_subtype'];
		$unsolved['biz_id']			= $data['biz_id'];
		$unsolved['biz_desc']		= $data['content'];
		$unsolved['assign_kf']		= $rtx;
		$unsolved['available_time']	= $data['available_time'];
		$unsolved['assign_time']	= time();
		$unsolved['source']			= $source;
		
		$ret = $db->insert('spf_assign_unsolved', $unsolved);
		if($ret){
			if($data['business'] === 'service'){
				IServiceApplyDao::update(array('followKF' => $rtx), 'id = ' .$data['biz_id']);
			}
		}
		
		$db = Config::getDB("b2b2c_kf_admin");
		$microtime = substr((microtime(true) * 100 + ''), 3);
		$ret = $db->execSql('REPLACE INTO spf_assign_kf_sequence SET `kf` = \''.$rtx .'\', `time` = \'' .$microtime .'\';');
	}
	
	//检查所有已分配的单的状态
	public static function checkAssignedStatus(){
		$db = Config::getDB("b2b2c_kf_admin");
		if($db === false){
			return false;
		}
		
		$unsolved = $db->getRows('SELECT * FROM spf_assign_unsolved;');
		if($unsolved){
			$service_bids = array();
			foreach($unsolved AS $row){
				if($row['business'] === 'service'){
					$service_bids[] = $row['biz_id'];
				}
			}
			
			//服务中心的单
			if($service_bids){
				$service_deal_info = array();
				$db_web = Config::getDB("b2b2c_kf_web");
				$rows = $db_web->getRows('SELECT `id`, `state`, `followKF`, `finishTime` FROM service_apply WHERE `id` IN ('. implode(',', $service_bids) .');');
				foreach($rows AS $row){
					$service_deal_info[$row['id']] = $row;
				}

				foreach($unsolved AS $row){
					if($row['business'] === 'service'){
						//已处理完成
						$deal = $service_deal_info[$row['biz_id']];
						if($deal['state'] == 3){
							self::_setSolved($row, $deal['finishTime'], $deal['followKF']);
						}
					}
				}
			}
		}
	}
	
	//开始分单
	public static function Assign(){
		//所有客服
		$kfs = self::getKF();
		if(count($kfs) === 0){
			return;
		}
		
		//var_dump($kfs);
		
		//所有待分配的单
		$unassigned	= self::getUnassigned();
		if(count($unassigned) === 0){
			return;
		}
		
		//var_dump($unassigned);
		
		
		//开始分单，一次一单
		foreach($kfs AS $kf){
			foreach($unassigned AS $n => $deal){
				$key	= $deal['business'] . '_' .$deal['business_type'] . '_' .$deal['business_subtype'];
				$key2	= $deal['business'] . '_' .$deal['business_type'] . '_0';
				//客服可处理
				if(in_array($key, $kf['business']) || in_array($key2, $kf['business'])){
					IAssign::assignToKF($kf['rtx'], $deal);
					unset($unassigned[$n]);
					break;
				}
			}
		}
		
		//再分一单
		foreach($kfs AS $kf){
			foreach($unassigned AS $n => $deal){
				$key	= $deal['business'] . '_' .$deal['business_type'] . '_' .$deal['business_subtype'];
				$key2	= $deal['business'] . '_' .$deal['business_type'] . '_0';
				//客服可处理
				if(in_array($key, $kf['business']) || in_array($key2, $kf['business'])){
					IAssign::assignToKF($kf['rtx'], $deal);
					unset($unassigned[$n]);
					break;
				}
			}
		}
	}
	
	
	//设置已处理完成
	private static function _setSolved($unsolved, $finishTime, $finishKF){
		$db = Config::getDB("b2b2c_kf_admin");
		if($db === false){
			return false;
		}
		
		//如果是分配的客服处理的
		if($unsolved['assign_kf'] == $finishKF){
			$solved = array();
			$solved['biz_id']			= $unsolved['biz_id'];
			$solved['business']			= $unsolved['business'];
			$solved['business_type']	= $unsolved['business_type'];
			$solved['business_subtype']	= $unsolved['business_subtype'];
			$solved['assign_kf']		= $finishKF;
			$solved['solve_kf']			= $finishKF;
			$solved['assign_time']		= $unsolved['assign_time'];
			$solved['available_time']	= $unsolved['available_time'];
			$solved['solve_time']		= time();
			$solved['source']			= $unsolved['source'];
			
			$db->insert('spf_assign_solved', $solved);
		}
		
		$db->execSql('DELETE FROM spf_assign_unsolved WHERE `id` = ' .$unsolved['id']);
	}
	
	
	
	//格式化待分配单的数据
	private static function _getUnassignedFormatData($data, $biz = 'service'){
		if($biz === 'service'){
			$data['biz_id']			= $data['id'];
			$data['business']		= 'service';
			$data['business_type']	= $data['type'];
			$data['business_subtype']	= $data['subType'];
			$data['available_time'] = $data['createTime'];
			$data['content']		= iconv('GBK', 'UTF-8', $data['content']);
			$data['weights']		= self::_getDealWeights($data, $biz);
		}
		
		
		return $data;
	}
	
	
	//组负责的业务
	private static function _getGroupBusiness(){
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db){
			return false;
		}
		
		$data	= array();
		
		$sql	= 'SELECT * FROM spf_group_biz;';
		$rows	= $db->getRows($sql);
		
		if($rows){
			foreach($rows AS $row){
				$biz_type_id		= floor($row['biz_id'] / 10000);
				$biz_sub_type_id	= $row['biz_id'] % 10000;
				if($biz_type_id <= 9){	//如果是服务单
					if(!isset($data[$row['group_id']])){
						$data[$row['group_id']] = array();
					}
					
					$data[$row['group_id']][] = 'service_' . $biz_type_id . '_' .$biz_sub_type_id;
				}else{
					/*
					 * TODO 其他业务
					 */
				}
			}
		}
		
		return $data;
	}
	
	
	//批量查询服务单状态
	private static function _getServiceDealStatusBatch($ids = array()){
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db){
			return false;
		}
		
		$result = array();
		$where = '`id` IN ('.implode(', ', $ids).')';
		$sql = 'SELECT `id`, `state` FROM service_apply WHERE ' .$where . ';';
		
		$rows = $db->getRows($sql);
		if($rows){
			foreach($rows AS $row){
				$result[$row['id']] = $row['state'];
			}
		}
		
		return $result;
	}
}




function cmpkf($a, $b){
	if($a['seq'] == $b['seq']){
		return 0;
	}
	return ($a['seq'] < $b['seq']) ? -1 : 1;
}

function cmpua($a, $b){
	if($a['weights'] == $b['weights']){
		return 0;
	}
	return ($a['weights'] < $b['weights']) ? -1 : 1;
}