<?php
/**
 * �����̱�
 * @author robinguo
 * @version 1.0
 * @updated 17-ʮ����-2012 15:56:54 by tellenji
 * �������û����ݵ���ɾ�Ķ�ֻ�漰 retailer��erp customer��ر�
 * ��51buy user���޹���
 */

class IRetailer
{
	public static $dbName = 'retailer';
	public static $tableName = 't_retailer';
	const MAX_ACCOUNT_LEN    = 100;
	const MAX_PASS_LEN       = 32;
	const MIN_PASS_LEN       = 6;
	const QQ_ACCOUNT_PRE     = 'Login_QQ_';
	const ALIPAY_ACCOUNT_PRE = 'Login_Alipay_';
	const LOG_BINDQQ            = 10;
	
	/**
	 * �׽��̼����ַ���
	 */
	const EJS_KEY = 'DWQ$Agwetyg45g';
	
	static $type = array(
			'WholeSaler' => 22,
			'Retailer'   => 23,
			'Chain'      => 24,
			'Plat'       => 25
	);
	
	private $_info;
	private $_uid;
	
	/**
	 * ������
	 */
	public static $errCode = 0;
	/**
	 * ������Ϣ
	 */
	public static $errMsg = '';
	
	public static $_RT_RETAILER_TYPE = array(
	    "22" => "����������",
	    "23" => "����������",
	    "24" => "����������",
	    "25" => "����ƽ̨��"
	);

    public static $_RT_LEVEL_TYPE = array(
	    '-1'  => '��˲�ͨ��',
	    '0'  => 'δ��˷�����',
	    '1'  => 'һ��������',
	    '2'  => '����������',
	    '3'  => '����������',
	    '4'  => '�ļ�������'
	);

    public static function setError($errno,$errmsg)
    {
    	self::$errCode = $errno;
    	self::$errMsg = $errmsg;
    	Logger::err($errmsg);
    }
	//�����������û�
	public static function registerRetailer($account, $pass,$userData=array())
	{
		$email  = isset($userData['email'])?$userData['email']:'';
		$regIp       = isset($userData['regIp'])?$userData['regIp']:'';
		$warehouseId = isset($userData['warehouseId'])?$userData['warehouseId']:1;
		$source      = isset($userData['source'])?$userData['source']:'';
		$referUid    = isset($userData['referUid'])?$userData['referUid']:-999999;
		$tel         = isset($userData['tel'])?$userData['tel']:'';
		$name        = isset($userData['name'])?$userData['name']:'';
		$mobile      = $userData['mobile'];

		if (!isset($account) || !isset($pass) || "" == $account || "" == $pass) {
			
			self::setError(16, '[account or pass is null]');
			return false;
		}

		if (strlen($account) > self::MAX_ACCOUNT_LEN) {
		    self::setError(15, '[account len is invalid]');
		    return false;
		}

		$passLen = strlen($pass);
		if ($passLen < self::MIN_PASS_LEN || $passLen > self::MAX_PASS_LEN) {
		    self::setError(17, '[pass len is invalid]');
		    return false;
		}
		
		//���tel
		if ($tel && !ToolUtil::checkMobilePhone($tel) && !ToolUtil::checkPhone($tel)) {
		    self::setError(27, '[tel is invalid]');
		    return false;
		}

		//�����д�����䣬����������У��
		if ("" != $email) {
			//��������Ƿ��Ѿ���ʹ��
			$ret = self::checkEmailExist($email);
			if ($ret['exist'] != 0) {
			    self::setError(25, "[email($email) is used]");
			    return false;
			}
		}
	    //����û�������ֻ����Ƿ�ռ��
		$ret = self::checkMobileExist($mobile);
		if (!$ret || $ret['exist'] != 0) {
		    self::setError(28, "[mobile ($mobile) is used]");
		    return false;
		}

		//����û�������û����Ƿ�ռ��
		$ret = self::checkIcsonAccountExist($account);
		if (!$ret || $ret['exist'] != 0) {
		    self::setError(26, "[account($account) is used]");
		    return false;
		}
		$now = time();
	    
	    //��ȡһ��Ψһ�û�uid
		$newId = self::getNewId('Customer_Sequence');
		//���������ݣ��Ȳ����û�����,�ٲ�����Ѹ������ٲ��������
		$udata = array(
		    'uid'          => $newId,
			'icsonid'      => $account,
			'name'         => $name,
			'tel'          => $tel,
			'email'        => $email,
			'retailerType' => self::$type['Retailer'],
			'level'        => 0,
			'regTime'      => $now,
			'status'       => 0,
			'regIP'        => $regIp,
		    'district'     => isset($userData['district'])?$userData['district']:0,
		    'address'      => isset($userData['address'])?$userData['address']:'',
		    'zipcode'      => isset($userData['zipCode'])?$userData['zipCode']:'',
		    'info'         => isset($userData['info'])?$userData['info']:'',
		    'conpanyName'  => isset($userData['conpanyName'])?$userData['conpanyName']:'',
		    'mobile'       => isset($userData['mobile'])?$userData['mobile']:'',
		    'fax'          => isset($userData['fax'])?$userData['fax']:'',
			'pid'		=>-1,
			);


		if (false === IRetailerTTC::insert($udata)) {
		    self::setError(IRetailerTTC::$errCode, " insert t_retailer failed! " . IRetailerTTC::$errMsg);
			return false;
		}

		$pdata = array(
			'uid'        =>$newId,
			'createtime' =>$now,
			'updatetime' =>$now,
            'password'   => md5(md5($pass) . self::EJS_KEY),
		);

		if (false === IRetailerPasswdTTC::insert($pdata)) {
		    IRetailerTTC::remove($newId);
		    self::setError(IRetailerPasswdTTC::$errCode, " insert Passwd failed! " . IRetailerPasswdTTC::$errMsg);
			return false;
		}
		
		$ldata = array (
			'account'    =>$account,
			'uid'        => $newId,
			'updatetime' =>$now,
		);

	    if (false === IRetailerLoginTTC::insert($ldata)) {
	        IRetailerTTC::remove($newId);
	        IRetailerPasswdTTC::remove($newId);
	        self::setError(IRetailerLoginTTC::$errCode, " insert Login failed! " . IRetailerLoginTTC::$errMsg);
			return false;
	    }
		
	    // ��erp�в�������
	    $erpDB = ToolUtil::getMSDBObj('Customer');
	   	if (false == $erpDB){
		    IRetailerTTC::remove($newId);
	        IRetailerPasswdTTC::remove($newId);
	        IRetailerLoginTTC::remove($newId);
		    return false;
		}
		global  $_USER_TYPE;
		$edata = array (
			"SysNo"		               => $newId,
			"CustomerID"	           => $udata['icsonid'],
			"CustomerName"             => $udata['name'],
			"Gender"		           => 2,
			"Email"		               => $udata['email'],
			"Phone"		               => $udata['tel'],
			"Pwd"		               => $pdata['password'],
			"CellPhone"	               => $udata['mobile'],
			'Status'		           => 0,
			'EmailStatus'              => 0,
			"Fax"		               => $udata['fax'],
			"DwellAreaSysNo"           => $udata['district'],
			"DwellAddress"             => $udata['address'],
			"DwellZip"	               => $udata['zipcode'],
			"TotalScore"	           => 0,
			"ValidScore"	           => 0,
			"CardNo"		           => '',
			"Note"		               => isset($userData['info'])?$userData['info']:'',
			"RegisterTime"             => date('Y-m-d H:i:s', $now),
			"CustomerRank"             => 0,
			"CustomerType"             => $_USER_TYPE['RetailersUser'],
			"RegisterIP"	           => $udata['regIP'],
			"ExpPoint"	               => 0,
			"CashValidScore"           => 0,
			"SalesPromotionValidScore" => 0,
			"rowModifydate"            => date('Y-m-d H:i:s', $now)
		);

		$ret = $erpDB->insert("Customer", $edata);
		if (false === $ret) {
		    IRetailerTTC::remove($newId);
	        IRetailerPasswdTTC::remove($newId);
	        IRetailerLoginTTC::remove($newId);
		    self::setError($erpDB->errCode, " insert ERP Customer failed! " . $erpDB->errMsg);
		    return false;
		}
		
        return $newId;
	}

