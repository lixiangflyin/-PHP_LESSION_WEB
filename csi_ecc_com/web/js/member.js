/*
 * ninojiang
 * 2013-05-13
 */

(function(csi, win){
	
	var member = {},
	doc = document;
	
	member.selectedRoleId = 0;
	member.queryStr = "";
	member.memberListCache = {};
	member.allRoles = {};
	member.current_page = 1;
	
	csi.title("成员管理");
	
	var _getRoleCheckBox = function(rids){
		var html = "", rstr = ","+rids.join(",")+",";
		for(var i in member.allRoles){
			var chk = rstr.indexOf(i) > -1 ? "checked" : "";
			html += "<label><input class='member-role-check' "+chk+" type='checkbox' value='"+i+"' /> "+member.allRoles[i].name+"</label> ";
		}
		return html;
	}
	
	member.initEvent = function(){
		
		//角色过滤
		$("#member-roles a[rid]").live("click", function(){
			$("#member-roles a").removeClass("selected");
			this.className = "selected";
			var rid = this.getAttribute("rid");
			member.selectedRoleId = rid;
			member.getList(1);
		});
		
		//选择
		$("#member-check-all").click(function(){
			if(this.checked){
				$("input[name=member-item-check]").attr("checked", true);
			}else{
				$("input[name=member-item-check]").attr("checked", false);
			}
		});
		
		//批量删除
		$("#member-check-delete").click(function(){
			var uids = [];
			$("input[name=member-item-check]").each(function(idx, ele){
				if(ele.checked){
					uids.push(ele.value);
				}
			});
			
			if(uids.length > 0){
				csi.confirmBox("确定要批量删除成员吗？", function(layerdom){
					$.ajax({
						url		: "/json.php?biz=admin&mod=member&act=delete&t=" + Math.random(),
						type	: "post",
						dataType: "json",
						data	: {
							uid	: uids.join(",")
						},
						success	: function(data){
							if(data.errno === 0){
								member.getList(1);
								layerdom.remove();
							}else{
								layerdom.find("span.msg-tips").html(data.msg);
							}
						}
					});
				});
			}
		});
		
		//搜索字符串
		var _strTips = "输入工号或RTX";
		$("#member-search-keywords").focus(function(){
			if(this.value === _strTips){
				this.value = "";
			}
		}).blur(function(){
			if(this.value === ""){
				this.value = _strTips;
			}
		});
		
		//搜索
		$("#member-search-btn").click(function(){
			var keywords = doc.getElementById("member-search-keywords").value;
			member.queryStr = keywords == _strTips ? "" : keywords;
			member.getList(1);
		});
		
		//角色信息
		$.ajax({
			url		: "/json.php?biz=admin&mod=member&act=getroleinfo&t="+Math.random(),
			type	: "post",
			dataType	: "json",
			success	: function(data){
				member.allRoles = data.data.roles;
				var html = "<a class='selected' href='javascript:void(0);' rid='0'>全部("+data.data.count+")</a>";
				for(var i in data.data.roles){
					html += "<a href='javascript:void(0);' rid='"+i+"'>"+data.data.roles[i].name+"("+data.data.roles[i].count+")"+"</a>";
				}
				doc.getElementById("member-roles").innerHTML = html;
			}
		});
		
		//删除成员
		$("#member-list-table a.member-delete-item[uid]").live("click", function(){
			var uid = parseInt(this.getAttribute("uid"), 10);
			if(member.memberListCache[uid]){
				CSI.confirmBox("确定要删除这个成员吗?", function(layerdom){
					$.ajax({
						url		: "/json.php?biz=admin&mod=member&act=delete",
						type	: "post",
						data	: {
							uid	: uid
						},
						dataType	: "json",
						success	: function(data){
							if(data.errno === 0){
								member.getList(member.current_page);
								layerdom.remove();
							}else{
								layerdom.find("span.msg-tips").html(data.msg);
							}
						}
					});
				});
			}
		});
		
		//修改成员信息
		$("#member-list-table a.member-modify-item[uid]").live("click", function(){
			var uid = parseInt(this.getAttribute("uid"), 10);
			if(member.memberListCache[uid]){
				var info = member.memberListCache[uid];

				var html = "<table border='0' width='90%'><tr height='40px'><td align='right' width='35%'>易迅ID：</td><td>"+info.icson_id+"</td></tr>";
				html += "<tr height='40px'><td align='right' >RTX：</td><td><input type='text' id='member-rtx' value='"+info.rtx_id+"' /></td></tr>";
				html += "<tr height='40px'><td align='right' >显示昵称：</td><td><input type='text' id='member-showname' value='"+info.show_name+"' /></td></tr>";
				html += "<tr height='40px'><td align='right' valign='top'>成员角色：</td><td><div class='ecc_power_list'>"+_getRoleCheckBox(info.role_ids)+"</div></td></tr>";
			
				html += "</div></div></td></tr></table><br />";
				
				CSI.newLayer("修改成员信息", html, function(layerdom){
					var rtx = doc.getElementById("member-rtx").value;
					var name = doc.getElementById("member-showname").value;
					
					var rids = [];
					$("input.member-role-check:checked").each(function(idx, ele){
						rids.push(ele.value);
					});
					if(rtx || name){
						$.ajax({
							url		: "/json.php?biz=admin&mod=member&act=modify&t="+Math.random(),
							type	: "post",
							data	: {
								uid	: uid,
								rtx	: rtx,
								name	: name,
								rids	: rids.join(",")
							},
							dataType	: "json",
							success	: function(data){
								if(data.errno === 0){
									member.getList(member.current_page);
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
		
		this.getList(1);
	}
	
	member.getList = function(page){
		var data = {page: page};
		member.current_page = page;
		if(this.selectedRoleId > 0){
			data.rid = this.selectedRoleId;
		}
		if(this.queryStr !== ""){
			data.query = this.queryStr;
		}
		CSI.loadingShow(true);
		$.ajax({
			url		: "/json.php?biz=admin&mod=member&act=getlist&t="+Math.random(),
			data	: data,
			dataType	: "json",
			success	: function(data){
				CSI.loadingHide();
				if(data.errno > 0){
					CSI.msgBox(data.msg);
					return;
				}
				
				$("#member-list-table tr:not(:first)").remove();
				var html = "";
				if(data.data.list.length > 0){
					for(var i = 0; i < data.data.list.length; i ++){
						html += "<tr><td class='cb'><input type='checkbox' name='member-item-check' value='"+data.data.list[i].uid+"' /></td>";
						html += "<td>"+data.data.list[i].icson_id+"</td>";
						html += "<td>"+data.data.list[i].rtx_id+"</td>";
						html += "<td>"+data.data.list[i].show_name+"</td>";
						html += "<td>"+data.data.list[i].role+"</td>";
						html += "<td>"+CSI.timeToDate(data.data.list[i].create_time, true)+"</td>";
						if(data.data.admin){
							html += "<td><a class='member-modify-item' uid='"+data.data.list[i].uid+"' href='javascript:void(0);'>配置</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class='member-delete-item' uid='"+data.data.list[i].uid+"' href='javascript:void(0);'>删除</a></td>";
						}else{
							html += "<td>-</td>";
						}
						html += "</tr>";
						
						member.memberListCache[data.data.list[i].uid] = data.data.list[i];
					}
				}
				$("#member-list-table").append(html);
				
				$("#member-list-pages").html(CSI.getPageList(Math.ceil(data.data.total / 15), page, 'CSI.member.getList'));
			}
		});
	}
	
	win.CSI.member = member;
	
})(CSI, window);