var editor_path = Tcc.base + "js/tcc/qmeditor/";
var editorUploadUrl = Tcc.base + "apis/qmeditor_upload.php";
var docUploadUrl = Tcc.base + "apis/doc2html.php";

var mo_path = "http://dayu.oa.com/image/mo/";
var css_path = editor_path + "style/";
//navigate
var gsAgent = navigator.userAgent.toLowerCase();
var gfAppVer = parseFloat(navigator.appVersion);
var gsAppVer = navigator.appVersion.toLowerCase();
var gIsWebKit = gsAgent.indexOf("applewebkit") > -1;
var gIsOpera = gsAgent.indexOf("opera") > -1;
var gIsKHTML = gsAgent.indexOf("khtml") > -1 || gsAgent.indexOf("konqueror") > -1 || gsAgent.indexOf("applewebkit") > -1;
var gIsSafari = gsAgent.indexOf("applewebkit") > -1;
var gIsIE = ( gsAgent.indexOf("compatible") > -1 && !gIsOpera ) || gsAgent.indexOf("msie") > -1;
var gIsTT = gIsIE ? (navigator.appVersion.indexOf("tencenttraveler") != -1 ? 1 : 0) : 0;
var gIsFF = gsAgent.indexOf("gecko") > -1 && !gIsKHTML;
var gIsQBWebKit = gIsWebKit ? (gsAppVer.indexOf("qqbrowser") != -1 ? 1 : 0) : 0;
var gIsChrome = gIsWebKit && !gIsQBWebKit && gsAgent.indexOf("chrome") > -1 && gsAgent.indexOf("se 2.x metasr 1.0") < 0; //排除搜狗浏览器在高速模式下
var gIsNS = !gIsIE && !gIsOpera && !gIsKHTML && (gsAgent.indexOf("mozilla") == 0) && (navigator.appName.toLowerCase() == "netscape");
var gIsAgentErr = !( gIsOpera || gIsKHTML || gIsSafari || gIsIE || gIsTT || gIsFF || gIsNS );
var g_sid="sid";

var iframe_src = "javascript:void((function(){document.open('text/html','replace');document.domain=\'"+document.domain+"\';document.close();})())";


if ( gIsIE ) {
    var reIE = new RegExp( "MSIE (\\d+\\.\\d+);", "i" );
    reIE.test( navigator.userAgent );
    var gIEVer = parseFloat( RegExp[ "$1" ] );
}

function GetDomain() {
    return document.domain;
}

