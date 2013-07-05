<?php
require_once 'platform/web_stub_cntl.php';
/*
* @desc 调用拍拍AO接口封装 
* @author hongfuguan
* @date 2013-06-26
* @param
* @return
*/
class Platform_API {
	function __construct($method){	
		$this->method = $method;
	}
	
	// 执行接口
	function exec($param, $caller = "yixun", $timeout = 10){
		// 构造请求数据
		$method_req = $this->method . 'Req';
		$req = new $method_req();
		foreach($param as $key => $value){
			$req->$key = $value;
		}
		
		// 构造返回数据
		$method_resp = $this->method . 'Resp';
		$resp = new $method_resp();
		
		// 执行请求
		$ret = $this->invoke($req, $resp, $caller, $timeout);
		if($ret != 0){
			return $ret;
		}
		return $resp;
	}
	
	function invoke($req, $resp, $caller = "yixun", $timeout = 10){
		$cntl = new WebStubCntl();
		$cntl->setCallerName($caller);
		$ret = $cntl->invoke($req, $resp, $timeout);
		if($ret != 0){
			printf("Invoke failed, RetCode[0x%x] ErrMsg[%s]\n", $ret, $cntl->getLastErrMsg());
			echo '<br />请求服务器内容时出错';
			return $ret;
		}	
	}
}