<?php
namespace icson\promotionrestrict\bo;	//source idl: com.icson.multprice.idl.CalcMultPriceResp.java
if (!class_exists('icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo', false)) {
class PromotionRestrictParamInfo_Bo{
	private $_arr_value=array();	//数组形式的类
	private $bussinessId;	//<uint32_t> 涓氬姟Id  澶氫环/淇冮攢(版本>=0)
	private $edm1;	//<uint32_t> edm1,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟,涓�埇涓哄浠�淇冮攢鐨勮鍒橧D(版本>=0)
	private $edm2;	//<uint64_t> edm2,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟(版本>=0)
	private $edm3;	//<std::string> edm3,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟(版本>=0)
	private $num;	//<uint32_t> 鐢熸晥娆℃暟/鍗曞搧鏁伴噺,璋冪敤鏂硅緭鍏�(版本>=0)
	private $isRestrict;	//<uint8_t> 鏄惁琚檺 0鏈檺锛�琚檺(版本>=0)
	private $surplus;	//<uint32_t> 鏈鍙敓鏁堢殑鏈�皬娆℃暟(版本>=0)
	private $threshold;	//<uint32_t> surplus瀵瑰簲鐨勯榾鍊�(版本>=0)
	private $dwDeductTime;	//<uint32_t> 鎵ｅ噺鏃堕棿 鎵ｅ噺鏃惰緭鍑猴紝鍥炴粴鏄緭鍏�(版本>=0)
	private $desc;	//<std::string> 闄愯喘绛栫暐鎻忚堪(版本>=0)

	function __construct(){
		$this->bussinessId = 0;	//<uint32_t>
		$this->edm1 = 0;	//<uint32_t>
		$this->edm2 = 0;	//<uint64_t>
		$this->edm3 = "";	//<std::string>
		$this->num = 0;	//<uint32_t>
		$this->isRestrict = 0;	//<uint8_t>
		$this->surplus = 0;	//<uint32_t>
		$this->threshold = 0;	//<uint32_t>
		$this->dwDeductTime = 0;	//<uint32_t>
		$this->desc = "";	//<std::string>
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
			exit("\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\promotionrestrict\bo\PromotionRestrictParamInfo_Bo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->bussinessId);	//<uint32_t> 涓氬姟Id  澶氫环/淇冮攢
		$bs->pushUint32_t($this->edm1);	//<uint32_t> edm1,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟,涓�埇涓哄浠�淇冮攢鐨勮鍒橧D
		$bs->pushUint64_t($this->edm2);	//<uint64_t> edm2,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟
		$bs->pushString($this->edm3);	//<std::string> edm3,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟
		$bs->pushUint32_t($this->num);	//<uint32_t> 鐢熸晥娆℃暟/鍗曞搧鏁伴噺,璋冪敤鏂硅緭鍏�
		$bs->pushUint8_t($this->isRestrict);	//<uint8_t> 鏄惁琚檺 0鏈檺锛�琚檺
		$bs->pushUint32_t($this->surplus);	//<uint32_t> 鏈鍙敓鏁堢殑鏈�皬娆℃暟
		$bs->pushUint32_t($this->threshold);	//<uint32_t> surplus瀵瑰簲鐨勯榾鍊�
		$bs->pushUint32_t($this->dwDeductTime);	//<uint32_t> 鎵ｅ噺鏃堕棿 鎵ｅ噺鏃惰緭鍑猴紝鍥炴粴鏄緭鍏�
		$bs->pushString($this->desc);	//<std::string> 闄愯喘绛栫暐鎻忚堪
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['bussinessId'] = $bs->popUint32_t();	//<uint32_t> 涓氬姟Id  澶氫环/淇冮攢
		$this->_arr_value['edm1'] = $bs->popUint32_t();	//<uint32_t> edm1,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟,涓�埇涓哄浠�淇冮攢鐨勮鍒橧D
		$this->_arr_value['edm2'] = $bs->popUint64_t();	//<uint64_t> edm2,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟
		$this->_arr_value['edm3'] = $bs->popString();	//<std::string> edm3,璋冪敤鏂硅緭鍏�璋冪敤鏂硅嚜瀹氫箟
		$this->_arr_value['num'] = $bs->popUint32_t();	//<uint32_t> 鐢熸晥娆℃暟/鍗曞搧鏁伴噺,璋冪敤鏂硅緭鍏�
		$this->_arr_value['isRestrict'] = $bs->popUint8_t();	//<uint8_t> 鏄惁琚檺 0鏈檺锛�琚檺
		$this->_arr_value['surplus'] = $bs->popUint32_t();	//<uint32_t> 鏈鍙敓鏁堢殑鏈�皬娆℃暟
		$this->_arr_value['threshold'] = $bs->popUint32_t();	//<uint32_t> surplus瀵瑰簲鐨勯榾鍊�
		$this->_arr_value['dwDeductTime'] = $bs->popUint32_t();	//<uint32_t> 鎵ｅ噺鏃堕棿 鎵ｅ噺鏃惰緭鍑猴紝鍥炴粴鏄緭鍏�
		$this->_arr_value['desc'] = $bs->popString();	//<std::string> 闄愯喘绛栫暐鎻忚堪

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
}

namespace icson\promotion\bo;	//source idl: com.icson.multprice.idl.CalcMultPriceReq.java
if (!class_exists('icson\promotion\bo\SpsItemBo', false)) {
class SpsItemBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  鐗堟湰鍙�(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $itemId;	//<std::string> 鍟嗗搧id锛岃皟鐢ㄦ柟杈撳叆(版本>=0)
	private $itemId_u;	//<uint8_t> (版本>=0)
	private $metaId;	//<uint32_t> 鍟嗗搧鍝佺被id,璋冪敤鏂硅緭鍏�鏈夊氨濉啓锛屽氨鏄槗璁殑灏忕被(版本>=0)
	private $metaId_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint64_t> 鍗栧id,璋冪敤鏂硅緭鍏�浠ュ悗鍙兘瑕佺敤锛岀幇鍦ㄥ彲涓嶅～(版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $brand;	//<uint64_t> 鍝佺墝id,璋冪敤鏂硅緭鍏ワ紝鏈夊氨濉繘鏉ュ搱(版本>=0)
	private $brand_u;	//<uint8_t> (版本>=0)
	private $skuId;	//<uint64_t> SKUID锛屼互鍚庡彲鑳界敤(版本>=0)
	private $skuId_u;	//<uint8_t> (版本>=0)
	private $itemWareHouseid;	//<uint32_t> 鍟嗗搧浠搃d锛岃皟鐢ㄦ柟浼犲叆(版本>=0)
	private $itemWareHouseid_u;	//<uint8_t> (版本>=0)
	private $priceSourceScene;	//<std::set<std::string> > 浠锋牸鏉ユ簮id鍙婂満鏅痠d, 瀛楃涓叉牸寮忎负鏉ユ簮id|鍦烘櫙id(版本>=0)
	private $priceSourceScene_u;	//<uint8_t> (版本>=0)
	private $edmCode;	//<std::set<std::string> > edm浠ｇ爜,璋冪敤鏂硅緭鍏澶氫环鏂板](版本>=0)
	private $edmCode_u;	//<uint8_t> (版本>=0)
	private $actId;	//<std::set<uint32_t> > 娲诲姩id,璋冪敤鏂硅緭鍏ワ紝鏆傛椂涓嶇敤(版本>=0)
	private $actId_u;	//<uint8_t> (版本>=0)
	private $itemPrice;	//<uint32_t> 鍟嗗搧淇冮攢鎵逛环鍓嶄环鏍�n浠跺晢鍝侊紝鍗充负n浠朵箣鍜岋紝杩欓噷娉ㄦ剰锛屽鏋滃湪淇冮攢涔嬪墠鏈夊叾浠栦紭鎯犲噺浠凤紝瑕佷紶鍏ョ殑鏄紭鎯犲悗浠锋牸(版本>=0)
	private $itemPrice_u;	//<uint8_t> (版本>=0)
	private $itemUnitPrice;	//<uint32_t> 鍟嗗搧淇冮攢鎵逛环鍓嶅崟浠�涓嶈�铏戝晢鍝佷欢鏁帮紝璋冪敤鏂硅緭鍏�(版本>=0)
	private $itemUnitPrice_u;	//<uint8_t> (版本>=0)
	private $itemCouponDiscount;	//<uint32_t> 鍒嗘憡鍒板晢鍝佺淮搴︾殑浼樻儬鍒镐紭鎯犻噾棰�璋冪敤鏂硅緭鍏�(版本>=0)
	private $itemCouponDiscount_u;	//<uint8_t> (版本>=0)
	private $itemNum;	//<uint32_t> 鍟嗗搧鏁伴噺,璋冪敤鏂硅緭鍏�(版本>=0)
	private $itemNum_u;	//<uint8_t> (版本>=0)
	private $pkgId;	//<uint32_t> 濂楅id,璋冪敤鏂硅緭鍏�鏈�ソ濉笂 (版本>=0)
	private $pkgId_u;	//<uint8_t> (版本>=0)
	private $itemType;	//<uint32_t> 鍟嗗搧绫诲瀷锛�涓烘櫘閫氬晢鍝侊紝1涓哄椁愯禒鍝佺瓑锛屾爣璇嗘槸鍚︿负濂楅鍟嗗搧鎴栬禒鍝佺瓑锛屾牴鎹晢鍝佺郴缁熺‘瀹氾紝璋冪敤鏂硅緭鍏�涓�畾瑕佸～鍐�(版本>=0)
	private $itemType_u;	//<uint8_t> (版本>=0)
	private $itemCategoryIdList;	//<std::vector<uint64_t> > 鍟嗗搧绫荤洰id Vector,鍐呴儴浣跨敤锛岀洰鍓嶅氨3涓紝澶т腑灏忕被 (版本>=0)
	private $itemCategoryIdList_u;	//<uint8_t> (版本>=0)
	private $itemFullMinusPrice;	//<uint32_t> 婊＄珛鍑�璧犲悗浠锋牸,婊￠�鍒哥殑璁板綍鍦ㄦ壒浠疯矾寰勪笂 (版本>=0)
	private $itemFullMinusPrice_u;	//<uint8_t> (版本>=0)
	private $itemFullMinusDiscount;	//<uint32_t> 婊＄珛鍑�璧犳姌鎵�(版本>=0)
	private $itemFullMinusDiscount_u;	//<uint8_t> (版本>=0)
	private $itemFullAddPrice;	//<uint32_t> 婊″姞浠疯喘鍚庝环鏍�涓�湡涓嶇敤 (版本>=0)
	private $itemFullAddPrice_u;	//<uint8_t> (版本>=0)
	private $itemFullAddDiscount;	//<uint32_t> 婊″姞浠疯喘浼樻儬锛屼竴鏈熶笉鐢�(版本>=0)
	private $itemFullAddDiscount_u;	//<uint8_t> (版本>=0)
	private $spsItemOpPathList;	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> > 鎿嶄綔璺緞鍒楄〃 (版本>=0)
	private $spsItemOpPathList_u;	//<uint8_t> (版本>=0)
	private $itemPromotionPrice;	//<uint32_t> 鍟嗗搧淇冮攢鍚庝环鏍�鎺ュ彛杈撳嚭锛屽氨鏄緭鍑虹殑浼樻儬浠锋牸 (版本>=0)
	private $itemPromotionPrice_u;	//<uint8_t> (版本>=0)
	private $itemPromotionDiscount;	//<uint32_t> 鍟嗗搧淇冮攢浼樻儬,鎺ュ彛杈撳嚭 (版本>=0)
	private $itemPromotionDiscount_u;	//<uint8_t> (版本>=0)
	private $itemMailFree;	//<uint32_t> 璇ュ晢鍝佹槸鍚﹀寘閭紝1涓嶅寘閭紝2鍖呴偖锛屾帴鍙ｈ緭鍑�涓�湡涓嶇 (版本>=0)
	private $itemMailFree_u;	//<uint8_t> (版本>=0)
	private $priceInfoList;	//<std::vector<icson::multprice::bo::CMultPriceBo> > 鍟嗗搧鐨勫浠穕ist [澶氫环浣跨敤]锛岃喘鐗╂祦绋媣ector鍙湁涓�釜鍏冪礌 (版本>=0)
	private $priceInfoList_u;	//<uint8_t> (版本>=0)
	private $ext;	//<std::map<std::string,std::string> > 鎵╁睍瀛楁(版本>=0)
	private $ext_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->itemId = "";	//<std::string>
		$this->itemId_u = 0;	//<uint8_t>
		$this->metaId = 0;	//<uint32_t>
		$this->metaId_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->brand = 0;	//<uint64_t>
		$this->brand_u = 0;	//<uint8_t>
		$this->skuId = 0;	//<uint64_t>
		$this->skuId_u = 0;	//<uint8_t>
		$this->itemWareHouseid = 0;	//<uint32_t>
		$this->itemWareHouseid_u = 0;	//<uint8_t>
		$this->priceSourceScene = new \stl_set2('stl_string');	//<std::set<std::string> >
		$this->priceSourceScene_u = 0;	//<uint8_t>
		$this->edmCode = new \stl_set2('stl_string');	//<std::set<std::string> >
		$this->edmCode_u = 0;	//<uint8_t>
		$this->actId = new \stl_set2('uint32_t');	//<std::set<uint32_t> >
		$this->actId_u = 0;	//<uint8_t>
		$this->itemPrice = 0;	//<uint32_t>
		$this->itemPrice_u = 0;	//<uint8_t>
		$this->itemUnitPrice = 0;	//<uint32_t>
		$this->itemUnitPrice_u = 0;	//<uint8_t>
		$this->itemCouponDiscount = 0;	//<uint32_t>
		$this->itemCouponDiscount_u = 0;	//<uint8_t>
		$this->itemNum = 0;	//<uint32_t>
		$this->itemNum_u = 0;	//<uint8_t>
		$this->pkgId = 0;	//<uint32_t>
		$this->pkgId_u = 0;	//<uint8_t>
		$this->itemType = 0;	//<uint32_t>
		$this->itemType_u = 0;	//<uint8_t>
		$this->itemCategoryIdList = new \stl_vector2('uint64_t');	//<std::vector<uint64_t> >
		$this->itemCategoryIdList_u = 0;	//<uint8_t>
		$this->itemFullMinusPrice = 0;	//<uint32_t>
		$this->itemFullMinusPrice_u = 0;	//<uint8_t>
		$this->itemFullMinusDiscount = 0;	//<uint32_t>
		$this->itemFullMinusDiscount_u = 0;	//<uint8_t>
		$this->itemFullAddPrice = 0;	//<uint32_t>
		$this->itemFullAddPrice_u = 0;	//<uint8_t>
		$this->itemFullAddDiscount = 0;	//<uint32_t>
		$this->itemFullAddDiscount_u = 0;	//<uint8_t>
		$this->spsItemOpPathList = new \stl_vector2('\icson\promotion\bo\SpsItemOpPathBo');	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> >
		$this->spsItemOpPathList_u = 0;	//<uint8_t>
		$this->itemPromotionPrice = 0;	//<uint32_t>
		$this->itemPromotionPrice_u = 0;	//<uint8_t>
		$this->itemPromotionDiscount = 0;	//<uint32_t>
		$this->itemPromotionDiscount_u = 0;	//<uint8_t>
		$this->itemMailFree = 0;	//<uint32_t>
		$this->itemMailFree_u = 0;	//<uint8_t>
		$this->priceInfoList = new \stl_vector2('\icson\multprice\bo\MultPriceBo');	//<std::vector<icson::multprice::bo::CMultPriceBo> >
		$this->priceInfoList_u = 0;	//<uint8_t>
		$this->ext = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->ext_u = 0;	//<uint8_t>
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
			exit("\icson\promotion\bo\SpsItemBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\promotion\bo\SpsItemBo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  鐗堟湰鍙�
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushString($this->itemId);	//<std::string> 鍟嗗搧id锛岃皟鐢ㄦ柟杈撳叆
		$bs->pushUint8_t($this->itemId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->metaId);	//<uint32_t> 鍟嗗搧鍝佺被id,璋冪敤鏂硅緭鍏�鏈夊氨濉啓锛屽氨鏄槗璁殑灏忕被
		$bs->pushUint8_t($this->metaId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 鍗栧id,璋冪敤鏂硅緭鍏�浠ュ悗鍙兘瑕佺敤锛岀幇鍦ㄥ彲涓嶅～
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->brand);	//<uint64_t> 鍝佺墝id,璋冪敤鏂硅緭鍏ワ紝鏈夊氨濉繘鏉ュ搱
		$bs->pushUint8_t($this->brand_u);	//<uint8_t> 
		$bs->pushUint64_t($this->skuId);	//<uint64_t> SKUID锛屼互鍚庡彲鑳界敤
		$bs->pushUint8_t($this->skuId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemWareHouseid);	//<uint32_t> 鍟嗗搧浠搃d锛岃皟鐢ㄦ柟浼犲叆
		$bs->pushUint8_t($this->itemWareHouseid_u);	//<uint8_t> 
		$bs->pushObject($this->priceSourceScene,'stl_set');	//<std::set<std::string> > 浠锋牸鏉ユ簮id鍙婂満鏅痠d, 瀛楃涓叉牸寮忎负鏉ユ簮id|鍦烘櫙id
		$bs->pushUint8_t($this->priceSourceScene_u);	//<uint8_t> 
		$bs->pushObject($this->edmCode,'stl_set');	//<std::set<std::string> > edm浠ｇ爜,璋冪敤鏂硅緭鍏澶氫环鏂板]
		$bs->pushUint8_t($this->edmCode_u);	//<uint8_t> 
		$bs->pushObject($this->actId,'stl_set');	//<std::set<uint32_t> > 娲诲姩id,璋冪敤鏂硅緭鍏ワ紝鏆傛椂涓嶇敤
		$bs->pushUint8_t($this->actId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemPrice);	//<uint32_t> 鍟嗗搧淇冮攢鎵逛环鍓嶄环鏍�n浠跺晢鍝侊紝鍗充负n浠朵箣鍜岋紝杩欓噷娉ㄦ剰锛屽鏋滃湪淇冮攢涔嬪墠鏈夊叾浠栦紭鎯犲噺浠凤紝瑕佷紶鍏ョ殑鏄紭鎯犲悗浠锋牸
		$bs->pushUint8_t($this->itemPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemUnitPrice);	//<uint32_t> 鍟嗗搧淇冮攢鎵逛环鍓嶅崟浠�涓嶈�铏戝晢鍝佷欢鏁帮紝璋冪敤鏂硅緭鍏�
		$bs->pushUint8_t($this->itemUnitPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemCouponDiscount);	//<uint32_t> 鍒嗘憡鍒板晢鍝佺淮搴︾殑浼樻儬鍒镐紭鎯犻噾棰�璋冪敤鏂硅緭鍏�
		$bs->pushUint8_t($this->itemCouponDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemNum);	//<uint32_t> 鍟嗗搧鏁伴噺,璋冪敤鏂硅緭鍏�
		$bs->pushUint8_t($this->itemNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->pkgId);	//<uint32_t> 濂楅id,璋冪敤鏂硅緭鍏�鏈�ソ濉笂 
		$bs->pushUint8_t($this->pkgId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemType);	//<uint32_t> 鍟嗗搧绫诲瀷锛�涓烘櫘閫氬晢鍝侊紝1涓哄椁愯禒鍝佺瓑锛屾爣璇嗘槸鍚︿负濂楅鍟嗗搧鎴栬禒鍝佺瓑锛屾牴鎹晢鍝佺郴缁熺‘瀹氾紝璋冪敤鏂硅緭鍏�涓�畾瑕佸～鍐�
		$bs->pushUint8_t($this->itemType_u);	//<uint8_t> 
		$bs->pushObject($this->itemCategoryIdList,'stl_vector');	//<std::vector<uint64_t> > 鍟嗗搧绫荤洰id Vector,鍐呴儴浣跨敤锛岀洰鍓嶅氨3涓紝澶т腑灏忕被 
		$bs->pushUint8_t($this->itemCategoryIdList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullMinusPrice);	//<uint32_t> 婊＄珛鍑�璧犲悗浠锋牸,婊￠�鍒哥殑璁板綍鍦ㄦ壒浠疯矾寰勪笂 
		$bs->pushUint8_t($this->itemFullMinusPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullMinusDiscount);	//<uint32_t> 婊＄珛鍑�璧犳姌鎵�
		$bs->pushUint8_t($this->itemFullMinusDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullAddPrice);	//<uint32_t> 婊″姞浠疯喘鍚庝环鏍�涓�湡涓嶇敤 
		$bs->pushUint8_t($this->itemFullAddPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemFullAddDiscount);	//<uint32_t> 婊″姞浠疯喘浼樻儬锛屼竴鏈熶笉鐢�
		$bs->pushUint8_t($this->itemFullAddDiscount_u);	//<uint8_t> 
		$bs->pushObject($this->spsItemOpPathList,'stl_vector');	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> > 鎿嶄綔璺緞鍒楄〃 
		$bs->pushUint8_t($this->spsItemOpPathList_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemPromotionPrice);	//<uint32_t> 鍟嗗搧淇冮攢鍚庝环鏍�鎺ュ彛杈撳嚭锛屽氨鏄緭鍑虹殑浼樻儬浠锋牸 
		$bs->pushUint8_t($this->itemPromotionPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemPromotionDiscount);	//<uint32_t> 鍟嗗搧淇冮攢浼樻儬,鎺ュ彛杈撳嚭 
		$bs->pushUint8_t($this->itemPromotionDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->itemMailFree);	//<uint32_t> 璇ュ晢鍝佹槸鍚﹀寘閭紝1涓嶅寘閭紝2鍖呴偖锛屾帴鍙ｈ緭鍑�涓�湡涓嶇 
		$bs->pushUint8_t($this->itemMailFree_u);	//<uint8_t> 
		$bs->pushObject($this->priceInfoList,'stl_vector');	//<std::vector<icson::multprice::bo::CMultPriceBo> > 鍟嗗搧鐨勫浠穕ist [澶氫环浣跨敤]锛岃喘鐗╂祦绋媣ector鍙湁涓�釜鍏冪礌 
		$bs->pushUint8_t($this->priceInfoList_u);	//<uint8_t> 
		$bs->pushObject($this->ext,'stl_map');	//<std::map<std::string,std::string> > 鎵╁睍瀛楁
		$bs->pushUint8_t($this->ext_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  鐗堟湰鍙�
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemId'] = $bs->popString();	//<std::string> 鍟嗗搧id锛岃皟鐢ㄦ柟杈撳叆
		$this->_arr_value['itemId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['metaId'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧鍝佺被id,璋冪敤鏂硅緭鍏�鏈夊氨濉啓锛屽氨鏄槗璁殑灏忕被
		$this->_arr_value['metaId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 鍗栧id,璋冪敤鏂硅緭鍏�浠ュ悗鍙兘瑕佺敤锛岀幇鍦ㄥ彲涓嶅～
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['brand'] = $bs->popUint64_t();	//<uint64_t> 鍝佺墝id,璋冪敤鏂硅緭鍏ワ紝鏈夊氨濉繘鏉ュ搱
		$this->_arr_value['brand_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['skuId'] = $bs->popUint64_t();	//<uint64_t> SKUID锛屼互鍚庡彲鑳界敤
		$this->_arr_value['skuId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemWareHouseid'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧浠搃d锛岃皟鐢ㄦ柟浼犲叆
		$this->_arr_value['itemWareHouseid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSourceScene'] = $bs->popObject('stl_set<stl_string>');	//<std::set<std::string> > 浠锋牸鏉ユ簮id鍙婂満鏅痠d, 瀛楃涓叉牸寮忎负鏉ユ簮id|鍦烘櫙id
		$this->_arr_value['priceSourceScene_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['edmCode'] = $bs->popObject('stl_set<stl_string>');	//<std::set<std::string> > edm浠ｇ爜,璋冪敤鏂硅緭鍏澶氫环鏂板]
		$this->_arr_value['edmCode_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['actId'] = $bs->popObject('stl_set<uint32_t>');	//<std::set<uint32_t> > 娲诲姩id,璋冪敤鏂硅緭鍏ワ紝鏆傛椂涓嶇敤
		$this->_arr_value['actId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPrice'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧淇冮攢鎵逛环鍓嶄环鏍�n浠跺晢鍝侊紝鍗充负n浠朵箣鍜岋紝杩欓噷娉ㄦ剰锛屽鏋滃湪淇冮攢涔嬪墠鏈夊叾浠栦紭鎯犲噺浠凤紝瑕佷紶鍏ョ殑鏄紭鎯犲悗浠锋牸
		$this->_arr_value['itemPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemUnitPrice'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧淇冮攢鎵逛环鍓嶅崟浠�涓嶈�铏戝晢鍝佷欢鏁帮紝璋冪敤鏂硅緭鍏�
		$this->_arr_value['itemUnitPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemCouponDiscount'] = $bs->popUint32_t();	//<uint32_t> 鍒嗘憡鍒板晢鍝佺淮搴︾殑浼樻儬鍒镐紭鎯犻噾棰�璋冪敤鏂硅緭鍏�
		$this->_arr_value['itemCouponDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemNum'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧鏁伴噺,璋冪敤鏂硅緭鍏�
		$this->_arr_value['itemNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pkgId'] = $bs->popUint32_t();	//<uint32_t> 濂楅id,璋冪敤鏂硅緭鍏�鏈�ソ濉笂 
		$this->_arr_value['pkgId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemType'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧绫诲瀷锛�涓烘櫘閫氬晢鍝侊紝1涓哄椁愯禒鍝佺瓑锛屾爣璇嗘槸鍚︿负濂楅鍟嗗搧鎴栬禒鍝佺瓑锛屾牴鎹晢鍝佺郴缁熺‘瀹氾紝璋冪敤鏂硅緭鍏�涓�畾瑕佸～鍐�
		$this->_arr_value['itemType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemCategoryIdList'] = $bs->popObject('stl_vector<uint64_t>');	//<std::vector<uint64_t> > 鍟嗗搧绫荤洰id Vector,鍐呴儴浣跨敤锛岀洰鍓嶅氨3涓紝澶т腑灏忕被 
		$this->_arr_value['itemCategoryIdList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullMinusPrice'] = $bs->popUint32_t();	//<uint32_t> 婊＄珛鍑�璧犲悗浠锋牸,婊￠�鍒哥殑璁板綍鍦ㄦ壒浠疯矾寰勪笂 
		$this->_arr_value['itemFullMinusPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullMinusDiscount'] = $bs->popUint32_t();	//<uint32_t> 婊＄珛鍑�璧犳姌鎵�
		$this->_arr_value['itemFullMinusDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullAddPrice'] = $bs->popUint32_t();	//<uint32_t> 婊″姞浠疯喘鍚庝环鏍�涓�湡涓嶇敤 
		$this->_arr_value['itemFullAddPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemFullAddDiscount'] = $bs->popUint32_t();	//<uint32_t> 婊″姞浠疯喘浼樻儬锛屼竴鏈熶笉鐢�
		$this->_arr_value['itemFullAddDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['spsItemOpPathList'] = $bs->popObject('stl_vector<\icson\promotion\bo\SpsItemOpPathBo>');	//<std::vector<icson::promotion::bo::CSpsItemOpPathBo> > 鎿嶄綔璺緞鍒楄〃 
		$this->_arr_value['spsItemOpPathList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPromotionPrice'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧淇冮攢鍚庝环鏍�鎺ュ彛杈撳嚭锛屽氨鏄緭鍑虹殑浼樻儬浠锋牸 
		$this->_arr_value['itemPromotionPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemPromotionDiscount'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧淇冮攢浼樻儬,鎺ュ彛杈撳嚭 
		$this->_arr_value['itemPromotionDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['itemMailFree'] = $bs->popUint32_t();	//<uint32_t> 璇ュ晢鍝佹槸鍚﹀寘閭紝1涓嶅寘閭紝2鍖呴偖锛屾帴鍙ｈ緭鍑�涓�湡涓嶇 
		$this->_arr_value['itemMailFree_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceInfoList'] = $bs->popObject('stl_vector<\icson\multprice\bo\MultPriceBo>');	//<std::vector<icson::multprice::bo::CMultPriceBo> > 鍟嗗搧鐨勫浠穕ist [澶氫环浣跨敤]锛岃喘鐗╂祦绋媣ector鍙湁涓�釜鍏冪礌 
		$this->_arr_value['priceInfoList_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 鎵╁睍瀛楁
		$this->_arr_value['ext_u'] = $bs->popUint8_t();	//<uint8_t> 

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
}

namespace icson\promotion\bo;	//source idl: com.icson.multprice.idl.SpsItemBo.java
if (!class_exists('icson\promotion\bo\SpsItemOpPathBo', false)) {
class SpsItemOpPathBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t>  鐗堟湰鍙�(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $ruleType;	//<uint32_t> 淇冮攢绫诲瀷:鍙傝�鏂囨。锛屽彲鑳藉悓鏃跺寘鎷浠凤細1鍜屼績閿�細2(版本>=0)
	private $ruleType_u;	//<uint8_t> (版本>=0)
	private $beforePrice;	//<uint32_t> 浼樻儬鍓嶅晢鍝佷环鏍�(版本>=0)
	private $beforePrice_u;	//<uint8_t> (版本>=0)
	private $afterPrice;	//<uint32_t> 浼樻儬鍚庡晢鍝佷环鏍�(版本>=0)
	private $afterPrice_u;	//<uint8_t> (版本>=0)
	private $ruleId;	//<uint32_t> 淇冮攢瑙勫垯ID (版本>=0)
	private $ruleId_u;	//<uint8_t> (版本>=0)
	private $descInfo;	//<std::string> 浼樻儬鎻忚堪淇℃伅 (版本>=0)
	private $descInfo_u;	//<uint8_t> (版本>=0)
	private $discountInfo;	//<std::string> 浼樻儬淇℃伅锛岃褰曢�绉垎涔嬬被鐨�(版本>=0)
	private $discountInfo_u;	//<uint8_t> (版本>=0)
	private $discountType;	//<uint32_t> 浼樻儬淇℃伅绫诲瀷锛�鍑忛噾棰濓紝2鍒竔d锛�鎶樻墸锛�鍟嗗搧id锛�绉垎锛�鎶樻墸 (版本>=0)
	private $discountType_u;	//<uint8_t> (版本>=0)
	private $conditionInfo;	//<std::string> 婊¤冻鏉′欢淇℃伅 (版本>=0)
	private $conditionInfo_u;	//<uint8_t> (版本>=0)
	private $conditionType;	//<uint32_t> 婊¤冻鏉′欢绫诲瀷 0:鏃犳潯浠讹紝1锛氶噾棰濓紝2锛氭暟閲�(版本>=0)
	private $conditionType_u;	//<uint8_t> (版本>=0)
	private $conditionIndex;	//<uint32_t> 婊¤冻鏉′欢姊害涓嬫爣锛岃嚜鍔ㄦ搴﹀垯涓鸿嚜鍔ㄦ鏁�鍟嗚涓嶇敤) (版本>=0)
	private $conditionIndex_u;	//<uint8_t> (版本>=0)
	private $sellerId;	//<uint64_t> 瑙勫垯鍗栧id锛屼互鍚庡彲鑳戒細鐢�涓�湡鏃犵敤 (版本>=0)
	private $sellerId_u;	//<uint8_t> (版本>=0)
	private $priceCoster;	//<uint32_t> 鎴愭湰鍒嗘憡浜�(版本>=0)
	private $priceCoster_u;	//<uint8_t> (版本>=0)
	private $ext;	//<std::map<std::string,std::string> > 鎵╁睍瀛楁(版本>=0)
	private $ext_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->ruleType = 0;	//<uint32_t>
		$this->ruleType_u = 0;	//<uint8_t>
		$this->beforePrice = 0;	//<uint32_t>
		$this->beforePrice_u = 0;	//<uint8_t>
		$this->afterPrice = 0;	//<uint32_t>
		$this->afterPrice_u = 0;	//<uint8_t>
		$this->ruleId = 0;	//<uint32_t>
		$this->ruleId_u = 0;	//<uint8_t>
		$this->descInfo = "";	//<std::string>
		$this->descInfo_u = 0;	//<uint8_t>
		$this->discountInfo = "";	//<std::string>
		$this->discountInfo_u = 0;	//<uint8_t>
		$this->discountType = 0;	//<uint32_t>
		$this->discountType_u = 0;	//<uint8_t>
		$this->conditionInfo = "";	//<std::string>
		$this->conditionInfo_u = 0;	//<uint8_t>
		$this->conditionType = 0;	//<uint32_t>
		$this->conditionType_u = 0;	//<uint8_t>
		$this->conditionIndex = 0;	//<uint32_t>
		$this->conditionIndex_u = 0;	//<uint8_t>
		$this->sellerId = 0;	//<uint64_t>
		$this->sellerId_u = 0;	//<uint8_t>
		$this->priceCoster = 0;	//<uint32_t>
		$this->priceCoster_u = 0;	//<uint8_t>
		$this->ext = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->ext_u = 0;	//<uint8_t>
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
			exit("\icson\promotion\bo\SpsItemOpPathBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\promotion\bo\SpsItemOpPathBo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t>  鐗堟湰鍙�
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleType);	//<uint32_t> 淇冮攢绫诲瀷:鍙傝�鏂囨。锛屽彲鑳藉悓鏃跺寘鎷浠凤細1鍜屼績閿�細2
		$bs->pushUint8_t($this->ruleType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->beforePrice);	//<uint32_t> 浼樻儬鍓嶅晢鍝佷环鏍�
		$bs->pushUint8_t($this->beforePrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->afterPrice);	//<uint32_t> 浼樻儬鍚庡晢鍝佷环鏍�
		$bs->pushUint8_t($this->afterPrice_u);	//<uint8_t> 
		$bs->pushUint32_t($this->ruleId);	//<uint32_t> 淇冮攢瑙勫垯ID 
		$bs->pushUint8_t($this->ruleId_u);	//<uint8_t> 
		$bs->pushString($this->descInfo);	//<std::string> 浼樻儬鎻忚堪淇℃伅 
		$bs->pushUint8_t($this->descInfo_u);	//<uint8_t> 
		$bs->pushString($this->discountInfo);	//<std::string> 浼樻儬淇℃伅锛岃褰曢�绉垎涔嬬被鐨�
		$bs->pushUint8_t($this->discountInfo_u);	//<uint8_t> 
		$bs->pushUint32_t($this->discountType);	//<uint32_t> 浼樻儬淇℃伅绫诲瀷锛�鍑忛噾棰濓紝2鍒竔d锛�鎶樻墸锛�鍟嗗搧id锛�绉垎锛�鎶樻墸 
		$bs->pushUint8_t($this->discountType_u);	//<uint8_t> 
		$bs->pushString($this->conditionInfo);	//<std::string> 婊¤冻鏉′欢淇℃伅 
		$bs->pushUint8_t($this->conditionInfo_u);	//<uint8_t> 
		$bs->pushUint32_t($this->conditionType);	//<uint32_t> 婊¤冻鏉′欢绫诲瀷 0:鏃犳潯浠讹紝1锛氶噾棰濓紝2锛氭暟閲�
		$bs->pushUint8_t($this->conditionType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->conditionIndex);	//<uint32_t> 婊¤冻鏉′欢姊害涓嬫爣锛岃嚜鍔ㄦ搴﹀垯涓鸿嚜鍔ㄦ鏁�鍟嗚涓嶇敤) 
		$bs->pushUint8_t($this->conditionIndex_u);	//<uint8_t> 
		$bs->pushUint64_t($this->sellerId);	//<uint64_t> 瑙勫垯鍗栧id锛屼互鍚庡彲鑳戒細鐢�涓�湡鏃犵敤 
		$bs->pushUint8_t($this->sellerId_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceCoster);	//<uint32_t> 鎴愭湰鍒嗘憡浜�
		$bs->pushUint8_t($this->priceCoster_u);	//<uint8_t> 
		$bs->pushObject($this->ext,'stl_map');	//<std::map<std::string,std::string> > 鎵╁睍瀛楁
		$bs->pushUint8_t($this->ext_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t>  鐗堟湰鍙�
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleType'] = $bs->popUint32_t();	//<uint32_t> 淇冮攢绫诲瀷:鍙傝�鏂囨。锛屽彲鑳藉悓鏃跺寘鎷浠凤細1鍜屼績閿�細2
		$this->_arr_value['ruleType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['beforePrice'] = $bs->popUint32_t();	//<uint32_t> 浼樻儬鍓嶅晢鍝佷环鏍�
		$this->_arr_value['beforePrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['afterPrice'] = $bs->popUint32_t();	//<uint32_t> 浼樻儬鍚庡晢鍝佷环鏍�
		$this->_arr_value['afterPrice_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ruleId'] = $bs->popUint32_t();	//<uint32_t> 淇冮攢瑙勫垯ID 
		$this->_arr_value['ruleId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['descInfo'] = $bs->popString();	//<std::string> 浼樻儬鎻忚堪淇℃伅 
		$this->_arr_value['descInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discountInfo'] = $bs->popString();	//<std::string> 浼樻儬淇℃伅锛岃褰曢�绉垎涔嬬被鐨�
		$this->_arr_value['discountInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['discountType'] = $bs->popUint32_t();	//<uint32_t> 浼樻儬淇℃伅绫诲瀷锛�鍑忛噾棰濓紝2鍒竔d锛�鎶樻墸锛�鍟嗗搧id锛�绉垎锛�鎶樻墸 
		$this->_arr_value['discountType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionInfo'] = $bs->popString();	//<std::string> 婊¤冻鏉′欢淇℃伅 
		$this->_arr_value['conditionInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionType'] = $bs->popUint32_t();	//<uint32_t> 婊¤冻鏉′欢绫诲瀷 0:鏃犳潯浠讹紝1锛氶噾棰濓紝2锛氭暟閲�
		$this->_arr_value['conditionType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['conditionIndex'] = $bs->popUint32_t();	//<uint32_t> 婊¤冻鏉′欢姊害涓嬫爣锛岃嚜鍔ㄦ搴﹀垯涓鸿嚜鍔ㄦ鏁�鍟嗚涓嶇敤) 
		$this->_arr_value['conditionIndex_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sellerId'] = $bs->popUint64_t();	//<uint64_t> 瑙勫垯鍗栧id锛屼互鍚庡彲鑳戒細鐢�涓�湡鏃犵敤 
		$this->_arr_value['sellerId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceCoster'] = $bs->popUint32_t();	//<uint32_t> 鎴愭湰鍒嗘憡浜�
		$this->_arr_value['priceCoster_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 鎵╁睍瀛楁
		$this->_arr_value['ext_u'] = $bs->popUint8_t();	//<uint8_t> 

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
}

namespace icson\multprice\bo;	//source idl: com.icson.multprice.idl.SpsItemBo.java
if (!class_exists('icson\multprice\bo\MultPriceBo', false)) {
class MultPriceBo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint32_t> 鐗堟湰鍙�(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $priceType;	//<uint32_t> 浠锋牸绫诲瀷锛岄鐣欙紝鏆傛椂涓嶇敤 (版本>=0)
	private $priceType_u;	//<uint8_t> (版本>=0)
	private $priceSceneId;	//<uint64_t> 鍦烘櫙 id (版本>=0)
	private $priceSceneId_u;	//<uint8_t> (版本>=0)
	private $priceSourceId;	//<uint64_t> 鏉ユ簮 id (版本>=0)
	private $priceSourceId_u;	//<uint8_t> (版本>=0)
	private $priceName;	//<std::string> 澶氫环瑙勫垯鍚嶇О鎻忚堪锛岄�濉�(版本>=0)
	private $priceName_u;	//<uint8_t> (版本>=0)
	private $priceDesc;	//<std::string> 浠锋牸瑙勫垯鎻忚堪 (版本>=0)
	private $priceDesc_u;	//<uint8_t> (版本>=0)
	private $pricePromotionUrl;	//<std::string> 娲诲姩瑙勫垯url锛屾殏鏃朵笉鐢�(版本>=0)
	private $pricePromotionUrl_u;	//<uint8_t> (版本>=0)
	private $priceBase;	//<uint32_t> 鎵逛环鐨勫熀鍑嗕环绫诲瀷锛屽崟涓晢鍝侊紝棰勭暀 (版本>=0)
	private $priceBase_u;	//<uint8_t> (版本>=0)
	private $priceOpType;	//<uint16_t> 鍟嗗搧淇冮攢澶氫环鐨勪紭鎯犳柟寮忥紝1瀹氫环锛�鍑忎环锛�鎶樻墸 (版本>=0)
	private $priceOpType_u;	//<uint8_t> (版本>=0)
	private $unitPriceOpNum;	//<uint32_t> 鍟嗗搧淇冮攢澶氫环鐨勬搷浣滈噾棰濓紝涓嶈�铏戝晢鍝佹暟閲忥紝濡�8鎶樹紶 98锛屽噺10鍏冧紶 10锛屽畾浠蜂负5鍏冧紶 5 (版本>=0)
	private $unitPriceOpNum_u;	//<uint8_t> (版本>=0)
	private $priceBeforeFavor;	//<uint32_t> 璇ユ鍟嗗搧鐨勪紭鎯犲墠浠锋牸锛屾湁n浠跺晢鍝侊紝鍒欎负n浠舵�鍊�(版本>=0)
	private $priceBeforeFavor_u;	//<uint8_t> (版本>=0)
	private $priceAfterFavor;	//<uint32_t> 璇ユ鍟嗗搧鐨勪紭鎯犲悗浠锋牸锛屾湁n浠跺晢鍝侊紝鍒欎负n浠舵�鍊�(版本>=0)
	private $priceAfterFavor_u;	//<uint8_t> (版本>=0)
	private $priceDiscount;	//<uint32_t> 璇ユ鍟嗗搧鎬讳紭鎯犵殑閲戦锛屽繀濉�(版本>=0)
	private $priceDiscount_u;	//<uint8_t> (版本>=0)
	private $unitPriceBeforeFavor;	//<uint32_t> 鍗曚釜鍟嗗搧浼樻儬鍓嶄环鏍硷紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 (版本>=0)
	private $unitPriceBeforeFavor_u;	//<uint8_t> (版本>=0)
	private $unitPriceAfterFavor;	//<uint32_t> 鍗曚釜鍟嗗搧澶氫环浼樻儬鍚庣殑浠蜂环鏍硷紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 (版本>=0)
	private $unitPriceAfterFavor_u;	//<uint8_t> (版本>=0)
	private $unitPriceDiscount;	//<uint32_t> 鍗曚釜鍟嗗搧澶氫环鐨勪紭鎯犻噾棰濓紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 (版本>=0)
	private $unitPriceDiscount_u;	//<uint8_t> (版本>=0)
	private $multPriceDiscount;	//<uint32_t> 璇ユ鍟嗗搧闈炶妭鑳借ˉ璐寸殑浼樻儬閲戦锛屽繀濉�(版本>=0)
	private $multPriceDiscount_u;	//<uint8_t> (版本>=0)
	private $energySaveDiscount;	//<uint32_t> 璇ユ鍟嗗搧鑺傝兘琛ヨ创鐨勪紭鎯犻噾棰濓紝蹇呭～ (版本>=0)
	private $energySaveDiscount_u;	//<uint8_t> (版本>=0)
	private $energySaveName;	//<std::string> 鑺傝兘琛ヨ创鍚嶇О锛岄�濉�(版本>=0)
	private $energySaveName_u;	//<uint8_t> (版本>=0)
	private $energySaveDesc;	//<std::string> 鑺傝兘琛ヨ创鎻忚堪 (版本>=0)
	private $energySaveDesc_u;	//<uint8_t> (版本>=0)
	private $priceRule;	//<std::string> 浠锋牸瑙勫垯锛岀洰鍓嶄粎闃舵浠蜂娇鐢�(版本>=0)
	private $priceRule_u;	//<uint8_t> (版本>=0)
	private $needNum;	//<uint32_t> 闃舵浠峰樊棰濇暟锛屽嵆宸甔浠讹紝鍙韩鍙楅樁姊鍒欙紝濡傚ぇ浜�锛屽垯鍙敤浜庡睍绀�(版本>=0)
	private $needNum_u;	//<uint8_t> (版本>=0)
	private $priceStartTime;	//<uint32_t> 瑙勫垯寮�鏃堕棿锛屽繀濉�(版本>=0)
	private $priceStartTime_u;	//<uint8_t> (版本>=0)
	private $priceEndTime;	//<uint32_t> 瑙勫垯缁撴潫鏃堕棿锛屽繀濉�(版本>=0)
	private $priceEndTime_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitRule;	//<std::string> 闄愯喘瑙勫垯 (版本>=0)
	private $priceBuyLimitRule_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitFlag;	//<uint32_t> 闄愬埗鏍囧織浣嶏紝瓒呰繃闄愯喘鏃朵负1锛岃〃绀哄晢鍝佷笉鍙喘涔�(版本>=0)
	private $priceBuyLimitFlag_u;	//<uint8_t> (版本>=0)
	private $priceBuyLimitNum;	//<uint32_t> 鍟嗗搧鍓╀綑鐨勯檺璐暟閲�(版本>=0)
	private $priceBuyLimitNum_u;	//<uint8_t> (版本>=0)
	private $priceCoster;	//<uint32_t> 鎴愭湰鍒嗘憡浜�(版本>=0)
	private $priceCoster_u;	//<uint8_t> (版本>=0)
	private $ext;	//<std::map<std::string,std::string> > 鎵╁睍瀛楁(版本>=0)
	private $ext_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->priceType = 0;	//<uint32_t>
		$this->priceType_u = 0;	//<uint8_t>
		$this->priceSceneId = 0;	//<uint64_t>
		$this->priceSceneId_u = 0;	//<uint8_t>
		$this->priceSourceId = 0;	//<uint64_t>
		$this->priceSourceId_u = 0;	//<uint8_t>
		$this->priceName = "";	//<std::string>
		$this->priceName_u = 0;	//<uint8_t>
		$this->priceDesc = "";	//<std::string>
		$this->priceDesc_u = 0;	//<uint8_t>
		$this->pricePromotionUrl = "";	//<std::string>
		$this->pricePromotionUrl_u = 0;	//<uint8_t>
		$this->priceBase = 0;	//<uint32_t>
		$this->priceBase_u = 0;	//<uint8_t>
		$this->priceOpType = 0;	//<uint16_t>
		$this->priceOpType_u = 0;	//<uint8_t>
		$this->unitPriceOpNum = 0;	//<uint32_t>
		$this->unitPriceOpNum_u = 0;	//<uint8_t>
		$this->priceBeforeFavor = 0;	//<uint32_t>
		$this->priceBeforeFavor_u = 0;	//<uint8_t>
		$this->priceAfterFavor = 0;	//<uint32_t>
		$this->priceAfterFavor_u = 0;	//<uint8_t>
		$this->priceDiscount = 0;	//<uint32_t>
		$this->priceDiscount_u = 0;	//<uint8_t>
		$this->unitPriceBeforeFavor = 0;	//<uint32_t>
		$this->unitPriceBeforeFavor_u = 0;	//<uint8_t>
		$this->unitPriceAfterFavor = 0;	//<uint32_t>
		$this->unitPriceAfterFavor_u = 0;	//<uint8_t>
		$this->unitPriceDiscount = 0;	//<uint32_t>
		$this->unitPriceDiscount_u = 0;	//<uint8_t>
		$this->multPriceDiscount = 0;	//<uint32_t>
		$this->multPriceDiscount_u = 0;	//<uint8_t>
		$this->energySaveDiscount = 0;	//<uint32_t>
		$this->energySaveDiscount_u = 0;	//<uint8_t>
		$this->energySaveName = "";	//<std::string>
		$this->energySaveName_u = 0;	//<uint8_t>
		$this->energySaveDesc = "";	//<std::string>
		$this->energySaveDesc_u = 0;	//<uint8_t>
		$this->priceRule = "";	//<std::string>
		$this->priceRule_u = 0;	//<uint8_t>
		$this->needNum = 0;	//<uint32_t>
		$this->needNum_u = 0;	//<uint8_t>
		$this->priceStartTime = 0;	//<uint32_t>
		$this->priceStartTime_u = 0;	//<uint8_t>
		$this->priceEndTime = 0;	//<uint32_t>
		$this->priceEndTime_u = 0;	//<uint8_t>
		$this->priceBuyLimitRule = "";	//<std::string>
		$this->priceBuyLimitRule_u = 0;	//<uint8_t>
		$this->priceBuyLimitFlag = 0;	//<uint32_t>
		$this->priceBuyLimitFlag_u = 0;	//<uint8_t>
		$this->priceBuyLimitNum = 0;	//<uint32_t>
		$this->priceBuyLimitNum_u = 0;	//<uint8_t>
		$this->priceCoster = 0;	//<uint32_t>
		$this->priceCoster_u = 0;	//<uint8_t>
		$this->ext = new \stl_map2('stl_string,stl_string');	//<std::map<std::string,std::string> >
		$this->ext_u = 0;	//<uint8_t>
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
			exit("\icson\multprice\bo\MultPriceBo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\icson\multprice\bo\MultPriceBo\\{$name}：请直接赋值为数组，无需new ***。");
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
		$bs->pushUint32_t($this->version);	//<uint32_t> 鐗堟湰鍙�
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceType);	//<uint32_t> 浠锋牸绫诲瀷锛岄鐣欙紝鏆傛椂涓嶇敤 
		$bs->pushUint8_t($this->priceType_u);	//<uint8_t> 
		$bs->pushUint64_t($this->priceSceneId);	//<uint64_t> 鍦烘櫙 id 
		$bs->pushUint8_t($this->priceSceneId_u);	//<uint8_t> 
		$bs->pushUint64_t($this->priceSourceId);	//<uint64_t> 鏉ユ簮 id 
		$bs->pushUint8_t($this->priceSourceId_u);	//<uint8_t> 
		$bs->pushString($this->priceName);	//<std::string> 澶氫环瑙勫垯鍚嶇О鎻忚堪锛岄�濉�
		$bs->pushUint8_t($this->priceName_u);	//<uint8_t> 
		$bs->pushString($this->priceDesc);	//<std::string> 浠锋牸瑙勫垯鎻忚堪 
		$bs->pushUint8_t($this->priceDesc_u);	//<uint8_t> 
		$bs->pushString($this->pricePromotionUrl);	//<std::string> 娲诲姩瑙勫垯url锛屾殏鏃朵笉鐢�
		$bs->pushUint8_t($this->pricePromotionUrl_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBase);	//<uint32_t> 鎵逛环鐨勫熀鍑嗕环绫诲瀷锛屽崟涓晢鍝侊紝棰勭暀 
		$bs->pushUint8_t($this->priceBase_u);	//<uint8_t> 
		$bs->pushUint16_t($this->priceOpType);	//<uint16_t> 鍟嗗搧淇冮攢澶氫环鐨勪紭鎯犳柟寮忥紝1瀹氫环锛�鍑忎环锛�鎶樻墸 
		$bs->pushUint8_t($this->priceOpType_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceOpNum);	//<uint32_t> 鍟嗗搧淇冮攢澶氫环鐨勬搷浣滈噾棰濓紝涓嶈�铏戝晢鍝佹暟閲忥紝濡�8鎶樹紶 98锛屽噺10鍏冧紶 10锛屽畾浠蜂负5鍏冧紶 5 
		$bs->pushUint8_t($this->unitPriceOpNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBeforeFavor);	//<uint32_t> 璇ユ鍟嗗搧鐨勪紭鎯犲墠浠锋牸锛屾湁n浠跺晢鍝侊紝鍒欎负n浠舵�鍊�
		$bs->pushUint8_t($this->priceBeforeFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceAfterFavor);	//<uint32_t> 璇ユ鍟嗗搧鐨勪紭鎯犲悗浠锋牸锛屾湁n浠跺晢鍝侊紝鍒欎负n浠舵�鍊�
		$bs->pushUint8_t($this->priceAfterFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceDiscount);	//<uint32_t> 璇ユ鍟嗗搧鎬讳紭鎯犵殑閲戦锛屽繀濉�
		$bs->pushUint8_t($this->priceDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceBeforeFavor);	//<uint32_t> 鍗曚釜鍟嗗搧浼樻儬鍓嶄环鏍硷紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 
		$bs->pushUint8_t($this->unitPriceBeforeFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceAfterFavor);	//<uint32_t> 鍗曚釜鍟嗗搧澶氫环浼樻儬鍚庣殑浠蜂环鏍硷紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 
		$bs->pushUint8_t($this->unitPriceAfterFavor_u);	//<uint8_t> 
		$bs->pushUint32_t($this->unitPriceDiscount);	//<uint32_t> 鍗曚釜鍟嗗搧澶氫环鐨勪紭鎯犻噾棰濓紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 
		$bs->pushUint8_t($this->unitPriceDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->multPriceDiscount);	//<uint32_t> 璇ユ鍟嗗搧闈炶妭鑳借ˉ璐寸殑浼樻儬閲戦锛屽繀濉�
		$bs->pushUint8_t($this->multPriceDiscount_u);	//<uint8_t> 
		$bs->pushUint32_t($this->energySaveDiscount);	//<uint32_t> 璇ユ鍟嗗搧鑺傝兘琛ヨ创鐨勪紭鎯犻噾棰濓紝蹇呭～ 
		$bs->pushUint8_t($this->energySaveDiscount_u);	//<uint8_t> 
		$bs->pushString($this->energySaveName);	//<std::string> 鑺傝兘琛ヨ创鍚嶇О锛岄�濉�
		$bs->pushUint8_t($this->energySaveName_u);	//<uint8_t> 
		$bs->pushString($this->energySaveDesc);	//<std::string> 鑺傝兘琛ヨ创鎻忚堪 
		$bs->pushUint8_t($this->energySaveDesc_u);	//<uint8_t> 
		$bs->pushString($this->priceRule);	//<std::string> 浠锋牸瑙勫垯锛岀洰鍓嶄粎闃舵浠蜂娇鐢�
		$bs->pushUint8_t($this->priceRule_u);	//<uint8_t> 
		$bs->pushUint32_t($this->needNum);	//<uint32_t> 闃舵浠峰樊棰濇暟锛屽嵆宸甔浠讹紝鍙韩鍙楅樁姊鍒欙紝濡傚ぇ浜�锛屽垯鍙敤浜庡睍绀�
		$bs->pushUint8_t($this->needNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceStartTime);	//<uint32_t> 瑙勫垯寮�鏃堕棿锛屽繀濉�
		$bs->pushUint8_t($this->priceStartTime_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceEndTime);	//<uint32_t> 瑙勫垯缁撴潫鏃堕棿锛屽繀濉�
		$bs->pushUint8_t($this->priceEndTime_u);	//<uint8_t> 
		$bs->pushString($this->priceBuyLimitRule);	//<std::string> 闄愯喘瑙勫垯 
		$bs->pushUint8_t($this->priceBuyLimitRule_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBuyLimitFlag);	//<uint32_t> 闄愬埗鏍囧織浣嶏紝瓒呰繃闄愯喘鏃朵负1锛岃〃绀哄晢鍝佷笉鍙喘涔�
		$bs->pushUint8_t($this->priceBuyLimitFlag_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceBuyLimitNum);	//<uint32_t> 鍟嗗搧鍓╀綑鐨勯檺璐暟閲�
		$bs->pushUint8_t($this->priceBuyLimitNum_u);	//<uint8_t> 
		$bs->pushUint32_t($this->priceCoster);	//<uint32_t> 鎴愭湰鍒嗘憡浜�
		$bs->pushUint8_t($this->priceCoster_u);	//<uint8_t> 
		$bs->pushObject($this->ext,'stl_map');	//<std::map<std::string,std::string> > 鎵╁睍瀛楁
		$bs->pushUint8_t($this->ext_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint32_t();	//<uint32_t> 鐗堟湰鍙�
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceType'] = $bs->popUint32_t();	//<uint32_t> 浠锋牸绫诲瀷锛岄鐣欙紝鏆傛椂涓嶇敤 
		$this->_arr_value['priceType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSceneId'] = $bs->popUint64_t();	//<uint64_t> 鍦烘櫙 id 
		$this->_arr_value['priceSceneId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceSourceId'] = $bs->popUint64_t();	//<uint64_t> 鏉ユ簮 id 
		$this->_arr_value['priceSourceId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceName'] = $bs->popString();	//<std::string> 澶氫环瑙勫垯鍚嶇О鎻忚堪锛岄�濉�
		$this->_arr_value['priceName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDesc'] = $bs->popString();	//<std::string> 浠锋牸瑙勫垯鎻忚堪 
		$this->_arr_value['priceDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['pricePromotionUrl'] = $bs->popString();	//<std::string> 娲诲姩瑙勫垯url锛屾殏鏃朵笉鐢�
		$this->_arr_value['pricePromotionUrl_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBase'] = $bs->popUint32_t();	//<uint32_t> 鎵逛环鐨勫熀鍑嗕环绫诲瀷锛屽崟涓晢鍝侊紝棰勭暀 
		$this->_arr_value['priceBase_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceOpType'] = $bs->popUint16_t();	//<uint16_t> 鍟嗗搧淇冮攢澶氫环鐨勪紭鎯犳柟寮忥紝1瀹氫环锛�鍑忎环锛�鎶樻墸 
		$this->_arr_value['priceOpType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceOpNum'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧淇冮攢澶氫环鐨勬搷浣滈噾棰濓紝涓嶈�铏戝晢鍝佹暟閲忥紝濡�8鎶樹紶 98锛屽噺10鍏冧紶 10锛屽畾浠蜂负5鍏冧紶 5 
		$this->_arr_value['unitPriceOpNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBeforeFavor'] = $bs->popUint32_t();	//<uint32_t> 璇ユ鍟嗗搧鐨勪紭鎯犲墠浠锋牸锛屾湁n浠跺晢鍝侊紝鍒欎负n浠舵�鍊�
		$this->_arr_value['priceBeforeFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceAfterFavor'] = $bs->popUint32_t();	//<uint32_t> 璇ユ鍟嗗搧鐨勪紭鎯犲悗浠锋牸锛屾湁n浠跺晢鍝侊紝鍒欎负n浠舵�鍊�
		$this->_arr_value['priceAfterFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceDiscount'] = $bs->popUint32_t();	//<uint32_t> 璇ユ鍟嗗搧鎬讳紭鎯犵殑閲戦锛屽繀濉�
		$this->_arr_value['priceDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceBeforeFavor'] = $bs->popUint32_t();	//<uint32_t> 鍗曚釜鍟嗗搧浼樻儬鍓嶄环鏍硷紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 
		$this->_arr_value['unitPriceBeforeFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceAfterFavor'] = $bs->popUint32_t();	//<uint32_t> 鍗曚釜鍟嗗搧澶氫环浼樻儬鍚庣殑浠蜂环鏍硷紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 
		$this->_arr_value['unitPriceAfterFavor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unitPriceDiscount'] = $bs->popUint32_t();	//<uint32_t> 鍗曚釜鍟嗗搧澶氫环鐨勪紭鎯犻噾棰濓紝鍗充笉鑰冭檻鍟嗗搧鏁伴噺 
		$this->_arr_value['unitPriceDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['multPriceDiscount'] = $bs->popUint32_t();	//<uint32_t> 璇ユ鍟嗗搧闈炶妭鑳借ˉ璐寸殑浼樻儬閲戦锛屽繀濉�
		$this->_arr_value['multPriceDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['energySaveDiscount'] = $bs->popUint32_t();	//<uint32_t> 璇ユ鍟嗗搧鑺傝兘琛ヨ创鐨勪紭鎯犻噾棰濓紝蹇呭～ 
		$this->_arr_value['energySaveDiscount_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['energySaveName'] = $bs->popString();	//<std::string> 鑺傝兘琛ヨ创鍚嶇О锛岄�濉�
		$this->_arr_value['energySaveName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['energySaveDesc'] = $bs->popString();	//<std::string> 鑺傝兘琛ヨ创鎻忚堪 
		$this->_arr_value['energySaveDesc_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceRule'] = $bs->popString();	//<std::string> 浠锋牸瑙勫垯锛岀洰鍓嶄粎闃舵浠蜂娇鐢�
		$this->_arr_value['priceRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['needNum'] = $bs->popUint32_t();	//<uint32_t> 闃舵浠峰樊棰濇暟锛屽嵆宸甔浠讹紝鍙韩鍙楅樁姊鍒欙紝濡傚ぇ浜�锛屽垯鍙敤浜庡睍绀�
		$this->_arr_value['needNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceStartTime'] = $bs->popUint32_t();	//<uint32_t> 瑙勫垯寮�鏃堕棿锛屽繀濉�
		$this->_arr_value['priceStartTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceEndTime'] = $bs->popUint32_t();	//<uint32_t> 瑙勫垯缁撴潫鏃堕棿锛屽繀濉�
		$this->_arr_value['priceEndTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitRule'] = $bs->popString();	//<std::string> 闄愯喘瑙勫垯 
		$this->_arr_value['priceBuyLimitRule_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitFlag'] = $bs->popUint32_t();	//<uint32_t> 闄愬埗鏍囧織浣嶏紝瓒呰繃闄愯喘鏃朵负1锛岃〃绀哄晢鍝佷笉鍙喘涔�
		$this->_arr_value['priceBuyLimitFlag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceBuyLimitNum'] = $bs->popUint32_t();	//<uint32_t> 鍟嗗搧鍓╀綑鐨勯檺璐暟閲�
		$this->_arr_value['priceBuyLimitNum_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['priceCoster'] = $bs->popUint32_t();	//<uint32_t> 鎴愭湰鍒嗘憡浜�
		$this->_arr_value['priceCoster_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext'] = $bs->popObject('stl_map<stl_string,stl_string>');	//<std::map<std::string,std::string> > 鎵╁睍瀛楁
		$this->_arr_value['ext_u'] = $bs->popUint8_t();	//<uint8_t> 

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
}
