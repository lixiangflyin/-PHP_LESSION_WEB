<?php

/*
	[Discuz!] (C)2001-2006 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$RCSfile: styles.inc.php,v $
	$Revision: 1.4 $
	$Date: 2006/02/23 13:44:02 $
*/

if(!defined('IN_DISCUZ') || !isset($PHP_SELF) || !preg_match("/[\/\\\\]admincp\.php$/", $PHP_SELF)) {
        exit('Access Denied');
}

if($action == 'styles' && $export) {
	$query = $db->query("SELECT s.name, s.templateid, t.name AS tplname, t.directory, t.copyright FROM {$tablepre}styles s LEFT JOIN {$tablepre}templates t ON t.templateid=s.templateid WHERE styleid='$export'");
	if(!$stylearray = $db->fetch_array($query)) {
		cpheader();
		cpmsg('styles_export_invalid');
	}

	$stylearray['version'] = strip_tags($version);
	$time = gmdate("$dateformat $timeformat", $timestamp + $timeoffset * 3600);

	$query = $db->query("SELECT * FROM {$tablepre}stylevars WHERE styleid='$export'");
	while($style = $db->fetch_array($query)) {
		$stylearray['style'][$style['variable']] = $style['substitute'];
	}

/*
	if($stylearray['templateid'] != 1) {
		$dir = dir(DISCUZ_ROOT.'./'.$stylearray['directory']);
		while($entry = $dir->read()) {
			$filename = DISCUZ_ROOT.'./'.$stylearray['directory'].'/'.$entry;
			if(is_file($filename)) {
				$stylearray['template'][str_replace('.', '_DOT_', $entry)] = join('', file($filename));
			}
		}
		$dir->close();
	}
*/

	$style_export = "# Discuz! Style Dump\n".
			"# Version: Discuz! $version\n".
			"# Time: $time\n".
			"# From: $bbname ($boardurl)\n".
			"#\n".
			"# This file was BASE64 encoded\n".
			"#\n".
			"# Discuz! Community: http://www.Discuz.net\n".
			"# Please visit our website for latest news about Discuz!\n".
			"# --------------------------------------------------------\n\n\n".
			wordwrap(base64_encode(serialize($stylearray)), 50, "\n", 1);

	ob_end_clean();
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	header('Content-Encoding: none');
	header('Content-Length: '.strlen($style_export));
	header('Content-Disposition: attachment; filename=discuz_style_'.$stylearray['name'].'.txt');
	header('Content-Type: '.(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'application/octetstream' : 'application/octet-stream'));

	echo $style_export;
	dexit();
}

cpheader();

