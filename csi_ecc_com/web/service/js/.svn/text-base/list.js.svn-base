var dealList = {
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
        602 : '表扬',
        901 : '评论导入-满意', 
        902 : '评论导入-一般', 
        903 : '评论导入-不满意'
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
	},
	searchType	: ''
};

dealList.bindInitEvent = function(){
	var _self = this;
	$("#advanced_search_start_time").datetimepicker({hourGrid: 3,minuteGrid: 10});
	$("#advanced_search_end_time").datetimepicker({hourGrid: 3,minuteGrid: 10});
	//$("#advanced_search_start_time").ligerDateEditor({showTime: true, label: '下次跟进时间', labelWidth: 100, labelAlign: 'left'});
	//$("#advanced_search_end_time").ligerDateEditor({showTime: true, label: '下次跟进时间', labelWidth: 100, labelAlign: 'left'});
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
	// $(".ui-draggable").each(function() {
	  	// this.onselectstart = function() { return false; };
	// });
	$(".ecc_filter_up").click(
		function() {
			$(this).hide();
			$(this).parent().find(".ecc_filter_down").show();
			$("#more_filter_item").show();
		}
	);
	
	$(".ecc_filter_down").click(
		function() {
			$(this).hide();
			$(this).parent().find(".ecc_filter_up").show();
			$("#more_filter_item").hide();
		}
	);
	
	$(".ecc_result_detail").live("click", function(event){
		var position = $(this).offset();
		var html = $(this).html();
		if (html) {
			html += "&nbsp;&nbsp;<a target='_blank' href='/index.php?biz=service&mod=deal&act=detail&id=" + $(this).attr("rid") + "'>回复>></a>";
		}
		$("#deal_detail").html(html);
		$("#deal_detail").css("left", position.left + "px").css("top", (position.top - 200) + "px");
		$("#deal_detail").show();
		$(document).on("click", function () {
			$("#deal_detail").hide();
		});
		event.stopPropagation();
		event.preventDefault();
		return false;
		
	});
	
	$("#deal_detail").click(function(event){
			//event.stopPropagation();
			//event.preventDefault();
			//return false;
	});
	
	$("#archive_zone .mod_pop_close").click(function(){
		$("#archive_id_selected").val();
		$("#archive_zone").hide();
		CSI.loadingHide();
	});
	
	$(".level-1").live('click',
		function() {
			var archive_id = $(this).attr('archive_id');
			var level = 1;
			$("#archive-level-1 a").removeClass('selected');
			$(this).addClass('selected');
			if (archive_id) {
				var data = {
				id: archive_id,
				level: 1
				};
				$.ajax({
					url	 : '/json.php?biz=service&mod=deal&act=getArchive',
					type 	 : 'POST',
					dataType : 'json',
					data	 : data,
					success  : function(result){
						if(0 == result.errno){
							$("#archive-level-2").empty();
							var html = '';
							for(var i = 0; i < result.data.length; i ++){
								html += '<li><a href="##" class="level-2" archive_id="' + result.data[i].id + '">' + result.data[i].name + '</a></li>'
							}
							$("#archive-level-2").append(html);
						}else{	
							CSI.msgBox("拉取归档失败");
						}
					}
				});
			}
		}
	);
	//归档快速查询
	$("#archive_quick_search_form").submit(
		function() {
			var key = $("#archive_quick_search").val();
			if (key) {
				var data = {
				key: key
				};
				$.ajax({
					url	 : '/json.php?biz=service&mod=deal&act=getArchive',
					type 	 : 'POST',
					dataType : 'json',
					data	 : data,
					success  : function(result){
						if(0 == result.errno){
							if(result.data.length > 0) {
								var html1 = '';
								var html2 = '';
								for(var i = 0; i < result.data.length; i ++){
									if(result.data[i].id > 1000) {
										html2 += '<li><a href="##" class="level-2" archive_id="' + result.data[i].id + '">' + result.data[i].name + '</a></li>'
									} else {
										html1 += '<li><a href="##" class="level-1" archive_id="' + result.data[i].id + '">' + result.data[i].name + '</a></li>'
									}
								}
							}
							$("#archive-level-2").empty().append(html2);
							$("#archive-level-1").empty().append(html1);
							
						}else{	
							CSI.msgBox("拉取归档失败");
						}
					}
				});
			}
			return false;
		}
	);
	//二级菜单点击
	$(".level-2").live('click',
		function() {
			var archive_id = $(this).attr('archive_id');
			var level = 2;
			$("#archive-level-2 a").removeClass('selected');
			$(this).addClass('selected');
			var cur_name = $(this).html();
			
			if (archive_id) {
				var data = {
				id: archive_id,
				level: 2
				};
				$.ajax({
					url	 : '/json.php?biz=service&mod=deal&act=getArchive',
					type 	 : 'POST',
					dataType : 'json',
					data	 : data,
					success  : function(result){
						if(0 == result.errno){
							var is_exist = 0;
							$("#archive-level-1 a").removeClass('selected');
							$("#archive-level-1 a").each(function(){
								if($(this).attr('archive_id') == result.data[0].id) {
									$(this).addClass('selected');
									is_exist = 1;
								}
							});
							if (!is_exist) {
								html = '<li><a href="##" class="level-1" archive_id="' + result.data[0].id + '">' + result.data[0].name + '</a></li>';
								$("#archive-level-1").append(html);
							}
							$("#selected_archive_id").val(result.data[0].name + "--" + cur_name + ":" + archive_id);
						}else{	
							CSI.msgBox("拉取归档失败");
						}
					}
				});
			}
		}
	);
	
	$("#select_archive_btn").click(function() {
		CSI.loadingShow();
		$("#archive_zone").show();
		 var dom = $("#archive_zone");
		 dom.css({"z-index": CSI.zindex});
		 CSI.zindex++;
		 dom.center();
		 dom.draggable({
						   scroll:true,
						   start: function(){
						      $(this).data("startingScrollTop",$(this).parent().scrollTop());
						   },
						   drag: function(event,ui){
						      var st = parseInt($(this).data("startingScrollTop"));
						      ui.position.top -= $(this).parent().scrollTop() - st;
						   }
					});
		 //拖动
		 //dom.draggable({ cancel: ".ecc_mod_cyitem_bd" });
	});
	
	$("#archive_btn").click(function(){
		var selected_archive_id = $("#selected_archive_id").val();
		if(selected_archive_id) {
			var ar = selected_archive_id.split(":");
			$("#selected_archive_id").val("");
			$("#advanced_search_archive").val(ar[0]);
			$("#search_archive").val(selected_archive_id);
			$("#archive_zone").hide();
			CSI.loadingHide();
		} else {
			CSI.msgBox2("请选择二级归档路径");
		}
	});
	
	$("#result_sort .ecc_mod_btn2").click(function() {
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
			if (_self.searchType == 'advanced') {
				var data = _self.getAdvancedData();
			} else {
				var data = {
				type: $('input:radio[name="simple_search_type"]:checked').val()	,
				key : $("#simple_search_key").val(),
				page: 1
				};
			}
			_self.search(data);
	});
}

