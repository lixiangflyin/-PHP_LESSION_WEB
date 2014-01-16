// qmEditor function file : base func
// author : angusdu
// date   : 2008-7-20

qmEditor.CONST._extend( qmEditor.CONST.LANGUAGE.zh_CN,  {
    FUN_SEPERATE     : "间隔线",
    FUN_BOLD         : "加粗",
    FUN_ITALIC       : "斜体",
    FUN_UNDERLINE    : "下划线",
    FUN_FONTNAME     : "选择字体",
    FUN_FONTSIZE     : "选择字体大小",
    FUN_FORECOLOR    : "选择字体颜色",
    FUN_BACKCOLOR    : "选择背景颜色",
    FUN_ALIGNMODE    : "选择对齐方式",
    FUN_SERIAL       : "设置编号",
    FUN_INDENT       : "设置缩进",
    FUN_CREATELINK   : "插入/移除链接",
    FUN_SOURCEEDIT   : "编辑HTML源码",

    FS_XXSMALL       : "小",
    FS_XSMALL        : "中",
    FS_MEDIUM        : "大",
    FS_LARGE         : "较大",
    FS_XLARGE        : "最大",

    AM_LEFT          : "左对齐",
    AM_CENTER        : "居中对齐",
    AM_RIGHT         : "右对齐",

    SL_NUMBER        : "数字编号",
    SL_PROJECT       : "项目编号",

    IT_INDENT        : "向右缩进",
    IT_OUTDENT       : "向左缩进",

    CL_NAME          : "文字：",
    CL_LINK          : "链接：",
    CL_MODIFY        : "修改",
    CL_DELETE        : "移除",
    CL_CONFIRM       : "添加",
    CL_CANCEL        : "取消",
    CL_NAME_DEF      : "默认使用链接名字",

    SE_PREVIEW       : "返回可视化编辑",
    SE_PREVIEW_TITLE : "所见即所得",
    SE_FORMAT        : "格式化",
    SE_FORMAT_TITLE  : "代码格式化",
    SE_FORMATTING    : "正在格式化，请不要修改代码..."
} );

qmEditor.CONST._extend( qmEditor.CONST.LANGUAGE.en_US,  {
    FUN_SEPERATE     : "Separation line",
    FUN_BOLD         : "Bold",
    FUN_ITALIC       : "Italics",
    FUN_UNDERLINE    : "Underline",
    FUN_FONTNAME     : "Select font",
    FUN_FONTSIZE     : "选择字体大小",
    FUN_FORECOLOR    : "选择字体颜色",
    FUN_BACKCOLOR    : "选择背景颜色",
    FUN_ALIGNMODE    : "选择对齐方式",
    FUN_SERIAL       : "设置编号",
    FUN_INDENT       : "设置缩进",
    FUN_CREATELINK   : "Add/Remove HyperLink",
    FUN_SOURCEEDIT   : "Edit the HTML source code",

    FS_XXSMALL       : "small",
    FS_XSMALL        : "medium",
    FS_MEDIUM        : "big",
    FS_LARGE         : "Large",
    FS_XLARGE        : "Maximum",

    AM_LEFT          : "Left alignment",
    AM_CENTER        : "Align center",
    AM_RIGHT         : "Right alignment",

    SL_NUMBER        : "Number",
    SL_PROJECT       : "Item number",

    IT_INDENT        : "Right indent",
    IT_OUTDENT       : "Left indent",

    CL_NAME          : "Wording:",
    CL_LINK          : "Hyperlink:",
    CL_MODIFY        : "Change",
    CL_DELETE        : "Remove",
    CL_CONFIRM       : "Add",
    CL_CANCEL        : "Cancel",
    CL_NAME_DEF      : "Use hyperlink as default name",

    SE_PREVIEW       : "Preview",
    SE_PREVIEW_TITLE : "Effect of preview",
    SE_FORMAT        : "Format",
    SE_FORMAT_TITLE  : "Code format",
    SE_FORMATTING    : "Formatting,Pls don' change the code"
} );


