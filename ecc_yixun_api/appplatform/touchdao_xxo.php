<?php

//source idl: com.b2b2c.touch.idl.TouchDao.java

if (!class_exists('TouchAtTimeDo')) {
class TouchAtTimeDo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 渠道ID(1 Tips  2 短信 3 邮件 4 站内信)
		 *
		 * 版本 >= 0
		 */
		var $dwChannel; //uint32_t

		/**
		 * 业务类型
		 *
		 * 版本 >= 0
		 */
		var $dwBusinessType; //uint32_t

		/**
		 * 关联业务号
		 *
		 * 版本 >= 0
		 */
		var $strBusinessId; //std::string

		/**
		 * 环节ID(子业务ID)
		 *
		 * 版本 >= 0
		 */
		var $dwFlowId; //uint32_t

		/**
		 * 是否可合并
		 *
		 * 版本 >= 0
		 */
		var $dwCombine; //uint32_t

		/**
		 * 期望发送时间
		 *
		 * 版本 >= 0
		 */
		var $dwExpectTime; //uint32_t

		/**
		 * 有效时间(在此时间内可发送，可合并)
		 *
		 * 版本 >= 0
		 */
		var $dwExpireTime; //uint32_t

		/**
		 * 用户ID
		 *
		 * 版本 >= 0
		 */
		var $ddwUin; //uint64_t

		/**
		 * 用户收货手机
		 *
		 * 版本 >= 0
		 */
		var $strMobile; //std::string

		/**
		 * 模板ID
		 *
		 * 版本 >= 0
		 */
		var $dwTemplate; //uint32_t

		/**
		 * 消息内容
		 *
		 * 版本 >= 0
		 */
		var $strContent; //std::string

		/**
		 * 扩展字段一
		 *
		 * 版本 >= 0
		 */
		var $strExt1; //std::string

		/**
		 * 扩展字段二
		 *
		 * 版本 >= 0
		 */
		var $dwExt2; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cChannel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFlowId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCombine_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpectTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpireTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUin_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTemplate_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cContent_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt2_u; //uint8_t

		/**
		 * 触达ID
		 *
		 * 版本 >= 1
		 */
		var $ddwId; //uint64_t

		/**
		 * 消息内容列表
		 *
		 * 版本 >= 1
		 */
		var $vecContentVector; //std::vector<std::string> 

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cContentVector_u; //uint8_t

		/**
		 * 触达对象（QQ/手机/邮箱地址）
		 *
		 * 版本 >= 2
		 */
		var $strTarget; //std::string

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cTarget_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwChannel = 0; // uint32_t
			 $this->dwBusinessType = 0; // uint32_t
			 $this->strBusinessId = ""; // std::string
			 $this->dwFlowId = 0; // uint32_t
			 $this->dwCombine = 0; // uint32_t
			 $this->dwExpectTime = 0; // uint32_t
			 $this->dwExpireTime = 0; // uint32_t
			 $this->ddwUin = 0; // uint64_t
			 $this->strMobile = ""; // std::string
			 $this->dwTemplate = 0; // uint32_t
			 $this->strContent = ""; // std::string
			 $this->strExt1 = ""; // std::string
			 $this->dwExt2 = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cChannel_u = 0; // uint8_t
			 $this->cBusinessType_u = 0; // uint8_t
			 $this->cBusinessId_u = 0; // uint8_t
			 $this->cFlowId_u = 0; // uint8_t
			 $this->cCombine_u = 0; // uint8_t
			 $this->cExpectTime_u = 0; // uint8_t
			 $this->cExpireTime_u = 0; // uint8_t
			 $this->cUin_u = 0; // uint8_t
			 $this->cMobile_u = 0; // uint8_t
			 $this->cTemplate_u = 0; // uint8_t
			 $this->cContent_u = 0; // uint8_t
			 $this->cExt1_u = 0; // uint8_t
			 $this->cExt2_u = 0; // uint8_t
			 $this->ddwId = 0; // uint64_t
			 $this->vecContentVector = new stl_vector('stl_string'); // std::vector<std::string> 
			 $this->cId_u = 0; // uint8_t
			 $this->cContentVector_u = 0; // uint8_t
			 $this->strTarget = ""; // std::string
			 $this->cTarget_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwChannel); // 序列化渠道ID(1 Tips  2 短信 3 邮件 4 站内信) 类型为uint32_t
			$bs->pushUint32_t($this->dwBusinessType); // 序列化业务类型 类型为uint32_t
			$bs->pushString($this->strBusinessId); // 序列化关联业务号 类型为std::string
			$bs->pushUint32_t($this->dwFlowId); // 序列化环节ID(子业务ID) 类型为uint32_t
			$bs->pushUint32_t($this->dwCombine); // 序列化是否可合并 类型为uint32_t
			$bs->pushUint32_t($this->dwExpectTime); // 序列化期望发送时间 类型为uint32_t
			$bs->pushUint32_t($this->dwExpireTime); // 序列化有效时间(在此时间内可发送，可合并) 类型为uint32_t
			$bs->pushUint64_t($this->ddwUin); // 序列化用户ID 类型为uint64_t
			$bs->pushString($this->strMobile); // 序列化用户收货手机 类型为std::string
			$bs->pushUint32_t($this->dwTemplate); // 序列化模板ID 类型为uint32_t
			$bs->pushString($this->strContent); // 序列化消息内容 类型为std::string
			$bs->pushString($this->strExt1); // 序列化扩展字段一 类型为std::string
			$bs->pushUint32_t($this->dwExt2); // 序列化扩展字段二 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cChannel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFlowId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCombine_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpectTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpireTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUin_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTemplate_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cContent_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt2_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwId); // 序列化触达ID 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushObject($this->vecContentVector, 'stl_vector'); // 序列化消息内容列表 类型为std::vector<std::string> 
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cContentVector_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushString($this->strTarget); // 序列化触达对象（QQ/手机/邮箱地址） 类型为std::string
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cTarget_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwChannel = $bs->popUint32_t(); // 反序列化渠道ID(1 Tips  2 短信 3 邮件 4 站内信) 类型为uint32_t
			$this->dwBusinessType = $bs->popUint32_t(); // 反序列化业务类型 类型为uint32_t
			$this->strBusinessId = $bs->popString(); // 反序列化关联业务号 类型为std::string
			$this->dwFlowId = $bs->popUint32_t(); // 反序列化环节ID(子业务ID) 类型为uint32_t
			$this->dwCombine = $bs->popUint32_t(); // 反序列化是否可合并 类型为uint32_t
			$this->dwExpectTime = $bs->popUint32_t(); // 反序列化期望发送时间 类型为uint32_t
			$this->dwExpireTime = $bs->popUint32_t(); // 反序列化有效时间(在此时间内可发送，可合并) 类型为uint32_t
			$this->ddwUin = $bs->popUint64_t(); // 反序列化用户ID 类型为uint64_t
			$this->strMobile = $bs->popString(); // 反序列化用户收货手机 类型为std::string
			$this->dwTemplate = $bs->popUint32_t(); // 反序列化模板ID 类型为uint32_t
			$this->strContent = $bs->popString(); // 反序列化消息内容 类型为std::string
			$this->strExt1 = $bs->popString(); // 反序列化扩展字段一 类型为std::string
			$this->dwExt2 = $bs->popUint32_t(); // 反序列化扩展字段二 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cChannel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFlowId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCombine_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpectTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpireTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUin_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTemplate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cContent_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->ddwId = $bs->popUint64_t(); // 反序列化触达ID 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->vecContentVector = $bs->popObject('stl_vector<stl_string> '); // 反序列化消息内容列表 类型为std::vector<std::string> 
			}
			if(  $this->wVersion >= 1 ){
				$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cContentVector_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->strTarget = $bs->popString(); // 反序列化触达对象（QQ/手机/邮箱地址） 类型为std::string
			}
			if(  $this->wVersion >= 2 ){
				$this->cTarget_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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


//source idl: com.b2b2c.touch.idl.TouchDao.java

if (!class_exists('TouchDealNoPayDo')) {
class TouchDealNoPayDo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 购买单ID
		 *
		 * 版本 >= 0
		 */
		var $strBdealId; //std::string

		/**
		 * 用户ID
		 *
		 * 版本 >= 0
		 */
		var $ddwUin; //uint64_t

		/**
		 * 下单时间
		 *
		 * 版本 >= 0
		 */
		var $dwCtime; //uint32_t

		/**
		 * 订单类型, 1：普通订单  2：抢购订单
		 *
		 * 版本 >= 0
		 */
		var $dwType; //uint32_t

		/**
		 * 扩展字段一
		 *
		 * 版本 >= 0
		 */
		var $strExt1; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBdealId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUin_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCtime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt1_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->strBdealId = ""; // std::string
			 $this->ddwUin = 0; // uint64_t
			 $this->dwCtime = 0; // uint32_t
			 $this->dwType = 0; // uint32_t
			 $this->strExt1 = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cBdealId_u = 0; // uint8_t
			 $this->cUin_u = 0; // uint8_t
			 $this->cCtime_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cExt1_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushString($this->strBdealId); // 序列化购买单ID 类型为std::string
			$bs->pushUint64_t($this->ddwUin); // 序列化用户ID 类型为uint64_t
			$bs->pushUint32_t($this->dwCtime); // 序列化下单时间 类型为uint32_t
			$bs->pushUint32_t($this->dwType); // 序列化订单类型, 1：普通订单  2：抢购订单 类型为uint32_t
			$bs->pushString($this->strExt1); // 序列化扩展字段一 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBdealId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUin_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCtime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt1_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->strBdealId = $bs->popString(); // 反序列化购买单ID 类型为std::string
			$this->ddwUin = $bs->popUint64_t(); // 反序列化用户ID 类型为uint64_t
			$this->dwCtime = $bs->popUint32_t(); // 反序列化下单时间 类型为uint32_t
			$this->dwType = $bs->popUint32_t(); // 反序列化订单类型, 1：普通订单  2：抢购订单 类型为uint32_t
			$this->strExt1 = $bs->popString(); // 反序列化扩展字段一 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBdealId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUin_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCtime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: com.b2b2c.touch.idl.TouchDao.java

if (!class_exists('TouchRealTimeDo')) {
class TouchRealTimeDo
{
		/**
		 * 协议版本号
		 *
		 * 版本 >= 0
		 */
		var $wVersion; //uint16_t

		/**
		 * 渠道ID(1 Tips  2 短信 3 邮件 4 站内信)
		 *
		 * 版本 >= 0
		 */
		var $dwChannel; //uint32_t

		/**
		 * 业务类型
		 *
		 * 版本 >= 0
		 */
		var $dwBusinessType; //uint32_t

		/**
		 * 关联业务号
		 *
		 * 版本 >= 0
		 */
		var $strBusinessId; //std::string

		/**
		 * 环节ID(子业务ID)
		 *
		 * 版本 >= 0
		 */
		var $dwFlowId; //uint32_t

		/**
		 * 用户ID
		 *
		 * 版本 >= 0
		 */
		var $ddwUin; //uint64_t

		/**
		 * 用户收货手机
		 *
		 * 版本 >= 0
		 */
		var $strMobile; //std::string

		/**
		 * 模板ID
		 *
		 * 版本 >= 0
		 */
		var $dwTemplate; //uint32_t

		/**
		 * 消息内容
		 *
		 * 版本 >= 0
		 */
		var $strContent; //std::string

		/**
		 * 插入时间
		 *
		 * 版本 >= 0
		 */
		var $dwCtime; //uint32_t

		/**
		 * 扩展字段一
		 *
		 * 版本 >= 0
		 */
		var $strExt1; //std::string

		/**
		 * 扩展字段二
		 *
		 * 版本 >= 0
		 */
		var $dwExt2; //uint32_t

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cChannel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBusinessId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFlowId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUin_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTemplate_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cContent_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCtime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt1_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExt2_u; //uint8_t

		/**
		 * 触达ID
		 *
		 * 版本 >= 1
		 */
		var $ddwId; //uint64_t

		/**
		 * 消息内容列表
		 *
		 * 版本 >= 1
		 */
		var $vecContentVector; //std::vector<std::string> 

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cId_u; //uint8_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cContentVector_u; //uint8_t

		/**
		 * 优先级
		 *
		 * 版本 >= 2
		 */
		var $dwPriority; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cPriority_u; //uint8_t

		/**
		 * 失效时间
		 *
		 * 版本 >= 2
		 */
		var $dwExpireTime; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cExpireTime_u; //uint8_t

		/**
		 * 处理时间
		 *
		 * 版本 >= 2
		 */
		var $dwTreatTime; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cTreatTime_u; //uint8_t

		/**
		 * 状态
		 *
		 * 版本 >= 2
		 */
		var $dwStatus; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 2
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 触达对象（QQ/手机/邮箱地址）
		 *
		 * 版本 >= 3
		 */
		var $strTarget; //std::string

		/**
		 * 
		 *
		 * 版本 >= 3
		 */
		var $cTarget_u; //uint8_t


		 function __construct() {
			 $this->wVersion = 0; // uint16_t
			 $this->dwChannel = 0; // uint32_t
			 $this->dwBusinessType = 0; // uint32_t
			 $this->strBusinessId = ""; // std::string
			 $this->dwFlowId = 0; // uint32_t
			 $this->ddwUin = 0; // uint64_t
			 $this->strMobile = ""; // std::string
			 $this->dwTemplate = 0; // uint32_t
			 $this->strContent = ""; // std::string
			 $this->dwCtime = 0; // uint32_t
			 $this->strExt1 = ""; // std::string
			 $this->dwExt2 = 0; // uint32_t
			 $this->cVersion_u = 0; // uint8_t
			 $this->cChannel_u = 0; // uint8_t
			 $this->cBusinessType_u = 0; // uint8_t
			 $this->cBusinessId_u = 0; // uint8_t
			 $this->cFlowId_u = 0; // uint8_t
			 $this->cUin_u = 0; // uint8_t
			 $this->cMobile_u = 0; // uint8_t
			 $this->cTemplate_u = 0; // uint8_t
			 $this->cContent_u = 0; // uint8_t
			 $this->cCtime_u = 0; // uint8_t
			 $this->cExt1_u = 0; // uint8_t
			 $this->cExt2_u = 0; // uint8_t
			 $this->ddwId = 0; // uint64_t
			 $this->vecContentVector = new stl_vector('stl_string'); // std::vector<std::string> 
			 $this->cId_u = 0; // uint8_t
			 $this->cContentVector_u = 0; // uint8_t
			 $this->dwPriority = 0; // uint32_t
			 $this->cPriority_u = 0; // uint8_t
			 $this->dwExpireTime = 0; // uint32_t
			 $this->cExpireTime_u = 0; // uint8_t
			 $this->dwTreatTime = 0; // uint32_t
			 $this->cTreatTime_u = 0; // uint8_t
			 $this->dwStatus = 0; // uint32_t
			 $this->cStatus_u = 0; // uint8_t
			 $this->strTarget = ""; // std::string
			 $this->cTarget_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint16_t($this->wVersion); // 序列化协议版本号 类型为uint16_t
			$bs->pushUint32_t($this->dwChannel); // 序列化渠道ID(1 Tips  2 短信 3 邮件 4 站内信) 类型为uint32_t
			$bs->pushUint32_t($this->dwBusinessType); // 序列化业务类型 类型为uint32_t
			$bs->pushString($this->strBusinessId); // 序列化关联业务号 类型为std::string
			$bs->pushUint32_t($this->dwFlowId); // 序列化环节ID(子业务ID) 类型为uint32_t
			$bs->pushUint64_t($this->ddwUin); // 序列化用户ID 类型为uint64_t
			$bs->pushString($this->strMobile); // 序列化用户收货手机 类型为std::string
			$bs->pushUint32_t($this->dwTemplate); // 序列化模板ID 类型为uint32_t
			$bs->pushString($this->strContent); // 序列化消息内容 类型为std::string
			$bs->pushUint32_t($this->dwCtime); // 序列化插入时间 类型为uint32_t
			$bs->pushString($this->strExt1); // 序列化扩展字段一 类型为std::string
			$bs->pushUint32_t($this->dwExt2); // 序列化扩展字段二 类型为uint32_t
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cChannel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBusinessId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFlowId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUin_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTemplate_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cContent_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCtime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt1_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExt2_u); // 序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$bs->pushUint64_t($this->ddwId); // 序列化触达ID 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushObject($this->vecContentVector, 'stl_vector'); // 序列化消息内容列表 类型为std::vector<std::string> 
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cId_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$bs->pushUint8_t($this->cContentVector_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwPriority); // 序列化优先级 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cPriority_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwExpireTime); // 序列化失效时间 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cExpireTime_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwTreatTime); // 序列化处理时间 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cTreatTime_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint32_t($this->dwStatus); // 序列化状态 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushString($this->strTarget); // 序列化触达对象（QQ/手机/邮箱地址） 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$bs->pushUint8_t($this->cTarget_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->wVersion = $bs->popUint16_t(); // 反序列化协议版本号 类型为uint16_t
			$this->dwChannel = $bs->popUint32_t(); // 反序列化渠道ID(1 Tips  2 短信 3 邮件 4 站内信) 类型为uint32_t
			$this->dwBusinessType = $bs->popUint32_t(); // 反序列化业务类型 类型为uint32_t
			$this->strBusinessId = $bs->popString(); // 反序列化关联业务号 类型为std::string
			$this->dwFlowId = $bs->popUint32_t(); // 反序列化环节ID(子业务ID) 类型为uint32_t
			$this->ddwUin = $bs->popUint64_t(); // 反序列化用户ID 类型为uint64_t
			$this->strMobile = $bs->popString(); // 反序列化用户收货手机 类型为std::string
			$this->dwTemplate = $bs->popUint32_t(); // 反序列化模板ID 类型为uint32_t
			$this->strContent = $bs->popString(); // 反序列化消息内容 类型为std::string
			$this->dwCtime = $bs->popUint32_t(); // 反序列化插入时间 类型为uint32_t
			$this->strExt1 = $bs->popString(); // 反序列化扩展字段一 类型为std::string
			$this->dwExt2 = $bs->popUint32_t(); // 反序列化扩展字段二 类型为uint32_t
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cChannel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBusinessId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFlowId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUin_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTemplate_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cContent_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCtime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt1_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExt2_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->wVersion >= 1 ){
				$this->ddwId = $bs->popUint64_t(); // 反序列化触达ID 类型为uint64_t
			}
			if(  $this->wVersion >= 1 ){
				$this->vecContentVector = $bs->popObject('stl_vector<stl_string> '); // 反序列化消息内容列表 类型为std::vector<std::string> 
			}
			if(  $this->wVersion >= 1 ){
				$this->cId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 1 ){
				$this->cContentVector_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwPriority = $bs->popUint32_t(); // 反序列化优先级 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cPriority_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwExpireTime = $bs->popUint32_t(); // 反序列化失效时间 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cExpireTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwTreatTime = $bs->popUint32_t(); // 反序列化处理时间 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cTreatTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 2 ){
				$this->dwStatus = $bs->popUint32_t(); // 反序列化状态 类型为uint32_t
			}
			if(  $this->wVersion >= 2 ){
				$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->wVersion >= 3 ){
				$this->strTarget = $bs->popString(); // 反序列化触达对象（QQ/手机/邮箱地址） 类型为std::string
			}
			if(  $this->wVersion >= 3 ){
				$this->cTarget_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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

?>