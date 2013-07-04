var dealOvertime= {
	APPLY_TYPE : {
		0: "全部",
		1: "订单催办",
		2: "订单修改",
		3: "订单取消",
		4: "投诉建议",
		5: "问题咨询",
		6: "建议表扬",
		8: "预约服务",
		9: "评论导入"
	},
	APPLY_SUBTYPE: {
		201 : '修改收货信息',
        202 : '修改发票抬头',
        203 : '修改收货时间',
        401 : '投诉-商品问题',
        402 : '投诉-订单问题',
        403 : '投诉-物流问题',
        404 : '投诉-售后问题',
        405 : '投诉-活动问题',
        406 : '投诉客服',
        407 : '投诉其它',
        501 : '活动咨询',
        502 : '其它咨询',
        601 : '建议',
        602 : '表扬'
	},
	APPLY_STATE: {
		0: "全部",
		1: "待处理",
		2: "处理中",
		3: "已解决"
	},
	APPLY_SOURCE: {
		0: "全部",
		1: "WEB",
		2: "IVR"
	},
	APPLY_CHECKUP: {
		0: "全部",
		1: "优",
		2: "良",
		3: "差"
	},
	APPLY_APPROVE: {
		0: "全部",
		1: '非常满意',
	    2: '很满意',
	    3: '不满意',
	    4: '很不满意'
	}
};

dealOvertime.bindInitEvent = function(){
	var _self = this;
	$('.up_down').click(
		function() {
			if($(this).children(".ecc_mod_box_down").css("display") == 'block') {
				$(this).children(".ecc_mod_box_down").hide();
				$(this).children(".ecc_mod_box_up").show();
	        	$(this).parent().find(".ecc_mod_box_bd").show();
			} else {
				$(this).children(".ecc_mod_box_up").hide();
				$(this).children(".ecc_mod_box_down").show();
	        	$(this).parent().find(".ecc_mod_box_bd").hide();
			}
		}
		
	);
	
	$(".ecc_result_detail").live("click", function(event){
		var position = $(this).offset();
		var html = $(this).html();
		if (html) {
			html += "&nbsp;&nbsp;<a target='_blank' href='/index.php?biz=service&mod=deal&act=detail&id=" + $(this).attr("rid") + "'>回复>></a>";
		}
		$("#deal_detail").html(html);
		$("#deal_detail").css("left", position.left + "px").css("top", (position.top +10) + "px");
		$("#deal_detail").show();
		
		$(document).on("click", function () {
			$("#deal_detail").hide();
		});
		event.stopPropagation();
		event.preventDefault();
		return false;
		
	});
	
	$("#deal_detail").click(
		function(event){
			// event.stopPropagation();
			// event.preventDefault();
			// return false;
		}
	);
	
	$("#result_export").click(function() {
		url = '/json.php?biz=service&mod=mywork&act=overtimeExport';
		var data = {
			//type: $("#unsolved_filter_type").val(),
			state: $("#unsolved_filter_state").val(),
			expire: $("#unsolved_filter_expire").val(),
			reply_state:	$("#unsolved_filter_reply_state").val(),
			flag:	$("#unsolved_filter_flag").val()
		};
		var fields = new Array();
		$("#fields_checkbox input[type='checkbox']:checked").each(function() {
		 	fields.push($(this).val());
		});
		data.fields = fields.join(",");
		if ($("#check_all_subtype").attr('checked') == 'checked') {
			data.type = '';
		} else {
			var selected_types = new Array();
			$("#subtype_box input[name='deal_type']:checked").each(function() {
			 	selected_types.push($(this).val());
			});
			data.type = selected_types.join(",");
		}
		for (var k in data) {
			url += "&" + k + "=" + encodeURIComponent(data[k]);
		}
		window.location.href = url;
	});

	$("#unsolved_reset_btn").click(function(){
		$("#unsolved_search_table input").val('');
		$("#unsolved_search_table select").val('');
		$("#subtype_box input[name='deal_type']").attr('checked', false);
	});
	
	$("#reassign_type1").click(function(){
		$("#input_kf_rtx").show();
		$("#group_list").hide();
	});
	$("#reassign_type2").click(function(){
		$("#input_kf_rtx").hide();
		$("#group_list").show();
	});
	
	$("#reassign_submit_btn").click(function(){
		var ids = new Array();
		$("#search_result_table input[type='checkbox']").each(function() {
			if ($(this).attr('checked') == 'checked') {
				ids.push($(this).val());
			}
		});
		if(ids.length < 1) {
			alert('选择工单');
		} else {
			url = '/json.php?biz=service&mod=deal&act=reassign';
			data = {
				id:ids.join(","),
				flag:$("#reassign_flag").val()
			}
			if ($("#reassign_type1").attr('checked') == 'checked') {
				data.type = 1;
				data.assign_target = $("#kf_rtx").val();
			} else {
				data.type =2;
				//只选一个分组
				$("#group_list input[type='checkbox']:checked").each(function() {
				 	data.assign_target = $(this).val();
				});
			}
			//CSI.loadingShow();
			$.ajax({
				url	 : url,
				type 	 : 'POST',
				dataType : 'json',
				data	 : data,
				success  : function(data){
					
					if(0 == data.errno){
						CSI.loadingHide();
						CSI.msgBox2('转单成功');
						$("#reassign_zone").hide();
						dealOvertime.getInfo();
					}else{	
						$("#reassign_zone .msg-tips").html(data.msg);
					}
				}
			});
		}
	});
	
	$("#reassign_urge_btn").click(function() {
		dealOvertime.assign();
		$("#reassign_flag").val('1');
	});
	$("#reassign_btn").click(function(){
		dealOvertime.assign();
	});
	
	$("#select_all").click(
		function() {
			if($(this).attr('checked') == 'checked') {
				$("#search_result_table input[name=deal_id]").each(function() {
	 				$(this).attr('checked', 'checked');
				});
			} else {
				$("#search_result_table input[name=deal_id]").each(function() {
	 				$(this).attr('checked', false);
				});
			}
		}
	);
	
}

