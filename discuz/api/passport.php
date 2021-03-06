<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$table_member_columns = array('username', 'password', 'secques', 'email', 'adminid', 'groupid', 'gender', 'bday', 'regip', 'regdate');
$table_memberfields_columns = array('nickname', 'site', 'location', 'qq', 'icq', 'msn', 'yahoo');

define('IN_DISCUZ', true);
define('DISCUZ_ROOT', './');

$timestamp = time();

if(PHP_VERSION < '4.1.0') {
	$_GET = &$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
}

chdir('../');
require_once './config.inc.php';
require_once './include/db_'.$database.'.class.php';
require_once './forumdata/cache/cache_settings.php';

if($_DCACHE['settings']['passport_status'] != 'passport') {
	exit('Passport disabled');
} elseif($_GET['verify'] != md5($_GET['action'].$_GET['auth'].$_GET['forward'].$_DCACHE['settings']['passport_key'])) {
	exit('Illegal request');
}

if($_GET['action'] == 'login') {

	$memberfields = $remoteinfo = array();
	parse_str(passport_decrypt($_GET['auth'], $_DCACHE['settings']['passport_key']), $member);
	foreach($member as $key => $val) {
		if(in_array($key, array('username', 'password', 'email', 'credits', 'gender', 'bday', 'regip', 'regdate', 'nickname', 'site', 'qq', 'msn', 'yahoo'))) {
			$memberfields[$key] = addslashes($val);
		} elseif(in_array($key, array('cookietime', 'time'))) {
			$remoteinfo[$key] = $val;
		} elseif($key == 'isadmin') {
			if($val) {
				$memberfields['groupid'] = $memberfields['adminid'] = 1;
			}
		}
	}

	if(strlen($memberfields['username'] = preg_replace("/(c:\\con\\con$|[%,\*\"\s\t\<\>\&])/i", "", $memberfields['username'])) > 15) {
		$memberfields['username'] = substr($memberfields['username'], 0, 15);
	}

	if(empty($remoteinfo['time']) || empty($memberfields['username']) || empty($memberfields['password']) || empty($memberfields['email'])) {
		exit('Lack of required parameters');
	} elseif($timestamp - $remoteinfo['time'] > $_DCACHE['settings']['passport_expire']) {
		exit('Request expired');
	}

	$db = new dbstuff;
	$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	unset($dbhost, $dbuser, $dbpw, $dbname, $pconnect);

	if($_DCACHE['settings']['passport_extcredits']) {
		$memberfields['extcredits'.$_DCACHE['settings']['passport_extcredits']] = $memberfields['credits'];
		$table_member_columns[] = 'extcredits'.$_DCACHE['settings']['passport_extcredits'];
	}

	$memberfields['regip'] = empty($memberfields['regip']) ? onlineip() : $memberfields['regip'];
	$memberfields['regdate'] = empty($memberfields['regdate']) ? $timestamp : $memberfields['regdate'];
		
	$query = $db->query("SELECT uid, secques FROM {$tablepre}members WHERE username='$memberfields[username]'");
	if($member = $db->fetch_array($query)) {
		$sql = $comma = '';
		foreach($table_member_columns as $field) {
			if(isset($memberfields[$field])) {
				$sql .= "$comma$field='{$memberfields[$field]}'";
				$comma = ', ';
			}
		}
		$db->query("UPDATE {$tablepre}members SET $sql WHERE uid='$member[uid]'");

		$sql = $comma = '';
		foreach($table_memberfields_columns as $field) {
			if(isset($memberfields[$field])) {
				$sql .= "$comma$field='{$memberfields[$field]}'";
				$comma = ', ';
			}
		}

		if($sql) {
			$db->query("UPDATE {$tablepre}memberfields SET $sql WHERE uid='$member[uid]'");
		}
	} else {
		if(empty($memberfields['groupid'])) {
			$query = $db->query("SELECT groupid FROM {$tablepre}usergroups WHERE type='member' AND creditshigher='0'");
			$memberfields['groupid'] = $db->result($query, 0);
			$memberfields['adminid'] = 0;
		}

		$sql1 = $sql2 = $comma = '';
		foreach($table_member_columns as $field) {
			if(isset($memberfields[$field])) {
				$sql1 .= "$comma$field";
				$sql2 .= "$comma'{$memberfields[$field]}'";
				$comma = ', ';
			}
		}
		$db->query("INSERT INTO {$tablepre}members ($sql1) VALUES ($sql2)");
		$table_memberfields_columns[] = 'uid';
		$memberfields['uid'] = $member['uid'] = $db->insert_id();
		$member['secques'] = '';

		$sql1 = $sql2 = $comma = '';
		foreach($table_memberfields_columns as $field) {
			if(isset($memberfields[$field])) {
				$sql1 .= "$comma$field";
				$sql2 .= "$comma'{$memberfields[$field]}'";
				$comma = ', ';
			}
		}

		$db->query("REPLACE INTO {$tablepre}memberfields ($sql1) VALUES ($sql2)");

		$_DCACHE['settings']['lastmember'] = $memberfields['username'];
		$_DCACHE['settings']['totalmembers']++;

		updatemembercache();
	}

	dsetcookie('sid', '', -86400 * 365);
	dsetcookie('auth', authcode("$memberfields[password]\t".(isset($memberfields['secques']) ? $memberfields['secques'] : $member['secques'])."\t$member[uid]", 'ENCODE'), ($remoteinfo['cookietime'] ? $remoteinfo['cookietime'] : 0));

	header('Location: '.(empty($_GET['forward']) ? $_DCACHE['settings']['passport_url'] : $_GET['forward']));

} elseif($_GET['action'] == 'logout') {

	dsetcookie('auth', '', -86400 * 365);
	dsetcookie('sid', '', -86400 * 365);

	header('Location: '.(empty($_GET['forward']) ? $_DCACHE['settings']['passport_url'] : $_GET['forward']));

} else {

	exit('Invalid action');

}

