<?php
#############################################################
#                                                           #
#                 仅支持批量取接口的TTC2                    #
# 由于 TTC API 中 int_key, string_key 等相关接口与批量取时  #
# 必须调用的 add_key 接口互斥, 且不能多次调用, 故单独出此类 #
#############################################################

if ( !defined('TPHP_TTC_OP_GET') ) {
	define( "TPHP_TTC_OP_GET", 4 );
}

if ( !defined('TPHP_TTC_OP_SELECT') ) {
	define( "TPHP_TTC_OP_SELECT", 4 );
}

define( "TPHP_TTC_KEY_TYPE_INT", 1 );
define( "TPHP_TTC_KEY_TYPE_STR", 4 );

/**
 * 封装TTC2的一些API
 * @author ericfu
 * @version 1.0
 * @updated 06-十一月-2008 18:16:40
 */
class TTC2
{
	const INT = 1;
	const STRING = 2;
	const BINARY = 3;
	const FLOAT = 4;
	/**
	 * 错误码
	 * @var int
	 */
	public $errCode;
	/**
	 * 错误信息
	 * @var string
	 */
	public $errMsg;

	/**
	 * TTC返回码
	 * @var int
	 */
	public $ttcCode;

	/**
	 * ttc的配置，可以通过这个配置验证其数据的合法性等等
	 * @var array
	 */
	private $config;

	private $keytype;

	/**
	 * ttc数据连接
	 * @var tphp_ttc_server
	 */
	private $server = false;
	private $ttcKey = false;
	private $result = null;

	/**
	 * ttc key 通过这个key来获取其配置信息
	 *
	 * @param string ttcKey
	 */
	function __construct($config)
	{
		$this->ttcKey = $config['TTCKEY'];
		$this->config = $config;
	}

	function __destruct()
	{
		if ($this->server != false) {
			$this->server->close();
		}
	}

	/**
	 * 初始化ttc的配置,这个只有在真正操作的时候才会去做
	 *
	 * @return boolean
	 */
	private function init()
	{
		$this->clearERR();

		if ( !extension_loaded('tphp_ttc') ) {
			if ( !ini_get("safe_mode") && ini_get("enable_dl") ) {
				if ( !@dl("tphp_ttc.so") ) {
					$this->errCode = 20000;
					$this->errMsg  = 'can not load tphp_ttc extension module';
					return false;
				}
			} else {
				$this->errCode = 20000;
				$this->errMsg  = 'can not load tphp_ttc extension module';
				return false;
			}
		}

		if ($this->server == false) {
			$this->server = new tphp_ttc_server();
			$errCode = $this->server->set_timeout($this->config['TimeOut']);
			if ($errCode != 0) {
				$this->errCode = 20001;
				$this->errMsg  = $this->server->error_message();
				$this->server->close();
				return false;
			}
			$errCode = $this->server->set_tablename($this->config['TABLE']);
			if ($errCode != 0) {
				$this->errCode = 20002;
				$this->errMsg  = $this->server->error_message();
				$this->server->close();
				return false;
			}
			$errCode = $this->server->set_address($this->config['IP']);
			if ($errCode != 0) {
				$this->errCode = 20003;
				$this->errMsg  = $this->server->error_message();
				$this->server->close();
				return false;
			}
			$key_type = $this->config['FIELDS'][$this->config['KEY']]['type'];
			// key类型只支持整型和字符串型
			if ( $key_type == 1 ) {
				$this->keytype = TPHP_TTC_KEY_TYPE_INT;
			} elseif ( $key_type == 2 ) {
				$this->keytype = TPHP_TTC_KEY_TYPE_STR;
			} else {
				$this->errCode = 20005;
				$this->errMsg  = 'invalid key type';
				$this->server->close();
				return false;
			}
			$errCode = $this->server->add_key($this->config['KEY'], $this->keytype);
			if ($errCode != 0) {
				$this->errCode = 20004;
				$this->errMsg  = $this->server->error_message();
				$this->server->close();
				return false;
			}
		}
		return true;
	}
	public function get($key_arr, $multikey_arr = array(), $need = array())
	{
		if (empty($key_arr)) {
			return array();
		}
		
		$key_arr = array_unique($key_arr);
		
		$retArr = array();
		
		$times = floor(count($key_arr) / 32);
		for ($i = 0; $i <= $times; $i++){		
			$tmp = self::get_multiItems(array_splice($key_arr, 0, 32), $multikey_arr, $need);
			if (false === $tmp) {
				return $retArr;
			}
			$retArr = array_merge($retArr, $tmp);		
		}
		return $retArr;
	}
	