if($action == 'styles' && !$export) {

	$predefinedvars = array('available', 'bgcolor', 'altbg1', 'altbg2', 'link', 'bordercolor', 'innerbordercolor', 'headercolor', 'headertext', 'catcolor',
				'tabletext', 'text', 'borderwidth', 'innerborderwidth', 'tablewidth', 'tablespace', 'fontsize', 'msgfontsize', 'font', 'smfontsize',
				'smfont', 'nobold', 'boardimg', 'imgdir', 'maintablewidth', 'maintablecolor', 'smdir', 'cattext');

	if(!submitcheck('stylesubmit') && !submitcheck('importsubmit') && !$edit && !$export) {

		$styleselect = '';
		$query = $db->query("SELECT s.styleid, s.available, s.name, t.name AS tplname, t.copyright FROM {$tablepre}styles s LEFT JOIN {$tablepre}templates t ON t.templateid=s.templateid");
		while($styleinfo = $db->fetch_array($query)) {
			$styleselect .= "<tr align=\"center\"><td bgcolor=\"".ALTBG1."\"><input type=\"checkbox\" name=\"delete[]\" value=\"$styleinfo[styleid]\"></td>\n".
				"<td bgcolor=\"".ALTBG2."\"><input type=\"text\" name=\"namenew[$styleinfo[styleid]]\" value=\"$styleinfo[name]\" size=\"18\"></td>\n".
				"<td bgcolor=\"".ALTBG1."\"><input type=\"checkbox\" name=\"availablenew[$styleinfo[styleid]]\" value=\"1\" ".($styleinfo['available'] ? 'checked' : NULL)."></td>\n".
				"<td bgcolor=\"".ALTBG2."\">$styleinfo[styleid]</td>\n".
				"<td bgcolor=\"".ALTBG1."\">$styleinfo[tplname]</td>\n".
				"<td bgcolor=\"".ALTBG2."\"><a href=\"admincp.php?action=styles&export=$styleinfo[styleid]\">[$lang[download]]</a></td>\n".
				"<td bgcolor=\"".ALTBG1."\"><a href=\"admincp.php?action=styles&edit=$styleinfo[styleid]\">[$lang[detail]]</a></td></tr>\n";
		}

?>
<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="90%" align="center" class="tableborder">
<tr class="header"><td><?=$lang['tips']?></td></tr>
<tr bgcolor="<?=ALTBG1?>"><td>
<br><?=$lang['styles_tips']?>
</td></tr></table><br><br>

<form method="post" action="admincp.php?action=styles">
<input type="hidden" name="formhash" value="<?=FORMHASH?>">
<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="90%" align="center" class="tableborder">
<tr class="header" align="center">
<td width="48"><input type="checkbox" name="chkall" class="header" onclick="checkall(this.form)"><?=$lang['del']?></td>
<td><?=$lang['styles_name']?></td><td><?=$lang['available']?></td><td>styleID</td><td><?=$lang['styles_template']?></td></td><td><?=$lang['export']?></td><td><?=$lang['edit']?></td></tr>
<?=$styleselect?>
<tr><td colspan="8" class="singleborder">&nbsp;</td></tr>
<tr align="center"><td bgcolor="<?=ALTBG1?>"><?=$lang['add_new']?></td>
<td bgcolor="<?=ALTBG2?>"><input type='text' name="newname" size="18"></td>
<td colspan="6" bgcolor="<?=ALTBG2?>">&nbsp;</td>
</tr></table><br>
<center><input type="submit" name="stylesubmit" value="<?=$lang['submit']?>"></center></form>

<br><form method="post" action="admincp.php?action=styles">
<input type="hidden" name="formhash" value="<?=FORMHASH?>">
<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="90%" align="center" class="tableborder">
<tr class="header"><td><?=$lang['styles_import']?></td></tr>
<tr><td bgcolor="<?=ALTBG1?>" align="center"><textarea  name="styledata" cols="80" rows="8"></textarea><br>
<input type="checkbox" name="ignoreversion" value="1"> <?=$lang['styles_import_ignore_version']?></td></tr>
</table><br><center><input type="submit" name="importsubmit" value="<?=$lang['submit']?>"></center></form>
<?

	} elseif(submitcheck('stylesubmit')) {

		if(is_array($namenew)) {
			foreach($namenew as $id => $val) {
				$db->query("UPDATE {$tablepre}styles SET name='$namenew[$id]', available='$availablenew[$id]' WHERE styleid='$id'");
			}
		}

		if(is_array($delete)) {
			$ids = $comma = '';
			foreach($delete as $id) {
				$ids .= "$comma'$id'";
				$comma  = ',';
			}
			$query = $db->query("SELECT COUNT(*) FROM {$tablepre}settings WHERE variable='styleid' AND value IN ($ids)");
			if($db->result($query, 0)) {
				cpmsg('styles_delete_invalid');
			}

			$db->query("DELETE FROM {$tablepre}styles WHERE styleid IN ($ids)");
			$db->query("DELETE FROM {$tablepre}stylevars WHERE styleid IN ($ids)");
			$db->query("UPDATE {$tablepre}members SET styleid='0' WHERE styleid IN ($ids)");
			$db->query("UPDATE {$tablepre}forums SET styleid='0' WHERE styleid IN ($ids)");
			$db->query("UPDATE {$tablepre}sessions SET styleid='$_DCACHE[settings][styleid]' WHERE styleid IN ($ids)");
		}

		if($newname) {
			$db->query("INSERT INTO {$tablepre}styles (name, templateid) VALUES ('$newname', '1')");
			$styleidnew = $db->insert_id();
			foreach($predefinedvars as $variable) {
				$db->query("INSERT INTO {$tablepre}stylevars (styleid, variable)
					VALUES ('$styleidnew', '$variable')");
			}
		}

		cpmsg('styles_edit_succeed', 'admincp.php?action=styles');

	} elseif(submitcheck('importsubmit')) {

		$styledata = preg_replace("/(#.*\s+)*/", '', $styledata);
		$stylearray = daddslashes(unserialize(base64_decode($styledata)), 1);

		if(!is_array($stylearray)) {
			cpmsg('styles_import_data_invalid');
		} elseif(empty($ignoreversion) && strip_tags($stylearray['version']) != strip_tags($version)) {
			cpmsg('styles_import_version_invalid');
		}

		$renamed = 0;
		if($stylearray['templateid'] != 1) {
			$templatedir = DISCUZ_ROOT.'./'.$stylearray['directory'];
			if(!is_dir($templatedir)) {
				if(!@mkdir($templatedir, 0777)) {
					$basedir = dirname($stylearray['directory']);
					cpmsg('styles_import_directory_invalid');
				}
			}
/*
			foreach($stylearray['template'] as $name => $file) {
				$name = $templatedir.'/'.str_replace('_DOT_', '.', $name);
				if(file_exists($name)) {
					cpmsg('styles_import_filename_invalid');
				}
				if(!@$fp = fopen($name, 'wb')) {
					cpmsg('styles_import_file_invalid');
				}
				flock($fp, 2);
				fwrite($fp, $file);
				fclose($fp);
			}
*/

			$query = $db->query("SELECT COUNT(*) FROM {$tablepre}templates WHERE name='$stylearray[tplname]'");
			if($db->result($query, 0)) {
				$stylearray['tplname'] .= '_'.random(4);
				$renamed = 1;
			}
			$db->query("INSERT INTO {$tablepre}templates (name, directory, copyright)
				VALUES ('$stylearray[tplname]', '$stylearray[directory]', '$stylearray[copyright]')");
			$templateid = $db->insert_id();
		} else {
			$templateid = 1;
		}

		$query = $db->query("SELECT COUNT(*) FROM {$tablepre}styles WHERE name='$stylearray[name]'");
		if($db->result($query, 0)) {
			$stylearray['name'] .= '_'.random(4);
			$renamed = 1;
		}
		$db->query("INSERT INTO {$tablepre}styles (name, templateid)
			VALUES ('$stylearray[name]', '$templateid')");
		$styleidnew = $db->insert_id();

		foreach($stylearray['style'] as $variable => $substitute) {
			$db->query("INSERT INTO {$tablepre}stylevars (styleid, variable, substitute)
				VALUES ('$styleidnew', '$variable', '$substitute')");
		}

		updatecache('styles');
		updatecache('settings');
		cpmsg($renamed ? 'styles_import_succeed_renamed' : 'styles_import_succeed', 'admincp.php?action=styles');

	} elseif($edit) {

		if(!submitcheck('editsubmit')) {

			$query = $db->query("SELECT name, templateid FROM {$tablepre}styles WHERE styleid='$edit'");
			if(!$style = $db->fetch_array($query)) {
				cpmsg('undefined_action');
			}

			$stylecustom = '';
			$stylestuff = array();
			$query = $db->query("SELECT * FROM {$tablepre}stylevars WHERE styleid='$edit'");
			while($stylevar = $db->fetch_array($query)) {
				if(in_array($stylevar['variable'], $predefinedvars)) {
					$stylestuff[$stylevar['variable']] = array('id' => $stylevar['stylevarid'], 'subst' => $stylevar['substitute']);
				} else {
					$stylecustom .= "<tr align=\"center\"><td bgcolor=\"".ALTBG1."\"><input type=\"checkbox\" name=\"delete[]\" value=\"$stylevar[stylevarid]\"></td>\n".
						"<td bgcolor=\"".ALTBG2."\"><b>{".strtoupper($stylevar[variable])."}</b></td>\n".
						"<td bgcolor=\"".ALTBG1."\"><textarea name=\"stylevar[$stylevar[stylevarid]]\" cols=\"50\" rows=\"2\">$stylevar[substitute]</textarea></td>\n".
						"</tr>";
				}
			}

			$tplselect = "<select name=\"templateidnew\">\n";
			$query = $db->query("SELECT templateid, name FROM {$tablepre}templates");
			while($template = $db->fetch_array($query)) {
				$tplselect .= "<option value=\"$template[templateid]\"".
					($style['templateid'] == $template['templateid'] ? 'selected="selected"' : NULL).
					">$template[name]</option>\n";
			}
			$tplselect .= '</select>';

			echo "<form method=\"post\" action=\"admincp.php?action=styles&edit=$edit&formhash=".FORMHASH."\">\n";

			showtype($lang['styles_edit'].' - '.$style['name'], 'top');
			showsetting('styles_edit_name', 'namenew', $style['name'], 'text', '55%');
			showsetting('styles_edit_tpl', '', '', $tplselect, '55%');
			showsetting('styles_edit_logo', "stylevar[{$stylestuff[boardimg][id]}]", $stylestuff['boardimg']['subst'], 'text', '55%');
			showsetting('styles_edit_imgdir', "stylevar[{$stylestuff[imgdir][id]}]", $stylestuff['imgdir']['subst'], 'text', '55%');
			showsetting('styles_edit_smdir', "stylevar[{$stylestuff[smdir][id]}]", $stylestuff['smdir']['subst'], 'text', '55%');

			showtype('styles_edit_font_color');
			showsetting('styles_edit_nobold', "stylevar[{$stylestuff[nobold][id]}]", $stylestuff['nobold']['subst'], 'radio', '55%');
			showsetting('styles_edit_font', "stylevar[{$stylestuff[font][id]}]", $stylestuff['font']['subst'], 'text', '55%');
			showsetting('styles_edit_fontsize', "stylevar[{$stylestuff[fontsize][id]}]", $stylestuff['fontsize']['subst'], 'text', '55%');
			showsetting('styles_edit_msgfontsize', "stylevar[{$stylestuff[msgfontsize][id]}]", $stylestuff['msgfontsize']['subst'], 'text', '55%');
			showsetting('styles_edit_smfont', "stylevar[{$stylestuff[smfont][id]}]", $stylestuff['smfont']['subst'], 'text', '55%');
			showsetting('styles_edit_smfontsize', "stylevar[{$stylestuff[smfontsize][id]}]", $stylestuff['smfontsize']['subst'], 'text', '55%');
			showsetting('styles_edit_link', "stylevar[{$stylestuff[link][id]}]", $stylestuff['link']['subst'], 'color', '55%');
			showsetting('styles_edit_headertext', "stylevar[{$stylestuff[headertext][id]}]", $stylestuff['headertext']['subst'], 'color', '55%');
			showsetting('styles_edit_cattext', "stylevar[{$stylestuff[cattext][id]}]", $stylestuff['cattext']['subst'], 'color', '55%');
			showsetting('styles_edit_tabletext', "stylevar[{$stylestuff[tabletext][id]}]", $stylestuff['tabletext']['subst'], 'color', '55%');
			showsetting('styles_edit_text', "stylevar[{$stylestuff[text][id]}]", $stylestuff['text']['subst'], 'color', '55%');

			showtype('styles_edit_table');
			showsetting('styles_edit_maintablewidth', "stylevar[{$stylestuff[maintablewidth][id]}]", $stylestuff['maintablewidth']['subst'], 'text', '55%');
			showsetting('styles_edit_maintablecolor', "stylevar[{$stylestuff[maintablecolor][id]}]", $stylestuff['maintablecolor']['subst'], 'color', '55%');
			showsetting('styles_edit_tablewidth', "stylevar[{$stylestuff[tablewidth][id]}]", $stylestuff['tablewidth']['subst'], 'text', '55%');
			showsetting('styles_edit_tablespace', "stylevar[{$stylestuff[tablespace][id]}]", $stylestuff['tablespace']['subst'],   'text', '55%');
			showsetting('styles_edit_borderwidth', "stylevar[{$stylestuff[borderwidth][id]}]", $stylestuff['borderwidth']['subst'], 'text', '55%');
			showsetting('styles_edit_bordercolor', "stylevar[{$stylestuff[bordercolor][id]}]", $stylestuff['bordercolor']['subst'], 'color', '55%');
			showsetting('styles_edit_innerborderwidth', "stylevar[{$stylestuff[innerborderwidth][id]}]", $stylestuff['innerborderwidth']['subst'], 'text', '55%');
			showsetting('styles_edit_innerbordercolor', "stylevar[{$stylestuff[innerbordercolor][id]}]", $stylestuff['innerbordercolor']['subst'], 'color', '55%');
			showsetting('styles_edit_bgcolor', "stylevar[{$stylestuff[bgcolor][id]}]", $stylestuff['bgcolor']['subst'], 'color', '55%');
			showsetting('styles_edit_headercolor', "stylevar[{$stylestuff[headercolor][id]}]", $stylestuff['headercolor']['subst'], 'color', '55%');
			showsetting('styles_edit_catcolor', "stylevar[{$stylestuff[catcolor][id]}]", $stylestuff['catcolor']['subst'], 'color', '55%');
			showsetting('styles_edit_altbg1', "stylevar[{$stylestuff[altbg1][id]}]", $stylestuff['altbg1']['subst'], 'color', '55%');
			showsetting('styles_edit_altbg2', "stylevar[{$stylestuff[altbg2][id]}]", $stylestuff['altbg2']['subst'], 'color', '55%');
			showtype('', 'bottom');

?>
<br><br>
<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="90%" align="center" class="tableborder">
<tr class="header" align="center">
<td width="48"><input type="checkbox" name="chkall" class="header" onclick="checkall(this.form)"><?=$lang['del']?></td>
<td><?=$lang['styles_edit_variable']?></td><td><?=$lang['styles_edit_subst']?></td></tr>
<?=$stylecustom?>
<tr><td colspan="3" class="singleborder">&nbsp;</td></tr>
<tr align="center"><td bgcolor="<?=ALTBG1?>"><?=$lang['add_new']?></td>
<td bgcolor="<?=ALTBG2?>"><input type='text' name="newcvar" size="20"></td>
<td bgcolor="<?=ALTBG1?>"><textarea name="newcsubst" cols="50" rows="2"></textarea></td>
</tr></table><br>
<?

			echo "<br><center><input type=\"submit\" name=\"editsubmit\" value=\"$lang[submit]\"></center></form>";

		} else {

			if($newcvar && $newcsubst) {
				$query = $db->query("SELECT COUNT(*) FROM {$tablepre}stylevars WHERE variable='$newcvar' AND styleid='$edit'");
				if($db->result($query, 0)) {
					cpmsg('styles_edit_variable_duplicate');
				} elseif(!preg_match("/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/", $newcvar)) {
					cpmsg('styles_edit_variable_illegal');
				}

				$db->query("INSERT INTO {$tablepre}stylevars (styleid, variable, substitute)
					VALUES ('$edit', '$newcvar', '$newcsubst')");
			}

			$db->query("UPDATE {$tablepre}styles SET name='$namenew', templateid='$templateidnew' WHERE styleid='$edit'");
			foreach($stylevar as $id => $substitute) {
				$db->query("UPDATE {$tablepre}stylevars SET substitute='$substitute' WHERE stylevarid='$id' AND styleid='$edit'");
			}

			if(is_array($delete)) {
				$ids = $comma = '';
				foreach($delete as $id) {
					$ids .= "$comma'$id'";
					$comma = ', ';
				}
				$db->query("DELETE FROM {$tablepre}stylevars WHERE stylevarid IN ($ids) AND styleid='$edit'");
			}

			updatecache('styles');
			cpmsg('styles_edit_succeed', 'admincp.php?action=styles');

		}

	}

}

?>