var dealMessage = {
};

dealMessage.bindInitEvent = function(){
	var _self = this;
	$(".msg a").live('click', function(){
		if($("#msg_detail" + $(this).attr('msg_id')).css('display') == 'none') {
			$("#msg_detail" + $(this).attr('msg_id')).show();
		} else {
			$("#msg_detail" + $(this).attr('msg_id')).hide();
		}
	});
	$("#select_all").click(
		function() {
			if($(this).attr('checked') == 'checked') {
				$("#result_table input[name=msg_id]").each(function() {
	 				$(this).attr('checked', true);
				});
			} else {
				$("#result_table input[name=msg_id]").each(function() {
	 				$(this).attr('checked', false);
				});
			}
		}
	);
	$(".setflag a").live('click', function(){
		CSI.loadingShow();
		url = '/json.php?biz=service&mod=mywork&act=setFlag';
		$.ajax({
			url	 : url,
			type 	 : 'POST',
			dataType : 'json',
			data	 : {id: $(this).attr('msg_id')},
			success  : function(data){
				CSI.loadingHide();
				if(0 == data.errno){
					var id= data.data;
					$("#setflag_link" + id).html("已处理");
					$("#setflag_link" + id).parents().find("sefflag").removeClass('setflag');
					$("#msg_title" + id).removeClass('unview');
				}else{	
					CSI.msgBox2("系统问题，请重新查询");
				}
			}
		});
	});
	
	$("#unread_filter").click(function(){
		CSI.loadingShow(true);
		if ($("#filter").val() == 0) {
			$("#filter").val("1");
			$(this).html("查看所有信息");
		} else {
			$("#filter").val("0");
			$(this).html("只看未处理信息");
		}
		var data = {filter: $("#filter").val()};
		_self.getInfo(data);
	});
	
}

dealMessage.bindSubmitEvent = function(){
	var _self = this;
	$("#read_all_btn").click(function() {
		url = '/json.php?biz=service&mod=mywork&act=msgReadAll';
		$.ajax({
			url	 : url,
			type 	 : 'POST',
			dataType : 'json',
			data	 : {username: dealMessage.getUsername },
			success  : function(data){
				CSI.loadingHide();
				if(0 == data.errno){
					dealMessage.getInfo();
				}else{	
					CSI.msgBox2("系统问题，请重新查询");
				}
			}
		});
	});
	
	$("#delete_btn").click(function(){
		CSI.confirmBox("确认删除这些消息吗？", function(laydom) {
			var ids = new Array();
			$("#result_table input[type='checkbox']").each(function() {
				if ($(this).attr('checked') == 'checked') {
					ids.push($(this).val());
				}
			});
			if (ids.length < 1) {
				CSI.msgBox2("请选择要处理的消息");
			} else {
				var id = ids.join(",");
				CSI.loadingShow(true);
				url = '/json.php?biz=service&mod=mywork&act=msgDel';
				$.ajax({
					url	 : url,
					type 	 : 'POST',
					dataType : 'json',
					data	 : {id: id},
					success  : function(data){
						CSI.loadingHide();
						if(0 == data.errno){
							 $("#select_all").attr('checked', false);
							dealMessage.getInfo();
						}else{	
							CSI.msgBox2("系统问题，请重新查询");
						}
					}
				});
			}
			laydom.remove();
		});
	});
	
	$("#readed_btn").click(function(){
		var ids = new Array();
		$("#result_table input[type='checkbox']").each(function() {
				if ($(this).attr('checked') == 'checked') {
					ids.push($(this).val());
				}
		});
		if (ids.length < 1) {
			CSI.msgBox2("请选择要处理的消息");
		} else {
			var id = ids.join(",");
			CSI.loadingShow(true);
			url = '/json.php?biz=service&mod=mywork&act=setFlag';
			$.ajax({
				url	 : url,
				type 	 : 'POST',
				dataType : 'json',
				data	 : {id: id},
				success  : function(data){
					CSI.loadingHide();
					if(0 == data.errno){
						for(var i = 0; i < ids.length; i ++){
						  $("#setflag_link" + ids[i]).html("已处理");
						  $("#setflag_link" + ids[i]).parents().find("sefflag").removeClass('setflag');
						  $("#msg_title" + ids[i]).removeClass('unview');
						 }
						 $("#result_table input[name=msg_id]").each(function() {
	 						$(this).attr('checked', false);
						 });
						 $("#select_all").attr('checked', false);
					}else{	
						CSI.msgBox2("系统问题，请重新查询");
					}
				}
			});
		}
	});
};



