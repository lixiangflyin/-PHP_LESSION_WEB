var dealDetail = {
	dealId: null,
	orderId: null,
	orderInfo: null,
	username: null,
	APPLY_TYPE : {
		0: "全部",
		1: "订单催办",
		2: "订单修改",
		3: "订单取消",
		4: "投诉建议",
		5: "问题咨询",
		6: "建议反馈",
		7: "表扬"
	},
	APPLY_SUBTYPE: {
		0   : "全部",
		1   : '商品已出库但未送达',
		2   : '商品未出库',
		3   : '订单未审核',
		4   : '查不到物流信息',
		5   : '已付款待充值',
		6   : '显示充值成功但未到账',
		7   : '订单问题',
		8   : '物流问题',
		9   : '售后问题',
		10  : '活动问题',
		11  : '建议反馈'
	},
	APPLY_STATE: {
		0: "全部",
		1: "待处理",
		2: "处理中",
		3: "已结单"
	},
	is_censor	: 0
};

dealDetail.getInfo = function(){
	var getUrl = '/json.php?biz=service&mod=deal&act=getApplyDetail';
	getUrl += '&id=' + this.dealId;
	getUrl += '&t='+Math.random();
	CSI.loadingShow();
	$.ajax({
	    type: "GET",
	    url: getUrl,
	    dataType: "jsonp",
	    success: function(data){
	    	CSI.loadingHide();
			if(data.errno == 0 && data.data != false){
				dealDetail.showInfo(data.data);
			}else{
				CSI.msgBox("获取投诉详情失败！");
			}			
	    }
	});
};

function _filtData(data){
	if(typeof data === "string"){
		return data.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, "&#039;").replace(/"/g, "&quot;");
	}       
	if(typeof data === "object" || typeof data === "array"){
		for(var i in data){
			data[i] = this.filtData(data[i]);
		}       
		return data;
	}       
	return data;
}

dealDetail.showInfo = function(data){
	var dealInfo = data;
	
	if(dealInfo.flag == 1) {
		$("#cl_flag_1_icon").show();
		$("#flag_1_btn").text("该单已催办");
		$("#flag_1_btn").unbind("click");
		$("#flag_1_btn").removeClass("mod_btn").addClass("mod_btn_disabled").addClass("urge_button_disabled");
	}
	var has_setflag_privilege = 0;
	var has_qa_privilege = 0;
	for(var i = 0; i < dealInfo.privileges.length; i++) {
		if (dealInfo.privileges[i] == 'URGE') {
			has_setflag_privilege = 1;
		}
		if (dealInfo.privileges[i] == 'QA') {
			has_qa_privilege = 1;
		}
	}
	if (has_setflag_privilege) {
		$("#flag_1_btn").show(); 
	}
	//初始化工作流
	if (dealInfo.workflows.length > 0) {
		html = '<h4 class="ecc_mod_box_stit">工单工作流：</h4>';
		for(var i = 0; i < dealInfo.workflows.length; i ++){
			if (i == 0) {
				html += '<div class="ecc_mod_reply ecc_mod_reply_selected">';
			} else {
				html += '<div class="ecc_mod_reply">';
			}
			var target_user_html = '';
			if (dealInfo.workflows[i].target_user) {
				target_user_html = '<span class="user"><strong>目标人：</strong>' + dealInfo.workflows[i].target_user + '</span>'
			}
			html += '<div class="ecc_mod_reply_hd">' +
								'<span class="tit">'+ (i+1) + '、' + dealInfo.workflows[i].workflow_type_map + '</span>' +
								'<span class="user"><strong>操作人：</strong>' + dealInfo.workflows[i].create_by + '</span>' +
								 target_user_html +
								'<span class="time"><strong>时间：</strong>'+ this.timeFormat(dealInfo.workflows[i].create_time,'y-m-d h:i:s') +'</span>' +
								'<a href="##" class="up" ' + (i == 0 ? ' style="display:none;" ': ' style="display:block;" ') + '>展开</a>' +
								'<a href="##" class="down"' + (i != 0 ? ' style="display:none;" ': ' style="display:block;" ') + '>收起</a>' +
							'</div>' +
							'<div class="ecc_mod_reply_bd">' + 
								'<p>' + dealInfo.workflows[i].workflow_detail + '</p>' +
						'</div>';
			html += '</div>';
		}
		$("#workflow_zone").empty().append(html);
	}
}


