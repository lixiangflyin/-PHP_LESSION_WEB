<?php
/**
PHP extract() 函数从数组中把变量导入到当前的符号表中。
对于数组中的每个元素，键名用于变量名，键值用于变量值。
第二个参数 type 用于指定当某个变量已经存在，而数组中又有同名元素时，extract() 函数如何对待这样的冲突。
本函数返回成功设置的变量数目。

extract() + ob_buffer 常见于PHP页面模板

如: template.php:

<html>
<head>
<title><?php echo $page_title;?></title>
<link rel="stylesheet" href="<?php echo $css_file;?>" />
<body>
<?php echo $content;?>
...

1:将 $page_title,$css_file,$content 利用 extract() 添加作为局部变量
2:打开ob_buffer
3:include template.php; 来执行代码
4:取出ob_buffer里的内容
 */

$var_array = array('name' => 'jack','age' => 18, 'path' => 'xxx');

//将$var_array里的变量 导入到当前作用域的 符号表中, 简单地说就是添加为局部变量
extract($var_array);

echo $name;
echo $age;
echo $path;