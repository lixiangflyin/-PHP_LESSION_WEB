<?php

/*
	[Discuz!] (C)2001-2006 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$RCSfile: global.func.php,v $
	$Revision: 1.17.2.1 $
	$Date: 2006/03/07 05:20:03 $
*/

if(!defined('IN_DISCUZ') || !isset($PHP_SELF) || !preg_match("/[\/\\\\]admincp\.php$/", $PHP_SELF)) {
        exit('Access Denied');
}

@set_time_limit(600);

function cpmsg($message, $url_forward = '', $msgtype = 'message', $extra = '') {
	extract($GLOBALS, EXTR_SKIP);
	eval("\$message = \"".(isset($msglang[$message]) ? $msglang[$message] : $message)."\";");

	if($msgtype == 'form') {
		$message = "<form method=\"post\" action=\"$url_forward\"><input type=\"hidden\" name=\"formhash\" value=\"".FORMHASH."\">".
			"<br><br><br>$message$extra<br><br><br><br>\n".
        		"<input type=\"submit\" name=\"confirmed\" value=\"$lang[ok]\"> &nbsp; \n".
       			"<input type=\"button\" value=\"$lang[cancel]\" onClick=\"history.go(-1);\"></form><br>";
	} else {
		if($url_forward) {
			$message .= "<br><br><br><a href=\"$url_forward\">$lang[message_redirect]</a>";
			$url_forward = transsid($url_forward);
			$message .= "<script>setTimeout(\"redirect('$url_forward');\", 1250);</script>";
		} elseif(strpos($message, $lang['return'])) {
			$message .= "<br><br><br><a href=\"javascript:history.go(-1);\" class=\"mediumtxt\">$lang[message_return]</a>";
		}
		$message = "<br><br><br>$message$extra<br><br>";
	}

?>
<br><br><br><br><br><br>
<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="80%" align="center" class="tableborder">
<tr class="header"><td><?=$lang['discuz_message']?></td></tr><tr><td bgcolor="<?=ALTBG2?>" align="center">
<table border="0" width="90%" cellspacing="0" cellpadding="0"><tr><td width="100%" align="center">
<?=$message?><br><br>
</td></tr></table>
</td></tr></table>
<br><br><br>
<?

	cpfooter();
	dexit();
}

function istpldir($dir) {
	return is_dir(DISCUZ_ROOT.'./'.$dir) && !in_array(substr($dir, -1, 1), array('/', '\\')) &&
		 strpos(realpath(DISCUZ_ROOT.'./'.$dir), realpath(DISCUZ_ROOT.'./templates')) === 0;
}

function isplugindir($dir) {
	return !$dir || (!preg_match("/(\.\.|[\\\\]+$)/", $dir) && substr($dir, -1) =='/');
}

