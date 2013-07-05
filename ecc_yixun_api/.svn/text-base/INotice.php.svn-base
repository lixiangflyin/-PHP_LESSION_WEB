<?php
//公告类
class INotice
{
	public static $DBName = "retailer";
	public static $tableName = "t_notice";
	public static $errCode=0;
	public static $errMsg="";
	
	public static function getNoticePage($noticeStr,$pageNo,$pageSize=10)
	{
		$statue=$noticeStr['statue'];
		$theme=trim($noticeStr['theme']);
		$author=trim($noticeStr['author']);
		$MSDB = ToolUtil::getDBObj(self::$DBName);		
		$startIndex = $pageSize * ($pageNo - 1);
		$theme = iconv("UTF-8","GB2312",$theme);
		$author = iconv("UTF-8","GB2312",$author);
		if(empty($theme)&&empty($author))
		{
			if($statue==0)
			{
				$sql="SELECT * from t_notice order by notice_statue,notice_publish_time desc LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue !=4";
			}
			else if($statue==2)
			{
				$sql="SELECT * from t_notice WHERE notice_statue = {$statue} order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue= {$statue} and notice_statue !=4";
			}
			else
			{
				$sql="SELECT * from t_notice WHERE notice_statue = 1 or notice_statue = 3 order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue= 1 or notice_statue = 3 and notice_statue !=4";
			}
		}
		else if(empty($theme)&& !empty($author))
		{
			if($statue==0)
			{
				$sql="SELECT * from t_notice WHERE notice_create_author = '{$author}' order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_create_author = '{$author}' and notice_statue !=4";
			}
			else if($statue==2)
			{
				$sql="SELECT * from t_notice WHERE notice_statue = {$statue} and notice_create_author = '{$author}' order by notice_statue,notice_publish_time desc LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue = {$statue} and notice_create_author = '{$author}' and notice_statue !=4";
			}
			else
			{
				$sql="SELECT * from t_notice WHERE notice_statue = 1 or notice_statue = 3 and notice_create_author = '{$author}' order by notice_statue,notice_publish_time desc LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue = 1 or notice_statue = 3 and notice_create_author = '{$author}' and notice_statue !=4";
			}
		}
		else if(!empty($theme)&& empty($author))
		{
			if($statue==0)
			{
				$sql="SELECT * from t_notice WHERE notice_theme LIKE '%{$theme}%'  order by notice_statue,notice_publish_time desc LIMIT {$startIndex},{$pageSize}";
				$where="notice_theme LIKE '%{$theme}%' and notice_statue !=4";
			}
			else if($statue==2)
			{
				$sql="SELECT * from t_notice WHERE notice_statue = {$statue} and notice_theme LIKE '%{$theme}%' order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue = {$statue} and notice_theme LIKE '%{$theme}%' and notice_statue !=4";
			}
			else
			{
				$sql="SELECT * from t_notice WHERE notice_statue = 1 or notice_statue = 3 and notice_theme LIKE '%{$theme}%' order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue = 1 or notice_statue = 3 and notice_theme LIKE '%{$theme}%' and notice_statue !=4";
			}
		}
		else
		{
			if($statue==0)
			{
				$sql="SELECT * from t_notice WHERE notice_create_author = '{$author}' and notice_theme LIKE '%{$theme}%' order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_create_author = '{$author}' and notice_theme LIKE '%{$theme}%' and notice_statue !=4";
			}
			else if($statue==2)
			{
				$sql="SELECT * from t_notice WHERE notice_statue = {$statue} and notice_create_author = '{$author}' and notice_theme LIKE '%{$theme}%' order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue = {$statue} and notice_create_author = '{$author}' and notice_theme LIKE '%{$theme}%' and notice_statue !=4";
			}
			else
			{
				$sql="SELECT * from t_notice WHERE notice_statue = 1 or notice_statue = 3 and notice_create_author = '{$author}' and notice_theme LIKE '%{$theme}%' order by notice_statue,notice_publish_time desc  LIMIT {$startIndex},{$pageSize}";
				$where="notice_statue = 1 or notice_statue = 3 and notice_create_author = '{$author}' and notice_theme LIKE '%{$theme}%' and notice_statue !=4";
			}
		}
		$ret=$MSDB->getRows($sql);
		$num=$MSDB->getRowsCount(self::$tableName,$where);
		return array('data'=>$ret,'total'=>$num);
	}
	