function RegFilter( str ) {
    return str.replace( /([\^\.\[\$\(\)\|\*\+\?\{\\])/ig, "\\$1" ) ;
}
function Template( t, f ) {
    var _t = typeof( t ) == "string" ? t : ( t.join ? t.join( "" ) : "" );
    var _tD, _lD, _f = f ? f : "$", _rf = RegFilter( _f );
    var rP =  function(p) {
        if ( !_tD )
            _lD = ( _tD = _t.split( _f ) ).concat();
        for ( var i = 1, _len = _tD.length; i < _len; i += 2 )
            _lD[ i ] = p[ _tD[ i ] ];
        return _lD.join( "" );
    };
    var rRE = function( p ) {
        return _t.replace( new RegExp( [ _rf, "(.*?)", _rf ].join( "" ), "ig" ), function( m, v ){return p[ v ];} );
    };
    this.toString = function() {
        return _t;
    };
    this.replace = function( p, defaultFunc ) {
        return ( defaultFunc == "parse" || !( document.all && !( /opera/i.test(navigator.userAgent ) ) ) ? rP : rRE )( p );
    };
}
function T( t, f ) {
    return new Template( t, f );
}

function CreateActiveX(activexId) {
    var _oScreenCapture;
     try {
        if (gIsIE) {
            //IE
            var tmpActivexName="SCActiveX.ScreenCapture";
            if (activexId==2) {
                tmpActivexName="SCActiveX.Uploader";
            }
            _oScreenCapture = new ActiveXObject(tmpActivexName);
        } else if (gIsChrome || gIsFF) {
            if (activexId==2) {
                //load uploader
               _oScreenCapture = getEmbed().CreateUploader();
            } else {
               _oScreenCapture = getEmbed().CreateScreenCapture();
            }
        } else {
        }
    } catch (_oError) {
        //alert("getScreenCapture Error : " +  _oError.message);
    }
    return _oScreenCapture;
}
//activexId: 0 - screen capture; 1 - upload file partition; 2 - upload; detectType: 0 - exist; 1 - min exist; 2 - new exist
function DetectActiveX(activexId, detectType, _aActiveXObj) {
    if ( gIsFF || gIsChrome ) {
        //FF or Chrome
        return checkInstallPlugin(activexId);
    }
    var result = false;
    try {
        var o = new ActiveXObject('SCActiveX.ScreenCapture');
        result = (o.version < '1.0.0.2') ? false : true;
        o = null;
    }catch(e){}
    
    return result;
}

/*------------------ start of ScreenCapture for FF&Chrome, by franky----------------------------*/


/**
 * 检查FF/Chrome浏览器有没装插件
 * _anPluginId: 0 - screen capture; 1 - upload file partition; 2 - upload; detectType:
 *
 */
function checkInstallPlugin(_anPluginId) {
    
    var ff_plugin_name = 'QQMail Plugin';
    var ff_plugin_type = 'application/x-tencent-qmail';
    _oPlugins	= navigator.plugins;
    if ( _oPlugins ) {
        for ( var i = _oPlugins.length - 1; i >= 0; i-- )
        {
            for (var j = _oPlugins[i].length - 1; j >= 0; j--)
            {
                if(ff_plugin_name == _oPlugins[i].name && _oPlugins[i][j].type.indexOf(ff_plugin_type) != -1 ) {
                    try {
                        return (getGetVersion() < '1.0.1.34') ? false : true;
                    } catch (e) {
                        return false;
                    }
               } else {
                    continue;
               }
            }
        }
    }
    return false;
}

function getGetVersion()
{
    var _oScreenCapture = getScreenCapture();
    return _oScreenCapture.Version;
};

//截屏
function getScreenCapture()
{
  return CreateActiveX();
}

function getEmbed()
{
    var _sEmbedId = "tapd_qmeditor_embed1",
    _oEmbed = S(_sEmbedId);
    if (!_oEmbed) {
        var _oEmbed = document.createElement("embed");
        _oEmbed.id = _sEmbedId;
        if(gIsFF) {
            _oEmbed.type = "application/x-tencent-qmail"; //FF
        } else {
            _oEmbed.type = "application/x-tencent-qmail-webkit"; //chrome
        }
        _oEmbed.hidden = "true";
        _oEmbed.height = "1";
        _oEmbed.width = "1";
        _oEmbed.style.position = "absolute";
        _oEmbed.style.left = "0px";
        _oEmbed.style.top = "0px";
        document.body.appendChild(_oEmbed);
    }
    return _oEmbed;
}

function doCapture()
{
    var _fSelf = arguments.callee;
    _fSelf.bWait = true;
    setTimeout(function()
    {
        var _oScreenCapture = getScreenCapture();

        window._oScreenCapture = _oScreenCapture; //防止被回收

        _oScreenCapture.OnCaptureFinished = function() {
            _fSelf.bWait = false;
            output(["testDoCapture 成功"]);
        };
        _oScreenCapture.OnCaptureCanceled = function() {
            _fSelf.bWait = false;
            output(["testDoCapture 取消"]);
        };
        var b = _oScreenCapture.DoCapture();
        output(["DoCapture 返回", b]);
        //window.gScreenCapture = _oScreenCapture;
    }, 1000);
};

/*--------------------- end of get -------------------------*/

//global base function
var gd = document;

function GelTags(tag, ob) {
    return ( ob || gd ).getElementsByTagName(tag);
}
function S(i, win) {
    try {
        return ( win || window ).document.getElementById(i);
    }
    catch( e ) {
        return null;
    }
}

//add by minglin
function SetClass(sID, sclass) {

}

function GetTopWin(){
    return window;
}

function F(sID, win) {
    if ( !sID )
        return null;
    var frame = S( sID, win );
    if ( !frame )
        return null;
    return frame.contentWindow || ( win || window ).frames[sID];
}
function E(list, Func, start, end) {
    if (!list)
        return;
    if ( list.length != null ) {
        var len = list.length;
        for (var i = (start || 0), end = end < 0 ? (len + end) : (end < len ? end : len); i < end; i++)
            try{Func(list[i], i, len);}catch(e){}
    }
    else {
        for (var i in list)
            try{Func(list[i], i);}catch(e){}
    }
}

function InsertHTML(el, where, html) {
    if ( !el )
        return false;
    try {
        //err ex: textarea afterBegin ... ( can not insert ... )
        if (el.insertAdjacentHTML) {
            el.insertAdjacentHTML( where, html );
        }
        else {
            var range = el.ownerDocument.createRange();
            var isBefore = where.indexOf("before") == 0;
            var isBegin = where.indexOf("Begin") != -1;
            if (isBefore == isBegin) {
                range[isBefore ? "setStartBefore" : "setStartAfter"](el);
                el.parentNode.insertBefore(range.createContextualFragment(html), isBegin ? el : el.nextSibling);
            }
            else {
                var obj = el[isBefore ? "lastChild" : "firstChild"];
                if (obj) {
                    range[isBefore ? "setStartAfter" : "setStartBefore"](obj);
                    el[isBefore ? "appendChild" : "insertBefore"](range.createContextualFragment(html), obj);
                }
                else {
                    el.innerHTML = html;
                }
            }
        }
        return true;
    }
    catch( e ) {
        return false;
    }
}

function RemoveSelf( _aObj ) {
    if ( _aObj )
        _aObj.parentNode.removeChild( _aObj );
}
function GetSid() {
    return g_sid;
    /*
    try {var s = top.g_sid;}catch(e){}
    s = s ? s : (S("sid") ? S("sid").value : "");
    if (!s) {
        s = (top.location.href.split("?")[1]).split("&");
        s = s[0].split("=")[1];
    }
    return s;
    */
}

function IsShow(obj) {
    obj = (typeof(obj) == "string" ? S(obj) : obj);
    if (!obj) return false;
    return obj.style.display != "none";
}
function Show(obj, bShow) {
    obj = (typeof(obj) == "string" ? S(obj) : obj);
    if (obj) obj.style.display= (bShow ? "" : "none");
}

function GetPath(type, bMustFull) {
    var p = "";
    switch ( type ) {
        case "image":
            try {p = window.images_path;}catch(e){}
            if(!p) p = editor_path + "images/";
            break;
        case "js":
            try {p = window.js_path;}catch(e){}
            if(!p) p = editor_path;
            break;
        case "css":
            try {p = window.css_path;}catch(e){}
            if(!p) p = editor_path + "style/";
            break;
        case "stationery":
            try {p = window.stationery_path;}catch(e){}
            if(!p) p = "http://m33.mail.qq.com/";
            break;
        case "card":
            try {p = window.card_path;}catch(e){}
            if(!p) p = "http://m33.mail.qq.com/";
            break;
        case "mo":
            try {p = window.mo_path;}catch(e){}
            if(!p) p = "http://m33.mail.qq.com/";
            break;
        case "editor":
            try {p = window.editor_path;}catch(e){}
            if(!p) p = editor_path;
            break;
        case "skin":
            try {p = window.skin_path;}catch(e){}
            if(!p) p = "0";
            break;
        case "blank":
            p = editor_path + "blank.html";
            break;
    }

    var _protocol = location.protocol;
    if ( bMustFull && type != "skin" && type != "blank" && p.indexOf( _protocol ) == -1 )
        p = [ _protocol, "//", location.host, p ].join( "" );
    return p;
}

function GetMainWin() {
    return F( "mainFrame", window ) || window;
}

function FixIeStatus(win) {
    if (typeof window.jQuery != "undefined") {
        jQuery.ready(function(){
			$(window).load();	
		});
    }

    var _body = win.document.body;

    var iframe_html = '<iframe frameborder="0" scrolling="no" width="0" height="0" id="fixiestatusframe" name="fixiestatusframe" class="menu_base_if" src="javascript:void((function(){document.open(\'text/html\',\'replace\');document.domain=\'' + document.domain + '\';document.close();})())"></iframe>';
    var iframe_html_without_id = '<iframe frameborder="0" scrolling="no" width="0" height="0" name="fixiestatusframe" class="menu_base_if" src="javascript:void((function(){document.open(\'text/html\',\'replace\');document.domain=\'' + document.domain + '\';document.close();})())"></iframe>';

    InsertHTML( _body, "afterBegin", iframe_html);
    _panel        = S( "fixiestatusframe", win );
    _panel.src = iframe_src;
    var _panelDoc =  F( "fixiestatusframe", win ).document;
    _panelDoc.open('text/html','replace');
    _panelDoc.writeln(iframe_html_without_id);
    _panelDoc.writeln("");

    //_panel.history.back();
    //_panelDoc.close();
	//_panel.src = "";
    //window.status = 'Done';
}

//iframe API
function CreatePanel( win, id, url, onloadEvent, style, className, bodyhtml ) {
    if ( !id || !win )
        return null;

    var _panel = S( id, win );
    if ( !_panel ) {
        var _body = win.document.body;
        InsertHTML( _body, "afterBegin", T ( [
        '<iframe frameborder="0" scrolling="no" id="$id$" name="$id$" class="menu_base_if $className$" ',
            'style="$style$" src="$url$" $event$ ></iframe>'] ).replace( {
            id        : id,
            className : className,
            url       : url || iframe_src,
            event     : onloadEvent ? [ 'onload="', onloadEvent, '"' ].join("") : '',
            style     : style || "display:none;left:0;top:0;"
        } ) );

        _panel        = S( id, win );

        _panel.src = iframe_src;


        if ( !url && className ) {
            var _panelDoc =  F( id, win ).document;
            _panelDoc.open('text/html','replace');
            _panelDoc.writeln( T(
                '<html><head><script>document.domain="'+document.domain+'";</script></head><body class="$className$">$content$</body></html>' ).replace( {
                className : id,
                content   : bodyhtml
            } ) );
            _panelDoc.close();
        }


    }

    return _panel;
}
//model dialog API
function ModelDialog( flag, title, content, focusId, arr_id, arr_fun, width, height, hideFunc ) {
    var mask    = CreateMask( window );
    var baseObj = S( "qqmail_dialog", window );
    if ( !baseObj ) {
        if ( flag == 0 )
            return;
        CreatePanel( window, "qqmail_dialog" );
        baseObj = S( "qqmail_dialog", window );
    }

    PushToDialogList( "qqmail_dialog" );

    if ( flag != 0 ) {
        var tb = window.document.body;
        width  = parseInt( width  || 400 );
        height = parseInt( height || 163 );

        baseObj.allowTransparency = "true";
        baseObj.style.width  = ( width  + 5 ) + "px";
        baseObj.style.height = ( height + 5 ) + "px";
        baseObj.style.left   = (( tb.clientWidth  - width  ) / 2 + tb.scrollLeft) + "px";

        var _top = ( tb.clientHeight - height ) / 2 + tb.scrollTop - 25;
        baseObj.style.top    = (_top < 2 ? 2 : _top) + "px";

        CreateWebDialog( baseObj, window, flag, title, content, focusId, arr_id, arr_fun, width, height );
    }

    //make dlg move smoothly
    SetDialogEvent( mask, !flag, true );
    Show( baseObj, flag );
    Show( mask, flag );

    setTimeout( function() {
        HideWindowsElement( !flag );
    }, 0 );

    setTimeout( function() {
        if( !flag )
            return ;
        try {
            var f = F( baseObj.id, window );
            f.focus();
            if( !!( f = S( focusId, f ) ) )
                f.focus();
        }
        catch( e ) {
        }
    }, 0 );

    if ( flag == 0 ) {
        window.gPageDialogMouseDown = false;
        try { window.HideModelDialogEvent(); } catch( e ) {}
    }

    SetHideModelDialogEvent(hideFunc);
}
function SetHideModelDialogEvent(func) {
    window.HideModelDialogEvent = func;
}
function HideModelDialog() {
    ModelDialog(0);
}
function IsShowModelDialog() {
    return IsShow( S( "qqmail_dialog", window ) );
}

//non model dialog
function OpenDialog( id, url, bModel, width, height ) {
    var mask = CreateMask( window );
    var baseObj = S( id, window );

    if ( !baseObj ) {
        CreatePanel( window, id, url );
        baseObj = S( id, window );
        PushToDialogList(id);
    }
    else {
        if ( IsNonModelDialogMinimize( id ) ) {
            MaximizeDialog( id );
            return baseObj;
        }

        baseObj.className += " bd";
        baseObj.contentWindow.location.replace( url + "&r="+ Math.random() );
    }

    var tb = window.document.body;
    baseObj.allowTransparency = "true";
    baseObj.style.width  = ( parseInt( width  || 403 ) + 5 ) + "px";
    baseObj.style.height = ( parseInt( height || 390 ) + 5 ) + "px";
    baseObj.style.left   = (tb.clientWidth - parseInt(baseObj.style.width)) / 2 + tb.scrollLeft;

    var _top = (tb.clientHeight - parseInt(baseObj.style.height)) / 2 + tb.scrollTop - 30;
    baseObj.style.top    = _top < 2 ? 2 : _top;

    if ( baseObj.style.top < 0 )
        baseObj.style.top = 0;

    window.gCurrentShowNonModelDialogId = id;

    SetDialogEvent( mask, false, bModel );
    Show( baseObj, 1 );
    Show( mask,    1 );

    setTimeout( function(){
        HideWindowsElement(false);
    }, 0);

    return baseObj;
}
function CloseDialog() {
    if ( window != window )
        return window.CloseDialog();

    if ( !window.gCurrentShowNonModelDialogId )
        return;

    var mask    = S( "qqmail_mask", window );
    var baseObj = S( window.gCurrentShowNonModelDialogId, window );
    if ( !baseObj )
        return;

    RemoveSelf( baseObj );
    Show( mask, 0 );
    SetDialogEvent( mask, true );

    window.gPageDialogMouseDown         = false;
    window.gCurrentShowNonModelDialogId = null;
    window.setTimeout( "HideWindowsElement( true )", 0);
}
function IsNonModelDialogMinimize(id) {
    var o = S( id + "_min", GetTopWin() );
    return o ? ( o.style.display == "" ? true : false ) : false;
}
function MaximizeDialog(id, bNoAnimation) {
    if ( !id )
        return;

    var baseObj = S(id, window);
    if ( !baseObj )
        return;

    var minObj   = S(id + "_min", GetTopWin());
    bNoAnimation = minObj ? bNoAnimation : true;

    if (!bNoAnimation) {
        var pos = fCalcPos(minObj);
        var params = {};
        params.descLeft = baseObj.style.left;
        params.descTop = baseObj.style.top;
        params.descWidth = baseObj.style.width;
        params.descHeight = baseObj.style.height;
        params.orgLeft = pos[1] - 60;
        params.orgTop = pos[0];
        params.orgWidth = 40;
        params.orgHeight = 18;
    }

    var mask = S("qqmail_mask", window);
    Show(mask, 1);
    SetDialogEvent(mask, false, false);

    window.gCurrentShowNonModelDialogId = id;

    if ( minObj )
        Show( minObj, false );

    if (!bNoAnimation) {
        Animation(baseObj, params, 100, function() {
            Show(baseObj, true);
        });
    }
    else {
        Show(baseObj, 1);
    }
    setTimeout(function(){
        HideWindowsElement(false);
    }, 0);
}
function MinimizeDialog() {
    var mc = S( "minimize_container", GetTopWin() );
    if ( !window.gCurrentShowNonModelDialogId || !mc )
        return;

    var baseObj = S( window.gCurrentShowNonModelDialogId, window );
    if ( !baseObj )
        return;

    var mask = S("qqmail_mask", window);
    Show(mask, 0);
    SetDialogEvent(mask, true);

    Show(baseObj, 0);
    window.gCurrentShowNonModelDialogId = null;

    var minId = baseObj.id + "_min";
    var min = S(minId, GetTopWin());
    if (!min) {
        InsertHTML(mc, "beforeEnd",
        ['<span id="', minId, '"><a onclick="top.MaximizeDialog(\'', baseObj.id, '\')">',
                S("dialog_title", F(baseObj.id, window)).innerHTML,
        '</a>&nbsp;&nbsp;|&nbsp;&nbsp;'].join(""));
        min = S(minId, GetTopWin());
    }
    Show(min, true);

    var pos = fCalcPos(min);
    var params = {
        orgLeft:        baseObj.style.left,
        orgTop:     baseObj.style.top,
        orgWidth:       baseObj.style.width,
        orgHeight:  baseObj.style.height,
        descLeft:       pos[1] - 60,
        descTop:        pos[0],
        descWidth:  40,
        descHeight: 18
    };

    var objPos = [baseObj.style.left, baseObj.style.top, baseObj.style.width, baseObj.style.height];
    var pos = fCalcPos(mc);

    setTimeout(function(){HideWindowsElement(true);}, 0);

    return Animation(baseObj, params, 100);
}
//dialog public
function IsModelDialogShow(id) {
    var baseObj = S("qqmail_dialog", window);
    if (baseObj && baseObj.style.display != "none")
        return id ? (S(id, F("qqmail_dialog", window)) ? true : false) : true;
    return false;
}
function IsDialogShow(id) {
    var baseObj = S( window.gCurrentShowNonModelDialogId ? window.gCurrentShowNonModelDialogId : "qqmail_dialog", window );
    if ( baseObj && baseObj.style.display != "none" )
        return id ? (S(id, F(baseObj.id, window)) ? true : false) : true;
    return false;
}
function GetDialogObj( _aId ) {
    var _win = GetDialogWin();
    return _win ? S( _aId, _win ) : null;
}
function GetDialogWin() {
    var baseObj = S( window.gCurrentShowNonModelDialogId || "qqmail_dialog", window );
    return baseObj ? F( baseObj.id, window ) : null;
}
//dialog private
function PushToDialogList(id) {
    if (!window.dialog_list)
        window.dialog_list = new window.Object;
    if (!id)
        return;
    window.dialog_list[id] = true;
}
function SetDialogEvent( mask, bRemove, bModel) {
    fAddEvent( window.document, "mousemove", window.fOnDialogMove,    bRemove );
    fAddEvent( window.document, "mouseup",   window.fOnDialogMouseUp, bRemove );
    if ( mask ) {
        fAddEvent( mask, "mousedown", window.HighLightDialog,       bRemove );
        fAddEvent( mask, "keydown",   window.DialogKeyEventProcess, bRemove );
    }
}
function DialogKeyEventProcess( e ) {
    if ( e && e.keyCode == 27 ) {
        CloseDialog();
        HideModelDialog();

        fPreventDefault( e );
    }
}
function HighLightDialog() {
    if ( window.gCurrentDialogInterval )
        clearInterval(window.gCurrentDialogInterval);
    if ( IsDialogShow() ) {
        var times = 1;
        window.gCurrentDialogInterval = setInterval(function(){
            var t = GetDialogObj("editor_dialog_titlebar");
            var t1 = GetDialogObj("no_move");

            SetClass( t, "editor_dialog_titlebar " + (times % 2 ? "toolbg" : "fdbody") );
            SetClass( t1, times % 2 ? "" : "fdbody" );

            if (times == 4 || !IsDialogShow())
                return clearInterval(window.gCurrentDialogInterval);
            times ++;
        }, 50);
    }
}
function CreateMask( win ) {
    win = win || window;
    var id = "qqmail_mask";
    var mask = S(id, win);
    if (!mask) {
        InsertHTML(win.document.body, "afterBegin",
            ['<div id="', id, '" class="editor_mask" style="display:none;" onkeypress="return false;" onkeydown="return false;" tabindex="0"></div>'].join(""));
        mask = S( id, win );
    }
    return mask;
}
function CreateWebDialog( obj, win, flag, title, content, focusIn, arr_id, arr_fun, width, height ) {
    if (!obj || !win)
        return false;

    var f = F(obj.id, win);

    if ( !S( "dialog_base", f ) ) {
        var f_doc = f.document;
        f_doc.open('text/html','replace');
        f_doc.writeln( T( [
            "<html>",
            "<head>",
            "<link rel='stylesheet' type='text/css' href='$csspath$comm.css' />",
            "<link rel='stylesheet' type='text/css' href='$csspath$skin$skin$.css' />",
            "</head>",

        "<body class='tipbg' onmousedown='return false;' >",
            "<div id='opashow' class='opashow' style='width:$width$;height:$height$;position:absolute;'></div>",
            "<table class='bd_upload' cellspacing='0' cellpadding='0' style='width:$width$px;height:$height$px;background:white;' >",
                "<tr><td id='editor_dialog_titlebar' class='fdbody' style='height:28px;border:none;background-image:none;cursor:move;overflow:hidden;' unselectable='on' onselectstart='return false;' >",
                    "<div class='fdbody' style='cursor:default;float:right;width:40px;border:none;background-image:none;' id='no_move'>",
                        "<div id='editor_close' class='editor_close' onmouseover='this.className=\"editor_close_mover\";' onmouseout='this.className=\"editor_close\";'>",
                            "<img src='$imgpath$ico_closetip.gif' width='12' height='12' ondragstart='return false;'>",
                        "</div>",
                    "</div>",
                    "<div class='editor_dialog_title' id='dialog_title' unselectable='on' ></div>",
                "</td></tr>",
                "<tr><td id='dialog_content' class='editor_dialog_content mailinfo' style='border:none;height:99%;' unselectable='on' onselectstart='return false;' valign='top'>",
                "</td></tr>",
            "</table>",
        "</body>",
            '<script>',
            'document.domain=\''+document.domain+'\';',
            '</script>',
            "</html>"
        ] ).replace( {
            csspath : GetPath("css", true),
            skin    : GetPath("skin"),
            imgpath : GetPath("image", true),
            width   : width,
            height  : height
        } ) );
        f_doc.close();

        fAddEvent( f_doc.body, "contextmenu", window.fPreventDefault );
        fAddEvent( f_doc.body, "dragstart",   window.fPreventDefault);
        fAddEvent( f_doc.body, "selectstart", window.fPreventDefault);

        fAddEvent( S( "editor_close", f ), "click", window.HideModelDialog );
        fAddEvent( S( "editor_dialog_titlebar", f ), "mousedown", window.fOnDialogMouseDown );
        fAddEvent( S( "editor_dialog_titlebar", f ), "mouseup",   window.fOnDialogMouseUp );
        fAddEvent( f_doc, "mousemove", window.fOnDialogMove );
        fAddEvent( f_doc, "keydown",   window.DialogKeyEventProcess );

        InitPageEvent( f );
    }

    S( "dialog_content", f ).innerHTML = flag ? content : "";
    S( "dialog_title",   f ).innerHTML = flag ? title   : "";

    if ( !arr_id || !arr_fun )
        return;

    for ( var i = arr_id.length - 1; i >= 0; i-- ) {
        var o = S( arr_id[ i ], f );
        if ( o && arr_fun[i] )
            fAddEvent( o, "click", arr_fun[ i ] );
    }
}
function fOnDialogMouseDown(e) {
    if ( ( e.target ? e.target : e.srcElement ).id == "no_move" )
    {
        return;
    }
    window.gPageCursorOldX = e.screenX;
    window.gPageCursorOldY = e.screenY;
    window.gPageDialogMouseDown = true;
    return false;
}
function fOnDialogMouseUp(e) {
    window.gPageDialogMouseDown = false;
}
function fOnDialogMove(e) {
    if( window.gPageDialogMouseDown ) {
        var o = S( window.gCurrentShowNonModelDialogId || "qqmail_dialog", window );
        if( o ) {
            o.style.left = parseInt( o.style.left ) + e.screenX - window.gPageCursorOldX;
            o.style.top  = parseInt( o.style.top  ) + e.screenY - window.gPageCursorOldY;
            window.gPageCursorOldX = e.screenX;
            window.gPageCursorOldY = e.screenY;
        }
    }
}

function DebugCreater( methodType ) {
    return function() {
        var _argLen = arguments.length;
        if ( _argLen > 2 && typeof( arguments[ _argLen - 1 ] ) == "number" && arguments[ _argLen - 1 ] != window.g_uin )
            return ;

        if ( window.Console ) {
            try {
                var _console = window.Console[ methodType ];
                _console.add.apply( _console, arguments );
            }
            catch(e) {
            }
        }
    }
}

function OnError( msg, url, line ) {
    try {
        return;
        var _cgi        = "/cgi-bin/getinvestigate?stat=js_run_err&msg=";
        var _func       = arguments.callee.caller;
        var _funcParent = _func && _func.caller;
        var _funcParPar = _funcParent && _funcParent.caller;
        var _funcStr    = ( _func || "null" ).toString();
        var _funcParStr = ( _funcParent || "null" ).toString();
        var _funcPPStr  = ( _funcParPar || "null" ).toString();

        //alert( [ "error:", msg, "<br><b>line</b>:", line, "<br><b>url</b>:", url, "<br><b>function</b>:", _funcStr.substr( 0, 100 ), _funcParStr ? "<br><b>parent function</b>:" + _funcParStr.substr( 0, 100 ) : "", _funcPPStr ? "<br><b>parent parent function</b>:" + _funcPPStr.substr( 0, 100 ) : "" ].join( "" ) , "error" );

        /*
        if ( !( url && url.indexOf( "/cgi-bin/mail_list?" ) != -1 && line == "2" ) )
            window.RunUrlWithSid( [ _cgi, msg, "&line=", line, "&url=", encodeURIComponent( url ),
                "&func=", encodeURIComponent( _funcStr.replace( /[\r\n\t ]/ig, "" ).substr( 0, 50 ) ) ].join( "" ) );

        window.Debug( [ "error:", msg, "<br><b>line</b>:", line, "<br><b>url</b>:", url, "<br><b>function</b>:", _funcStr.substr( 0, 100 ), _funcParStr ? "<br><b>parent function</b>:" + _funcParStr.substr( 0, 100 ) : "", _funcPPStr ? "<br><b>parent parent function</b>:" + _funcPPStr.substr( 0, 100 ) : "" ].join( "" ) , "error" );
*/
    }
    catch( e ) {
        alert('onerror:' + e.message );
        ( new Image() ).src = [ _cgi, msg, "&line=", line, "&url=", encodeURIComponent( url ), "&func=", e.message ].join( "" );
    }

    return true;
}

function _ExtendLocation( _aWin ) {
    if ( _aWin.location.getParams )
        return ;
    _aWin.location.params       = {};
    _aWin.location.getParams    = function(){
        var _params = {};
        var _queryString = ( arguments.length > 0 ? arguments[0].substr( arguments[0].indexOf( "?" )*1+1 ) : this.search.substr( 1 ) );
        if ( _queryString != null && _queryString != "" ) {
            var _queries = _queryString.split("&");
            for ( var i = 0 ; i < _queries.length ; i++ ) {
                var _query = _queries[i].split("=");
                _params[ _query[0] ] = unescape( _query.slice(1).join("=") );
            }
            if ( arguments.length > 0 ) {
                return _params;
            }
            else {
                this.params = _params;
            }
        }
        return _params;
    };
}

//onload ini
function _InitPageEventProcess( win ) {
    win.Debug   = win.debug = DebugCreater( "debug" );
    win.Log     = win.log   = DebugCreater( "log"   );
    win.Watch   = win.watch = DebugCreater( "watch" );
    win.onerror = OnError;

    win.Trace   = win.trace = function( name, desc, mode, project, uin ) {
        if ( window.timeTracer && ( !uin || uin == window.g_uin ) )
            window.timeTracer.getTracer().trace( name, desc, win, mode, project );
    };

    //--start for history back--
    if ( win != window && win == GetMainWin() ) {
        History.recordCurrentUrl( win );
        History.recordActionFrameChange( "clear" );

        fAddEvent( win, "unload", function() {
            //msg...
            if ( IsShowMsg() && window.msgDispTime && ( new Date() ) - window.msgDispTime > 2000 ) {
                HiddenMsg();
            }
            else {
                ShowProcess( 0 );
            }
        } );
    }
    //--end for history back--

    // window && frame_html.html
    if ( win == window && window.location.href.indexOf("/frame_html") != -1 ) {
        fAddEvent(win, "load", function(e) {
            var b = window.document.body;
            fAddEvent( b, "mousewheel", function(e) {
                if ( ( e.target || e.srcElement ) == b )
                    fPreventDefault(e);
            } );

            if ( gIsIE ) {
                //fix ie iframe bug ...
                E( GelTags( "a" , window.document.body ), function( obj ) {
                    fAddEvent( obj, "mousedown", function( e ) {
                        obj.setAttribute( "md", "true" );
                        setTimeout( function(){ obj.setAttribute( "md", "false" ) }, 1000 );
                    } );
                    var tempFunc = obj.onclick;
                    obj.onclick = function() {};
                    fAddEvent( obj, "click", function( e ) {
                        if ( obj.getAttribute( "md" ) != "true" ) {
                            fPreventDefault( e );
                        }
                        else if ( tempFunc ) {
                            tempFunc.call( obj, e );
                        }
                    } );
                });
            }
        });
    }
}
function _InitPageEventProcessDelay( win ) {
    try {
        fAddEvent( win.document, "mousedown", HideMenuEvent );
        fAddEvent( win.document, "click",     HideEditorMenu );
        fAddEvent( win.document, "keydown",   fIniAllKeyDow );
    }
    catch( e ) {
        // the page has redirected ...
        return ;
    }

    if ( GetMainWin() == win && win != window )
        E( [ "/mail_list?", "t=readmail", "t=note_first_page",
            "/addr_listall?", "/cgi-bin/read_multilist", "/cgi-bin/reader_"], function( key ) {
            var _loc = win.location.href;
            if ( key && _loc.indexOf( key ) != -1 && _loc.indexOf( "t=compose" ) == -1 )
                win.focus();
        } );
}
var InitPageEvent = ( function( win ) {
    try {
        win = win || window;

        if ( !win.gIsInitPageEventProcess ) {
            win.gIsInitPageEventProcess = true;

            try {
                _InitPageEventProcess( win );
                _ExtendLocation( win );
            }
            catch( e ) {
                OnError( e.message, ( win || window ).location.href, "InitPageEventProcess" );
            }

            setTimeout( function() {
                _InitPageEventProcessDelay( win );
            }, 100 );
        }
    }
    catch( e ) {
        debug( "InitPageEvent err:" + e.message );
    }

    return arguments.callee;
} )();

function HideWindowsElement( bShow, win ) {

    win = win || GetMainWin();
    if ( !gIsIE || ( win.gHasHideElements || false ) != ( bShow || false ) )
        return;

    win.gHasHideElements = !bShow;

    var swaps = [ "select", "object", "embed" ];
    for (var i = swaps.length - 1; i >= 0; i--) {
        var objs = GelTags( swaps[i], win.document.body );
        for ( var j = objs.length - 1; j >= 0; j-- ) {
            var _obj = objs[ j ];
            try {
                if ( bShow ) {
                    _obj.style.visibility  = _obj.getAttribute( "savevisibility" );
                }
                else {
                    _obj.setAttribute( "savevisibility", _obj.style.visibility );
                    _obj.style.visibility = "hidden";
                }
            }
            catch( e ) {
            }
        }
    }
}
//Event Mng Fun
function fAddEvent(oTarget, sType, fHandler, bRemove) {
    if (!oTarget)
        return;

    if (oTarget.addEventListener) {
        bRemove ? oTarget.removeEventListener(sType, fHandler, false) : oTarget.addEventListener(sType, fHandler, false);
    }
    else if (oTarget.attachEvent) {
        bRemove ? oTarget.detachEvent("on" + sType, fHandler) : oTarget.attachEvent("on" + sType, fHandler);
    }
    else {
        oTarget["on" +sType] = bRemove ? null : fHandler;
    }
}
function fRemoveEvent(oTarget, sType, fHandler) {
    fAddEvent( oTarget, sType, fHandler, true );
}
function fPreventDefault( oEvent ) {
    if ( oEvent ) {
        if ( oEvent.preventDefault ) {
            oEvent.preventDefault();
        }
        else {
            oEvent.returnValue = false;
        }
    }
}
function fStopPropagation( oEvent ) {
    if ( oEvent ) {
        if ( oEvent.stopPropagation ) {
            oEvent.stopPropagation();
        }
        else {
            oEvent.cancelBubble = true;
        }
    }
}

function fLoadJsFile(file, checked, doc) {
    doc = doc || document;
    if ( checked ) {
        var s = GelTags( "script", doc );
        for ( var i = s.length - 1; i >= 0; i-- )
            if ( s[ i ].src.indexOf( file ) != -1 )
                return;
    }
    var o      = doc.createElement( "script" );

    o.language = "javascript";
    o.charset  = "utf-8";
    o.src = file;
    var h = GelTags("head", doc)[0];

    if ( h )
        h.appendChild(o);

    return o;
}


function LoadJsFileToTop( path, filelist ) {
    for ( var i = 0, _len = filelist.length; i < _len; i++ )
        fLoadJsFile( path + filelist[ i ], true, window.document );
}
function OutputJsReferece( path, filelist ) {
    var _t = T( '<script language="JavaScript" src="$file$"></script>' );
    for ( var i = 0, _c = [], _len = filelist.length; i < _len; i++ )
        _c.push( _t.replace( {
            file : path + filelist[ i ]
        } ) );
    return _c.join( "" );
}
//object rewrite --> for ie active problom
function fParamsInTag( o ) {
    var c = "";
    var p = GelTags("PARAM", o);
    for (var i = p.length - 1; i >= 0; i--)
        c += p[i].outerHTML;
    return c;
}
function fTagRewrite( tag, container ) {
    var o = GelTags( tag, container );
    for ( var i = o.length - 1; i >= 0; i-- )
        o[ i ].outerHTML = o[ i ].outerHTML.split(">")[ 0 ] + ">" + fParamsInTag( o[ i ] ) /*+ o[i].innerHTML*/ + "</" + o[ i ].tagName + ">";
}
function fObjectActive( container ) {
    if ( gIsIE ) {
        fTagRewrite( "embed", container );
        fTagRewrite( "object", container );
    }
}
//str api
function Trim(sStr) {
    return sStr.replace(/(^\s*)|(\s*$)/ig,"");
}
function StrReplace(s, o, d, mode) {
    return s.replace(new RegExp( RegFilter(o), mode ), d);
}

function GetAsiiStrLen( _aStr ) {
    return ( _aStr || "" ).replace( /[^\x00-\xFF]/g, "aa" ).length;
}
function SubAsiiStr( _aStr, _aLen, _aPlus ) {
    _aStr  = Trim( new String( _aStr  || "" ) );
    _aPlus = _aPlus || "";

    var _cutLen = _aLen - _aPlus.length;
    _cutLen     = _cutLen <= 0 ? 1 : _cutLen;

    for ( var i = 0, _strLen = _aStr.length, _countLen = 0, _cutPos = -1; i < _strLen; i++ ) {
        var _charCode = _aStr.charCodeAt( i );
        //asii -> 1 ( # W -> 1.3 )
        //not asii -> 1.5
        _countLen += _charCode == 35 || _charCode == 87 ? 1.2 : ( _charCode > 255 ? 1.5 : 1 );
        if ( _cutPos == -1 && _countLen > _cutLen )
            _cutPos = i;
        if ( _countLen > _aLen )
            return _aStr.substr( 0, _cutPos ) + _aPlus;
    }

    return _aStr;
}

//API
function fCalcPos(obj) {
    var pos = [0, obj ? obj.offsetWidth : 0, obj ? obj.offsetHeight : 0, 0];
    for (; obj;obj = obj.offsetParent) {
        pos[3] += obj.offsetLeft;
        pos[0] += obj.offsetTop - ( obj.offsetParent ? obj.scrollTop : 0 );
    }
    pos[1] += pos[3];
    pos[2] += pos[0];
    return pos;
}



// qmEditor - a mini rich editor
// author : angusdu
// date   : 2008-7-15

/*
@param
_aParamSet = {
    editorId        : string, //the id for editor
    tbExternId      : string, //the id for extern tool bar container
    editorAreaWin   : window object, // the edit area in which window
    editorAreaId    : string, // the id for edit area container
    height          : number, // the height for editor (just bugfix for mini editor)
    language        : language object, // the language packet
    style           : string, // editor style but now just support border:none;
    funclist        : tools func list object
    //event
    onload          : func,
    onfocus         : func,
    onblur          : func,
    onclick         : func,
    onmousedown     : func,
    onkeydown       : func,
    onputcontent    : func,
    onbeforesaverange   : func,
    onselectionchange   : func,
    onchangecontenttype : func,
    onchangebgmusic     : func,
    onshowinstallactive : func
}
*/
var qmEditor = function( _aParamSet ) {
    if ( !_aParamSet )
        _aParamSet = {};

    this._mEditorId      = _aParamSet.editorId      || [ "qmEditor", ( new Date() ).valueOf() ].join( "" );
    this._mTbExternId    = _aParamSet.tbExternId    || "qmEditorToolBarPlusArea";

    this._mEditorAreaWin = _aParamSet.editorAreaWin || window;
    this._mEditorAreaId  = _aParamSet.editorAreaId  || "qmEditorArea";

    // this arrtibute for non ie browser (ff/safari/chrome/opera...)
    // becase of the iframe 100% in table has program when the table mini 160px ...
    this._mFixedHeight      = _aParamSet.height;
    this._mAllowCustomTag   = _aParamSet.customtags;

    // attribute
    this._mResPath       = _aParamSet.resPath  || GetPath( "editor" );
    this._mLang          = _aParamSet.lang || 'zh';
    this._mLanguage      = (_aParamSet.lang && _aParamSet.lang == 'en') ? qmEditor.CONST.LANGUAGE.en_US : qmEditor.CONST.LANGUAGE.zh_CN;
    this._mTemplate      = /*_aParamSet.template ||*/ qmEditor.CONST._TEMPLATE;

    this._mStyle         = [ ";", _aParamSet.style ].join( "" ).toLowerCase();
    this._mFuncList      = _aParamSet.funclist || qmEditor.CONST.FUNCLIST.BASE;

    this._mEditMode      = "html"; // html/source/text
    this._mIsInitialized = false;

    this._mLoaddingFile  = {};
    this._mInfile        = {};
    for ( var i in qmEditor.CONST._FILES ) {
        var _funcNames = qmEditor.CONST._FILES[ i ].split( " " );
        for ( var j = _funcNames.length - 1; j >= 0; j-- )
            this._mInfile[ _funcNames[ j ] ] = i;
    }

    //event
    this._onload                = _aParamSet.onload;
    this._onfocus               = _aParamSet.onfocus;
    this._onblur                = _aParamSet.onblur;
    this._onclick               = _aParamSet.onclick;
    this._onmousedown           = _aParamSet.onmousedown;
    this._onkeydown             = _aParamSet.onkeydown;
    this._onputcontent          = _aParamSet.onputcontent;
    this._onbeforesaverange     = _aParamSet.onbeforesaverange;
    this._onuserselectchange    = _aParamSet.onselectionchange;
    this._onchangecontenttype   = _aParamSet.onchangecontenttype;
    this._onchangebgmusic       = _aParamSet.onchangebgmusic;
    this._onshowinstallactive   = _aParamSet.onshowinstallactive || showActiveInstall;

    //upload image setting
    this._image_prefix     = (_aParamSet.prefix)?_aParamSet.prefix : '';
    this._show_relative_path    = _aParamSet.show_relative_path;
    this._relative_base_path    = _aParamSet.relative_base_path;
    
    //value
    this._mPhotoActionSrc   =  editorUploadUrl + "?domain=" + document.domain + '&prefix=' + this._image_prefix
    if(this._show_relative_path) {
        this._mPhotoActionSrc = this._mPhotoActionSrc + '&show_relative_path=' + this._show_relative_path + '&relative_base_path=' + this._relative_base_path;
    }
    this._mDocActionSrc     =  docUploadUrl;
    this._mPhotoConfig      = _aParamSet.photoConfig;
};

//public method
qmEditor.prototype.getEditorId = function() {
    return this._mEditorId;
};

qmEditor.prototype.getEditorArea = function() {
    return S( this._mEditorAreaId, this._mEditorAreaWin );
};

qmEditor.prototype.getContentType = function() {
    return this._mEditMode == "text" ? "text" : "html";
};

qmEditor.prototype.adjustBodyStyle = function( _aStyle, _aValue ) {
    this._mEditBody.style[ _aStyle ] = _aValue;
};

qmEditor.prototype.getBodyStyle = function( _aStyle ) {
    return this._mEditBody.style[ _aStyle ];
};

qmEditor.prototype.initialize = function( _aContent, _aIsShowToolBar, _aTabIndex ) {
    if ( !( this._editorAreaObj = S( this._mEditorAreaId, this._mEditorAreaWin ) ) || this._mIsInitialized )
        return false;

    // this program method for ob
    [ this._initializeForIframe, this._initializeForDiv ][
        true || this._hasDesignMode( this._mEditorAreaWin.document ) ? 0 : 1 ].call( this, _aContent || qmEditor.getBreakLine(), _aTabIndex );

    this._fixHtmlContent();
    this._setFixFocusEvent();
    this._setFixIEBreakLineEvent();
    this._setFixIEBackSpaceEvent();
    this._setUnloadEvent();
    this._setClickEvent();
    this._setKeyDownEvent();
    this._setFocusEvent();
    this._setPasteEvent();

    var tmp_editor = this;
    setTimeout(function () {
        tmp_editor._setEditorSelectionChangeEvent();
    }, 1000);

    this._mIsInitialized = true;
    qmEditor.setEditor( this );

    this._initializeToolbar();

    if ( _aIsShowToolBar )
        this.showToolBar( true );

    //for ie cross domain issue, by minglin
    if (gIsIE) {
        CreatePanel( window, "qqmail_dialog" );

        setTimeout(function () {
             FixIeStatus(window);
        }, 500);
    }

    var _self = this;
    if ( typeof ( this._onload ) == "function" )
        setTimeout( function() {
            _self._onload.call( _self );
        } );
    return true;
};

qmEditor.prototype.isInitialized = function() {
    return this._mIsInitialized;
};

qmEditor.prototype.isSelectionInObject = function( _aObject ) {
    if ( !_aObject )
        return ;

    if ( this._mEditWin.getSelection ) {
        //ff/safari/chrome
        var _selection = this._mEditWin.getSelection();
        if ( _selection && _selection.rangeCount > 0 ) {
            var _range     = _selection.getRangeAt( 0 );
            var _nodeRange = this._mEditDoc.createRange();

            _nodeRange.selectNode( _aObject.firstChild || _aObject );
            var _isBefore = _range.compareBoundaryPoints( Range.START_TO_START, _nodeRange ) ==  1;

            _nodeRange.selectNode( _aObject.lastChild || _aObject );
            var _isAfter  = _range.compareBoundaryPoints( Range.END_TO_END, _nodeRange )     == -1;

            if ( !( _isBefore && _isAfter ) )
                return false;
        }
        else {
            return false;
        }
    }
    else {
        //ie
        var _range     = this._mEditDoc.body.createTextRange();
        _range.moveToElementText( _aObject );

        var _selection = this._mEditDoc.selection;
        var _selRange  = _selection.createRange();
        if ( _selection.type == "Control" )
            for ( i = 0, _len = _selRange.length; i < _len; i++ )
                if ( _selRange( i ).parentNode ) {
                    var _node = _selRange( i ).parentNode;
                    _selRange = this._mEditDoc.body.createTextRange();
                    _selRange.moveToElementText( _node );
                    break ;
                }

        if ( !_range.inRange( _selRange ) )
            return false;
    }

    return true;
};

qmEditor.prototype.focus = function( _aPos, _aFocusObj ) {
    var _focusObj = null;
    switch( this._mEditMode ) {
        case "text":
            this._mEditorAreaWin.focus();
            this._mTextBody.focus();
            _focusObj = this._mTextBody;
            break;
        case "source":
            this._mEditorAreaWin.focus();
            this._mSrceBody.focus();
            _focusObj = this._mSrceBody;
            break;
        case "html":
        default:
            ( this._hasDesignMode( this._mEditDoc ) ? this._mEditWin : this._mEditBody ).focus();
            _focusObj = _aFocusObj || this._mEditBody;
            break;
    }

    this._setCursorPos( _focusObj, _aPos );
};

qmEditor.prototype.showCursor = function() {
    try {
        // just for ie ...
        this._mEditDoc.selection.createRange().select();
    }
    catch( e ) {
    }
};

qmEditor.prototype.changeContentType = function( _aContentType, _aNoWarn ) {
    var _isHtml = !_aContentType ? ( this.getContentType() == "text" ? true : false ) :
        ( _aContentType == "text" ? false : true );
    _aContentType = _isHtml ? "html" : "text";

    if ( _aContentType == this.getContentType() )
        return true;
    if ( !_isHtml && !confirm( this._mLanguage.CHG_CONTENTTYPE ) )
        return false;

    this._mEditObj.style.display  = _isHtml ? "block" : "none";
    this._mTextBody.style.display = _isHtml ? "none"  : "block";
    this._mSrceBody.style.display = "none";

    if ( !_isHtml )
        this._syncHtmlContentTo( "text" );

    if ( _isHtml )
        this._syncTextContentTo( "html" );


    this.showToolBar( _isHtml ? this.isShowToolBar() : false, true )
    Show( S( this._mTbExternId, this._mEditorAreaWin ), _isHtml );

    this._mEditMode = _aContentType;
    this.focus( 0 );

    if ( typeof ( this._onchangecontenttype ) == "function" )
        this._onchangecontenttype.call( this );

    return true;
};

qmEditor.prototype.showToolBar = function( _aIsShow, _aIsNotRecord ) {
    _aIsShow = _aIsShow == null ? !this.isShowToolBar() : _aIsShow;

    if ( !_aIsNotRecord )
        this._mToolBarObj.setAttribute( "disp", _aIsShow ? "true" : "false" );

    this._mToolBarObj.parentNode.style.display = _aIsShow ? "" : "none";
};

qmEditor.prototype.isShowToolBar = function() {
    return this._mToolBarObj.getAttribute( "disp" ) == "true";
};

qmEditor.prototype.getContentObj = function( _aId ) {
    return S( _aId, this._mEditWin );
};

qmEditor.prototype.getContentTags = function( _aTagName ) {
    return GelTags( _aTagName, this._mEditDoc );
};

qmEditor.prototype.getContent = function( _aIsTextContent ) {
    return this._getEditContent( this._mEditMode, _aIsTextContent );
};

qmEditor.prototype.setContent = function( _aContent ) {
    this._setEditContent( this._mEditMode, _aContent );
};

qmEditor.prototype.getBgMusicInfo = function() {
    return this._mBgMusicInfo;
};

qmEditor.prototype.setBgMusicInfo = function( _aSong, _aSinger, _aUrl ) {
    var _oldInfo   = this._mBgMusicInfo || {};
    var _oldSong   = _oldInfo.song;
    var _oldSinger = _oldInfo.singer;
    var _oldUrl    = _oldInfo.url;
    var _isChange  = !_oldSong && !_aSong ?
        _aUrl != _oldUrl : ( _oldSong != _aSong || _oldSinger != _aSinger );

    this._mBgMusicInfo = !_aSong && !_aUrl ? null : {
        song   : _aSong,
        singer : _aSinger,
        url    : _aUrl
    };

    if ( !_isChange )
        return ;

    if ( typeof( this._onprivatechangebgmusic ) == "function" )
        this._onprivatechangebgmusic( this );

    if ( typeof( this._onchangebgmusic ) == "function" )
        this._onchangebgmusic.call( this );
};

qmEditor.prototype.hideMenu = function( _aIsAllowLoadRange ) {
    if ( this._getCurMenuFuncObj() )
        this._getCurMenuFuncObj()._hideMenu( _aIsAllowLoadRange );
};

qmEditor.prototype.addEvent = function( _aEventName, _aFuncPointer ) {
    if ( typeof( _aFuncPointer ) != "function" )
        return false;

    var _listName = [ "on", _aEventName, "List" ].join( "" );
    if ( !this[ _listName ] )
        this[ _listName ] = [];

    this[ _listName ].push( _aFuncPointer );

    return true;
};

qmEditor.prototype.saveRange = function() {
    this.focus();

    if ( typeof( this._onbeforesaverange ) == "function" )
        this._onbeforesaverange.call( this );

    this._mEditorRange = this._getRange();
};

qmEditor.prototype.loadRange = function( _aType ) {
    if ( _aType == "last" ) {
        this._loadLastRange();
    }
    else if ( this._setRange( this._mEditorRange ) ) {
        this.clearRange();
    }
};

qmEditor.prototype.clearRange = function() {
    this._mEditorRange = null;
};

qmEditor.prototype.paste = function() {
    this._execCmd( "paste" );
};

qmEditor.prototype.updateToolBarUI = function( _aToolName ) {
    var _fUpdateUIForTool = function( _aToolInfo ) {
        for ( var i = _aToolInfo.length - 1; i >= 0; i-- ) {
            var _info = _aToolInfo[ i ];
            if ( _info.funcObj && _info.funcName == _aToolName )
                _info.funcObj._updateUI();
        }
    };

    _fUpdateUIForTool( this._mToolBarInfo );
    _fUpdateUIForTool( this._mTbExternInfo );
}

//private method
qmEditor.prototype._initializeForDiv = function( _aContent ) {
    this._editorAreaObj.innerHTML = this._mTemplate.FRAME_BASE.replace( {
        editcontainer: this._mTemplate.FRAME_DIV.replace( {
            content: _aContent
        } )
    } );
    //init var ...
    this._mEditCore = "div";
    this._mEditObj  = GelTags( "td", this._editorAreaObj )[ 1 ].firstChild;
    this._mEditWin  = this._mEditorAreaWin;
    this._mEditDoc  = this._mEditWin.document;
    this._mEditBody = this._mEditObj;
    this._mSrceBody = this._mEditObj.nextSibling;
    this._mTextBody = this._mSrceBody.nextSibling;
    //set editable
    this._setContentEditable();
};

qmEditor.prototype._initializeForIframe = function( _aContent, _aTabIndex ) {
    var _styleHeight = this._mFixedHeight ? "height:" + this._mFixedHeight : "";

    // gen the html
    this._editorAreaObj.innerHTML = this._mTemplate.FRAME_BASE.replace( {
        border       : this._mStyle.indexOf( ";border:none" ) != -1 ? "border:none;" : "",
        style        : _styleHeight,
        editcontainer: this._mTemplate.FRAME_IFRM.replace( {
            tabindex : typeof( _aTabIndex ) == "number" ? [ 'tabindex="', _aTabIndex, '"' ].join( "" ) : "",
            style    : _styleHeight
        } )
    } );
    // init var ...
    this._mEditCore = "iframe";
    this._mEditObj  = GelTags( "td", this._editorAreaObj )[ 1 ].firstChild;

    if (gIsIE) {
        window['qeEditor'] = this;
        window['qeEditor_content'] = _aContent;
        this._mEditObj.src = "javascript:void((function(){document.open('text/html','replace');document.domain=\'"+document.domain+"\';document.close(); window.parent['qeEditor']._setupForIframe(window.parent['qeEditor_content']);})())";
    } else {
        this._setupForIframe(_aContent);
    }
};

qmEditor.prototype._setupForIframe = function(_aContent){
    this._mEditWin  = this._mEditObj.contentWindow;
    this._mEditDoc  = this._mEditWin.document;

    this._mEditDoc.open('text/html','replace');
    this._mEditDoc.writeln ( this._mTemplate.FRAME_BODY.replace( {
        editable    : this._hasDesignMode( this._mEditDoc ) ? "" : "contentEditable=true",
        content     : _aContent
    } ) );
    this._mEditDoc.close();

    this._mEditBody = this._mEditDoc.body;
    this._mSrceBody = this._mEditObj.nextSibling;
    this._mTextBody = this._mSrceBody.nextSibling;

    //set editable
    this._setContentEditable();
    this._setAllowCustomTag();

};

qmEditor.prototype._initializeToolbar = function() {
    this._mToolBarObj  = GelTags( "td", this._editorAreaObj )[ 0 ];
    this._mTbExternObj = S( this._mTbExternId, this._mEditorAreaWin );

    this._mRichToolBarObj = this._mToolBarObj.firstChild.firstChild;
    this._mSrceToolBarObj = this._mRichToolBarObj.nextSibling;

    if ( ( this._mToolBarInfo = this._pasteFuncList( this._mFuncList.toolbar ) ).length > 0 ) {
        for ( var i = this._mToolBarInfo.length - 1; i >= 0; i-- ) {
            InsertHTML( this._mRichToolBarObj, "afterBegin", this._mTemplate.TOOLBAR_ITEM );
            this._mToolBarInfo[ i ].funcArea = this._mRichToolBarObj.firstChild;
        }
    }

    if ( ( this._mTbExternInfo = ( this._mTbExternObj && this._pasteFuncList( this._mFuncList.tbExtern ) ) || [] ).length > 0 ) {
        for ( var i = this._mTbExternInfo.length - 1; i >= 0; i-- ) {
            InsertHTML( this._mTbExternObj, "afterBegin", this._mTemplate.TBEXTERN_ITEM );
            this._mTbExternInfo[ i ].funcArea = this._mTbExternObj.firstChild;
        }
    }

    var _self = this;
    setTimeout( function() {
        _self._setupFunction();
    }, 100 );
};

qmEditor.prototype._setContentEditable = function() {
    if ( this._hasDesignMode( this._mEditDoc ) ) {
        // for non-ie browser
        // if ie browser --> html set contentEditable can do it !!!
        this._mEditDoc.designMode = "on";
        this._execCmd( "useCSS", false );
        // ### here must force focus at editor area win !!! ###
        this._mEditorAreaWin.focus();
        // ### end ###
    }
    this._mEditBody.setAttribute( "canEditable", "true" );
};

qmEditor.prototype._setAllowCustomTag = function() {
    var _allowCustomTag = this._mAllowCustomTag;
    if ( !_allowCustomTag )
        return false;
    for ( var i = 0, _len = _allowCustomTag.length; i < _len; i++ )
        this._mEditDoc.createElement( _allowCustomTag[ i ] );
};

qmEditor.prototype._pasteFuncList = function( _aFuncList ) {
    var _arrInfo = [];
    var _arrFunc = ( _aFuncList || "" ).replace( /\|/ig, "Separate" ).split( " " );
    for ( var i = 0, _len = _arrFunc.length; i < _len; i++ ) {
        if ( _arrFunc[ i ] )
            _arrInfo.push( {
                funcName : _arrFunc[ i ],
                funcArea : null,
                funcObj  : null
            } );
    }
    return _arrInfo;
};

qmEditor.prototype._setupFunction = function() {
    var _self       = this;
    var _filesCache = {};
    var _fSetup     = function( _aSetupInfo, _aUiType ) {
        for ( var i = _aSetupInfo.length - 1; i >= 0; i-- ) {
            var _info = _aSetupInfo[ i ];
            if ( _info.funcObj != null )
                continue;
            if ( qmEditor.FUNCLIB[ _info.funcName ] ) {
                _info.funcObj = new qmEditor.FUNCLIB[ _info.funcName ]( {
                    editor : _self
                } );
                _info.funcObj._setup( {
                    container   : _info.funcArea,
                    uiType      : _aUiType
                } );
            }
            else {
                _filesCache[ _self._mInfile[ _info.funcName ] ] = true;
            }
        }
    };
    _fSetup( this._mToolBarInfo , "icon"  );
    _fSetup( this._mTbExternInfo, this._mStyle.indexOf( ";icon:big" ) != -1 ? "big" : "text" );
    this._loadFile( _filesCache );
};

qmEditor.prototype._loadFile = function( _aFilesCache ) {

    if ( !this._mLoaddingFile )
        this._mLoaddingFile = {};
    for ( var i in _aFilesCache ) {
        var _isNeedLoaded = this._mLoaddingFile[ i ] ?
            ( ( new Date() ) - this._mLoaddingFile[ i ] > 2000 ) : true;
        if ( _isNeedLoaded ) {
            fLoadJsFile( GetPath( "editor" ) + i );
            this._mLoaddingFile[ i ] = new Date();
        }
    }

};

qmEditor.prototype._getCurMenuFuncObj = function() {
    return this._mCurMenuFuncObj;
};

qmEditor.prototype._setCurMenuFuncObj = function( _aMenuObj ) {
    var _preObj           = this._mCurMenuFuncObj;
    this._mCurMenuFuncObj = _aMenuObj;
    return _preObj;
};

qmEditor.prototype._hasDesignMode = function( _aDoc ) {
    //ie is false ... other is true
    var _designMode = _aDoc && _aDoc.designMode && _aDoc.designMode.toString().toLowerCase() || "";
    return ( _designMode == "off" || _designMode == "on" )
        /*because it has bug in mac safari, safari must use ie mode!! */&& !gIsSafari;
};

qmEditor.prototype._getEditContent = function( _aEditMode, _aIsTextContent ) {
    switch ( _aEditMode ) {
    case "html":
        return _aIsTextContent ? ( this._mEditBody.innerText || this._mEditBody.textContent || "" ) : this._beforeGetEditContent(this._mEditBody.innerHTML);
    case "text":
        return this._mTextBody.value;
    case "source":
        return this._mSrceBody.value;
    }
    return "";
};

//fixed ie自动补全相对路径的问题. frankychen
qmEditor.prototype._fixRelativePath = function (_content) {
    var hostName = Tcc.host;
    var sRegExpPic = '(http|https)://' + hostName + this._relative_base_path + 'pictures/';
    var sRegExpCap = '(http|https)://' + hostName + this._relative_base_path + 'captures/';
    _content = _content.replace(new RegExp(sRegExpPic,"ig"), this._relative_base_path + "pictures/");
    _content = _content.replace(new RegExp(sRegExpCap,"ig"), this._relative_base_path + "captures/");
    return _content;
}

qmEditor.prototype._beforeGetEditContent = function( _content ) {
    if (_content.length < 20) {
        _content = _content.toLowerCase() == "<div>&nbsp;</div>\n" ? '' : _content; //for chrome
        _content = _content.toLowerCase() == '<div>&nbsp;</div>' ? '' : _content;
        _content = _content.toLowerCase() == '<br>' ? '' : _content;
        _content = _content.toLowerCase() == "\n" ? '' : _content;
    }

    if (gIsIE) {
        if(this._show_relative_path) {
            _content = this._fixRelativePath(_content);
        }
        
        return _content.replace(new RegExp(this.preg_quote(document.location) + '#', 'g'), '#');
    } else {
        return _content;
    }
}

qmEditor.prototype.preg_quote = function(str) {
	return (str+'').replace(/([\.\\\\/+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:\-])/g,"\\$1");
}

qmEditor.prototype._setEditContent = function( _aEditMode, _aContent ) {
    switch ( _aEditMode ) {
    case "html":
        this._mEditBody.innerHTML   = _aContent || qmEditor.getBreakLine();
        this._fixHtmlContent();
        // clear last range ...
        this._clearLastRange();
        break;
    case "text":
        this._mTextBody.value     = _aContent;
        break;
    case "source":
        this._mSrceBody.value     = _aContent;
        break;
    }
};

qmEditor.prototype._syncHtmlContentTo = function( _aToEditor ) {
    switch( _aToEditor ) {
    case "text":
        if ( !gIsIE && !gIsSafari )
            this._setEditContent( "html", HtmlToText( this._getEditContent( "html" ) ) );
        this._setEditContent( "text", this._getEditContent( "html", true ) );
        break;
    case "source":
        this._setEditContent( "source", this._getEditContent( "html" ) );
        break;
    }
};

qmEditor.prototype._syncTextContentTo = function( _aToEditor ) {
    if ( _aToEditor == "html" || _aToEditor == "source" )
        this._setEditContent( "html", ( gIsIE || gIsOpera ? TextToHtml : TextToHtmlForNoIE )( this._getEditContent( "text" ) ) );
    if ( _aToEditor == "source" )
        this._syncHtmlContentTo( "source" );
};

qmEditor.prototype._setCursorPos = function( _aFocusObj, _aPos ) {
    if ( typeof( _aPos ) != "number" )
        return ;

    if ( !window.getSelection ) {
        var _r = ( _aFocusObj.createTextRange ? _aFocusObj : this._mEditBody ).createTextRange();
        _r.moveToElementText( _aFocusObj );
        _r.moveStart( "character", _aPos );
        _r.collapse( true );
        _r.select();
    }
    else {
        if ( _aFocusObj.tagName != "TEXTAREA" ) {
            var _self = this;
            var _fFocus = function() {
                _self._mEditWin.focus();
                var _selection = _self._mEditWin.getSelection();
                if ( !_selection )
                    return false;
                if( _selection.rangeCount > 0 )
                    _selection.removeAllRanges();
                var _r = _self._mEditDoc.createRange();
                _r.selectNode( _aFocusObj && _aFocusObj.firstChild || _aFocusObj || _self._mEditBody.firstChild || _self._mEditBody );
                _r.collapse( true );
                _selection.addRange( _r );
                return true;
            }
            if ( !_fFocus() )
                setTimeout( _fFocus );
        }
        else {
            _aFocusObj.selectionStart = _aPos;
            _aFocusObj.selectionEnd   = _aPos;
        }
    }
};

qmEditor.prototype._isSelectionInEditArea = function( _aMode ) {
    if ( this._mEditCore != "div" && _aMode != "equal" )
        return true;

    var _r = this._mEditDoc.body.createTextRange();
    _r.moveToElementText( _aMode == "equal" ? this._mEditBody : this._editorAreaObj );
    try {
        return _r[ _aMode == "equal" ? "isEqual" : "inRange" ]( this._mEditDoc.selection.createRange() );
    }
    catch( e ) {
        return false;
    }
};

qmEditor.prototype._fixHtmlContent = function() {
    if ( typeof( this._onputcontent ) == "function" )
        try {
            this._onputcontent.call( this );
        }
        catch( e ) {
        }

    if ( !gIsIE ) {
		E( GelTags( "pre", this._mEditBody ), function( _aNode ) {
			_aNode.innerHTML = _aNode.innerHTML.replace(/<br>/gi, "\n");
		} );
	} else {
		E( GelTags( "div", this._mEditBody ), function( _aNode ) {
			if ( _aNode.childNodes.length == 1 && _aNode.innerHTML == "&nbsp;" )
				_aNode.innerHTML = "";
		} );
	}
};

qmEditor.prototype._setUnloadEvent = function() {
    var _self = this;
    //this event fail in opera
    fAddEvent( this._mEditorAreaWin, "unload", function( _aEvent ) {
        qmEditor.delEditor( _self._mEditorId );
    } );
};

qmEditor.prototype._setClickEvent  = function() {
    var _self      = this;
    var _fHideMenu = function( _aEvent ) {
        _self.hideMenu();
    };

    // no need process -> give this event page do
    // fAddEvent( this._mEditorAreaWin.document, "click", _fHideMenu );

    fAddEvent( this._mEditDoc, "mousedown", function() {
        _self._clearLastRange();
    } );

    if ( this._mEditCore == "iframe" )
        // use "click" event has problom for control selection ( eg: img )
        fAddEvent( this._mEditDoc, "mousedown", _fHideMenu );

    if ( typeof( this._onmousedown ) == "function" )
        fAddEvent( this._mEditDoc, "mousedown", this._onmousedown );

    if ( typeof( this._onclick ) == "function" )
        fAddEvent( this._mEditDoc, "click", this._onclick );
};

qmEditor.prototype._setKeyDownEvent = function() {
    if ( typeof( this._onkeydown ) == "function" )
        fAddEvent( this._mEditDoc, "keydown", this._onkeydown );
};

qmEditor.prototype._setFocusEvent = function() {
    var _self = this;
    if ( typeof( this._onfocus ) == "function" ) {
        fAddEvent( this._mEditWin, "focus", function( _aEvent ) {
            // last range ...
            _self._loadLastRange();
            // on focus call back ...
            _self._onfocus.call( _self, _aEvent );
        } );
    }

    if ( typeof( this._onblur ) == "function" ) {
        fAddEvent( this._mEditWin, "blur",  function( _aEvent ) {
            _self._onblur.call( _self, _aEvent );
        } );
    }
};

qmEditor.prototype._setPasteEvent = function() {
    if(gIsChrome && !DetectActiveX(0)){
        var editor = this;
        fAddEvent( this._mEditWin, "paste",  function( _aEvent ) {
            var items = _aEvent.clipboardData.items;
            var blob = items[0].getAsFile();
            var reader = new FileReader();
            reader.onload = function(_aEvent){
                var data_url = _aEvent.target.result;
                // console.log(data_url);
                editor._execCmd('InsertImage', data_url);
            }
            reader.readAsDataURL(blob);
        });
    }
}

qmEditor.prototype._setFixFocusEvent = function() {
    var _self = this;

    if ( !gIsIE ) {
        fAddEvent( this._mEditWin,  "focus", function( _aEvent ) {
            try {
                var _sel = _self._mEditWin.getSelection();
                if ( _sel.focusNode && _sel.focusNode.tagName == "HTML" )
                    _sel.collapse( _self._mEditBody.firstChild || _self._mEditBody, 0 );
            }
            catch( e ) {
                window.OnError( [ "editor focus error: ", e.message ].join( "" ) ) ;
            }
        } );
    }
    else {
        fAddEvent( this._mEditWin, "blur",  function( _aEvent ) {
            try {
                _self._mEditBody.ownerDocument.selection.empty();
            }
            catch ( e ) {
                //window.OnError( [ "editor blur error: ", e.message ].join( "" ) ) ;
            }
        } );
    }
};

qmEditor.prototype._setFixIEBreakLineEvent = function() {
    if ( !gIsIE )
        return ;
    var _self = this;
    var _fOnEditorKeyDonw = function( _aEvent ) {
        var _k = _aEvent.keyCode;
        if ( !_aEvent.altKey  && !_aEvent.ctrlKey && (
              _k >= 48  && _k <= 57  ||
              _k >= 65  && _k <= 90  ||
              _k >= 96  && _k <= 111 ||
              _k >= 186 && _k <= 192 ||
              _k >= 219 && _k <= 222 ||
              _k == 8   || _k == 32  ||
              _k == 13  || _k == 46  ||
              _k == 229 //chinese
        ) ) {
            _fDeleteAllForFixIE( _k == 8 ? _aEvent : null );
        }
    };
    var _fDeleteAllForFixIE = function( _aEvent, _aDelayTime, _aIsAllowDefault ) {
        if ( !_self._isSelectionInEditArea( "equal" ) )
            return ;

        var _fClear = function() {
            _self._mEditBody.innerHTML = "<div>&nbsp;</div>";
            _self._fixHtmlContent();
            _self.focus( 0 );

            if ( !_aIsAllowDefault && _aEvent )
                fPreventDefault( _aEvent );
        };

        if ( typeof( _aDelayTime ) == "number" )
            return setTimeout( _fClear, _aDelayTime );

        _fClear();
    };

    fAddEvent( this._mEditBody, "keydown", _fOnEditorKeyDonw );
    fAddEvent( this._mEditBody, "cut", function() {
        _fDeleteAllForFixIE( null, 0, true );
    } );
};

qmEditor.prototype._setFixIEBackSpaceEvent = function() {
    if ( !gIsIE )
        return ;

    var _self = this;

    fAddEvent( this._mEditBody, "keydown", function( _aEvent ) {
        if ( !_self._isSelectionInEditArea() )
            return ;

        if ( _aEvent.keyCode == 8 && _self._mEditDoc.selection.type == "Control" ) {
            _self._mEditDoc.selection.clear();
            fPreventDefault( _aEvent );
        }
    } );
};

qmEditor.prototype._setEditorSelectionChangeEvent = function() {
    // must sure one editor set once
    if ( this.isSetSelectionChangeEvent )
        throw { message : "*** can not set once again!!" }

    this.isSetSelectionChangeEvent = true;
    var _self                      = this;

    // ### here need optimize ###

    // IE has the onselectionchange event, don't use it ...
    // just enough
    fAddEvent( this._mEditDoc, "mouseup", function( _aEvent ) {
        // the performance of nodelay and delay is the same ... ???
        _self._doOnSelectionChange( _aEvent, true );
    } );
    fAddEvent( this._mEditDoc, "keyup", function( _aEvent ) {
        //var _keyCode = _aEvent.keyCode;
        //if ( _keyCode >= 33 && _keyCode <= 40 || _keyCode == 46 || _keyCode == 8 )
        // in safari has bug ... so disable ..
            _self._doOnSelectionChange( _aEvent, true );
    } );
    // ### end ###

    fAddEvent( this._mEditDoc, "keydown", function( _aEvent ) {
        var _keyCode = _aEvent.keyCode;
        if ( _aEvent.ctrlKey && _keyCode >= 65 && _keyCode <= 90 )
            _self._doOnEvent( "keydown", _aEvent );
    } );
    fAddEvent( this._mEditDoc, "contextmenu", function( _aEvent ) {
        _self._doOnEvent( "contextmenu", _aEvent );
    } );
    fAddEvent( this._mEditBody, "paste", function( _aEvent ) {
        _self._doOnEvent( "paste", _aEvent );
    } );
};

qmEditor.prototype._getRange = function() {
    if ( this._mEditMode != "html" )
        return null;

    if ( window.getSelection ) {
        var _selection = this._mEditWin.getSelection();
        return _selection ? _selection.getRangeAt( 0 ) : null;
    }
    else {
        return this._mEditDoc.selection.createRange();
    }
};

qmEditor.prototype._setRange = function( _aRange ) {
    if ( !_aRange )
        return false;

    this.focus();

    if ( window.getSelection ) {
        var _selection = this._mEditWin.getSelection();
        _selection.removeAllRanges();
        _selection.addRange( _aRange );
    }
    else {
        _aRange.select();
    }

    return true;
};

qmEditor.prototype._saveLastRange = function() {
    this._mEditorLastRange =this._getRange();
};

qmEditor.prototype._loadLastRange = function() {
    this._setRange( this._mEditorLastRange );
};

qmEditor.prototype._clearLastRange = function() {
    this._mEditorLastRange = null;
};

qmEditor.prototype._doOnEvent = function( _aEventName, _aEvent ) {
    var _list = this[ [ "on", _aEventName, "List" ].join( "" ) ];
    if ( !_list || _list.length == 0 )
        return ;

    if ( !this._isSelectionInEditArea() )
        return ;

    for ( var i = 0, _len = _list.length; i < _len; i++ )
        if ( _list[ i ]( _aEvent ) === true )
            break;
};

qmEditor.prototype._doOnSelectionChange = function( _aEvent, _aIsNoDelay ) {
    var _list = this.onselectionchangeList || [];
//  if ( !_list || _list.length == 0 )
//      return ;

    if ( this.onselectionchangeTimer )
        clearTimeout( this.onselectionchangeTimer );

    if ( !this._isSelectionInEditArea() )
        return ;

    var _self = this;
    var _fRun = function() {
        // last range ...
        _self._saveLastRange();
        // do change event ...
        for ( var i = 0, _len = _list.length; i < _len; i++ )
            if ( _list[ i ]( _aEvent ) === true )
                break;

        if ( typeof( _self._onuserselectchange ) == "function" )
            _self._onuserselectchange.call( _self );
    };

    if ( _aIsNoDelay ) {
        _fRun();
    }
    else {
        this.onselectionchangeTimer = setTimeout( function() {
            _self.onselectionchangeTimer = null;
            _fRun();
        }, 100 );
    }
};

qmEditor.prototype._doCmd = function( _aType, _aCmd, _aParam ) {
    if ( this._mEditMode != "html" )
        return false;

    if ( _aType == "execCommand" && _aCmd != "useCSS")
        this.focus();

    try {
        return this._mEditDoc[ _aType ]( _aCmd, false, _aParam || false );
    }
    catch( e ) {
        return false;
    }
};

qmEditor.prototype._execCmd = function( _aCmd, _aParam, _aAfterExecCmdFunc ) {
    var _isOk = this._doCmd( "execCommand", _aCmd, _aParam );
    if ( _isOk ) {
        if ( typeof( _aAfterExecCmdFunc ) == "function" )
            _aAfterExecCmdFunc.call( this );
        this._doOnSelectionChange( {}, true );
    }
    return _isOk;
};

qmEditor.prototype._queryCmdState = function( _aCmd ) {
    return this._doCmd( "queryCommandState", _aCmd );
};

qmEditor.prototype._queryCmdEnabled = function( _aCmd ) {
    return this._doCmd( "queryCommandEnabled", _aCmd );
};

qmEditor.prototype._queryCmdValue = function( _aCmd ) {
    return this._doCmd( "queryCommandValue", _aCmd );
};
// end for class qmEditor


//global api
qmEditor.createEditor = function( _aParamSet ) {
    return new this( _aParamSet );
};

qmEditor.getEditorSet = function() {
    return window.gQmEditorSet || {};
};

qmEditor.getEditor = function( _aId ) {
    var _editor = window.gQmEditorSet && window.gQmEditorSet[ _aId ];

    try {
        if ( _editor._mEditBody.getAttribute( "canEditable" ) == "true" )
            return _editor;
    }
    catch( e ) {
        this.delEditor( _aId );
    }

    return null;
};

qmEditor.setEditor = function( _aQmEditorObj ) {
    if ( !this.getEditor )
        return false;

    var _id = _aQmEditorObj.getEditorId();
    this.delEditor( _id );

    if ( !window.gQmEditorSet )
        window.gQmEditorSet = {};

    window.gQmEditorSet[ _id ] = _aQmEditorObj;
    return true;
};

qmEditor.delEditor = function( _aId ) {
    if ( window.gQmEditorSet && window.gQmEditorSet[ _aId ] )
        delete window.gQmEditorSet[ _aId ];
};

qmEditor.hideEditorMenu = function() {
    var _set = this.getEditorSet();
    for ( var _id in _set )
        try {
            _set[ _id ].hideMenu();
        }
        catch( e ) {
            this.delEditor( _id );
        }
}

qmEditor.getBreakLine = function( _aNum ) {
     return ( new Array( ( _aNum || 1 ) + 1  ) ).join( gIsIE || gIsOpera || gIsSafari ? "<div>&nbsp;</div>" : "<br>" );
};

//const var ...
qmEditor.CONST = {};

qmEditor.CONST._extend = function( _aDesc, _aSource ) {
    for ( var i in _aSource )
        _aDesc[ i ] = _aSource[ i ];
};

//_language pack
qmEditor.CONST.LANGUAGE = {};

qmEditor.CONST.LANGUAGE.zh_CN = {
    CHG_CONTENTTYPE : "杞崲鍐呭涓虹函鏂囨湰鏍煎紡鏈夊彲鑳戒涪澶辨煇浜涙牸寮忥紝纭畾浣跨敤绾枃鏈悧?"
};

qmEditor.CONST.LANGUAGE.en_US = {
    CHG_CONTENTTYPE : "Coverting this message to plain text will lost some formatting,Are you sure you want to continue?"
};


//func in file
qmEditor.CONST._FILES = {
    //in file has these func ...
    "editor_toolbar.js?r=1"      : "Separate Bold Italic Underline FontName FontName FontSize ForeColor BackColor AlignMode Serial Indent CreateLink SourceEdit",
    "editor_toolbar_plus.js?r=1" : "Photo Table Mo ScreenSnap Music Doc Max Flash Code"
};

//editor func pattern
qmEditor.CONST.FUNCLIST = {};

qmEditor.CONST.FUNCLIST.BASE = {
    toolbar  : "Bold Italic Underline | FontName FontSize ForeColor BackColor | AlignMode Serial Indent | CreateLink Table Mo Photo ScreenSnap Doc Max SourceEdit"
};

qmEditor.CONST.FUNCLIST.KM = {
    toolbar  : "Bold Italic Underline | FontName FontSize ForeColor BackColor | AlignMode Serial Indent | CreateLink Mo Photo ScreenSnap Doc Flash Code Max SourceEdit"
};


qmEditor.CONST.FUNCLIST.COMPOSE = {
    toolbar  : "Bold Italic Underline | FontName FontSize ForeColor BackColor | AlignMode Serial Indent | CreateLink SourceEdit",
    tbExtern : "Photo Mo ScreenSnap Music"
};

qmEditor.CONST.FUNCLIST.GROUP = {
    toolbar  : "Bold Italic Underline | FontName FontSize ForeColor BackColor | AlignMode Serial Indent | CreateLink SourceEdit",
    tbExtern : "Photo Mo ScreenSnap"
};

qmEditor.CONST.FUNCLIST.NOTE = {
    toolbar  : "Bold Italic Underline | FontName FontSize ForeColor BackColor | AlignMode Serial Indent | CreateLink SourceEdit",
    tbExtern : "Photo Mo ScreenSnap"
};

qmEditor.CONST.FUNCLIST.MO = {
    toolbar  : "Bold Italic Underline | FontName FontSize ForeColor BackColor | AlignMode Serial Indent | CreateLink Mo SourceEdit"
};

//_template
qmEditor.CONST._TEMPLATE = {
    FRAME_BASE     : T( [
    '<table cellspacing=0 cellpadding=0 class="qmEditorBase" style="$border$" >',
        '<tr style="display:none;"><td height="1%" class="qmEditorToolBar" valign="top" unselectable="on" onmousedown="return false;" >',
            '<div class="qmEditorToolBarDiv">',
                '<div></div><div style="display:none;"></div><div class="qmEditorBtnIcon" style="width:1px;" ></div>',
            '</div>',
        '</td></tr>',
        '<tr><td height="99%" valign="top" unselectable="on" class="qmEditorContent">',
            '$editcontainer$',
            '<textarea class="qmEditorText" style="display:none;font-size:12px;$style$"></textarea>',
            '<textarea class="qmEditorText" style="display:none;font-size:12px;$style$"></textarea>',
        '</td></tr>',
    '</table><div class="qmEditorBaseBd"></div>'
    ] ),
    FRAME_DIV      : T( [
    '<div class="qmEditorDivEditArea">$content$</div>'
    ] ),
    FRAME_IFRM     : T( [
    '<iframe class="qmEditorIfrmEditArea" style="$style$" frameborder="no" src="'+iframe_src+'" hideFocus $tabindex$ ></iframe>',
    ] ),
    FRAME_BODY     : T( [
    '<html>',
        '<head>',
        '<script>',
            'window.onerror = function() { return true; };',
            'document.domain = "'+document.domain+'";',
        '</script>',
        '<style>',
            'body {margin:0;overflow:auto;font:normal 14px Verdana;background:#fff;padding:2px 4px 0;}',
            'body, p, font, div, li { line-height: 150%;}',
            '.i {width:100%;*width:auto;table-layout:fixed;}',
            'pre {white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;}',
            //fix FF
            'a { color: -moz-hyperlinktext !important;text-decoration: -moz-anchor-decoration;}',
        '</style></head>',
        '<body $editable$ >$content$</body>',
    '</html>'
    ] ),
    TOOLBAR_ITEM    : T( [
    '<div class="qmEditorToolBarItem" unselectable="on" onmousedown="return false;"></div>'
    ] ),
    TBEXTERN_ITEM   : T( [
    '<span class="qmEditorTBExternItem"></span>'
    ] ),
    BOTTON_ICON      : T( [
    '<div class="qmEditorBtnIcon" style="background:url($path$images/editoricon.gif?r=2) $bgleft$px 0;width:$width$px;margin:$margin$;$style$;" ',
        ' unselectable="on" onmousedown="return false;" title="$title$" ></div>',
    ] ),
    BOTTON_TEXT     : T( [
    '<span style="font-size:12px;cursor:pointer;margin:$margin$;" title="$title$" unselectable="on" onmousedown="return false;" >',
        '<span style="background:url($path$images/editoricon.gif?r=2) $bgleft$px 1px no-repeat;font:13px;padding:5px $width$px 0 0;* padding:3px $width$px 0 0;',
            '" unselectable="on">&nbsp;</span>',
        '<a class="udline" style="margin:$lbMargin$;" unselectable="on">$label$</a>',
    '</span>'
    ] ),
    BOTTON_BIG      : T( [
    '<a unselectable="on"><img src="$src$" align="absmiddle">$label$</img></a>',
    ] ),
    MENU_BORDER     : T( [
    '<div class="qmEditorMenuBorder" style="display:none;$style$" unselectable="on" onmousedown="return false;" >$innerHTML$</div>'
    ] ),
    MENU_ITEM       : T( [
    '<div class="qmEditorMenuItem" param="$param$" style="$style$;" title="$title$" unselectable="on" $event$ >',
        '$content$',
    '</div>'
    ] ),
    MENU_ITEM_EVENT : T( [
    'onmouseover="',
        'if ( this.className != \'qmEditorMenuItemDisabled\' && this.className != \'qmEditorMenuItemOver\' )',
            'this.className = \'qmEditorMenuItemOver\';',
    '" onmouseout="',
        'var _className = this.getAttribute( \'curclass\' ) || \'qmEditorMenuItem\';',
        'if ( this.className != _className )',
            'this.className = _className',
    '" '
    ] )
};

//func libiry
qmEditor.FUNCLIB = {};

//inherit method
qmEditor.FUNCLIB._inheritFrom = function( _aConstructor, _aBase ) {
    _aConstructor.prototype = new _aBase();
    return _aConstructor;
}

qmEditor.FUNCLIB._BASE = function( _aParamSet ) {
    this._mId         = "_BASE";
    this._mType       = "label";
    this._mChecked    = false;
    this._mUiConfig   = {};
    this._mParamSet   = {};
};

//funclib class interface
qmEditor.FUNCLIB._BASE.prototype._setup = function( _aParamSet ) {
    if ( this._isSetuped() )
        return false;

    this._mContainer  = _aParamSet.container;
    this._mUiType     = _aParamSet.uiType
    if ( !this._mBindEditor || !this._mContainer )
        return false;

    this._mContainer.innerHTML = this._getUI();

    if ( !this._mCmd )
        this._mCmd = this._mId;

    if ( typeof ( this._mType ) != "string" )
        this._mType = "label";

    if ( this._mType != "label" ) {
        if ( typeof ( this._onclick ) != "function" ) {
            var _self = this;
            var _onclick = {
                btn      : _self._doDefaultClick,
                checkbox : _self._doDefaultClick,
                menu     : _self._doShowMenuClick
            }[ this._mType ];
            this._onclick = function( _aEvent ) {
                if ( _self._mBindEditor._changeEditMode )
                    _self._mBindEditor._changeEditMode( "html" );
                _onclick.call( this, _aEvent );
            };
        }

        if ( this._mType == "menu" && typeof( this._onmenuclick ) != "function" )
            this._onmenuclick = this._doDefaultMenuClick;

        if ( this._mType == "btn" )
            this._onselectionchange = this._doDefaultSelectionChange;

        this._setEditorEvent( "keydown" );
        this._setEditorEvent( "selectionchange" );
        this._setEditorEvent( "contextmenu" );
        this._setEditorEvent( "paste" );

        this._setMouseOverEvent();
        this._setClickEvent();
    }

    this._mIsSetupOK = true;

    return true;
};

qmEditor.FUNCLIB._BASE.prototype._isSetuped = function() {
    return this._mIsSetupOK;
};

qmEditor.FUNCLIB._BASE.prototype._getUI = function() {
    if ( typeof( this._mUiType ) != "string" )
        this._mUiType = "icon"

    var _dataSet  = this._mUiConfig[ this._mUiType ];
    if ( !_dataSet )
        return "";

    var _template = this._mBindEditor._mTemplate[
        [ "BOTTON_", this._mUiType.toUpperCase(), ( this._mType == "custom" ? "_" + this._mId.toUpperCase() : "" ) ].join( "" ) ];

    if ( !_template )
        return "";

    _dataSet.path  = this._mBindEditor._mResPath;

    // ### need improve ###
    // Dirty hark code for Firefox/Opera/Safari
    //if ( !gIsIE && this._mUiType == "icon" )
    _dataSet.width = _dataSet.width - 2;

    return _template.replace( _dataSet );
};

qmEditor.FUNCLIB._BASE.prototype._updateUI = function() {
    if ( this._updateUIInfo ) {
        this._updateUIInfo();
        this._mContainer.innerHTML = this._getUI();
    }
}

qmEditor.FUNCLIB._BASE.prototype._getStatus = function() {
    return this._mChecked;
};

qmEditor.FUNCLIB._BASE.prototype._changeStatus = function( _aCheck ) {
    this._mChecked = _aCheck;
    if ( this._mUiType == "icon" ) {
        var _obj       = this._mContainer.firstChild;
        var _className = _aCheck ? "qmEditorBtnIconCheck" : _obj.getAttribute( "oldClassName" ) || "qmEditorBtnIcon";
        if ( _obj.className != _className )
            _obj.className = _className;
    }
};

qmEditor.FUNCLIB._BASE.prototype._setEditorEvent = function( _aEventName ) {
    // var _eventFunc = this[ [ "on", _aEventName ].join( "" ) ];
    // use this method program
    // for obfuscator
    var _eventFunc = {
        "keydown"         : this._onkeydown,
        "selectionchange" : this._onselectionchange,
        "contextmenu"     : this._oncontextmenu,
        "paste"           : this._onpaste
    }[ _aEventName ];

    var _self      = this;
    if ( typeof( _eventFunc ) == "function" )
        this._mBindEditor.addEvent( _aEventName, function( _aEvent ) {
            _eventFunc.call( _self, _aEvent );
        } );
};

qmEditor.FUNCLIB._BASE.prototype._setMouseOverEvent = function() {
    if ( this._mUiType == "icon" ) {
        var _self = this;
        this._mContainer.onmouseover  = function() {
            var _obj = this.firstChild;
            if ( !_self._mChecked && _obj.className != "qmEditorBtnIconOver" )
                _obj.className = "qmEditorBtnIconOver";
            _obj.setAttribute( "oldClassName", "qmEditorBtnIconOver" );
        };
        this._mContainer.onmouseout  = function() {
            var _obj = this.firstChild;
            if ( !_self._mChecked && _obj.className != "qmEditorBtnIcon" )
                _obj.className = "qmEditorBtnIcon";
            _obj.setAttribute( "oldClassName", "qmEditorBtnIcon" );
        };
    }
};

qmEditor.FUNCLIB._BASE.prototype._setClickEvent = function() {
    if ( typeof( this._onclick ) != "function" )
        return false;

    var _self = this;
    this._mContainer.onclick = function( _aEvent ) {
        _aEvent = _aEvent || _self._mBindEditor._mEditorAreaWin.event;
        _self._onclick.call( _self, _aEvent );
        fPreventDefault( _aEvent );
        fStopPropagation( _aEvent );
    };
    return true;
};

qmEditor.FUNCLIB._BASE.prototype._createMenu = function() {
    if ( this._mBindMenu )
        return false;

    var _body   = this._mBindEditor._mEditorAreaWin.document.body;
    InsertHTML( _body, "afterBegin", this._mBindEditor._mTemplate.MENU_BORDER.replace( {
        innerHTML : this._getMenuUI()
    } ) );

    this._mBindMenu = _body.firstChild;
    this._initMenuElements();
    this._setMenuClickEvent();

    return true;
};

qmEditor.FUNCLIB._BASE.prototype._getMenuUI = function() {
    var _editor = this._mBindEditor;
    var _defTmp = _editor._mTemplate[ this._mTmplName || ( "MENU_" + this._mId.toUpperCase() ) ] || _editor._mTemplate.MENU_ITEM;

    var _html   = [];
    for ( var i = 0, _len = ( this._mMenuData || [] ).length ; i < _len; i++ ) {
        var _data     = this._mMenuData[ i ];
        var _template = _data._mTemplate || _defTmp;
        _data.event   = _data.event      || _editor._mTemplate.MENU_ITEM_EVENT;
        _data.path    = _data.path       || GetPath( "editor" );

        _html.push( _template.replace( _data ) );

        if ( _data.param || _data.cmd )
            this._mParamSet[ ( _data.param || _data.cmd ).toUpperCase() ] = _data;
    }

    return _html.join( "" );
};

qmEditor.FUNCLIB._BASE.prototype._initMenuElements = function() {
};

qmEditor.FUNCLIB._BASE.prototype._setMenuClickEvent = function() {
    if ( typeof( this._onmenuclick ) != "function" )
        return false;

    var _self = this;
    // must use onclick = function !!!!
    // because the propagation must in the topest level!!!!
    this._mBindMenu.onclick = function( _aEvent ) {
        _aEvent = _aEvent || _self._mBindEditor._mEditorAreaWin.event;
        if ( !_self._onmenuclick.call( _self, _aEvent ) )
            fPreventDefault( _aEvent );
        fStopPropagation( _aEvent );
    };
    return true;
};

qmEditor.FUNCLIB._BASE.prototype._adjustMenuPos = function() {
    var _pos  = fCalcPos( this._mContainer );
    var _top  = _pos[ 2 ];
    var _left = _pos[ 3 ];

    // ### so bad ###
    // Dirty hark code for any ui type
    if ( this._mUiType == "text" )
        _top += 1;

    var _menuObj    = this._mBindMenu;
    var _bodyObj    = this._mBindMenu.ownerDocument.body;

    var _menuWidth  = this._mBindMenu.offsetWidth;
    var _menuHeight = this._mBindMenu.offsetHeight;

    var _bodyWidth  = _bodyObj.clientWidth + _bodyObj.scrollLeft;
    var _bodyHeight = _bodyObj.clientHeight + _bodyObj.scrollTop;

    //todo: minglin
    //if ( _top + _menuHeight > _bodyHeight )
    //    _top = _bodyHeight - _menuHeight;

    if ( _left + _menuWidth > _bodyWidth )
        _left = _bodyWidth - _menuWidth;

    _menuObj.style.top  = ( _top < 0 ? 0 : _top ) + "px";
    _menuObj.style.left = ( _left < 0 ? 0 : _left ) + "px";
};

qmEditor.FUNCLIB._BASE.prototype._showMenu = function( _aIsAllowLoadRange ) {
    if ( !this._mBindMenu )
        return false;

    var _curMenuFuncObj = this._mBindEditor._getCurMenuFuncObj();
    if ( _curMenuFuncObj == this )
        return true;

    if ( _curMenuFuncObj )
        _curMenuFuncObj._hideMenu( _aIsAllowLoadRange );

    this._mBindEditor._setCurMenuFuncObj( this );

    // here here here will focus editor ...
    // has some problom at special need ...~~~
    if ( this._mIsSaveRange )
        this._mBindEditor.saveRange();

    this._changeStatus( true );

    Show( this._mBindMenu, true );
    this._adjustMenuPos();

    if ( typeof( this._onshowmenu ) == "function" )
        this._onshowmenu();

    return true;
};

qmEditor.FUNCLIB._BASE.prototype._hideMenu = function( _aIsAllowLoadRange ) {
    if ( !this._mBindMenu )
        return false;

    if ( this._mBindEditor._getCurMenuFuncObj() == this )
        this._mBindEditor._setCurMenuFuncObj( null );

    if ( IsShow( this._mBindMenu ) )
        Show( this._mBindMenu, false );

    if ( this._mIsSaveRange && _aIsAllowLoadRange )
        this._mBindEditor.loadRange();

    this._changeStatus( false );
    this._afterHideMenu();

    return true;
};

qmEditor.FUNCLIB._BASE.prototype._afterHideMenu = function() {
};

qmEditor.FUNCLIB._BASE.prototype._doDefaultClick = function( _aEvent ) {
    this._mBindEditor._execCmd( this._mCmd );
    this._mBindEditor.hideMenu();
};

qmEditor.FUNCLIB._BASE.prototype._doDefaultSelectionChange = function( _aEvent ) {
    var _editor = this._mBindEditor;
    if ( _editor._queryCmdEnabled( this._mCmd ) )
        this._changeStatus( _editor._queryCmdState( this._mCmd ) );
};

qmEditor.FUNCLIB._BASE.prototype._doShowMenuClick = function( _aEvent ) {
    if ( !this._mBindMenu )
        this._createMenu();

    if ( this._getStatus() ) {
        this._hideMenu( true );
    }
    else {
        this._showMenu( true );
    }
};

qmEditor.FUNCLIB._BASE.prototype._doDefaultMenuClick = function( _aEvent ) {
    var _target = _aEvent.target || _aEvent.srcElement;
    var _cmd    = _target && _target.getAttribute( "cmd" );
    var _param  = _target && _target.getAttribute( "param" );
    if ( _param || _cmd ) {
        this._mBindEditor._execCmd( _cmd || this._mCmd, _param );
        this._hideMenu();
    }
};

function showActiveInstall() {
    window.open(editor_path+"getactivex.html");
}
