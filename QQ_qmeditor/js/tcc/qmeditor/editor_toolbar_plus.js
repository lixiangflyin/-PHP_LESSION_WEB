// qmEditor function file : expert func
// author : angusdu
// date   : 2008-7-20

qmEditor.CONST._extend( qmEditor.CONST.LANGUAGE.zh_CN,  {
    FUN_PHOTO                : "上传图片",
    FUN_PHOTO_LABEL          : "图片",
    FUN_MO                   : "插入表情",
    FUN_MO_LABEL             : "表情",
    FUN_SCREENSNAP           : "捕获屏幕",
    FUN_SCREENSNAP_SETUP_TIP : "请点击安装截屏控件\r安装后您就可以很方便地截屏，并发送\n给您的好友一起交流分享。",
    FUN_SCREENSNAP_LABEL     : "截屏",
    FUN_MUSIC                : "插入背景音乐",
    FUN_MUSIC_LABEL          : "音乐",
    FUN_MUSIC_LABEL_ADDED    : "已添加",

    COMM_CONFIRM             : "确定",
    COMM_CANCEL              : "取消",
    COMM_HELP                : "帮助",

    PO_LOCAL_PHOTO           : "上传图片",
    PO_LOCAL_DESC            : "( 请点击“浏览”，在您电脑中选择您要上传的图片。)",
    PO_LOCAL_INPUT           : "选择图片：",
    PO_LOCAL_OK              : "立即上传",
    PO_NET_PHOTO             : "网络图片",
    PO_NET_DESC              : "( 请在下面输入框里面填上待插入图片的链接路径。注：无访问权限的网络图片有可能导致无法显示。)",
    PO_NET_INPUT             : "图片路径：",
    PO_NET_OK                : "立即插入",

    PO_DLG_TITLE             : "上传图片",
    PO_DLG_UPLOADING         : "图片上传中...",
    PO_DLG_UPLOADFAIL        : "图片上传失败了！",
    PO_DLG_UPLOADFAIL_INFO   : "图片上传失败：您上传的图片大小($curSize$)超过了最大限制($allowSize$)。",

    MO_LOADING               : "表情加载中...",

    MC_LOADING               : "音乐加载中...",
    MC_REPLACE_TIP           : "您已经添加了背景音乐，是否需要替换为新的？",

    DOC_TITLE                : "导入Word文档(Doc)",
    DOC_DESC                 : "( 请点击“浏览”，在您电脑中选择您要上传的文档。)",
    DOC_INPUT                : "选择文档：",
    DOC_OK                   : "立即导入",

    DOC_DLG_TITLE            : "上传文档",
    DOC_DLG_UPLOADING        : "文档上传中...",
    DOC_DLG_UPLOADFAIL       : "文档上传失败了！",

    MAX_TITLE                : "全屏",


    SCREENSNAP_FAIL          : "截屏不成功！",
    SCREENSNAP_SAVEFAIL      : "保存截屏图片不成功！",
    UPLOADER_VERSION_LOW     : "上传控件版本过低，请升级！"
} );

qmEditor.CONST._extend( qmEditor.CONST.LANGUAGE.en_US,  {
    FUN_PHOTO                : "Upload the photo",
    FUN_PHOTO_LABEL          : "Photo",
    FUN_MO                   : "Insert the emoticons",
    FUN_MO_LABEL             : "Emoticon",
    FUN_SCREENSNAP           : "Screen Capture",
    FUN_SCREENSNAP_SETUP_TIP : "Please click it to install the screen capture control; \r after installing the control, you can capture screens conveniently, and send the captured screens to your friends for sharing.",
    FUN_SCREENSNAP_LABEL     : "Capture",
    FUN_MUSIC                : "Insert the background music ",
    FUN_MUSIC_LABEL          : "Music",
    FUN_MUSIC_LABEL_ADDED    : "Added",

    COMM_CONFIRM             : "OK",
    COMM_CANCEL              : "Cancel",
    COMM_HELP                : "Help",

    PO_LOCAL_PHOTO           : "Upload the photo",
    PO_LOCAL_DESC            : "( Click \"Brower\" to select the photo to upload.)",
    PO_LOCAL_INPUT           : "Select photo:",
    PO_LOCAL_OK              : "Upload",
    PO_NET_PHOTO             : "Photo online",
    PO_NET_DESC              : "( Please input the Url of the photo into textbox)",
    PO_NET_INPUT             : "Url:",
    PO_NET_OK                : "Insert ",

    PO_DLG_TITLE             : "Upload photo",
    PO_DLG_UPLOADING         : "Uploading...",
    PO_DLG_UPLOADFAIL        : "Upload fail!",
    PO_DLG_UPLOADFAIL_INFO   : "Upload fail ,the size of file you upload exceed($curSize$)the limitation($allowSize$).",

    MO_LOADING               : "表情加载中...",

    MC_LOADING               : "音乐加载中...",
    MC_REPLACE_TIP           : "您已经添加了背景音乐，是否需要替换为新的？",

    DOC_TITLE                : "导入Word文档(Doc)",
    DOC_DESC                 : "( 请点击“浏览”，在您电脑中选择您要上传的文档。)",
    DOC_INPUT                : "选择文档：",
    DOC_OK                   : "立即导入",

    DOC_DLG_TITLE            : "上传文档",
    DOC_DLG_UPLOADING        : "文档上传中...",
    DOC_DLG_UPLOADFAIL       : "文档上传失败了！",

    MAX_TITLE                : "Maximize",


    SCREENSNAP_FAIL          : "Capture fail!",
    SCREENSNAP_SAVEFAIL      : "save capture picture fail!",
    UPLOADER_VERSION_LOW     : "You need to upgrade your upload component."
} );



qmEditor.CONST._extend( qmEditor.CONST._TEMPLATE, {
    STYLE : T( [
        'body, table, form {padding:0;margin:0;font-family:Verdana;font-size:12px;line-height:12px;}',
        'table {padding-top:2px;}',
        '.qmEditorTabEmptyLeft, .qmEditorTabEmptyRight {border-bottom:1px solid #aeaeae;}',
        '.qmEditorTabEmptyLeft {padding-left:10px;}',
        '.qmEditorTabEmptyRight {width:100%;}',
        '.qmEditorTab {padding:4px 4px 2px 4px;border:1px solid #aeaeae;margin-top:2px;cursor:pointer;} ',
        '.qmEditorTabSel {padding:4px;border:1px solid #aeaeae;border-bottom:none;border-top:2px solid #FFC83C;font-weight:bold;cursor:pointer;}',
        '.qmEditorPoPanel {padding:padding:2px 0 0 8px;}',
        '.qmEditorPoDesc {margin-bottom:6px;color:gray;line-height:20px;}',
        '.qmEditorPoInputLabel {padding:5px 0 15px 2px;}',
        'input {width:232px;height:20px;}',
        '.qmEditorPoButton {text-align:right;padding-right:15px;}',
        '.qmEditorButton1 {width:52px;margin:1px 2px 0 0}',
        '.qmEditorButton2 {width:76px;*width:72px;margin:1px 2px 0 0}',
        '.qmEditorButton1 .qmEditorButton2 {font-size:12x;height:auto;*height:22px;line-height:auto;*line-height:18px;padding:0 8px;*padding:0;}',
        '.hidden {display:none}',
    ] )
} );

