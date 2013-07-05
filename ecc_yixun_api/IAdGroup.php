<?php
/*
 * Ƶ��ҳ���ϵ���� -- ��̨������ʹ��
 * @author railszhu
 * @version 1.0
 */

class IAdGroup{
	public static $errMsg = "";
	public static $errCode = 0;
	public static $group_type = array('channel' => 1, 'group' =>2); //t_ad_group�������ͣ�1��ʾƵ����2��ʾ�����
	public static $status = array(1 => '����', 2 => 'δ����'); //����״̬
	public static $siteList = array(1 => '�Ϻ�վ', 1001 => '�㶫վ', 2001 => '����վ', 3001 => '����վ', 4001 => '����վ');//��վ��
	
	/**
	 * 
	 * �������е�Ƶ����������Ϣ
	 * @author railszhu
	 * @param  $g_type �������ͣ�1 => Ƶ���� 2 => ����飬Ĭ��ΪƵ��
	 * @return $groups �������飬��RowsΪkey, �����б�Ϊvalue
	 */
	public static function ad_groupList($g_type = 1) {
		if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 11;
			self::$errMsg  = 'ָ��group���Ͳ�����Ҫ��ֻ��Ϊ1��2';
			return array('Rows' => '');
		}
		$filter = array();
		if(isset($_POST['type']) && $_POST['type']) { //��ָ�������ͣ����滻Ĭ��$g_typeֵ
			$g_type = intval($_POST['type']);
		}
		