qmEditor.CONST._extend( qmEditor.CONST._TEMPLATE, {
    MENU_COLOR       : T( [
    '<div class="qmEditorMenuItem" param="$color$" title="$color$" style="float:left;width:auto;height:auto;" unselectable="on" $event$ >',
        '<div class="qmEditorMenuColor" param="$color$" style="background:$color$;" unselectable="on"></div>',
    '</div>'
    ] ),
    MENU_BREAKLINE   : T( [
    '<br style="clear:both;">'
    ] ),
    MENU_SELECT_ITEM : T( [
    '<b>&#187;</b>&nbsp;$content$'
    ] ),
    MENU_ICON_ITEM   : T( [
    '<div class="qmEditorMenuItem" cmd="$cmd$" style="$style$;" title="$title$" unselectable="on" $event$ >',
        '<div class="qmEditorMenuIcon" cmd="$cmd$" style="float:left;background:url($path$images/editoricon.gif?r=2) $bgleft$px 0;width:$width$px;margin:$margin$;" unselectable="on"></div>',
        '&nbsp;<span cmd="$cmd$" unselectable="on">$content$</span>',
    '</div>'
    ] ),
    MENU_CREATELINK  : T( [
    '<div class="qmEditorMenuPanel" unselectable="on" >',
        '<div class="qmEditorLinkDiv" unselectable="on" >',
            '$langName$<input param="name" type="text" onmousedown="top.fStopPropagation(event);" > ',
        '</div>',
        '<div class="qmEditorLinkDiv" unselectable="on" >',
            '$langLink$<input param="link" type="text" onmousedown="top.fStopPropagation(event);" />',
        '</div>',
        '<div class="qmEditorLinkButton" unselectable="on" >',
            '<button param="modify" class="qmEditorButton1 qmEditorLinkBtn" unselectable="on" >$langModify$</button>',
            '<button param="delete" class="qmEditorButton1 qmEditorLinkBtn" unselectable="on" >$langDelete$</button>',
            '<button param="confirm" class="qmEditorButton1 qmEditorLinkBtn" unselectable="on" >$langConfirm$</button>',
            '<button param="cancel" class="qmEditorButton1 qmEditorLinkBtn" unselectable="on" >$langCancel$</button>',
        '</div>',
    '</div>'
    ] ),
    BOTTON_ICON_SOURCEEDIT : T( [
    '<div class="qmEditorBtnA" style="$style$;padding-left:0;" ',
        ' unselectable="on" onmousedown="return false;" title="$title$" >&lt;HTML&gt;</div>'
    ] ),
    SOURCEEDIT_TOOLBAR     : T( [
    '<div class="qmEditorBtnA" style="float:right;padding:2px 5px 0 0;* padding:3px 5px 0 0;" unselectable="on" onmousedown="return false;" title="$formatTitle$" >',
        '<span style="display:none;">',
            '$langFormatting$<span></span>',
        '</span>',
        '<span>$langFormat$</span>',
    '</div>',
    '<div class="qmEditorBtnA qmEditorFormatBtn" unselectable="on" onmousedown="return false;" title="$previewTitle$" >',
        '$langPreview$<b>&#187;</b>',
    '</div>'
    ] )
} );

qmEditor.CONST._COLORS = [
    '#000000 #993300 #333300 #003300 #003366 #000080 #333399 #333333',
    '#800000 #FF6600 #808000 #008000 #008080 #0000FF #666699 #808080',
    '#FF0000 #FF9900 #99CC00 #339966 #33CCCC #3366FF #800080 #999999',
    '#FF00FF #FFCC00 #FFFF00 #00FF00 #00FFFF #00CCFF #993366 #C0C0C0',
    '#FF99CC #FFCC99 #FFFF99 #CCFFCC #CCFFFF #99CCFF #CC99FF #FFFFFF'
];

//expend editor method

qmEditor.prototype._isCollapsed = function() {
    return this._mEditWin.getSelection ? this._mEditWin.getSelection().getRangeAt( 0 ).collapsed : this._mEditDoc.selection.type == "None";
};

qmEditor.prototype._getSelectionElement = function() {
    var _node, _s = this._mEditDoc.selection;

    if ( _s ) {
        var _r = _s.createRange();
        if ( _s.type == "Control" ) {
            for ( i = 0, _len = _r.length; i < _len; i++ )
                if ( _r( i ).parentNode ) {
                    _node = _r( i ).parentNode;
                    break ;
                }
        }
        else {
            _node = _r.parentElement();
        }
    }
    else {
        var _r = this._mEditWin.getSelection().getRangeAt( 0 );

        if ( !( _r.startContainer != _r.endContainer || _r.startContainer.nodeType != 1 || _r.startOffset != _r.endOffset - 1 ) ) {
            _node = _r.startContainer.childNodes[ _r.startOffset ];
            if ( _node.nodeType != 1 )
                _node = null;
        }

        if ( !_node )
            _node = _r.endContainer;
    }

    return _node;
};

qmEditor.prototype._moveToAncestorNode = function( _aNodeTagName ) {
    var _node = this._getSelectionElement();

    while ( _node && _node.nodeName != _aNodeTagName )
        _node = _node.parentNode;

    return _node;
};