qmEditor.CONST._extend( qmEditor.CONST._TEMPLATE, {
    MENU_PHOTO       : T( [
    '<iframe frameborder="no" scrolling="no" width="330px" height="140px" src="javascript:void((function(){document.open();document.domain=\''+document.domain+'\';document.close();})())" hideFocus></iframe>',
    ] ),
    MENU_PHOTO_BODY  : T( [
    '<head>',
        '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
        '<link rel="stylesheet" type="text/css" href="$css_path$comm.css" />',
        '<style>',
            '$style$',
        '</style>',
    '</head>',
    '<body unselectable="on" onmousedown="return false;" >',
        '<table cellspacing="0" cellpadding="0" border="0" width="100%" unselectable="on" ><tr>',
            '<td class="qmEditorTabEmptyLeft" unselectable="on" nowrap >&nbsp;</td>',
            '<td style="$uploadDisp$" unselectable="on" nowrap>',
                '<div param="localPhoto" class="qmEditorTabSel" unselectable="on">$langLocalPhoto$</div>',
            '</td>',
            '<td unselectable="on" nowrap >',
                '<div param="netPhoto" class="qmEditorTab" style="border-left:none;" unselectable="on" >$langNetPhoto$</div>',
            '</td>',
            '<td class="qmEditorTabEmptyRight" unselectable="on" nowrap >&nbsp;</td>',
        '</tr></table>',
        '<div class="qmEditorPoPanel" unselectable="on" style="$uploadDisp$" >',
        '<iframe name="qmEditorPhotoIframe$iframeId$"  src="javascript:void((function(){document.open();document.domain=\''+document.domain+'\';document.close();})())" style="display:none;" onload="qmEditorPhotoLoaded(this);"  ></iframe>',
            '<form action="$actionSrc$" enctype="multipart/form-data" method="post" target="qmEditorPhotoIframe$iframeId$" >',
                '<div class="qmEditorPoDesc" unselectable="on" >$langLocalDesc$</div>',
                '<div class="qmEditorPoInputLabel" unselectable="on">$langLocalInput$&nbsp;',
                        '<input type="file" name="UploadFile" onkeydown="return false;" />',
                        '<input type="hidden" name="sid"  value="$sid$" />',
                        '<input type="hidden" name="fun"  value="add" />',
                        '<input type="hidden" name="mode" value="download" />',
                        '<input type="hidden" name="widthlimit" value="$widthlimit$" />',
                        '<input type="hidden" name="heightlimit" value="$heightlimit$" />',
                        '<input type="hidden" name="sizelimit" value="$sizelimit$" />',
                '</div>',
            '</form>',
            '<div class="qmEditorPoButton" unselectable="on" >',
                '<button class="qmEditorButton2" param="localok" >$langLocalOK$</button>&nbsp;',
                '<button class="qmEditorButton1" param="cancel" >$langCancel$</button>',
            '</div>',
        '</div>',
        '<div class="qmEditorPoPanel" style="display:none;" unselectable="on" >',
            '<div class="qmEditorPoDesc" unselectable="on" >$langNetDesc$</div>',
            '<div class="qmEditorPoInputLabel" unselectable="on" >$langNetInput$&nbsp;',
                '<input type="text" class="txt" onmousedown="parent.fStopPropagation(event);" />',
            '</div>',
            '<div class="qmEditorPoButton" unselectable="on" >',
                '<button class="qmEditorButton2" param="netok" >$langNetOK$</button>&nbsp;',
                '<button class="qmEditorButton1" param="cancel" >$langCancel$</button>',
            '</div>',
        '</div>',
        '</body>',
                '<script>',
            'document.domain=\''+document.domain+'\';',
        '</script>'
    ] ),
    DIALOG_UPLOADIMG : T( [
    '<div style="padding-top:40px;font:normal 12px;">',
        '<div id="uploading">',
            '<img src="$imgPath$ico_loading2.gif" width="32" height="32" align=absmiddle style="margin:0 4px 0 0" />$langUploading$',
            '<span id="uploadProcess"></span>',
        '</div>',
        '<div id="uploadFail" style="display:none;" >',
            '$langUploadFail$',
        '</div>',
    '</div>'
    ] ),
    MENU_MO          : T( [
    '<div class="qmEditorMenuPanel" unselectable="on" ><span>$loading$</span></div>'
    ] ),
    MENU_MUSIC       : T( [
    '<div class="qmEditorMenuPanel" unselectable="on" ><span>$loading$</span></div>',
    ] ),
    MENU_DOC         : T( [
        '<iframe frameborder="no" scrolling="no" width="330px" height="140px" src="javascript:void((function(){document.open();document.domain=\''+document.domain+'\';document.close();})())" hideFocus></iframe>',
    ] ),
    MENU_DOC_BODY  : T( [
    '<head>',
        '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
        '<link rel="stylesheet" type="text/css" href="$css_path$comm.css" />',
        '<style>',
            '$style$',
        '</style>',
    '</head>',
    '<body unselectable="on" onmousedown="return false;" >',
        '<table cellspacing="0" cellpadding="0" border="0" width="100%" unselectable="on" ><tr>',
            '<td class="qmEditorTabEmptyLeft" unselectable="on" nowrap >&nbsp;</td>',
            '<td style="$uploadDisp$" unselectable="on" nowrap>',
                '<div param="localDoc" class="qmEditorTabSel" unselectable="on">$langDocTitle$</div>',
            '</td>',
            '<td class="qmEditorTabEmptyRight" unselectable="on" nowrap >&nbsp;</td>',
        '</tr></table>',
        '<div class="qmEditorPoPanel" unselectable="on" style="$uploadDisp$" >',
        '<iframe name="qmEditorDocIframe$iframeId$"  src="javascript:void((function(){document.open();document.domain=\''+document.domain+'\';document.close();})())" style="display:none;" onload="qmEditorDocLoaded(this);"  ></iframe>',
            '<form action="$actionSrc$" enctype="multipart/form-data" method="post" target="qmEditorDocIframe$iframeId$" >',
                '<div class="qmEditorPoInputLabel" unselectable="on">$langDocInput$&nbsp;',
                        '<input type="file" name="file" onkeydown="return false;" />',
                        '<input type="hidden" name="sid"  value="$sid$" />',
                        '<input type="hidden" name="fun"  value="add" />',
                '</div>',
            '</form>',
            '<ul style="margin:0px;padding-left:20px;line-height:16px;color:#808080">',
            	'<li>文字、图片以及文字格式会得到保留</li>',
            	'<li>word文档格式复杂，可能存在不能完全还原的情况</li>',
            '</ul>',
            '<div class="qmEditorPoButton" unselectable="on" style="margin-top:5px">',
                '<button class="qmEditorButton2" param="ok" >$langDocOK$</button>&nbsp;',
                '<button class="qmEditorButton1" param="cancel" >$langCancel$</button>',
            '</div>',
        '</div>',
        '</body>',
        '<script>',
            'document.domain=\''+document.domain+'\';',
        '</script>'
    ] ),
    MENU_TABLE         : T( [
        '<iframe frameborder="no" scrolling="no" width="200px" height="80px" src="javascript:void((function(){document.open();document.domain=\''+document.domain+'\';document.close();})())" hideFocus></iframe>',
    ] ),
    MENU_TABLE_BODY          : T( [
    '<head>',
        '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
        '<style>',
            '.qmEditorPoInputLabel input{width:50px}',
            '$style$',
        '</style>',
    '</head>',
    '<div class="qmEditorPoPanel" unselectable="on" >',
        '<div class="qmEditorPoInputLabel" unselectable="on" style="padding-bottom:5px;">',
            '<input param="row" id="row" value="3" type="text" onkeypress="return isInputAvailable(event);" onpaste="return !clipboardData.getData(\'text\').match(/\D/)" ondragenter="return false">行',
            '<input param="column" id="column" value="2" type="text" onkeypress="return isInputAvailable(event);" onpaste="return !clipboardData.getData(\'text\').match(/\D/)" ondragenter="return false" style="ime-mode:Disabled;margin-left:6px"/>列',
            '<div style="height:16px;padding-top:2px;"><font class="hidden" style="color:red;">请正确输入数字</font></div>',
        '</div>',
        '<div class="qmEditorPoButton" unselectable="on">',
            '<button style="line-height:16px;overflow:visible" param="confirm" class="qmEditorButton2" param="ok">添加</button>&nbsp;',
            '<button style="line-height:16px;overflow:visible" param="cancel" class="qmEditorButton1" param="cancel">取消</button>',
        '</div>',
    '</div>',
    '<script>',
    'function isInputAvailable(e) {',
        'var keyCode = window.event ? e.keyCode : e.which;',
        'return keyCode>=48&&keyCode<=57;',
    '}',
    'document.domain=\''+document.domain+'\';',
    '</script>'
    ] )
} );

//// func base class ////

//CONTROL
qmEditor._activex = function( _aBindEditor ) {
    this._mBindEditor = _aBindEditor;
};

qmEditor._activex._bind = function( _aBindEditor ) {
    if ( !_aBindEditor )
        return null;
    if ( !_aBindEditor._mUseActivex )
        _aBindEditor._mUseActivex = new qmEditor._activex( _aBindEditor );
    return _aBindEditor._mUseActivex;
};