dealOvertime.bindSubmitEvent = function(){
	var _self = this;
	
	$("#reassign_zone .mod_pop_close").click(function(){
		CSI.loadingHide();
		$("#reassign_zone").hide();
	});
	
	$("#unsolved_search_btn").click(function(){
		var data = {
			//type: $("#unsolved_filter_type").val(),
			state: $("#unsolved_filter_state").val(),
			expire: $("#unsolved_filter_expire").val(),
			reply_state:	$("#unsolved_filter_reply_state").val(),
			flag:	$("#unsolved_filter_flag").val(),
			page: 1	
		};
		_self.search(data);
	});
	
	$("#filter_field_btn").click(function(){
		var data = {
			//type: $("#unsolved_filter_type").val(),
			state: $("#unsolved_filter_state").val(),
			expire: $("#unsolved_filter_expire").val(),
			reply_state:	$("#unsolved_filter_reply_state").val(),
			flag:	$("#unsolved_filter_flag").val(),
			page: 1	
		};
		_self.search(data);
	});
	
	$(".ecc_mod_btn2").click(
		function() {
			if($("#order_by").val() != $(this).attr("ob")) {
				$("#order_by").val($(this).attr("ob"));
				$("#order_dir").val($(this).attr("obdir"));
			} else {
				if ($(this).attr("obdir") == "DESC") {
					$("#order_dir").val("ASC");
				} else {
					$("#order_dir").val("DESC");
				}
			}
			
			
			var data = {
				//type: $("#unsolved_filter_type").val(),
				state: $("#unsolved_filter_state").val(),
				expire: $("#unsolved_filter_expire").val(),
				reply_state:	$("#unsolved_filter_reply_state").val(),
				flag:	$("#unsolved_filter_flag").val(),
				page: 1	
			};
			_self.search(data);
	});
	
};

