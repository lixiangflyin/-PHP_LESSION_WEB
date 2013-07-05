<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie ie6" lang="zh-cn"><![endif]-->
<!--[if IE 7]><html class="ie ie7" lang="zh-cn"><![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="zh-cn"><![endif]-->
<!--[if IE 9]><html class="ie ie9" lang="zh-cn"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="zh-cn"><!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>工单详情</title>
		<meta name="Copyright" content="Tencent" />
		<script src="/js/jquery.1.7.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/jquery.easing.min.js"></script>
		<script src="/js/csi.js"></script>
		<script type="text/javascript" src="/js/fancybox/jquery.fancybox.js?v=2.1.4"></script>
		<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
		<link rel="stylesheet" type="text/css" href="/css/deal_detail.css" media="screen" />
		<!-- <link rel="stylesheet" type="text/css" href="/css/gb.css" media="screen" />  -->
		<link rel="stylesheet" type="text/css" href="css/overlay.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/css/power_manage.css" media="screen" />
	</head>
	<body>
		<div class="wrapper">
			<!--S 头部 -->
			<div class="ecc_header">
				<div class="ecc_header_inner grid_c1">
					<div id="loading-tips" style="position: absolute; top: -25px; left: 400px; width: 200px; height: 15px; padding: 3px; background: #FFC;border: 1px solid blue;">数据加载中......</div>
					<h1>
						<a href="http://csi.ecc.com" class="ecc_logo"><span class="hidden">腾讯电商服务指数平台</span> </a>
					</h1>
					<ul class="ecc_header_action">
						<li><a href="##">数据订阅</a></li>
						<li><a href="##">您的建议</a></li>
						<li><a href="/page.php?menu=2&biz=admin&mod=misc&act=aboutus">关于我们</a></li>
						<li><a href="/page.php?menu=2&biz=admin&mod=member&act=list">系统配置</a></li>
						<li><a href="/json.php?biz=admin&mod=user&act=logout">退出登录</a></li>
					</ul>
				</div>
			</div>
			<!--E 头部 -->
			<div class="ecc_subheader">
				<div class="ecc_subheader_inner grid_c1">
					<ul class="ecc_nav">
						<li><a href="##" class="selected">工单处理</a></li>
						<!--  <li><a href="##">用户历史工单</a></li> -->
					</ul>
					<div class="ecc_subheader_info">
						<!-- <span class="online">56</span>
						<span class="phone">56</span>
						<span class="weibo">56</span> -->
					</div>
				</div>
			</div>


			<div class="ecc_scoll_content grid_c1  ecc_scoll_content_full" id="complaint_detail_zone">
				<div class="ecc_main" id="content">

				<div class="ecc_action">
					<p class="no" id="deal_id">工单号：<strong>{id}</strong> </p>
				</div>
				<!-- S 用户信息 -->
				<div class="ecc_mod_box" id="user_info_box">
					<div class="ecc_mod_box_hd up_down">
						<h3 class="ecc_mod_box_tit">用户信息</h3>
						<p class="ecc_mod_icon ecc_mod_icon1" title=""></p>
						{vip_icon_str}
						<a href="##" class="ecc_mod_box_up"><span class="hidden">展开</span></a>
						<a href="##" class="ecc_mod_box_down" style="display:none"><span class="hidden">收起</span></a>
					</div>
					<div class="ecc_mod_box_bd" >
						<table class="ecc_mod_table">
							<tr>
								<th>用户账户：</th>
								<td id="user_account">{account}</td>
								<th>用户电话：</th>
								<td id="user_mobile">{userPhone}</td>
								<th>用户特征：</th>
								<td id="user_feature">{vip_str}</td>
								<th>专属客服经理</th>
								<td id="kf_manager"></td>
							</tr>
						</table>
					</div>
				</div>
				<!-- E 用户信息 -->

				<!-- S 单据信息 -->
				<div class="ecc_mod_box">
					<div class="ecc_mod_box_hd up_down">
						<h3 class="ecc_mod_box_tit">单据信息</h3>
						<p class="ecc_mod_icon ecc_mod_icon3" id="flag_1_icon" title="已催办" {flag_str}></p>
						{memo_str}
						<p class="ecc_mod_inline ecc_mod_txt1" id="deal_order_id">{order_id_str}</p>
						<a href="##" class="ecc_mod_box_up"><span class="hidden">展开</span></a>
						<a href="##" class="ecc_mod_box_down" style="display:none"><span class="hidden">收起</span></a>
					</div>
					<div class="ecc_mod_box_bd">
						<table class="ecc_mod_table">
							<tr>
								<th>单据来源：</th>
								<td id="deal_biz">{biz}</td>
								<th>单据类型：</th>
								<td id="deal_type">{type_str}</td>
								<th>建单时间：</th>
								<td id="deal_create_time">{createTime_str}</td>
								<th>归档路径：</th>
								<td id="deal_archive">{archive_str}</td>
							</tr>
							<tr>
								<th>单据状态：</th>
								<td id="deal_status">{state_str}</td>
								<th>满意度：</th>
								<td id="deal_approve">{approve_str}</td>
								<th>预计完成时间：</th>
								<td id="deal_evaluate_finish_time">{est_comp_time_str}</td>
								<th></th>
								<td></td>
							</tr>
							<tr>
								<th>质检结果：</th>
								<td id="deal_checkup">{checkup_str}</td>
								<th>不满意详情：</th>
								<td id="deal_unsati_detail"></td>
								<th>实际完成时间：</th>
								<td id="deal_finish_time">{finishTime_str}</td>
								<th></th>
								<td></td>
							</tr>
							<tr>
								<th>质检人：</th>
								<td id="deal_censor">{censor}</td>
								<th></th>
								<td></td>
								<th>处理时间：</th>
								<td id="deal_consumer_time">{deal_time_str}</td>
								<th></th>
								<td></td>
							</tr>
							<tr>
								<th>当前跟进人：</th>
								<td id="deal_followed_kf">{followKF}</td>
								<th></th>
								<td></td>
								<th></th>
								<td></td>
								<th></th>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
				<!-- E 单据信息 -->

				<!-- S 用户投诉详情 -->
				<div class="ecc_mod_box">
					<!-- cur_d:鼠标为默认状态（非手型） -->
					<div class="ecc_mod_box_hd cur_d">
						<h3 class="ecc_mod_box_tit">用户描述详情</h3>
						<!--  <p class="ecc_mod_inline ecc_mod_txt2">用户前台查看3次，请加快受理</p> -->
						<!-- <div class="ecc_mod_box_action">
							<a class="mod_btn" id="reassign_btn" href="#">转单</a>
							<a class="mod_btn_common" id="reassign_urge_btn" href="#">转单并加急</a>
						</div> -->
					</div>
					<div class="ecc_mod_box_bd">
						<p id="deal_content">
							{deal_detail_str}
						</p>
						<!-- 用户缩略图 -->
						<div class="ecc_detail_list clear" id="attachment_list">
							{attachment_str}
						</div>
					</div>
				</div>
				<!-- E 用户投诉详情 -->

				<!-- S 处理记录详情 -->
				<div class="ecc_mod_box">
					<div class="ecc_mod_box_hd up_down">
						<h3 class="ecc_mod_box_tit">处理记录详情</h3>
						<a href="##" class="ecc_mod_box_up"><span class="hidden">展开</span></a>
						<a href="##" class="ecc_mod_box_down" style="display:none"><span class="hidden">收起</span></a>
					</div>
					<div class="ecc_mod_box_bd">
						<div id="latest_reply">
							{last_reply_str}
						</div>
						<div id="workflow_zone">
							{workflow_str}
						</div>
					</div>
				</div>
				<!-- E 用户投诉详情 -->
			</div>
			</div>
			
			
		{censor_box_str}
		<div class="mod_pop" id="archive_zone" style="display:none; width:700px;position:absolute;">
			<div class="mod_pop_hd">
				<h3 class="mod_pop_tit">请选择归档路径</h3>
				<button type="button" class="mod_pop_close">关闭</button>
			</div>
			<div class="mod_pop_bd">
				<div class="ecc_mod_rowform">
					<div class="item">
						<label class="tit" for="">最近使用过的归档：</label>
						<div class="cont">
							<select name="" id="used_archive">
								{archive_option_str}
							</select>
						</div>
					</div>
					<div class="item">
						<label class="tit" for="">快速搜索：</label>
						<div class="cont">
							<form id="archive_quick_search_form">
								<input type="text" id="archive_quick_search">
							</form>
							<div class="ecc_mod_classify clear">
								<div class="ecc_mod_cyitem">
									<div class="ecc_mod_cyitem_hd">一级分类</div>
									<div class="ecc_mod_cyitem_bd">
										<ul id="archive-level-1">
											{archive_level_1_str}
										</ul>
									</div>
								</div>
								<a class="ecc_mod_cyitem_btn" href="##"></a>
								<div class="ecc_mod_cyitem">
									<div class="ecc_mod_cyitem_hd">二级分类</div>
									<div class="ecc_mod_cyitem_bd">
										<ul id="archive-level-2">
											{archive_level_2_str}
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="cont">
							<input type="hidden" id="selected_archive_id">
							<a href="##" id="archive_btn" class="mod_btn">确认</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mod_pop" id="reassign_zone" style="display:none; position:absolute;">
			<div class="mod_pop_hd">
				<h3 class="mod_pop_tit">转单</h3>
				<button type="button" class="mod_pop_close">关闭</button>
			</div>
			<div class="mod_pop_bd">
				<div class="ecc_mod_rowform">
					<div class="item">
						<input type="radio" id="reassign_type1" checked name="reassign_type" value="1"><label for="reassign_type1">转单到个人</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" id="reassign_type2" name="reassign_type" value="2"><label for="reassign_type2">转单到组</label>
					</div>
					<div class="item" id="input_kf_rtx">
						输入员工RTX: <input type="text" id="kf_rtx">
					</div>
					<div class="item" id="group_list" style="display:none;">
					</div>
					<div class="item">
						<input type="hidden" id="reassign_flag" value="">
						<a href="##" id="reassign_submit_btn" class="mod_btn">确认</a>
					</div>
				</div>
			</div>
		</div>
		<div id="overlay" class="overlay_hide"></div>
		<div id="loading_text"></div>
		<script src="/service/js/detail_close.js" type="text/javascript" charset="utf-8" > </script> 
		<script type="text/javascript">
			$(document).ready(function() {
				$('.fancybox').fancybox();
			});
		</script>
	</body>
</html>