qmEditor._activex.prototype._modelDialog = function( _aOnCloseEvent ) {
    var _editor   = this._mBindEditor;
    var _template = _editor._mTemplate;
    var _language = _editor._mLanguage;

    ModelDialog( 1, _language.PO_DLG_TITLE, _template.DIALOG_UPLOADIMG.replace( {
        imgPath        : GetPath( "image" ),
        langUploading  : _language.PO_DLG_UPLOADING,
        langUploadFail : _language.PO_DLG_UPLOADFAIL
    } ), null, null, null, null, null, function() {
        _editor.loadRange();
        if ( typeof( _aOnCloseEvent ) == "function" )
            _aOnCloseEvent();
    } );
};

qmEditor._activex.prototype._uploadOk = function() {
    ModelDialog( 0 );
};

qmEditor._activex.prototype._uploadFail = function( _aParam ) {
    var _uploadFailObj = GetDialogObj( "uploadFail" );
    if ( !_uploadFailObj )
        return ;

    var _lang = this._mBindEditor._mLanguage;
    _uploadFailObj.innerHTML = _aParam ?
        T( _lang.PO_DLG_UPLOADFAIL_INFO ).replace( _aParam ) : _lang.PO_DLG_UPLOADFAIL;

    Show( _uploadFailObj, true );
    Show( GetDialogObj( "uploading" ), false );
};

qmEditor._activex.prototype._uploading = function( _aProcessVal ) {
    var _uploadProcess = GetDialogObj( "uploadProcess" );
    if ( !_uploadProcess )
        return ;

    _uploadProcess.innerHTML = _aProcessVal;
    Show( GetDialogObj( "uploading" ),  true  );
    Show( GetDialogObj( "uploadFail" ), false );
};

qmEditor._activex.prototype._screenSnap = function( _aOnCaptureFinishEvent ) {

    if ( !DetectActiveX( 0, 1 ) )
        return;

    if ( !this.screenSnapObj )
        this.screenSnapObj = CreateActiveX( 0 );

    try {
        this.screenSnapObj._Type = ( GetDomain() == "foxmail.com" ) ? 1 : 0;
    }
    catch( e ) {
    }
    
     var _fEventCreater = function( _aIsOk ) {
        return function() {
            if ( typeof( _aOnCaptureFinishEvent ) == "function" )
                _aOnCaptureFinishEvent( _aIsOk );
        };
    };
    
    //if ( gIsIE ) {
        //IE
        this.screenSnapObj.OnCaptureFinished = _fEventCreater( true  );
        this.screenSnapObj.OnCaptureCanceled = _fEventCreater( false );
        this.screenSnapObj.DoCapture();
   // } else {
        //FF.Chrome
     //   this.screenSnapObj.OnCaptureFinished = function() {
    //        _fSelf.bWait = false;
    //        _fEventCreater( true  );
            //output(["testDoCapture 成功"]);
    //    };
    //    this.screenSnapObj.OnCaptureCanceled = function() {
       //     _fSelf.bWait = false;
       //     _fEventCreater( false );
            //output(["testDoCapture 取消"]);
      //  };
       //  this.screenSnapObj.DoCapture();
  //  }
   

  
};

qmEditor._activex.prototype._hasScreenSnapImg = function() {
    return this.screenImg;
};

qmEditor._activex.prototype._clearScreenSnapImg = function() {
    this.screenImg = "";
};

qmEditor._activex.prototype._saveImg = function( _aIsWarn ) {
    if ( !this.screenSnapObj ) {
        if ( !DetectActiveX( 0, 1 ) )
            return false;
        this.screenSnapObj = CreateActiveX(0);
    }

    if ( !this.screenSnapObj.IsClipBoardImage ) {
        if ( _aIsWarn )
            alert( this._mBindEditor._mLanguage.SCREENSNAP_FAIL );
        return false;
    }

    this.screenImg = this.screenSnapObj.SaveClipBoardBmpToFile(1);
    if ( !this.screenImg ) {
        if ( _aIsWarn )
            alert( this._mBindEditor._mLanguage.SCREENSNAP_SAVEFAIL );
        return false;
    }

    return true;
};

qmEditor._activex.prototype._uploadCustomImg = function( _aIsWarn, _aOnUploadFinishEvent ) {
    if ( this._saveImg( _aIsWarn ) )
        this._startUploadCustomImg( null, _aIsWarn, _aOnUploadFinishEvent );
};

qmEditor._activex.prototype._startUploadCustomImg = function( _aFileCtrl, _aIsWarn, _aOnUploadFinishEvent ) {
    if ( !DetectActiveX( 2, 1 ) ) {
        if ( _aIsWarn )
            alert( this._mBindEditor._mLanguage.UPLOADER_VERSION_LOW );
        return false;
    }

    if ( !this.screenImg && !_aFileCtrl )
        return false;
    
    if ( !this.uploaderObj ) {
        this.uploaderObj = CreateActiveX( 2 );
    }
    
    var _self        = this;
    var _uploader    = this.uploaderObj;
    var _isCallBack  = false;
    
    var _fOnCallBack = function( _aIsOk, _aParam ) {
        if ( _isCallBack )
            return ;
        _isCallBack  = true;

        //_uploader.StopUpload();

        if ( typeof( _aOnUploadFinishEvent ) == "function" )
            _aOnUploadFinishEvent( _aIsOk ? true : false, _aParam );
    };

    this._modelDialog( _fOnCallBack );
    _uploader.StopUpload();
    _uploader.ClearHeaders();
    _uploader.ClearFormItems();
    _uploader.URL     = this._mBindEditor._mPhotoActionSrc;
    _uploader.OnEvent = function( _aObj, _aEventId, _aP1, _aP2, _aP3 ) {
        _self._onUploaderEvent( _aObj, _aEventId, _aP1, _aP2, _aP3, _fOnCallBack );
    }

    _uploader.AddHeader(   "Cookie", document.cookie );
    //_uploader.AddFormItem( "fun", 0, 0, "add" );
    //_uploader.AddFormItem( "sid", 0, 0, GetSid() );
    _uploader.AddFormItem( "mode", 0, 0, /*!gIsIE || gIEVer >= 7 || location.protocol == "https:" ? */"download" );
    _uploader.AddFormItem( "from", 0, 0, _aFileCtrl ? "" : "snapscreen" );

    var _conf = this._mBindEditor._mPhotoConfig || {};

    _uploader.AddFormItem( "widthlimit", 0, 0, _conf.widthlimit || 0 );
    _uploader.AddFormItem( "heightlimit", 0, 0, _conf.heightlimit || 0 );
    _uploader.AddFormItem( "sizelimit", 0, 0, _conf.sizelimit || 0 );
    
    if ( _aFileCtrl ) {
        _uploader.AddFormItemObject( _aFileCtrl );
    }
    else {
        _uploader.AddFormItem( "UploadFile", 1, 4, this.screenImg );
    }
    
    _uploader.StartUpload();
    return true;
};

qmEditor._activex.prototype._onUploaderEvent = function( _aObj, _aEventId, _aP1, _aP2, _aP3, _aOnUploadFinishEvent ) {
    switch( _aEventId ) {
    case 1:
        //error
        return _aOnUploadFinishEvent( false, {
            errCode : _aP1
        } );
    case 2:
        //process
        this._uploading( parseInt( _aP1 * 90 / _aP2 ) + "%" );
        return;
    case 3:
        //finish
        if ( this.uploaderObj.ResponseCode != "200" )
            return _aOnUploadFinishEvent( false, {
                errCode : _aP1
            } );

        this._uploading( "100%" );

        //window.alert(this.uploaderObj.Response);

        this._processResponse( this.uploaderObj.Response, _aOnUploadFinishEvent );
    }
};

qmEditor._activex.prototype._processResponse = function( _aResponse, _aOnUploadFinishEvent ) {
    return _aOnUploadFinishEvent( true, {
            imgUrl : _aResponse
    } );

    /*
    var _ss     = _aResponse || "";
    var _s      = _ss.indexOf( 'On_upload("' );
    var _e      = _ss.indexOf( '");', _s );
    var _rparam = ( _s != -1 && _e != -1 ) ? _ss.substring( _s + 11, _e ) : "err";

    if ( _rparam != "err" )
        return _aOnUploadFinishEvent( true, {
            imgUrl : _rparam
        } );

    _s = _ss.indexOf( 'On_upload_Fail("' );
    _e = _ss.indexOf( '");', _s );

    var _fFormatSize = function( _aValue ) {
        _aValue = parseInt( _aValue );
        return '<span style="color:red;" >' + ( isNaN( _aValue ) ? "5M" : ( parseInt( 100 * parseInt( _aValue ) / ( 1024 * 1024 ) ) / 100 ) ) + "M</span>";
    };

    if ( _s != -1 && _e != -1 ) {
        _rparam = _ss.substring( _s + 16, _e ).replace( new RegExp( "\"", "ig" ), "" ).split( "," );
        return _aOnUploadFinishEvent( false, {
            curSize   : _fFormatSize( _rparam[ 0 ] ),
            allowSize : _fFormatSize( _rparam[ 1 ] )
        } );
    }

    return _aOnUploadFinishEvent( false );
    */
};