		if (isset($_POST['status']) && $_POST['status']) {
			$filter['status'] = intval($_POST['status']);
		}
		if (isset($_POST['name']) && $_POST['name']) {
			$filter['name'] = trim($_POST['name']);
		}
		if (isset($_POST['comment']) && $_POST['comment']) {
			$filter['comment'] = trim($_POST['comment']);
		}
		$rs = IAdGroupTTC::get($g_type, $filter);
		if ($rs === false) {
			self::$errCode = 12;
			self::$errMsg  = '���group��ȡ����ʧ��';
			return array('Rows' => '');
		}
		$groupList = array();
		if (count($rs)) {
			foreach ($rs as $v) {
				$groupList[$v['gid']] = $v;
			}
		}
		rsort($groupList);
		foreach ($groupList as $k => $v) {
			$groupList[$k]['name'] = empty($v['name']) ? '-' : '<a title="'.$v['name'].'" onclick="modifyChannel(\''.$v['gid'].'\', \''.$v['type'].'\')">'.$v['name'].'</a>';
			$groupList[$k]['comment'] = empty($v['comment']) ? '-' : '<p title="'.$v['comment'].'">'.$v['comment'].'</p>';
			//��ҳ��id��Ϊselect��id��������onChange�¼�������updateStatus����������ʵ���б�ҳ��ֱ���޸�״̬����
			$groupList[$k]['status'] = Tools::get_select($v['gid'], self::$status, '', $v['status'], false, 'onChange="updateStatus('.$v['gid'].')"');
			$groupList[$k]['user_name'] = Tools::get_user_name($v['user_id']);
		}
		$groups['Rows'] = $groupList;
		return $groups;
	}
	
	/**
	 * 
	 * ��������ĳվ���Ƶ����������Ϣ
	 * @author railszhu
	 * @param  $wid վ��id	 
	 * @param  $g_type �������ͣ�1 => Ƶ���� 2 => �����
	 * @return $name Ƶ����������������
	 */
	public static function ad_groupName($q, $g_type=1){
		if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 21;
			self::$errMsg  = 'ָ��group���Ͳ�����Ҫ��ֻ��Ϊ1��2';
			return '';
		}
		$filter = array();
		if($q == 1) {
			$filter['status'] = 1;
		}
			
		$rs = IAdGroupTTC::get($g_type, $filter);
		if ($rs === false) {
			self::$errCode = 22;
			self::$errMsg  = '���group��ȡ����ʧ��';
			return '';
		}
		$groupList = array();
		if (count($rs)) {
			foreach ($rs as $v) {
				$groupList[$v['gid']] = $v;
			}
		}
		rsort($groupList);
		$name = array();
		foreach ($groupList as $k => $v) {
			$name[$v['gid']] = $v;
		}		
		return $name;		
	}
	
	/**
	 * 
	 * ��������վ��Ƶ�����������ƹ�selectʹ��
	 * @author railszhu
	 * @param  $wid վ��id	 
	 * @param  $g_type �������ͣ�1 => Ƶ���� 2 => �����
	 * @return $name Ƶ����������������
	 */
	public static function ad_groupName2($g_type=1){
		if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 21;
			self::$errMsg  = 'ָ��group���Ͳ�����Ҫ��ֻ��Ϊ1��2';
			return '';
		}
		$rs = IAdGroupTTC::get($g_type, array());
		if ($rs === false) {
			self::$errCode = 22;
			self::$errMsg  = '���group��ȡ����ʧ��';
			return '';
		}
		$name = array();
		$groupList = array();
		if (count($rs)) {
			foreach ($rs as $v) {
				$groupList[$v['gid']] = $v;
			}
		}
		rsort($groupList);
		$name = array();
		foreach ($groupList as $k => $v) {
			$name[$v['gid']] = $v['comment'];
		}	
		return $name;		
	}
	
	/**
	 * 
	 * ����gid��ȡĳgroup����
	 * @author railszhu
	 * @param $g_type => group���ͣ�1ΪƵ��ҳ�棬2Ϊ�����
	 * @param $gid => Ƶ����ϵ�е�id
	 * @return ��ȡ��������
	 */
    function ad_group($gid, $g_type) {
    	if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 31;
			self::$errMsg  = 'ָ��group���Ͳ�����Ҫ��ֻ��Ϊ1��2';
			return array();
		}
		if($gid <= 0) {
			self::$errCode = 32;
			self::$errMsg  = 'Ƶ��ҳ��id����';
			return array();
		}
		$filter = array('gid' => $gid);
		$rs = IAdGroupTTC::get($g_type, $filter);
    	if ($rs === false) {
			self::$errCode = 33;
			self::$errMsg  = '���group��ȡ����ʧ��';
			return array();
		}
		return $rs[0];
    }
    
    /**
	 * 
	 * ���group����
	 * @author railszhu
	 * @param $g_type => group���ͣ�1ΪƵ��ҳ�棬2Ϊ�����
	 * @param $para => �����������
	 * @return array('msg' => '������Ϣ')
	 */
    public static function uploadGroup($g_type, $para) {
        if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 41;
			self::$errMsg  = 'ָ��group���Ͳ�����Ҫ��ֻ��Ϊ1��2';
			return array('msg' => 'group���Ͳ�����Ҫ��');
		}
		$data = array(
				'name'       => $para['name'],
				'comment'    => $para['comment'],
				'type'       => $g_type,    
				'createtime' => date('Y-m-d'),
				'updatetime' => date('Y-m-d'),	
			   	'user_id'    => $para['user_id'],
				'status'     => $para['status']
		);
		$rs = IAdGroupTTC::insert($data);
		if ($rs === false) {
			self::$errCode = 42;
			self::$errMsg  = '���group��������ʧ��';			
			return array('msg' => IAdGroupTTC::$errMsg);
		}			
		return array('msg' => 'success!!');
		
    }
    
    /**
	 * 
	 * ����group����
	 * @author railszhu
	 * @param $g_type => group���ͣ�1ΪƵ��ҳ�棬2Ϊ�����
	 * @param $para => ��Ҫ���µ���������
	 * @return array('msg' => '������Ϣ')
	 */
    public static function updateGroup($g_type, $para) {
        if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 51;
			self::$errMsg  = 'ָ��group���Ͳ�����Ҫ��ֻ��Ϊ1��2';
			return array('msg' => 'group���Ͳ�����Ҫ��');
		}
		$data = array(
				'type' => $g_type,    
				'updatetime' => date('Y-m-d'),	
		);	
		foreach($para as $k => $v) {
			if($k != 'gid') {
				$data[$k] = $v;
			}
		}
		$filter = array('gid' => $para['gid']);
		$rs = IAdGroupTTC::update($data, $filter);
		if ($rs === false) {
			self::$errCode = 52;
			self::$errMsg  = '���group�޸�����ʧ��';
			return array('msg' => IAdGroupTTC::$errMsg);
		}			
		return array('msg' => 'success!!');
		
    }
    
     /**
	 * 
	 * ����ĳ�ϵ���µ����й��
	 * @author railszhu
	 * @param $gid �ϵ��ID
	 * @return ���й����Ϣ����RowsΪkey�������Ϣ����Ϊvalue
	 */
     public static function ad_showAd($gid) {
        if($gid <= 0)
		{
			self::$errCode = 61;
			self::$errMsg  = 'ָ���ϵ��ID������Ҫ��';
			return '';
		}
		$filter = array('gid' => $gid);
		$rs = IAdInfoTTC::get(IAdInfo::$key, $filter);
		if($rs === false) {
			self::$errCode = 62;
			self::$errMsg  = '��info������ȡ�����Ϣʧ��';
			return '';
		}
		$ad_info = array();
		if(count($rs)) {
			foreach($rs as $k => $v) {
				$ad_info[] = $v;
			}
			foreach ($ad_info as $k => $v) {
				$ad_info[$k]['aid'] = $v['aid'];
				$ad_info[$k]['name'] =  empty($v['name']) ? '-' : '<a title="'.$v['name'].'">'.$v['name'].'</a>';
				$ad_info[$k]['status'] = Tools::get_select($v['aid'], self::$status, '', $v['status'], false, 'onChange="updateStatus('.$v['aid'].')"');
				$ad_info[$k]['date'] = date("Y-m-d H:i",strtotime($v['starttime'])).' - '.date("Y-m-d H:i",strtotime($v['endtime']));
				$ad_info[$k]['content'] =  empty($v['content']) ? '-' : '<p title="'.$v['content'].'">'.$v['content'].'</p>';
				$ad_id =  'k'.$v['aid'];
				$ad_id2 = 'z'.$v['aid'];
				$ad_info[$k]['adurl'] = $v['adurl'];
				$ad_info[$k]['adurl2'] = $v['adurl2'];
				$ad_info[$k]['url'] = empty($v['url']) ? '-' : '<a title="' . $v['url'] . '" target="_blank" href="' . $v['url'] . '">' . $v['url'] . '</a>';
				$ad_info[$k]['user_name'] = Tools::get_user_name($v['user_id']);
			}	
			rsort($ad_info);			
		}
		$ad_infos['Rows'] = $ad_info;
		return $ad_infos;
     }
     
     public static function getChannel($id) {
		$filter = array('gid' => $id);
		$rs = IAdGroupTTC::get(1, $filter);
    	if (empty($rs)) {
			throw new BaseException(101, "Failed to get channel with id $id.");
		}
		return $rs[0];
     }
     
     public static function findChannels($conditions) {
     	$filter = array();
    	if(is_array($conditions)) {
    		if(isset($conditions['gid']) && !empty($conditions['gid'])) {
    			$filter['gid'] = $conditions['gid'];
    		}
    		
    		if(isset($conditions['name']) && !empty($conditions['name'])) {
    			$filter['name'] = $conditions['name'];
    		}
    		
    		if(isset($conditions['comment']) && !empty($conditions['comment'])) {
    			$filter['comment'] = $conditions['comment'];
    		}
    		
    		if(isset($conditions['status']) && !empty($conditions['status'])) {
    			$filter['status'] = $conditions['status'];
    		}
    	} else 
    		throw new BaseException(101, 'Unexpect search condition.');
    	$res = IAdGroupTTC::get(self::$key, $filter);
    	if($res === false)
    		throw new BaseException(102, 'Failed to find channels.');
    	return $res;
     }
    
}