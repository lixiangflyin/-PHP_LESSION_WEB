<?php
namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OnlinePayNotifyReq.java
class OnlinePayBdealParams{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $bdealId;	//<uint64_t> 交易订单号(版本>=0)
	private $bdealCode;	//<std::string> 交易订单号,带买卖家号(版本>=0)
	private $businessBdealId;	//<std::string> 业务父订单号,必填(版本>=0)
	private $payTime;	//<uint32_t> 支付时间，必填(版本>=0)
	private $totalPayAmt;	//<uint32_t> 支付总金额,必填(版本>=0)
	private $isMerge;	//<uint32_t> 0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单),必填(版本>=0)
	private $payId;	//<uint64_t> 统一订单支付单号,必填(版本>=0)
	private $dealParamsList;	//<ecc::deal::po::COnlinePayDealParamsList> 支付同步入参订单列表(版本>=0)
	private $icsonAccount;	//<std::string> 易讯内部账号(版本>=0)
	private $buyerId;	//<std::string> 统一用户号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $bdealCode_u;	//<uint8_t> (版本>=0)
	private $businessBdealId_u;	//<uint8_t> (版本>=0)
	private $payTime_u;	//<uint8_t> (版本>=0)
	private $totalPayAmt_u;	//<uint8_t> (版本>=0)
	private $isMerge_u;	//<uint8_t> (版本>=0)
	private $payId_u;	//<uint8_t> (版本>=0)
	private $dealParamsList_u;	//<uint8_t> (版本>=0)
	private $icsonAccount_u;	//<uint8_t> (版本>=0)
	private $buyerId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->bdealId = 0;	//<uint64_t>
		$this->bdealCode = "";	//<std::string>
		$this->businessBdealId = "";	//<std::string>
		$this->payTime = 0;	//<uint32_t>
		$this->totalPayAmt = 0;	//<uint32_t>
		$this->isMerge = 0;	//<uint32_t>
		$this->payId = 0;	//<uint64_t>
		$this->dealParamsList = new \ecc\deal\po\OnlinePayDealParamsList();	//<ecc::deal::po::COnlinePayDealParamsList>
		$this->icsonAccount = "";	//<std::string>
		$this->buyerId = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->bdealCode_u = 0;	//<uint8_t>
		$this->businessBdealId_u = 0;	//<uint8_t>
		$this->payTime_u = 0;	//<uint8_t>
		$this->totalPayAmt_u = 0;	//<uint8_t>
		$this->isMerge_u = 0;	//<uint8_t>
		$this->payId_u = 0;	//<uint8_t>
		$this->dealParamsList_u = 0;	//<uint8_t>
		$this->icsonAccount_u = 0;	//<uint8_t>
		$this->buyerId_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("\ecc\deal\po\OnlinePayBdealParams\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OnlinePayBdealParams\\{$name}：请直接赋值为数组，无需new ***。");
		$base = array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(!in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}
				}
			}
			$obj->setValue($arr);
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}
			}
		}
	}
	function __get($name){
		return $this->$name;
	}

	function serialize($bs){
		$bs->pushUint32_t($this->getClassLen());
		$this->serialize_internal($bs);
	}

	function serialize_internal($bs){
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushUint64_t($this->bdealId);	//<uint64_t> 交易订单号
		$bs->pushString($this->bdealCode);	//<std::string> 交易订单号,带买卖家号
		$bs->pushString($this->businessBdealId);	//<std::string> 业务父订单号,必填
		$bs->pushUint32_t($this->payTime);	//<uint32_t> 支付时间，必填
		$bs->pushUint32_t($this->totalPayAmt);	//<uint32_t> 支付总金额,必填
		$bs->pushUint32_t($this->isMerge);	//<uint32_t> 0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单),必填
		$bs->pushUint64_t($this->payId);	//<uint64_t> 统一订单支付单号,必填
		$bs->pushObject($this->dealParamsList,'\ecc\deal\po\OnlinePayDealParamsList');	//<ecc::deal::po::COnlinePayDealParamsList> 支付同步入参订单列表
		$bs->pushString($this->icsonAccount);	//<std::string> 易讯内部账号
		$bs->pushString($this->buyerId);	//<std::string> 统一用户号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealCode_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessBdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->totalPayAmt_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isMerge_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealParamsList_u);	//<uint8_t> 
		$bs->pushUint8_t($this->icsonAccount_u);	//<uint8_t> 
		$bs->pushUint8_t($this->buyerId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['bdealId'] = $bs->popUint64_t();	//<uint64_t> 交易订单号
		$this->_arr_value['bdealCode'] = $bs->popString();	//<std::string> 交易订单号,带买卖家号
		$this->_arr_value['businessBdealId'] = $bs->popString();	//<std::string> 业务父订单号,必填
		$this->_arr_value['payTime'] = $bs->popUint32_t();	//<uint32_t> 支付时间，必填
		$this->_arr_value['totalPayAmt'] = $bs->popUint32_t();	//<uint32_t> 支付总金额,必填
		$this->_arr_value['isMerge'] = $bs->popUint32_t();	//<uint32_t> 0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单),必填
		$this->_arr_value['payId'] = $bs->popUint64_t();	//<uint64_t> 统一订单支付单号,必填
		$this->_arr_value['dealParamsList'] = $bs->popObject('\ecc\deal\po\OnlinePayDealParamsList');	//<ecc::deal::po::COnlinePayDealParamsList> 支付同步入参订单列表
		$this->_arr_value['icsonAccount'] = $bs->popString();	//<std::string> 易讯内部账号
		$this->_arr_value['buyerId'] = $bs->popString();	//<std::string> 统一用户号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessBdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['totalPayAmt_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isMerge_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealParamsList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonAccount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['buyerId_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream2();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OnlinePayBdealParams.java
class OnlinePayDealParamsList{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 版本号(版本>=0)
	private $dealParamsList;	//<std::vector<ecc::deal::po::COnlinePayDealParams> > 支付单列表(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealParamsList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->dealParamsList = new \stl_vector2('\ecc\deal\po\OnlinePayDealParams');	//<std::vector<ecc::deal::po::COnlinePayDealParams> >
		$this->version_u = 0;	//<uint8_t>
		$this->dealParamsList_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("\ecc\deal\po\OnlinePayDealParamsList\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OnlinePayDealParamsList\\{$name}：请直接赋值为数组，无需new ***。");
		$base = array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(!in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}
				}
			}
			$obj->setValue($arr);
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}
			}
		}
	}
	function __get($name){
		return $this->$name;
	}

	function serialize($bs){
		$bs->pushUint32_t($this->getClassLen());
		$this->serialize_internal($bs);
	}

	function serialize_internal($bs){
		$bs->pushUint16_t($this->version);	//<uint16_t> 版本号
		$bs->pushObject($this->dealParamsList,'stl_vector');	//<std::vector<ecc::deal::po::COnlinePayDealParams> > 支付单列表
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealParamsList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 版本号
		$this->_arr_value['dealParamsList'] = $bs->popObject('stl_vector<\ecc\deal\po\OnlinePayDealParams>');	//<std::vector<ecc::deal::po::COnlinePayDealParams> > 支付单列表
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealParamsList_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream2();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}