//MENU CUSTOM
qmEditor.FUNCLIB._MENUCUSTOM = qmEditor.FUNCLIB._inheritFrom( function() {
    this._mId          = "MENUCUSTOM";
    this._mType        = "menu";
    this._mTmplName    = "MENU_CUSTOM";
    this._mIsSaveRange = true;
    this._mMenuData    = [ {} ];
}, qmEditor.FUNCLIB._BASE );

qmEditor.FUNCLIB._MENUCUSTOM.prototype._initMenuElements = function() {
    this.menuElements = {};

    ( function( _aNode ) {
        if ( !_aNode || _aNode.nodeType != 1 )
            return;

        var _param = _aNode.getAttribute( "param" );
        if ( _param )
            this.menuElements[ _param ] = _aNode;

        for ( _aNode = _aNode.firstChild ; _aNode ; _aNode = _aNode.nextSibling )
                arguments.callee.call( this, _aNode );
    } ).call( this, this._mBindMenu );

    this._setMenuElementsEvent();
};

qmEditor.FUNCLIB._MENUCUSTOM.prototype._setMenuElementsEvent = function() {
};

//MENU IMAGE
qmEditor.FUNCLIB._MENUIMAGE = qmEditor.FUNCLIB._inheritFrom( function() {
    this._mId              = "MENUIMAGE";
    this._mTmplName        = "MENU_IMAGE";
    this.isFireUploadEvent = true;
}, qmEditor.FUNCLIB._MENUCUSTOM );

qmEditor.FUNCLIB._MENUIMAGE.prototype._insertImage = function( _aPicUrl ) {
    var _editor = this._mBindEditor;

    _editor._execCmd( "InsertImage", _aPicUrl, function() {
        var _selection = this._mEditDoc.selection;
        if ( _selection && _selection.type == "Control" ) {
            var _range = this._mEditDoc.body.createTextRange();
            _range.moveToElementText( this._mEditDoc.selection.createRange().item( 0 ) );
            _range.collapse( false );
            _range.select();
        }
    } );
};

qmEditor.FUNCLIB._MENUIMAGE.prototype._readyToUpload = function() {
    this.isFireUploadEvent = false;
};

qmEditor.FUNCLIB._MENUIMAGE.prototype._isReadyToUpload = function() {
    return this.isFireUploadEvent != true;
};

qmEditor.FUNCLIB._MENUIMAGE.prototype._doUploadFinish = function( _aIsOk, _aParam ) {
    if ( this.isFireUploadEvent )
        return ;
    this.isFireUploadEvent = true;

    var _activex = qmEditor._activex._bind( this._mBindEditor );
    if ( _aIsOk ) {
        _activex._uploadOk();
        this._insertImage( _aParam.imgUrl );
    }
    else {
        _activex._uploadFail( _aParam );
    }
    window.status = 'Done';
};

//// funcs ////

//Photo
qmEditor.FUNCLIB.Photo = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Photo";
    this._mBindEditor = _aParamSet.editor;
    this._mTmplName   = "MENU_PHOTO";

    var _lang       = this._mBindEditor._mLanguage;

    this._mUiConfig.icon  = {
        bgleft : -322,
        width  : 20,
        margin : "0 4px 0 0",
        title  : _lang.FUN_PHOTO
    };
    this._mUiConfig.text = {
        margin   : "0 11px 0 0",
        bgleft   : -324,
        width    : 13,
        title    : _lang.FUN_PHOTO,
        label    : _lang.FUN_PHOTO_LABEL
    };
    this._mUiConfig.big  = {
        src    : GetPath( "image" ) + "compose_easy_photo.gif",
        label  : _lang.FUN_PHOTO_LABEL
    };

}, qmEditor.FUNCLIB._MENUIMAGE );

qmEditor.FUNCLIB.Photo.prototype._initMenuElements = function() {
    if ( this.menuElements )
        return ;

    this.menuElements            = {};

    if (gIsIE) {
        window['menu_pic'] = this;

        this._mBindMenu.firstChild.src = "javascript:void((function(){document.open('text/html','replace');document.domain=\'"+document.domain+"\';document.close(); parent.window['menu_pic']._setupMenuElements();})())";
    } else {
        this._setupMenuElements();
    }
};

qmEditor.FUNCLIB.Photo.prototype._setupMenuElements = function() {
    this.menuElements.photoPanel = this._mBindMenu.firstChild.contentWindow;

    var _editor      = this._mBindEditor;

    var _uploadDisp  = _editor._mPhotoActionSrc ? "" : "display:none";
    this.defTabName  = _uploadDisp == "" ? "localPhoto" : "netPhoto";

    var _lang        = _editor._mLanguage;
    var _doc         = this.menuElements.photoPanel.document;
    var _template    = _editor._mTemplate;
    var _conf        = _editor._mPhotoConfig || {};

    _doc.open('text/html','replace');
    _doc.writeln( _template.MENU_PHOTO_BODY.replace( {
        iframeId       : ( new Date() ).valueOf(),
        css_path       : editor_path + "style/",

        actionSrc      : _editor._mPhotoActionSrc,
        widthlimit     : _conf.widthlimit || 0,
        heightlimit    : _conf.heightlimit || 0,
        sizelimit      : _conf.sizelimit || 0,

        sid            : GetSid(),
        uploadDisp     : _uploadDisp,

        style          : _template.STYLE,

        langLocalPhoto : _lang.PO_LOCAL_PHOTO,
        langLocalDesc  : _lang.PO_LOCAL_DESC,
        langLocalInput : _lang.PO_LOCAL_INPUT,
        langLocalOK    : _lang.PO_LOCAL_OK,
        langNetPhoto   : _lang.PO_NET_PHOTO,
        langNetDesc    : _lang.PO_NET_DESC,
        langNetInput   : _lang.PO_NET_INPUT,
        langNetOK      : _lang.PO_NET_OK,
        langCancel     : _lang.COMM_CANCEL
    } ) );
    _doc.close();

    // ### warning ###
    // after document write ... the charset change to unicode
    // now set it default charset force
    _doc.charset                 = "utf-8";

    var _body                    = _doc.body;
    this.menuElements.localPanel = _body.childNodes[ 1 ];
    this.menuElements.netPanel   = _body.childNodes[ 2 ];

    var _divs                    = GelTags( "div", _body );
    this.menuElements.localBtn   = _divs[ 0 ];
    this.menuElements.netBtn     = _divs[ 1 ];

    var _inputs                  = GelTags( "input", _body );
    this.menuElements.localInput = _inputs[ 0 ];
    this.menuElements.netInput   = _inputs[ _inputs.length - 1 ];

    var _buttons                 = GelTags( "button", _body );
    this.menuElements.localOk    = _buttons[ 0 ];
    this.menuElements.netOk      = _buttons[ 2 ];
    this.menuElements.cancel     = _buttons[ 1 ];

    this.menuElements.actionForm = GelTags( "form", _body )[ 0 ];
    this.menuElements.actionIfrm = GelTags( "iframe", _body )[ 0 ];

    this._setMenuElementsEvent();

    //event
    this._onshowmenu = this._doDefaultShowMenu;
}

