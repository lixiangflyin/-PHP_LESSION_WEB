<?php
/**
服务器端包含 (SSI) 用于创建可在多个页面重复使用的函数、页眉、页脚或元素。
PHP include 和 require 语句
在 PHP 中，您能够在服务器执行 PHP 文件之前把该文件插入另一个 PHP 文件中。
include 和 require 语句用于在执行流中向其他文件插入有用的的代码。
include 和 require 很相似，除了在错误处理方面的差异：
require 会产生致命错误 (E_COMPILE_ERROR)，并停止脚本
include 只会产生警告 (E_WARNING)，脚本将继续
因此，如果您希望继续执行，并向用户输出结果，即使包含文件已丢失，那么请使用 include。否则，在框架、CMS 或者复杂的 PHP 应用程序编程中，请始终使用 require 向执行流引用关键文件。这有助于提高应用程序的安全性和完整性，在某个关键文件意外丢失的情况下。
包含文件省去了大量的工作。这意味着您可以为所有页面创建标准页头、页脚或者菜单文件。然后，在页头需要更新时，您只需更新这个页头包含文件即可。
语法
include 'filename';
或者
require 'filename';
 */

//require 会产生致命错误 (E_COMPILE_ERROR)，并停止脚本

//require_once 语句和 require 语句完全相同，唯一区别是 PHP 会检查该文件是否已经被包含过，如果是则不会再次包含。
require_once 'vars.php';
require_once 'vars.php';	//此句会被忽略

echo "I have a $color $car";  //关键是变量$color $car的作用域的关系， vars.php 里的作用域会和当前的作用域合并。

?>