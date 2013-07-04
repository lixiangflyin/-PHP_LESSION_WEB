<?php
/**
 * 验证码
 *
 * @author allenzhou
 * @version 1.0
 * @created 24-八月-2011 15:19:31
 */
require_once 'Config.php';
require_once ROOT_DIR . 'lib/PicCode.php';
require_once ROOT_DIR . 'lib/Logger.php';

Logger::init();

$vc = new PicCode();

$vc->setWidth(90);
$vc->setHeight(30);
$vc->setFontSize(16);
$vc->setTextNumber(4);
$vc->setNoisePoint(50);
$vc->setNoiseLine(5);
$vc->setDistortion(true);
$v = $vc->createImage();
if(!isset($_SESSION)){  
    session_start();  
}
$_SESSION['vcode']=$v;

//End Of Script
