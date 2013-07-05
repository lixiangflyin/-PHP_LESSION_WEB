<?php
// source idl: com.b2b2c.kf.idl.DAO_51Buy_ServiceCenter.java
namespace icson;
require_once "dao_51buy_servicecenter_php5_xxoo.php";

namespace icson\servicecenter\dao;
class addApplyInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $applyInfo;	//<icson::servicecenter::ddo::CApplyInfo>  申请信息 (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->applyInfo = new \icson\servicecenter\ddo\ApplyInfo();	//<icson::servicecenter::ddo::CApplyInfo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("addApplyInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("addApplyInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushObject($this->applyInfo,'\icson\servicecenter\ddo\ApplyInfo');	//<icson::servicecenter::ddo::CApplyInfo>  申请信息 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261004;
	}
}

class addApplyInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268004;
	}
}

namespace icson\servicecenter\dao;
class addBaseStatInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $baseInfo;	//<icson::servicecenter::ddo::CBaseStatInfo>  基础数据 (版本>=0)
	private $inReserve;	//<std::string>  备用字段 (版本>=0)

	function __construct() {
		$this->baseInfo = new \icson\servicecenter\ddo\BaseStatInfo();	//<icson::servicecenter::ddo::CBaseStatInfo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("addBaseStatInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("addBaseStatInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushObject($this->baseInfo,'\icson\servicecenter\ddo\BaseStatInfo');	//<icson::servicecenter::ddo::CBaseStatInfo>  基础数据 
		$bs->pushString($this->inReserve);	//<std::string>  备用字段 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261001;
	}
}

class addBaseStatInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268001;
	}
}

namespace icson\servicecenter\dao;
class addReplyInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $replyInfo;	//<icson::servicecenter::ddo::CReplyInfo>   回复信息 (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->replyInfo = new \icson\servicecenter\ddo\ReplyInfo();	//<icson::servicecenter::ddo::CReplyInfo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("addReplyInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("addReplyInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushObject($this->replyInfo,'\icson\servicecenter\ddo\ReplyInfo');	//<icson::servicecenter::ddo::CReplyInfo>   回复信息 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE126100A;
	}
}

class addReplyInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE126800A;
	}
}

namespace icson\servicecenter\dao;
class delBaseStatInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $billNo;	//<std::string>  业务单号 (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->billNo = "";	//<std::string>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("delBaseStatInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("delBaseStatInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->billNo);	//<std::string>  业务单号 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261003;
	}
}

class delBaseStatInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268003;
	}
}

namespace icson\servicecenter\dao;
class getApplyInfoListReq{
	private $_arr_value=array();	//数组形式的类
	private $account;	//<std::string>  用户帐号 (版本>=0)
	private $type;	//<uint32_t>  工单类型 (版本>=0)
	private $page;	//<uint32_t>  页码 (版本>=0)
	private $pageSize;	//<uint32_t>  每页显示数量 (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->account = "";	//<std::string>
		$this->type = 0;	//<uint32_t>
		$this->page = 0;	//<uint32_t>
		$this->pageSize = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("getApplyInfoListReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("getApplyInfoListReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushString($this->account);	//<std::string>  用户帐号 
		$bs->pushUint32_t($this->type);	//<uint32_t>  工单类型 
		$bs->pushUint32_t($this->page);	//<uint32_t>  页码 
		$bs->pushUint32_t($this->pageSize);	//<uint32_t>  每页显示数量 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261006;
	}
}

class getApplyInfoListResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $applyInfoList;	//<std::vector<icson::servicecenter::ddo::CApplyInfo> >  申请信息列表 (版本>=0)
	private $total;	//<uint32_t>  总数量 (版本>=0)
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['applyInfoList'] = $bs->popObject('stl_vector<\icson\servicecenter\ddo\ApplyInfo>');	//<std::vector<icson::servicecenter::ddo::CApplyInfo> >  申请信息列表 
		$this->_arr_value['total'] = $bs->popUint32_t();	//<uint32_t>  总数量 
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268006;
	}
}

namespace icson\servicecenter\dao;
class getApplyInfoOneReq{
	private $_arr_value=array();	//数组形式的类
	private $id;	//<uint64_t>  id (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->id = 0;	//<uint64_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("getApplyInfoOneReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("getApplyInfoOneReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushUint64_t($this->id);	//<uint64_t>  id 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261007;
	}
}

class getApplyInfoOneResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $applyInfo;	//<icson::servicecenter::ddo::CApplyInfo>  申请信息详情 (版本>=0)
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['applyInfo'] = $bs->popObject('\icson\servicecenter\ddo\ApplyInfo');	//<icson::servicecenter::ddo::CApplyInfo>  申请信息详情 
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268007;
	}
}