qmEditor.prototype._hasAncestorNode = function( _aNodeTagName ) {
    var _node = this._getSelectionElement();
    var _test = _node;

    while ( _test && _test.nodeName != _aNodeTagName )
        _test = _test.parentNode;

    if ( _test )
        return true;

    if ( this._isCollapsed() )
        return false;

    ( function( _n ) {
        if ( !_n )
            return ;

        if ( _n.nodeName == _aNodeTagName ) {
            _test = _n;
            return ;
        }

        for ( var _curNode = _n.firstChild, _nextNode; _curNode; _curNode = _nextNode ) {
            _nextNode = _curNode.nextSibling;
            arguments.callee( _curNode );
        }
    } )( _node.parentNode );

    return _test ? true : false;
};

qmEditor.prototype._changeEditMode = function( _aEditMode ) {
    if ( this._mEditMode == "text" )
        return false;

    if ( this._mEditMode == _aEditMode )
        return true;

    var _isCode = _aEditMode == "source";
    _aEditMode  = _isCode ? "source" : "html";

    this._mEditObj.style.display  = _isCode ? "none" : "block";
    this._mSrceBody.style.display = _isCode ? "block" : "none";

    Show( this._mRichToolBarObj, !_isCode );
    Show( this._mSrceToolBarObj, _isCode  );

    this._setEditContent( _aEditMode, this._getEditContent( _isCode ? "html" : "source" ) );

    this._mEditMode = _aEditMode;
    if (!gIsIE) {
        this.focus( 0 );
    }

};

//// func base class ////

//MENU STATUS
qmEditor.FUNCLIB._MENUSTATUS = qmEditor.FUNCLIB._inheritFrom( function() {
    this._mId       = "MENUSTATUS";
    this._mType     = "menu";
    //event
    this._onshowmenu = this._doDefaultShowMenu;
}, qmEditor.FUNCLIB._BASE );

qmEditor.FUNCLIB._MENUSTATUS.prototype._doDefaultShowMenu = function( _aEvent ) {
    var _value = this._mBindEditor._queryCmdValue( this._mCmd );
    if ( typeof( _value ) != "string" && typeof( _value ) != "number" )
        //return ;
        _value = "";

    var _tmp   = this._mBindEditor._mTemplate.MENU_SELECT_ITEM;
    var _nodes = this._mBindMenu.childNodes;

    _value = _value.toString().toUpperCase();

    for ( var i = 0, _len = _nodes.length; i < _len; i++ ) {
        var _node    = _nodes[ i ];
        var _param   = _node.getAttribute( "param" ).toUpperCase();
        var _content = this._mParamSet[ _param ].content;

        var _clsName = _value == _param ? "qmEditorMenuItemCheck" : "qmEditorMenuItem";
        if ( _node.className != _clsName ) {
            _node.className = _clsName;
            _node.setAttribute( "curclass", _clsName );
        }

        _node.innerHTML = _value == _param ? _tmp.replace( {
            content : _content
        } ) : _content;
    }
};

//MENU COLOR
qmEditor.FUNCLIB._MENUCOLOR = qmEditor.FUNCLIB._inheritFrom( function() {
    this._mId        = "MENUCOLOR";
    this._mType      = "menu";
    //menu data
    this._mMenuData  = qmEditor.CONST._COLORS;
    //event
    this._onshowmenu = this._doDefaultShowMenu;
}, qmEditor.FUNCLIB._BASE );

qmEditor.FUNCLIB._MENUCOLOR.prototype._doDefaultShowMenu = function( _aEvent ) {
    var _value = this._mBindEditor._queryCmdValue( this._mCmd );

    if ( typeof( _value ) == "string" ) {
        _value = _value.substring( 4, _value.length - 1 ).split( "," );
        for ( var i = 0, _len = _value.length; i < _len; i++ ) {
            _value[ i ] = parseInt( Trim( _value[ i ] ) ).toString( 16 );
            if ( _value[ i ].length == 1 )
                _value[ i ] = "0" + _value[ i ];
        }
        _value = _value.join( "" );
    }
    else if ( typeof( _value ) == "number" ) {
        _value = [ _value.toString( 16 ) ];
        for ( var i = 0, _len = 6 - _value[ 0 ].length ; i < _len; i++ )
            _value.unshift( "0" );
        _value      = _value.join( "" ).split( "" );
        var _tmp    = _value[ 0 ];
        _value[ 0 ] = _value[ 4 ];
        _value[ 4 ] = _tmp;
        _tmp        = _value[ 1 ];
        _value[ 1 ] = _value[ 5 ];
        _value[ 5 ] = _tmp;
        _value      = _value.join( "" );
    }
    else {
        return ;
    }

    _value     = "#" + _value;
    var _tmp   = this._mBindEditor._mTemplate.MENU_SELECT_ITEM;
    var _nodes = this._mBindMenu.childNodes;
    for ( var i = 0, _len = _nodes.length, _value = _value.toString().toUpperCase(); i < _len; i++ ) {
        var _node    = _nodes[ i ];
        var _param   = _node.getAttribute( "param" );

        if ( !_param )
            continue;

        var _clsName = _value == _param ? "qmEditorMenuItemCheck" : "qmEditorMenuItem";
        if ( _clsName != _node.className ) {
            _node.className = _clsName;
            _node.setAttribute( "curclass", _clsName );
        }
    }
};

