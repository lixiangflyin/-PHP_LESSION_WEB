qing.dom.ready(function(){var e=window.qVisitorInfo.loginStatus;e=="not_login"?(window.qui&&qui.showTopGuideTip&&qui.showTopGuideTip(),window._Forbid_TopYellow_Bar_=!0):(e=="not_activate"||e=="no_pass_username")&&!window.qVisitorInfo.isOldUser&&(window.qui&&qui.showTopGuideTip&&qui.showClickonceTip(),window._Forbid_TopYellow_Bar_=!0)}),qing.registNS("qdetail"),qdetail.ListenerMgr=function(){var e=function(e){return qVisitorInfo.loginStatus=="not_login"?(qing.event.stop(e),qui.showLogin(),!1):qVisitorInfo.loginStatus!="activated"?(qing.event.stop(e),qui.showActive(),!1):!0},t=function(e){var t=qext.fn.getAncestorByClass(this,"mod-repost-content"),n=qing.dom.query(".q-reasonitem",t);qing.array.each(n,function(e){qing.dom.removeClass(e,"hide")}),qing.dom.removeClass(this,"a-expand-reason"),qing.dom.addClass(this,"a-collapse-reason"),this.innerHTML="\u6536\u8d77",qing.event.stop(e)},n=function(e){var t=qext.fn.getAncestorByClass(this,"mod-repost-content"),n=qing.dom.query(".q-reasonitem",t);qing.array.each(n,function(e,t){if(t===0)return;qing.dom.addClass(e,"hide")}),qing.dom.removeClass(this,"a-collapse-reason"),qing.dom.addClass(this,"a-expand-reason"),this.innerHTML="\u67e5\u770b\u66f4\u591a\u8f6c\u8f7d\u7406\u7531",qing.event.stop(e)},r=function(e){var t=this;qui.showTip({width:140,height:20,msg:"\u786e\u5b9a\u8981\u5220\u9664\u8fd9\u7bc7\u535a\u5ba2\u5417\uff1f",target:t,anchor:"top",buttons:[{text:"\u786e\u5b9a",handler:function(e,t){qing.ajax.post("/pub/submit/deleteblog",{qbid:detailPage.threadId,bdstoken:qBdsToken},function(t){qui.showSuccess("\u5220\u9664\u6210\u529f"),e.close(),setTimeout(function(){var e=qPageInfo.referUrl;if(!e||!/^http/.test(e))e=qDomain.qing+qUserInfo.qingUrl+"/blog";location.href=e},600)},function(t){qui.showError("\u5220\u9664\u5931\u8d25"),e.close()})}},{text:"\u53d6\u6d88",type:"silver",handler:function(e,t){e.close()}}]}),qing.event.stop(e)},i=function(t){if(!e(t))return!1;var n=this,r={};r.name=detailPage.originAuthorName,r.portrait=detailPage.originPortrait;var i=qing.dom.query("#shareBnt .share-nub")[0],s=qing.dom.query("#commentBnt .comment-nub")[0],o=function(e,t,n){t.toReplyeeId&&(n.indexOf("\u56de")==0?n=n.replace("\u56de\u590d "+t.toReplyeeName+"\uff1a",""):t.toReplyeeId="");var r="";t.toReplyeeId?r=qing.string.format(qcmt.tpl.cmtReplyDetailTpl,{userUrl:qDomain.qing+"/go/check?portrait="+t.userInfo.portrait,userName:t.userInfo.nickname,replyeeUrl:t.toUrl,replyeeName:t.toReplyeeName,summary:qing.string.filterFormat.escapeString(n),isWiseIcoShowClass:"hide",imgUrl:t.userInfo.avatar||"",userId:t.userInfo.portrait||""}):r=qing.string.format(qcmt.tpl.cmtDetailTpl,{userUrl:qDomain.qing+"/go/check?portrait="+t.userInfo.portrait,userName:t.userInfo.nickname,summary:qing.string.filterFormat.escapeString(n),isWiseIcoShowClass:"hide",imgUrl:t.userInfo.avatar||"",userId:t.userInfo.portrait||""});var i="";if(!(e&&e[0]&&e[0].replyIdEnc))return;i=e[0].replyIdEnc;var s=qing.string.format(qcmt.tpl.cmtItem,{userUrl:qDomain.qing+"/go/check?portrait="+t.userInfo.portrait,userId:t.userInfo.portrait,userName:t.userInfo.userName,imgUrl:t.userInfo.avatar,cmtDetailTpl:r,cmtId:i,cmtPubTime:qing.date.format(new Date(e[0].cdatetime*1e3),"yyyy-MM-dd HH:mm"),isHoverShowClass:"delete-hover-show",isReplyHideClass:"hide"}),o=qing.dom.query(".cmt-list")[0];qing.dom.insertHTML(o,"afterBegin",s)};qext.fn.scrollFix(n);var u=qing.g("shareDetail");qdetail.repostBuilder=qcmt.build(u,{type:"repost",target:n,numElem:i,extraNumElem:s,id:detailPage.threadId,actorPortrait:qUserInfo.portrait,actorName:qUserInfo.userName,actorQingUrl:qUserInfo.qingUrl,contentType:detailPage.contentType,originAuthor:r,originThreadId:detailPage.originThreadId,repostSuccess:o,count:20,max:1e8})},s=function(t){if(!e(t))return!1;qing.dom.query("#commentDetail .qcmt-textarea-box")[0].focus(),qdetail.repostBuilder&&qdetail.repostBuilder.destroy()},o=function(e){return qVisitorInfo.loginStatus=="not_login"?(qing.event.stop(e),qui.showLogin(),!1):qVisitorInfo.loginStatus!="activated"?(qing.event.stop(e),qui.showActive(),!1):!0},u=function(e){if(!o(e))return!1;var t=this;qing.ajax.post(qDomain.qing+qUserInfo.qingUrl+"/qfriend/submit/addcare",{portrait:qUserInfo.portrait,bdstoken:qBdsToken},function(e){qui.showSuccess("\u5173\u6ce8\u6210\u529f"),qing.dom.addClass(t,"a-btn-followed"),qing.dom.removeClass(t,"a-btn-follow");var n=qing.dom.query(".mod-userinfo .q-fans span")[0],r=parseInt(n.innerHTML,10)||0;n.innerHTML=r+1}),qing.event.stop(e)},a=function(e){if(!o(e))return!1;var t=this;qing.ajax.post(qDomain.qing+qUserInfo.qingUrl+"/qfriend/submit/addcare",{portrait:qUserInfo.portrait,bdstoken:qBdsToken},function(e){window.qIsNotice=!0,qui.showSuccess("\u5173\u6ce8\u6210\u529f"),qing.dom.addClass(t,"a-btn-followed"),qing.dom.addClass(t,"a-btn-followed"),qing.dom.hide(t),qing.dom.removeClass(t,"a-btn-follow"),qdetail.followPopUp&&qdetail.followPopUp.close();var n=qing.dom.query(".mod-userinfo .q-fans span");if(n&&n.length!=0){var r=n[0],i=parseInt(r.innerHTML,10)||0;r.innerHTML=i+1}}),qing.event.stop(e)},f=function(e){if(!o(e))return!1;var t=this;qing.ajax.post(qDomain.qing+qUserInfo.qingUrl+"/qfriend/submit/deletecare",{portrait:qUserInfo.portrait,bdstoken:qBdsToken},function(e){qui.showSuccess("\u53d6\u6d88\u5173\u6ce8\u6210\u529f"),qing.dom.addClass(t,"a-btn-follow"),qing.dom.removeClass(t,"a-btn-followed");var n=qing.dom.query(".mod-userinfo .q-fans span")[0],r=parseInt(n.innerHTML,10)||1;n.innerHTML=r-1}),qing.event.stop(e)},l=function(e){if(!qVisitorInfo.isHost)return;qing.dom.addClass(this,"mouseover")},c=function(e){if(!qVisitorInfo.isHost)return;qing.dom.removeClass(this,"mouseover")},h=function(){qing.q("report-btn")&&qing.q("report-btn")[0]&&qing.dom.hasClass(qing.q("report-btn")[0],"hide")&&qing.removeClass(qing.q("report-btn")[0],"hide")},p=function(){qing.q("report-btn")&&qing.q("report-btn")[0]&&!qing.dom.hasClass(qing.q("report-btn")[0],"hide")&&qing.addClass(qing.q("report-btn")[0],"hide")},d=function(e){e.close();var t,n=['<div class="mod-report-confirm">',"<p>\u60a8\u7684\u4e3e\u62a5\u5df2\u53d7\u7406\uff0c\u611f\u8c22\u60a8\u5bf9\u767e\u5ea6\u7a7a\u95f4\u7684\u652f\u6301\uff01</p>","<p>\u6211\u4eec\u7684\u5458\u5de5\u4f1a\u5c3d\u5feb\u5904\u7406\u60a8\u7684\u4e3e\u62a5</p>"].join(""),r={title:"\u4e3e\u62a5\u8fdd\u89c4\u884c\u4e3a",opacity:.2,width:410,height:90,content:n,buttons:[{text:"\u786e\u5b9a",type:"green",handler:function(){t.close()}}]};t=new qui.dialog.Dialog(r),t.show({isAutoHide:!1})},v=function(e,t){var n=qDomain.qing+"/anti/submit/report";qing.ajax.request(n,{method:"POST",data:{reporter_id:t.erId||"",reportee_id:t.eeId||"",type:t.type||"1",reason:t.reason||"1",item_id:t.itemId||"",blog_id:t.blogId||"",content:t.content||"",url:t.url||qUserInfo.qingUrl},onsuccess:e||function(){}})},m=function(){var e,t=['<div class="mod-report-article">',"<p>\u4eb2\u7231\u7684\u7528\u6237\uff1a\u6b22\u8fce\u4f7f\u7528\u767e\u5ea6\u7a7a\u95f4\u4e3e\u62a5\u7cfb\u7edf\uff0c","\u60a8\u7684\u4e3e\u62a5\u4fe1\u606f\u6211\u4eec\u5c06\u5728\u53d6\u8bc1\u540e\u5904\u7406\uff0c","\u611f\u8c22\u60a8\u7684\u652f\u6301\uff0c\u8bf7\u4e0d\u8981\u6076\u610f\u4e3e\u62a5\u54e6\uff01</p>",'<div class="report-highlight">\u4f60\u8981\u4e3e\u62a5\u7684\u662f\uff1a</div>','<div class="report-capture clearfix">','<div class="left avatar"><img src="'+qUserAvatar.size40+'"></div>','<div class="left">','<div class="uname">'+qUserInfo.nickname+"</div>",'<div class="content" >\u6587\u7ae0\u6807\u9898\uff1a'+detailPage.blogTitle+"</div>","</div>","</div>",'<p class="report-highlight">\u4e3e\u62a5\u7c7b\u578b\uff1a</p>','<form id="reportTypeForm">','<ul class="clearfix">',"<li>",'<input type="radio" name="report_type" id="report_type1" value="1" />&nbsp;','<label for="report_type1">\u5783\u573e\u5e7f\u544a</label>',"</li>","<li>",'<input type="radio" name="report_type" id="report_type2" value="2" />&nbsp;','<label for="report_type2">\u6deb\u79fd\u8272\u60c5</label>',"</li>","<li>",'<input type="radio" name="report_type" id="report_type3" value="3" />&nbsp;','<label for="report_type3">\u654f\u611f\u4fe1\u606f</label>',"</li>","<li>",'<input type="radio" name="report_type" id="report_type4" value="4" />&nbsp;','<label for="report_type4">\u4eba\u8eab\u653b\u51fb</label>',"</li>","<li>",'<input type="radio" name="report_type" id="report_type5" value="5" />&nbsp;','<label for="report_type5">\u9a9a\u6270\u4ed6\u4eba</label>',"</li>","<li>",'<input type="radio" name="report_type" id="report_type6" value="6" />&nbsp;','<label for="report_type6">\u5176\u4ed6</label>',"</li>","</ul>","</form>",'<p class="red-tip hide">\u8bf7\u9009\u62e9\u4e3e\u62a5\u7c7b\u578b~</p>',"</div>"].join(""),n={title:"\u4e3e\u62a5\u8fdd\u89c4\u884c\u4e3a",opacity:.2,width:410,height:230,content:t,buttons:[{text:"\u786e\u5b9a",type:"green",handler:function(){var t=qing.dom.query("#reportTypeForm input:checked")[0];reportReason=t?t.value:"0";var n="1";switch(detailPage.contentType){case"text":n="1";break;case"picture":n="2";break;case"video":n="3";break;case"music":n="4";break;case"repost":n="5"}reportReason!=0&&(v(function(){d(e)},{erId:qVisitorInfo.portrait,eeId:qUserInfo.portrait,type:n,reason:reportReason,itemId:detailPage.threadId,url:qUserInfo.qingUrl,content:detailPage.blogTitle}),e.close());if(reportReason==0){var r=qing.dom.query(".mod-report-article .red-tip")[0];qing.removeClass(r,"hide"),setTimeout(function(){qing.addClass(r,"hide")},5e3)}}},{text:"\u53d6\u6d88",handler:function(){e.close()}}]};e=new qui.dialog.Dialog(n),e.show({isAutoHide:!1})},g={click:{"a-sendmsg":o,"a-btn-follow":u,"a-btn-followed":f,"share-bnt":i,"comment-bnt":s,"a-expand-reason":t,"a-collapse-reason":n,"delete-bnt":r},mouseover:{"wraper-avatar":l,"mod-post-content":h},mouseout:{"wraper-avatar":c,"mod-post-content":p}},y={click:{"a-btn-follow":a}},b=function(){qext.fn.addEventMap(qing.dom.q("mod-page-main")[0],["click","mouseover","mouseout"],g),qext.fn.addEventMap(qing.dom.q("mod-topbar")[0],["click"],y)};return{run:b}}(),qing.registNS("qdetail"),qdetail.main=function(){var e=function(e,t,n){var r=new Image;r.onload=function(){var i=r.width,s=r.height;if(i&&s){var o=i/s;i>t&&(e.width=t,e.height=t/o)}n&&n()},r.src=e.src},t=function(){if(!qing.browser.ie&&qing.browser.ie>6)return;var t=qing.dom.query(".text-content img");qing.array.each(t,function(t,n){var r=qing.dom.getAncestorByClass(t,"content").clientWidth;e(t,r)})},n=function(){var e=function(e){var t=new Date(qServerInfo.timeStamp*1e3),n=new Date(e*1e3),r=Math.round(t.getTime()/1e3-e),i="",s=(new Date(n.getYear(),n.getMonth()+1,0)).getDate();return r<60?i=r+"\u79d2\u524d":r<3600?i=Math.round(r/60)+"\u5206\u949f\u524d":r<86400&&t.getDate()==n.getDate()?i=qing.date.format(n,"HH:mm"):r<172800&&(t.getDate()-n.getDate()==1||t.getDate()-n.getDate()+s==1)?i=qing.date.format(n,"\u6628\u5929HH:mm"):r<259200&&(t.getDate()-n.getDate()==2||t.getDate()-n.getDate()+s==2)?i=qing.date.format(n,"\u524d\u5929HH:mm"):i=n.getMonth()+1+"\u6708"+n.getDate()+"\u65e5",i},t=qing.dom.query(".mod-recent-readers .visit-time");qing.array.each(t,function(t,n){var r=qing.dom.getAttr(t,"data-visit-time");t.innerHTML=e(r)})},r=function(){var e=qing.dom.g("commentDetail");if(!e)return;var t=qing.dom.query("#commentDetail .comment-content")[0],n=qing.g("commentBnt"),r=qing.dom.query("#commentBnt .comment-nub")[0];if(!t)return;var i=function(){var e=qing.dom.query("#commentDetail .qcmt-textarea-box")[0],t=location.hash.replace(/^#/,""),n=40,r=qing.browser.isWebkit?document.body:document.documentElement,i=r.scrollTop;if(t=="reply"){e.focus(),qext.fn.scrollFix(e);var s=qing.dom.getPosition(e).top-n,o=s<0?0:s;r.scrollTop=o}else{var u=qing.g(t);if(u){var s=qing.dom.getPosition(u).top-n,o=s<0?0:s;r.scrollTop=o}}};qdetail.cmtBuilder=qcmt.build(t,{type:"comment",target:n,numElem:r,focus:!1,callback:i,bindTargetEvent:!1,id:detailPage.threadId,actorPortrait:qUserInfo.portrait,actorQingUrl:qUserInfo.qingUrl,count:20,max:1e10})},i=function(){var e=qing.g("content"),t=qing.dom.query(".mod-post-content .description")[0],n=[];t&&(qing.dom.query("ul",t,n),qing.dom.query("ol",t,n)),e&&(qing.dom.query("ul",e,n),qing.dom.query("ol",e,n)),qing.array.each(n,function(e,t){e.style.listStyleType&&e.style.listStyleType!="none"&&(e.style.marginLeft="35px")})},s=function(){var e=baidu.dom.query(".op-box")[0],t=baidu.dom.query(".tag-box")[0];if(t&&e){var n=e.offsetHeight;n>20&&baidu.dom.setStyles(t,{"float":"none",display:"block"})}},o=function(){if(qVisitorInfo.isHost)return;if(location.hash=="#repost"){var e=qing.dom.q("share-bnt")[0];e&&qing.event.fire(e,"click")}},u=function(){qext.back2top.init()},a=function(){if(!window.cmsBlogs||cmsBlogs.switchOn===!1)return;var e=qUserInfo.portrait;cmsBlogs.recommends[e]?f(cmsBlogs.recommends[e],"recommends"):cmsBlogs.relates[e]&&f(cmsBlogs.relates[e],"relates")},f=function(e,t){var n=qing.dom.g("relateBlog"),r=qing.dom.g("relateBlogList"),i=[];qing.dom.removeClass(n,"hide");var s=e.length;if(s<=7)i=e;else for(var o=0;o<7;o++){var u=Math.floor(Math.random()*s),a=qing.array.removeAt(e,u);i.push(a),s--}qing.array.each(i,function(e,n){var e=e||{},i=document.createElement("li");n==0&&qing.dom.addClass(i,"first"),i.innerHTML=['<a target="_blank" href="'+e.url+'" class="qing-stat-nsclick" data-nsclick="m_20121105_detail_'+t+'_img">','<img src="'+e.img+'" class="relate-img" alt="'+e.txt+'" title="'+e.txt+'" /></a>','<a class="relate-txt qing-stat-nsclick" data-nsclick="m_20121105_detail_'+t+'_txt" href="'+e.url+'">'+e.txt+"</a>"].join(""),r.appendChild(i)})},l=function(){qext.lazy.ImageLoad.init(),t(),qdetail.ListenerMgr.run(),o(),n(),r(),i(),s(),u(),T.q("report-btn")&&T.q("report-btn").length>0&&(T.q("report-btn")[0].href="http://tousu.baidu.com/hi.add?tsurl="+encodeURIComponent(location.href))};return{init:l}}(),qing.dom.ready(function(){qdetail.main.init()});