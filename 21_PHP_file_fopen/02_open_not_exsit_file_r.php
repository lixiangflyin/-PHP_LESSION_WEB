<?php 
/**
open() 函数用于在 PHP 中打开文件。
打开文件
fopen() 函数用于在 PHP 中打开文件。
此函数的第一个参数含有要打开的文件的名称，第二个参数规定了使用哪种模式来打开文件：

文件可能通过下列模式来打开：
模式	描述
r	只读。在文件的开头开始。
r+	读/写。在文件的开头开始。
w	只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
w+	读/写。打开并清空文件的内容；如果文件不存在，则创建新文件。
a	追加。打开并向文件文件的末端进行写操作，如果文件不存在，则创建新文件。
a+	读/追加。通过向文件末端写内容，来保持文件内容。
x	只写。创建新文件。如果文件已存在，则返回 FALSE。
x+	
读/写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。
注释：如果 fopen() 无法打开指定文件，则返回 0 (false)。
 * Enter description here ...
 * @var unknown_type
 */

$file = fopen("notexistfile.txt",'r'); //只读方式打开文件: (boolean) false

/**
//只读模式下读取不存在的文件会有如果的响应:
Content-type: text/html

<br />
<b>Warning</b>:  fopen(notexistfile.txt) [<a href='function.fopen'>function.fopen</a>]: failed to open stream: No such file or directory in <b>F:\opt\www\21_PHP_file_fopen\02_open_not_exsit_file.php</b> on line <b>24</b><br />
*/
?>