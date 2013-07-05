<?php

/*
 * ���Ͷ�Ź�ϵ�� -- ��̨������ʹ��
 * @author railszhu
 * @version 1.0
 */

class IAdMap{
	public static $key = 1; 	    //TTC����
	public static $errMsg = "";     //������Ϣ
	public static $errCode = 0;     //�������
	public static $inaccuracy = 10; //ͼƬ�ߴ���������
		
	/*
	 * ���ĳ�����Ͷ�ŵ����й��λID
	 * @param  $aid => ���ID
	 * @return $pid => Ͷ�ŵĹ��λID����
	 * @author railszhu
	 */
	public static function get_pid($aid) {
		$filter = array('aid' => $aid, 'status' => 1 ); //ֻȡ״̬Ϊ���õĹ��λ
		$rs = IAdMapTTC::get(self::$key, $filter);
		if ($rs === false) {
			self::$errCode = 11;
			self::$errMsg  = '��ȡͶ�ŵĹ��λʧ��';
			return '';
		}
		$pid = array();
		if (count($rs)) {
			foreach ($rs as $v) {
				$pid[] = $v['pid'];
			}
		}
		return $pid;
	}
	
	/*
	 * Ͷ�Ź�棬һ�����Ͷ�ŵ�������λ
	 * @param  $para = array(
	 *			'pid' => Ŀ����λID����,
	 *			'aid' => ��Ͷ�Ź��ID,
	 *			'user_id' => �û�ID,
	 *			'status' => 1
	 *			);
	 * @return $msg => array('msg' => '������Ϣ');
	 * @author railszhu
	 */
    public static function uploadMap($para) {
    	//����ȡ�ù����Ϣ�������ж�ͼƬ�Ƿ����Ҫ��
    	$filter_ad = array('aid' => $para['aid']);
		$rs_ad = IAdInfoTTC::get(IAdInfo::$key, $filter_ad);
		if($rs_ad === false) {
			self::$errCode = 21;
			self::$errMsg  = '���info��ȡ�����Ϣʧ��';
			return array('msg' => '��ȡ�����Ϣʧ�ܣ�');
		}
		$ad_info = $rs_ad[0];
		$start_time = $ad_info['starttime']; //��ù����Чʱ��
		$end_time = $ad_info['endtime'];
		if(!empty($ad_info['content'])) { //��ù������
			$type = 2;
		} else {
			$type = 1;
			//ȡ������ͼƬ��С
			$arr = ToolUtil::getImageSize($ad_info['adurl']);
			if(!$arr) {
				return array('msg' => '��ȡ����ͼƬ��Ϣʧ�ܣ�');
			} else{
				$w_width = $arr['width'];
				$w_height = $arr['height'];
			}
			//�����ϴ�խ��ͼƬ��ȡ��խ��ͼƬ��С
			if(!empty($ad_info['adurl2'])) {
				$brr = ToolUtil::getImageSize($ad_info['adurl2']);
				if(!$brr) {
					return array('msg' => '��ȡխ��ͼƬ��Ϣʧ�ܣ�');
				} else {
					$n_width = $brr['width'];
					$n_height = $brr['height'];
				}
			}
		}
		foreach ($para['pid'] as $pid) {
			//���жϸù��λ����Ͷ�ŵĹ�����Ͷ�ŵĹ��ʱ���Ƿ����ص�
			/*$filter_m = array('pid' => $pid, 'status' => 1, 'site_id' => $para['site_id']);
			$rs_aid = IAdMapTTC::get(IAdMap::$key, $filter_m);
			if($rs_aid === false) {
				self::$errCode = 22;
				self::$errMsg  = '���map��ȡ���λ�ϵĹ����Ϣʧ��';
				return array('msg' => '��ȡ���λ'.$pid.'��Ͷ�ŵĹ����Ϣʧ�ܣ�');
			}
			$aid_list = array();
			if(count($rs_aid)) {
				foreach($rs_aid as $k => $v) {
					$aid_list[] = $v['aid'];
				}
			}
			foreach($aid_list as $aid_2) {
				$filter_ad2 = array('aid' => $aid_2);
				$rs_ad2 = IAdInfoTTC::get(IAdInfo::$key, $filter_ad2);
				if($rs_ad2 === false) {
					self::$errCode = 23;
					self::$errMsg  = '���info��ȡ�����Ϣʧ��';
					return array('msg' => '��ȡ���'.$aid_2.'��Ϣʧ�ܣ�');
				}
				$ad_info2 = $rs_ad2[0];
				$start_time2 = $ad_info2['starttime'];
				$end_time2 = $ad_info2['endtime'];
				if(!($start_time > $end_time2 || $end_time < $start_time2)) {
					return array('msg' => '���Ͷ��ʱ������λ'.$pid.'�ϵĹ��'.$aid_2.'���ص���');
				}
			}	*/		 
			//����ͼƬ��棬�������жϸù��ͼƬ��С�ܷ�����Ҫ��
			if($type == 1) {
				$filter_p = array('pid' => $pid);
				$rs_p = IAdPositionTTC::get(IAdPosition::$key, $filter_p);
				if($rs_p === false) {
					self::$errCode = 22;
					self::$errMsg  = '���position��ȡ���λ��Ϣʧ��';
					return array('msg' => '��ȡ���λ'.$pid.'��Ϣʧ�ܣ�');
				}
				$position_info = $rs_p[0];
				$p_width = $position_info['width'];
				$p_height = $position_info['height'];
				$p_width2 = $position_info['width2'];
				$p_height2 = $position_info['height2'];
				if($w_width < ($p_width-self::$inaccuracy)) {
					return array('msg' => '�ù���޷�������λ'.$pid.'�Ŀ���ͼƬ�ߴ�Ҫ�󣬿��ƫС��');
				} else if($w_width > ($p_width+self::$inaccuracy)) {
					return array('msg' => '�ù���޷�������λ'.$pid.'�Ŀ���ͼƬ�ߴ�Ҫ�󣬿��ƫ��');
				} else if($w_height < ($p_height-self::$inaccuracy)) {
					return array('msg' => '�ù���޷�������λ'.$pid.'�Ŀ���ͼƬ�ߴ�Ҫ�󣬸߶�ƫС��');
				} else if($w_height > ($p_height+self::$inaccuracy)) {
					return array('msg' => '�ù���޷�������λ'.$pid.'�Ŀ���ͼƬ�ߴ�Ҫ�󣬸߶�ƫ��');
				} else if(!empty($ad_info['adurl2'])) { 
					if($n_width < ($p_width2-self::$inaccuracy)) {
						return array('msg' => '�ù���޷�������λ'.$pid.'��խ��ͼƬ�ߴ�Ҫ�󣬿��ƫС��');
					} else if($n_width > ($p_width2+self::$inaccuracy)) {
						return array('msg' => '�ù���޷�������λ'.$pid.'��խ��ͼƬ�ߴ�Ҫ�󣬿��ƫ��');
					} else if($n_height < ($p_height2-self::$inaccuracy)) {
						return array('msg' => '�ù���޷�������λ'.$pid.'��խ��ͼƬ�ߴ�Ҫ�󣬸߶�ƫС��');
					} else if($n_height > ($p_height2+self::$inaccuracy)) {
						return array('msg' => '�ù���޷�������λ'.$pid.'��խ��ͼƬ�ߴ�Ҫ�󣬸߶�ƫ��');
					}
				}
			}
			$filter = array('pid' => $pid, 'aid' => $para['aid'], 'site_id' => $para['site_id']);
			$rs = IAdMapTTC::get(self::$key, $filter); //�����жϸù���Ƿ�����Ͷ�Ź��ù��λ
			if($rs) {//Ͷ�Ź�
				if($rs[0]['status'] == 0) { //�Ѿ����������ٴ�Ͷ�ţ�����status����
					$data = array('updatetime' => date('Y-m-d'), 'status' => 1, 'mid' => self::$key);
					$rs = IAdMapTTC::update($data, $filter);
					if ($rs === false) {
						self::$errCode = 23;
						self::$errMsg  = '��ȡͶ����Ϣʧ��';   
						return array('msg' => IAdMapTTC::$errMsg);
					}	
				} else { //����δɾ��������ʾ������Ϣ
						return array('msg' => '��ǰ�����Ͷ���ڸù��λ��������ѡ��!');
				}
			} else { //δͶ�Ź������½����ݲ���
				$data = array(
						'pid' => $pid,
						'aid' => $para['aid'],
						'seq' => 1,    //TODO
						'createtime' => date('Y-m-d'),
						'updatetime' => date('Y-m-d'),	
					   	'user_id' => $para['user_id'],
						'status' => $para['status'],
						'mid' => self::$key,
						'site_id' => $para['site_id']  
				);
				$rs = IAdMapTTC::insert($data);
				if ($rs === false) {
					self::$errCode = 24;
					self::$errMsg  = 'Ͷ�Ź��ʧ��';
					return array('msg' => IAdMapTTC::$errMsg);
				}
			}
		} 		
		return array('msg' => 'success!!');
    }
    /*
	 * ȡ��Ͷ�Ź��
	 * @param  $para = array(
	 *			'pid' => Ŀ����λID����,
	 *			'aid' => ��ȡ��Ͷ�Ź��ID,
	 *			'user_id' => �û�ID,
	 *			'status' => 0
	 *			);
	 * @return $msg => array('msg' => '������Ϣ');
	 * @author railszhu
	 */
    public static function updateMap($para) {
    	foreach($para['pid'] as $pid) {
	    	$filter = array('pid' => $pid, 'aid' => $para['aid']);
	    	$data = array(
					'updatetime' => date('Y-m-d'),	
					'mid' => self::$key
			);
	    	foreach ($para as $k => $v) {
	    		if($k != 'pid' && $k !='aid') {
	    			$data[$k] = $v;
	    		}
	    	}
			$rs = IAdMapTTC::update($data, $filter);
			if ($rs === false) {
				self::$errCode = 31;
				self::$errMsg  = 'ȡ��Ͷ�Ź��ʧ��';
				return array('msg' => IAdMapTTC::$errMsg);
			}
    	}		
		return array('msg' => 'success!!');
    }
    