	private  function get_multiItems($key_arr, $filter = array(), $need = array())
	{	
		if ( $this->server == false && $this->init() == false ) {
			return false;
		}
		
		$req = new tphp_ttc_request($this->server, TPHP_TTC_OP_GET);     
		foreach ( $key_arr as $k => $v ) {
			if ( $this->checkKey($v) == false ) {
				return false;
			}
			if ( $this->keytype == TPHP_TTC_KEY_TYPE_INT ) {
				$errCode = $req->addkey_value($this->config['KEY'], $v);
			} else {
				$errCode = $req->addkey_value_str($this->config['KEY'], $v);
			}
			if ( $errCode != 0 ) {
				$this->errCode = 20021;
				$this->errMsg  = "ttc config:{$this->ttcKey} get:" . $this->config['KEY'] ."; add key value error";
				return false;
			}
		}
		
		
		
		
		if ( !empty($filter) && is_array($filter) ) {
            // 处理多字段key情况
            foreach ( $filter as $mk => $mv ) {
                $chk = $this->checkMultikey($mk, $mv);
                if ( !$chk ) {
                    return $chk;
                }
                $eq = $this->eqv($req, $mk, $mv);
                if ( $eq != 0 ) {
                    $this->errCode = 20028;
                    $this->errMsg  = "ttc config:{$this->ttcKey} get:{$key}: set multikey error";
                    return false;
                }
            }
        }
        $fields = $this->config['FIELDS'];
	    $keyfield   = $this->config['KEY'];
	    $need[] = $keyfield;
        if (count($need) == 1) {        	
	        foreach ($fields as $k => $v){
	            $errCode = $req->need($k);
	            if($errCode != 0){
	                $this->errCode = 20022;
	                $this->errMsg  = "ttc config:{$this->ttcKey} need({$k}) error,error code:{$errCode}";
	                return false;
	            }
	        }
        }else 
        {
        	foreach ($need as $k) {  
        		$errCode = $req->need($k);
	            if($errCode != 0){
	                $this->errCode = 20022;
	                $this->errMsg  = "ttc config:{$this->ttcKey} need({$k}) error,error code:{$errCode}";
	                return false;
	            }
        	}
        }
 
        $result = new tphp_ttc_result();
        $req->execute($result);
        $this->result = $result;
        $errCode = $result->result_code();
        if ($errCode != 0) {
            $this->ttcCode = $errCode;
            $this->errCode = 20023;
            $this->errMsg  = "ttc config:{$this->ttcKey} get:{" . implode(",", $key_arr) . "} error,error code:{$errCode}";
            return false;
        }
        $rowCount = $result->num_rows();
        $multiRows = array();
		
        for ($i = 0 ; $i < $rowCount; ++$i)
        {           
            $ret = $result->fetch_row();
            if ($ret < 0)
            {
                $this->errCode = 20026;
                $this->errMsg  = "ttc config:{$this->ttcKey} get:{" . implode(",", $key_arr) . "} error,fetch_row error";
                return false;
            }
            $rData = array();
            if (count($need) == 1) {
            	 foreach ($fields as $k => $v){            	 	
	                switch ($v['type']){
	                    case TTC2::INT :
	                        $rData[$k] = $result->int_value($k);
	                        break;
	                    case TTC2::STRING :
	                        $rData[$k] = $result->string_value($k);
	                        break;
	                    case TTC2::BINARY :
	                        $rData[$k] = $result->binary_value($k);
	                        break;
	                    case TTC2::FLOAT  :
	                        $rData[$k] = $result->float_value($k);
	                        break;
	                    default:
	                        $this->errCode = 20027;
	                        $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
	                        return false;
	                }
	            }
	            $multiRows[] = $rData;
	        }else 
	        {
	        	foreach ($need as $k){
	                switch ($fields[$k]['type']){
	                    case TTC2::INT :
	                        $rData[$k] = $result->int_value($k);
	                        break;
	                    case TTC2::STRING :
	                        $rData[$k] = $result->string_value($k);
	                        break;
	                    case TTC2::BINARY :
	                        $rData[$k] = $result->binary_value($k);
	                        break;
	                    case TTC2::FLOAT  :
	                        $rData[$k] = $result->float_value($k);
	                        break;
	                    default:
	                        $this->errCode = 20027;
	                        $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
	                        return false;
	                }
	            }
	            $multiRows[] = $rData;
	        }
         }
        return $multiRows;
		
	}
	