dealDetail.bindInitEvent = function(){
	var _self = this;
	$(window).bind("scroll", function(){ 
		var fold = $(window).scrollTop();
		var ele_top = $("#dealing_info_box").offset().top;
		if(fold > ele_top + 50) {
			$("#dealing_info_box .ecc_mod_box_bd").hide();
			$("#dealing_info_box .ecc_mod_box_up").hide();
			$("#dealing_info_box .ecc_mod_box_down").show();
		}
		
		if(fold < ele_top - 50) {
			$("#dealing_info_box .ecc_mod_box_bd").show();
			$("#dealing_info_box .ecc_mod_box_up").show();
			$("#dealing_info_box .ecc_mod_box_down").hide();
		}
	}); 
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
	
	$("#kf_reply_zone .ecc_mod_box_up").click(function() {
		$(this).parent().find(".ecc_mod_box_down").show();
		$(this).hide();
		$(this).parent().parent().find(".ecc_mod_box_bd").hide();	
	});
	
	$("#kf_reply_zone .ecc_mod_box_down").click(function() {
		$(this).parent().find(".ecc_mod_box_up").show();
		$(this).hide();
		$(this).parent().parent().find(".ecc_mod_box_bd").show();	
	});
	
	$(".ecc_mod_reply_hd").live('click', function() {
		if($(this).children(".down").css("display") == 'block') {
				$(this).children(".down").hide();
				$(this).children(".up").show();
	        	$("#workflow_zone .ecc_mod_reply_bd").hide();
			} else {
				$(this).children(".up").hide();
				$(this).children(".down").show();
	        	$("#workflow_zone .ecc_mod_reply_bd").hide();
	        	$(this).parent().find(".ecc_mod_reply_bd").show();
			}
	});
	
	$("#archive_zone .mod_pop_close").click(function(){
		$("#archive_id_selected").val();
		$("#archive_zone").hide();
		CSI.loadingHide();
	});
	
	$("#used_archive").live('change', function(){
		$("#selected_archive_id").val($("#used_archive").val());
	});
	
	$("#reassign_type1").click(function(){
		$("#input_kf_rtx").show();
		$("#group_list").hide();
	});
	$("#reassign_type2").click(function(){
		$("#input_kf_rtx").hide();
		$("#group_list").show();
	});
	
	$("#reassign_urge_btn").click(function() {
		dealDetail.assign();
		$("#reassign_flag").val('1');
	});
	$("#reassign_btn").click(function(){
		dealDetail.assign();
	});
	
	$("#reassign_zone .mod_pop_close").click(function(){
		CSI.loadingHide();
		$("#reassign_zone").hide();
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
			$("#selected_archive_id").val(archive_id);
			
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
						}else{	
							CSI.msgBox("拉取归档失败");
						}
					}
				});
			}
		}
	);
	//快速回复
	$("#quick_reply").change(
		function() {
			var reply_index = $(this).get(0).selectedIndex - 0;
			if (reply_index != 0) {
				var text = $("#kf_reply").val() + $(this).val();
				$("#kf_reply").val(text);
			} else {
				//$("#kf_reply").val('');
			}
			if($(this).val() == "0") 
			{
				$(this).addClass("empty");
			} else {
    			$(this).removeClass("empty")
    		}

		}
	);
	
}

