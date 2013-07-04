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
		6: "建议表扬",
		8: "预约服务"
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
	QR_LIST: {
		0: "",
		1: "快捷回复预定设置1",
		2: "快捷回复预定设置2"
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
	if (data.state == 3) { //已经结单的工单
		$("#deal_info_box").show();
		$("#user_info_box").show();
		$("#dealing_info_box").hide();
		$("#user_mobile").html(dealInfo.userPhone);
		$("#user_account").html(dealInfo.account);
		$("#deal_id strong").html(dealInfo.id);	
		$("#deal_followed_kf").html(dealInfo.followKF);
		$("#deal_censor").html(dealInfo.censor);
		$("#deal_biz").html(dealInfo.biz);
		$("#deal_approve").html(dealInfo.approve);
		$("#deal_checkup").html(dealInfo.checkup);
		$("#deal_unsati_detail").html(dealInfo.unsati_detail);
		if (dealInfo.est_comp_time) {
			$("#deal_evaluate_finish_time").html(this.timeFormat(dealInfo.est_comp_time,'y-m-d h:i:s'));
		}
		$("#deal_create_time").html(this.timeFormat(dealInfo.createTime,'y-m-d h:i:s'));
		$("#deal_status").html(dealDetail.APPLY_STATE[dealInfo.state])
		$("#deal_order_id").html('<a href="http://ias.icson.com/Sale/SODetail.aspx?SysNo=' + order_id + '" target="_blank">' + dealInfo.orderNo + '</a>');
		$("#deal_type").html(dealDetail.APPLY_TYPE[dealInfo.type]);
		var order_id = dealInfo.orderNo;
		var reg = /^[0]*/;
		order_id = order_id.replace(reg, "");
		//$("#deal_evaluate_finish_time").html(this.timeFormat(dealInfo.evaluate_finish_time,'y-m-d h:i:s'));
		if(dealInfo.isVip == 1) {
			$("#user_feature").html("VIP用户");
		} else {
			$("#user_feature").html("普通用户");
		}
		if(dealInfo.state != '0') {
			$("#deal_status").html(dealDetail.APPLY_STATE[dealInfo.state]);
		}
		if (dealInfo.hasMemo) {
			$("#flag_memo_icon").show();
		}
		if(dealInfo.flag == 1) {
			$("#flag_1_icon").show();
			$("#flag_1_btn").text("该单已催办");
			$("#flag_1_btn").unbind("click");
		}
		$("#deal_finish_time").html(this.timeFormat(dealInfo.finishTime,'y-m-d h:i:s'));
		$("#deal_consumer_time").html(this.time2Hour(dealInfo.dealTime));
		//如果有质检权限，出质检
		if (has_qa_privilege) {
			$("#kf_censor_zone").show();
		} else {
			$("#complaint_detail_zone").css("padding-bottom", "0px");
		}
		
	} else {//未结单的工单
		$("#dealing_info_box").show();
		$("#deal_info_box").hide();
		$("#user_info_box").hide();
		$("#cl_user_mobile").html(dealInfo.userPhone);
		$("#cl_user_account").html(dealInfo.account);
		$("#deal_id strong").html(dealInfo.id);
		$("#cl_deal_type").html(dealDetail.APPLY_TYPE[dealInfo.type]);
		if(dealInfo.isVip == 1) {
			$("#cl_user_feature").html("VIP用户");
		} else {
			$("#cl_user_feature").html("普通用户");
		}
		if (dealInfo.hasMemo) {
			$("#cl_flag_memo_icon").show();
		}
		$("#cl_deal_biz").html(dealInfo.biz);
		if (dealInfo.est_comp_time) {
			$("#cl_deal_evaluate_finish_time").html(this.timeFormat(dealInfo.est_comp_time,'y-m-d h:i:s'));
		}
		$("#cl_deal_create_time").html(this.timeFormat(dealInfo.createTime,'y-m-d h:i:s'));
		if(dealInfo.flag == 1) {
			$("#cl_flag_1_icon").show();
			$("#flag_1_btn").text("该单已催办");
			$("#flag_1_btn").unbind("click");
		}
		$("#kf_reply_zone").show();	
		$("#cl_apply_count").html(dealInfo.week_total);
		$("#cl_reply_count").html(dealInfo.reply_count);
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
	if (dealInfo.expire_time > 0 ) {
		$("#expire_time").html("当前与用户预期处理时间已超时" + dealInfo.expire_time + "分钟")
	}
	$("#deal_content").html(_filtData(dealInfo.content));
	//处理详情附件
	if (dealInfo.attachment) {
		att_array = dealInfo.attachment.split(/[,;\n]/);
		img_html = '';
		for(var i = 0; i < att_array.length; i++) {
			img_html += '<a href="' + att_array[i] +'" class="ecc_detail_img"><img src="' + att_array[i] + '" target="_blank" /><i></i></a>';
		}
		$("#attachment_list").empty().append(img_html);
	}
	//处理最新回复
	if (dealInfo.latest_reply) {
		$("#latest_reply").html('<h4 class="ecc_mod_box_stit">用户新回复信息：</h4>' +
							"<p>" + dealInfo.latest_reply.content + "</p>");
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
	
	//归档初始化 S
	if(dealInfo.archive.name) {
		$("#deal_archive").html(dealInfo.archive.name);
	}
	if(dealInfo.archive.selected_id && dealInfo.archive.selected_id > 1000) {
		$("#archive-level-1 a").removeClass('selected');
		$("#archive-level-1 a").each(function(){
			if($(this).attr('archive_id') == dealInfo.archive.level1) {
				$(this).addClass('selected');
			}
		});
		$("#archive-level-2").empty();
		var level2_html = '';
		for(var i = 0; i < dealInfo.archive.level2.length; i ++){
			level2_html += '<li><a href="##" class="level-2 ' + (dealInfo.archive.level2[i].id == dealInfo.archive.selected_id ? 'selected': '') + '" archive_id="' + dealInfo.archive.level2[i].id + '">' + dealInfo.archive.level2[i].name + '</a></li>'
		}
		$("#archive-level-2").append(level2_html);
	}
	
	if(dealInfo.used_archive) {
		var option_html = '';
		for(var i = 0; i < dealInfo.used_archive.length; i ++){
			option_html += '<option value="' + dealInfo.used_archive[i].id + '">' + dealInfo.used_archive[i].text + '</option>';
		}
		$("#used_archive").append(option_html);
	}
	//归档初始化 E
}


dealDetail.bindInitEvent = function(){
	var _self = this;
	//$("#next_follow_time").ligerDateEditor({showTime: true, label: '下次跟进时间', labelWidth: 100, labelAlign: 'left'});
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
	
	$(".ecc_mod_reply_hd .up").live('click',
		function() {
			$(this).removeClass("up").addClass("down");
			$(this).parent().parent().find(".ecc_mod_reply_bd").show();
		}
	);
	
	$(".ecc_mod_reply_hd .down").live('click',
		function() {
			$(this).removeClass("down").addClass("up");
			$(this).parent().parent().find(".ecc_mod_reply_bd").hide();
		}
	);
	
	$("#archive_zone .mod_pop_close").click(function(){
		$("#archive_id_selected").val();
		$("#archive_zone").hide();
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
		$("#reassign_flag").val('1');
	});
	$("#reassign_btn").click(function(){
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
				var text = $("#kf_reply").val() + dealDetail.QR_LIST[reply_index];
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
		dom.draggable();
		$("#archive_zone").show();
	});
	
	$("#reassign_submit_btn").click(function(){
		var id = _self.QueryString('id');
		if(id < 1) {
			CSI.msgBox('选择工单');
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
					CSI.loadingHide();
					if(0 == data.errno){
						$("#kf_rtx").val('');
						$("#group_list input[type='checkbox']:checked").each(function() {
				 			$(this).attr('checked', false);
						});
						$("#reassign_zone").hide();
						CSI.newLayer("成功","转单成功", function(layerdom){
							layerdom.remove();
							dealDetail.getInfo();
						});
					}else{	
						if(data.msg) {
							CSI.msgBox(data.msg)
						} else {
							CSI.msgBox("系统问题，请重新查询");
						}
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
						CSI.newLayer("成功","归档成功", function(layerdom){
							layerdom.remove();
							dealDetail.getInfo();
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
	//质检
	$("#normal_censor_submit").click(function(){
		var data = {
			id: _self.QueryString('id'),
			content: $.trim($('#kf_censor').val()),
			checkup: $('input:radio[name="checkup"]:checked').val()	
		};
		$.ajax({
			url	 : '/json.php?biz=service&mod=deal&act=checkup',
			type 	 : 'POST',
			dataType : 'json',
			data	 : data,
			success  : function(result){
				if(0 == result.errno){
					$('#kf_censor').val('');
					$('input:radio[name="checkup"]').each(function()
					{
						$(this).attr("checked", false);
					});
					CSI.newLayer("成功","质检提交成功", function(layerdom){
						layerdom.remove();
						dealDetail.getInfo();
					});
				}else{	
					CSI.msgBox("修改失败");
				}
			}
		});
	});
	$("#flag_4_btn").click(function(){
		var data = {
			id: _self.QueryString('id'),
			flag: 4
		};
		$.ajax({
			url	 : '/json.php?biz=service&mod=deal&act=setFlag',
			type 	 : 'POST',
			dataType : 'json',
			data	 : data,
			success  : function(result){
				if(0 == result.errno){
					CSI.msgBox("设置为典型工单成功");
					dealDetail.getInfo();
				}else{	
					CSI.msgBox("修改失败");
				}
			}
		});
	});
	//加急催办
	$("#flag_1_btn").click(function(){
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
					CSI.newLayer("成功","订单催办成功", function(layerdom){
						layerdom.remove();
						dealDetail.getInfo();
					});
				}else{	
					CSI.msgBox("修改失败");
				}
			}
		});
	});
	
}

dealDetail.addReply = function(dealId, resolved){
	var postUrl = '/json.php?biz=service&mod=deal&act=addReply';
	var content = $('#kf_reply').val().trim();
	if(content === ""){
		CSI.msgBox("请输入回复内容");
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
					CSI.newLayer("成功","客服回复成功", function(layerdom){
						layerdom.remove();
						dealDetail.getInfo();
					});
				}else{	
					CSI.msgBox(data.msg);
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
	this.getInfo();
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

dealDetail.init();