qmEditor.FUNCLIB._MENUCOLOR.prototype._getMenuUI = function() {
    var _editor = this._mBindEditor;
    var _defTmp = _editor._mTemplate.MENU_COLOR;

    var _html   = [];
    for ( var i = 0, len1 = this._mMenuData.length; i < len1; i++ ) {
        var _datas = this._mMenuData[ i ].split( " " );
        for ( var j = 0, len2 = _datas.length; j < len2; j++ ) {
            _html.push( _defTmp.replace( {
                color : _datas[ j ],
                event : _editor._mTemplate.MENU_ITEM_EVENT
            } ) );
        }
        _html.push( _editor._mTemplate.MENU_BREAKLINE );
    }

    _html.push( this._getExternMenuInnerHTML() );

    return _html.join( "" );
};

qmEditor.FUNCLIB._MENUCOLOR.prototype._getExternMenuInnerHTML = function() {
    var _editor = this._mBindEditor;
    var _defTmp = _editor._mTemplate.MENU_COLOR;

    var _html   = [];
    for ( var i = 0, _len = ( this.menuExternData || "" ).length; i < _len; i++ ) {
    }

    return _html.join( "" );
};

//MENU ICON
qmEditor.FUNCLIB._MENUICON = qmEditor.FUNCLIB._inheritFrom( function() {
    this._mId         = "MENUICON";
    this._mType       = "menu";
    this._mTmplName   = "MENU_ICON_ITEM";
}, qmEditor.FUNCLIB._BASE );

//MENU ICON STATUS
qmEditor.FUNCLIB._MENUICONSTATUS = qmEditor.FUNCLIB._inheritFrom( function() {
    this._mId         = "MENUICONSTATUS";
    //event
    this._onshowmenu = this._doDefaultShowMenu;
}, qmEditor.FUNCLIB._MENUICON );

qmEditor.FUNCLIB._MENUICONSTATUS.prototype._doDefaultShowMenu = function( _aEvent ) {
    var _tmp   = this._mBindEditor._mTemplate.MENU_SELECT_ITEM;
    var _nodes = this._mBindMenu.childNodes;
    for ( var i = 0, _len = _nodes.length; i < _len; i++ ) {
        var _node    = _nodes[ i ];
        var _content = this._mMenuData[ i ].content;
        var _cmd     = _node.getAttribute( "cmd" );
        var _value   = this._getCmdValue( _cmd );

        if ( typeof( _value ) != "boolean" )
            continue;

        var _clsName = _value ? "qmEditorMenuItemCheck" : "qmEditorMenuItem";

        if ( _clsName != _node.className ) {
            _node.className = _clsName;
            _node.setAttribute( "curclass", _clsName );
        }

        _node.lastChild.innerHTML = _value ? _tmp.replace( {
            content : _content
        } ) : _content;
    }
};

qmEditor.FUNCLIB._MENUICONSTATUS.prototype._getCmdValue = function( _aCmd ) {
    return this._mBindEditor._queryCmdState( _aCmd );
};

//MENU ICON DISABLE
qmEditor.FUNCLIB._MENUICONDISABLE = qmEditor.FUNCLIB._inheritFrom( function() {
    this._mId        = "MENUICONDISABLE";
    //event
    this._onshowmenu = this._doDefaultShowMenu;
}, qmEditor.FUNCLIB._MENUICON );

