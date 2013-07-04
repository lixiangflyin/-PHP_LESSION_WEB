/*
 * ninojiang
 * 2013-05-10
 */

(function(csi, win){
	
	var role = {},
	doc = document;
	
	role.role_id = 0;	//决定是否编辑或是增加
	role.roleListCache = {};
	role.authCache = [];
	
	
	csi.title("角色管理");
	
	role.initEvent = function(){
		
		this.getList(1);
		
		$.ajax({
			url		: "/json.php?biz=admin&mod=role&act=getauthlist",
			dataType	: "json",
			success	: function(data){
				for(var i in data.data){
					role.authCache.push({
						auth_id : i,
						name	: data.data[i]
					});
				}
			}
		});
		
		$("#role-add-btn").click(function(){
			
			if(CSI.rtx === ""){
				CSI.msgBox("您尚未设置RTX，无法创建角色");
				return;
			}
			
			role.role_id = 0;
			$.ajax({
				url		: "/json.php?biz=admin&mod=role&act=getauthlist",
				dataType	: "json",
				success	: function(data){
					if(data.errno === 0){
						var html = "<table border='0' width='90%'><tr height='40px'><td align='right' width='35%'><span>*</span>角色名：</td><td><input type='text' id='role-mod-name' /></td></tr>";
						html += "<tr height='40px'><td align='right' valign='top'>权限选择：</td><td><div class='ecc_power_list'><div id='role-items'>";
						for(var i in data.data){
							html += "<label><input type='checkbox' name='role-item' value='"+i+"'>"+data.data[i]+"</label>";
						}
						html += "</div></div></td></tr></table><br />";
						
						CSI.newLayer("添加角色", html, function(layerdom){
							var name = doc.getElementById("role-mod-name").value;
			
							if(name){
								var aids = [];
								$("input[name=role-item]:checked").each(function(idx, ele){
									aids.push(ele.value);
								});
				
								$.ajax({
									url		: "/json.php?biz=admin&mod=role&act=" + (role.role_id === 0 ? "add" : "modify"),
									type	: "post",
									dataType: "json",
									data	: {
										role_id	: role.role_id,
										name	: name,
										auth	: aids.join(",")
									},
									success	: function(data){
										if(data.errno === 0){
											//CSI.msgBox("添加角色成功");
											role.getList(1);
											layerdom.remove();
										}else{
											layerdom.find("span.msg-tips").html(data.msg);
										}
									}
								});
							}else{
								layerdom.find("span.msg-tips").html("角色名不能为空");
							}
						});
					}
				}
			});
		});
		
		//修改角色
		$("#role-list-table a.role-modify-item[rid]").live("click", function(){
			var rid = parseInt(this.getAttribute("rid"), 10);
			if(role.roleListCache[rid]){
				role.role_id = rid;
				var html = "<table border='0' width='90%'><tr height='40px'><td align='right' width='35%'><span>*</span>角色名：</td><td><input type='text' id='role-mod-name' value='"+role.roleListCache[rid].name+"' /></td></tr>";
				html += "<tr height='40px'><td align='right' valign='top'>权限选择：</td><td><div class='ecc_power_list'><div id='role-items'>";
				for(var i = 0; i < role.authCache.length; i ++){
					var chk = role.roleListCache[rid].auth_ids[role.authCache[i].auth_id] ? "checked" : "";
					html += "<label><input "+chk+" type='checkbox' name='role-item' value='"+role.authCache[i].auth_id+"'>"+role.authCache[i].name+"</label>";
				}
				html += "</div></div></td></tr></table><br />";
				
				CSI.newLayer("编辑角色", html, function(layerdom){
					var name = doc.getElementById("role-mod-name").value;
	
					if(name){
						var aids = [];
						$("input[name=role-item]:checked").each(function(idx, ele){
							aids.push(ele.value);
						});
		
						$.ajax({
							url		: "/json.php?biz=admin&mod=role&act=" + (role.role_id === 0 ? "add" : "modify"),
							type	: "post",
							dataType: "json",
							data	: {
								role_id	: role.role_id,
								name	: name,
								auth	: aids.join(",")
							},
							success	: function(data){
								if(data.errno === 0){
									//CSI.msgBox("修改角色成功");
									role.getList(1);
									layerdom.remove();
								}else{
									layerdom.find("span.msg-tips").html(data.msg);
								}
							}
						});
					}
				});
			}
		});
		
		//删除角色
		$("#role-list-table a.role-delete-item[rid]").live("click", function(){
			var rid = parseInt(this.getAttribute("rid"), 10);
			if(role.roleListCache[rid]){
				CSI.confirmBox("确定要删除这个角色吗?", function(layerdom){
					$.ajax({
						url		: "/json.php?biz=admin&mod=role&act=delete",
						data	: {
							rid	: rid
						},
						dataType	: "json",
						success	: function(data){
							if(data.errno === 0){
								role.getList(1);
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
	
	//角色列表
	role.getList = function(page){
		CSI.loadingShow(true);
		$.ajax({
			url		: "/json.php?biz=admin&mod=role&act=getlist&t="+Math.random(),
			dataType	: "json",
			success	: function(data){
				CSI.loadingHide();
				if(data.errno === 0){
					$("#role-list-table tr:not(:first)").remove();
					
					var html = "";
					
					for(var i = 0; i < data.data.list.length; i ++){
						html += "<tr><td class='cb'><input type='checkbox' name='role-item-check' value='"+data.data.list[i].rid+"' /></td>";
						html += "<td>"+data.data.list[i].name+"</td>";
						html += "<td>"+data.data.list[i].auths+"</td>";
						html += "<td>"+data.data.list[i].creator+"</td>";
						html += "<td>"+CSI.timeToDate(data.data.list[i].create_time, true)+"</td>";
						if(data.data.admin){
							html += "<td><a class='role-modify-item' rid='"+data.data.list[i].rid+"' href='javascript:void(0);'>配置</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class='role-delete-item' rid='"+data.data.list[i].rid+"' href='javascript:void(0);'>删除</a></td>";
						}else{
							html += "<td>-</td>";
						}
						html += "</tr>";
						
						role.roleListCache[data.data.list[i].rid] = data.data.list[i];
					}
					
					$("#role-list-table").append(html);
				}else{
					CSI.msgBox(data.msg);
				}
			}
		});
	}
	
	win.CSI.role = role;
})(CSI, window)