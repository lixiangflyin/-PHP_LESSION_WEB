<?php
//require_once('Config.php');
//require_once(PHPLIB_ROOT . 'inc/constant.inc.php');
//require_once('ToolUtil.php');
//require_once('Logger.php');
//require_once('NetUtil.php');
//require_once('inc/IIdGenerator.php');
//require_once('inc/IUsersTTC.php');
//require_once('inc/IUserReviewLimitTTC.php');

$_USER_REVIEW_LIMIT = array(
    "GAP"       => 60 * 10,
    "MAX_COUNT" => 2,
);

$_REVIEW_BIZ_NAME = array(
    "REVIEWS"          => "����",
    "ASKING"           => "��ѯ",
    "SHORT_MESSAGE"    => "վ����",
    "RECEIEVE_MESSAGE" => "վ����",
    "DIY"              => "DIY",
);

$_REVIEW_BIZ_ID = array(
    "REVIEWS"         => 1,
    "ASKING"          => 2,
    "SHORT_MESSAGE"   => 30,
    "RECEIEVE_MESSAGE"=> 31,
    "DIY"             => 40,
);

$_REVIEW_TYPE_NAME = array(
    1  => "�Ƽ�",
    2  => "һ��",
    3  => "���Ƽ�",
    4  => "����",
    5  => "��Ʒ��ѯ",
    6  => "����/֧��",
    7  => "��Ʊ/����",
    30 => "ϵͳ��Ϣ",
    31 => "�û���Ϣ",
    40 => "DIY",
);

$_REVIEW_TYPE_ID = array(
    "SATISFIED"       => 1,
    "GENERAL"         => 2,
    "UNSATISFIED"     => 3,
    "DISCUSSION"      => 4,
    "ASKING"          => 5,
    "TRANSPORT"       => 6,
    "INVOICE"         => 7,
    "SYSTEM_MESSAGE"  => 30,
    "USER_MESSAGE"    => 31,
    "DIY"             => 40,
);
define("REIVEW_FILTER_REQUEST_TEMPLATE", 'uid=%d&cmd=%d&id=%d-%d-%d&ip=%s&content=%s');

define("REIVEW_REQUEST_TEMPLATE",
"cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=0\r\n");
define("REIVEW_WITH_FLAG_REQUEST_TEMPLATE",
"cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=0&flag=%d\r\n");
define("SYN_REIVEW_REQUEST_TEMPLATE",
"cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d\r\n");
define('TOP_USERS_NUMBER', 5);

$_REVIEW_CMD = array(
    "ADD"    => 1,
    "GET"    => 2,
    "DELETE" => 3,
    "UPDATE" => 4,
);
/**
01  ��Ʒ����
02  ��Ʒ��ѯ
03  ���ۻظ�
04  ��Ʒ����ͳ��
05  ��Ʒ��ѯͳ��
06  ��������
30  ���͵�վ����Ϣ
31  ���յ�վ`����Ϣ
32  վ����Ϣ
33  ����վ����Ϣͳ��
34  ����վ����Ϣͳ��
35  ����վ����Ϣ����
36  ����վ����Ϣ����
 */
$_REVIEW_CATEGORY = array(
    "PRODUCT_REVIEW"             => 1,
    "PRODUCT_ASKING"             => 2,
    "REVIEW_REPLY"               => 3,
    "STATISTIC_REVIEW"           => 4,
    "STATISTIC_ASKING"           => 5,
    "REVIEW_ATTRIBUTE"           => 6,
    "ICSON_REPLY"                => 7,
    "USER_REVIEW"                => 8,
    "USER_ASKING"                => 9,
    "REPLY_ATTRIBUTE"            => 10,
    "SEND_MESSAGE"               => 30,
    "RECEIVE_MESSAGE"            => 31,
    "SHORT_MESSAGE"              => 32,
    "STATISTIC_SEND_MESSAGE"     => 33,
    "STATISTIC_RECEIVE_MESSAGE"  => 34,
    "ATTRIBUTE_SEND_MESSAGE"     => 35,
    "ATTRIBUTE_RECEIVE_MESSAGE"  => 36,
    "DIY_REVIEW"                 => 40,
    "STATISTIC_DIY"              => 41,
    "PROMOTION_REVIEW"           => 50,
    "STATISTIC_PROMOTION"        => 51,
);