function ispluginkey($key) {
	return preg_match("/^[a-z]+[a-z0-9_]*$/i", $key);
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

function hookselect($hooksarray, $title = '') {
	$hookselect = '';
	foreach($hooksarray as $group => $hooks) {
		$hookselect .= "<optgroup label=\"$group\">";
		foreach($hooks as $hook) {
			$hookselect .= "<option value=\"$hook\" ".($title && $title == $hook ? 'selected' : '').">$hook</option>";
		}
		$hookselect .= "</optgroup>";
	}
	return $hookselect;
}

function showforum($key, $type = '') {
	global $forums, $showedforums, $lang;

	$forum = $forums[$key];
	$showedforums[] = $key;

	return '<li><a href="'.($type == 'group' ? './index.php?gid='.$forum['fid'] : './forumdisplay.php?fid='.$forum['fid']).'" target="_blank"><b>'.$forum['name'].'</b><span class="smalltxt">'.
		($forum['status'] ? '' : ' ('.$lang['forums_hidden'].')').'</a> - '.
		$lang['display_order'].': <input type="text" name="order['.$forum['fid'].']" value="'.$forum['displayorder'].'" size="1"> - '.
		($type != 'sub' ? '<a href="admincp.php?action=forumadd&fupid='.$forum['fid'].'" title="'.$lang['forums_add_comment'].'">['.$lang['forums_add'].']</a> ' : '').
		'<a href="admincp.php?action=forumdetail&fid='.$forum['fid'].'" title="'.$lang['forums_edit_comment'].'">['.$lang['edit'].']</a>'.
		($type != 'group' ? ' <a href="admincp.php?action=forumcopy&source='.$forum['fid'].'" title="'.$lang['forums_copy_comment'].'">['.$lang['forums_copy'].']</a> ' : ' ').
		'<a href="admincp.php?action=forumdelete&fid='.$forum['fid'].'" title="'.$lang['forums_delete_comment'].'">['.$lang['delete'].']</a> - '.
		'<a href="admincp.php?action=moderators&fid='.$forum['fid'].'" title="'.$lang['forums_moderators_comment'].'">['.$lang['forums_moderators'].($forum['moderators'] ? ': '.str_replace("\t", ', ', $forum['inheritedmod'] ? '<b>'.$forum['moderators'].'</b>' : $forum['moderators']) : '').']</a>'.
		'</span><br></li>';
}

function showtype($name, $type = '', $submit = '') {
	$name = $GLOBALS['lang'][$name] ? $GLOBALS['lang'][$name] : $name;
	$submithtml = $submit ? '<center><input type="submit" name="'.$submit.'" value="'.$GLOBALS['lang']['submit'].'"></center>' : '';
	if($type != 'bottom') {
		if(!$type) {
			echo '</table><br>'.$submithtml.'<br>';
		}
		if(!$type || $type == 'top') {

?>
<a name="<?=$name?>"></a>
<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="90%" align="center" class="tableborder">
<tr class="header">
<td colspan="2"><?=$name?></td>
</tr>
<?

		}
	} else {
		echo '</table>'.$submithtml;
	}
}

function showsetting($setname, $varname, $value, $type = 'radio', $width = '60%') {
	$check = array();
	$comment = $GLOBALS['lang'][$setname.'_comment'];

	$aligntop = $type == "textarea" || $width != "60%" ?  "valign=\"top\"" : NULL;
	echo "<tr><td width=\"$width\" bgcolor=\"".ALTBG1."\" $aligntop>".
		'<b>'.(isset($GLOBALS['lang'][$setname]) ? $GLOBALS['lang'][$setname] : $setname).'</b>'.($comment ? '<br><span class="smalltxt">'.$comment.'</span>' : NULL).'</td>'.
		'<td bgcolor="'.ALTBG2.'">';

	if($type == 'radio') {
		$value ? $check['true'] = "checked" : $check['false'] = "checked";
		echo "<input type=\"radio\" name=\"$varname\" value=\"1\" $check[true]> {$GLOBALS[lang][yes]} &nbsp; &nbsp; \n".
			"<input type=\"radio\" name=\"$varname\" value=\"0\" $check[false]> {$GLOBALS[lang][no]}\n";
	} elseif($type == 'radioplus') {
		$value == -1 ? $check['default'] = 'checked' : ($value ? $check['true'] = 'checked' : $check['false'] = 'checked');
		echo "<input type=\"radio\" name=\"$varname\" value=\"-1\" $check[default]> ".$GLOBALS['lang']['default']." &nbsp; &nbsp; \n".
			"<input type=\"radio\" name=\"$varname\" value=\"1\" $check[true]> {$GLOBALS[lang][yes]} &nbsp; &nbsp; \n".
			"<input type=\"radio\" name=\"$varname\" value=\"0\" $check[false]> {$GLOBALS[lang][no]}\n";
	} elseif($type == 'color') {
		$preview_varname = str_replace('[', '_', str_replace(']', '', $varname));
		echo "<input type=\"text\" size=\"30\" value=\"$value\" name=\"$varname\" onchange=\"this.form.$preview_varname.style.backgroundColor=this.value;\">\n".
			"<input type=\"button\" id=\"$preview_varname\" value=\"\" style=\"background-color: $value\" disabled>\n";
	} elseif($type == 'text' || $type == 'password') {
		echo "<input type=\"$type\" size=\"30\" name=\"$varname\" value=\"".dhtmlspecialchars($value)."\">\n";
	} elseif($type == 'textarea') {
		echo "<img src=\"images/common/zoomin.gif\" onmouseover=\"this.style.cursor='hand'\" onclick=\"zoomtextarea('$varname', 1)\"> <img src=\"images/common/zoomout.gif\" onmouseover=\"this.style.cursor='hand'\" onclick=\"zoomtextarea('$varname', 0)\"><br><textarea rows=\"5\" name=\"$varname\" cols=\"30\">".dhtmlspecialchars($value)."</textarea>";
	} else {
		echo $type;
	}
	echo '</td></tr>';
}

function showmenu($title, $menus = array()) {
	global $menucount, $collapse;

?>
<tr><td bgcolor="<?=ALTBG1?>"><a name="#<?=$menucount?>"></a>
<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="100%" align="center" class="tableborder">
<?

	if(is_array($menus)) {
		$menucount++;
		$collapsed = preg_match("/(^|_)$menucount($|_)/is", $collapse);

		echo '<tr><td width="100%" class="header"><img src="images/common/'.($collapsed ? 'plus' : 'minus').'.gif"><a href="admincp.php?action=menu&collapse='.$collapse.'&change='.$menucount.'#'.($menucount - 2).'" style="color: '.HEADERTEXT.'">'.$title.'</td></tr>';
		if(!$collapsed) {
			foreach($menus as $menu) {
				if(!isset($menu['url'])) {
					showmenu($menu['name'], $menu['mods']);
				} else {
					echo '<tr><td bgcolor="'.ALTBG2.'" onMouseOver="this.style.backgroundColor=\''.ALTBG1.'\'" onMouseOut="this.style.backgroundColor=\''.ALTBG2.'\'"><img src="images/common/spacer.gif"><a href="'.$menu['url'].'" target="main">'.$menu['name'].'</a></td></tr>';
				}
			}
		}
	} else {
		echo "<tr><td width=\"100%\" class=\"header\"><img src=\"images/common/plus.gif\"><a href=\"$menus\" target=\"main\" style=\"color: ".HEADERTEXT."\">$title</a></td></tr>\n";
	}
	echo "</table></td></tr>\n";
}

function sqldumptable($table, $startfrom = 0, $currsize = 0) {
	global $db, $sizelimit, $startrow, $extendins, $sqlcompat, $sqlcharset, $dumpcharset;

	$offset = 300;
	$tabledump = '';

	if(!$startfrom) {

		$tabledump = "DROP TABLE IF EXISTS $table;\n";

		$createtable = $db->query("SHOW CREATE TABLE $table");
		$create = $db->fetch_row($createtable);

		$tabledump .= $create[1];

		if($sqlcompat == 'MYSQL41' && $db->version() < '4.1') {
			$tabledump = preg_replace("/TYPE\=(.+)/", "ENGINE=\\1 DEFAULT CHARSET=".$dumpcharset, $tabledump);
		}
		if($db->version() > '4.1' && $sqlcharset) {
			$tabledump = preg_replace("/(DEFAULT)*\s*CHARSET=.+/", "DEFAULT CHARSET=".$sqlcharset, $tabledump);
		}

		$query = $db->query("SHOW TABLE STATUS LIKE '$table'");
		$tablestatus = $db->fetch_array($query);
		$tabledump .= ($tablestatus['Auto_increment'] ? " AUTO_INCREMENT=$tablestatus[Auto_increment]" : '').";\n\n";

	}

	$tabledumped = 0;
	$numrows = $offset;
	if($extendins =='0') {
		while($currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset) {
			$tabledumped = 1;
			$rows = $db->query("SELECT * FROM $table LIMIT $startfrom, $offset");
			$numfields = $db->num_fields($rows);
			$numrows = $db->num_rows($rows);
			while ($row = $db->fetch_row($rows)) {
				$comma = '';
				$tabledump .= "INSERT INTO $table VALUES(";
				for($i = 0; $i < $numfields; $i++) {
					$tabledump .= $comma.'\''.mysql_escape_string($row[$i]).'\'';
					$comma = ',';
				}
				$tabledump .= ");\n";
			}
			$startfrom += $offset;
		}
	} else {
		while($currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset) {
			$tabledumped = 1;
			$rows = $db->query("SELECT * FROM $table LIMIT $startfrom, $offset");
			$numfields = $db->num_fields($rows);
			if($numrows = $db->num_rows($rows)){
				$tabledump .= "INSERT INTO $table VALUES";
				$commas = '';
				while ($row = $db->fetch_row($rows)) {
					$comma = '';
					$tabledump .= $commas."(";
					for($i = 0; $i < $numfields; $i++) {
						$tabledump .= $comma.'\''.mysql_escape_string($row[$i]).'\'';
						$comma = ',';
					}
					$tabledump .= ')';
					$commas = ',';
				}
				$tabledump .= ";\n";
			}
			$startfrom += $offset;
		}

	}

	$startrow = $startfrom;
	$tabledump .= "\n";
	return $tabledump;
}

function splitsql($sql) {
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query) {
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == "#" ? NULL : $query;
		}
		$num++;
	}
	return($ret);
}