	/**
	 * 获得TTC记录
	 *
	 * @param array			$key_arr, 键值数组
	 * @param array			$multikey_arr, 二维数组, 可选参数, 当键为多字段 key 时, 为其他字段键值数组,
	 * 										如 array(
	 * 											array('k1'=>1,'k2'=>2),
	 * 											array('k1'=>3,'k2'=>4)
	 * 											)
	 */
	private  function get_in($key_arr, $multikey_arr = array())
	{
		if (empty($key_arr)) {
			return array();
		}
		$this->clearERR();
		if ( empty($key_arr) || !is_array($key_arr) ) {
			$this->errCode = 20006;
			$this->errMsg  = "invalid parameter";
			return false;
		}
		if ( count($key_arr) > 32 ) {
			$this->errCode = 20007;
			$this->errMsg  = "too much key";
			return false;
		}
		if ( $this->server == false && $this->init() == false ) {
			return false;
		}
		// 若为多字段 key 时, 暂存其他字段的字段名
		$mk_arr = array();
		// 若主键为整型, 且有多字段key, 添加其他字段(注意:server在v3.3.1之前版本对整型多字段key支持有bug)
		if ( $this->keytype == TPHP_TTC_KEY_TYPE_INT && !empty($multikey_arr) && is_array($multikey_arr) ) {
			if ( count($key_arr) != count($multikey_arr) ) {
				$this->errCode = 20040;
				$this->errMsg  = "key array count is not equal multikey_key array count";
				return false;
			}

			if ( $this->addMultikey($this->server, $multikey_arr) == false ) {
				return false;
			}

			foreach ( $multikey_arr[0] as $fk => $v ) {
				$mk_arr[] = $fk;
			}

			##### 其他key字段参数数组去重 #####
			$param_temp = array();
			foreach ($key_arr as $mst_k => $mst_v) {
				$stamp = print_r($mst_v, true) . print_r($multikey_arr[$mst_k], true);
				if ( in_array($stamp, $param_temp) ) {
					unset($key_arr[$mst_k]);
					unset($multikey_arr[$mst_k]);
				} else {
					$param_temp[] = $stamp;
				}
			}
			$multikey_arr = array_values($multikey_arr);
		} else {
			// 若为非多字段key时, 传入key数组做去重处理
			$key_arr = array_unique($key_arr);
		}

		####### 注意: 去重处理会保留数组下标, 需重新整理key数组的下标 #######
		$key_arr = array_values($key_arr);

		$req = new tphp_ttc_request($this->server, TPHP_TTC_OP_GET);
		// 设置请求的key值
		$i = 0;
		foreach ( $key_arr as $k => $v ) {
			if ( $this->checkKey($v) == false ) {
				return false;
			}
			if ( $this->keytype == TPHP_TTC_KEY_TYPE_INT ) {
				$errCode = $req->addkey_value($this->config['KEY'], $v);
			} else {
				$errCode = $req->addkey_value_str($this->config['KEY'], $v);
			}
			if ( $errCode != 0 ) {
				$this->errCode = 20021;
				$this->errMsg  = "ttc config:{$this->ttcKey} get:" . $this->config['KEY'] ."; add key value error";
				return false;
			}
			// 处理多字段key情况, 字段需均为整型
			if ( $this->keytype == TPHP_TTC_KEY_TYPE_INT && !empty($multikey_arr) && is_array($multikey_arr) ) {
				$multikey = $multikey_arr[$i];
				foreach ( $multikey as $mk => $mv ) {
					$chk = $this->checkMultikey($mk, $mv);
					if ( !$chk ) {
						return $chk;
					}
					if ( $this->config['FIELDS'][$mk]['type'] == 1 ) {
						$addval = $req->addkey_value($mk, $mv);
					} else {
						$this->errCode = 20029;
						$this->errMsg  = "ttc config:{$this->ttcKey} get:{$mk}; multikey key type error";
						return false;
					}
					if ( $addval != 0 ) {
						$this->errCode = 20028;
						$this->errMsg  = "ttc config:{$this->ttcKey} get:{$mk}; multikey addkey_value error";
						return false;
					}
				}
				++$i;
			}
		}
		$fields = $this->config['FIELDS'];
		$key	= $this->config['KEY'];
		foreach ( $fields as $k => $v ) {
			$errCode = $req->need($k);
			if ( $errCode != 0 ) {
				$this->errCode = 20022;
				$this->errMsg  = "ttc config:{$this->ttcKey} need({$k}) error,error code:{$errCode}";
				return false;
			}
		}
		$result = new tphp_ttc_result();
		$req->execute($result);
		$errCode = $result->result_code();
		if ( $errCode != 0 ) {
			$this->ttcCode = $errCode;
			$this->errCode = 20023;
			$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,error code:{$errCode}";
			return false;
		}
		$rowCount = $result->num_rows();
		if ( $rowCount == 0 ) {
			return  array();
		}

		$ret_arr = array();
		for ( $i = 0; $i < $rowCount; $i++ ) {

			$ret = $result->fetch_row();
			if ( $ret < 0 ) {
				$this->errCode = 20026;
				$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,fetch_row error";
				return false;
			}

			$rData = array();
			foreach ( $fields as $k => $v ) {
				switch ( $v['type'] ) {
					case TTC2::INT :
						$rData[$k] = $result->int_value($k);
						break;
					case TTC2::STRING :
						$rData[$k] = $result->string_value($k);
						break;
					case TTC2::BINARY :
						$rData[$k] = $result->binary_value($k);
						break;
					case TTC2::FLOAT  :
						$rData[$k] = $result->float_value($k);
						break;
					default:
						$this->errCode = 20027;
						$this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
						return false;
				}
			}

			array_push($ret_arr,$rData) ;
		}
		return $ret_arr;
	}