dealOvertime.assign = function() {
	var ids = new Array();
		$("#search_result_table input[type='checkbox']").each(function() {
			if ($(this).attr('checked') == 'checked') {
				ids.push($(this).val());
			}
		});
		if(ids.length < 1) {
			CSI.msgBox2('请选择工单');
		} else {
			CSI.loadingShow();
			var dom = $("#reassign_zone");
			dom.css({"z-index": CSI.zindex});
			CSI.zindex++;
			dom.center();
			//拖动
			dom.draggable();
			$("#kf_rtx").val('');
			$("#reassign_zone .msg-tips").empty();
			$("#reassign_zone").show();
			url = '/json.php?biz=admin&mod=group&act=getallgroups';
			$.ajax({
					url	 : url,
					type 	 : 'GET',
					dataType : 'json',
					success  : function(data){
						if(0 == data.errno){
							var html = '<p>选择要转单的组:</p>';
							for(var i = 0; i < data.data.length; i++) {
								html+= '<label><input type="checkbox" name="group_id" value="' + data.data[i].gid + '">' + data.data[i].name + "</label>";
							}
							$("#group_list").empty().append(html);
						}else{	
							alert("系统问题，请重新查询");
						}
					}
			});
		}
}
dealOvertime.search = function(data) {
	var url = '';
	var fields = new Array();
	$("#fields_checkbox input[type='checkbox']:checked").each(function() {
	 	fields.push($(this).val());
	});
	data.fields = fields.join(",");
	data.order_by = $("#order_by").val();
	data.order_dir = $("#order_dir").val();
	if ($("#check_all_subtype").attr('checked') == 'checked') {
		data.type = '';
	} else {
		var selected_types = new Array();
		$("#subtype_box input[name='deal_type']:checked").each(function() {
		 	selected_types.push($(this).val());
		});
		data.type = selected_types.join(",");
	}
	url = '/json.php?biz=service&mod=mywork&act=overtime';
	CSI.loadingShow();
	$.ajax({
			url	 : url,
			type 	 : 'POST',
			dataType : 'json',
			data	 : data,
			success  : function(data){
				if(0 == data.errno){
					dealOvertime._render_data(data.data);
				}else{	
					alert("系统问题，请重新查询");
				}
			}
		});
};

dealOvertime._render_data = function (data) {
	CSI.loadingHide();
	$("#search_result_table tr").remove();
	var html = '';
	var fields_map = data.fields_map;
	$("#fields_checkbox input[type='checkbox']").each(function() {
	 	for (var k in fields_map) {
			if (k == $(this).val()) {
				$(this).attr('checked', true);
				break;
			}
		}
	});
	$("#order_by").val(data.order_by);
	$("#order_dir").val(data.order_dir);
	$("#result_sort .ecc_mod_btn2").each(function() {
		var order_by = $(this).attr("ob");
		if (order_by == (data.order_by + "")) {
			$(this).addClass("selected");
			$(this).attr("obdir", data.order_dir);
			if (data.order_dir == 'DESC') {
				$(this).children("i").removeClass("ecc_mod_icon_up");
				$(this).children("i").addClass("ecc_mod_icon_down");
			} else {
				$(this).children("i").removeClass("ecc_mod_icon_down");
				$(this).children("i").addClass("ecc_mod_icon_up");
			}
		} else {
			$(this).removeClass("selected");
		}
	});
	if(data.list.length > 0){
		var head_html = '<tr>';
		for (var k in fields_map) {
			if(k == 'id') {
				head_html += '<th class="first_fix">' + fields_map[k] + '</th>';
			} else {
				head_html += '<th>' + fields_map[k] + '</th>';
			}
		}
		head_html += '</tr>';
		$("#search_result_table").append(head_html);
		for(var i = 0; i < data.list.length; i ++){
			html += '<tr>';
			for (var k in fields_map) {
				switch (k) {
					case 'id':
						html += '<td class="first_fix"><input type="checkbox" name="deal_id" value="' + data.list[i][k] + '"><a href="index.php?biz=service&mod=deal&act=detail&id=' + data.list[i][k] + '" target="_blank">' + data.list[i][k] + '</a></td>';
						break;
					case 'flag':
						html += '<td>' + (data.list[i][k] > 0 ? '催办' : '') + '</td>';;
						break;
					case 'type':
						if (data.list[i][k] > 100) {
							html += '<td>' + dealOvertime.APPLY_SUBTYPE[data.list[i][k]] + '</td>';
						} else {
							html += '<td>' + dealOvertime.APPLY_TYPE[data.list[i][k]] + '</td>';
						}
						break;
					case 'state':
						html += '<td>' + dealOvertime.APPLY_STATE[data.list[i][k]] + '</td>';
						break;
					case 'checkup':
						html += '<td>' + dealOvertime.APPLY_CHECKUP[data.list[i][k]] + '</td>';
						break;
					case 'source':
						html += '<td>' + dealOvertime.APPLY_SOURCE[data.list[i][k]] + '</td>';
						break;
					case 'approve':
						html += '<td>' + dealOvertime.APPLY_APPROVE[data.list[i][k]] + '</td>';
						break;
					case 'isVip':
						html += '<td>' + (data.list[i][k] > 0 ?'是' : '否') + '</td>';
						break;
					case 'createTime':
						html += '<td>' + dealOvertime.timeFormat(data.list[i][k],'y-m-d h:i:s') + '</td>';
						break;
					case 'finishTime':
					case 'nextTime':
					case 'acceptTime':
						if (data.list[i][k] > 0) {
							html += '<td>' + dealOvertime.timeFormat(data.list[i][k],'y-m-d h:i:s') + '</td>';
						} else {
							html += '<td></td>';
						}
						break;
					case 'content':
						html += '<td><div class="ecc_result_detail"  rid="' + data.list[i].id + '" title="' + data.list[i].content + '">' + data.list[i].content +  '</div></td>';
						break;
					default:
						html += '<td>' + data.list[i][k] + '</td>';	
				}
			}
			html += '</tr>';
			$("#search_result_div").removeClass("ecc_noresult_table");
			}
	} else {
		html = '<tr><td >无查询结果</td></tr>';
		$("#search_result_div").addClass("ecc_noresult_table");
	}
	$("#search_result_table").append(html);
	var paginator_html = getPageHTML("javascript:dealOvertime.goPage({page})", data.page, data.pages, 5);
	$("#paginator").empty().html(paginator_html);
}

