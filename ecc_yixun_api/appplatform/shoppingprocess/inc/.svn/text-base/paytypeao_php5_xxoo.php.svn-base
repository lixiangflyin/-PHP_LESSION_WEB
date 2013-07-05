<?php
namespace icson\deal\bo;	//source idl: com.icson.deal.idl.GetAllPayTypeInfoResp.java
class PayTypeInfo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $payTypeList;	//<std::vector<icson::deal::bo::CPayType> > 支付方式列表(版本>=0)
	private $payTypeList_u;	//<uint8_t> (版本>=0)
	private $installmentConfigList;	//<std::vector<icson::deal::bo::CInstallmentConfig> > 分期付款配置(版本>=0)
	private $installmentConfigList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->payTypeList = new \stl_vector2('\icson\deal\bo\PayType');	//<std::vector<icson::deal::bo::CPayType> >
		$this->payTypeList_u = 0;	//<uint8_t>
		$this->installmentConfigList = new \stl_vector2('\icson\deal\bo\InstallmentConfig');	//<std::vector<icson::deal::bo::CInstallmentConfig> >
		$this->installmentConfigList_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\PayTypeInfo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\PayTypeInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushObject($this->payTypeList,'stl_vector');	//<std::vector<icson::deal::bo::CPayType> > 支付方式列表
		$bs->pushUint8_t($this->payTypeList_u);	//<uint8_t> 
		$bs->pushObject($this->installmentConfigList,'stl_vector');	//<std::vector<icson::deal::bo::CInstallmentConfig> > 分期付款配置
		$bs->pushUint8_t($this->installmentConfigList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTypeList'] = $bs->popObject('stl_vector<\icson\deal\bo\PayType>');	//<std::vector<icson::deal::bo::CPayType> > 支付方式列表
		$this->_arr_value['payTypeList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['installmentConfigList'] = $bs->popObject('stl_vector<\icson\deal\bo\InstallmentConfig>');	//<std::vector<icson::deal::bo::CInstallmentConfig> > 分期付款配置
		$this->_arr_value['installmentConfigList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.PayTypeInfo.java
class InstallmentConfig{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $payTypeId;	//<uint32_t> 支付方式id(版本>=0)
	private $payTypeId_u;	//<uint8_t> (版本>=0)
	private $bankName;	//<std::string> 分期银行名称(版本>=0)
	private $bankName_u;	//<uint8_t> (版本>=0)
	private $installmentTermList;	//<std::vector<icson::deal::bo::CInstallmentTerm> > 分期下各期设置(版本>=0)
	private $installmentTermList_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->payTypeId = 0;	//<uint32_t>
		$this->payTypeId_u = 0;	//<uint8_t>
		$this->bankName = "";	//<std::string>
		$this->bankName_u = 0;	//<uint8_t>
		$this->installmentTermList = new \stl_vector2('\icson\deal\bo\InstallmentTerm');	//<std::vector<icson::deal::bo::CInstallmentTerm> >
		$this->installmentTermList_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\InstallmentConfig\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\InstallmentConfig\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->payTypeId);	//<uint32_t> 支付方式id
		$bs->pushUint8_t($this->payTypeId_u);	//<uint8_t> 
		$bs->pushString($this->bankName);	//<std::string> 分期银行名称
		$bs->pushUint8_t($this->bankName_u);	//<uint8_t> 
		$bs->pushObject($this->installmentTermList,'stl_vector');	//<std::vector<icson::deal::bo::CInstallmentTerm> > 分期下各期设置
		$bs->pushUint8_t($this->installmentTermList_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTypeId'] = $bs->popUint32_t();	//<uint32_t> 支付方式id
		$this->_arr_value['payTypeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bankName'] = $bs->popString();	//<std::string> 分期银行名称
		$this->_arr_value['bankName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['installmentTermList'] = $bs->popObject('stl_vector<\icson\deal\bo\InstallmentTerm>');	//<std::vector<icson::deal::bo::CInstallmentTerm> > 分期下各期设置
		$this->_arr_value['installmentTermList_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.InstallmentConfig.java
class InstallmentTerm{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $termNum;	//<uint32_t> 分的期数(版本>=0)
	private $termNum_u;	//<uint8_t> (版本>=0)
	private $minPrice;	//<uint32_t> 该期最小金额(版本>=0)
	private $minPrice_u;	//<uint8_t> (版本>=0)
	private $maxPrice;	//<uint32_t> 该期最大金额(版本>=0)
	private $maxPrice_u;	//<uint8_t> (版本>=0)
	private $rate;	//<uint32_t> 费率 * 1000000(版本>=0)
	private $rate_u;	//<uint8_t> (版本>=0)
	private $backRate;	//<uint32_t> BackRate * 1000000(版本>=0)
	private $backRate_u;	//<uint8_t> (版本>=0)
	private $bankSynNo;	//<uint32_t> BankSynNo(版本>=0)
	private $bankSynNo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->termNum = 0;	//<uint32_t>
		$this->termNum_u = 0;	//<uint8_t>
		$this->minPrice = 0;	//<uint32_t>
		$this->minPrice_u = 0;	//<uint8_t>
		$this->maxPrice = 0;	//<uint32_t>
		$this->maxPrice_u = 0;	//<uint8_t>
		$this->rate = 0;	//<uint32_t>
		$this->rate_u = 0;	//<uint8_t>
		$this->backRate = 0;	//<uint32_t>
		$this->backRate_u = 0;	//<uint8_t>
		$this->bankSynNo = 0;	//<uint32_t>
		$this->bankSynNo_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\InstallmentTerm\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\InstallmentTerm\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->termNum);	//<uint32_t> 分的期数
		$bs->pushUint8_t($this->termNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->minPrice);	//<uint32_t> 该期最小金额
		$bs->pushUint8_t($this->minPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->maxPrice);	//<uint32_t> 该期最大金额
		$bs->pushUint8_t($this->maxPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->rate);	//<uint32_t> 费率 * 1000000
		$bs->pushUint8_t($this->rate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->backRate);	//<uint32_t> BackRate * 1000000
		$bs->pushUint8_t($this->backRate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->bankSynNo);	//<uint32_t> BankSynNo
		$bs->pushUint8_t($this->bankSynNo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['termNum'] = $bs->popUint32_t();	//<uint32_t> 分的期数
		$this->_arr_value['termNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['minPrice'] = $bs->popUint32_t();	//<uint32_t> 该期最小金额
		$this->_arr_value['minPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['maxPrice'] = $bs->popUint32_t();	//<uint32_t> 该期最大金额
		$this->_arr_value['maxPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['rate'] = $bs->popUint32_t();	//<uint32_t> 费率 * 1000000
		$this->_arr_value['rate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['backRate'] = $bs->popUint32_t();	//<uint32_t> BackRate * 1000000
		$this->_arr_value['backRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bankSynNo'] = $bs->popUint32_t();	//<uint32_t> BankSynNo
		$this->_arr_value['bankSynNo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.PayTypeInfo.java
class PayType{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $payTypeId;	//<uint32_t> 支付方式id(版本>=0)
	private $payTypeId_u;	//<uint8_t> (版本>=0)
	private $strPayTypeId;	//<std::string> String 类型的支付方式id(版本>=0)
	private $strPayTypeId_u;	//<uint8_t> (版本>=0)
	private $payTypeName;	//<std::string> 支付方式名称(版本>=0)
	private $payTypeName_u;	//<uint8_t> (版本>=0)
	private $payTypeDesc;	//<std::string> 支付方式描述(版本>=0)
	private $payTypeDesc_u;	//<uint8_t> (版本>=0)
	private $period;	//<std::string> Period(版本>=0)
	private $period_u;	//<uint8_t> (版本>=0)
	private $paymentPage;	//<std::string> PaymentPage(版本>=0)
	private $paymentPage_u;	//<uint8_t> (版本>=0)
	private $payRate;	//<uint32_t> PayRate * 1000000(版本>=0)
	private $payRate_u;	//<uint8_t> (版本>=0)
	private $isNet;	//<uint32_t> 是否在线支付(版本>=0)
	private $isNet_u;	//<uint8_t> (版本>=0)
	private $isPayWhenRecv;	//<uint32_t> IsPayWhenRecv(版本>=0)
	private $isPayWhenRecv_u;	//<uint8_t> (版本>=0)
	private $orderNumber;	//<std::string> OrderNumber(版本>=0)
	private $orderNumber_u;	//<uint8_t> (版本>=0)
	private $isOnlineShow;	//<uint32_t> 是否线上展示(版本>=0)
	private $isOnlineShow_u;	//<uint8_t> (版本>=0)
	private $returnRate;	//<uint32_t> ReturnRate * 1000000(版本>=0)
	private $returnRate_u;	//<uint8_t> (版本>=0)
	private $isNetBank;	//<uint32_t> 是否是在线支付银行(版本>=0)
	private $isNetBank_u;	//<uint8_t> (版本>=0)
	private $isInstallment;	//<uint32_t> 是否分期付款支付方式(版本>=0)
	private $isInstallment_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->payTypeId = 0;	//<uint32_t>
		$this->payTypeId_u = 0;	//<uint8_t>
		$this->strPayTypeId = "";	//<std::string>
		$this->strPayTypeId_u = 0;	//<uint8_t>
		$this->payTypeName = "";	//<std::string>
		$this->payTypeName_u = 0;	//<uint8_t>
		$this->payTypeDesc = "";	//<std::string>
		$this->payTypeDesc_u = 0;	//<uint8_t>
		$this->period = "";	//<std::string>
		$this->period_u = 0;	//<uint8_t>
		$this->paymentPage = "";	//<std::string>
		$this->paymentPage_u = 0;	//<uint8_t>
		$this->payRate = 0;	//<uint32_t>
		$this->payRate_u = 0;	//<uint8_t>
		$this->isNet = 0;	//<uint32_t>
		$this->isNet_u = 0;	//<uint8_t>
		$this->isPayWhenRecv = 0;	//<uint32_t>
		$this->isPayWhenRecv_u = 0;	//<uint8_t>
		$this->orderNumber = "";	//<std::string>
		$this->orderNumber_u = 0;	//<uint8_t>
		$this->isOnlineShow = 0;	//<uint32_t>
		$this->isOnlineShow_u = 0;	//<uint8_t>
		$this->returnRate = 0;	//<uint32_t>
		$this->returnRate_u = 0;	//<uint8_t>
		$this->isNetBank = 0;	//<uint32_t>
		$this->isNetBank_u = 0;	//<uint8_t>
		$this->isInstallment = 0;	//<uint32_t>
		$this->isInstallment_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\PayType\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\PayType\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->payTypeId);	//<uint32_t> 支付方式id
		$bs->pushUint8_t($this->payTypeId_u);	//<uint8_t> 
		$bs->pushString($this->strPayTypeId);	//<std::string> String 类型的支付方式id
		$bs->pushUint8_t($this->strPayTypeId_u);	//<uint8_t> 
		$bs->pushString($this->payTypeName);	//<std::string> 支付方式名称
		$bs->pushUint8_t($this->payTypeName_u);	//<uint8_t> 
		$bs->pushString($this->payTypeDesc);	//<std::string> 支付方式描述
		$bs->pushUint8_t($this->payTypeDesc_u);	//<uint8_t> 
		$bs->pushString($this->period);	//<std::string> Period
		$bs->pushUint8_t($this->period_u);	//<uint8_t> 
		$bs->pushString($this->paymentPage);	//<std::string> PaymentPage
		$bs->pushUint8_t($this->paymentPage_u);	//<uint8_t> 
		$bs->pushUint32_t($this->payRate);	//<uint32_t> PayRate * 1000000
		$bs->pushUint8_t($this->payRate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isNet);	//<uint32_t> 是否在线支付
		$bs->pushUint8_t($this->isNet_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isPayWhenRecv);	//<uint32_t> IsPayWhenRecv
		$bs->pushUint8_t($this->isPayWhenRecv_u);	//<uint8_t> 
		$bs->pushString($this->orderNumber);	//<std::string> OrderNumber
		$bs->pushUint8_t($this->orderNumber_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isOnlineShow);	//<uint32_t> 是否线上展示
		$bs->pushUint8_t($this->isOnlineShow_u);	//<uint8_t> 
		$bs->pushUint32_t($this->returnRate);	//<uint32_t> ReturnRate * 1000000
		$bs->pushUint8_t($this->returnRate_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isNetBank);	//<uint32_t> 是否是在线支付银行
		$bs->pushUint8_t($this->isNetBank_u);	//<uint8_t> 
		$bs->pushUint32_t($this->isInstallment);	//<uint32_t> 是否分期付款支付方式
		$bs->pushUint8_t($this->isInstallment_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTypeId'] = $bs->popUint32_t();	//<uint32_t> 支付方式id
		$this->_arr_value['payTypeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['strPayTypeId'] = $bs->popString();	//<std::string> String 类型的支付方式id
		$this->_arr_value['strPayTypeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTypeName'] = $bs->popString();	//<std::string> 支付方式名称
		$this->_arr_value['payTypeName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTypeDesc'] = $bs->popString();	//<std::string> 支付方式描述
		$this->_arr_value['payTypeDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['period'] = $bs->popString();	//<std::string> Period
		$this->_arr_value['period_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['paymentPage'] = $bs->popString();	//<std::string> PaymentPage
		$this->_arr_value['paymentPage_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payRate'] = $bs->popUint32_t();	//<uint32_t> PayRate * 1000000
		$this->_arr_value['payRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isNet'] = $bs->popUint32_t();	//<uint32_t> 是否在线支付
		$this->_arr_value['isNet_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isPayWhenRecv'] = $bs->popUint32_t();	//<uint32_t> IsPayWhenRecv
		$this->_arr_value['isPayWhenRecv_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderNumber'] = $bs->popString();	//<std::string> OrderNumber
		$this->_arr_value['orderNumber_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isOnlineShow'] = $bs->popUint32_t();	//<uint32_t> 是否线上展示
		$this->_arr_value['isOnlineShow_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['returnRate'] = $bs->popUint32_t();	//<uint32_t> ReturnRate * 1000000
		$this->_arr_value['returnRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isNetBank'] = $bs->popUint32_t();	//<uint32_t> 是否是在线支付银行
		$this->_arr_value['isNetBank_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isInstallment'] = $bs->popUint32_t();	//<uint32_t> 是否分期付款支付方式
		$this->_arr_value['isInstallment_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace icson\deal\bo;	//source idl: com.icson.deal.idl.GetAllPayTypeInfoReq.java
class PayTypeParam{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 协议版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $payTypeId;	//<uint32_t> 支付方式id(版本>=0)
	private $payTypeId_u;	//<uint8_t> (版本>=0)
	private $shipTypeId;	//<uint32_t> 配送方式id(版本>=0)
	private $shipTypeId_u;	//<uint8_t> (版本>=0)
	private $whId;	//<uint32_t> 分站id(版本>=0)
	private $whId_u;	//<uint8_t> (版本>=0)
	private $uid;	//<uint32_t> 用户uid(版本>=0)
	private $uid_u;	//<uint8_t> (版本>=0)
	private $userType;	//<std::string> 用户类型(版本>=0)
	private $userType_u;	//<uint8_t> (版本>=0)
	private $cartType;	//<uint32_t> 购物车类型(版本>=0)
	private $cartType_u;	//<uint8_t> (版本>=0)
	private $productIdList;	//<std::vector<uint32_t> > 商品id列表(版本>=0)
	private $productIdList_u;	//<uint8_t> (版本>=0)
	private $price;	//<uint32_t> 价格(版本>=0)
	private $price_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->payTypeId = 0;	//<uint32_t>
		$this->payTypeId_u = 0;	//<uint8_t>
		$this->shipTypeId = 0;	//<uint32_t>
		$this->shipTypeId_u = 0;	//<uint8_t>
		$this->whId = 0;	//<uint32_t>
		$this->whId_u = 0;	//<uint8_t>
		$this->uid = 0;	//<uint32_t>
		$this->uid_u = 0;	//<uint8_t>
		$this->userType = "";	//<std::string>
		$this->userType_u = 0;	//<uint8_t>
		$this->cartType = 0;	//<uint32_t>
		$this->cartType_u = 0;	//<uint8_t>
		$this->productIdList = new \stl_vector2('uint32_t');	//<std::vector<uint32_t> >
		$this->productIdList_u = 0;	//<uint8_t>
		$this->price = 0;	//<uint32_t>
		$this->price_u = 0;	//<uint8_t>
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
			exit("\icson\deal\bo\PayTypeParam\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\deal\bo\PayTypeParam\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 协议版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->payTypeId);	//<uint32_t> 支付方式id
		$bs->pushUint8_t($this->payTypeId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->shipTypeId);	//<uint32_t> 配送方式id
		$bs->pushUint8_t($this->shipTypeId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->whId);	//<uint32_t> 分站id
		$bs->pushUint8_t($this->whId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->uid);	//<uint32_t> 用户uid
		$bs->pushUint8_t($this->uid_u);	//<uint8_t> 
		$bs->pushString($this->userType);	//<std::string> 用户类型
		$bs->pushUint8_t($this->userType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cartType);	//<uint32_t> 购物车类型
		$bs->pushUint8_t($this->cartType_u);	//<uint8_t> 
		$bs->pushObject($this->productIdList,'stl_vector');	//<std::vector<uint32_t> > 商品id列表
		$bs->pushUint8_t($this->productIdList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->price);	//<uint32_t> 价格
		$bs->pushUint8_t($this->price_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 协议版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['payTypeId'] = $bs->popUint32_t();	//<uint32_t> 支付方式id
		$this->_arr_value['payTypeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['shipTypeId'] = $bs->popUint32_t();	//<uint32_t> 配送方式id
		$this->_arr_value['shipTypeId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['whId'] = $bs->popUint32_t();	//<uint32_t> 分站id
		$this->_arr_value['whId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['uid'] = $bs->popUint32_t();	//<uint32_t> 用户uid
		$this->_arr_value['uid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['userType'] = $bs->popString();	//<std::string> 用户类型
		$this->_arr_value['userType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cartType'] = $bs->popUint32_t();	//<uint32_t> 购物车类型
		$this->_arr_value['cartType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productIdList'] = $bs->popObject('stl_vector<uint32_t>');	//<std::vector<uint32_t> > 商品id列表
		$this->_arr_value['productIdList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['price'] = $bs->popUint32_t();	//<uint32_t> 价格
		$this->_arr_value['price_u'] = $bs->popUint8_t();	//<uint8_t> 

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