namespace ecc\deal\po;	//source idl: com.ecc.deal.idl.OnlinePayDealParamsList.java
class OnlinePayDealParams{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $dealId;	//<std::string> 订单号(版本>=0)
	private $businessDealId;	//<std::string> 订单业务单号,必填(版本>=0)
	private $payAmt;	//<uint32_t> 支付金额,必填(版本>=0)
	private $account;	//<std::string> 收款账户，必填,统一后台(payAccount)(版本>=0)
	private $payType;	//<std::string> 支付类型系统编号()，必填,统一后台(icsonPayType)(版本>=0)
	private $payTime;	//<uint32_t> 支付时间，必填(版本>=0)
	private $tradeNo;	//<std::string> 收款（交易）流水号，必填,统一后台(paydealid)(版本>=0)
	private $key;	//<std::string> 0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单)，必填(版本>=0)
	private $sourceType;	//<uint32_t> 来源类型(1:实物,2:虚拟,3:分销),必填(版本>=1)
	private $billType;	//<uint32_t> 订单类型(1:普通订单,2:礼品卡),必填(版本>=1)
	private $version_u;	//<uint8_t> (版本>=0)
	private $dealId_u;	//<uint8_t> (版本>=0)
	private $businessDealId_u;	//<uint8_t> (版本>=0)
	private $payAmt_u;	//<uint8_t> (版本>=0)
	private $account_u;	//<uint8_t> (版本>=0)
	private $payType_u;	//<uint8_t> (版本>=0)
	private $payTime_u;	//<uint8_t> (版本>=0)
	private $tradeNo_u;	//<uint8_t> (版本>=0)
	private $key_u;	//<uint8_t> (版本>=0)
	private $sourceType_u;	//<uint8_t> (版本>=0)
	private $billType_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 1;	//<uint16_t>
		$this->dealId = "";	//<std::string>
		$this->businessDealId = "";	//<std::string>
		$this->payAmt = 0;	//<uint32_t>
		$this->account = "";	//<std::string>
		$this->payType = "";	//<std::string>
		$this->payTime = 0;	//<uint32_t>
		$this->tradeNo = "";	//<std::string>
		$this->key = "";	//<std::string>
		$this->sourceType = 0;	//<uint32_t>
		$this->billType = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->dealId_u = 0;	//<uint8_t>
		$this->businessDealId_u = 0;	//<uint8_t>
		$this->payAmt_u = 0;	//<uint8_t>
		$this->account_u = 0;	//<uint8_t>
		$this->payType_u = 0;	//<uint8_t>
		$this->payTime_u = 0;	//<uint8_t>
		$this->tradeNo_u = 0;	//<uint8_t>
		$this->key_u = 0;	//<uint8_t>
		$this->sourceType_u = 0;	//<uint8_t>
		$this->billType_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				$this->initClass($name,$val,$this->$name);
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
			exit("\ecc\deal\po\OnlinePayDealParams\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\ecc\deal\po\OnlinePayDealParams\\{$name}：请直接赋值为数组，无需new ***。");
		$base = array('bool','byte','uint8_t','int8_t','uint16_t','int16_t','uint32_t','int32_t','uint64_t','int64_t','long','int','string','stl_string');
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(!in_array($class, $base)){
				$arr=$val;
			}else if(strpos($class,'stl_')===0){
				$cls=explode("<", $class);
				$cls="\\".trim($cls[0])."2";
				$start=strpos($obj->element_type,'<')+1;
				$end= strrpos($obj->element_type,'>');
				$parm= trim(substr($obj->element_type, $start,$end-$start));
				foreach($val as $k => $v){
					$arr[$k]=new $cls($parm);
					$this->initClass($name.'\\'.$k,$v,$arr[$k]);
				}
			}else{
				foreach ($val as $key => $value) {
					$arr[$key]=new $class();
					foreach($value as $k => $v){
						if(is_object($arr[$key]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$key]->$k);
						}else{
							$arr[$key]->$k=$v;
						}
					}
				}
			}
			$obj->setValue($arr);
		}else{
			foreach($val as $k => $v){
				if(is_object($obj->$k)){
					$this->initClass($name.'\\'.$k,$v,$obj->$k);
				}else{
					$obj->$k=$v;
				}
			}
		}
	}
	function __get($name){
		return $this->$name;
	}

	function serialize($bs){
		$bs->pushUint32_t($this->getClassLen());
		$this->serialize_internal($bs);
	}

	function serialize_internal($bs){
		$bs->pushUint16_t($this->version);	//<uint16_t> 协议版本号
		$bs->pushString($this->dealId);	//<std::string> 订单号
		$bs->pushString($this->businessDealId);	//<std::string> 订单业务单号,必填
		$bs->pushUint32_t($this->payAmt);	//<uint32_t> 支付金额,必填
		$bs->pushString($this->account);	//<std::string> 收款账户，必填,统一后台(payAccount)
		$bs->pushString($this->payType);	//<std::string> 支付类型系统编号()，必填,统一后台(icsonPayType)
		$bs->pushUint32_t($this->payTime);	//<uint32_t> 支付时间，必填
		$bs->pushString($this->tradeNo);	//<std::string> 收款（交易）流水号，必填,统一后台(paydealid)
		$bs->pushString($this->key);	//<std::string> 0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单)，必填
		if($this->version >= 1){
			$bs->pushUint32_t($this->sourceType);	//<uint32_t> 来源类型(1:实物,2:虚拟,3:分销),必填
		}
		if($this->version >= 1){
			$bs->pushUint32_t($this->billType);	//<uint32_t> 订单类型(1:普通订单,2:礼品卡),必填
		}
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessDealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payAmt_u);	//<uint8_t> 
		$bs->pushUint8_t($this->account_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->payTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->tradeNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->key_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sourceType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->billType_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['dealId'] = $bs->popString();	//<std::string> 订单号
		$this->_arr_value['businessDealId'] = $bs->popString();	//<std::string> 订单业务单号,必填
		$this->_arr_value['payAmt'] = $bs->popUint32_t();	//<uint32_t> 支付金额,必填
		$this->_arr_value['account'] = $bs->popString();	//<std::string> 收款账户，必填,统一后台(payAccount)
		$this->_arr_value['payType'] = $bs->popString();	//<std::string> 支付类型系统编号()，必填,统一后台(icsonPayType)
		$this->_arr_value['payTime'] = $bs->popUint32_t();	//<uint32_t> 支付时间，必填
		$this->_arr_value['tradeNo'] = $bs->popString();	//<std::string> 收款（交易）流水号，必填,统一后台(paydealid)
		$this->_arr_value['key'] = $bs->popString();	//<std::string> 0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单)，必填
		if($this->version >= 1){
			$this->_arr_value['sourceType'] = $bs->popUint32_t();	//<uint32_t> 来源类型(1:实物,2:虚拟,3:分销),必填
		}
		if($this->version >= 1){
			$this->_arr_value['billType'] = $bs->popUint32_t();	//<uint32_t> 订单类型(1:普通订单,2:礼品卡),必填
		}
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessDealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payAmt_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['account_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['tradeNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['key_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sourceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['billType_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream2();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}