	//添加公告
	public static function saveNotice($data)
	{
		$ID="";
		$MSDB = ToolUtil::getDBObj(self::$DBName); 
		if ($MSDB == false) 
		{
			self::$errCode = -4001;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "链接数据库失败";
			return false;
		}
		if($data['notice_statue']==1)
		{
			$sql="select * from t_notice where notice_statue=1";
			$ret=$MSDB->getRows($sql);
			if($ret)
			{
				$ID=$ret[0]['notice_id'];
				$param=$ret[0];
				$param['notice_statue']=3;
				$_condtion="notice_id={$ID}";
				$ret=$MSDB->update(self::$tableName,$param,$_condtion);
				if($ret == false)
				{
					return false;
				}
			}
		}
		
		$ret =  $MSDB->insert(self::$tableName,$data);
		
		if(false === $ret)
		{
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert NoticeDB failed". $MSDB->errMsg;
			Logger::err(self::$errMsg); 
			return  false;
		}
		
		return true;
	}
	
	//修改公告
	public static function updateNotice($data,$condtion)
	{
		$ID="";
		$MSDB = ToolUtil::getDBObj(self::$DBName); 
		if ($MSDB == false) 
		{
			self::$errCode = -4001;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "链接数据库失败";
			return false;
		}
		if($data['notice_statue']==1)
		{
			$sql="select * from t_notice where notice_statue=1";
			$ret=$MSDB->getRows($sql);
			if($ret)
			{
				$ID=$ret[0]['notice_id'];
				$param=$ret[0];
				$param['notice_statue']=3;
				$_condtion="notice_id={$ID}";
				$ret=$MSDB->update(self::$tableName,$param,$_condtion);
				if($ret == false)
				{
					return false;
				}
			}
		}
		$ret =  $MSDB->update(self::$tableName,$data,$condtion);
		
		if(false === $ret)
		{
			self::$errCode = -4002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert NoticeDB failed". $MSDB->errMsg;
			Logger::err(self::$errMsg); 
			return  false;
		}
		
		return true;
	}
	
	//得到base下面已正在发布和已发布的总数
	public static function getbaseTotal()
	{
		$MSDB = ToolUtil::getDBObj(self::$DBName); 
		if ($MSDB == false) 
		{
			self::$errCode = -4001;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "链接数据库失败";
			return false;
		}
		
		$where="notice_statue = 1 or notice_statue = 3";
		$Total=$MSDB->getRowsCount(self::$tableName,$where);
		return $Total;
		
	}
	
	//得到base下面已正在发布和已发布的特定页面的数据
	public static function getBaseNoticePage($pageNo,$pageSize=5)
	{
		$MSDB = ToolUtil::getDBObj(self::$DBName);
		$startIndex = $pageSize * ($pageNo - 1);
		$sql="SELECT * from t_notice WHERE notice_statue = 1 or notice_statue = 3 order by notice_statue,notice_publish_time desc LIMIT {$startIndex},{$pageSize}";
		$ret=$MSDB->getRows($sql);
		return $ret;
		
	}
	
	//按notice_id搜索数据库
	public static function getData($notice_id)
	{
		$MSDB = ToolUtil::getDBObj(self::$DBName);
		$sql="SELECT * from t_notice WHERE notice_id={$notice_id}";
		$ret=$MSDB->getRows($sql);
		return $ret;
		
	}
	
}

?>