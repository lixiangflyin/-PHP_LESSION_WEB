<?php
if ( !defined('TPHP_TTC_OP_GET') ) {
    define( "TPHP_TTC_OP_GET", 4 );
}

if ( !defined('TPHP_TTC_OP_SELECT') ) {
    define( "TPHP_TTC_OP_SELECT", 4 );
}

define( "TPHP_TTC_OP_PURGE",    5 );
define( "TPHP_TTC_OP_INSERT",   6 );
define( "TPHP_TTC_OP_UPDATE",   7 );
define( "TPHP_TTC_OP_DELETE",   8 );
define( "TPHP_TTC_OP_REPLACE",  9 );
define( "TPHP_TTC_OP_FLUSH",    13 );

/**
 * 封装TTC的一些API
 * @author ericfu
 * @version 1.0
 * @updated 06-十一月-2008 18:16:40
 */
class TTC
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

    private $key_type;

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

        if ( @!extension_loaded('tphp_ttc') ) {
            if ( @!ini_get("safe_mode") && ini_get("enable_dl") ) {
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
            // 此处加入对字符串key的支持
            $this->key_type = $this->config['FIELDS'][$this->config['KEY']]['type'];
            if ( $this->key_type == 1 ) {
                $errCode = $this->server->int_key();
            } elseif ( $this->key_type == 2 ) {
                $errCode = $this->server->string_key();
            } else  {
                $this->errCode = 20005;
                $this->errMsg  = 'invalid key type';
                $this->server->close();
                return false;
            }
            if ($errCode != 0) {
                $this->errCode = 20004;
                $this->errMsg  = $this->server->error_message();
                $this->server->close();
                return false;
            }
        }
        return true;
    }

    /**
     * 删除一条数据库记录
     *
     * @param key    数据库的主键
     */
    public function delete($key, $multikey = array())
    {
        $this->clearERR();
        if (($this->server == false) && ($this->init() == false)) {
            return false;
        }
        if ($this->checkKey($key) == false) {
            return false;
        }
        $req = new tphp_ttc_request($this->server, TPHP_TTC_OP_DELETE);
        if ( $this->key_type == 1 ) {
            $errCode = $req->set_key($key);
        } elseif ( $this->key_type == 2 ) {
            $errCode = $req->set_key_str($key);
        } else {
            return false;
        }
        if($errCode != 0){
            $this->errCode = 20011;
            $this->errMsg  = "ttc config:{$this->ttcKey} delete:{$key}: set_key error";
            return false;
        }
        if ( !empty($multikey) && is_array($multikey) ) {
            // 处理多字段key情况
            foreach ( $multikey as $mk => $mv ) {
                $chk = $this->checkMultikey($mk, $mv);
                if ( !$chk ) {
                    return $chk;
                }
                $eq = $this->eqv($req, $mk, $mv);
                if ( $eq != 0 ) {
                    $this->errCode = 20013;
                    $this->errMsg  = "ttc config:{$this->ttcKey} delete:{$key}: set multikey error";
                    return false;
                }
            }
        }
        $result = new tphp_ttc_result();
        $ret = $req->execute($result);
        $this->result = $result;
        //TODO ...
        $errCode = $result->result_code();
        if ($errCode != 0) {
            $this->ttcCode = $errCode;
            $this->errCode = 20012;
            $this->errMsg  = "ttc config:{$this->ttcKey} delete:{$key} error,error code:{$errCode}";
            return false;
        }
        return true;
    }
    
     public function getAffectRows()
    {
        if ( !empty( $this->result ) )
        {
            return $this->result->affected_rows();
        }
        else
        {
            return -1;
        }
    }

    /**
     * 获得TTC记录
     *
     * @param   string  $key, 数据库的主键
     * @param   array   $multikey, 可选参数, 多字段key时必选, 形如array('field2' => 1, 'field3' => 2)
     * @param   array    $need, 可选参数, 默认返回所有列，也可以指明需要返回的列
     * @param   int    $start, 可选参数, 默认从第一条符合条件的记录开始返回，也可指定返回记录的起始偏移量
     * * @param   int    $need, 可选参数, 默认返回所有符合条件的记录，也可指明需要的条数
     */
    public function get($key, $multikey = array(), $need = array(), $itemLimit = 0, $start = 0)
    {
        $this->clearERR();
        if (($this->server == false) && ($this->init() == false)) {
            return false;
        }
        if ($this->checkKey($key) == false) {
            return false;
        }
        $req = new tphp_ttc_request($this->server, TPHP_TTC_OP_GET);
        if ( $this->key_type == 1 ) {
            $errCode = $req->set_key($key);
        } elseif ( $this->key_type == 2 ) {
            $errCode = $req->set_key_str($key);
        } else {
            return false;
        }
        if($errCode != 0){
            $this->errCode = 20021;
            $this->errMsg  = "ttc config:{$this->ttcKey} get:{$key}: set_key error";
            return false;
        }
        if ( !empty($multikey) && is_array($multikey) ) {
            // 处理多字段key情况
            foreach ( $multikey as $mk => $mv ) {
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
	    
        if (empty($need)) {
        	
	        foreach ($fields as $k => $v){
	            if ($keyfield == $k){
	                continue;
	            }
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
        		if ($keyfield == $k){
	                continue;
	            }
        		$errCode = $req->need($k);
	            if($errCode != 0){
	                $this->errCode = 20022;
	                $this->errMsg  = "ttc config:{$this->ttcKey} need({$k}) error,error code:{$errCode}";
	                return false;
	            }
        	}
        }
        if (0 != $itemLimit) {
        	$errCode = $req->limit($start, $itemLimit);
        	if ($errCode != 0) {
        		$this->ttcCode = $errCode;
	            $this->errCode = 20028;
	            $this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,error code:{$errCode}";
	            return false;
        	}
        	
        }
        $result = new tphp_ttc_result();
        $req->execute($result);
        $this->result = $result;
        $errCode = $result->result_code();
        if ($errCode != 0) {
            $this->ttcCode = $errCode;
            $this->errCode = 20023;
            $this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,error code:{$errCode}";
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
                $this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,fetch_row error";
                return false;
            }
            $rData = array();
            if (empty($need)) {
            	 foreach ($fields as $k => $v){
	                if ($k == $keyfield) {
	                    continue;
	                }
	                switch ($v['type']){
	                    case TTC::INT :
	                        $rData[$k] = $result->int_value($k);
	                        break;
	                    case TTC::STRING :
	                        $rData[$k] = $result->string_value($k);
	                        break;
	                    case TTC::BINARY :
	                        $rData[$k] = $result->binary_value($k);
	                        break;
	                    case TTC::FLOAT  :
	                    	 $rData[$k] = $result->float_value($k);
	                    	 break;
	                    default:
	                        $this->errCode = 20027;
	                        $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
	                        return false;
	                }
	            }
	            $rData[$keyfield] = $key;
	            $multiRows[] = $rData;
	        }else 
	        {
	        	foreach ($need as $k){
	                if ($k == $keyfield) {
	                    continue;
	                }
	                switch ($fields[$k]['type']){
	                    case TTC::INT :
	                        $rData[$k] = $result->int_value($k);
	                        break;
	                    case TTC::STRING :
	                        $rData[$k] = $result->string_value($k);
	                        break;
	                    case TTC::BINARY :
	                        $rData[$k] = $result->binary_value($k);
	                        break;
	                    case TTC::FLOAT  :
	                        $rData[$k] = $result->float_value($k);
	                        break;
	                    default:
	                        $this->errCode = 20027;
	                        $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
	                        return false;
	                }
	            }
	            $rData[$keyfield] = $key;
	            $multiRows[] = $rData;
	        }
         }
        return $multiRows;
    }

    /**
     * 获得TTC记录
     *
     * @param   string  $key, 数据库的主键
     * @param   array   $eqs, 可选参数, 多字段key时必选, 形如array('field2' => 1, 'field3' => 2)
     * @param   array    $need, 可选参数, 默认返回所有列，也可以指明需要返回的列
     * @param   int    $start, 可选参数, 默认从第一条符合条件的记录开始返回，也可指定返回记录的起始偏移量
     * * @param   int    $need, 可选参数, 默认返回所有符合条件的记录，也可指明需要的条数
     */
    public function getc($key, $eqs = array(), $lts = array(), $gts = array(), $need = array(), $itemLimit = 0, $start = 0)
    {
    	$this->clearERR();
    	if (($this->server == false) && ($this->init() == false)) {
    		return false;
    	}
    	if ($this->checkKey($key) == false) {
    		return false;
    	}
    	$req = new tphp_ttc_request($this->server, TPHP_TTC_OP_GET);
    	if ( $this->key_type == 1 ) {
    		$errCode = $req->set_key($key);
    	} elseif ( $this->key_type == 2 ) {
    		$errCode = $req->set_key_str($key);
    	} else {
    		return false;
    	}
    	if($errCode != 0){
    		$this->errCode = 20021;
    		$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key}: set_key error";
    		return false;
    	}
    	if ( !empty($eqs) && is_array($eqs) ) {
    		// 处理多字段key情况
    		foreach ( $eqs as $mk => $mv ) {
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

    	if ( !empty($lts) && is_array($lts) ) {
    		foreach ( $lts as $mk => $mv ) {
    			if (!$this->checkFieldCanLtGt($mk)){
    				// TODO: need to modify?
    				continue;
    			}

    			$lt = $req->lt($mk, $mv);
    			if ( $lt != 0 ) {
    				$this->errCode = 20038;
    				$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key}: set multikey error";
    				return false;
    			}
    		}
    	}
  
    	if ( !empty($gts) && is_array($gts) ) {
    		foreach ( $gts as $mk => $mv ) {
    			if (!$this->checkFieldCanLtGt($mk)){
    				// TODO: need to modify?
    				continue;
    			}
    	
    			$gt = $req->gt($mk, $mv);
    			if ( $gt != 0 ) {
    				$this->errCode = 20039;
    				$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key}: set multikey error";
    				return false;
    			}
    		}
    	}

    	$fields = $this->config['FIELDS'];
    	$keyfield   = $this->config['KEY'];
    	 
    	if (empty($need)) {
    		 
    		foreach ($fields as $k => $v){
    			if ($keyfield == $k){
    				continue;
    			}
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
    			if ($keyfield == $k){
    				continue;
    			}
    			$errCode = $req->need($k);
    			if($errCode != 0){
    				$this->errCode = 20022;
    				$this->errMsg  = "ttc config:{$this->ttcKey} need({$k}) error,error code:{$errCode}";
    				return false;
    			}
    		}
    	}
    	if (0 != $itemLimit) {
    		$errCode = $req->limit($start, $itemLimit);
    		if ($errCode != 0) {
    			$this->ttcCode = $errCode;
    			$this->errCode = 20028;
    			$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,error code:{$errCode}";
    			return false;
    		}
    	}
    	$result = new tphp_ttc_result();
    	$req->execute($result);
    	$this->result = $result;
    	$errCode = $result->result_code();
    	if ($errCode != 0) {
    		$this->ttcCode = $errCode;
    		$this->errCode = 20023;
    		$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,error code:{$errCode}";
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
    			$this->errMsg  = "ttc config:{$this->ttcKey} get:{$key} error,fetch_row error";
    			return false;
    		}
    		$rData = array();
    		if (empty($need)) {
    			foreach ($fields as $k => $v){
    				if ($k == $keyfield) {
    					continue;
    				}
    				switch ($v['type']){
    					case TTC::INT :
    						$rData[$k] = $result->int_value($k);
    						break;
    					case TTC::STRING :
    						$rData[$k] = $result->string_value($k);
    						break;
    					case TTC::BINARY :
    						$rData[$k] = $result->binary_value($k);
    						break;
    					case TTC::FLOAT  :
    						$rData[$k] = $result->float_value($k);
    						break;
    					default:
    						$this->errCode = 20027;
    						$this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
    						return false;
    				}
    			}
    			$rData[$keyfield] = $key;
    			$multiRows[] = $rData;
    		}else
    		{
    			foreach ($need as $k){
    				if ($k == $keyfield) {
    					continue;
    				}
    				switch ($fields[$k]['type']){
    					case TTC::INT :
    						$rData[$k] = $result->int_value($k);
    						break;
    					case TTC::STRING :
    						$rData[$k] = $result->string_value($k);
    						break;
    					case TTC::BINARY :
    						$rData[$k] = $result->binary_value($k);
    						break;
    					case TTC::FLOAT  :
    						$rData[$k] = $result->float_value($k);
    						break;
    					default:
    						$this->errCode = 20027;
    						$this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
    						return false;
    				}
    			}
    			$rData[$keyfield] = $key;
    			$multiRows[] = $rData;
    		}
    	}
    	return $multiRows;
    }
    /**
     * 更新一条数据库记录
     *
     * @param $data    数据
     */
    public function update($data, $multikey = array())
    {
        $this->clearERR();
        if (($this->server == false) && ($this->init() == false)) {
            return false;
        }
        $key = $this->config['KEY'];
        if (!isset($data[$key])) {
            $this->errCode = 20031;
            $this->errMsg  = "ttc config:{$this->ttcKey} update key not set";
            return false;
        }
        if (($this->check($data) == false)) {
            return false;
        }
        $fields = $this->config['FIELDS'];
        $req = new tphp_ttc_request($this->server, TPHP_TTC_OP_UPDATE);
        if ( $this->key_type == 1 ) {
            $errCode = $req->set_key($data[$key]);
        } elseif ( $this->key_type == 2 ) {
            $errCode = $req->set_key_str($data[$key]);
        } else {
            return false;
        }
        if($errCode != 0){
            $this->errCode = 20032;
            $this->errMsg  = "ttc config:{$this->ttcKey} update:{$key}: set_key error";
            return false;
        }
        if ( !empty($multikey) && is_array($multikey) ) {
            // 处理多字段key情况
            foreach ( $multikey as $mk => $mv ) {
                $chk = $this->checkMultikey($mk, $mv);
                if ( !$chk ) {
                    return $chk;
                }
                $eq = $this->eqv($req, $mk, $mv);
                if ( $eq != 0 ) {
                    $this->errCode = 20036;
                    $this->errMsg  = "ttc config:{$this->ttcKey} update:{$key}: set multikey error";
                    return false;
                }
            }
        }
        foreach ($data as $k => $v){
            if ($k == $key || array_key_exists($k, $multikey)) {
                continue;
            }
            if ( !isset($fields[$k]) ) {
                continue;
            }
            $tmpConfig = $fields[$k];
            switch($tmpConfig['type']){
                case TTC::INT:
                    $data[$k] = $data[$k] + 0; // 确保类型正确,否则ttc扩展报warnning
                    $req->set($k, $data[$k]);
                    break;
                case TTC::STRING:
                    $data[$k] = $data[$k] . ''; // 确保类型正确,否则ttc扩展报warnning
                    $req->set_str($k, $data[$k]);
                    break;
                case TTC::BINARY:
                    $data[$k] = $data[$k] . ''; // 确保类型正确,否则ttc扩展报warnning
                    $req->set_bin($k, $data[$k]);
                    break;
                case TTC::FLOAT :
                    $data[$k] = $data[$k] . ''; // 确保类型正确,否则ttc扩展报warnning
                    $req->set_flo($k, $data[$k]);
                    break;
                default:
                    $this->errCode = 20033;
                    $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
                    return false;
            }
        }
        $result = new tphp_ttc_result();
        $req->execute($result);
        $this->result = $result;
        $errCode = $result->result_code();
        if ($errCode != 0) {
            $this->ttcCode = $errCode;
            $this->errCode = 20034;
            $this->errMsg  = "ttc config:{$this->ttcKey} update:{$data[$key]} error,error code:{$errCode}";
            return false;
        }
        return true;
    }

    /**
     * 增加一条数据库记录
     *
     * @param data    需要insert 的数据
     */
    public function insert($data)
    {
        $this->clearERR();
        if (($this->server == false) && ($this->init() == false)) {
            return false;
        }
        if ($this->check($data) == false) {
            return false;
        }
        $key = $this->config['KEY'];
        $fields = $this->config['FIELDS'];
        $keyConfig = $fields[$key];
        if (!isset($data[$key]) && $keyConfig['auto'] == false) {
            $this->errCode = 20041;
            $this->errMsg  = "ttc config:{$this->ttcKey} insert key not set";
            return false;
        }
        $req = new tphp_ttc_request($this->server, TPHP_TTC_OP_INSERT);
        if (isset($data[$key])) {
            if ( $this->key_type == 1 ) {
                $errCode = $req->set_key($data[$key]);
            } elseif ( $this->key_type == 2 ) {
                $errCode = $req->set_key_str($data[$key]);
            } else {
                return false;
            }
            if($errCode != 0){
                $this->errCode = 20042;
                $this->errMsg  = "ttc config:{$this->ttcKey} insert:{$key}: set_key error";
                return false;
            }
        }
        foreach ($data as $k => $v){
            if ($k == $key) {
                continue;
            }
            if ( !isset($fields[$k]) ) {
                continue;
            }
            $tmpConfig = $fields[$k];
            switch($tmpConfig['type']){
                case TTC::INT:
                    $data[$k] = $data[$k] + 0; // 确保类型正确,否则ttc扩展报warnning
                    $req->set($k, $data[$k]);
                    break;
                case TTC::STRING:
                    $data[$k] = $data[$k] . ''; // 确保类型正确,否则ttc扩展报warnning
                    $req->set_str($k, $data[$k]);
                    break;
                case TTC::BINARY:
                    $data[$k] = $data[$k] . ''; // 确保类型正确,否则ttc扩展报warnning
                    $req->set_bin($k, $data[$k]);
                    break;
                case TTC::FLOAT :
                    $data[$k] = $data[$k] . ''; // 确保类型正确,否则ttc扩展报warnning
                    $req->set_flo($k, $data[$k]);
                    break;
                default:
                    $this->errCode = 20043;
                    $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
                    return false;
            }
        }
        $result = new tphp_ttc_result();
        $req->execute($result);
        $this->result = $result;
        //TODO...
        $errCode = $result->result_code();
        if ($errCode != 0) {
            $this->ttcCode = $errCode;
            $this->errCode = 20044;
            $k_val = isset($data[$key]) ? $data[$key] : '[auto_increment]';
            $this->errMsg  = "ttc config:{$this->ttcKey} insert:{$k_val} error,code:{$errCode}";
            return false;
        }
        // 若为自增型key，返回insert_id
        if ( !isset($data[$key]) && $keyConfig['auto'] ) {
            return $result->int_key();
        }
        return true;
    }

    /**
     * 整形字段自增
     *
     * @param   array   $key_arr, key数组
     * @param   string  $fld, 字段名,必须为整形字段
     * @param   int     $val, 自增值
     * @return  boolean
     */
    public function increment($key_arr, $fld, $val = 1)
    {
        $this->clearERR();
        if (($this->server == false) && ($this->init() == false)) {
            return false;
        }
        $key = $this->config['KEY'];
        if (!isset($key_arr[$key])) {
            $this->errCode = 20071;
            $this->errMsg  = "ttc config:{$this->ttcKey} increment key not set";
            return false;
        }
        $fields = $this->config['FIELDS'];
        if ( !array_key_exists($fld, $fields) ) {
            $this->errCode = 20072;
            $this->errMsg  = "ttc config:{$this->ttcKey} increment no field name $fld";
            return false;
        }
        $val = intval($val);
        if ( $val < 1 ) {
            $this->errCode = 20073;
            $this->errMsg  = "ttc config:{$this->ttcKey} invalid increment value";
            return false;
        }
        $req = new tphp_ttc_request($this->server, TPHP_TTC_OP_UPDATE);
        if ( $this->key_type == 1 ) {
            $errCode = $req->set_key($key_arr[$key]);
        } elseif ( $this->key_type == 2 ) {
            $errCode = $req->set_key_str($key_arr[$key]);
        } else {
            return false;
        }
        if($errCode != 0){
            $this->errCode = 20074;
            $this->errMsg  = "ttc config:{$this->ttcKey} increment:{$key}: set_key error";
            return false;
        }
        if ( count($key_arr) > 1 ) {
            // 处理多字段key情况
            foreach ( $key_arr as $mk => $mv ) {
                if ($mk == $key) {
                    continue;
                }
                $chk = $this->checkMultikey($mk, $mv);
                if ( !$chk ) {
                    return $chk;
                }
                $eq = $this->eqv($req, $mk, $mv);
                if ( $eq != 0 ) {
                    $this->errCode = 20075;
                    $this->errMsg  = "ttc config:{$this->ttcKey} increment:{$key}: set multikey error";
                    return false;
                }
            }
        }
        $add = $req->add($fld, $val);
        if ( $add != 0 ) {
            $this->errCode = 20076;
            $this->errMsg  = "ttc config:{$this->ttcKey} increment:{$key}: add error";
            return false;
        }
        $result = new tphp_ttc_result();
        $req->execute($result);
        $this->result = $result;
        $errCode = $result->result_code();
        if ($errCode != 0) {
            $this->ttcCode = $errCode;
            $this->errCode = 20077;
            $this->errMsg  = "ttc config:{$this->ttcKey} increment:{$key} error,error code:{$errCode}";
            return false;
        }
        return true;
    }

    /**
     * 整形字段自减
     *
     * @param   array   $key_arr, key数组
     * @param   string  $fld, 字段名,必须为整形字段
     * @param   int     $val, 自减值
     * @return  boolean
     */
    public function decrement($key_arr, $fld, $val = 1)
    {
        $this->clearERR();
        if (($this->server == false) && ($this->init() == false)) {
            return false;
        }
        $key = $this->config['KEY'];
        if (!isset($key_arr[$key])) {
            $this->errCode = 20081;
            $this->errMsg  = "ttc config:{$this->ttcKey} decrement key not set";
            return false;
        }
        $fields = $this->config['FIELDS'];
        if ( !array_key_exists($fld, $fields) ) {
            $this->errCode = 20082;
            $this->errMsg  = "ttc config:{$this->ttcKey} decrement no field name $fld";
            return false;
        }
        $val = intval($val);
        if ( $val < 1 ) {
            $this->errCode = 20083;
            $this->errMsg  = "ttc config:{$this->ttcKey} invalid decrement value";
            return false;
        }
        $req = new tphp_ttc_request($this->server, TPHP_TTC_OP_UPDATE);
        if ( $this->key_type == 1 ) {
            $errCode = $req->set_key($key_arr[$key]);
        } elseif ( $this->key_type == 2 ) {
            $errCode = $req->set_key_str($key_arr[$key]);
        } else {
            return false;
        }
        if($errCode != 0){
            $this->errCode = 20084;
            $this->errMsg  = "ttc config:{$this->ttcKey} decrement:{$key}: set_key error";
            return false;
        }
        if ( count($key_arr) > 1 ) {
            // 处理多字段key情况
            foreach ( $key_arr as $mk => $mv ) {
                if ($mk == $key) {
                    continue;
                }
                $chk = $this->checkMultikey($mk, $mv);
                if ( !$chk ) {
                    return $chk;
                }
                $eq = $this->eqv($req, $mk, $mv);
                if ( $eq != 0 ) {
                    $this->errCode = 20085;
                    $this->errMsg  = "ttc config:{$this->ttcKey} decrement:{$key}: set multikey error";
                    return false;
                }
            }
        }
        $add = $req->sub($fld, $val);
        if ( $add != 0 ) {
            $this->errCode = 20086;
            $this->errMsg  = "ttc config:{$this->ttcKey} decrement:{$key}: sub error";
            return false;
        }
        $result = new tphp_ttc_result();
        $req->execute($result);
        $this->result = $result;
        $errCode = $result->result_code();
        if ($errCode != 0) {
            $this->ttcCode = $errCode;
            $this->errCode = 20087;
            $this->errMsg  = "ttc config:{$this->ttcKey} decrement:{$key} error,error code:{$errCode}";
            return false;
        }
        return true;
    }

    /**
     * 检测数据是否合法
     *
     * @param data    数据
     * @param type    1:insert, 2:update 3:delete 4:get
     */
    public function check(&$data)
    {
        $this->clearERR();
        $fields = $this->config['FIELDS'];
        foreach ($fields as $k => $v){
            if (!isset($data[$k])) {
                continue;
            }
            switch ($v['type']){
                case TTC::INT :
                case TTC::FLOAT :
                    if ($v['min'] > $data[$k] || $data[$k] > $v['max']) {
                        $this->errCode = 20051;
                        $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} error";
                        return false;
                    } else {
                        $data[$k] = 0 + $data[$k];
                    }
                    break;
                case TTC::STRING :
                    $len = strlen($data[$k]);
                    if ($v['min'] > $len || $len > $v['max']) {
                        $this->errCode = 20052;
                        $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} error";
                        return false;
                    } else {
                        $data[$k] = '' . $data[$k];
                    }
                    break;
                case TTC::BINARY :
                    $len = strlen($data[$k]);
                    if ($v['min'] > $len || $len > $v['max']) {
                        $this->errCode = 20053;
                        $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} error";
                        return false;
                    } else {
                        $data[$k] = '' . $data[$k];
                    }
                    break;
                default:
                    $this->errCode = 20054;
                    $this->errMsg  = "ttc config:{$this->ttcKey} field:{$k} data type:{$v['type']} error";
                    return false;
            }
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
            case TTC::INT:
            case TTC::FLOAT :
                $ret = ($v['min'] <= $key && $key <= $v['max']);
                if($ret == false){
                    $this->errCode = 20061;
                    $this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
                } else {
                    $key = 0 + $key;
                }
                return $ret;
            case TTC::STRING:
                $len = strlen($key);
                $ret = ($v['min'] <= $len && $len <= $v['max']);
                if ($ret === false) {
                    $this->errCode = 20062;
                    $this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
                } else {
                    $key = '' . $key;
                }
                return $ret;
            case TTC::BINARY:
                //TODO...
                return true;
            default:
                $this->errCode = 20063;
                $this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} data type:{$v['type']} error";
                return false;
        }
    }

    private function checkFieldCanLtGt($key){
    	if ( !isset($this->config['FIELDS'][$key]) ) {
    		$this->errCode = 20064;
    		$this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} not exists";
    		return false;
    	}
    	$field = $this->config['FIELDS'][$key];
    	return $field['type'] == TTC::INT;
    }

    /**
     * 检测多字段key情况下，除主key外的其他key字段
     *
     * @param   string  $key, key字段名
     * @param   mix     $val, key字段值(引用), 若检测通过, 根据字段类型同时进行类型转换, 避免参数类型错误
     * @return  boolean
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
            case TTC::INT:
            case TTC::FLOAT :
                $ret = ($field['min'] <= $val && $val <= $field['max']);
                if($ret == false){
                    $this->errCode = 20065;
                    $this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
                } else {
                    $val = 0 + $val;
                }
                return $ret;
            case TTC::STRING:
                $len = strlen($val);
                $ret = ($field['min'] <= $len && $len <= $field['max']);
                if ($ret === false) {
                    $this->errCode = 20066;
                    $this->errMsg  = "ttc config:{$this->ttcKey} field:{$key} error";
                } else {
                    $val = '' . $val;
                }
                return $ret;
            case TTC::BINARY:
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
     * @param   tphp_ttc_request    $req, ttc请求对象
     * @param   string              $key, 字段名
     * @param   mix                 $val, 字段值
     * @return  int                 $ret
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
