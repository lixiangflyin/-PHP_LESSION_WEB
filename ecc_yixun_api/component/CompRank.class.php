<?php
/**
 *  排行榜组件类
 * @author oscarzhu
 * @version 1.0
 * @created 21-02-2012
 */
class CompRank
{
	private static $tableName = "t_rank";
	public static $sort = array('1'=>"销量"); // 1 按销量排 2 按点击率
	private static $debug = true; //调试开关
	
	/**
	 * 日志调试
	 */
	private static function logger($str)
	{
		if(self::$debug)
			logger::info($str);
	}
	
	/**
	 * 从数据库拉取组件信息
	 * @param int $id 
	 * @return array  组件信息
	 */	
	public static function getData($id)
	{
		$db = CompConfig::getDB();
		$sql = "select * from " . self::$tableName . " WHERE id=" . $id;
		return $db->getRows($sql);	
	}
	
	/**
	 * 拉取排行榜商品信息，前台展示使用
	 * @param int $id 
	 * @return array  商品信息
	 */
	public static function getProducts($id, $wId='')
	{
		$wId = empty($wId)?IUser::getSiteId():intval($wId);
		$result = self::getData($id);
		if( $result[0]['type']==1 || $result[0]['type']==11 )
		{
			$classId = $result[0]['c1_id'];
			$level = 1;
		} else if( $result[0]['type']==2  || $result[0]['type']==22 ) {
			$classId = $result[0]['c2_id'];
			$level = 2;
		} else if ( $result[0]['type'] == 3 || $result[0]['type']==33 ){
			$classId = $result[0]['c3_id'];
			$level = 3;
		}
		$input = array(
					'currentPage'	=>	1,
					'pageSize'	=>	$result[0]['num'],
					"sort" => 6,
					"desc" => 1,
					"day" => 0,
					"price" => 0,
					"option" => '',
					"classId"	=> $classId,
					"categorylevel" 	=>	$level,
					"areacode"	=>	$wId,
					"key" => $result[0]['brand']
					);
		return ISearch::gets($input);
	}
	
	/**
	 *  设置排行榜
	 * @param int $id
	 * @param array $data
	 * @return bool
	 */
	public static function setRank($id,$data=array(),$mod=0)
	{
		$result = self::getData($id);
		$db = CompConfig::getDB();
		if( !empty($result) && !$mod )
		{
			$result = $db->insert(self::$tableName, $data);
			if(!$result)
			{
				self::logger("db error: ".$db->errMsg);
				return array("result"=>false,"errorMsg"=>"数据库操作失败！");
			}
			return array("result"=>true,"errorMsg"=>"操作成功！");
		} else {
			$result = $db->update(self::$tableName, $data, 'id='.$id);
			if(!$result)
			{
				self::logger("db error: ".$db->errMsg);
				return array("result"=>false,"errorMsg"=>"数据库操作失败！");
			}
			return array("result"=>true,"errorMsg"=>"操作成功！");			
		}
	}

	/**
	 * 
	 * 拉取排行榜代码区
	 * @param int $id
	 * @return string
	 */
	public static function getConfig($id)
	{
		$result = self::getData($id);
		$code ='<script type="text/javascript" src="http://st.51buy.com/static_v1/js/app/event.comp.rank.js" charset="gb2312"></script>
				<script>
				$(document).ready(function(){
				G.app.comp.rank.init('.$id.');
				});
				</script>';
		//$code .= '<div id="compRank"></div>
		//		  <div id="compRank_tpl" style="display:none"><!--<@list@>';	
		//$code .= $result[0]['html'];
		//$code .= "<@_list@>--></div>";
		$code .= '<div id="compRank"></div>';
		return $code;
	}
	
}