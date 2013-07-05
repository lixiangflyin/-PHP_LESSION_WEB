<?php
/*
 * ��ȡCmem��Key��Ӧ��valueֵ
 * svcName  �����������õ��ֹ����������
 * key�������Cmem�е�keyֵ
 
 ����ֵ:һ��array  ���������ֶΣ�
 result  ��0 ����    Ϊ0 ��ȷ��ȡ����
 msg   ������Ϣ      ��ʾ��Ϣ
 data   �޶���       ������Ϣ
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
	  * $arr ������ҵ���
	  *	$timeout_ms �շ����ݳ�ʱʱ��(����)
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
 * ѭ����ȡ�ֹ��������������ip:port ����Ҫ�����е��ֹ������ip��������set0����

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