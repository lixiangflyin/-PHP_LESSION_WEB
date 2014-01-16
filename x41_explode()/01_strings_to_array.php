<?php
$names_str = 'ken,jack,mary';

//以"分号"分隔字符串     'ken,jack,mary' --> array('ken','jack','mary');
$names = explode(',', $names_str);

var_dump($names);