qing.registNS("qing.QMsg");qing.QMsg.LongPolling=(function(){window.setReady=function(){window.flashReady=true};if(!window.initSpaceMessage){window.initSpaceMessage=function(){}}var b=function(){var c=[];c.push(parseInt(Math.random()*10000,10).toString());c.push(new Date().getTime().toString());return c.join("")};function a(e,c,d){if(window.isInitSRequest){throw new Error("SingleRequest已经被实例化")}this.portrait=e;this.stDomain=c;this.domain=d;this.pageId=parseInt(Math.random()*10000).toString()+(new Date).getTime().toString();this.swfEle=this.createSwf();if(T.browser.firefox>0){this.createPostIfm()}window.lpAdmin=window.lpAdmin||false}a.prototype={_SWF_CID:"sr_swfContainer",_SWF_ID:"sr_swf",_IFRAME_ID:"sr_iframe",_URL:qLongPolling.url,_isCreateConn:false,_isMaster:false,pageId:null,swfEle:null,sendFuncs:[],admincBacks:[],swfCounts:0,createSwf:function(){var c='<div style="height: 1px;left: 1px;overflow: hidden;position: absolute;top: 1px;width: 1px;background:#000" id="'+this._SWF_CID+'"></div>';baidu.dom.insertHTML(document.body,"beforeEnd",c);baidu.swf.create({id:this._SWF_ID,width:1,height:1,url:qDomain["static"]+"/static/qmessage/swf/longpolling.swf?v=c114dc3e.swf?swfran="+b(),wmode:"opaque",allowscriptaccess:"always","allownetworking ":"all"},baidu.g(this._SWF_CID));return baidu.swf.getMovie(this._SWF_ID)},createPostIfm:function(){baidu.dom.insertHTML(document.body,"beforeEnd",'<iframe id="'+this._IFRAME_ID+'" src="'+this.domain+'/com/show/proxy?for=longpolling" scrolling="no" allowTransparency="true" style="display:none;" frameborder="0"></iframe>');window.addEventListener("message",T.fn.bind(this.ifrmeEvent,this),false)},ifrmeEvent:function(c){this.dataHandler(baidu.json.decode(c.data))},superCallback:function(){},addSendFunc:function(c){this.sendFuncs.push(c)},addAdminCBack:function(c){this.admincBacks.push(c)},exAdminCBack:function(e){var c=this.admincBacks.length;for(var d=0;d<c;d++){this.admincBacks[d](e)}},start:function(){var d=baidu.swf.version;if(d){if(!window.flashReady){if((this.swfCounts++)>30){if(!this.isSendErrLog){this.isSendErrLog=true}}setTimeout(T.fn.bind(function(){this.start()},this),1000);return}if(!this.isSendOkLog){this.isSendOkLog=true}var c=this.swfEle.checkAdmin(this.portrait,this.pageId,window.lpAdmin);var f=false;if(c){f=true}if(c&&!window.lpAdmin){this.sendChannel();return}var e=this.swfEle.connectChannel();if(e){if(!c||(c&&window.lpAdmin)){this.request()}else{this.sendChannel()}}else{if(window.lpAdmin){this.superCallback();return}this.sendChannel()}}else{this.request()}},sendChannel:function(){this.swfEle.sendChannel();setTimeout(T.fn.bind(function(){this.start()},this),30000)},sendCmd:function(c,d){try{this.swfEle.sendCmd(c)}catch(f){}},clearData:function(){},parseData:function(f){var c=this.sendFuncs.length;for(var d=0;d<c;d++){try{this.sendFuncs[d](f)}catch(g){}}},dataHandler:function(d){if(d.err_no){return}if(d.msg&&d.msg[0]){d.msg[0].msgId="msg_"+b()}this.exAdminCBack(d);this.parseData(d);var c={};baidu.extend(c,d);c.transfer=true;if(c.msg){try{this.swfEle.send(c)}catch(f){}}clearTimeout(this.stId);this.start()},request:function(){var c=this._URL+"?r="+Math.random();if(T.browser.firefox>0){if(!this.iframeWin){this.iframeWin=baidu.g(this._IFRAME_ID).contentWindow}this.iframeWin.postMessage(c,this.domain)}else{setTimeout(function(){baidu.page.loadJsFile(c)},10)}this.sending=true;this.stId=setTimeout(T.fn.bind(function(){this.start()},this),70000)}};return{SingleRequest:a}})();qing.registNS("qing.QMsg");qing.QMsg.Notice=(function(){var g=document.title;var f=0;var b=[];var e=500;var a;function d(j){if(typeof j=="string"){b=[].concat("【"+j+"】","【"+new Array(j.length+1).join("　")+"】")}else{b=[].concat(j)}}function i(j){e=j||500}function c(j,k){d(j);i(k);h();a=setInterval(function(){document.title=b[f]+g;f++;if(f>b.length-1){f=0}},e)}function h(){clearInterval(a);document.title=g}return{blink:c,stop:h,setDelay:i}})();qing.registNS("qing.QMsg");qing.QMsg.msgList=(function(){var b;var f=function(g){var g=g||{};b=g.listItemHTML};var c=function(h,g,i){qing.ajax.request(qDomain.qing+"/qmsg/data/msglist?number="+g+"&p="+h,{noCache:true,onsuccess:function(j){listDatas=j[0].qMsglist;i(listDatas)}})};var e=function(g){qing.ajax.request(qDomain.qing+"/qmsg/data/unread",{noCache:true,onsuccess:function(h){g(h[0])}})};var a=function(g){var n="";var o="";var h="";var l=b;var k=[];for(var m=0;m<g.length;m++){var j=g[m];if(j.type=="1"){o=" follow";h=j.who.qingUrl;n='<a target="_blank" title="'+j.who.username+'" href="'+j.who.qingUrl+'" onclick="event.cancelBubble=true;">'+j.who.usernameTruncate+"</a> 关注了你"}else{if(j.type=="2"){o=" share";h=j.target.url;if(j.target.title!=""){n='<a target="_blank" title="'+j.who.username+'" href="'+j.who.qingUrl+'" onclick="event.cancelBubble=true;">'+j.who.usernameTruncate+"</a> 转载了你的 "+d(j.target.type)+' <a target="_blank" title='+j.target.title+' href="'+j.target.url+'" onclick="event.cancelBubble=true;">'+j.target.titleTruncate+"</a>"}else{n='<a target="_blank" title="'+j.who.username+'" href="'+j.who.qingUrl+'" onclick="event.cancelBubble=true;">'+j.who.usernameTruncate+'</a> 转载了你的 <a target="_blank" href="'+j.target.url+'" onclick="event.cancelBubble=true;">'+d(j.target.type)+"</a>"}}else{if(j.type=="3"){o=" comment";h=j.target.url+"#"+j.target.commentId;if(j.target.title!=""){n='<a target="_blank" title="'+j.who.username+'" href="'+j.who.qingUrl+'" onclick="event.cancelBubble=true;">'+j.who.usernameTruncate+"</a> 回应了你的 "+d(j.target.type)+' <a target="_blank" title='+j.target.title+' href="'+j.target.url+"#"+j.target.commentId+'" onclick="event.cancelBubble=true;">'+j.target.titleTruncate+"</a>"}else{n='<a target="_blank" title="'+j.who.username+'" href="'+j.who.qingUrl+'" onclick="event.cancelBubble=true;">'+j.who.usernameTruncate+'</a> 回应了你的 <a target="_blank" href="'+j.target.url+"#"+j.target.commentId+'" onclick="event.cancelBubble=true;">'+d(j.target.type)+"</a>"}}else{if(j.type=="4"){o=" comment";h=j.target.url+"#"+j.target.commentId;if(j.target.title!=""){n='<a target="_blank" title="'+j.who.username+'" href="'+j.who.qingUrl+'" onclick="event.cancelBubble=true;">'+j.who.usernameTruncate+"</a> 在 "+d(j.target.type)+' <a target="_blank" title='+j.target.title+' href="'+j.target.url+"#"+j.target.commentId+'" onclick="event.cancelBubble=true;">'+j.target.titleTruncate+"</a> 下回应了你"}else{n='<a target="_blank" title="'+j.who.username+'" href="'+j.who.qingUrl+'" onclick="event.cancelBubble=true;">'+j.who.usernameTruncate+'</a> 在 <a target="_blank" href="'+j.target.url+"#"+j.target.commentId+'" onclick="event.cancelBubble=true;">'+d(j.target.type)+"</a> 下回应了你"}}else{if(j.type=="5"){o=" alert";var p=qing.lang.guid();n=['<form action="'+qDomain.qing+'/anti/submit/appeal" method="post" style="display:none" id="appelForm'+p+'" target="_blank">','<input type="hide" name="bdstoken" value="'+qBdsToken+'"/>','<input type="hide" name="portrait" value="'+j.target.commentId+'"/>','<input type="hide" name="appealid" value="'+j.target.appealId+'"/>','<input type="hide" name="src" value="'+j.target.src+'"/>',"</form>","抱歉，您发布的内容",(j.target.title!="")?"《"+j.target.title+"》":"","可能包含不合适的内容，已被管理员删除（锁定），如您需要申诉，",'<a href="#" onclick="qing.g(\'appelForm'+p+"').submit();return false;\">请点击</a>"].join("")}else{if(j.type=="6"){o=" alert";h=j.target.url;n=j.target.title}else{continue}}}}}}l=b;l=qing.string.format(l,{"class":o,content:n,time:j.time,id:j.id,clickEvent:j.type=="5"?"":"onclick=\"window.open('"+h+"');return false;\""});k.push(l)}return k.join("")};var d=function(g){if(g=="text"){return"文字"}else{if(g=="video"){return"视频"}else{if(g=="music"){return"音乐"}else{if(g=="picture"){return"图片"}}}}};return{initialize:f,buildMsgList:a,getMsgDatas:c,getUnreadNum:e}})();qing.registNS("qing.QMsg");qing.QMsg.msgBubble=(function(){var m;var b;var u;var p;var e;var q;var h;var l;var c=0;var d=0;var s=function(v){var v=v||{};m=v.maxUnreadNum||100;b=v.maxUnreadViewListNum||10;if(v.bubbleContainer==null){var w=qing.dom.query(".mod-topbar .wrapper-box")[0];qing.dom.insertHTML(w,"afterBegin",'<div class="mod-msg-bubble hide" id="mod-msg-bubble"></div>');p=qing.g("mod-msg-bubble")}else{p=qing.g(v.bubbleContainer)}qing.event.on(document,"click",function(x){var y=qing.event.getTarget(x);if(!qing.dom.contains(p,y)){if(l){j()}}});qing.event.on(qing.dom.getParent(qing.g("qMsgUnReadTips")),"click",function(x){qing.event.preventDefault(x);if(l){j()}else{f()}});e=v.bubbleTpl;q=v.unReadNumTipsTpl;h=v.msgItemTpl;l=false;r();window.SpNet=new qing.QMsg.LongPolling.SingleRequest(qUserInfo.portrait,qDomain["static"],qDomain.qing);window.SpNet.addAdminCBack(function(x){g(x)});window.SpNet.addSendFunc(function(x){if(x.act){switch(x.act){case"clear_unread":n();break;case"new_msg":t();break}return}});window.SpNet.start()};var r=function(){qing.QMsg.msgList.getUnreadNum(function(w){c=parseInt(w.unreadNumMsg);d=parseInt(w.unreadNumLetter);if(d>0){qing.g("qUnreadNumLetter").innerHTML="("+d+")"}qing.dom.insertHTML(qing.dom.query(".mod-topbar .wrapper-box")[0],"beforeEnd",q);var A=qing.page.getWidth();var x=qing.dom.getPosition(qing.g("qMsgUnReadTips")).left;var B=Math.ceil(A-x-(A-980)/2);var C=qing.dom.query(".mod-topbar .wrapper-box")[0];var v=C.offsetHeight;var y=Math.ceil(v/2)-18;u=qing.dom.query(".mod-msg-unread-num")[0];var D=qing.dom.getPosition(qing.g("qMsgUnReadTips"));u.style.top=y+"px";u.style.left=(980-B)+"px";var z=u;if(c>0){qing.dom.removeClass(z,"hide");if(c>m){qing.dom.query(".content",z)[0].innerHTML=m+"+"}else{qing.dom.query(".content",z)[0].innerHTML=c}}qing.event.on(z,"click",function(){if(!l){f()}})})};var n=function(){c=0;qing.QMsg.Notice.stop();var v=u;qing.dom.addClass(v,"hide")};var f=function(){qing.QMsg.Notice.stop();qing.QMsg.msgList.initialize({listItemHTML:h});qing.QMsg.msgList.getMsgDatas(0,b,function(y){var B=[];if(c<b){if(c>0){B=y.slice(0,c)}else{B=y}}else{B=y.slice(0,b)}var z=[];qing.array.each(B,function(H,G){H.who.usernameTruncate=qing.string.subByte(H.who.username,14);if(H.type!=1){H.target.titleTruncate=qing.string.subByte(H.target.title,26-qing.string.getByteLength(H.who.usernameTruncate))}z.push(H)});var x=e;if(B.length>0){x=x.replace("#{msgList}",qing.QMsg.msgList.buildMsgList(z))}else{x=x.replace("#{msgList}","<li><span class='noMsg-content'>无最新消息<span></li>")}p.innerHTML=x;var v=qext.fn.getDimensions(qing.dom.query(".mod-topbar .wrapper-box")[0]);p.style.top=(v.height-7)+"px";var E=qing.page.getWidth();var C=qing.dom.getPosition(qing.g("qMsgUnReadTips")).left;var D=qing.dom.query(".bubble-icon-container .bubble-icon")[0];var F=Math.ceil(E-C-(E-980)/2)+5;qing.dom.setStyle(D,"right",F+"px");qing.dom.removeClass(p,"hide");l=true;var A=qext.fn.getDimensions(p);p.style.height="0px";var w=qani.animate(p,{height:0+"px"},{height:(A.height+7)+"px$tween:strongAc2deCelerate"},600);w.on("finish",function(){n();window.SpNet.sendCmd("clear_unread")})})};var j=function(){l=false;var w=qext.fn.getDimensions(p);var v=qani.animate(p,{height:w.height+"px"},{height:0+"px$tween:strongAc2deCelerate"},600);v.on("finish",function(){qing.dom.addClass(p,"hide");p.style.height="auto";p.innerHTML=""})};var g=function(v){if(v.msg.length==0){return}var w=parseInt(v.msg[0].content);unreadNumDom=u;if(w>0){t(function(){window.SpNet.sendCmd("new_msg")})}else{qing.dom.addClass(unreadNumDom,"hide")}};var t=function(w){var v=u;qing.QMsg.msgList.getUnreadNum(function(x){c=parseInt(x.unreadNumMsg);if(c>0){if(c>m){qing.dom.query(".content",v)[0].innerHTML=m+"+"}else{qing.dom.query(".content",v)[0].innerHTML=c}qing.dom.removeClass(v,"hide");qing.QMsg.Notice.blink("有新消息",600);if(w){w()}}else{qing.dom.addClass(v,"hide")}})};var o=function(w){var v=qing.dom.query(".msg-item-icon",w)[0];if(qing.dom.hasClass(v,"comment")){qing.dom.removeClass(v,"comment");qing.dom.addClass(v,"comment-hover")}else{if(qing.dom.hasClass(v,"follow")){qing.dom.removeClass(v,"follow");qing.dom.addClass(v,"follow-hover")}else{if(qing.dom.hasClass(v,"share")){qing.dom.removeClass(v,"share");qing.dom.addClass(v,"share-hover")}}}qing.dom.addClass(w,"item-hover")};var a=function(w){var v=qing.dom.query(".msg-item-icon",w)[0];if(qing.dom.hasClass(v,"comment-hover")){qing.dom.removeClass(v,"comment-hover");qing.dom.addClass(v,"comment")}else{if(qing.dom.hasClass(v,"follow-hover")){qing.dom.removeClass(v,"follow-hover");qing.dom.addClass(v,"follow")}else{if(qing.dom.hasClass(v,"share-hover")){qing.dom.removeClass(v,"share-hover");qing.dom.addClass(v,"share")}}}qing.dom.removeClass(w,"item-hover")};var k=function(){var v=qing.g("modTopbar");if(!v){return false}s({maxUnreadNum:99,maxUnreadViewListNum:10,unReadNumTipsTpl:['<div class="mod-msg-unread-num hide">','<div class="left-border"></div>','<div class="content"></div>','<div class="right-border"></div>',"</div>"].join(""),bubbleTpl:['<div class="bubble-icon-container">','<div class="bubble-icon"></div>',"</div>",'<div class="mod-msg-bubble-container">','<div class="bubble-content">','<div class="grid-36">','<div class="bubble-title-container clearfix">','<div class="bubble-title">消息</div>','<a onclick="qing.QMsg.msgBubble.closeBubble();return false;" title="关闭" href="#" class="bubble-title-close" target="_blank"></a>',"</div>",'<ul class="bubble-msg-list" id="bubble-msg-list">',"#{msgList}","</ul>","</div>",'<div class="bubble-more">','<a href="/qmsg" class="a-normal" target="_blank">查看全部消息</a>',"</div>","</div>",'<div class="bubble-bottom"></div>',"</div>"].join(""),msgItemTpl:['<li class="clearfix#{class}-li" #{clickEvent} onmouseover="qing.QMsg.msgBubble.itemMouseOn(this)" onmouseout="qing.QMsg.msgBubble.itemMouseOut(this)">','<span class="msg-item-icon#{class}"></span>','<span class="msg-item-word wordwrap">#{content}</span>',"</li>"].join("")})};var i=function(){qing.dom.ready(function(){k()})};return{initialize:s,showBubble:f,closeBubble:j,updateUnreadNum:g,itemMouseOn:o,itemMouseOut:a,init:i}})();qing.QMsg.msgBubble.init();