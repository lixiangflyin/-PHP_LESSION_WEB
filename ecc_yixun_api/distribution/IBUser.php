<?php

/**
 *
 * BUser��(�����̣��ŵ�����˺�) <br />
 * ��װ�˶Ե���ƽ̨���˺ź��ŵ�ĸ��ֲ�����
 * @author derongzeng
 * @package distribution
 */
class IBUser {
    const MAX_SHOP_NAME_LEN     = 64;
    const MAX_CONTACT_LEN       = 64;
    const MAX_NAME_LEN          = 64;
    const MAX_REMARK_LEN        = 255;
    const STATUS_PENDING_CHECK  = 0;
    const STATUS_CHECK_PASSED   = 1;
    const STATUS_CHECK_NOT_PASS = 2;
    const IS_DELETED            = 1;
    const LOG_INSERT            = 0;
    const LOG_UPDATE            = 1;
    const LOG_CHECK             = 2;
    const LOG_ADDRESS_CHANGE    = 3;
    const LOG_DELETE            = 9;

     /**
     * ������   <br />
     * �����붨�壺  <br />
     * ----�ŵ�add��updateʱУ�����----<br />
     * -4021 �ŵ����Ƴ��ȸ�ʽ���� ShopName length is incorrect <br />
     * -4022 ��ϵ�˳��ȸ�ʽ���� ContactName length is incorrect  <br />
     * -4023 ������ϵ�˳��ȸ�ʽ���� EmergencyContactName length is incorrect <br />
     * -4024 ������ϵ���ֻ���ʽ���� EmergencyMobile format error <br />
     * -4025 ������ϵ�˵绰��ʽ���� EmergencyPhone format error <br />
     * -4026 ������ϵ���ֻ��͵绰�������һ�� EmergencyPhone and mobile must be registered to one of <br />
     * -4027 ���������ʽ����  District is empty <br />
     * -4028 ��������ֵ���Ϸ�  Illegal district value <br />
     * -4029 ��ַ���ȸ�ʽ����  Address length is incorrect <br />
     * -4030 �ʱ೤�ȸ�ʽ���� Zipcode format error <br />
     * -4031 ���δͨ����ԭ��Ϊ�� The reason of not passed can not be empty <br />
     * -4032 �ŵ������Ѵ��� shopName is already occupied
     *
     * ----���˺�add��updteʱУ�����----<br />
     * -4001 uidΪ�� uid is empty <br />
     * -4002 retailerIdΪ�� retailerId is empty <br />
     * -4003 �����̲����� Can not find company info <br />
     * -4004 ������δͨ����� Company's status did not pass <br />
     * -4005 ������û�п������� company did not open shoppingGuide <br />
     * -4006 �ʺų��ȸ�ʽ���� Account length is incorrect  <br />
     * -4007 �ʺ��ѱ�ռ�� Account is already occupied <br />
     * -4008 ���볤�ȸ�ʽ���� Password length is incorrect <br />
     * -4009 �������ȸ�ʽ���� Name length is incorrect <br />
     * -4010 shopIdΪ�� Shopid is empty <br />
     * -4011 �ŵ겻���� Can not find shop info <br />
     * -4012 �ŵ�δͨ����� Shop's status did not pass <br />
     * -4013 �ֻ���ʽ���� Mobile format error <br />
     * -4014 �绰��ʽ���� Phone format error <br />
     * -4015 �ֻ��͵绰������һ�� Phone and mobile must be registered to one of <br />
     * -4016 ���״̬Ϊ�� status is empty <br />
     *
     * ----�߼�����----<br />
     * -4041 �ʺŲ����� Account does not exist <br />
     * -4042 ������� Password is incorrect <br />
     * -4043 δ���ͨ�� Status did not pass <br />
     * -4044 �������˺Ű�,���ܽ����ŵ� The store is bound, can not be disabled <br />
     */
    public static $errCode = 0;

    /**
     * ������Ϣ
     */
    public static $errMsg = '';