qmEditor.FUNCLIB.Photo.prototype._setMenuElementsEvent = function() {
    var _self = this;

    with( this.menuElements ) {

        fAddEvent( photoPanel.document, "click", function( _aEvent ) {
            _self._doDefaultMenuClick( _aEvent );
        } );

        fAddEvent( photoPanel.document.body, "keydown", function( _aEvent ) {
            if ( _aEvent.keyCode == 27 ) {
                _self._doDefaultMenuClick( {
                    target : cancel
                } );
                fPreventDefault( _aEvent );
            }
            if ( _aEvent.keyCode == 13 ) {
                var _target = _aEvent.target || _aEvent.srcElement;
                _self._doDefaultMenuClick( {
                    target : _target == localInput ? localOk :
                        ( _target == netInput ? netOk : null )
                } );
                fPreventDefault( _aEvent );
            }
        } );

        //call back
        photoPanel.qmEditorPhotoLoaded = function( _aObj ) {
            try {
                var _location  = _aObj.contentWindow.location.href;

                if ( _location.indexOf( "qmeditor_upload" ) < 0 ) return;

                if ( _location.indexOf( "javascript:" ) == 0 ||
                     _location.indexOf( "about:blank" ) == 0 )
                    return ;

                var _response = _aObj.contentWindow.document.body.innerHTML;

                qmEditor._activex._bind( _self._mBindEditor )._processResponse( _response, function( _aIsOk, _aParam ) {
                    _self._doUploadFinish( _aIsOk, _aParam );
                } );
            }
            catch( e ) {
                alert('photo loaded:' + e.message);
                return _self._doUploadFinish( false, {} );
            }
        };

        //hack code
        GetMainWin().On_upload = GetMainWin().On_upload_Fail = function() {};
    }
};

qmEditor.FUNCLIB.Photo.prototype._doDefaultShowMenu = function( _aEvent ) {
    //this.menuElements.localInput.clear();
    this.menuElements.netInput.value = "http://";

    this._changeTab( this.defTabName );
};

qmEditor.FUNCLIB.Photo.prototype._doDefaultMenuClick = function( _aEvent ) {
    var _target = _aEvent.target || _aEvent.srcElement;
    var _param  = _target && _target.getAttribute( "param" );
    var _editor = this._mBindEditor;

    if ( !_param )
        return;

    var _fFilter = function( _aValue ) {
        return _aValue.replace( "\"", "%22" ).replace( "'", "%27" ).replace( ">", "%3E" );
    };

    switch( _param ) {
    case "localPhoto":
    case "netPhoto":
        this._changeTab( _param );
        break;
    case "netok":
        this._hideMenu( true );
        this._insertImage( _fFilter( this.menuElements.netInput.value ) );
        break;
    case "localok":
        this._uploadImg();
        this._hideMenu( false );
        break;
    case "cancel":
        this._hideMenu( true );
        break;
    }
};

qmEditor.FUNCLIB.Photo.prototype._changeTab = function( _aTab ) {
    var _isLocalPhoto = _aTab == "localPhoto";

    var _tabClass = [ "qmEditorTabSel", "qmEditorTab" ];
    var _tabInput = [ "localInput", "netInput" ];
    var _classIdx = _isLocalPhoto ? 0 : 1;

    with( this.menuElements ) {

        Show( localPanel, _isLocalPhoto  );
        Show( netPanel,   !_isLocalPhoto );

        localBtn.className = _tabClass[ _classIdx ];
        netBtn.className   = _tabClass[ 1 - _classIdx ];

    }

    this.menuElements[ _tabInput[ _classIdx ] ].focus();
    this.menuElements[ _tabInput[ _classIdx ] ].select();
};

qmEditor.FUNCLIB.Photo.prototype._uploadImg = function() {

    var _self    = this;
    var _editor  = this._mBindEditor;
    var _activex = qmEditor._activex._bind( _editor );
    var _input   = this.menuElements.localInput;

    if ( !_input.value )
        return;
    this._readyToUpload();
    //chrome与FF用JS表单上传，其它浏览器用用插件上传，（FF14.0以上用插件上传有问题）
    if (!gIsChrome && !gIsFF) {
        if ( _activex._startUploadCustomImg( _input, false, 
            function( _aIsOk, _aParam ) {
				//当返回的URL被<html></html>包裹的时候获取内容，内容是正确的图片地址
				var imgUrl = _aParam['imgUrl'];
				if(imgUrl.indexOf("http://") != 0){
					_aParam['imgUrl'] = $(imgUrl).text();
				}
                _self._doUploadFinish( _aIsOk, _aParam );
         } ) ) {
            return;
        }
    }
    this.menuElements.actionForm.submit();

    _activex._modelDialog( function() {
        if ( !_self._isReadyToUpload() )
            return ;
        try {
            //cancel
            _self.menuElements.actionIfrm.contentWindow.location = "about:blank";
        }
        catch( e ) {
        }

        _self._doUploadFinish( false );
    } );
};

//Mo
qmEditor.FUNCLIB.Mo = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Mo";
    this._mBindEditor = _aParamSet.editor;
    this._mTmplName   = "MENU_MO";

    var _lang       = this._mBindEditor._mLanguage;

    this._mUiConfig.icon  = {
        bgleft : -362,
        width  : 20,
        margin : "0 4px 0 0",
        title  : _lang.FUN_MO
    };
    this._mUiConfig.text = {
        margin : "0 11px 0 -2px",
        bgleft : -362,
        width  : 13,
        lbMargin : "0 0 0 1px",
        title  : _lang.FUN_MO,
        label  : _lang.FUN_MO_LABEL
    };
    this._mUiConfig.big  = {
        src    : GetPath( "image" ) + "compose_easy_face.gif",
        label  : _lang.FUN_MO_LABEL
    };

    //menu data
    this._mMenuData = [ {
        loading : _lang.MO_LOADING
    } ];

}, qmEditor.FUNCLIB._MENUIMAGE );

qmEditor.FUNCLIB.Mo.prototype._initMenuElements = function() {
    if ( !this.moPanel ) {
        if ( !window.qmMo ) {
            if ( this.waitLoadTimer )
                return;


            if (this._mBindEditor._mLang == 'en') {
                this._mBindEditor._loadFile( {
                    "plus/mo_en.js" : true
                } );
            } else {
                this._mBindEditor._loadFile( {
                    "plus/mo.js" : true
                } );
            }

            var _self = this;
            this.waitLoadTimer = setInterval( function() {
                _self._initMenuElements();
            }, 200 );

            return ;
        }

        if ( this.waitLoadTimer ) {
            clearInterval( this.waitLoadTimer );
            this.waitLoadTimer = null;
        }

        this.moPanel = new qmMo( {
            tabList : this._mBindEditor._mFuncList.moTabs
        } );
        this.moPanel.setup( {
            container : this._mBindMenu
        } );
        this._adjustMenuPos();
    }
};

qmEditor.FUNCLIB.Mo.prototype._afterHideMenu = function() {
    if ( this.waitLoadTimer ) {
        clearInterval( this.waitLoadTimer );
        this.waitLoadTimer = null;
    }
};

qmEditor.FUNCLIB.Mo.prototype._doDefaultMenuClick = function( _aEvent ) {
    var _target = _aEvent.target || _aEvent.srcElement;
    var _param  = _target && _target.getAttribute( "param" );
    var _editor = this._mBindEditor;

    if ( !_param )
        return;

    this._hideMenu( true );
    this._insertImage( _param );
};

//ScreenSnap
qmEditor.FUNCLIB.ScreenSnap = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    if ( !_aParamSet.editor._mPhotoActionSrc )
        return ;

    this._mId         = "ScreenSnap";
    this._mType       = "btn";
    this._mBindEditor = _aParamSet.editor;
    this._updateUIInfo();

    //event
    var _self      = this;
    var _editor    = this._mBindEditor;
    var _activex   = qmEditor._activex._bind( _editor );

    var _timeout;
    
    this._onkeydown = function( _aEvent ) {
        if ( _aEvent.ctrlKey && _aEvent.altKey && _aEvent.keyCode == 65 ) {
            _self._doDefaultClick();
            fPreventDefault( _aEvent );
        }
        else if ( _aEvent.ctrlKey && _aEvent.keyCode == 86 && ((_aEvent.srcElement && _aEvent.srcElement.tagName == "BODY") || window.gIsFF )) {
            _editor.saveRange();

            _self._readyToUpload();
            if ( _activex._uploadCustomImg( false, function( _aUploadOk, _aParam ) {
                    _self._doUploadFinish( _aUploadOk, _aParam );
                } ) ) {
                fPreventDefault( _aEvent );
            }
            else if ( !DetectActiveX( 0 ) ) {
                if ( _timeout )
                    return ;
                _timeout = setTimeout( function() {
                    if ( !_timeout )
                        return ;
                    _timeout = null;
                    _editor._onshowinstallactive( "paste" );
                }, 200 );
            }
        }
    };

    this._oncontextmenu = function( _aEvent ) {
        try {
            if ( _activex._saveImg() )
                clipboardData.setData( "Text", "" );
        }
        catch( e ) {
        }
    };

    this._onpaste = function( _aEvent ) {
        if ( _timeout ) {
            clearTimeout( _timeout );
            _timeout = null;
        }
        if ( !_activex._hasScreenSnapImg() ) {
            return;
        } else {
            // has img in cilckboard
           if(window.gIsFF) {
                fPreventDefault(_aEvent);
                _activex._clearScreenSnapImg();
                return;
            }
        }

        try {
            _editor.saveRange();

            if ( !clipboardData.getData( "Text" ) ) {
                _self._readyToUpload();
                _activex._startUploadCustomImg( null, false, function( _aUploadOk, _aParam ) {
                    _self._doUploadFinish( _aUploadOk, _aParam );
                } );
            }
            else {
                _activex._clearScreenSnapImg();
            }
        }
        catch( e ) {
        }
    };
}, qmEditor.FUNCLIB._MENUIMAGE );

