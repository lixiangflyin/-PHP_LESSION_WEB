<?php
namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.MultiGetInventoryReq.java
class ViewInventoryMulFilterAdminPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $productSysno;	//<std::set<uint64_t> >  商品系统编号,必填 (版本>=0)
	private $productSysno_u;	//<uint8_t> (版本>=0)
	private $stockSysno;	//<uint64_t> 商品所在仓库编号，不填查出所有仓库下的某商品(版本>=0)
	private $stockSysno_u;	//<uint8_t> (版本>=0)
	private $platformSysno;	//<uint64_t> 平台编号，不填查出所有平台下的某商品(版本>=0)
	private $platformSysno_u;	//<uint8_t> (版本>=0)
	private $ownerSysno;	//<uint64_t>  货主编号 (版本>=0)
	private $ownerSysno_u;	//<uint8_t> (版本>=0)
	private $reserveDdw;	//<uint32_t> 保留字段dw(版本>=0)
	private $reserveDdw_u;	//<uint8_t> (版本>=0)
	private $reserveStr;	//<std::string> 保留字段str(版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->productSysno = new \stl_set2('uint64_t');	//<std::set<uint64_t> >
		$this->productSysno_u = 0;	//<uint8_t>
		$this->stockSysno = 0;	//<uint64_t>
		$this->stockSysno_u = 0;	//<uint8_t>
		$this->platformSysno = 0;	//<uint64_t>
		$this->platformSysno_u = 0;	//<uint8_t>
		$this->ownerSysno = 0;	//<uint64_t>
		$this->ownerSysno_u = 0;	//<uint8_t>
		$this->reserveDdw = 0;	//<uint32_t>
		$this->reserveDdw_u = 0;	//<uint8_t>
		$this->reserveStr = "";	//<std::string>
		$this->reserveStr_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewInventoryMulFilterAdminPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewInventoryMulFilterAdminPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushObject($this->productSysno,'stl_set');	//<std::set<uint64_t> >  商品系统编号,必填 
		$bs->pushUint8_t($this->productSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->stockSysno);	//<uint64_t> 商品所在仓库编号，不填查出所有仓库下的某商品
		$bs->pushUint8_t($this->stockSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->platformSysno);	//<uint64_t> 平台编号，不填查出所有平台下的某商品
		$bs->pushUint8_t($this->platformSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->ownerSysno);	//<uint64_t>  货主编号 
		$bs->pushUint8_t($this->ownerSysno_u);	//<uint8_t> 
		$bs->pushUint32_t($this->reserveDdw);	//<uint32_t> 保留字段dw
		$bs->pushUint8_t($this->reserveDdw_u);	//<uint8_t> 
		$bs->pushString($this->reserveStr);	//<std::string> 保留字段str
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSysno'] = $bs->popObject('stl_set<uint64_t>');	//<std::set<uint64_t> >  商品系统编号,必填 
		$this->_arr_value['productSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockSysno'] = $bs->popUint64_t();	//<uint64_t> 商品所在仓库编号，不填查出所有仓库下的某商品
		$this->_arr_value['stockSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['platformSysno'] = $bs->popUint64_t();	//<uint64_t> 平台编号，不填查出所有平台下的某商品
		$this->_arr_value['platformSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ownerSysno'] = $bs->popUint64_t();	//<uint64_t>  货主编号 
		$this->_arr_value['ownerSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveDdw'] = $bs->popUint32_t();	//<uint32_t> 保留字段dw
		$this->_arr_value['reserveDdw_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> 保留字段str
		$this->_arr_value['reserveStr_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.FetchSkuListInfoResp.java
class ViewSkuErrorPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $errorNo;	//<uint32_t> 接口返回错误码(版本>=0)
	private $errorNo_u;	//<uint8_t> (版本>=0)
	private $errorMsgOutter;	//<std::string> 接口返回外部用错误信息(版本>=0)
	private $errorMsgOutter_u;	//<uint8_t> (版本>=0)
	private $errorMsgInner;	//<std::string> 接口返回内部用错误信息(版本>=0)
	private $errorMsgInner_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->errorNo = 0;	//<uint32_t>
		$this->errorNo_u = 0;	//<uint8_t>
		$this->errorMsgOutter = "";	//<std::string>
		$this->errorMsgOutter_u = 0;	//<uint8_t>
		$this->errorMsgInner = "";	//<std::string>
		$this->errorMsgInner_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewSkuErrorPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewSkuErrorPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->errorNo);	//<uint32_t> 接口返回错误码
		$bs->pushUint8_t($this->errorNo_u);	//<uint8_t> 
		$bs->pushString($this->errorMsgOutter);	//<std::string> 接口返回外部用错误信息
		$bs->pushUint8_t($this->errorMsgOutter_u);	//<uint8_t> 
		$bs->pushString($this->errorMsgInner);	//<std::string> 接口返回内部用错误信息
		$bs->pushUint8_t($this->errorMsgInner_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['errorNo'] = $bs->popUint32_t();	//<uint32_t> 接口返回错误码
		$this->_arr_value['errorNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['errorMsgOutter'] = $bs->popString();	//<std::string> 接口返回外部用错误信息
		$this->_arr_value['errorMsgOutter_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['errorMsgInner'] = $bs->popString();	//<std::string> 接口返回内部用错误信息
		$this->_arr_value['errorMsgInner_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.FetchSkuListInfoReq.java
class ViewSkuFilterPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $commodityId;	//<std::string> Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923, 其中102923为易迅sysno 必填(版本>=0)
	private $commodityId_u;	//<uint8_t> (版本>=0)
	private $skuSaleAttr;	//<std::string>  sku销售属性 ，保留(版本>=0)
	private $skuSaleAttr_u;	//<uint8_t> (版本>=0)
	private $snapversion;	//<uint32_t>  快照版本号，选填 (版本>=0)
	private $snapversion_u;	//<uint8_t> (版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴id, 选填 (版本>=0)
	private $cooperatorId_u;	//<uint8_t> (版本>=0)
	private $skuFilterExtent;	//<std::map<std::string,std::string> > 拓展用，保留(版本>=0)
	private $skuFilterExtent_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->commodityId = "";	//<std::string>
		$this->commodityId_u = 0;	//<uint8_t>
		$this->skuSaleAttr = "";	//<std::string>
		$this->skuSaleAttr_u = 0;	//<uint8_t>
		$this->snapversion = 0;	//<uint32_t>
		$this->snapversion_u = 0;	//<uint8_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->cooperatorId_u = 0;	//<uint8_t>
		$this->skuFilterExtent = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->skuFilterExtent_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewSkuFilterPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewSkuFilterPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->commodityId);	//<std::string> Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923, 其中102923为易迅sysno 必填
		$bs->pushUint8_t($this->commodityId_u);	//<uint8_t> 
		$bs->pushString($this->skuSaleAttr);	//<std::string>  sku销售属性 ，保留
		$bs->pushUint8_t($this->skuSaleAttr_u);	//<uint8_t> 
		$bs->pushUint32_t($this->snapversion);	//<uint32_t>  快照版本号，选填 
		$bs->pushUint8_t($this->snapversion_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴id, 选填 
		$bs->pushUint8_t($this->cooperatorId_u);	//<uint8_t> 
		$bs->pushObject($this->skuFilterExtent,'stl_map');	//<std::map<std::string,std::string> > 拓展用，保留
		$bs->pushUint8_t($this->skuFilterExtent_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['commodityId'] = $bs->popString();	//<std::string> Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923, 其中102923为易迅sysno 必填
		$this->_arr_value['commodityId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuSaleAttr'] = $bs->popString();	//<std::string>  sku销售属性 ，保留
		$this->_arr_value['skuSaleAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['snapversion'] = $bs->popUint32_t();	//<uint32_t>  快照版本号，选填 
		$this->_arr_value['snapversion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorId'] = $bs->popUint32_t();	//<uint32_t> 合作伙伴id, 选填 
		$this->_arr_value['cooperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuFilterExtent'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 拓展用，保留
		$this->_arr_value['skuFilterExtent_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.FetchSkuInfo4DetailResp.java
class ViewSpuPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号, version要为小写 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $spuId;	//<uint32_t> spuid (版本>=0)
	private $spuId_u;	//<uint8_t> (版本>=0)
	private $categoryId;	//<uint32_t> 品类id，商品所属品类 统一类目后(版本>=0)
	private $categoryId_u;	//<uint8_t> (版本>=0)
	private $cooperatorId;	//<uint32_t> spu创建者，实际上是发布这个spu下第一个sku的合作伙伴的id (版本>=0)
	private $cooperatorId_u;	//<uint8_t> (版本>=0)
	private $spuTitle;	//<std::string> spu统一标题  未被spu统一 则为空 以下同(版本>=0)
	private $spuTitle_u;	//<uint8_t> (版本>=0)
	private $spuLeadTitle;	//<std::string> spu统一引题 (版本>=0)
	private $spuLeadTitle_u;	//<uint8_t> (版本>=0)
	private $spuSubTitle;	//<std::string> spu统一副题(版本>=0)
	private $spuSubTitle_u;	//<uint8_t> (版本>=0)
	private $spuPromotDesc;	//<std::string> spu统一促销语(版本>=0)
	private $spuPromotDesc_u;	//<uint8_t> (版本>=0)
	private $spuUnifyPrice;	//<uint32_t> spu统一售价，单位分 (版本>=0)
	private $spuUnifyPrice_u;	//<uint8_t> (版本>=0)
	private $spuReferPrice;	//<uint32_t> spu统一参考售价，单位分 (版本>=0)
	private $spuReferPrice_u;	//<uint8_t> (版本>=0)
	private $spuSaleAttr;	//<std::string> spu已选的销售属性项集合，竖线分割的id集合,从小到大排列 例如：2483|2486(版本>=0)
	private $spuSaleAttr_u;	//<uint8_t> (版本>=0)
	private $spuSaleAttrText;	//<std::string> spuSaleAttr解析后明文例如：颜色|尺码(版本>=0)
	private $spuSaleAttrText_u;	//<uint8_t> (版本>=0)
	private $spuKeyAttr;	//<std::string> spu关键属性项值集合，项值以冒号分割，项值和项值之间以竖线分割，项id从小到大排列 例如：123:356|345:567(版本>=0)
	private $spuKeyAttr_u;	//<uint8_t> (版本>=0)
	private $spuKeyAttrText;	//<std::string> spuKeyAttr解析后明文例如：品牌:三星|货号:35666545(版本>=0)
	private $spuKeyAttrText_u;	//<uint8_t> (版本>=0)
	private $spuCategoryAttr;	//<std::string> spu公共类目属性串，属于spu，但是不用来区分spu的属性项，只起描述作用，格式定义与spuKeyAttr字段一样(版本>=0)
	private $spuCategoryAttr_u;	//<uint8_t> (版本>=0)
	private $spuCategoryAttrText;	//<std::string> spuCategoryAttr解析后明文 例如：cpu:i5|memory:2G(版本>=0)
	private $spuCategoryAttrText_u;	//<uint8_t> (版本>=0)
	private $spuProperty;	//<std::bitset<128> > spu属性标志 参见enum SpuProperty(版本>=0)
	private $spuProperty_u;	//<uint8_t> (版本>=0)
	private $spuState;	//<uint64_t> spu状态 参见enmu SpuState(版本>=0)
	private $spuState_u;	//<uint8_t> (版本>=0)
	private $spuKeyWord;	//<std::string> 关键字，竖线分割，最长128字节(版本>=0)
	private $spuKeyWord_u;	//<uint8_t> (版本>=0)
	private $spuClassify;	//<std::string> spu分类，最长64字节(版本>=0)
	private $spuClassify_u;	//<uint8_t> (版本>=0)
	private $spuAddTime;	//<std::string> spu添加时间，格式0000-00-00 00:00:00(版本>=0)
	private $spuAddTime_u;	//<uint8_t> (版本>=0)
	private $spuLastUpdateTime;	//<std::string> spu最后修改时间，格式0000-00-00 00:00:00(版本>=0)
	private $spuLastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $viewSkuPo;	//<std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > > 销售属性对应的sku列表 key为sku的销售属性字符串 对易迅商品 key为易迅的'颜色:值|规格:值' 其中值为id 暂返回主子关系的sku列表 不返回spu下的sku列表 无key的则key为‘default’字符串 同key的在vector中排队(版本>=0)
	private $viewSkuPo_u;	//<uint8_t> (版本>=0)
	private $reserve;	//<std::string> 保留字段 (版本>=0)
	private $reserve_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->spuId = 0;	//<uint32_t>
		$this->spuId_u = 0;	//<uint8_t>
		$this->categoryId = 0;	//<uint32_t>
		$this->categoryId_u = 0;	//<uint8_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->cooperatorId_u = 0;	//<uint8_t>
		$this->spuTitle = "";	//<std::string>
		$this->spuTitle_u = 0;	//<uint8_t>
		$this->spuLeadTitle = "";	//<std::string>
		$this->spuLeadTitle_u = 0;	//<uint8_t>
		$this->spuSubTitle = "";	//<std::string>
		$this->spuSubTitle_u = 0;	//<uint8_t>
		$this->spuPromotDesc = "";	//<std::string>
		$this->spuPromotDesc_u = 0;	//<uint8_t>
		$this->spuUnifyPrice = 0;	//<uint32_t>
		$this->spuUnifyPrice_u = 0;	//<uint8_t>
		$this->spuReferPrice = 0;	//<uint32_t>
		$this->spuReferPrice_u = 0;	//<uint8_t>
		$this->spuSaleAttr = "";	//<std::string>
		$this->spuSaleAttr_u = 0;	//<uint8_t>
		$this->spuSaleAttrText = "";	//<std::string>
		$this->spuSaleAttrText_u = 0;	//<uint8_t>
		$this->spuKeyAttr = "";	//<std::string>
		$this->spuKeyAttr_u = 0;	//<uint8_t>
		$this->spuKeyAttrText = "";	//<std::string>
		$this->spuKeyAttrText_u = 0;	//<uint8_t>
		$this->spuCategoryAttr = "";	//<std::string>
		$this->spuCategoryAttr_u = 0;	//<uint8_t>
		$this->spuCategoryAttrText = "";	//<std::string>
		$this->spuCategoryAttrText_u = 0;	//<uint8_t>
		$this->spuProperty = new \stl_bitset2('128');	//<std::bitset<128> >
		$this->spuProperty_u = 0;	//<uint8_t>
		$this->spuState = 0;	//<uint64_t>
		$this->spuState_u = 0;	//<uint8_t>
		$this->spuKeyWord = "";	//<std::string>
		$this->spuKeyWord_u = 0;	//<uint8_t>
		$this->spuClassify = "";	//<std::string>
		$this->spuClassify_u = 0;	//<uint8_t>
		$this->spuAddTime = "0000-00-00 00:00:00";	//<std::string>
		$this->spuAddTime_u = 0;	//<uint8_t>
		$this->spuLastUpdateTime = "0000-00-00 00:00:00";	//<std::string>
		$this->spuLastUpdateTime_u = 0;	//<uint8_t>
		$this->viewSkuPo = new \stl_map2('stl_string,stl_vector<\b2b2c\detailview\po\ViewSkuPo> ');	//<std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > >
		$this->viewSkuPo_u = 0;	//<uint8_t>
		$this->reserve = "";	//<std::string>
		$this->reserve_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewSpuPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewSpuPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号, version要为小写 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->spuId);	//<uint32_t> spuid 
		$bs->pushUint8_t($this->spuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->categoryId);	//<uint32_t> 品类id，商品所属品类 统一类目后
		$bs->pushUint8_t($this->categoryId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> spu创建者，实际上是发布这个spu下第一个sku的合作伙伴的id 
		$bs->pushUint8_t($this->cooperatorId_u);	//<uint8_t> 
		$bs->pushString($this->spuTitle);	//<std::string> spu统一标题  未被spu统一 则为空 以下同
		$bs->pushUint8_t($this->spuTitle_u);	//<uint8_t> 
		$bs->pushString($this->spuLeadTitle);	//<std::string> spu统一引题 
		$bs->pushUint8_t($this->spuLeadTitle_u);	//<uint8_t> 
		$bs->pushString($this->spuSubTitle);	//<std::string> spu统一副题
		$bs->pushUint8_t($this->spuSubTitle_u);	//<uint8_t> 
		$bs->pushString($this->spuPromotDesc);	//<std::string> spu统一促销语
		$bs->pushUint8_t($this->spuPromotDesc_u);	//<uint8_t> 
		$bs->pushUint32_t($this->spuUnifyPrice);	//<uint32_t> spu统一售价，单位分 
		$bs->pushUint8_t($this->spuUnifyPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->spuReferPrice);	//<uint32_t> spu统一参考售价，单位分 
		$bs->pushUint8_t($this->spuReferPrice_u);	//<uint8_t> 
		$bs->pushString($this->spuSaleAttr);	//<std::string> spu已选的销售属性项集合，竖线分割的id集合,从小到大排列 例如：2483|2486
		$bs->pushUint8_t($this->spuSaleAttr_u);	//<uint8_t> 
		$bs->pushString($this->spuSaleAttrText);	//<std::string> spuSaleAttr解析后明文例如：颜色|尺码
		$bs->pushUint8_t($this->spuSaleAttrText_u);	//<uint8_t> 
		$bs->pushString($this->spuKeyAttr);	//<std::string> spu关键属性项值集合，项值以冒号分割，项值和项值之间以竖线分割，项id从小到大排列 例如：123:356|345:567
		$bs->pushUint8_t($this->spuKeyAttr_u);	//<uint8_t> 
		$bs->pushString($this->spuKeyAttrText);	//<std::string> spuKeyAttr解析后明文例如：品牌:三星|货号:35666545
		$bs->pushUint8_t($this->spuKeyAttrText_u);	//<uint8_t> 
		$bs->pushString($this->spuCategoryAttr);	//<std::string> spu公共类目属性串，属于spu，但是不用来区分spu的属性项，只起描述作用，格式定义与spuKeyAttr字段一样
		$bs->pushUint8_t($this->spuCategoryAttr_u);	//<uint8_t> 
		$bs->pushString($this->spuCategoryAttrText);	//<std::string> spuCategoryAttr解析后明文 例如：cpu:i5|memory:2G
		$bs->pushUint8_t($this->spuCategoryAttrText_u);	//<uint8_t> 
		$bs->pushObject($this->spuProperty,'stl_bitset');	//<std::bitset<128> > spu属性标志 参见enum SpuProperty
		$bs->pushUint8_t($this->spuProperty_u);	//<uint8_t> 
		$bs->pushUint64_t($this->spuState);	//<uint64_t> spu状态 参见enmu SpuState
		$bs->pushUint8_t($this->spuState_u);	//<uint8_t> 
		$bs->pushString($this->spuKeyWord);	//<std::string> 关键字，竖线分割，最长128字节
		$bs->pushUint8_t($this->spuKeyWord_u);	//<uint8_t> 
		$bs->pushString($this->spuClassify);	//<std::string> spu分类，最长64字节
		$bs->pushUint8_t($this->spuClassify_u);	//<uint8_t> 
		$bs->pushString($this->spuAddTime);	//<std::string> spu添加时间，格式0000-00-00 00:00:00
		$bs->pushUint8_t($this->spuAddTime_u);	//<uint8_t> 
		$bs->pushString($this->spuLastUpdateTime);	//<std::string> spu最后修改时间，格式0000-00-00 00:00:00
		$bs->pushUint8_t($this->spuLastUpdateTime_u);	//<uint8_t> 
		$bs->pushObject($this->viewSkuPo,'stl_map');	//<std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > > 销售属性对应的sku列表 key为sku的销售属性字符串 对易迅商品 key为易迅的'颜色:值|规格:值' 其中值为id 暂返回主子关系的sku列表 不返回spu下的sku列表 无key的则key为‘default’字符串 同key的在vector中排队
		$bs->pushUint8_t($this->viewSkuPo_u);	//<uint8_t> 
		$bs->pushString($this->reserve);	//<std::string> 保留字段 
		$bs->pushUint8_t($this->reserve_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号, version要为小写 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuId'] = $bs->popUint32_t();	//<uint32_t> spuid 
		$this->_arr_value['spuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['categoryId'] = $bs->popUint32_t();	//<uint32_t> 品类id，商品所属品类 统一类目后
		$this->_arr_value['categoryId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorId'] = $bs->popUint32_t();	//<uint32_t> spu创建者，实际上是发布这个spu下第一个sku的合作伙伴的id 
		$this->_arr_value['cooperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuTitle'] = $bs->popString();	//<std::string> spu统一标题  未被spu统一 则为空 以下同
		$this->_arr_value['spuTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuLeadTitle'] = $bs->popString();	//<std::string> spu统一引题 
		$this->_arr_value['spuLeadTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuSubTitle'] = $bs->popString();	//<std::string> spu统一副题
		$this->_arr_value['spuSubTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuPromotDesc'] = $bs->popString();	//<std::string> spu统一促销语
		$this->_arr_value['spuPromotDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuUnifyPrice'] = $bs->popUint32_t();	//<uint32_t> spu统一售价，单位分 
		$this->_arr_value['spuUnifyPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuReferPrice'] = $bs->popUint32_t();	//<uint32_t> spu统一参考售价，单位分 
		$this->_arr_value['spuReferPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuSaleAttr'] = $bs->popString();	//<std::string> spu已选的销售属性项集合，竖线分割的id集合,从小到大排列 例如：2483|2486
		$this->_arr_value['spuSaleAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuSaleAttrText'] = $bs->popString();	//<std::string> spuSaleAttr解析后明文例如：颜色|尺码
		$this->_arr_value['spuSaleAttrText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuKeyAttr'] = $bs->popString();	//<std::string> spu关键属性项值集合，项值以冒号分割，项值和项值之间以竖线分割，项id从小到大排列 例如：123:356|345:567
		$this->_arr_value['spuKeyAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuKeyAttrText'] = $bs->popString();	//<std::string> spuKeyAttr解析后明文例如：品牌:三星|货号:35666545
		$this->_arr_value['spuKeyAttrText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuCategoryAttr'] = $bs->popString();	//<std::string> spu公共类目属性串，属于spu，但是不用来区分spu的属性项，只起描述作用，格式定义与spuKeyAttr字段一样
		$this->_arr_value['spuCategoryAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuCategoryAttrText'] = $bs->popString();	//<std::string> spuCategoryAttr解析后明文 例如：cpu:i5|memory:2G
		$this->_arr_value['spuCategoryAttrText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuProperty'] = $bs->popObject('stl_bitset<128>');	//<std::bitset<128> > spu属性标志 参见enum SpuProperty
		$this->_arr_value['spuProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuState'] = $bs->popUint64_t();	//<uint64_t> spu状态 参见enmu SpuState
		$this->_arr_value['spuState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuKeyWord'] = $bs->popString();	//<std::string> 关键字，竖线分割，最长128字节
		$this->_arr_value['spuKeyWord_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuClassify'] = $bs->popString();	//<std::string> spu分类，最长64字节
		$this->_arr_value['spuClassify_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuAddTime'] = $bs->popString();	//<std::string> spu添加时间，格式0000-00-00 00:00:00
		$this->_arr_value['spuAddTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spuLastUpdateTime'] = $bs->popString();	//<std::string> spu最后修改时间，格式0000-00-00 00:00:00
		$this->_arr_value['spuLastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewSkuPo'] = $bs->popObject('stl_map<stl_string,stl_vector<\b2b2c\detailview\po\ViewSkuPo> >');	//<std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > > 销售属性对应的sku列表 key为sku的销售属性字符串 对易迅商品 key为易迅的'颜色:值|规格:值' 其中值为id 暂返回主子关系的sku列表 不返回spu下的sku列表 无key的则key为‘default’字符串 同key的在vector中排队
		$this->_arr_value['viewSkuPo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserve'] = $bs->popString();	//<std::string> 保留字段 
		$this->_arr_value['reserve_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.BatchGetMultPriceRule4PromotionResp.java
class ViewMultPriceRulesForSkuPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> sku id (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $cooperatorSubAccountId;	//<uint64_t> 合作伙伴子帐号 (版本>=0)
	private $cooperatorSubAccountId_u;	//<uint8_t> (版本>=0)
	private $viewMultPriceRulePo4Promotion;	//<std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> > 多价规则Po(版本>=0)
	private $viewMultPriceRulePo4Promotion_u;	//<uint8_t> (版本>=0)
	private $viewSkuPo;	//<b2b2c::detailview::po::CViewSkuPo> sku基本信息 仅供读接口使用(版本>=0)
	private $viewSkuPo_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->cooperatorSubAccountId = 0;	//<uint64_t>
		$this->cooperatorSubAccountId_u = 0;	//<uint8_t>
		$this->viewMultPriceRulePo4Promotion = new \stl_vector2('\b2b2c\detailview\po\ViewMultPriceRulePo4Promotion');	//<std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> >
		$this->viewMultPriceRulePo4Promotion_u = 0;	//<uint8_t>
		$this->viewSkuPo = new \b2b2c\detailview\po\ViewSkuPo();	//<b2b2c::detailview::po::CViewSkuPo>
		$this->viewSkuPo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewMultPriceRulesForSkuPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewMultPriceRulesForSkuPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> sku id 
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->cooperatorSubAccountId);	//<uint64_t> 合作伙伴子帐号 
		$bs->pushUint8_t($this->cooperatorSubAccountId_u);	//<uint8_t> 
		$bs->pushObject($this->viewMultPriceRulePo4Promotion,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> > 多价规则Po
		$bs->pushUint8_t($this->viewMultPriceRulePo4Promotion_u);	//<uint8_t> 
		$bs->pushObject($this->viewSkuPo,'\b2b2c\detailview\po\ViewSkuPo');	//<b2b2c::detailview::po::CViewSkuPo> sku基本信息 仅供读接口使用
		$bs->pushUint8_t($this->viewSkuPo_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> sku id 
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorSubAccountId'] = $bs->popUint64_t();	//<uint64_t> 合作伙伴子帐号 
		$this->_arr_value['cooperatorSubAccountId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewMultPriceRulePo4Promotion'] = $bs->popObject('stl_vector<\b2b2c\detailview\po\ViewMultPriceRulePo4Promotion>');	//<std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> > 多价规则Po
		$this->_arr_value['viewMultPriceRulePo4Promotion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewSkuPo'] = $bs->popObject('\b2b2c\detailview\po\ViewSkuPo');	//<b2b2c::detailview::po::CViewSkuPo> sku基本信息 仅供读接口使用
		$this->_arr_value['viewSkuPo_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewMultPriceRulesForSkuPo.java
class ViewMultPriceRulePo4Promotion{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> sku id  (版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $regionId;	//<uint32_t> 地域 id，写入时必填，不关心地域的可以填100000，表示全国(版本>=0)
	private $regionId_u;	//<uint8_t> (版本>=0)
	private $priceSceneId;	//<uint64_t> 场景 id 必填(版本>=0)
	private $priceSceneId_u;	//<uint8_t> (版本>=0)
	private $priceSourceId;	//<uint64_t> 来源 id 必填(版本>=0)
	private $priceSourceId_u;	//<uint8_t> (版本>=0)
	private $priceName;	//<std::string> 名称(版本>=0)
	private $priceName_u;	//<uint8_t> (版本>=0)
	private $priceNumber;	//<std::string> 数量维度,可实现价格阶梯 格式待定(版本>=0)
	private $priceNumber_u;	//<uint8_t> (版本>=0)
	private $priceBitProperty;	//<std::bitset<32> > 仅读接口,用多价属性(版本>=0)
	private $priceBitProperty_u;	//<uint8_t> (版本>=0)
	private $priceBitInclude;	//<std::bitset<32> > 仅写接口用,price 属性 include bit位,用于设置(版本>=0)
	private $priceBitInclude_u;	//<uint8_t> (版本>=0)
	private $priceBitExclude;	//<std::bitset<32> > 仅写接口用,price 属性 include bit位,用于取消(版本>=0)
	private $priceBitExclude_u;	//<uint8_t> (版本>=0)
	private $priceState;	//<uint16_t> 多价状态 0-已审核 1-待审核 2-中止 3-删除(版本>=0)
	private $priceState_u;	//<uint8_t> (版本>=0)
	private $priceShowOperationType;	//<uint16_t> 多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价)(版本>=0)
	private $priceShowOperationType_u;	//<uint8_t> (版本>=0)
	private $priceShowOperationNum;	//<uint32_t> 多价展示操作数(版本>=0)
	private $priceShowOperationNum_u;	//<uint8_t> (版本>=0)
	private $priceCostRatio;	//<std::string> 多价成本分摊比例(版本>=0)
	private $priceCostRatio_u;	//<uint8_t> (版本>=0)
	private $priceTimeFieldFlag;	//<uint16_t> timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1(版本>=0)
	private $priceTimeFieldFlag_u;	//<uint8_t> (版本>=0)
	private $viewTimePricePo4Promotion;	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> > 多价时间维度 (版本>=0)
	private $viewTimePricePo4Promotion_u;	//<uint8_t> (版本>=0)
	private $priceDesc;	//<std::string> 多价规则描述，选填(版本>=0)
	private $priceDesc_u;	//<uint8_t> (版本>=0)
	private $priceUserIdentityRule;	//<std::string> 用户身份规则，选填(版本>=0)
	private $priceUserIdentityRule_u;	//<uint8_t> (版本>=0)
	private $priceStartTime;	//<uint32_t> 规则开始时间，必填(版本>=0)
	private $priceStartTime_u;	//<uint8_t> (版本>=0)
	private $priceEndTime;	//<uint32_t> 规则结束时间，必填(版本>=0)
	private $priceEndTime_u;	//<uint8_t> (版本>=0)
	private $priceDealOperationType;	//<uint16_t> 多价下单操作行为类型，必填 定义同priceShowOperationType(版本>=0)
	private $priceDealOperationType_u;	//<uint8_t> (版本>=0)
	private $priceDealOperationNum;	//<uint32_t> 多价下单操作数，必填(版本>=0)
	private $priceDealOperationNum_u;	//<uint8_t> (版本>=0)
	private $priceDiffReason;	//<std::string> 展示价与下单价不同原因，选填(版本>=0)
	private $priceDiffReason_u;	//<uint8_t> (版本>=0)
	private $priceDealDesc;	//<std::string> 下单价描述，选填(版本>=0)
	private $priceDealDesc_u;	//<uint8_t> (版本>=0)
	private $pricePromotionDesc;	//<std::string> 活动规则描述(版本>=0)
	private $pricePromotionDesc_u;	//<uint8_t> (版本>=0)
	private $priceBase;	//<uint32_t> 基准价，必填 0-库存价即仓价 其他待定义(版本>=0)
	private $priceBase_u;	//<uint8_t> (版本>=0)
	private $priceMaxUseNum;	//<uint32_t> 规则生效次数(版本>=0)
	private $priceMaxUseNum_u;	//<uint8_t> (版本>=0)
	private $priceEnergySaving;	//<uint32_t> 节能补贴价 default为0(版本>=0)
	private $priceEnergySaving_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitFlag;	//<uint16_t> 是否限购，必填(版本>=0)
	private $priceBuyLimitFlag_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitRule;	//<std::string> 限购规则，选填 待定义(版本>=0)
	private $priceBuyLimitRule_u;	//<uint8_t> (版本>=0)
	private $priceVerifyType;	//<uint16_t> 验证类型，选填，default 0(版本>=0)
	private $priceVerifyType_u;	//<uint8_t> (版本>=0)
	private $priceCreaterId;	//<std::string> 创建者id，必填(版本>=0)
	private $priceCreaterId_u;	//<uint8_t> (版本>=0)
	private $priceStoreHouse;	//<std::string> 适用仓库，格式待定义(版本>=0)
	private $priceStoreHouse_u;	//<uint8_t> (版本>=0)
	private $priceActiveId;	//<std::string> 活动关联id，格式待定义(版本>=0)
	private $priceActiveId_u;	//<uint8_t> (版本>=0)
	private $priceLastModifiyer;	//<std::string> 最后修改人，不填(版本>=0)
	private $priceLastModifiyer_u;	//<uint8_t> (版本>=0)
	private $priceCostResponse;	//<uint32_t> 成本分摊人 待定义(版本>=0)
	private $priceCostResponse_u;	//<uint8_t> (版本>=0)
	private $priceForeCastTime;	//<uint32_t> 预告时间时间(版本>=0)
	private $priceForeCastTime_u;	//<uint8_t> (版本>=0)
	private $priceAddTime;	//<uint32_t> 添加时间，不填(版本>=0)
	private $priceAddTime_u;	//<uint8_t> (版本>=0)
	private $priceLastUpdateTime;	//<uint32_t> 最后更新时间，不填(版本>=0)
	private $priceLastUpdateTime_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->regionId = 0;	//<uint32_t>
		$this->regionId_u = 0;	//<uint8_t>
		$this->priceSceneId = 0;	//<uint64_t>
		$this->priceSceneId_u = 0;	//<uint8_t>
		$this->priceSourceId = 0;	//<uint64_t>
		$this->priceSourceId_u = 0;	//<uint8_t>
		$this->priceName = "";	//<std::string>
		$this->priceName_u = 0;	//<uint8_t>
		$this->priceNumber = "";	//<std::string>
		$this->priceNumber_u = 0;	//<uint8_t>
		$this->priceBitProperty = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->priceBitProperty_u = 0;	//<uint8_t>
		$this->priceBitInclude = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->priceBitInclude_u = 0;	//<uint8_t>
		$this->priceBitExclude = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->priceBitExclude_u = 0;	//<uint8_t>
		$this->priceState = 0;	//<uint16_t>
		$this->priceState_u = 0;	//<uint8_t>
		$this->priceShowOperationType = 0;	//<uint16_t>
		$this->priceShowOperationType_u = 0;	//<uint8_t>
		$this->priceShowOperationNum = 0;	//<uint32_t>
		$this->priceShowOperationNum_u = 0;	//<uint8_t>
		$this->priceCostRatio = "";	//<std::string>
		$this->priceCostRatio_u = 0;	//<uint8_t>
		$this->priceTimeFieldFlag = 0;	//<uint16_t>
		$this->priceTimeFieldFlag_u = 0;	//<uint8_t>
		$this->viewTimePricePo4Promotion = new \stl_vector2('\b2b2c\detailview\po\ViewTimedPricePo4Promotion');	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> >
		$this->viewTimePricePo4Promotion_u = 0;	//<uint8_t>
		$this->priceDesc = "";	//<std::string>
		$this->priceDesc_u = 0;	//<uint8_t>
		$this->priceUserIdentityRule = "";	//<std::string>
		$this->priceUserIdentityRule_u = 0;	//<uint8_t>
		$this->priceStartTime = 0;	//<uint32_t>
		$this->priceStartTime_u = 0;	//<uint8_t>
		$this->priceEndTime = 0;	//<uint32_t>
		$this->priceEndTime_u = 0;	//<uint8_t>
		$this->priceDealOperationType = 0;	//<uint16_t>
		$this->priceDealOperationType_u = 0;	//<uint8_t>
		$this->priceDealOperationNum = 0;	//<uint32_t>
		$this->priceDealOperationNum_u = 0;	//<uint8_t>
		$this->priceDiffReason = "";	//<std::string>
		$this->priceDiffReason_u = 0;	//<uint8_t>
		$this->priceDealDesc = "";	//<std::string>
		$this->priceDealDesc_u = 0;	//<uint8_t>
		$this->pricePromotionDesc = "";	//<std::string>
		$this->pricePromotionDesc_u = 0;	//<uint8_t>
		$this->priceBase = 0;	//<uint32_t>
		$this->priceBase_u = 0;	//<uint8_t>
		$this->priceMaxUseNum = 0;	//<uint32_t>
		$this->priceMaxUseNum_u = 0;	//<uint8_t>
		$this->priceEnergySaving = 0;	//<uint32_t>
		$this->priceEnergySaving_u = 0;	//<uint8_t>
		$this->priceBuyLimitFlag = 0;	//<uint16_t>
		$this->priceBuyLimitFlag_u = 0;	//<uint8_t>
		$this->priceBuyLimitRule = "";	//<std::string>
		$this->priceBuyLimitRule_u = 0;	//<uint8_t>
		$this->priceVerifyType = 0;	//<uint16_t>
		$this->priceVerifyType_u = 0;	//<uint8_t>
		$this->priceCreaterId = "";	//<std::string>
		$this->priceCreaterId_u = 0;	//<uint8_t>
		$this->priceStoreHouse = "";	//<std::string>
		$this->priceStoreHouse_u = 0;	//<uint8_t>
		$this->priceActiveId = "";	//<std::string>
		$this->priceActiveId_u = 0;	//<uint8_t>
		$this->priceLastModifiyer = "";	//<std::string>
		$this->priceLastModifiyer_u = 0;	//<uint8_t>
		$this->priceCostResponse = 0;	//<uint32_t>
		$this->priceCostResponse_u = 0;	//<uint8_t>
		$this->priceForeCastTime = 0;	//<uint32_t>
		$this->priceForeCastTime_u = 0;	//<uint8_t>
		$this->priceAddTime = 0;	//<uint32_t>
		$this->priceAddTime_u = 0;	//<uint8_t>
		$this->priceLastUpdateTime = 0;	//<uint32_t>
		$this->priceLastUpdateTime_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewMultPriceRulePo4Promotion\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewMultPriceRulePo4Promotion\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> sku id  
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id，写入时必填，不关心地域的可以填100000，表示全国
		$bs->pushUint8_t($this->regionId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->priceSceneId);	//<uint64_t> 场景 id 必填
		$bs->pushUint8_t($this->priceSceneId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->priceSourceId);	//<uint64_t> 来源 id 必填
		$bs->pushUint8_t($this->priceSourceId_u);	//<uint8_t> 
		$bs->pushString($this->priceName);	//<std::string> 名称
		$bs->pushUint8_t($this->priceName_u);	//<uint8_t> 
		$bs->pushString($this->priceNumber);	//<std::string> 数量维度,可实现价格阶梯 格式待定
		$bs->pushUint8_t($this->priceNumber_u);	//<uint8_t> 
		$bs->pushObject($this->priceBitProperty,'stl_bitset');	//<std::bitset<32> > 仅读接口,用多价属性
		$bs->pushUint8_t($this->priceBitProperty_u);	//<uint8_t> 
		$bs->pushObject($this->priceBitInclude,'stl_bitset');	//<std::bitset<32> > 仅写接口用,price 属性 include bit位,用于设置
		$bs->pushUint8_t($this->priceBitInclude_u);	//<uint8_t> 
		$bs->pushObject($this->priceBitExclude,'stl_bitset');	//<std::bitset<32> > 仅写接口用,price 属性 include bit位,用于取消
		$bs->pushUint8_t($this->priceBitExclude_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceState);	//<uint16_t> 多价状态 0-已审核 1-待审核 2-中止 3-删除
		$bs->pushUint8_t($this->priceState_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceShowOperationType);	//<uint16_t> 多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价)
		$bs->pushUint8_t($this->priceShowOperationType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceShowOperationNum);	//<uint32_t> 多价展示操作数
		$bs->pushUint8_t($this->priceShowOperationNum_u);	//<uint8_t> 
		$bs->pushString($this->priceCostRatio);	//<std::string> 多价成本分摊比例
		$bs->pushUint8_t($this->priceCostRatio_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceTimeFieldFlag);	//<uint16_t> timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1
		$bs->pushUint8_t($this->priceTimeFieldFlag_u);	//<uint8_t> 
		$bs->pushObject($this->viewTimePricePo4Promotion,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> > 多价时间维度 
		$bs->pushUint8_t($this->viewTimePricePo4Promotion_u);	//<uint8_t> 
		$bs->pushString($this->priceDesc);	//<std::string> 多价规则描述，选填
		$bs->pushUint8_t($this->priceDesc_u);	//<uint8_t> 
		$bs->pushString($this->priceUserIdentityRule);	//<std::string> 用户身份规则，选填
		$bs->pushUint8_t($this->priceUserIdentityRule_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceStartTime);	//<uint32_t> 规则开始时间，必填
		$bs->pushUint8_t($this->priceStartTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceEndTime);	//<uint32_t> 规则结束时间，必填
		$bs->pushUint8_t($this->priceEndTime_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceDealOperationType);	//<uint16_t> 多价下单操作行为类型，必填 定义同priceShowOperationType
		$bs->pushUint8_t($this->priceDealOperationType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceDealOperationNum);	//<uint32_t> 多价下单操作数，必填
		$bs->pushUint8_t($this->priceDealOperationNum_u);	//<uint8_t> 
		$bs->pushString($this->priceDiffReason);	//<std::string> 展示价与下单价不同原因，选填
		$bs->pushUint8_t($this->priceDiffReason_u);	//<uint8_t> 
		$bs->pushString($this->priceDealDesc);	//<std::string> 下单价描述，选填
		$bs->pushUint8_t($this->priceDealDesc_u);	//<uint8_t> 
		$bs->pushString($this->pricePromotionDesc);	//<std::string> 活动规则描述
		$bs->pushUint8_t($this->pricePromotionDesc_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBase);	//<uint32_t> 基准价，必填 0-库存价即仓价 其他待定义
		$bs->pushUint8_t($this->priceBase_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceMaxUseNum);	//<uint32_t> 规则生效次数
		$bs->pushUint8_t($this->priceMaxUseNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceEnergySaving);	//<uint32_t> 节能补贴价 default为0
		$bs->pushUint8_t($this->priceEnergySaving_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceBuyLimitFlag);	//<uint16_t> 是否限购，必填
		$bs->pushUint8_t($this->priceBuyLimitFlag_u);	//<uint8_t> 
		$bs->pushString($this->priceBuyLimitRule);	//<std::string> 限购规则，选填 待定义
		$bs->pushUint8_t($this->priceBuyLimitRule_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceVerifyType);	//<uint16_t> 验证类型，选填，default 0
		$bs->pushUint8_t($this->priceVerifyType_u);	//<uint8_t> 
		$bs->pushString($this->priceCreaterId);	//<std::string> 创建者id，必填
		$bs->pushUint8_t($this->priceCreaterId_u);	//<uint8_t> 
		$bs->pushString($this->priceStoreHouse);	//<std::string> 适用仓库，格式待定义
		$bs->pushUint8_t($this->priceStoreHouse_u);	//<uint8_t> 
		$bs->pushString($this->priceActiveId);	//<std::string> 活动关联id，格式待定义
		$bs->pushUint8_t($this->priceActiveId_u);	//<uint8_t> 
		$bs->pushString($this->priceLastModifiyer);	//<std::string> 最后修改人，不填
		$bs->pushUint8_t($this->priceLastModifiyer_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceCostResponse);	//<uint32_t> 成本分摊人 待定义
		$bs->pushUint8_t($this->priceCostResponse_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceForeCastTime);	//<uint32_t> 预告时间时间
		$bs->pushUint8_t($this->priceForeCastTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceAddTime);	//<uint32_t> 添加时间，不填
		$bs->pushUint8_t($this->priceAddTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceLastUpdateTime);	//<uint32_t> 最后更新时间，不填
		$bs->pushUint8_t($this->priceLastUpdateTime_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> sku id  
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['regionId'] = $bs->popUint32_t();	//<uint32_t> 地域 id，写入时必填，不关心地域的可以填100000，表示全国
		$this->_arr_value['regionId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSceneId'] = $bs->popUint64_t();	//<uint64_t> 场景 id 必填
		$this->_arr_value['priceSceneId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSourceId'] = $bs->popUint64_t();	//<uint64_t> 来源 id 必填
		$this->_arr_value['priceSourceId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceName'] = $bs->popString();	//<std::string> 名称
		$this->_arr_value['priceName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceNumber'] = $bs->popString();	//<std::string> 数量维度,可实现价格阶梯 格式待定
		$this->_arr_value['priceNumber_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBitProperty'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > 仅读接口,用多价属性
		$this->_arr_value['priceBitProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBitInclude'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > 仅写接口用,price 属性 include bit位,用于设置
		$this->_arr_value['priceBitInclude_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBitExclude'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > 仅写接口用,price 属性 include bit位,用于取消
		$this->_arr_value['priceBitExclude_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceState'] = $bs->popUint16_t();	//<uint16_t> 多价状态 0-已审核 1-待审核 2-中止 3-删除
		$this->_arr_value['priceState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceShowOperationType'] = $bs->popUint16_t();	//<uint16_t> 多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价)
		$this->_arr_value['priceShowOperationType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceShowOperationNum'] = $bs->popUint32_t();	//<uint32_t> 多价展示操作数
		$this->_arr_value['priceShowOperationNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceCostRatio'] = $bs->popString();	//<std::string> 多价成本分摊比例
		$this->_arr_value['priceCostRatio_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceTimeFieldFlag'] = $bs->popUint16_t();	//<uint16_t> timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1
		$this->_arr_value['priceTimeFieldFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewTimePricePo4Promotion'] = $bs->popObject('stl_vector<\b2b2c\detailview\po\ViewTimedPricePo4Promotion>');	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> > 多价时间维度 
		$this->_arr_value['viewTimePricePo4Promotion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDesc'] = $bs->popString();	//<std::string> 多价规则描述，选填
		$this->_arr_value['priceDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceUserIdentityRule'] = $bs->popString();	//<std::string> 用户身份规则，选填
		$this->_arr_value['priceUserIdentityRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceStartTime'] = $bs->popUint32_t();	//<uint32_t> 规则开始时间，必填
		$this->_arr_value['priceStartTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceEndTime'] = $bs->popUint32_t();	//<uint32_t> 规则结束时间，必填
		$this->_arr_value['priceEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDealOperationType'] = $bs->popUint16_t();	//<uint16_t> 多价下单操作行为类型，必填 定义同priceShowOperationType
		$this->_arr_value['priceDealOperationType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDealOperationNum'] = $bs->popUint32_t();	//<uint32_t> 多价下单操作数，必填
		$this->_arr_value['priceDealOperationNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDiffReason'] = $bs->popString();	//<std::string> 展示价与下单价不同原因，选填
		$this->_arr_value['priceDiffReason_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDealDesc'] = $bs->popString();	//<std::string> 下单价描述，选填
		$this->_arr_value['priceDealDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pricePromotionDesc'] = $bs->popString();	//<std::string> 活动规则描述
		$this->_arr_value['pricePromotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBase'] = $bs->popUint32_t();	//<uint32_t> 基准价，必填 0-库存价即仓价 其他待定义
		$this->_arr_value['priceBase_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceMaxUseNum'] = $bs->popUint32_t();	//<uint32_t> 规则生效次数
		$this->_arr_value['priceMaxUseNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceEnergySaving'] = $bs->popUint32_t();	//<uint32_t> 节能补贴价 default为0
		$this->_arr_value['priceEnergySaving_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitFlag'] = $bs->popUint16_t();	//<uint16_t> 是否限购，必填
		$this->_arr_value['priceBuyLimitFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitRule'] = $bs->popString();	//<std::string> 限购规则，选填 待定义
		$this->_arr_value['priceBuyLimitRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceVerifyType'] = $bs->popUint16_t();	//<uint16_t> 验证类型，选填，default 0
		$this->_arr_value['priceVerifyType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceCreaterId'] = $bs->popString();	//<std::string> 创建者id，必填
		$this->_arr_value['priceCreaterId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceStoreHouse'] = $bs->popString();	//<std::string> 适用仓库，格式待定义
		$this->_arr_value['priceStoreHouse_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceActiveId'] = $bs->popString();	//<std::string> 活动关联id，格式待定义
		$this->_arr_value['priceActiveId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceLastModifiyer'] = $bs->popString();	//<std::string> 最后修改人，不填
		$this->_arr_value['priceLastModifiyer_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceCostResponse'] = $bs->popUint32_t();	//<uint32_t> 成本分摊人 待定义
		$this->_arr_value['priceCostResponse_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceForeCastTime'] = $bs->popUint32_t();	//<uint32_t> 预告时间时间
		$this->_arr_value['priceForeCastTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceAddTime'] = $bs->popUint32_t();	//<uint32_t> 添加时间，不填
		$this->_arr_value['priceAddTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceLastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后更新时间，不填
		$this->_arr_value['priceLastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewMultPriceRulePo4Promotion.java
class ViewTimedPricePo4Promotion{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $timedPriceIndex;	//<uint16_t>  timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO:(版本>=0)
	private $timedPriceIndex_u;	//<uint8_t> (版本>=0)
	private $timedPriceState;	//<uint16_t> 多价状态 0-已审核 1-待审核 2-中止 3-删除(版本>=0)
	private $timedPriceState_u;	//<uint8_t> (版本>=0)
	private $timedPriceName;	//<std::string>  规则名称 支持64个字符(版本>=0)
	private $timedPriceName_u;	//<uint8_t> (版本>=0)
	private $timedPriceCount;	//<uint16_t>  timedPrice 次数,可不填，default为1次(版本>=0)
	private $timedPriceCount_u;	//<uint8_t> (版本>=0)
	private $timedPriceLastLong;	//<uint32_t>  timedPrice 持续时间 单位s，必填 由结束时间-开始时间 (版本>=0)
	private $timedPriceLastLong_u;	//<uint8_t> (版本>=0)
	private $timedPriceStartTime;	//<uint32_t>  timedPrice 开始时间 必填(版本>=0)
	private $timedPriceStartTime_u;	//<uint8_t> (版本>=0)
	private $timedPriceOperationType;	//<uint16_t>  timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填(版本>=0)
	private $timedPriceOperationType_u;	//<uint8_t> (版本>=0)
	private $timedPriceOperationNum;	//<uint32_t>  timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填(版本>=0)
	private $timedPriceOperationNum_u;	//<uint8_t> (版本>=0)
	private $timedPriceProperty;	//<uint32_t>  timedPrice 属性 仅用于读接口(版本>=0)
	private $timedPriceProperty_u;	//<uint8_t> (版本>=0)
	private $timedPriceBitInclude;	//<std::bitset<32> > 属性 include bit位 仅用于写接口 设置属性(版本>=0)
	private $timedPriceBitInclude_u;	//<uint8_t> 属性 include bit位 flag(版本>=0)
	private $timePriceBitExclude;	//<std::bitset<32> > 属性 exclude bit位 仅用于写接口 取消属性(版本>=0)
	private $timePriceBitExclude_u;	//<uint8_t> 属性 exclude bit位 flag(版本>=0)
	private $timedPriceCustomerPromotionRule;	//<std::string>  timedPrice 自定义促销规则，暂不填(版本>=0)
	private $timedPriceCustomerPromotionRule_u;	//<uint8_t> (版本>=0)
	private $timedPriceBasePriceType;	//<uint16_t>  timedPrice 价格基准类型，必填(版本>=0)
	private $timedPriceBasePriceType_u;	//<uint8_t> (版本>=0)
	private $timedPricePromotionDesc;	//<std::string>  促销语描述，最大支持120个字(字符) 选填(版本>=0)
	private $timedPricePromotionDesc_u;	//<uint8_t> (版本>=0)
	private $timedPriceMaxUseNum;	//<uint32_t> 规则生效次数(版本>=0)
	private $timedPriceMaxUseNum_u;	//<uint8_t> (版本>=0)
	private $timedPriceStoreHouse;	//<std::string> 适用仓库，格式待定义(版本>=0)
	private $timedPriceStoreHouse_u;	//<uint8_t> (版本>=0)
	private $timedPriceActiveId;	//<std::string> 活动关联id，格式待定义(版本>=0)
	private $timedPriceActiveId_u;	//<uint8_t> (版本>=0)
	private $timedPriceCostResponse;	//<uint32_t> 成本分摊人 待定义(版本>=0)
	private $timedPriceCostResponse_u;	//<uint8_t> (版本>=0)
	private $timedPriceForeCastTime;	//<uint32_t> 预告时间时间(版本>=0)
	private $timedPriceForeCastTime_u;	//<uint8_t> (版本>=0)
	private $timedPriceBuyLimitRule;	//<std::string> 限购规则(版本>=0)
	private $timedPriceBuyLimitRule_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->timedPriceIndex = 0;	//<uint16_t>
		$this->timedPriceIndex_u = 0;	//<uint8_t>
		$this->timedPriceState = 0;	//<uint16_t>
		$this->timedPriceState_u = 0;	//<uint8_t>
		$this->timedPriceName = "";	//<std::string>
		$this->timedPriceName_u = 0;	//<uint8_t>
		$this->timedPriceCount = 0;	//<uint16_t>
		$this->timedPriceCount_u = 0;	//<uint8_t>
		$this->timedPriceLastLong = 0;	//<uint32_t>
		$this->timedPriceLastLong_u = 0;	//<uint8_t>
		$this->timedPriceStartTime = 0;	//<uint32_t>
		$this->timedPriceStartTime_u = 0;	//<uint8_t>
		$this->timedPriceOperationType = 0;	//<uint16_t>
		$this->timedPriceOperationType_u = 0;	//<uint8_t>
		$this->timedPriceOperationNum = 0;	//<uint32_t>
		$this->timedPriceOperationNum_u = 0;	//<uint8_t>
		$this->timedPriceProperty = 0;	//<uint32_t>
		$this->timedPriceProperty_u = 0;	//<uint8_t>
		$this->timedPriceBitInclude = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->timedPriceBitInclude_u = 0;	//<uint8_t>
		$this->timePriceBitExclude = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->timePriceBitExclude_u = 0;	//<uint8_t>
		$this->timedPriceCustomerPromotionRule = "";	//<std::string>
		$this->timedPriceCustomerPromotionRule_u = 0;	//<uint8_t>
		$this->timedPriceBasePriceType = 0;	//<uint16_t>
		$this->timedPriceBasePriceType_u = 0;	//<uint8_t>
		$this->timedPricePromotionDesc = "";	//<std::string>
		$this->timedPricePromotionDesc_u = 0;	//<uint8_t>
		$this->timedPriceMaxUseNum = 0;	//<uint32_t>
		$this->timedPriceMaxUseNum_u = 0;	//<uint8_t>
		$this->timedPriceStoreHouse = "";	//<std::string>
		$this->timedPriceStoreHouse_u = 0;	//<uint8_t>
		$this->timedPriceActiveId = "";	//<std::string>
		$this->timedPriceActiveId_u = 0;	//<uint8_t>
		$this->timedPriceCostResponse = 0;	//<uint32_t>
		$this->timedPriceCostResponse_u = 0;	//<uint8_t>
		$this->timedPriceForeCastTime = 0;	//<uint32_t>
		$this->timedPriceForeCastTime_u = 0;	//<uint8_t>
		$this->timedPriceBuyLimitRule = "";	//<std::string>
		$this->timedPriceBuyLimitRule_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewTimedPricePo4Promotion\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewTimedPricePo4Promotion\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint16_t($this->timedPriceIndex);	//<uint16_t>  timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO:
		$bs->pushUint8_t($this->timedPriceIndex_u);	//<uint8_t> 
		$bs->pushUint16_t($this->timedPriceState);	//<uint16_t> 多价状态 0-已审核 1-待审核 2-中止 3-删除
		$bs->pushUint8_t($this->timedPriceState_u);	//<uint8_t> 
		$bs->pushString($this->timedPriceName);	//<std::string>  规则名称 支持64个字符
		$bs->pushUint8_t($this->timedPriceName_u);	//<uint8_t> 
		$bs->pushUint16_t($this->timedPriceCount);	//<uint16_t>  timedPrice 次数,可不填，default为1次
		$bs->pushUint8_t($this->timedPriceCount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceLastLong);	//<uint32_t>  timedPrice 持续时间 单位s，必填 由结束时间-开始时间 
		$bs->pushUint8_t($this->timedPriceLastLong_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceStartTime);	//<uint32_t>  timedPrice 开始时间 必填
		$bs->pushUint8_t($this->timedPriceStartTime_u);	//<uint8_t> 
		$bs->pushUint16_t($this->timedPriceOperationType);	//<uint16_t>  timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填
		$bs->pushUint8_t($this->timedPriceOperationType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceOperationNum);	//<uint32_t>  timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填
		$bs->pushUint8_t($this->timedPriceOperationNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceProperty);	//<uint32_t>  timedPrice 属性 仅用于读接口
		$bs->pushUint8_t($this->timedPriceProperty_u);	//<uint8_t> 
		$bs->pushObject($this->timedPriceBitInclude,'stl_bitset');	//<std::bitset<32> > 属性 include bit位 仅用于写接口 设置属性
		$bs->pushUint8_t($this->timedPriceBitInclude_u);	//<uint8_t> 属性 include bit位 flag
		$bs->pushObject($this->timePriceBitExclude,'stl_bitset');	//<std::bitset<32> > 属性 exclude bit位 仅用于写接口 取消属性
		$bs->pushUint8_t($this->timePriceBitExclude_u);	//<uint8_t> 属性 exclude bit位 flag
		$bs->pushString($this->timedPriceCustomerPromotionRule);	//<std::string>  timedPrice 自定义促销规则，暂不填
		$bs->pushUint8_t($this->timedPriceCustomerPromotionRule_u);	//<uint8_t> 
		$bs->pushUint16_t($this->timedPriceBasePriceType);	//<uint16_t>  timedPrice 价格基准类型，必填
		$bs->pushUint8_t($this->timedPriceBasePriceType_u);	//<uint8_t> 
		$bs->pushString($this->timedPricePromotionDesc);	//<std::string>  促销语描述，最大支持120个字(字符) 选填
		$bs->pushUint8_t($this->timedPricePromotionDesc_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceMaxUseNum);	//<uint32_t> 规则生效次数
		$bs->pushUint8_t($this->timedPriceMaxUseNum_u);	//<uint8_t> 
		$bs->pushString($this->timedPriceStoreHouse);	//<std::string> 适用仓库，格式待定义
		$bs->pushUint8_t($this->timedPriceStoreHouse_u);	//<uint8_t> 
		$bs->pushString($this->timedPriceActiveId);	//<std::string> 活动关联id，格式待定义
		$bs->pushUint8_t($this->timedPriceActiveId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceCostResponse);	//<uint32_t> 成本分摊人 待定义
		$bs->pushUint8_t($this->timedPriceCostResponse_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceForeCastTime);	//<uint32_t> 预告时间时间
		$bs->pushUint8_t($this->timedPriceForeCastTime_u);	//<uint8_t> 
		$bs->pushString($this->timedPriceBuyLimitRule);	//<std::string> 限购规则
		$bs->pushUint8_t($this->timedPriceBuyLimitRule_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceIndex'] = $bs->popUint16_t();	//<uint16_t>  timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO:
		$this->_arr_value['timedPriceIndex_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceState'] = $bs->popUint16_t();	//<uint16_t> 多价状态 0-已审核 1-待审核 2-中止 3-删除
		$this->_arr_value['timedPriceState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceName'] = $bs->popString();	//<std::string>  规则名称 支持64个字符
		$this->_arr_value['timedPriceName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceCount'] = $bs->popUint16_t();	//<uint16_t>  timedPrice 次数,可不填，default为1次
		$this->_arr_value['timedPriceCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceLastLong'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 持续时间 单位s，必填 由结束时间-开始时间 
		$this->_arr_value['timedPriceLastLong_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceStartTime'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 开始时间 必填
		$this->_arr_value['timedPriceStartTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceOperationType'] = $bs->popUint16_t();	//<uint16_t>  timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填
		$this->_arr_value['timedPriceOperationType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceOperationNum'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填
		$this->_arr_value['timedPriceOperationNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceProperty'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 属性 仅用于读接口
		$this->_arr_value['timedPriceProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceBitInclude'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > 属性 include bit位 仅用于写接口 设置属性
		$this->_arr_value['timedPriceBitInclude_u'] = $bs->popUint8_t();	//<uint8_t> 属性 include bit位 flag
		$this->_arr_value['timePriceBitExclude'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > 属性 exclude bit位 仅用于写接口 取消属性
		$this->_arr_value['timePriceBitExclude_u'] = $bs->popUint8_t();	//<uint8_t> 属性 exclude bit位 flag
		$this->_arr_value['timedPriceCustomerPromotionRule'] = $bs->popString();	//<std::string>  timedPrice 自定义促销规则，暂不填
		$this->_arr_value['timedPriceCustomerPromotionRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceBasePriceType'] = $bs->popUint16_t();	//<uint16_t>  timedPrice 价格基准类型，必填
		$this->_arr_value['timedPriceBasePriceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPricePromotionDesc'] = $bs->popString();	//<std::string>  促销语描述，最大支持120个字(字符) 选填
		$this->_arr_value['timedPricePromotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceMaxUseNum'] = $bs->popUint32_t();	//<uint32_t> 规则生效次数
		$this->_arr_value['timedPriceMaxUseNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceStoreHouse'] = $bs->popString();	//<std::string> 适用仓库，格式待定义
		$this->_arr_value['timedPriceStoreHouse_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceActiveId'] = $bs->popString();	//<std::string> 活动关联id，格式待定义
		$this->_arr_value['timedPriceActiveId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceCostResponse'] = $bs->popUint32_t();	//<uint32_t> 成本分摊人 待定义
		$this->_arr_value['timedPriceCostResponse_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceForeCastTime'] = $bs->popUint32_t();	//<uint32_t> 预告时间时间
		$this->_arr_value['timedPriceForeCastTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceBuyLimitRule'] = $bs->popString();	//<std::string> 限购规则
		$this->_arr_value['timedPriceBuyLimitRule_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewMultPriceRulesForSkuPo.java
class ViewSkuPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> skuid,网购侧唯一(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $skuType;	//<uint32_t> 商品类型 如：正常商品 二手商品等 参见enum SkuType(版本>=0)
	private $skuType_u;	//<uint8_t> (版本>=0)
	private $inputSkuId;	//<uint64_t> 请求的SKUID 例如：入参skuid为A，由于某种原因A被迁移变更或替换为B，则返回的数据中无A的sku，则在B的sku信息中这个字段被设置为A(版本>=0)
	private $inputSkuId_u;	//<uint8_t> (版本>=0)
	private $cooperatorSubAccountId;	//<uint64_t> 合作伙伴ID 主号+子号  (版本>=0)
	private $cooperatorSubAccountId_u;	//<uint8_t> (版本>=0)
	private $itemId;	//<uint64_t> ItemID,目前的itemId实际上表示主子商品的组id(版本>=0)
	private $itemId_u;	//<uint8_t> (版本>=0)
	private $ssuId;	//<uint64_t> ssuid 最小搜索单元id(版本>=0)
	private $ssuId_u;	//<uint8_t> (版本>=0)
	private $cooperatorSkuCode;	//<std::string> 供应商Sku编码 实际上对应易迅商品ID(版本>=0)
	private $cooperatorSkuCode_u;	//<uint8_t> (版本>=0)
	private $producerBarCode;	//<std::string> 生产商条形码  (版本>=0)
	private $producerBarCode_u;	//<uint8_t> (版本>=0)
	private $skuBarCode;	//<std::string> 国际通行条形码  (版本>=0)
	private $skuBarCode_u;	//<uint8_t> (版本>=0)
	private $skuTitle;	//<std::string> Sku标题  (版本>=0)
	private $skuTitle_u;	//<uint8_t> (版本>=0)
	private $skuLeadTitle;	//<std::string> Sku引题  (版本>=0)
	private $skuLeadTitle_u;	//<uint8_t> (版本>=0)
	private $skuSubTitle;	//<std::string> Sku副题  (版本>=0)
	private $skuSubTitle_u;	//<uint8_t> (版本>=0)
	private $skuPromotDesc;	//<std::string> Sku促销语  (版本>=0)
	private $skuPromotDesc_u;	//<uint8_t> (版本>=0)
	private $skuSaleAttr;	//<std::string> Sku销售属性串  (版本>=0)
	private $skuSaleAttr_u;	//<uint8_t> (版本>=0)
	private $skuSaleAttrText;	//<std::string> sku销售属性明文(版本>=0)
	private $skuSaleAttrText_u;	//<uint8_t> (版本>=0)
	private $skuSaleAttrDesc;	//<std::string> Sku销售属性串描述 为销售属性做额外解析 (版本>=0)
	private $skuSaleAttrDesc_u;	//<uint8_t> (版本>=0)
	private $skuReferPrice;	//<uint32_t> Sku参考价格 即市场价,精确到分  (版本>=0)
	private $skuReferPrice_u;	//<uint8_t> (版本>=0)
	private $skuProperty;	//<std::bitset<128> > Sku属性标志 参见enum SkuProperty(二手商品属性位废弃)  (版本>=0)
	private $skuProperty_u;	//<uint8_t> (版本>=0)
	private $skuState;	//<uint8_t> Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 (版本>=0)
	private $skuState_u;	//<uint8_t> (版本>=0)
	private $skuWeight;	//<uint32_t> Sku 重量 克  (版本>=0)
	private $skuWeight_u;	//<uint8_t> (版本>=0)
	private $skuVolume;	//<uint32_t> Sku 体积 立方厘米  (版本>=0)
	private $skuVolume_u;	//<uint8_t> (版本>=0)
	private $skuCategoryAttr;	//<std::string> Sku 类目属性串  (版本>=0)
	private $skuCategoryAttr_u;	//<uint8_t> (版本>=0)
	private $skuCategoryAttrText;	//<std::string> Sku 类目属性串明文  (版本>=0)
	private $skuCategoryAttrText_u;	//<uint8_t> (版本>=0)
	private $skuCustomizeAttr;	//<std::string> Sku 自定义属性(版本>=0)
	private $skuCustomizeAttr_u;	//<uint8_t> (版本>=0)
	private $skuCustomizeAttrText;	//<std::string> Sku 自定义属性 明文 (版本>=0)
	private $skuCustomizeAttrText_u;	//<uint8_t> (版本>=0)
	private $skukeyWord;	//<std::string> Sku 关键词 可以有多个 (版本>=0)
	private $skukeyWord_u;	//<uint8_t> (版本>=0)
	private $skuClassify;	//<std::string> Sku 分类  (版本>=0)
	private $skuClassify_u;	//<uint8_t> (版本>=0)
	private $skuVatRate;	//<uint32_t> Sku 税率  (版本>=0)
	private $skuVatRate_u;	//<uint8_t> (版本>=0)
	private $skuSnapVersion;	//<uint16_t> Sku 当前快照版本  (版本>=0)
	private $skuSnapVersion_u;	//<uint8_t> (版本>=0)
	private $skuBuyLimit;	//<uint32_t> Sku 购买限制 0 -- 无限制  (版本>=0)
	private $skuBuyLimit_u;	//<uint8_t> (版本>=0)
	private $skuLastUpTime;	//<uint32_t> Sku 最后上架时间  (版本>=0)
	private $skuLastUpTime_u;	//<uint8_t> (版本>=0)
	private $skuLastDownTime;	//<uint32_t> Sku 最后下架时间  (版本>=0)
	private $skuLastDownTime_u;	//<uint8_t> (版本>=0)
	private $skuAddTime;	//<uint32_t> Sku 添加时间  (版本>=0)
	private $skuAddTime_u;	//<uint8_t> (版本>=0)
	private $skuLastSnapTime;	//<uint32_t> Sku 最后快照生成时间  (版本>=0)
	private $skuLastSnapTime_u;	//<uint8_t> (版本>=0)
	private $skuLastUpdateTime;	//<uint32_t> Sku 最后修改时间  (版本>=0)
	private $skuLastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $mainLogoLastUpdateTime;	//<uint32_t> 主图最后更新时间 可以拼接在图片链接后面 用来强制浏览器拉取新图片(版本>=0)
	private $mainLogoLastUpdateTime_u;	//<uint8_t> (版本>=0)
	private $skuSizeTableId;	//<uint32_t> 尺码表Id 保留(版本>=0)
	private $skuSizeTableId_u;	//<uint8_t> (版本>=0)
	private $icsonInfoPo;	//<b2b2c::detailview::po::CIcsonInfoPo> 易迅商品信息(版本>=0)
	private $icsonInfoPo_u;	//<uint8_t> (版本>=0)
	private $viewStockPo;	//<std::vector<b2b2c::detailview::po::CViewStockPo> > 一个Sku所对应的库存信息 即分仓信息 (版本>=0)
	private $viewStockPo_u;	//<uint8_t> (版本>=0)
	private $viewSkuPicturePo;	//<b2b2c::detailview::po::CViewSkuPicturePo> Sku主图Po 里面有主图url及图片类型等 (版本>=0)
	private $viewSkuPicturePo_u;	//<uint8_t> (版本>=0)
	private $viewCooperatorBasePo;	//<b2b2c::detailview::po::CViewCooperatorBasePo> 该sku所属合作伙伴基本信息  (版本>=0)
	private $viewCooperatorBasePo_u;	//<uint8_t> (版本>=0)
	private $viewMultPricePo;	//<b2b2c::detailview::po::CViewMultPricePo> 多价po 网购侧多价po 内含地域价和限时价 保留(版本>=0)
	private $viewMultPricePo_u;	//<uint8_t> (版本>=0)
	private $reverse;	//<std::string> reverse字段 (版本>=0)
	private $reverse_u;	//<uint8_t> (版本>=0)
	private $skuOperationModel;	//<uint32_t> 运营类型 0:经销/1:代销/2:联营/3：新联营 (版本>=20120308)
	private $skuOperationModel_u;	//<uint8_t> 运营类型 0:经销/1:代销/2:联营/3：新联营 (版本>=20120308)
	private $skuSearchFactor;	//<uint32_t> Sku 搜索因子 仅供搜索使用 其他调用接口不用关心(版本>=20130327)
	private $skuSearchFactor_u;	//<uint8_t> Sku 搜索因子flag 其他调用接口不用关心(版本>=20130327)
	private $skuSizeX;	//<uint16_t> 商品长度，单位毫米(版本>=20130329)
	private $skuSizeX_u;	//<uint8_t> 商品长度，单位毫米(版本>=20130329)
	private $skuSizeY;	//<uint16_t> 商品宽度，单位毫米(版本>=20130329)
	private $skuSizeY_u;	//<uint8_t> 商品宽度，单位毫米(版本>=20130329)
	private $skuSizeZ;	//<uint16_t> 商品高度，单位毫米(版本>=20130329)
	private $skuSizeZ_u;	//<uint8_t> 商品高度，单位毫米(版本>=20130329)
	private $skuComponent;	//<std::map<std::string,uint16_t> > 组件清单, coSkuCode(易迅sysno) -> 组件数量(版本>=20130329)
	private $skuComponent_u;	//<uint8_t> 组件清单, coSkuCode(易迅sysno) -> 组件数量_u(版本>=20130329)
	private $skuNetWeight;	//<uint32_t> 净重,单位克(版本>=20130617)
	private $skuNetWeight_u;	//<uint8_t> 净重,单位克_u(版本>=20130617)
	private $categoryId;	//<uint32_t> 品类id，商品所属品类 统一类目后  可代替外层spu结构上的品类(版本>=20130617)
	private $categoryId_u;	//<uint8_t> 品类id_u，商品所属品类 统一类目后 可代替外层spu结构上的品类 (版本>=20130617)
	private $viewOmsStockPo;	//<std::vector<b2b2c::detailview::po::CViewOmsStockPo> > 该商品对应的 oms 库存信息(版本>=20130628)
	private $viewOmsStockPo_u;	//<uint8_t> oms 库存信息flag(版本>=20130628)

	function __construct(){
		$this->version = 20130617;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->skuType = 0;	//<uint32_t>
		$this->skuType_u = 0;	//<uint8_t>
		$this->inputSkuId = 0;	//<uint64_t>
		$this->inputSkuId_u = 0;	//<uint8_t>
		$this->cooperatorSubAccountId = 0;	//<uint64_t>
		$this->cooperatorSubAccountId_u = 0;	//<uint8_t>
		$this->itemId = 0;	//<uint64_t>
		$this->itemId_u = 0;	//<uint8_t>
		$this->ssuId = 0;	//<uint64_t>
		$this->ssuId_u = 0;	//<uint8_t>
		$this->cooperatorSkuCode = "";	//<std::string>
		$this->cooperatorSkuCode_u = 0;	//<uint8_t>
		$this->producerBarCode = "";	//<std::string>
		$this->producerBarCode_u = 0;	//<uint8_t>
		$this->skuBarCode = "";	//<std::string>
		$this->skuBarCode_u = 0;	//<uint8_t>
		$this->skuTitle = "";	//<std::string>
		$this->skuTitle_u = 0;	//<uint8_t>
		$this->skuLeadTitle = "";	//<std::string>
		$this->skuLeadTitle_u = 0;	//<uint8_t>
		$this->skuSubTitle = "";	//<std::string>
		$this->skuSubTitle_u = 0;	//<uint8_t>
		$this->skuPromotDesc = "";	//<std::string>
		$this->skuPromotDesc_u = 0;	//<uint8_t>
		$this->skuSaleAttr = "";	//<std::string>
		$this->skuSaleAttr_u = 0;	//<uint8_t>
		$this->skuSaleAttrText = "";	//<std::string>
		$this->skuSaleAttrText_u = 0;	//<uint8_t>
		$this->skuSaleAttrDesc = "";	//<std::string>
		$this->skuSaleAttrDesc_u = 0;	//<uint8_t>
		$this->skuReferPrice = 0;	//<uint32_t>
		$this->skuReferPrice_u = 0;	//<uint8_t>
		$this->skuProperty = new \stl_bitset2('128');	//<std::bitset<128> >
		$this->skuProperty_u = 0;	//<uint8_t>
		$this->skuState = 0;	//<uint8_t>
		$this->skuState_u = 0;	//<uint8_t>
		$this->skuWeight = 0;	//<uint32_t>
		$this->skuWeight_u = 0;	//<uint8_t>
		$this->skuVolume = 0;	//<uint32_t>
		$this->skuVolume_u = 0;	//<uint8_t>
		$this->skuCategoryAttr = "";	//<std::string>
		$this->skuCategoryAttr_u = 0;	//<uint8_t>
		$this->skuCategoryAttrText = "";	//<std::string>
		$this->skuCategoryAttrText_u = 0;	//<uint8_t>
		$this->skuCustomizeAttr = "";	//<std::string>
		$this->skuCustomizeAttr_u = 0;	//<uint8_t>
		$this->skuCustomizeAttrText = "";	//<std::string>
		$this->skuCustomizeAttrText_u = 0;	//<uint8_t>
		$this->skukeyWord = "";	//<std::string>
		$this->skukeyWord_u = 0;	//<uint8_t>
		$this->skuClassify = "";	//<std::string>
		$this->skuClassify_u = 0;	//<uint8_t>
		$this->skuVatRate = 0;	//<uint32_t>
		$this->skuVatRate_u = 0;	//<uint8_t>
		$this->skuSnapVersion = 0;	//<uint16_t>
		$this->skuSnapVersion_u = 0;	//<uint8_t>
		$this->skuBuyLimit = 0;	//<uint32_t>
		$this->skuBuyLimit_u = 0;	//<uint8_t>
		$this->skuLastUpTime = 0;	//<uint32_t>
		$this->skuLastUpTime_u = 0;	//<uint8_t>
		$this->skuLastDownTime = 0;	//<uint32_t>
		$this->skuLastDownTime_u = 0;	//<uint8_t>
		$this->skuAddTime = 0;	//<uint32_t>
		$this->skuAddTime_u = 0;	//<uint8_t>
		$this->skuLastSnapTime = 0;	//<uint32_t>
		$this->skuLastSnapTime_u = 0;	//<uint8_t>
		$this->skuLastUpdateTime = 0;	//<uint32_t>
		$this->skuLastUpdateTime_u = 0;	//<uint8_t>
		$this->mainLogoLastUpdateTime = 0;	//<uint32_t>
		$this->mainLogoLastUpdateTime_u = 0;	//<uint8_t>
		$this->skuSizeTableId = 0;	//<uint32_t>
		$this->skuSizeTableId_u = 0;	//<uint8_t>
		$this->icsonInfoPo = new \b2b2c\detailview\po\IcsonInfoPo();	//<b2b2c::detailview::po::CIcsonInfoPo>
		$this->icsonInfoPo_u = 0;	//<uint8_t>
		$this->viewStockPo = new \stl_vector2('\b2b2c\detailview\po\ViewStockPo');	//<std::vector<b2b2c::detailview::po::CViewStockPo> >
		$this->viewStockPo_u = 0;	//<uint8_t>
		$this->viewSkuPicturePo = new \b2b2c\detailview\po\ViewSkuPicturePo();	//<b2b2c::detailview::po::CViewSkuPicturePo>
		$this->viewSkuPicturePo_u = 0;	//<uint8_t>
		$this->viewCooperatorBasePo = new \b2b2c\detailview\po\ViewCooperatorBasePo();	//<b2b2c::detailview::po::CViewCooperatorBasePo>
		$this->viewCooperatorBasePo_u = 0;	//<uint8_t>
		$this->viewMultPricePo = new \b2b2c\detailview\po\ViewMultPricePo();	//<b2b2c::detailview::po::CViewMultPricePo>
		$this->viewMultPricePo_u = 0;	//<uint8_t>
		$this->reverse = "";	//<std::string>
		$this->reverse_u = 0;	//<uint8_t>
		$this->skuOperationModel = 0;	//<uint32_t>
		$this->skuOperationModel_u = 0;	//<uint8_t>
		$this->skuSearchFactor = 0;	//<uint32_t>
		$this->skuSearchFactor_u = 0;	//<uint8_t>
		$this->skuSizeX = 0;	//<uint16_t>
		$this->skuSizeX_u = 0;	//<uint8_t>
		$this->skuSizeY = 0;	//<uint16_t>
		$this->skuSizeY_u = 0;	//<uint8_t>
		$this->skuSizeZ = 0;	//<uint16_t>
		$this->skuSizeZ_u = 0;	//<uint8_t>
		$this->skuComponent = new \stl_map2('stl_string,uint16_t');	//<std::map<std::string,uint16_t> >
		$this->skuComponent_u = 0;	//<uint8_t>
		$this->skuNetWeight = 0;	//<uint32_t>
		$this->skuNetWeight_u = 0;	//<uint8_t>
		$this->categoryId = 0;	//<uint32_t>
		$this->categoryId_u = 0;	//<uint8_t>
		$this->viewOmsStockPo = new \stl_vector2('\b2b2c\detailview\po\ViewOmsStockPo');	//<std::vector<b2b2c::detailview::po::CViewOmsStockPo> >
		$this->viewOmsStockPo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewSkuPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewSkuPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuid,网购侧唯一
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuType);	//<uint32_t> 商品类型 如：正常商品 二手商品等 参见enum SkuType
		$bs->pushUint8_t($this->skuType_u);	//<uint8_t> 
		$bs->pushUint64_t($this->inputSkuId);	//<uint64_t> 请求的SKUID 例如：入参skuid为A，由于某种原因A被迁移变更或替换为B，则返回的数据中无A的sku，则在B的sku信息中这个字段被设置为A
		$bs->pushUint8_t($this->inputSkuId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->cooperatorSubAccountId);	//<uint64_t> 合作伙伴ID 主号+子号  
		$bs->pushUint8_t($this->cooperatorSubAccountId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->itemId);	//<uint64_t> ItemID,目前的itemId实际上表示主子商品的组id
		$bs->pushUint8_t($this->itemId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->ssuId);	//<uint64_t> ssuid 最小搜索单元id
		$bs->pushUint8_t($this->ssuId_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorSkuCode);	//<std::string> 供应商Sku编码 实际上对应易迅商品ID
		$bs->pushUint8_t($this->cooperatorSkuCode_u);	//<uint8_t> 
		$bs->pushString($this->producerBarCode);	//<std::string> 生产商条形码  
		$bs->pushUint8_t($this->producerBarCode_u);	//<uint8_t> 
		$bs->pushString($this->skuBarCode);	//<std::string> 国际通行条形码  
		$bs->pushUint8_t($this->skuBarCode_u);	//<uint8_t> 
		$bs->pushString($this->skuTitle);	//<std::string> Sku标题  
		$bs->pushUint8_t($this->skuTitle_u);	//<uint8_t> 
		$bs->pushString($this->skuLeadTitle);	//<std::string> Sku引题  
		$bs->pushUint8_t($this->skuLeadTitle_u);	//<uint8_t> 
		$bs->pushString($this->skuSubTitle);	//<std::string> Sku副题  
		$bs->pushUint8_t($this->skuSubTitle_u);	//<uint8_t> 
		$bs->pushString($this->skuPromotDesc);	//<std::string> Sku促销语  
		$bs->pushUint8_t($this->skuPromotDesc_u);	//<uint8_t> 
		$bs->pushString($this->skuSaleAttr);	//<std::string> Sku销售属性串  
		$bs->pushUint8_t($this->skuSaleAttr_u);	//<uint8_t> 
		$bs->pushString($this->skuSaleAttrText);	//<std::string> sku销售属性明文
		$bs->pushUint8_t($this->skuSaleAttrText_u);	//<uint8_t> 
		$bs->pushString($this->skuSaleAttrDesc);	//<std::string> Sku销售属性串描述 为销售属性做额外解析 
		$bs->pushUint8_t($this->skuSaleAttrDesc_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuReferPrice);	//<uint32_t> Sku参考价格 即市场价,精确到分  
		$bs->pushUint8_t($this->skuReferPrice_u);	//<uint8_t> 
		$bs->pushObject($this->skuProperty,'stl_bitset');	//<std::bitset<128> > Sku属性标志 参见enum SkuProperty(二手商品属性位废弃)  
		$bs->pushUint8_t($this->skuProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->skuState);	//<uint8_t> Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		$bs->pushUint8_t($this->skuState_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuWeight);	//<uint32_t> Sku 重量 克  
		$bs->pushUint8_t($this->skuWeight_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuVolume);	//<uint32_t> Sku 体积 立方厘米  
		$bs->pushUint8_t($this->skuVolume_u);	//<uint8_t> 
		$bs->pushString($this->skuCategoryAttr);	//<std::string> Sku 类目属性串  
		$bs->pushUint8_t($this->skuCategoryAttr_u);	//<uint8_t> 
		$bs->pushString($this->skuCategoryAttrText);	//<std::string> Sku 类目属性串明文  
		$bs->pushUint8_t($this->skuCategoryAttrText_u);	//<uint8_t> 
		$bs->pushString($this->skuCustomizeAttr);	//<std::string> Sku 自定义属性
		$bs->pushUint8_t($this->skuCustomizeAttr_u);	//<uint8_t> 
		$bs->pushString($this->skuCustomizeAttrText);	//<std::string> Sku 自定义属性 明文 
		$bs->pushUint8_t($this->skuCustomizeAttrText_u);	//<uint8_t> 
		$bs->pushString($this->skukeyWord);	//<std::string> Sku 关键词 可以有多个 
		$bs->pushUint8_t($this->skukeyWord_u);	//<uint8_t> 
		$bs->pushString($this->skuClassify);	//<std::string> Sku 分类  
		$bs->pushUint8_t($this->skuClassify_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuVatRate);	//<uint32_t> Sku 税率  
		$bs->pushUint8_t($this->skuVatRate_u);	//<uint8_t> 
		$bs->pushUint16_t($this->skuSnapVersion);	//<uint16_t> Sku 当前快照版本  
		$bs->pushUint8_t($this->skuSnapVersion_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuBuyLimit);	//<uint32_t> Sku 购买限制 0 -- 无限制  
		$bs->pushUint8_t($this->skuBuyLimit_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuLastUpTime);	//<uint32_t> Sku 最后上架时间  
		$bs->pushUint8_t($this->skuLastUpTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuLastDownTime);	//<uint32_t> Sku 最后下架时间  
		$bs->pushUint8_t($this->skuLastDownTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuAddTime);	//<uint32_t> Sku 添加时间  
		$bs->pushUint8_t($this->skuAddTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuLastSnapTime);	//<uint32_t> Sku 最后快照生成时间  
		$bs->pushUint8_t($this->skuLastSnapTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuLastUpdateTime);	//<uint32_t> Sku 最后修改时间  
		$bs->pushUint8_t($this->skuLastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->mainLogoLastUpdateTime);	//<uint32_t> 主图最后更新时间 可以拼接在图片链接后面 用来强制浏览器拉取新图片
		$bs->pushUint8_t($this->mainLogoLastUpdateTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->skuSizeTableId);	//<uint32_t> 尺码表Id 保留
		$bs->pushUint8_t($this->skuSizeTableId_u);	//<uint8_t> 
		$bs->pushObject($this->icsonInfoPo,'\b2b2c\detailview\po\IcsonInfoPo');	//<b2b2c::detailview::po::CIcsonInfoPo> 易迅商品信息
		$bs->pushUint8_t($this->icsonInfoPo_u);	//<uint8_t> 
		$bs->pushObject($this->viewStockPo,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewStockPo> > 一个Sku所对应的库存信息 即分仓信息 
		$bs->pushUint8_t($this->viewStockPo_u);	//<uint8_t> 
		$bs->pushObject($this->viewSkuPicturePo,'\b2b2c\detailview\po\ViewSkuPicturePo');	//<b2b2c::detailview::po::CViewSkuPicturePo> Sku主图Po 里面有主图url及图片类型等 
		$bs->pushUint8_t($this->viewSkuPicturePo_u);	//<uint8_t> 
		$bs->pushObject($this->viewCooperatorBasePo,'\b2b2c\detailview\po\ViewCooperatorBasePo');	//<b2b2c::detailview::po::CViewCooperatorBasePo> 该sku所属合作伙伴基本信息  
		$bs->pushUint8_t($this->viewCooperatorBasePo_u);	//<uint8_t> 
		$bs->pushObject($this->viewMultPricePo,'\b2b2c\detailview\po\ViewMultPricePo');	//<b2b2c::detailview::po::CViewMultPricePo> 多价po 网购侧多价po 内含地域价和限时价 保留
		$bs->pushUint8_t($this->viewMultPricePo_u);	//<uint8_t> 
		$bs->pushString($this->reverse);	//<std::string> reverse字段 
		$bs->pushUint8_t($this->reverse_u);	//<uint8_t> 
		if($this->version >= 20120308){
			$bs->pushUint32_t($this->skuOperationModel);	//<uint32_t> 运营类型 0:经销/1:代销/2:联营/3：新联营 
		}
		if($this->version >= 20120308){
			$bs->pushUint8_t($this->skuOperationModel_u);	//<uint8_t> 运营类型 0:经销/1:代销/2:联营/3：新联营 
		}
		if($this->version >= 20130327){
			$bs->pushUint32_t($this->skuSearchFactor);	//<uint32_t> Sku 搜索因子 仅供搜索使用 其他调用接口不用关心
		}
		if($this->version >= 20130327){
			$bs->pushUint8_t($this->skuSearchFactor_u);	//<uint8_t> Sku 搜索因子flag 其他调用接口不用关心
		}
		if($this->version >= 20130329){
			$bs->pushUint16_t($this->skuSizeX);	//<uint16_t> 商品长度，单位毫米
		}
		if($this->version >= 20130329){
			$bs->pushUint8_t($this->skuSizeX_u);	//<uint8_t> 商品长度，单位毫米
		}
		if($this->version >= 20130329){
			$bs->pushUint16_t($this->skuSizeY);	//<uint16_t> 商品宽度，单位毫米
		}
		if($this->version >= 20130329){
			$bs->pushUint8_t($this->skuSizeY_u);	//<uint8_t> 商品宽度，单位毫米
		}
		if($this->version >= 20130329){
			$bs->pushUint16_t($this->skuSizeZ);	//<uint16_t> 商品高度，单位毫米
		}
		if($this->version >= 20130329){
			$bs->pushUint8_t($this->skuSizeZ_u);	//<uint8_t> 商品高度，单位毫米
		}
		if($this->version >= 20130329){
			$bs->pushObject($this->skuComponent,'stl_map');	//<std::map<std::string,uint16_t> > 组件清单, coSkuCode(易迅sysno) -> 组件数量
		}
		if($this->version >= 20130329){
			$bs->pushUint8_t($this->skuComponent_u);	//<uint8_t> 组件清单, coSkuCode(易迅sysno) -> 组件数量_u
		}
		if($this->version >= 20130617){
			$bs->pushUint32_t($this->skuNetWeight);	//<uint32_t> 净重,单位克
		}
		if($this->version >= 20130617){
			$bs->pushUint8_t($this->skuNetWeight_u);	//<uint8_t> 净重,单位克_u
		}
		if($this->version >= 20130617){
			$bs->pushUint32_t($this->categoryId);	//<uint32_t> 品类id，商品所属品类 统一类目后  可代替外层spu结构上的品类
		}
		if($this->version >= 20130617){
			$bs->pushUint8_t($this->categoryId_u);	//<uint8_t> 品类id_u，商品所属品类 统一类目后 可代替外层spu结构上的品类 
		}
		if($this->version >= 20130628){
			$bs->pushObject($this->viewOmsStockPo,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewOmsStockPo> > 该商品对应的 oms 库存信息
		}
		if($this->version >= 20130628){
			$bs->pushUint8_t($this->viewOmsStockPo_u);	//<uint8_t> oms 库存信息flag
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuid,网购侧唯一
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuType'] = $bs->popUint32_t();	//<uint32_t> 商品类型 如：正常商品 二手商品等 参见enum SkuType
		$this->_arr_value['skuType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['inputSkuId'] = $bs->popUint64_t();	//<uint64_t> 请求的SKUID 例如：入参skuid为A，由于某种原因A被迁移变更或替换为B，则返回的数据中无A的sku，则在B的sku信息中这个字段被设置为A
		$this->_arr_value['inputSkuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorSubAccountId'] = $bs->popUint64_t();	//<uint64_t> 合作伙伴ID 主号+子号  
		$this->_arr_value['cooperatorSubAccountId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemId'] = $bs->popUint64_t();	//<uint64_t> ItemID,目前的itemId实际上表示主子商品的组id
		$this->_arr_value['itemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ssuId'] = $bs->popUint64_t();	//<uint64_t> ssuid 最小搜索单元id
		$this->_arr_value['ssuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorSkuCode'] = $bs->popString();	//<std::string> 供应商Sku编码 实际上对应易迅商品ID
		$this->_arr_value['cooperatorSkuCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['producerBarCode'] = $bs->popString();	//<std::string> 生产商条形码  
		$this->_arr_value['producerBarCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuBarCode'] = $bs->popString();	//<std::string> 国际通行条形码  
		$this->_arr_value['skuBarCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuTitle'] = $bs->popString();	//<std::string> Sku标题  
		$this->_arr_value['skuTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuLeadTitle'] = $bs->popString();	//<std::string> Sku引题  
		$this->_arr_value['skuLeadTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuSubTitle'] = $bs->popString();	//<std::string> Sku副题  
		$this->_arr_value['skuSubTitle_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuPromotDesc'] = $bs->popString();	//<std::string> Sku促销语  
		$this->_arr_value['skuPromotDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuSaleAttr'] = $bs->popString();	//<std::string> Sku销售属性串  
		$this->_arr_value['skuSaleAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuSaleAttrText'] = $bs->popString();	//<std::string> sku销售属性明文
		$this->_arr_value['skuSaleAttrText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuSaleAttrDesc'] = $bs->popString();	//<std::string> Sku销售属性串描述 为销售属性做额外解析 
		$this->_arr_value['skuSaleAttrDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuReferPrice'] = $bs->popUint32_t();	//<uint32_t> Sku参考价格 即市场价,精确到分  
		$this->_arr_value['skuReferPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuProperty'] = $bs->popObject('stl_bitset<128>');	//<std::bitset<128> > Sku属性标志 参见enum SkuProperty(二手商品属性位废弃)  
		$this->_arr_value['skuProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuState'] = $bs->popUint8_t();	//<uint8_t> Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		$this->_arr_value['skuState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuWeight'] = $bs->popUint32_t();	//<uint32_t> Sku 重量 克  
		$this->_arr_value['skuWeight_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuVolume'] = $bs->popUint32_t();	//<uint32_t> Sku 体积 立方厘米  
		$this->_arr_value['skuVolume_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuCategoryAttr'] = $bs->popString();	//<std::string> Sku 类目属性串  
		$this->_arr_value['skuCategoryAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuCategoryAttrText'] = $bs->popString();	//<std::string> Sku 类目属性串明文  
		$this->_arr_value['skuCategoryAttrText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuCustomizeAttr'] = $bs->popString();	//<std::string> Sku 自定义属性
		$this->_arr_value['skuCustomizeAttr_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuCustomizeAttrText'] = $bs->popString();	//<std::string> Sku 自定义属性 明文 
		$this->_arr_value['skuCustomizeAttrText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skukeyWord'] = $bs->popString();	//<std::string> Sku 关键词 可以有多个 
		$this->_arr_value['skukeyWord_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuClassify'] = $bs->popString();	//<std::string> Sku 分类  
		$this->_arr_value['skuClassify_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuVatRate'] = $bs->popUint32_t();	//<uint32_t> Sku 税率  
		$this->_arr_value['skuVatRate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuSnapVersion'] = $bs->popUint16_t();	//<uint16_t> Sku 当前快照版本  
		$this->_arr_value['skuSnapVersion_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuBuyLimit'] = $bs->popUint32_t();	//<uint32_t> Sku 购买限制 0 -- 无限制  
		$this->_arr_value['skuBuyLimit_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuLastUpTime'] = $bs->popUint32_t();	//<uint32_t> Sku 最后上架时间  
		$this->_arr_value['skuLastUpTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuLastDownTime'] = $bs->popUint32_t();	//<uint32_t> Sku 最后下架时间  
		$this->_arr_value['skuLastDownTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuAddTime'] = $bs->popUint32_t();	//<uint32_t> Sku 添加时间  
		$this->_arr_value['skuAddTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuLastSnapTime'] = $bs->popUint32_t();	//<uint32_t> Sku 最后快照生成时间  
		$this->_arr_value['skuLastSnapTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuLastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> Sku 最后修改时间  
		$this->_arr_value['skuLastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mainLogoLastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 主图最后更新时间 可以拼接在图片链接后面 用来强制浏览器拉取新图片
		$this->_arr_value['mainLogoLastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuSizeTableId'] = $bs->popUint32_t();	//<uint32_t> 尺码表Id 保留
		$this->_arr_value['skuSizeTableId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['icsonInfoPo'] = $bs->popObject('\b2b2c\detailview\po\IcsonInfoPo');	//<b2b2c::detailview::po::CIcsonInfoPo> 易迅商品信息
		$this->_arr_value['icsonInfoPo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewStockPo'] = $bs->popObject('stl_vector<\b2b2c\detailview\po\ViewStockPo>');	//<std::vector<b2b2c::detailview::po::CViewStockPo> > 一个Sku所对应的库存信息 即分仓信息 
		$this->_arr_value['viewStockPo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewSkuPicturePo'] = $bs->popObject('\b2b2c\detailview\po\ViewSkuPicturePo');	//<b2b2c::detailview::po::CViewSkuPicturePo> Sku主图Po 里面有主图url及图片类型等 
		$this->_arr_value['viewSkuPicturePo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewCooperatorBasePo'] = $bs->popObject('\b2b2c\detailview\po\ViewCooperatorBasePo');	//<b2b2c::detailview::po::CViewCooperatorBasePo> 该sku所属合作伙伴基本信息  
		$this->_arr_value['viewCooperatorBasePo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewMultPricePo'] = $bs->popObject('\b2b2c\detailview\po\ViewMultPricePo');	//<b2b2c::detailview::po::CViewMultPricePo> 多价po 网购侧多价po 内含地域价和限时价 保留
		$this->_arr_value['viewMultPricePo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reverse'] = $bs->popString();	//<std::string> reverse字段 
		$this->_arr_value['reverse_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20120308){
			$this->_arr_value['skuOperationModel'] = $bs->popUint32_t();	//<uint32_t> 运营类型 0:经销/1:代销/2:联营/3：新联营 
		}
		if($this->version >= 20120308){
			$this->_arr_value['skuOperationModel_u'] = $bs->popUint8_t();	//<uint8_t> 运营类型 0:经销/1:代销/2:联营/3：新联营 
		}
		if($this->version >= 20130327){
			$this->_arr_value['skuSearchFactor'] = $bs->popUint32_t();	//<uint32_t> Sku 搜索因子 仅供搜索使用 其他调用接口不用关心
		}
		if($this->version >= 20130327){
			$this->_arr_value['skuSearchFactor_u'] = $bs->popUint8_t();	//<uint8_t> Sku 搜索因子flag 其他调用接口不用关心
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuSizeX'] = $bs->popUint16_t();	//<uint16_t> 商品长度，单位毫米
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuSizeX_u'] = $bs->popUint8_t();	//<uint8_t> 商品长度，单位毫米
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuSizeY'] = $bs->popUint16_t();	//<uint16_t> 商品宽度，单位毫米
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuSizeY_u'] = $bs->popUint8_t();	//<uint8_t> 商品宽度，单位毫米
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuSizeZ'] = $bs->popUint16_t();	//<uint16_t> 商品高度，单位毫米
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuSizeZ_u'] = $bs->popUint8_t();	//<uint8_t> 商品高度，单位毫米
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuComponent'] = $bs->popObject('stl_map<stl_string,uint16_t>');	//<std::map<std::string,uint16_t> > 组件清单, coSkuCode(易迅sysno) -> 组件数量
		}
		if($this->version >= 20130329){
			$this->_arr_value['skuComponent_u'] = $bs->popUint8_t();	//<uint8_t> 组件清单, coSkuCode(易迅sysno) -> 组件数量_u
		}
		if($this->version >= 20130617){
			$this->_arr_value['skuNetWeight'] = $bs->popUint32_t();	//<uint32_t> 净重,单位克
		}
		if($this->version >= 20130617){
			$this->_arr_value['skuNetWeight_u'] = $bs->popUint8_t();	//<uint8_t> 净重,单位克_u
		}
		if($this->version >= 20130617){
			$this->_arr_value['categoryId'] = $bs->popUint32_t();	//<uint32_t> 品类id，商品所属品类 统一类目后  可代替外层spu结构上的品类
		}
		if($this->version >= 20130617){
			$this->_arr_value['categoryId_u'] = $bs->popUint8_t();	//<uint8_t> 品类id_u，商品所属品类 统一类目后 可代替外层spu结构上的品类 
		}
		if($this->version >= 20130628){
			$this->_arr_value['viewOmsStockPo'] = $bs->popObject('stl_vector<\b2b2c\detailview\po\ViewOmsStockPo>');	//<std::vector<b2b2c::detailview::po::CViewOmsStockPo> > 该商品对应的 oms 库存信息
		}
		if($this->version >= 20130628){
			$this->_arr_value['viewOmsStockPo_u'] = $bs->popUint8_t();	//<uint8_t> oms 库存信息flag
		}

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewSkuPo.java
class IcsonInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> skuid,网购侧唯一(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $productId;	//<std::string> 易迅产品编号(版本>=0)
	private $productId_u;	//<uint8_t> (版本>=0)
	private $manufacturerSysNo;	//<uint64_t> 品牌编号(版本>=0)
	private $manufacturerSysNo_u;	//<uint8_t> (版本>=0)
	private $manufacturerText;	//<std::string> 品牌明文(版本>=0)
	private $manufacturerText_u;	//<uint8_t> (版本>=0)
	private $productMode;	//<std::string> 商品型号(版本>=0)
	private $productMode_u;	//<uint8_t> (版本>=0)
	private $c1SysNo;	//<uint64_t> 大类编号(版本>=0)
	private $c1SysNo_u;	//<uint8_t> (版本>=0)
	private $c1Text;	//<std::string> 大类名称(版本>=0)
	private $c1Text_u;	//<uint8_t> (版本>=0)
	private $c2SysNo;	//<uint64_t> 中类编号(版本>=0)
	private $c2SysNo_u;	//<uint8_t> (版本>=0)
	private $c2Text;	//<std::string> 中类名称(版本>=0)
	private $c2Text_u;	//<uint8_t> (版本>=0)
	private $c3SysNo;	//<uint64_t> 小类编号(版本>=0)
	private $c3SysNo_u;	//<uint8_t> (版本>=0)
	private $c3Text;	//<std::string> 小类名称(版本>=0)
	private $c3Text_u;	//<uint8_t> (版本>=0)
	private $productColor;	//<uint64_t> 商品颜色编号(版本>=0)
	private $productColor_u;	//<uint8_t> (版本>=0)
	private $productColorText;	//<std::string> 商品颜色名称(版本>=0)
	private $productColorText_u;	//<uint8_t> (版本>=0)
	private $productSize;	//<uint64_t> 商品规格(版本>=0)
	private $productSize_u;	//<uint8_t> (版本>=0)
	private $productSizeText;	//<std::string> 商品规格明文(版本>=0)
	private $productSizeText_u;	//<uint8_t> (版本>=0)
	private $masterProductSysno;	//<uint64_t> 对应主商品的易迅ID(版本>=0)
	private $masterProductSysno_u;	//<uint8_t> (版本>=0)
	private $showPicCount;	//<uint16_t> 图片数量(版本>=0)
	private $showPicCount_u;	//<uint8_t> (版本>=0)
	private $attrs;	//<std::string> 易迅类目属性信息(版本>=0)
	private $attrs_u;	//<uint8_t> (版本>=0)
	private $specialAttrs;	//<std::string> '易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志 (版本>=0)
	private $specialAttrs_u;	//<uint8_t> (版本>=0)
	private $sndSource;	//<uint32_t> 二手商品来源(版本>=0)
	private $sndSource_u;	//<uint8_t> (版本>=0)
	private $sndWarrantyTime;	//<uint32_t> 二手保修截止时间(版本>=0)
	private $sndWarrantyTime_u;	//<uint8_t> (版本>=0)
	private $sndClass;	//<uint32_t> 二手商品品相(版本>=0)
	private $sndClass_u;	//<uint8_t> (版本>=0)
	private $sndPerformance;	//<uint32_t> 二手商品性能(版本>=0)
	private $sndPerformance_u;	//<uint8_t> (版本>=0)
	private $sndUsedDays;	//<uint32_t> 二手顾客使用时间(版本>=0)
	private $sndUsedDays_u;	//<uint8_t> (版本>=0)
	private $sndHavePhoto;	//<uint32_t> 二手是否实物拍摄 0：没有，1：有(版本>=0)
	private $sndHavePhoto_u;	//<uint8_t> (版本>=0)
	private $sndMemo;	//<std::string> 二手备注信息(版本>=0)
	private $sndMemo_u;	//<uint8_t> (版本>=0)
	private $sndAttach;	//<std::string> 二手包装附件(版本>=0)
	private $sndAttach_u;	//<uint8_t> (版本>=0)
	private $contractSaleMode;	//<uint32_t> 合约机类型(版本>=20130308)
	private $contractSaleMode_u;	//<uint8_t> 合约机类型flag(版本>=20130308)
	private $carAttrInfo;	//<std::string> 爱车宝扩展属性类目信息(版本>=20130308)
	private $carAttrInfo_u;	//<uint8_t> 爱车宝扩展属性类目信息 flag(版本>=20130308)
	private $carAttrInfoText;	//<std::string> 爱车宝扩展属性类目信息明文(版本>=20130308)
	private $carAttrInfoText_u;	//<uint8_t> 爱车宝扩展属性类目信息明文 flag(版本>=20130308)
	private $skuOwner;	//<uint32_t> 货主(版本>=20130308)
	private $skuOwner_u;	//<uint8_t> 货主 flag(版本>=20130308)

	function __construct(){
		$this->version = 20130308;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->productId = "";	//<std::string>
		$this->productId_u = 0;	//<uint8_t>
		$this->manufacturerSysNo = 0;	//<uint64_t>
		$this->manufacturerSysNo_u = 0;	//<uint8_t>
		$this->manufacturerText = "";	//<std::string>
		$this->manufacturerText_u = 0;	//<uint8_t>
		$this->productMode = "";	//<std::string>
		$this->productMode_u = 0;	//<uint8_t>
		$this->c1SysNo = 0;	//<uint64_t>
		$this->c1SysNo_u = 0;	//<uint8_t>
		$this->c1Text = "";	//<std::string>
		$this->c1Text_u = 0;	//<uint8_t>
		$this->c2SysNo = 0;	//<uint64_t>
		$this->c2SysNo_u = 0;	//<uint8_t>
		$this->c2Text = "";	//<std::string>
		$this->c2Text_u = 0;	//<uint8_t>
		$this->c3SysNo = 0;	//<uint64_t>
		$this->c3SysNo_u = 0;	//<uint8_t>
		$this->c3Text = "";	//<std::string>
		$this->c3Text_u = 0;	//<uint8_t>
		$this->productColor = 0;	//<uint64_t>
		$this->productColor_u = 0;	//<uint8_t>
		$this->productColorText = "";	//<std::string>
		$this->productColorText_u = 0;	//<uint8_t>
		$this->productSize = 0;	//<uint64_t>
		$this->productSize_u = 0;	//<uint8_t>
		$this->productSizeText = "";	//<std::string>
		$this->productSizeText_u = 0;	//<uint8_t>
		$this->masterProductSysno = 0;	//<uint64_t>
		$this->masterProductSysno_u = 0;	//<uint8_t>
		$this->showPicCount = 0;	//<uint16_t>
		$this->showPicCount_u = 0;	//<uint8_t>
		$this->attrs = "";	//<std::string>
		$this->attrs_u = 0;	//<uint8_t>
		$this->specialAttrs = "";	//<std::string>
		$this->specialAttrs_u = 0;	//<uint8_t>
		$this->sndSource = 0;	//<uint32_t>
		$this->sndSource_u = 0;	//<uint8_t>
		$this->sndWarrantyTime = 0;	//<uint32_t>
		$this->sndWarrantyTime_u = 0;	//<uint8_t>
		$this->sndClass = 0;	//<uint32_t>
		$this->sndClass_u = 0;	//<uint8_t>
		$this->sndPerformance = 0;	//<uint32_t>
		$this->sndPerformance_u = 0;	//<uint8_t>
		$this->sndUsedDays = 0;	//<uint32_t>
		$this->sndUsedDays_u = 0;	//<uint8_t>
		$this->sndHavePhoto = 0;	//<uint32_t>
		$this->sndHavePhoto_u = 0;	//<uint8_t>
		$this->sndMemo = "";	//<std::string>
		$this->sndMemo_u = 0;	//<uint8_t>
		$this->sndAttach = "";	//<std::string>
		$this->sndAttach_u = 0;	//<uint8_t>
		$this->contractSaleMode = 0;	//<uint32_t>
		$this->contractSaleMode_u = 0;	//<uint8_t>
		$this->carAttrInfo = "";	//<std::string>
		$this->carAttrInfo_u = 0;	//<uint8_t>
		$this->carAttrInfoText = "";	//<std::string>
		$this->carAttrInfoText_u = 0;	//<uint8_t>
		$this->skuOwner = 0;	//<uint32_t>
		$this->skuOwner_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\IcsonInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\IcsonInfoPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuid,网购侧唯一
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushString($this->productId);	//<std::string> 易迅产品编号
		$bs->pushUint8_t($this->productId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->manufacturerSysNo);	//<uint64_t> 品牌编号
		$bs->pushUint8_t($this->manufacturerSysNo_u);	//<uint8_t> 
		$bs->pushString($this->manufacturerText);	//<std::string> 品牌明文
		$bs->pushUint8_t($this->manufacturerText_u);	//<uint8_t> 
		$bs->pushString($this->productMode);	//<std::string> 商品型号
		$bs->pushUint8_t($this->productMode_u);	//<uint8_t> 
		$bs->pushUint64_t($this->c1SysNo);	//<uint64_t> 大类编号
		$bs->pushUint8_t($this->c1SysNo_u);	//<uint8_t> 
		$bs->pushString($this->c1Text);	//<std::string> 大类名称
		$bs->pushUint8_t($this->c1Text_u);	//<uint8_t> 
		$bs->pushUint64_t($this->c2SysNo);	//<uint64_t> 中类编号
		$bs->pushUint8_t($this->c2SysNo_u);	//<uint8_t> 
		$bs->pushString($this->c2Text);	//<std::string> 中类名称
		$bs->pushUint8_t($this->c2Text_u);	//<uint8_t> 
		$bs->pushUint64_t($this->c3SysNo);	//<uint64_t> 小类编号
		$bs->pushUint8_t($this->c3SysNo_u);	//<uint8_t> 
		$bs->pushString($this->c3Text);	//<std::string> 小类名称
		$bs->pushUint8_t($this->c3Text_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productColor);	//<uint64_t> 商品颜色编号
		$bs->pushUint8_t($this->productColor_u);	//<uint8_t> 
		$bs->pushString($this->productColorText);	//<std::string> 商品颜色名称
		$bs->pushUint8_t($this->productColorText_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productSize);	//<uint64_t> 商品规格
		$bs->pushUint8_t($this->productSize_u);	//<uint8_t> 
		$bs->pushString($this->productSizeText);	//<std::string> 商品规格明文
		$bs->pushUint8_t($this->productSizeText_u);	//<uint8_t> 
		$bs->pushUint64_t($this->masterProductSysno);	//<uint64_t> 对应主商品的易迅ID
		$bs->pushUint8_t($this->masterProductSysno_u);	//<uint8_t> 
		$bs->pushUint16_t($this->showPicCount);	//<uint16_t> 图片数量
		$bs->pushUint8_t($this->showPicCount_u);	//<uint8_t> 
		$bs->pushString($this->attrs);	//<std::string> 易迅类目属性信息
		$bs->pushUint8_t($this->attrs_u);	//<uint8_t> 
		$bs->pushString($this->specialAttrs);	//<std::string> '易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志 
		$bs->pushUint8_t($this->specialAttrs_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sndSource);	//<uint32_t> 二手商品来源
		$bs->pushUint8_t($this->sndSource_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sndWarrantyTime);	//<uint32_t> 二手保修截止时间
		$bs->pushUint8_t($this->sndWarrantyTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sndClass);	//<uint32_t> 二手商品品相
		$bs->pushUint8_t($this->sndClass_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sndPerformance);	//<uint32_t> 二手商品性能
		$bs->pushUint8_t($this->sndPerformance_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sndUsedDays);	//<uint32_t> 二手顾客使用时间
		$bs->pushUint8_t($this->sndUsedDays_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sndHavePhoto);	//<uint32_t> 二手是否实物拍摄 0：没有，1：有
		$bs->pushUint8_t($this->sndHavePhoto_u);	//<uint8_t> 
		$bs->pushString($this->sndMemo);	//<std::string> 二手备注信息
		$bs->pushUint8_t($this->sndMemo_u);	//<uint8_t> 
		$bs->pushString($this->sndAttach);	//<std::string> 二手包装附件
		$bs->pushUint8_t($this->sndAttach_u);	//<uint8_t> 
		if($this->version >= 20130308){
			$bs->pushUint32_t($this->contractSaleMode);	//<uint32_t> 合约机类型
		}
		if($this->version >= 20130308){
			$bs->pushUint8_t($this->contractSaleMode_u);	//<uint8_t> 合约机类型flag
		}
		if($this->version >= 20130308){
			$bs->pushString($this->carAttrInfo);	//<std::string> 爱车宝扩展属性类目信息
		}
		if($this->version >= 20130308){
			$bs->pushUint8_t($this->carAttrInfo_u);	//<uint8_t> 爱车宝扩展属性类目信息 flag
		}
		if($this->version >= 20130308){
			$bs->pushString($this->carAttrInfoText);	//<std::string> 爱车宝扩展属性类目信息明文
		}
		if($this->version >= 20130308){
			$bs->pushUint8_t($this->carAttrInfoText_u);	//<uint8_t> 爱车宝扩展属性类目信息明文 flag
		}
		if($this->version >= 20130308){
			$bs->pushUint32_t($this->skuOwner);	//<uint32_t> 货主
		}
		if($this->version >= 20130308){
			$bs->pushUint8_t($this->skuOwner_u);	//<uint8_t> 货主 flag
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuid,网购侧唯一
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productId'] = $bs->popString();	//<std::string> 易迅产品编号
		$this->_arr_value['productId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['manufacturerSysNo'] = $bs->popUint64_t();	//<uint64_t> 品牌编号
		$this->_arr_value['manufacturerSysNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['manufacturerText'] = $bs->popString();	//<std::string> 品牌明文
		$this->_arr_value['manufacturerText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productMode'] = $bs->popString();	//<std::string> 商品型号
		$this->_arr_value['productMode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c1SysNo'] = $bs->popUint64_t();	//<uint64_t> 大类编号
		$this->_arr_value['c1SysNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c1Text'] = $bs->popString();	//<std::string> 大类名称
		$this->_arr_value['c1Text_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c2SysNo'] = $bs->popUint64_t();	//<uint64_t> 中类编号
		$this->_arr_value['c2SysNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c2Text'] = $bs->popString();	//<std::string> 中类名称
		$this->_arr_value['c2Text_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c3SysNo'] = $bs->popUint64_t();	//<uint64_t> 小类编号
		$this->_arr_value['c3SysNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['c3Text'] = $bs->popString();	//<std::string> 小类名称
		$this->_arr_value['c3Text_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productColor'] = $bs->popUint64_t();	//<uint64_t> 商品颜色编号
		$this->_arr_value['productColor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productColorText'] = $bs->popString();	//<std::string> 商品颜色名称
		$this->_arr_value['productColorText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSize'] = $bs->popUint64_t();	//<uint64_t> 商品规格
		$this->_arr_value['productSize_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSizeText'] = $bs->popString();	//<std::string> 商品规格明文
		$this->_arr_value['productSizeText_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['masterProductSysno'] = $bs->popUint64_t();	//<uint64_t> 对应主商品的易迅ID
		$this->_arr_value['masterProductSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['showPicCount'] = $bs->popUint16_t();	//<uint16_t> 图片数量
		$this->_arr_value['showPicCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['attrs'] = $bs->popString();	//<std::string> 易迅类目属性信息
		$this->_arr_value['attrs_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['specialAttrs'] = $bs->popString();	//<std::string> '易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志 
		$this->_arr_value['specialAttrs_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndSource'] = $bs->popUint32_t();	//<uint32_t> 二手商品来源
		$this->_arr_value['sndSource_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndWarrantyTime'] = $bs->popUint32_t();	//<uint32_t> 二手保修截止时间
		$this->_arr_value['sndWarrantyTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndClass'] = $bs->popUint32_t();	//<uint32_t> 二手商品品相
		$this->_arr_value['sndClass_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndPerformance'] = $bs->popUint32_t();	//<uint32_t> 二手商品性能
		$this->_arr_value['sndPerformance_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndUsedDays'] = $bs->popUint32_t();	//<uint32_t> 二手顾客使用时间
		$this->_arr_value['sndUsedDays_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndHavePhoto'] = $bs->popUint32_t();	//<uint32_t> 二手是否实物拍摄 0：没有，1：有
		$this->_arr_value['sndHavePhoto_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndMemo'] = $bs->popString();	//<std::string> 二手备注信息
		$this->_arr_value['sndMemo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndAttach'] = $bs->popString();	//<std::string> 二手包装附件
		$this->_arr_value['sndAttach_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20130308){
			$this->_arr_value['contractSaleMode'] = $bs->popUint32_t();	//<uint32_t> 合约机类型
		}
		if($this->version >= 20130308){
			$this->_arr_value['contractSaleMode_u'] = $bs->popUint8_t();	//<uint8_t> 合约机类型flag
		}
		if($this->version >= 20130308){
			$this->_arr_value['carAttrInfo'] = $bs->popString();	//<std::string> 爱车宝扩展属性类目信息
		}
		if($this->version >= 20130308){
			$this->_arr_value['carAttrInfo_u'] = $bs->popUint8_t();	//<uint8_t> 爱车宝扩展属性类目信息 flag
		}
		if($this->version >= 20130308){
			$this->_arr_value['carAttrInfoText'] = $bs->popString();	//<std::string> 爱车宝扩展属性类目信息明文
		}
		if($this->version >= 20130308){
			$this->_arr_value['carAttrInfoText_u'] = $bs->popUint8_t();	//<uint8_t> 爱车宝扩展属性类目信息明文 flag
		}
		if($this->version >= 20130308){
			$this->_arr_value['skuOwner'] = $bs->popUint32_t();	//<uint32_t> 货主
		}
		if($this->version >= 20130308){
			$this->_arr_value['skuOwner_u'] = $bs->popUint8_t();	//<uint8_t> 货主 flag
		}

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewSkuPo.java
class ViewCooperatorBasePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴ID 主帐号如易迅为：855006089(版本>=0)
	private $cooperatorId_u;	//<uint8_t> (版本>=0)
	private $cooperatorName;	//<std::string> 合作伙伴名称(版本>=0)
	private $cooperatorName_u;	//<uint8_t> (版本>=0)
	private $cooperatorAddress;	//<std::string> 合作伙伴地址(版本>=0)
	private $cooperatorAddress_u;	//<uint8_t> (版本>=0)
	private $cooperatorPhone;	//<std::string> 合作伙伴联系电话(版本>=0)
	private $cooperatorPhone_u;	//<uint8_t> (版本>=0)
	private $cooperatorFax;	//<std::string> 合作伙伴传真(版本>=0)
	private $cooperatorFax_u;	//<uint8_t> (版本>=0)
	private $cooperatorEmail;	//<std::string> 合作伙伴邮箱(版本>=0)
	private $cooperatorEmail_u;	//<uint8_t> (版本>=0)
	private $cooperatorType;	//<uint8_t> 合作伙伴类型 参见enum CooperatorType(版本>=0)
	private $cooperatorType_u;	//<uint8_t> (版本>=0)
	private $cooperatorSpid;	//<std::string> 合作伙伴spid(版本>=0)
	private $cooperatorSpid_u;	//<uint8_t> (版本>=0)
	private $cooperatorState;	//<uint8_t> 合作伙伴状态 参见enum CooperatorState(版本>=0)
	private $cooperatorState_u;	//<uint8_t> (版本>=0)
	private $cooperatorDiminutive;	//<std::string> 合作伙伴简称(版本>=0)
	private $cooperatorDiminutive_u;	//<uint8_t> (版本>=0)
	private $cooperatorAddrDiminutive;	//<std::string> 合作伙伴所在地简称(版本>=0)
	private $cooperatorAddrDiminutive_u;	//<uint8_t> (版本>=0)
	private $customerHotLine;	//<std::string> 客服热线电话(版本>=0)
	private $customerHotLine_u;	//<uint8_t> (版本>=0)
	private $cooperatorProperty;	//<std::bitset<128> > 合作伙伴属性 参见enum CooperatorProperty(版本>=0)
	private $cooperatorProperty_u;	//<uint8_t> (版本>=0)
	private $icsonCooperatorId;	//<uint32_t> 易迅侧商户Id(版本>=20130513)
	private $icsonCooperatorId_u;	//<uint8_t> 易迅Id_u(版本>=20130513)
	private $cooperatorEnName;	//<std::string> 合作伙伴英文名(版本>=20130513)
	private $cooperatorEnName_u;	//<uint8_t> 合作伙伴英文名_u(版本>=20130513)

	function __construct(){
		$this->version = 20130513;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->cooperatorId_u = 0;	//<uint8_t>
		$this->cooperatorName = "";	//<std::string>
		$this->cooperatorName_u = 0;	//<uint8_t>
		$this->cooperatorAddress = "";	//<std::string>
		$this->cooperatorAddress_u = 0;	//<uint8_t>
		$this->cooperatorPhone = "";	//<std::string>
		$this->cooperatorPhone_u = 0;	//<uint8_t>
		$this->cooperatorFax = "";	//<std::string>
		$this->cooperatorFax_u = 0;	//<uint8_t>
		$this->cooperatorEmail = "";	//<std::string>
		$this->cooperatorEmail_u = 0;	//<uint8_t>
		$this->cooperatorType = 0;	//<uint8_t>
		$this->cooperatorType_u = 0;	//<uint8_t>
		$this->cooperatorSpid = "";	//<std::string>
		$this->cooperatorSpid_u = 0;	//<uint8_t>
		$this->cooperatorState = 0;	//<uint8_t>
		$this->cooperatorState_u = 0;	//<uint8_t>
		$this->cooperatorDiminutive = "";	//<std::string>
		$this->cooperatorDiminutive_u = 0;	//<uint8_t>
		$this->cooperatorAddrDiminutive = "";	//<std::string>
		$this->cooperatorAddrDiminutive_u = 0;	//<uint8_t>
		$this->customerHotLine = "";	//<std::string>
		$this->customerHotLine_u = 0;	//<uint8_t>
		$this->cooperatorProperty = new \stl_bitset2('128');	//<std::bitset<128> >
		$this->cooperatorProperty_u = 0;	//<uint8_t>
		$this->icsonCooperatorId = 0;	//<uint32_t>
		$this->icsonCooperatorId_u = 0;	//<uint8_t>
		$this->cooperatorEnName = "";	//<std::string>
		$this->cooperatorEnName_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewCooperatorBasePo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewCooperatorBasePo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴ID 主帐号如易迅为：855006089
		$bs->pushUint8_t($this->cooperatorId_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorName);	//<std::string> 合作伙伴名称
		$bs->pushUint8_t($this->cooperatorName_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorAddress);	//<std::string> 合作伙伴地址
		$bs->pushUint8_t($this->cooperatorAddress_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorPhone);	//<std::string> 合作伙伴联系电话
		$bs->pushUint8_t($this->cooperatorPhone_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorFax);	//<std::string> 合作伙伴传真
		$bs->pushUint8_t($this->cooperatorFax_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorEmail);	//<std::string> 合作伙伴邮箱
		$bs->pushUint8_t($this->cooperatorEmail_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cooperatorType);	//<uint8_t> 合作伙伴类型 参见enum CooperatorType
		$bs->pushUint8_t($this->cooperatorType_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorSpid);	//<std::string> 合作伙伴spid
		$bs->pushUint8_t($this->cooperatorSpid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->cooperatorState);	//<uint8_t> 合作伙伴状态 参见enum CooperatorState
		$bs->pushUint8_t($this->cooperatorState_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorDiminutive);	//<std::string> 合作伙伴简称
		$bs->pushUint8_t($this->cooperatorDiminutive_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorAddrDiminutive);	//<std::string> 合作伙伴所在地简称
		$bs->pushUint8_t($this->cooperatorAddrDiminutive_u);	//<uint8_t> 
		$bs->pushString($this->customerHotLine);	//<std::string> 客服热线电话
		$bs->pushUint8_t($this->customerHotLine_u);	//<uint8_t> 
		$bs->pushObject($this->cooperatorProperty,'stl_bitset');	//<std::bitset<128> > 合作伙伴属性 参见enum CooperatorProperty
		$bs->pushUint8_t($this->cooperatorProperty_u);	//<uint8_t> 
		if($this->version >= 20130513){
			$bs->pushUint32_t($this->icsonCooperatorId);	//<uint32_t> 易迅侧商户Id
		}
		if($this->version >= 20130513){
			$bs->pushUint8_t($this->icsonCooperatorId_u);	//<uint8_t> 易迅Id_u
		}
		if($this->version >= 20130513){
			$bs->pushString($this->cooperatorEnName);	//<std::string> 合作伙伴英文名
		}
		if($this->version >= 20130513){
			$bs->pushUint8_t($this->cooperatorEnName_u);	//<uint8_t> 合作伙伴英文名_u
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorId'] = $bs->popUint32_t();	//<uint32_t> 合作伙伴ID 主帐号如易迅为：855006089
		$this->_arr_value['cooperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorName'] = $bs->popString();	//<std::string> 合作伙伴名称
		$this->_arr_value['cooperatorName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorAddress'] = $bs->popString();	//<std::string> 合作伙伴地址
		$this->_arr_value['cooperatorAddress_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorPhone'] = $bs->popString();	//<std::string> 合作伙伴联系电话
		$this->_arr_value['cooperatorPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorFax'] = $bs->popString();	//<std::string> 合作伙伴传真
		$this->_arr_value['cooperatorFax_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorEmail'] = $bs->popString();	//<std::string> 合作伙伴邮箱
		$this->_arr_value['cooperatorEmail_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorType'] = $bs->popUint8_t();	//<uint8_t> 合作伙伴类型 参见enum CooperatorType
		$this->_arr_value['cooperatorType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorSpid'] = $bs->popString();	//<std::string> 合作伙伴spid
		$this->_arr_value['cooperatorSpid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorState'] = $bs->popUint8_t();	//<uint8_t> 合作伙伴状态 参见enum CooperatorState
		$this->_arr_value['cooperatorState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorDiminutive'] = $bs->popString();	//<std::string> 合作伙伴简称
		$this->_arr_value['cooperatorDiminutive_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorAddrDiminutive'] = $bs->popString();	//<std::string> 合作伙伴所在地简称
		$this->_arr_value['cooperatorAddrDiminutive_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['customerHotLine'] = $bs->popString();	//<std::string> 客服热线电话
		$this->_arr_value['customerHotLine_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorProperty'] = $bs->popObject('stl_bitset<128>');	//<std::bitset<128> > 合作伙伴属性 参见enum CooperatorProperty
		$this->_arr_value['cooperatorProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20130513){
			$this->_arr_value['icsonCooperatorId'] = $bs->popUint32_t();	//<uint32_t> 易迅侧商户Id
		}
		if($this->version >= 20130513){
			$this->_arr_value['icsonCooperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 易迅Id_u
		}
		if($this->version >= 20130513){
			$this->_arr_value['cooperatorEnName'] = $bs->popString();	//<std::string> 合作伙伴英文名
		}
		if($this->version >= 20130513){
			$this->_arr_value['cooperatorEnName_u'] = $bs->popUint8_t();	//<uint8_t> 合作伙伴英文名_u
		}

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewSkuPo.java
class ViewOmsStockPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> skuid,网购侧唯一(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $inventorySysno;	//<uint64_t>  库存编号 (版本>=0)
	private $inventorySysno_u;	//<uint8_t> (版本>=0)
	private $productSysno;	//<uint64_t>  产品系统编号 (版本>=0)
	private $productSysno_u;	//<uint8_t> (版本>=0)
	private $stockSysno;	//<uint64_t>  仓库编号 (版本>=0)
	private $stockSysno_u;	//<uint8_t> (版本>=0)
	private $ownerSysno;	//<uint64_t>  货主编号 (版本>=0)
	private $ownerSysno_u;	//<uint8_t> (版本>=0)
	private $platformSysno;	//<uint64_t>  平台编号 (版本>=0)
	private $platformSysno_u;	//<uint8_t> (版本>=0)
	private $realNum;	//<uint32_t>  实库数量 (版本>=0)
	private $realNum_u;	//<uint8_t> (版本>=0)
	private $realReserveNum;	//<uint32_t>  实库预留数量 (版本>=0)
	private $realReserveNum_u;	//<uint8_t> (版本>=0)
	private $virtualNum;	//<uint32_t>  虚库数量  (版本>=0)
	private $virtualNum_u;	//<uint8_t> (版本>=0)
	private $virtualReserveNum;	//<uint32_t>  虚库预留数量  (版本>=0)
	private $virtualReserveNum_u;	//<uint8_t> (版本>=0)
	private $activeNum;	//<uint32_t>  活动数量  (版本>=0)
	private $activeNum_u;	//<uint8_t> (版本>=0)
	private $activeReserveNum;	//<uint32_t>  活动预留数量 (版本>=0)
	private $activeReserveNum_u;	//<uint8_t> (版本>=0)
	private $oversellNum;	//<uint32_t>  可超卖数量  (版本>=0)
	private $oversellNum_u;	//<uint8_t> (版本>=0)
	private $oversellReserveNum;	//<uint32_t>  可超卖预留数量  (版本>=0)
	private $oversellReserveNum_u;	//<uint8_t> (版本>=0)
	private $purchaseNum;	//<uint32_t>  采购在途数量  (版本>=0)
	private $purchaseNum_u;	//<uint8_t> (版本>=0)
	private $transferNum;	//<uint32_t>  调拨数量  (版本>=0)
	private $transferNum_u;	//<uint8_t> (版本>=0)
	private $transferOnlineNum;	//<uint32_t>  调拨在途数量  (版本>=0)
	private $transferOnlineNum_u;	//<uint8_t> (版本>=0)
	private $manualLockNum;	//<uint32_t>  人工锁定数量  (版本>=0)
	private $manualLockNum_u;	//<uint8_t> (版本>=0)
	private $allocatedNum;	//<uint32_t>  已分配数量  (版本>=0)
	private $allocatedNum_u;	//<uint8_t> (版本>=0)
	private $sellMode;	//<uint32_t>  销售类型 (版本>=0)
	private $sellMode_u;	//<uint8_t> (版本>=0)
	private $status;	//<uint32_t>  oms 库存状态  (版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $property;	//<uint64_t>  oms库存属性  (版本>=0)
	private $property_u;	//<uint8_t> (版本>=0)
	private $returnedPurchaseNum;	//<uint32_t> 采购退货数量  (版本>=0)
	private $returnedPurchaseNum_u;	//<uint8_t> 采购退货数量  uflag(版本>=0)
	private $wmsRecordPo;	//<b2b2c::detailview::po::CViewWMSPo>  wms老库存字段(版本>=0)
	private $wmsRecordPo_u;	//<uint8_t>  wms老库存字段(版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->inventorySysno = 0;	//<uint64_t>
		$this->inventorySysno_u = 0;	//<uint8_t>
		$this->productSysno = 0;	//<uint64_t>
		$this->productSysno_u = 0;	//<uint8_t>
		$this->stockSysno = 0;	//<uint64_t>
		$this->stockSysno_u = 0;	//<uint8_t>
		$this->ownerSysno = 0;	//<uint64_t>
		$this->ownerSysno_u = 0;	//<uint8_t>
		$this->platformSysno = 0;	//<uint64_t>
		$this->platformSysno_u = 0;	//<uint8_t>
		$this->realNum = 0;	//<uint32_t>
		$this->realNum_u = 0;	//<uint8_t>
		$this->realReserveNum = 0;	//<uint32_t>
		$this->realReserveNum_u = 0;	//<uint8_t>
		$this->virtualNum = 0;	//<uint32_t>
		$this->virtualNum_u = 0;	//<uint8_t>
		$this->virtualReserveNum = 0;	//<uint32_t>
		$this->virtualReserveNum_u = 0;	//<uint8_t>
		$this->activeNum = 0;	//<uint32_t>
		$this->activeNum_u = 0;	//<uint8_t>
		$this->activeReserveNum = 0;	//<uint32_t>
		$this->activeReserveNum_u = 0;	//<uint8_t>
		$this->oversellNum = 0;	//<uint32_t>
		$this->oversellNum_u = 0;	//<uint8_t>
		$this->oversellReserveNum = 0;	//<uint32_t>
		$this->oversellReserveNum_u = 0;	//<uint8_t>
		$this->purchaseNum = 0;	//<uint32_t>
		$this->purchaseNum_u = 0;	//<uint8_t>
		$this->transferNum = 0;	//<uint32_t>
		$this->transferNum_u = 0;	//<uint8_t>
		$this->transferOnlineNum = 0;	//<uint32_t>
		$this->transferOnlineNum_u = 0;	//<uint8_t>
		$this->manualLockNum = 0;	//<uint32_t>
		$this->manualLockNum_u = 0;	//<uint8_t>
		$this->allocatedNum = 0;	//<uint32_t>
		$this->allocatedNum_u = 0;	//<uint8_t>
		$this->sellMode = 0;	//<uint32_t>
		$this->sellMode_u = 0;	//<uint8_t>
		$this->status = 0;	//<uint32_t>
		$this->status_u = 0;	//<uint8_t>
		$this->property = 0;	//<uint64_t>
		$this->property_u = 0;	//<uint8_t>
		$this->returnedPurchaseNum = 0;	//<uint32_t>
		$this->returnedPurchaseNum_u = 0;	//<uint8_t>
		$this->wmsRecordPo = new \b2b2c\detailview\po\ViewWMSPo();	//<b2b2c::detailview::po::CViewWMSPo>
		$this->wmsRecordPo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewOmsStockPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewOmsStockPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuid,网购侧唯一
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->inventorySysno);	//<uint64_t>  库存编号 
		$bs->pushUint8_t($this->inventorySysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->productSysno);	//<uint64_t>  产品系统编号 
		$bs->pushUint8_t($this->productSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->stockSysno);	//<uint64_t>  仓库编号 
		$bs->pushUint8_t($this->stockSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->ownerSysno);	//<uint64_t>  货主编号 
		$bs->pushUint8_t($this->ownerSysno_u);	//<uint8_t> 
		$bs->pushUint64_t($this->platformSysno);	//<uint64_t>  平台编号 
		$bs->pushUint8_t($this->platformSysno_u);	//<uint8_t> 
		$bs->pushUint32_t($this->realNum);	//<uint32_t>  实库数量 
		$bs->pushUint8_t($this->realNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->realReserveNum);	//<uint32_t>  实库预留数量 
		$bs->pushUint8_t($this->realReserveNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->virtualNum);	//<uint32_t>  虚库数量  
		$bs->pushUint8_t($this->virtualNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->virtualReserveNum);	//<uint32_t>  虚库预留数量  
		$bs->pushUint8_t($this->virtualReserveNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->activeNum);	//<uint32_t>  活动数量  
		$bs->pushUint8_t($this->activeNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->activeReserveNum);	//<uint32_t>  活动预留数量 
		$bs->pushUint8_t($this->activeReserveNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->oversellNum);	//<uint32_t>  可超卖数量  
		$bs->pushUint8_t($this->oversellNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->oversellReserveNum);	//<uint32_t>  可超卖预留数量  
		$bs->pushUint8_t($this->oversellReserveNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->purchaseNum);	//<uint32_t>  采购在途数量  
		$bs->pushUint8_t($this->purchaseNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->transferNum);	//<uint32_t>  调拨数量  
		$bs->pushUint8_t($this->transferNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->transferOnlineNum);	//<uint32_t>  调拨在途数量  
		$bs->pushUint8_t($this->transferOnlineNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->manualLockNum);	//<uint32_t>  人工锁定数量  
		$bs->pushUint8_t($this->manualLockNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->allocatedNum);	//<uint32_t>  已分配数量  
		$bs->pushUint8_t($this->allocatedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sellMode);	//<uint32_t>  销售类型 
		$bs->pushUint8_t($this->sellMode_u);	//<uint8_t> 
		$bs->pushUint32_t($this->status);	//<uint32_t>  oms 库存状态  
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushUint64_t($this->property);	//<uint64_t>  oms库存属性  
		$bs->pushUint8_t($this->property_u);	//<uint8_t> 
		$bs->pushUint32_t($this->returnedPurchaseNum);	//<uint32_t> 采购退货数量  
		$bs->pushUint8_t($this->returnedPurchaseNum_u);	//<uint8_t> 采购退货数量  uflag
		$bs->pushObject($this->wmsRecordPo,'\b2b2c\detailview\po\ViewWMSPo');	//<b2b2c::detailview::po::CViewWMSPo>  wms老库存字段
		$bs->pushUint8_t($this->wmsRecordPo_u);	//<uint8_t>  wms老库存字段
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuid,网购侧唯一
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['inventorySysno'] = $bs->popUint64_t();	//<uint64_t>  库存编号 
		$this->_arr_value['inventorySysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productSysno'] = $bs->popUint64_t();	//<uint64_t>  产品系统编号 
		$this->_arr_value['productSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockSysno'] = $bs->popUint64_t();	//<uint64_t>  仓库编号 
		$this->_arr_value['stockSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ownerSysno'] = $bs->popUint64_t();	//<uint64_t>  货主编号 
		$this->_arr_value['ownerSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['platformSysno'] = $bs->popUint64_t();	//<uint64_t>  平台编号 
		$this->_arr_value['platformSysno_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['realNum'] = $bs->popUint32_t();	//<uint32_t>  实库数量 
		$this->_arr_value['realNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['realReserveNum'] = $bs->popUint32_t();	//<uint32_t>  实库预留数量 
		$this->_arr_value['realReserveNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualNum'] = $bs->popUint32_t();	//<uint32_t>  虚库数量  
		$this->_arr_value['virtualNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualReserveNum'] = $bs->popUint32_t();	//<uint32_t>  虚库预留数量  
		$this->_arr_value['virtualReserveNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeNum'] = $bs->popUint32_t();	//<uint32_t>  活动数量  
		$this->_arr_value['activeNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['activeReserveNum'] = $bs->popUint32_t();	//<uint32_t>  活动预留数量 
		$this->_arr_value['activeReserveNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['oversellNum'] = $bs->popUint32_t();	//<uint32_t>  可超卖数量  
		$this->_arr_value['oversellNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['oversellReserveNum'] = $bs->popUint32_t();	//<uint32_t>  可超卖预留数量  
		$this->_arr_value['oversellReserveNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['purchaseNum'] = $bs->popUint32_t();	//<uint32_t>  采购在途数量  
		$this->_arr_value['purchaseNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['transferNum'] = $bs->popUint32_t();	//<uint32_t>  调拨数量  
		$this->_arr_value['transferNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['transferOnlineNum'] = $bs->popUint32_t();	//<uint32_t>  调拨在途数量  
		$this->_arr_value['transferOnlineNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['manualLockNum'] = $bs->popUint32_t();	//<uint32_t>  人工锁定数量  
		$this->_arr_value['manualLockNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['allocatedNum'] = $bs->popUint32_t();	//<uint32_t>  已分配数量  
		$this->_arr_value['allocatedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellMode'] = $bs->popUint32_t();	//<uint32_t>  销售类型 
		$this->_arr_value['sellMode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popUint32_t();	//<uint32_t>  oms 库存状态  
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['property'] = $bs->popUint64_t();	//<uint64_t>  oms库存属性  
		$this->_arr_value['property_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['returnedPurchaseNum'] = $bs->popUint32_t();	//<uint32_t> 采购退货数量  
		$this->_arr_value['returnedPurchaseNum_u'] = $bs->popUint8_t();	//<uint8_t> 采购退货数量  uflag
		$this->_arr_value['wmsRecordPo'] = $bs->popObject('\b2b2c\detailview\po\ViewWMSPo');	//<b2b2c::detailview::po::CViewWMSPo>  wms老库存字段
		$this->_arr_value['wmsRecordPo_u'] = $bs->popUint8_t();	//<uint8_t>  wms老库存字段

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewOmsStockPo.java
class ViewWMSPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号 (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $availableQty;	//<int> 可用库存数量(版本>=0)
	private $availableQty_u;	//<uint8_t> (版本>=0)
	private $virtualQty;	//<int>  虚库数量 (版本>=0)
	private $virtualQty_u;	//<uint8_t> (版本>=0)
	private $reserveDdw;	//<uint32_t> 保留字段dw(版本>=0)
	private $reserveDdw_u;	//<uint8_t> (版本>=0)
	private $reserveStr;	//<std::string> 保留字段str(版本>=0)
	private $reserveStr_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->availableQty = 0;	//<int>
		$this->availableQty_u = 0;	//<uint8_t>
		$this->virtualQty = 0;	//<int>
		$this->virtualQty_u = 0;	//<uint8_t>
		$this->reserveDdw = 0;	//<uint32_t>
		$this->reserveDdw_u = 0;	//<uint8_t>
		$this->reserveStr = "";	//<std::string>
		$this->reserveStr_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewWMSPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewWMSPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号 
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushInt32_t($this->availableQty);	//<int> 可用库存数量
		$bs->pushUint8_t($this->availableQty_u);	//<uint8_t> 
		$bs->pushInt32_t($this->virtualQty);	//<int>  虚库数量 
		$bs->pushUint8_t($this->virtualQty_u);	//<uint8_t> 
		$bs->pushUint32_t($this->reserveDdw);	//<uint32_t> 保留字段dw
		$bs->pushUint8_t($this->reserveDdw_u);	//<uint8_t> 
		$bs->pushString($this->reserveStr);	//<std::string> 保留字段str
		$bs->pushUint8_t($this->reserveStr_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号 
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['availableQty'] = $bs->popInt32_t();	//<int> 可用库存数量
		$this->_arr_value['availableQty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['virtualQty'] = $bs->popInt32_t();	//<int>  虚库数量 
		$this->_arr_value['virtualQty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveDdw'] = $bs->popUint32_t();	//<uint32_t> 保留字段dw
		$this->_arr_value['reserveDdw_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reserveStr'] = $bs->popString();	//<std::string> 保留字段str
		$this->_arr_value['reserveStr_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewSkuPo.java
class ViewMultPricePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $regionId;	//<uint32_t> 地域 id(版本>=0)
	private $regionId_u;	//<uint8_t> (版本>=0)
	private $priceViewPrice;	//<uint32_t> 展示价(版本>=0)
	private $priceViewPrice_u;	//<uint8_t> (版本>=0)
	private $priceDealPrice;	//<uint32_t> 下单价(版本>=0)
	private $priceDealPrice_u;	//<uint8_t> (版本>=0)
	private $priceDealDesc;	//<std::string> 下单价描述(版本>=0)
	private $priceDealDesc_u;	//<uint8_t> (版本>=0)
	private $priceDiffReason;	//<std::string> 展示价与下单价不同原因(版本>=0)
	private $priceDiffReason_u;	//<uint8_t> (版本>=0)
	private $priceState;	//<uint16_t> 多价状态(版本>=0)
	private $priceState_u;	//<uint8_t> (版本>=0)
	private $priceBitProperty;	//<std::bitset<32> > 多价属性，用于读(版本>=0)
	private $priceBitProperty_u;	//<uint8_t> (版本>=0)
	private $priceStartTime;	//<uint32_t> 规则开始时间(版本>=0)
	private $priceStartTime_u;	//<uint8_t> (版本>=0)
	private $priceEndTime;	//<uint32_t> 规则结束时间(版本>=0)
	private $priceEndTime_u;	//<uint8_t> (版本>=0)
	private $priceDesc;	//<std::string> 多价规则描述(版本>=0)
	private $priceDesc_u;	//<uint8_t> (版本>=0)
	private $pricePromotionDesc;	//<std::string> 活动规则描述(版本>=0)
	private $pricePromotionDesc_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitFlag;	//<uint16_t> 是否限购(版本>=0)
	private $priceBuyLimitFlag_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitRule;	//<std::string> 限购规则(版本>=0)
	private $priceBuyLimitRule_u;	//<uint8_t> (版本>=0)
	private $priceVerifyType;	//<uint16_t> 验证类型(版本>=0)
	private $priceVerifyType_u;	//<uint8_t> (版本>=0)
	private $viewTimedPrice;	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo> > timed price,基于时间维度多价 可以有多个(版本>=0)
	private $viewTimedPrice_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->regionId = 0;	//<uint32_t>
		$this->regionId_u = 0;	//<uint8_t>
		$this->priceViewPrice = 0;	//<uint32_t>
		$this->priceViewPrice_u = 0;	//<uint8_t>
		$this->priceDealPrice = 0;	//<uint32_t>
		$this->priceDealPrice_u = 0;	//<uint8_t>
		$this->priceDealDesc = "";	//<std::string>
		$this->priceDealDesc_u = 0;	//<uint8_t>
		$this->priceDiffReason = "";	//<std::string>
		$this->priceDiffReason_u = 0;	//<uint8_t>
		$this->priceState = 0;	//<uint16_t>
		$this->priceState_u = 0;	//<uint8_t>
		$this->priceBitProperty = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->priceBitProperty_u = 0;	//<uint8_t>
		$this->priceStartTime = 0;	//<uint32_t>
		$this->priceStartTime_u = 0;	//<uint8_t>
		$this->priceEndTime = 0;	//<uint32_t>
		$this->priceEndTime_u = 0;	//<uint8_t>
		$this->priceDesc = "";	//<std::string>
		$this->priceDesc_u = 0;	//<uint8_t>
		$this->pricePromotionDesc = "";	//<std::string>
		$this->pricePromotionDesc_u = 0;	//<uint8_t>
		$this->priceBuyLimitFlag = 0;	//<uint16_t>
		$this->priceBuyLimitFlag_u = 0;	//<uint8_t>
		$this->priceBuyLimitRule = "";	//<std::string>
		$this->priceBuyLimitRule_u = 0;	//<uint8_t>
		$this->priceVerifyType = 0;	//<uint16_t>
		$this->priceVerifyType_u = 0;	//<uint8_t>
		$this->viewTimedPrice = new \stl_vector2('\b2b2c\detailview\po\ViewTimedPricePo');	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo> >
		$this->viewTimedPrice_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewMultPricePo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewMultPricePo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id
		$bs->pushUint8_t($this->regionId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceViewPrice);	//<uint32_t> 展示价
		$bs->pushUint8_t($this->priceViewPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceDealPrice);	//<uint32_t> 下单价
		$bs->pushUint8_t($this->priceDealPrice_u);	//<uint8_t> 
		$bs->pushString($this->priceDealDesc);	//<std::string> 下单价描述
		$bs->pushUint8_t($this->priceDealDesc_u);	//<uint8_t> 
		$bs->pushString($this->priceDiffReason);	//<std::string> 展示价与下单价不同原因
		$bs->pushUint8_t($this->priceDiffReason_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceState);	//<uint16_t> 多价状态
		$bs->pushUint8_t($this->priceState_u);	//<uint8_t> 
		$bs->pushObject($this->priceBitProperty,'stl_bitset');	//<std::bitset<32> > 多价属性，用于读
		$bs->pushUint8_t($this->priceBitProperty_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceStartTime);	//<uint32_t> 规则开始时间
		$bs->pushUint8_t($this->priceStartTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceEndTime);	//<uint32_t> 规则结束时间
		$bs->pushUint8_t($this->priceEndTime_u);	//<uint8_t> 
		$bs->pushString($this->priceDesc);	//<std::string> 多价规则描述
		$bs->pushUint8_t($this->priceDesc_u);	//<uint8_t> 
		$bs->pushString($this->pricePromotionDesc);	//<std::string> 活动规则描述
		$bs->pushUint8_t($this->pricePromotionDesc_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceBuyLimitFlag);	//<uint16_t> 是否限购
		$bs->pushUint8_t($this->priceBuyLimitFlag_u);	//<uint8_t> 
		$bs->pushString($this->priceBuyLimitRule);	//<std::string> 限购规则
		$bs->pushUint8_t($this->priceBuyLimitRule_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceVerifyType);	//<uint16_t> 验证类型
		$bs->pushUint8_t($this->priceVerifyType_u);	//<uint8_t> 
		$bs->pushObject($this->viewTimedPrice,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo> > timed price,基于时间维度多价 可以有多个
		$bs->pushUint8_t($this->viewTimedPrice_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['regionId'] = $bs->popUint32_t();	//<uint32_t> 地域 id
		$this->_arr_value['regionId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceViewPrice'] = $bs->popUint32_t();	//<uint32_t> 展示价
		$this->_arr_value['priceViewPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDealPrice'] = $bs->popUint32_t();	//<uint32_t> 下单价
		$this->_arr_value['priceDealPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDealDesc'] = $bs->popString();	//<std::string> 下单价描述
		$this->_arr_value['priceDealDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDiffReason'] = $bs->popString();	//<std::string> 展示价与下单价不同原因
		$this->_arr_value['priceDiffReason_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceState'] = $bs->popUint16_t();	//<uint16_t> 多价状态
		$this->_arr_value['priceState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBitProperty'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > 多价属性，用于读
		$this->_arr_value['priceBitProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceStartTime'] = $bs->popUint32_t();	//<uint32_t> 规则开始时间
		$this->_arr_value['priceStartTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceEndTime'] = $bs->popUint32_t();	//<uint32_t> 规则结束时间
		$this->_arr_value['priceEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDesc'] = $bs->popString();	//<std::string> 多价规则描述
		$this->_arr_value['priceDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pricePromotionDesc'] = $bs->popString();	//<std::string> 活动规则描述
		$this->_arr_value['pricePromotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitFlag'] = $bs->popUint16_t();	//<uint16_t> 是否限购
		$this->_arr_value['priceBuyLimitFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitRule'] = $bs->popString();	//<std::string> 限购规则
		$this->_arr_value['priceBuyLimitRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceVerifyType'] = $bs->popUint16_t();	//<uint16_t> 验证类型
		$this->_arr_value['priceVerifyType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['viewTimedPrice'] = $bs->popObject('stl_vector<\b2b2c\detailview\po\ViewTimedPricePo>');	//<std::vector<b2b2c::detailview::po::CViewTimedPricePo> > timed price,基于时间维度多价 可以有多个
		$this->_arr_value['viewTimedPrice_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewMultPricePo.java
class ViewTimedPricePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $timedPricePrice;	//<uint32_t>  timedPrice 价格(版本>=0)
	private $timedPricePrice_u;	//<uint8_t> (版本>=0)
	private $timedPriceStartTime;	//<uint32_t>  timedPrice 开始时间 (版本>=0)
	private $timedPriceStartTime_u;	//<uint8_t> (版本>=0)
	private $timedPriceEndTime;	//<uint32_t>  timedPrice 结束时间 (版本>=0)
	private $timedPriceEndTime_u;	//<uint8_t> (版本>=0)
	private $timedPriceProperty;	//<uint32_t>  timedPrice 属性(版本>=0)
	private $timedPriceProperty_u;	//<uint8_t> (版本>=0)
	private $timedPricePromotionDesc;	//<std::string>  促销语描述(版本>=0)
	private $timedPricePromotionDesc_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->timedPricePrice = 0;	//<uint32_t>
		$this->timedPricePrice_u = 0;	//<uint8_t>
		$this->timedPriceStartTime = 0;	//<uint32_t>
		$this->timedPriceStartTime_u = 0;	//<uint8_t>
		$this->timedPriceEndTime = 0;	//<uint32_t>
		$this->timedPriceEndTime_u = 0;	//<uint8_t>
		$this->timedPriceProperty = 0;	//<uint32_t>
		$this->timedPriceProperty_u = 0;	//<uint8_t>
		$this->timedPricePromotionDesc = "";	//<std::string>
		$this->timedPricePromotionDesc_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewTimedPricePo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewTimedPricePo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPricePrice);	//<uint32_t>  timedPrice 价格
		$bs->pushUint8_t($this->timedPricePrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceStartTime);	//<uint32_t>  timedPrice 开始时间 
		$bs->pushUint8_t($this->timedPriceStartTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceEndTime);	//<uint32_t>  timedPrice 结束时间 
		$bs->pushUint8_t($this->timedPriceEndTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->timedPriceProperty);	//<uint32_t>  timedPrice 属性
		$bs->pushUint8_t($this->timedPriceProperty_u);	//<uint8_t> 
		$bs->pushString($this->timedPricePromotionDesc);	//<std::string>  促销语描述
		$bs->pushUint8_t($this->timedPricePromotionDesc_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPricePrice'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 价格
		$this->_arr_value['timedPricePrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceStartTime'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 开始时间 
		$this->_arr_value['timedPriceStartTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceEndTime'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 结束时间 
		$this->_arr_value['timedPriceEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPriceProperty'] = $bs->popUint32_t();	//<uint32_t>  timedPrice 属性
		$this->_arr_value['timedPriceProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['timedPricePromotionDesc'] = $bs->popString();	//<std::string>  促销语描述
		$this->_arr_value['timedPricePromotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewSkuPo.java
class ViewSkuPicturePo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuPicId;	//<uint64_t> sku 图片ID 自动生成 目前没用 (版本>=0)
	private $skuPicId_u;	//<uint8_t> (版本>=0)
	private $skuPicSize;	//<std::set<std::string> > sku 图片大小列表,如：'60' '80' (版本>=0)
	private $skuPicSize_u;	//<uint8_t> (版本>=0)
	private $skuPicIndex;	//<uint8_t> sku 图片编号 (版本>=0)
	private $skuPicIndex_u;	//<uint8_t> (版本>=0)
	private $skuPicType;	//<std::string> sku 图片类型,jpg&gif  (版本>=0)
	private $skuPicType_u;	//<uint8_t> (版本>=0)
	private $skuProperty;	//<std::bitset<32> > sku 图片属性 参见enum SkuProperty(版本>=0)
	private $skuProperty_u;	//<uint8_t> (版本>=0)
	private $skuPicDesc;	//<std::string> sku 图片描述  (版本>=0)
	private $skuPicDesc_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime;	//<uint32_t> sku 图片最后更新时间  (版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> sku 图片最后更新时间 flag(版本>=0)
	private $logoUrl;	//<std::map<std::string,std::string> > 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E (版本>=0)
	private $logoUrl_u;	//<uint8_t> Url map flag(版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuPicId = 0;	//<uint64_t>
		$this->skuPicId_u = 0;	//<uint8_t>
		$this->skuPicSize = new \stl_set2('stl_string');	//<std::set<std::string> >
		$this->skuPicSize_u = 0;	//<uint8_t>
		$this->skuPicIndex = 0;	//<uint8_t>
		$this->skuPicIndex_u = 0;	//<uint8_t>
		$this->skuPicType = "";	//<std::string>
		$this->skuPicType_u = 0;	//<uint8_t>
		$this->skuProperty = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->skuProperty_u = 0;	//<uint8_t>
		$this->skuPicDesc = "";	//<std::string>
		$this->skuPicDesc_u = 0;	//<uint8_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
		$this->logoUrl = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->logoUrl_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewSkuPicturePo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewSkuPicturePo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuPicId);	//<uint64_t> sku 图片ID 自动生成 目前没用 
		$bs->pushUint8_t($this->skuPicId_u);	//<uint8_t> 
		$bs->pushObject($this->skuPicSize,'stl_set');	//<std::set<std::string> > sku 图片大小列表,如：'60' '80' 
		$bs->pushUint8_t($this->skuPicSize_u);	//<uint8_t> 
		$bs->pushUint8_t($this->skuPicIndex);	//<uint8_t> sku 图片编号 
		$bs->pushUint8_t($this->skuPicIndex_u);	//<uint8_t> 
		$bs->pushString($this->skuPicType);	//<std::string> sku 图片类型,jpg&gif  
		$bs->pushUint8_t($this->skuPicType_u);	//<uint8_t> 
		$bs->pushObject($this->skuProperty,'stl_bitset');	//<std::bitset<32> > sku 图片属性 参见enum SkuProperty
		$bs->pushUint8_t($this->skuProperty_u);	//<uint8_t> 
		$bs->pushString($this->skuPicDesc);	//<std::string> sku 图片描述  
		$bs->pushUint8_t($this->skuPicDesc_u);	//<uint8_t> 
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> sku 图片最后更新时间  
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> sku 图片最后更新时间 flag
		$bs->pushObject($this->logoUrl,'stl_map');	//<std::map<std::string,std::string> > 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E 
		$bs->pushUint8_t($this->logoUrl_u);	//<uint8_t> Url map flag
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuPicId'] = $bs->popUint64_t();	//<uint64_t> sku 图片ID 自动生成 目前没用 
		$this->_arr_value['skuPicId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuPicSize'] = $bs->popObject('stl_set<stl_string>');	//<std::set<std::string> > sku 图片大小列表,如：'60' '80' 
		$this->_arr_value['skuPicSize_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuPicIndex'] = $bs->popUint8_t();	//<uint8_t> sku 图片编号 
		$this->_arr_value['skuPicIndex_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuPicType'] = $bs->popString();	//<std::string> sku 图片类型,jpg&gif  
		$this->_arr_value['skuPicType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuProperty'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > sku 图片属性 参见enum SkuProperty
		$this->_arr_value['skuProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuPicDesc'] = $bs->popString();	//<std::string> sku 图片描述  
		$this->_arr_value['skuPicDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> sku 图片最后更新时间  
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> sku 图片最后更新时间 flag
		$this->_arr_value['logoUrl'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E 
		$this->_arr_value['logoUrl_u'] = $bs->popUint8_t();	//<uint8_t> Url map flag

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewSkuPo.java
class ViewStockPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> skuid,网购侧唯一(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $stockId;	//<uint64_t> stockId,库存id 平台自动生成且唯一 ，skuid+storehouseid唯一关联一个stockid(版本>=0)
	private $stockId_u;	//<uint8_t> (版本>=0)
	private $storeHouseId;	//<uint32_t> 仓库Id 对应网购平台逻辑仓id (版本>=0)
	private $storeHouseId_u;	//<uint8_t> (版本>=0)
	private $cooperatorStockCode;	//<std::string> 供应商库存编码,内码  (版本>=0)
	private $cooperatorStockCode_u;	//<uint8_t> (版本>=0)
	private $cooperatorBarCode;	//<std::string> 供应商商品条形码  (版本>=0)
	private $cooperatorBarCode_u;	//<uint8_t> (版本>=0)
	private $stockPrice;	//<uint32_t> 库存价格，单位分 商品真实售卖价格 (版本>=0)
	private $stockPrice_u;	//<uint8_t> (版本>=0)
	private $stockPrePrice;	//<uint32_t> 库存上次价格  (版本>=0)
	private $stockPrePrice_u;	//<uint8_t> (版本>=0)
	private $stockCostPrice;	//<uint32_t> 库存成本价格  (版本>=0)
	private $stockCostPrice_u;	//<uint8_t> (版本>=0)
	private $stockVirtualNum;	//<uint32_t> 库存虚拟数量  暂未用(版本>=0)
	private $stockVirtualNum_u;	//<uint8_t> (版本>=0)
	private $stockRealNum;	//<uint32_t> 库存实际数量  暂未用(版本>=0)
	private $stockRealNum_u;	//<uint8_t> (版本>=0)
	private $stockLockNum;	//<uint32_t> 库存活动锁定数 暂未用 (版本>=0)
	private $stockLockNum_u;	//<uint8_t> (版本>=0)
	private $stockSellingNum;	//<uint32_t> 普通销售锁定增减  暂未用(版本>=0)
	private $stockSellingNum_u;	//<uint8_t> (版本>=0)
	private $stockProSellingNum;	//<uint32_t> 活动销售锁定增减 暂未用 (版本>=0)
	private $stockProSellingNum_u;	//<uint8_t> (版本>=0)
	private $stockEstimateDispatch;	//<std::string> 预计发送天数-出货时间 仓库到物流的时间   (版本>=0)
	private $stockEstimateDispatch_u;	//<uint8_t> (版本>=0)
	private $stocProperty;	//<std::bitset<32> > 库存属性 参见enum StockProperty (版本>=0)
	private $stocProperty_u;	//<uint8_t> (版本>=0)
	private $stockState;	//<uint8_t> 库存状态  参见enum StockState 同sku状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 (版本>=0)
	private $stockState_u;	//<uint8_t> (版本>=0)
	private $coverArea;	//<std::set<uint32_t> > 覆盖地域  (版本>=0)
	private $coverArea_u;	//<uint8_t> (版本>=0)
	private $stockLimitArea;	//<std::set<uint32_t> > 限运地域  (版本>=0)
	private $stockLimitArea_u;	//<uint8_t> (版本>=0)
	private $stockLimitRule;	//<std::string> 库存限运规则  (版本>=0)
	private $stockLimitRule_u;	//<uint8_t> (版本>=0)
	private $stockOrderNum;	//<uint32_t> 库存购买总数,下单件数  暂未用(版本>=0)
	private $stockOrderNum_u;	//<uint8_t> (版本>=0)
	private $stockSoldNum;	//<uint32_t> 库存销售总数，订单流程走完的数量  暂未用(版本>=0)
	private $stockSoldNum_u;	//<uint8_t> (版本>=0)
	private $stockPayedNum;	//<uint32_t> 完成付款后的锁定数量 暂未用(版本>=0)
	private $stockPayedNum_u;	//<uint8_t> (版本>=0)
	private $stockProPayedNum;	//<uint32_t> 促销付款后的锁定数量 暂未用(版本>=0)
	private $stockProPayedNum_u;	//<uint8_t> (版本>=0)
	private $stockRealSynNum;	//<uint32_t> 合作伙伴真实同步数量  暂未用(版本>=0)
	private $stockRealSynNum_u;	//<uint8_t> (版本>=0)
	private $stockPromotionDesc;	//<std::string> 库存促销语  (版本>=0)
	private $stockPromotionDesc_u;	//<uint8_t> (版本>=0)
	private $storeHouseName;	//<std::string> 仓库名称  (版本>=0)
	private $storeHouseName_u;	//<uint8_t> (版本>=0)
	private $stockMinBuyCount;	//<uint32_t> 起购数量 最小购买数量(版本>=0)
	private $stockMinBuyCount_u;	//<uint8_t> (版本>=0)
	private $stockMaxBuyCount;	//<uint32_t> 限购数量 最大购买限制(版本>=0)
	private $stockMaxBuyCount_u;	//<uint8_t> (版本>=0)
	private $stockSellMode;	//<uint32_t> 合约机业务类型(版本>=0)
	private $stockSellMode_u;	//<uint8_t> (版本>=0)
	private $stockBusinessCost;	//<uint32_t> 业务成本(版本>=20130308)
	private $stockBusinessCost_u;	//<uint8_t> 业务成本 flag(版本>=20130308)
	private $stockLimitCode;	//<uint32_t> 易迅限运规则编码，具体由易迅侧服务解释(版本>=20130308)
	private $stockLimitCode_u;	//<uint8_t> 易迅限运规则编码，具体由易迅侧服务解释 flag(版本>=20130308)
	private $promotionType;	//<uint32_t> 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发(版本>=20130308)
	private $promotionType_u;	//<uint8_t> 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag(版本>=20130308)
	private $storeHouseType;	//<uint32_t> 仓库类型 0 为逻辑仓 1为物理仓 (版本>=20130327)
	private $storeHouseType_u;	//<uint8_t> 仓库类型 0 为逻辑仓 1为物理仓 flag(版本>=20130327)
	private $storeHouseCode;	//<uint32_t> 合作伙伴侧仓库编码 (版本>=20130327)
	private $storeHouseCode_u;	//<uint8_t> 合作伙伴侧仓库编码flag(版本>=20130327)
	private $viewIcsonStockExInfo;	//<std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> > 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员(版本>=20130327)
	private $viewIcsonStockExInfo_u;	//<uint8_t> 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员(版本>=20130327)

	function __construct(){
		$this->version = 20130327;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->stockId = 0;	//<uint64_t>
		$this->stockId_u = 0;	//<uint8_t>
		$this->storeHouseId = 0;	//<uint32_t>
		$this->storeHouseId_u = 0;	//<uint8_t>
		$this->cooperatorStockCode = "";	//<std::string>
		$this->cooperatorStockCode_u = 0;	//<uint8_t>
		$this->cooperatorBarCode = "";	//<std::string>
		$this->cooperatorBarCode_u = 0;	//<uint8_t>
		$this->stockPrice = 0;	//<uint32_t>
		$this->stockPrice_u = 0;	//<uint8_t>
		$this->stockPrePrice = 0;	//<uint32_t>
		$this->stockPrePrice_u = 0;	//<uint8_t>
		$this->stockCostPrice = 0;	//<uint32_t>
		$this->stockCostPrice_u = 0;	//<uint8_t>
		$this->stockVirtualNum = 0;	//<uint32_t>
		$this->stockVirtualNum_u = 0;	//<uint8_t>
		$this->stockRealNum = 0;	//<uint32_t>
		$this->stockRealNum_u = 0;	//<uint8_t>
		$this->stockLockNum = 0;	//<uint32_t>
		$this->stockLockNum_u = 0;	//<uint8_t>
		$this->stockSellingNum = 0;	//<uint32_t>
		$this->stockSellingNum_u = 0;	//<uint8_t>
		$this->stockProSellingNum = 0;	//<uint32_t>
		$this->stockProSellingNum_u = 0;	//<uint8_t>
		$this->stockEstimateDispatch = "";	//<std::string>
		$this->stockEstimateDispatch_u = 0;	//<uint8_t>
		$this->stocProperty = new \stl_bitset2('32');	//<std::bitset<32> >
		$this->stocProperty_u = 0;	//<uint8_t>
		$this->stockState = 0;	//<uint8_t>
		$this->stockState_u = 0;	//<uint8_t>
		$this->coverArea = new \stl_set2('uint32_t');	//<std::set<uint32_t> >
		$this->coverArea_u = 0;	//<uint8_t>
		$this->stockLimitArea = new \stl_set2('uint32_t');	//<std::set<uint32_t> >
		$this->stockLimitArea_u = 0;	//<uint8_t>
		$this->stockLimitRule = "";	//<std::string>
		$this->stockLimitRule_u = 0;	//<uint8_t>
		$this->stockOrderNum = 0;	//<uint32_t>
		$this->stockOrderNum_u = 0;	//<uint8_t>
		$this->stockSoldNum = 0;	//<uint32_t>
		$this->stockSoldNum_u = 0;	//<uint8_t>
		$this->stockPayedNum = 0;	//<uint32_t>
		$this->stockPayedNum_u = 0;	//<uint8_t>
		$this->stockProPayedNum = 0;	//<uint32_t>
		$this->stockProPayedNum_u = 0;	//<uint8_t>
		$this->stockRealSynNum = 0;	//<uint32_t>
		$this->stockRealSynNum_u = 0;	//<uint8_t>
		$this->stockPromotionDesc = "";	//<std::string>
		$this->stockPromotionDesc_u = 0;	//<uint8_t>
		$this->storeHouseName = "";	//<std::string>
		$this->storeHouseName_u = 0;	//<uint8_t>
		$this->stockMinBuyCount = 0;	//<uint32_t>
		$this->stockMinBuyCount_u = 0;	//<uint8_t>
		$this->stockMaxBuyCount = 0;	//<uint32_t>
		$this->stockMaxBuyCount_u = 0;	//<uint8_t>
		$this->stockSellMode = 0;	//<uint32_t>
		$this->stockSellMode_u = 0;	//<uint8_t>
		$this->stockBusinessCost = 0;	//<uint32_t>
		$this->stockBusinessCost_u = 0;	//<uint8_t>
		$this->stockLimitCode = 0;	//<uint32_t>
		$this->stockLimitCode_u = 0;	//<uint8_t>
		$this->promotionType = 0;	//<uint32_t>
		$this->promotionType_u = 0;	//<uint8_t>
		$this->storeHouseType = 0;	//<uint32_t>
		$this->storeHouseType_u = 0;	//<uint8_t>
		$this->storeHouseCode = 0;	//<uint32_t>
		$this->storeHouseCode_u = 0;	//<uint8_t>
		$this->viewIcsonStockExInfo = new \stl_vector2('\b2b2c\detailview\po\ViewIcsonStockExInfoPo');	//<std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> >
		$this->viewIcsonStockExInfo_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewStockPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewStockPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> skuid,网购侧唯一
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->stockId);	//<uint64_t> stockId,库存id 平台自动生成且唯一 ，skuid+storehouseid唯一关联一个stockid
		$bs->pushUint8_t($this->stockId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->storeHouseId);	//<uint32_t> 仓库Id 对应网购平台逻辑仓id 
		$bs->pushUint8_t($this->storeHouseId_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorStockCode);	//<std::string> 供应商库存编码,内码  
		$bs->pushUint8_t($this->cooperatorStockCode_u);	//<uint8_t> 
		$bs->pushString($this->cooperatorBarCode);	//<std::string> 供应商商品条形码  
		$bs->pushUint8_t($this->cooperatorBarCode_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockPrice);	//<uint32_t> 库存价格，单位分 商品真实售卖价格 
		$bs->pushUint8_t($this->stockPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockPrePrice);	//<uint32_t> 库存上次价格  
		$bs->pushUint8_t($this->stockPrePrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockCostPrice);	//<uint32_t> 库存成本价格  
		$bs->pushUint8_t($this->stockCostPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockVirtualNum);	//<uint32_t> 库存虚拟数量  暂未用
		$bs->pushUint8_t($this->stockVirtualNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockRealNum);	//<uint32_t> 库存实际数量  暂未用
		$bs->pushUint8_t($this->stockRealNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockLockNum);	//<uint32_t> 库存活动锁定数 暂未用 
		$bs->pushUint8_t($this->stockLockNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockSellingNum);	//<uint32_t> 普通销售锁定增减  暂未用
		$bs->pushUint8_t($this->stockSellingNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockProSellingNum);	//<uint32_t> 活动销售锁定增减 暂未用 
		$bs->pushUint8_t($this->stockProSellingNum_u);	//<uint8_t> 
		$bs->pushString($this->stockEstimateDispatch);	//<std::string> 预计发送天数-出货时间 仓库到物流的时间   
		$bs->pushUint8_t($this->stockEstimateDispatch_u);	//<uint8_t> 
		$bs->pushObject($this->stocProperty,'stl_bitset');	//<std::bitset<32> > 库存属性 参见enum StockProperty 
		$bs->pushUint8_t($this->stocProperty_u);	//<uint8_t> 
		$bs->pushUint8_t($this->stockState);	//<uint8_t> 库存状态  参见enum StockState 同sku状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		$bs->pushUint8_t($this->stockState_u);	//<uint8_t> 
		$bs->pushObject($this->coverArea,'stl_set');	//<std::set<uint32_t> > 覆盖地域  
		$bs->pushUint8_t($this->coverArea_u);	//<uint8_t> 
		$bs->pushObject($this->stockLimitArea,'stl_set');	//<std::set<uint32_t> > 限运地域  
		$bs->pushUint8_t($this->stockLimitArea_u);	//<uint8_t> 
		$bs->pushString($this->stockLimitRule);	//<std::string> 库存限运规则  
		$bs->pushUint8_t($this->stockLimitRule_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockOrderNum);	//<uint32_t> 库存购买总数,下单件数  暂未用
		$bs->pushUint8_t($this->stockOrderNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockSoldNum);	//<uint32_t> 库存销售总数，订单流程走完的数量  暂未用
		$bs->pushUint8_t($this->stockSoldNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockPayedNum);	//<uint32_t> 完成付款后的锁定数量 暂未用
		$bs->pushUint8_t($this->stockPayedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockProPayedNum);	//<uint32_t> 促销付款后的锁定数量 暂未用
		$bs->pushUint8_t($this->stockProPayedNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockRealSynNum);	//<uint32_t> 合作伙伴真实同步数量  暂未用
		$bs->pushUint8_t($this->stockRealSynNum_u);	//<uint8_t> 
		$bs->pushString($this->stockPromotionDesc);	//<std::string> 库存促销语  
		$bs->pushUint8_t($this->stockPromotionDesc_u);	//<uint8_t> 
		$bs->pushString($this->storeHouseName);	//<std::string> 仓库名称  
		$bs->pushUint8_t($this->storeHouseName_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockMinBuyCount);	//<uint32_t> 起购数量 最小购买数量
		$bs->pushUint8_t($this->stockMinBuyCount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockMaxBuyCount);	//<uint32_t> 限购数量 最大购买限制
		$bs->pushUint8_t($this->stockMaxBuyCount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->stockSellMode);	//<uint32_t> 合约机业务类型
		$bs->pushUint8_t($this->stockSellMode_u);	//<uint8_t> 
		if($this->version >= 20130308){
			$bs->pushUint32_t($this->stockBusinessCost);	//<uint32_t> 业务成本
		}
		if($this->version >= 20130308){
			$bs->pushUint8_t($this->stockBusinessCost_u);	//<uint8_t> 业务成本 flag
		}
		if($this->version >= 20130308){
			$bs->pushUint32_t($this->stockLimitCode);	//<uint32_t> 易迅限运规则编码，具体由易迅侧服务解释
		}
		if($this->version >= 20130308){
			$bs->pushUint8_t($this->stockLimitCode_u);	//<uint8_t> 易迅限运规则编码，具体由易迅侧服务解释 flag
		}
		if($this->version >= 20130308){
			$bs->pushUint32_t($this->promotionType);	//<uint32_t> 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发
		}
		if($this->version >= 20130308){
			$bs->pushUint8_t($this->promotionType_u);	//<uint8_t> 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag
		}
		if($this->version >= 20130327){
			$bs->pushUint32_t($this->storeHouseType);	//<uint32_t> 仓库类型 0 为逻辑仓 1为物理仓 
		}
		if($this->version >= 20130327){
			$bs->pushUint8_t($this->storeHouseType_u);	//<uint8_t> 仓库类型 0 为逻辑仓 1为物理仓 flag
		}
		if($this->version >= 20130327){
			$bs->pushUint32_t($this->storeHouseCode);	//<uint32_t> 合作伙伴侧仓库编码 
		}
		if($this->version >= 20130327){
			$bs->pushUint8_t($this->storeHouseCode_u);	//<uint8_t> 合作伙伴侧仓库编码flag
		}
		if($this->version >= 20130327){
			$bs->pushObject($this->viewIcsonStockExInfo,'stl_vector');	//<std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> > 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员
		}
		if($this->version >= 20130327){
			$bs->pushUint8_t($this->viewIcsonStockExInfo_u);	//<uint8_t> 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> skuid,网购侧唯一
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockId'] = $bs->popUint64_t();	//<uint64_t> stockId,库存id 平台自动生成且唯一 ，skuid+storehouseid唯一关联一个stockid
		$this->_arr_value['stockId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['storeHouseId'] = $bs->popUint32_t();	//<uint32_t> 仓库Id 对应网购平台逻辑仓id 
		$this->_arr_value['storeHouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorStockCode'] = $bs->popString();	//<std::string> 供应商库存编码,内码  
		$this->_arr_value['cooperatorStockCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorBarCode'] = $bs->popString();	//<std::string> 供应商商品条形码  
		$this->_arr_value['cooperatorBarCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockPrice'] = $bs->popUint32_t();	//<uint32_t> 库存价格，单位分 商品真实售卖价格 
		$this->_arr_value['stockPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockPrePrice'] = $bs->popUint32_t();	//<uint32_t> 库存上次价格  
		$this->_arr_value['stockPrePrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockCostPrice'] = $bs->popUint32_t();	//<uint32_t> 库存成本价格  
		$this->_arr_value['stockCostPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockVirtualNum'] = $bs->popUint32_t();	//<uint32_t> 库存虚拟数量  暂未用
		$this->_arr_value['stockVirtualNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockRealNum'] = $bs->popUint32_t();	//<uint32_t> 库存实际数量  暂未用
		$this->_arr_value['stockRealNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockLockNum'] = $bs->popUint32_t();	//<uint32_t> 库存活动锁定数 暂未用 
		$this->_arr_value['stockLockNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockSellingNum'] = $bs->popUint32_t();	//<uint32_t> 普通销售锁定增减  暂未用
		$this->_arr_value['stockSellingNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockProSellingNum'] = $bs->popUint32_t();	//<uint32_t> 活动销售锁定增减 暂未用 
		$this->_arr_value['stockProSellingNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockEstimateDispatch'] = $bs->popString();	//<std::string> 预计发送天数-出货时间 仓库到物流的时间   
		$this->_arr_value['stockEstimateDispatch_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stocProperty'] = $bs->popObject('stl_bitset<32>');	//<std::bitset<32> > 库存属性 参见enum StockProperty 
		$this->_arr_value['stocProperty_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockState'] = $bs->popUint8_t();	//<uint8_t> 库存状态  参见enum StockState 同sku状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		$this->_arr_value['stockState_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['coverArea'] = $bs->popObject('stl_set<uint32_t>');	//<std::set<uint32_t> > 覆盖地域  
		$this->_arr_value['coverArea_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockLimitArea'] = $bs->popObject('stl_set<uint32_t>');	//<std::set<uint32_t> > 限运地域  
		$this->_arr_value['stockLimitArea_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockLimitRule'] = $bs->popString();	//<std::string> 库存限运规则  
		$this->_arr_value['stockLimitRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockOrderNum'] = $bs->popUint32_t();	//<uint32_t> 库存购买总数,下单件数  暂未用
		$this->_arr_value['stockOrderNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockSoldNum'] = $bs->popUint32_t();	//<uint32_t> 库存销售总数，订单流程走完的数量  暂未用
		$this->_arr_value['stockSoldNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockPayedNum'] = $bs->popUint32_t();	//<uint32_t> 完成付款后的锁定数量 暂未用
		$this->_arr_value['stockPayedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockProPayedNum'] = $bs->popUint32_t();	//<uint32_t> 促销付款后的锁定数量 暂未用
		$this->_arr_value['stockProPayedNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockRealSynNum'] = $bs->popUint32_t();	//<uint32_t> 合作伙伴真实同步数量  暂未用
		$this->_arr_value['stockRealSynNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockPromotionDesc'] = $bs->popString();	//<std::string> 库存促销语  
		$this->_arr_value['stockPromotionDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['storeHouseName'] = $bs->popString();	//<std::string> 仓库名称  
		$this->_arr_value['storeHouseName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockMinBuyCount'] = $bs->popUint32_t();	//<uint32_t> 起购数量 最小购买数量
		$this->_arr_value['stockMinBuyCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockMaxBuyCount'] = $bs->popUint32_t();	//<uint32_t> 限购数量 最大购买限制
		$this->_arr_value['stockMaxBuyCount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['stockSellMode'] = $bs->popUint32_t();	//<uint32_t> 合约机业务类型
		$this->_arr_value['stockSellMode_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 20130308){
			$this->_arr_value['stockBusinessCost'] = $bs->popUint32_t();	//<uint32_t> 业务成本
		}
		if($this->version >= 20130308){
			$this->_arr_value['stockBusinessCost_u'] = $bs->popUint8_t();	//<uint8_t> 业务成本 flag
		}
		if($this->version >= 20130308){
			$this->_arr_value['stockLimitCode'] = $bs->popUint32_t();	//<uint32_t> 易迅限运规则编码，具体由易迅侧服务解释
		}
		if($this->version >= 20130308){
			$this->_arr_value['stockLimitCode_u'] = $bs->popUint8_t();	//<uint8_t> 易迅限运规则编码，具体由易迅侧服务解释 flag
		}
		if($this->version >= 20130308){
			$this->_arr_value['promotionType'] = $bs->popUint32_t();	//<uint32_t> 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发
		}
		if($this->version >= 20130308){
			$this->_arr_value['promotionType_u'] = $bs->popUint8_t();	//<uint8_t> 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag
		}
		if($this->version >= 20130327){
			$this->_arr_value['storeHouseType'] = $bs->popUint32_t();	//<uint32_t> 仓库类型 0 为逻辑仓 1为物理仓 
		}
		if($this->version >= 20130327){
			$this->_arr_value['storeHouseType_u'] = $bs->popUint8_t();	//<uint8_t> 仓库类型 0 为逻辑仓 1为物理仓 flag
		}
		if($this->version >= 20130327){
			$this->_arr_value['storeHouseCode'] = $bs->popUint32_t();	//<uint32_t> 合作伙伴侧仓库编码 
		}
		if($this->version >= 20130327){
			$this->_arr_value['storeHouseCode_u'] = $bs->popUint8_t();	//<uint8_t> 合作伙伴侧仓库编码flag
		}
		if($this->version >= 20130327){
			$this->_arr_value['viewIcsonStockExInfo'] = $bs->popObject('stl_vector<\b2b2c\detailview\po\ViewIcsonStockExInfoPo>');	//<std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> > 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员
		}
		if($this->version >= 20130327){
			$this->_arr_value['viewIcsonStockExInfo_u'] = $bs->popUint8_t();	//<uint8_t> 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员
		}

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.ViewStockPo.java
class ViewIcsonStockExInfoPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 版本号, version需要小写(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $skuid;	//<uint64_t> (版本>=0)
	private $skuid_u;	//<uint8_t> (版本>=0)
	private $storehouseid;	//<uint32_t> (版本>=0)
	private $storehouseid_u;	//<uint8_t> (版本>=0)
	private $sndSource;	//<uint32_t> 二手商品来源(版本>=0)
	private $sndSource_u;	//<uint8_t> 二手商品来源  flag(版本>=0)
	private $sndWarrantyTime;	//<uint32_t> 二手保修截止时间(版本>=0)
	private $sndWarrantyTime_u;	//<uint8_t> 二手保修截止时间  flag(版本>=0)
	private $sndClass;	//<uint32_t> 二手商品品相(版本>=0)
	private $sndClass_u;	//<uint8_t> 二手商品品相  flag(版本>=0)
	private $sndPerformance;	//<uint32_t> 二手商品性能(版本>=0)
	private $sndPerformance_u;	//<uint8_t> 二手商品性能  flag(版本>=0)
	private $sndUsedDays;	//<uint32_t> 二手顾客使用时间(版本>=0)
	private $sndUsedDays_u;	//<uint8_t> 二手顾客使用时间  flag(版本>=0)
	private $sndHavePhoto;	//<uint32_t> 二手是否实物拍摄 0：没有，1：有(版本>=0)
	private $sndHavePhoto_u;	//<uint8_t> 二手是否实物拍摄  flag(版本>=0)
	private $sndMemo;	//<std::string> 二手备注信息(版本>=0)
	private $sndMemo_u;	//<uint8_t> 二手备注信息  flag(版本>=0)
	private $sndAttach;	//<std::string> 二手包装附件(版本>=0)
	private $sndAttach_u;	//<uint8_t> 二手包装附件  flag(版本>=0)
	private $carAttrInfo;	//<std::string> 爱车宝扩展属性类目信息(版本>=0)
	private $carAttrInfo_u;	//<uint8_t> 爱车宝扩展属性类目信息 flag(版本>=0)
	private $createdTime;	//<uint32_t> (版本>=0)
	private $createdTime_u;	//<uint8_t> (版本>=0)
	private $lastUpdatedTime;	//<uint32_t> (版本>=0)
	private $lastUpdatedTime_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->skuid = 0;	//<uint64_t>
		$this->skuid_u = 0;	//<uint8_t>
		$this->storehouseid = 0;	//<uint32_t>
		$this->storehouseid_u = 0;	//<uint8_t>
		$this->sndSource = 0;	//<uint32_t>
		$this->sndSource_u = 0;	//<uint8_t>
		$this->sndWarrantyTime = 0;	//<uint32_t>
		$this->sndWarrantyTime_u = 0;	//<uint8_t>
		$this->sndClass = 0;	//<uint32_t>
		$this->sndClass_u = 0;	//<uint8_t>
		$this->sndPerformance = 0;	//<uint32_t>
		$this->sndPerformance_u = 0;	//<uint8_t>
		$this->sndUsedDays = 0;	//<uint32_t>
		$this->sndUsedDays_u = 0;	//<uint8_t>
		$this->sndHavePhoto = 0;	//<uint32_t>
		$this->sndHavePhoto_u = 0;	//<uint8_t>
		$this->sndMemo = "";	//<std::string>
		$this->sndMemo_u = 0;	//<uint8_t>
		$this->sndAttach = "";	//<std::string>
		$this->sndAttach_u = 0;	//<uint8_t>
		$this->carAttrInfo = "";	//<std::string>
		$this->carAttrInfo_u = 0;	//<uint8_t>
		$this->createdTime = 0;	//<uint32_t>
		$this->createdTime_u = 0;	//<uint8_t>
		$this->lastUpdatedTime = 0;	//<uint32_t>
		$this->lastUpdatedTime_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewIcsonStockExInfoPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewIcsonStockExInfoPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 版本号, version需要小写
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuid);	//<uint64_t> 
		$bs->pushUint8_t($this->skuid_u);	//<uint8_t> 
		$bs->pushUint32_t($this->storehouseid);	//<uint32_t> 
		$bs->pushUint8_t($this->storehouseid_u);	//<uint8_t> 
		$bs->pushUint32_t($this->sndSource);	//<uint32_t> 二手商品来源
		$bs->pushUint8_t($this->sndSource_u);	//<uint8_t> 二手商品来源  flag
		$bs->pushUint32_t($this->sndWarrantyTime);	//<uint32_t> 二手保修截止时间
		$bs->pushUint8_t($this->sndWarrantyTime_u);	//<uint8_t> 二手保修截止时间  flag
		$bs->pushUint32_t($this->sndClass);	//<uint32_t> 二手商品品相
		$bs->pushUint8_t($this->sndClass_u);	//<uint8_t> 二手商品品相  flag
		$bs->pushUint32_t($this->sndPerformance);	//<uint32_t> 二手商品性能
		$bs->pushUint8_t($this->sndPerformance_u);	//<uint8_t> 二手商品性能  flag
		$bs->pushUint32_t($this->sndUsedDays);	//<uint32_t> 二手顾客使用时间
		$bs->pushUint8_t($this->sndUsedDays_u);	//<uint8_t> 二手顾客使用时间  flag
		$bs->pushUint32_t($this->sndHavePhoto);	//<uint32_t> 二手是否实物拍摄 0：没有，1：有
		$bs->pushUint8_t($this->sndHavePhoto_u);	//<uint8_t> 二手是否实物拍摄  flag
		$bs->pushString($this->sndMemo);	//<std::string> 二手备注信息
		$bs->pushUint8_t($this->sndMemo_u);	//<uint8_t> 二手备注信息  flag
		$bs->pushString($this->sndAttach);	//<std::string> 二手包装附件
		$bs->pushUint8_t($this->sndAttach_u);	//<uint8_t> 二手包装附件  flag
		$bs->pushString($this->carAttrInfo);	//<std::string> 爱车宝扩展属性类目信息
		$bs->pushUint8_t($this->carAttrInfo_u);	//<uint8_t> 爱车宝扩展属性类目信息 flag
		$bs->pushUint32_t($this->createdTime);	//<uint32_t> 
		$bs->pushUint8_t($this->createdTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->lastUpdatedTime);	//<uint32_t> 
		$bs->pushUint8_t($this->lastUpdatedTime_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 版本号, version需要小写
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuid'] = $bs->popUint64_t();	//<uint64_t> 
		$this->_arr_value['skuid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['storehouseid'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['storehouseid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sndSource'] = $bs->popUint32_t();	//<uint32_t> 二手商品来源
		$this->_arr_value['sndSource_u'] = $bs->popUint8_t();	//<uint8_t> 二手商品来源  flag
		$this->_arr_value['sndWarrantyTime'] = $bs->popUint32_t();	//<uint32_t> 二手保修截止时间
		$this->_arr_value['sndWarrantyTime_u'] = $bs->popUint8_t();	//<uint8_t> 二手保修截止时间  flag
		$this->_arr_value['sndClass'] = $bs->popUint32_t();	//<uint32_t> 二手商品品相
		$this->_arr_value['sndClass_u'] = $bs->popUint8_t();	//<uint8_t> 二手商品品相  flag
		$this->_arr_value['sndPerformance'] = $bs->popUint32_t();	//<uint32_t> 二手商品性能
		$this->_arr_value['sndPerformance_u'] = $bs->popUint8_t();	//<uint8_t> 二手商品性能  flag
		$this->_arr_value['sndUsedDays'] = $bs->popUint32_t();	//<uint32_t> 二手顾客使用时间
		$this->_arr_value['sndUsedDays_u'] = $bs->popUint8_t();	//<uint8_t> 二手顾客使用时间  flag
		$this->_arr_value['sndHavePhoto'] = $bs->popUint32_t();	//<uint32_t> 二手是否实物拍摄 0：没有，1：有
		$this->_arr_value['sndHavePhoto_u'] = $bs->popUint8_t();	//<uint8_t> 二手是否实物拍摄  flag
		$this->_arr_value['sndMemo'] = $bs->popString();	//<std::string> 二手备注信息
		$this->_arr_value['sndMemo_u'] = $bs->popUint8_t();	//<uint8_t> 二手备注信息  flag
		$this->_arr_value['sndAttach'] = $bs->popString();	//<std::string> 二手包装附件
		$this->_arr_value['sndAttach_u'] = $bs->popUint8_t();	//<uint8_t> 二手包装附件  flag
		$this->_arr_value['carAttrInfo'] = $bs->popString();	//<std::string> 爱车宝扩展属性类目信息
		$this->_arr_value['carAttrInfo_u'] = $bs->popUint8_t();	//<uint8_t> 爱车宝扩展属性类目信息 flag
		$this->_arr_value['createdTime'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['createdTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdatedTime'] = $bs->popUint32_t();	//<uint32_t> 
		$this->_arr_value['lastUpdatedTime_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.BatchGetMultPriceRule4PromotionReq.java
class ViewMultPriceQueryPo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  版本号   (版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $cooperatorId;	//<uint32_t> 合作伙伴帐号 必填(版本>=0)
	private $cooperatorId_u;	//<uint8_t> (版本>=0)
	private $regionId;	//<uint32_t> 地域 id，选填 用于选仓(版本>=0)
	private $regionId_u;	//<uint8_t> (版本>=0)
	private $specialId;	//<uint32_t> 特殊id，转换后的分站id 选填 用于过滤多价(版本>=0)
	private $specialId_u;	//<uint8_t> (版本>=0)
	private $priceSceneId;	//<std::set<uint64_t> > 场景 id，选填(版本>=0)
	private $priceSceneId_u;	//<uint8_t> (版本>=0)
	private $priceSourceId;	//<std::set<uint64_t> > 来源 id，选填(版本>=0)
	private $priceSourceId_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->cooperatorId = 0;	//<uint32_t>
		$this->cooperatorId_u = 0;	//<uint8_t>
		$this->regionId = 0;	//<uint32_t>
		$this->regionId_u = 0;	//<uint8_t>
		$this->specialId = 0;	//<uint32_t>
		$this->specialId_u = 0;	//<uint8_t>
		$this->priceSceneId = new \stl_set2('uint64_t');	//<std::set<uint64_t> >
		$this->priceSceneId_u = 0;	//<uint8_t>
		$this->priceSourceId = new \stl_set2('uint64_t');	//<std::set<uint64_t> >
		$this->priceSourceId_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewMultPriceQueryPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewMultPriceQueryPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  版本号   
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->cooperatorId);	//<uint32_t> 合作伙伴帐号 必填
		$bs->pushUint8_t($this->cooperatorId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->regionId);	//<uint32_t> 地域 id，选填 用于选仓
		$bs->pushUint8_t($this->regionId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->specialId);	//<uint32_t> 特殊id，转换后的分站id 选填 用于过滤多价
		$bs->pushUint8_t($this->specialId_u);	//<uint8_t> 
		$bs->pushObject($this->priceSceneId,'stl_set');	//<std::set<uint64_t> > 场景 id，选填
		$bs->pushUint8_t($this->priceSceneId_u);	//<uint8_t> 
		$bs->pushObject($this->priceSourceId,'stl_set');	//<std::set<uint64_t> > 来源 id，选填
		$bs->pushUint8_t($this->priceSourceId_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  版本号   
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['cooperatorId'] = $bs->popUint32_t();	//<uint32_t> 合作伙伴帐号 必填
		$this->_arr_value['cooperatorId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['regionId'] = $bs->popUint32_t();	//<uint32_t> 地域 id，选填 用于选仓
		$this->_arr_value['regionId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['specialId'] = $bs->popUint32_t();	//<uint32_t> 特殊id，转换后的分站id 选填 用于过滤多价
		$this->_arr_value['specialId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSceneId'] = $bs->popObject('stl_set<uint64_t>');	//<std::set<uint64_t> > 场景 id，选填
		$this->_arr_value['priceSceneId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSourceId'] = $bs->popObject('stl_set<uint64_t>');	//<std::set<uint64_t> > 来源 id，选填
		$this->_arr_value['priceSourceId_u'] = $bs->popUint8_t();	//<uint8_t> 

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

namespace b2b2c\detailview\po;	//source idl: com.b2b2c.sku.idl.BatchGetIcsonCrossSaleRelationResp.java
class ViewCrossSaleRelationPo{
	private $_arr_value=array();	//数组形式的类
	private $skuId;	//<uint64_t> Skuid，保存时可以不赋值,在接口参数上指定易迅SysNo(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $storehouseId;	//<uint32_t> 统一平台侧仓库Id，发货源(版本>=0)
	private $storehouseId_u;	//<uint8_t> (版本>=0)
	private $salesStoreHouseId;	//<uint32_t> 可销售仓库ID(版本>=0)
	private $salesStoreHouseId_u;	//<uint8_t> (版本>=0)
	private $status;	//<uint8_t> 状态, 0:正常 1：作废(版本>=0)
	private $status_u;	//<uint8_t> (版本>=0)
	private $addTime;	//<uint32_t> 新增时间(版本>=0)
	private $addTime_u;	//<uint8_t> (版本>=0)
	private $lastUpdateTime;	//<uint32_t> 最后修改时间(版本>=0)
	private $lastUpdateTime_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->storehouseId = 0;	//<uint32_t>
		$this->storehouseId_u = 0;	//<uint8_t>
		$this->salesStoreHouseId = 0;	//<uint32_t>
		$this->salesStoreHouseId_u = 0;	//<uint8_t>
		$this->status = 0;	//<uint8_t>
		$this->status_u = 0;	//<uint8_t>
		$this->addTime = 0;	//<uint32_t>
		$this->addTime_u = 0;	//<uint8_t>
		$this->lastUpdateTime = 0;	//<uint32_t>
		$this->lastUpdateTime_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("b2b2c\detailview\po\ViewCrossSaleRelationPo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("b2b2c\detailview\po\ViewCrossSaleRelationPo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint64_t($this->skuId);	//<uint64_t> Skuid，保存时可以不赋值,在接口参数上指定易迅SysNo
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->storehouseId);	//<uint32_t> 统一平台侧仓库Id，发货源
		$bs->pushUint8_t($this->storehouseId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->salesStoreHouseId);	//<uint32_t> 可销售仓库ID
		$bs->pushUint8_t($this->salesStoreHouseId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->status);	//<uint8_t> 状态, 0:正常 1：作废
		$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		$bs->pushUint32_t($this->addTime);	//<uint32_t> 新增时间
		$bs->pushUint8_t($this->addTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->lastUpdateTime);	//<uint32_t> 最后修改时间
		$bs->pushUint8_t($this->lastUpdateTime_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> Skuid，保存时可以不赋值,在接口参数上指定易迅SysNo
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['storehouseId'] = $bs->popUint32_t();	//<uint32_t> 统一平台侧仓库Id，发货源
		$this->_arr_value['storehouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['salesStoreHouseId'] = $bs->popUint32_t();	//<uint32_t> 可销售仓库ID
		$this->_arr_value['salesStoreHouseId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['status'] = $bs->popUint8_t();	//<uint8_t> 状态, 0:正常 1：作废
		$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['addTime'] = $bs->popUint32_t();	//<uint32_t> 新增时间
		$this->_arr_value['addTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['lastUpdateTime'] = $bs->popUint32_t();	//<uint32_t> 最后修改时间
		$this->_arr_value['lastUpdateTime_u'] = $bs->popUint8_t();	//<uint8_t> 

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
