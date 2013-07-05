<?php
/*
 * µ¹¼ÆÊ±Àà
 * 
 * @Version	0.1
 * @Created	17:36 2012/07/10
 * @Author	EdisonTsai
 */

class CompCountdown{

	private static $_tableName	= 't_countdown';
	private static $_htmlData	= '';

  /*
   * Get data from DB
   *
   * @Param	integer $id the ID of current component
   * @Return array
   */
	public static function getData($id){

		$DB = CompConfig::getDB();
			$sql = 'SELECT * FROM ' . self::$_tableName . ' WHERE id=' . $id;
		$rs	= $DB->getRows($sql);
		return array_pop($rs);
	}

	/*
	 * Save data to current component
	 *
	 * @Param string  $act which action, add or update, default is add
	 * @Param array	  $data the data array
	 * @Param integer $id the id of current record, only using for update
	 * @Return boolean
	 * @Created 19:09 2012/07/10
	 * @Author EdisonTsai
	 */
	public static function saveData($act='add', $data, $id=0){

		$DB = CompConfig::getDB();
		
		$res = false;

		switch($act){
			case 'add':
				$res = $DB->insert(self::$_tableName, $data);
				break;
			case 'update':
				$res = $id>0 ? $DB->update(self::$_tableName, $data, 'id='.$id) : false;
				break;
		} #end switch

		return $res ? true : false;
	}

	/*
	 * Get component config
	 *
	 * @Param integer $id
	 * @Return string
	 */
	public static function getConfig($id){
		
		//$res = self::getData($id);
		
		return '<script type="text/javascript" src="http://st.icson.com/static_v1/js/app/event.comp.countdown.js" charset="gb2312"></script><script type="text/javascript">
			 $(document).ready(function(){
				G.app.comp.countdown.init('.$id.');
			});
			</script>';
		
	}
}
?>