qmEditor.FUNCLIB.ScreenSnap.prototype._doDefaultClick = function( _aEvent ) {
    var _editor = this._mBindEditor;
    _editor.hideMenu();

    if ( !DetectActiveX( 0, 1 ) ) {
        if ( typeof( this._mBindEditor._onshowinstallactive ) == "function" )
            _editor._onshowinstallactive();
        return ;
    }

    _editor.saveRange();

    var _self    = this;
    var _activex = qmEditor._activex._bind( _editor );
    _activex._screenSnap( function( _aIsOk ) {
        
        if ( !_aIsOk )
            _editor.loadRange();

        if ( _aIsOk ) {
            _self._readyToUpload();
            _activex._uploadCustomImg( true, function( _aUploadOk, _aParam ) {
                _self._doUploadFinish( _aUploadOk, _aParam );
            } );
        }
    } );
};

qmEditor.FUNCLIB.ScreenSnap.prototype._updateUIInfo = function() {
    var _isEnabled  = DetectActiveX( 0 );
    var _lang       = this._mBindEditor._mLanguage;

    this._mUiConfig.icon  = {
        bgleft : _isEnabled ? -382 : -343,
        width  : 20,
        margin : "0 4px 0 0",
        title  : _isEnabled ? _lang.FUN_SCREENSNAP : _lang.FUN_SCREENSNAP_SETUP_TIP
    };
    this._mUiConfig.text = {
        margin : "0 11px 0 0",
        bgleft : _isEnabled ? -383 : -344,
        width  : 13,
        lbMargin : "0 0 0 2px",
        title  : _isEnabled ? _lang.FUN_SCREENSNAP : _lang.FUN_SCREENSNAP_SETUP_TIP,
        label  : _lang.FUN_SCREENSNAP_LABEL
    };
};

//Music
qmEditor.FUNCLIB.Music = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId          = "Music";
    this._mBindEditor  = _aParamSet.editor;
    this._mTmplName    = "MENU_MUSIC";

    var _editor      = this._mBindEditor;
    var _lang        = _editor._mLanguage;

    this._mUiConfig.text = {
        margin : "0 11px 0 -3px",
        bgleft : -493,
        width  : 13,
        title  : _lang.FUN_MUSIC,
        label  : _lang[ _editor.getBgMusicInfo() ? "FUN_MUSIC_LABEL_ADDED" : "FUN_MUSIC_LABEL" ]
    };

    //menu data
    this._mMenuData = [ {
        loading : _lang.MC_LOADING
    } ];

    //event
    this._onshowmenu = this._doDefaultShowMenu;

    var _self       = this;
    _editor._onprivatechangebgmusic = function() {
        _self._doChangeBgMusic( this.getBgMusicInfo() );
    }

}, qmEditor.FUNCLIB._MENUCUSTOM );

qmEditor.FUNCLIB.Music.prototype._initMenuElements = function() {
    if ( this._mMusicPanel )
        return ;

    var _self   = this;
    var _editor = this._mBindEditor;

    if ( !window.qmBgMusic ) {
        if ( this.waitLoadTimer )
            return;

        _editor._loadFile( {
            "plus/bgmusic.js" : true
        } );

        this.waitLoadTimer = setInterval( function() {
            _self._initMenuElements();
        }, 200 );

        return ;
    }

    if ( this.waitLoadTimer ) {
        clearInterval( this.waitLoadTimer );
        this.waitLoadTimer = null;
    }

    this._mMusicPanel = new qmBgMusic();
    this._mMusicPanel.setup( {
        container     : this._mBindMenu,
        style         : _editor._mTemplate.STYLE,
        func          : "soso",
        onselectmusic : function( _aSong, _aSinger, _aUrl ) {
            if ( !_editor.getBgMusicInfo() || confirm( _editor._mLanguage.MC_REPLACE_TIP ) ) {
                if ( _aUrl && _aUrl.indexOf( "://" ) == -1 )
                    _aUrl = "http://" + _aUrl;
                _editor.setBgMusicInfo( _aSong, _aSinger, _aUrl );
                _self._hideMenu( true );
            }
        },
        onclose       : function() {
            _self._hideMenu( true );
        }
    } );
    this._adjustMenuPos();

    this._mMusicPanel.focus();
};

qmEditor.FUNCLIB.Music.prototype._doDefaultShowMenu = function( _aEvent ) {
    if ( this._mMusicPanel )
        this._mMusicPanel.focus();
};

qmEditor.FUNCLIB.Music.prototype._doChangeBgMusic = function( _aInfo ) {
    if ( !this._mContainer )
        return;

    var _labels = GelTags( "a", this._mContainer );
    var _labLen = _labels.length;
    if ( _labLen == 0 )
        return;

    _labels[ _labLen - 1 ].innerHTML = this._mBindEditor._mLanguage[ _aInfo ? "FUN_MUSIC_LABEL_ADDED" : "FUN_MUSIC_LABEL" ];
};


//add by minglin, word import
//doc

qmEditor.FUNCLIB.Doc = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Doc";
    this._mBindEditor = _aParamSet.editor;
    this._mTmplName    = "MENU_DOC";

    var _editor      = this._mBindEditor;
    var _lang        = _editor._mLanguage;

    this._mUiConfig.icon  = {
        bgleft : -533,
        width  : 20,
        margin : "0 4px 0 0",
        title  : _lang.DOC_TITLE
    };
    this._mUiConfig.text = {
        margin : "0 11px 0 -2px",
        bgleft : -462,
        width  : 13,
        lbMargin : "0 0 0 1px",
        title  : _lang.DOC_TITLE,
        label  : _lang.DOC_TITLE
    };
}, qmEditor.FUNCLIB._MENUIMAGE );

qmEditor.FUNCLIB.Doc.prototype._doDefaultShowMenu = function( _aEvent ) {
    //this.menuElements.localInput.clear();
    //alert('doc do default show menu');
    //ModelDialog( 1, 'title', 'content', null, null, null, 300, 200, null );
};

qmEditor.FUNCLIB.Doc.prototype._initMenuElements = function() {
    if ( this.menuElements )
        return ;

    this.menuElements            = {};

    if (gIsIE) {
        window['menu_doc'] = this;
        this._mBindMenu.firstChild.src = "javascript:void((function(){document.open('text/html','replace');document.domain=\'"+document.domain+"\';document.close(); parent.window['menu_doc']._setupMenuElements();})())";
    } else {
        this._setupMenuElements();
    }

};