	/**
	 * 针对多字段 key, 将主键以外的字段_key, 添加到 server 对象
	 *
	 * @param	tphp_ttc_s	$svr, TTC server 对象引用
	 * @param	array			$multikey,键值数组, 形如:
	 *									array (
	 * 										array('field1' => 'val1', 'field2' => 'val2'),
	 * 										array('field1' => 'val3', 'field2' => 'val4')
	 * 									)
	 */
	private function addMultikey(&$svr, $multikey) {
		if ( empty($multikey) ) {
			return true;
		}

		// 验证每组 key 字段数是否一致
		foreach ( $multikey as $val ) {
			if ( !isset($cnt) ) {
				$cnt = count($val);
				continue;
			} elseif ( $cnt != count($val) ) {
				return false;
			}
		}

		$keys = $multikey[0];

		foreach ( $keys as $k => $v ) {
			if ( !isset($this->config['FIELDS'][$k]) ) {
				$this->errCode = 20064;
				$this->errMsg = "ttc config:{$this->ttcKey} field:{$k} not exists";
				return false;
			}

			$fld = $this->config['FIELDS'][$k];

			// 批量取只支持整型和字符, 多字段 key 只支持整型
			if ( $fld['type'] == 1 ) {
				$key_type = TPHP_TTC_KEY_TYPE_INT;
			} else {
				$this->errCode = 20068;
				$this->errMsg  = "ttc config:{$this->ttcKey}, add multikey {$k} key type error";
				return false;
			}

			$svr->add_key($k, $key_type);
		}

		return true;
	}