dealList.bindSubmitEvent = function(){
	var _self = this;
	$("#result_export").click(function() {
		url = '/json.php?biz=service&mod=list&act=export';
		if (_self.searchType == 'advanced') {
			var data = {
				stype: 'advanced',
				userPhone: $('#advanced_search_phone').val(),
				key : $("#advanced_search_key").val(),
				account: $("#advanced_search_account").val(),
				//type: $("#advanced_search_type").val(),
				state: $("#advanced_search_state").val(),
				start_time: $("#advanced_search_start_time").val(),
				end_time:	$("#advanced_search_end_time").val(),
				approve:	$("#advanced_search_stai").val(),
				source:		$("#advanced_search_source").val(),
				flag:	$("#advanced_search_flag").val(),
				checkup:	$("#advanced_search_checkup").val(),
				archive:	$("#search_archive").val(),
				isVip:		$("#advanced_search_isVip").val(),
				accept_expire: $("#advanced_search_accept_expire").val(),
				reply_state: $("#advanced_search_reply_state").val(),
				finish_expire: $("#advanced_search_finish_expire").val()
			};
			if ($("#check_all_subtype").attr('checked') == 'checked') {
				data.type = '';
			} else {
				var selected_types = new Array();
				$("#subtype_box input[name='deal_type']:checked").each(function() {
				 	selected_types.push($(this).val());
				});
				data.type = selected_types.join(",");
			}
		} else {
			var data = {
				stype: 'simple',
				type: $('input:radio[name="simple_search_type"]:checked').val()	,
				key : $("#simple_search_key").val()
			};
		}
		var fields = new Array();
		$("#fields_checkbox input[type='checkbox']:checked").each(function() {
		 	fields.push($(this).val());
		});
		data.fields = fields.join(",");
		for (var k in data) {
			url += "&" + k + "=" + encodeURIComponent(data[k]);
		}
		window.location.href = url;
	});
	
	$("#advanced_search").click(function(){
		var data = _self.getAdvancedData();
		if (data.start_time && !CSI.checkDateTime(data.start_time)) {
			CSI.msgBox2("错误的开始时间");
			//$("#advanced_search_start_time").focus();
			return false;
		}
		if (data.end_time && !CSI.checkDateTime(data.end_time)) {
			CSI.msgBox2("错误的结束时间");
			//$("#advanced_search_end_time").focus();
			return false;
		}
		_self.searchType = 'advanced';
		dealList.searchBoxHide();
		_self.search(data);
	});
	
	$("#reset_advanced_search").click(function(){
		$("#advanced_search_table input").val('');
		$("#advanced_search_table select").val('');
		$("#advanced_search_table textarea").val('');
		return false;
	});
	
	$("#filter_field_btn").click(function(){
		if (_self.searchType == 'advanced') {
			var data = dealList.getAdvancedData();
		} else {
			var data = {
			type: $('input:radio[name="simple_search_type"]:checked').val()	,
			key : $("#simple_search_key").val(),
			page: 1
			};
		}
		
		_self.search(data);
	});
	
	$("#simple_search").click(function(){
		var data = {
			type: $('input:radio[name="simple_search_type"]:checked').val()	,
			key : $("#simple_search_key").val(),
			page: 1
		};
		
		
		if (!data.type) {
			CSI.msgBox2("请选择查询方式");
			return false;
		}
		_self.searchType = 'simple';
		dealList.searchBoxHide();
		_self.search(data);
	});
};
dealList.getAdvancedData = function() {
	var data = {
				userPhone: $('#advanced_search_phone').val(),
				key : $("#advanced_search_key").val(),
				account: $("#advanced_search_account").val(),
				//type: $("#advanced_search_type").val(),
				state: $("#advanced_search_state").val(),
				start_time: $("#advanced_search_start_time").val(),
				end_time:	$("#advanced_search_end_time").val(),
				approve:	$("#advanced_search_stai").val(),
				source:		$("#advanced_search_source").val(),
				flag:	$("#advanced_search_flag").val(),
				checkup:	$("#advanced_search_checkup").val(),
				archive:	$("#search_archive").val(),
				isVip:		$("#advanced_search_isVip").val(),
				accept_expire: $("#advanced_search_accept_expire").val(),
				finish_expire: $("#advanced_search_finish_expire").val(),
				reply_state: $("#advanced_search_reply_state").val(),
				page: 1	
			};
		if ($("#check_all_subtype").attr('checked') == 'checked') {
			data.type = '';
		} else {
			var selected_types = new Array();
			$("#subtype_box input[name='deal_type']:checked").each(function() {
			 	selected_types.push($(this).val());
			});
			data.type = selected_types.join(",");
		}
	return data;
};
dealList.searchBoxHide = function() {
	$("#advanced_search_box").hide();
	$("#advanced_search_box_hd .ecc_mod_box_up").hide();
	$("#advanced_search_box_hd .ecc_mod_box_down").show();
	
	$("#simple_search_box").hide();
	$("#simple_search_box_hd .ecc_mod_box_up").hide();
	$("#simple_search_box_hd .ecc_mod_box_down").show();
};
dealList.search = function(data) {
	var url = '';
	var fields = new Array();
	$("#fields_checkbox input[type='checkbox']:checked").each(function() {
	 	fields.push($(this).val());
	});
	data.fields = fields.join(",");
	data.order_by = $("#order_by").val();
	data.order_dir = $("#order_dir").val();
	if (dealList.searchType == 'simple') {
		url = '/json.php?biz=service&mod=list&act=simpleSearch';
	} else {
		url = '/json.php?biz=service&mod=list&act=advancedSearch';
	}
	CSI.loadingShow(true);
	$.ajax({
			url	 : url,
			type 	 : 'POST',
			dataType : 'json',
			data	 : data,
			success  : function(data){
				if(0 == data.errno){
					CSI.loadingHide();
					$("#search_result_table tr").remove();
					var html = '';
					var fields_map = data.data.fields_map;
					$("#fields_checkbox input[type='checkbox']").each(function() {
				 		for (var k in fields_map) {
							if (k == $(this).val()) {
								$(this).attr('checked', 'checked');
								break;
							}
						}
					});
					
					$("#order_by").val(data.data.order_by);
					$("#order_dir").val(data.data.order_dir);
					$("#result_sort .ecc_mod_btn2").each(function() {
						var order_by = $(this).attr("ob");
						if (order_by == (data.data.order_by + "")) {
							$(this).addClass("selected");
							$(this).attr("obdir", data.data.order_dir);
							if (data.data.order_dir == 'DESC') {
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
					
					if(data.data.list.length > 0){
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
						for(var i = 0; i < data.data.list.length; i ++){
							html += '<tr>';
							for (var k in fields_map) {
								switch (k) {
									case 'id':
										html += '<td class="first_fix"><a href="index.php?biz=service&mod=deal&act=detail&id=' + data.data.list[i][k] + '" target="_blank">' + data.data.list[i][k] + '</a></td>';
										break;
									case 'flag':
										html += '<td>' + (data.data.list[i][k] > 0 ? '催办' : '') + '</td>';;
										break;
									case 'type':
										if (data.data.list[i][k] > 100) {
											html += '<td>' + dealList.APPLY_SUBTYPE[data.data.list[i][k]] + '</td>';
										} else {
											html += '<td>' + dealList.APPLY_TYPE[data.data.list[i][k]] + '</td>';
										}
										break;
									case 'state':
										html += '<td>' + dealList.APPLY_STATE[data.data.list[i][k]] + '</td>';
										break;
									case 'checkup':
										html += '<td>' + dealList.APPLY_CHECKUP[data.data.list[i][k]] + '</td>';
										break;
									case 'source':
										html += '<td>' + dealList.APPLY_SOURCE[data.data.list[i][k]] + '</td>';
										break;
									case 'approve':
										html += '<td>' + dealList.APPLY_APPROVE[data.data.list[i][k]] + '</td>';
										break;
									case 'isVip':
										html += '<td>' + (data.data.list[i][k] > 0 ?'是' : '否') + '</td>';
										break;
									case 'createTime':
										html += '<td>' + dealList.timeFormat(data.data.list[i][k],'y-m-d h:i:s') + '</td>';
										break;
									case 'finishTime':
									case 'nextTime':
									case 'acceptTime':
										if (data.data.list[i][k] > 0) {
											html += '<td>' + dealList.timeFormat(data.data.list[i][k],'y-m-d h:i:s') + '</td>';
										} else {
											html += '<td></td>';
										}
										break;
									case 'content':
										html += '<td><div class="ecc_result_detail"  rid="' + data.data.list[i].id + '" title="' + data.data.list[i].content + '">' + data.data.list[i].content +  '</div></td>';
										break;
									default:
										html += '<td>' + data.data.list[i][k] + '</td>';	
								}
							}
							html += '</tr>';
							}
						$("#search_result_div").removeClass("ecc_noresult_table");
					} else {
						$("#search_result_div").addClass("ecc_noresult_table");
						html = '<tr><td >无查询结果</td></tr>'
					}
					$("#search_result_table").append(html);
					var paginator_html = getPageHTML("javascript:dealList.goPage({page})", data.data.page, data.data.pages, 5);
					$("#paginator").empty().html(paginator_html);
				}else{	
					CSI.msgBox("系统问题，请重新查询");
				}
			}
		});
};

dealList.goPage = function(page) {
	if (dealList.searchType == 'simple') {
		var data = {
			type: $('input:radio[name="simple_search_type"]:checked').val()	,
			key : $("#simple_search_key").val(),
			page: page
		};	
	} else {
		 var data = dealList.getAdvancedData();
		 data.page = page;
	}
	dealList.search(data);
};


dealList.getCookie = function(name) {
	//读取COOKIE
	var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"), val = document.cookie.match(reg);
	return val ? (val[2] ? unescape(val[2]) : "") : null;
};


dealList.getUsername = function(){
	//返回当前登陆用户的用户名 ,没有则返回""
	var username = this.getCookie("username");
	return username ? username : "";
};

dealList.strToDate = function(str){
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
dealList.timeFormat= function(ts, fstr) {
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

dealList.getTimeInfo = function(t) {
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

dealList.QueryString = function(item){
  var svalue = window.location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
  return svalue ? svalue[1] : svalue;
}

dealList.getInfo = function(){
	var _self = this;
	var uid = _self.QueryString('uid');
	var type = _self.QueryString('type');
	if(uid && type) {
		if (type != 'week') {
			var data = {key: uid, page : 1};
			$("#advanced_search_key").val(uid);
		} else {
			//var uname = _self.QueryString('uname');
			var data = {account: uid, page : 1};
			$("#advanced_search_account").val(uid);
		}
		
		switch(type) {
			case 'undeal':
				data.state = 1;
				$("#advanced_search_state").val(2);
				break;
			case 'dealed':
				data.state = 3;
				$("#advanced_search_state").val(3);
				break;
			case 'deal1':
				data.state = 2;
				data.reply_state = 2;
				$("#advanced_search_reply_state").val(2);
				$("#advanced_search_state").val(2);
				break;
			case 'deal2':
				data.state = 2;
				data.reply_state = 1;
				$("#advanced_search_reply_state").val(1);
				$("#advanced_search_state").val(2);
				break;
			case 'urge':
				data.flag = 1;
				$("#advanced_search_flag").val(1);
				break;
			case 'expire1':
				data.accept_expire = 1;
				$("#advanced_search_accept_expire").val(1);
				break;
			case 'expire2':
				data.finish_expire = 1;
				$("#advanced_search_finish_expire").val(1);
				break;
			case 'week':
				data.start_time = unescape(_self.QueryString('start_time'));
				//alert(data.start_time);
				$("#advanced_search_start_time").val(data.start_time);
				break;
		}
		_self.search(data);
		dealList.searchBoxHide();
	} else if (type == 'kanban') {
		var data = {};
		var stype = _self.QueryString('stype');
		var start_time = _self.QueryString('start_time');
		var end_time = _self.QueryString('end_time');
		var selected_types = new Array();
		$("#subtype_box input[name='deal_type']").each(function() {
			 if ($(this).val() == stype || Math.floor($(this).val() / 100) == stype ) {
			 	$(this).attr("checked", true);
			 	selected_types.push($(this).val());
			 }
		});
		$("#advanced_search_start_time").val(start_time + " 00:00");
		$("#advanced_search_end_time").val(end_time + " 00:00");
		$("#advanced_search_stai").val(2);
		data.approve = 2;
		data.type = selected_types.join(",");
		data.start_time = start_time + " 00:00";
		data.end_time = end_time + "00:00";
		_self.search(data);
		dealList.searchBoxHide();
	}
};
dealList.init = function(){
	this.username = this.getCookie('username');
	if(this.username == null || this.username == ""){
		CSI.msgBox("请首先登录！");
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
	dealList.init();
});