qmEditor.FUNCLIB._MENUICONDISABLE.prototype._doDefaultShowMenu = function( _aEvent ) {
    var _nodes = this._mBindMenu.childNodes;
    for ( var i = 0, _len = _nodes.length; i < _len; i++ ) {
        var _node    = _nodes[ i ];
        var _cmd     = _node.getAttribute( "cmd" );
        //bug : in ie fail
        var _value   = this._mBindEditor._queryCmdEnabled( _cmd );

        var _clsName = _value ? "qmEditorMenuItem" : "qmEditorMenuItemDisabled";
        if ( _clsName != _node.className ) {
            _node.className = _clsName;
            _node.setAttribute( "curclass", _clsName );
        }
    }
};

//// funcs ////

//Separate
qmEditor.FUNCLIB.Separate = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Separate";
    this._mType       = "label";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -320,
        width  : 3,
        margin : "-1px 3px 0 2px",
        title  : this._mBindEditor._mLanguage.FUN_SEPERATE
    };
}, qmEditor.FUNCLIB._BASE );

//Bold
qmEditor.FUNCLIB.Bold = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Bold";
    this._mType       = "btn";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : 0,
        width  : 19,
        margin : "0",
        title  : this._mBindEditor._mLanguage.FUN_BOLD
    };

    //event
    this._onkeydown = function( _aEvent ) {
        if ( _aEvent.ctrlKey && _aEvent.keyCode == 66 ) {
            this._doDefaultClick();
            fPreventDefault( _aEvent );
        }
    };
}, qmEditor.FUNCLIB._BASE );

//Italic
qmEditor.FUNCLIB.Italic = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "Italic";
    this._mType       = "btn";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig = {};
    this._mUiConfig.icon = {
        bgleft : -20,
        width  : 20,
        margin : "0",
        title  : this._mBindEditor._mLanguage.FUN_ITALIC
    };

    //event
    this._onkeydown = function( _aEvent ) {
        if ( _aEvent.ctrlKey && _aEvent.keyCode == 73 ) {
            this._doDefaultClick();
            fPreventDefault( _aEvent );
        }
    };
}, qmEditor.FUNCLIB._BASE );

//Underline
qmEditor.FUNCLIB.Underline = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId        = "Underline";
    this._mType      = "btn";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -40,
        width  : 20,
        margin : "0",
        title  : this._mBindEditor._mLanguage.FUN_UNDERLINE
    };

    //event
    this._onkeydown = function( _aEvent ) {
        if ( _aEvent.ctrlKey && _aEvent.keyCode == 85 ) {
            this._doDefaultClick();
            fPreventDefault( _aEvent );
        }
    };
}, qmEditor.FUNCLIB._BASE );

//FontName
qmEditor.FUNCLIB.FontName = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "FontName";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -60,
        width  : 20,
        margin : "0 2px",
        title  : this._mBindEditor._mLanguage.FUN_FONTNAME
    };
    //menu data
    this._mMenuData = [ {
        param   : "宋体",
        style   : "font-family:宋体",
        content : "宋体"
    }, {
        param   : "黑体",
        style   : "font-family:黑体",
        content : "黑体"
    }, {
        param   : "楷体_GB2312",
        style   : "font-family:楷体_GB2312",
        content : "楷书"
    }, {
        param   : "幼圆",
        style   : "font-family:幼圆",
        content : "幼圆"
    }, {
        param   : "Arial",
        style   : "font-family:Arial",
        content : "Arial"
    }, {
        param   : "Arial Black",
        style   : "font-family:Arial Black;",
        content : "Arial Black"
    }, {
        param   : "Times New Roman",
        style   : "font-family:Times New Roman",
        content : "Times New Roman"
    }, {
        param   : "Verdana",
        style   : "font-family:Verdana",
        content : "Verdana"
    } ];
}, qmEditor.FUNCLIB._MENUSTATUS );

//FontSize
qmEditor.FUNCLIB.FontSize = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    var _language    = _aParamSet.editor._mLanguage;
    this._mId         = "FontSize";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -80,
        width  : 21,
        margin : "0 2px",
        title  : _language.FUN_FONTSIZE
    };
    //menu data
    this._mMenuData = [ {
        param   : "1",
        style   : "font-size:xx-small;",
        content : _language.FS_XXSMALL
    }, {
        param   : "2",
        style   : "font-size:x-small;",
        content : _language.FS_XSMALL
    }, {
        param   : "4",
        style   : "font-size:medium;",
        content : _language.FS_MEDIUM
    }, {
        param   : "5",
        style   : "font-size:large;line-height:28px;height:26px;",
        content : _language.FS_LARGE
    }, {
        param   : "6",
        style   : "font-size:x-large;line-height:36px;height:34px;",
        content : _language.FS_XLARGE
    }];
}, qmEditor.FUNCLIB._MENUSTATUS );

