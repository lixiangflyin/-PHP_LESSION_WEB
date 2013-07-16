<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2013-07-16 11:01:36 中国标准时间 */ ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $this->_vars['title']; ?>
</title>
</head>
<body>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("content.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</body>
</html>