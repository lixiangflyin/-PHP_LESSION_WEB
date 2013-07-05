<?php
/**
 * entry of process
 */
require_once 'AlertAgent.php';

Logger::init();

$agent = new AlertAgent();

// Get the arguments from url.
//GET /process.php?&api='$apiName'&alert='$alertType'&site='$siteId'&uid='$uid'&cost='$cost'&err='$errCode'&msg='$errMsg'

Logger::info("process.php");

$apiName = $_GET["api"];
$alertType = $_GET["alert"];
$siteId = $_GET["site"];
$uid = $_GET["uid"];
$cost = $_GET["cost"];
$errCode = $_GET["err"];
$errMsg = $_GET["msg"];

// Process the new request.
$agent->process($apiName, $alertType, $siteId, $uid, $cost, $errCode, $errMsg);
