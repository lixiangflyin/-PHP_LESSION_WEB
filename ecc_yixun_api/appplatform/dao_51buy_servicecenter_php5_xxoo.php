<?php
namespace icson\servicecenter\ddo;	//source idl: com.b2b2c.kf.idl.DAO_51Buy_ServiceCenter.java
class ReplyInfo{
	private $_arr_value=array();	//数组形式的类
	private $rid;	//<uint64_t>  rid (版本>=0)
	private $complaint_id;	//<uint64_t>   业务单id (版本>=0)
	private $reply_type;	//<uint32_t>  回复类型（1：回复 2：备注） (版本>=0)
	private $replyer_id;	//<std::string>  回复人 (版本>=0)
	private $replyer_type;	//<uint32_t>  回复人类型（1：客服 2：用户） (版本>=0)
	private $time_reply;	//<uint32_t>  回复时间 (版本>=0)
	private $content;	//<std::string>  回复内容 (版本>=0)
	private $attachment;	//<std::string>  附件 (版本>=0)
	private $ext1;	//<uint32_t> ext1(版本>=0)
	private $ext2;	//<std::string> ext2(版本>=0)
	private $ext3;	//<uint32_t> ext3(版本>=0)
	private $ext4;	//<std::string> ext4(版本>=0)
	private $ext5;	//<uint32_t> ext5(版本>=0)
	private $ext6;	//<std::string> ext6(版本>=0)
	private $rid_u;	//<uint8_t> (版本>=0)
	private $complaint_id_u;	//<uint8_t> (版本>=0)
	private $reply_type_u;	//<uint8_t> (版本>=0)
	private $replyer_id_u;	//<uint8_t> (版本>=0)
	private $replyer_type_u;	//<uint8_t> (版本>=0)
	private $time_reply_u;	//<uint8_t> (版本>=0)
	private $content_u;	//<uint8_t> (版本>=0)
	private $attachment_u;	//<uint8_t> (版本>=0)
	private $ext1_u;	//<uint8_t> (版本>=0)
	private $ext2_u;	//<uint8_t> (版本>=0)
	private $ext3_u;	//<uint8_t> (版本>=0)
	private $ext4_u;	//<uint8_t> (版本>=0)
	private $ext5_u;	//<uint8_t> (版本>=0)
	private $ext6_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->rid = 0;	//<uint64_t>
		$this->complaint_id = 0;	//<uint64_t>
		$this->reply_type = 0;	//<uint32_t>
		$this->replyer_id = "";	//<std::string>
		$this->replyer_type = 0;	//<uint32_t>
		$this->time_reply = 0;	//<uint32_t>
		$this->content = "";	//<std::string>
		$this->attachment = "";	//<std::string>
		$this->ext1 = 0;	//<uint32_t>
		$this->ext2 = "";	//<std::string>
		$this->ext3 = 0;	//<uint32_t>
		$this->ext4 = "";	//<std::string>
		$this->ext5 = 0;	//<uint32_t>
		$this->ext6 = "";	//<std::string>
		$this->rid_u = 0;	//<uint8_t>
		$this->complaint_id_u = 0;	//<uint8_t>
		$this->reply_type_u = 0;	//<uint8_t>
		$this->replyer_id_u = 0;	//<uint8_t>
		$this->replyer_type_u = 0;	//<uint8_t>
		$this->time_reply_u = 0;	//<uint8_t>
		$this->content_u = 0;	//<uint8_t>
		$this->attachment_u = 0;	//<uint8_t>
		$this->ext1_u = 0;	//<uint8_t>
		$this->ext2_u = 0;	//<uint8_t>
		$this->ext3_u = 0;	//<uint8_t>
		$this->ext4_u = 0;	//<uint8_t>
		$this->ext5_u = 0;	//<uint8_t>
		$this->ext6_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\servicecenter\ddo\ReplyInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("icson\servicecenter\ddo\ReplyInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint64_t($this->rid);	//<uint64_t>  rid 
		$bs->pushUint64_t($this->complaint_id);	//<uint64_t>   业务单id 
		$bs->pushUint32_t($this->reply_type);	//<uint32_t>  回复类型（1：回复 2：备注） 
		$bs->pushString($this->replyer_id);	//<std::string>  回复人 
		$bs->pushUint32_t($this->replyer_type);	//<uint32_t>  回复人类型（1：客服 2：用户） 
		$bs->pushUint32_t($this->time_reply);	//<uint32_t>  回复时间 
		$bs->pushString($this->content);	//<std::string>  回复内容 
		$bs->pushString($this->attachment);	//<std::string>  附件 
		$bs->pushUint32_t($this->ext1);	//<uint32_t> ext1
		$bs->pushString($this->ext2);	//<std::string> ext2
		$bs->pushUint32_t($this->ext3);	//<uint32_t> ext3
		$bs->pushString($this->ext4);	//<std::string> ext4
		$bs->pushUint32_t($this->ext5);	//<uint32_t> ext5
		$bs->pushString($this->ext6);	//<std::string> ext6
		$bs->pushUint8_t($this->rid_u);	//<uint8_t> 
		$bs->pushUint8_t($this->complaint_id_u);	//<uint8_t> 
		$bs->pushUint8_t($this->reply_type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->replyer_id_u);	//<uint8_t> 
		$bs->pushUint8_t($this->replyer_type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->time_reply_u);	//<uint8_t> 
		$bs->pushUint8_t($this->content_u);	//<uint8_t> 
		$bs->pushUint8_t($this->attachment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext2_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext3_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext4_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext5_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext6_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['rid'] = $bs->popUint64_t();	//<uint64_t>  rid 
		$this->_arr_value['complaint_id'] = $bs->popUint64_t();	//<uint64_t>   业务单id 
		$this->_arr_value['reply_type'] = $bs->popUint32_t();	//<uint32_t>  回复类型（1：回复 2：备注） 
		$this->_arr_value['replyer_id'] = $bs->popString();	//<std::string>  回复人 
		$this->_arr_value['replyer_type'] = $bs->popUint32_t();	//<uint32_t>  回复人类型（1：客服 2：用户） 
		$this->_arr_value['time_reply'] = $bs->popUint32_t();	//<uint32_t>  回复时间 
		$this->_arr_value['content'] = $bs->popString();	//<std::string>  回复内容 
		$this->_arr_value['attachment'] = $bs->popString();	//<std::string>  附件 
		$this->_arr_value['ext1'] = $bs->popUint32_t();	//<uint32_t> ext1
		$this->_arr_value['ext2'] = $bs->popString();	//<std::string> ext2
		$this->_arr_value['ext3'] = $bs->popUint32_t();	//<uint32_t> ext3
		$this->_arr_value['ext4'] = $bs->popString();	//<std::string> ext4
		$this->_arr_value['ext5'] = $bs->popUint32_t();	//<uint32_t> ext5
		$this->_arr_value['ext6'] = $bs->popString();	//<std::string> ext6
		$this->_arr_value['rid_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['complaint_id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['reply_type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['replyer_id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['replyer_type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['time_reply_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['content_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['attachment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext3_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext4_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext5_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext6_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}

namespace icson\servicecenter\ddo;	//source idl: com.b2b2c.kf.idl.DAO_51Buy_ServiceCenter.java
class ApplyInfo{
	private $_arr_value=array();	//数组形式的类
	private $baseInfo;	//<icson::servicecenter::ddo::CBaseStatInfo>  基础信息 (版本>=0)
	private $subtype;	//<uint32_t>  子类型 (版本>=0)
	private $order_state;	//<std::string>  订单状态 (版本>=0)
	private $postsale_id;	//<std::string>  售后单id (版本>=0)
	private $title;	//<std::string>  标题 (版本>=0)
	private $content;	//<std::string>  内容 (版本>=0)
	private $attachment;	//<std::string>  附件 (版本>=0)
	private $detail;	//<std::string>  投诉详情（新地址，新时间，投诉内容） (版本>=0)
	private $unsati_detail;	//<std::string>  不满详情 (版本>=0)
	private $question_url;	//<std::string>  活动咨询URL (版本>=0)
	private $est_comp_time;	//<uint32_t>  预计完成时间 (版本>=0)
	private $est_deal_time;	//<uint32_t>  预计受理时间 (版本>=0)
	private $file_kf;	//<std::string>  归档人 (版本>=0)
	private $file_time;	//<uint32_t>  归档时间 (版本>=0)
	private $hasReply;	//<uint32_t>  是否有新回复 (版本>=0)
	private $baseInfo_u;	//<uint8_t> (版本>=0)
	private $subtype_u;	//<uint8_t> (版本>=0)
	private $order_state_u;	//<uint8_t> (版本>=0)
	private $postsale_id_u;	//<uint8_t> (版本>=0)
	private $title_u;	//<uint8_t> (版本>=0)
	private $content_u;	//<uint8_t> (版本>=0)
	private $attachment_u;	//<uint8_t> (版本>=0)
	private $detail_u;	//<uint8_t> (版本>=0)
	private $unsati_detail_u;	//<uint8_t> (版本>=0)
	private $question_url_u;	//<uint8_t> (版本>=0)
	private $est_comp_time_u;	//<uint8_t> (版本>=0)
	private $est_deal_time_u;	//<uint8_t> (版本>=0)
	private $file_kf_u;	//<uint8_t> (版本>=0)
	private $file_time_u;	//<uint8_t> (版本>=0)
	private $hasReply_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->baseInfo = new \icson\servicecenter\ddo\BaseStatInfo();	//<icson::servicecenter::ddo::CBaseStatInfo>
		$this->subtype = 0;	//<uint32_t>
		$this->order_state = "";	//<std::string>
		$this->postsale_id = "";	//<std::string>
		$this->title = "";	//<std::string>
		$this->content = "";	//<std::string>
		$this->attachment = "";	//<std::string>
		$this->detail = "";	//<std::string>
		$this->unsati_detail = "";	//<std::string>
		$this->question_url = "";	//<std::string>
		$this->est_comp_time = 0;	//<uint32_t>
		$this->est_deal_time = 0;	//<uint32_t>
		$this->file_kf = "";	//<std::string>
		$this->file_time = 0;	//<uint32_t>
		$this->hasReply = 0;	//<uint32_t>
		$this->baseInfo_u = 0;	//<uint8_t>
		$this->subtype_u = 0;	//<uint8_t>
		$this->order_state_u = 0;	//<uint8_t>
		$this->postsale_id_u = 0;	//<uint8_t>
		$this->title_u = 0;	//<uint8_t>
		$this->content_u = 0;	//<uint8_t>
		$this->attachment_u = 0;	//<uint8_t>
		$this->detail_u = 0;	//<uint8_t>
		$this->unsati_detail_u = 0;	//<uint8_t>
		$this->question_url_u = 0;	//<uint8_t>
		$this->est_comp_time_u = 0;	//<uint8_t>
		$this->est_deal_time_u = 0;	//<uint8_t>
		$this->file_kf_u = 0;	//<uint8_t>
		$this->file_time_u = 0;	//<uint8_t>
		$this->hasReply_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\servicecenter\ddo\ApplyInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("icson\servicecenter\ddo\ApplyInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushObject($this->baseInfo,'\icson\servicecenter\ddo\BaseStatInfo');	//<icson::servicecenter::ddo::CBaseStatInfo>  基础信息 
		$bs->pushUint32_t($this->subtype);	//<uint32_t>  子类型 
		$bs->pushString($this->order_state);	//<std::string>  订单状态 
		$bs->pushString($this->postsale_id);	//<std::string>  售后单id 
		$bs->pushString($this->title);	//<std::string>  标题 
		$bs->pushString($this->content);	//<std::string>  内容 
		$bs->pushString($this->attachment);	//<std::string>  附件 
		$bs->pushString($this->detail);	//<std::string>  投诉详情（新地址，新时间，投诉内容） 
		$bs->pushString($this->unsati_detail);	//<std::string>  不满详情 
		$bs->pushString($this->question_url);	//<std::string>  活动咨询URL 
		$bs->pushUint32_t($this->est_comp_time);	//<uint32_t>  预计完成时间 
		$bs->pushUint32_t($this->est_deal_time);	//<uint32_t>  预计受理时间 
		$bs->pushString($this->file_kf);	//<std::string>  归档人 
		$bs->pushUint32_t($this->file_time);	//<uint32_t>  归档时间 
		$bs->pushUint32_t($this->hasReply);	//<uint32_t>  是否有新回复 
		$bs->pushUint8_t($this->baseInfo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->subtype_u);	//<uint8_t> 
		$bs->pushUint8_t($this->order_state_u);	//<uint8_t> 
		$bs->pushUint8_t($this->postsale_id_u);	//<uint8_t> 
		$bs->pushUint8_t($this->title_u);	//<uint8_t> 
		$bs->pushUint8_t($this->content_u);	//<uint8_t> 
		$bs->pushUint8_t($this->attachment_u);	//<uint8_t> 
		$bs->pushUint8_t($this->detail_u);	//<uint8_t> 
		$bs->pushUint8_t($this->unsati_detail_u);	//<uint8_t> 
		$bs->pushUint8_t($this->question_url_u);	//<uint8_t> 
		$bs->pushUint8_t($this->est_comp_time_u);	//<uint8_t> 
		$bs->pushUint8_t($this->est_deal_time_u);	//<uint8_t> 
		$bs->pushUint8_t($this->file_kf_u);	//<uint8_t> 
		$bs->pushUint8_t($this->file_time_u);	//<uint8_t> 
		$bs->pushUint8_t($this->hasReply_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['baseInfo'] = $bs->popObject('\icson\servicecenter\ddo\BaseStatInfo');	//<icson::servicecenter::ddo::CBaseStatInfo>  基础信息 
		$this->_arr_value['subtype'] = $bs->popUint32_t();	//<uint32_t>  子类型 
		$this->_arr_value['order_state'] = $bs->popString();	//<std::string>  订单状态 
		$this->_arr_value['postsale_id'] = $bs->popString();	//<std::string>  售后单id 
		$this->_arr_value['title'] = $bs->popString();	//<std::string>  标题 
		$this->_arr_value['content'] = $bs->popString();	//<std::string>  内容 
		$this->_arr_value['attachment'] = $bs->popString();	//<std::string>  附件 
		$this->_arr_value['detail'] = $bs->popString();	//<std::string>  投诉详情（新地址，新时间，投诉内容） 
		$this->_arr_value['unsati_detail'] = $bs->popString();	//<std::string>  不满详情 
		$this->_arr_value['question_url'] = $bs->popString();	//<std::string>  活动咨询URL 
		$this->_arr_value['est_comp_time'] = $bs->popUint32_t();	//<uint32_t>  预计完成时间 
		$this->_arr_value['est_deal_time'] = $bs->popUint32_t();	//<uint32_t>  预计受理时间 
		$this->_arr_value['file_kf'] = $bs->popString();	//<std::string>  归档人 
		$this->_arr_value['file_time'] = $bs->popUint32_t();	//<uint32_t>  归档时间 
		$this->_arr_value['hasReply'] = $bs->popUint32_t();	//<uint32_t>  是否有新回复 
		$this->_arr_value['baseInfo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['subtype_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['order_state_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['postsale_id_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['title_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['content_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['attachment_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['detail_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['unsati_detail_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['question_url_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['est_comp_time_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['est_deal_time_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['file_kf_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['file_time_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['hasReply_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}

namespace icson\servicecenter\ddo;	//source idl: com.b2b2c.kf.idl.ApplyInfo.java
class BaseStatInfo{
	private $_arr_value=array();	//数组形式的类
	private $sysNo;	//<uint32_t> 系统编号(版本>=0)
	private $source;	//<uint32_t>  来源 (版本>=0)
	private $biz;	//<uint32_t>  业务 (版本>=0)
	private $siteID;	//<uint32_t>  分站ID (版本>=0)
	private $type;	//<uint32_t>  工单类型 (版本>=0)
	private $billNo;	//<std::string>  业务单号 (版本>=0)
	private $orderNo;	//<std::string>  订单号 (版本>=0)
	private $account;	//<std::string>  用户帐号 (版本>=0)
	private $userType;	//<uint32_t>  帐号类型 (版本>=0)
	private $userName;	//<std::string>  用户姓名 (版本>=0)
	private $userPhone;	//<std::string>  用户电话 (版本>=0)
	private $isVIP;	//<uint32_t>  是否是VIP (版本>=0)
	private $optTeam;	//<uint32_t>  受理分组 (版本>=0)
	private $creator;	//<std::string>  创建人 (版本>=0)
	private $followKF;	//<std::string>  跟进人 (版本>=0)
	private $censor;	//<std::string>  质检人 (版本>=0)
	private $state;	//<uint32_t>  单据状态 (版本>=0)
	private $flag;	//<uint32_t>  单据标识(催办/疑难/升级/典型工单) (版本>=0)
	private $approve;	//<uint32_t>  满意度 (版本>=0)
	private $checkup;	//<uint32_t>  质检结果 (版本>=0)
	private $productdCate;	//<std::string>  商品类目 (版本>=0)
	private $archive;	//<std::string>  归档路径 (版本>=0)
	private $createTime;	//<uint32_t>  生成时间 (版本>=0)
	private $distributeTime;	//<uint32_t>  分单时间 (版本>=0)
	private $acceptTime;	//<uint32_t>  实际受理时间 (版本>=0)
	private $nextTime;	//<uint32_t>  再次跟进时间 (版本>=0)
	private $finishTime;	//<uint32_t>  结束时间 (版本>=0)
	private $checkupTime;	//<uint32_t>  质检时间 (版本>=0)
	private $modifyTime;	//<uint32_t>  最后更新时间 (版本>=0)
	private $sumTime;	//<uint32_t>  处理总时长(结束时间 - 生成时间) (版本>=0)
	private $dealTime;	//<uint32_t>  实际处理时长(结束时间 - 受理时间) (版本>=0)
	private $ext1;	//<uint32_t> ext1(版本>=0)
	private $ext2;	//<std::string> ext2(版本>=0)
	private $ext3;	//<uint32_t> ext3(版本>=0)
	private $ext4;	//<std::string> ext4(版本>=0)
	private $ext5;	//<uint32_t> ext5(版本>=0)
	private $ext6;	//<std::string> ext6(版本>=0)
	private $sysNo_u;	//<uint8_t> (版本>=0)
	private $source_u;	//<uint8_t> (版本>=0)
	private $biz_u;	//<uint8_t> (版本>=0)
	private $siteID_u;	//<uint8_t> (版本>=0)
	private $type_u;	//<uint8_t> (版本>=0)
	private $billNo_u;	//<uint8_t> (版本>=0)
	private $orderNo_u;	//<uint8_t> (版本>=0)
	private $account_u;	//<uint8_t> (版本>=0)
	private $userType_u;	//<uint8_t> (版本>=0)
	private $userName_u;	//<uint8_t> (版本>=0)
	private $userPhone_u;	//<uint8_t> (版本>=0)
	private $isVIP_u;	//<uint8_t> (版本>=0)
	private $optTeam_u;	//<uint8_t> (版本>=0)
	private $creator_u;	//<uint8_t> (版本>=0)
	private $followKF_u;	//<uint8_t> (版本>=0)
	private $censor_u;	//<uint8_t> (版本>=0)
	private $state_u;	//<uint8_t> (版本>=0)
	private $flag_u;	//<uint8_t> (版本>=0)
	private $approve_u;	//<uint8_t> (版本>=0)
	private $checkup_u;	//<uint8_t> (版本>=0)
	private $productdCate_u;	//<uint8_t> (版本>=0)
	private $archive_u;	//<uint8_t> (版本>=0)
	private $createTime_u;	//<uint8_t> (版本>=0)
	private $distributeTime_u;	//<uint8_t> (版本>=0)
	private $acceptTime_u;	//<uint8_t> (版本>=0)
	private $nextTime_u;	//<uint8_t> (版本>=0)
	private $finishTime_u;	//<uint8_t> (版本>=0)
	private $checkupTime_u;	//<uint8_t> (版本>=0)
	private $modifyTime_u;	//<uint8_t> (版本>=0)
	private $sumTime_u;	//<uint8_t> (版本>=0)
	private $dealTime_u;	//<uint8_t> (版本>=0)
	private $ext1_u;	//<uint8_t> (版本>=0)
	private $ext2_u;	//<uint8_t> (版本>=0)
	private $ext3_u;	//<uint8_t> (版本>=0)
	private $ext4_u;	//<uint8_t> (版本>=0)
	private $ext5_u;	//<uint8_t> (版本>=0)
	private $ext6_u;	//<uint8_t> (版本>=0)

	function __construct(){
		$this->sysNo = 0;	//<uint32_t>
		$this->source = 0;	//<uint32_t>
		$this->biz = 0;	//<uint32_t>
		$this->siteID = 0;	//<uint32_t>
		$this->type = 0;	//<uint32_t>
		$this->billNo = "";	//<std::string>
		$this->orderNo = "";	//<std::string>
		$this->account = "";	//<std::string>
		$this->userType = 0;	//<uint32_t>
		$this->userName = "";	//<std::string>
		$this->userPhone = "";	//<std::string>
		$this->isVIP = 0;	//<uint32_t>
		$this->optTeam = 0;	//<uint32_t>
		$this->creator = "";	//<std::string>
		$this->followKF = "";	//<std::string>
		$this->censor = "";	//<std::string>
		$this->state = 0;	//<uint32_t>
		$this->flag = 0;	//<uint32_t>
		$this->approve = 0;	//<uint32_t>
		$this->checkup = 0;	//<uint32_t>
		$this->productdCate = "";	//<std::string>
		$this->archive = "";	//<std::string>
		$this->createTime = 0;	//<uint32_t>
		$this->distributeTime = 0;	//<uint32_t>
		$this->acceptTime = 0;	//<uint32_t>
		$this->nextTime = 0;	//<uint32_t>
		$this->finishTime = 0;	//<uint32_t>
		$this->checkupTime = 0;	//<uint32_t>
		$this->modifyTime = 0;	//<uint32_t>
		$this->sumTime = 0;	//<uint32_t>
		$this->dealTime = 0;	//<uint32_t>
		$this->ext1 = 0;	//<uint32_t>
		$this->ext2 = "";	//<std::string>
		$this->ext3 = 0;	//<uint32_t>
		$this->ext4 = "";	//<std::string>
		$this->ext5 = 0;	//<uint32_t>
		$this->ext6 = "";	//<std::string>
		$this->sysNo_u = 0;	//<uint8_t>
		$this->source_u = 0;	//<uint8_t>
		$this->biz_u = 0;	//<uint8_t>
		$this->siteID_u = 0;	//<uint8_t>
		$this->type_u = 0;	//<uint8_t>
		$this->billNo_u = 0;	//<uint8_t>
		$this->orderNo_u = 0;	//<uint8_t>
		$this->account_u = 0;	//<uint8_t>
		$this->userType_u = 0;	//<uint8_t>
		$this->userName_u = 0;	//<uint8_t>
		$this->userPhone_u = 0;	//<uint8_t>
		$this->isVIP_u = 0;	//<uint8_t>
		$this->optTeam_u = 0;	//<uint8_t>
		$this->creator_u = 0;	//<uint8_t>
		$this->followKF_u = 0;	//<uint8_t>
		$this->censor_u = 0;	//<uint8_t>
		$this->state_u = 0;	//<uint8_t>
		$this->flag_u = 0;	//<uint8_t>
		$this->approve_u = 0;	//<uint8_t>
		$this->checkup_u = 0;	//<uint8_t>
		$this->productdCate_u = 0;	//<uint8_t>
		$this->archive_u = 0;	//<uint8_t>
		$this->createTime_u = 0;	//<uint8_t>
		$this->distributeTime_u = 0;	//<uint8_t>
		$this->acceptTime_u = 0;	//<uint8_t>
		$this->nextTime_u = 0;	//<uint8_t>
		$this->finishTime_u = 0;	//<uint8_t>
		$this->checkupTime_u = 0;	//<uint8_t>
		$this->modifyTime_u = 0;	//<uint8_t>
		$this->sumTime_u = 0;	//<uint8_t>
		$this->dealTime_u = 0;	//<uint8_t>
		$this->ext1_u = 0;	//<uint8_t>
		$this->ext2_u = 0;	//<uint8_t>
		$this->ext3_u = 0;	//<uint8_t>
		$this->ext4_u = 0;	//<uint8_t>
		$this->ext5_u = 0;	//<uint8_t>
		$this->ext6_u = 0;	//<uint8_t>
	}

	function __set($name,$val){
		if(isset($this->$name)){
			if(is_object($this->$name)){
				if(!is_array($val)) exit("icson\servicecenter\ddo\BaseStatInfo\\{$name}：请直接赋值为数组，无需new ***。");
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
			exit("icson\servicecenter\ddo\BaseStatInfo\\{$name}：不存在此变量，请查询xxoo。");
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
		$bs->pushUint32_t($this->sysNo);	//<uint32_t> 系统编号
		$bs->pushUint32_t($this->source);	//<uint32_t>  来源 
		$bs->pushUint32_t($this->biz);	//<uint32_t>  业务 
		$bs->pushUint32_t($this->siteID);	//<uint32_t>  分站ID 
		$bs->pushUint32_t($this->type);	//<uint32_t>  工单类型 
		$bs->pushString($this->billNo);	//<std::string>  业务单号 
		$bs->pushString($this->orderNo);	//<std::string>  订单号 
		$bs->pushString($this->account);	//<std::string>  用户帐号 
		$bs->pushUint32_t($this->userType);	//<uint32_t>  帐号类型 
		$bs->pushString($this->userName);	//<std::string>  用户姓名 
		$bs->pushString($this->userPhone);	//<std::string>  用户电话 
		$bs->pushUint32_t($this->isVIP);	//<uint32_t>  是否是VIP 
		$bs->pushUint32_t($this->optTeam);	//<uint32_t>  受理分组 
		$bs->pushString($this->creator);	//<std::string>  创建人 
		$bs->pushString($this->followKF);	//<std::string>  跟进人 
		$bs->pushString($this->censor);	//<std::string>  质检人 
		$bs->pushUint32_t($this->state);	//<uint32_t>  单据状态 
		$bs->pushUint32_t($this->flag);	//<uint32_t>  单据标识(催办/疑难/升级/典型工单) 
		$bs->pushUint32_t($this->approve);	//<uint32_t>  满意度 
		$bs->pushUint32_t($this->checkup);	//<uint32_t>  质检结果 
		$bs->pushString($this->productdCate);	//<std::string>  商品类目 
		$bs->pushString($this->archive);	//<std::string>  归档路径 
		$bs->pushUint32_t($this->createTime);	//<uint32_t>  生成时间 
		$bs->pushUint32_t($this->distributeTime);	//<uint32_t>  分单时间 
		$bs->pushUint32_t($this->acceptTime);	//<uint32_t>  实际受理时间 
		$bs->pushUint32_t($this->nextTime);	//<uint32_t>  再次跟进时间 
		$bs->pushUint32_t($this->finishTime);	//<uint32_t>  结束时间 
		$bs->pushUint32_t($this->checkupTime);	//<uint32_t>  质检时间 
		$bs->pushUint32_t($this->modifyTime);	//<uint32_t>  最后更新时间 
		$bs->pushUint32_t($this->sumTime);	//<uint32_t>  处理总时长(结束时间 - 生成时间) 
		$bs->pushUint32_t($this->dealTime);	//<uint32_t>  实际处理时长(结束时间 - 受理时间) 
		$bs->pushUint32_t($this->ext1);	//<uint32_t> ext1
		$bs->pushString($this->ext2);	//<std::string> ext2
		$bs->pushUint32_t($this->ext3);	//<uint32_t> ext3
		$bs->pushString($this->ext4);	//<std::string> ext4
		$bs->pushUint32_t($this->ext5);	//<uint32_t> ext5
		$bs->pushString($this->ext6);	//<std::string> ext6
		$bs->pushUint8_t($this->sysNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->source_u);	//<uint8_t> 
		$bs->pushUint8_t($this->biz_u);	//<uint8_t> 
		$bs->pushUint8_t($this->siteID_u);	//<uint8_t> 
		$bs->pushUint8_t($this->type_u);	//<uint8_t> 
		$bs->pushUint8_t($this->billNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->orderNo_u);	//<uint8_t> 
		$bs->pushUint8_t($this->account_u);	//<uint8_t> 
		$bs->pushUint8_t($this->userType_u);	//<uint8_t> 
		$bs->pushUint8_t($this->userName_u);	//<uint8_t> 
		$bs->pushUint8_t($this->userPhone_u);	//<uint8_t> 
		$bs->pushUint8_t($this->isVIP_u);	//<uint8_t> 
		$bs->pushUint8_t($this->optTeam_u);	//<uint8_t> 
		$bs->pushUint8_t($this->creator_u);	//<uint8_t> 
		$bs->pushUint8_t($this->followKF_u);	//<uint8_t> 
		$bs->pushUint8_t($this->censor_u);	//<uint8_t> 
		$bs->pushUint8_t($this->state_u);	//<uint8_t> 
		$bs->pushUint8_t($this->flag_u);	//<uint8_t> 
		$bs->pushUint8_t($this->approve_u);	//<uint8_t> 
		$bs->pushUint8_t($this->checkup_u);	//<uint8_t> 
		$bs->pushUint8_t($this->productdCate_u);	//<uint8_t> 
		$bs->pushUint8_t($this->archive_u);	//<uint8_t> 
		$bs->pushUint8_t($this->createTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->distributeTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->acceptTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->nextTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->finishTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->checkupTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->modifyTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->sumTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->dealTime_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext1_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext2_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext3_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext4_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext5_u);	//<uint8_t> 
		$bs->pushUint8_t($this->ext6_u);	//<uint8_t> 
	}

	function unserialize($bs){
		$class_len = $bs->popUint32_t();
		$startPop  = $bs->getReadLength();
		$this->_arr_value['sysNo'] = $bs->popUint32_t();	//<uint32_t> 系统编号
		$this->_arr_value['source'] = $bs->popUint32_t();	//<uint32_t>  来源 
		$this->_arr_value['biz'] = $bs->popUint32_t();	//<uint32_t>  业务 
		$this->_arr_value['siteID'] = $bs->popUint32_t();	//<uint32_t>  分站ID 
		$this->_arr_value['type'] = $bs->popUint32_t();	//<uint32_t>  工单类型 
		$this->_arr_value['billNo'] = $bs->popString();	//<std::string>  业务单号 
		$this->_arr_value['orderNo'] = $bs->popString();	//<std::string>  订单号 
		$this->_arr_value['account'] = $bs->popString();	//<std::string>  用户帐号 
		$this->_arr_value['userType'] = $bs->popUint32_t();	//<uint32_t>  帐号类型 
		$this->_arr_value['userName'] = $bs->popString();	//<std::string>  用户姓名 
		$this->_arr_value['userPhone'] = $bs->popString();	//<std::string>  用户电话 
		$this->_arr_value['isVIP'] = $bs->popUint32_t();	//<uint32_t>  是否是VIP 
		$this->_arr_value['optTeam'] = $bs->popUint32_t();	//<uint32_t>  受理分组 
		$this->_arr_value['creator'] = $bs->popString();	//<std::string>  创建人 
		$this->_arr_value['followKF'] = $bs->popString();	//<std::string>  跟进人 
		$this->_arr_value['censor'] = $bs->popString();	//<std::string>  质检人 
		$this->_arr_value['state'] = $bs->popUint32_t();	//<uint32_t>  单据状态 
		$this->_arr_value['flag'] = $bs->popUint32_t();	//<uint32_t>  单据标识(催办/疑难/升级/典型工单) 
		$this->_arr_value['approve'] = $bs->popUint32_t();	//<uint32_t>  满意度 
		$this->_arr_value['checkup'] = $bs->popUint32_t();	//<uint32_t>  质检结果 
		$this->_arr_value['productdCate'] = $bs->popString();	//<std::string>  商品类目 
		$this->_arr_value['archive'] = $bs->popString();	//<std::string>  归档路径 
		$this->_arr_value['createTime'] = $bs->popUint32_t();	//<uint32_t>  生成时间 
		$this->_arr_value['distributeTime'] = $bs->popUint32_t();	//<uint32_t>  分单时间 
		$this->_arr_value['acceptTime'] = $bs->popUint32_t();	//<uint32_t>  实际受理时间 
		$this->_arr_value['nextTime'] = $bs->popUint32_t();	//<uint32_t>  再次跟进时间 
		$this->_arr_value['finishTime'] = $bs->popUint32_t();	//<uint32_t>  结束时间 
		$this->_arr_value['checkupTime'] = $bs->popUint32_t();	//<uint32_t>  质检时间 
		$this->_arr_value['modifyTime'] = $bs->popUint32_t();	//<uint32_t>  最后更新时间 
		$this->_arr_value['sumTime'] = $bs->popUint32_t();	//<uint32_t>  处理总时长(结束时间 - 生成时间) 
		$this->_arr_value['dealTime'] = $bs->popUint32_t();	//<uint32_t>  实际处理时长(结束时间 - 受理时间) 
		$this->_arr_value['ext1'] = $bs->popUint32_t();	//<uint32_t> ext1
		$this->_arr_value['ext2'] = $bs->popString();	//<std::string> ext2
		$this->_arr_value['ext3'] = $bs->popUint32_t();	//<uint32_t> ext3
		$this->_arr_value['ext4'] = $bs->popString();	//<std::string> ext4
		$this->_arr_value['ext5'] = $bs->popUint32_t();	//<uint32_t> ext5
		$this->_arr_value['ext6'] = $bs->popString();	//<std::string> ext6
		$this->_arr_value['sysNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['source_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['biz_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['siteID_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['type_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['billNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['orderNo_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['account_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['userType_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['userName_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['userPhone_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['isVIP_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['optTeam_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['creator_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['followKF_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['censor_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['state_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['flag_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['approve_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['checkup_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['productdCate_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['archive_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['createTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['distributeTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['acceptTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['nextTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['finishTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['checkupTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['modifyTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['sumTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['dealTime_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext1_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext2_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext3_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext4_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext5_u'] = $bs->popUint8_t();	//<uint8_t> 
		$this->_arr_value['ext6_u'] = $bs->popUint8_t();	//<uint8_t> 

		/**********************为了支持多个版本的客户端************************/
		$needPopLen = $class_len - ($bs->getReadLength() - $startPop);
		for($idx = 0;$idx < $needPopLen;$idx++){
			$bs->popUint8_t();
		}
		/**********************为了支持多个版本的客户端************************/
		
		return $this->_arr_value;
	}

	function getClassLen(){
		$len_bs = new \ByteStream();
		$len_bs->setRealWrite(false);
		$this->serialize_internal($len_bs);
		$class_len = $len_bs->getWrittenLength();

		return $class_len;
	}
}