//ForeColor
qmEditor.FUNCLIB.ForeColor = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "ForeColor";
    this._mBindEditor = _aParamSet && _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -240,
        width  : 20,
        margin : "0 2px",
        title  : this._mBindEditor && this._mBindEditor._mLanguage.FUN_FORECOLOR
    };
}, qmEditor.FUNCLIB._MENUCOLOR );

//BackColor
qmEditor.FUNCLIB.BackColor = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId         = "BackColor";
    this._mCmd        = gIsIE || gIsSafari ? this._mId : "hilitecolor";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -260,
        width  : 20,
        margin : "0 2px",
        title  : this._mBindEditor._mLanguage.FUN_BACKCOLOR
    };
}, qmEditor.FUNCLIB._MENUCOLOR );

//AlignMode
qmEditor.FUNCLIB.AlignMode = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    var _language    = _aParamSet.editor._mLanguage;
    this._mId         = "AlignMode";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -427,
        width  : 21,
        margin : "0 4px 0 0",
        title  : _language.FUN_ALIGNMODE
    };
    //menu data
    this._mMenuData = [ {
        bgleft  : -100,
        cmd     : "justifyleft",
        content : _language.AM_LEFT
    }, {
        bgleft  : -120,
        cmd     : "justifycenter",
        content : _language.AM_CENTER
    }, {
        bgleft  : -140,
        cmd     : "justifyright",
        content : _language.AM_RIGHT
    }];
}, qmEditor.FUNCLIB._MENUICONSTATUS );

//Serial
qmEditor.FUNCLIB.Serial = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    var _language    = _aParamSet.editor._mLanguage;
    this._mId         = "Serial";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -449,
        width  : 22,
        margin : "0 4px 0 0",
        title  : _language.FUN_SERIAL
    };
    //menu data
    this._mMenuData = [ {
        bgleft  : -160,
        cmd     : "insertorderedlist",
        content : _language.SL_NUMBER
    }, {
        bgleft  : -180,
        cmd     : "insertunorderedlist",
        content : _language.SL_PROJECT
    } ];
}, qmEditor.FUNCLIB._MENUICONSTATUS );

//Indent
qmEditor.FUNCLIB.Indent = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    var _language    = _aParamSet.editor._mLanguage;
    this._mId         = "Indent";
    this._mBindEditor = _aParamSet.editor;
    this._mUiConfig.icon = {
        bgleft : -470,
        width  : 22,
        margin : "0 4px 0 0",
        title  : _language.FUN_INDENT
    };
    //menu data
    this._mMenuData = [ {
        bgleft  : -220,
        cmd     : "indent",
        content : _language.IT_INDENT
    }, {
        bgleft  : -200,
        cmd     : "outdent",
        content : _language.IT_OUTDENT
    } ];
}, qmEditor.FUNCLIB._MENUICONDISABLE );

//CreateLink
qmEditor.FUNCLIB.CreateLink = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId          = "CreateLink";
    this._mType        = "menu";
    this._mIsSaveRange = true;
    this._mBindEditor  = _aParamSet.editor;
    this._mTmplName    = "MENU_CREATELINK";

    var _language      = this._mBindEditor._mLanguage;

    this._mUiConfig.icon = {
        bgleft : -280,
        width  : 22,
        margin : "0 4px 0 0",
        title  : _language.FUN_CREATELINK
    };

    //menu data
    this._mMenuData = [ {
        langName    : _language.CL_NAME,
        langLink    : _language.CL_LINK,
        langModify  : _language.CL_MODIFY,
        langDelete  : _language.CL_DELETE,
        langConfirm : _language.CL_CONFIRM,
        langCancel  : _language.CL_CANCEL
    } ];

    //event
    this._onshowmenu = this._doDefaultShowMenu;
}, qmEditor.FUNCLIB._BASE );


qmEditor.FUNCLIB.CreateLink.prototype._filterElement = function( _aElements, _aAttr, _aValue ) {
    for ( var i = 0, _len = _aElements.length; i < _len; i++ )
        if ( _aElements[ i ].getAttribute( _aAttr ) == _aValue )
            return _aElements[ i ];
    return null;
};

