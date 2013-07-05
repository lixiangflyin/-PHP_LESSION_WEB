<?php 
require_once(PHPLIB_ROOT . 'api/appplatform/platform_api.php');
require_once(PHPLIB_ROOT . 'api/appplatform/activeao/php4/activeao_stub4php.php');

/*
* @desc 虚拟充值活动支持 
* @author hongfuguan
* @date 2013-06-26
* @param
* @return
*/
class IVirtualAct {
	/*
    * @desc 条件检查
    * @author hongfuguan
    * @date 2013-05-10
    * @param
    * @return
    */
    public static function checkCondition($data){
    	$ActiveRequestPo = new ActiveRequestPo();
		$ActiveRequestPo->strActiveName = $data['strActiveName'];
		$ActiveRequestPo->dwActiveType = $data['dwActiveType'];
		$ActiveRequestPo->bPreCheckTag = $data['bPreCheckTag'];
		$ActiveRequestPo->dwUin = (int) $data['dwUin'];
		$ActiveRequestPo->dwReqCount = $data['dwReqCount'];

		//var_dump($ActiveRequestPo);exit;
		
		$param = array(
			'source' => __FILE__,
			'activeRequestPo' => $ActiveRequestPo
		);
		mb_convert_variables("GBK", "UTF-8,GBK", $param);
		$api = new Platform_API('JoinActive');
		$resp = $api->exec($param, 'yixun_chong_96zhe');
		$result = array(); // 统一封装返回的值 传到view中必须有total error data三者 以下同
		if($resp->result != '0'){
			$result = array(
				'errorCode' => (string) $resp->result,
				'data' => ''
			);
			return $result;
		}
		$result = array(
			'errorCode' => '0',
			'data' => $resp->activeResponePo
		);
		
		return $result;
    }

    /*
    * @desc 领取次数添加
    * @author hongfuguan
    * @date 2013-05-10
    * @param
    * @return
    */
    public static function addCount($data){
    	$ActiveRequestPo = new ActiveRequestPo();
		$ActiveRequestPo->strActiveName = $data['strActiveName'];
		$ActiveRequestPo->dwActiveType = $data['dwActiveType'];
		$ActiveRequestPo->bPreCheckTag = $data['bPreCheckTag'];
		$ActiveRequestPo->dwUin = (int) $data['dwUin'];
		$ActiveRequestPo->dwReqCount = $data['dwReqCount'];

		//var_dump($ActiveRequestPo);exit;
		
		$param = array(
			'source' => __FILE__,
			'activeRequestPo' => $ActiveRequestPo
		);
		mb_convert_variables("GBK", "UTF-8,GBK", $param);
		$api = new Platform_API('JoinActive');
		$resp = $api->exec($param, 'yixun_chong_96zhe');
		$result = array(); // 统一封装返回的值 传到view中必须有total error data三者 以下同
		if($resp->result != '0'){
			$result = array(
				'errorCode' => (string) $resp->result,
				'data' => ''
			);
			return $result;
		}
		$result = array(
			'errorCode' => '0',
			'data' => $resp->activeResponePo
		);
		
		return $result;
    }
    /*
    * @desc 领取次数减少 注意仅测试用
    * @author hongfuguan
    * @date 2013-05-10
    * @param
    * @return
    */
    public static function delCount($data){
    	$ActiveRequestPo = new ActiveRequestPo();
		$ActiveRequestPo->strActiveName = $data['strActiveName'];
		$ActiveRequestPo->dwActiveType = $data['dwActiveType'];
		$ActiveRequestPo->bPreCheckTag = $data['bPreCheckTag'];
		$ActiveRequestPo->dwUin = (int) $data['dwUin'];
		$ActiveRequestPo->dwReqCount = $data['dwReqCount'];

		//var_dump($ActiveRequestPo);exit;
		
		$param = array(
			'source' => __FILE__,
			'activeRequestPo' => $ActiveRequestPo
		);
		mb_convert_variables("GBK", "UTF-8,GBK", $param);
		$api = new Platform_API('RollBackActive');
		$resp = $api->exec($param, 'yixun_chong_96zhe');
		$result = array(); // 统一封装返回的值 传到view中必须有total error data三者 以下同
		if($resp->result != '0'){
			$result = array(
				'errorCode' => (string) $resp->result,
				'data' => ''
			);
			return $result;
		}
		$result = array(
			'errorCode' => '0',
			'data' => $resp->rollBackResult
		);
		
		return $result;
    }
}