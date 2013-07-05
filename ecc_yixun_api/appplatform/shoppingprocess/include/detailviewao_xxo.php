<?php

//source idl: com.b2b2c.sku.idl.FetchSkuListInfoResp.java

if (!class_exists('ViewSkuErrorPo',false)) {
class ViewSkuErrorPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 接口返回错误码
		 *
		 * 版本 >= 0
		 */
		var $dwErrorNo; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cErrorNo_u; //uint8_t

		/**
		 * 接口返回外部用错误信息
		 *
		 * 版本 >= 0
		 */
		var $strErrorMsgOutter; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cErrorMsgOutter_u; //uint8_t

		/**
		 * 接口返回内部用错误信息
		 *
		 * 版本 >= 0
		 */
		var $strErrorMsgInner; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cErrorMsgInner_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwErrorNo = 0; // uint32_t
			 $this->cErrorNo_u = 0; // uint8_t
			 $this->strErrorMsgOutter = ""; // std::string
			 $this->cErrorMsgOutter_u = 0; // uint8_t
			 $this->strErrorMsgInner = ""; // std::string
			 $this->cErrorMsgInner_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwErrorNo); // 序列化接口返回错误码 类型为uint32_t
			$bs->pushUint8_t($this->cErrorNo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strErrorMsgOutter); // 序列化接口返回外部用错误信息 类型为std::string
			$bs->pushUint8_t($this->cErrorMsgOutter_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strErrorMsgInner); // 序列化接口返回内部用错误信息 类型为std::string
			$bs->pushUint8_t($this->cErrorMsgInner_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwErrorNo = $bs->popUint32_t(); // 反序列化接口返回错误码 类型为uint32_t
			$this->cErrorNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strErrorMsgOutter = $bs->popString(); // 反序列化接口返回外部用错误信息 类型为std::string
			$this->cErrorMsgOutter_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strErrorMsgInner = $bs->popString(); // 反序列化接口返回内部用错误信息 类型为std::string
			$this->cErrorMsgInner_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.FetchSkuListInfoReq.java

if (!class_exists('ViewSkuFilterPo',false)) {
class ViewSkuFilterPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923, 其中102923为易迅sysno 必填
		 *
		 * 版本 >= 0
		 */
		var $strCommodityId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCommodityId_u; //uint8_t

		/**
		 *  sku销售属性 ，保留
		 *
		 * 版本 >= 0
		 */
		var $strSkuSaleAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuSaleAttr_u; //uint8_t

		/**
		 *  快照版本号，选填 
		 *
		 * 版本 >= 0
		 */
		var $dwSnapversion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSnapversion_u; //uint8_t

		/**
		 * 合作伙伴id, 选填 
		 *
		 * 版本 >= 0
		 */
		var $dwCooperatorId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * 拓展用，保留
		 *
		 * 版本 >= 0
		 */
		var $mapSkuFilterExtent; //std::map<std::string,std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cSkuFilterExtent_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->strCommodityId = ""; // std::string
			 $this->cCommodityId_u = 0; // uint8_t
			 $this->strSkuSaleAttr = ""; // std::string
			 $this->cSkuSaleAttr_u = 0; // uint8_t
			 $this->dwSnapversion = 0; // uint32_t
			 $this->cSnapversion_u = 0; // uint8_t
			 $this->dwCooperatorId = 0; // uint32_t
			 $this->cCooperatorId_u = 0; // uint8_t
			 $this->mapSkuFilterExtent = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cSkuFilterExtent_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCommodityId); // 序列化Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923, 其中102923为易迅sysno 必填 类型为std::string
			$bs->pushUint8_t($this->cCommodityId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuSaleAttr); // 序列化 sku销售属性 ，保留 类型为std::string
			$bs->pushUint8_t($this->cSkuSaleAttr_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSnapversion); // 序列化 快照版本号，选填  类型为uint32_t
			$bs->pushUint8_t($this->cSnapversion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCooperatorId); // 序列化合作伙伴id, 选填  类型为uint32_t
			$bs->pushUint8_t($this->cCooperatorId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapSkuFilterExtent,'stl_map'); // 序列化拓展用，保留 类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cSkuFilterExtent_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCommodityId = $bs->popString(); // 反序列化Commodityid 兼容三个平台commodity 内部做区分 如易迅填：icson-102923, 其中102923为易迅sysno 必填 类型为std::string
			$this->cCommodityId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuSaleAttr = $bs->popString(); // 反序列化 sku销售属性 ，保留 类型为std::string
			$this->cSkuSaleAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSnapversion = $bs->popUint32_t(); // 反序列化 快照版本号，选填  类型为uint32_t
			$this->cSnapversion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCooperatorId = $bs->popUint32_t(); // 反序列化合作伙伴id, 选填  类型为uint32_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapSkuFilterExtent = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化拓展用，保留 类型为std::map<std::string,std::string> 
			$this->cSkuFilterExtent_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.FetchSkuInfo4DetailResp.java

if (!class_exists('ViewSpuPo',false)) {
class ViewSpuPo
{
		/**
		 * 版本号, version要为小写 
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * spuid 
		 *
		 * 版本 >= 0
		 */
		var $dwSpuId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSpuId_u; //uint8_t

		/**
		 * 品类id，商品所属品类 统一类目后
		 *
		 * 版本 >= 0
		 */
		var $dwCategoryId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCategoryId_u; //uint8_t

		/**
		 * spu创建者，实际上是发布这个spu下第一个sku的合作伙伴的id 
		 *
		 * 版本 >= 0
		 */
		var $dwCooperatorId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * spu统一标题  未被spu统一 则为空 以下同
		 *
		 * 版本 >= 0
		 */
		var $strSpuTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuTitle_u; //uint8_t

		/**
		 * spu统一引题 
		 *
		 * 版本 >= 0
		 */
		var $strSpuLeadTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuLeadTitle_u; //uint8_t

		/**
		 * spu统一副题
		 *
		 * 版本 >= 0
		 */
		var $strSpuSubTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuSubTitle_u; //uint8_t

		/**
		 * spu统一促销语
		 *
		 * 版本 >= 0
		 */
		var $strSpuPromotDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuPromotDesc_u; //uint8_t

		/**
		 * spu统一售价，单位分 
		 *
		 * 版本 >= 0
		 */
		var $dwSpuUnifyPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSpuUnifyPrice_u; //uint8_t

		/**
		 * spu统一参考售价，单位分 
		 *
		 * 版本 >= 0
		 */
		var $dwSpuReferPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSpuReferPrice_u; //uint8_t

		/**
		 * spu已选的销售属性项集合，竖线分割的id集合,从小到大排列 例如：2483|2486
		 *
		 * 版本 >= 0
		 */
		var $strSpuSaleAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuSaleAttr_u; //uint8_t

		/**
		 * spuSaleAttr解析后明文例如：颜色|尺码
		 *
		 * 版本 >= 0
		 */
		var $strSpuSaleAttrText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuSaleAttrText_u; //uint8_t

		/**
		 * spu关键属性项值集合，项值以冒号分割，项值和项值之间以竖线分割，项id从小到大排列 例如：123:356|345:567
		 *
		 * 版本 >= 0
		 */
		var $strSpuKeyAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuKeyAttr_u; //uint8_t

		/**
		 * spuKeyAttr解析后明文例如：品牌:三星|货号:35666545
		 *
		 * 版本 >= 0
		 */
		var $strSpuKeyAttrText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuKeyAttrText_u; //uint8_t

		/**
		 * spu公共类目属性串，属于spu，但是不用来区分spu的属性项，只起描述作用，格式定义与spuKeyAttr字段一样
		 *
		 * 版本 >= 0
		 */
		var $strSpuCategoryAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuCategoryAttr_u; //uint8_t

		/**
		 * spuCategoryAttr解析后明文 例如：cpu:i5|memory:2G
		 *
		 * 版本 >= 0
		 */
		var $strSpuCategoryAttrText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuCategoryAttrText_u; //uint8_t

		/**
		 * spu属性标志 参见enum SpuProperty
		 *
		 * 版本 >= 0
		 */
		var $bitsetSpuProperty; //std::bitset<128> 

		/**
		 * 版本 >= 0
		 */
		var $cSpuProperty_u; //uint8_t

		/**
		 * spu状态 参见enmu SpuState
		 *
		 * 版本 >= 0
		 */
		var $ddwSpuState; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSpuState_u; //uint8_t

		/**
		 * 关键字，竖线分割，最长128字节
		 *
		 * 版本 >= 0
		 */
		var $strSpuKeyWord; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuKeyWord_u; //uint8_t

		/**
		 * spu分类，最长64字节
		 *
		 * 版本 >= 0
		 */
		var $strSpuClassify; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuClassify_u; //uint8_t

		/**
		 * spu添加时间，格式0000-00-00 00:00:00
		 *
		 * 版本 >= 0
		 */
		var $strSpuAddTime; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuAddTime_u; //uint8_t

		/**
		 * spu最后修改时间，格式0000-00-00 00:00:00
		 *
		 * 版本 >= 0
		 */
		var $strSpuLastUpdateTime; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpuLastUpdateTime_u; //uint8_t

		/**
		 * 销售属性对应的sku列表 key为sku的销售属性字符串 对易迅商品 key为易迅的'颜色:值|规格:值' 其中值为id 暂返回主子关系的sku列表 不返回spu下的sku列表 无key的则key为‘default’字符串 同key的在vector中排队
		 *
		 * 版本 >= 0
		 */
		var $mapViewSkuPo; //std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > 

		/**
		 * 版本 >= 0
		 */
		var $cViewSkuPo_u; //uint8_t

		/**
		 * 保留字段 
		 *
		 * 版本 >= 0
		 */
		var $strReserve; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReserve_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwSpuId = 0; // uint32_t
			 $this->cSpuId_u = 0; // uint8_t
			 $this->dwCategoryId = 0; // uint32_t
			 $this->cCategoryId_u = 0; // uint8_t
			 $this->dwCooperatorId = 0; // uint32_t
			 $this->cCooperatorId_u = 0; // uint8_t
			 $this->strSpuTitle = ""; // std::string
			 $this->cSpuTitle_u = 0; // uint8_t
			 $this->strSpuLeadTitle = ""; // std::string
			 $this->cSpuLeadTitle_u = 0; // uint8_t
			 $this->strSpuSubTitle = ""; // std::string
			 $this->cSpuSubTitle_u = 0; // uint8_t
			 $this->strSpuPromotDesc = ""; // std::string
			 $this->cSpuPromotDesc_u = 0; // uint8_t
			 $this->dwSpuUnifyPrice = 0; // uint32_t
			 $this->cSpuUnifyPrice_u = 0; // uint8_t
			 $this->dwSpuReferPrice = 0; // uint32_t
			 $this->cSpuReferPrice_u = 0; // uint8_t
			 $this->strSpuSaleAttr = ""; // std::string
			 $this->cSpuSaleAttr_u = 0; // uint8_t
			 $this->strSpuSaleAttrText = ""; // std::string
			 $this->cSpuSaleAttrText_u = 0; // uint8_t
			 $this->strSpuKeyAttr = ""; // std::string
			 $this->cSpuKeyAttr_u = 0; // uint8_t
			 $this->strSpuKeyAttrText = ""; // std::string
			 $this->cSpuKeyAttrText_u = 0; // uint8_t
			 $this->strSpuCategoryAttr = ""; // std::string
			 $this->cSpuCategoryAttr_u = 0; // uint8_t
			 $this->strSpuCategoryAttrText = ""; // std::string
			 $this->cSpuCategoryAttrText_u = 0; // uint8_t
			 $this->bitsetSpuProperty = new stl_bitset('128'); // std::bitset<128> 
			 $this->cSpuProperty_u = 0; // uint8_t
			 $this->ddwSpuState = 0; // uint64_t
			 $this->cSpuState_u = 0; // uint8_t
			 $this->strSpuKeyWord = ""; // std::string
			 $this->cSpuKeyWord_u = 0; // uint8_t
			 $this->strSpuClassify = ""; // std::string
			 $this->cSpuClassify_u = 0; // uint8_t
			 $this->strSpuAddTime = "0000-00-00 00:00:00"; // std::string
			 $this->cSpuAddTime_u = 0; // uint8_t
			 $this->strSpuLastUpdateTime = "0000-00-00 00:00:00"; // std::string
			 $this->cSpuLastUpdateTime_u = 0; // uint8_t
			 $this->mapViewSkuPo = new stl_map('stl_string,stl_vector<ViewSkuPo> '); // std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > 
			 $this->cViewSkuPo_u = 0; // uint8_t
			 $this->strReserve = ""; // std::string
			 $this->cReserve_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version要为小写  类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSpuId); // 序列化spuid  类型为uint32_t
			$bs->pushUint8_t($this->cSpuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCategoryId); // 序列化品类id，商品所属品类 统一类目后 类型为uint32_t
			$bs->pushUint8_t($this->cCategoryId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCooperatorId); // 序列化spu创建者，实际上是发布这个spu下第一个sku的合作伙伴的id  类型为uint32_t
			$bs->pushUint8_t($this->cCooperatorId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuTitle); // 序列化spu统一标题  未被spu统一 则为空 以下同 类型为std::string
			$bs->pushUint8_t($this->cSpuTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuLeadTitle); // 序列化spu统一引题  类型为std::string
			$bs->pushUint8_t($this->cSpuLeadTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuSubTitle); // 序列化spu统一副题 类型为std::string
			$bs->pushUint8_t($this->cSpuSubTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuPromotDesc); // 序列化spu统一促销语 类型为std::string
			$bs->pushUint8_t($this->cSpuPromotDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSpuUnifyPrice); // 序列化spu统一售价，单位分  类型为uint32_t
			$bs->pushUint8_t($this->cSpuUnifyPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSpuReferPrice); // 序列化spu统一参考售价，单位分  类型为uint32_t
			$bs->pushUint8_t($this->cSpuReferPrice_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuSaleAttr); // 序列化spu已选的销售属性项集合，竖线分割的id集合,从小到大排列 例如：2483|2486 类型为std::string
			$bs->pushUint8_t($this->cSpuSaleAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuSaleAttrText); // 序列化spuSaleAttr解析后明文例如：颜色|尺码 类型为std::string
			$bs->pushUint8_t($this->cSpuSaleAttrText_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuKeyAttr); // 序列化spu关键属性项值集合，项值以冒号分割，项值和项值之间以竖线分割，项id从小到大排列 例如：123:356|345:567 类型为std::string
			$bs->pushUint8_t($this->cSpuKeyAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuKeyAttrText); // 序列化spuKeyAttr解析后明文例如：品牌:三星|货号:35666545 类型为std::string
			$bs->pushUint8_t($this->cSpuKeyAttrText_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuCategoryAttr); // 序列化spu公共类目属性串，属于spu，但是不用来区分spu的属性项，只起描述作用，格式定义与spuKeyAttr字段一样 类型为std::string
			$bs->pushUint8_t($this->cSpuCategoryAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuCategoryAttrText); // 序列化spuCategoryAttr解析后明文 例如：cpu:i5|memory:2G 类型为std::string
			$bs->pushUint8_t($this->cSpuCategoryAttrText_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetSpuProperty,'stl_bitset'); // 序列化spu属性标志 参见enum SpuProperty 类型为std::bitset<128> 
			$bs->pushUint8_t($this->cSpuProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSpuState); // 序列化spu状态 参见enmu SpuState 类型为uint64_t
			$bs->pushUint8_t($this->cSpuState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuKeyWord); // 序列化关键字，竖线分割，最长128字节 类型为std::string
			$bs->pushUint8_t($this->cSpuKeyWord_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuClassify); // 序列化spu分类，最长64字节 类型为std::string
			$bs->pushUint8_t($this->cSpuClassify_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuAddTime); // 序列化spu添加时间，格式0000-00-00 00:00:00 类型为std::string
			$bs->pushUint8_t($this->cSpuAddTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpuLastUpdateTime); // 序列化spu最后修改时间，格式0000-00-00 00:00:00 类型为std::string
			$bs->pushUint8_t($this->cSpuLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->mapViewSkuPo,'stl_map'); // 序列化销售属性对应的sku列表 key为sku的销售属性字符串 对易迅商品 key为易迅的'颜色:值|规格:值' 其中值为id 暂返回主子关系的sku列表 不返回spu下的sku列表 无key的则key为‘default’字符串 同key的在vector中排队 类型为std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > 
			$bs->pushUint8_t($this->cViewSkuPo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReserve); // 序列化保留字段  类型为std::string
			$bs->pushUint8_t($this->cReserve_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version要为小写  类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSpuId = $bs->popUint32_t(); // 反序列化spuid  类型为uint32_t
			$this->cSpuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCategoryId = $bs->popUint32_t(); // 反序列化品类id，商品所属品类 统一类目后 类型为uint32_t
			$this->cCategoryId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCooperatorId = $bs->popUint32_t(); // 反序列化spu创建者，实际上是发布这个spu下第一个sku的合作伙伴的id  类型为uint32_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuTitle = $bs->popString(); // 反序列化spu统一标题  未被spu统一 则为空 以下同 类型为std::string
			$this->cSpuTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuLeadTitle = $bs->popString(); // 反序列化spu统一引题  类型为std::string
			$this->cSpuLeadTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuSubTitle = $bs->popString(); // 反序列化spu统一副题 类型为std::string
			$this->cSpuSubTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuPromotDesc = $bs->popString(); // 反序列化spu统一促销语 类型为std::string
			$this->cSpuPromotDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSpuUnifyPrice = $bs->popUint32_t(); // 反序列化spu统一售价，单位分  类型为uint32_t
			$this->cSpuUnifyPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSpuReferPrice = $bs->popUint32_t(); // 反序列化spu统一参考售价，单位分  类型为uint32_t
			$this->cSpuReferPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuSaleAttr = $bs->popString(); // 反序列化spu已选的销售属性项集合，竖线分割的id集合,从小到大排列 例如：2483|2486 类型为std::string
			$this->cSpuSaleAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuSaleAttrText = $bs->popString(); // 反序列化spuSaleAttr解析后明文例如：颜色|尺码 类型为std::string
			$this->cSpuSaleAttrText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuKeyAttr = $bs->popString(); // 反序列化spu关键属性项值集合，项值以冒号分割，项值和项值之间以竖线分割，项id从小到大排列 例如：123:356|345:567 类型为std::string
			$this->cSpuKeyAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuKeyAttrText = $bs->popString(); // 反序列化spuKeyAttr解析后明文例如：品牌:三星|货号:35666545 类型为std::string
			$this->cSpuKeyAttrText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuCategoryAttr = $bs->popString(); // 反序列化spu公共类目属性串，属于spu，但是不用来区分spu的属性项，只起描述作用，格式定义与spuKeyAttr字段一样 类型为std::string
			$this->cSpuCategoryAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuCategoryAttrText = $bs->popString(); // 反序列化spuCategoryAttr解析后明文 例如：cpu:i5|memory:2G 类型为std::string
			$this->cSpuCategoryAttrText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetSpuProperty = $bs->popObject('stl_bitset<128>'); // 反序列化spu属性标志 参见enum SpuProperty 类型为std::bitset<128> 
			$this->cSpuProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSpuState = $bs->popUint64_t(); // 反序列化spu状态 参见enmu SpuState 类型为uint64_t
			$this->cSpuState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuKeyWord = $bs->popString(); // 反序列化关键字，竖线分割，最长128字节 类型为std::string
			$this->cSpuKeyWord_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuClassify = $bs->popString(); // 反序列化spu分类，最长64字节 类型为std::string
			$this->cSpuClassify_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuAddTime = $bs->popString(); // 反序列化spu添加时间，格式0000-00-00 00:00:00 类型为std::string
			$this->cSpuAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpuLastUpdateTime = $bs->popString(); // 反序列化spu最后修改时间，格式0000-00-00 00:00:00 类型为std::string
			$this->cSpuLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->mapViewSkuPo = $bs->popObject('stl_map<stl_string,stl_vector<ViewSkuPo> >'); // 反序列化销售属性对应的sku列表 key为sku的销售属性字符串 对易迅商品 key为易迅的'颜色:值|规格:值' 其中值为id 暂返回主子关系的sku列表 不返回spu下的sku列表 无key的则key为‘default’字符串 同key的在vector中排队 类型为std::map<std::string,std::vector<b2b2c::detailview::po::CViewSkuPo> > 
			$this->cViewSkuPo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReserve = $bs->popString(); // 反序列化保留字段  类型为std::string
			$this->cReserve_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.BatchGetMultPriceRule4PromotionResp.java

if (!class_exists('ViewMultPriceRulesForSkuPo',false)) {
class ViewMultPriceRulesForSkuPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * sku id 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 合作伙伴子帐号 
		 *
		 * 版本 >= 0
		 */
		var $ddwCooperatorSubAccountId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorSubAccountId_u; //uint8_t

		/**
		 * 多价规则Po
		 *
		 * 版本 >= 0
		 */
		var $vecViewMultPriceRulePo4Promotion; //std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> 

		/**
		 * 版本 >= 0
		 */
		var $cViewMultPriceRulePo4Promotion_u; //uint8_t

		/**
		 * sku基本信息 仅供读接口使用
		 *
		 * 版本 >= 0
		 */
		var $oViewSkuPo; //b2b2c::detailview::po::CViewSkuPo

		/**
		 * 版本 >= 0
		 */
		var $cViewSkuPo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->ddwCooperatorSubAccountId = 0; // uint64_t
			 $this->cCooperatorSubAccountId_u = 0; // uint8_t
			 $this->vecViewMultPriceRulePo4Promotion = new stl_vector('ViewMultPriceRulePo4Promotion'); // std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> 
			 $this->cViewMultPriceRulePo4Promotion_u = 0; // uint8_t
			 $this->oViewSkuPo = new ViewSkuPo(); // b2b2c::detailview::po::CViewSkuPo
			 $this->cViewSkuPo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id  类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwCooperatorSubAccountId); // 序列化合作伙伴子帐号  类型为uint64_t
			$bs->pushUint8_t($this->cCooperatorSubAccountId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecViewMultPriceRulePo4Promotion,'stl_vector'); // 序列化多价规则Po 类型为std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> 
			$bs->pushUint8_t($this->cViewMultPriceRulePo4Promotion_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oViewSkuPo,'ViewSkuPo'); // 序列化sku基本信息 仅供读接口使用 类型为b2b2c::detailview::po::CViewSkuPo
			$bs->pushUint8_t($this->cViewSkuPo_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id  类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwCooperatorSubAccountId = $bs->popUint64_t(); // 反序列化合作伙伴子帐号  类型为uint64_t
			$this->cCooperatorSubAccountId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecViewMultPriceRulePo4Promotion = $bs->popObject('stl_vector<ViewMultPriceRulePo4Promotion>'); // 反序列化多价规则Po 类型为std::vector<b2b2c::detailview::po::CViewMultPriceRulePo4Promotion> 
			$this->cViewMultPriceRulePo4Promotion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oViewSkuPo = $bs->popObject('ViewSkuPo'); // 反序列化sku基本信息 仅供读接口使用 类型为b2b2c::detailview::po::CViewSkuPo
			$this->cViewSkuPo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewMultPriceRulesForSkuPo.java

if (!class_exists('ViewMultPriceRulePo4Promotion',false)) {
class ViewMultPriceRulePo4Promotion
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * sku id  
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 地域 id，写入时必填，不关心地域的可以填100000，表示全国
		 *
		 * 版本 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * 场景 id 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSceneId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * 来源 id 必填
		 *
		 * 版本 >= 0
		 */
		var $ddwPriceSourceId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t

		/**
		 * 名称
		 *
		 * 版本 >= 0
		 */
		var $strPriceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceName_u; //uint8_t

		/**
		 * 数量维度,可实现价格阶梯 格式待定
		 *
		 * 版本 >= 0
		 */
		var $strPriceNumber; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceNumber_u; //uint8_t

		/**
		 * 仅读接口,用多价属性
		 *
		 * 版本 >= 0
		 */
		var $bitsetPriceBitProperty; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceBitProperty_u; //uint8_t

		/**
		 * 仅写接口用,price 属性 include bit位,用于设置
		 *
		 * 版本 >= 0
		 */
		var $bitsetPriceBitInclude; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceBitInclude_u; //uint8_t

		/**
		 * 仅写接口用,price 属性 include bit位,用于取消
		 *
		 * 版本 >= 0
		 */
		var $bitsetPriceBitExclude; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceBitExclude_u; //uint8_t

		/**
		 * 多价状态 0-已审核 1-待审核 2-中止 3-删除
		 *
		 * 版本 >= 0
		 */
		var $wPriceState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceState_u; //uint8_t

		/**
		 * 多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价)
		 *
		 * 版本 >= 0
		 */
		var $wPriceShowOperationType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceShowOperationType_u; //uint8_t

		/**
		 * 多价展示操作数
		 *
		 * 版本 >= 0
		 */
		var $dwPriceShowOperationNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceShowOperationNum_u; //uint8_t

		/**
		 * 多价成本分摊比例
		 *
		 * 版本 >= 0
		 */
		var $strPriceCostRatio; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceCostRatio_u; //uint8_t

		/**
		 * timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1
		 *
		 * 版本 >= 0
		 */
		var $wPriceTimeFieldFlag; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceTimeFieldFlag_u; //uint8_t

		/**
		 * 多价时间维度 
		 *
		 * 版本 >= 0
		 */
		var $vecViewTimePricePo4Promotion; //std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> 

		/**
		 * 版本 >= 0
		 */
		var $cViewTimePricePo4Promotion_u; //uint8_t

		/**
		 * 多价规则描述，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDesc_u; //uint8_t

		/**
		 * 用户身份规则，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceUserIdentityRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceUserIdentityRule_u; //uint8_t

		/**
		 * 规则开始时间，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceStartTime_u; //uint8_t

		/**
		 * 规则结束时间，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEndTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEndTime_u; //uint8_t

		/**
		 * 多价下单操作行为类型，必填 定义同priceShowOperationType
		 *
		 * 版本 >= 0
		 */
		var $wPriceDealOperationType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealOperationType_u; //uint8_t

		/**
		 * 多价下单操作数，必填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceDealOperationNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealOperationNum_u; //uint8_t

		/**
		 * 展示价与下单价不同原因，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceDiffReason; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDiffReason_u; //uint8_t

		/**
		 * 下单价描述，选填
		 *
		 * 版本 >= 0
		 */
		var $strPriceDealDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealDesc_u; //uint8_t

		/**
		 * 活动规则描述
		 *
		 * 版本 >= 0
		 */
		var $strPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPricePromotionDesc_u; //uint8_t

		/**
		 * 基准价，必填 0-库存价即仓价 其他待定义
		 *
		 * 版本 >= 0
		 */
		var $dwPriceBase; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBase_u; //uint8_t

		/**
		 * 规则生效次数
		 *
		 * 版本 >= 0
		 */
		var $dwPriceMaxUseNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceMaxUseNum_u; //uint8_t

		/**
		 * 节能补贴价 default为0
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEnergySaving; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEnergySaving_u; //uint8_t

		/**
		 * 是否限购，必填
		 *
		 * 版本 >= 0
		 */
		var $wPriceBuyLimitFlag; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitFlag_u; //uint8_t

		/**
		 * 限购规则，选填 待定义
		 *
		 * 版本 >= 0
		 */
		var $strPriceBuyLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitRule_u; //uint8_t

		/**
		 * 验证类型，选填，default 0
		 *
		 * 版本 >= 0
		 */
		var $wPriceVerifyType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceVerifyType_u; //uint8_t

		/**
		 * 创建者id，必填
		 *
		 * 版本 >= 0
		 */
		var $strPriceCreaterId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceCreaterId_u; //uint8_t

		/**
		 * 适用仓库，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strPriceStoreHouse; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceStoreHouse_u; //uint8_t

		/**
		 * 活动关联id，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strPriceActiveId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceActiveId_u; //uint8_t

		/**
		 * 最后修改人，不填
		 *
		 * 版本 >= 0
		 */
		var $strPriceLastModifiyer; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceLastModifiyer_u; //uint8_t

		/**
		 * 成本分摊人 待定义
		 *
		 * 版本 >= 0
		 */
		var $dwPriceCostResponse; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceCostResponse_u; //uint8_t

		/**
		 * 预告时间时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceForeCastTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceForeCastTime_u; //uint8_t

		/**
		 * 添加时间，不填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceAddTime_u; //uint8_t

		/**
		 * 最后更新时间，不填
		 *
		 * 版本 >= 0
		 */
		var $dwPriceLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceLastUpdateTime_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->ddwPriceSceneId = 0; // uint64_t
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->ddwPriceSourceId = 0; // uint64_t
			 $this->cPriceSourceId_u = 0; // uint8_t
			 $this->strPriceName = ""; // std::string
			 $this->cPriceName_u = 0; // uint8_t
			 $this->strPriceNumber = ""; // std::string
			 $this->cPriceNumber_u = 0; // uint8_t
			 $this->bitsetPriceBitProperty = new stl_bitset('32'); // std::bitset<32> 
			 $this->cPriceBitProperty_u = 0; // uint8_t
			 $this->bitsetPriceBitInclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cPriceBitInclude_u = 0; // uint8_t
			 $this->bitsetPriceBitExclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cPriceBitExclude_u = 0; // uint8_t
			 $this->wPriceState = 0; // uint16_t
			 $this->cPriceState_u = 0; // uint8_t
			 $this->wPriceShowOperationType = 0; // uint16_t
			 $this->cPriceShowOperationType_u = 0; // uint8_t
			 $this->dwPriceShowOperationNum = 0; // uint32_t
			 $this->cPriceShowOperationNum_u = 0; // uint8_t
			 $this->strPriceCostRatio = ""; // std::string
			 $this->cPriceCostRatio_u = 0; // uint8_t
			 $this->wPriceTimeFieldFlag = 0; // uint16_t
			 $this->cPriceTimeFieldFlag_u = 0; // uint8_t
			 $this->vecViewTimePricePo4Promotion = new stl_vector('ViewTimedPricePo4Promotion'); // std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> 
			 $this->cViewTimePricePo4Promotion_u = 0; // uint8_t
			 $this->strPriceDesc = ""; // std::string
			 $this->cPriceDesc_u = 0; // uint8_t
			 $this->strPriceUserIdentityRule = ""; // std::string
			 $this->cPriceUserIdentityRule_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->wPriceDealOperationType = 0; // uint16_t
			 $this->cPriceDealOperationType_u = 0; // uint8_t
			 $this->dwPriceDealOperationNum = 0; // uint32_t
			 $this->cPriceDealOperationNum_u = 0; // uint8_t
			 $this->strPriceDiffReason = ""; // std::string
			 $this->cPriceDiffReason_u = 0; // uint8_t
			 $this->strPriceDealDesc = ""; // std::string
			 $this->cPriceDealDesc_u = 0; // uint8_t
			 $this->strPricePromotionDesc = ""; // std::string
			 $this->cPricePromotionDesc_u = 0; // uint8_t
			 $this->dwPriceBase = 0; // uint32_t
			 $this->cPriceBase_u = 0; // uint8_t
			 $this->dwPriceMaxUseNum = 0; // uint32_t
			 $this->cPriceMaxUseNum_u = 0; // uint8_t
			 $this->dwPriceEnergySaving = 0; // uint32_t
			 $this->cPriceEnergySaving_u = 0; // uint8_t
			 $this->wPriceBuyLimitFlag = 0; // uint16_t
			 $this->cPriceBuyLimitFlag_u = 0; // uint8_t
			 $this->strPriceBuyLimitRule = ""; // std::string
			 $this->cPriceBuyLimitRule_u = 0; // uint8_t
			 $this->wPriceVerifyType = 0; // uint16_t
			 $this->cPriceVerifyType_u = 0; // uint8_t
			 $this->strPriceCreaterId = ""; // std::string
			 $this->cPriceCreaterId_u = 0; // uint8_t
			 $this->strPriceStoreHouse = ""; // std::string
			 $this->cPriceStoreHouse_u = 0; // uint8_t
			 $this->strPriceActiveId = ""; // std::string
			 $this->cPriceActiveId_u = 0; // uint8_t
			 $this->strPriceLastModifiyer = ""; // std::string
			 $this->cPriceLastModifiyer_u = 0; // uint8_t
			 $this->dwPriceCostResponse = 0; // uint32_t
			 $this->cPriceCostResponse_u = 0; // uint8_t
			 $this->dwPriceForeCastTime = 0; // uint32_t
			 $this->cPriceForeCastTime_u = 0; // uint8_t
			 $this->dwPriceAddTime = 0; // uint32_t
			 $this->cPriceAddTime_u = 0; // uint8_t
			 $this->dwPriceLastUpdateTime = 0; // uint32_t
			 $this->cPriceLastUpdateTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化sku id   类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域 id，写入时必填，不关心地域的可以填100000，表示全国 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSceneId); // 序列化场景 id 必填 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwPriceSourceId); // 序列化来源 id 必填 类型为uint64_t
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceName); // 序列化名称 类型为std::string
			$bs->pushUint8_t($this->cPriceName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceNumber); // 序列化数量维度,可实现价格阶梯 格式待定 类型为std::string
			$bs->pushUint8_t($this->cPriceNumber_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetPriceBitProperty,'stl_bitset'); // 序列化仅读接口,用多价属性 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitProperty_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetPriceBitInclude,'stl_bitset'); // 序列化仅写接口用,price 属性 include bit位,用于设置 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitInclude_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetPriceBitExclude,'stl_bitset'); // 序列化仅写接口用,price 属性 include bit位,用于取消 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitExclude_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceState); // 序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$bs->pushUint8_t($this->cPriceState_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceShowOperationType); // 序列化多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价) 类型为uint16_t
			$bs->pushUint8_t($this->cPriceShowOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceShowOperationNum); // 序列化多价展示操作数 类型为uint32_t
			$bs->pushUint8_t($this->cPriceShowOperationNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceCostRatio); // 序列化多价成本分摊比例 类型为std::string
			$bs->pushUint8_t($this->cPriceCostRatio_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceTimeFieldFlag); // 序列化timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1 类型为uint16_t
			$bs->pushUint8_t($this->cPriceTimeFieldFlag_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecViewTimePricePo4Promotion,'stl_vector'); // 序列化多价时间维度  类型为std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> 
			$bs->pushUint8_t($this->cViewTimePricePo4Promotion_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDesc); // 序列化多价规则描述，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceUserIdentityRule); // 序列化用户身份规则，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceUserIdentityRule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // 序列化规则开始时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // 序列化规则结束时间，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceDealOperationType); // 序列化多价下单操作行为类型，必填 定义同priceShowOperationType 类型为uint16_t
			$bs->pushUint8_t($this->cPriceDealOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceDealOperationNum); // 序列化多价下单操作数，必填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceDealOperationNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDiffReason); // 序列化展示价与下单价不同原因，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDiffReason_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDealDesc); // 序列化下单价描述，选填 类型为std::string
			$bs->pushUint8_t($this->cPriceDealDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPricePromotionDesc); // 序列化活动规则描述 类型为std::string
			$bs->pushUint8_t($this->cPricePromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceBase); // 序列化基准价，必填 0-库存价即仓价 其他待定义 类型为uint32_t
			$bs->pushUint8_t($this->cPriceBase_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceMaxUseNum); // 序列化规则生效次数 类型为uint32_t
			$bs->pushUint8_t($this->cPriceMaxUseNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEnergySaving); // 序列化节能补贴价 default为0 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEnergySaving_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceBuyLimitFlag); // 序列化是否限购，必填 类型为uint16_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceBuyLimitRule); // 序列化限购规则，选填 待定义 类型为std::string
			$bs->pushUint8_t($this->cPriceBuyLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceVerifyType); // 序列化验证类型，选填，default 0 类型为uint16_t
			$bs->pushUint8_t($this->cPriceVerifyType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceCreaterId); // 序列化创建者id，必填 类型为std::string
			$bs->pushUint8_t($this->cPriceCreaterId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceStoreHouse); // 序列化适用仓库，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cPriceStoreHouse_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceActiveId); // 序列化活动关联id，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cPriceActiveId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceLastModifiyer); // 序列化最后修改人，不填 类型为std::string
			$bs->pushUint8_t($this->cPriceLastModifiyer_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceCostResponse); // 序列化成本分摊人 待定义 类型为uint32_t
			$bs->pushUint8_t($this->cPriceCostResponse_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceForeCastTime); // 序列化预告时间时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceForeCastTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceAddTime); // 序列化添加时间，不填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceLastUpdateTime); // 序列化最后更新时间，不填 类型为uint32_t
			$bs->pushUint8_t($this->cPriceLastUpdateTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化sku id   类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域 id，写入时必填，不关心地域的可以填100000，表示全国 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSceneId = $bs->popUint64_t(); // 反序列化场景 id 必填 类型为uint64_t
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwPriceSourceId = $bs->popUint64_t(); // 反序列化来源 id 必填 类型为uint64_t
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceName = $bs->popString(); // 反序列化名称 类型为std::string
			$this->cPriceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceNumber = $bs->popString(); // 反序列化数量维度,可实现价格阶梯 格式待定 类型为std::string
			$this->cPriceNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetPriceBitProperty = $bs->popObject('stl_bitset<32>'); // 反序列化仅读接口,用多价属性 类型为std::bitset<32> 
			$this->cPriceBitProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetPriceBitInclude = $bs->popObject('stl_bitset<32>'); // 反序列化仅写接口用,price 属性 include bit位,用于设置 类型为std::bitset<32> 
			$this->cPriceBitInclude_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetPriceBitExclude = $bs->popObject('stl_bitset<32>'); // 反序列化仅写接口用,price 属性 include bit位,用于取消 类型为std::bitset<32> 
			$this->cPriceBitExclude_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceState = $bs->popUint16_t(); // 反序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$this->cPriceState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceShowOperationType = $bs->popUint16_t(); // 反序列化多价展示操作行为类型 0-原价不变 1-打折 2-扣减 3-覆盖(一口价) 类型为uint16_t
			$this->cPriceShowOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceShowOperationNum = $bs->popUint32_t(); // 反序列化多价展示操作数 类型为uint32_t
			$this->cPriceShowOperationNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceCostRatio = $bs->popString(); // 反序列化多价成本分摊比例 类型为std::string
			$this->cPriceCostRatio_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceTimeFieldFlag = $bs->popUint16_t(); // 反序列化timefield开关 如果没有设置且设置了bosstimedfieldPo 则自动设置为1 类型为uint16_t
			$this->cPriceTimeFieldFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecViewTimePricePo4Promotion = $bs->popObject('stl_vector<ViewTimedPricePo4Promotion>'); // 反序列化多价时间维度  类型为std::vector<b2b2c::detailview::po::CViewTimedPricePo4Promotion> 
			$this->cViewTimePricePo4Promotion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDesc = $bs->popString(); // 反序列化多价规则描述，选填 类型为std::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceUserIdentityRule = $bs->popString(); // 反序列化用户身份规则，选填 类型为std::string
			$this->cPriceUserIdentityRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // 反序列化规则开始时间，必填 类型为uint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // 反序列化规则结束时间，必填 类型为uint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceDealOperationType = $bs->popUint16_t(); // 反序列化多价下单操作行为类型，必填 定义同priceShowOperationType 类型为uint16_t
			$this->cPriceDealOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceDealOperationNum = $bs->popUint32_t(); // 反序列化多价下单操作数，必填 类型为uint32_t
			$this->cPriceDealOperationNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDiffReason = $bs->popString(); // 反序列化展示价与下单价不同原因，选填 类型为std::string
			$this->cPriceDiffReason_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDealDesc = $bs->popString(); // 反序列化下单价描述，选填 类型为std::string
			$this->cPriceDealDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPricePromotionDesc = $bs->popString(); // 反序列化活动规则描述 类型为std::string
			$this->cPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceBase = $bs->popUint32_t(); // 反序列化基准价，必填 0-库存价即仓价 其他待定义 类型为uint32_t
			$this->cPriceBase_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceMaxUseNum = $bs->popUint32_t(); // 反序列化规则生效次数 类型为uint32_t
			$this->cPriceMaxUseNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEnergySaving = $bs->popUint32_t(); // 反序列化节能补贴价 default为0 类型为uint32_t
			$this->cPriceEnergySaving_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceBuyLimitFlag = $bs->popUint16_t(); // 反序列化是否限购，必填 类型为uint16_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则，选填 待定义 类型为std::string
			$this->cPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceVerifyType = $bs->popUint16_t(); // 反序列化验证类型，选填，default 0 类型为uint16_t
			$this->cPriceVerifyType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceCreaterId = $bs->popString(); // 反序列化创建者id，必填 类型为std::string
			$this->cPriceCreaterId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceStoreHouse = $bs->popString(); // 反序列化适用仓库，格式待定义 类型为std::string
			$this->cPriceStoreHouse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceActiveId = $bs->popString(); // 反序列化活动关联id，格式待定义 类型为std::string
			$this->cPriceActiveId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceLastModifiyer = $bs->popString(); // 反序列化最后修改人，不填 类型为std::string
			$this->cPriceLastModifiyer_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceCostResponse = $bs->popUint32_t(); // 反序列化成本分摊人 待定义 类型为uint32_t
			$this->cPriceCostResponse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceForeCastTime = $bs->popUint32_t(); // 反序列化预告时间时间 类型为uint32_t
			$this->cPriceForeCastTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceAddTime = $bs->popUint32_t(); // 反序列化添加时间，不填 类型为uint32_t
			$this->cPriceAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceLastUpdateTime = $bs->popUint32_t(); // 反序列化最后更新时间，不填 类型为uint32_t
			$this->cPriceLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewMultPriceRulePo4Promotion.java

if (!class_exists('ViewTimedPricePo4Promotion',false)) {
class ViewTimedPricePo4Promotion
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO:
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceIndex; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceIndex_u; //uint8_t

		/**
		 * 多价状态 0-已审核 1-待审核 2-中止 3-删除
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceState_u; //uint8_t

		/**
		 *  规则名称 支持64个字符
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceName_u; //uint8_t

		/**
		 *  timedPrice 次数,可不填，default为1次
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceCount; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCount_u; //uint8_t

		/**
		 *  timedPrice 持续时间 单位s，必填 由结束时间-开始时间 
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceLastLong; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceLastLong_u; //uint8_t

		/**
		 *  timedPrice 开始时间 必填
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceStartTime_u; //uint8_t

		/**
		 *  timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceOperationType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceOperationType_u; //uint8_t

		/**
		 *  timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceOperationNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceOperationNum_u; //uint8_t

		/**
		 *  timedPrice 属性 仅用于读接口
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceProperty; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceProperty_u; //uint8_t

		/**
		 * 属性 include bit位 仅用于写接口 设置属性
		 *
		 * 版本 >= 0
		 */
		var $bitsetTimedPriceBitInclude; //std::bitset<32> 

		/**
		 * 属性 include bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cTimedPriceBitInclude_u; //uint8_t

		/**
		 * 属性 exclude bit位 仅用于写接口 取消属性
		 *
		 * 版本 >= 0
		 */
		var $bitsetTimePriceBitExclude; //std::bitset<32> 

		/**
		 * 属性 exclude bit位 flag
		 *
		 * 版本 >= 0
		 */
		var $cTimePriceBitExclude_u; //uint8_t

		/**
		 *  timedPrice 自定义促销规则，暂不填
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceCustomerPromotionRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCustomerPromotionRule_u; //uint8_t

		/**
		 *  timedPrice 价格基准类型，必填
		 *
		 * 版本 >= 0
		 */
		var $wTimedPriceBasePriceType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceBasePriceType_u; //uint8_t

		/**
		 *  促销语描述，最大支持120个字(字符) 选填
		 *
		 * 版本 >= 0
		 */
		var $strTimedPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPricePromotionDesc_u; //uint8_t

		/**
		 * 规则生效次数
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceMaxUseNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceMaxUseNum_u; //uint8_t

		/**
		 * 适用仓库，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceStoreHouse; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceStoreHouse_u; //uint8_t

		/**
		 * 活动关联id，格式待定义
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceActiveId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceActiveId_u; //uint8_t

		/**
		 * 成本分摊人 待定义
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceCostResponse; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceCostResponse_u; //uint8_t

		/**
		 * 预告时间时间
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceForeCastTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceForeCastTime_u; //uint8_t

		/**
		 * 限购规则
		 *
		 * 版本 >= 0
		 */
		var $strTimedPriceBuyLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceBuyLimitRule_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->wTimedPriceIndex = 0; // uint16_t
			 $this->cTimedPriceIndex_u = 0; // uint8_t
			 $this->wTimedPriceState = 0; // uint16_t
			 $this->cTimedPriceState_u = 0; // uint8_t
			 $this->strTimedPriceName = ""; // std::string
			 $this->cTimedPriceName_u = 0; // uint8_t
			 $this->wTimedPriceCount = 0; // uint16_t
			 $this->cTimedPriceCount_u = 0; // uint8_t
			 $this->dwTimedPriceLastLong = 0; // uint32_t
			 $this->cTimedPriceLastLong_u = 0; // uint8_t
			 $this->dwTimedPriceStartTime = 0; // uint32_t
			 $this->cTimedPriceStartTime_u = 0; // uint8_t
			 $this->wTimedPriceOperationType = 0; // uint16_t
			 $this->cTimedPriceOperationType_u = 0; // uint8_t
			 $this->dwTimedPriceOperationNum = 0; // uint32_t
			 $this->cTimedPriceOperationNum_u = 0; // uint8_t
			 $this->dwTimedPriceProperty = 0; // uint32_t
			 $this->cTimedPriceProperty_u = 0; // uint8_t
			 $this->bitsetTimedPriceBitInclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cTimedPriceBitInclude_u = 0; // uint8_t
			 $this->bitsetTimePriceBitExclude = new stl_bitset('32'); // std::bitset<32> 
			 $this->cTimePriceBitExclude_u = 0; // uint8_t
			 $this->strTimedPriceCustomerPromotionRule = ""; // std::string
			 $this->cTimedPriceCustomerPromotionRule_u = 0; // uint8_t
			 $this->wTimedPriceBasePriceType = 0; // uint16_t
			 $this->cTimedPriceBasePriceType_u = 0; // uint8_t
			 $this->strTimedPricePromotionDesc = ""; // std::string
			 $this->cTimedPricePromotionDesc_u = 0; // uint8_t
			 $this->dwTimedPriceMaxUseNum = 0; // uint32_t
			 $this->cTimedPriceMaxUseNum_u = 0; // uint8_t
			 $this->strTimedPriceStoreHouse = ""; // std::string
			 $this->cTimedPriceStoreHouse_u = 0; // uint8_t
			 $this->strTimedPriceActiveId = ""; // std::string
			 $this->cTimedPriceActiveId_u = 0; // uint8_t
			 $this->dwTimedPriceCostResponse = 0; // uint32_t
			 $this->cTimedPriceCostResponse_u = 0; // uint8_t
			 $this->dwTimedPriceForeCastTime = 0; // uint32_t
			 $this->cTimedPriceForeCastTime_u = 0; // uint8_t
			 $this->strTimedPriceBuyLimitRule = ""; // std::string
			 $this->cTimedPriceBuyLimitRule_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceIndex); // 序列化 timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO: 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceIndex_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceState); // 序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceName); // 序列化 规则名称 支持64个字符 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceName_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceCount); // 序列化 timedPrice 次数,可不填，default为1次 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceCount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceLastLong); // 序列化 timedPrice 持续时间 单位s，必填 由结束时间-开始时间  类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceLastLong_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceStartTime); // 序列化 timedPrice 开始时间 必填 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceOperationType); // 序列化 timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceOperationType_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceOperationNum); // 序列化 timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceOperationNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceProperty); // 序列化 timedPrice 属性 仅用于读接口 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceProperty_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetTimedPriceBitInclude,'stl_bitset'); // 序列化属性 include bit位 仅用于写接口 设置属性 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cTimedPriceBitInclude_u); // 序列化属性 include bit位 flag 类型为uint8_t
			$bs->pushObject($this->bitsetTimePriceBitExclude,'stl_bitset'); // 序列化属性 exclude bit位 仅用于写接口 取消属性 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cTimePriceBitExclude_u); // 序列化属性 exclude bit位 flag 类型为uint8_t
			$bs->pushString($this->strTimedPriceCustomerPromotionRule); // 序列化 timedPrice 自定义促销规则，暂不填 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceCustomerPromotionRule_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wTimedPriceBasePriceType); // 序列化 timedPrice 价格基准类型，必填 类型为uint16_t
			$bs->pushUint8_t($this->cTimedPriceBasePriceType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPricePromotionDesc); // 序列化 促销语描述，最大支持120个字(字符) 选填 类型为std::string
			$bs->pushUint8_t($this->cTimedPricePromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceMaxUseNum); // 序列化规则生效次数 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceMaxUseNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceStoreHouse); // 序列化适用仓库，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceStoreHouse_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceActiveId); // 序列化活动关联id，格式待定义 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceActiveId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceCostResponse); // 序列化成本分摊人 待定义 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceCostResponse_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceForeCastTime); // 序列化预告时间时间 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceForeCastTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPriceBuyLimitRule); // 序列化限购规则 类型为std::string
			$bs->pushUint8_t($this->cTimedPriceBuyLimitRule_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceIndex = $bs->popUint16_t(); // 反序列化 timedPrice index 合法值为1-10，最大支持10个timefield的设置 其中coss最多5个(1-5)，用户5个 10个不排序 TODO: 类型为uint16_t
			$this->cTimedPriceIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceState = $bs->popUint16_t(); // 反序列化多价状态 0-已审核 1-待审核 2-中止 3-删除 类型为uint16_t
			$this->cTimedPriceState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceName = $bs->popString(); // 反序列化 规则名称 支持64个字符 类型为std::string
			$this->cTimedPriceName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceCount = $bs->popUint16_t(); // 反序列化 timedPrice 次数,可不填，default为1次 类型为uint16_t
			$this->cTimedPriceCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceLastLong = $bs->popUint32_t(); // 反序列化 timedPrice 持续时间 单位s，必填 由结束时间-开始时间  类型为uint32_t
			$this->cTimedPriceLastLong_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceStartTime = $bs->popUint32_t(); // 反序列化 timedPrice 开始时间 必填 类型为uint32_t
			$this->cTimedPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceOperationType = $bs->popUint16_t(); // 反序列化 timedPrice 价格操作类型，打折(精确度为10000) 扣减 覆盖 原价不变等，必填 类型为uint16_t
			$this->cTimedPriceOperationType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceOperationNum = $bs->popUint32_t(); // 反序列化 timedPrice 操作数 如操作类型为打折 此对应具体多少折扣 为价格是 单位分 必填 类型为uint32_t
			$this->cTimedPriceOperationNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceProperty = $bs->popUint32_t(); // 反序列化 timedPrice 属性 仅用于读接口 类型为uint32_t
			$this->cTimedPriceProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetTimedPriceBitInclude = $bs->popObject('stl_bitset<32>'); // 反序列化属性 include bit位 仅用于写接口 设置属性 类型为std::bitset<32> 
			$this->cTimedPriceBitInclude_u = $bs->popUint8_t(); // 反序列化属性 include bit位 flag 类型为uint8_t
			$this->bitsetTimePriceBitExclude = $bs->popObject('stl_bitset<32>'); // 反序列化属性 exclude bit位 仅用于写接口 取消属性 类型为std::bitset<32> 
			$this->cTimePriceBitExclude_u = $bs->popUint8_t(); // 反序列化属性 exclude bit位 flag 类型为uint8_t
			$this->strTimedPriceCustomerPromotionRule = $bs->popString(); // 反序列化 timedPrice 自定义促销规则，暂不填 类型为std::string
			$this->cTimedPriceCustomerPromotionRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wTimedPriceBasePriceType = $bs->popUint16_t(); // 反序列化 timedPrice 价格基准类型，必填 类型为uint16_t
			$this->cTimedPriceBasePriceType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPricePromotionDesc = $bs->popString(); // 反序列化 促销语描述，最大支持120个字(字符) 选填 类型为std::string
			$this->cTimedPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceMaxUseNum = $bs->popUint32_t(); // 反序列化规则生效次数 类型为uint32_t
			$this->cTimedPriceMaxUseNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceStoreHouse = $bs->popString(); // 反序列化适用仓库，格式待定义 类型为std::string
			$this->cTimedPriceStoreHouse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceActiveId = $bs->popString(); // 反序列化活动关联id，格式待定义 类型为std::string
			$this->cTimedPriceActiveId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceCostResponse = $bs->popUint32_t(); // 反序列化成本分摊人 待定义 类型为uint32_t
			$this->cTimedPriceCostResponse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceForeCastTime = $bs->popUint32_t(); // 反序列化预告时间时间 类型为uint32_t
			$this->cTimedPriceForeCastTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则 类型为std::string
			$this->cTimedPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewMultPriceRulesForSkuPo.java

if (!class_exists('ViewSkuPo',false)) {
class ViewSkuPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * skuid,网购侧唯一
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 商品类型 如：正常商品 二手商品等 参见enum SkuType
		 *
		 * 版本 >= 0
		 */
		var $dwSkuType; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuType_u; //uint8_t

		/**
		 * 请求的SKUID 例如：入参skuid为A，由于某种原因A被迁移变更或替换为B，则返回的数据中无A的sku，则在B的sku信息中这个字段被设置为A
		 *
		 * 版本 >= 0
		 */
		var $ddwInputSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cInputSkuId_u; //uint8_t

		/**
		 * 合作伙伴ID 主号+子号  
		 *
		 * 版本 >= 0
		 */
		var $ddwCooperatorSubAccountId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorSubAccountId_u; //uint8_t

		/**
		 * ItemID,目前的itemId实际上表示主子商品的组id
		 *
		 * 版本 >= 0
		 */
		var $ddwItemId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cItemId_u; //uint8_t

		/**
		 * ssuid 最小搜索单元id
		 *
		 * 版本 >= 0
		 */
		var $ddwSsuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSsuId_u; //uint8_t

		/**
		 * 供应商Sku编码 实际上对应易迅商品ID
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorSkuCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorSkuCode_u; //uint8_t

		/**
		 * 生产商条形码  
		 *
		 * 版本 >= 0
		 */
		var $strProducerBarCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProducerBarCode_u; //uint8_t

		/**
		 * 国际通行条形码  
		 *
		 * 版本 >= 0
		 */
		var $strSkuBarCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuBarCode_u; //uint8_t

		/**
		 * Sku标题  
		 *
		 * 版本 >= 0
		 */
		var $strSkuTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuTitle_u; //uint8_t

		/**
		 * Sku引题  
		 *
		 * 版本 >= 0
		 */
		var $strSkuLeadTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuLeadTitle_u; //uint8_t

		/**
		 * Sku副题  
		 *
		 * 版本 >= 0
		 */
		var $strSkuSubTitle; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuSubTitle_u; //uint8_t

		/**
		 * Sku促销语  
		 *
		 * 版本 >= 0
		 */
		var $strSkuPromotDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuPromotDesc_u; //uint8_t

		/**
		 * Sku销售属性串  
		 *
		 * 版本 >= 0
		 */
		var $strSkuSaleAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuSaleAttr_u; //uint8_t

		/**
		 * sku销售属性明文
		 *
		 * 版本 >= 0
		 */
		var $strSkuSaleAttrText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuSaleAttrText_u; //uint8_t

		/**
		 * Sku销售属性串描述 为销售属性做额外解析 
		 *
		 * 版本 >= 0
		 */
		var $strSkuSaleAttrDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuSaleAttrDesc_u; //uint8_t

		/**
		 * Sku参考价格 即市场价,精确到分  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuReferPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuReferPrice_u; //uint8_t

		/**
		 * Sku属性标志 参见enum SkuProperty(二手商品属性位废弃)  
		 *
		 * 版本 >= 0
		 */
		var $bitsetSkuProperty; //std::bitset<128> 

		/**
		 * 版本 >= 0
		 */
		var $cSkuProperty_u; //uint8_t

		/**
		 * Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		 *
		 * 版本 >= 0
		 */
		var $cSkuState; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuState_u; //uint8_t

		/**
		 * Sku 重量 克  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuWeight; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuWeight_u; //uint8_t

		/**
		 * Sku 体积 立方厘米  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuVolume; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuVolume_u; //uint8_t

		/**
		 * Sku 类目属性串  
		 *
		 * 版本 >= 0
		 */
		var $strSkuCategoryAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuCategoryAttr_u; //uint8_t

		/**
		 * Sku 类目属性串明文  
		 *
		 * 版本 >= 0
		 */
		var $strSkuCategoryAttrText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuCategoryAttrText_u; //uint8_t

		/**
		 * Sku 自定义属性
		 *
		 * 版本 >= 0
		 */
		var $strSkuCustomizeAttr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuCustomizeAttr_u; //uint8_t

		/**
		 * Sku 自定义属性 明文 
		 *
		 * 版本 >= 0
		 */
		var $strSkuCustomizeAttrText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuCustomizeAttrText_u; //uint8_t

		/**
		 * Sku 关键词 可以有多个 
		 *
		 * 版本 >= 0
		 */
		var $strSkukeyWord; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkukeyWord_u; //uint8_t

		/**
		 * Sku 分类  
		 *
		 * 版本 >= 0
		 */
		var $strSkuClassify; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuClassify_u; //uint8_t

		/**
		 * Sku 税率  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuVatRate; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuVatRate_u; //uint8_t

		/**
		 * Sku 当前快照版本  
		 *
		 * 版本 >= 0
		 */
		var $wSkuSnapVersion; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuSnapVersion_u; //uint8_t

		/**
		 * Sku 购买限制 0 -- 无限制  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuBuyLimit; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuBuyLimit_u; //uint8_t

		/**
		 * Sku 最后上架时间  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuLastUpTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuLastUpTime_u; //uint8_t

		/**
		 * Sku 最后下架时间  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuLastDownTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuLastDownTime_u; //uint8_t

		/**
		 * Sku 添加时间  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuAddTime_u; //uint8_t

		/**
		 * Sku 最后快照生成时间  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuLastSnapTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuLastSnapTime_u; //uint8_t

		/**
		 * Sku 最后修改时间  
		 *
		 * 版本 >= 0
		 */
		var $dwSkuLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuLastUpdateTime_u; //uint8_t

		/**
		 * 主图最后更新时间 可以拼接在图片链接后面 用来强制浏览器拉取新图片
		 *
		 * 版本 >= 0
		 */
		var $dwMainLogoLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cMainLogoLastUpdateTime_u; //uint8_t

		/**
		 * 尺码表Id 保留
		 *
		 * 版本 >= 0
		 */
		var $dwSkuSizeTableId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuSizeTableId_u; //uint8_t

		/**
		 * 易迅商品信息
		 *
		 * 版本 >= 0
		 */
		var $oIcsonInfoPo; //b2b2c::detailview::po::CIcsonInfoPo

		/**
		 * 版本 >= 0
		 */
		var $cIcsonInfoPo_u; //uint8_t

		/**
		 * 一个Sku所对应的库存信息 即分仓信息 
		 *
		 * 版本 >= 0
		 */
		var $vecViewStockPo; //std::vector<b2b2c::detailview::po::CViewStockPo> 

		/**
		 * 版本 >= 0
		 */
		var $cViewStockPo_u; //uint8_t

		/**
		 * Sku主图Po 里面有主图url及图片类型等 
		 *
		 * 版本 >= 0
		 */
		var $oViewSkuPicturePo; //b2b2c::detailview::po::CViewSkuPicturePo

		/**
		 * 版本 >= 0
		 */
		var $cViewSkuPicturePo_u; //uint8_t

		/**
		 * 该sku所属合作伙伴基本信息  
		 *
		 * 版本 >= 0
		 */
		var $oViewCooperatorBasePo; //b2b2c::detailview::po::CViewCooperatorBasePo

		/**
		 * 版本 >= 0
		 */
		var $cViewCooperatorBasePo_u; //uint8_t

		/**
		 * 多价po 网购侧多价po 内含地域价和限时价 保留
		 *
		 * 版本 >= 0
		 */
		var $oViewMultPricePo; //b2b2c::detailview::po::CViewMultPricePo

		/**
		 * 版本 >= 0
		 */
		var $cViewMultPricePo_u; //uint8_t

		/**
		 * reverse字段 
		 *
		 * 版本 >= 0
		 */
		var $strReverse; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cReverse_u; //uint8_t

		/**
		 * 运营类型 0:经销/1:代销/2:联营/3：新联营 
		 *
		 * 版本 >= 20120308
		 */
		var $dwSkuOperationModel; //uint32_t

		/**
		 * 运营类型 0:经销/1:代销/2:联营/3：新联营 
		 *
		 * 版本 >= 20120308
		 */
		var $cSkuOperationModel_u; //uint8_t

		/**
		 * Sku 搜索因子 仅供搜索使用 其他调用接口不用关心
		 *
		 * 版本 >= 20130327
		 */
		var $dwSkuSearchFactor; //uint32_t

		/**
		 * Sku 搜索因子flag 其他调用接口不用关心
		 *
		 * 版本 >= 20130327
		 */
		var $cSkuSearchFactor_u; //uint8_t

		/**
		 * 商品长度，单位毫米
		 *
		 * 版本 >= 20130329
		 */
		var $wSkuSizeX; //uint16_t

		/**
		 * 商品长度，单位毫米
		 *
		 * 版本 >= 20130329
		 */
		var $cSkuSizeX_u; //uint8_t

		/**
		 * 商品宽度，单位毫米
		 *
		 * 版本 >= 20130329
		 */
		var $wSkuSizeY; //uint16_t

		/**
		 * 商品宽度，单位毫米
		 *
		 * 版本 >= 20130329
		 */
		var $cSkuSizeY_u; //uint8_t

		/**
		 * 商品高度，单位毫米
		 *
		 * 版本 >= 20130329
		 */
		var $wSkuSizeZ; //uint16_t

		/**
		 * 商品高度，单位毫米
		 *
		 * 版本 >= 20130329
		 */
		var $cSkuSizeZ_u; //uint8_t

		/**
		 * 组件清单, coSkuCode(易迅sysno) -> 组件数量
		 *
		 * 版本 >= 20130329
		 */
		var $mapSkuComponent; //std::map<std::string,uint16_t> 

		/**
		 * 组件清单, coSkuCode(易迅sysno) -> 组件数量_u
		 *
		 * 版本 >= 20130329
		 */
		var $cSkuComponent_u; //uint8_t

		/**
		 * 净重,单位克
		 *
		 * 版本 >= 20130617
		 */
		var $dwSkuNetWeight; //uint32_t

		/**
		 * 净重,单位克_u
		 *
		 * 版本 >= 20130617
		 */
		var $cSkuNetWeight_u; //uint8_t

		/**
		 * 品类id，商品所属品类 统一类目后  可代替外层spu结构上的品类
		 *
		 * 版本 >= 20130617
		 */
		var $dwCategoryId; //uint32_t

		/**
		 * 品类id_u，商品所属品类 统一类目后 可代替外层spu结构上的品类 
		 *
		 * 版本 >= 20130617
		 */
		var $cCategoryId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 20130617; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwSkuType = 0; // uint32_t
			 $this->cSkuType_u = 0; // uint8_t
			 $this->ddwInputSkuId = 0; // uint64_t
			 $this->cInputSkuId_u = 0; // uint8_t
			 $this->ddwCooperatorSubAccountId = 0; // uint64_t
			 $this->cCooperatorSubAccountId_u = 0; // uint8_t
			 $this->ddwItemId = 0; // uint64_t
			 $this->cItemId_u = 0; // uint8_t
			 $this->ddwSsuId = 0; // uint64_t
			 $this->cSsuId_u = 0; // uint8_t
			 $this->strCooperatorSkuCode = ""; // std::string
			 $this->cCooperatorSkuCode_u = 0; // uint8_t
			 $this->strProducerBarCode = ""; // std::string
			 $this->cProducerBarCode_u = 0; // uint8_t
			 $this->strSkuBarCode = ""; // std::string
			 $this->cSkuBarCode_u = 0; // uint8_t
			 $this->strSkuTitle = ""; // std::string
			 $this->cSkuTitle_u = 0; // uint8_t
			 $this->strSkuLeadTitle = ""; // std::string
			 $this->cSkuLeadTitle_u = 0; // uint8_t
			 $this->strSkuSubTitle = ""; // std::string
			 $this->cSkuSubTitle_u = 0; // uint8_t
			 $this->strSkuPromotDesc = ""; // std::string
			 $this->cSkuPromotDesc_u = 0; // uint8_t
			 $this->strSkuSaleAttr = ""; // std::string
			 $this->cSkuSaleAttr_u = 0; // uint8_t
			 $this->strSkuSaleAttrText = ""; // std::string
			 $this->cSkuSaleAttrText_u = 0; // uint8_t
			 $this->strSkuSaleAttrDesc = ""; // std::string
			 $this->cSkuSaleAttrDesc_u = 0; // uint8_t
			 $this->dwSkuReferPrice = 0; // uint32_t
			 $this->cSkuReferPrice_u = 0; // uint8_t
			 $this->bitsetSkuProperty = new stl_bitset('128'); // std::bitset<128> 
			 $this->cSkuProperty_u = 0; // uint8_t
			 $this->cSkuState = 0; // uint8_t
			 $this->cSkuState_u = 0; // uint8_t
			 $this->dwSkuWeight = 0; // uint32_t
			 $this->cSkuWeight_u = 0; // uint8_t
			 $this->dwSkuVolume = 0; // uint32_t
			 $this->cSkuVolume_u = 0; // uint8_t
			 $this->strSkuCategoryAttr = ""; // std::string
			 $this->cSkuCategoryAttr_u = 0; // uint8_t
			 $this->strSkuCategoryAttrText = ""; // std::string
			 $this->cSkuCategoryAttrText_u = 0; // uint8_t
			 $this->strSkuCustomizeAttr = ""; // std::string
			 $this->cSkuCustomizeAttr_u = 0; // uint8_t
			 $this->strSkuCustomizeAttrText = ""; // std::string
			 $this->cSkuCustomizeAttrText_u = 0; // uint8_t
			 $this->strSkukeyWord = ""; // std::string
			 $this->cSkukeyWord_u = 0; // uint8_t
			 $this->strSkuClassify = ""; // std::string
			 $this->cSkuClassify_u = 0; // uint8_t
			 $this->dwSkuVatRate = 0; // uint32_t
			 $this->cSkuVatRate_u = 0; // uint8_t
			 $this->wSkuSnapVersion = 0; // uint16_t
			 $this->cSkuSnapVersion_u = 0; // uint8_t
			 $this->dwSkuBuyLimit = 0; // uint32_t
			 $this->cSkuBuyLimit_u = 0; // uint8_t
			 $this->dwSkuLastUpTime = 0; // uint32_t
			 $this->cSkuLastUpTime_u = 0; // uint8_t
			 $this->dwSkuLastDownTime = 0; // uint32_t
			 $this->cSkuLastDownTime_u = 0; // uint8_t
			 $this->dwSkuAddTime = 0; // uint32_t
			 $this->cSkuAddTime_u = 0; // uint8_t
			 $this->dwSkuLastSnapTime = 0; // uint32_t
			 $this->cSkuLastSnapTime_u = 0; // uint8_t
			 $this->dwSkuLastUpdateTime = 0; // uint32_t
			 $this->cSkuLastUpdateTime_u = 0; // uint8_t
			 $this->dwMainLogoLastUpdateTime = 0; // uint32_t
			 $this->cMainLogoLastUpdateTime_u = 0; // uint8_t
			 $this->dwSkuSizeTableId = 0; // uint32_t
			 $this->cSkuSizeTableId_u = 0; // uint8_t
			 $this->oIcsonInfoPo = new IcsonInfoPo(); // b2b2c::detailview::po::CIcsonInfoPo
			 $this->cIcsonInfoPo_u = 0; // uint8_t
			 $this->vecViewStockPo = new stl_vector('ViewStockPo'); // std::vector<b2b2c::detailview::po::CViewStockPo> 
			 $this->cViewStockPo_u = 0; // uint8_t
			 $this->oViewSkuPicturePo = new ViewSkuPicturePo(); // b2b2c::detailview::po::CViewSkuPicturePo
			 $this->cViewSkuPicturePo_u = 0; // uint8_t
			 $this->oViewCooperatorBasePo = new ViewCooperatorBasePo(); // b2b2c::detailview::po::CViewCooperatorBasePo
			 $this->cViewCooperatorBasePo_u = 0; // uint8_t
			 $this->oViewMultPricePo = new ViewMultPricePo(); // b2b2c::detailview::po::CViewMultPricePo
			 $this->cViewMultPricePo_u = 0; // uint8_t
			 $this->strReverse = ""; // std::string
			 $this->cReverse_u = 0; // uint8_t
			 $this->dwSkuOperationModel = 0; // uint32_t
			 $this->cSkuOperationModel_u = 0; // uint8_t
			 $this->dwSkuSearchFactor = 0; // uint32_t
			 $this->cSkuSearchFactor_u = 0; // uint8_t
			 $this->wSkuSizeX = 0; // uint16_t
			 $this->cSkuSizeX_u = 0; // uint8_t
			 $this->wSkuSizeY = 0; // uint16_t
			 $this->cSkuSizeY_u = 0; // uint8_t
			 $this->wSkuSizeZ = 0; // uint16_t
			 $this->cSkuSizeZ_u = 0; // uint8_t
			 $this->mapSkuComponent = new stl_map('stl_string,uint16_t'); // std::map<std::string,uint16_t> 
			 $this->cSkuComponent_u = 0; // uint8_t
			 $this->dwSkuNetWeight = 0; // uint32_t
			 $this->cSkuNetWeight_u = 0; // uint8_t
			 $this->dwCategoryId = 0; // uint32_t
			 $this->cCategoryId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid,网购侧唯一 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuType); // 序列化商品类型 如：正常商品 二手商品等 参见enum SkuType 类型为uint32_t
			$bs->pushUint8_t($this->cSkuType_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwInputSkuId); // 序列化请求的SKUID 例如：入参skuid为A，由于某种原因A被迁移变更或替换为B，则返回的数据中无A的sku，则在B的sku信息中这个字段被设置为A 类型为uint64_t
			$bs->pushUint8_t($this->cInputSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwCooperatorSubAccountId); // 序列化合作伙伴ID 主号+子号   类型为uint64_t
			$bs->pushUint8_t($this->cCooperatorSubAccountId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwItemId); // 序列化ItemID,目前的itemId实际上表示主子商品的组id 类型为uint64_t
			$bs->pushUint8_t($this->cItemId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSsuId); // 序列化ssuid 最小搜索单元id 类型为uint64_t
			$bs->pushUint8_t($this->cSsuId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorSkuCode); // 序列化供应商Sku编码 实际上对应易迅商品ID 类型为std::string
			$bs->pushUint8_t($this->cCooperatorSkuCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProducerBarCode); // 序列化生产商条形码   类型为std::string
			$bs->pushUint8_t($this->cProducerBarCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuBarCode); // 序列化国际通行条形码   类型为std::string
			$bs->pushUint8_t($this->cSkuBarCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuTitle); // 序列化Sku标题   类型为std::string
			$bs->pushUint8_t($this->cSkuTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuLeadTitle); // 序列化Sku引题   类型为std::string
			$bs->pushUint8_t($this->cSkuLeadTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuSubTitle); // 序列化Sku副题   类型为std::string
			$bs->pushUint8_t($this->cSkuSubTitle_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuPromotDesc); // 序列化Sku促销语   类型为std::string
			$bs->pushUint8_t($this->cSkuPromotDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuSaleAttr); // 序列化Sku销售属性串   类型为std::string
			$bs->pushUint8_t($this->cSkuSaleAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuSaleAttrText); // 序列化sku销售属性明文 类型为std::string
			$bs->pushUint8_t($this->cSkuSaleAttrText_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuSaleAttrDesc); // 序列化Sku销售属性串描述 为销售属性做额外解析  类型为std::string
			$bs->pushUint8_t($this->cSkuSaleAttrDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuReferPrice); // 序列化Sku参考价格 即市场价,精确到分   类型为uint32_t
			$bs->pushUint8_t($this->cSkuReferPrice_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetSkuProperty,'stl_bitset'); // 序列化Sku属性标志 参见enum SkuProperty(二手商品属性位废弃)   类型为std::bitset<128> 
			$bs->pushUint8_t($this->cSkuProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuState); // 序列化Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为uint8_t
			$bs->pushUint8_t($this->cSkuState_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuWeight); // 序列化Sku 重量 克   类型为uint32_t
			$bs->pushUint8_t($this->cSkuWeight_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuVolume); // 序列化Sku 体积 立方厘米   类型为uint32_t
			$bs->pushUint8_t($this->cSkuVolume_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuCategoryAttr); // 序列化Sku 类目属性串   类型为std::string
			$bs->pushUint8_t($this->cSkuCategoryAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuCategoryAttrText); // 序列化Sku 类目属性串明文   类型为std::string
			$bs->pushUint8_t($this->cSkuCategoryAttrText_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuCustomizeAttr); // 序列化Sku 自定义属性 类型为std::string
			$bs->pushUint8_t($this->cSkuCustomizeAttr_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuCustomizeAttrText); // 序列化Sku 自定义属性 明文  类型为std::string
			$bs->pushUint8_t($this->cSkuCustomizeAttrText_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkukeyWord); // 序列化Sku 关键词 可以有多个  类型为std::string
			$bs->pushUint8_t($this->cSkukeyWord_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuClassify); // 序列化Sku 分类   类型为std::string
			$bs->pushUint8_t($this->cSkuClassify_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuVatRate); // 序列化Sku 税率   类型为uint32_t
			$bs->pushUint8_t($this->cSkuVatRate_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wSkuSnapVersion); // 序列化Sku 当前快照版本   类型为uint16_t
			$bs->pushUint8_t($this->cSkuSnapVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuBuyLimit); // 序列化Sku 购买限制 0 -- 无限制   类型为uint32_t
			$bs->pushUint8_t($this->cSkuBuyLimit_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuLastUpTime); // 序列化Sku 最后上架时间   类型为uint32_t
			$bs->pushUint8_t($this->cSkuLastUpTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuLastDownTime); // 序列化Sku 最后下架时间   类型为uint32_t
			$bs->pushUint8_t($this->cSkuLastDownTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuAddTime); // 序列化Sku 添加时间   类型为uint32_t
			$bs->pushUint8_t($this->cSkuAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuLastSnapTime); // 序列化Sku 最后快照生成时间   类型为uint32_t
			$bs->pushUint8_t($this->cSkuLastSnapTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuLastUpdateTime); // 序列化Sku 最后修改时间   类型为uint32_t
			$bs->pushUint8_t($this->cSkuLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwMainLogoLastUpdateTime); // 序列化主图最后更新时间 可以拼接在图片链接后面 用来强制浏览器拉取新图片 类型为uint32_t
			$bs->pushUint8_t($this->cMainLogoLastUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSkuSizeTableId); // 序列化尺码表Id 保留 类型为uint32_t
			$bs->pushUint8_t($this->cSkuSizeTableId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oIcsonInfoPo,'IcsonInfoPo'); // 序列化易迅商品信息 类型为b2b2c::detailview::po::CIcsonInfoPo
			$bs->pushUint8_t($this->cIcsonInfoPo_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecViewStockPo,'stl_vector'); // 序列化一个Sku所对应的库存信息 即分仓信息  类型为std::vector<b2b2c::detailview::po::CViewStockPo> 
			$bs->pushUint8_t($this->cViewStockPo_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oViewSkuPicturePo,'ViewSkuPicturePo'); // 序列化Sku主图Po 里面有主图url及图片类型等  类型为b2b2c::detailview::po::CViewSkuPicturePo
			$bs->pushUint8_t($this->cViewSkuPicturePo_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oViewCooperatorBasePo,'ViewCooperatorBasePo'); // 序列化该sku所属合作伙伴基本信息   类型为b2b2c::detailview::po::CViewCooperatorBasePo
			$bs->pushUint8_t($this->cViewCooperatorBasePo_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->oViewMultPricePo,'ViewMultPricePo'); // 序列化多价po 网购侧多价po 内含地域价和限时价 保留 类型为b2b2c::detailview::po::CViewMultPricePo
			$bs->pushUint8_t($this->cViewMultPricePo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strReverse); // 序列化reverse字段  类型为std::string
			$bs->pushUint8_t($this->cReverse_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 20120308 ){
				$bs->pushUint32_t($this->dwSkuOperationModel); // 序列化运营类型 0:经销/1:代销/2:联营/3：新联营  类型为uint32_t
			}
			if(  $this->dwVersion >= 20120308 ){
				$bs->pushUint8_t($this->cSkuOperationModel_u); // 序列化运营类型 0:经销/1:代销/2:联营/3：新联营  类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushUint32_t($this->dwSkuSearchFactor); // 序列化Sku 搜索因子 仅供搜索使用 其他调用接口不用关心 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushUint8_t($this->cSkuSearchFactor_u); // 序列化Sku 搜索因子flag 其他调用接口不用关心 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushUint16_t($this->wSkuSizeX); // 序列化商品长度，单位毫米 类型为uint16_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushUint8_t($this->cSkuSizeX_u); // 序列化商品长度，单位毫米 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushUint16_t($this->wSkuSizeY); // 序列化商品宽度，单位毫米 类型为uint16_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushUint8_t($this->cSkuSizeY_u); // 序列化商品宽度，单位毫米 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushUint16_t($this->wSkuSizeZ); // 序列化商品高度，单位毫米 类型为uint16_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushUint8_t($this->cSkuSizeZ_u); // 序列化商品高度，单位毫米 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushObject($this->mapSkuComponent,'stl_map'); // 序列化组件清单, coSkuCode(易迅sysno) -> 组件数量 类型为std::map<std::string,uint16_t> 
			}
			if(  $this->dwVersion >= 20130329 ){
				$bs->pushUint8_t($this->cSkuComponent_u); // 序列化组件清单, coSkuCode(易迅sysno) -> 组件数量_u 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$bs->pushUint32_t($this->dwSkuNetWeight); // 序列化净重,单位克 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$bs->pushUint8_t($this->cSkuNetWeight_u); // 序列化净重,单位克_u 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$bs->pushUint32_t($this->dwCategoryId); // 序列化品类id，商品所属品类 统一类目后  可代替外层spu结构上的品类 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$bs->pushUint8_t($this->cCategoryId_u); // 序列化品类id_u，商品所属品类 统一类目后 可代替外层spu结构上的品类  类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid,网购侧唯一 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuType = $bs->popUint32_t(); // 反序列化商品类型 如：正常商品 二手商品等 参见enum SkuType 类型为uint32_t
			$this->cSkuType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwInputSkuId = $bs->popUint64_t(); // 反序列化请求的SKUID 例如：入参skuid为A，由于某种原因A被迁移变更或替换为B，则返回的数据中无A的sku，则在B的sku信息中这个字段被设置为A 类型为uint64_t
			$this->cInputSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwCooperatorSubAccountId = $bs->popUint64_t(); // 反序列化合作伙伴ID 主号+子号   类型为uint64_t
			$this->cCooperatorSubAccountId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwItemId = $bs->popUint64_t(); // 反序列化ItemID,目前的itemId实际上表示主子商品的组id 类型为uint64_t
			$this->cItemId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSsuId = $bs->popUint64_t(); // 反序列化ssuid 最小搜索单元id 类型为uint64_t
			$this->cSsuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorSkuCode = $bs->popString(); // 反序列化供应商Sku编码 实际上对应易迅商品ID 类型为std::string
			$this->cCooperatorSkuCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProducerBarCode = $bs->popString(); // 反序列化生产商条形码   类型为std::string
			$this->cProducerBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuBarCode = $bs->popString(); // 反序列化国际通行条形码   类型为std::string
			$this->cSkuBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuTitle = $bs->popString(); // 反序列化Sku标题   类型为std::string
			$this->cSkuTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuLeadTitle = $bs->popString(); // 反序列化Sku引题   类型为std::string
			$this->cSkuLeadTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuSubTitle = $bs->popString(); // 反序列化Sku副题   类型为std::string
			$this->cSkuSubTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuPromotDesc = $bs->popString(); // 反序列化Sku促销语   类型为std::string
			$this->cSkuPromotDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuSaleAttr = $bs->popString(); // 反序列化Sku销售属性串   类型为std::string
			$this->cSkuSaleAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuSaleAttrText = $bs->popString(); // 反序列化sku销售属性明文 类型为std::string
			$this->cSkuSaleAttrText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuSaleAttrDesc = $bs->popString(); // 反序列化Sku销售属性串描述 为销售属性做额外解析  类型为std::string
			$this->cSkuSaleAttrDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuReferPrice = $bs->popUint32_t(); // 反序列化Sku参考价格 即市场价,精确到分   类型为uint32_t
			$this->cSkuReferPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetSkuProperty = $bs->popObject('stl_bitset<128>'); // 反序列化Sku属性标志 参见enum SkuProperty(二手商品属性位废弃)   类型为std::bitset<128> 
			$this->cSkuProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuState = $bs->popUint8_t(); // 反序列化Sku 参见enum SkuState状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为uint8_t
			$this->cSkuState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuWeight = $bs->popUint32_t(); // 反序列化Sku 重量 克   类型为uint32_t
			$this->cSkuWeight_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuVolume = $bs->popUint32_t(); // 反序列化Sku 体积 立方厘米   类型为uint32_t
			$this->cSkuVolume_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuCategoryAttr = $bs->popString(); // 反序列化Sku 类目属性串   类型为std::string
			$this->cSkuCategoryAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuCategoryAttrText = $bs->popString(); // 反序列化Sku 类目属性串明文   类型为std::string
			$this->cSkuCategoryAttrText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuCustomizeAttr = $bs->popString(); // 反序列化Sku 自定义属性 类型为std::string
			$this->cSkuCustomizeAttr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuCustomizeAttrText = $bs->popString(); // 反序列化Sku 自定义属性 明文  类型为std::string
			$this->cSkuCustomizeAttrText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkukeyWord = $bs->popString(); // 反序列化Sku 关键词 可以有多个  类型为std::string
			$this->cSkukeyWord_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuClassify = $bs->popString(); // 反序列化Sku 分类   类型为std::string
			$this->cSkuClassify_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuVatRate = $bs->popUint32_t(); // 反序列化Sku 税率   类型为uint32_t
			$this->cSkuVatRate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wSkuSnapVersion = $bs->popUint16_t(); // 反序列化Sku 当前快照版本   类型为uint16_t
			$this->cSkuSnapVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuBuyLimit = $bs->popUint32_t(); // 反序列化Sku 购买限制 0 -- 无限制   类型为uint32_t
			$this->cSkuBuyLimit_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuLastUpTime = $bs->popUint32_t(); // 反序列化Sku 最后上架时间   类型为uint32_t
			$this->cSkuLastUpTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuLastDownTime = $bs->popUint32_t(); // 反序列化Sku 最后下架时间   类型为uint32_t
			$this->cSkuLastDownTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuAddTime = $bs->popUint32_t(); // 反序列化Sku 添加时间   类型为uint32_t
			$this->cSkuAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuLastSnapTime = $bs->popUint32_t(); // 反序列化Sku 最后快照生成时间   类型为uint32_t
			$this->cSkuLastSnapTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuLastUpdateTime = $bs->popUint32_t(); // 反序列化Sku 最后修改时间   类型为uint32_t
			$this->cSkuLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwMainLogoLastUpdateTime = $bs->popUint32_t(); // 反序列化主图最后更新时间 可以拼接在图片链接后面 用来强制浏览器拉取新图片 类型为uint32_t
			$this->cMainLogoLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSkuSizeTableId = $bs->popUint32_t(); // 反序列化尺码表Id 保留 类型为uint32_t
			$this->cSkuSizeTableId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oIcsonInfoPo = $bs->popObject('IcsonInfoPo'); // 反序列化易迅商品信息 类型为b2b2c::detailview::po::CIcsonInfoPo
			$this->cIcsonInfoPo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecViewStockPo = $bs->popObject('stl_vector<ViewStockPo>'); // 反序列化一个Sku所对应的库存信息 即分仓信息  类型为std::vector<b2b2c::detailview::po::CViewStockPo> 
			$this->cViewStockPo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oViewSkuPicturePo = $bs->popObject('ViewSkuPicturePo'); // 反序列化Sku主图Po 里面有主图url及图片类型等  类型为b2b2c::detailview::po::CViewSkuPicturePo
			$this->cViewSkuPicturePo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oViewCooperatorBasePo = $bs->popObject('ViewCooperatorBasePo'); // 反序列化该sku所属合作伙伴基本信息   类型为b2b2c::detailview::po::CViewCooperatorBasePo
			$this->cViewCooperatorBasePo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->oViewMultPricePo = $bs->popObject('ViewMultPricePo'); // 反序列化多价po 网购侧多价po 内含地域价和限时价 保留 类型为b2b2c::detailview::po::CViewMultPricePo
			$this->cViewMultPricePo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strReverse = $bs->popString(); // 反序列化reverse字段  类型为std::string
			$this->cReverse_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 20120308 ){
				$this->dwSkuOperationModel = $bs->popUint32_t(); // 反序列化运营类型 0:经销/1:代销/2:联营/3：新联营  类型为uint32_t
			}
			if(  $this->dwVersion >= 20120308 ){
				$this->cSkuOperationModel_u = $bs->popUint8_t(); // 反序列化运营类型 0:经销/1:代销/2:联营/3：新联营  类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->dwSkuSearchFactor = $bs->popUint32_t(); // 反序列化Sku 搜索因子 仅供搜索使用 其他调用接口不用关心 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->cSkuSearchFactor_u = $bs->popUint8_t(); // 反序列化Sku 搜索因子flag 其他调用接口不用关心 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->wSkuSizeX = $bs->popUint16_t(); // 反序列化商品长度，单位毫米 类型为uint16_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->cSkuSizeX_u = $bs->popUint8_t(); // 反序列化商品长度，单位毫米 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->wSkuSizeY = $bs->popUint16_t(); // 反序列化商品宽度，单位毫米 类型为uint16_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->cSkuSizeY_u = $bs->popUint8_t(); // 反序列化商品宽度，单位毫米 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->wSkuSizeZ = $bs->popUint16_t(); // 反序列化商品高度，单位毫米 类型为uint16_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->cSkuSizeZ_u = $bs->popUint8_t(); // 反序列化商品高度，单位毫米 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->mapSkuComponent = $bs->popObject('stl_map<stl_string,uint16_t>'); // 反序列化组件清单, coSkuCode(易迅sysno) -> 组件数量 类型为std::map<std::string,uint16_t> 
			}
			if(  $this->dwVersion >= 20130329 ){
				$this->cSkuComponent_u = $bs->popUint8_t(); // 反序列化组件清单, coSkuCode(易迅sysno) -> 组件数量_u 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$this->dwSkuNetWeight = $bs->popUint32_t(); // 反序列化净重,单位克 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$this->cSkuNetWeight_u = $bs->popUint8_t(); // 反序列化净重,单位克_u 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$this->dwCategoryId = $bs->popUint32_t(); // 反序列化品类id，商品所属品类 统一类目后  可代替外层spu结构上的品类 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130617 ){
				$this->cCategoryId_u = $bs->popUint8_t(); // 反序列化品类id_u，商品所属品类 统一类目后 可代替外层spu结构上的品类  类型为uint8_t
			}

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewSkuPo.java

if (!class_exists('ViewStockPo',false)) {
class ViewStockPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * skuid,网购侧唯一
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * stockId,库存id 平台自动生成且唯一 ，skuid+storehouseid唯一关联一个stockid
		 *
		 * 版本 >= 0
		 */
		var $ddwStockId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cStockId_u; //uint8_t

		/**
		 * 仓库Id 对应网购平台逻辑仓id 
		 *
		 * 版本 >= 0
		 */
		var $dwStoreHouseId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStoreHouseId_u; //uint8_t

		/**
		 * 供应商库存编码,内码  
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorStockCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorStockCode_u; //uint8_t

		/**
		 * 供应商商品条形码  
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorBarCode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorBarCode_u; //uint8_t

		/**
		 * 库存价格，单位分 商品真实售卖价格 
		 *
		 * 版本 >= 0
		 */
		var $dwStockPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockPrice_u; //uint8_t

		/**
		 * 库存上次价格  
		 *
		 * 版本 >= 0
		 */
		var $dwStockPrePrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockPrePrice_u; //uint8_t

		/**
		 * 库存成本价格  
		 *
		 * 版本 >= 0
		 */
		var $dwStockCostPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockCostPrice_u; //uint8_t

		/**
		 * 库存虚拟数量  
		 *
		 * 版本 >= 0
		 */
		var $dwStockVirtualNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockVirtualNum_u; //uint8_t

		/**
		 * 库存实际数量  
		 *
		 * 版本 >= 0
		 */
		var $dwStockRealNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockRealNum_u; //uint8_t

		/**
		 * 库存活动锁定数  
		 *
		 * 版本 >= 0
		 */
		var $dwStockLockNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockLockNum_u; //uint8_t

		/**
		 * 普通销售锁定增减  
		 *
		 * 版本 >= 0
		 */
		var $dwStockSellingNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockSellingNum_u; //uint8_t

		/**
		 * 活动销售锁定增减  
		 *
		 * 版本 >= 0
		 */
		var $dwStockProSellingNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockProSellingNum_u; //uint8_t

		/**
		 * 预计发送天数-出货时间 仓库到物流的时间   
		 *
		 * 版本 >= 0
		 */
		var $strStockEstimateDispatch; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStockEstimateDispatch_u; //uint8_t

		/**
		 * 库存属性 参见enum StockProperty 
		 *
		 * 版本 >= 0
		 */
		var $bitsetStocProperty; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cStocProperty_u; //uint8_t

		/**
		 * 库存状态  参见enum StockState 同sku状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除 
		 *
		 * 版本 >= 0
		 */
		var $cStockState; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStockState_u; //uint8_t

		/**
		 * 覆盖地域  
		 *
		 * 版本 >= 0
		 */
		var $setCoverArea; //std::set<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cCoverArea_u; //uint8_t

		/**
		 * 限运地域  
		 *
		 * 版本 >= 0
		 */
		var $setStockLimitArea; //std::set<uint32_t> 

		/**
		 * 版本 >= 0
		 */
		var $cStockLimitArea_u; //uint8_t

		/**
		 * 库存限运规则  
		 *
		 * 版本 >= 0
		 */
		var $strStockLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStockLimitRule_u; //uint8_t

		/**
		 * 库存购买总数,下单件数  
		 *
		 * 版本 >= 0
		 */
		var $dwStockOrderNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockOrderNum_u; //uint8_t

		/**
		 * 库存销售总数，订单流程走完的数量  
		 *
		 * 版本 >= 0
		 */
		var $dwStockSoldNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockSoldNum_u; //uint8_t

		/**
		 * 完成付款后的锁定数量 
		 *
		 * 版本 >= 0
		 */
		var $dwStockPayedNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockPayedNum_u; //uint8_t

		/**
		 * 促销付款后的锁定数量 
		 *
		 * 版本 >= 0
		 */
		var $dwStockProPayedNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockProPayedNum_u; //uint8_t

		/**
		 * 合作伙伴真实同步数量  
		 *
		 * 版本 >= 0
		 */
		var $dwStockRealSynNum; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockRealSynNum_u; //uint8_t

		/**
		 * 库存促销语  
		 *
		 * 版本 >= 0
		 */
		var $strStockPromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStockPromotionDesc_u; //uint8_t

		/**
		 * 仓库名称  
		 *
		 * 版本 >= 0
		 */
		var $strStoreHouseName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cStoreHouseName_u; //uint8_t

		/**
		 * 起购数量 最小购买数量
		 *
		 * 版本 >= 0
		 */
		var $dwStockMinBuyCount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockMinBuyCount_u; //uint8_t

		/**
		 * 限购数量 最大购买限制
		 *
		 * 版本 >= 0
		 */
		var $dwStockMaxBuyCount; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockMaxBuyCount_u; //uint8_t

		/**
		 * 合约机业务类型
		 *
		 * 版本 >= 0
		 */
		var $dwStockSellMode; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStockSellMode_u; //uint8_t

		/**
		 * 业务成本
		 *
		 * 版本 >= 20130308
		 */
		var $dwStockBusinessCost; //uint32_t

		/**
		 * 业务成本 flag
		 *
		 * 版本 >= 20130308
		 */
		var $cStockBusinessCost_u; //uint8_t

		/**
		 * 易迅限运规则编码，具体由易迅侧服务解释
		 *
		 * 版本 >= 20130308
		 */
		var $dwStockLimitCode; //uint32_t

		/**
		 * 易迅限运规则编码，具体由易迅侧服务解释 flag
		 *
		 * 版本 >= 20130308
		 */
		var $cStockLimitCode_u; //uint8_t

		/**
		 * 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发
		 *
		 * 版本 >= 20130308
		 */
		var $dwPromotionType; //uint32_t

		/**
		 * 促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag
		 *
		 * 版本 >= 20130308
		 */
		var $cPromotionType_u; //uint8_t

		/**
		 * 仓库类型 0 为逻辑仓 1为物理仓 此字段仅供搜索使用 其他调用不用关心
		 *
		 * 版本 >= 20130327
		 */
		var $dwStoreHouseType; //uint32_t

		/**
		 * 仓库类型 0 为逻辑仓 1为物理仓 此字段仅供搜索使用 其他调用不用关心flag
		 *
		 * 版本 >= 20130327
		 */
		var $cStoreHouseType_u; //uint8_t

		/**
		 * 合作伙伴侧仓库编码 此字段仅供搜索使用 其他调用不用关心
		 *
		 * 版本 >= 20130327
		 */
		var $dwStoreHouseCode; //uint32_t

		/**
		 * 合作伙伴侧仓库编码 此字段仅供搜索使用 其他调用不用关心flag
		 *
		 * 版本 >= 20130327
		 */
		var $cStoreHouseCode_u; //uint8_t

		/**
		 * 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员
		 *
		 * 版本 >= 20130327
		 */
		var $vecViewIcsonStockExInfo; //std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> 

		/**
		 * 易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员
		 *
		 * 版本 >= 20130327
		 */
		var $cViewIcsonStockExInfo_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 20130327; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->ddwStockId = 0; // uint64_t
			 $this->cStockId_u = 0; // uint8_t
			 $this->dwStoreHouseId = 0; // uint32_t
			 $this->cStoreHouseId_u = 0; // uint8_t
			 $this->strCooperatorStockCode = ""; // std::string
			 $this->cCooperatorStockCode_u = 0; // uint8_t
			 $this->strCooperatorBarCode = ""; // std::string
			 $this->cCooperatorBarCode_u = 0; // uint8_t
			 $this->dwStockPrice = 0; // uint32_t
			 $this->cStockPrice_u = 0; // uint8_t
			 $this->dwStockPrePrice = 0; // uint32_t
			 $this->cStockPrePrice_u = 0; // uint8_t
			 $this->dwStockCostPrice = 0; // uint32_t
			 $this->cStockCostPrice_u = 0; // uint8_t
			 $this->dwStockVirtualNum = 0; // uint32_t
			 $this->cStockVirtualNum_u = 0; // uint8_t
			 $this->dwStockRealNum = 0; // uint32_t
			 $this->cStockRealNum_u = 0; // uint8_t
			 $this->dwStockLockNum = 0; // uint32_t
			 $this->cStockLockNum_u = 0; // uint8_t
			 $this->dwStockSellingNum = 0; // uint32_t
			 $this->cStockSellingNum_u = 0; // uint8_t
			 $this->dwStockProSellingNum = 0; // uint32_t
			 $this->cStockProSellingNum_u = 0; // uint8_t
			 $this->strStockEstimateDispatch = ""; // std::string
			 $this->cStockEstimateDispatch_u = 0; // uint8_t
			 $this->bitsetStocProperty = new stl_bitset('32'); // std::bitset<32> 
			 $this->cStocProperty_u = 0; // uint8_t
			 $this->cStockState = 0; // uint8_t
			 $this->cStockState_u = 0; // uint8_t
			 $this->setCoverArea = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cCoverArea_u = 0; // uint8_t
			 $this->setStockLimitArea = new stl_set('uint32_t'); // std::set<uint32_t> 
			 $this->cStockLimitArea_u = 0; // uint8_t
			 $this->strStockLimitRule = ""; // std::string
			 $this->cStockLimitRule_u = 0; // uint8_t
			 $this->dwStockOrderNum = 0; // uint32_t
			 $this->cStockOrderNum_u = 0; // uint8_t
			 $this->dwStockSoldNum = 0; // uint32_t
			 $this->cStockSoldNum_u = 0; // uint8_t
			 $this->dwStockPayedNum = 0; // uint32_t
			 $this->cStockPayedNum_u = 0; // uint8_t
			 $this->dwStockProPayedNum = 0; // uint32_t
			 $this->cStockProPayedNum_u = 0; // uint8_t
			 $this->dwStockRealSynNum = 0; // uint32_t
			 $this->cStockRealSynNum_u = 0; // uint8_t
			 $this->strStockPromotionDesc = ""; // std::string
			 $this->cStockPromotionDesc_u = 0; // uint8_t
			 $this->strStoreHouseName = ""; // std::string
			 $this->cStoreHouseName_u = 0; // uint8_t
			 $this->dwStockMinBuyCount = 0; // uint32_t
			 $this->cStockMinBuyCount_u = 0; // uint8_t
			 $this->dwStockMaxBuyCount = 0; // uint32_t
			 $this->cStockMaxBuyCount_u = 0; // uint8_t
			 $this->dwStockSellMode = 0; // uint32_t
			 $this->cStockSellMode_u = 0; // uint8_t
			 $this->dwStockBusinessCost = 0; // uint32_t
			 $this->cStockBusinessCost_u = 0; // uint8_t
			 $this->dwStockLimitCode = 0; // uint32_t
			 $this->cStockLimitCode_u = 0; // uint8_t
			 $this->dwPromotionType = 0; // uint32_t
			 $this->cPromotionType_u = 0; // uint8_t
			 $this->dwStoreHouseType = 0; // uint32_t
			 $this->cStoreHouseType_u = 0; // uint8_t
			 $this->dwStoreHouseCode = 0; // uint32_t
			 $this->cStoreHouseCode_u = 0; // uint8_t
			 $this->vecViewIcsonStockExInfo = new stl_vector('ViewIcsonStockExInfoPo'); // std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> 
			 $this->cViewIcsonStockExInfo_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid,网购侧唯一 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwStockId); // 序列化stockId,库存id 平台自动生成且唯一 ，skuid+storehouseid唯一关联一个stockid 类型为uint64_t
			$bs->pushUint8_t($this->cStockId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStoreHouseId); // 序列化仓库Id 对应网购平台逻辑仓id  类型为uint32_t
			$bs->pushUint8_t($this->cStoreHouseId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorStockCode); // 序列化供应商库存编码,内码   类型为std::string
			$bs->pushUint8_t($this->cCooperatorStockCode_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorBarCode); // 序列化供应商商品条形码   类型为std::string
			$bs->pushUint8_t($this->cCooperatorBarCode_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockPrice); // 序列化库存价格，单位分 商品真实售卖价格  类型为uint32_t
			$bs->pushUint8_t($this->cStockPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockPrePrice); // 序列化库存上次价格   类型为uint32_t
			$bs->pushUint8_t($this->cStockPrePrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockCostPrice); // 序列化库存成本价格   类型为uint32_t
			$bs->pushUint8_t($this->cStockCostPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockVirtualNum); // 序列化库存虚拟数量   类型为uint32_t
			$bs->pushUint8_t($this->cStockVirtualNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockRealNum); // 序列化库存实际数量   类型为uint32_t
			$bs->pushUint8_t($this->cStockRealNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockLockNum); // 序列化库存活动锁定数   类型为uint32_t
			$bs->pushUint8_t($this->cStockLockNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockSellingNum); // 序列化普通销售锁定增减   类型为uint32_t
			$bs->pushUint8_t($this->cStockSellingNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockProSellingNum); // 序列化活动销售锁定增减   类型为uint32_t
			$bs->pushUint8_t($this->cStockProSellingNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStockEstimateDispatch); // 序列化预计发送天数-出货时间 仓库到物流的时间    类型为std::string
			$bs->pushUint8_t($this->cStockEstimateDispatch_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetStocProperty,'stl_bitset'); // 序列化库存属性 参见enum StockProperty  类型为std::bitset<32> 
			$bs->pushUint8_t($this->cStocProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStockState); // 序列化库存状态  参见enum StockState 同sku状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为uint8_t
			$bs->pushUint8_t($this->cStockState_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setCoverArea,'stl_set'); // 序列化覆盖地域   类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cCoverArea_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setStockLimitArea,'stl_set'); // 序列化限运地域   类型为std::set<uint32_t> 
			$bs->pushUint8_t($this->cStockLimitArea_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStockLimitRule); // 序列化库存限运规则   类型为std::string
			$bs->pushUint8_t($this->cStockLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockOrderNum); // 序列化库存购买总数,下单件数   类型为uint32_t
			$bs->pushUint8_t($this->cStockOrderNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockSoldNum); // 序列化库存销售总数，订单流程走完的数量   类型为uint32_t
			$bs->pushUint8_t($this->cStockSoldNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockPayedNum); // 序列化完成付款后的锁定数量  类型为uint32_t
			$bs->pushUint8_t($this->cStockPayedNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockProPayedNum); // 序列化促销付款后的锁定数量  类型为uint32_t
			$bs->pushUint8_t($this->cStockProPayedNum_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockRealSynNum); // 序列化合作伙伴真实同步数量   类型为uint32_t
			$bs->pushUint8_t($this->cStockRealSynNum_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStockPromotionDesc); // 序列化库存促销语   类型为std::string
			$bs->pushUint8_t($this->cStockPromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strStoreHouseName); // 序列化仓库名称   类型为std::string
			$bs->pushUint8_t($this->cStoreHouseName_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockMinBuyCount); // 序列化起购数量 最小购买数量 类型为uint32_t
			$bs->pushUint8_t($this->cStockMinBuyCount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockMaxBuyCount); // 序列化限购数量 最大购买限制 类型为uint32_t
			$bs->pushUint8_t($this->cStockMaxBuyCount_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStockSellMode); // 序列化合约机业务类型 类型为uint32_t
			$bs->pushUint8_t($this->cStockSellMode_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint32_t($this->dwStockBusinessCost); // 序列化业务成本 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint8_t($this->cStockBusinessCost_u); // 序列化业务成本 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint32_t($this->dwStockLimitCode); // 序列化易迅限运规则编码，具体由易迅侧服务解释 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint8_t($this->cStockLimitCode_u); // 序列化易迅限运规则编码，具体由易迅侧服务解释 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint32_t($this->dwPromotionType); // 序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint8_t($this->cPromotionType_u); // 序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushUint32_t($this->dwStoreHouseType); // 序列化仓库类型 0 为逻辑仓 1为物理仓 此字段仅供搜索使用 其他调用不用关心 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushUint8_t($this->cStoreHouseType_u); // 序列化仓库类型 0 为逻辑仓 1为物理仓 此字段仅供搜索使用 其他调用不用关心flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushUint32_t($this->dwStoreHouseCode); // 序列化合作伙伴侧仓库编码 此字段仅供搜索使用 其他调用不用关心 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushUint8_t($this->cStoreHouseCode_u); // 序列化合作伙伴侧仓库编码 此字段仅供搜索使用 其他调用不用关心flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushObject($this->vecViewIcsonStockExInfo,'stl_vector'); // 序列化易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员 类型为std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> 
			}
			if(  $this->dwVersion >= 20130327 ){
				$bs->pushUint8_t($this->cViewIcsonStockExInfo_u); // 序列化易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid,网购侧唯一 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwStockId = $bs->popUint64_t(); // 反序列化stockId,库存id 平台自动生成且唯一 ，skuid+storehouseid唯一关联一个stockid 类型为uint64_t
			$this->cStockId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStoreHouseId = $bs->popUint32_t(); // 反序列化仓库Id 对应网购平台逻辑仓id  类型为uint32_t
			$this->cStoreHouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorStockCode = $bs->popString(); // 反序列化供应商库存编码,内码   类型为std::string
			$this->cCooperatorStockCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorBarCode = $bs->popString(); // 反序列化供应商商品条形码   类型为std::string
			$this->cCooperatorBarCode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockPrice = $bs->popUint32_t(); // 反序列化库存价格，单位分 商品真实售卖价格  类型为uint32_t
			$this->cStockPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockPrePrice = $bs->popUint32_t(); // 反序列化库存上次价格   类型为uint32_t
			$this->cStockPrePrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockCostPrice = $bs->popUint32_t(); // 反序列化库存成本价格   类型为uint32_t
			$this->cStockCostPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockVirtualNum = $bs->popUint32_t(); // 反序列化库存虚拟数量   类型为uint32_t
			$this->cStockVirtualNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockRealNum = $bs->popUint32_t(); // 反序列化库存实际数量   类型为uint32_t
			$this->cStockRealNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockLockNum = $bs->popUint32_t(); // 反序列化库存活动锁定数   类型为uint32_t
			$this->cStockLockNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockSellingNum = $bs->popUint32_t(); // 反序列化普通销售锁定增减   类型为uint32_t
			$this->cStockSellingNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockProSellingNum = $bs->popUint32_t(); // 反序列化活动销售锁定增减   类型为uint32_t
			$this->cStockProSellingNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStockEstimateDispatch = $bs->popString(); // 反序列化预计发送天数-出货时间 仓库到物流的时间    类型为std::string
			$this->cStockEstimateDispatch_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetStocProperty = $bs->popObject('stl_bitset<32>'); // 反序列化库存属性 参见enum StockProperty  类型为std::bitset<32> 
			$this->cStocProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStockState = $bs->popUint8_t(); // 反序列化库存状态  参见enum StockState 同sku状态 0-在售 1-售完 2-下架 3-强制下架 4-删除 5-强制删除  类型为uint8_t
			$this->cStockState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setCoverArea = $bs->popObject('stl_set<uint32_t>'); // 反序列化覆盖地域   类型为std::set<uint32_t> 
			$this->cCoverArea_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setStockLimitArea = $bs->popObject('stl_set<uint32_t>'); // 反序列化限运地域   类型为std::set<uint32_t> 
			$this->cStockLimitArea_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStockLimitRule = $bs->popString(); // 反序列化库存限运规则   类型为std::string
			$this->cStockLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockOrderNum = $bs->popUint32_t(); // 反序列化库存购买总数,下单件数   类型为uint32_t
			$this->cStockOrderNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockSoldNum = $bs->popUint32_t(); // 反序列化库存销售总数，订单流程走完的数量   类型为uint32_t
			$this->cStockSoldNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockPayedNum = $bs->popUint32_t(); // 反序列化完成付款后的锁定数量  类型为uint32_t
			$this->cStockPayedNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockProPayedNum = $bs->popUint32_t(); // 反序列化促销付款后的锁定数量  类型为uint32_t
			$this->cStockProPayedNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockRealSynNum = $bs->popUint32_t(); // 反序列化合作伙伴真实同步数量   类型为uint32_t
			$this->cStockRealSynNum_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStockPromotionDesc = $bs->popString(); // 反序列化库存促销语   类型为std::string
			$this->cStockPromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strStoreHouseName = $bs->popString(); // 反序列化仓库名称   类型为std::string
			$this->cStoreHouseName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockMinBuyCount = $bs->popUint32_t(); // 反序列化起购数量 最小购买数量 类型为uint32_t
			$this->cStockMinBuyCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockMaxBuyCount = $bs->popUint32_t(); // 反序列化限购数量 最大购买限制 类型为uint32_t
			$this->cStockMaxBuyCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStockSellMode = $bs->popUint32_t(); // 反序列化合约机业务类型 类型为uint32_t
			$this->cStockSellMode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130308 ){
				$this->dwStockBusinessCost = $bs->popUint32_t(); // 反序列化业务成本 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->cStockBusinessCost_u = $bs->popUint8_t(); // 反序列化业务成本 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->dwStockLimitCode = $bs->popUint32_t(); // 反序列化易迅限运规则编码，具体由易迅侧服务解释 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->cStockLimitCode_u = $bs->popUint8_t(); // 反序列化易迅限运规则编码，具体由易迅侧服务解释 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->dwPromotionType = $bs->popUint32_t(); // 反序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->cPromotionType_u = $bs->popUint8_t(); // 反序列化促销类型 0:普通/1:新品/2:特卖/3:进口/4:限时/5:人气/6:独家/7:首发 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->dwStoreHouseType = $bs->popUint32_t(); // 反序列化仓库类型 0 为逻辑仓 1为物理仓 此字段仅供搜索使用 其他调用不用关心 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->cStoreHouseType_u = $bs->popUint8_t(); // 反序列化仓库类型 0 为逻辑仓 1为物理仓 此字段仅供搜索使用 其他调用不用关心flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->dwStoreHouseCode = $bs->popUint32_t(); // 反序列化合作伙伴侧仓库编码 此字段仅供搜索使用 其他调用不用关心 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->cStoreHouseCode_u = $bs->popUint8_t(); // 反序列化合作伙伴侧仓库编码 此字段仅供搜索使用 其他调用不用关心flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->vecViewIcsonStockExInfo = $bs->popObject('stl_vector<ViewIcsonStockExInfoPo>'); // 反序列化易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员 类型为std::vector<b2b2c::detailview::po::CViewIcsonStockExInfoPo> 
			}
			if(  $this->dwVersion >= 20130327 ){
				$this->cViewIcsonStockExInfo_u = $bs->popUint8_t(); // 反序列化易迅分站扩展信息，包括二手商品信息和爱车宝属性信息，保存在这个po中, 只支持1个成员 类型为uint8_t
			}

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewStockPo.java

if (!class_exists('ViewIcsonStockExInfoPo',false)) {
class ViewIcsonStockExInfoPo
{
		/**
		 * 版本号, version需要小写
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $ddwSkuid; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuid_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $dwStorehouseid; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStorehouseid_u; //uint8_t

		/**
		 * 二手商品来源
		 *
		 * 版本 >= 0
		 */
		var $dwSndSource; //uint32_t

		/**
		 * 二手商品来源  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndSource_u; //uint8_t

		/**
		 * 二手保修截止时间
		 *
		 * 版本 >= 0
		 */
		var $dwSndWarrantyTime; //uint32_t

		/**
		 * 二手保修截止时间  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndWarrantyTime_u; //uint8_t

		/**
		 * 二手商品品相
		 *
		 * 版本 >= 0
		 */
		var $dwSndClass; //uint32_t

		/**
		 * 二手商品品相  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndClass_u; //uint8_t

		/**
		 * 二手商品性能
		 *
		 * 版本 >= 0
		 */
		var $dwSndPerformance; //uint32_t

		/**
		 * 二手商品性能  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndPerformance_u; //uint8_t

		/**
		 * 二手顾客使用时间
		 *
		 * 版本 >= 0
		 */
		var $dwSndUsedDays; //uint32_t

		/**
		 * 二手顾客使用时间  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndUsedDays_u; //uint8_t

		/**
		 * 二手是否实物拍摄 0：没有，1：有
		 *
		 * 版本 >= 0
		 */
		var $dwSndHavePhoto; //uint32_t

		/**
		 * 二手是否实物拍摄  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndHavePhoto_u; //uint8_t

		/**
		 * 二手备注信息
		 *
		 * 版本 >= 0
		 */
		var $strSndMemo; //std::string

		/**
		 * 二手备注信息  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndMemo_u; //uint8_t

		/**
		 * 二手包装附件
		 *
		 * 版本 >= 0
		 */
		var $strSndAttach; //std::string

		/**
		 * 二手包装附件  flag
		 *
		 * 版本 >= 0
		 */
		var $cSndAttach_u; //uint8_t

		/**
		 * 爱车宝扩展属性类目信息
		 *
		 * 版本 >= 0
		 */
		var $strCarAttrInfo; //std::string

		/**
		 * 爱车宝扩展属性类目信息 flag
		 *
		 * 版本 >= 0
		 */
		var $cCarAttrInfo_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $dwCreatedTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCreatedTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $dwLastUpdatedTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdatedTime_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuid = 0; // uint64_t
			 $this->cSkuid_u = 0; // uint8_t
			 $this->dwStorehouseid = 0; // uint32_t
			 $this->cStorehouseid_u = 0; // uint8_t
			 $this->dwSndSource = 0; // uint32_t
			 $this->cSndSource_u = 0; // uint8_t
			 $this->dwSndWarrantyTime = 0; // uint32_t
			 $this->cSndWarrantyTime_u = 0; // uint8_t
			 $this->dwSndClass = 0; // uint32_t
			 $this->cSndClass_u = 0; // uint8_t
			 $this->dwSndPerformance = 0; // uint32_t
			 $this->cSndPerformance_u = 0; // uint8_t
			 $this->dwSndUsedDays = 0; // uint32_t
			 $this->cSndUsedDays_u = 0; // uint8_t
			 $this->dwSndHavePhoto = 0; // uint32_t
			 $this->cSndHavePhoto_u = 0; // uint8_t
			 $this->strSndMemo = ""; // std::string
			 $this->cSndMemo_u = 0; // uint8_t
			 $this->strSndAttach = ""; // std::string
			 $this->cSndAttach_u = 0; // uint8_t
			 $this->strCarAttrInfo = ""; // std::string
			 $this->cCarAttrInfo_u = 0; // uint8_t
			 $this->dwCreatedTime = 0; // uint32_t
			 $this->cCreatedTime_u = 0; // uint8_t
			 $this->dwLastUpdatedTime = 0; // uint32_t
			 $this->cLastUpdatedTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号, version需要小写 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuid); // 序列化 类型为uint64_t
			$bs->pushUint8_t($this->cSkuid_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStorehouseid); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cStorehouseid_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndSource); // 序列化二手商品来源 类型为uint32_t
			$bs->pushUint8_t($this->cSndSource_u); // 序列化二手商品来源  flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSndWarrantyTime); // 序列化二手保修截止时间 类型为uint32_t
			$bs->pushUint8_t($this->cSndWarrantyTime_u); // 序列化二手保修截止时间  flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSndClass); // 序列化二手商品品相 类型为uint32_t
			$bs->pushUint8_t($this->cSndClass_u); // 序列化二手商品品相  flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSndPerformance); // 序列化二手商品性能 类型为uint32_t
			$bs->pushUint8_t($this->cSndPerformance_u); // 序列化二手商品性能  flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSndUsedDays); // 序列化二手顾客使用时间 类型为uint32_t
			$bs->pushUint8_t($this->cSndUsedDays_u); // 序列化二手顾客使用时间  flag 类型为uint8_t
			$bs->pushUint32_t($this->dwSndHavePhoto); // 序列化二手是否实物拍摄 0：没有，1：有 类型为uint32_t
			$bs->pushUint8_t($this->cSndHavePhoto_u); // 序列化二手是否实物拍摄  flag 类型为uint8_t
			$bs->pushString($this->strSndMemo); // 序列化二手备注信息 类型为std::string
			$bs->pushUint8_t($this->cSndMemo_u); // 序列化二手备注信息  flag 类型为uint8_t
			$bs->pushString($this->strSndAttach); // 序列化二手包装附件 类型为std::string
			$bs->pushUint8_t($this->cSndAttach_u); // 序列化二手包装附件  flag 类型为uint8_t
			$bs->pushString($this->strCarAttrInfo); // 序列化爱车宝扩展属性类目信息 类型为std::string
			$bs->pushUint8_t($this->cCarAttrInfo_u); // 序列化爱车宝扩展属性类目信息 flag 类型为uint8_t
			$bs->pushUint32_t($this->dwCreatedTime); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cCreatedTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpdatedTime); // 序列化 类型为uint32_t
			$bs->pushUint8_t($this->cLastUpdatedTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号, version需要小写 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuid = $bs->popUint64_t(); // 反序列化 类型为uint64_t
			$this->cSkuid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStorehouseid = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cStorehouseid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndSource = $bs->popUint32_t(); // 反序列化二手商品来源 类型为uint32_t
			$this->cSndSource_u = $bs->popUint8_t(); // 反序列化二手商品来源  flag 类型为uint8_t
			$this->dwSndWarrantyTime = $bs->popUint32_t(); // 反序列化二手保修截止时间 类型为uint32_t
			$this->cSndWarrantyTime_u = $bs->popUint8_t(); // 反序列化二手保修截止时间  flag 类型为uint8_t
			$this->dwSndClass = $bs->popUint32_t(); // 反序列化二手商品品相 类型为uint32_t
			$this->cSndClass_u = $bs->popUint8_t(); // 反序列化二手商品品相  flag 类型为uint8_t
			$this->dwSndPerformance = $bs->popUint32_t(); // 反序列化二手商品性能 类型为uint32_t
			$this->cSndPerformance_u = $bs->popUint8_t(); // 反序列化二手商品性能  flag 类型为uint8_t
			$this->dwSndUsedDays = $bs->popUint32_t(); // 反序列化二手顾客使用时间 类型为uint32_t
			$this->cSndUsedDays_u = $bs->popUint8_t(); // 反序列化二手顾客使用时间  flag 类型为uint8_t
			$this->dwSndHavePhoto = $bs->popUint32_t(); // 反序列化二手是否实物拍摄 0：没有，1：有 类型为uint32_t
			$this->cSndHavePhoto_u = $bs->popUint8_t(); // 反序列化二手是否实物拍摄  flag 类型为uint8_t
			$this->strSndMemo = $bs->popString(); // 反序列化二手备注信息 类型为std::string
			$this->cSndMemo_u = $bs->popUint8_t(); // 反序列化二手备注信息  flag 类型为uint8_t
			$this->strSndAttach = $bs->popString(); // 反序列化二手包装附件 类型为std::string
			$this->cSndAttach_u = $bs->popUint8_t(); // 反序列化二手包装附件  flag 类型为uint8_t
			$this->strCarAttrInfo = $bs->popString(); // 反序列化爱车宝扩展属性类目信息 类型为std::string
			$this->cCarAttrInfo_u = $bs->popUint8_t(); // 反序列化爱车宝扩展属性类目信息 flag 类型为uint8_t
			$this->dwCreatedTime = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cCreatedTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastUpdatedTime = $bs->popUint32_t(); // 反序列化 类型为uint32_t
			$this->cLastUpdatedTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewSkuPo.java

if (!class_exists('ViewSkuPicturePo',false)) {
class ViewSkuPicturePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * sku 图片ID 自动生成 目前没用 
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuPicId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuPicId_u; //uint8_t

		/**
		 * sku 图片大小列表,如：'60' '80' 
		 *
		 * 版本 >= 0
		 */
		var $setSkuPicSize; //std::set<std::string> 

		/**
		 * 版本 >= 0
		 */
		var $cSkuPicSize_u; //uint8_t

		/**
		 * sku 图片编号 
		 *
		 * 版本 >= 0
		 */
		var $cSkuPicIndex; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuPicIndex_u; //uint8_t

		/**
		 * sku 图片类型,jpg&gif  
		 *
		 * 版本 >= 0
		 */
		var $strSkuPicType; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuPicType_u; //uint8_t

		/**
		 * sku 图片属性 参见enum SkuProperty
		 *
		 * 版本 >= 0
		 */
		var $bitsetSkuProperty; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cSkuProperty_u; //uint8_t

		/**
		 * sku 图片描述  
		 *
		 * 版本 >= 0
		 */
		var $strSkuPicDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSkuPicDesc_u; //uint8_t

		/**
		 * sku 图片最后更新时间  
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * sku 图片最后更新时间 flag
		 *
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t

		/**
		 * 图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E 
		 *
		 * 版本 >= 0
		 */
		var $mapLogoUrl; //std::map<std::string,std::string> 

		/**
		 * Url map flag
		 *
		 * 版本 >= 0
		 */
		var $cLogoUrl_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuPicId = 0; // uint64_t
			 $this->cSkuPicId_u = 0; // uint8_t
			 $this->setSkuPicSize = new stl_set('stl_string'); // std::set<std::string> 
			 $this->cSkuPicSize_u = 0; // uint8_t
			 $this->cSkuPicIndex = 0; // uint8_t
			 $this->cSkuPicIndex_u = 0; // uint8_t
			 $this->strSkuPicType = ""; // std::string
			 $this->cSkuPicType_u = 0; // uint8_t
			 $this->bitsetSkuProperty = new stl_bitset('32'); // std::bitset<32> 
			 $this->cSkuProperty_u = 0; // uint8_t
			 $this->strSkuPicDesc = ""; // std::string
			 $this->cSkuPicDesc_u = 0; // uint8_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
			 $this->mapLogoUrl = new stl_map('stl_string,stl_string'); // std::map<std::string,std::string> 
			 $this->cLogoUrl_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuPicId); // 序列化sku 图片ID 自动生成 目前没用  类型为uint64_t
			$bs->pushUint8_t($this->cSkuPicId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setSkuPicSize,'stl_set'); // 序列化sku 图片大小列表,如：'60' '80'  类型为std::set<std::string> 
			$bs->pushUint8_t($this->cSkuPicSize_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSkuPicIndex); // 序列化sku 图片编号  类型为uint8_t
			$bs->pushUint8_t($this->cSkuPicIndex_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuPicType); // 序列化sku 图片类型,jpg&gif   类型为std::string
			$bs->pushUint8_t($this->cSkuPicType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetSkuProperty,'stl_bitset'); // 序列化sku 图片属性 参见enum SkuProperty 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cSkuProperty_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSkuPicDesc); // 序列化sku 图片描述   类型为std::string
			$bs->pushUint8_t($this->cSkuPicDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化sku 图片最后更新时间   类型为uint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化sku 图片最后更新时间 flag 类型为uint8_t
			$bs->pushObject($this->mapLogoUrl,'stl_map'); // 序列化图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E  类型为std::map<std::string,std::string> 
			$bs->pushUint8_t($this->cLogoUrl_u); // 序列化Url map flag 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuPicId = $bs->popUint64_t(); // 反序列化sku 图片ID 自动生成 目前没用  类型为uint64_t
			$this->cSkuPicId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setSkuPicSize = $bs->popObject('stl_set<stl_string>'); // 反序列化sku 图片大小列表,如：'60' '80'  类型为std::set<std::string> 
			$this->cSkuPicSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSkuPicIndex = $bs->popUint8_t(); // 反序列化sku 图片编号  类型为uint8_t
			$this->cSkuPicIndex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuPicType = $bs->popString(); // 反序列化sku 图片类型,jpg&gif   类型为std::string
			$this->cSkuPicType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetSkuProperty = $bs->popObject('stl_bitset<32>'); // 反序列化sku 图片属性 参见enum SkuProperty 类型为std::bitset<32> 
			$this->cSkuProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSkuPicDesc = $bs->popString(); // 反序列化sku 图片描述   类型为std::string
			$this->cSkuPicDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化sku 图片最后更新时间   类型为uint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化sku 图片最后更新时间 flag 类型为uint8_t
			$this->mapLogoUrl = $bs->popObject('stl_map<stl_string,stl_string>'); // 反序列化图片Url map size->url 如：http://img0.wgimg.com/qqbuy/855006089/item-00000000000000000000003E86B55530.0.jpg/320?50E2EA7E  类型为std::map<std::string,std::string> 
			$this->cLogoUrl_u = $bs->popUint8_t(); // 反序列化Url map flag 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewSkuPo.java

if (!class_exists('ViewMultPricePo',false)) {
class ViewMultPricePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 地域 id
		 *
		 * 版本 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * 展示价
		 *
		 * 版本 >= 0
		 */
		var $dwPriceViewPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceViewPrice_u; //uint8_t

		/**
		 * 下单价
		 *
		 * 版本 >= 0
		 */
		var $dwPriceDealPrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealPrice_u; //uint8_t

		/**
		 * 下单价描述
		 *
		 * 版本 >= 0
		 */
		var $strPriceDealDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDealDesc_u; //uint8_t

		/**
		 * 展示价与下单价不同原因
		 *
		 * 版本 >= 0
		 */
		var $strPriceDiffReason; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDiffReason_u; //uint8_t

		/**
		 * 多价状态
		 *
		 * 版本 >= 0
		 */
		var $wPriceState; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceState_u; //uint8_t

		/**
		 * 多价属性，用于读
		 *
		 * 版本 >= 0
		 */
		var $bitsetPriceBitProperty; //std::bitset<32> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceBitProperty_u; //uint8_t

		/**
		 * 规则开始时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceStartTime_u; //uint8_t

		/**
		 * 规则结束时间
		 *
		 * 版本 >= 0
		 */
		var $dwPriceEndTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceEndTime_u; //uint8_t

		/**
		 * 多价规则描述
		 *
		 * 版本 >= 0
		 */
		var $strPriceDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceDesc_u; //uint8_t

		/**
		 * 活动规则描述
		 *
		 * 版本 >= 0
		 */
		var $strPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPricePromotionDesc_u; //uint8_t

		/**
		 * 是否限购
		 *
		 * 版本 >= 0
		 */
		var $wPriceBuyLimitFlag; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitFlag_u; //uint8_t

		/**
		 * 限购规则
		 *
		 * 版本 >= 0
		 */
		var $strPriceBuyLimitRule; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cPriceBuyLimitRule_u; //uint8_t

		/**
		 * 验证类型
		 *
		 * 版本 >= 0
		 */
		var $wPriceVerifyType; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cPriceVerifyType_u; //uint8_t

		/**
		 * timed price,基于时间维度多价 可以有多个
		 *
		 * 版本 >= 0
		 */
		var $vecViewTimedPrice; //std::vector<b2b2c::detailview::po::CViewTimedPricePo> 

		/**
		 * 版本 >= 0
		 */
		var $cViewTimedPrice_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->dwPriceViewPrice = 0; // uint32_t
			 $this->cPriceViewPrice_u = 0; // uint8_t
			 $this->dwPriceDealPrice = 0; // uint32_t
			 $this->cPriceDealPrice_u = 0; // uint8_t
			 $this->strPriceDealDesc = ""; // std::string
			 $this->cPriceDealDesc_u = 0; // uint8_t
			 $this->strPriceDiffReason = ""; // std::string
			 $this->cPriceDiffReason_u = 0; // uint8_t
			 $this->wPriceState = 0; // uint16_t
			 $this->cPriceState_u = 0; // uint8_t
			 $this->bitsetPriceBitProperty = new stl_bitset('32'); // std::bitset<32> 
			 $this->cPriceBitProperty_u = 0; // uint8_t
			 $this->dwPriceStartTime = 0; // uint32_t
			 $this->cPriceStartTime_u = 0; // uint8_t
			 $this->dwPriceEndTime = 0; // uint32_t
			 $this->cPriceEndTime_u = 0; // uint8_t
			 $this->strPriceDesc = ""; // std::string
			 $this->cPriceDesc_u = 0; // uint8_t
			 $this->strPricePromotionDesc = ""; // std::string
			 $this->cPricePromotionDesc_u = 0; // uint8_t
			 $this->wPriceBuyLimitFlag = 0; // uint16_t
			 $this->cPriceBuyLimitFlag_u = 0; // uint8_t
			 $this->strPriceBuyLimitRule = ""; // std::string
			 $this->cPriceBuyLimitRule_u = 0; // uint8_t
			 $this->wPriceVerifyType = 0; // uint16_t
			 $this->cPriceVerifyType_u = 0; // uint8_t
			 $this->vecViewTimedPrice = new stl_vector('ViewTimedPricePo'); // std::vector<b2b2c::detailview::po::CViewTimedPricePo> 
			 $this->cViewTimedPrice_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域 id 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceViewPrice); // 序列化展示价 类型为uint32_t
			$bs->pushUint8_t($this->cPriceViewPrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceDealPrice); // 序列化下单价 类型为uint32_t
			$bs->pushUint8_t($this->cPriceDealPrice_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDealDesc); // 序列化下单价描述 类型为std::string
			$bs->pushUint8_t($this->cPriceDealDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDiffReason); // 序列化展示价与下单价不同原因 类型为std::string
			$bs->pushUint8_t($this->cPriceDiffReason_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceState); // 序列化多价状态 类型为uint16_t
			$bs->pushUint8_t($this->cPriceState_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetPriceBitProperty,'stl_bitset'); // 序列化多价属性，用于读 类型为std::bitset<32> 
			$bs->pushUint8_t($this->cPriceBitProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceStartTime); // 序列化规则开始时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwPriceEndTime); // 序列化规则结束时间 类型为uint32_t
			$bs->pushUint8_t($this->cPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceDesc); // 序列化多价规则描述 类型为std::string
			$bs->pushUint8_t($this->cPriceDesc_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPricePromotionDesc); // 序列化活动规则描述 类型为std::string
			$bs->pushUint8_t($this->cPricePromotionDesc_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceBuyLimitFlag); // 序列化是否限购 类型为uint16_t
			$bs->pushUint8_t($this->cPriceBuyLimitFlag_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strPriceBuyLimitRule); // 序列化限购规则 类型为std::string
			$bs->pushUint8_t($this->cPriceBuyLimitRule_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wPriceVerifyType); // 序列化验证类型 类型为uint16_t
			$bs->pushUint8_t($this->cPriceVerifyType_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->vecViewTimedPrice,'stl_vector'); // 序列化timed price,基于时间维度多价 可以有多个 类型为std::vector<b2b2c::detailview::po::CViewTimedPricePo> 
			$bs->pushUint8_t($this->cViewTimedPrice_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域 id 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceViewPrice = $bs->popUint32_t(); // 反序列化展示价 类型为uint32_t
			$this->cPriceViewPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceDealPrice = $bs->popUint32_t(); // 反序列化下单价 类型为uint32_t
			$this->cPriceDealPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDealDesc = $bs->popString(); // 反序列化下单价描述 类型为std::string
			$this->cPriceDealDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDiffReason = $bs->popString(); // 反序列化展示价与下单价不同原因 类型为std::string
			$this->cPriceDiffReason_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceState = $bs->popUint16_t(); // 反序列化多价状态 类型为uint16_t
			$this->cPriceState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetPriceBitProperty = $bs->popObject('stl_bitset<32>'); // 反序列化多价属性，用于读 类型为std::bitset<32> 
			$this->cPriceBitProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceStartTime = $bs->popUint32_t(); // 反序列化规则开始时间 类型为uint32_t
			$this->cPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwPriceEndTime = $bs->popUint32_t(); // 反序列化规则结束时间 类型为uint32_t
			$this->cPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceDesc = $bs->popString(); // 反序列化多价规则描述 类型为std::string
			$this->cPriceDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPricePromotionDesc = $bs->popString(); // 反序列化活动规则描述 类型为std::string
			$this->cPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceBuyLimitFlag = $bs->popUint16_t(); // 反序列化是否限购 类型为uint16_t
			$this->cPriceBuyLimitFlag_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strPriceBuyLimitRule = $bs->popString(); // 反序列化限购规则 类型为std::string
			$this->cPriceBuyLimitRule_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wPriceVerifyType = $bs->popUint16_t(); // 反序列化验证类型 类型为uint16_t
			$this->cPriceVerifyType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->vecViewTimedPrice = $bs->popObject('stl_vector<ViewTimedPricePo>'); // 反序列化timed price,基于时间维度多价 可以有多个 类型为std::vector<b2b2c::detailview::po::CViewTimedPricePo> 
			$this->cViewTimedPrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewMultPricePo.java

if (!class_exists('ViewTimedPricePo',false)) {
class ViewTimedPricePo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 *  timedPrice 价格
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPricePrice; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPricePrice_u; //uint8_t

		/**
		 *  timedPrice 开始时间 
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceStartTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceStartTime_u; //uint8_t

		/**
		 *  timedPrice 结束时间 
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceEndTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceEndTime_u; //uint8_t

		/**
		 *  timedPrice 属性
		 *
		 * 版本 >= 0
		 */
		var $dwTimedPriceProperty; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cTimedPriceProperty_u; //uint8_t

		/**
		 *  促销语描述
		 *
		 * 版本 >= 0
		 */
		var $strTimedPricePromotionDesc; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cTimedPricePromotionDesc_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwTimedPricePrice = 0; // uint32_t
			 $this->cTimedPricePrice_u = 0; // uint8_t
			 $this->dwTimedPriceStartTime = 0; // uint32_t
			 $this->cTimedPriceStartTime_u = 0; // uint8_t
			 $this->dwTimedPriceEndTime = 0; // uint32_t
			 $this->cTimedPriceEndTime_u = 0; // uint8_t
			 $this->dwTimedPriceProperty = 0; // uint32_t
			 $this->cTimedPriceProperty_u = 0; // uint8_t
			 $this->strTimedPricePromotionDesc = ""; // std::string
			 $this->cTimedPricePromotionDesc_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPricePrice); // 序列化 timedPrice 价格 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPricePrice_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceStartTime); // 序列化 timedPrice 开始时间  类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceStartTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceEndTime); // 序列化 timedPrice 结束时间  类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceEndTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwTimedPriceProperty); // 序列化 timedPrice 属性 类型为uint32_t
			$bs->pushUint8_t($this->cTimedPriceProperty_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strTimedPricePromotionDesc); // 序列化 促销语描述 类型为std::string
			$bs->pushUint8_t($this->cTimedPricePromotionDesc_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPricePrice = $bs->popUint32_t(); // 反序列化 timedPrice 价格 类型为uint32_t
			$this->cTimedPricePrice_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceStartTime = $bs->popUint32_t(); // 反序列化 timedPrice 开始时间  类型为uint32_t
			$this->cTimedPriceStartTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceEndTime = $bs->popUint32_t(); // 反序列化 timedPrice 结束时间  类型为uint32_t
			$this->cTimedPriceEndTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwTimedPriceProperty = $bs->popUint32_t(); // 反序列化 timedPrice 属性 类型为uint32_t
			$this->cTimedPriceProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strTimedPricePromotionDesc = $bs->popString(); // 反序列化 促销语描述 类型为std::string
			$this->cTimedPricePromotionDesc_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewSkuPo.java

if (!class_exists('IcsonInfoPo',false)) {
class IcsonInfoPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * skuid,网购侧唯一
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 易迅产品编号
		 *
		 * 版本 >= 0
		 */
		var $strProductId; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductId_u; //uint8_t

		/**
		 * 品牌编号
		 *
		 * 版本 >= 0
		 */
		var $ddwManufacturerSysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cManufacturerSysNo_u; //uint8_t

		/**
		 * 品牌明文
		 *
		 * 版本 >= 0
		 */
		var $strManufacturerText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cManufacturerText_u; //uint8_t

		/**
		 * 商品型号
		 *
		 * 版本 >= 0
		 */
		var $strProductMode; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductMode_u; //uint8_t

		/**
		 * 大类编号
		 *
		 * 版本 >= 0
		 */
		var $ddwC1SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC1SysNo_u; //uint8_t

		/**
		 * 大类名称
		 *
		 * 版本 >= 0
		 */
		var $strC1Text; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cC1Text_u; //uint8_t

		/**
		 * 中类编号
		 *
		 * 版本 >= 0
		 */
		var $ddwC2SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC2SysNo_u; //uint8_t

		/**
		 * 中类名称
		 *
		 * 版本 >= 0
		 */
		var $strC2Text; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cC2Text_u; //uint8_t

		/**
		 * 小类编号
		 *
		 * 版本 >= 0
		 */
		var $ddwC3SysNo; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cC3SysNo_u; //uint8_t

		/**
		 * 小类名称
		 *
		 * 版本 >= 0
		 */
		var $strC3Text; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cC3Text_u; //uint8_t

		/**
		 * 商品颜色编号
		 *
		 * 版本 >= 0
		 */
		var $ddwProductColor; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductColor_u; //uint8_t

		/**
		 * 商品颜色名称
		 *
		 * 版本 >= 0
		 */
		var $strProductColorText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductColorText_u; //uint8_t

		/**
		 * 商品规格
		 *
		 * 版本 >= 0
		 */
		var $ddwProductSize; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cProductSize_u; //uint8_t

		/**
		 * 商品规格明文
		 *
		 * 版本 >= 0
		 */
		var $strProductSizeText; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cProductSizeText_u; //uint8_t

		/**
		 * 对应主商品的易迅ID
		 *
		 * 版本 >= 0
		 */
		var $ddwMasterProductSysno; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cMasterProductSysno_u; //uint8_t

		/**
		 * 图片数量
		 *
		 * 版本 >= 0
		 */
		var $wShowPicCount; //uint16_t

		/**
		 * 版本 >= 0
		 */
		var $cShowPicCount_u; //uint8_t

		/**
		 * 易迅类目属性信息
		 *
		 * 版本 >= 0
		 */
		var $strAttrs; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cAttrs_u; //uint8_t

		/**
		 * '易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志 
		 *
		 * 版本 >= 0
		 */
		var $strSpecialAttrs; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSpecialAttrs_u; //uint8_t

		/**
		 * 二手商品来源
		 *
		 * 版本 >= 0
		 */
		var $dwSndSource; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndSource_u; //uint8_t

		/**
		 * 二手保修截止时间
		 *
		 * 版本 >= 0
		 */
		var $dwSndWarrantyTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndWarrantyTime_u; //uint8_t

		/**
		 * 二手商品品相
		 *
		 * 版本 >= 0
		 */
		var $dwSndClass; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndClass_u; //uint8_t

		/**
		 * 二手商品性能
		 *
		 * 版本 >= 0
		 */
		var $dwSndPerformance; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndPerformance_u; //uint8_t

		/**
		 * 二手顾客使用时间
		 *
		 * 版本 >= 0
		 */
		var $dwSndUsedDays; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndUsedDays_u; //uint8_t

		/**
		 * 二手是否实物拍摄 0：没有，1：有
		 *
		 * 版本 >= 0
		 */
		var $dwSndHavePhoto; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSndHavePhoto_u; //uint8_t

		/**
		 * 二手备注信息
		 *
		 * 版本 >= 0
		 */
		var $strSndMemo; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSndMemo_u; //uint8_t

		/**
		 * 二手包装附件
		 *
		 * 版本 >= 0
		 */
		var $strSndAttach; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cSndAttach_u; //uint8_t

		/**
		 * 合约机类型
		 *
		 * 版本 >= 20130308
		 */
		var $dwContractSaleMode; //uint32_t

		/**
		 * 合约机类型flag
		 *
		 * 版本 >= 20130308
		 */
		var $cContractSaleMode_u; //uint8_t

		/**
		 * 爱车宝扩展属性类目信息
		 *
		 * 版本 >= 20130308
		 */
		var $strCarAttrInfo; //std::string

		/**
		 * 爱车宝扩展属性类目信息 flag
		 *
		 * 版本 >= 20130308
		 */
		var $cCarAttrInfo_u; //uint8_t

		/**
		 * 爱车宝扩展属性类目信息明文
		 *
		 * 版本 >= 20130308
		 */
		var $strCarAttrInfoText; //std::string

		/**
		 * 爱车宝扩展属性类目信息明文 flag
		 *
		 * 版本 >= 20130308
		 */
		var $cCarAttrInfoText_u; //uint8_t

		/**
		 * 货主
		 *
		 * 版本 >= 20130308
		 */
		var $dwSkuOwner; //uint32_t

		/**
		 * 货主 flag
		 *
		 * 版本 >= 20130308
		 */
		var $cSkuOwner_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 20130308; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->strProductId = ""; // std::string
			 $this->cProductId_u = 0; // uint8_t
			 $this->ddwManufacturerSysNo = 0; // uint64_t
			 $this->cManufacturerSysNo_u = 0; // uint8_t
			 $this->strManufacturerText = ""; // std::string
			 $this->cManufacturerText_u = 0; // uint8_t
			 $this->strProductMode = ""; // std::string
			 $this->cProductMode_u = 0; // uint8_t
			 $this->ddwC1SysNo = 0; // uint64_t
			 $this->cC1SysNo_u = 0; // uint8_t
			 $this->strC1Text = ""; // std::string
			 $this->cC1Text_u = 0; // uint8_t
			 $this->ddwC2SysNo = 0; // uint64_t
			 $this->cC2SysNo_u = 0; // uint8_t
			 $this->strC2Text = ""; // std::string
			 $this->cC2Text_u = 0; // uint8_t
			 $this->ddwC3SysNo = 0; // uint64_t
			 $this->cC3SysNo_u = 0; // uint8_t
			 $this->strC3Text = ""; // std::string
			 $this->cC3Text_u = 0; // uint8_t
			 $this->ddwProductColor = 0; // uint64_t
			 $this->cProductColor_u = 0; // uint8_t
			 $this->strProductColorText = ""; // std::string
			 $this->cProductColorText_u = 0; // uint8_t
			 $this->ddwProductSize = 0; // uint64_t
			 $this->cProductSize_u = 0; // uint8_t
			 $this->strProductSizeText = ""; // std::string
			 $this->cProductSizeText_u = 0; // uint8_t
			 $this->ddwMasterProductSysno = 0; // uint64_t
			 $this->cMasterProductSysno_u = 0; // uint8_t
			 $this->wShowPicCount = 0; // uint16_t
			 $this->cShowPicCount_u = 0; // uint8_t
			 $this->strAttrs = ""; // std::string
			 $this->cAttrs_u = 0; // uint8_t
			 $this->strSpecialAttrs = ""; // std::string
			 $this->cSpecialAttrs_u = 0; // uint8_t
			 $this->dwSndSource = 0; // uint32_t
			 $this->cSndSource_u = 0; // uint8_t
			 $this->dwSndWarrantyTime = 0; // uint32_t
			 $this->cSndWarrantyTime_u = 0; // uint8_t
			 $this->dwSndClass = 0; // uint32_t
			 $this->cSndClass_u = 0; // uint8_t
			 $this->dwSndPerformance = 0; // uint32_t
			 $this->cSndPerformance_u = 0; // uint8_t
			 $this->dwSndUsedDays = 0; // uint32_t
			 $this->cSndUsedDays_u = 0; // uint8_t
			 $this->dwSndHavePhoto = 0; // uint32_t
			 $this->cSndHavePhoto_u = 0; // uint8_t
			 $this->strSndMemo = ""; // std::string
			 $this->cSndMemo_u = 0; // uint8_t
			 $this->strSndAttach = ""; // std::string
			 $this->cSndAttach_u = 0; // uint8_t
			 $this->dwContractSaleMode = 0; // uint32_t
			 $this->cContractSaleMode_u = 0; // uint8_t
			 $this->strCarAttrInfo = ""; // std::string
			 $this->cCarAttrInfo_u = 0; // uint8_t
			 $this->strCarAttrInfoText = ""; // std::string
			 $this->cCarAttrInfoText_u = 0; // uint8_t
			 $this->dwSkuOwner = 0; // uint32_t
			 $this->cSkuOwner_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwSkuId); // 序列化skuid,网购侧唯一 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductId); // 序列化易迅产品编号 类型为std::string
			$bs->pushUint8_t($this->cProductId_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwManufacturerSysNo); // 序列化品牌编号 类型为uint64_t
			$bs->pushUint8_t($this->cManufacturerSysNo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strManufacturerText); // 序列化品牌明文 类型为std::string
			$bs->pushUint8_t($this->cManufacturerText_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductMode); // 序列化商品型号 类型为std::string
			$bs->pushUint8_t($this->cProductMode_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC1SysNo); // 序列化大类编号 类型为uint64_t
			$bs->pushUint8_t($this->cC1SysNo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strC1Text); // 序列化大类名称 类型为std::string
			$bs->pushUint8_t($this->cC1Text_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC2SysNo); // 序列化中类编号 类型为uint64_t
			$bs->pushUint8_t($this->cC2SysNo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strC2Text); // 序列化中类名称 类型为std::string
			$bs->pushUint8_t($this->cC2Text_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwC3SysNo); // 序列化小类编号 类型为uint64_t
			$bs->pushUint8_t($this->cC3SysNo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strC3Text); // 序列化小类名称 类型为std::string
			$bs->pushUint8_t($this->cC3Text_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductColor); // 序列化商品颜色编号 类型为uint64_t
			$bs->pushUint8_t($this->cProductColor_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductColorText); // 序列化商品颜色名称 类型为std::string
			$bs->pushUint8_t($this->cProductColorText_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwProductSize); // 序列化商品规格 类型为uint64_t
			$bs->pushUint8_t($this->cProductSize_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strProductSizeText); // 序列化商品规格明文 类型为std::string
			$bs->pushUint8_t($this->cProductSizeText_u); // 序列化 类型为uint8_t
			$bs->pushUint64_t($this->ddwMasterProductSysno); // 序列化对应主商品的易迅ID 类型为uint64_t
			$bs->pushUint8_t($this->cMasterProductSysno_u); // 序列化 类型为uint8_t
			$bs->pushUint16_t($this->wShowPicCount); // 序列化图片数量 类型为uint16_t
			$bs->pushUint8_t($this->cShowPicCount_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strAttrs); // 序列化易迅类目属性信息 类型为std::string
			$bs->pushUint8_t($this->cAttrs_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSpecialAttrs); // 序列化'易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志  类型为std::string
			$bs->pushUint8_t($this->cSpecialAttrs_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndSource); // 序列化二手商品来源 类型为uint32_t
			$bs->pushUint8_t($this->cSndSource_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndWarrantyTime); // 序列化二手保修截止时间 类型为uint32_t
			$bs->pushUint8_t($this->cSndWarrantyTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndClass); // 序列化二手商品品相 类型为uint32_t
			$bs->pushUint8_t($this->cSndClass_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndPerformance); // 序列化二手商品性能 类型为uint32_t
			$bs->pushUint8_t($this->cSndPerformance_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndUsedDays); // 序列化二手顾客使用时间 类型为uint32_t
			$bs->pushUint8_t($this->cSndUsedDays_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSndHavePhoto); // 序列化二手是否实物拍摄 0：没有，1：有 类型为uint32_t
			$bs->pushUint8_t($this->cSndHavePhoto_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSndMemo); // 序列化二手备注信息 类型为std::string
			$bs->pushUint8_t($this->cSndMemo_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strSndAttach); // 序列化二手包装附件 类型为std::string
			$bs->pushUint8_t($this->cSndAttach_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint32_t($this->dwContractSaleMode); // 序列化合约机类型 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint8_t($this->cContractSaleMode_u); // 序列化合约机类型flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushString($this->strCarAttrInfo); // 序列化爱车宝扩展属性类目信息 类型为std::string
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint8_t($this->cCarAttrInfo_u); // 序列化爱车宝扩展属性类目信息 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushString($this->strCarAttrInfoText); // 序列化爱车宝扩展属性类目信息明文 类型为std::string
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint8_t($this->cCarAttrInfoText_u); // 序列化爱车宝扩展属性类目信息明文 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint32_t($this->dwSkuOwner); // 序列化货主 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$bs->pushUint8_t($this->cSkuOwner_u); // 序列化货主 flag 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化skuid,网购侧唯一 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductId = $bs->popString(); // 反序列化易迅产品编号 类型为std::string
			$this->cProductId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwManufacturerSysNo = $bs->popUint64_t(); // 反序列化品牌编号 类型为uint64_t
			$this->cManufacturerSysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strManufacturerText = $bs->popString(); // 反序列化品牌明文 类型为std::string
			$this->cManufacturerText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductMode = $bs->popString(); // 反序列化商品型号 类型为std::string
			$this->cProductMode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC1SysNo = $bs->popUint64_t(); // 反序列化大类编号 类型为uint64_t
			$this->cC1SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strC1Text = $bs->popString(); // 反序列化大类名称 类型为std::string
			$this->cC1Text_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC2SysNo = $bs->popUint64_t(); // 反序列化中类编号 类型为uint64_t
			$this->cC2SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strC2Text = $bs->popString(); // 反序列化中类名称 类型为std::string
			$this->cC2Text_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwC3SysNo = $bs->popUint64_t(); // 反序列化小类编号 类型为uint64_t
			$this->cC3SysNo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strC3Text = $bs->popString(); // 反序列化小类名称 类型为std::string
			$this->cC3Text_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductColor = $bs->popUint64_t(); // 反序列化商品颜色编号 类型为uint64_t
			$this->cProductColor_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductColorText = $bs->popString(); // 反序列化商品颜色名称 类型为std::string
			$this->cProductColorText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwProductSize = $bs->popUint64_t(); // 反序列化商品规格 类型为uint64_t
			$this->cProductSize_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strProductSizeText = $bs->popString(); // 反序列化商品规格明文 类型为std::string
			$this->cProductSizeText_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->ddwMasterProductSysno = $bs->popUint64_t(); // 反序列化对应主商品的易迅ID 类型为uint64_t
			$this->cMasterProductSysno_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->wShowPicCount = $bs->popUint16_t(); // 反序列化图片数量 类型为uint16_t
			$this->cShowPicCount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strAttrs = $bs->popString(); // 反序列化易迅类目属性信息 类型为std::string
			$this->cAttrs_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSpecialAttrs = $bs->popString(); // 反序列化'易迅侧商品特殊属性，格式为 1:节能减排|2:延保产品，目前用于显示节能减排/延保产品标志  类型为std::string
			$this->cSpecialAttrs_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndSource = $bs->popUint32_t(); // 反序列化二手商品来源 类型为uint32_t
			$this->cSndSource_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndWarrantyTime = $bs->popUint32_t(); // 反序列化二手保修截止时间 类型为uint32_t
			$this->cSndWarrantyTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndClass = $bs->popUint32_t(); // 反序列化二手商品品相 类型为uint32_t
			$this->cSndClass_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndPerformance = $bs->popUint32_t(); // 反序列化二手商品性能 类型为uint32_t
			$this->cSndPerformance_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndUsedDays = $bs->popUint32_t(); // 反序列化二手顾客使用时间 类型为uint32_t
			$this->cSndUsedDays_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSndHavePhoto = $bs->popUint32_t(); // 反序列化二手是否实物拍摄 0：没有，1：有 类型为uint32_t
			$this->cSndHavePhoto_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSndMemo = $bs->popString(); // 反序列化二手备注信息 类型为std::string
			$this->cSndMemo_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strSndAttach = $bs->popString(); // 反序列化二手包装附件 类型为std::string
			$this->cSndAttach_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130308 ){
				$this->dwContractSaleMode = $bs->popUint32_t(); // 反序列化合约机类型 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->cContractSaleMode_u = $bs->popUint8_t(); // 反序列化合约机类型flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->strCarAttrInfo = $bs->popString(); // 反序列化爱车宝扩展属性类目信息 类型为std::string
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->cCarAttrInfo_u = $bs->popUint8_t(); // 反序列化爱车宝扩展属性类目信息 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->strCarAttrInfoText = $bs->popString(); // 反序列化爱车宝扩展属性类目信息明文 类型为std::string
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->cCarAttrInfoText_u = $bs->popUint8_t(); // 反序列化爱车宝扩展属性类目信息明文 flag 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->dwSkuOwner = $bs->popUint32_t(); // 反序列化货主 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130308 ){
				$this->cSkuOwner_u = $bs->popUint8_t(); // 反序列化货主 flag 类型为uint8_t
			}

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.ViewSkuPo.java

if (!class_exists('ViewCooperatorBasePo',false)) {
class ViewCooperatorBasePo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 合作伙伴ID 主帐号如易迅为：855006089
		 *
		 * 版本 >= 0
		 */
		var $dwCooperatorId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * 合作伙伴名称
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorName; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorName_u; //uint8_t

		/**
		 * 合作伙伴地址
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorAddress; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorAddress_u; //uint8_t

		/**
		 * 合作伙伴联系电话
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorPhone; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorPhone_u; //uint8_t

		/**
		 * 合作伙伴传真
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorFax; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorFax_u; //uint8_t

		/**
		 * 合作伙伴邮箱
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorEmail; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorEmail_u; //uint8_t

		/**
		 * 合作伙伴类型 参见enum CooperatorType
		 *
		 * 版本 >= 0
		 */
		var $cCooperatorType; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorType_u; //uint8_t

		/**
		 * 合作伙伴spid
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorSpid; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorSpid_u; //uint8_t

		/**
		 * 合作伙伴状态 参见enum CooperatorState
		 *
		 * 版本 >= 0
		 */
		var $cCooperatorState; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorState_u; //uint8_t

		/**
		 * 合作伙伴简称
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorDiminutive; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorDiminutive_u; //uint8_t

		/**
		 * 合作伙伴所在地简称
		 *
		 * 版本 >= 0
		 */
		var $strCooperatorAddrDiminutive; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorAddrDiminutive_u; //uint8_t

		/**
		 * 客服热线电话
		 *
		 * 版本 >= 0
		 */
		var $strCustomerHotLine; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cCustomerHotLine_u; //uint8_t

		/**
		 * 合作伙伴属性 参见enum CooperatorProperty
		 *
		 * 版本 >= 0
		 */
		var $bitsetCooperatorProperty; //std::bitset<128> 

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorProperty_u; //uint8_t

		/**
		 * 易迅侧商户Id
		 *
		 * 版本 >= 20130513
		 */
		var $dwIcsonCooperatorId; //uint32_t

		/**
		 * 易迅Id_u
		 *
		 * 版本 >= 20130513
		 */
		var $cIcsonCooperatorId_u; //uint8_t

		/**
		 * 合作伙伴英文名
		 *
		 * 版本 >= 20130513
		 */
		var $strCooperatorEnName; //std::string

		/**
		 * 合作伙伴英文名_u
		 *
		 * 版本 >= 20130513
		 */
		var $cCooperatorEnName_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 20130513; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwCooperatorId = 0; // uint32_t
			 $this->cCooperatorId_u = 0; // uint8_t
			 $this->strCooperatorName = ""; // std::string
			 $this->cCooperatorName_u = 0; // uint8_t
			 $this->strCooperatorAddress = ""; // std::string
			 $this->cCooperatorAddress_u = 0; // uint8_t
			 $this->strCooperatorPhone = ""; // std::string
			 $this->cCooperatorPhone_u = 0; // uint8_t
			 $this->strCooperatorFax = ""; // std::string
			 $this->cCooperatorFax_u = 0; // uint8_t
			 $this->strCooperatorEmail = ""; // std::string
			 $this->cCooperatorEmail_u = 0; // uint8_t
			 $this->cCooperatorType = 0; // uint8_t
			 $this->cCooperatorType_u = 0; // uint8_t
			 $this->strCooperatorSpid = ""; // std::string
			 $this->cCooperatorSpid_u = 0; // uint8_t
			 $this->cCooperatorState = 0; // uint8_t
			 $this->cCooperatorState_u = 0; // uint8_t
			 $this->strCooperatorDiminutive = ""; // std::string
			 $this->cCooperatorDiminutive_u = 0; // uint8_t
			 $this->strCooperatorAddrDiminutive = ""; // std::string
			 $this->cCooperatorAddrDiminutive_u = 0; // uint8_t
			 $this->strCustomerHotLine = ""; // std::string
			 $this->cCustomerHotLine_u = 0; // uint8_t
			 $this->bitsetCooperatorProperty = new stl_bitset('128'); // std::bitset<128> 
			 $this->cCooperatorProperty_u = 0; // uint8_t
			 $this->dwIcsonCooperatorId = 0; // uint32_t
			 $this->cIcsonCooperatorId_u = 0; // uint8_t
			 $this->strCooperatorEnName = ""; // std::string
			 $this->cCooperatorEnName_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化版本号 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCooperatorId); // 序列化合作伙伴ID 主帐号如易迅为：855006089 类型为uint32_t
			$bs->pushUint8_t($this->cCooperatorId_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorName); // 序列化合作伙伴名称 类型为std::string
			$bs->pushUint8_t($this->cCooperatorName_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorAddress); // 序列化合作伙伴地址 类型为std::string
			$bs->pushUint8_t($this->cCooperatorAddress_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorPhone); // 序列化合作伙伴联系电话 类型为std::string
			$bs->pushUint8_t($this->cCooperatorPhone_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorFax); // 序列化合作伙伴传真 类型为std::string
			$bs->pushUint8_t($this->cCooperatorFax_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorEmail); // 序列化合作伙伴邮箱 类型为std::string
			$bs->pushUint8_t($this->cCooperatorEmail_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCooperatorType); // 序列化合作伙伴类型 参见enum CooperatorType 类型为uint8_t
			$bs->pushUint8_t($this->cCooperatorType_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorSpid); // 序列化合作伙伴spid 类型为std::string
			$bs->pushUint8_t($this->cCooperatorSpid_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCooperatorState); // 序列化合作伙伴状态 参见enum CooperatorState 类型为uint8_t
			$bs->pushUint8_t($this->cCooperatorState_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorDiminutive); // 序列化合作伙伴简称 类型为std::string
			$bs->pushUint8_t($this->cCooperatorDiminutive_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCooperatorAddrDiminutive); // 序列化合作伙伴所在地简称 类型为std::string
			$bs->pushUint8_t($this->cCooperatorAddrDiminutive_u); // 序列化 类型为uint8_t
			$bs->pushString($this->strCustomerHotLine); // 序列化客服热线电话 类型为std::string
			$bs->pushUint8_t($this->cCustomerHotLine_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->bitsetCooperatorProperty,'stl_bitset'); // 序列化合作伙伴属性 参见enum CooperatorProperty 类型为std::bitset<128> 
			$bs->pushUint8_t($this->cCooperatorProperty_u); // 序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130513 ){
				$bs->pushUint32_t($this->dwIcsonCooperatorId); // 序列化易迅侧商户Id 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130513 ){
				$bs->pushUint8_t($this->cIcsonCooperatorId_u); // 序列化易迅Id_u 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130513 ){
				$bs->pushString($this->strCooperatorEnName); // 序列化合作伙伴英文名 类型为std::string
			}
			if(  $this->dwVersion >= 20130513 ){
				$bs->pushUint8_t($this->cCooperatorEnName_u); // 序列化合作伙伴英文名_u 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化版本号 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCooperatorId = $bs->popUint32_t(); // 反序列化合作伙伴ID 主帐号如易迅为：855006089 类型为uint32_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorName = $bs->popString(); // 反序列化合作伙伴名称 类型为std::string
			$this->cCooperatorName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorAddress = $bs->popString(); // 反序列化合作伙伴地址 类型为std::string
			$this->cCooperatorAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorPhone = $bs->popString(); // 反序列化合作伙伴联系电话 类型为std::string
			$this->cCooperatorPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorFax = $bs->popString(); // 反序列化合作伙伴传真 类型为std::string
			$this->cCooperatorFax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorEmail = $bs->popString(); // 反序列化合作伙伴邮箱 类型为std::string
			$this->cCooperatorEmail_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCooperatorType = $bs->popUint8_t(); // 反序列化合作伙伴类型 参见enum CooperatorType 类型为uint8_t
			$this->cCooperatorType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorSpid = $bs->popString(); // 反序列化合作伙伴spid 类型为std::string
			$this->cCooperatorSpid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCooperatorState = $bs->popUint8_t(); // 反序列化合作伙伴状态 参见enum CooperatorState 类型为uint8_t
			$this->cCooperatorState_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorDiminutive = $bs->popString(); // 反序列化合作伙伴简称 类型为std::string
			$this->cCooperatorDiminutive_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCooperatorAddrDiminutive = $bs->popString(); // 反序列化合作伙伴所在地简称 类型为std::string
			$this->cCooperatorAddrDiminutive_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->strCustomerHotLine = $bs->popString(); // 反序列化客服热线电话 类型为std::string
			$this->cCustomerHotLine_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->bitsetCooperatorProperty = $bs->popObject('stl_bitset<128>'); // 反序列化合作伙伴属性 参见enum CooperatorProperty 类型为std::bitset<128> 
			$this->cCooperatorProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->dwVersion >= 20130513 ){
				$this->dwIcsonCooperatorId = $bs->popUint32_t(); // 反序列化易迅侧商户Id 类型为uint32_t
			}
			if(  $this->dwVersion >= 20130513 ){
				$this->cIcsonCooperatorId_u = $bs->popUint8_t(); // 反序列化易迅Id_u 类型为uint8_t
			}
			if(  $this->dwVersion >= 20130513 ){
				$this->strCooperatorEnName = $bs->popString(); // 反序列化合作伙伴英文名 类型为std::string
			}
			if(  $this->dwVersion >= 20130513 ){
				$this->cCooperatorEnName_u = $bs->popUint8_t(); // 反序列化合作伙伴英文名_u 类型为uint8_t
			}

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.BatchGetMultPriceRule4PromotionReq.java

if (!class_exists('ViewMultPriceQueryPo',false)) {
class ViewMultPriceQueryPo
{
		/**
		 *  版本号   
		 *
		 * 版本 >= 0
		 */
		var $dwVersion; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 合作伙伴帐号 必填
		 *
		 * 版本 >= 0
		 */
		var $dwCooperatorId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cCooperatorId_u; //uint8_t

		/**
		 * 地域 id，选填 用于选仓
		 *
		 * 版本 >= 0
		 */
		var $dwRegionId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cRegionId_u; //uint8_t

		/**
		 * 特殊id，转换后的分站id 选填 用于过滤多价
		 *
		 * 版本 >= 0
		 */
		var $dwSpecialId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSpecialId_u; //uint8_t

		/**
		 * 场景 id，选填
		 *
		 * 版本 >= 0
		 */
		var $setPriceSceneId; //std::set<uint64_t> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceSceneId_u; //uint8_t

		/**
		 * 来源 id，选填
		 *
		 * 版本 >= 0
		 */
		var $setPriceSourceId; //std::set<uint64_t> 

		/**
		 * 版本 >= 0
		 */
		var $cPriceSourceId_u; //uint8_t


		 function __construct() {
			 $this->dwVersion = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->dwCooperatorId = 0; // uint32_t
			 $this->cCooperatorId_u = 0; // uint8_t
			 $this->dwRegionId = 0; // uint32_t
			 $this->cRegionId_u = 0; // uint8_t
			 $this->dwSpecialId = 0; // uint32_t
			 $this->cSpecialId_u = 0; // uint8_t
			 $this->setPriceSceneId = new stl_set('uint64_t'); // std::set<uint64_t> 
			 $this->cPriceSceneId_u = 0; // uint8_t
			 $this->setPriceSourceId = new stl_set('uint64_t'); // std::set<uint64_t> 
			 $this->cPriceSourceId_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint32_t($this->dwVersion); // 序列化 版本号    类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwCooperatorId); // 序列化合作伙伴帐号 必填 类型为uint32_t
			$bs->pushUint8_t($this->cCooperatorId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwRegionId); // 序列化地域 id，选填 用于选仓 类型为uint32_t
			$bs->pushUint8_t($this->cRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSpecialId); // 序列化特殊id，转换后的分站id 选填 用于过滤多价 类型为uint32_t
			$bs->pushUint8_t($this->cSpecialId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setPriceSceneId,'stl_set'); // 序列化场景 id，选填 类型为std::set<uint64_t> 
			$bs->pushUint8_t($this->cPriceSceneId_u); // 序列化 类型为uint8_t
			$bs->pushObject($this->setPriceSourceId,'stl_set'); // 序列化来源 id，选填 类型为std::set<uint64_t> 
			$bs->pushUint8_t($this->cPriceSourceId_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->dwVersion = $bs->popUint32_t(); // 反序列化 版本号    类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwCooperatorId = $bs->popUint32_t(); // 反序列化合作伙伴帐号 必填 类型为uint32_t
			$this->cCooperatorId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwRegionId = $bs->popUint32_t(); // 反序列化地域 id，选填 用于选仓 类型为uint32_t
			$this->cRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSpecialId = $bs->popUint32_t(); // 反序列化特殊id，转换后的分站id 选填 用于过滤多价 类型为uint32_t
			$this->cSpecialId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setPriceSceneId = $bs->popObject('stl_set<uint64_t>'); // 反序列化场景 id，选填 类型为std::set<uint64_t> 
			$this->cPriceSceneId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->setPriceSourceId = $bs->popObject('stl_set<uint64_t>'); // 反序列化来源 id，选填 类型为std::set<uint64_t> 
			$this->cPriceSourceId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}


//source idl: com.b2b2c.sku.idl.BatchGetIcsonCrossSaleRelationResp.java

if (!class_exists('ViewCrossSaleRelationPo',false)) {
class ViewCrossSaleRelationPo
{
		/**
		 * Skuid，保存时可以不赋值,在接口参数上指定易迅SysNo
		 *
		 * 版本 >= 0
		 */
		var $ddwSkuId; //uint64_t

		/**
		 * 版本 >= 0
		 */
		var $cSkuId_u; //uint8_t

		/**
		 * 统一平台侧仓库Id，发货源
		 *
		 * 版本 >= 0
		 */
		var $dwStorehouseId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cStorehouseId_u; //uint8_t

		/**
		 * 可销售仓库ID
		 *
		 * 版本 >= 0
		 */
		var $dwSalesStoreHouseId; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cSalesStoreHouseId_u; //uint8_t

		/**
		 * 状态, 0:正常 1：作废
		 *
		 * 版本 >= 0
		 */
		var $cStatus; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 新增时间
		 *
		 * 版本 >= 0
		 */
		var $dwAddTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cAddTime_u; //uint8_t

		/**
		 * 最后修改时间
		 *
		 * 版本 >= 0
		 */
		var $dwLastUpdateTime; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cLastUpdateTime_u; //uint8_t


		 function __construct() {
			 $this->ddwSkuId = 0; // uint64_t
			 $this->cSkuId_u = 0; // uint8_t
			 $this->dwStorehouseId = 0; // uint32_t
			 $this->cStorehouseId_u = 0; // uint8_t
			 $this->dwSalesStoreHouseId = 0; // uint32_t
			 $this->cSalesStoreHouseId_u = 0; // uint8_t
			 $this->cStatus = 0; // uint8_t
			 $this->cStatus_u = 0; // uint8_t
			 $this->dwAddTime = 0; // uint32_t
			 $this->cAddTime_u = 0; // uint8_t
			 $this->dwLastUpdateTime = 0; // uint32_t
			 $this->cLastUpdateTime_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint64_t($this->ddwSkuId); // 序列化Skuid，保存时可以不赋值,在接口参数上指定易迅SysNo 类型为uint64_t
			$bs->pushUint8_t($this->cSkuId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwStorehouseId); // 序列化统一平台侧仓库Id，发货源 类型为uint32_t
			$bs->pushUint8_t($this->cStorehouseId_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwSalesStoreHouseId); // 序列化可销售仓库ID 类型为uint32_t
			$bs->pushUint8_t($this->cSalesStoreHouseId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStatus); // 序列化状态, 0:正常 1：作废 类型为uint8_t
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwAddTime); // 序列化新增时间 类型为uint32_t
			$bs->pushUint8_t($this->cAddTime_u); // 序列化 类型为uint8_t
			$bs->pushUint32_t($this->dwLastUpdateTime); // 序列化最后修改时间 类型为uint32_t
			$bs->pushUint8_t($this->cLastUpdateTime_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->ddwSkuId = $bs->popUint64_t(); // 反序列化Skuid，保存时可以不赋值,在接口参数上指定易迅SysNo 类型为uint64_t
			$this->cSkuId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwStorehouseId = $bs->popUint32_t(); // 反序列化统一平台侧仓库Id，发货源 类型为uint32_t
			$this->cStorehouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwSalesStoreHouseId = $bs->popUint32_t(); // 反序列化可销售仓库ID 类型为uint32_t
			$this->cSalesStoreHouseId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStatus = $bs->popUint8_t(); // 反序列化状态, 0:正常 1：作废 类型为uint8_t
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwAddTime = $bs->popUint32_t(); // 反序列化新增时间 类型为uint32_t
			$this->cAddTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->dwLastUpdateTime = $bs->popUint32_t(); // 反序列化最后修改时间 类型为uint32_t
			$this->cLastUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

			/**********************为了支持多个版本的客户端************************/
			$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
			for ($idx=0; $idx<$needPopLen; $idx++) {
				$bs->popUint8_t();
			}
			/**********************为了支持多个版本的客户端************************/
			

			return $this;
		}

		 function getClassLen() {
			$len_bs = new ByteStream();
			$len_bs->setRealWrite(false);
			$this->serialize_internal($len_bs);
			$class_len = $len_bs->getWrittenLength();

			return $class_len;
		}

}
}
?>