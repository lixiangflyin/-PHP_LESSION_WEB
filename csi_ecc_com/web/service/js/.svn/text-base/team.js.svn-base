var teamWork = {
	kf:''
};

teamWork.bindInitEvent = function(){
	var _self = this;
	$("#group").change(function(){
		var data = {
						group_id: $(this).val()
					};
		$("#member_work_zone").hide();
		_self.getInfo(data);
		
	});
	$(".first_fix a").live("click", function(){
		var uid = $(this).attr('uid');
		_self.kf = uid;
		$("#member_work_zone").show();
		$("#member_work_title").html(uid + "今日工作流水");
		var url = '/json.php?biz=service&mod=team&act=memberWork';
		url += '&t='+Math.random();
		var data = {'kf' : uid};
		CSI.loadingShow(true);
		$.ajax({
		    type: "POST",
		    url: url,
		    data: data,
		    dataType: "jsonp",
		    success: function(data){
				if(data.errno == 0 && data.data != false){
					CSI.loadingHide();
					var html = '';
					for(var i = 0; i < data.data.list.length; i ++) {
						html += '<li><span class="time">' + data.data.list[i].create_time + '</span>' + data.data.list[i].detail + '</li>';
					}
					$("#member_work_list").empty().append(html);
					var paginator_html = getPageHTML("javascript:teamWork.goPage({page})", data.data.page, data.data.pages, 5);
					$("#paginator").empty().html(paginator_html);	
				}else{
					CSI.loadingHide();
					$("#member_work_list").empty().html('<li>暂无今日工作流水</li>');
				}			
		    }
		});
		$("#member_work_zone").show();
	});
	
}

teamWork.bindSubmitEvent = function(){
	var _self = this;
	
};



teamWork._render_data = function (data) {
	CSI.loadingHide();
	if(data.groups.length > 0) {
		var option_html = '<option value="">全部</option>';
		for(var i = 0; i < data.groups.length; i ++){
			option_html += '<option value="' + data.groups[i].gid + '"' + (data.groups[i].gid == data.selected_group )+ '>' + data.groups[i].name  + '</option>'
		}
		$("#group").empty().append(option_html);
	}
	if(data.list.length > 0){
		var html = '<tr><th class="first_fix">姓名</th><th>待处理</th><th>处理中回复</th><th>处理中待用户回复</th><th>已处理</th><th>催单</th><th>处理超时</th><th>结单超时</th></tr>';
		for(var i = 0; i < data.list.length; i ++) {
			html += '<tr>' +
						'<td class="first_fix">' +
						'	<a href="##" uid=' + data.list[i].rtx_id + '>' + data.list[i].rtx_id + '</a>' +
						'</td>' +
						'<td><a href="/page.php?menu=0&biz=service&mod=deal&act=list&uid=' + data.list[i].rtx_id + '&type=undeal" target="_blank">' + data.list[i].undeal_count + '</a></td>' +
						'<td><a href="/page.php?menu=0&biz=service&mod=deal&act=list&uid=' + data.list[i].rtx_id + '&type=deal1" target="_blank">' + data.list[i].dealing_count + '</a></td>' +
						'<td><a href="/page.php?menu=0&biz=service&mod=deal&act=list&uid=' + data.list[i].rtx_id + '&type=deal2" target="_blank">' + data.list[i].dealing_count2 + '</a></td>' +
						'<td><a href="/page.php?menu=0&biz=service&mod=deal&act=list&uid=' + data.list[i].rtx_id + '&type=dealed" target="_blank">' + data.list[i].dealed_count + '</a></td>' +
						'<td><a href="/page.php?menu=0&biz=service&mod=deal&act=list&uid=' + data.list[i].rtx_id + '&type=urge" target="_blank">' + data.list[i].urge_deal_count + '</a></td>' +
						'<td><a href="/page.php?menu=0&biz=service&mod=deal&act=list&uid=' + data.list[i].rtx_id + '&type=expire1" target="_blank">' + data.list[i].deal_expire_count + '</a></td>' +
						'<td><a href="/page.php?menu=0&biz=service&mod=deal&act=list&uid=' + data.list[i].rtx_id + '&type=expire2" target="_blank">' + data.list[i].finish_expire_count + '</a></td>' +
					'</tr>';
		}
		$("#result_table").empty().append(html);
	} else {
		alert("分组内没有用户");
	}
	
}

teamWork.goPage = function(page) {
	 var data = {
		page: page,
		kf:teamWork.kf
	};
	var url = '/json.php?biz=service&mod=team&act=memberWork';
	url += '&t='+Math.random();
	CSI.loadingShow(true);
	$.ajax({
	    type: "POST",
	    url: url,
	    data: data,
	    dataType: "jsonp",
	    success: function(data){
			if(data.errno == 0 && data.data != false){
				CSI.loadingHide();
				var html = '';
				for(var i = 0; i < data.data.list.length; i ++) {
					html += '<li><span class="time">' + data.data.list[i].create_time + '</span>' + data.data.list[i].detail + '</li>';
				}
				$("#member_work_list").empty().append(html);
				var paginator_html = getPageHTML("javascript:teamWork.goPage({page})", data.data.page, data.data.pages, 5);
				$("#paginator").empty().html(paginator_html);	
			}else{
				CSI.loadingHide();
				$("#member_work_list").empty().html('<li>暂无今日工作流水</li>');
			}			
	    }
	});
};


teamWork.getCookie = function(name) {
	//读取COOKIE
	var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"), val = document.cookie.match(reg);
	return val ? (val[2] ? unescape(val[2]) : "") : null;
};


teamWork.getUsername = function(){
	//返回当前登陆用户的用户名 ,没有则返回""
	var username = teamWork.getCookie("username");
	return username ? username : "";
};

teamWork.strToDate = function(str){
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
teamWork.timeFormat= function(ts, fstr) {
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

teamWork.QueryString = function(item){
  var svalue = window.location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
  return svalue ? svalue[1] : svalue;
}

teamWork.getInfo = function(data){
	var getUrl = '/json.php?biz=service&mod=team&act=init';
	getUrl += '&t='+Math.random();
	CSI.loadingShow(true);
	$.ajax({
	    type: "POST",
	    url: getUrl,
	    data: data,
	    dataType: "jsonp",
	    success: function(data){
			if(data.errno == 0 && data.data != false){
				$("#search_result_div").removeClass("ecc_noresult_table");
				teamWork._render_data(data.data);
			}else{
				CSI.loadingHide();
				$("#search_result_div").addClass("ecc_noresult_table");
				$("#result_table").empty().html('<tr><td style="width:100%">没有数据</td></tr>');
			}			
	    }
	});
};

teamWork.getTimeInfo = function(t) {
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
teamWork.init = function(){
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
	str += '<a class="btn' + (currentPage == 1 ? ' page-start" href="#" onclick="return false"' : (' "' + linkAttr.replace(/\{page\}/g, currentPage - 1))) + '><i>&lt;</i>上一页</a>';

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
	teamWork.init();
});