dealDetail.bindSubmitEvent = function(){
	var _self = this;
	$('#normal_submit').click(function(){
		_self.addReply(_self.QueryString('id'), 0);
	});
	$('#resolved_submit').click(function(){
		CSI.loadingShow();
		var dom = $("#archive_zone");
		dom.css({"z-index": CSI.zindex});
		CSI.zindex++;
		dom.center();
		dom.draggable({handle: ".mod_pop_hd"});
		$("#archive_zone").show();
	});
	
	$("#reassign_submit_btn").click(function(){
		var id = _self.QueryString('id');
		if(id < 1) {
			CSI.msgBox2('选择工单');
		} else {
			url = '/json.php?biz=service&mod=deal&act=reassign';
			data = {
				id:id,
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
						$("#kf_rtx").val('');
						$("#group_list input[type='checkbox']:checked").each(function() {
				 			$(this).attr('checked', false);
						});
						$("#reassign_zone").hide();
						CSI.newLayer2("成功","转单成功", function(layerdom){
							layerdom.remove();
							dealDetail.getInfo();
						});
					}else{	
						$("#reassign_zone .msg-tips").html(data.msg);
					}
				}
			});
		}
	});
	
	$('#censor_submit').click(function(){
		//_self.addReply(_self.QueryString('id'), 1);
		$("#archive_zone").show();
		_self.is_censor = 1;
	});
	
	//归档提交按钮
	$("#archive_btn").click(function(){
		var selected_archive_id = $("#selected_archive_id").val();
		if(selected_archive_id) {
			var need_sms = 0;
			if($("#need_sms").attr("checked") == 'checked') {
				need_sms = 1;
			}
			var data = {
				id: _self.QueryString('id'),
				content: $.trim($('#kf_reply').val()),
				archive_id: selected_archive_id,
				isclose: 1,
				need_sms : need_sms
			};
			if (_self.is_censor == 1) {
				data.content = $.trim($('#kf_censor').val());
				data.is_censor = 1;
				data.checkup = $('input:radio[name="checkup"]:checked').val();	
			}
			$.ajax({
				url	 : '/json.php?biz=service&mod=deal&act=setArchive',
				type 	 : 'POST',
				dataType : 'json',
				data	 : data,
				success  : function(result){
					if(0 == result.errno){
						$("#latest_archive").val();
						$("#selected_archive_id").val();
						$("#archive_zone").hide();
						CSI.newLayer3("成功","归档成功", function(layerdom){
							layerdom.remove();
							//dealDetail.getInfo();
							window.location.reload();
						});
					}else{	
						CSI.msgBox("服务器繁忙");
					}
				}
			});
		} else {
			CSI.msgBox('必须选定归档的二级分类!!');
		}
	});
	//对内备注
	$("#memo_submit").click(function(){
		var data = {
			id: _self.QueryString('id'),
			content: $.trim($('#kf_reply').val()),
			deal_kf: this.username,
			is_memo: 1
			
		};
		$.ajax({
			url	 : '/json.php?biz=service&mod=deal&act=addReply',
			type 	 : 'POST',
			dataType : 'json',
			data	 : data,
			success  : function(result){
				if(0 == result.errno){
					$('#kf_reply').val('');
					CSI.newLayer("成功","备注提交成功", function(layerdom){
						layerdom.remove();
						dealDetail.getInfo();
					});
				}else{	
					CSI.msgBox("修改失败");
				}
			}
		});
	});
	

	//加急催办
	$("#flag_1_btn").click(function(){
		if ($(this).attr('urge') == 1) {
			return false;
		}
		var data = {
			id: _self.QueryString('id'),
			flag: 1
		};
		$.ajax({
			url	 : '/json.php?biz=service&mod=deal&act=setFlag',
			type 	 : 'POST',
			dataType : 'json',
			data	 : data,
			success  : function(result){
				if(0 == result.errno){
					CSI.newLayer2("成功","订单催办成功", function(layerdom){
						layerdom.remove();
						dealDetail.getInfo();
					});
				}else{	
					CSI.msgBox2("修改失败");
				}
			}
		});
	});
	
	//差评导入删除
	$("#review_delete").click(function(){
		CSI.confirmBox("确认删除此差评？", function(layerdom) {
			layerdom.remove();
			$.ajax({
			url	 : "/json.php?biz=service&mod=deal&act=deleteReview",
			type 	 : 'POST',
			dataType : 'json',
			data	 : {id: _self.QueryString('id')},
			success  : function(result){
				if(0 == result.errno){
					CSI.newLayer2("成功","差评删除成功", function(layerdom){
						layerdom.remove();
						dealDetail.getInfo();
						$("#review_delete").text("差评已删除");
						$("#review_delete").unbind("click");
						$("#review_delete").addClass("mod_btn_disabled");

					});
				}else{	
					CSI.msgBox2(result.msg);
				}
			}
			});
		});
	});
	
}
dealDetail.assign = function() {
	$("#kf_rtx").val('');
	$("#reassign_zone .msg-tips").empty();
	CSI.loadingShow();
	var dom = $("#reassign_zone");
	dom.css({"z-index": CSI.zindex});
	CSI.zindex++;
	dom.center();
	dom.draggable();
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
					if (data.msg) {
						CSI.msgBox(data.msg);
					} else {
						CSI.msgBox("系统问题，请重试");
					}
				}
			}
		});
}
dealDetail.addReply = function(dealId, resolved){
	var postUrl = '/json.php?biz=service&mod=deal&act=addReply';
	var content = $.trim($('#kf_reply').val());
	if(content === ""){
		CSI.msgBox2("请输入回复内容");
		return false;
	}
	var need_sms = 0;
	if($("#need_sms").attr("checked") == 'checked') {
		need_sms = 1;
	}
	nextTime = $("#next_follow_time").val();
	var data = {
		id: dealId,
		deal_kf: this.username,
		content: content,
		nextTime: nextTime,
		need_sms: need_sms,
		isclose: resolved
	};
	$.ajax({
			url	 : postUrl,
			type 	 : 'POST',
			dataType : 'json',
			data	 : data,
			success  : function(result){
				if(0 == result.errno){
					$('#kf_reply').val('');
					$('#need_sms').attr('checked', false);
					CSI.newLayer3("成功","客服回复成功", function(layerdom){
						layerdom.remove();
						dealDetail.getInfo();
					});
				}else{	
					CSI.msgBox2(result.msg);
				}
			}
		});
};