qmEditor.FUNCLIB.CreateLink.prototype._initMenuElements = function() {
    var _inputs  = GelTags( "input" , this._mBindMenu )
    var _buttons = GelTags( "button", this._mBindMenu );
    this.menuElements = {
        nameText   : this._filterElement( _inputs , "param", "name"    ),
        linkText   : this._filterElement( _inputs , "param", "link"    ),
        modifyBtn  : this._filterElement( _buttons, "param", "modify"  ),
        deleteBtn  : this._filterElement( _buttons, "param", "delete"  ),
        confirmBtn : this._filterElement( _buttons, "param", "confirm" ),
        cancelBtn  : this._filterElement( _buttons, "param", "cancel"  )
    };

    with( this.menuElements ) {
        var _self          = this;
        var _language      = this._mBindEditor._mLanguage;
        nameText.className = "qmEditorCLNameDef";
        nameText.value     = _language.CL_NAME_DEF;
        nameText.onfocus   = function() {
            if ( this.className == "qmEditorCLNameMdf" )
                return ;
            this.className = "qmEditorCLNameMdf";
            this.value     = "";
        };
        nameText.onblur    = function() {
            if ( this.value != "" )
                return ;
            this.className = "qmEditorCLNameDef";
            this.value     = _language.CL_NAME_DEF;
        };
        fAddEvent( nameText, "keydown", function( _aEvent ) {
            if ( _aEvent.keyCode == 13 )
                fPreventDefault( _aEvent );

            if ( _aEvent.keyCode == 27 ) {
                _self._doDefaultMenuClick( {
                    target : cancelBtn
                } );
                fPreventDefault( _aEvent );
            }
        } );


        fAddEvent( linkText, "keydown", function( _aEvent ) {
            if ( _aEvent.keyCode == 13 ) {
                _self._doDefaultMenuClick( {
                    target : IsShow( confirmBtn ) ? confirmBtn : modifyBtn
                } );
                fPreventDefault( _aEvent );
            }
            if ( _aEvent.keyCode == 27 ) {
                _self._doDefaultMenuClick( {
                    target : cancelBtn
                } );
                fPreventDefault( _aEvent );
            }
        } );
    }
};

qmEditor.FUNCLIB.CreateLink.prototype._setMenuElementAttr = function() {
    with( this.menuElements ) {
        Show( nameText.parentNode, !this.enabledUnlink && this.isCollapsed );
        Show( linkText.parentNode, !( this.enabledUnlink && !this.oLink )  );
        Show( modifyBtn , this.oLink          );
        Show( deleteBtn , this.enabledUnlink  );
        Show( confirmBtn, !this.enabledUnlink );

        linkText.value = ( this.oLink && this.oLink.href ) || "";
        if ( IsShow( linkText.parentNode ) ) {
            linkText.focus();
            linkText.select();
        }
    }
};

qmEditor.FUNCLIB.CreateLink.prototype._doDefaultShowMenu = function( _aEvent ) {
    var _editor        = this._mBindEditor;
    var _editorWin     = _editor._mEditWin;

    this.enabledUnlink = _editor._queryCmdEnabled( "Unlink" ) && _editor._hasAncestorNode( "A" );
    this.oLink         = this.enabledUnlink && _editor._moveToAncestorNode( "A" );
    this.isCollapsed   = _editor._isCollapsed();

    this._setMenuElementAttr();
};

qmEditor.FUNCLIB.CreateLink.prototype._doDefaultMenuClick = function( _aEvent ) {
    var _target = _aEvent.target || _aEvent.srcElement;
    var _param  = _target && _target.getAttribute( "param" );
    var _editor = this._mBindEditor;

    switch( _param ) {
    case "delete":
        this._hideMenu( true );
        _editor._execCmd( "Unlink" );
        break;
    case "modify":
        this._hideMenu( true );
        this.oLink.href = this._getLinkText();
        break;
    case "confirm":
        this._hideMenu( true );
        if ( this.isCollapsed ) {
            if ( _editor._mEditDoc.selection ) {
                _editor._mEditDoc.selection.createRange().pasteHTML( T( '<a href="$url$" >$name$</a>' ).replace( {
                    url  : this._getLinkText(),
                    name : this._getNameText()
                } ) );
            }
            else {
                var _r       = _editor._mEditWin.getSelection().getRangeAt( 0 );
                var _a       = _editor._mEditDoc.createElement( "a" );
                _a.href      = this._getLinkText();
                _a.innerHTML = this._getNameText();

                _r.insertNode( _a );
                _r.setStartAfter( _a );
            }
        }
        else {
            _editor._execCmd( this._mCmd, this._getLinkText() );
        }
        break;
    case "cancel" :
        this._hideMenu( true );
        break;
    }
};

