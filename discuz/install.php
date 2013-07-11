<?php

/*
	[Discuz!] (C)2001-2006 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$RCSfile: install4.php,v $
	$Revision: 1.8.2.1 $
	$Date: 2006/03/09 05:58:05 $
*/

error_reporting(7);
set_magic_quotes_runtime(0);

define('IN_DISCUZ', TRUE);
define('DISCUZ_ROOT', '');

if(PHP_VERSION < '4.1.0') {
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
}

$action		= $_POST['action'] ? $_POST['action'] : $_GET['action'];
$language	= $_POST['language'] ? $_POST['language'] : $_GET['language'];

@set_time_limit(1000);
@include './config.inc.php';

switch($language) {
	case 'simplified_chinese_gbk':
		$dbcharset = $charset = 'gbk';
		break;
	case 'simplified_chinese_utf8':
		$dbcharset = 'utf8';
		$charset = 'utf-8';
		break;
	case 'traditional_chinese_big5':
		$dbcharset = $charset = 'big5';
		break;
	case 'traditional_chinese_utf8':
		$dbcharset = 'utf8';
		$charset = 'utf-8';
		break;
	case 'english':
		$dbcharset = 'utf8';
		$charset = 'utf-8';
		break;
	default:
		$language = '';
		$dbcharset = 'utf8';
		$charset = 'utf-8';
}

if($language) {
	$languagefile	= './install/'.$language.'.lang.php';
	$sqlfile	= './install/discuz.sql';
	if(!is_readable($languagefile) || !is_readable($sqlfile)) {
		exit('Please upload ./install and all its files completely.');
	}

	require_once $languagefile;
	$fp = fopen($sqlfile, 'rb');
	$sql = fread($fp, 2048000);
	fclose($fp);
}

header('Content-Type: text/html; charset='.$charset);
$version = '4.1.0';