dealDetail.getCookie = function(name) {
	//读取COOKIE
	var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"), val = document.cookie.match(reg);
	return val ? (val[2] ? unescape(val[2]) : "") : null;
};


dealDetail.getUsername = function(){
	//返回当前登陆用户的用户名 ,没有则返回""
	var username = this.getCookie("username");
	return username ? username : "";
};

dealDetail.strToDate = function(str){
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
dealDetail.timeFormat= function(ts, fstr) {
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

dealDetail.time2Hour = function(ts) {
	var h = Math.floor(ts/3600);
	var m = Math.floor((ts - h*3600) / 60);
	var str = '';
	if (h > 0 ) {
		str += h + "小时";
	}
	if (m > 0) {
		str += m + "分钟";
	}
	str += (ts % 60) + "秒";
	return str;
}

dealDetail.getTimeInfo = function(t) {
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


dealDetail.QueryString = function(item){
  var svalue = window.location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
  return svalue ? svalue[1] : svalue;
}

dealDetail.init = function(){
	this.username = this.getCookie('username');
	if(this.username == null || this.username == ""){
		CSI.msgBox("请首先登录！");
		window.location.href = "http://csi.ecc.com";
		return;
	 }
	this.dealId = this.QueryString("id");
	if(this.dealId != null && this.dealId != ""){
		this.dealId -= 0;
	}
	this.bindInitEvent();
	//this.getInfo();
	this.bindSubmitEvent();
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
$(document).ready(function() {
dealDetail.init();
});
