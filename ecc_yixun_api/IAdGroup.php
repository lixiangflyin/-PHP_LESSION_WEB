<?php
/*
 * 频道页面或活动系列类 -- 后台广告管理使用
 * @author railszhu
 * @version 1.0
 */

class IAdGroup{
	public static $errMsg = "";
	public static $errCode = 0;
	public static $group_type = array('channel' => 1, 'group' =>2); //t_ad_group数据类型，1表示频道，2表示广告组
	public static $status = array(1 => '启用', 2 => '未启用'); //启用状态
	public static $siteList = array(1 => '上海站', 1001 => '广东站', 2001 => '北京站', 3001 => '湖北站', 4001 => '重庆站');//分站点
	
	/**
	 * 
	 * 返回所有的频道或广告组信息
	 * @author railszhu
	 * @param  $g_type 数据类型：1 => 频道， 2 => 广告组，默认为频道
	 * @return $groups 数据数组，以Rows为key, 数据列表为value
	 */
	public static function ad_groupList($g_type = 1) {
		if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 11;
			self::$errMsg  = '指定group类型不符合要求，只能为1或2';
			return array('Rows' => '');
		}
		$filter = array();
		if(isset($_POST['type']) && $_POST['type']) { //若指定了类型，则替换默认$g_type值
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
			self::$errMsg  = '向表group读取数据失败';
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
			//以页面id作为select的id，并增加onChange事件触发的updateStatus函数，用于实现列表页面直接修改状态功能
			$groupList[$k]['status'] = Tools::get_select($v['gid'], self::$status, '', $v['status'], false, 'onChange="updateStatus('.$v['gid'].')"');
			$groupList[$k]['user_name'] = Tools::get_user_name($v['user_id']);
		}
		$groups['Rows'] = $groupList;
		return $groups;
	}
	
	/**
	 * 
	 * 返回属于某站点的频道或广告组信息
	 * @author railszhu
	 * @param  $wid 站点id	 
	 * @param  $g_type 数据类型：1 => 频道， 2 => 广告组
	 * @return $name 频道或广告组名称数组
	 */
	public static function ad_groupName($q, $g_type=1){
		if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 21;
			self::$errMsg  = '指定group类型不符合要求，只能为1或2';
			return '';
		}
		$filter = array();
		if($q == 1) {
			$filter['status'] = 1;
		}
			
		$rs = IAdGroupTTC::get($g_type, $filter);
		if ($rs === false) {
			self::$errCode = 22;
			self::$errMsg  = '向表group读取数据失败';
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
	 * 返回所属站点频道或广告组名称供select使用
	 * @author railszhu
	 * @param  $wid 站点id	 
	 * @param  $g_type 数据类型：1 => 频道， 2 => 广告组
	 * @return $name 频道或广告组名称数组
	 */
	public static function ad_groupName2($g_type=1){
		if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 21;
			self::$errMsg  = '指定group类型不符合要求，只能为1或2';
			return '';
		}
		$rs = IAdGroupTTC::get($g_type, array());
		if ($rs === false) {
			self::$errCode = 22;
			self::$errMsg  = '向表group读取数据失败';
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
	 * 根据gid读取某group数据
	 * @author railszhu
	 * @param $g_type => group类型，1为频道页面，2为广告组
	 * @param $gid => 频道或活动系列的id
	 * @return 读取到的数据
	 */
    function ad_group($gid, $g_type) {
    	if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 31;
			self::$errMsg  = '指定group类型不符合要求，只能为1或2';
			return array();
		}
		if($gid <= 0) {
			self::$errCode = 32;
			self::$errMsg  = '频道页面id错误';
			return array();
		}
		$filter = array('gid' => $gid);
		$rs = IAdGroupTTC::get($g_type, $filter);
    	if ($rs === false) {
			self::$errCode = 33;
			self::$errMsg  = '向表group读取数据失败';
			return array();
		}
		return $rs[0];
    }
    
    /**
	 * 
	 * 添加group数据
	 * @author railszhu
	 * @param $g_type => group类型，1为频道页面，2为广告组
	 * @param $para => 插入的数据组
	 * @return array('msg' => '错误信息')
	 */
    public static function uploadGroup($g_type, $para) {
        if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 41;
			self::$errMsg  = '指定group类型不符合要求，只能为1或2';
			return array('msg' => 'group类型不符合要求');
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
			self::$errMsg  = '向表group插入数据失败';			
			return array('msg' => IAdGroupTTC::$errMsg);
		}			
		return array('msg' => 'success!!');
		
    }
    
    /**
	 * 
	 * 更新group数据
	 * @author railszhu
	 * @param $g_type => group类型，1为频道页面，2为广告组
	 * @param $para => 需要更新的数据数组
	 * @return array('msg' => '错误信息')
	 */
    public static function updateGroup($g_type, $para) {
        if($g_type != self::$group_type['channel'] && $g_type != self::$group_type['group'])
		{
			self::$errCode = 51;
			self::$errMsg  = '指定group类型不符合要求，只能为1或2';
			return array('msg' => 'group类型不符合要求');
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
			self::$errMsg  = '向表group修改数据失败';
			return array('msg' => IAdGroupTTC::$errMsg);
		}			
		return array('msg' => 'success!!');
		
    }
    
     /**
	 * 
	 * 返回某活动系列下的所有广告
	 * @author railszhu
	 * @param $gid 活动系列ID
	 * @return 所有广告信息，以Rows为key，广告信息数组为value
	 */
     public static function ad_showAd($gid) {
        if($gid <= 0)
		{
			self::$errCode = 61;
			self::$errMsg  = '指定活动系列ID不符合要求';
			return '';
		}
		$filter = array('gid' => $gid);
		$rs = IAdInfoTTC::get(IAdInfo::$key, $filter);
		if($rs === false) {
			self::$errCode = 62;
			self::$errMsg  = '从info表中提取广告信息失败';
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