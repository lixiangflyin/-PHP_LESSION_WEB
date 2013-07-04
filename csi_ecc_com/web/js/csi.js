/*
 * ninojiang
 */

(function(win){
	var csi = {},
	doc = document;
	
	csi.zindex = 1001;
	csi.rtx = "";
	
	var _getUserInfo = function(){
		//拉取必要的信息
		$.ajax({
			url		: "/json.php?biz=admin&mod=user&act=getinfo&t="+Math.random(),
			dataType	: "json",
			success	: function(data){
				if(data.errno == 0){
					doc.getElementById("menu-username").innerHTML = data.data.username;
					doc.getElementById("menu-mygroup").innerHTML = data.data.groupstr;
					doc.getElementById("my-count-unsolved").innerHTML = data.data.assign_unsolved;
					doc.getElementById("my-count-message").innerHTML = data.data.unread_message_count;
					doc.getElementById("my-count-overtime").innerHTML = data.data.alarm_count;
					
					csi.rtx = data.data.rtx;
					
					if(!data.data.is_leader){
						$("#menu-for-leader").hide();
					}else{
						$("#menu-for-leader").show();
					}
					
					if(MOD === "member" || MOD === "role" || MOD === "group"){
						$("#menu-for-kf, #menu-for-sign, #menu-for-leader").hide();
						$("#menu-for-admin").show();
					}else{
						$("#menu-for-admin").hide();
						$("#menu-for-kf, #menu-for-sign, #menu-for-leader").show();
					}
					
					var obj = doc.getElementById("sign-in-btn");
					if(data.data.is_working){
						obj.innerHTML = "签出";
						obj.className = "ecc_side_checkoutbtn";
						obj.onclick = function(){
							$.ajax({
								url		: "/json.php?biz=admin&mod=user&act=signout&t="+Math.random(),
								dataType	: "json",
								success	: function(data){
									if(data.errno == 0){
										//CSI.msgBox("成功签出");
										top.location.reload();
									}else{
										if(data.errno == 500){
											top.location.reload();
										}else{
											CSI.msgBox(data.msg);
										}
									}
								}
							});
						}
					}else{
						obj.innerHTML = "签入";
						obj.onclick = function(){
							
							$.ajax({
								url		: "/json.php?biz=admin&mod=group&act=getallgroups&t=" + Math.random(),
								type	: "post",
								dataType: "json",
								success	: function(data){
									var grouphtml = "<table>";
									if(data.data.length > 0){
										grouphtml += "<tr><td height='40px'>请选择您要签入的组别，系统会根据您的组进行分单。</td></tr>";
										grouphtml += "<tr><td><div class='ecc_power_list'>";
										for(var i = 0; i < data.data.length; i ++){
											grouphtml += "<label><input class='sign-check-group' type='checkbox' value='"+data.data[i].gid+"' /> "+data.data[i].name+"</label> ";
										}
										grouphtml += "</div></td></tr>";
									}else{
										grouphtml += "<tr><td>系统尚未设置分组</td></tr>";
									}
									grouphtml += "</table>";
									
									CSI.newLayer("签入", grouphtml, function(layerdom){
										var gids = [];
										$("input.sign-check-group:checked").each(function(idx, ele){
											gids.push(ele.value);
										});
										if(gids.length > 0){
											$.ajax({
												url		: "/json.php?biz=admin&mod=user&act=signin&t="+Math.random(),
												data	: {
													gids	: gids.join(",")
												},
												dataType	: "json",
												success	: function(data){
													if(data.errno == 0){
														//CSI.msgBox("成功签入");
														layerdom.remove();
														top.location.reload();
													}else{
														if(data.errno == 500){
															top.location.reload();
														}else{
															CSI.msgBox(data.msg);
															layerdom.remove();
														}
													}
												}
											});
										}
									});
								}
							});
							
						}
					}
					
				}else{
					CSI.msgBox(data.msg);
				}
			}
		});
	}
	
	//一些公共方法
	csi.getPageList = function(pages, page, goToFunc){
		var html = "<div class='page_wrap'><div class='paginator'>";
		if (page <= 1) {
			html += "<a page='' href='javascript:void(0);' class='btn page-start'><i>&lt;</i> 上一页</a>";
		} else {
			html += "<a page='"+ (page -1) +"' href='javascript:void(0);' onclick='" + goToFunc + "(" + (page -1) + ");"+"' class='btn"+(page > 1 ? "" : " page-start")+"'><i>&lt;</i> 上一页</a>";
		}
		if (pages <= 7)
		{
			for (var iPage = 1; iPage <= pages; iPage++){
				html += getPageHtml(iPage,page);
			}
		}
		else if (page <= 3)
		{
			for (var iPage = 1; iPage <= 5; iPage++){
				html += getPageHtml(iPage,pages);
			}
			html += '<span class="dot">...</span>';
			html +=  getPageHtml(pages,page);
		}
		else if (page >= pages - 2)
		{
			html +=  getPageHtml(1,page);
			html += '<span class="dot">...</span>';
			for (var iPage = pages - 4; iPage <= pages; iPage++){
				html += getPageHtml(iPage,page);
			}
		}
		else
		{
			html +=  getPageHtml(1, page);
			html += '<span class="dot">...</span>';
			for (var iPage = page - 1; iPage <= page + 1; iPage++){
				html += getPageHtml(iPage,page);
			}
			html += '<span class="dot">...</span>';
			html +=  getPageHtml(pages,page);
		}
		var dis = page>= pages ? " page-start" : "";
		if (page >= pages) {
			html += '<a page="" href="javascript:void(0);" class="btn'+dis+'">下一页 <i>&gt;</i></a>';
		} else {
			html += '<a page="'+ (page+1) +'" href="javascript:void(0);" class="btn" onclick="' + goToFunc + '('+ (page+1) + ');">下一页 <i>&gt;</i></a>';
		}
		html += "</div></div>";
		
		return html;
		
		function getPageHtml(iPage,selPage)
		{
			var sHtml = '<a href="javascript:void(0);" onclick="'+goToFunc+'('+iPage+');"';
			if (iPage == selPage)
			{
				sHtml += ' class="page-start"';
			}else{
				sHtml += ' page="'+iPage+'"';
			}
			sHtml += ">"+iPage+"</a>\n";
			return sHtml;
		}
	}
	
	csi.timeToDate = function(time, d){
		if(time == 0 || !time){
			return '';
		}
		var dt = new Date();
		dt.setTime(time*1000);
		var mon = dt.getMonth()+1;
		if(mon < 10){
			mon = "0" + mon;
		}
		var day = dt.getDate();
		if(day < 10){
			day = "0" + day;
		}
		var date = dt.getFullYear() + "-" + mon + "-" + day;
		if(d){
			var hou = dt.getHours();
			if(hou < 10){
				hou = "0" + hou;
			}
			var min = dt.getMinutes();
			if(min < 10){
				min = "0" + min;
			}
			var sec = dt.getSeconds();
			if(sec < 10){
				sec = "0" + sec;
			}
			date += " "+hou+ ":" + min + ":" + sec;
		}
		return date;
	}
	
	//设置页面title
	csi.title = function(title){
		doc.title = title;
	}
	
	csi.checkLogin = function(){
		$.ajax({
			url		: "/json.php?biz=admin&mod=user",
			dataType	: "json",
			success	: function(data){
				console.log(data);
			}
		});
	}
	
	//初始化左侧菜单
	csi.initMenu = function(){
		_getUserInfo();
		//$(".ecc_side_navlist li a[href$='mod="+MOD+"&act="+ACT+"']").parent()[0].className = "ecc_side_navitem ecc_side_curitem";
		var line = $($(".ecc_side_navlist li a[href$='mod="+MOD+"&act="+ACT+"']").parent()[0]);
		line.addClass("ecc_side_curitem");
		line.find("span.num").addClass("em");
		
		//修改个人信息
		$("#menu-username").click(function(){
			$.ajax({
				url		: "/json.php?biz=admin&mod=user&act=getmyinfo&t="+Math.random(),
				dataType	: "json",
				success	: function(data){
					var html = "<table border='0' width='90%'><tr height='40px'><td align='right'><span>*</span>RTX英文名：</label></td>";
					html += "<td><input type='text' id='user-info-rtx' value='"+data.data.rtx_id+"' /></td></tr>";
					html += "<tr height='40px'><td align='right'><span>*</span>显示昵称：</td>";
					html += "<td><input type='text' id='user-info-showname' value='"+data.data.show_name+"' /></td></tr></table><br />";
					
					csi.newLayer("编辑个人信息", html, function(layerdom){
						var rtx = doc.getElementById("user-info-rtx").value;
						var name = doc.getElementById("user-info-showname").value;
						if(rtx){
							$.ajax({
								url		: "/json.php?biz=admin&mod=user&act=setmyinfo&t="+Math.random(),
								type	: "post",
								data	: {
									rtx	: rtx,
									name	: name
								},
								dataType	: "json",
								success	: function(data){
									if(data.errno === 0){
										layerdom.remove();
										_getUserInfo();
									}else{
										layerdom.find("span.msg-tips").html(data.msg);
									}
								}
							});
						}else{
							layerdom.find("span.msg-tips").html("RTX必填");
						}
					});
				}
			});
		});
		
		
	}
	
	
	
	
	
	
	
	
	
	csi.checkDateTime = function(str)  {   
	    var reg = /^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})$/;   
	    var r = str.match(reg); 
	    if(r==null)return false;   
	    r[2]=r[2]-1;   
	    var d= new Date(r[1],r[2],r[3],r[4],r[5],0);   
	    if(d.getFullYear()!=r[1])return false;   
	    if(d.getMonth()!=r[2])return false;   
	    if(d.getDate()!=r[3])return false;   
	    if(d.getHours()!=r[4])return false;   
	    if(d.getMinutes()!=r[5])return false;   
	    // if(d.getSeconds()!=r[6])return false;   
	    return true;   
	}
	
	csi.msgBox = function(msg){
		this.newLayer("提示", msg, function(laydom){
			laydom.remove();
		});
	}
	csi.msgBox2 = function(msg) {
		this.newLayer2("提示", msg, function(laydom){
			laydom.remove();
		});
	}
	csi.confirmBox = function(msg, func){
		this.newLayer("确认提示", msg, func);
	}
		
	csi.newLayer = function(title, content, okFunc){
		var html = "";
		html += "<div class='mod_pop' style='width: 550px;max-width: 600px;position: absolute;margin:0;'>";
		html += "<div class='mod_pop_hd' style='cursor: crosser;'><h3 class='mod_pop_tit'>"+title+"</h3><button type='button' class='mod_pop_close'>关闭</button></div>"
		html += "<div class='mod_pop_bd'><div class='ecc_mod_rowform'>";
		html += "<div class='' style='position: relative;margin-bottom: 15px;'>"+content+"</div>";
		html += "<div class='item'><div class='cont'><a href='javascript:void(0);' class='apply mod_btn'>确定</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='cancel mod_btn'>取消</a></div></div>";
		html += "<div class='item'><span class='msg-tips' style='color: red;'></span></div>";
		html += "</div></div>";
		
		var dom = $(html);
		dom.appendTo($(document.body));
		dom.css({"z-index": this.zindex});
		dom.center();
		this.zindex ++;
		
		csi.loadingShow();
		
		//拖动
		dom.draggable({handle: ".mod_pop_hd"});
		
		//关闭
		dom.find(".mod_pop_close, a.cancel").click(function(){
			dom.remove();
			//dom.animate({left: -600}, {duration: 400, complete: function(){dom.remove()}});
			csi.loadingHide();
		});
		
		//确定
		dom.find("a.apply").click(function(){
			if(typeof okFunc === "function"){
				okFunc(dom);
			}
			csi.loadingHide();
		});
	}
	csi.newLayer2 = function(title, content, okFunc){
		var html = "";
		html += "<div class='mod_pop' style='width: 500px;max-width: 600px;position: absolute;margin:0;'>";
		html += "<div class='mod_pop_hd' style='cursor: crosser;'><h3 class='mod_pop_tit'>"+title+"</h3><button type='button' class='mod_pop_close'>关闭</button></div>"
		html += "<div class='mod_pop_bd'><div class='ecc_mod_rowform'>";
		html += "<div class='' style='font-size:14px;position: relative;margin-bottom: 15px;text-align:center;'>"+content+"</div>";
		html += "<div class='item'><div style='text-align:center;'><a href='javascript:void(0);' class='apply mod_btn'>确定</a> </div></div>";
		html += "<div class='item'><span class='msg-tips' style='color: red;'></span></div>";
		html += "</div></div>";
		
		var dom = $(html);
		dom.appendTo($(document.body));
		dom.css({"z-index": this.zindex});
		dom.center();
		this.zindex ++;
		
		csi.loadingShow();
		
		//拖动
		dom.draggable({handle: ".mod_pop_hd"});
		
		//关闭
		dom.find(".mod_pop_close, a.cancel").click(function(){
			dom.remove();
			//dom.animate({left: -600}, {duration: 400, complete: function(){dom.remove()}});
			csi.loadingHide();
		});
		
		//确定
		dom.find("a.apply").click(function(){
			if(typeof okFunc === "function"){
				okFunc(dom);
			}
			csi.loadingHide();
		});
	}
	
	csi.newLayer3 = function(title, content, okFunc){
		var html = "";
		html += "<div class='mod_pop' style='width: 550px;max-width: 600px;position: absolute;margin:0;'>";
		html += "<div class='mod_pop_hd' style='cursor: crosser;'><h3 class='mod_pop_tit'>"+title+"</h3><button type='button' class='mod_pop_close'>关闭</button></div>"
		html += "<div class='mod_pop_bd'><div class='ecc_mod_rowform'>";
		html += "<div class='' style='position: relative;margin-bottom: 15px;'>"+content+"</div>";
		html += "<div class='item'><div class='cont'><a href='javascript:void(0);' class='apply mod_btn'>查看</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='cancel mod_btn'>关闭</a></div></div>";
		html += "<div class='item'><span class='msg-tips' style='color: red;'></span></div>";
		html += "</div></div>";
		
		var dom = $(html);
		dom.appendTo($(document.body));
		dom.css({"z-index": this.zindex});
		dom.center();
		this.zindex ++;
		
		csi.loadingShow();
		
		//拖动
		dom.draggable({handle: ".mod_pop_hd"});
		
		//关闭
		dom.find(".mod_pop_close, a.cancel").click(function(){
			dom.remove();
			//dom.animate({left: -600}, {duration: 400, complete: function(){dom.remove()}});
			csi.loadingHide();
			window.close();
		});
		
		//确定
		dom.find("a.apply").click(function(){
			if(typeof okFunc === "function"){
				okFunc(dom);
			}
			csi.loadingHide();
		});
	}
	csi.loadingShow = function(showLoadingText){
		/*
		$("#loading-tips").css({
			top: "0px"
		});*/
    	
    	if(showLoadingText){
    		$("#loading_text").show().center();
    	}
    	
    	$("#overlay").hide().addClass("overlay_show").css({"opacity" : 0.3, "z-index" : (csi.zindex-1)}).fadeIn(200);
	}
	
	csi.loadingHide = function(){
		/*
		$("#loading-tips").animate({
			top: "-25px"
		}, 360);*/

		$("#loading_text").hide();
		$("#overlay").fadeOut(200, function(){
			$("#overlay").removeClass("overlay_show").addClass("overlay_hide");
   		});
	}
	
	/*
	csi.setHeightFromFrame = function(){
		return;
		var obj = $("#frame");
		if($.browser.msie){
	        var height = document.compatMode == "CSS1Compat"? document.documentElement.clientHeight : document.body.clientHeight;
	    }else{
	        var height = self.innerHeight;
	    }
	    obj.attr("height", height);
	}
	
	csi.dyniframesize = function(down){
		return;
	    var pTar = null;
	    if (document.getElementById) {
	        pTar = document.getElementById(down);
	    } else {
	        eval('pTar = ' + down + ';');
	    }
	    if (pTar && !window.opera) {
	        //begin resizing iframe 
	        pTar.style.display = "block";
	        if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight) {
	            //ns6 syntax 
	            pTar.height = pTar.contentDocument.body.offsetHeight + 20;
	            pTar.width = pTar.contentDocument.body.scrollWidth + 20;
	        } else if (pTar.Document && pTar.Document.body.scrollHeight) {
	            //ie5+ syntax 
	            pTar.height = pTar.Document.body.scrollHeight;
	            pTar.width = pTar.Document.body.scrollWidth;
	        }
	    }
	}*/
	
	
	
	win.CSI = csi;
})(window);




(function($) {
    $.fn.extend({
        center: function() {
            return this.each(function() {
                var top = ($(window).height() - $(this).outerHeight()) / 2;
                var left = ($(window).width() - $(this).outerWidth()) / 2;
                $(this).css({top: (top > 0 ? top: 0) + 'px',
                left: (left > 0 ? left: 0) + 'px'});
                /*
                $(this).animate({
                    left: (left > 0 ? left: 0) + 'px'
                }, {duration: 700, easing: "easeInQuart"});
                */
            });
        }
    });
})(jQuery);