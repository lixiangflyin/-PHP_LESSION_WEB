<!DOCTYPE html>
<html lang="zh-cn">
<html>
<head>
<title>CSI 首页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/gb.css" rel="stylesheet" type="text/css" />
<link href="/css/index_page.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.1.7.min.js"></script>
<script src="/js/highcharts/highcharts.js"></script>
</head>
<body>
	<div class="toolbar">
		<div class="toolbar_inner clear">
			<ul class="header_toolbar_list">
				<li class="header_toolbar_item header_toolbar_welcome">Welcome,{rtx}(<a class="header_toolbar_link" href="/json.php?biz=admin&mod=user&act=logout" title="注销">注销</a>)</li>
				<li class="header_toolbar_item"><a href="/page.php?menu=2&biz=service&mod=deal&act=unsolved" class="header_toolbar_link">我的工作台</a></li>
				<li class="header_toolbar_item"><a class="header_toolbar_link">数据订阅</a></li>
				<li class="header_toolbar_item"><a class="header_toolbar_link">您的建议</a></li>
				<li class="header_toolbar_item"><a href="/page.php?menu=2&biz=admin&mod=misc&act=aboutus" class="header_toolbar_link">关于我们</a></li>
			</ul>
		</div>
	</div>
	<div class="banner">
		<div class="banner_inner">
			<span class="banner_month">{month}</span>
			<span class="banner_dan_amounts">{month_count}</span>
			<span class="banner_dan_info_tit1">平台截止{data_str}共产生</span>
			<span class="banner_dan_info_con1">{total_count}单</span>
			<span class="banner_dan_info_tit2">当前已处理</span>
			<span class="banner_dan_info_con2">{dealed_count}单</span>
			<div class="banner_deal_per">{dealed_percent}%</div>
			<div class="banner_trend"><span class="trend_per">{tb_percent}%</span><span class="{trend_str}"></span><span style="display:none;" class="trend_arrow_down"></span></div>
		</div>
	</div>
	<div class="nav">
		<div class="nav_inner">
			<ul class="nav_list clear">
				<li class="nav_item nav_item_cur"><a class="nav_link">首 页</a></li>
				<!-- <li class="nav_item"><a class="nav_link">排行榜</a></li>
				<li class="nav_item"><a class="nav_link">统计报表</a></li> -->
				<li class="nav_item"><a href="/page.php?menu=0&biz=service&mod=deal&act=list" class="nav_link">工单查询</a></li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="contennt">
			<div class="index_mod1">
				<div class="index_mod1_hd clear">
					<h3>今日处理结单时效</h3>
					<div class="progress_wrap clear">
						<div class="progress_bar clear">
							<div class="progress_per" style="width:{today_dealed_precent}%;z-index:3">
								<div class="progress_per_bg" style="background-color:#539BFC;"></div>
								<p class="progress_per_txt">已完成{today_dealed_precent}%</p>
							</div>
							<div class="progress_per" style="width:{today_dealing_precent}%;;z-index:2">
								<div class="progress_per_bg" style="background-color:#80B4FC;"></div>
								<p class="progress_per_txt progress_per_txt_top">处理中{today_dealing_precent}%</p>
							</div>
						</div>
					</div>
					<div class="progress_num">{today_total}</div>
					<div class="trend_con">
						较昨日同期：{trend_st_str}今日首次回复平均时长：{average_accept_time}<!-- <i class="icon_trend_up"></i> -->
					</div>
					<!-- <a class="index_mod1_unflod_link" href="#"></a> -->
				</div>
				<div class="index_mod1_bd">
					<div class="chart_box" id="chart-1" style=""></div>
				</div>
				<div class="index_mod1_hd clear">
					<h3>昨日处理结单时效</h3>
					<div class="progress_wrap clear">
						<div class="progress_bar clear">
							<div class="progress_per" style="width:{yesterday_dealed_percent}%;">
								<div class="progress_per_bg" style="background-color:#539BFC;"></div>
								<p class="progress_per_txt">已完成{yesterday_dealed_percent}%</p>
							</div>
							<div class="progress_per" style="width:{yesterday_dealing_percent}%;">
								<div class="progress_per_bg" style="background-color:#80B4FC;"></div>
								<p class="progress_per_txt progress_per_txt_top">处理中{yesterday_dealing_percent}%</p>
							</div>
						</div>
					</div>
					<div class="progress_num">{yesterday_total}</div>
					
				</div>

				<div class="index_mod1_hd clear">
					<h3>昨日结单不满意度</h3>
					<div class="progress_wrap clear">
						<div class="progress_bar clear">
							<div class="progress_per" style="width:{approve_precent}%;">
								<div class="progress_per_bg" style="background-color:#FA7A57;"></div>
								<p class="progress_per_txt">{approve_precent}%</p>
							</div>
 
						</div>
					</div>
					<div class="progress_num">{yesterday_total}</div>
					<div class="trend_con">
						较上周同期：{approve_trend_str}今日处理完结平均时长：{average_deal_time}<!-- <i class="icon_trend_down"></i> -->
					</div>									
					<!-- <a class="index_mod1_flod_link" href="#"></a> -->
				</div>
				<div class="index_mod1_bd">
					<div class="chart_box" id="chart-2" style=""></div>
				</div>
				
				<div class="index_mod1_bd" style="display:none;">
					<div class="chart_box" style="width:920px;height:222px;">d</div>
				</div>
			</div>
 
 
			<!-- S 服务单量整体趋势 -->
			<div class="index_mod2">
				<div class="index_mod2_hd clear">
					<h3>服务单量整体趋势</h3>
					<!-- <div class="extra">
						<select name="">
							<option value="">最近14天</option>
							<option value="">最近7天</option>
							<option value="">最近30天</option>
						</select>
					</div> -->
				</div>
				<div class="index_mod2_bd clear">
					<div class="chart_tab">
						<div class="chart_tabhd clear">
							<a class="chart_tabhd_item chart_tabhd_item_cur" href="#" title="在线">在线</a>
							<!-- <a class="chart_tabhd_item" href="#" title="在线">IVR</a>
							<a class="chart_tabhd_item" href="#" title="在线">微博</a>
							<a class="chart_tabhd_item" href="#" title="在线">全部</a> -->
						</div>
						<div class="chart_tabbd">
							<div class="chart" id="chart-3" style="height:260px;">
								<img src="http://ppms.paipaioa.com/img/demo/608x260.png" / >
							</div>
						</div>
 
					</div>
					<div class="rank_tab" id="archive_rank">
						<div class="rank_tabhd clear">
							<h4>昨日归档排行</h4>
							<a class="rank_tabhd_item  rank_tabhd_item_cur" dx="ts" href="javascript:void(0);">投诉</a>
							<a class="rank_tabhd_item" dx="zx" href="javascript:void(0);">咨询</a>
						</div>
						<div class="rank_tabbd" id="div_ts">
							<table class="rank_list" >
								<colgroup>
									<col width="30%">
									<col width="30%">
									<col width="30%">
								</colgroup>
								<tbody>
									{archive_rank_str}																		
								</tbody>
							</table>
							
							<a class="mod_btn" href="/page.php?menu=0&biz=service&mod=deal&act=list">按条件筛选</a>
						</div>
						<div class="rank_tabbd" id="div_zx" style="display: none;">
							<table class="rank_list" >
								<colgroup>
									<col width="30%">
									<col width="30%">
									<col width="30%">
								</colgroup>
								<tbody>
									{archive_rank_zx_str}																		
								</tbody>
							</table>
							<a class="mod_btn" href="/page.php?menu=0&biz=service&mod=deal&act=list">按条件筛选</a>
						</div>
					</div>
				</div>
			</div>
			<!-- E 服务单量整体趋势 -->
 
			<!-- S 人均处理效能 -->
			<div class="index_mod2">
				<div class="index_mod2_hd clear">
					<h3>人均处理效能</h3>
					<div class="extra">
						<!-- <select name="">
							<option value="">最近14天</option>
							<option value="">最近7天</option>
							<option value="">最近30天</option>
						</select> -->
					</div>
				</div>
				<div class="index_mod2_bd clear">
					<div class="chart_tab">
						<div class="chart_tabhd clear">
							<a class="chart_tabhd_item chart_tabhd_item_cur" href="#" title="在线">在线</a>
							<!-- <a class="chart_tabhd_item" href="#" title="在线">IVR</a>
							<a class="chart_tabhd_item" href="#" title="在线">微博</a>
							<a class="chart_tabhd_item" href="#" title="在线">全部</a> -->
						</div>
						<div class="chart_tabbd">
							<div class="chart" style="height:260px;" id="chart-4">
								<img src="http://ppms.paipaioa.com/img/demo/608x260.png" / >
							</div>
						</div>
 
					</div>
					<div class="rank_tab">
						<div class="rank_tabhd clear">
							<h4>昨日客服排行榜</h4>
							
						</div>
						<div class="rank_tabbd">
							<table class="rank_list">
								<colgroup>
									<col width="30%">
									<col width="30%">
									<col width="30%">
								</colgroup>
								<tbody>
									{work_rank_str}															
								</tbody>
							</table>
							<a class="mod_btn" href="/page.php?menu=0&biz=service&mod=deal&act=list">按条件筛选</a>
						</div>
					</div>
				</div>
			</div>
			<!-- E 人均处理效能 -->
 
			<!-- S 人均处理效能 -->
			<!-- <div class="index_mod2">
				<div class="index_mod2_hd clear">
					<h3>人均处理效能</h3>
					<div class="extra">
						<select name="">
							<option value="">最近14天</option>
							<option value="">最近7天</option>
							<option value="">最近30天</option>
						</select>
					</div> 
				</div>
				<div class="index_mod2_bd clear">
					<div class="details_tab">
						<div class="details_tabhd clear">
							<div class="details_tabhd_item details_tabhd_item_cur" title="在线">
								<div class="details_tab_type">在线</div>
								<p class="num"><span>2645</span>例</p>
							</div>
							<div class="details_tabhd_item " title="IVR">
								<div class="details_tab_type">IVR</div>
								<p class="num"><span>2645</span>例</p>
							</div>
							<div class="details_tabhd_item " title="微博">
								<div class="details_tab_type">微博</div>
								<p class="num"><span>2645</span>例</p>
							</div>
							<div class="details_tabhd_item " title="全部">
								<div class="details_tab_type">全部</div>
								<p class="num"><span>2645</span>例</p>
							</div>
						</div>
						<div class="details_tabbd">
							<div class="details" style="">
								<table class="details_table">
									<tbody>
										<tr>
											<td>1.交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉</td>
											<td>peterhu</td>
											<td>2013.03.19</td>
										</tr>
										<tr>
											<td>2.交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉</td>
											<td>peterhu</td>
											<td>2013.03.19</td>
										</tr>
										<tr>
											<td>3.交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉</td>
											<td>peterhu</td>
											<td>2013.03.19</td>
										</tr>
										<tr>
											<td>4.交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉</td>
											<td>peterhu</td>
											<td>2013.03.19</td>
										</tr>
										<tr>
											<td>5.交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉</td>
											<td>peterhu</td>
											<td>2013.03.19</td>
										</tr>
										<tr>
											<td>6.交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉</td>
											<td>peterhu</td>
											<td>2013.03.19</td>
										</tr>
										<tr>
											<td>7.交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉交易投诉</td>
											<td>peterhu</td>
											<td>2013.03.19</td>
										</tr>																
									</tbody>
								</table>
								<a class="mod_btn" href="#">查看所有</a>
							</div>
						</div>
 
					</div>
					<div class="rank_tab">
						<div class="rank_tabhd clear">
							<h4>排行榜</h4>
							<a class="rank_tabhd_item" href="#">投诉</a>
							<a class="rank_tabhd_item  rank_tabhd_item_cur" href="#">咨询</a>
							<a class="rank_tabhd_item" href="#">售后</a>
						</div>
						<div class="rank_tabbd">
							<table class="rank_list">
								<colgroup>
									<col width="30%">
									<col width="30%">
									<col width="30%">
								</colgroup>
								<tbody>
									<tr>
										<td class="partment_col">1. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_up"></i></td>
									</tr>
									<tr>
										<td class="partment_col">2. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_down"></i></td>
									</tr>
									<tr>
										<td class="partment_col">3. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_up"></i></td>
									</tr>
									<tr>
										<td class="partment_col">4. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_up"></i></td>
									</tr>
									<tr>
										<td class="partment_col">5. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_up"></i></td>
									</tr>
									<tr>
										<td class="partment_col">6. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_up"></i></td>
									</tr>
									<tr>
										<td class="partment_col">7. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_up"></i></td>
									</tr>
									<tr>
										<td class="partment_col">8. 产品部门</td>
										<td class="per_col">25%</td>
										<td class="trend_col"><i class="icon_trend_up"></i></td>
									</tr>																		
								</tbody>
							</table>
							<a class="mod_btn">按条件筛选</a>
						</div> -->
					</div>
				</div>
			</div>
 
			<!-- E 人均处理效能 -->
 
 
 
		</div>
 
	</div>
 
 
 <script>
 	var data_dealing_arr = [{data_dealing_arr_str}];
 	var data_undeal_arr = [{data_undeal_arr_str}];
 	var data_dealed_arr = [{data_dealed_arr_str}];
 	var data_expire_arr = [{data_expire_arr_str}];
 	
 	var data_approve_arr = [{data_approve_arr_str}];
 	var data_daily_y_arr_str = [{data_daily_y_arr_str}];
 	var data_daily_x_arr_str = [{data_daily_x_arr_str}];
 	var data_wk_y_arr_str = [{data_wk_y_arr_str}];
 	var data_wk_x_arr_str = [{data_wk_x_arr_str}];
 </script>
 <script src="/service/js/kanban.js" type="text/javascript" charset="utf-8" > </script>
 
</body>
</html>
