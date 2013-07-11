<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>

<form method="post" onSubmit="if(this.srchtype[0].value=='qihoo' && this.srchtype[0].checked) this.target='_blank'; else this.target=''; return true;">
<input type="hidden" name="formhash" value="<?=FORMHASH?>">

<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="99%" class="tableborder">

<tr class="header">
<td>关键字</td>
<td><a href="member.php?action=credits&view=search" target="_blank"><img src="<?=IMGDIR?>/credits.gif" alt="查看积分策略说明" align="right" border="0"></a>发信人或收信人</td>
</tr>

<tr class="smalltxt">
<td class="altbg2" width="60%">
<input type="text" name="srchtxt" size="25" maxlength="40">
&nbsp; &nbsp;关键字中可使用通配符 "*"<br><br>匹配多个关键字全部，可用空格或 "AND" 连接。如 win32 AND unix<br>匹配多个关键字其中部分，可用 "|" 或 "OR" 连接。如 win32 OR unix</td>

<td class="altbg2" width="40%"><input type="text" name="srchuname" size="25" maxlength="40">
<br><br>发信人或收信人用户名中可使用通配符 "*"，如 *user*</td>
</tr>

<tr class="header"><td>搜索范围</td><td>排序类型</td></tr>

<tr class="smalltxt">
<td class="altbg2">

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="smalltxt">
<tr valign="top">

<td width="50%">
<select name="srchfolder">
<option value="inbox">收件箱</option>
<option value="outbox">发件箱</option>
<option value="track">消息跟踪</option>
</select><br><br>
</td>

<td>
<select name="srchfrom">
<option value="0">全部时间</option>
<option value="86400">1 天前</option>
<option value="172800">2 天前</option>
<option value="432000">1 周前</option>
<option value="1296000">1 个月前</option>
<option value="5184000">3 个月前</option>
<option value="8640000">6 个月前</option>
<option value="31536000">1 年前</option>
</select><br><br>
</td></tr>

<tr valign="bottom">
<td>
<table cellspacing="0" cellpadding="0" border="0" class="smalltxt">
<tr>
<td><input type="radio" name="srchtype" value="title" checked> 标题搜索 &nbsp; </td>
<td><input type="checkbox" name="srchread" value="1" checked> 已读短消息 &nbsp; </td>
</tr><tr>
<td><input type="radio" name="srchtype" value="fulltext" <?=$ftdisabled?>> 全文搜索</td>
<td><input type="checkbox" name="srchunread" value="1" checked> 未读短消息 &nbsp; </td>
</tr>
</table></td>

<td>
<input type="radio" name="before" value="" checked> 之后<br>
<input type="radio" name="before" value="1"> 之前
</td>

</tr></table></td>

<td class="altbg2"><select name="orderby">
<option value="dateline"> 按收发时间</option>
<option value="msgfrom"> 按收发信人名</option>
</select>
<br>
<br><input type="radio" name="ascdesc" value="asc"> 按升序排列<br>
<input type="radio" name="ascdesc" value="desc" checked> 按降序排列</td>
</tr>

</table><br>
<center><input type="submit" name="searchsubmit" value="提 &nbsp; 交"></center>
</form>