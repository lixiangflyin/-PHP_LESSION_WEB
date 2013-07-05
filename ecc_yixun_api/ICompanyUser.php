<?php
/**
 * “企业客户绿色通道”功能引入的“企业用户”对象，对应的表为 SQLServer 的 CompanyUser 表。
 */
class ICompanyUser
{
	public static $errCode = 0;
	public static $errMsg = '';
	private static $colInfo = array(
		'ConnName' => array( 'errCode' => 903,  'len' => 20, ), //联系人姓名
		'ConnNumber' => array( 'errCode' => 904, 'len' => 30, ), //联系电话
		'CompanyName' => array( 'errCode' => 905, 'len' => 50, ), //公司名称
		'CompanyAddr' => array( 'errCode' => 906, 'len' => 200, ), //公司地址
		'ProcureNeed' => array( 'errCode' => 907, 'len' => 500, ), //采购需求
		'CompanyIndustry' => array( 'errCode' => 902, 'len' => 10, ), //行业
		'CompanyScale' => array( 'errCode' => 902, 'len' => 10, ), //规模
	);

	//检查公司基本信息
	public static function checkCompanyInfo(&$company) {
		foreach (self::$colInfo as $colName => $info) {
			if (! isset($company[$colName])) {
				if (! ToolUtil::checkInput($company[$colName], $info['len'])) {
					self::$errCode = $info['errCode'];
					self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "{$colName}: {$company[$colName]} is invalid";
					return false;
				}
			}

			$company[$colName] = trim(ToolUtil::transXSSContent($company[$colName])); //过滤可能的xss内容
			if($colName == 'CompanyIndustry' || $colName == 'CompanyScale') {
				if(!is_numeric($company[$colName])) {
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * 向ERP中添加“企业客户”信息
	 * @param array $company 公司信息
	 * @param int $whId 根据cookie中的标记或IP定位子站ID
	 * @return		bool	添加成功返回true, 错误返回false
	 */
	public static function addCompany(&$company, $whId) {
		global $crm_company_save_url, $crm_key;
		if (!self::checkCompanyInfo($company)) { //基本验证，并过滤
			return false;
		}

		if (! preg_match('/^[0-9_-]{7,20}$/', trim($company['ConnNumber']))) { //联系电话验证, 7~20位, 数字、_、-
			self::$errCode = self::$colInfo['ConnNumber']['errCode'];
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "ConnNumber: {$company['ConnNumber']} is invalid, " . ToolUtil::$errMsg;
			return false;
		}
		if (!$company['uid']) {
			self::$errCode = 909;
			self::$errMsg = '用户ID为空';
			return false;
		}
		$user_info = IUser::getUserInfo($company['uid']);
		if (!$user_info) {
			self::$errCode = 910;
			self::$errMsg = '获取用户信息失败 uid'.$uid;
			return false;
		}

		//存入erp
		$msdb = Config::getMSDB("ERP_{$whId}"); //注意：erp名称由子站ID决定！
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = "init ms db failed" . Config::$errMsg;
			return false;
		}
		//检查该联系人是否已经提交过资料
		$sql = "select * from CompanyUser where CompanyName='" . $msdb->msEscapeStr($company['CompanyName']) . "' or IcsonID='" . $user_info['icsonid'] . "' or ConnNumber='" . $company['ConnNumber'] . "'";
		$exist = $msdb->getRows($sql);
		if (false === $exist) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = "query ms db failed" . $msdb->errMsg;
			return false;
		}
		if ($exist[0]['CompanyName'] == $company['CompanyName']) {
			self::$errCode = 914;
			self::$errMsg = "该公司已经提交过申请，请毋重复提交";
			return false;
		}
		else if($exist[0]['IcsonID'] == $user_info['icsonid']) {
			self::$errCode = 908;
			self::$errMsg = "您已经提交过申请，请毋重复提交";
			return false;
		}
		else if($exist[0]['ConnNumber'] == $company['ConnNumber']) {
			self::$errCode = 915;
			self::$errMsg = "该联系方式已存在";
			return false;
		}

		$id = IIdGenerator::getNewId('companyuser_sequence');
		if (false === $id) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}
		$ret = $msdb->execSql('begin transaction');
		if ($ret === false) {
			self::$errCode = 911;
			self::$errMsg = 'begin transaction fail';
			return false;
		}
		$companyData = array(
			'SysNo' => $id,
			'IcsonID' => $user_info['icsonid'], //申请人易迅用户名
			'ConnName' => $company['ConnName'], //联系人姓名
			'ConnNumber' => $company['ConnNumber'], //联系电话
			'CompanyName' => $company['CompanyName'], //公司名称
			'CompanyAddr' => $company['CompanyAddr'], //公司地址
			'ProcureNeed' => $company['ProcureNeed'], //采购需求
		);
		$ret = $msdb->insert('CompanyUser', $companyData);
		if (false === $ret) {
			self::$errCode = 912;
			self::$errMsg = "insert ms db failed," . $msdb->errMsg;
			return false;
		}
		$ret = IUser::updateUser($company['uid'], array('type' => 8));
		if($ret === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = IUser::$errMsg;
			$msdb->execSql('rollback');
			return false;
		}		
		//存入企业管理系统
		$companyData['CompanyIndustry'] = $company['CompanyIndustry'];
		$companyData['CompanyScale'] = $company['CompanyScale'];
		$companyData['Uid'] = $company['uid'];
		unset($companyData['SysNo']);
		unset($companyData['ProcureNeed']);
		$sign = CPSTools::genSig($companyData, $crm_key);
		$companyData['sign'] = $sign;
		$company_str = '';
		foreach($companyData as $key => $value) {
			$company_str .= $key . '=' . urlencode($value) . '&';
		}
		$company_str = substr($company_str, 0, -1);
		$ret = json_decode(NetUtil::cURLHTTPPost($crm_company_save_url, $company_str), true);
		if(!$ret) {
			self::$errCode = 900;
			self::$errMsg = 'net error';
			$msdb->execSql('rollback');
			$ret = IUser::updateUser($company['uid'], array('type' => $user_info['type']));
			if($ret === false) {
				Logger::err('update uid:' . $company['uid'] . ' to type:' . $user_info['type'] . ' error');
			}
			return false;
		}
		if($ret['errno']) {
			self::$errCode = $ret['errno'];
			self::$errMsg = $ret['msg'];
			$msdb->execSql('rollback');
			$ret = IUser::updateUser($company['uid'], array('type' => $user_info['type']));
			if($ret === false) {
				Logger::err('update uid:' . $company['uid'] . ' to type:' . $user_info['type'] . ' error');
			}
			return false;
		}
		$msdb->execSql('commit');
		return true;
	}
}