	public static function checkEmailExist($email) {
		if (!isset($email) || "" == $email) {
			self::setError(10, '[email is null]');
			return false;
		}
	
		if (!ToolUtil::checkEmail($email)) {
			self::setError(11, '[email($email) is invalid]');
			return false;
		}
	
		$mysql = ToolUtil::getDBObj(self::$dbName);
		$rows = $mysql->getRows("select uid from t_retailer where email = '$email'");
		if (false === $rows) {
			self::setError($mysql->errCode, $mysql->errMsg);
			return false;
		}
	
		return array('exist'=>count($rows) > 0 ? 1 : 0);
	}
	
	public static function checkMobileExist($mobile) {
		if (!isset($mobile) || "" == $mobile) {
			self::setError(10, '[mobile is null]');
			return false;
		}
	
		if (!ToolUtil::checkMobilePhone($mobile)) {
			self::setError(11, '[mobile($mobile) is invalid]');
			return false;
		}
	
		$mysql = ToolUtil::getDBObj(self::$dbName);
		$rows = $mysql->getRows("select uid from t_retailer where mobile = '$mobile'");
		if (false === $rows) {
			self::setError($mysql->errCode, $mysql->errMsg);
			return false;
		}
	
		return array('exist'=>count($rows) > 0 ? 1 : 0);
	}
	
	public static function checkIcsonAccountExist($account) {
		if (!isset($account) || "" == $account) {
			self::setError(4, '[account is null]');
			return false;
		}
	
		$item = IRetailerLoginTTC::get($account);
		if (false === $item) {
			self::setError(IRetailerLoginTTC::$errCode, IRetailerLoginTTC::$errMsg);
			return false;
		}
		return array('exist' => count($item) > 0 ? 1 : 0);
	}
	
	public static function getNewId($bizName, $need=1, $time=0) {
		$index = rand(0, 1);
		$ip = Config::getIP('IDGenerator_' . $index);
		if (null == $ip)
		{
			self::setError(1800, 'getip(IDGenerator) failed');
			return false;
		}
	
		$addr = explode(":", $ip);
		$cmd = "cmd=100&bizid=" . $bizName . "&need=" .$need .  "\r\n";
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd, 1, 1);
		if (false == $rspStr || "" == $rspStr) {
			if ($time < 3)
			{
				return self::getNewId($bizName, $need, $time++);
			}
			else
			{
				self::setError(1801, 'IDGenerator svr timeout');
				return false;
			}
		}
	
		$rspArr = array();
		parse_str($rspStr, $rspArr);
		if (!isset($rspArr['id'])) {
			self::setError(1802, 'IDGenerator failed');
			return false;
		}
	
