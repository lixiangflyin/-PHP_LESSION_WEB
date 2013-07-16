<?php
/**
兼容Perl的Regex

1.定界符号 //

2.原子 : 正则表达式的最基本组成单位,而且必须至少要包含一个原子
	   (只有一个正则表达式可以单独使用的字符,就是原子)

	   1: 所有打印和非打印字符
	   2: . * + ? ( <> ) 如果所有有意义的字符,想作为原子使用,则使用'\'来转义
	   	  '\'转义字符: 可以将有意义的字符转成没意义的字符
	   	                        也可以将没意义的字符转成有意义的字符

	   3:在正则表达式中可以直接使用一些代表范围的原子(将没意义的字符转成有意义的字符)
	   		\d    : 表示任意一个十进制的数字
	   		\D    : 表示任意一个除数字之外的字符
	   		\s    : 表示任意一个空白字符, 空格 \n\r\t\f
	   		\S    : 表示任意一个非空白字符
	   		\w    : 表示任意一个字符: a-zA-Z0-9_
	   		\W

		4:'.' : 默认情况下,表示陶换行符号外的任意一个字符

3.元字符: * ? (元字符是一种特殊的字符,是用来修饰原子用的,不可以单独出现)

	* : 表示 其前的原子可以出现0次,1次或多次
	+ : 表示 其前的原子可以出现1次或多次
	? : 表示 其前的原子可以出现0次,1次

	{}: 用于自己定义前面原子出现的次数
			{num},[num,num]
			{m,n},[m,n]
			{m,} [m,~)

	^ : 直接 在一个正则表达式的第一个字符出现,则表达必须以这个正则表达式开始
	$ : 直接 在一个正则表达式的最后的字符出现,则表达必须以这个正则表达式结束

	|

	()
	\b
	\B






4. 模式 修正符号 i u
 */


$pattern = '/^one$/';//表示字符串必须是one结尾的

$string = 'one';  //SUCCESS


$match_time = preg_match($pattern, $string);


if($match_time === false)
{
	echo 'error';
}
else
{
	echo 'match time:' . $match_time;
}