    public static function findAdMaps($conditions) {
    	$filter = array();
    	if(is_array($conditions)) {
    		if(isset($conditions['pid']) && !empty($conditions['pid'])) {
    			$filter['pid'] = $conditions['pid'];
    		}
    		
    		if(isset($conditions['aid']) && !empty($conditions['aid'])) {
    			$filter['aid'] = $conditions['aid'];
    		}
    		
    		if(isset($conditions['site_id']) && !empty($conditions['site_id'])) {
    			$filter['site_id'] = $conditions['site_id'];
    		}
    		
    		if(isset($conditions['status']) && !empty($conditions['status'])) {
    			$filter['status'] = $conditions['status'];
    		}
    	} else 
    		throw new BaseException(101, 'Unexpect search condition.');
    	$res = IAdMapTTC::get(self::$key, $filter);
    	if($res === false)
    		throw new BaseException(102, 'Failed to find advertise maps.');
    	return $res;
    }
    
    public static function modifyAdMap($aid, $pid, $site_id, $properties) {
    	$filter = array( 'aid' => $aid, 'pid' => $pid, 'site_id' => $site_id );
    	$properties['mid'] = self::$key;
    	$res = IAdMapTTC::update($properties, $filter);
    	if($res === false) {
    		throw new BaseException(101, 'Failed to modify advertise map.');
    	}
    }
    
    public static function removeAdMap($aid, $pid, $site_id) {
    	$filter = array( 'aid' => $aid, 'pid' => $pid, 'site_id' => $site_id );
    	$res = IAdMapTTC::remove(self::$key, $filter);
    	if($res === false) {
    		throw new BaseException(101, 'Failed to remove advertise map.');
    	}
    }
}