dealOvertime.goPage = function(page) {
	 var data = {
		//type: $("#unsolved_filter_type").val(),
		state: $("#unsolved_filter_state").val(),
		expire: $("#unsolved_filter_expire").val(),
		reply_state:	$("#unsolved_filter_reply_state").val(),
		flag:	$("#unsolved_filter_flag").val(),
		page: page
	};
	dealOvertime.search(data);
};


dealOvertime.getCookie = function(name) {
	//读取COOKIE
	var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"), val = document.cookie.match(reg);
	return val ? (val[2] ? unescape(val[2]) : "") : null;
};


dealOvertime.getUsername = function(){
	//返回当前登陆用户的用户名 ,没有则返回""
	var username = this.getCookie("username");
	return username ? username : "";
};

dealOvertime.strToDate = function(str){
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
dealOvertime.timeFormat= function(ts, fstr) {
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

dealOvertime.QueryString = function(item){
  var svalue = window.location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
  return svalue ? svalue[1] : svalue;
}

dealOvertime.getInfo = function(){
	var getUrl = '/json.php?biz=service&mod=mywork&act=overtime';
	getUrl += '&t='+Math.random();
	CSI.loadingShow(true);
	$.ajax({
	    type: "POST",
	    url: getUrl,
	    dataType: "jsonp",
	    success: function(data){
	    	CSI.loadingHide();
			if(data.errno == 0 && data.data != false){
				dealOvertime._render_data(data.data);
			}else{
				alert("失败！");
			}			
	    }
	});
};

dealOvertime.getTimeInfo = function(t) {
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
dealOvertime.init = function(){
	this.username = this.getCookie('username');
	if(this.username == null || this.username == ""){
		alert("请首先登录！");
		return;
	 }
	this.bindInitEvent();
	this.bindSubmitEvent();
	this.getInfo();
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
	str += '<a class="btn' + (currentPage == 1 ? ' btn_disabled" href="#" onclick="return false"' : (' page-start"' + linkAttr.replace(/\{page\}/g, currentPage - 1))) + '><i>&lt;</i>上一页</a>';

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
	dealOvertime.init();
});