qmEditor.FUNCLIB.CreateLink.prototype._getLinkText = function() {
    var _link = this.menuElements.linkText.value;
    //identify mailto
    if ( /[a-zA-Z_0-9.-]+@[a-zA-Z_0-9.-]+\.\w+/.test( _link ) )
        return Trim( _link ).toLowerCase().indexOf( "mailto" ) == 0 ? _link : "mailto:" + _link;
    //identify url
    return Trim( _link ).indexOf( "://" ) == -1 ? "http://" + _link : _link;
};

qmEditor.FUNCLIB.CreateLink.prototype._getNameText = function() {
    var _nameText = this.menuElements.nameText;
    return _nameText.className == "qmEditorCLNameDef" ? this._getLinkText() : _nameText.value || this._getLinkText();
};

//SourceEdit
qmEditor.FUNCLIB.SourceEdit = qmEditor.FUNCLIB._inheritFrom( function( _aParamSet ) {
    this._mId   = "SourceEdit";
    this._mType = "custom";
    this._mBindEditor  = _aParamSet.editor;

    var _language      = this._mBindEditor._mLanguage;
    this._mUiConfig.icon          = {
        title          : _language.FUN_SOURCEEDIT
    };
    this._mUiConfig.sourceToolBar = {
        formatTitle    : _language.SE_FORMAT_TITLE,
        langFormat     : _language.SE_FORMAT,
        previewTitle   : _language.SE_PREVIEW_TITLE,
        langPreview    : _language.SE_PREVIEW,
        langFormatting : _language.SE_FORMATTING
    };

    //event
    this._onclick    = this._doDefaultClick;

}, qmEditor.FUNCLIB._BASE );

qmEditor.FUNCLIB.SourceEdit.prototype._setMouseOverEvent = function( _aUiType ) {};

qmEditor.FUNCLIB.SourceEdit.prototype._doDefaultClick = function( _aEvent ) {
    this._setupSourceToolBar();
    this._mBindEditor.hideMenu();
    this._mBindEditor._changeEditMode( "source" );
};

qmEditor.FUNCLIB.SourceEdit.prototype._setupSourceToolBar = function() {
    var _srceToolBarObj = this._mBindEditor._mSrceToolBarObj;

    if ( _srceToolBarObj.getAttribute( "setuped" ) == "true" )
        return false;

    _srceToolBarObj.innerHTML = this._mBindEditor._mTemplate.SOURCEEDIT_TOOLBAR.replace( this._mUiConfig.sourceToolBar );

    _srceToolBarObj.setAttribute( "setuped", "true" );

    this._setSourceToolBarEvent();
};

qmEditor.FUNCLIB.SourceEdit.prototype._setSourceToolBarEvent = function() {
    var _formatObj  = this._mBindEditor._mSrceToolBarObj.firstChild;
    var _previewObj = _formatObj.nextSibling;
    var _self       = this;

    _previewObj.onclick = function() {
        if ( _self.waitLoadTimer )
            clearInterval( _self.waitLoadTimer );
        _self._mBindEditor._changeEditMode( "html" );
    };

    _formatObj.onclick = function() {
        _self._formatCode();
    };
};

qmEditor.FUNCLIB.SourceEdit.prototype._formatCode = function() {
    var _self   = this;
    var _editor = this._mBindEditor;

    if ( !window.Formatter ) {
        _editor._loadFile( {
            "plus/formatter.js" : true
        } );

        if ( this.waitLoadTimer )
            return ;

        this.waitLoadTimer = setInterval( function() {
            _self._formatCode();
        }, 500 );

        return;
    }

    if ( this.waitLoadTimer )
        clearInterval( this.waitLoadTimer );

    var _formatObj  = _editor._mSrceToolBarObj.firstChild;
    var _runObj     = _formatObj.firstChild;
    var _sizeObj    = _runObj.lastChild;
    var _btnObj     = _formatObj.lastChild;

    Show( _runObj, true  );
    Show( _btnObj, false );

    _formatObj.className = "qmEditorFormatting";
    _sizeObj.innerHTML   = "0%";

    var _fFinishFunc = function( _aResult ) {
        _editor._setEditContent( "source", _aResult );

        Show( _runObj, false  );
        Show( _btnObj, true );

        _formatObj.className = "qmEditorBtnA";
    };

    var _fProcessFunc = function( _aProcessInfo ) {
        _sizeObj.innerHTML = _aProcessInfo;
    }

    window.Formatter.format( _editor._getEditContent( "source" ), _fFinishFunc, _fProcessFunc );

};

//setup...
( function() {
    var _editorSet = qmEditor.getEditorSet();
    for ( var i in _editorSet )
        try { _editorSet[ i ]._setupFunction(); } catch( e ) { debug( [ "etp", i, e.message ] ); }
} )();