qmEditor.FUNCLIB.Doc.prototype._setupMenuElements = function() {
    this.menuElements.docPanel = this._mBindMenu.firstChild.contentWindow;

    var _editor      = this._mBindEditor;

    var _uploadDisp  = _editor._mPhotoActionSrc ? "" : "display:none";
    this.defTabName  = _uploadDisp == "" ? "localPhoto" : "netPhoto";

    var _lang        = _editor._mLanguage;
    var _doc         = this.menuElements.docPanel.document;
    var _template    = _editor._mTemplate;
    var _conf        = _editor._mPhotoConfig || {};

    _doc.open('text/html','replace');
    _doc.writeln( _template.MENU_DOC_BODY.replace( {
        iframeId       : ( new Date() ).valueOf(),
        css_path       : editor_path + "style/",

        actionSrc      : _editor._mDocActionSrc + "?domain=" + document.domain,
        widthlimit     : _conf.widthlimit || 0,
        heightlimit    : _conf.heightlimit || 0,
        sizelimit      : _conf.sizelimit || 0,

        sid            : GetSid(),
        uploadDisp     : _uploadDisp,

        style          : _template.STYLE,

        langDocTitle   : _lang.DOC_TITLE,
        langDocDesc    : _lang.DOC_DESC,
        langDocInput   : _lang.DOC_INPUT,
        langDocOK      : _lang.DOC_OK,
        langCancel     : _lang.COMM_CANCEL
    } ) );
    _doc.close();

    // ### warning ###
    // after document write ... the charset change to unicode
    // now set it default charset force
    _doc.charset                 = "utf-8";

    var _body                    = _doc.body;
    this.menuElements.localPanel = _body.childNodes[ 1 ];
    this.menuElements.netPanel   = _body.childNodes[ 2 ];

    var _divs                    = GelTags( "div", _body );
    this.menuElements.localBtn   = _divs[ 0 ];
    this.menuElements.netBtn     = _divs[ 1 ];

    var _inputs                  = GelTags( "input", _body );
    this.menuElements.docInput = _inputs[ 0 ];

    var _buttons                 = GelTags( "button", _body );
    this.menuElements.docOk    = _buttons[ 0 ];
    this.menuElements.cancel     = _buttons[ 1 ];

    this.menuElements.actionForm = GelTags( "form", _body )[ 0 ];
    this.menuElements.actionIfrm = GelTags( "iframe", _body )[ 0 ];

    this._setMenuElementsEvent();
    this._onshowmenu = this._doDefaultShowMenu;
}

qmEditor.FUNCLIB.Doc.prototype._setMenuElementsEvent = function() {
    var _self = this;

    with( this.menuElements ) {

        fAddEvent( docPanel.document, "click", function( _aEvent ) {
            _self._doDefaultMenuClick( _aEvent );
        } );

        fAddEvent( docPanel.document.body, "keydown", function( _aEvent ) {
            if ( _aEvent.keyCode == 27 ) {
                _self._doDefaultMenuClick( {
                    target : cancel
                } );
                fPreventDefault( _aEvent );
            }
            if ( _aEvent.keyCode == 13 ) {
                var _target = _aEvent.target || _aEvent.srcElement;
                _self._doDefaultMenuClick( {
                    target : _target == localInput ? localOk :
                        ( _target == netInput ? netOk : null )
                } );
                fPreventDefault( _aEvent );
            }
        } );

        //call back
        docPanel.qmEditorDocLoaded = function( _aObj ) {
            try {
                var _location  = _aObj.contentWindow.location.href;

                if ( _location.indexOf( "doc2html" ) < 0 ) return;

                if ( _location.indexOf( "javascript:" ) == 0 ||
                     _location.indexOf( "about:blank" ) == 0 )
                    return ;

                var _body  =  _aObj.contentWindow.document.body;

                var _docContent = _body.innerHTML;

                var _editor = _self._mBindEditor;

                ModelDialog( 0 );

                if (gIsIE) {
                    _editor._mEditDoc.selection.createRange().pasteHTML(_docContent);
                } else {
                    _editor._execCmd( "InsertHTML", _docContent, function() {
                        var _selection = this._mEditDoc.selection;
                        if ( _selection && _selection.type == "Control" ) {
                            var _range = this._mEditDoc.body.createTextRange();
                            _range.moveToElementText( this._mEditDoc.selection.createRange().item( 0 ) );
                            _range.collapse( false );
                            _range.select();
                        }
                    } );
                }


            }
            catch( e ) {
                alert('doc loaded:' + e.message);
                return _self._doUploadFinish( false, {} );
            }
        };

        //hack code
        GetMainWin().On_upload = GetMainWin().On_upload_Fail = function() {};
    }
};

qmEditor.FUNCLIB.Doc.prototype._doDefaultMenuClick = function( _aEvent ) {
    var _target = _aEvent.target || _aEvent.srcElement;
    var _param  = _target && _target.getAttribute( "param" );
    var _editor = this._mBindEditor;

    if ( !_param )
        return;

    var _fFilter = function( _aValue ) {
        return _aValue.replace( "\"", "%22" ).replace( "'", "%27" ).replace( ">", "%3E" );
    };

    switch( _param ) {
    case "ok":
        this._uploadDoc();
        this._hideMenu( false );
        break;
    case "cancel":
        this._hideMenu( true );
        break;
    }
};

qmEditor.FUNCLIB.Doc.prototype._uploadDoc = function() {
    var _self    = this;
    var _editor  = this._mBindEditor;
    var _activex = qmEditor._activex._bind( _editor );
    var _input   = this.menuElements.docInput;
    var _language = _editor._mLanguage;
    var _template = _editor._mTemplate;


    if ( !_input.value )
        return;

    this.menuElements.actionForm.submit();

    ModelDialog( 1, _language.DOC_DLG_TITLE, _template.DIALOG_UPLOADIMG.replace( {
        imgPath        : GetPath( "image" ),
        langUploading  : _language.DOC_DLG_UPLOADING,
        langUploadFail : _language.DOC_DLG_UPLOADFAIL
    } ), null, null, null, null, null, function() {
        _editor.loadRange();
    } );

};

//Maximize
qmEditor.FUNCLIB.Max = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Max";
    this._mType       = "btn";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -618,
        width  : 20,
        margin : "0",
        title  : "全屏"
    };

    //event
    this._onkeydown = function( _aEvent ) {
        if ( _aEvent.ctrlKey && _aEvent.keyCode == 77 ) {
            this._doDefaultClick();
            fPreventDefault( _aEvent );
        }
    };
}, qmEditor.FUNCLIB._BASE );

qmEditor.FUNCLIB.Max.prototype._updateUIInfo = function() {
	var editorArea = S(this._mBindEditor._mEditorAreaId, window);
	if ( editorArea.className == 'qme_maximized' ) {
		this._mUiConfig.icon = {
			bgleft : -641,
			width  : 20,
			margin : "0",
			title  : "取消全屏"
		};
	} else {
		this._mUiConfig.icon = {
			bgleft : -618,
			width  : 20,
			margin : "0",
			title  : "全屏"
		};
	}
};

qmEditor.FUNCLIB.Max.prototype._doDefaultClick = function( _aEvent ) {
    var editorArea = S(this._mBindEditor._mEditorAreaId, window);
    if ( editorArea.className == 'qme_maximized' ) {
        editorArea.className = '';
        gd.body.className = gd.body.className.replace(/qme_disable_scroll/,'');
        gd.body.scroll = 'yes';

		this._mBindEditor.updateToolBarUI("Max");
		//fix第一次全屏时垂直滚动条不正确的bug
		var html = document.getElementsByTagName("html")[0];
		html.style.overflow = "auto";
    } else {
        editorArea.className = 'qme_maximized';
      //editorArea.style.top = document.documentElement.scrollTop + "px";
        gd.body.className += ' qme_disable_scroll';
        gd.body.scroll = 'no';

		this._mBindEditor.updateToolBarUI("Max");
		//fix第一次全屏时垂直滚动条不正确的bug,by powerjiang
		var html = document.getElementsByTagName("html")[0];
		html.style.overflow = "hidden";
    }

    var editorIframe  = GelTags( "td", editorArea )[ 1 ].firstChild;
    if ( editorIframe.className == 'qmEditorIfrmEditArea qme_iframe_maximized' ) {
        editorIframe.className = 'qmEditorIfrmEditArea';
    } else {
        editorIframe.className = 'qmEditorIfrmEditArea qme_iframe_maximized';
    }

    var editorText = GelTags( "td", editorArea )[ 1 ].childNodes[ 1 ];
    if ( editorText.className == 'qmEditorText qme_iframe_maximized' ) {
        editorText.className = 'qmEditorText';
    } else {
        editorText.className = 'qmEditorText qme_iframe_maximized';
    }

    if(gIsIE){
        this._mBindEditor._mEditDoc.body.setAttribute( 'contentEditable', false );
        this._mBindEditor._mEditDoc.body.setAttribute( 'contentEditable', true );
        this._mBindEditor.focus();
    }
};


//code
qmEditor.FUNCLIB.Code = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Code";
    this._mBindEditor = _aParamSet.editor;

    var _editor      = this._mBindEditor;
    var _lang        = _editor._mLanguage;

    this._mUiConfig.icon = {
        bgleft : -553,
        width  : 20,
        margin : "0",
        title  : "插入代码"
    };
    this._mTmplName    = "MENU_CODE";

    var _editor      = this._mBindEditor;
    var _lang        = _editor._mLanguage;

    //menu data
    this._mMenuData = [ {
        loading : _lang.MC_LOADING
    } ];

    //event
    this._onshowmenu = this._doDefaultShowMenu;

}, qmEditor.FUNCLIB._MENUCUSTOM );

