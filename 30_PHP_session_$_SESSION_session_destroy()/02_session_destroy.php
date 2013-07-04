<?php
/**
 * 
终结 Session
如果您希望删除某些 session 数据，可以使用session_destroy() 函数
*/

session_start();

session_destroy();		
//session_destroy()前先调用 session_start()
//如果未调用 session_start(),则控制台输出: Trying to destroy uninitialized session


/** 结果:
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache
Content-type: text/html

View Count: 4
 */
?>