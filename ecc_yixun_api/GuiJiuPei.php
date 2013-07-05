<?php
require_once(PHPLIB_ROOT . 'lib/Logger.php');
/*
0���ɹ�
1��TTC��ȡʧ��
2���Ѿ������ύ��¼
3��TTC����ʧ��
4���������ݴ���
*/
class EA_GuiJiuPei {
	public static $errCode = 0;
	public static $errMsg="";

	public function setErr($code, $msg) {
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	public function clearErr() {
		self::$errCode = 0;
		self::$errMsg  = "";
	}
	
public static function get_pids_presented($uid, $order_char_id){
	self::clearErr();
	if (!isset($order_char_id) || $order_char_id == ''){
		self::setErr(4,"order_char_id��������");
		return array('errno' => 4,'data' => "order_char_id��������");
	}
	$ret = IGuiJiuPeiTTC::get($uid, array('order_char_id' => $order_char_id), array('product_char_id'));
	if ($ret === false){
		self::setErr(1,"TTC��ȡʧ��");
		return array('errno' => 1,'data' => $order_char_id . "��ȡʧ��");
	}
	else {
		$hasSubmitProduct = array();
		if(!empty($ret)){
			foreach ($ret as $item){
				$hasSubmitProduct[] = $item['product_char_id'];
			}
		}
		return array('errno' => 0,'data' => $hasSubmitProduct);
	}
}

/**
 * ����������ѯ
 * @param int $uid
 * @param int $pageSize
 * @param int $page
 */
public static function getGJPApplies($uid, $pageSize, $page){
	$total = IGuiJiuPeiTTC::get($uid, array('status' => 0), array('product_char_id'));
	if (false === $total) {
		self::$errCode = IGuiJiuPeiTTC::$errCode;
		self::$errMsg = IGuiJiuPeiTTC::$errMsg;
		Logger::err("IGuiJiuPeiTTC get" . " errMsg: " .IGuiJiuPeiTTC::$errMsg ." errCode: " .IGuiJiuPeiTTC::$errCode);
		return false;
	}
	
	if (count($total) == 0) {
		return array('total'=>0, 'data'=>array());
	}
	
	$total = count($total);
	
	$GJPlist = IGuiJiuPeiTTC::get(
									$uid, 
									array('status' => 0), 
									array('order_char_id', 'product_char_id', 'uid', 'user_name', 'mobile', 'create_time', 'data'), 
									$pageSize, $page*$pageSize
								);
	if($GJPlist === false){
		self::$errCode = IGuiJiuPeiTTC::$errCode;
		self::$errMsg = IGuiJiuPeiTTC::$errMsg;
		Logger::err("IGuiJiuPeiTTC get" . " errMsg: " .IGuiJiuPeiTTC::$errMsg ." errCode: " .IGuiJiuPeiTTC::$errCode);
		return false;
	} 

	foreach ($GJPlist as $k => $v){
		$GJPlist[$k]['user_name'] = iconv("utf-8","gb2312", htmlspecialchars($v['user_name'], ENT_QUOTES)); 
		$GJPlist[$k]['data'] = json_decode($v['data'], true);
	}
	
	if(count($GJPlist) == 0){
		return array('total'=>$total, 'data'=>array());
	}
	return array('total'=>$total, 'data'=>$GJPlist);
}

public static function insert($order_char_id, $uid, $product_char_id, $data, $create_time, $user_name, $mobile, $status = 0, $flags = 0){
	self::clearErr();
	//$order_char_idΪ�ַ���
	if (!isset($order_char_id) || $order_char_id ==''){
		self::setErr(4,"order_char_id��������");
		return array('errno' => 4,'data' => "order_char_id��������");
	}
	//$order_char_idΪint
	if (is_null($uid) || !is_numeric($uid) ){
		self::setErr(4,"uid��������");
		return array('errno' => 4,'data' => "uid��������");
	}
	//$user_nameΪ�ַ���
	if (!isset($user_name) || $user_name ==''){
		self::setErr(4,"user_name��������");
		return array('errno' => 4,'data' => "user_name��������");
	}
	//$mobileΪ�ַ���
	if (!isset($mobile) || $mobile ==''){
		self::setErr(4,"mobile��������");
		return array('errno' => 4,'data' => "mobile��������");
	}
	//$dataΪ�������
	if (!isset($data) || $data ==''){
		self::setErr(4,"data��������");
		return array('errno' => 4,'data' => "data��������");
	}
	//$create_timeΪint
	if (is_null($create_time) || !is_numeric($create_time) ){
		$create_time = time();
	}
	$data_json = json_encode($data);
	$param = array(
		'order_char_id' => $order_char_id,
		'product_char_id' => $product_char_id,
		'uid' => $uid,
		'data' => $data_json,
		'create_time' => $create_time,
		'user_name' => $user_name,
		'mobile' => $mobile,
		'status' => $status,
		'flags' => $flags,
	);
	$ret = IGuiJiuPeiTTC::get($order_char_id, array('product_char_id' => $product_char_id));
	if ($ret === false){
		self::setErr(1,"TTC��ȡʧ��");
		return array('errno' => 1,'data' => $product_char_id . "��ȡʧ��");
	}
	else if (!empty($ret)){
		self::setErr(2,"�Ѿ��ύ��");
		return array('errno' => 2,'data' => $product_char_id . "�Ѿ��ύ��");
	}
	else {
		$ret = IGuiJiuPeiTTC::insert($param);
		if ($ret === false){
			self::setErr(3,"�ύʧ��");
			Logger::err('IGuiJiuPeiTTC::insert failed' . IGuiJiuPeiTTC::$errCode . ' : ' . IGuiJiuPeiTTC::$errMsg);
			return array('errno' => 3,'data' => $product_char_id . "�ύʧ��");
		}
	}
		
	return array('errno' => 0,'data' => "�ύ�ɹ�");
}

/**
 * �ж��Ƿ�Ϊ����ⶩ��
 * @param $order
 */
public static function validateGJPOrder($uid, $order) {
	global $_OrderState;
	if (!( ( $order['status'] == $_OrderState['OutStock']['value'] || $order['status'] == $_OrderState['PartlyReturn']['value'] ) && ( (time() - $order['out_time']) <= 3600*24 ) ) ) { //����״̬Ϊ�ѳ���򲿷��˻� �� ���������24Сʱ���� 
		return false;
	}
	$ret = EA_GuiJiuPei::get_pids_presented($uid, $order['order_char_id']); // �������ύ���������Ʒ�б�
	if (false === $ret) {
		Logger::err('EA_GuiJiuPei::get_pids_presented failed-' . EA_GuiJiuPei::$errCode . '-' . EA_GuiJiuPei::$errMsg);
		return false;
	}
	global $GJP_CLASS;
	$p_count = count($order['items']);
	foreach ($order['items'] as $pinfo) {
		$product_info = IProductCommonInfoTTC::get($pinfo['product_id'], array(), array('c3_ids'));
		if (false === $product_info) {
			Logger::err('IProductCommonInfoTTC::get failed-' . IProductCommonInfoTTC::$errCode . '-' . IProductCommonInfoTTC::$errMsg);
			return false;
		}
		foreach ($product_info as $item) {
			if ( !in_array($item['c3_ids'], $GJP_CLASS) || in_array($pinfo['product_char_id'], $ret['data']) ) { // ���ǹ�������Ʒ || ��Ʒ����������
				$p_count --;
			}
		}
	}
	if ($p_count > 0) {
		return true;
	} else {
		return false;
	}
}
}
