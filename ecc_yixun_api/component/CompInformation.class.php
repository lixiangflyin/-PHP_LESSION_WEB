<?php
class CompInformation
{
	private static $tableName = 't_information';
	private static $listTableName = 't_information_list';
	private static $config = '';
	public static $defaultInfoConent = '<style type="text/css">
	
</style>
<div id="comp_information" class="comp_information">
	<ul class="comp_information_list">
	</ul>
	<div id="information_list_tpl" style="display:none">
	<!--<@list@><li>
		<a href="#" onclick="G.app.comp.information.showMsg({information_id});">{information_title}</a><span>{information_time}</span>
	</li><@_list@>-->
	</div>
	<div class="page_wrap">
		<div id="information_page" class="paginator"></div>
	</div>
</div>';
	
	public static function selectConfig($id) {
		$db = CompConfig::getDB();
		$sql = "SELECT * FROM " . self::$tableName . " WHERE id=" . $id;
		$rs = $db->getRows($sql);
		return $rs ? $rs : array();
	}
	
	public static function setConfig($id, $pageSize, $content) {
		$db = CompConfig::getDB();
		if (!$id) {
			return array('result' => false, 'errorMsg' => 'ID不能为空');
		}
		$rs = self::selectConfig($id);
		if ($rs) {
			$condition = 'id=' . $id;
			$data = array(
				'content'		=> $content,
				'page_size'		=> $pageSize,
				'update_time'	=> date("Y-m-d H:i:s"),
				'user_id'		=> $_COOKIE['CurrentUserID']
			);
			$rs = $db->update(self::$tableName, $data, $condition);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
		} else {
			$data = array(
				'content'	   => $content,
				'page_size'    => $pageSize,
				'create_time'  => date("Y-m-d H:i:s"),
				'update_time'  => date("Y-m-d H:i:s"),
				'user_id'      => $_COOKIE['CurrentUserID']
			);
			$rs = $db->insert(self::$tableName, $data);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
		}
		return array('result' => true);
	}
	
	public static function selectInformationList($infoConfigId) {
		$db = CompConfig::getDB();
		$sql = "SELECT * FROM " . self::$listTableName . " WHERE infoconfig_id=" . $infoConfigId . " and status=1 ORDER BY order_id DESC";
		$rs = $db->getRows($sql);
		$infoArr = array();
		if ($rs) {
			foreach ($rs as $k => $v) {
				$v['no'] = $k + 1;
				$infoArr[$k] = $v;
			}
		}
		return $infoArr;
	}
	
	public static function pageInformation($infoConfigId, $page) {
		$db = CompConfig::getDB();
		$sql = "SELECT COUNT(*) as num FROM " . self::$listTableName . " WHERE infoconfig_id=" . $infoConfigId . " and status=1";
		$rs = $db->getRows($sql);
		if($rs && $rs[0]['num']){
			$count  = $rs[0]['num'];
			$rs = self::selectConfig($infoConfigId);
			$pageSize = isset($rs[0]['page_size']) ? $rs[0]['page_size'] : 10;
			$page = ($page < 1) ? 1 : $page;
			$page = ($page > ceil($count / $pageSize)) ? ceil($count / $pageSize) : $page;
			$start = ($page - 1) * $pageSize;
			$pageTotal = ceil($count / $pageSize);
			$sql = "SELECT * FROM " . self::$listTableName . " WHERE infoconfig_id=" . $infoConfigId ;
			$sql .= " and status=1 ORDER BY order_id DESC LIMIT " . $start . ", " . $pageSize ;
			$rs = $db->getRows($sql);
			return array('count'=> $count, 'total' => $pageTotal, 'list' => $rs);
		} else {
			return array('count'=> 0, 'total'=> 0, 'list' => array());
		}
	}
	
	public static function selectInformation($where) {
		$db = CompConfig::getDB();
		$where = empty($where) ? '' : ' WHERE ' . $where;
		$sql = "SELECT * FROM " . self::$listTableName . $where;
		$rs = $db->getRows($sql);
		return $rs ? $rs : array();
	}
	
