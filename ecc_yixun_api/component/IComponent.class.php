<?php

/**
 * ����ӿڣ��ṩ����Ĳ�ѯ���������������
 * @author smithhuang
 */
class IComponent {
	
	public static $errCode = 0;
	public static $errMsg = '';
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	/**
	 * ��ȡָ��id�������Ϣ
	 * @param int/array $id �����id
	 */
	public static function getComponentById($id) {
		self::clearErr();
		
		try {
			if(!is_array($id)) {
				if(empty($id)) {
					throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Id should not be empty.');
				} else {
					$compDao = new IMySQLDAO('icson_event_component', 't_component');
					$res = $compDao->getRows('', "id = $id AND status = 1", null, null);
					if(empty($res)) {
						throw new BaseException(ErrorConfig::getErrorCode('component_not_found'), "Failed to find component with id $id.");
					}
					$res[0]['params'] = unserialize($res[0]['params']);
					return $res[0];
				}
			} else {
				if(empty($id)) {
					return array();
				} else {
					$compDao = new IMySQLDAO('icson_event_component', 't_component');
					$res = $compDao->getRows('', 'id IN (' . implode(', ', $id) . ') AND status = 1', null, null);
					foreach ($res as &$r) {
						$r['params'] = unserialize($r['params']);
					}
					return $res;
				}
			}
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ��ȡ��ָ������������
	 * @param int $biz �ҵ��id
	 * @param int $act_id �id
	 */
	public static function getComponentByActivity($biz, $act_id) {
		self::clearErr();
		
		try {
			$compMapDao = new IMySQLDAO('icson_event_component', 't_component_map');
			$map_res = $compMapDao->getRows('', "biz_id = $biz AND act_id = $act_id AND status = 1", null, null);
			if(!empty($map_res)) {
				$ids = array();
				foreach ($map_res as $r) {
					$ids[] = $r['comp_id'];
				}
				$compDao = new IMySQLDAO('icson_event_component', 't_component');
				$comps = $compDao->getRows('', 'id IN (' . implode(', ', $ids) . ') AND status = 1', null, null);
				foreach ($comps as &$c) {
					$c['params'] = unserialize($c['params']);
				}
				return $comps;
			} else {
				return array();
			}
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ��ȡ��ָ����������Ļ
	 * @param int $comp_id ���id
	 */
	public static function getActivityByComponent($comp_id) {
		self::clearErr();
		
		try {
			$compMapDao = new IMySQLDAO('icson_event_component', 't_component_map');
			$map_res = $compMapDao->getRows('', "comp_id = $comp_id AND status = 1", null, null);
			if(!empty($map_res)) {
				$res = array();
				foreach ($map_res as $r) {
					if(isset(ComponentConfig::$bizs[$r['biz_id']])) {
						$res[] = array(
							'biz' => ComponentConfig::$bizs[$r['biz_id']]['name'],
							'act_id' => $r['act_id'],
							'url' => str_replace('{act_id}', $r['act_id'], ComponentConfig::$bizs[$r['biz_id']]['url'])
						);
					}
				}
				return $res;
			} else {
				return array();
			}
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ��������ѯ��������Ը���id��type��title��start_time��end_time��col1��col2��col3��ѯ
	 * @param array $conditions ��ѯ����
	 * @param int $pageNo ҳ��
	 * @param int $pageSize ҳ��С
	 */
	public static function searchComponent($conditions, $pageNo, $pageSize) {
		self::clearErr();
		
		try {
			$conds = array();
			
			if(isset($conditions['id']) && !empty($conditions['id'])) {
				$conds[] = "id = {$conditions['id']}";
			}
			
			if(isset($conditions['type']) && !empty($conditions['type'])) {
				$conds[] = "type = {$conditions['type']}";
			}
			
			if(isset($conditions['title']) && !empty($conditions['title'])) {
				$conds[] = "title LIKE '%{$conditions['title']}%'";
			}
			
			if(isset($conditions['start_time']) && !empty($conditions['start_time'])) {
				$conds[] = "start_time <= {$conditions['start_time']}";
			}
			
			if(isset($conditions['end_time']) && !empty($conditions['end_time'])) {
				$conds[] = "end_time >= {$conditions['end_time']}";
			}
			
			if(isset($conditions['col1']) && !empty($conditions['col1'])) {
				$conds[] = "col1 = {$conditions['col1']}";
			}
			
			if(isset($conditions['col2']) && !empty($conditions['col2'])) {
				$conds[] = "col2 LIKE '%{$conditions['col2']}%'";
			}
			
			if(isset($conditions['col3']) && !empty($conditions['col3'])) {
				$conds[] = "col3 LIKE '%{$conditions['col3']}%'";
			}
			
			$conds[] = 'status = 1';
			
			$compDao = new IMySQLDAO('icson_event_component', 't_component');
			if(is_int($pageNo) && $pageNo > 0 && is_int($pageSize) && $pageSize > 0) {
				//$res = $compDao->getPage('', implode(' AND ', $conds), $pageNo, $pageSize);
				$res = $compDao->getPageFromSQL(
					'SELECT * FROM t_component WHERE ' . implode(' AND ', $conds) . ' ORDER BY id DESC', 
					'SELECT count(*) AS c FROM t_component WHERE ' . implode(' AND ', $conds), 
					$pageNo, 
					$pageSize
				);
				foreach ($res['data'] as &$r) {
					$r['params'] = unserialize($r['params']);
				}
				return $res;
			} else {
				//$res = $compDao->getRows('', implode(' AND ', $conds), null, null);
				$res = $compDao->query('SELECT * FROM t_component WHERE ' . implode(' AND ', $conds) . ' ORDER BY id DESC');
				foreach ($res as &$r) {
					$r['params'] = unserialize($r['params']);
				}
				return $res;
			}
			
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ����������
	 * @param int $biz �ҵ��id
	 * @param int $act_id �id
	 * @param int $comp_id ���id
	 * @param int $user_id �û�id
	 */
	public static function addComponentMap($biz, $act_id, $comp_id, $user_id) {
		self::clearErr();
		
		try {
			if(!isset(ComponentConfig::$bizs[$biz])) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), "Unexpected biz $biz.");
			}
			$compMapDao = new IMySQLDAO('icson_event_component', 't_component_map');
			$res = $compMapDao->getRows('', "biz_id = $biz AND act_id = $act_id AND comp_id = $comp_id", null, null);
			if(!empty($res)) {
				if($res[0]['status'] == 0) {
					$compMapDao->update(array( 'status' => 1, 'operator_id' => $user_id ), "biz_id = $biz AND act_id = $act_id AND comp_id = $comp_id");
				} else {
					throw new BaseException(ErrorConfig::getErrorCode('duplicate_map'), '�����ظ�������');
				}
			} else {
				$compMapDao->insert(array(
					'biz_id' => $biz,
					'act_id' => $act_id,
					'comp_id' => $comp_id,
					'create_time' => date('Y-m-d H:i:s'),
					'operator_id' => $user_id
				));
			}
			return true;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ɾ���������
	 * @param int $biz �ҵ��id
	 * @param int $act_id �id
	 * @param int $comp_id ���id
	 * @param int $user_id �û�id
	 */
	public static function removeComponentMap($biz, $act_id, $comp_id, $user_id) {
		self::clearErr();
		
		try {
			$compMapDao = new IMySQLDAO('icson_event_component', 't_component_map');
			$compMapDao->update(array( 'status' => 0, 'operator_id' => $user_id ), "biz_id = $biz AND act_id = $act_id AND comp_id = $comp_id");
			return true;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	/**
	 * ��������ü�¼������
	 * @param int $comp_id ���id
	 */
	public static function setComponentCache($comp_id) {
		self::clearErr();
		
		$component = self::getComponentById($comp_id);
		if($component === false) {
			if(self::$errCode == ErrorConfig::getErrorCode('component_not_found')) {
				// �����ɾ��
				$ret = IDataCache::delData(IDataCache::getPrefix(IDataCache::BIZ_TYPE_COMP_CONFIG) . $comp_id);
				if($ret === false) {
					self::$errCode = IDataCache::$errCode;
					self::$errMsg = IDataCache::$errMsg;
					return false;
				}
				return true;
			} else {
				return false;
			}
		}
		
		$ret = IDataCache::setData(IDataCache::getPrefix(IDataCache::BIZ_TYPE_COMP_CONFIG) . $comp_id, serialize($component));
		if($ret === false) {
			self::$errCode = IDataCache::$errCode;
			self::$errMsg = IDataCache::$errMsg;
			return false;
		}
		
		return true;
	}
	
	/**
	 * �ӻ����ж�ȡ�������
	 * @param int $comp_id ���id
	 */
	public static function getCachedComponent($comp_id) {
		self::clearErr();
		
		$ret = IDataCache::getData(IDataCache::getPrefix(IDataCache::BIZ_TYPE_COMP_CONFIG) . $comp_id);
		if($ret === false) {
			self::$errCode = IDataCache::$errCode;
			self::$errMsg = IDataCache::$errMsg;
			return false;
		}
		
		return unserialize($ret);
	}
}