dealMessage._render_data = function (data) {
	CSI.loadingHide();
	$("#msg_title").html("我的消息提醒 (共" + data.total + "条信息，其中未处理" + data.unread_total + "条)");
	if(data.list.length > 0){
		var html = '';
		for(var i = 0; i < data.list.length; i ++){
			html += '<tr class="item ' + (data.list[i].has_read== 0 ? 'unview': '') + '" id="msg_title' + data.list[i].id + '"> ' +
						'<td class="cbox"><input type="checkbox" name="msg_id" value="' + data.list[i].id + '"></td> ' +
						'<td class="msg"><a href="##" msg_id="' + data.list[i].id+ '">' + data.list[i].title + '</a></td> ' +
						'<td class="time">' +  dealMessage.timeFormat(data.list[i].create_time,'y-m-d h:i:s') + '</td> ' +
					'</tr>' +
					'<tr class="cont" style="display:none" id="msg_detail' + data.list[i].id + '">' +
						'<td class="cbox"></td>' +
						'<td class="msg_detail">' + data.list[i].msg_detail + '</td>' +
						'<td class="time setflag"><a id="setflag_link' + data.list[i].id + '" href="##" msg_id="' + data.list[i].id+ '">标记为已处理</a></td>' +
					'</tr>';
		}
		$("#result_table").empty().append(html);
		$(".msg_detail a").each(function(){
			$(this).attr("target", "_blank");
		});
		var paginator_html = getPageHTML("javascript:dealMessage.goPage({page})", data.page, data.pages, 5);
		$("#paginator").empty().html(paginator_html);
	} else {
		var html = "<tr><td>没有未读消息</td></tr>";
		$("#result_table").empty().append(html);
		$("#paginator").empty();
	}
}

dealMessage.goPage = function(page) {
	 var data = {
		filter: $("#filter").val(),
		page: page
	};
	dealMessage.getInfo(data);
};


dealMessage.getCookie = function(name) {
	//读取COOKIE
	var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"), val = document.cookie.match(reg);
	return val ? (val[2] ? unescape(val[2]) : "") : null;
};


dealMessage.getUsername = function(){
	//返回当前登陆用户的用户名 ,没有则返回""
	var username = dealMessage.getCookie("username");
	return username ? username : "";
};

dealMessage.strToDate = function(str){
	if(!str) return null;

	var regUserDate = /(\d{4})-(\d{2})-(\d{2})(?:(?:\s)+(\d{2}):(\d{2})(?::(\d{2}))?)?/;
	var dates = str.match(regUserDate);
	if(dates){
		dates[4] = dates[4] || 0 ;
		dates[5] = dates[5] || 0 ;
		dates[6] = dates[6] || 0 ;
	}
	return new Date(dates[1], dates[2]-1, dates[3], dates[4], dates[5], dates[6]);
};

/**
 * 时间戳转换成时间对象
 */
dealMessage.timeFormat= function(ts, fstr) {
	var d = this.getTimeInfo(ts);
	var r = {
		y: d.year,
		m: d.month,
		d: d.date,
		h: d.hour,
		i: d.minute,
		s: d.sec,
		w: d.week
	};
	$.each(r, function(k, v){
		if(k != 'y' && v < 10) r[k] = '0' + v;
	});
	return fstr.replace(/(?!\\)(y|m|d|h|i|s|w)/gi,
	function(a0, a1) {
		return r[a1.toLowerCase()];
	});
}

dealMessage.QueryString = function(item){
  var svalue = window.location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
  return svalue ? svalue[1] : svalue;
}

dealMessage.getInfo = function(data){
	var getUrl = '/json.php?biz=service&mod=mywork&act=message';
	getUrl += '&t='+Math.random();
	CSI.loadingShow(true);
	$.ajax({
	    type: "POST",
	    url: getUrl,
	    data: data,
	    dataType: "jsonp",
	    success: function(data){
			if(data.errno == 0 && data.data != false){
				dealMessage._render_data(data.data);
			}else{
				CSI.msgBox2("失败！");
			}			
	    }
	});
};

