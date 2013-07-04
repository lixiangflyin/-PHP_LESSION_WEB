/*
 * ninojiang
 * 2013-05-13
 */

(function(csi, win){
	
	var group = {},
	doc = document;
	
	group.group_id = 0;
	group.groupListCache = {};
	group.queryStr = "";
	group.biz = {};
	
	
	csi.title("分组管理");
	
	group.initEvent = function(){
		
		this.getList(1);
		
		//保存好业务信息
		$.ajax({
			url		: "/json.php?biz=admin&mod=group&act=getbizlist",
			dataType	: "json",
			success	: function(data){
				for(var i in data.data){
					group.biz[i] = data.data[i];
				}
			}
		});
		
		//选择
		$("#group-check-all").click(function(){
			if(this.checked){
				$("input[name=group-item-check]").attr("checked", true);
			}else{
				$("input[name=group-item-check]").attr("checked", false);
			}
		});
		
		//批量删除
		$("#group-check-delete").click(function(){
			var gids = [];
			$("input[name=group-item-check]").each(function(idx, ele){
				if(ele.checked){
					gids.push(ele.value);
				}
			});
			
			if(gids.length > 0){
				csi.confirmBox("确定要批量删除分组吗？", function(layerdom){
					$.ajax({
						url		: "/json.php?biz=admin&mod=group&act=delete&t=" + Math.random(),
						type	: "post",
						dataType: "json",
						data	: {
							gid	: gids.join(",")
						},
						success	: function(data){
							if(data.errno === 0){
								group.getList(1);
								layerdom.remove();
							}else{
								layerdom.find("span.msg-tips").html(data.msg);
							}
						}
					});
				});
			}
		});
		
		//搜索
		$("#group-search-btn").click(function(){
			var keywords = doc.getElementById("group-search-keywords").value;
			group.queryStr = keywords;
			group.getList(1);
		});
		
		//添加
		$("#group-add-btn").click(function(){
			
			if(CSI.rtx === ""){
				CSI.msgBox("您尚未设置RTX，无法创建分组");
				return;
			}
			
			group.group_id = 0;
			
			var html = "<table border='0' width='600px'><tr height='40px'><td align='right' width='140px'><span>*</span>分组名：</td><td><input type='text' id='group-mod-name' /></td></tr>";
			html += "<tr height='40px'><td align='right'><span>*</span>组长RTX：</td><td><input type='text' id='group-leader' /></td></tr>";
			html += "<tr height='40px'><td align='right' valign='top'>业务选择：</td><td><div class='ecc_power_list'><div id='biz-items'>";
			for(var i in group.biz){
				html += "<label><input type='checkbox' name='biz-item' value='"+i+"'>"+group.biz[i]+"</label>";
			}
			html += "</div></div></td></tr></table><br />";
			
			CSI.newLayer("添加分组", html, function(layerdom){
				var name = doc.getElementById("group-mod-name").value;
				var rtx = doc.getElementById("group-leader").value;

				if(name && rtx){
					var bids = [];
					$("input[name=biz-item]:checked").each(function(idx, ele){
						bids.push(ele.value);
					});
					
					$.ajax({
						url		: "/json.php?biz=admin&mod=group&act=add&t=" + Math.random(),
						type	: "post",
						dataType: "json",
						data	: {
							group_id	: group.group_id,
							name	: name,
							rtx		: rtx,
							bids	: bids.join(",")
						},
						success	: function(data){
							if(data.errno === 0){
								group.getList(1);
								layerdom.remove();
							}else{
								layerdom.find("span.msg-tips").html(data.msg);
							}
						}
					});
				}else{
					layerdom.find("span.msg-tips").html("分组名或组长RTX不能为空");
				}
			});
		});
		
		//修改分组
		$("#group-list-table a.group-modify-item[gid]").live("click", function(){
			var gid = parseInt(this.getAttribute("gid"), 10);
			if(group.groupListCache[gid]){
				group.group_id = gid;
				var html = "<table border='0' width='600px'><tr height='40px'><td align='right' width='140px'><span>*</span>分组名：</td><td><input type='text' id='group-mod-name' value='"+group.groupListCache[gid].name+"' /></td></tr>";
				html += "<tr height='40px'><td align='right'><span>*</span>组长RTX：</td><td><input type='text' id='group-leader' value='"+group.groupListCache[gid].leader_rtx+"' /></td></tr>";
				html += "<tr height='40px'><td align='right' valign='top'>业务选择：</td><td><div class='ecc_power_list'><div id='biz-items'>";
				for(var i in group.biz){
					var chk = group.groupListCache[gid].biz_names.indexOf(group.biz[i]) > -1 ? "checked" : "";
					html += "<label><input "+chk+" type='checkbox' name='biz-item' value='"+i+"'>"+group.biz[i]+"</label>";
				}
				html += "</div></div></td></tr></table><br />";
				
				CSI.newLayer("编辑分组", html, function(layerdom){
					var name = doc.getElementById("group-mod-name").value;
					var rtx = doc.getElementById("group-leader").value;
	
					if(name && rtx){
						var bids = [];
						$("input[name=biz-item]:checked").each(function(idx, ele){
							bids.push(ele.value);
						});
		
						$.ajax({
							url		: "/json.php?biz=admin&mod=group&act=modify&t=" + Math.random(),
							type	: "post",
							dataType: "json",
							data	: {
								group_id	: group.group_id,
								name	: name,
								rtx		: rtx,
								bids	: bids.join(",")
							},
							success	: function(data){
								if(data.errno === 0){
									group.getList(1);
									layerdom.remove();
								}else{
									layerdom.find("span.msg-tips").html(data.msg);
								}
							}
						});
					}else{
						layerdom.find("span.msg-tips").html("分组名或组长RTX不能为空");
					}
				});
			}
		});
		
		
		//删除分组
		$("#group-list-table a.group-delete-item[gid]").live("click", function(){
			var gid = parseInt(this.getAttribute("gid"), 10);
			if(group.groupListCache[gid]){
				CSI.confirmBox("确定要删除这个分组吗?", function(layerdom){
					$.ajax({
						url		: "/json.php?biz=admin&mod=group&act=delete&t="+Math.random(),
						type	: "post",
						data	: {
							gid	: gid
						},
						dataType	: "json",
						success	: function(data){
							if(data.errno === 0){
								group.getList(1);
								layerdom.remove();
							}else{
								layerdom.find("span.msg-tips").html(data.msg);
							}
						}
					});
				});
			}
		});
	}
	
	
	group.getList = function(page){
		CSI.loadingShow(true);
		$.ajax({
			url		: "/json.php?biz=admin&mod=group&act=getlist&t="+Math.random(),
			type	: "post",
			data	: {
				page	: page,
				query	: group.queryStr
			},
			dataType	: "json",
			success	: function(data){
				CSI.loadingHide();
				if(data.errno === 0){
					$("#group-list-table tr:not(:first)").remove();
					
					var html = "";
					
					for(var i = 0; i < data.data.list.length; i ++){
						html += "<tr><td class='cb'><input type='checkbox' name='group-item-check' value='"+data.data.list[i].gid+"' /></td>";
						html += "<td>"+data.data.list[i].gid+"</td>";
						html += "<td>"+data.data.list[i].name+"</td>";
						html += "<td>"+data.data.list[i].leader_rtx+"</td>";
						html += "<td>"+data.data.list[i].biz_names+"</td>";
						html += "<td>"+CSI.timeToDate(data.data.list[i].create_time, true)+"</td>";
						if(data.data.admin){
							html += "<td><a class='group-modify-item' gid='"+data.data.list[i].gid+"' href='javascript:void(0);'>配置</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class='group-delete-item' gid='"+data.data.list[i].gid+"' href='javascript:void(0);'>删除</a></td>";
						}else{
							html += "<td>-</td>";
						}
						html += "</tr>";
						
						group.groupListCache[data.data.list[i].gid] = data.data.list[i];
					}
					
					$("#group-list-table").append(html);
				}else{
					CSI.msgBox(data.msg);
				}
			}
		});
	}
	

	win.CSI.group = group;

})(CSI, window);