    /**
     *
     * ע�����˺�
     * @param array $data  ע�������ֶ�
     * @return boolean     �Ƿ�ɹ�
     */
    public static function register($data) {
        $insertData = self::_checkData ( $data );
        if (FALSE === $insertData) {
            return FALSE;
        }
        $insertData['password'] = md5($insertData['password'] . IBSession::$ENCODE_KEY);
        $insertData['createTime'] = time();
        $ret = IRetailerSalesmanTTC::insert($insertData);
        if (FALSE === $ret) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     * ���˺ŵ�½
     * @param string $parent_id   ���ʺ�(������)ID
     * @param string $account     �ʺ�
     * @param string $password    ����
     * @return array
     */
    public static function login($parent_account, $account, $password) {
        $companys = IRetailer::getRetailers(array('account' => $parent_account,'status'=>0));
        if (FALSE === $companys) {
            self::$errCode = IRetailer::$errCode;
            self::$errMsg  = IRetailer::$errMsg;
            return FALSE;
        }
        if (!$companys) {
            self::$errCode = -4003;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Can not find company info ";
            return FALSE;
        }
        $companyInfo = current($companys);
        if (1 != $companyInfo['isShoppingGuide']) {
            self::$errCode = -4005;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Company did not open shoppingGuide ";
            return FALSE;
        }
        if (1 > $companyInfo['level']) {
            self::$errCode = -4004;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Company's status did not pass ";
            return FALSE;
        }
        $conditions = array();
        $conditions['account']   = $account;
        $conditions['isDeleted'] = 0;
        $salesman = IRetailerSalesmanTTC::get($companyInfo['uid'], $conditions);
        if (FALSE === $salesman) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        if (!$salesman) {
            self::$errCode = -4041;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Account does not exist ";
            return FALSE;
        }
        $salesman = current($salesman);
        if (md5($password . IBSession::$ENCODE_KEY) !== $salesman['password']) {
            self::$errCode = -4042;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Password is incorrect ";
            return FALSE;
        }
        if (self::STATUS_CHECK_PASSED != $salesman['status']) {
            self::$errCode = -4043;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Status did not pass ";
            return FALSE;
        }
        //��ȡskey
        $level = $companyInfo['level'];
        $uid   = $salesman['uid'];
        $skey  = IBSession::getSession($uid);
        if (FALSE === $skey) {
            self::$errCode = IBSession::$errCode;
            self::$errMsg  = IBSession::$errMsg;
            EL_Flow::getInstance("ipad_login")->append("session��Ϣ��ȡʧ��" . IBSession::$errMsg);
            return FALSE;
        }
        //��ȡ�ŵ��ַ
	    $shopInfo = RetailerAddress::getAddrByShopId($companyInfo['uid'],$salesman['shopId']);
	    if (false === $shopInfo)
	    {
	    	EL_Flow::getInstance("ipad_login")->append("�ջ���ַ��Ϣ��ȡʧ��" . RetailerAddress::$errMsg);
	    	self::$errCode = RetailerAddress::$errCode;
	    	self::$errMsg  = RetailerAddress::$errMsg;;
	    	return false;
	    }
        global $_Province, $_City, $_District;
        
        $district = $_District [$shopInfo['district']];
        $from = $_Province [$district ['province_id']] . $_City [$district ['city_id']] ['name'] . $district ['name'] . ' ';

        return array(
            'level'   => $level,
            'pid'     => $companyInfo['uid'],
            'uid'     => $uid,
            'session' => $skey,
            'shopAddr' => $from . $shopInfo['address'],
        );
    }

    /**
     *
     * ��ȡ���˺���Ϣ
     * @param string $parent_id   ���ʺ�(������)ID
     * @param string $account     �ʺ�
     * @return array
     */
    public static function getUserInfo($parent_account, $account) {
    	$companys = IRetailer::getRetailers(array('account' => $parent_account,'status'=>0));
    	if (FALSE === $companys) {
    		self::$errCode = IRetailer::$errCode;
    		self::$errMsg  = IRetailer::$errMsg;
    		return FALSE;
    	}
    	if (!$companys) {
    		self::$errCode = -4003;
    		self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Can not find company info ";
    		return FALSE;
    	}
    	$companyInfo = current($companys);
    	if (1 != $companyInfo['isShoppingGuide']) {
    		self::$errCode = -4005;
    		self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Company did not open shoppingGuide ";
    		return FALSE;
    	}
    	if (1 > $companyInfo['level']) {
    		self::$errCode = -4004;
    		self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Company's status did not pass ";
    		return FALSE;
    	}
    	$conditions = array();
    	$conditions['account']   = $account;
    	$conditions['isDeleted'] = 0;
    	$salesman = IRetailerSalesmanTTC::get($companyInfo['uid'], $conditions);
    	if (FALSE === $salesman) {
    		self::$errCode = IRetailerSalesmanTTC::$errCode;
    		self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
    		return FALSE;
    	}
    	if (!$salesman) {
    		self::$errCode = -4041;
    		self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Account does not exist ";
    		return FALSE;
    	}
    	$salesman = current($salesman);
    	if (self::STATUS_CHECK_PASSED != $salesman['status']) {
    		self::$errCode = -4043;
    		self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Status did not pass ";
    		return FALSE;
    	}
    	//��ȡskey
    	$level = $companyInfo['level'];
    	$uid   = $salesman['uid'];
    	$skey  = IBSession::getSession($uid);
    	if (FALSE === $skey) {
    		self::$errCode = IBSession::$errCode;
    		self::$errMsg  = IBSession::$errMsg;
    		EL_Flow::getInstance("ipad_login")->append("session��Ϣ��ȡʧ��" . IBSession::$errMsg);
    		return FALSE;
    	}
    	//��ȡ�ŵ��ַ
    	$shopInfo = RetailerAddress::getAddrByShopId($companyInfo['uid'],$salesman['shopId']);
    	if (false === $shopInfo)
    	{
    		EL_Flow::getInstance("ipad_login")->append("�ջ���ַ��Ϣ��ȡʧ��" . RetailerAddress::$errMsg);
    		self::$errCode = RetailerAddress::$errCode;
    		self::$errMsg  = RetailerAddress::$errMsg;;
    		return false;
    	}
    	global $_Province, $_City, $_District;
    
    	$district = $_District [$shopInfo['district']];
    	$from = $_Province [$district ['province_id']] . $_City [$district ['city_id']] ['name'] . $district ['name'] . ' ';
    
    	return array(
    			'level'   => $level,
    			'pid'     => $companyInfo['uid'],
    			'uid'     => $uid,
    			'shopId'  => $salesman['shopId'],
    			'session' => $skey,
    			'shopAddr' => $from . $shopInfo['address'],
    	);
    }
    
    /**
     *
     * ���˺�ע��
     * @param int $uid
     * @return boolean
     */
    public static function logout($uid) {
        $ret = IBSession::delSession($uid);
        if (FALSE === $ret)
        {
            self::$errCode = IBSession::$errCode;
            self::$errMsg = IBSession::$errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     * ����¼̬
     * @param int $uid
     * @param string $skey
     * @return boolean
     */
    public static function logcheck($uid, $skey) {
        $ret = IBSession::checkSession($uid, $skey);
        if (FALSE === $ret)
        {
            self::$errCode = IBSession::$errCode;
            self::$errMsg = IBSession::$errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     * ��������
     * @param int $retailerId  ������ID
     * @return boolean
     */
    public static function openShoppingGuide ($retailerId,$auditUser) {
        $updateData = array();
        $updateData['retailerId']      = $retailerId;
        $updateData['isShoppingGuide'] = 1;
        $updateData['openGuideTime']   = time();
        $updateData['auditUser'] = $auditUser;
        $ret = IRetailerShopguidTTC::get($retailerId);
        if(false === $ret)
        {
            self::$errCode = IRetailer::$errCode;
            self::$errMsg  = IRetailer::$errMsg;
            return FALSE;
        }
        if (0 === count($ret))
        {
           $ret_insert = IRetailerShopguidTTC::insert($updateData);
           if (false === $ret_insert)
           {
	            self::$errCode = IRetailerShopguidTTC::$errCode;
	            self::$errMsg  = IRetailerShopguidTTC::$errMsg;
	            return FALSE;
           }
        }
        else
        {
        	$ret_update = IRetailerShopguidTTC::update($updateData);
            if (false === $ret_update)
            {
                self::$errCode = IRetailerShopguidTTC::$errCode;
                self::$errMsg  = IRetailerShopguidTTC::$errMsg;
                return FALSE;
            }
        }

    	return TRUE;
    }

    /**
     *
     * �رյ���
     * @param int $retailerId
     * @return boolean
     */
    public static function closeShoppingGuide ($retailerId,$auditUser) {
        $updateData = array();
        $updateData['retailerId']      = $retailerId;
        $updateData['isShoppingGuide'] = 0;
        $updateData['auditUser'] = $auditUser;

        $ret_update = IRetailerShopguidTTC::update($updateData);
        if (false === $ret_update)
        {
            self::$errCode = IRetailerShopguidTTC::$errCode;
            self::$errMsg  = IRetailerShopguidTTC::$errMsg;
            return FALSE;
        }

    	return TRUE;
    }

    /**
     *
     * ���õ���
     * @param unknown_type $retailerId
     * @return boolean
     */
    public static function enableShoppingGuide ($retailerId, $auditUser) {
        $updateData = array();
        $updateData['retailerId']      = $retailerId;
        $updateData['isShoppingGuide'] = 1;
        $updateData['openGuideTime']   = time();
        $updateData['auditUser'] = $auditUser;

        $ret = IRetailerShopguidTTC::get($retailerId);
        if(false === $ret)
        {
            self::$errCode = IRetailer::$errCode;
            self::$errMsg  = IRetailer::$errMsg;
            return FALSE;
        }
        if (0 === count($ret))
        {
           $ret_insert = IRetailerShopguidTTC::insert($updateData);
           if (false === $ret_insert)
           {
                self::$errCode = IRetailerShopguidTTC::$errCode;
                self::$errMsg  = IRetailerShopguidTTC::$errMsg;
                return FALSE;
           }
        }
        else
        {
            $ret_update = IRetailerShopguidTTC::update($updateData);
            if (false === $ret_update)
            {
                self::$errCode = IRetailerShopguidTTC::$errCode;
                self::$errMsg  = IRetailerShopguidTTC::$errMsg;
                return FALSE;
            }
        }

    	return TRUE;
    }

    /**
     *
     * ���õ���
     * @param int $retailerId
     * @return boolean
     */
    public static function disableShoppingGuide ($retailerId, $auditUser) {
        $updateData = array();
        $updateData['retailerId']      = $retailerId;
        $updateData['isShoppingGuide'] = 2;
        $updateData['auditUser'] = $auditUser;

        $ret_update = IRetailerShopguidTTC::update($updateData);
        if (false === $ret_update)
        {
            self::$errCode = IRetailerShopguidTTC::$errCode;
            self::$errMsg  = IRetailerShopguidTTC::$errMsg;
            return FALSE;
        }

    	return TRUE;
    }

    /**
     *
     * �������˺�ID��ȡ��Ӧ���ŵ����״̬
     * @param int $retailerId
     * @param int $uid
     * @return int
     */
    private static function getShopStatusByUid($retailerId, $uid) {
        $salesmen = IRetailerSalesmanTTC::get($retailerId, array('uid' => $uid));
        if (FALSE === $salesmen) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        if (!$salesmen) {
            return FALSE;
        }
        $salesmen = current($salesmen);
        $shopInfo = IRetailerTTC::get($salesmen['shopId'],
            array(
            	'pid'    => $retailerId,
                'status' => 0
            )
        );
        if (FALSE === $shopInfo) {
            self::$errCode = IRetailerTTC::$errCode;
            self::$errMsg  = IRetailerTTC::$errMsg;
            return FALSE;
        }
        if (!$shopInfo) {
            self::$errCode = -4011;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Can not find shop info ";
            return FALSE;
        }
        $shopInfo = current($shopInfo);
        
        return $shopInfo['level'];
    }
    /**
     *
     * �������˺�
     * @param int $retailerId
     * @param int $uid
     * @return boolean
     */
    public static function enable($retailerId, $uid) {
        $ret = self::getShopStatusByUid($retailerId, $uid);
        if (FALSE === $ret) {
            self::$errCode = -4011;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Can not find shop info ";
            return FALSE;
        }
        if (self::STATUS_CHECK_PASSED != $ret) {
            //�ŵ����δͨ��
            self::$errCode = -4012;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Shop's status did not pass ";
            return FALSE;
        }
        $data = array();
        $data['retailerId'] = $retailerId;
        $data['status']     = self::STATUS_CHECK_PASSED;
        $data['checkTime']  = time();
        $data['updateTime'] = time();
        $ret = IRetailerSalesmanTTC::update($data, array('uid' => $uid));
        if (FALSE === $ret) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     * ͣ�����˺�
     * @param int $retailerId
     * @param int $uid
     * @return boolean
     */
    public static function disable($retailerId, $uid) {
        $data = array();
        $data['retailerId'] = $retailerId;
        $data['status']     = self::STATUS_CHECK_NOT_PASS;
        $data['checkTime']  = time();
        $data['updateTime'] = time();
        $ret = IRetailerSalesmanTTC::update($data, array('uid' => $uid));
        if (FALSE === $ret) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        return TRUE;

    }

    /**
     *
     * �޸����˺���Ϣ
     * @param int $retailerId
     * @param array $userData
     * @return boolean
     */
    public static function modify($retailerId, $userData) {
        $userData['retailerId'] = $retailerId;
        $updateData = self::_checkData ( $userData, TRUE );
        if (FALSE === $updateData) {
            return FALSE;
        }
        $updateData['updateTime'] = time();
        $ret = IRetailerSalesmanTTC::update($updateData, array('uid' => $updateData['uid']));
        if (FALSE === $ret) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     *���˺��޸�����
     * @param int $retailerId
     * @param int $uid
     * @param string $newPass
     * @param string $oldPass �����Ҫ�������������֤�����������
     * @return boolean
     */
    public static function changePassword($retailerId, $uid, $newPass, $oldPass = '') {
        if ($oldPass) {
            $info = IRetailerSalesmanTTC::get($retailerId, array('uid' => $uid));
            if (!$info) {
                self::$errCode = IRetailerSalesmanTTC::$errCode;
                self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
                return FALSE;
            }
            $info = current($info);
            if (md5($oldPass . IBSession::$ENCODE_KEY) !== $info['password']) {
                self::$errCode = -4042;
                self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ .  'Password is incorrect ';
                return FALSE;
            }
        }
        //������볤��
        $passLen = strlen ( $newPass );
        if ($passLen < MIN_PASS_LEN || $passLen > MAX_PASS_LEN) {
            self::$errCode = -4008;
            self::$errMsg = basename ( __FILE__, '.php' ) . " | Line:" . __LINE__ . ' Password length is incorrect ';
            return false;
        }
        $data = array();
        $data ['password']   = md5($newPass . IBSession::$ENCODE_KEY);
        $data ['retailerId'] = $retailerId;
        $data ['updateTime'] = time();
        $ret = IRetailerSalesmanTTC::update($data, array('uid' => $uid));
        if (!$ret) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     *
     * �������˺�ID��ȡ���˺�����
     * @param int $retailerId
     * @param int $uid
     * @return array|boolean
     */
    public static function getSalesmanInfo($retailerId, $uid) {
        $conditions = array('uid' => $uid, 'isDeleted' => 0);
        $rows = IRetailerSalesmanTTC::get($retailerId, $conditions, array('uid', 'shopId', 'account',
        'name', 'phone', 'mobile', 'remark', 'status', 'createTime', 'updateTime', 'checkTime', 'retailerId'));
        if (FALSE === $rows) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        if (!$rows) {
            self::$errCode = -4041;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Account does not exist ";
            return FALSE;
        }
        $row = current($rows);
        return $row;
    }

    /**
     *
     * ���������������������˺���Ϣ
     * @param int $retailerId
     * @param array $conditions
     * @return array|boolean
     */
    public static function getAllSalesman($retailerId, $conditions) {
        $conditions['isDeleted'] = 0;
        $rows = IRetailerSalesmanTTC::get($retailerId, $conditions, array('uid', 'shopId', 'account',
        'name', 'phone', 'mobile', 'remark', 'status', 'createTime', 'updateTime', 'checkTime', 'retailerId'));
        if (FALSE === $rows) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        return $rows;
    }

    /**
     *
     * ����һҳ���˺���Ϣ
     * @param int $retailerId
     * @param array $conditions
     * @param int $page
     * @param int $pageSize
     * @param boolean $needCount
     * @return array|boolean
     */
    public static function getPageSalesman($retailerId, $conditions, $page, $pageSize = 15, $needCount = TRUE) {
        $returnData = array();
        $conditions['isDeleted'] = 0;
        if (1 > $page) {
            $page = 1;
        }
        $rows = IRetailerSalesmanTTC::get(
            $retailerId,
            $conditions,
            array('uid', 'shopId', 'account', 'name', 'phone', 'mobile', 'remark', 'status', 'createTime', 'updateTime', 'checkTime', 'retailerId'),
            $pageSize,
            ($page - 1) * $pageSize
        );
        if (FALSE === $rows) {
            self::$errCode = IRetailerSalesmanTTC::$errCode;
            self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
            return FALSE;
        }
        $returnData['data'] = $rows;
        if ($needCount) {
            $count = IRetailerSalesmanTTC::get($retailerId, $conditions, array('uid'));
            if (FALSE === $count) {
                self::$errCode = IRetailerSalesmanTTC::$errCode;
                self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
                return FALSE;
            }
            $returnData['count'] = count($count);
        }
        return $returnData;
    }

    /**
     *
     * �����ŵ�
     * TODO �����־
     * @param array $userData
     * @return boolean
     */
    public static function addShop($userData, $operatorName = '', $operatorId = 0) {
        $insertData = self::_checkShopData($userData);
        if (FALSE === $insertData) {
            return FALSE;
        }
        $ret = IRetailerShopDao::get($insertData['pid'],'', array('conpanyName'=> $insertData ['conpanyName'], 'status' => 0));
        if (FALSE === $ret) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        if ($ret) {
            self::$errCode = -4032;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . ' shopName is already occupied';
            return FALSE;
        }
        $insertData ['regTime']   = time();
        $insertData ['editTime']   = time();
        $insertData ['info'] = $operatorName;
        $ret = IRetailerShopDao::insert($insertData);
        if (!$ret) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        //��¼��־����������ŵ��ttc���ܷ���������ID������ֻ�ܸ������ʱ������ѯ
        $shopInfo = IRetailerShopDao::get($insertData['pid'], $insertData['uid']);
        if ($shopInfo) {
            $shopInfo = current($shopInfo);
            $log = array ();
            $log ['shopId']       = $shopInfo['shopId'];
            $log ['type']         = self::LOG_INSERT;
            $log ['remark']       = '';
            $log ['createTime']   = time();
            $log ['operatorId']   = $operatorId;
            $log ['operatorName'] = $operatorName;
            $ret = IRetailerShopLogTTC::insert ( $log );
        }
        return TRUE;
    }

    /**
     *
     * �޸��ŵ�
     * @param int $retailerId
     * @param array $userData
     * @return boolean
     */
    public static function modifyShop($retailerId, $userData, $operatorName = '', $operatorId = 0) {
        $updateData = self::_checkShopData($userData, TRUE);
        if (FALSE === $updateData) {
            return FALSE;
        }
        $updateData['pid'] = $retailerId;
        //�޸����ŵ����ƺ�Ҫ����Ƿ����������ŵ���ڡ�
        $ret = IRetailerShopDao::get($retailerId, '',array('conpanyName'=> $updateData ['conpanyName'],'status'=>0));
        if (FALSE === $ret) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }

        if ($ret && $updateData['uid'] != $ret[0]['uid']) {
            self::$errCode = -4032;
            self::$errMsg  = 'shopName is already occupied';
            return FALSE;
        }

        $updateData ['editTime']   = time();
        
        $ret = IRetailerShopDao::update($updateData, array('pid' => $retailerId));
        if (!$ret) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        $log ['shopId']       = $updateData['uid'];
        $log ['createTime']   = time();
        $log ['operatorId']   = $operatorId;
        $log ['operatorName'] = $operatorName;
        $ret = IRetailerShopLogTTC::insert ( $log );
        return TRUE;
    }

	/**
     *
     * �����ŵ�ID��ȡ�ŵ�����
     * @param int $retailerId
     * @param int $uid
     * @return array|boolean
     */
    public static function getShopInfo($retailerId, $shopId) {
		$conditions = array('status' => 0,);
		$rows = IRetailerShopDao::get($retailerId, $shopId, $conditions);
		
        if (FALSE === $rows) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        if (!$rows) {
            self::$errCode = -4011;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Can not find shop info ";
            return FALSE;
        }

        return $rows[0];
    }

	/**
     *
     * �����ŵ�ID��ȡ����־���ŵ�����
     * @param int $retailerId
     * @param int $uid
     * @return array|boolean
     */
    public static function getShopDetail($retailerId, $shopId) {
        $conditions = array( 'status' => 0);
        $rows = IRetailerShopDao::get($retailerId, $shopId, $conditions);

        if (FALSE === $rows) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        if (!$rows) {
            self::$errCode = -4011;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Can not find shop info ";
            return FALSE;
        }

        $row = $rows[0];

        $logs = IRetailerShopLogTTC::get ( $shopId );
        $row['logs'] = $logs;
        
        return $row;
    }

    /**
     *
     * �������������������ŵ���Ϣ
     * @param int $retailerId
     * @param array $conditions
     * @return array|boolean
     */
    public static function getAllShop($retailerId, $conditions = array()) {
        $conditions['status'] = 0;
        $rows = IRetailerShopDao::get($retailerId, '',$conditions);
        if (FALSE === $rows) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        return $rows;
    }

    /**
     *
     * ����һҳ�ŵ���Ϣ
     * @param int $retailerId
     * @param array $conditions
     * @param int $page
     * @param int $pageSize
     * @param boolean $needCount
     * @return array|boolean
     */
    public static function getPageShop($retailerId, $conditions, $page, $pageSize = 15, $needCount = TRUE) {
        $returnData = array();
        $conditions['status'] = 0;
        if (1 > $page) {
            $page = 1;
        }
        $rows = IRetailerShopDao::get($retailerId,'', $conditions, array(), $pageSize, ($page - 1) * $pageSize);
        if (FALSE === $rows) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        $returnData['data'] = $rows;
        if ($needCount) {
            $count = IRetailerShopDao::count($retailerId,'', $conditions);
            if (FALSE === $count) {
                self::$errCode = IRetailerShopDao::$errCode;
                self::$errMsg  = IRetailerShopDao::$errMsg;
                return FALSE;
            }
            $returnData['count'] = $count;
        }
        return $returnData;
    }


    /**
     *
     * ����ŵ�
     * @param int $retailerId
     * @param int $shopId         �ŵ�ID
     * @param boolean $isPass     �Ƿ�ͨ��
     * @param string $reason      ��ͨ��ԭ��
     * @return boolean
     */
    public static function checkShop($retailerId, $shopId, $isPass, $reason = '', $operatorName = '', $operatorId = 0) {
        if (!$isPass) {
            //���״̬��ͨ����Ϊ��ͨ��ʱ��Ҫ������˺ŵ������
            $shopInfo = IRetailerShopDao::get($retailerId,  $shopId);
            if (FALSE === $shopInfo) {
                self::$errCode = IRetailerShopDao::$errCode;
                self::$errMsg  = IRetailerShopDao::$errMsg;
                return FALSE;
            }
            if (!$shopInfo) {
                self::$errCode = -4011;
                self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . ' Can not find shop info ';
                return FALSE;
            }
            $shopInfo = current($shopInfo);
            if (self::STATUS_CHECK_PASSED == $shopInfo['status']) {
                $salesmans = IRetailerSalesmanTTC::get($retailerId, array('shopId' => $shopId, 'status' => self::STATUS_CHECK_PASSED, 'isDeleted' => 0));
                if (FALSE === $salesmans) {
                    self::$errCode = IRetailerSalesmanTTC::$errCode;
                    self::$errMsg  = IRetailerSalesmanTTC::$errMsg;
                    return FALSE;
                }
                if ($salesmans) {
                    self::$errCode = -4044;
                    self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . ' The store is bound, can not be disabled ';
                    return FALSE;
                }
            }
            //��˲�ͨ��ʱ������дԭ��
            if ('' == $reason) {
                self::$errCode = -4031;
                self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . ' The reason of did not passed can not be empty ';
                return FALSE;
            }
        }
        $data = array(
        	'uid' => $shopId,
        	'level'     => $isPass ? self::STATUS_CHECK_PASSED : self::STATUS_CHECK_NOT_PASS,
        	'auditTime' => time());
        //$data ['operatorId']   = $operatorId;
        $data ['info'] = $operatorName;
        $data ['editTime']   = time();
        $ret = IRetailerShopDao::update($data, array('pid' => $retailerId));
        if (!$ret) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        $log = array ();
        $log ['shopId']       = $shopId;
        $log ['type']         = self::LOG_CHECK;
        $log ['remark']       = ToolUtil::filterInput($reason);
        $log ['createTime']   = time();
        $log ['operatorId']   = $operatorId;
        $log ['operatorName'] = $operatorName;
        $ret = IRetailerShopLogTTC::insert ( $log );
        return TRUE;
    }

    /**
     *
     * �߼�ɾ��һ���ŵ��ַ
     * @param int $retailerId
     * @param int $shopId
     * @return boolean
     */
    public static function deleteShop($retailerId, $shopId, $operatorName = '', $operatorId = 0) {
        $updateData = array('status' => -1, 'uid' => $shopId,'editTime'=>time());
        $ret = IRetailerShopDao::update($updateData, array('pid' => $retailerId));
        if (!$ret) {
            self::$errCode = IRetailerShopDao::$errCode;
            self::$errMsg  = IRetailerShopDao::$errMsg;
            return FALSE;
        }
        $log = array ();
        $log ['shopId']       = $shopId;
        $log ['type']         = self::LOG_DELETE;
        $log ['remark']       = '';
        $log ['createTime']   = time();
        $log ['operatorId']   = $operatorId;
        $log ['operatorName'] = $operatorName;
        $ret = IRetailerShopLogTTC::insert ( $log );
        return TRUE;
    }

	/**
     *
     * �����ŵ�ID��ȡδͨ����˵���־��Ϣ
     * @param int $shopId
     * @param int $type
     * @return array|boolean
     */
    public static function getNoPassReason($shopId, $type = self::LOG_CHECK) {
        $logs = IRetailerShopLogTTC::get ( $shopId, array('type' => $type), array(), 1);
        if (FALSE === $logs) {
            self::$errCode = IRetailerShopLogTTC::$errCode;
            self::$errMsg = IRetailerShopLogTTC::$errMsg;
            return FALSE;
        }
        return current($logs);
    }

    /**
     *
     * ����һϵ�з�����ID�����ŵ���Ϣ
     * @param array $retailerIds
     * @param array $conditions
     * @return array|boolean
     */
//     public static function getShopsByRetailerIds($retailerIds, $conditions) {
//         $conditions['isDeleted'] = 0;
//         $rows = IRetailerShopTTC::gets($retailerIds, $conditions);
//         if (FALSE === $rows) {
//             self::$errCode = IRetailerShopTTC::$errCode;
//             self::$errMsg = IRetailerShopTTC::$errMsg;
//             return FALSE;;
//         }
//         return $rows;
//     }

	/**
     *
     * ����һϵ�з�����ID�����ŵ�����˺���Ŀ
     * ����TTCû��group�Ȳ�ѯ��ֻ��ȫ���������ͳ�ơ�
     * @param array $retailerIds
     * @return array|boolean
     */
    public static function getShopsAndSalesmanCount($retailerIds) {
        //TODO
    }


    /**
     *
     * ������˺����ݸ�ʽ,  <br />
     * ����������ַ��������ݳ��ȡ���ʽ�����жϣ��������ַ������ˡ�  <br />
     * ���������int�͵���������ʽת����  <br />
     * ���жϹ����ķ�����ID���ŵ�ID״̬��  <br />
     * IBUser��ֻ��insert��updateʱ�����������鴦��������������Ҫ��mod����ǰ����á�  <br />
     * @param array   $userData   �û��ύ������
     * @param boolean $isUpdate   �Ƿ�ֻ����
     * @return array              ����������
     */
    private function _checkData($userData, $isUpdate = FALSE) {
        $retData = array ();
        $retailerId = self::_checkIndex($userData, 'retailerId');
        if (FALSE === $retailerId) {
            //������IDΪ��
            self::$errCode = -4002;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  retailerId is empty ";
            return false;
        }
        $retData ['retailerId'] = $retailerId;
        if ($isUpdate) {
            $uid = self::_checkIndex($userData, 'uid');
            if (FALSE === $uid) {
                //uidΪ��
                self::$errCode = -4001;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " uid is empty ";
                return false;
            }
            $retData ['uid'] = $uid;
        }
        else {
            $retailers = IRetailer::getRetailers(array('uid' => $retailerId));
            if (!$retailers) {
                //������ID������
                self::$errCode = -4003;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  Can not find company info ";
                return false;
            }
            $retailerInfo =current($retailers);
            if (1 > $retailerInfo['level']) {
                //������δͨ�����
                self::$errCode = -4004;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  Company's status did not pass ";
                return false;
            }
            if (1 != $retailerInfo['isShoppingGuide']) {
                //�����̲��ǵ���������
                self::$errCode = -4005;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  company did not open shoppingGuide ";
                return false;
            }
            $retData ['retailerId'] = $retailerId;

            $account = self::_checkIndex($userData, 'account', MAX_ACCOUNT_LEN);
            if (FALSE === $account) {
                self::$errCode = -4006;
                self::$errMsg = basename ( __FILE__, '.php' ) . " | Line:" . __LINE__ . ' Account length is incorrect ';
                return false;
            }

            //����ʺŵ�Ψһ��
            $rows = IRetailerSalesmanTTC::get($retailerId, array('account' => $account));
            if (FALSE === $rows) {
                self::$errCode = IRetailerSalesmanTTC::$errCode;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " select the same account failed";
                return FALSE;
            }
            if ($rows) {
                self::$errCode = -4007;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Account is already occupied ";
                return FALSE;
            }
            $retData ['account'] = $account;

            //������볤��
            $passwd = self::_checkIndex($userData, 'password', MAX_PASS_LEN, MIN_PASS_LEN);
            if (FALSE === $passwd) {
                self::$errCode = -4008;
                self::$errMsg = basename ( __FILE__, '.php' ) . " | Line:" . __LINE__ . '  Password length is incorrect ';
                return false;
            }
            $retData ['password'] = $passwd;

            $name = self::_checkIndex($userData, 'name', self::MAX_NAME_LEN);
            if (FALSE === $name) {
                //����Ϊ�� �򳤶Ȳ��Ϸ�
                self::$errCode = -4009;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "   Name length is incorrect ";
                return false;
            }
            $retData ['name']= $name;
        }

        $shopId = self::_checkIndex($userData, 'shopId');
        if (FALSE === $shopId) {
            //shopIdΪ��
            self::$errCode = -4010;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Shopid is empty ";
            return false;
        }
        $shops = IRetailerShopDao::get($retailerId,$shopId, array('pid' => $retailerId));
        if (! $shops) {
            //�ŵ겻����
            self::$errCode = -4011;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Can not find shop info ";
            return false;
        }
        $shops = $shops[0];
        if (self::STATUS_CHECK_PASSED > $shops['status']) {
            //�ŵ����δͨ��
            self::$errCode = -4012;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Shop's status did not pass ";
            return false;
        }
        $retData ['shopId'] = $shopId;

        $mobile = self::_checkIndex($userData, 'mobile', 1);
        if ($mobile) {
            if (! ToolUtil::checkMobilePhone ( $mobile )) {
                //�ֻ���ʽ���Ϸ�
                self::$errCode = -4013;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  Mobile format error ";
                return false;
            } else {
                $retData ['mobile'] = $mobile;
            }
        }

        $phone = self::_checkIndex($userData, 'phone', 1);
        if ($phone) {
            if (! ToolUtil::checkPhone ( $phone )) {
                //�绰��ʽ���Ϸ�
                self::$errCode = -4014;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Phone format error ";
                return false;
            } else {
                $retData ['phone'] = $phone;
            }
        }

        if (! isset ( $retData ['mobile'] ) && ! isset ( $retData ['phone'] )) {
            //�ֻ��͵绰����һ��
            self::$errCode = -4015;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Phone and mobile must be registered to one of";
            return false;
        }

        $remark = self::_checkIndex($userData, 'remark', self::MAX_REMARK_LEN);
        if ($remark) {
            $retData ['remark'] = $remark;
        }

        $status = self::_checkIndex($userData, 'status');
        if ($status) {
            $retData ['status'] = $status;
        }
        return $retData;
    }


    /**
     *
     * ����ŵ����ݸ�ʽ  <br />
     * ����������ַ��������ݳ��ȡ���ʽ�����жϣ��������ַ������ˡ�  <br />
     * ���������int�͵���������ʽת����  <br />
     * IBUser��ֻ��insert��updateʱ�����������鴦��������������Ҫ��mod����ǰ����á�  <br />
     * @param array   $userData   �û��ύ������
     * @param boolean $isUpdate   �Ƿ�ֻ����
     * @return array    ����������
     */
    private static function _checkShopData($userData, $isUpdate = FALSE) {
        global $_District;
        $retData = array ();
        if ($isUpdate) {
            $shopId = self::_checkIndex($userData, 'shopId');
            if (FALSE === $shopId) {
                //�ŵ�IDΪ��
                self::$errCode = -4010;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "   Shopid is empty ";
                return false;
            }
            $retData ['uid'] = $shopId;
        }
        else {
            $retailerId = self::_checkIndex($userData, 'retailerId');
            if (FALSE === $retailerId) {
                //������IDΪ��
                self::$errCode = -4002;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "   retailerId is empty ";
                return false;
            }
            $retailers = IRetailer::getRetailers(array('uid' => $retailerId));
            if (! $retailers) {
                //������ID������
                self::$errCode = -4003;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "   Can not find company info ";
                return false;
            }
            $retailerInfo =current($retailers);
            if (1 > $retailerInfo['level']) {
                //������δͨ�����
                self::$errCode = -4004;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "   Company's status did not pass ";
                return false;
            }
//            if (1 != $retailerInfo['isShoppingGuide']) {
//                //�����̲��ǵ���������
//                self::$errCode = -4005;
//                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "   company did not open shoppingGuide ";
//                return false;
//            }
           // $retData ['retailerId'] = $retailerId;
            $newId = IIdGenerator::getNewId('Customer_Sequence');
            $retData['pid'] = $retailerId;
            $retData['uid']  = $newId;
            $retData['icsonid']      = $retailerInfo['icsonid'];
            $retData['tel']          = isset($userData['phone'])?$userData['phone']:$retailerInfo['tel'];
            $retData['email']        = $retailerInfo['email'];
            $retData['retailerType'] = $retailerInfo['retailerType'];
            //�ŵ�����״̬
            $retData['level']        = self::STATUS_CHECK_PASSED;
            //�ŵ��ɾ��״̬
            $retData['status']       = 0;
            $retData['regIP']        = $retailerInfo['regIP'];
            $retData['district']     = $retailerInfo['district'];
            //$retData['address']      = $userData['address'];
            $retData['zipcode']      = $retailerInfo['zipcode'];
            $retData['info']         = $retailerInfo['info'];
            $retData['name']  		 = isset($userData['contact'])?$userData['contact']:$retailerInfo['name'];
            $retData['mobile']       = $retailerInfo['mobile'];
            $retData['fax']          = $retailerInfo['fax'];
            $retData['stage']		 = 2; //�ڶ�����
        }

        $shopName = self::_checkIndex($userData, 'shopName', self::MAX_SHOP_NAME_LEN);
        if (FALSE === $shopName) {
            //�ŵ�����Ϊ��
            self::$errCode = -4021;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  ShopName length is incorrect ";
            return false;
        }
        $retData ['conpanyName'] = $shopName;

        $contact = self::_checkIndex($userData, 'contact', self::MAX_CONTACT_LEN);
        if (FALSE === $contact) {
            //��ϵ������Ϊ��
            self::$errCode = -4022;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " ContactName length is incorrect ";
            return false;
        }
        $retData ['name'] = $contact;

        $mobile = self::_checkIndex($userData, 'mobile', 1);
        if ($mobile) {
            if (! ToolUtil::checkMobilePhone ( $mobile )) {
                //�ֻ���ʽ���Ϸ�
                self::$errCode = -4013;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  Mobile format error ";
                return false;
            } 
        }
        $retData ['mobile'] = $mobile;
        $phone = self::_checkIndex($userData, 'phone', 1);
        if ($phone) {
            if (! ToolUtil::checkPhone ( $phone )) {
                //�绰��ʽ���Ϸ�
                self::$errCode = -4014;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  Phone format error ";
                return false;
            } 
        }
        $retData ['phone'] = $phone;
        if (! isset ( $retData ['mobile'] ) && ! isset ( $retData ['phone'] )) {
            //�ֻ��͵绰����һ��
            self::$errCode = -4015;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Phone and mobile must be registered to one of";
            return false;
        }

//         $emergencyContact = self::_checkIndex($userData, 'emergencyContact', self::MAX_CONTACT_LEN);
//         if (FALSE === $emergencyContact) {
//             //������ϵ������Ϊ�� �򳤶Ȳ��Ϸ�
//             self::$errCode = -4023;
//             self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " EmergencyContactName length is incorrect ";
//             return false;
//         }
//         $retData ['emergencyContact'] = $emergencyContact;

//         $emergencyMobile = self::_checkIndex($userData, 'emergencyMobile', 1);
//         if ($emergencyMobile) {
//             if (! ToolUtil::checkMobilePhone ( $emergencyMobile )) {
//                 //������ϵ���ֻ���ʽ���Ϸ�
//                 self::$errCode = -4024;
//                 self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  EmergencyMobile format error ";
//                 return false;
//             } else {
//                 $retData ['emergencyMobile'] = $emergencyMobile;
//             }
//         }

//         $emergencyPhone = self::_checkIndex($userData, 'emergencyPhone', 1);
//         if ($emergencyPhone) {
//             if (! ToolUtil::checkPhone ( $emergencyPhone )) {

//                 //������ϵ�绰��ʽ���Ϸ�
//                 self::$errCode = -4025;
//                 self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  EmergencyPhone format error ";
//                 return false;
//             } else {
//                 $retData ['emergencyPhone'] = $emergencyPhone;
//             }
//         }

//         if (! isset ( $retData ['emergencyMobile'] ) && ! isset ( $retData ['emergencyPhone'] )) {
//             //������ϵ���ֻ��͵绰����һ��
//             self::$errCode = -4026;
//             self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " EmergencyPhone and mobile must be registered to one of";
//             return false;
//         }

        $district = self::_checkIndex($userData, 'district');
        if (FALSE === $district) {
            //����Ϊ��
            self::$errCode = -4027;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " District is empty";
            return false;
        }
        if (1 > $district || !isset($_District[$district])) {
            //���򲻺Ϸ�
            self::$errCode = -4028;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " Illegal district value";
            return false;
        }
        $retData ['district'] = $district;

        $address = self::_checkIndex($userData, 'address', MAX_ADDR_LEN);
        if (FALSE === $address) {
            //��ַΪ�ջ��ַ���Ȳ��Ϸ�
            self::$errCode = -4029;
            self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "   Address length is incorrect ";
            return false;
        }
        $retData ['address'] = $address;

        $zipcode = self::_checkIndex($userData, 'zipcode', 1);
        if ($zipcode) {
            if (! ToolUtil::checkZip ( $zipcode )) {
                //�ʱ�Ϊ�ջ��ʱ೤�Ȳ��Ϸ�
                self::$errCode = -4030;
                self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  Zipcode format error ";
                return false;
            } else {
                $retData ['zipcode'] = $zipcode;
            }
        }
        return $retData;
    }

    /**
     * ��������е�Ԫ��ֵ�Ƿ���ڲ��Ϸ���  <br />
     * �����������Ƿ���ڸ�index��  <br />
     * ��index��ֵ�Ƿ�Ϊ�ա�  <br />
     * ���ַ��������ݼ�ⳤ���Ƿ�Ϸ���  <br />
     * ���ַ����������滻�Ƿ��ַ���  <br />
     * �������͵�������intval����  <br />
     * @param array  $rawArray   ԭʼ����
     * @param string $index      �����±�
     * @param int    $maxLen     �����޶��������0��ʾ��int�ʹ���1��ʾ����Դ�ַ�����
     * @param int    $minLen     �����޶�����С�����жϡ�
     * @return string|int|boolen ������ʧ�ܣ�����FALSE�����򷵻ذ�ȫ������
     */
    private static function _checkIndex(&$rawArray, $index, $maxLen = 0, $minLen = 0) {
        if (!isset($rawArray[$index])) {
            return FALSE;
        }
        $test = $rawArray[$index];
        if ('' == $test) {
            return FALSE;
        }
        if (0 == $maxLen) {
            return intval($test);
        }
        else if (1 == $maxLen) {
            return $test;
        }
        else {
            if ($maxLen < strlen($test)) {
                return FALSE;
            }
            else if (0 < $minLen && $maxLen < strlen($test)) {
                return FALSE;
            }
            else if ('remark' == $index) {
                return $test;
            }
            else {
                return ToolUtil::filterInput($test);
            }
        }

    }

    /**
     *
     * ���ط�����Logo
     * @param int $retailerId
     * @return string|boolean logo
     */
    public static function getRetailerLogo ($retailerId) {
        $retailer = IRetailer::getRetailers(array('uid' => $retailerId));
        if (FALSE === $retailer) {
            self::$errCode = IRetailer::$errCode;
            self::$errMsg  = IRetailer::$errMsg;
            return FALSE;
        }
        if (!$retailer) {
            self::$errCode = -4003;
            self::$errMsg  = basename ( __FILE__, '.php' ) . " |" . __LINE__ . "  Can not find company info ";
            return FALSE;
        }
        $info = current($retailer);
        return $info['logo'];
    }

    /**
     *
     * ���汾������汾Ϊ���£��򷵻�TRUE�����򷵻����°汾�ź�������ַ��������FALSE
     * @param int $version_
     * @return array|boolean
     */
    public static function checkVersion ($version_) {
        $rows = IRetailerConfigTTC::gets(array('version', 'version_location'));
        if (FALSE === $rows) {
            self::$errCode = IRetailerConfigTTC::$errCode;
            self::$errMsg  = IRetailerConfigTTC::$errMsg;
            return FALSE;
        }
        foreach ($rows as $v) {
            if ('version' == $v['key']) {
                $version = $v['value'];
            }
            else if ('version_location' == $v['key']) {
                $url = $v['value'];
            }
        }
        //����汾��û�г�ʼ�������ȳ�ʼ����
        if (!isset($version) || !isset($url)) {
            if (!isset($version)) {
                $version = 0;
                $ret = IRetailerConfigTTC::insert(array('key' => 'version', 'value' => $version));
                if (FALSE === $ret) {
                    self::$errCode = IRetailerConfigTTC::$errCode;
                    self::$errMsg  = IRetailerConfigTTC::$errMsg;
                    return FALSE;
                }
            }
            if (!isset($url)) {
                $url = '';
                $ret = IRetailerConfigTTC::insert(array('key' => 'version_location', 'value' => $url));
                if (FALSE === $ret) {
                    self::$errCode = IRetailerConfigTTC::$errCode;
                    self::$errMsg  = IRetailerConfigTTC::$errMsg;
                    return FALSE;
                }
            }
            return array('version' => $version, 'url' => $url);
        }
        if ($version == $version_) {
            return TRUE;
        }
        else {
            return array('version' => $version, 'url' => $url);
        }
    }

    public static function setVersion($version, $url) {
        $ret = IRetailerConfigTTC::update(array('key' => 'version', 'value' => $version));
        if (FALSE === $ret) {
            self::$errCode = IRetailerConfigTTC::$errCode;
            self::$errMsg  = IRetailerConfigTTC::$errMsg;
            return FALSE;
        }
        $ret = IRetailerConfigTTC::update(array('key' => 'version_location', 'value' => $url));
        if (FALSE === $ret) {
            self::$errCode = IRetailerConfigTTC::$errCode;
            self::$errMsg  = IRetailerConfigTTC::$errMsg;
            return FALSE;
        }
        return TRUE;
    }
}