qmEditor.FUNCLIB.Code.prototype._initMenuElements = function() {
    if ( this._mCodePanel )
        return ;

    var _self   = this;
    var _editor = this._mBindEditor;

    if ( !window.qmCode ) {
        if ( this.waitLoadTimer )
            return;

        _editor._loadFile( {
            "plus/code.js" : true
        } );

        this.waitLoadTimer = setInterval( function() {
            _self._initMenuElements();
        }, 200 );

        return ;
    }

    if ( this.waitLoadTimer ) {
        clearInterval( this.waitLoadTimer );
        this.waitLoadTimer = null;
    }

    this._mCodePanel = new qmCode();
    this._mCodePanel.setup( {
        container     : this._mBindMenu,
        style         : _editor._mTemplate.STYLE,
        editor        : _editor,
        onclose       : function() {
            _self._hideMenu( true );
        },
        oninsertcode  : function(code_class, code_style, code_content) {
            if (gIsIE) {
                var _codeContent = "<pre name='code' class='" + code_class + "' style='" + code_style +"'>"
                    + code_content
                    + "</pre>";
                _editor.focus();
                _editor._loadLastRange();
                _editor._mEditDoc.selection.createRange().pasteHTML(_codeContent);
            } else {
                var p = _editor._mEditDoc.createElement("pre");
                p.setAttribute('name','code');
                p.setAttribute('class', code_class);
                p.setAttribute('style', code_style);

                $(p).text(code_content);
                _editor._mEditDoc.execCommand('insertHTML', false, '<p id="tmp_p_id"></p>');
                var d = _editor._mEditDoc.getElementById('tmp_p_id');
                d.parentNode.insertBefore(p,d);
                d.parentNode.insertBefore(_editor._mEditDoc.createElement("br"),d);
                d.parentNode.removeChild(d);

                /*
                _editor._execCmd( "InsertHTML", _codeContent, function() {
                    var _selection = this._mEditDoc.selection;
                    if ( _selection && _selection.type == "Control" ) {
                        var _range = this._mEditDoc.body.createTextRange();
                        _range.moveToElementText( this._mEditDoc.selection.createRange().item( 0 ) );
                        _range.collapse( false );
                        _range.select();
                    }
                } );
                */
            }
            _self._hideMenu( true );
        }
    } );
    this._adjustMenuPos();

    this._mCodePanel.focus();
};

qmEditor.FUNCLIB.Code.prototype._doDefaultShowMenu = function( _aEvent ) {
    if ( this._mCodePanel )
        this._mCodePanel.focus();
};


//flash
qmEditor.FUNCLIB.Flash = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Flash";
    this._mType       = "btn";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -595,
        width  : 20,
        margin : "0",
        title  : "插入Flash"
    };
}, qmEditor.FUNCLIB._BASE );

qmEditor.FUNCLIB.Flash.prototype._doDefaultClick = function( _aEvent ) {
    alert('max default click');
};

//end add by minglin

//Table
qmEditor.FUNCLIB.Table = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Table";
    this._mBindEditor  = _aParamSet.editor;    
    this._mTmplName   = "MENU_TABLE";
    var _editor      = this._mBindEditor;
    var _lang        = _editor._mLanguage;
   
    this._mUiConfig.icon = {
        bgleft : -665,
        width  : 20,
        margin : "0",
        title  : "插入表格"
    };
    //event
    this._onshowmenu = this._doDefaultShowMenu;
}, qmEditor.FUNCLIB._MENUCUSTOM );

qmEditor.FUNCLIB.Table.prototype._doDefaultShowMenu = function( _aEvent ) {
  
};

qmEditor.FUNCLIB.Table.prototype._setMenuElementsEvent = function() {
    var _self = this;

    with( this.menuElements ) {

        fAddEvent( tablePanel.document, "click", function( _aEvent ) {
            _self._doDefaultMenuClick( _aEvent );
        } );

        fAddEvent( tablePanel.document.body, "keydown", function( _aEvent ) {
            if ( _aEvent.keyCode == 27 ) {
                _self._doDefaultMenuClick( {
                    target : cancel
                } );
                fPreventDefault( _aEvent );
            }
            if ( _aEvent.keyCode == 13 ) {
                var _target = _aEvent.target || _aEvent.srcElement;
                _self._doDefaultMenuClick( {
                    target : _target == localInput ? localOk :
                        ( _target == netInput ? netOk : null )
                } );
                fPreventDefault( _aEvent );
            }
        } );

    }
};

qmEditor.FUNCLIB.Table.prototype._setupMenuElements = function() {
    this.menuElements.tablePanel = this._mBindMenu.firstChild.contentWindow;

    var _editor      = this._mBindEditor;

    var _lang        = _editor._mLanguage;
    var _doc         = this.menuElements.tablePanel.document;
    var _template    = _editor._mTemplate;

    _doc.open('text/html','replace');
    _doc.writeln( _template.MENU_TABLE_BODY.replace( {
        style          : _template.STYLE
    } )  );
    _doc.close();

    // ### warning ###
    // after document write ... the charset change to unicode
    // now set it default charset force
    _doc.charset                 = "utf-8";
    var _body                    = _doc.body;

    var _inputs                  = GelTags( "input", _body );
    this.menuElements.rowInput   = _inputs[ 0 ];
    this.menuElements.columnInput= _inputs[ 1 ];

    var _buttons                 = GelTags( "button", _body );
    this.menuElements.confirm    = _buttons[ 0 ];
    this.menuElements.cancel     = _buttons[ 1 ];
    var _fonts                   = GelTags( "font", _body );
    this.menuElements.warning_tip= _fonts[ 0 ];
    
    this._setMenuElementsEvent();
    this._onshowmenu = this._doDefaultShowMenu;
}

qmEditor.FUNCLIB.Table.prototype._doDefaultMenuClick = function( _aEvent ) {
    var _target = _aEvent.target || _aEvent.srcElement;
    var _param  = _target && _target.getAttribute( "param" );
    if ( !_param )
        return;

    var _editor = this._mBindEditor;
    switch( _param ) {
        case "confirm":
            var _row_value = this.menuElements.rowInput.value||0;
            var _column_value = this.menuElements.columnInput.value||0;
            if(_row_value ==0 || _column_value==0) {
                //input error
                this.menuElements.warning_tip.className = '';
            } else {
                if(_row_value > 99) { _row_value = 99;}
                if(_column_value > 99) { _column_value = 99;}
                var _table_html = '<br><table border="1" cellpadding="2" style="border:1px solid #444;border-collapse:collapse">';
                for(var i=0; i<_row_value; i++) {
                    _table_html += '<tr style="height:20px">';
                    for(var j=0; j<_column_value; j++) {
                        _table_html += '<td style="width:50px"></td>';
                    }
                    _table_html += '</tr>';
                }
                _table_html += '</table><br>';

                 if (gIsIE) {
                    _editor.focus();
                    _editor._loadLastRange();
                    _editor._mEditDoc.selection.createRange().pasteHTML(_table_html);
                } else {
                    _editor._execCmd( "InsertHTML", _table_html, function() {
                    var _selection = this._mEditDoc.selection;
                        if ( _selection && _selection.type == "Control" ) {
                            var _range = this._mEditDoc.body.createTextRange();
                            _range.moveToElementText( this._mEditDoc.selection.createRange().item( 0 ) );
                            _range.collapse( false );
                            _range.select();
                        }
                    });
                }
                this._hideMenu( true );
            }
            break;
        case "cancel":
            this._hideMenu( true );
            break;
    }
};

qmEditor.FUNCLIB.Table.prototype._initMenuElements = function() {
    if ( this.menuElements ) return;
    this.menuElements = {};
    if (gIsIE) {
        window['menu_table'] = this;
        this._mBindMenu.firstChild.src = "javascript:void((function(){document.open('text/html','replace');document.domain=\'"+document.domain+"\';document.close(); parent.window['menu_table']._setupMenuElements();})())";
    } else {
        this._setupMenuElements();
    }
};

//setup...
( function() {
    var _editorSet = qmEditor.getEditorSet();
    for ( var i in _editorSet )
        try { _editorSet[ i ]._setupFunction(); } catch( e ) { debug( [ "etp", i, e.message ] ); }
} )();