namespace icson\servicecenter\dao;
class getReplyListReq{
	private $_arr_value=array();	//数组形式的类
	private $complaint_id;	//<uint64_t>   业务单id (版本>=0)
	private $reply_type;	//<uint32_t>  回复类型（1：回复 2：备注） (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->complaint_id = 0;	//<uint64_t>
		$this->reply_type = 0;	//<uint32_t>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("getReplyListReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("getReplyListReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushUint64_t($this->complaint_id);	//<uint64_t>   业务单id 
		$bs->pushUint32_t($this->reply_type);	//<uint32_t>  回复类型（1：回复 2：备注） 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261008;
	}
}

class getReplyListResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $replyInfoList;	//<std::vector<icson::servicecenter::ddo::CReplyInfo> >  回复列表 (版本>=0)
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['replyInfoList'] = $bs->popObject('stl_vector<\icson\servicecenter\ddo\ReplyInfo>');	//<std::vector<icson::servicecenter::ddo::CReplyInfo> >  回复列表 
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268008;
	}
}

namespace icson\servicecenter\dao;
class updateApplyInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $applyInfo;	//<icson::servicecenter::ddo::CApplyInfo>  申请信息 (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->applyInfo = new \icson\servicecenter\ddo\ApplyInfo();	//<icson::servicecenter::ddo::CApplyInfo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("updateApplyInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("updateApplyInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushObject($this->applyInfo,'\icson\servicecenter\ddo\ApplyInfo');	//<icson::servicecenter::ddo::CApplyInfo>  申请信息 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261005;
	}
}

class updateApplyInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268005;
	}
}

namespace icson\servicecenter\dao;
class updateBaseStatInfoReq{
	private $_arr_value=array();	//数组形式的类
	private $modStatInfo;	//<icson::servicecenter::ddo::CBaseStatInfo>  更新信息 (版本>=0)
	private $inReserve;	//<std::string>  备用 (版本>=0)

	function __construct() {
		$this->modStatInfo = new \icson\servicecenter\ddo\BaseStatInfo();	//<icson::servicecenter::ddo::CBaseStatInfo>
		$this->inReserve = "";	//<std::string>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("updateBaseStatInfoReq\\{$name}：请直接赋值为数组，无需new ***。");
				if(strpos(get_class($this->$name), 'stl_')===0){
					$class=$this->$name->element_type;
					$arr = array();	
					if(class_exists($class,false)){						
						for($i=0;$i<count($val);$i++){
							$arr[$i]=new $class();
							foreach($val[$i] as $k => $v){
								$arr[$i]->$k=$v;
							}	
						}
					}else{
						$arr=$val;
					}
					$this->$name->setValue($arr);				
				}else{
					foreach($val as $k => $v){
						$this->$name->$k=$v;
					}
				}
			}else{
				if($name=="version" && ($val < 0 || $val > $this->version)){
					exit("Version error.It must be > 0 and < {$this->version} (default version).Now value is {$val}.");
				}
				$this->$name=$val;
			}
			if(isset($this->{$name.'_u'})){
				$this->{$name.'_u'}=1;
			}
		}else{
			exit("updateBaseStatInfoReq\\{$name}：不存在此变量，请查询stub。");
		}
	}

	function Serialize($bs){
		$bs->pushObject($this->modStatInfo,'\icson\servicecenter\ddo\BaseStatInfo');	//<icson::servicecenter::ddo::CBaseStatInfo>  更新信息 
		$bs->pushString($this->inReserve);	//<std::string>  备用 

		return $bs->isGood();
	}
	
	function getCmdId(){
		return 0xE1261002;
	}
}

class updateBaseStatInfoResp{
	private $result;	
	private $_arr_value=array();	//数组形式的类
	private $errMsg;	//<std::string>  错误信息 (版本>=0)
	private $outReserve;	//<std::string>  备用 (版本>=0)

	function __get($name){
		if($name=="errmsg" && !array_key_exists('errmsg', $this->_arr_value)){
			return "errmsg is not define.";
		}
		return $this->_arr_value[$name];
	}
	
	function Unserialize($bs){
		$this->_arr_value['result'] = $bs->popUint32_t();
		$this->_arr_value['errMsg'] = $bs->popString();	//<std::string>  错误信息 
		$this->_arr_value['outReserve'] = $bs->popString();	//<std::string>  备用 

	}

	function getCmdId() {
		return 0xE1268002;
	}
}
