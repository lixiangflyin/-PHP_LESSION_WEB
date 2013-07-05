<?php
namespace b2b2c\touch\ddo;	//source idl: com.b2b2c.touch.idl.GetRealTimeResp.java
class TouchRealTimeDo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $channel;	//<uint32_t> 渠道ID(1 Tips  2 短信 3 邮件 4 FEEDS)(版本>=0)
	private $businessType;	//<uint32_t> 业务类型(版本>=0)
	private $businessId;	//<std::string> 关联业务号(版本>=0)
	private $flowId;	//<uint32_t> 环节ID(子业务ID)(版本>=0)
	private $uin;	//<uint64_t> 用户ID(版本>=0)
	private $mobile;	//<std::string> 用户收货手机(版本>=0)
	private $template;	//<uint32_t> 模板ID(版本>=0)
	private $content;	//<std::string> 消息内容(版本>=0)
	private $ctime;	//<uint32_t> 插入时间(版本>=0)
	private $ext1;	//<std::string> 扩展字段一(版本>=0)
	private $ext2;	//<uint32_t> 扩展字段二(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $channel_u;	//<uint8_t> (版本>=0)
	private $businessType_u;	//<uint8_t> (版本>=0)
	private $businessId_u;	//<uint8_t> (版本>=0)
	private $flowId_u;	//<uint8_t> (版本>=0)
	private $uin_u;	//<uint8_t> (版本>=0)
	private $mobile_u;	//<uint8_t> (版本>=0)
	private $template_u;	//<uint8_t> (版本>=0)
	private $content_u;	//<uint8_t> (版本>=0)
	private $ctime_u;	//<uint8_t> (版本>=0)
	private $ext1_u;	//<uint8_t> (版本>=0)
	private $ext2_u;	//<uint8_t> (版本>=0)
	private $id;	//<uint64_t> 触达ID(版本>=1)
	private $contentVector;	//<std::vector<std::string> > 消息内容列表(版本>=1)
	private $id_u;	//<uint8_t> (版本>=1)
	private $contentVector_u;	//<uint8_t> (版本>=1)
	private $priority;	//<uint32_t> 优先级(版本>=2)
	private $priority_u;	//<uint8_t> (版本>=2)
	private $expireTime;	//<uint32_t> 失效时间(版本>=2)
	private $expireTime_u;	//<uint8_t> (版本>=2)
	private $treatTime;	//<uint32_t> 处理时间(版本>=2)
	private $treatTime_u;	//<uint8_t> (版本>=2)
	private $status;	//<uint32_t> 状态(版本>=2)
	private $status_u;	//<uint8_t> (版本>=2)
	private $target;	//<std::string> 触达对象（QQ/手机/邮箱地址）(版本>=3)
	private $target_u;	//<uint8_t> (版本>=3)

	function __construct(){
		$this->version = 3;	//<uint16_t>
		$this->channel = 0;	//<uint32_t>
		$this->businessType = 0;	//<uint32_t>
		$this->businessId = "";	//<std::string>
		$this->flowId = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->mobile = "";	//<std::string>
		$this->template = 0;	//<uint32_t>
		$this->content = "";	//<std::string>
		$this->ctime = 0;	//<uint32_t>
		$this->ext1 = "";	//<std::string>
		$this->ext2 = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->channel_u = 0;	//<uint8_t>
		$this->businessType_u = 0;	//<uint8_t>
		$this->businessId_u = 0;	//<uint8_t>
		$this->flowId_u = 0;	//<uint8_t>
		$this->uin_u = 0;	//<uint8_t>
		$this->mobile_u = 0;	//<uint8_t>
		$this->template_u = 0;	//<uint8_t>
		$this->content_u = 0;	//<uint8_t>
		$this->ctime_u = 0;	//<uint8_t>
		$this->ext1_u = 0;	//<uint8_t>
		$this->ext2_u = 0;	//<uint8_t>
		$this->id = 0;	//<uint64_t>
		$this->contentVector = new \stl_vector2('stl_string');	//<std::vector<std::string> >
		$this->id_u = 0;	//<uint8_t>
		$this->contentVector_u = 0;	//<uint8_t>
		$this->priority = 0;	//<uint32_t>
		$this->priority_u = 0;	//<uint8_t>
		$this->expireTime = 0;	//<uint32_t>
		$this->expireTime_u = 0;	//<uint8_t>
		$this->treatTime = 0;	//<uint32_t>
		$this->treatTime_u = 0;	//<uint8_t>
		$this->status = 0;	//<uint32_t>
		$this->status_u = 0;	//<uint8_t>
		$this->target = "";	//<std::string>
		$this->target_u = 0;	//<uint8_t>
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
			exit("\b2b2c\touch\ddo\TouchRealTimeDo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\touch\ddo\TouchRealTimeDo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->channel);	//<uint32_t> 渠道ID(1 Tips  2 短信 3 邮件 4 FEEDS)
		$bs->pushUint32_t($this->businessType);	//<uint32_t> 业务类型
		$bs->pushString($this->businessId);	//<std::string> 关联业务号
		$bs->pushUint32_t($this->flowId);	//<uint32_t> 环节ID(子业务ID)
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户ID
		$bs->pushString($this->mobile);	//<std::string> 用户收货手机
		$bs->pushUint32_t($this->template);	//<uint32_t> 模板ID
		$bs->pushString($this->content);	//<std::string> 消息内容
		$bs->pushUint32_t($this->ctime);	//<uint32_t> 插入时间
		$bs->pushString($this->ext1);	//<std::string> 扩展字段一
		$bs->pushUint32_t($this->ext2);	//<uint32_t> 扩展字段二
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->channel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->flowId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->uin_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->template_u);	//<uint8_t> 
		$bs->pushUint8_t($this->content_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ctime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext2_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint64_t($this->id);	//<uint64_t> 触达ID
		}
		if($this->version >= 1){
			$bs->pushObject($this->contentVector,'stl_vector');	//<std::vector<std::string> > 消息内容列表
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->id_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->contentVector_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->priority);	//<uint32_t> 优先级
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->priority_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->expireTime);	//<uint32_t> 失效时间
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->expireTime_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->treatTime);	//<uint32_t> 处理时间
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->treatTime_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushUint32_t($this->status);	//<uint32_t> 状态
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->status_u);	//<uint8_t> 
		}
		if($this->version >= 3){
			$bs->pushString($this->target);	//<std::string> 触达对象（QQ/手机/邮箱地址）
		}
		if($this->version >= 3){
			$bs->pushUint8_t($this->target_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['channel'] = $bs->popUint32_t();	//<uint32_t> 渠道ID(1 Tips  2 短信 3 邮件 4 FEEDS)
		$this->_arr_value['businessType'] = $bs->popUint32_t();	//<uint32_t> 业务类型
		$this->_arr_value['businessId'] = $bs->popString();	//<std::string> 关联业务号
		$this->_arr_value['flowId'] = $bs->popUint32_t();	//<uint32_t> 环节ID(子业务ID)
		$this->_arr_value['uin'] = $bs->popUint64_t();	//<uint64_t> 用户ID
		$this->_arr_value['mobile'] = $bs->popString();	//<std::string> 用户收货手机
		$this->_arr_value['template'] = $bs->popUint32_t();	//<uint32_t> 模板ID
		$this->_arr_value['content'] = $bs->popString();	//<std::string> 消息内容
		$this->_arr_value['ctime'] = $bs->popUint32_t();	//<uint32_t> 插入时间
		$this->_arr_value['ext1'] = $bs->popString();	//<std::string> 扩展字段一
		$this->_arr_value['ext2'] = $bs->popUint32_t();	//<uint32_t> 扩展字段二
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['channel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['flowId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['uin_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['template_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['content_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ctime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext2_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['id'] = $bs->popUint64_t();	//<uint64_t> 触达ID
		}
		if($this->version >= 1){
			$this->_arr_value['contentVector'] = $bs->popObject('stl_vector<stl_string>');	//<std::vector<std::string> > 消息内容列表
		}
		if($this->version >= 1){
			$this->_arr_value['id_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['contentVector_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['priority'] = $bs->popUint32_t();	//<uint32_t> 优先级
		}
		if($this->version >= 2){
			$this->_arr_value['priority_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['expireTime'] = $bs->popUint32_t();	//<uint32_t> 失效时间
		}
		if($this->version >= 2){
			$this->_arr_value['expireTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['treatTime'] = $bs->popUint32_t();	//<uint32_t> 处理时间
		}
		if($this->version >= 2){
			$this->_arr_value['treatTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['status'] = $bs->popUint32_t();	//<uint32_t> 状态
		}
		if($this->version >= 2){
			$this->_arr_value['status_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 3){
			$this->_arr_value['target'] = $bs->popString();	//<std::string> 触达对象（QQ/手机/邮箱地址）
		}
		if($this->version >= 3){
			$this->_arr_value['target_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\touch\ddo;	//source idl: com.b2b2c.touch.idl.GetAtTimeOkResp.java
class TouchAtTimeDo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $channel;	//<uint32_t> 渠道ID(1 Tips  2 短信 3 邮件 4 站内信)(版本>=0)
	private $businessType;	//<uint32_t> 业务类型(版本>=0)
	private $businessId;	//<std::string> 关联业务号(版本>=0)
	private $flowId;	//<uint32_t> 环节ID(子业务ID)(版本>=0)
	private $combine;	//<uint32_t> 是否可合并(版本>=0)
	private $expectTime;	//<uint32_t> 期望发送时间(版本>=0)
	private $expireTime;	//<uint32_t> 有效时间(在此时间内可发送，可合并)(版本>=0)
	private $uin;	//<uint64_t> 用户ID(版本>=0)
	private $mobile;	//<std::string> 用户收货手机(版本>=0)
	private $template;	//<uint32_t> 模板ID(版本>=0)
	private $content;	//<std::string> 消息内容(版本>=0)
	private $ext1;	//<std::string> 扩展字段一(版本>=0)
	private $ext2;	//<uint32_t> 扩展字段二(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $channel_u;	//<uint8_t> (版本>=0)
	private $businessType_u;	//<uint8_t> (版本>=0)
	private $businessId_u;	//<uint8_t> (版本>=0)
	private $flowId_u;	//<uint8_t> (版本>=0)
	private $combine_u;	//<uint8_t> (版本>=0)
	private $expectTime_u;	//<uint8_t> (版本>=0)
	private $expireTime_u;	//<uint8_t> (版本>=0)
	private $uin_u;	//<uint8_t> (版本>=0)
	private $mobile_u;	//<uint8_t> (版本>=0)
	private $template_u;	//<uint8_t> (版本>=0)
	private $content_u;	//<uint8_t> (版本>=0)
	private $ext1_u;	//<uint8_t> (版本>=0)
	private $ext2_u;	//<uint8_t> (版本>=0)
	private $id;	//<uint64_t> 触达ID(版本>=1)
	private $contentVector;	//<std::vector<std::string> > 消息内容列表(版本>=1)
	private $id_u;	//<uint8_t> (版本>=1)
	private $contentVector_u;	//<uint8_t> (版本>=1)
	private $target;	//<std::string> 触达对象（QQ/手机/邮箱地址）(版本>=2)
	private $target_u;	//<uint8_t> (版本>=2)

	function __construct(){
		$this->version = 2;	//<uint16_t>
		$this->channel = 0;	//<uint32_t>
		$this->businessType = 0;	//<uint32_t>
		$this->businessId = "";	//<std::string>
		$this->flowId = 0;	//<uint32_t>
		$this->combine = 0;	//<uint32_t>
		$this->expectTime = 0;	//<uint32_t>
		$this->expireTime = 0;	//<uint32_t>
		$this->uin = 0;	//<uint64_t>
		$this->mobile = "";	//<std::string>
		$this->template = 0;	//<uint32_t>
		$this->content = "";	//<std::string>
		$this->ext1 = "";	//<std::string>
		$this->ext2 = 0;	//<uint32_t>
		$this->version_u = 0;	//<uint8_t>
		$this->channel_u = 0;	//<uint8_t>
		$this->businessType_u = 0;	//<uint8_t>
		$this->businessId_u = 0;	//<uint8_t>
		$this->flowId_u = 0;	//<uint8_t>
		$this->combine_u = 0;	//<uint8_t>
		$this->expectTime_u = 0;	//<uint8_t>
		$this->expireTime_u = 0;	//<uint8_t>
		$this->uin_u = 0;	//<uint8_t>
		$this->mobile_u = 0;	//<uint8_t>
		$this->template_u = 0;	//<uint8_t>
		$this->content_u = 0;	//<uint8_t>
		$this->ext1_u = 0;	//<uint8_t>
		$this->ext2_u = 0;	//<uint8_t>
		$this->id = 0;	//<uint64_t>
		$this->contentVector = new \stl_vector2('stl_string');	//<std::vector<std::string> >
		$this->id_u = 0;	//<uint8_t>
		$this->contentVector_u = 0;	//<uint8_t>
		$this->target = "";	//<std::string>
		$this->target_u = 0;	//<uint8_t>
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
			exit("\b2b2c\touch\ddo\TouchAtTimeDo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\touch\ddo\TouchAtTimeDo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushUint32_t($this->channel);	//<uint32_t> 渠道ID(1 Tips  2 短信 3 邮件 4 站内信)
		$bs->pushUint32_t($this->businessType);	//<uint32_t> 业务类型
		$bs->pushString($this->businessId);	//<std::string> 关联业务号
		$bs->pushUint32_t($this->flowId);	//<uint32_t> 环节ID(子业务ID)
		$bs->pushUint32_t($this->combine);	//<uint32_t> 是否可合并
		$bs->pushUint32_t($this->expectTime);	//<uint32_t> 期望发送时间
		$bs->pushUint32_t($this->expireTime);	//<uint32_t> 有效时间(在此时间内可发送，可合并)
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户ID
		$bs->pushString($this->mobile);	//<std::string> 用户收货手机
		$bs->pushUint32_t($this->template);	//<uint32_t> 模板ID
		$bs->pushString($this->content);	//<std::string> 消息内容
		$bs->pushString($this->ext1);	//<std::string> 扩展字段一
		$bs->pushUint32_t($this->ext2);	//<uint32_t> 扩展字段二
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->channel_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->businessId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->flowId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->combine_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expectTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->expireTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->uin_u);	//<uint8_t> 
		$bs->pushUint8_t($this->mobile_u);	//<uint8_t> 
		$bs->pushUint8_t($this->template_u);	//<uint8_t> 
		$bs->pushUint8_t($this->content_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext2_u);	//<uint8_t> 
		if($this->version >= 1){
			$bs->pushUint64_t($this->id);	//<uint64_t> 触达ID
		}
		if($this->version >= 1){
			$bs->pushObject($this->contentVector,'stl_vector');	//<std::vector<std::string> > 消息内容列表
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->id_u);	//<uint8_t> 
		}
		if($this->version >= 1){
			$bs->pushUint8_t($this->contentVector_u);	//<uint8_t> 
		}
		if($this->version >= 2){
			$bs->pushString($this->target);	//<std::string> 触达对象（QQ/手机/邮箱地址）
		}
		if($this->version >= 2){
			$bs->pushUint8_t($this->target_u);	//<uint8_t> 
		}
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['channel'] = $bs->popUint32_t();	//<uint32_t> 渠道ID(1 Tips  2 短信 3 邮件 4 站内信)
		$this->_arr_value['businessType'] = $bs->popUint32_t();	//<uint32_t> 业务类型
		$this->_arr_value['businessId'] = $bs->popString();	//<std::string> 关联业务号
		$this->_arr_value['flowId'] = $bs->popUint32_t();	//<uint32_t> 环节ID(子业务ID)
		$this->_arr_value['combine'] = $bs->popUint32_t();	//<uint32_t> 是否可合并
		$this->_arr_value['expectTime'] = $bs->popUint32_t();	//<uint32_t> 期望发送时间
		$this->_arr_value['expireTime'] = $bs->popUint32_t();	//<uint32_t> 有效时间(在此时间内可发送，可合并)
		$this->_arr_value['uin'] = $bs->popUint64_t();	//<uint64_t> 用户ID
		$this->_arr_value['mobile'] = $bs->popString();	//<std::string> 用户收货手机
		$this->_arr_value['template'] = $bs->popUint32_t();	//<uint32_t> 模板ID
		$this->_arr_value['content'] = $bs->popString();	//<std::string> 消息内容
		$this->_arr_value['ext1'] = $bs->popString();	//<std::string> 扩展字段一
		$this->_arr_value['ext2'] = $bs->popUint32_t();	//<uint32_t> 扩展字段二
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['channel_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['businessId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['flowId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['combine_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expectTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['expireTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['uin_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['mobile_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['template_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['content_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext2_u'] = $bs->popUint8_t();	//<uint8_t> 
		if($this->version >= 1){
			$this->_arr_value['id'] = $bs->popUint64_t();	//<uint64_t> 触达ID
		}
		if($this->version >= 1){
			$this->_arr_value['contentVector'] = $bs->popObject('stl_vector<stl_string>');	//<std::vector<std::string> > 消息内容列表
		}
		if($this->version >= 1){
			$this->_arr_value['id_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 1){
			$this->_arr_value['contentVector_u'] = $bs->popUint8_t();	//<uint8_t> 
		}
		if($this->version >= 2){
			$this->_arr_value['target'] = $bs->popString();	//<std::string> 触达对象（QQ/手机/邮箱地址）
		}
		if($this->version >= 2){
			$this->_arr_value['target_u'] = $bs->popUint8_t();	//<uint8_t> 
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

namespace b2b2c\touch\ddo;	//source idl: com.b2b2c.touch.idl.DeleteDealNoPayReq.java
class TouchDealNoPayDo{
	private $_arr_value=array();	//数组形式的类
	private $version;	//<uint16_t> 协议版本号(版本>=0)
	private $bdealId;	//<std::string> 购买单ID(版本>=0)
	private $uin;	//<uint64_t> 用户ID(版本>=0)
	private $ctime;	//<uint32_t> 下单时间(版本>=0)
	private $type;	//<uint32_t> 订单类型, 1：普通订单  2：抢购订单(版本>=0)
	private $ext1;	//<std::string> 扩展字段一(版本>=0)
	private $version_u;	//<uint8_t> (版本>=0)
	private $bdealId_u;	//<uint8_t> (版本>=0)
	private $uin_u;	//<uint8_t> (版本>=0)
	private $ctime_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $ext1_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->version = 0;	//<uint16_t>
		$this->bdealId = "";	//<std::string>
		$this->uin = 0;	//<uint64_t>
		$this->ctime = 0;	//<uint32_t>
		$this->type = 0;	//<uint32_t>
		$this->ext1 = "";	//<std::string>
		$this->version_u = 0;	//<uint8_t>
		$this->bdealId_u = 0;	//<uint8_t>
		$this->uin_u = 0;	//<uint8_t>
		$this->ctime_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->ext1_u = 0;	//<uint8_t>
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
			exit("\b2b2c\touch\ddo\TouchDealNoPayDo\\{$name}：不存在此变量，请查询xxoo。");
		}
	}

	function initClass($name,$val,$obj){
		if(!is_array($val)) exit("\b2b2c\touch\ddo\TouchDealNoPayDo\\{$name}：请直接赋值为数组，无需new ***。");
		if(strpos(get_class($obj), 'stl_')===0){
			$class=$obj->element_type;
			$arr = array();
			if(class_exists($class,false)){
				for($i=0;$i<count($val);$i++){
					$arr[$i]=new $class();
					foreach($val[$i] as $k => $v){
						if(is_object($arr[$i]->$k)){
							$this->initClass($name.'\\'.$k,$v,$arr[$i]->$k);
						}else{
							$arr[$i]->$k=$v;
						}
					}
				}
			}else{
				$arr=$val;
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
		$bs->pushString($this->bdealId);	//<std::string> 购买单ID
		$bs->pushUint64_t($this->uin);	//<uint64_t> 用户ID
		$bs->pushUint32_t($this->ctime);	//<uint32_t> 下单时间
		$bs->pushUint32_t($this->type);	//<uint32_t> 订单类型, 1：普通订单  2：抢购订单
		$bs->pushString($this->ext1);	//<std::string> 扩展字段一
		$bs->pushUint8_t($this->version_u);	//<uint8_t> 
		$bs->pushUint8_t($this->bdealId_u);	//<uint8_t> 
		$bs->pushUint8_t($this->uin_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ctime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext1_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['version'] = $bs->popUint16_t();	//<uint16_t> 协议版本号
		$this->_arr_value['bdealId'] = $bs->popString();	//<std::string> 购买单ID
		$this->_arr_value['uin'] = $bs->popUint64_t();	//<uint64_t> 用户ID
		$this->_arr_value['ctime'] = $bs->popUint32_t();	//<uint32_t> 下单时间
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t> 订单类型, 1：普通订单  2：抢购订单
		$this->_arr_value['ext1'] = $bs->popString();	//<std::string> 扩展字段一
		$this->_arr_value['version_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['bdealId_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['uin_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ctime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext1_u'] = $bs->popUint8_t();	//<uint8_t> 

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
