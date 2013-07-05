<?php

//source idl: idl.UserApiAo.java


class CopartnerInvoicePo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 * 发票类型, 1-普通发票（映射1、3）2-增值税普通发票（映射4）3-增值税专用发票（映射2）
		 *
		 * 版本 >= 0
		 */
		var $cType; //uint8_t

		/**
		 * 发票抬头
		 *
		 * 版本 >= 0
		 */
		var $strTitle; //std::string

		/**
		 * 公司名称
		 *
		 * 版本 >= 0
		 */
		var $strName; //std::string

		/**
		 * 公司地址
		 *
		 * 版本 >= 0
		 */
		var $strAddr; //std::string

		/**
		 * 公司电话
		 *
		 * 版本 >= 0
		 */
		var $strPhone; //std::string

		/**
		 * 公司税号
		 *
		 * 版本 >= 0
		 */
		var $strTaxAccount; //std::string

		/**
		 * 银行账号
		 *
		 * 版本 >= 0
		 */
		var $strBankAccount; //std::string

		/**
		 * 开户银行名称
		 *
		 * 版本 >= 0
		 */
		var $strBankName; //std::string

		/**
		 * 发票状态，0-正常 1-无效
		 *
		 * 版本 >= 0
		 */
		var $dwStatus; //uint32_t

		/**
		 * 创建时间
		 *
		 * 版本 >= 0
		 */
		var $dwCreateTime; //uint32_t

		/**
		 * 更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwUpdateTime; //uint32_t

		/**
		 * 保留整型字段
		 *
		 * 版本 >= 0
		 */
		var $dwReserveInt; //uint32_t

		/**
		 * 保留字符串字段
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTitle_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cTaxAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBankAccount_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cBankName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cStatus_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCreateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveInt_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->cType = 0; // uint8_t
			 $this->strTitle = ""; // std::string
			 $this->strName = ""; // std::string
			 $this->strAddr = ""; // std::string
			 $this->strPhone = ""; // std::string
			 $this->strTaxAccount = ""; // std::string
			 $this->strBankAccount = ""; // std::string
			 $this->strBankName = ""; // std::string
			 $this->dwStatus = 0; // uint32_t
			 $this->dwCreateTime = 0; // uint32_t
			 $this->dwUpdateTime = 0; // uint32_t
			 $this->dwReserveInt = 0; // uint32_t
			 $this->strReserveStr = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cType_u = 0; // uint8_t
			 $this->cTitle_u = 0; // uint8_t
			 $this->cName_u = 0; // uint8_t
			 $this->cAddr_u = 0; // uint8_t
			 $this->cPhone_u = 0; // uint8_t
			 $this->cTaxAccount_u = 0; // uint8_t
			 $this->cBankAccount_u = 0; // uint8_t
			 $this->cBankName_u = 0; // uint8_t
			 $this->cStatus_u = 0; // uint8_t
			 $this->cCreateTime_u = 0; // uint8_t
			 $this->cUpdateTime_u = 0; // uint8_t
			 $this->cReserveInt_u = 0; // uint8_t
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化版本号 类型为uint8_t
			$bs->pushUint8_t($this->cType); // 序列化发票类型, 1-普通发票（映射1、3）2-增值税普通发票（映射4）3-增值税专用发票（映射2） 类型为uint8_t
			$bs->pushString($this->strTitle); // 序列化发票抬头 类型为std::string
			$bs->pushString($this->strName); // 序列化公司名称 类型为std::string
			$bs->pushString($this->strAddr); // 序列化公司地址 类型为std::string
			$bs->pushString($this->strPhone); // 序列化公司电话 类型为std::string
			$bs->pushString($this->strTaxAccount); // 序列化公司税号 类型为std::string
			$bs->pushString($this->strBankAccount); // 序列化银行账号 类型为std::string
			$bs->pushString($this->strBankName); // 序列化开户银行名称 类型为std::string
			$bs->pushUint32_t($this->dwStatus); // 序列化发票状态，0-正常 1-无效 类型为uint32_t
			$bs->pushUint32_t($this->dwCreateTime); // 序列化创建时间 类型为uint32_t
			$bs->pushUint32_t($this->dwUpdateTime); // 序列化更新时间 类型为uint32_t
			$bs->pushUint32_t($this->dwReserveInt); // 序列化保留整型字段 类型为uint32_t
			$bs->pushString($this->strReserveStr); // 序列化保留字符串字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTitle_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cTaxAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBankAccount_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cBankName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cStatus_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCreateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveInt_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化版本号 类型为uint8_t
			$this->cType = $bs->popUint8_t(); // 反序列化发票类型, 1-普通发票（映射1、3）2-增值税普通发票（映射4）3-增值税专用发票（映射2） 类型为uint8_t
			$this->strTitle = $bs->popString(); // 反序列化发票抬头 类型为std::string
			$this->strName = $bs->popString(); // 反序列化公司名称 类型为std::string
			$this->strAddr = $bs->popString(); // 反序列化公司地址 类型为std::string
			$this->strPhone = $bs->popString(); // 反序列化公司电话 类型为std::string
			$this->strTaxAccount = $bs->popString(); // 反序列化公司税号 类型为std::string
			$this->strBankAccount = $bs->popString(); // 反序列化银行账号 类型为std::string
			$this->strBankName = $bs->popString(); // 反序列化开户银行名称 类型为std::string
			$this->dwStatus = $bs->popUint32_t(); // 反序列化发票状态，0-正常 1-无效 类型为uint32_t
			$this->dwCreateTime = $bs->popUint32_t(); // 反序列化创建时间 类型为uint32_t
			$this->dwUpdateTime = $bs->popUint32_t(); // 反序列化更新时间 类型为uint32_t
			$this->dwReserveInt = $bs->popUint32_t(); // 反序列化保留整型字段 类型为uint32_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字符串字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTitle_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cTaxAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBankAccount_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cBankName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cStatus_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCreateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveInt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: idl.UserApiAo.java


class CopartnerRecvaddrPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 * 收件人姓名
		 *
		 * 版本 >= 0
		 */
		var $strRecvName; //std::string

		/**
		 * 收件人手机号
		 *
		 * 版本 >= 0
		 */
		var $strRecvMobile; //std::string

		/**
		 * 收件人电话
		 *
		 * 版本 >= 0
		 */
		var $strRecvPhone; //std::string

		/**
		 * 收件人邮编
		 *
		 * 版本 >= 0
		 */
		var $strZipcode; //std::string

		/**
		 * 收件人地区id，需转换为网购内部地区id
		 *
		 * 版本 >= 0
		 */
		var $dwRecvRegionId; //uint32_t

		/**
		 * 收件人详细地址
		 *
		 * 版本 >= 0
		 */
		var $strRecvAddr; //std::string

		/**
		 * 更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwUpdateTime; //uint32_t

		/**
		 * 保留整型字段
		 *
		 * 版本 >= 0
		 */
		var $dwReserveInt; //uint32_t

		/**
		 * 保留字符串字段
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvName_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cZipcode_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvRegionId_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRecvAddr_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveInt_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t


		 function __construct() {
			 $this->cVersion = 0; // uint8_t
			 $this->strRecvName = ""; // std::string
			 $this->strRecvMobile = ""; // std::string
			 $this->strRecvPhone = ""; // std::string
			 $this->strZipcode = ""; // std::string
			 $this->dwRecvRegionId = 0; // uint32_t
			 $this->strRecvAddr = ""; // std::string
			 $this->dwUpdateTime = 0; // uint32_t
			 $this->dwReserveInt = 0; // uint32_t
			 $this->strReserveStr = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cRecvName_u = 0; // uint8_t
			 $this->cRecvMobile_u = 0; // uint8_t
			 $this->cRecvPhone_u = 0; // uint8_t
			 $this->cZipcode_u = 0; // uint8_t
			 $this->cRecvRegionId_u = 0; // uint8_t
			 $this->cRecvAddr_u = 0; // uint8_t
			 $this->cUpdateTime_u = 0; // uint8_t
			 $this->cReserveInt_u = 0; // uint8_t
			 $this->cReserveStr_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化版本号 类型为uint8_t
			$bs->pushString($this->strRecvName); // 序列化收件人姓名 类型为std::string
			$bs->pushString($this->strRecvMobile); // 序列化收件人手机号 类型为std::string
			$bs->pushString($this->strRecvPhone); // 序列化收件人电话 类型为std::string
			$bs->pushString($this->strZipcode); // 序列化收件人邮编 类型为std::string
			$bs->pushUint32_t($this->dwRecvRegionId); // 序列化收件人地区id，需转换为网购内部地区id 类型为uint32_t
			$bs->pushString($this->strRecvAddr); // 序列化收件人详细地址 类型为std::string
			$bs->pushUint32_t($this->dwUpdateTime); // 序列化更新时间 类型为uint32_t
			$bs->pushUint32_t($this->dwReserveInt); // 序列化保留整型字段 类型为uint32_t
			$bs->pushString($this->strReserveStr); // 序列化保留字符串字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvName_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cZipcode_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvRegionId_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRecvAddr_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveInt_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化版本号 类型为uint8_t
			$this->strRecvName = $bs->popString(); // 反序列化收件人姓名 类型为std::string
			$this->strRecvMobile = $bs->popString(); // 反序列化收件人手机号 类型为std::string
			$this->strRecvPhone = $bs->popString(); // 反序列化收件人电话 类型为std::string
			$this->strZipcode = $bs->popString(); // 反序列化收件人邮编 类型为std::string
			$this->dwRecvRegionId = $bs->popUint32_t(); // 反序列化收件人地区id，需转换为网购内部地区id 类型为uint32_t
			$this->strRecvAddr = $bs->popString(); // 反序列化收件人详细地址 类型为std::string
			$this->dwUpdateTime = $bs->popUint32_t(); // 反序列化更新时间 类型为uint32_t
			$this->dwReserveInt = $bs->popUint32_t(); // 反序列化保留整型字段 类型为uint32_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字符串字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvName_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cZipcode_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvRegionId_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRecvAddr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveInt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t

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


//source idl: idl.UserApiAo.java


class CopartnerUserInfoPo
{
		/**
		 * 版本号
		 *
		 * 版本 >= 0
		 */
		var $cVersion; //uint8_t

		/**
		 * 加密后的登录密码
		 *
		 * 版本 >= 0
		 */
		var $strPassword; //std::string

		/**
		 * 绑定的QQ号
		 *
		 * 版本 >= 0
		 */
		var $dwQqNumber; //uint32_t

		/**
		 * 电子邮箱
		 *
		 * 版本 >= 0
		 */
		var $strEmail; //std::string

		/**
		 * 手机号
		 *
		 * 版本 >= 0
		 */
		var $strMobile; //std::string

		/**
		 * 用户昵称
		 *
		 * 版本 >= 0
		 */
		var $strNickname; //std::string

		/**
		 * 性别, 0-不明 1-男 2-女
		 *
		 * 版本 >= 0
		 */
		var $cSex; //uint8_t

		/**
		 * 用户电话
		 *
		 * 版本 >= 0
		 */
		var $strPhone; //std::string

		/**
		 * 用户传真
		 *
		 * 版本 >= 0
		 */
		var $strFax; //std::string

		/**
		 * 用户所在城市，需转成网购内部城市id
		 *
		 * 版本 >= 0
		 */
		var $dwCity; //uint32_t

		/**
		 * 用户详细地址
		 *
		 * 版本 >= 0
		 */
		var $strAddress; //std::string

		/**
		 * 更新时间
		 *
		 * 版本 >= 0
		 */
		var $dwUpdateTime; //uint32_t

		/**
		 * 注册时间
		 *
		 * 版本 >= 0
		 */
		var $dwRegTime; //uint32_t

		/**
		 * 用户类型
		 *
		 * 版本 >= 0
		 */
		var $cUserType; //uint8_t

		/**
		 * 用户经验值
		 *
		 * 版本 >= 0
		 */
		var $dwExpPoint; //uint32_t

		/**
		 * 用户属性位，需转成网购内部用户属性位值
		 *
		 * 版本 >= 0
		 */
		var $ddwUserProperty; //uint64_t

		/**
		 * 经销商等级
		 *
		 * 版本 >= 0
		 */
		var $cRetailerLevel; //uint8_t

		/**
		 * 保留整型字段
		 *
		 * 版本 >= 0
		 */
		var $dwReserveInt; //uint32_t

		/**
		 * 保留字符串字段
		 *
		 * 版本 >= 0
		 */
		var $strReserveStr; //std::string

		/**
		 * 版本 >= 0
		 */
		var $cVersion_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPassword_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cQqNumber_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cEmail_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cMobile_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cNickname_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cSex_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cPhone_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cFax_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cCity_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cAddress_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUpdateTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRegTime_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUserType_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cExpPoint_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cUserProperty_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cRetailerLevel_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveInt_u; //uint8_t

		/**
		 * 版本 >= 0
		 */
		var $cReserveStr_u; //uint8_t

		/**
		 * 易讯的用户uid
		 *
		 * 版本 >= 1
		 */
		var $dwIcsonUid; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonUid_u; //uint8_t

		/**
		 * 易讯的用户交易密码
		 *
		 * 版本 >= 1
		 */
		var $strTradePasswd; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cTradePasswd_u; //uint8_t

		/**
		 * 用户真实姓名
		 *
		 * 版本 >= 1
		 */
		var $strTruename; //std::string

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cTruename_u; //uint8_t

		/**
		 * 易迅会员等级
		 *
		 * 版本 >= 1
		 */
		var $dwIcsonMemberLevel; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cIcsonMemberLevel_u; //uint8_t

		/**
		 * 易讯促销积分
		 *
		 * 版本 >= 1
		 */
		var $dwPromotionPoints; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cPromotionPoints_u; //uint8_t

		/**
		 * 易讯现金积分
		 *
		 * 版本 >= 1
		 */
		var $dwCashPoints; //uint32_t

		/**
		 * 
		 *
		 * 版本 >= 1
		 */
		var $cCashPoints_u; //uint8_t


		 function __construct() {
			 $this->cVersion = 1; // uint8_t
			 $this->strPassword = ""; // std::string
			 $this->dwQqNumber = 0; // uint32_t
			 $this->strEmail = ""; // std::string
			 $this->strMobile = ""; // std::string
			 $this->strNickname = ""; // std::string
			 $this->cSex = 0; // uint8_t
			 $this->strPhone = ""; // std::string
			 $this->strFax = ""; // std::string
			 $this->dwCity = 0; // uint32_t
			 $this->strAddress = ""; // std::string
			 $this->dwUpdateTime = 0; // uint32_t
			 $this->dwRegTime = 0; // uint32_t
			 $this->cUserType = 0; // uint8_t
			 $this->dwExpPoint = 0; // uint32_t
			 $this->ddwUserProperty = 0; // uint64_t
			 $this->cRetailerLevel = 0; // uint8_t
			 $this->dwReserveInt = 0; // uint32_t
			 $this->strReserveStr = ""; // std::string
			 $this->cVersion_u = 0; // uint8_t
			 $this->cPassword_u = 0; // uint8_t
			 $this->cQqNumber_u = 0; // uint8_t
			 $this->cEmail_u = 0; // uint8_t
			 $this->cMobile_u = 0; // uint8_t
			 $this->cNickname_u = 0; // uint8_t
			 $this->cSex_u = 0; // uint8_t
			 $this->cPhone_u = 0; // uint8_t
			 $this->cFax_u = 0; // uint8_t
			 $this->cCity_u = 0; // uint8_t
			 $this->cAddress_u = 0; // uint8_t
			 $this->cUpdateTime_u = 0; // uint8_t
			 $this->cRegTime_u = 0; // uint8_t
			 $this->cUserType_u = 0; // uint8_t
			 $this->cExpPoint_u = 0; // uint8_t
			 $this->cUserProperty_u = 0; // uint8_t
			 $this->cRetailerLevel_u = 0; // uint8_t
			 $this->cReserveInt_u = 0; // uint8_t
			 $this->cReserveStr_u = 0; // uint8_t
			 $this->dwIcsonUid = 0; // uint32_t
			 $this->cIcsonUid_u = 0; // uint8_t
			 $this->strTradePasswd = ""; // std::string
			 $this->cTradePasswd_u = 0; // uint8_t
			 $this->strTruename = ""; // std::string
			 $this->cTruename_u = 0; // uint8_t
			 $this->dwIcsonMemberLevel = 0; // uint32_t
			 $this->cIcsonMemberLevel_u = 0; // uint8_t
			 $this->dwPromotionPoints = 0; // uint32_t
			 $this->cPromotionPoints_u = 0; // uint8_t
			 $this->dwCashPoints = 0; // uint32_t
			 $this->cCashPoints_u = 0; // uint8_t
		}

		 function serialize($bs) {
			$bs->pushUint32_t($this->getClassLen());
			$this->serialize_internal($bs);
		}

		 function serialize_internal($bs) {
			$bs->pushUint8_t($this->cVersion); // 序列化版本号 类型为uint8_t
			$bs->pushString($this->strPassword); // 序列化加密后的登录密码 类型为std::string
			$bs->pushUint32_t($this->dwQqNumber); // 序列化绑定的QQ号 类型为uint32_t
			$bs->pushString($this->strEmail); // 序列化电子邮箱 类型为std::string
			$bs->pushString($this->strMobile); // 序列化手机号 类型为std::string
			$bs->pushString($this->strNickname); // 序列化用户昵称 类型为std::string
			$bs->pushUint8_t($this->cSex); // 序列化性别, 0-不明 1-男 2-女 类型为uint8_t
			$bs->pushString($this->strPhone); // 序列化用户电话 类型为std::string
			$bs->pushString($this->strFax); // 序列化用户传真 类型为std::string
			$bs->pushUint32_t($this->dwCity); // 序列化用户所在城市，需转成网购内部城市id 类型为uint32_t
			$bs->pushString($this->strAddress); // 序列化用户详细地址 类型为std::string
			$bs->pushUint32_t($this->dwUpdateTime); // 序列化更新时间 类型为uint32_t
			$bs->pushUint32_t($this->dwRegTime); // 序列化注册时间 类型为uint32_t
			$bs->pushUint8_t($this->cUserType); // 序列化用户类型 类型为uint8_t
			$bs->pushUint32_t($this->dwExpPoint); // 序列化用户经验值 类型为uint32_t
			$bs->pushUint64_t($this->ddwUserProperty); // 序列化用户属性位，需转成网购内部用户属性位值 类型为uint64_t
			$bs->pushUint8_t($this->cRetailerLevel); // 序列化经销商等级 类型为uint8_t
			$bs->pushUint32_t($this->dwReserveInt); // 序列化保留整型字段 类型为uint32_t
			$bs->pushString($this->strReserveStr); // 序列化保留字符串字段 类型为std::string
			$bs->pushUint8_t($this->cVersion_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPassword_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cQqNumber_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cEmail_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cMobile_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cNickname_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cSex_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cPhone_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cFax_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cCity_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cAddress_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUpdateTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRegTime_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUserType_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cExpPoint_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cUserProperty_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cRetailerLevel_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveInt_u); // 序列化 类型为uint8_t
			$bs->pushUint8_t($this->cReserveStr_u); // 序列化 类型为uint8_t
			if(  $this->cVersion >= 1 ){
				$bs->pushUint32_t($this->dwIcsonUid); // 序列化易讯的用户uid 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonUid_u); // 序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushString($this->strTradePasswd); // 序列化易讯的用户交易密码 类型为std::string
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint8_t($this->cTradePasswd_u); // 序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushString($this->strTruename); // 序列化用户真实姓名 类型为std::string
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint8_t($this->cTruename_u); // 序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint32_t($this->dwIcsonMemberLevel); // 序列化易迅会员等级 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint8_t($this->cIcsonMemberLevel_u); // 序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint32_t($this->dwPromotionPoints); // 序列化易讯促销积分 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint8_t($this->cPromotionPoints_u); // 序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint32_t($this->dwCashPoints); // 序列化易讯现金积分 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$bs->pushUint8_t($this->cCashPoints_u); // 序列化 类型为uint8_t
			}
		}

		 function unserialize($bs) {
			$class_len = $bs->popUint32_t();
			$startPop = $bs->getReadLength();
			$this->cVersion = $bs->popUint8_t(); // 反序列化版本号 类型为uint8_t
			$this->strPassword = $bs->popString(); // 反序列化加密后的登录密码 类型为std::string
			$this->dwQqNumber = $bs->popUint32_t(); // 反序列化绑定的QQ号 类型为uint32_t
			$this->strEmail = $bs->popString(); // 反序列化电子邮箱 类型为std::string
			$this->strMobile = $bs->popString(); // 反序列化手机号 类型为std::string
			$this->strNickname = $bs->popString(); // 反序列化用户昵称 类型为std::string
			$this->cSex = $bs->popUint8_t(); // 反序列化性别, 0-不明 1-男 2-女 类型为uint8_t
			$this->strPhone = $bs->popString(); // 反序列化用户电话 类型为std::string
			$this->strFax = $bs->popString(); // 反序列化用户传真 类型为std::string
			$this->dwCity = $bs->popUint32_t(); // 反序列化用户所在城市，需转成网购内部城市id 类型为uint32_t
			$this->strAddress = $bs->popString(); // 反序列化用户详细地址 类型为std::string
			$this->dwUpdateTime = $bs->popUint32_t(); // 反序列化更新时间 类型为uint32_t
			$this->dwRegTime = $bs->popUint32_t(); // 反序列化注册时间 类型为uint32_t
			$this->cUserType = $bs->popUint8_t(); // 反序列化用户类型 类型为uint8_t
			$this->dwExpPoint = $bs->popUint32_t(); // 反序列化用户经验值 类型为uint32_t
			$this->ddwUserProperty = $bs->popUint64_t(); // 反序列化用户属性位，需转成网购内部用户属性位值 类型为uint64_t
			$this->cRetailerLevel = $bs->popUint8_t(); // 反序列化经销商等级 类型为uint8_t
			$this->dwReserveInt = $bs->popUint32_t(); // 反序列化保留整型字段 类型为uint32_t
			$this->strReserveStr = $bs->popString(); // 反序列化保留字符串字段 类型为std::string
			$this->cVersion_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPassword_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cQqNumber_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cEmail_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cMobile_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cNickname_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cSex_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cPhone_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cFax_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cCity_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cAddress_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUpdateTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRegTime_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUserType_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cExpPoint_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cUserProperty_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cRetailerLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveInt_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			$this->cReserveStr_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			if(  $this->cVersion >= 1 ){
				$this->dwIcsonUid = $bs->popUint32_t(); // 反序列化易讯的用户uid 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$this->cIcsonUid_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$this->strTradePasswd = $bs->popString(); // 反序列化易讯的用户交易密码 类型为std::string
			}
			if(  $this->cVersion >= 1 ){
				$this->cTradePasswd_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$this->strTruename = $bs->popString(); // 反序列化用户真实姓名 类型为std::string
			}
			if(  $this->cVersion >= 1 ){
				$this->cTruename_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$this->dwIcsonMemberLevel = $bs->popUint32_t(); // 反序列化易迅会员等级 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$this->cIcsonMemberLevel_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$this->dwPromotionPoints = $bs->popUint32_t(); // 反序列化易讯促销积分 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$this->cPromotionPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
			}
			if(  $this->cVersion >= 1 ){
				$this->dwCashPoints = $bs->popUint32_t(); // 反序列化易讯现金积分 类型为uint32_t
			}
			if(  $this->cVersion >= 1 ){
				$this->cCashPoints_u = $bs->popUint8_t(); // 反序列化 类型为uint8_t
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

?>