	public static function saveInformation($id, $infoconfigId, $title, $content) {
		$db = CompConfig::getDB();
		if ($id) {
			$condition = 'id=' . $id;
			$data = array(
				'title'		=> $title,
				'content'		=> $content,
				'update_time'	=> date("Y-m-d H:i:s"),
				'user_id'		=> 555
			);
			$rs = $db->update(self::$listTableName, $data, $condition);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
		} else {
			$data = array(
				'infoconfig_id' => $infoconfigId,
				'title'		   => $title,
				'content'	   => $content,
				'status'	   => 1,
				'create_time'  => date("Y-m-d H:i:s"),
				'update_time'  => date("Y-m-d H:i:s"),
				'user_id'      => $_COOKIE['CurrentUserID']
			);
			$rs = $db->insert(self::$listTableName, $data);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
			$id = $db->getInsertId();
			$condition = 'id=' . $id;
			$sql = 'SELECT MAX(order_id) AS order_id FROM ' . self::$listTableName . ' WHERE status=1 AND infoconfig_id=' . $infoconfigId ;
			$rs = $db->getRows($sql);
			$orderId = isset($rs[0]['order_id']) ? $rs[0]['order_id'] + 1 : $id;
			$data = array(
				'order_id' => $orderId
			);
			$rs = $db->update(self::$listTableName, $data, $condition);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
		}
		return array('result' => true);
	}
	
	public static function removeInformation($id) {
		$db = CompConfig::getDB();
		if ($id) {
			$condition = 'id=' . $id;
			$data = array(
				'status'		=> 0,
				'update_time'	=> date("Y-m-d H:i:s"),
				'user_id'		=> $_COOKIE['CurrentUserID']
			);
			$rs = $db->update(self::$listTableName, $data, $condition);
			if ($rs === false) {
				return array('result' => false, 'errorMsg' => $db->errMsg);
			}
		} else {
			return array('result' => false, 'errorMsg' => 'ID不能为空');
		}
		return array('result' => true);	
	}
	
	public static function sortInformation($type, $id, $infoconfigId) {
		$db = CompConfig::getDB();
		$rs = self::selectInformation('id=' . $id);
		$orderId = $rs[0]['order_id'];
		if($type == 'up' || $type == 'down') {
			if ($type == 'up') {
				$where = 'status=1 AND infoconfig_id=' . $infoconfigId . ' AND order_id>' . $orderId . ' ORDER BY order_id ASC LIMIT 1';
			} else {
				$where = 'status=1 AND infoconfig_id=' . $infoconfigId . ' AND order_id<' . $orderId . ' order by order_id DESC LIMIT 1';
			}
			$rs = self::selectInformation($where);
			if ($rs && isset($rs[0])) {
				$newId = $rs[0]['id'];
				$newOrderId = $rs[0]['order_id'];
				
				$condition = 'id=' . $id;
				$data = array(
					'order_id'		=> $newOrderId,
					'update_time'	=> date("Y-m-d H:i:s"),
					'user_id'		=> $_COOKIE['CurrentUserID']
				);
				$db->update(self::$listTableName, $data, $condition);
				
				$condition = 'id=' . $newId;
				$data = array(
					'order_id'		=> $orderId,
					'update_time'	=> date("Y-m-d H:i:s"),
					'user_id'		=> $_COOKIE['CurrentUserID']
				);
				$db->update(self::$listTableName, $data, $condition);
				return array('result' => true);
			}
		} else if($type == 'top' || $type == 'bottom') {
			if ($type == 'top') {
				$sql = 'SELECT MAX(order_id) AS order_id FROM ' . self::$listTableName . ' WHERE status=1 AND infoconfig_id=' . $infoconfigId ;
			} else {
				$sql = 'SELECT MIN(order_id) AS order_id FROM ' . self::$listTableName . ' WHERE status=1 AND infoconfig_id=' . $infoconfigId;
			}
			$rs = $db->getRows($sql);
			if ($rs && isset($rs[0])) {
				if ($rs[0]['order_id'] == $orderId) {
					return array('result' => false, 'errorMsg' => 'do not reload');
				} else {
					$newOrderId = ($type == 'top') ? $rs[0]['order_id'] + 1 : $rs[0]['order_id'] - 1;
					$condition = 'id=' . $id;
					$data = array(
						'order_id'		=> $newOrderId,
						'update_time'	=> date("Y-m-d H:i:s"),
						'user_id'		=> $_COOKIE['CurrentUserID']
					);
					$rs = $db->update(self::$listTableName, $data, $condition);
					return array('result' => true);
				}
			}
		}
		return array('result' => false);
	}
	
	public static function getConfig($id) {
		$rs = self::selectConfig($id);
		if ($rs) {
			$pageSize = isset($rs[0]['page_size']) && $rs[0]['page_size'] ? $rs[0]['page_size'] : 10;
			$content = isset($rs[0]['content']) ? $rs[0]['content'] : '';
			self::$config .= !empty($content) ? $content . '<script type="text/javascript" src="http://st.icson.com/static_v1/js/app/event.comp.information.js" charset="gb2312"></script>		
			<script type="text/javascript">
			$(document).ready(function(){
				G.app.comp.information.init({
					id:' . $id . '
				});
			});
			</script>' : '';
		}
		return self::$config;
	}
	
}