?>
<html>
<head>
<title>Discuz! Board Installation Wizard</title>
<style>
A:visited	{COLOR: #3A4273; TEXT-DECORATION: none}
A:link		{COLOR: #3A4273; TEXT-DECORATION: none}
A:hover		{COLOR: #3A4273; TEXT-DECORATION: underline}
body,table,td	{COLOR: #3A4273; FONT-FAMILY: Tahoma, Verdana, Arial; FONT-SIZE: 12px; LINE-HEIGHT: 20px; scrollbar-base-color: #E3E3EA; scrollbar-arrow-color: #5C5C8D}
input		{COLOR: #085878; FONT-FAMILY: Tahoma, Verdana, Arial; FONT-SIZE: 12px; background-color: #3A4273; color: #FFFFFF; scrollbar-base-color: #E3E3EA; scrollbar-arrow-color: #5C5C8D}
.install	{FONT-FAMILY: Arial, Verdana; FONT-SIZE: 20px; FONT-WEIGHT: bold; COLOR: #000000}
</style>
</head>
<?

if(!in_array($language, array('simplified_chinese_gbk', 'simplified_chinese_utf8', 'traditional_chinese_big5', 'traditional_chinese_utf8', 'english'))) {

?>
<body bgcolor="#FFFFFF">
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" align="center">
<tr><td valign="middle" align="center">

<table cellpadding="0" cellspacing="0" border="0" align="center">
  <tr align="center" valign="middle">
    <td bgcolor="#000000">
    <table cellpadding="10" cellspacing="1" border="0" width="500" height="100%" align="center">
    <tr>
      <td valign="middle" align="center" bgcolor="#EBEBEB">
        <!-- final utf8/orig <br><b>Discuz! Board Installation Wizard</b><br><br>Please choose your prefered language<br><br><center><a href="?language=simplified_chinese_gbk">[&#31616;&#20307;&#20013;&#25991; GBK]</a> &nbsp; <a href="?language=simplified_chinese_utf8">[&#31616;&#20307;&#20013;&#25991; UTF-8]</a><br><a href="?language=traditional_chinese_big5">[&#32321;&#39636;&#20013;&#25991; BIG5]</a> &nbsp; <a href="?language=traditional_chinese_utf8">[&#32321;&#39636;&#20013;&#25991; UTF-8]</a><br><a href="?language=english">[English]</a><br><br> -->
        <br><b>Discuz! Board Installation Wizard</b><br><br>Please choose your prefered language<br><br><center><a href="?language=simplified_chinese_gbk">[&#31616;&#20307;&#20013;&#25991; GBK]</a> &nbsp; <a href="?language=simplified_chinese_utf8">[&#31616;&#20307;&#20013;&#25991; UTF-8]</a><br><a href="?language=traditional_chinese_big5">[&#32321;&#39636;&#20013;&#25991; BIG5]</a> &nbsp; <a href="?language=traditional_chinese_utf8">[&#32321;&#39636;&#20013;&#25991; UTF-8]</a><br><a href="?language=english">[English]</a><br><br>
      </td>
    </tr>
    </table>
    </td>
  </tr>
</table>

</td></td></table>
</body>
</html>
<?

	exit();

} else {

?>
<body bgcolor="#3A4273" text="#000000">
<table width="95%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
  <tr>
    <td>
      <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td class="install" height="30" valign="bottom"><font color="#FF0000">&gt;&gt;</font>
            <?=$lang['install_wizard']?></td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td align="center">
            <b><?=$lang['welcome']?></b>
          </td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
<?

}

if(!$action) {

	$discuz_license = str_replace('  ', '&nbsp; ', $lang['license']);

?>
        <tr>
          <td><b><?=$lang['current_process']?> </b><font color="#0000EE"><?=$lang['show_license']?></font></td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['agreement']?></font></b></td>
        </tr>
        <tr>
          <td><br>
            <table width="90%" cellspacing="1" bgcolor="#000000" border="0" align="center">
              <tr>
                <td bgcolor="#E3E3EA">
                  <table width="99%" cellspacing="1" border="0" align="center">
                    <tr>
                      <td>
                        <?=$discuz_license?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td align="center">
            <br>
            <form method="post" action="?language=<?=$language?>">
              <input type="hidden" name="action" value="config">
              <input type="submit" name="submit" value="<?=$lang['agreement_yes']?>" style="height: 25">&nbsp;
              <input type="button" name="exit" value="<?=$lang['agreement_no']?>" style="height: 25" onclick="javascript: window.close();">
            </form>
          </td>
        </tr>
<?

} elseif($action == 'config') {

	$exist_error = FALSE;
	$write_error = FALSE;
	if(file_exists('./config.inc.php')) {
		$fileexists = result(1, 0);
	} else {
		$fileexists = result(0, 0);
		$exist_error = TRUE;
	}
	if(is_writeable('./config.inc.php')) {
		$filewriteable = result(1, 0);
	} else {
		$filewriteable = result(0, 0);
		$write_error = TRUE;
	}
	if($exist_error) {
		$config_info = $lang['config_nonexistence'];
	} elseif(!$write_error) {
		$config_info = $lang['config_comment'];
	} elseif($write_error) {
		$config_info = $lang['config_unwriteable'];
	}

?>
        <tr>
          <td><b><?=$lang['current_process']?> </b><font color="#0000EE"><?=$lang['configure']?></font></td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['check_config']?></font></b></td>
        </tr>
        <tr>
          <td>config.inc.php <?=$lang['check_existence']?> <?=$fileexists?></td>
        </tr>
        <tr>
          <td>config.inc.php <?=$lang['check_writeable']?> <?=$filewriteable?></td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['edit_config']?></font></b></td>
        </tr>
        <tr>
          <td align="center"><br><?=$config_info?></td>
        </tr>
<?

	if(!$exist_error) {

		if(!$write_error) {

			$dbhost = 'localhost';
			$dbuser = 'dbuser';
			$dbpw = 'dbpw';
			$dbname = 'dbname';
			$adminemail = 'admin@domain.com';
			$tablepre = 'cdb_';

			@include './config.inc.php';

?>
        <tr>
          <td align="center">
            <br>
            <form method="post" action="?language=<?=$language?>">
              <table width="650" cellspacing="1" bgcolor="#000000" border="0" align="center">
                <tr bgcolor="#3A4273">
                  <td align="center" width="20%" style="color: #FFFFFF"><?=$lang['variable']?></td>
                  <td align="center" width="30%" style="color: #FFFFFF"><?=$lang['value']?></td>
                  <td align="center" width="50%" style="color: #FFFFFF"><?=$lang['comment']?></td>
                </tr>
                <tr>
                  <td bgcolor="#E3E3EA" style="color: #FF0000">&nbsp;<?=$lang['dbhost']?></td>
                  <td bgcolor="#EEEEF6" align="center"><input type="text" name="dbhost" value="<?=$dbhost?>" size="30"></td>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['dbhost_comment']?></td>
                </tr>
                <tr>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['dbuser']?></td>
                  <td bgcolor="#EEEEF6" align="center"><input type="text" name="dbuser" value="<?=$dbuser?>" size="30"></td>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['dbuser_comment']?></td>
                </tr>
                <tr>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['dbpw']?></td>
                  <td bgcolor="#EEEEF6" align="center"><input type="password" name="dbpw" value="<?=$dbpw?>" size="30"></td>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['dbpw_comment']?></td>
                </tr>
                <tr>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['dbname']?></td>
                  <td bgcolor="#EEEEF6" align="center"><input type="text" name="dbname" value="<?=$dbname?>" size="30"></td>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['dbname_comment']?></td>
                </tr>
                <tr>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['email']?></td>
                  <td bgcolor="#EEEEF6" align="center"><input type="text" name="adminemail" value="<?=$adminemail?>" size="30"></td>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['email_comment']?></td>
                </tr>
                <tr>
                  <td bgcolor="#E3E3EA" style="color: #FF0000">&nbsp;<?=$lang['tablepre']?></td>
                  <td bgcolor="#EEEEF6" align="center"><input type="text" name="tablepre" value="<?=$tablepre?>" size="30" onClick="javascript: alert('<?=$lang['install_note']?>:\n\n<?=$lang['tablepre_prompt']?>');"></td>
                  <td bgcolor="#E3E3EA">&nbsp;<?=$lang['tablepre_comment']?></td>
                </tr>
              </table>
              <br>
              <input type="hidden" name="action" value="environment">
              <input type="hidden" name="saveconfig" value="1">
              <input type="submit" name="submit" value="<?=$lang['save_config']?>" style="height: 25">
              <input type="button" name="exit" value="<?=$lang['exit']?>" style="height: 25" onclick="javascript: window.close();">
            </form>
          </td>
        </tr>
<?

		} else {

			@include './config.inc.php';

?>
        <tr>
          <td>
            <br>
            <table width="60%" cellspacing="1" bgcolor="#000000" border="0" align="center">
              <tr bgcolor="#3A4273">
                <td align="center" style="color: #FFFFFF"><?=$lang['variable']?></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['value']?></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['comment']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">$dbhost</td>
                <td bgcolor="#EEEEF6" align="center"><?=$dbhost?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['dbhost_comment']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">$dbuser</td>
                <td bgcolor="#EEEEF6" align="center"><?=$dbuser?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['dbuser_comment']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">$dbpw</td>
                <td bgcolor="#EEEEF6" align="center"><?=$dbpw?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['dbpw_comment']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">$dbname</td>
                <td bgcolor="#EEEEF6" align="center"><?=$dbname?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['dbname_comment']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">$adminemail</td>
                <td bgcolor="#EEEEF6" align="center"><?=$adminemail?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['email_comment']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">$tablepre</td>
                <td bgcolor="#EEEEF6" align="center"><?=$tablepre?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['tablepre_comment']?></td>
              </tr>
            </table>
            <br>
          </td>
        </tr>
        <tr>
          <td align="center">
            <form method="post" action="?language=<?=$language?>">
              <input type="hidden" name="action" value="environment">
              <input type="submit" name="submit" value="<?=$lang['confirm_config']?>" style="height: 25">
              <input type="button" name="exit" value="<?=$lang['refresh_config']?>" style="height: 25" onclick="javascript: window.location=('?language=<?=$language?>&action=config');">
            </form>
          </td>
        </tr>
<?

		}

	} else {

?>
        <tr>
          <td align="center">
            <br>
            <form method="post" action="?language=<?=$language?>">
              <input type="hidden" name="action" value="config">
              <input type="submit" name="submit" value="<?=$lang['recheck_config']?>" style="height: 25">
              <input type="button" name="exit" value="<?=$lang['exit']?>" style="height: 25" onclick="javascript: window.close();">
            </form>
          </td>
        </tr>
<?

	}

} elseif($action == 'environment') {

	if($_POST['saveconfig'] && is_writeable('./config.inc.php')) {

		$dbhost = $_POST['dbhost'];
		$dbuser = $_POST['dbuser'];
		$dbpw = $_POST['dbpw'];
		$dbname = $_POST['dbname'];
		$adminemail = $_POST['adminemail'];
		$tablepre = $_POST['tablepre'];

		$fp = fopen('./config.inc.php', 'r');
		$configfile = fread($fp, filesize('./config.inc.php'));
		fclose($fp);

		$configfile = preg_replace("/[$]dbhost\s*\=\s*[\"'].*?[\"']/is", "\$dbhost = '$dbhost'", $configfile);
		$configfile = preg_replace("/[$]dbuser\s*\=\s*[\"'].*?[\"']/is", "\$dbuser = '$dbuser'", $configfile);
		$configfile = preg_replace("/[$]dbpw\s*\=\s*[\"'].*?[\"']/is", "\$dbpw = '$dbpw'", $configfile);
		$configfile = preg_replace("/[$]dbname\s*\=\s*[\"'].*?[\"']/is", "\$dbname = '$dbname'", $configfile);
		$configfile = preg_replace("/[$]adminemail\s*\=\s*[\"'].*?[\"']/is", "\$adminemail = '$adminemail'", $configfile);
		$configfile = preg_replace("/[$]tablepre\s*\=\s*[\"'].*?[\"']/is", "\$tablepre = '$tablepre'", $configfile);

		$fp = fopen('./config.inc.php', 'w');
		fwrite($fp, trim($configfile));
		fclose($fp);

	}

	include './config.inc.php';
	include './include/db_'.$database.'.class.php';
	$db = new dbstuff;
	$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);

	$msg = '';
	$quit = FALSE;

	$curr_os = PHP_OS;

	$curr_php_version = PHP_VERSION;
	if($curr_php_version < '4.0.6') {
		$msg .= "<font color=\"#FF0000\">$lang[php_version_406]</font>\t";
		$quit = TRUE;
	}

	if(@ini_get(file_uploads)) {
		$max_size = @ini_get(upload_max_filesize);
		$curr_upload_status = $lang['attach_enabled'].$max_size;
		$msg .= $lang['attach_enabled_info'].$max_size."\t";
	} else {
		$curr_upload_status = $lang['attach_disabled'];
		$msg .= "<font color=\"#FF0000\">$lang[attach_disabled_info]</font>\t";
	}

	$query = $db->query("SELECT VERSION()");
	$curr_mysql_version = $db->result($query, 0);
	if($curr_mysql_version < '3.23') {
		$msg .= "<font color=\"#FF0000\">$lang[mysql_version_323]</font>\t";
		$quit = TRUE;
	}

	$curr_disk_space = intval(diskfreespace('.') / (1024 * 1024)).'M';

	if(dir_writeable('./templates')) {
		$curr_tpl_writeable = $lang['writeable'];
	} else {
		$curr_tpl_writeable = $lang['unwriteable'];
		$msg .= "<font color=\"#FF0000\">$lang[unwriteable_template]</font>\t";
	}

	if(dir_writeable('./customavatars')) {
		$curr_avatar_writeable = $lang['writeable'];
	} else {
		$curr_avatar_writeable = $lang['unwriteable'];
		$msg .= "<font color=\"#FF0000\">$lang[unwriteable_avatar]</font>\t";
	}

	if(dir_writeable($attachdir)) {
		$curr_attach_writeable = $lang['writeable'];
	} else {
		$curr_attach_writeable = $lang['unwriteable'];
		$msg .= "<font color=\"#FF0000\">$lang[unwriteable_attach]</font>\t";
	}

	if(dir_writeable('./forumdata')) {
		$curr_data_writeable = $lang['writeable'];
	} else {
		$curr_data_writeable = $lang['unwriteable'];
		$msg .= "<font color=\"#FF0000\">$lang[unwriteable_forumdata]</font>\t";
	}

	if(dir_writeable('./forumdata/templates')) {
		$curr_template_writeable = $lang['writeable'];
	} else {
		$curr_template_writeable = $lang['unwriteable'];
		$msg .= "<font color=\"#FF0000\">$lang[unwriteable_forumdata_template]</font>\t";
		$quit = TRUE;
	}

	if(dir_writeable('./forumdata/cache')) {
		$curr_cache_writeable = $lang['writeable'];
	} else {
		$curr_cache_writeable = $lang['unwriteable'];
		$msg .= "<font color=\"#FF0000\">$lang[unwriteable_forumdata_cache]</font>\t";
		$quit = TRUE;
	}

	if(strstr($tablepre, '.')) {
		$msg .= "<font color=\"#FF0000\">$lang[tablepre_invalid]</font>\t";
		$quit = TRUE;
	}

	$db->select_db($dbname);
	if($db->error()) {
		if(mysql_get_server_info() > '4.1') {
			$db->query("CREATE DATABASE $dbname DEFAULT CHARACTER SET $dbcharset");
		} else {
			$db->query("CREATE DATABASE $dbname");
		}
		if($db->error()) {
			$msg .= "<font color=\"#FF0000\">$lang[db_invalid]</font>\t";
			$quit = TRUE;
		} else {
			$db->select_db($dbname);
			$msg .= "$lang[db_auto_created]\t";
		}
	}

	$query - $db->query("SELECT COUNT(*) FROM $tablepre"."settings", 'SILENT');
	if(!$db->error()) {
		$msg .= "<font color=\"#FF0000\">$lang[db_not_null]</font>\t";
		$alert = " onSubmit=\"return confirm('$lang[db_drop_table_confirm]');\"";
	} else {
		$alert = '';
	}

	if($quit) {
		$msg .= "<font color=\"#FF0000\">$lang[install_abort]</font>";
	} else {
		$msg .= $lang['install_process'];
	}
?>
        <tr>
          <td><b><?=$lang['current_process']?> </b><font color="#0000EE"><?=$lang['check_env']?></font></td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['compare_env']?></font></b></td>
        </tr>
        <tr>
          <td>
            <br>
            <table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
              <tr bgcolor="#3A4273">
                <td align="center"></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['env_required']?></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['env_best']?></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['env_current']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['env_os']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['unlimited']?></td>
                <td bgcolor="#E3E3EA" align="center">UNIX/Linux/FreeBSD</td>
                <td bgcolor="#E3E3EA" align="center"><?=$curr_os?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['env_php']?></td>
                <td bgcolor="#EEEEF6" align="center">4.0.6+</td>
                <td bgcolor="#E3E3EA" align="center">4.3.5+</td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_php_version?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['env_attach']?></td>
                <td bgcolor="#EEEEF6" align="center"3><?=$lang['unlimited']?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['enabled']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_upload_status?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['env_mysql']?></td>
                <td bgcolor="#EEEEF6" align="center">3.23+</td>
                <td bgcolor="#E3E3EA" align="center">4.0.18</td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_mysql_version?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['env_diskspace']?></td>
                <td bgcolor="#EEEEF6" align="center">2M+</td>
                <td bgcolor="#E3E3EA" align="center">50M+</td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_disk_space?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">./templates <?=$lang['env_dir_writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['unlimited']?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_tpl_writeable?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center"><?=$attachdir?> <?=$lang['env_dir_writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['unlimited']?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_attach_writeable?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">./customavatars <?=$lang['env_dir_writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['unlimited']?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_avatar_writeable?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">./forumdata <?=$lang['env_dir_writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['unlimited']?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_data_writeable?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">./forumdata/templates <?=$lang['env_dir_writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_template_writeable?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center">./forumdata/cache <?=$lang['env_dir_writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['writeable']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$curr_cache_writeable?></td>
              </tr>
            </table>
            <br>
          </td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['confirm_preparation']?></font></b></td>
        </tr>
        <tr>
          <td>
            <br>
            <ol><?=$lang['preparation']?></ol>
          </td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['install_note']?></font></b></td>
        </tr>
        <tr>
          <td>
            <br>
            <ol>
<?

	foreach(explode("\t", $msg) as $message) {
		echo "              <li>$message</li>\n";
	}
	echo"            </ol>\n";

	if($quit) {

?>
            <center>
            <input type="button" name="refresh" value="<?=$lang['recheck_config']?>" style="height: 25" onclick="javascript: window.location=('?language=<?=$language?>&action=environment');">&nbsp;
            <input type="button" name="exit" value="<?=$lang['exit']?>" style="height: 25" onclick="javascript: window.close();">
            </center>
<?

	} else {

?>
        <form method="post" action="?language=<?=$language?>" <?=$alert?>>

        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>

<!-- final customize
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> 初始功能方案设定</font></b></td>
        </tr>
        <tr>
          <td align="center">
            <br>
            <table width="80%" cellspacing="1" bgcolor="#000000" border="0" align="center">
              <tr bgcolor="#3A4273">
                <td align="center"></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['env_required']?></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['env_best']?></td>
                <td align="center" style="color: #FFFFFF"><?=$lang['env_current']?></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" align="center"><?=$lang['env_os']?></td>
                <td bgcolor="#EEEEF6" align="center"><?=$lang['unlimited']?></td>
                <td bgcolor="#E3E3EA" align="center">UNIX/Linux/FreeBSD</td>
                <td bgcolor="#E3E3EA" align="center"><?=$curr_os?></td>
              </tr>
            </table>
            <br>
          </td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
-->
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['add_admin']?></font></b></td>
        </tr>
        <tr>
          <td align="center">
            <br>
            <table width="350" cellspacing="1" bgcolor="#000000" border="0" align="center">
              <tr>
                <td bgcolor="#E3E3EA" width="40%">&nbsp;<?=$lang['username']?></td>
                <td bgcolor="#EEEEF6" width="60%"><input type="text" name="username" value="admin" size="30"></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" width="40%">&nbsp;<?=$lang['admin_email']?></td>
                <td bgcolor="#EEEEF6" width="60%"><input type="text" name="email" value="name@domain.com" size="30"></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" width="40%">&nbsp;<?=$lang['password']?></td>
                <td bgcolor="#EEEEF6" width="60%"><input type="password" name="password1" size="30"></td>
              </tr>
              <tr>
                <td bgcolor="#E3E3EA" width="40%">&nbsp;<?=$lang['repeat_password']?></td>
                <td bgcolor="#EEEEF6" width="60%"><input type="password" name="password2" size="30"></td>
              </tr>
            </table>
            <br>
            <input type="hidden" name="action" value="install">
            <input type="submit" name="submit" value="<?=$lang['start_install']?>" style="height: 25" >&nbsp;
            <input type="button" name="exit" value="<?=$lang['exit']?>" style="height: 25" onclick="javascript: window.close();">
          </td>
        </tr>

        </form>
<?

	}

} elseif($action == 'install') {

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

?>
        <tr>
          <td><b><?=$lang['current_process']?> </b><font color="#0000EE"> <?=$lang['installing']?></font></td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['check_admin']?></font></b></td>
        </tr>
        <tr>
          <td><?=$lang['check_admin_validity']?>
<?

	$msg = '';
	if($username && $email && $password1 && $password2) {
		if($password1 != $password2) {
			$msg = $lang['admin_password_invalid'];
		} elseif(strlen($username) > 15 || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^游客|^Guest/is", $username)) {
			$msg = $lang['admin_username_invalid'];
		} elseif(!strstr($email, '@') || $email != stripslashes($email) || $email != htmlspecialchars($email)) {
			$msg = $lang['admin_email_invalid'];
		}
	} else {
		$msg = $lang['admin_invalid'];
	}

	if($msg) {

?>
            ... <font color="#FF0000"><?=$lang['fail_reason']?> <?=$msg?></font></td>
        </tr>
        <tr>
          <td align="center">
            <br>
            <input type="button" name="back" value="<?=$lang['go_back']?>" onclick="javascript: history.go(-1);">
          </td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td align="center">
            <b style="font-size: 11px">Powered by <a href="http://discuz.net" target="_blank">Discuz! <?=$version?></a> , &nbsp; Copyright &copy; <a href="http://www.comsenz.com" target=\"_blank\">Comsenz Inc.</a>, 2001-2006</b>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
</body>
</html>

<?

		exit();
	} else {
		echo result(1, 0)."</td>\n";
		echo"        </tr>\n";
	}

?>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td><b><font color="#FF0000">&gt;</font><font color="#000000"> <?=$lang['select_db']?></font></b></td>
        </tr>
<?
	include './config.inc.php';
	include './include/db_'.$database.'.class.php';
	$db = new dbstuff;
	$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	$db->select_db($dbname);

echo"        <tr>\n";
echo"          <td>$lang[select_db] $dbname ".result(1, 0)."</td>\n";
echo"        </tr>\n";
echo"        <tr>\n";
echo"          <td>\n";
echo"            <hr noshade align=\"center\" width=\"100%\" size=\"1\">\n";
echo"          </td>\n";
echo"        </tr>\n";
echo"        <tr>\n";
echo"          <td><b><font color=\"#FF0000\">&gt;</font><font color=\"#000000\"> $lang[create_table]</font></b></td>\n";
echo"        </tr>\n";
echo"        <tr>\n";
echo"          <td>\n";

$extrasql = <<<EOT
UPDATE cdb_forumlinks SET name='$lang[init_link]', note='$lang[init_link_note]' WHERE id='1';

UPDATE cdb_forums SET name='$lang[init_default_forum]' WHERE fid='1';

UPDATE cdb_onlinelist SET title='$lang[init_group_1]' WHERE groupid='1';
UPDATE cdb_onlinelist SET title='$lang[init_group_2]' WHERE groupid='2';
UPDATE cdb_onlinelist SET title='$lang[init_group_3]' WHERE groupid='3';
UPDATE cdb_onlinelist SET title='$lang[init_group_0]' WHERE groupid='0';

UPDATE cdb_ranks SET ranktitle='$lang[init_rank_1]' WHERE rankid='1';
UPDATE cdb_ranks SET ranktitle='$lang[init_rank_2]' WHERE rankid='2';
UPDATE cdb_ranks SET ranktitle='$lang[init_rank_3]' WHERE rankid='3';
UPDATE cdb_ranks SET ranktitle='$lang[init_rank_4]' WHERE rankid='4';
UPDATE cdb_ranks SET ranktitle='$lang[init_rank_5]' WHERE rankid='5';

UPDATE cdb_usergroups SET grouptitle='$lang[init_group_1]' WHERE groupid='1';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_2]' WHERE groupid='2';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_3]' WHERE groupid='3';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_4]' WHERE groupid='4';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_5]' WHERE groupid='5';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_6]' WHERE groupid='6';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_7]' WHERE groupid='7';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_8]' WHERE groupid='8';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_9]' WHERE groupid='9';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_10]' WHERE groupid='10';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_11]' WHERE groupid='11';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_12]' WHERE groupid='12';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_13]' WHERE groupid='13';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_14]' WHERE groupid='14';
UPDATE cdb_usergroups SET grouptitle='$lang[init_group_15]' WHERE groupid='15';

UPDATE cdb_crons SET name='$lang[init_cron_1]' WHERE cronid='1';
UPDATE cdb_crons SET name='$lang[init_cron_2]' WHERE cronid='2';
UPDATE cdb_crons SET name='$lang[init_cron_3]' WHERE cronid='3';
UPDATE cdb_crons SET name='$lang[init_cron_4]' WHERE cronid='4';
UPDATE cdb_crons SET name='$lang[init_cron_5]' WHERE cronid='5';
UPDATE cdb_crons SET name='$lang[init_cron_6]' WHERE cronid='6';
UPDATE cdb_crons SET name='$lang[init_cron_7]' WHERE cronid='7';
UPDATE cdb_crons SET name='$lang[init_cron_8]' WHERE cronid='8';

UPDATE cdb_settings SET value='$lang[init_dataformat]' WHERE variable='dateformat';
UPDATE cdb_settings SET value='$lang[init_modreasons]' WHERE variable='modreasons';

UPDATE cdb_styles SET name='$lang[init_default_style]' WHERE styleid='1';

UPDATE cdb_templates SET name='$lang[init_default_template]', copyright='$lang[init_default_template_copyright]' WHERE templateid='1';
EOT;

	runquery($sql);
	runquery($extrasql);

	$extcredits = Array
		(
		1 => Array
			(
			'title' => $lang['init_credits_karma'],
			'showinthread' => '',
			'available' => 1
			),
		2 => Array
			(
			'title' => $lang['init_credits_money'],
			'showinthread' => '',
			'available' => 1
			)
		);

	$db->query("REPLACE INTO {$tablepre}settings (variable, value) VALUES ('authkey', '".random(15)."')");
	$db->query("REPLACE INTO {$tablepre}settings (variable, value) VALUES ('extcredits', '".addslashes(serialize($extcredits))."')");

	$db->query("DELETE FROM {$tablepre}members");
	$db->query("DELETE FROM {$tablepre}memberfields");
	$db->query("INSERT INTO {$tablepre}members (uid, username, password, secques, adminid, groupid, regip, regdate, lastvisit, lastpost, email, dateformat, timeformat, showemail, newsletter, timeoffset) VALUES ('1', '$username', '".md5($password1)."', '', '1', '1', 'hidden', '".time()."', '".time()."', '".time()."', '$email', '', '0', '1', '1', '9999');");
	$db->query("INSERT INTO {$tablepre}memberfields (uid, bio, signature, sightml, ignorepm, groupterms) VALUES ('1', '', '', '', '', '')");
	$db->query("UPDATE {$tablepre}crons SET lastrun='0', nextrun='".(time() + 3600)."'");

echo"          </td>\n";
echo"        </tr>\n";
echo"        <tr>\n";
echo"          <td>\n";
echo"            <hr noshade align=\"center\" width=\"100%\" size=\"1\">\n";
echo"          </td>\n";
echo"        </tr>\n";
echo"        <tr>\n";
echo"          <td><b><font color=\"#FF0000\">&gt;</font><font color=\"#000000\"> $lang[init_file]</font></b></td>\n";
echo"        </tr>\n";
echo"        <tr>\n";
echo"          <td>\n";

loginit('ratelog');
loginit('illegallog');
loginit('modslog');
loginit('cplog');
loginit('errorlog');
loginit('banlog');
dir_clear('./forumdata/templates');
dir_clear('./forumdata/cache');

?>
          </td>
        </tr>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td align="center">
            <font color="#FF0000"><b><?=$lang['install_succeed']?></font><br>
            <?=$lang['username']?></b> <?=$username?><b> &nbsp; <?=$lang['password']?></b> <?=$password1?><br><br>
            <a href="index.php" target="_blank"><?=$lang['goto_forum']?></a>
          </td>
        </tr>
<?

}

?>
        <tr>
          <td>
            <hr noshade align="center" width="100%" size="1">
          </td>
        </tr>
        <tr>
          <td align="center">
            <b style="font-size: 11px">Powered by <a href="http://discuz.net" target="_blank">Discuz! <?=$version?></a> , &nbsp; Copyright &copy; <a href="http://www.comsenz.com" target=\"_blank\">Comsenz Inc.</a>, 2001-2006</b>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<iframe width="0" height="0" src="./index.php"></iframe>
</body>
</html>
<?

function loginit($log) {
	global $lang;

	echo $lang['init_log'].' '.$log;
	$fp = @fopen('./forumdata/'.$log.'.php', 'w');
	@fwrite($fp, "<?PHP exit(\"Access Denied\"); ?>\n");
	@fclose($fp);
	result();
}

function runquery($sql) {
	global $lang, $dbcharset, $tablepre, $db;

	$sql = str_replace("\r", "\n", str_replace(' cdb_', ' '.$tablepre, $sql));
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == '#' || $query[0].$query[1] == '--' ? '' : $query;
		}
		$num++;
	}
	unset($sql);

	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(substr($query, 0, 12) == 'CREATE TABLE') {
				$name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);
				echo $lang['create_table'].' '.$name.' ... <font color="#0000EE">'.$lang['succeed'].'</font><br>';
				$db->query(createtable($query, $dbcharset));
			} else {
				$db->query($query);
			}
		}
	}
}

function result($result = 1, $output = 1) {
	global $lang;

	if($result) {
		$text = '... <font color="#0000EE">'.$lang['succeed'].'</font><br>';
		if(!$output) {
			return $text;
		}
		echo $text;
	} else {
		$text = '... <font color="#FF0000">'.$lang['fail'].'</font><br>';
		if(!$output) {
			return $text;
		}
		echo $text;
	}
}

function dir_writeable($dir) {
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.test", 'w')) {
			@fclose($fp);
			@unlink("$dir/test.test");
			$writeable = 1;
		} else {
			$writeable = 0;
		}
	}
	return $writeable;
}

function dir_clear($dir) {
	global $lang;

	echo $lang['clear_dir'].' '.$dir;
	$directory = dir($dir);
	while($entry = $directory->read()) {
		$filename = $dir.'/'.$entry;
		if(is_file($filename)) {
			@unlink($filename);
		}
	}
	$directory->close();
	result();
}

function random($length) {
	$hash = '';
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$max = strlen($chars) - 1;
	mt_srand((double)microtime() * 1000000);
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function createtable($sql, $dbcharset) {
	$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
	$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
		(mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=$dbcharset" : " TYPE=$type");
}

?>