dealMessage.getTimeInfo = function(t) {
	var week = ["星期天", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
	var d = new Date(t * 1000);
	return {
		year: d.getFullYear(),
		month: d.getMonth() + 1,
		date: d.getDate(),
		hour: d.getHours(),
		minute: d.getMinutes(),
		sec: d.getSeconds(),
		week: week[d.getDay()]
	};
}
dealMessage.init = function(){
	this.username = this.getCookie('username');
	if(this.username == null || this.username == ""){
		alert("请首先登录！");
		return;
	 }
	 data = {};
	this.bindInitEvent();
	this.bindSubmitEvent();
	this.getInfo(data);
}

var strToDate = function(str){
	if(!str) return null;

	var regUserDate = /(\d{4})-(\d{2})-(\d{2})(?:(?:\s)+(\d{2}):(\d{2})(?::(\d{2}))?)?/;
	var dates = str.match(regUserDate);
	if(dates){
		dates[4] = dates[4] || 0 ;
		dates[5] = dates[5] || 0 ;
		dates[6] = dates[6] || 0 ;
	}
	return new Date(dates[1], dates[2]-1, dates[3], dates[4], dates[5], dates[6]);
};

function getPageHTML(url, currentPage, pageCount, neighborLength){
	url += '';
	currentPage -= 0;
	pageCount -= 0;
	neighborLength = neighborLength || 3;

	if(pageCount < 2 )
		return "";
	var start = currentPage  - neighborLength, end = currentPage + neighborLength;
		str = "";;
	if(start <= 4){
		start = 2;
	}
	start = start > 1 ? start : 2;
	end = end < pageCount ? (end < currentPage ? currentPage : end) : ( pageCount - 1 );

	var linkAttr = "";
	if(url.indexOf('javascript:') == 0){
		linkAttr = ' href="#" onclick="' + url.substr(11) + ';return false"';
	} else {
		linkAttr = ' href="' + url + '"';
	}
	//上一页
	str += '<a class="btn' + (currentPage == 1 ? ' page-start" href="#" onclick="return false"' : ('"' + linkAttr.replace(/\{page\}/g, currentPage - 1))) + '><i>&lt;</i>上一页</a>';

	//第一页
	str += '<a' + (currentPage == 1 ? ' class="page-this"' : '') + linkAttr.replace(/\{page\}/g, 1) + '>1</a>';

	if( start != 2 )
		str += '<span class="dot">...</span>';

	for(var i = start; i < end + 1; i++){
		str += '<a' + (currentPage == i ? ' class="page-this"' : '') + linkAttr.replace(/\{page\}/g, i) + '>' + i + '</a>';
	}
  
	if( end != pageCount - 1 )
		str += '<span class="dot">...</span>';
  
	//最后一页
	str += '<a' + (currentPage == pageCount ? ' class="page-this"' : '') + linkAttr.replace(/\{page\}/g, pageCount) + '>' + pageCount + '</a>';

	//下一页
	str += '<a class="btn' + (currentPage == pageCount ? ' btn_disabled" href="#" onclick="return false"' : (' page-next"' + linkAttr.replace(/\{page\}/g, currentPage + 1))) + '>下一页<i>&gt;</i></a>';

	//输入框跳转
	//var jumpStr = url.indexOf('javascript:') == 0 ? "$.globalEval('" + url.substr(11).replace(/'/g, '\\\'').replace(/\{page\}/g, "'+a+'") + "')" : ('location.href=\''+url.replace(/'/g, '\\\'').replace(/\{page\}/g, "'+a+'")+'\''),
	//	fnStr = 'var a=parseInt($(\'input[name=iptpage]\',$(this).parent()).val(),10);a=(!!a&&a>0&&a<=' + pageCount + ')?a:1;' + jumpStr+';';

	//str += '<span class="page-skip"> 到第<input type="text" value="' + currentPage + '" maxlength="3" name="iptpage" onkeydown="if(event.keyCode==13){$(\'button[name=go]\',$(this).parent()).click();return false;}">页<button name="go" value="go" onclick="'+fnStr+'return false">确定</button></span>';

	return str;
};
$(document).ready(function() {
	dealMessage.init();
});
