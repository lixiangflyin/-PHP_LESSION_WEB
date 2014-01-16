<?php
function inc(){
	static $sum; //静态变量
	
	$sum++;

	var_dump($sum);
}

inc();
inc();
inc();
inc();
inc();

/**
int(1)
int(2)
int(3)
int(4)
int(5)
 */