<?php /* Smarty version Smarty-3.1.14, created on 2013-07-11 06:24:35
         compiled from ".\templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1906151de4c4b68bf71-93676567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06f2fd8d9a960ed1fa3c26ccfad67689d23fc229' => 
    array (
      0 => '.\\templates\\index.html',
      1 => 1373523870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1906151de4c4b68bf71-93676567',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_51de4c4b74b1f4_99920007',
  'variables' => 
  array (
    'users' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51de4c4b74b1f4_99920007')) {function content_51de4c4b74b1f4_99920007($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>

<ul>
<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
	<li><?php echo $_smarty_tpl->tpl_vars['user']->value;?>
</li>
<?php } ?>
</ul>
</body>
</html><?php }} ?>