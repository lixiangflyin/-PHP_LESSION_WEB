<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>

<form method="post" action="pm.php?action=archive" target="_blank">
<input type="hidden" name="formhash" value="<?=FORMHASH?>">

<table cellspacing="<?=INNERBORDERWIDTH?>" cellpadding="<?=TABLESPACE?>" width="99%" class="tableborder">

<tr>
<td class="header" colspan="2">导出短消息</td>
</tr>

<tr>
<td valign="top" class="altbg1">删除:</td>
<td class="altbg2"><input type="checkbox" name="delete" value="1"> 导出后删除短消息</td>
</tr>

<tr>
<td class="altbg1" width="15%">文件夹:</td>
<td class="altbg2" width="75%"><input type="radio" name="folder" value="inbox" checked> 收件箱 &nbsp; <input type="radio" name="folder" value="outbox"> 发件箱</td>
</tr>

<tr>
<td class="altbg1">时间范围:</td>
<td class="altbg2"><select name="days">
<option value="1">1 天</option>
<option value="2">2 天</option>
<option value="7">1 周</option>
<option value="30">1 个月</option>
<option value="90">3 个月</option>
<option value="180">6 个月</option>
<option value="365">1 年</option>
<option value="0">全部</option>
</select> <select name="newerolder">
<option value="newer">以来</option>
<option value="older">以前</option>
</select></td>
</tr>

<tr>
<td class="altbg1">导出短消息数量:</td>
<td class="altbg2"><select name="amount">
<option value="10">10</option>
<option value="20">20</option>
<option value="30">30</option>
<option value="40">40</option>
<option value="50">50</option>
<option value="0">全部</option>
</select></td>
</tr>

</table>
<br><table cellspacing="0" cellpadding="0" width="99%">
<tr><td align="center"><input type="submit" name="archivesubmit" value="提 &nbsp; 交"></td></tr>
</table>
</form>