<html>
<head>
	<title><?php echo $title;?></title>
	<title><?=$title?></title>
</head>
<body>
<?php if($isVip):?>
	<div>Hello VIP!</div>
<?php else:?>
	<div>Hello Dear!</div>
<?php endif;?>
</body>
</html>