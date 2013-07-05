<?php
//������
class IBanner
{
	public static $DBName = "retailer";
	public static $tableName = "t_retailer_banner";
	public static $errCode=0;
	public static $errMsg="";
	public static $status = array(1 => '��Ʒ�б�', 2 => '��Ʒ����', 3 => '�ҳ'); //����״̬
	
	public static function getBannerPage($bannerStr,$pageNo,$pageSize=10)
	{
		$statue=$bannerStr['statue'];
		$MSDB = ToolUtil::getDBObj(self::$DBName);		
		$startIndex = $pageSize * ($pageNo - 1);
		
		if($statue==0)//ȫ��
		{
			$sql="SELECT * from t_retailer_banner where banner_statue != 4 order by banner_statue,banner_create_time desc LIMIT {$startIndex},{$pageSize}";
			$where="banner_statue !=4";
		}
		else if($statue==1)//������
		{
			$sql="SELECT * from t_retailer_banner WHERE banner_statue = {$statue} order by banner_statue,banner_create_time desc  LIMIT {$startIndex},{$pageSize}";
			$where="banner_statue= {$statue}";
		}
		else if($statue==2)//������
		{
			$sql="SELECT * from t_retailer_banner WHERE banner_statue = {$statue} order by banner_statue,banner_create_time desc  LIMIT {$startIndex},{$pageSize}";
			$where="banner_statue = {$statue}";
		}	
		else if($statue==3)//�ѷ���
		{
			$sql="SELECT * from t_retailer_banner WHERE banner_statue = {$statue} order by banner_statue,banner_create_time desc  LIMIT {$startIndex},{$pageSize}";
			$where="banner_statue = {$statue}";
		}
		$ret=$MSDB->getRows($sql);
		$num=$MSDB->getRowsCount(self::$tableName,$where);
		$_where="banner_statue = 1";
		$_num=$MSDB->getRowsCount(self::$tableName,$_where);   //���ڷ����еĹ�������
		return array('data'=>$ret,'total'=>$num,'_total'=>$_num);
	}
	//�õ����ڷ����ĺ���ӿ�
	public static function getnowpublishbanner($retailerID)
	{
		$MSDB = ToolUtil::getDBObj(self::$DBName);	
		if (false == $MSDB)
		{
			self::$errCode = ToolUtil::$errCode;
            self::$errMsg = ToolUtil::$errMsg;
            return false;
		}
		$sql="SELECT * from t_retailer_banner where banner_statue = 1 and (retailerId={$retailerID} or retailerId=0) order by retailerId asc, banner_update_time desc limit 0,10";
		$ret=$MSDB->getRows($sql);
		if (false == $ret)
		{
			self::$errCode = $MSDB->errCode;
			self::$errMsg = $MSDB->errMsg;
            return false;
		}
		return $ret;
	}
	
	//��Ӻ��
	public static function saveBanner($data)
	{
		$ret = IBannerTTC::insert($data);
		if(FALSE === $ret)
		{
			self::$errCode = IBannerTTC::$errCode;
			self::$errMsg = IBannerTTC::$errMsg;
			return false;
		}	
		return true;
	}
	
	//�޸ĺ��
	public static function updateBanner($data,$banner_uid,$uptotal)
	{
		$ID="";
		$MSDB = ToolUtil::getDBObj(self::$DBName); 
		if ($MSDB == false) 
		{
			self::$errCode = -4001;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "�������ݿ�ʧ��";
			return false;
		}
	
		if($uptotal>10)
		{
			$sql="SELECT * from t_retailer_banner where banner_statue = 1  order by banner_update_time desc limit 0,1";
			$ret=$MSDB->getRows($sql);
			$_data=$ret[0];
			$_data['banner_statue']=3;
			
			$ret = IBannerTTC::update($_data,array('banner_uid' => $_data['banner_uid']));
			if(FALSE === $ret)
			{
				self::$errCode = IBannerTTC::$errCode;
				self::$errMsg = IBannerTTC::$errMsg;
				return false;
			}
		}
	
		$ret = IBannerTTC::update($data,array('banner_uid' => $banner_uid));
		if(FALSE === $ret)
		{
			self::$errCode = IBannerTTC::$errCode;
			self::$errMsg = IBannerTTC::$errMsg;
			return false;
		}	
		return true;
	}
	
	//��banner_uid�������ݿ�
	public static function getData($banner_uid)
	{
		$MSDB = ToolUtil::getDBObj(self::$DBName);
		$sql="SELECT * from t_retailer_banner where banner_uid = {$banner_uid} order by banner_update_time";
		$ret=$MSDB->getRows($sql);
		return $ret;
		
	}
	
}

?>