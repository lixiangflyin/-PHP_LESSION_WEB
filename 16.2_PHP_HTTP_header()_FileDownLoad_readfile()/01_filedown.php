<?php
/**
提示用户保存一个生成的 RAR 文件（Content-Disposition 报头用于提供一个推荐的文件名，
并强制浏览器显示保存对话框）：
 */

header("Content-Type:x-rar-compressed");

header("Content-Disposition:attachment;filename='userfile.rar'");


//RAR 源在 myfile.rar中
readfile("myfile.rar");	//readfile() 读取一个文件，并输出到输出缓冲。

/**
*HTTP 响应:
Content-Type:x-rar-compressed
Content-Disposition:attachment;filename='userfile.rar'

�����Exif�D�G�H��{�?8��t%h�q�g�v���5� �ڹ�����/�\I[u��F�&���������=�NK�@i��aL�S3��;r�2�z-��!���ˮ�ԁ�7��
k*Vlmw�6�fp�O	Ce��n����As���YZ��+ל'y1�_�.Q��Bd���<$����,������cT�~ޯ
 */
?>