function arrayeval($array, $level = 0) {
	$space = '';
	for($i = 0; $i <= $level; $i++) {
		$space .= "\t";
	}
	$evaluate = "Array\n$space(\n";
	$comma = $space;
	foreach($array as $key => $val) {
		$key = is_string($key) ? '\''.addcslashes($key, '\'\\').'\'' : $key;
		$val = !is_array($val) && (!preg_match("/^\d+$/", $val) || strlen($val) > 12) ? '\''.addcslashes($val, '\'\\').'\'' : $val;
		if(is_array($val)) {
			$evaluate .= "$comma$key => ".arrayeval($val, $level + 1);
		} else {
			$evaluate .= "$comma$key => $val";
		}
		$comma = ",\n$space";
	}
	$evaluate .= "\n$space)";
	return $evaluate;
}

function authcode($string, $operation) {
	global $_SERVER, $_DCACHE;

	require_once './forumdata/cache/cache_settings.php';
	$discuz_auth_key = md5($_DCACHE['settings']['authkey'].$_SERVER['HTTP_USER_AGENT']);

	$coded = '';
	$keylength = strlen($discuz_auth_key);
	$string = $operation == 'DECODE' ? base64_decode($string) : $string;
	for($i = 0; $i < strlen($string); $i += $keylength) {
		$coded .= substr($string, $i, $keylength) ^ $discuz_auth_key;
	}
	$coded = $operation == 'ENCODE' ? str_replace('=', '', base64_encode($coded)) : $coded;
	return $coded;
}

function dsetcookie($var, $value, $life = 0, $prefix = 1) {
	global $tablepre, $cookiedomain, $cookiepath, $timestamp, $_SERVER;
	setcookie(($prefix ? $tablepre : '').$var, $value,
		$life ? $timestamp + $life : 0, $cookiepath,
		$cookiedomain, $_SERVER['SERVER_PORT'] == 443 ? 1 : 0);
}

function onlineip() {
	global $_SERVER;
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$onlineip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}
	return preg_replace("/^([\d\.]+).*/", "\\1", $onlineip);
}

function passport_encrypt($txt, $key) {
	srand((double)microtime() * 1000000);
	$encrypt_key = md5(rand(0, 32000));
	$ctr = 0;
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}
	return base64_encode(passport_key($tmp, $key));
}

function passport_decrypt($txt, $key) {
	$txt = passport_key(base64_decode($txt), $key);
	$tmp = '';
	for ($i = 0;$i < strlen($txt); $i++) {
		$md5 = $txt[$i];
		$tmp .= $txt[++$i] ^ $md5;
	}
	return $tmp;
}

function passport_key($txt, $encrypt_key) {
	$encrypt_key = md5($encrypt_key);
	$ctr = 0;
	$tmp = '';
	for($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
	}
	return $tmp;
}

function updatemembercache() {
	$dir = './forumdata/cache/';
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}		
	if(@$fp = fopen($dir.'cache_settings.php', 'w')) {
		fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n".
			"//Created on ".date("M j, Y, G:i")."\n\n\$_DCACHE['settings'] = ".arrayeval($GLOBALS['_DCACHE']['settings'])."?>");
		fclose($fp);
	} else {
		exit('Can not write to cache files, please check directory ./forumdata/ and ./forumdata/cache/ .');
	}
}

?>