	/**
	 * 检测数据是否合法
	 *
	 * @param key    表的主键
	 */
	public function checkKey(&$key)
	{
		$this->clearERR();
		$v = $this->config['FIELDS'][$this->config['KEY']];
		switch($v['type']){
			case TTC2::INT:
			case TTC2::FLOAT :
				$ret = ($v['min'] <= $key && $key <= $v['max']);
				if($ret == false){
					$this->errCode = 20061;
					$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
				} else {
					$key = 0 + $key;
				}
				return $ret;
			case TTC2::STRING:
				$len = strlen($key);
				$ret = ($v['min'] <= $len && $len <= $v['max']);
				if ($ret === false) {
					$this->errCode = 20062;
					$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
				} else {
					$key = '' . $key;
				}
				return $ret;
			case TTC2::BINARY:
				//TODO...
				return true;
			default:
				$this->errCode = 20063;
				$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} data type:{$v['type']} error";
				return false;
		}
	}

	/**
	 * 检测多字段key情况下，除主key外的其他key字段
	 *
	 * @param	string	$key, key字段名
	 * @param	mix		$val, key字段值(引用), 若检测通过, 根据字段类型同时进行类型转换, 避免参数类型错误
	 * @return	boolean
	 */
	private function checkMultikey($key, &$val)
	{
		if ( !isset($this->config['FIELDS'][$key]) ) {
			$this->errCode = 20064;
			$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} not exists";
			return false;
		}
		$field = $this->config['FIELDS'][$key];
		switch($field['type']){
			case TTC2::INT:
			case TTC2::FLOAT :
				$ret = ($field['min'] <= $val && $val <= $field['max']);
				if($ret == false){
					$this->errCode = 20065;
					$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
				} else {
					$val = 0 + $val;
				}
				return $ret;
			case TTC2::STRING:
				$len = strlen($val);
				$ret = ($field['min'] <= $len && $len <= $field['max']);
				if ($ret === false) {
					$this->errCode = 20066;
					$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
				} else {
					$val = '' . $val;
				}
				return $ret;
			case TTC2::BINARY:
				//TODO...
				return true;
			default:
				$this->errCode = 20067;
				$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} data type:{$field['type']} error";
				return false;
		}
	}

	/**
	 * 为request对象添加请求条件(通常为多字段key情况下，附加其他key)
	 *
	 * @param	tphp_ttc_request	$req, ttc请求对象
	 * @param	string				$key, 字段名
	 * @param	mix					$val, 字段值
	 * @return	int					$ret
	 */
	private function eqv(&$req, $key, $val) {
		if ( is_string($val) ) {
			$ret = $req->eq_str($key, $val);
		} elseif ( is_numeric($val) ) {
			$ret = $req->eq($key, $val);
		}

		return $ret;
	}

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private function clearERR()
	{
		$this->errCode = 0;
		$this->errMsg  = '';
		$this->ttcCode = 0;
	}
}

//End Of Script