function cpheader() {
	extract($GLOBALS, EXTR_SKIP);

	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset='.$charset.'">';
	include template('css');
	echo '<script language="JavaScript" src="include/common.js"></script>';

?>

<script language="JavaScript">
function checkalloption(form, value) {
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.value == value && e.type == 'radio' && e.disabled != true) {
			e.checked = true;
		}
	}
}

function zoomtextarea(objname, zoom) {
	zoomsize = zoom ? 10 : -10;
	obj = findobj(objname);
	if(obj.rows + zoomsize > 0 && obj.cols + zoomsize * 3 > 0) {
		obj.rows += zoomsize;
		obj.cols += zoomsize * 3;
	}
}

function redirect(url) {
	window.location.replace(url);
}
</script>
</head>

<body <?=BGCODE?> text="<?=TEXT?>" leftmargin="10" topmargin="10">
<br>
<?

}

function cpfooter() {
	global $version;

?>
<br><br><br><br><hr size="0" noshade color="<?=BORDERCOLOR?>" width="80%"><center><font style="font-size: 11px; font-family: Tahoma, Verdana, Arial">
Powered by <a href="http://www.discuz.net" target="_blank" style="color: <?=TEXT?>"><b>Discuz!</b> <?=$version?></a> &nbsp;&copy; 2001-2006, <b>
<a href="http://www.comsenz.com" target="_blank" style="color: <?=TEXT?>">Comsenz Inc.</a></b></font>

</body>
</html>
<?

	updatesession();
}

function dirsize($dir) {
	$dh = opendir($dir);
	$size = 0;
	while($file = readdir($dh)) {
		if ($file != '.' and $file != '..') {
			$path = $dir."/".$file;
			if (@is_dir($path)) {
				$size += dirsize($path);
			} else {
				$size += filesize($path);
			}
		}
	}
	@closedir($dh);
	return $size;
}

?>