/**
001  ������Ʒ
002  һ��
003  ��������Ʒ
004  ����
005  ��Ʒ��ѯ
006  ����/֧��
007  ��Ʊ/����
008  ��Ʒ�����
009  ǰ5λ������
010  ȫ��
011  ȫ����������
030  ϵͳ��Ϣ
031  �û���Ϣ
032  δ����Ϣ
 */
$_REVIEW_SUB_CATEGORY = array(
    "SATISFIED"       => 1,
    "GENERAL"         => 2,
    "UNSATISFIED"     => 3,
    "DISCUSSION"      => 4,
    "ASKING"          => 5,
    "TRANSPORT"       => 6,
    "INVOICE"         => 7,
    "SATISFACTION"    => 8,
    "TOPREVIEWS"      => 9,
    "ALL"             => 10,
    "ALL_REVIEWS"     => 11,
    "BATCH"           => 12,
    "SYSTEM_MESSAGE"  => 30,
    "USER_MESSAGE"    => 31,
    "UNREVIEW"        => 32,
    "DIY"             => 40,
    "PROMOTION"       => 50,
);

$_REVIEW_ATTRIBUTE_TYPE = array(
    "TOP"               => 1,
    "BEST"              => 2,
    "LIKE"              => 3,
    "UNLIKE"            => 4,
    "APPROVED"          => 5,
    "REJECTED"          => 6,
    "PENDING"           => 7,
    "DELETED"           => 8,
    "REVIEWED"          => 9,
    "UNTOP"             => 10,
    "UNBEST"            => 11,
);

/**
 * The basic class of review system
 * @author Bill
 *
 */

class IReview
{
    public static $errCode = 0;
    public static $errMsg = '';

    public static function getProductReviewProperty($product_id_, $is_json_ = true, $property_ = "ALL_REVIEWS")
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;

        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['STATISTIC_REVIEW'], $_REVIEW_SUB_CATEGORY[$property_],
                    $product_id_, 0, 0, 0, 0, "", 0, "", "", "");
        return self::sendRequest($cmd, $is_json_);
    }
    
    public static function getProductSatisfiedExperience($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY['SATISFIED'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return self::sendRequest($cmd, true);
    }
    
  
  

    
    protected static function getSpp($svcName)
    {
        $result = array(
                "data" => "",
                "errorCode" => 0
        );
        $total_svc =configcenter4_get_serv_count($svcName,0);
        $net=configcenter4_get_serv($svcName,0,rand(1,$total_svc));
        if (!isset($net))
        {
            $result["errorCode"] = 1;
            return $result;
        }
        $pos = strpos($net, ":");
        if ($pos === false)
        {
            $result["errorCode"] = 2;
            return $result;
        }

        $ip = substr($net, 0, $pos);
        $port = substr($net, $pos+1);
        $result["data"]=array(
                "ip"=>$ip,
                "port"=>$port
        );
        return $result;
    }

    protected static function getSppByConfig($svcName)
    {
        $result = array(
                "data" => "",
                "errorCode" => 0
        );
        $result=self::getSpp($svcName);
        if($result["errorCode"]!=0)
        {
            return  $result;
        }
        return $result;
    }

    protected static function sendRequest($cmd_, $is_get_ = false)
    {
       /*  $ip = Config::getIP('reviewSystem');
        if (null == $ip)
        {
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(reviewSystem) failed]";
            return  false;
        }

        $address = explode(":", $ip);
        $response_str = NetUtil::tcpCmd($address[0], $address[1], $cmd_, 1, 1, 0, "\r\n"); */
        
        $net = self::getSppByConfig("review_server_list");
        if($net["errorCode"]!=0)
        {
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(reviewSystem) failed]";
            return  false;
        }
        
        $response_str = NetUtil::tcpCmd($net["data"]["ip"], $net["data"]["port"], $cmd_, 1, 1, 0, "\r\n");

        if (false == $response_str || "" == $response_str)
        {
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[review system ".$net["data"]["ip"].":".$net["data"]["port"]." svr timeout]";
            return  false;
        }

        if ($is_get_)
        {
            return $response_str;
        }
        else
        {
             return ToolUtil::gbJsonDecode($response_str);

        }
    }
}
?>
