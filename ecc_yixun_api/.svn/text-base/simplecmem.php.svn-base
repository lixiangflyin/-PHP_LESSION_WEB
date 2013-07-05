<?php
/*
 * 获取Cmem中Key对应的value值
 * svcName  配置中心配置的手工服务的名字
 * key最后存放在Cmem中的key值
 
 返回值:一个array  包含两个字段：
 result  非0 报错    为0 正确获取数据
 msg   错误信息      提示信息
 data   无定义       数据信息
*/

function Cmem_getKey(&$svcName,&$bid,&$key) {
	$arrServer = getServerBysvcName($svcName);
	$tmem_api= new tmem();
	$timeoust_ms = defined('CMEM_TIMEOUT') ? CMEM_TIMEOUT:1000; 
	
	$conn_resp =  conn_server($tmem_api,$arrServer);
	if($conn_resp->result != 0) {
		$resp->result = $conn_resp->result;
		$resp->msg = "get servers error";
		return $resp;
	}
	$data  = $tmem_api->get($bid,$key);
	if(($tmem_api->errno()) != 0 ) {
		$resp->result = $tmem_api->errno();
		$resp->msg = "get error";
		return $resp;
	} else {
		$resp->result = 0;
		$resp->msg = "get success";
		$resp->data = $data;
		return $resp;
	}
	
}

function Cmem_setKey(&$svcName,&$bid,&$key,&$data) {
	$arrServer = getServerBysvcName($svcName);
	$tmem_api= new tmem();
	$timeoust_ms = defined('CMEM_TIMEOUT') ? CMEM_TIMEOUT:1000; 
	
	$conn_resp =  conn_server($tmem_api,$arrServer);
	if($conn_resp->result != 0) {
		$resp->result = $conn_resp->result;
		$resp->msg = "get servers error";
		return $resp;
	}
	
	$data  = $tmem_api->set($bid,$key,$data);
	if(($tmem_api->errno()) != 0 ) {
		$resp->result = $tmem_api->errno();
		$resp->msg = "get error";
		return $resp;
	} else {
		$resp->result = 0;
		$resp->msg = "get success";
		return $resp;
	}
	
}

function Cmem_deleteKey(&$svcName,&$bid,&$key) {
	$arrServer = getServerBysvcName($svcName);
	$tmem_api= new tmem();
	$timeoust_ms = defined('CMEM_TIMEOUT') ? CMEM_TIMEOUT:1000; 
	
	$conn_resp =  conn_server($tmem_api,$arrServer);
	if($conn_resp->result != 0) {
		$resp->result = $conn_resp->result;
		$resp->msg = "get servers error";
		return $resp;
	}
	
	$data  = $tmem_api->del($bid,$key);
	if(($tmem_api->errno()) != 0 ) {
		$resp->result = $tmem_api->errno();
		$resp->msg = "delete error";
		return $resp;
	} else {
		$resp->result = 0;
		$resp->msg = "delete success";
		return $resp;
	}
	
}




function conn_server(&$tmem_api,&$svcarray) {
	$tmem_api->set_connect_timeout($timeout_ms);
	if(($tmem_api->errno()) != 0 ) {
		$resp->result = $tmem_api->errno();
		$resp->msg = "connect error";
		return $resp;
	}
	/*
	  * $arr 服务器业务的
	  *	$timeout_ms 收发数据超时时间(毫秒)
	  * $freetime 
	  
	
	*/
	$freezesecs = defined('CMEM_FREEZE_TIME') ? CMEM_FREEZE_TIME:10; 
	$tmem_api->set_servers($svcarray,$timeout_ms,$freezesecs);
	if(($tmem_api->errno()) != 0 ) {
		$resp->result = $tmem_api->errno();
		$resp->msg = "set servers error";
		return $resp;
	} else {
		$resp->result = 0;
		$resp->msg = 'connect success';
		return $resp;
	}
}
/*
 * 循环获取手工服务下面的所有ip:port 这里要求所有的手工服务的ip都配置在set0下面

*/
function getServerBysvcName(&$svcName) {
	$server_array = array();
	$total_svc =configcenter4_get_serv_count($svcName,0);
	for($i=0;$i<$total_svc;$i++) {
		$server=configcenter4_get_serv($svcName,0,$i);
		if(array_key_exists($server,$server_array) ) {
			break;
		} else {
			$server_array[$server] = $i;
		}
	}
	//$server=configcenter4_get_serv($svcName,0,0);
	
	return array_flip($server_array);
}