		Logger::info("generate sequence success (bizName $bizName : {$ip} : IDGenerator_{$index} : time $time)");
		return intval($rspArr['id']);
	}
	
	//��ѯ�������û�  modify by @tellenji at 2012/9/3 ���ݿ��޸�
	public static function getRetailers($data)
	{
		$mysql = ToolUtil::getDBObj(self::$dbName);
		if (!$mysql)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		$sql = 'SELECT uid,icsonid,name,qq,tel,email,retailerType,level,trs.isShoppingGuide,
		          openGuideTime,regTime,tr.auditUser,auditTime,editTime,status,invoiceId,
		          bindManager,useInvoice,regIP ,info,logo ,conpanyName, address,fax,mobile,zipcode,
		          district FROM ' 
		          . self::$tableName .' tr left join t_retailer_shopguid trs on  uid = retailerId WHERE uid!=0 and status != -1 and pid=-1 ';
		if (isset($data['uid']))
		{
			$sql .=  " AND uid=" . $data['uid'];
		}
	    if (isset($data['uids']))
		{
			$sql .=  " AND uid in (" . implode(',', $data['uids']) . ")";
		}
		if (isset($data['icsonid']))
		{
			$sql .= " AND icsonid like '%" . str_replace(' ','%',$data['icsonid']) . "%' ";
		}
	    if (isset($data['account']))
		{
			$sql .= " AND icsonid = '" . $mysql->filterString($data['account']) . "' ";
		}
		if (isset($data['name']))
		{
			$sql .= " AND name like '%" . str_replace(' ','%',$data['name']) . "%' ";
		}
		if (isset($data['tel']))
		{
			$sql .= " AND tel like '%" . str_replace(' ','%',$data['tel']) . "%' ";
		}
		if (isset($data['valid_time_from']) && isset($data['valid_time_to']))
		{
			$sql .= " AND regTime>=" . $data['valid_time_from'] . " AND regTime<=" . $data['valid_time_to'];
		}
		if (isset($data['email']))
		{
			$sql .=  " AND email='" . $data['email'] . "'";
		}
		if (isset($data['auditUser']))
		{
			$sql .=  " AND auditUser='" . $data['auditUser'] . "'";
		}
		if (isset($data['retailerType']))
		{
			$sql .=  " AND retailerType=" . $data['retailerType'];
		}
		if (isset($data['status']))
		{
			$sql .=  " AND status=" . $data['status'];
		}
		if (isset($data['isShoppingGuide']))
		{
			$sql .=  " AND isShoppingGuide=" . $data['isShoppingGuide'];
		}
	    if (isset($data['conpanyName']))
		{
			$sql .=  " AND conpanyName like '%" . $data['conpanyName'] . "%'";
		}
		if (isset($data['level']))
		{
			$sql .=  " AND level=" . $data['level'];
		}

		$retailers = $mysql->getRows($sql);
		
		if(false === $retailers)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select retailer DB failed" . $mysql->errMsg;
			return  false;
		}
		
		return $retailers;
	}

	/**
	 * ��ȡ����������
	 * @param $uids = array(id1,id2,...)
	 * 
	 * @return int total  
	 */
    public static function getRetailersCount()
    {
        $mysql = ToolUtil::getDBObj(self::$dbName);
        if (!$mysql)
        {
            self::$errCode = ToolUtil::$errCode;
            self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
            Logger::err(self::$errMsg);
            return false;
        }
        //status�����ʺ��Ƿ���ã�level�����Ƿ�ͨ�����
        $sql = 'SELECT COUNT(*) AS total FROM ' 
                  . self::$tableName .' WHERE pid=-1 and level=1 and status=0'; 
        $retailers = $mysql->getRows($sql);
        
        if(false === $retailers)
        {
            self::$errCode = -4001;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select retailer DB failed" . $mysql->errMsg;
            return  false;
        }          
       
        return $retailers[0]['total'];
    }
    
	/**
	 * ��ҳ��ȡretailers @kevinhong add
	 * @param array $data  array('uid'=>xx ...)
	 * @param int $pageNo
	 * @param int $pageSize
	 * @return array('data'=>array(), 'total'=> ) 
	 *flag 0:��ʾδ������ҵQQ��1����ʾ���� 
	 */
	public static function getRetailersqqPage($data, $pageNo, $pageSize=20)
	{
	    $mysql = ToolUtil::getDBObj(self::$dbName);
        if (!$mysql)
        {
            self::$errCode = ToolUtil::$errCode;
            self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
            Logger::err(self::$errMsg);
            return false;
        }
		
		$sql = 'SELECT 
                    uid,icsonid,conpanyName,retailerType,qq,flag ' .
                'FROM ' .
                   self::$tableName .' tr 
                   left join t_retailer_shopguid trs on  uid = retailerId WHERE pid=-1 AND status != -1 AND qq != '."'"."'";
        $whereSql = '';
        
		if ((isset($data['conpanyName']))&&(!(empty($data['conpanyName']))))
        {
            $whereSql .= " AND conpanyName like BINARY '%" . str_replace(' ','%',$data['conpanyName']) . "%' ";
        }
        
		if ((isset($data['qq']))&&(!(empty($data['qq']))))
        {
            $whereSql .=  " AND qq= " . $data['qq'];
        }
		
		if ((isset($data['icsonid']))&&(!(empty($data['icsonid']))))
        {
            $whereSql .=  " AND icsonid= " . "'".$data['icsonid']."'";
        }
		if((isset($data['operatorName']))&&(!(empty($data['operatorName'])))){
			$_sql = 'SELECT * FROM t_retailer_shop_log where operatorName = '."'".$data['operatorName']."'";
			$_operator = $mysql->getRows($_sql);
			if(false === $_operator)
			{
				self::$errCode = -4003;
				return  false;
			}
			if(count($_operator)){
				$i = 0;
				$_operator = array_unique($_operator);
				foreach($_operator as $_item){
					if($i == 0){
						$whereSql .= " AND uid = ".$_item['shopId'];
					}else{
						$whereSql .= " OR uid = ".$_item['shopId'];
					}
					$i++;			
				}
			}
			
		}
		
        $startIndex = $pageSize * ($pageNo - 1);
        $condition = $sql . $whereSql . ' order by regTime desc ' . ' LIMIT ' . $startIndex. ',' . $pageSize ;
        $retailers = $mysql->getRows($condition);
        if(false === $retailers)
        {
            self::$errCode = -4001;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select retailer DB failed" . $mysql->errMsg;
            return  false;
        }
		$dbqq = ToolUtil::getDBObj ( 'retailer' );
		
		foreach($retailers as &$retailer){
			if($retailer['qq']){
				$sqlStrqq = "select * from " . 't_retailer_shop_log';
				$sqlStrqq .= " where shopId= " . $retailer['uid']." and type = 10";
				$sqlStrqq .= " order by createTime desc";
				$_rows = $dbqq->getRows ( $sqlStrqq );
				$sqlStrqq = "";
				if(false === $_rows)
				{
					self::$errCode = -4002;
					//self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select retailer DB failed" . $_rows->errMsg;
					return  false;
				}
				if(count($_rows)){
					$_rows = current($_rows);
					$retailer['operatorId'] = $_rows['operatorId'];
					$retailer['operatorName'] = $_rows['operatorName'];
				}else{
					$retailer['operatorId'] = '';
					$retailer['operatorName'] = '';
				}
			}else{
					$retailer['operatorId'] = '';
					$retailer['operatorName'] = '';
			}

		}
        
        $countSql = 'SELECT count(*) AS total FROM ' . 
                     self::$tableName .' tr left join t_retailer_shopguid on  uid = retailerId WHERE uid!=0 and pid=-1 AND status != -1 AND qq != '."'"."'";
        $rows = $mysql->getRows($countSql . $whereSql);
        if (false === $rows)
        {
            self::$errCode = -4001;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select retailer DB failed" . $mysql->errMsg;
            return  false;
        }
        $total =  ((count($rows)<=0) ? 0 : $rows[0]['total']);
        
        return array('data'=>$retailers ,'total'=>$total);
	}
	
	/**
	 * ��ҳ��ȡretailers @tellenji add
	 * @param array $data  array('uid'=>xx,'status'=>yy, ...)
	 * @param int $pageNo
	 * @param int $pageSize
	 * @return array('data'=>array(), 'total'=> ) 
	 */
	public static function getRetailersPage($data, $pageNo, $pageSize=20)
	{
	    $mysql = ToolUtil::getDBObj(self::$dbName);
        if (!$mysql)
        {
            self::$errCode = ToolUtil::$errCode;
            self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
            Logger::err(self::$errMsg);
            return false;
        }
        
        $sql = 'SELECT 
                    uid,icsonid,name,qq,tel,email,retailerType,level,trs.isShoppingGuide,
                    openGuideTime,regTime,tr.auditUser,auditTime,editTime,status,
                    invoiceId,useInvoice,regIP ,info,logo,conpanyName,bindManager ' .
                'FROM ' .
                   self::$tableName .' tr 
                   left join t_retailer_shopguid trs on  uid = retailerId WHERE pid=-1 AND status != -1 ';
        $whereSql = '';
        if (isset($data['uid']))
        {
            $whereSql .=  " AND uid=" . $data['uid'];
        }
        if (isset($data['uids']))
        {
            $whereSql .=  " AND uid in (" . implode(',', $data['uids']) . ")";
        }
        if (isset($data['icsonid']))
        {
            $whereSql .= " AND icsonid like BINARY '%" . str_replace(' ','%',$data['icsonid']) . "%' ";
        }
        if (isset($data['account']))
        {
            $whereSql .= " AND icsonid = '" . $mysql->filterString($data['account']) . "' ";
        }
        if (isset($data['name']))
        {
            $whereSql .= " AND name like '%" . str_replace(' ','%',$data['name']) . "%' ";
        }
        if (isset($data['tel']))
        {
            $whereSql .= " AND tel like '%" . str_replace(' ','%',$data['tel']) . "%' ";
        }
        if (isset($data['valid_time_from']) && isset($data['valid_time_to']))
        {
            $whereSql .= " AND regTime>=" . $data['valid_time_from'] . " AND regTime<=" . $data['valid_time_to'];
        }
        if (isset($data['email']))
        {
            $whereSql .=  " AND email='" . $data['email'] . "'";
        }
        if (isset($data['auditUser']))
        {
            $whereSql .=  " AND auditUser='" . $mysql->filterString($data['auditUser']) . "'";
        }
        if (isset($data['retailerType']))
        {
            $whereSql .=  " AND retailerType=" . intval($data['retailerType']);
        }
        if (isset($data['status']))
        {
            $whereSql .=  " AND status=" . intval($data['status']);
        }
        if (isset($data['isShoppingGuid']))
        {
        	if (0 == $data['isShoppingGuid'])
        	{
        	   $whereSql .=  " AND isShoppingGuide != 1 ";
        	}
        	else {
                $whereSql .=  " AND isShoppingGuide=" . intval($data['isShoppingGuid']);
        	}
        }

	    if (isset($data['level_pass']) && ($data['level_pass'] >= 1))
        {
            $whereSql .=  " AND level>=1" ;
        }
	    else if ( isset($data['level']))
        {
            $whereSql .=  " AND level =" . intval($data['level']);
        }
        
        if (isset($data['bindManager']))
        {
             $whereSql .=  " AND bindManager='" . $mysql->filterString($data['bindManager']) ."'";
        }
        if (isset($data['contact']))
        {
             $whereSql .= " AND( tel like '%" . str_replace(' ','%',$data['contact']) . "%' ";
             $whereSql .= " OR mobile like '%" . str_replace(' ','%',$data['contact']) . "%' ";
             $whereSql .= " OR fax like '%" . str_replace(' ','%',$data['contact']) . "%' )";
        }
	    if (isset($data['conpanyName']))
        {
            $whereSql .= " AND conpanyName like BINARY '%" . str_replace(' ','%',$data['conpanyName']) . "%' ";
        }
        $startIndex = $pageSize * ($pageNo - 1);
        $condition = $sql . $whereSql . ' order by regTime desc ' . ' LIMIT ' . $startIndex. ',' . $pageSize ;
  
        $retailers = $mysql->getRows($condition);
        if(false === $retailers)
        {
            self::$errCode = -4001;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select retailer DB failed" . $mysql->errMsg;
            return  false;
        }
        
        $countSql = 'SELECT count(*) AS total FROM ' . 
                     self::$tableName .' tr left join t_retailer_shopguid on  uid = retailerId WHERE uid!=0 and pid=-1 AND status != -1';
        $rows = $mysql->getRows($countSql . $whereSql);
        if (false === $rows)
        {
            self::$errCode = -4001;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select retailer DB failed" . $mysql->errMsg;
            return  false;
        }
        $total =  ((count($rows)<=0) ? 0 : $rows[0]['total']);
        
        return array('data'=>$retailers ,'total'=>$total);
	}
	
	
	//��˷������û��ȼ�������
	public static function updateRetailer($data)
	{
		$mysql = ToolUtil::getDBObj(self::$dbName);
		if (!$mysql)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__  ." _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		$updateData = array();

		if (isset($data['level']))
		{
			$updateData['level'] = $data['level'];
		}
		if (isset($data['status']))
		{
		   $updateData['status'] = $data['status'];
		}
		if (isset($data['retailerType']))
		{
			$updateData['retailerType'] = $data['retailerType'];
		}
	    if (isset($data['isShoppingGuide']))
		{
			$shopGuidData['isShoppingGuide'] = $data['isShoppingGuide'];
		}
	    if (isset($data['logo']))
		{
			$updateData['logo'] = $mysql->filterString($data['logo']);
		}
	    if (isset($data['openGuideTime']))
		{
			$shopGuidData['openGuideTime'] = $data['openGuideTime'];
		}
		if (isset($data['auditUser']))
		{
			$updateData['auditUser'] = $data['auditUser'];
		}
		if (isset($data['auditTime']))
		{
			$updateData['auditTime'] = $data['auditTime'];
		}
		if (isset($data['editTime']))
		{
			$updateData['editTime'] = $data['editTime'];
		}
		if (isset($data['info']))
		{
			$updateData['info'] = $data['info'];
		}
	    if (isset($data['useInvoice']))
		{
			$updateData['useInvoice'] = $data['useInvoice'];
		}
	    if (isset($data['invoiceId']))
		{
			$updateData['invoiceId'] = $data['invoiceId'];
		}
        $params = array('conpanyName','name','qq','email','fax','mobile','tel','district','address','zipCode','bindManager');
        foreach ($params AS $param)
        {
			if (isset($data[$param]))
			{
			   $updateData[$param] = $mysql->filterString($data[$param]);
			}
        }

		//update erp data
		$updateERPData = array();
		isset($updateData['fax']) ? $updateUserData['fax'] =$updateData['fax']:'';
        isset($updateData['district']) ? $updateUserData['city'] = $updateData['district']:0;
        isset($updateData['address']) ? $updateUserData['address'] = $updateData['address']:0;
        isset($updateData['zipCode']) ? $updateUserData['zipcode'] = $updateData['zipCode']:'';
		isset($updateData['mobile']) ? $updateUserData['mobile'] = $updateData['mobile']: '';
	    isset($updateData['fax'])?( $updateERPData['Fax'] = $updateData['fax']):'';
		isset($updateData['mobile']) ? $updateERPData['CellPhone'] = $updateData['mobile']:'';
		isset($updateData['district']) ? $updateERPData['DwellAreaSysNo'] =$updateData['district']:'';
		isset($updateData['address']) ? $updateERPData['DwellAddress'] =$updateData['address']:'';
		isset($updateData['zipCode']) ? $updateERPData['DwellZip'] = $updateData['zipCode']:'';
		
		global $_USER_TYPE;
		if(isset($updateData['level']))
		{
		    $updateData['level'] = $updateData['level'] <= 0 ? 0 : $updateData['level'];

			//$updateERPData['CustomerRank'] = $updateData['level'];
		}
		if(isset($updateData['retailerType']) || (isset($updateData['level']) && $updateData['level']>0))
		{

			$updateERPData['CustomerType'] = $_USER_TYPE['RetailersUser'];  //erp�̶�Ϊһ�ָ�ʽ���������̣�����Ҫ���־�������
		}
		
		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__  ." _getDB Error".ToolUtil::$errMsg;
			return false;
		}
		//�������ȸ������ݿ��ٸ���users ttc
		if (false === $erpDb->execSql("begin transaction "))
		{
			self::$errCode = $erpDb->errCode;
			self::$errMsg = basename(__FILE__,"php"). " | ". __LINE__ . " start transaction failed! " .$erpDb->$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		
        //����erp @tellenji 2012/8/6���
	    if (count($updateERPData)>0) {
	    	
	   	    $ret = $erpDb->update('Customer', $updateERPData, "SysNo={$data['uid']}");
            if (false === $ret)
            {
                self::$errCode = $erpDb->errCode;
                self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $data['uid'] . ") info to userMysql faild:". $erpDb->errMsg;
                Logger::err(self::$errMsg);
                $erpDb->execSql("rollback");
                return false;
            }
        }
       
        //�󶨾���ʱ����ͬ��IAS customerinfo������erp���ݰ󶨾���ͳ��
        if (isset($updateData['bindManager']))
        {
        	//ȡ����
        	if (empty($data['managerId']) && empty($updateData['bindManager'])){
        		$ret = $erpDb->execSql("delete from CustomerMangeMapInfo where CustomerID='" . $data['icsonid']) . "'";
        		if (false === $ret)
        		{
        			self::$errCode = $erpDb->errCode;
        			self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_delete (" . $data['icsonid'] . ") info to userMysql faild:". $erpDb->errMsg;
        			Logger::err(self::$errMsg);
        			$erpDb->execSql("rollback");
        			return false;
        		}
        	}
        	else{
	        	$udata = array(
	               'CustomerID' => $data['icsonid'],
	               'ManagerID' => $data['managerId'],
	               'ManagerName' => $updateData['bindManager'],
	               'rowCreateDate' => date("M d Y H:i:s", time()),
	            );
	        	$ret = $erpDb->getRows("select * from CustomerMangeMapInfo where CustomerID='" . $data['icsonid']) . "'";
	        	if (false === $ret)
	        	{
	        	    self::$errCode = $erpDb->errCode;
	                self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $data['icsonid'] . ") info to userMysql faild:". $erpDb->errMsg;
	                Logger::err(self::$errMsg);
	                $erpDb->execSql("rollback");
	                return false;
	        	}
	        	if (0 === count($ret))
	        	{
	        		$udata['sysno'] = time() + 1;  //�����ȱ�� ����δ��������,����ȡʱ��ֵ
	        	    $rets = $erpDb->insert('CustomerInfo', $udata);
	        	}
	            else {
	                $udata['rowModifyDate'] = date("M d Y H:i:s", time());
	                unset($udata['rowCreateDate']);
	                $rets = $erpDb->update('CustomerInfo', $udata, "CustomerID='{$data['icsonid']}'");
	            }
	            if (false === $rets)
	            {
	                self::$errCode = $userMysql->errCode;
	                self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $data['icsonid'] . ") info to userMysql faild:". $erpDb->errMsg;
	                Logger::err(self::$errMsg);
	                 $erpDb->execSql("rollback");
	                return false;
	            }
        	}
        }
        
        //update retailer ttc
        $updateData['uid'] = $data['uid'];
        isset($updateData['zipCode']) ? $updateData['zipcode'] = $updateData['zipCode'] : '';
        unset($updateData['zipCode']);
        $ret = IRetailerTTC::update($updateData);
        if(false === $ret)
        {
        	self::$errCode = IRetailerTTC::$errCode;
        	self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "update retailerDB failed" . IRetailerTTC::$errMsg;
        	Logger::err(self::$errMsg);
        	$erpDb->execSql("rollback");
        	return  false;
        }
		if(isset($data['qq'])){
			$log = array ();
			$log ['shopId']       = $data['uid'];
			$log ['type']         = self::LOG_BINDQQ;
			$log ['remark']       = ToolUtil::filterInput("�����̰�QQ");
			$log ['createTime']   = time();
			$log ['operatorId']   = $data['icsonid'];
			$log ['operatorName'] = $data['name'];
			$ret = IRetailerShopLogTTC::insert ( $log );
			if(false === $ret)
			{
				self::$errCode = IRetailerShopLogTTC::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "update retailerDB failed" . IRetailerShopLogTTC::$errMsg;
				Logger::err(self::$errMsg);
				//$erpDb->execSql("rollback");
			//	return  false;
			}
		}
		
        
		$erpDb->execSql("commit");

		return true;
	}

	//��˲�ͨ���������û�
	public static function invalidRetailer($data)
	{
		global $_USER_TYPE;
		if (!isset($data['uid']))
		{
			self::$errCode = 2012;
			self::$errMsg = basename(__FILE__,'php') . " | ". __LINE__ . " invalidRetailer lost uid";
			Logger::err(self::$errMsg);
			return false;

		}

		$updateErpData = array();
		//$updateErpData['CustomerRank'] = RETAILER_INIT;
        $updateErpData['CustomerType'] = $_USER_TYPE['Personal'];
	    $erpDb = ToolUtil::getMSDBObj('Customer');
	    if (false == $erpDb)
	    {
	    	self::$errCode = ToolUtil::$errCode;
	    	self::$errMsg = basename(__FILE__,"php"). " | ". __LINE__ . " start transaction failed! " .ToolUtil::$errMsg;
	    	Logger::err(self::$errMsg);
	    	return false;
	    }
	    
	    //�������ȸ������ݿ�
	    if (false === $erpDb->execSql("begin transaction "))
	    {
	    	self::$errCode = $mysql->errCode;
	    	self::$errMsg = basename(__FILE__,"php"). " | ". __LINE__ . " start transaction failed! " .$erpDb->errMsg;
	    	Logger::err(self::$errMsg);
	    	return false;
	    }
	    
	    $ret = $erpDb->update('Customer', $updateErpData, "SysNo={$data['uid']}");
	    if (false === $ret)
	    {
	    	self::$errCode = $erpDb->errCode;
	    	self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $data['uid'] . ") info to userMysql faild:". $erpDb->errMsg;
	    	Logger::err(self::$errMsg);
	    	$erpDb->execSql("rollback");
	    	return false;
	    }
	    
	    //���º�̨���ݿ�  @@��˲�ͨ����ɾ����������
	    $datatmp = array(
	    		'uid' => $data['uid'],
	    		'level' => $data['level'],
	    		'auditTime' => $data['auditTime'],
	    		'auditUser' => $data['auditUser']
	    );
	    
	    $ret = IRetailerTTC::update($datatmp);
	    if(false === $ret)
	    {
	    	self::$errCode = IRetailerTTC::$errCode;
	    	self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "delete retailerDB failed" . IRetailerTTC::$errMsg;
	    	Logger::err(self::$errMsg);
	    	$erpDb->execSql("rollback");
	    	return  false;
	    }
	    
		$erpDb->execSql("commit");
		return true;
	}

	//��ѯ����ע���ǰNλ��Ч�ķ������û�
	public static function getValidRetailers($num = 20)
	{
		$mysql = ToolUtil::getDBObj(self::$dbName);
		if (!$mysql)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: ".__LINE__ ." _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		$sql = 'SELECT uid,icsonid,name,tel,email,retailerType,level,regTime,auditTime,editTime FROM ' . self::$tableName . ' WHERE level>0 order by  auditTime desc limit 0,' . $num;

		$retailers = $mysql->getRows($sql);
		if(false === $retailers)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed" . $mysql->errMsg;
			return  false;
		}
		return $retailers;
	}

	//��ѯ���·�������
	/*
		����num Ҫ��Ķ�������
		����
		array��
			  [0]=> array(9) {
						["order_char_id"]=>
						string(10) "1011292642"
						["order_id"]=>
						int(11292642)
						["status"]=>
						int(4)
						["uid"]=>
						int(4303846)
						["order_date"]=>
						int(1318475702)
						["order_cost"]=>
						int(880)
						["cash"]=>
						int(880)
						["receiver"]=>
						string(6) "�ƽ�ϲ"
						["icsonid"]=>
						string(8) "wzsrremd"
					  }
			  [1]=>
					  array(9) {
						["order_char_id"]=>
						string(10) "1011292642"
						["order_id"]=>
						int(11292642)
						["status"]=>
						int(4)
						["uid"]=>
						int(4303846)
						["order_date"]=>
						int(1318475702)
						["order_cost"]=>
						int(880)
						["cash"]=>
						int(880)
						["receiver"]=>
						string(6) "�ƽ�ϲ"
						["icsonid"]=>
						string(8) "wzsrremd"
					  }
		��
	*/
	public static function getNewOrders($num = 20)
	{
		$dbIndex = rand(0,9);
		$tableIndex = rand(0,99);
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $dbIndex);
		if (!$orderDb)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " .__LINE__ . " _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		$sql = 'SELECT top '. $num .' [order_char_id]
			  ,[order_id]
			  ,[status]
			  ,[uid]
			  ,[order_date]
			  ,[order_cost]
			  ,[cash]
			  ,[receiver]
  FROM t_orders_' . $tableIndex . '  order by order_date desc';

		$orders = $orderDb->getRows($sql);
		$tempuid = 'aetc';
		foreach($orders as $k => $v)
		{
			//���uid
			$userInfo = IUsersTTC::get($v['uid'],array());
			if (!is_array($userInfo)) {
				self::$errCode = -2004;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "�û�id����ȷ!";
				Logger::err(self::$errMsg);
				return false;
			}
			if(!isset($userInfo[0]['icsonid']))
			{
				$string = 'abcdefghijklmnopgrstuvwxyz';
				$rand = '';
				for ($x=0;$x<8;$x++)
				{
					$rand .= substr($string,mt_rand(0,strlen($string)-1),1);
				}
				$orders[$k]['icsonid'] = $rand;
			}
			else
			{
				$orders[$k]['icsonid'] = $userInfo[0]['icsonid'];
			}
		}
		if(false === $orders)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select OrderDB failed" . $mysql->errMsg;
			return  false;
		}
		return $orders;
	}

	//��ȡ��Ӧ�ȼ������̼۸�
	public static function getRetailerMultiPrice($productList,$level = 0)
	{
		global $_TRADER_Type;
		$priceArray = array();
		if($level > 0 && is_array($productList) && count($productList) > 0)
		{
			foreach($_TRADER_Type as $k => $v)
			{
				if($level <= 0)
				{
					break;
				}
				else
				{
					$fliter = array(
						'status' => MP_STATUS_VALID,
						'price_id' => $k
					);

					$priceArray[$k] = IMultiPrice::getMultiPricesByProduct($productList,$fliter);
					if($priceArray[$k] == false)
					{
						unset($priceArray[$k]);
					}
				}
				$level--;
			}
		}
		else
		{
			return false;
		}

		$retPrices = array();
		krsort($_TRADER_Type);
		foreach($priceArray as $k => $v)
		{
			foreach($v as $pk => $pv)
			{
				$retPrices[$pk][$k] = $pv[$k];
			}
			foreach($v as $pk => $pv)
			{
				$hasTraderPrice = false;
				foreach($_TRADER_Type as $kt => $vt)
				{
					if($hasTraderPrice && isset($retPrices[$pk][$kt]))
					{
						unset($retPrices[$pk][$kt]);
						continue;
					}
					if(isset($retPrices[$pk][$kt]))
					{
						$hasTraderPrice = true;
					}
				}
			}
		}
		return $retPrices;
	}
	
	/**
	 * ����ͨc�û�ת��Ϊ�����û�
	 * 1�� Iuser��ȡc�û�����
	 * 2���޸������ֶ�
	 * 3������t_retailer ��
	 * 4��ͬ��user��
	 * 5��ͬ��erp customer�� 
	 */
	public static function changeUserToRetailer($uid,$type,$managerId,$managerName)
	{
	   $user_info_ = IUser::getUserInfo(intval($uid));
	   if (false == $user_info_)
	   {
	       self::$errCode = IUser::$errCode;
	       self::$errMsg = IUser::$errMsg;
	       Logger::err(self::$errMsg);
	       return false;
	   }
	   
	   $ret = IRetailerLoginTTC::get($user_info_['icsonid']);
	   if (false === $ret || count($ret) != 0)
	   {
	   	Logger::err(IRetailerLoginTTC::$errMsg);
	   	  return false;
	   }
	  
	   $old = self::getRetailers(array('uid'=>$uid));
	   $insertOrupdate = false;  //insert
	   if (false != $old && is_array($old) && count($old) == 1)
	   {
	        $insertOrupdate = true; //update
	   }
	   $newid = self::getNewId('Customer_Sequence');
	   if (false == $newid)
	   {
	   	    Logger::err(self::$errMsg);
	     	return false;
	   }
	   $now = time();
	   $data = array(
	            "uid"  =>  $newid,
                "icsonid"    => $user_info_['icsonid'],
                "name"  => $user_info_['name'],
                'tel' =>    $user_info_['phone'],
                "email"         => $user_info_['email'],
                "retailerType"         => $type,
	            "level"      => 0,  //�����״̬
                "status"     => $user_info_['status'],
                "regIp"           => $user_info_['regIP'],
                "info"=> $user_info_['note'],
                "fax"  => $user_info_['fax'],
                "mobile"      => $user_info_['mobile'],
                "sex"    => $user_info_['sex'],
                "district"    => $user_info_['city'],
                "address" => $user_info_['address'],
                "zipcode" => $user_info_['zipcode'],
                "editTime"    => $now,
	            "regTime"  =>  $user_info_['regtime'],
	            "bindManager" => $managerName
            );
	    $erpCustomerInfoDb = ToolUtil::getMSDBObj('ERP_1');
        //����erp��
        $erpDb = ToolUtil::getMSDBObj('Customer');
        if (false === $erpDb)
        {
            self::$errCode = ToolUtil::$errCode;
            self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__  ." _getDB Error".ToolUtil::$errMsg;
            Logger::err(self::$errMsg);
            return false;
        }
       
        $newERPUser = @$erpDb->getRows("select * from customer where sysno=" . $user_info_['uid'] );
        if (false === $newERPUser || count($newERPUser) == 0){
        	self::setError($erpDb->errCode, " get customer user failed! " . $erpDb->errMsg);
        	return false;
        }
        $newERPUser = current($newERPUser);
        $pass = IUserPassTTC::get($user_info_['uid']);
        if (false == $pass || count($pass) == 0) {
        	self::setError(IUserPassTTC::$errCode, " get Passwd failed! " . IUserPassTTC::$errMsg);
        	return false;
        }
        
        $sql = "begin transaction ";
        $ret = $erpDb->execSql($sql);
        if (false === $ret) {
        	self::$errCode = $erpDb->errCode;
        	self::$errMsg='����$erpDb����ʧ��,line:'. __LINE__ . ",errMsg:".$erpDb->errMsg;
        	Logger::err(self::$errMsg);
        	$erpDb->execSql("rollback");
        	return false;
        }
        
        global $_USER_TYPE;

        $ERPUser = array (
        		"SysNo"		               => $newid,
        		"CustomerID"	           => $newERPUser['CustomerID'],
        		"CustomerName"             => $newERPUser['CustomerName'],
        		"Gender"		           => intval($newERPUser['Gender']),
        		"Email"		               => $newERPUser['Email'],
        		"Phone"		               => $newERPUser['Phone'],
        		"Pwd"		               => md5($newERPUser['Pwd'] . self::EJS_KEY),
        		"CellPhone"	               => $newERPUser['CellPhone'],
        		'Status'		           => 0,
        		'EmailStatus'              => 0,
        		"Fax"		               => $newERPUser['Fax'],
        		"DwellAreaSysNo"           => intval($newERPUser['DwellAreaSysNo']),
        		"DwellAddress"             => $newERPUser['DwellAddress'],
        		"DwellZip"	               => $newERPUser['DwellZip'],
        		"TotalScore"	           => 0,
        		"ValidScore"	           => 0,
        		"CardNo"		           => '',
        		"Note"		               => $newERPUser['Note'],
        		"RegisterTime"             => date('Y-m-d H:i:s', $now),
        		"CustomerRank"             => 0,
        		"CustomerType"             => $_USER_TYPE['RetailersUser'],
        		"RegisterIP"	           => '',
        		"ExpPoint"	               => 0,
        		"CashValidScore"           => 0,
        		"SalesPromotionValidScore" => 0,
        		"rowModifydate"            => date('Y-m-d H:i:s', $now)
        );
        
        $eRet = $erpDb->insert('Customer', $ERPUser);
        
        if (false === $eRet)
         {
             self::$errCode = $erpDb->errCode;
             self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $user_info_['uid'] . ") info to userMysql faild:". $erpDb->errMsg;
             Logger::err(self::$errMsg);
             return false;
        }
  
        
            //����retailer��
            $reta = false;
            if (!$insertOrupdate)
            {
            	$ret = IRetailerTTC::insert($data);
            }
            else
            {
            	$data['uid'] = $old;
            	$ret = IRetailerTTC::update($data,array('retailerType'=>$type,'level'=>0));
            }
            if(false === $ret)
            {
            	self::$errCode = IRetailerTTC::$errCode;
            	self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "update retailerTTC failed" . IRetailerTTC::$errMsg;
            	Logger::err(self::$errMsg);
            	$erpDb->execSql("rollback");
            	return  false;
            }
			
            //��ȡ51buy��¼����
            
            if (!$insertOrupdate) 
            {
	            $pdata = array(
	            		'uid'        =>($newid == false) ? $user_info_['uid'] : $newid,
	            		'createtime' =>$now,
	            		'updatetime' =>$now
	            );
	            $pdata['password'] = md5($pass[0]['password'] . self::EJS_KEY);
	            if (false === IRetailerPasswdTTC::insert($pdata)) 
	            {
	            	IRetailerTTC::remove(($newid == false) ? $user_info_['uid'] : $newid);
	            	$erpDb->execSql("rollback");
	            	self::setError(IRetailerPasswdTTC::$errCode, " insert Passwd failed! " . IRetailerPasswdTTC::$errMsg);
	            	return false;
	            }
	            
	            $ldata = array (
	            		'account'    =>$user_info_['icsonid'],
	            		'uid'        => ($newid == false) ? $user_info_['uid'] : $newid,
	            		'updatetime' => $now,
	            );
	           
	            if (false === IRetailerLoginTTC::insert($ldata)) 
	            {
	            	$ret = IRetailerLoginTTC::update($ldata);
	            	if (false == $ret)
	            	{
		            	self::setError(IRetailerLoginTTC::$errCode, " insert Login failed! " . IRetailerLoginTTC::$errMsg . ' ' . IRetailerLoginTTC::$errCode);
		            	IRetailerTTC::remove(($newid == false) ? $user_info_['uid'] : $newid);
		            	IRetailerPasswdTTC::remove(($newid == false) ? $user_info_['uid'] : $newid);
		            	$erpDb->execSql("rollback");
		            	return false;
	            	}
	            }
            }
              
        $erpDb->execSql("commit");
    
        //��� ����erp��������
        $udata = array(
        		'CustomerID' => $data['uid'],
        		'ManagerID' => $managerId,
        		'ManagerName' => $managerName,
        		'rowCreateDate' => date("M d Y H:i:s", time()),
        );
         
        $ret = @$erpCustomerInfoDb->getRows('select * from CustomerInfo where CustomerID=' . $data['uid']);
        if (false === $ret)
        {
        	self::$errCode = $erpCustomerInfoDb->errCode;
        	self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $data['uid'] . ") info to userMysql faild:". $erpCustomerInfoDb->errMsg;
        	Logger::err(self::$errMsg);
        }
         
        if (0 === count($ret))
        {
        	$udata['sysno'] = time() + 1;  //�����ȱ�� ����δ��������,����ȡʱ��ֵ
        	$rets = $erpCustomerInfoDb->insert('CustomerInfo', $udata);
        }
        else {
        	$udata['rowModifyDate'] = date("M d Y H:i:s", time());
        	unset($udata['rowCreateDate']);
        	$rets = $erpCustomerInfoDb->update('CustomerInfo', $udata, "CustomerID={$data['uid']}");
        }
        if (false === $rets)
        {
        	self::$errCode = $erpCustomerInfoDb->errCode;
        	self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $data['uid'] . ") info to userMysql faild:". $erpCustomerInfoDb->errMsg;
        	Logger::err(self::$errMsg);
        }

        return true;
	}
	
	/**
	 * ��������û����ͣ�ȡ�������̣�
	 * ȡ����erp���������û�����Щ�û��ȿ�����51buy��¼Ҳ����ejinshangdeng�� 
	 */
    public static function changeRetailerToUser($erpUid)
    {
    	$mysql = ToolUtil::getDBObj(self::$dbName);
    	if (!$mysql)
    	{
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
    		Logger::err(self::$errMsg);
    		return false;
    	}
    	$user_info_ = $mysql->getRows("select uid,icsonid from t_retailer where uid =" . intval($erpUid));
	    if (false == $user_info_)
	    {
	       self::$errCode = $mysql->errCode;
	       self::$errMsg = $mysql->errMsg;
	       Logger::err(self::$errMsg);
	       return false;
	    }
	
       if (count($user_info_) < 0)
       {
            self::$errCode = -1001;
            self::$errMsg = '��uid ������';
            Logger::err(self::$errMsg);
            return false;
       }
       $uid = $user_info_[0]['uid'];
       $icsonid = $user_info_[0]['icsonid'];
       //����erp��
       $erpDb = ToolUtil::getMSDBObj('Customer');
       if (false === $erpDb)
       {
	       	self::$errCode = ToolUtil::$errCode;
	       	self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__  ." _getDB Error".ToolUtil::$errMsg;
	       	Logger::err(self::$errMsg);
	       	return false;
       }
        //�������ȸ������ݿ�
        if (false === $erpDb->execSql("begin transaction "))
        {
        	self::$errCode = $mysql->errCode;
        	self::$Msg = basename(__FILE__,"php"). " | ". __LINE__ . " start transaction failed! " .$mysql->Msg;
        	Logger::err(self::$errMsg);
        	return false;
        }
        global $_UserType;
        $erpUpdateData = array(
            'CustomerType' => $_UserType['Personal'],  //���Ϊ�����û�
            //'CustomerRank' => 0,  // δ��˷�����״̬
            'RowModifyDate' => date('Y-m-d H:i:s', time())
        );

        $eRet = $erpDb->update('Customer', $erpUpdateData, "sysno={$erpUid}");
        if (false === $eRet)
         {
             self::$errCode = $erpDb->errCode;
             self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $erpUid . ") info to erp faild:". $erpDb->errMsg;
             Logger::err(self::$errMsg);
             $erpDb->execSql("rollback");
             return false;
        }
  
        //�ڷ����̱���ɾ�����û�
        $ret = IRetailerTTC::remove(intval($erpUid));
        if(false === $ret)
        {
        	self::$errCode = $IRetailerTTC::$errCode;
        	self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "update retailerDB failed" . $IRetailerTTC::$errMsg;
        	Logger::err(self::$errMsg);
        	$erpDb->execSql("rollback");
        	return  false;
        }
        
        
        $erpDb->execSql("commit");
        //�ڵ�������ɾ����ǵ����ļ�¼  --�˴�����Ҫɾ������ص��ŵ�����ʺ���Ϣ
		IRetailerLoginTTC::remove($icsonid);
		IRetailerPasswdTTC::remove(intval($erpUid));
		IRetailerShopguidTTC::remove(intval($erpUid));
		
        return true;
    }
}




















