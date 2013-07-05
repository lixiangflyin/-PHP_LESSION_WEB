/**
 *
 */
G.app.mycenter = G.app.mycenter || {};
G.app.mycenter.myrepair = {
	_order_id	: '',
	_products	: {},
	_pay_type_id : '',
	_pick_up_type : 0,
	_submit: 0,
	_CONTACT_MOBILE_DESC : '手机号码',
	_CONTACT_PHONE1_DESC : '区号',
	_CONTACT_PHONE2_DESC : '电话号码',
	_CONTACT_PHONE3_DESC : '分机号(可选)',

	_REVERT_CONTACT_MOBILE_DESC : '手机号码',
	_REVERT_CONTACT_PHONE1_DESC : '区号',
	_REVERT_CONTACT_PHONE2_DESC : '电话号码',
	_REVERT_CONTACT_PHONE3_DESC : '分机号(可选)',

	_WORD_CALC : '输入内容不能超过400个字',

	_orderOneMonthAge	: false,

	_order15DayAgo		: false,

	_request_id			: 0,
	_order_id			: 0,

	_getItemsOfOrder	: function(order_id, callback){
		if(G.logic.login.ifLogin(this, arguments) === false) return;
		var uid = G.logic.login.getLoginUid();

		$.get('http://' + G.DOMAIN.BASE_ICSON_COM + '/json.php?mod=myrepair&act=getavailableproducts', {
			uid	: uid,
			order_id	: order_id
		},callback, 'jsonp');
	},

	_err	: '',
	getItemsOfOrder	: function(){
		var setItemTip = function(err){
			self._err = err;
			G.ui.tips.warn(self._err, $('#order_items_cnt'), {
				style	: 'inner',
				autoHide	: true
			});
		};
		var setItemTip2 = function(err){
			self._err = err;
			G.ui.tips.warn(self._err, $('#order_items_cntTip'), {
				style	: 'inner',
				autoHide	: false
			});
		};
		var self = G.app.mycenter.myrepair,
			order_id = $('#rma_order_id').val();

		if(!G.logic.validate.checkOrderId(order_id)){
			setItemTip2('请输入正确的订单号！');
			return false;
		};

		self._getItemsOfOrder(order_id, function(o){
			//console.log(o);
			self._err = '';
			self._products = {};
			self._pay_type_id = '';
			self._pick_up_type = 0;
			var currWhId = o.siteID;
			self.get_fetchgoods_way2(currWhId);
			if(o.errno == 21 ){
				G.logic.constants.setLocationId(o.prid);
				G.logic.constants.setSiteId(currWhId);
				window.location.reload();
			}

			if(o.errno == 22){
				setItemTip2('对不起，该订单尚未出库，无法提交报修/退换货！');
				return;
			}

			if(o.errno == 6001 || o.errno == 6002){
				var _msg = "系统繁忙，请稍后再试。";
				return G.ui.popup.showMsg(_msg,1,
					function() {
						window.location.href = "http://base.51buy.com/index.html";
						return false;
					},
					function() { //closeFunc
					},
					function() { //cancelFunc
					},
					"确定", "取消"
				).paint(function() {
					$(this).addClass('layer_jump_city');
				});
			}

			/*
			if(o.data && o.data.is_sign == true){//如果有签收流水的订单
				if(o.data.refund_type == false){//true:已签收,false:未签收
					var _msg = "您的订单处于未签收状态，暂时无法提交报修/退换货，如需售后服务，请联系易迅客服。";
					return G.ui.popup.showMsg(_msg,1,null,null,null,"确定", "取消").paint(function() {
						$(this).addClass('layer_jump_city');
					});
				}
			}

			if(o.data && o.data.is_sign == true){//如果有签收流水的订单
				if(o.data.refund_type == false){//true:已签收,false:未签收
					var _msg = "您的订单未签收，如需申请退款，请到“我的易迅-退款申请”申请退款。";
					return G.ui.popup.showMsg(_msg,1,
						function() {
							window.location.href = "http://base.51buy.com/myrefund_report.html?orderid="+o.data.order_char_id;
							return false;
						},
						function() { //closeFunc
						},
						function() { //cancelFunc
						},
						"进入退款申请", "取消"
					).paint(function() {
						$(this).addClass('layer_jump_city');
					});
				}
			}*/
			if(o && o.errno == 0){
				document.getElementById("order_items_select").innerHTML = self._getSelectedItems(o.data);
				setTimeout(G.app.mycenter.myrepair.judgeFetchTime, 1000);
				/*
				var htm = [];
				$.each(o.data.items || [], function(k, item){
					if(item.canrepair){
						self._products[item.product_id] = item;
						htm.push('<p><input type="checkbox" name="order_items" id="order_items_' + item.product_id + '" class="mdr" value="' + item.product_id+ '"  pro_weight="' + item.weight + '"/>'
						    +'<label for="order_items_' + item.product_id + '">' + item.name + '</label></p>');
					}
					if(item.gift){
						$.each(item.gift || [], function(v, gift){
							if(gift.canrepair){
								self._products[gift.product_id] = gift;
								htm.push('<p><input type="checkbox" name="order_items" id="order_items_' + gift.product_id + '" class="mdr" value="' + gift.product_id+ '"  pro_weight="' + gift.weight + '"/>'
								    +'<label for="order_items_' + gift.product_id + '">' + gift.name + '</label></p>');
							}
						});
					}
				});*/
				G.app.mycenter.myrepair._order_id = order_id;
				G.app.mycenter.myrepair._pay_type_id = o.data.pay_type;
				var fieldList = {
					'contact'	: 'receiver',
					'mobile'	: 'receiver_mobile',
					'phone' 	: 'receiver_tel',
					'area_id'	: 'receiver_addr_id',
					'address'	: 'receiver_addr_input',
					'zip'	: 'receiver_zip'

				};
				$.each(fieldList, function(field, v){
					var ovalue = '';
					v = v.split(',');
					$.each(v, function(kk, vv){
						ovalue = ovalue || o.data[vv.replace(/(^\s*|\s*$)/g, '')];
					});
					if(field == 'area_id'){
						$('#contact_' + field).data('loc').setLocation(ovalue||0);
					} else if(field == 'phone'){
						var _str = ovalue.split('-');
						for(i = 0; i< 3; i++){
							var j = i + 1;
							$('input[name=contact_phone'+ j +']').val(_str[i] || '');
						}
					}else {
						$('input[name=contact_'+field+']').val(ovalue || '');
					}
				});

				//显示地址文本
				var address_text = o.data.receiver_addr;
				$("#pickup_address_view_value").html(address_text);

				/*
				if(htm.length <= 0) {
					setItemTip2('对不起，没有可以提交报修/退换货的商品信息，可能已经提交了报修/退换货！');
					return;
				}*/

				//$('#order_items_cnt').empty().html(htm.join(''));

				//默认取货方式
				//$('#fetchgoods_way_2').attr('checked','checked')
				//$('.fetchgoods_way2').css('display','');
				//$('.fetchgoods_way1, .fetchgoods_way3').css('display','none');

				//判断订单出库时间是否在15天以内
				var canRevertReason = o.data['canRevertReason'];
				if(canRevertReason){
					$('#revert_result').html('<label id="revert_result1" class="radio_wrap"><input type="radio" value="0" id="is_revert_result_0" name="is_revert_result" checked="checked"/>商品质量问题</label> &nbsp;'
											+'<label id="revert_result2" class="radio_wrap"><input type="radio" value="1" id="is_revert_result_1" name="is_revert_result"/>非质量问题</label>');
					//绑定取货原因触发事件
					$('input[name=is_revert_result]').click(self.reasonChanged);
				}else{
					$('#revert_result').html('<label id="revert_result1" class="radio_wrap"><input type="radio" value="0" id="is_revert_result_0" name="is_revert_result" checked="checked"/>商品质量问题</label> &nbsp;<label id="revert_result2" class="radio_wrap"><input type="radio" disabled value="1" id="is_revert_result_1" name="is_revert_result"/>非质量问题</label>');
				}

				//期望处理方式展示情况
				if(o.data['request_num'] && o.data['request_num'] == 3){//7天内:退,换,修
					$('#td_request_type').empty().html(
														'<label class="radio_wrap" for="request_type_3"><input type="radio" class="mdr" name="request_type" id="request_type_3" value="3" />退货</label> '
														+'<label class="radio_wrap" for="request_type_2"><input type="radio" class="mdr" name="request_type" id="request_type_2" value="2" />换货</label>'
														+'<label class="radio_wrap" for="request_type_1"><input type="radio" class="mdr" name="request_type" id="request_type_1" value="1" checked="checked" />报修</label>')
					$('input[name=request_type]').click(self.requestType);
				}else if(o.data['request_num'] && o.data['request_num'] ==2){//8至15天: 换,修
					$('#td_request_type').empty().html(
														'<label title="当前订单出库已超过7天，根据易迅网售后政策，无法申请退货" class="define" for="request_type_3"><input disabled title="当前订单出库已超过7天，根据易迅网售后政策，无法申请退货" type="radio" class="mdr" name="request_type" id="request_type_3" value="3" />退货</label>'
														+'<label class="radio_wrap" for="request_type_2"><input type="radio" class="mdr" name="request_type" id="request_type_2" value="2" />换货</label>'
														+'<label class="radio_wrap" for="request_type_1"><input type="radio" class="mdr" name="request_type" id="request_type_1" value="1" checked="checked" />报修</label>')
				}else{//超过15天:修
					G.app.mycenter.myrepair._order15DayAgo = true;
					$('#td_request_type').empty().html(
									'<label title="当前订单出库已超过7天，根据易迅网售后政策，无法申请退货" class="radio_wrap" for="request_type_3"><input disabled title="当前订单出库已超过7天，根据易迅网售后政策，无法申请退货" type="radio" class="mdr" name="request_type" id="request_type_3" value="3" />退货</label>'
									+'<label title="当前订单出库已超过15天，根据易迅网售后政策，无法申请换货" class="radio_wrap" for="request_type_2"><input disabled title="当前订单出库已超过15天，根据易迅网售后政策，无法申请换货" type="radio" class="mdr" name="request_type" id="request_type_2" value="2" />换货</label>'
									+'<label class="radio_wrap" for="request_type_1"><input type="radio" class="mdr" name="request_type" id="request_type_1" value="1" checked="checked" />报修</label>')
				}

				//绑定取货地址发生改变事件
				if($('#contact_area_id').data('loc')){
					$('#contact_area_id').data('loc').uonchange(self.locChanged);
				}

				//绑定商品选择触发事件
				$('#order_items_select input[name=order_items]').click(self.productChanged);
				$('#contact_area_id').data('loc').uonchange();
			} else {
				//暂时做处理
				//$('#fetchgoods_way_1, #fetchgoods_way_lab1, .box_ba fetchgoods_way1').css('display','none');
			}
		});
	},

	//展示退款填写信息模块
	show_refund: function(){
		var pay_type = G.app.mycenter.myrepair._pay_type_id,
			pay_type3 = [1,2,3,4,23],
			pay_type4 = [8,9,10,14,16,17,18,19,20,21,28,31,34,35,36,37,38,39,40,41,42];
			$('#rma_order_id').attr('paytype', pay_type);

		//有五种展现方式 1:联合ok卡 ;  2:一城卡;  3:积分,银行卡;  4.积分,原路返回;  5.原路返回
		//支付方式:联华OK卡;展现方式:1

		if(pay_type && (pay_type - 0) == 15){
			$('#refund_type_lianhua').css('display','');
			$('#refund_type_yicheng, #refund_type_info').css('display','none');
		}
		//支付方式:一城卡;展现方式:2
		if(pay_type && (pay_type - 0) == 32){
			$('#refund_type_lianhua, #refund_type_info').css('display','none');
			$('#refund_type_yicheng').css('display','');
		}
		//展现方式:3
		for(var i in pay_type3){
			if(pay_type && (pay_type - 0) == pay_type3[i]){
				$.each(['refund_type_lianhua', 'refund_type_yicheng', 'refund_before_p'], function(k,v){
					$('#'+v).css('display','none');
				});
				$('#refund_points_p input[name=refund_type]').attr('checked', true);
				$('#bank_box_ba').css('display','');

				var refund_type = 0;
				$('#refund_type_info input[name=refund_type]').each(function(){
					if($(this).is(':checked')){
						refund_type = $(this).val();
					}
				});
				if(refund_type == 2){
					$('#refund_banks_p, #bank_box_ba').css('display','');
				}else{
					$('#bank_box_ba').css('display','none');
				}
			}
		}
		//展现方式:4
		for(var i in pay_type4){
			if(pay_type && (pay_type - 0) == pay_type4[i]){
				$('#refund_type_lianhua, #refund_type_yicheng, #refund_banks_p, #bank_box_ba').css('display','none');
			}
		}
		//展现方式:5
		if(pay_type && (pay_type - 0) == 73){//73为通联支付
			$('#refund_type_lianhua, #refund_type_yicheng, #refund_banks_p, #bank_box_ba, #refund_points_p').css('display','none');
			$('#refund_before_p').css('display','');
			$('#refund_before_p input[name=refund_type]').attr('checked', true);

		}

		//退款方式选择
		$('input[name=refund_type]').click(function(){
			var ck = parseInt($(this).val());
			switch(ck){
				case 1://退积分
					$('#bank_box_ba').hide();
					break;
				case 2://退款至银行卡
					$('#bank_box_ba').show();
					$('input[name=sel_online_pay]').click(G.app.mycenter.myrepair.bankChanged);//开户银行发生改变时间
					$('#refund_area_id select:eq(1)').change(G.app.mycenter.myrepair.bankChanged);//开户城市发生改变事件
					break;
				case 3://原路返回
					$('#bank_box_ba').hide();;
					break;
			}
		});
	},

	judgeFetchTime	: function(){
		var self = G.app.mycenter.myrepair;
		if(G.logic.login.ifLogin(this, arguments) === false) return;
		var uid = G.logic.login.getLoginUid(),
			weight = 0,
			district = $('#contact_area_id').data('loc').getLocId(),
			reason = $('input[name=is_revert_result]:checked').val(),
			provid = $('#contact_area_id select:eq(0)').val(),
			cityid = $('#contact_area_id select:eq(1)').val();
		$('input[name=order_items]:checked').each(function(){
			weight += $(this).attr('pro_weight') - 0;
		});

		if(weight == 0 || district == 0){
			var ck_type = self._pick_up_type;
			return;
		}
		$.get('http://base.51buy.com/json.php', {
			mod	: 'myrepair',
			act	: 'getfetchtime',
			order_id	: G.app.mycenter.myrepair._order_id,
			uid	: uid,
			revert_reason	: reason,
			district	: district,
			weight	: weight,
			provid	: provid,
			cityid  : cityid
		}, function(o){
			if(o && o.errno == 500){
				return G.logic.login.popup();
			}else if(o && o.errno == 0){
				var ck = parseInt(o.data.pickup_type);
				self._pick_up_type = ck;
				switch(ck){
				case 1://上海地区易迅快递 或者圆通快递
					self.isSH_isYX1(o);
					break;
				case 2://上海地区非易迅快递
					self.isSH_isYX2(o);
					break;
				case 3://非上海地区易迅快递 或者圆通快递
					self.isSH_isYX3(o);
					break;
				case 4://非上海地区非易迅快递
					self.isSH_isYX4(o);
					break;
				}
			}else if(o && (o.errno == 14 || o.errno ==15)){
				G.ui.popup.showMsg('不好意思出错了,请坐下来喝杯茶休息一下.');
				return;
			}
		}, 'jsonp');
	},

	//显示圆通上门取件
	_showYTO : function(o){
		//是否是江苏或者浙江
		var prov = $("#contact_area_id select:eq(0)").val();
		//自行送修是否显示逻辑
		if(prov == 2621){	//上海
			$("#sendback_address_sh, .bj_sh_repair").show();
			$("#sendback_address_bj").hide();
		}else if(prov == 131){	//北京
			$("#sendback_address_bj, .bj_sh_repair").show();
			$("#sendback_address_sh").hide();
		}else{
			$(".bj_sh_repair").hide();
		}

		if(o.data.logistics.icson){
			$('#fetchgoods_way_7, #fetchgoods_way_lab7, #yto_pick_up_Info, #pick_up_addr_tr').hide();
			$('#fetchgoods_way_1, #fetchgoods_way_lab1, #pick_up_fee_tr').show();
			$('#fetchgoods_way_1').attr('checked','checked');
			G.app.mycenter.myrepair.calc_time_price(o);
		}else if(o.data.logistics.yto){
			$('#fetchgoods_way_1, #fetchgoods_way_lab1, #pick_up_fee_tr').hide();
			$('#fetchgoods_way_7, #fetchgoods_way_lab7, #yto_pick_up_Info, #pick_up_addr_tr').show();
			$('#fetchgoods_way_7').attr('checked','checked');
			o.data.shipTime = o.data.ytoShipTime;
			G.app.mycenter.myrepair.calc_time_price(o);

			if(o.data.backMailAddr){
				$("#pick_up_addr_td").html(o.data.backMailAddr.MailAddress + "<br>" + o.data.backMailAddr.MailUserName+"(收) 电话:" + o.data.backMailAddr.MailTel);
			}else{
				$("#pick_up_addr_tr").hide();
			}

		}else{
			$('#fetchgoods_way_1, #fetchgoods_way_7, #fetchgoods_way_lab1, #fetchgoods_way_lab7').hide();
		}
	},

	//填写取货/收货信息(上海地区易迅快递 )
	isSH_isYX1: function(o){
		$('#fetchgoods_way_1, #fetchgoods_way_lab1, #fetchgoods_way1,#fetchgoods_way_2, #fetchgoods_way_lab2,#fetchgoods_way_3, #fetchgoods_way_lab3').css('display','');
		$('#fetchgoods_way_1').attr('checked','checked');
		$('#fetchgoods_way3').removeClass('fetchgoods_way2').addClass('fetchgoods_way3');
		$('#fetchgoods_way2, #fetchgoods_way3').css('display','none').attr('checked','').removeClass('fetchgoods_way0');

		$('#revert_info').css('display','');

		this._showYTO(o);
	},

	//填写取货/收货信息(上海地区非易迅快递 )
	isSH_isYX2: function(o){
		$('#fetchgoods_way_2, #fetchgoods_way_lab2, #fetchgoods_way2').css('display','');
		$('#fetchgoods_way_2').attr('checked','checked');
		$('#fetchgoods_way2').addClass('fetchgoods_way0');
		$('#fetchgoods_way3').removeClass('fetchgoods_way3').addClass('fetchgoods_way2');
		$('#fetchgoods_way_1, #fetchgoods_way_lab1, #fetchgoods_way1, #fetchgoods_way3').css('display','none');

		$('#revert_info').css('display','none');
		this._showYTO(o);
		return;
	},

	//填写取货/收货信息(非上海地区易迅快递 )
	isSH_isYX3: function(o){
		$('#fetchgoods_way_1, #fetchgoods_way_lab1, #fetchgoods_way1').css('display','');
		$('#fetchgoods_way_1').attr('checked','checked');
		$('#fetchgoods_way_3, #fetchgoods_way_lab3, #fetchgoods_way3, #fetchgoods_way2').css('display','none');

		$('#revert_info').css('display','');

		this._showYTO(o);
	},

	//填写取货/收货信息(非上海地区非易迅快递 )
	isSH_isYX4: function(o){
		$('#fetchgoods_way_2, #fetchgoods_way_lab2, #fetchgoods_way2').css('display','');
		$('#fetchgoods_way_2').attr('checked','checked');
		$('#fetchgoods_way2').addClass('fetchgoods_way0');
		$('#fetchgoods_way_1, #fetchgoods_way_lab1,#fetchgoods_way_3, #fetchgoods_way_lab3, #fetchgoods_way1, #fetchgoods_way3').css('display','none');

		$('#revert_info').css('display','none');

		this._showYTO(o);
	},

	//上门取件计算取件时间及取件费用
	calc_time_price:function(o){
		var pick_up = $('input[name=fetchgoods_way]:checked').val();
		if(pick_up == 1 || pick_up == 7){
			var time = o.data.shipTime;
			var shiptime_date = '';
			var shiptime_timeSpan = '';
			var len = o.data.shipMode;
			//计算取件时间
			$.each(time, function(k, date){
				shiptime_date += '<option value=' + k + '>' + date['date'] + '</option>';
			});
			$('#shiptime_date').html(shiptime_date);
			$('#shiptime_date').data("alldate", time);
			if(len > 1){
				$("#shiptime_date").change();
				$('#shiptime_timeSpan').css('display','');
			}else{
				$("#shiptime_date").unbind('change');
				$('#shiptime_timeSpan').css('display','none');
			}
			//计算取件费用
			var pickup_price = (o.data.fetchprice / 100).toFixed(2);
			$('#pickup_price').html(pickup_price+'元');
		}
	},

	//商品发生变化的函数
	productChanged	: function(){
		G.app.mycenter.myrepair.judgeFetchTime();
	},

	//取货地区发生变化的函数
	locChanged	: function(){
		//G.app.mycenter.myrepair.judgeFetchTime();
	},

	//报修原因发生变化的函数
	reasonChanged : function(){
		G.app.mycenter.myrepair.judgeFetchTime();
	},

	//产品描述字数限制
	keydownHandler : function(){
		var desc = $('#rma_description').val();
		if(desc.length > 500){
			var num=desc.substr(0,500);
			$('#rma_description').val(num);
			G.ui.popup.showMsg('超过字数限制，多出的字将被截断!');
		}
	},

	//开户城市触发事件
	bankChanged: function(){
		var district = $('#refund_area_id').data('loc').getLocId(),
			cityid = $('#refund_area_id select:eq(1)').val(),
			sel_online_pay = 0;
			$('input[name=sel_online_pay]').each(function(){
				if($(this).is(':checked')){
					sel_online_pay = $(this).val();
				}
			});

			if(cityid != 0){
				var query_banks = sel_online_pay + '-' + cityid;
				$.get('http://base.51buy.com/json.php', {
					mod	: 'myrefund',
					act	: 'getBanks',
					query_banks	: query_banks
				}, function(o){
					if(o && o.errno == 0){
						$('#p_refund_bank').empty().html('<span class="tit"><em>*</em>支行名称：</span><select id="sel_refund_bank"><option value="0">请选择支行</option></select>')
						$.each(o.data, function(k, v){
							$('#sel_refund_bank').append('<option value="'+v.SysNo+'">'+v.SubBranchName+'</option>');
						});
					}else if(o && o.errno == 2){
						$('#p_refund_bank').empty().html('<span class="tit"><em>*</em>支行名称：</span><input id="sel_refund_bank" type="text" class="input_short" name="refund_bank" />');
					}else if(o && (o.errno == 1 || o.errno ==1001)){
						return;
					}
				}, 'jsonp');
			}
	},

	//提交申请
	submitReport	: function(){
		if(G.app.mycenter.myrepair._submit == 1){
			return;
		}

		G.app.mycenter.myrepair._submit = 1;
		$('#rma_submit_btn')[0].disabled = true;

		var _enableBtn = function(){
			$('#rma_submit_btn')[0].disabled = false;
			G.app.mycenter.myrepair._submit = 0;
		};

		if(G.logic.login.ifLogin(this, arguments) === false) {
			return _enableBtn();
		}
		var uid = G.logic.login.getLoginUid();

		var data = {},
			fieldList = {
				'contact'	: ['联系人', 1],
				'mobile'	: ['手机', 0],
				'phone'	: ['联系电话', 0],
				'area_id'	: ['地区', 1],
				'address'	: ['详细地址', 1],
				'zip'	: ['邮编', 0]
			};

		$.each(['order_id', 'description'], function(k, field){
			data[field] = $('#rma_' + field).val();
		});

		if(!data['order_id']){
			var autoFocus = function(){
				$('#rma_order_id').focus();
			};
			G.ui.popup.showMsg('请填写报修/退换货的订单号！', autoFocus, autoFocus, autoFocus);
			return _enableBtn();
		}

		data['order_items'] = [];
		var order_id_s = parseInt(data['order_id'].slice(-8), 10);
		$('input[name=order_items]:checked').each(function(){
			var count = document.getElementById("pnum_"+order_id_s+"-"+this.value).value;
			if(count !== "" && count > 0){
				data['order_items'].push(this.value+"."+count);
			}
		});

		if(data['order_items'].length <= 0){
			G.ui.popup.showMsg('请选择报修/退换货的商品！');
			return _enableBtn();
		}

		if(!data['description']){
			var autoFocus = function(){
				$('#rma_description').focus();
			};
			G.ui.popup.showMsg('请填写产品问题描述！', autoFocus, autoFocus, autoFocus);
			return _enableBtn();
		}

		var self = G.app.mycenter.myrepair;
		//手机或者固话
		var mobile = $('input[name=contact_mobile]').val();

		if (mobile == self._CONTACT_MOBILE_DESC){ mobile = ''};

		data['contact_phone'] = '';

		data['contact_mobile'] = mobile;
		if(!data['contact_mobile']){
			var autoFocus = function(){
				$('input[name=contact_mobile]').focus();
			};
			G.ui.popup.showMsg('请填写取货手机', autoFocus, autoFocus, autoFocus);
			return _enableBtn();
		}else{
			if(mobile && !G.logic.validate.checkMobilePhone(mobile)){
				//手机格式判断
				var autoFocus = function(){
					$('input[name=contact_mobile]').focus();
				};
				G.ui.popup.showMsg('取货手机号码填写有误，格式：13612345678，请重新填写', autoFocus, autoFocus, autoFocus);
				return _enableBtn();
			}
		}
		data['order_items'] = data['order_items'].join(',');

		//报修原因
		data['is_revert_result'] = $('input[name=is_revert_result]:checked').val();

		//期望处理方式
		var request_type = 0;
		$('input[name=request_type]').each(function(){
			if($(this).is(':checked')){
				request_type = $(this).val();
			}
		});
		data['request_type'] = request_type;
		var pay_type = self._pay_type_id;
		data['pay_type'] = pay_type;//订单支付方式

		if(request_type == 3){//退货.既退款时
			var refund_type = 0,
			sel_online_pay =0;
			$('#refundinfo_tr input[name=refund_type]').each(function(){
				if($(this).is(':checked')){
					refund_type = $(this).val();
				}
			});
			data['refund_type'] = refund_type;

			//退款信息
			data = self.check_refundInfo(refund_type, data);
			if(false === data){
				return _enableBtn();
			}
		}

		//取货方式
		var fetchgoods_way = 0,
			pickup_price = '0.00元';
		$('input[name=fetchgoods_way]').each(function(){
			if($(this).is(':checked')){
				fetchgoods_way = $(this).val();
			}
		});

		data['fetchgoods_way'] = fetchgoods_way;
		//取货日期时间
		data['etake_date'] = (fetchgoods_way == 1 || fetchgoods_way == 7) ? $("#shiptime_date").val() : '';
		data['etake_time_span'] = (fetchgoods_way == 1 || fetchgoods_way == 7) ? $("#shiptime_timeSpan").val() : 0;

		//取货费用
		data['pickup_price'] = fetchgoods_way == 1 ? pickup_price.substring(0,(pickup_price.length-1)) : 0;

		//取货信息
		$.each(fieldList, function(field, fieldInfo){
			var v = '';
			if(field == 'mobile' || field == 'phone') {
				return;
			} else if(field == 'area_id'){
				v = $('#contact_' + field).data('loc').getLocId();
				if((!v || v == 0) && fieldInfo[1] == 1){
					G.ui.popup.showMsg('请选择取货' + fieldInfo[0] + '！');
					data = false;
				}
			} else {
				v = $('input[name=contact_'+field+']').val();
				if(!v && fieldInfo[1] == 1){
					var autoFocus = function(){
						$('input[name=contact_'+field+']').focus();
					};
					G.ui.popup.showMsg('请填写取货' + fieldInfo[0] + '！', autoFocus, autoFocus, autoFocus);
					data = false;
				}
			}
			if(data === false) return _enableBtn();
			data['contact_' + field] = v;
		});
		if(data === false) return _enableBtn();

		//收货信息
		//var have_revert = $('#revert_info').is(':visible');
		data['is_revert_address'] = $('input[name=is_revert_address]:checked').val();
		if(data['is_revert_address'] == 0){
			$.each(fieldList, function(field, fieldInfo){
				var v = '';
				if(field == 'area_id'){
					v = $('#revert_contact_' + field).data('loc').getLocId();
					if((!v || v == 0) && fieldInfo[1] == 1){
						G.ui.popup.showMsg('请选择收货' + fieldInfo[0] + '！');
						data = false;
					}
				}else if(field == 'mobile' || field == 'phone') {
					var revert_mobile = $('input[name=revert_contact_mobile]').val();
					var revert_phone1 = $('input[name=revert_contact_phone1]').val();
					var revert_phone2 = $('input[name=revert_contact_phone2]').val();
					var revert_phone3 = $('input[name=revert_contact_phone3]').val();
					var revert_phone = '';

					if (revert_mobile == self._REVERT_CONTACT_MOBILE_DESC){ revert_mobile = ''};
					if (revert_phone1 == self._REVERT_CONTACT_PHONE1_DESC){ revert_phone1 = ''};
					if (revert_phone2 == self._REVERT_CONTACT_PHONE2_DESC){ revert_phone2 = ''};
					if (revert_phone3 == self._REVERT_CONTACT_PHONE3_DESC){ revert_phone3 = ''};
					if(revert_phone3){
						revert_phone = revert_phone1 + '-' + revert_phone2 + '-' + revert_phone3;
					}else if(revert_phone2){
						revert_phone = revert_phone1 + '-' + revert_phone2;
					}else if(revert_phone1){
						revert_phone = revert_phone1;
					}else{
						revert_phone = '';
					}

					if(!revert_mobile  && !revert_phone){
						var autoFocus = function(){
							$('input[name=revert_contact_mobile]').focus();
						};
						G.ui.popup.showMsg('收货手机和电话号码两者至少填写一项', autoFocus, autoFocus, autoFocus);
						data = false;
					}
					if(revert_mobile && !G.logic.validate.checkMobilePhone(revert_mobile)){
						//手机格式判断
						var autoFocus = function(){
							$('input[name=revert_contact_mobile]').focus();
						};
						G.ui.popup.showMsg('收货手机号码填写有误，格式：13612345678，请重新填写', autoFocus, autoFocus, autoFocus);
						data = false;
					}
					if(revert_phone && !G.logic.validate.checkTelephone(revert_phone)){
						//固定电话格式判断
						var autoFocus = function(){
							$('input[name=revert_contact_phone1]').focus();
						};
						G.ui.popup.showMsg('收货固定电话填写有误，格式：021-61831107，请重新填写', autoFocus, autoFocus, autoFocus);
						data = false;
					}
					if(field == 'mobile'){
						v = revert_mobile;
					}
					if(field == 'phone'){
						v = revert_phone;
					}
				}else {
					v = $('input[name=revert_contact_'+field+']').val();
					if(!v && fieldInfo[1] == 1){
						var autoFocus = function(){
							$('input[name=revert_contact_'+field+']').focus();
						};
						G.ui.popup.showMsg('请填写收货' + fieldInfo[0] + '！', autoFocus, autoFocus, autoFocus);
						data = false;
					}
				}
				if(data === false) return _enableBtn();
				data['revert_contact_' + field] = v;
			});
		}

		if(data === false) return _enableBtn();

		//上传图片
		var pictures = [];
		for(var k in G.app.mycenter.myrepair.upload){
			pictures.push(G.app.mycenter.myrepair.upload[k]);
		}
		data["pictures"] = pictures.join("|");

		G.util.post('http://' + G.DOMAIN.BASE_ICSON_COM + '/json.php?mod=myrepair&act=add&fmt=1&uid=' + uid, data, function(o){
			G.app.mycenter.myrepair._submit = 1;
			$('#rma_submit_btn')[0].disabled = true;
			if(o && o.errno == 0){
				/*
				var jump = function(){
					location.href = 'http://base.51buy.com/myrepair.html';
				};
				G.ui.popup.showMsg('您的报修/退换货申请已经成功提交，我们会尽快处理！', 3, jump, jump, jump);
				*/

				location.href = "http://base.51buy.com/index.php?mod=myrepair&act=success&rma_id=" + o.data;

			} else {
				G.app.mycenter.myrepair._submit = 0;
				$('#rma_submit_btn')[0].disabled = false;
				var em = {
					6002	: '该订单尚未出库，无法提交报修/退换货'
				};
				if(o && o.errno == 6004){
					return G.ui.popup.showMsg((G.app.mycenter.myrepair._products[o.data] ? G.app.mycenter.myrepair._products[o.data].name : '部分商品') + '已经申请过报修退换货，请重新选择', 1);
				}
				if(o && em[o.errno]){
					G.ui.popup.showMsg(em[o.errno], 1);
				}else{
					G.ui.popup.showMsg('对不起，提交失败', 1);
				}
			}
		});
	},

	check_refundInfo: function(refund_type, data){
		var fieldList = {
				'sel_online_pay' : ['开户银行', 1],
				'area_id_bank'	: ['开户城市', 1],
				'sel_refund_bank'	: ['开户支行', 1],
				'account_name'	: ['开户人姓名', 1],
				'account_no'	: ['银行账号', 1],
				'account_no2'	: ['银行账号', 1],
				'mobile_phone_bank'	: ['手机号码', 1]
			};
		if(refund_type == 2){//退款至银行卡信息核实
			$.each(fieldList, function(field, fieldInfo){
				var v = '',
				sel_online_pay =0;
				if(field == 'sel_online_pay'){
					$('input[name=sel_online_pay]').each(function(){
						if($(this).is(':checked')){
							sel_online_pay = $(this).val();
						}
					});
					if(sel_online_pay == 0){
						G.ui.popup.showMsg('请选择' + fieldInfo[0] + '！');
						data = false;
					}
					v = sel_online_pay;
				} else if(field == 'area_id_bank'){
					v = $('#refund_area_id').data('loc').getLocId();
					var provinceID = $('#refund_area_id select:eq(0)').val();
					var provinceName = $('#refund_area_id select:eq(0) option[value='+provinceID+']').text();
					var cityID = $('#refund_area_id select:eq(1)').val();
					var cityName = $('#refund_area_id select:eq(1) option[value='+cityID+']').text();
					data['bank_cityName'] = provinceName + ' ' + cityName;//开户城市名称
					if((!v || v == 0) && fieldInfo[1] == 1){
						G.ui.popup.showMsg('请选择' + fieldInfo[0] + '！');
						data = false;
					}
				}else if(field == 'sel_refund_bank'){//开户支行
					if($('#sel_refund_bank').is('select')){
						v = $('#sel_refund_bank').val();
						data['refund_bankName'] = $('#sel_refund_bank option[value='+v+']').text();//开户支行名称
						if(v == 0){
							G.ui.popup.showMsg('请选择对应的支行！');
							data = false;
						}
					}else{
						data['refund_bankName'] = $.trim($('#sel_refund_bank').val());//开户支行名称
						v = 99999;
						if(data['refund_bankName'] == '' || data['refund_bankName'].length <=0){
							var autoFocus = function(){
								$('#sel_refund_bank').focus();
							};
							G.ui.popup.showMsg('请输入对应的支行！', autoFocus, autoFocus, autoFocus);
							data = false;
						}
					}
				}else if(field == 'mobile_phone_bank'){//手机格式判断
					v = data['contact_mobile'];
					/*
					var mobile = $('input[name=mobile_phone]').val();
					if (mobile == self._CONTACT_MOBILE_DESC){ mobile = ''};
					if(mobile && !G.logic.validate.checkMobilePhone(mobile)){
						var autoFocus = function(){
							$('input[name=mobile_phone]').focus();
						};
						G.ui.popup.showMsg('手机号码填写有误，格式：13612345678，请重新填写', autoFocus, autoFocus, autoFocus);
						data = false;
					}
					v = mobile;
					if(!v && fieldInfo[1] == 1){
						var autoFocus = function(){
							$('input[name=mobile_phone]').focus();
						};
						G.ui.popup.showMsg('请填写手机号码！', autoFocus, autoFocus, autoFocus);
						data = false;
					}*/
				}else if(field == 'account_no2'){
					var account_no2 = $('input[name=account_no2]').val();
					if(!account_no2){
						var autoFocus = function(){
							$('input[name=account_no2]').focus();
						};
						G.ui.popup.showMsg('请再次输入银行帐号！', autoFocus, autoFocus, autoFocus);
						data = false;
					}else{
						//两次帐号比较
						if(account_no2 != data["account_no"]){
							G.ui.popup.showMsg('为保证您的退款能及时准确到账，请您仔细核对您输入的结果。！', autoFocus, autoFocus, autoFocus);
							data = false;
						}
					}
				}else {
					v = $('input[name='+field+']').val();
					if(!v && fieldInfo[1] == 1){
						var autoFocus = function(){
							$('input[name='+field+']').focus();
						};
						G.ui.popup.showMsg('请填写' + fieldInfo[0] + '！', autoFocus, autoFocus, autoFocus);
						data = false;
					}
				}
				if(data === false) return false;
				data[field] = v;
			});
		}else{
			var _lianhua = $('#lianhua_ok_id').is(':hidden'),
				_yicheng = $('#yicheng_id').is(':hidden');
			if(_lianhua == false){//退款至联华OK卡
				data['refund_type'] = 3;
				var lh_val = $.trim($('#lianhua_ok_id').val());
				var autoFocus = function(){
					$('#lianhua_ok_id').focus();
				};
				if(!lh_val && lh_val.length <= 0){
					G.ui.popup.showMsg('请填写联华OK卡卡号！', autoFocus, autoFocus, autoFocus);
					data = false;
				}
				if(lh_val && (lh_val.length != 9 || lh_val.length != 10)){
					G.ui.popup.showMsg('联华OK卡卡号填写有误，联华OK卡号必须是9位或10位纯数字！', autoFocus, autoFocus, autoFocus);
					return false;
				}
				data['lianhua_ok_id'] = lh_val;
			}

			if(_yicheng == false){//退款至一城卡
				data['refund_type'] = 3;
				var yc_val = $.trim($('#yicheng_id').val());
				var autoFocus = function(){
					$('#yicheng_id').focus();
				};
				if(!yc_val && yc_val.length <= 0){
					G.ui.popup.showMsg('请填写一城卡卡号！', autoFocus, autoFocus, autoFocus);
					return false;
				}
				if(yc_val && yc_val.length != 16){
					G.ui.popup.showMsg('一城卡卡号填写有误，一城卡号必须是16位纯数字！', autoFocus, autoFocus, autoFocus);
					return false;
				}
				data['yicheng_id'] = yc_val;
			}
		}

		if(data === false){
			return false;
		}else{
			return data;
		}
	},

	//期望处理方式点击事件
	requestType: function(){
		$("#show_return_tips").hide();
		var ck = parseInt($(this).val());
		switch(ck){
			case 1:
				$('#refundinfo_tr').hide();
				break;
			case 2:	//换货
				$('#refundinfo_tr').hide();
				$("#show_return_tips_arrow").css({left : "80px"});
				$("#show_return_tips p").html("申请退换货时，请将商品发票、附件（含说明书/保修卡）商品配件一并寄回，并请尽量保证商品外包装完整。");
				$("#show_return_tips").show();
				break;
			case 3:	//退货
				$("#show_return_tips_arrow").css({left : "22px"});
				$("#show_return_tips p").html("申请退换货时，请将商品发票、附件（含说明书/保修卡）商品配件一并寄回，并请尽量保证商品外包装完整。<br />请将所有赠品一并退回。");
				$('#refundinfo_tr, #show_return_tips').show();
				$('#refund_type_1').attr('checked','checked');
				$('#bank_box_ba').hide();
				G.app.mycenter.myrepair.show_refund();//退款方式点击事件
				break;
		}
	},

	//填写申请页面加载事件
	initReport	: function(){
		G.app.mycenter.myrepair._initQueryData();
		var self = G.app.mycenter.myrepair,
			box_ba_css =  $('#bank_box_ba').css('display'),
			pay_type = self._pay_type_id,
			//currWhId = (G.util.cookie.get('wsid') == '' || G.util.cookie.get('wsid') == '3001' || G.util.cookie.get('wsid') == null) ? 1 : G.util.cookie.get('wsid');//获取当前站点的cook值
			currWhId = (G.util.cookie.get('wsid') == '' || G.util.cookie.get('wsid') == null) ? 1 : G.util.cookie.get('wsid');//modify by allenzhou 20120911 去掉武汉站的外壳
		$('#bank_box_ba').css('display','none');
		$('#request_type_1').attr('checked','checked');//默认选择处理方式:报修
		$('#refundinfo_tr').css('display','none');//隐藏退款方式
		$('#rma_order_id_query').click(self.getItemsOfOrder);
		$('#rma_submit_btn').click(self.submitReport);

		//选择取货地区
		$.each(['#contact_area_id', '#revert_contact_area_id'], function(k, area_id){
			var loc = self.location.locSelection(0),
				$this = $(area_id);

			$this.empty().append(loc);
			$this.data('loc', loc);
		});

		//取货地址修改
		$("#pickup_address_edit_btn").click(function(){
			$("#pickup_address_view").hide();
			$("div.pickup_address_edit").show();
		});

		//地址修改完成
		$("#pickup_address_edit_done").click(function(){
			var addr = "";
			var dom1 = $('#contact_area_id select:eq(0)')[0];
			addr += dom1.options[dom1.selectedIndex].text;

			var dom2 = $('#contact_area_id select:eq(1)')[0];
			if(dom2.options[dom2.selectedIndex].text == "请选择"){
				G.ui.popup.showMsg("请选择具体省市。", 2);
				return;
			}


			addr += dom2.options[dom2.selectedIndex].text;

			var dom3 = $('#contact_area_id select:eq(2)')[0];
			if(dom3){
				addr += dom3.options[dom3.selectedIndex].text;
				if(dom3.options[dom3.selectedIndex].text == "请选择"){
					G.ui.popup.showMsg("请选择具体省市。", 2);
					return;
				}
			}
			addr += $("#pickup_Detailaddress").val();

			$("#pickup_address_view_value").html(addr);
			$("#pickup_address_view").show();
			$("div.pickup_address_edit").hide();
		});

		//选择开户城市
		if(box_ba_css == 'block'){
			$.each(['#refund_area_id'], function(k, area_id){
				var loc = self.location2.locSelection(0),
					$this = $(area_id);

				$this.empty().append(loc);
				$this.data('loc', loc);
			});
		}

		var paras = G.util.parse.url(),
			order_id = paras.search.orderid || paras.hash.orderid;
		/*
		if(order_id){
			$('#rma_order_id').val(order_id);
			$('#rma_order_id_query').click();
		}else{
			self.get_fetchgoods_way2(currWhId);
		}*/

		//取货方式radio
		$('#fetchgoods_way_2').attr('checked','checked');//默认邮寄给易迅网
		$('#fetchgoods_way2').show();
		$('#fetchgoods_way1, #fetchgoods_way3').hide();
		$('input[name=fetchgoods_way]').click(function(){
			var ck = parseInt($(this).val());
			switch(ck){
				case 1:
				case 7:
					$('#fetchgoods_way1').show();
					$('#fetchgoods_way2, #fetchgoods_way3').hide();
					break;
				case 2:
					if(!order_id){
						self.get_fetchgoods_way2(currWhId);
					}
					$('#fetchgoods_way2').show();
					$('#fetchgoods_way1, #fetchgoods_way3').hide();
					break;
				case 3:
					$('#fetchgoods_way3').show();
					$('#fetchgoods_way1, #fetchgoods_way2').hide();
					break;
			}
		});

		//取货地址是否自定义radio
		$('input[name=is_revert_address]').click(function(){
			$('#revert_contact_info').css('display', $(this).val() == 1 ? 'none' : '');
		});

		/*var paras = G.util.parse.url(),
			order_id = paras.search.orderid || paras.hash.orderid;
		if(order_id){
			$('#rma_order_id').val(order_id);
			$('#rma_order_id_query').click();
		}*/

		//取货日期下拉框事件
		$("#shiptime_date").change(function(){
			var v = $(this).val(),
				alldate = $(this).data("alldate");
			if(alldate && alldate[v]){
				var shipTimeSpan = '';
				$.each(alldate[v].timeSpan, function(k, tvalue){
					shipTimeSpan += '<option value=' + k + '>' + tvalue + '</option>';
				});
				$('#shiptime_timeSpan').html(shipTimeSpan);
			}
		});

		//取货收获手机电话号码默认值
		var editBox = $('#contact_info');
		G.ui.tips.swapInput({
			target	: $('input[name=contact_mobile]', editBox),
			defaultValue	: self._CONTACT_MOBILE_DESC,
			blurClass	: 'nor'
		}).blur();

		var revert_editBox = $('#revert_contact_info');
		G.ui.tips.swapInput({
			target	: $('input[name=revert_contact_mobile]', revert_editBox),
			defaultValue	: self._REVERT_CONTACT_MOBILE_DESC,
			blurClass	: 'nor'
		}).blur();
	},

	recovery : function() {
	},

	location	: {
		_loc	: false,
		getLocInfo	: function(district){
			if(!G.util.area) return false;

			var self = G.app.mycenter.myrepair.location;
			if(self._loc === false){
				self._loc = {};
				$.each(G.util.area, function(pid, pinfo){
					$.each(pinfo.l, function(cid, cinfo){
						$.each(cinfo.l, function(did, dname){
							// [名称,省份ID,省份名称,城市ID,城市名称]
							self._loc[did] = [
								dname,
								pid,
								pinfo.n,
								cid,
								cinfo.n
							];
						});
					});
				});
			}

			var loc = self._loc[district];
			if(!loc) return false;

			return {
				name	: loc[0],
				provinceId	: loc[1],
				provinceName	: loc[2],
				cityId	: loc[3],
				cityName	: loc[4]
			};
		},

		locSelection	: function(district){
			var htm = ['<select class="sl75"><option value="0">请选择</option>'];
			$.each(G.util.area, function(pid, pinfo){
				htm.push('<option value="'+pid+'">'+pinfo.n+'</option>');
			});
			htm.push('</select> <select class="sl120"><option value="0">请选择</option></select> <select class="sl75"><option value="0">请选择</option></select>');

			var j = $(htm.join(''));

			var p = j.filter('select:eq(0)');
			var c = j.filter('select:eq(1)');
			var d = j.filter('select:eq(2)');

			p.change((function(_, __, ___){
				return function(){
					var pid = _.val();

					var cHtm = ['<option value="0">请选择</option>'];
					if(G.util.area[pid]){
						$.each(G.util.area[pid].l, function(cid, cinfo){
							cHtm.push('<option value="'+cid+'">'+cinfo.n+'</option>');
						});
					}

					__.empty().html(cHtm.join(''));
					__.hide()[0].style.display = '';

					__.change();
				};
			})(p, c, d));

			c.change((function(_, __, ___){
				return function(){
					var pid = _.val();
					var cid = __.val();

					var dHtm = ['<option value="0">请选择</option>'];
					if(G.util.area[pid] && G.util.area[pid].l[cid]){
						var r = $.extend({}, G.util.area[pid].l[cid].l);
						var l = [];
						$.each(r, function(k, v){
							l.push({
								id	: k,
								name	: v
							});
						});

						l.sort(function(a, b){
							return a.name.toString().localeCompare(b.name.toString());
						});

						$.each(l, function(kk, dInfo){
							dHtm.push('<option value="'+dInfo.id+'">'+dInfo.name+'</option>');
						});
						l = null;
					}
					___.empty().html(dHtm.join(''));
					___.hide()[0].style.display = '';
				};
			})(p, c, d));

			//区域变化事件
			d.change(function(){
				G.app.mycenter.myrepair.judgeFetchTime();
			});

			j.setLocation = function(dist){
				var p = $(this).filter('select:eq(0)'),
					c = $(this).filter('select:eq(1)'),
					d = $(this).filter('select:eq(2)');
				var ddInfo = G.app.mycenter.myrepair.location.getLocInfo(dist);
				if(ddInfo !== false){
					p.val(ddInfo.provinceId).change();
					setTimeout(function(){
						c.val(ddInfo.cityId).change();
						setTimeout(function(){
							d.val(dist);
						}, 1);
					}, 1);
				} else {
					p.val(0);
					p.change();
				}
			};
			j.getLocId = function(){
				return $(this).filter('select:eq(2)').val();
			};

			j.setLocation(district);
			//取货地区发生改变时触发
			j.uonchange = function(func){
				$(this).filter('select:eq(1)').change(func);
				$(this).filter('select:eq(2)').change(func);
			};
			return j;
		},

		getLocName	: function(district){
			var self = G.app.mycenter.myrepair.location;
			var dInfo = self.getLocInfo(district);
			if(dInfo === false) return '';

			return dInfo.provinceName + dInfo.cityName + dInfo.name;
		}
	},

	_encode	: function(arr){
		var newArr = {};
		$.each(arr, function(k, v){
			if($.type(v) == 'string'){
				newArr[k] = G.util.parse.encodeHtml(v);
			} else {
				newArr[k] = v;
			}
		});
		return newArr;
	},

	initApplyList	: function(){
		//点击页面其他地方隐藏tips
		$(document).click(function(e){
			if($(".id_layout_repair:visible").size()>0){
				$(".id_layout_repair").hide();
			}
		});

		this.myrepair_linktrack();//流水跟踪查询
		this.SurveyClick();//满意度调查
	},


	//处理情况查询跟踪状态
	myrepair_linktrack: function(){
	$("a.link_track").hover(function(){
	    var self = $(this), parent = self.parent();
	    clearTimeout(self.data('timer'));
		parent.addClass("status_layout_on");

		if(!self.data("requested")){
			var str =  '<table class="table_info" style="width:100%"><colgroup><col class="col1"><col class="col2"></colgroup>';
			str+= '<thead><tr><td>处理时间</td><td>处理信息</td></tr></thead>';
			str+='<tbody class="js_tbody"><tr><td colspan="2" style="text-align:center;padding:5px">正在请求，请稍后...</td></tr></tbody>';
			str+='<tfoot class="js_tfooter" style="display:none"><tr><td colspan="2"></td></tr></tfoot></table>';
			parent.find(".layout_bd").html(str);
			self.data("requested", true);
			parent.find(".layout_popup").unbind('mouseenter').unbind('mouseleave').hover(function(){
			    clearTimeout(self.data('timer'));
				parent.addClass("status_layout_on");
			}, function(){
				parent.removeClass("status_layout_on");
			});
			$.ajax({
				"timeout" : 1000 * 10,
				"dataType" : "jsonp",
				"type": "get",
				"url" : 'json.php?mod=myrepair&act=repairflownew&reqid=' +self.attr("req_sysno"),
				"success" : function(json){
					var str = '', sumTime = null;
					if( null === json){
						str = '<tr><td colspan="2">网络错误</td></tr>';
					}
					else{
						if(json.errno == 0){
							var data = json.data;
							for(var i in data){
								var item = data[i];
								str+= '<tr><td>'+item['time']+'</td><td>'+item['content']+'</td></tr>';
							}

							self.data("inner_html", str);
						}
						else{
							str = '<tr><td colspan="2">' + ( json.data ||  '查询处理情况流水失败' ) + '</td></tr>';
						}
					}

					if( null !== sumTime){
						parent.find(".js_tfooter").css("display", "").html(sumTime);
					}

					parent.find(".js_tbody").html(str);
			}, "error" : function(){self.data("requested", false)}});
		}
	  }, function(){
		  	var self = $(this);
	    	clearTimeout(self.data('timer'));
		var timer = setTimeout(function(){
			self.parent().removeClass("status_layout_on");
		}, 100);
		self.data('timer', timer);
	  });
	},

	//处理情况查询
	myrepair_Requestinit: function(){
		this.myrepair_linktrack();
	},

	//报修/退换货详情
	myrepairInfo_init: function(){
		var regist_id = $("#order_tbody").attr('regist_id'),
			rdate = $("#order_tbody").attr('rdate'),
			req_sysno = $("#order_tbody").attr('req_sysno');

		this.myrepairInfo_getLogFlow(regist_id, rdate, req_sysno);
	},

	//报修/退换货详情---状态跟踪
	myrepairInfo_getLogFlow: function(regist_id, rdate, req_sysno){
		var container = $("#order_tbody"), cache = '';
		$.ajax({
			"timeout" : 1000 * 10,
			"dataType" : "jsonp",
			"type": "get",
			//"url" : 'json.php?mod=myrepair&act=repairflow&req_sysno=' + req_sysno,
			"url" : 'json.php?mod=myrepair&act=repairflowlog&rdate=' + rdate + '&regist_id=' +regist_id + '&req_sysno=' +req_sysno,
			"success" : function(json){
				var str = '', sumTime = null;
				if( null === json){
					str = '<tr><td colspan="2">网络错误</td></tr>';
				}
				else{
					if(json.errno == 0){
						var data = json.data;
						for(var i in data){
							var item = data[i];
							str+= '<tr><td class="left">'+item['time']+'</td><td>'+item['content']+'</td></tr>';
						}
						cache =  str;
						container.html(str);
					}
					else{
						str = '<tr><td colspan="2">' + ( json.data ||  '查询处理情况流水失败' ) + '</td></tr>';
						container.html(str);
					}
			}
		}
	});
	container.html('<tr><td colspan="2">正在查询，请稍候...</td></tr>');
},

	//站点切换所需
	switchSite: function(siteId,orderID) {
		var self = arguments.callee;
		if (!this.xhr) {
			var version = 1.4;
			self.xhr = $.ajax({
				type: "GET",
				timeout: 30 * 1000,
				scriptCharset	: 'gb2312',
				url: 'http://' + G.DOMAIN.ST_ICSON_COM + '/static_v1/js/app/switchSite.js?v=' + version,
				dataType: 'script',
				cache	: true,
				crossDomain	: true
			});
		}

		self.xhr.done(function() {
			G.app.switchSite.tryToSwitchTo(siteId, location.href);
		}).fail(function() {
			G.ui.popup.showMsg("抱歉，切换分站失败，请您稍后再试。", 2);
		});
	},

	//根据当前站点或者订单出库站点动态显示 邮寄给易迅网 选项里的内容
	get_fetchgoods_way2: function(whid){
		whid = parseInt(whid, 10);
		switch(whid){
			case 1:
				$('#fetchgoods_way2_address').empty().html('上海市奉贤区肖湾路311号（近环城东路） 易迅网售后服务部（收）<br/>邮编：201400<br/>联系电话：400-828-1878');
				break;
			case 1001:
				$('#fetchgoods_way2_address').empty().html('深圳龙岗区五联街道办朱古石路92号明利五金厂旁边<br/>易迅网售后服务部 （收）<br/>邮编：518116<br/>联系电话：400-828-6699转3 （周一至周六 09：00-18：00）');
				break;
			case 2001:
				$('#fetchgoods_way2_address').empty().html('北京市大兴区黄村镇太福庄村村委向南500米（芦求路周村对面）凯通物流院内  易迅网售后服务部 （收）<br/>邮编：201400<br/>联系电话：400-828-0055转3 （周一至周六 09：00-18：00）');
				break;
			case 3001:
				$('#fetchgoods_way2_address').empty().html('武汉市东湖高新区佛祖岭二路与东园南路交汇处（光谷大道走到底堆场处，赤湾东方物流院) 易迅网售后服务部 （收）<br/>邮编：430000<br/>联系电话：400-828-0055');
				break;
			case 4001:
				$('#fetchgoods_way2_address').empty().html('重庆市南岸区茶园新区长江工业园茶涪路美的空调基地1号仓库  易迅网售后服务部 （收）<br/>邮编：404100<br/>联系电话：400-828-6699转3 （周一至周六 09：00-18：00）');
				break;
			case 5001:
				$('#fetchgoods_way2_address').empty().html('西安市经济技术开发区凤城七路明光路交汇处陕西商储仓库  易迅网售后服务部 （收）<br/>邮编：710020<br/>联系电话：400-828-0055');
				break;
			default:
				$('#fetchgoods_way2_address').empty().html('上海市奉贤区肖湾路311号（近环城东路）易迅网售后服务部（收）<br/>邮编：201400<br/>联系电话：400-828-1878');
		}
	},

	//满意度调查
	SurveyClick : function(){
		var that = this;

		var _layer = $("#satisfaction_layer");
		$("body").append(_layer);

		var _post = function(type, question, suggest){
			G.util.post('http://' + G.DOMAIN.BASE_ICSON_COM + '/json.php?mod=myrepair&act=satisfactionadd', {
				request_sysno	: G.app.mycenter.myrepair._request_id,
				order_id		: G.app.mycenter.myrepair._order_id,
				add_type		: type,
				question		: question.join(","),
				suggestions		: suggest
			}, function(o){
				if(o && o.errno == 500){//未登录
					return G.logic.login.popup();
				}

				if(o && o.errno == 0){
					var _reload = function(){
						window.location.reload();
						return false;
					}
					return G.ui.popup.showMsg('感谢您的支持及评价！', 3, _reload,_reload,_reload, null, null);
				}else if(o && o.errno == 7){
					return G.ui.popup.showMsg('该条满意度评价您之前已经提交过啦！');
				}else{
					if(o.msg){
						return G.ui.popup.showMsg(o.msg);
					}else{
						return G.ui.popup.showMsg('提交满意度评价失败！');
					}
				}
			});
		}

		_layer.find("a").click(function(e){
			//选择满意
			if(e.target.id === "satisfaction_layer_yes"){
				_post(1, [], "");
			}else if(e.target.id === "satisfaction_layer_no"){
				$("#satisfaction_layer_more").toggle("slow");
			}
		});

		$(document).bind('click', function(e) {
			if(!$(e.target).hasClass('bx_manyi_layer')) {
				if($(e.target).parents("#satisfaction_layer").length == 0){
					_layer.hide();
				}
			}
		});

		//输入字数
		$("#satisfaction_layer_text").bind('input', function(e) {
			var inputNum = $(this).val().length;
			$("#satisfaction_layer_text_count").html(inputNum);
		});

		//点击提交
		$("#satisfaction_layer_btn").click(function(){
			var question = [];
			var suggestions = $.trim($("#satisfaction_layer_text").val());
			$("#satisfaction_layer input[name=satisfaction_check]:checked").each(function(idx, ele){
				question.push(ele.value);
			});

			if(question.length === 0){
				return;
			}

			_post(2, question, suggestions);
		});

		$('#applylist .survey_link').click(function(){
			if($(".J_layoutZiXun:visible").size() > 0){
				$(".J_layoutZiXun").hide();
			}
			$("#satisfaction_layer_more").hide();

			G.app.mycenter.myrepair._request_id = this.getAttribute("survey_link");
			G.app.mycenter.myrepair._order_id = this.getAttribute("soid");

			for(var i = 1; i <= 3; i ++){
				var html = "";
				for(var n in _SATISFACTION_QUESTIONS[i]){
					html += '<div class="bx_manyi_row"><label class="chk_wrap"><input value="'+i+'_'+n+'" name="satisfaction_check" type="checkbox">'+_SATISFACTION_QUESTIONS[i][n]+'</label></div>';
				}
				$("#satisfaction_layer_question_"+i).html(html);
			}

			var this_h = $(this).height(),
				this_w = $(this).width(),
				offset = $(this).offset(),
				offset_left = offset.left,
				offset_top = offset.top,
				request_sysno = $(this).attr('survey_link'),
				soid = $(this).attr('soid');

			var _layer = $("#satisfaction_layer");
			_layer.css('top', offset_top + this_h + 10 + 'px');
			_layer.css('left', offset_left + this_w - 300 + 'px');
			_layer.toggle();

			return false;
		});
	},

	location2	: {
		_loc	: false,
		getLocInfo	: function(district){
			if(!G.util.area) return false;

			var self = G.app.mycenter.myrepair.location2;
			if(self._loc === false){
				self._loc = {};
				$.each(G.util.area, function(pid, pinfo){
					$.each(pinfo.l, function(cid, cinfo){
						$.each(cinfo.l, function(did, dname){
							// [名称,省份ID,省份名称,城市ID,城市名称]
							self._loc[did] = [
								dname,
								pid,
								pinfo.n,
								cid,
								cinfo.n
							];
						});
					});
				});
			}

			var loc = self._loc[district];
			if(!loc) return false;

			return {
				name	: loc[0],
				provinceId	: loc[1],
				provinceName	: loc[2],
				cityId	: loc[3],
				cityName	: loc[4]
			};
		},

		locSelection	: function(district){
			var htm = ['<select><option value="0">请选择</option>'];
			$.each(G.util.area, function(pid, pinfo){
				htm.push('<option value="'+pid+'">'+pinfo.n+'</option>');
			});
			htm.push('</select> <select><option value="0">请选择</option></select>');

			var j = $(htm.join(''));

			var p = j.filter('select:eq(0)');
			var c = j.filter('select:eq(1)');

			p.change((function(_, __){
				return function(){
					var pid = _.val();

					var cHtm = ['<option value="0">请选择</option>'];
					if(G.util.area[pid]){
						$.each(G.util.area[pid].l, function(cid, cinfo){
							cHtm.push('<option value="'+cid+'">'+cinfo.n+'</option>');
						});
					}

					__.empty().html(cHtm.join(''));
					__.hide()[0].style.display = '';

					__.change();
				};
			})(p, c));

			j.setLocation = function(dist){
				var p = $(this).filter('select:eq(0)'),
					c = $(this).filter('select:eq(1)');
				var ddInfo = G.app.mycenter.myrepair.location2.getLocInfo(dist);
				if(ddInfo !== false){
					p.val(ddInfo.provinceId).change();
					setTimeout(function(){
						c.val(ddInfo.cityId).change();
						setTimeout(function(){
							d.val(dist);
						}, 1);
					}, 1);
				} else {
					p.val(0);
					p.change();
				}
			};
			j.getLocId = function(){
				return $(this).filter('select:eq(1)').val();
			};

			j.setLocation(district);
			return j;
		},

		getLocName	: function(district){
			var self = G.app.mycenter.myrepair.location2;
			var dInfo = self.getLocInfo(district);
			if(dInfo === false) return '';

			return dInfo.provinceName + dInfo.cityName + dInfo.name;
		}
	},





	//以下nonojiang增加

	_initQueryData	: function(){
		//?items=1001004255.08-516-289.1
		G.app.mycenter.myrepair._queryData = {
						order	: false,
						items	: false
		}
		if(window.location.search.indexOf("?items=") != -1){
			var arr = window.location.search.split("?items=")[1].split(".");
			if(arr.length > 2){
				var orderid = arr[0];
				var items = {}, lastitem = "";
				for(var i = 1; i < arr.length; i ++){
					if(i%2 === 1){
						items[arr[i]] = 1;
						lastitem = arr[i];
					}else{
						items[lastitem] = arr[i];
					}
				}
				G.app.mycenter.myrepair._queryData = {
								order	: orderid,
								items	: items
				}
				document.getElementById("rma_order_id").value = orderid;
				setTimeout(function(){
					document.getElementById("rma_order_id_query").click();
				}, 500);
			}
		}

		//选择商品
		$("#order_items_select input.mdr").live("click", function(){
			G.app.mycenter.myrepair.judgeFetchTime();
		});

		(function(){
			var that = G.app.mycenter.myrepair,
			doc = document,

			_uploadSort = function(){
				var n = 0;
				var html = "";
				for(var i in that.upload){
					if(that.upload[i] === "uploading"){
						html += "<span id='complaint_upload_"+i+"' class='img_wrap'><img src='http://pics2.paipaiimg.com/update/20121203/my_loading_icon.png' alt='图片上传中' /><a href='javascript:void(0);' title='取消上传' imgkey='"+i+"' class='del_img alpha-layer'>&times;</a></span>";
					}else{
						html += "<span id='complaint_upload_"+i+"' class='img_wrap'><img width='60px' height='60px' src='"+G.app.mycenter.myrepair.upload[i]+"' /><a href='javascript:void(0);' title='删除图片' imgkey='"+i+"' class='del_img alpha-layer'>&times;</a></span>";
					}
					n ++;
				}
				doc.getElementById("complaint_upload_item").innerHTML = html;
				if(n >= 5){
					doc.getElementById("complaint_upload_start").style.display = "none";
				}else{
					doc.getElementById("complaint_upload_start").style.display = "block";
				}
			},

			_picUpload = function(key){
				var imgtype = 0;
				var file =  $("#upload_input").val();
				var toFileId = key;
				if(file != ""){
					/*
					if(file.match(/.jpg/i)){
						imgtype = 2;
					}else if(file.match(/.gif/i)){
						imgtype = 1;
					}else{
						alert("图片类型或者大小不符合条件,请上传1M以内的JPG或GIF格式的图片");
						delete that.upload[key];
						that.uploadFlag	= false;
						that.uploadSort();
						$("#upload_input").val("");
						return;
					}*/
					$("#upload_imgtype").val(imgtype);
					$("#upload_field").val(toFileId);
					$("#complaint_upload_form").submit();
					return;
				}
			},

			_pictureUpload = function(){
				var key = Math.random() * 999999 | 0;
				that.upload[key] = "uploading";
				that.uploadFlag	= true;
				_picUpload(key);
				_uploadSort();
			}

			that.uploadFlag = false;
			that.upload = {};
			that.uploadSort = _uploadSort;

			$("#upload_input").change(function(){
				if(that.uploadFlag){
					alert("图片上传中，请等待");
					return;
				}
				_pictureUpload();
			});

			$("#complaint_upload_item a.del_img").live("click", function(){
				var key = this.getAttribute("imgkey");
				var upload = that.upload;
				if(upload[key]){
					if(upload[key] === "uploading"){
						that.uploadFlag = false;
					}
					delete upload[key];
					that.uploadSort();
				}
			});

			document.getElementById("target_callback").callback = function(data){
				if(data.errno == 0){
					that.upload[data.toFileId] = data.data.attachment;
				}else{
					delete that.upload[data.toFileId];
					alert(data.msg);
				}
				that.uploadFlag	= false;
				that.uploadSort();
				$("#upload_input").val("");
			}
		})();
	},

	_getGoodTable : function(item, order_id){
		var itemkey = order_id + "-" + item.product_id;
		var attr = item.canapplycount == 0 ? "disabled" : (this._queryData.items[item.product_id] ? "checked" : "");
		var html = "<table class='goods_table'>";
		html += "<tbody>";
		html += '<tr>';
		html += "<td class='check_box'><input style='display:none;' class='mdr' type='radio' id='order_items_"+item.product_id+"' name='order_items' "+attr+" pro_weight='"+item.weight+"' value='"+item.product_id+"' /></td>";
		html += "<td class='goods_img'><a href='"+this._getItemUrl(item.product_id)+"' target='_blank'><img width='60px' height='60px' src='"+this._getItemPic(item.product_char_id)+"' /></a></td>";
		html += "<td class='goods_detail'><p class='goods_name_price'><a href='"+this._getItemUrl(item.product_id)+"' target='_blank'>"+item.name+"</a></p>";
		if(item.gift){
			html += "<div class='goods_gift'>";
			for(var l in item.gift){
				html += "<p class='goods_gift_con'><label><input type='checkbox'> <em>[赠品]</em> "+item.gift[l].name+"</label></p>";
			}
			html += "</div>";
		}
		html += "</td>";
		html += "</tbody>";
		html += '</table>';

		return html;
	},

	_getSelectedItems	: function(data){
		var that = this;
		var html = "<table class='' style='width: 100%;'>";
		html += '<tr><th class="bx_cf_appygoodsname">申请退换货商品名称</th><th class="bx_cf_appygoodsnum">申请退换货商品数量</th><th class="bx_cf_appygoodsamount">退换货商品金额</th></tr>';
		for(var i in data.items){
			var itemkey = data.order_id + "-" + data.items[i].product_id;
			var selected = that._queryData.items[data.items[i].product_id] ? true : false;
			var attr = data.items[i].canapplycount == 0 ? "disabled" : (selected ? "checked" : "");
			if(selected){
				html += "<tr>";
				html += "<td class='bx_cf_appygoodsname'>";
				html += that._getGoodTable(data.items[i], data.order_id);
				html += "</td>";
				html += "<td class='bx_cf_appygoodsnum'><span class='wrap_input'><span class='jian' onclick='G.app.mycenter.myrepair.addPnum(\""+itemkey+"\", -1);return false;'>-</span><span class='input'><input type='text' id='pnum_"+itemkey+"' value='"+(that._queryData.items[data.items[i].product_id] ? that._queryData.items[data.items[i].product_id] : data.items[i].canapplycount)+"' numlimit='"+data.items[i].canapplycount+"' numlowest='1' onblur='G.app.mycenter.myrepair.addPnum(\""+itemkey+"\",0);'></span><span class='jia' onclick='G.app.mycenter.myrepair.addPnum(\""+itemkey+"\",1);return false'>+</span></span>件</td>";
				html += "<td class='bx_cf_appygoodsamount'><span class='price'>&yen;"+(data.items[i].price/100)+"</span></td>";
				html += "</tr>";
			}
		}
		html += "</table>";
		return html;
	},

	_getItemPic : function(pid){
		var arr = pid.split("-");
		return "http://img2.icson.com/product/small/"+arr[0]+"/"+arr[1]+"/"+pid+".jpg";
	},

	_getItemUrl : function(pid){
		return "http://item.51buy.com/item-"+pid+".html";
	},

	_timeToDate : function (time, d) {
		if (time == 0 || !time) {
			return '';
		}
		var dt = new Date();
		dt.setTime(time * 1000);
		var mon = dt.getMonth() + 1;
		if (mon < 10) {
			mon = "0" + mon;
		}
		var day = dt.getDate();
		if (day < 10) {
			day = "0" + day;
		}
		var date = dt.getFullYear() + "-" + mon + "-" + day;
		if (d) {
			var hou = dt.getHours();
			if (hou < 10) {
				hou = "0" + hou;
			}
			var min = dt.getMinutes();
			if (min < 10) {
				min = "0" + min;
			}
			var sec = dt.getSeconds();
			if (sec < 10) {
				sec = "0" + sec;
			}
			date += " " + hou + ":" + min + ":" + sec;
		}
		return date;
	},

	addPnum : function(id, num){
		var dom = document.getElementById("pnum_"+id);
		if(dom){
			var count = parseInt(dom.value, 10);
			var min = parseInt(dom.getAttribute("numlowest"), 10);
			var max = parseInt(dom.getAttribute("numlimit"), 10);
			count += num;
			if(count < min){
				count = min;
			}
			if(count > max){
				count = max;
			}
			dom.value = count;
		}
	},

	getOrderList	: function(page){
		var pagesize = 10;
		var that = this;
		$.ajax({
			url		: "/json.php?mod=myrepair&act=getorderlist",
			type	: "post",
			data	: {
				monthago	: document.getElementById("myrepair-monthago").value,
				page		: page
			},
			dataType: "json",
			success	: function(data){
				$("#myrepair-order-list tr:not(:first)").remove();
				var html = "", pagehtml = "";
				if(data.total > 0){
					for(var i in data.orders){
						var row = data.orders[i];
						if(row.items){
							var itemcount = 0;
							for(var j in row.items){
								itemcount ++;
							}
							html += "<tr>";
							html += "<td class='order_no'><p><a target='_blank' href='http://base.51buy.com/orderdetail-"+row.order_char_id+"-html'>"+row.order_char_id+"</a></p><p class='order_date'>"+that._timeToDate(row.order_date)+"</p></td>";
							html += "<td colspan='3' class='goods many_packages'><div class='package_box package_1'><table>";
							var k = 0;
							for(var j in row.items){
								var price = '';
								for(var p in data.orders[i].detail.items){
									if(data.orders[i].detail.items[p].product_id === row.items[j].product_id){
										price = data.orders[i].detail.items[p].price/100;
									}
								}
								k ++;
								var itemkey = row.order_char_id + "-" + row.items[j].product_id;
								var style = k > 2 ? "style='display:none;'" : "";
								var style = "";
								var klass = "";
								if(k > 2){
									style = "style='display:none;'";
									klass = "order-items-row-some-" + row.order_char_id;
								}
								var itemattr = "";
								if(row.items[j].canapplycount == 0){
									itemattr = "disabled";
								}else{
									if(itemcount === 1){
										itemattr = "checked";
									}
								}
								html += "<tr orderid='"+row.order_char_id+"' class='order-items-row "+klass+"' "+style+"><td class='goods_info'>";
								html += "		<table class='goods_table'>";
								html += "			<tr>";
								html += "				<td class='check_box'><input title='"+row.items[j].exceptionmsg+"' "+itemattr+" type='radio' class='oid_"+row.order_char_id+"' name='oid_"+row.order_char_id+"' id='chk_"+itemkey+"' /></td>";
								html += "				<td class='goods_img'><img src='"+that._getItemPic(row.items[j].product_char_id)+"' /></td>";
								html += "				<td class='goods_detail'><p class='goods_name_price'><a href='"+that._getItemUrl(row.items[j].product_id)+"' target='_blank'>"+row.items[j].name+"</a> <span class='price'>&yen;"+price+"</span></p>";
								for(p in data.orders[i].detail.items){
									if(data.orders[i].detail.items[p].product_id === row.items[j].product_id){
										if(data.orders[i].detail.items[p].gift){
											var gift = data.orders[i].detail.items[p].gift;
											for(var l in gift){
												html += "<p class='sale_tips'><em>[赠品]</em> "+gift[l].name+"</p>";
											}
										}
									}
								}
								html += "				</td>";

								var _excptips = "";
								if(row.items[j].exceptionmsg){
									_excptips += "<div class='mod_hint'>";
									_excptips += '<div class="mod_hint_inner"><p>'+row.items[j].exceptionmsg+'</p></div>';
									_excptips += '<i class="mod_hint_arrow1" style="left:25px;"></i>';
									_excptips += "</div>";
								}

								html += "				<td class='num'><span class='wrap_input'><span class='jian' onclick='G.app.mycenter.myrepair.addPnum(\""+itemkey+"\", -1);return false;'>-</span><span class='input'><input title='"+row.items[j].exceptionmsg+"' type='text' id='pnum_"+itemkey+"' value='"+row.items[j].canapplycount+"' numlimit='"+row.items[j].canapplycount+"' numlowest='1' curnum='"+row.items[j].canapplycount+"' onblur='G.app.mycenter.myrepair.addPnum(\""+itemkey+"\",0);'></span><span class='jia' onclick='G.app.mycenter.myrepair.addPnum(\""+itemkey+"\",1);return false'>+</span></span>件"+_excptips+"</td>";
								html += "			</tr>";
								html += "		</table></td>";

								if(k === 1){
									if(row.canapply){
										html += "<td rowspan='"+itemcount+"' class='opt_inner'><div><span orderid='"+row.order_char_id+"' class='yx_btn_normal110 myrepair-select-start'>报修/退换货</span></div></td>";
									}else{
										//待出库
										if(row.status_int == 1){
											html += "<td rowspan='"+itemcount+"' class='opt_inner'><div style='width:110px;'><a class='icson_blue' href='http://service.51buy.com/ordermodify.html' target='_blank'>修改订单</a> <br> <a class='icson_blue' href='http://service.51buy.com/orderurge.html' target='_blank'>订单催办</a> <br /> <a class='icson_blue' href='http://service.51buy.com/ordercancel.html' target='_blank'>取消订单</a></div></td>";
										}else{
											html += "<td rowspan='"+itemcount+"' class='opt_inner'><div><span orderid='"+row.order_char_id+"' class='yx_btn_disable110'>报修/退换货</span></div></td>";
										}
									}
								}
								html += "</tr>";
							}
							if(k > 2){
								html += "<tr class='more_goods_unfold' orderid='"+row.order_char_id+"'><td colspan='5'>&nbsp;<a href='javascript:void(0);' class='order-items-showall icson_blue' orderid='"+row.order_char_id+"'>展开全部订单商品</a></td></tr>";
								html += "<tr class='more_goods_fold' orderid='"+row.order_char_id+"' style='display:none;'><td colspan='5'>&nbsp;<a href='javascript:void(0);' class='order-items-hidesome icson_blue' orderid='"+row.order_char_id+"'>收起订单商品</a></td></tr>";
							}
							html += "</table></div></td>";
							html += "</tr>";
						}
					}
					pagehtml = G.ui.page("javascript:G.app.mycenter.myrepair.getOrderList({page});", page, Math.ceil(data.total / pagesize));
				}else{
					html = "<tr><td colspan='4' align='center'><p class='kong'>没有任何订单信息<p></td></tr>";
				}
				$("#myrepair-order-list").append(html);
				document.getElementById("myrepair-order-pagelist").innerHTML = pagehtml;
			}
		});
	},

	_initEventCover	: function(){
		var that = this;

		//订单范围选择
		$("#myrepair-monthago").change(function(){
			that.getOrderList(1);
		});

		//选择售后商品
		$("#myrepair-order-list .myrepair-select-start").live("click", function(ev){
			ev.preventDefault();
			if(this.className.indexOf("yx_btn_disable110") > -1){
				return;
			}
			var orderid = this.getAttribute("orderid");
			var items = [];
			$("#myrepair-order-list .oid_"+orderid+":radio:checked").each(function(){
				var arr = this.id.split("-");
				var pid = arr[1];
				var count = document.getElementById(this.id.replace("chk_", "pnum_")).value;
				if(count && count > 0){
					items.push(pid+"."+count);
				}
			});
			var _void = function(){};
			if(items.length === 0){
				G.ui.popup.showMsg("请先选择要售后的商品", _void, _void, _void);
				return;
			}
			window.location.href = "/myrepair_report.html?items=" + orderid + "." + items.join(".");
		});

		//多商品显示
		$("#myrepair-order-list a.order-items-showall").live("click", function(){
			var orderid = this.getAttribute("orderid");
			$("#myrepair-order-list tr.order-items-row-some-"+orderid).show();
			$("#myrepair-order-list tr.more_goods_fold[orderid='"+orderid+"']").show();
			$("#myrepair-order-list tr.more_goods_unfold[orderid='"+orderid+"']").hide();
		});

		//多商品隐藏
		$("#myrepair-order-list a.order-items-hidesome").live("click", function(){
			var orderid = this.getAttribute("orderid");
			$("#myrepair-order-list tr.order-items-row-some-"+orderid).hide();
			$("#myrepair-order-list tr.more_goods_fold[orderid='"+orderid+"']").hide();
			$("#myrepair-order-list tr.more_goods_unfold[orderid='"+orderid+"']").show();
		});
	},

	initCoverPage	: function(){
		this.getOrderList(1);
		this._initEventCover();
	}
};