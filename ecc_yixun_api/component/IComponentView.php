<?php

define('COMPONENT_VIEW_ROOT', PHPLIB_ROOT . 'api/component/view/');

class IComponentView {
	
	const PARAM_TYPE_NUMBER = 1;
	const PARAM_TYPE_TEXT = 2;
	const PARAM_TYPE_COLOR = 3;
	
	private static $_PARAM_TYPES = array(
		self::PARAM_TYPE_NUMBER,
		self::PARAM_TYPE_TEXT,
		self::PARAM_TYPE_COLOR
	);
	
	public static $errCode = 0;
	public static $errMsg = '';
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	public static function addView($component_type, $title, $template, $operator_id) {
		self::clearErr();
		try {
			if(!isset(ComponentConfig::$components[$component_type])) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), "Unknown component type $component_type.");
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view');
			$id = $dao->insert(array(
				'component_type' => $component_type,
				'title' => $title,
				'template' => $template,
				'operator_id' => $operator_id,
				'create_time' => date('Y-m-d H:i:s')
			));
			return $id;
		} catch(BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function updateView($id, $params, $operater_id) {
		self::clearErr();
		try {
			if(empty($id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			if(!is_array($params)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 2 should be array.');
			}
			
			$data = ArrayUtil::array_mask($params, array( 'title' => true, 'template' => true ));
			$data['operator_id'] = $operater_id;
			$dao = new IMySQLDAO('icson_event_component', 't_component_view');
			$dao->update($data, "id = $id AND status = 1");
			return true;
			
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function removeView($id, $operator_id) {
		self::clearErr();
		try {
			if(empty($id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$data = array( 'operator_id' => $operator_id, 'status' => 0 );
			if($data === false) {
				throw new BaseException(ArrayUtil::$errCode, ArrayUtil::$errMsg);
			}
			$dao = new IMySQLDAO('icson_event_component', 't_component_view');
			$dao->update($data, "id = $id AND status = 1");
			return true;
			
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function getView($id) {
		self::clearErr();
		try {
			if(empty($id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view');
			$res = $dao->getRows('', "id = $id AND status = 1", null, null);
			if(empty($res)) {
				throw new BaseException(ErrorConfig::getErrorCode('view_not_found'), "Failed to find view with id $id.");
			}
			
			return $res[0];
			
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function searchView($conditions, $pageNo = null, $pageSize = null) {
		self::clearErr();
		try {
			$conds = array();
			
			if(!empty($conditions['id'])) {
				$conds[] = "id = {$conditions['id']}";
			}
			
			if(!empty($conditions['title'])) {
				$conds[] = "title LIKE '%{$conditions['title']}%'";
			}
			
			if(!empty($conditions['component_type'])) {
				$conds[] = "component_type = {$conditions['component_type']}";
			}
			
			$conds[] = 'status = 1';
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view');
			if(is_int($pageNo) && $pageNo > 0 && is_int($pageSize) && $pageSize > 0) {
				$res = $dao->getPage('', implode(' AND ', $conds), $pageNo, $pageSize);
			} else {
				$res = $dao->getRows('', implode(' AND ', $conds), null, null);
			}
			
			return $res;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function addParameter($view_id, $type, $name, $zh_name, $operator_id, $default_value = array(), $is_diy = false) {
		self::clearErr();
		try {
			if(empty($view_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			if(!in_array($type, self::$_PARAM_TYPES)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), "Unknown parameter type $type.");
			}
			
			if(empty($name)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 3 should not be empty.');
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_param');
			$res = $dao->getRows('', "view_id = $view_id AND name = '$name'", null, null);
			if(!empty($res)) {
				$dao->update(array(
					'type' => $type,
					'zh_name' => $zh_name,
					'default_value' => serialize($default_value),
					'is_diy' => $is_diy,
					'create_time' => date('Y-m-d H:i:s'),
					'operator_id' => $operator_id,
					'status' => 1
				), "view_id = $view_id AND name = '$name'");
			} else {
				$dao->insert(array(
					'view_id' => $view_id,
					'type' => $type,
					'name' => $name,
					'zh_name' => $zh_name,
					'default_value' => serialize($default_value),
					'is_diy' => $is_diy,
					'create_time' => date('Y-m-d H:i:s'),
					'operator_id' => $operator_id
				));
			}
			
			return true;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function removeParameters($view_id, $operator_id) {
		self::clearErr();
		try {
			if(empty($view_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$data = array( 'operator_id' => $operator_id, 'status' => 0 );
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_param');
			$dao->update($data, "view_id = $view_id AND status = 1");
			
			return true;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function getParameters($view_id) {
		self::clearErr();
		try {
			if(empty($view_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_param');
			$res = $dao->getRows('', "view_id = $view_id AND status = 1", null, null);
			foreach ($res as &$r) {
				$r['default_value'] = unserialize($r['default_value']);
			}
			
			return $res;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function getViewConfigByView($view_id, $pageNo = null, $pageSize = null) {
		self::clearErr();
		
		try {
			if(empty($view_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_config');
			if(is_int($pageNo) && $pageNo > 0 && is_int($pageSize) && $pageSize > 0) {
				$res = $dao->getPage('', "view_id = $view_id AND status = 1", $pageNo, $pageSize);
				foreach ($res['data'] as &$r) {
					$r['value'] = unserialize($r['value']);
				}
			} else {
				$res = $dao->getRows('', "view_id = $view_id AND status = 1", null, null);
				foreach ($res as &$r) {
					$r['value'] = unserialize($r['value']);
				}
			}
			
			return $res;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function getViewConfigByComponent($component_id, $pageNo = null, $pageSize = null) {
		self::clearErr();
		
		try {
			if(empty($component_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_config');
			if(is_int($pageNo) && $pageNo > 0 && is_int($pageSize) && $pageSize > 0) {
				$res = $dao->getPage('', "component_id = $component_id AND status = 1", $pageNo, $pageSize);
				foreach ($res['data'] as &$r) {
					$r['value'] = unserialize($r['value']);
				}
			} else {
				$res = $dao->getRows('', "component_id = $component_id AND status = 1", null, null);
				foreach ($res as &$r) {
					$r['value'] = unserialize($r['value']);
				}
			}
			
			return $res;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function addViewConfig($comp_id, $view_id, $title, $value, $operator_id) {
		self::clearErr();
		
		try {
			if(empty($comp_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			if(empty($view_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 2 should not be empty.');
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_config');
			$id = $dao->insert(array(
				'component_id' => $comp_id,
				'view_id' => $view_id,
				'title' => $title,
				'value' => serialize($value),
				'create_time' => date('Y-m-d H:i:s'),
				'operator_id' => $operator_id
			));
			
			return $id;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function updateViewConfig($id, $params, $operator_id) {
		self::clearErr();
		
		try {
			if(empty($id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$data = ArrayUtil::array_mask($params, array( 'title' => true, 'value' => true ));
			if($data === false) {
				throw new BaseException(ArrayUtil::$errCode, ArrayUtil::$errMsg);
			}
			$data['value'] = serialize($data['value']);
			$data['operator_id'] = $operator_id;
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_config');
			$dao->update($data, "id = $id AND status = 1");
			
			return true;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function removeViewConfig($id, $operator_id) {
		self::clearErr();
		
		try {
			if(empty($id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$data = array( 'status' => 0, 'operator_id' => $operator_id );
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_config');
			$dao->update($data, "id = $id AND status = 1");
			
			return true;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function getViewConfig($id) {
		self::clearErr();
		
		try {
			if(empty($id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$dao = new IMySQLDAO('icson_event_component', 't_component_view_config');
			$res = $dao->getRows('', "id = $id AND status = 1", null, null);
			if(empty($res)) {
				throw new BaseException(ErrorConfig::getErrorCode('view_config_not_found'), "Failed to find view config with id $id.");
			}
			$res[0]['value'] = unserialize($res[0]['value']);
			
			return $res[0];
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
	}
	
	public static function show($config_id) {
		self::clearErr();
		
		try {
			if(empty($config_id)) {
				throw new BaseException(ErrorConfig::getErrorCode('unexpected_input'), 'Parameter 1 should not be empty.');
			}
			
			$config = self::getViewConfig($config_id);
			if($config === false) {
				throw new BaseException(ErrorConfig::getErrorCode('view_config_not_found'), "Failed to find view config with id $config_id.");
			}
			
			$component = IComponent::getComponentById($config['component_id']);
			if($component === false) {
				throw new BaseException(ErrorConfig::getErrorCode('component_not_found', 'IComponent'), "Failed to find component with id {$config['component_id']}");
			}
			
			$view = self::getView($config['view_id']);
			if($view === false) {
				throw new BaseException(ErrorConfig::getErrorCode('view_not_found'), "Failed to find view with id {$config['view_id']}.");
			}
			
			$template = $view['template'];
			$symbols = array_merge(ComponentConfig::$commonSymbols, ComponentConfig::$components[$component['type']]['symbols']);
			
			$template = self::_parseSymbols($template, $component, $symbols);
			
			$params = array();
			foreach ($config['value'] as $k => $v) {
				$params[$k] = $v['value'];
			}
			$template = self::_parseParams($template, $params);
			
			return $template;
		} catch (BaseException $e) {
			self::$errCode = $e->errCode;
			self::$errMsg = $e->errMsg;
			return false;
		}
	}
	
	private static function _parseSymbols($template, $component, $symbols) {
		if(empty($symbols)) {
			return $template;
		}
		$symbolRegExp = '{@@(' . implode('|', array_keys($symbols)) . ')}';
		$replace_symbol = function($m) use ($component, $symbols) {
			$props = explode('.', $symbols[$m[1]]['name']);
			$obj = $component;
			foreach ($props as $p) {
				if(isset($obj[$p])) {
					$obj = $obj[$p];
				} else {
					return $m[0];
				}
			}
			return is_array($obj) ? (empty($obj) ? '[]' : ToolUtil::gbJsonEncode($obj)) : $obj;
		};
		return preg_replace_callback("/$symbolRegExp/", $replace_symbol, $template);
	}
	
	private static function _parseParams($template, $params) {
		if(empty($params)) {
			return $template;
		}
		$symbolRegExp = '{@(?:(?:n|t|c):)?(' . implode('|', array_keys($params)) . ')}';
		$replace_param = function($m) use ($params) {
			return $params[$m[1]];
		};
		return preg_replace_callback("/$symbolRegExp/", $replace_param, $template);
	}
}