<?php
/**
 * Created by JetBrains PhpStorm.
 * User: flycgu
 * Date: 13-1-18
 * Time: 下午4:56
 * To change this template use File | Settings | File Templates.
 */
if (!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . "lib/ToolUtil.php");
class EA_AdminFromErp{
    /**
     * 错误码
     * @var int
     */
    public static $errCode = 0;

    /**
     * 错误提示
     * @var string
     */
    public static $errMsg = "";

    //TODO 定义对应的库表名
    public static $ERPName_Categroy = "Category";
    public static $ERPName_Stock = "Stock";
    public static $ERPName_Product = "Product";
    public static $ERPName_Product_Gift = "Product_Gift";
    public static $errArray = array(
        1000			=>"数据库连接错误!",
        1101		=>"数据库插入错误!",
        1201		=>"数据库查找数据为空!",
        1102		=>"数据库查找错误!",
        1103		=>"数据库更新错误!",
        1301			=>"数据库参数错误!",
        1401 	=>"启动事务错误!",
        1402		=>"提交事务错误!",
        1302			=>"参数错误",
    );
    function clearError()
    {
        self::$errCode = 0;
        self::$errMsg="";
    }
    /**
     * 从数据库中查找category1的数据
     *
     * @param null
     *
     * 返回值：正确返回查找到的类目，错误返回false
     * 数据格式:
     * array(
     * 		'C1Name' =>  XXX ,
     * 		'SysNo'    =>  XXX
     * 		)
     */
    public static function selectCategory1()
    {
        $MSDB = ToolUtil::getMSDBObj(self::$ERPName_Categroy);

        if ($MSDB == false) {
            self::$errCode = 1000;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ .  self::$errArray[1000];
            Logger::info(var_export($MSDB->errMsg,true));
            return false;
        }
        $categorys = $MSDB->getRows("select C1Name,SysNo from Category1 where Status=0");
        if ($categorys === false) {
            self::$errCode = 1102;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1102];
            Logger::info(var_export($categorys,true));
            return false;
        }
        if (empty($categorys)) {
            return false;
        }
        return $categorys;
    }

    /**
     * 由C1SysNo从数据库中查找category2的数据
     *
     * @param	string C1SysNo C1类目的系统编号
     *
     * 返回值：正确返回查找到的类目，错误返回false
     * array(
     * 		'C1SysNo' =>  XXX ,
     * 		'C2Name'    =>  XXX ,
     * 		'SysNo'    =>  XXX ,
     * 		)
     */
    public static function selectCategory2($C1SysNo)
    {
        if (!isset($C1SysNo)) {
            self::$errCode = 1302;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1302];
            return false;
        }
        $MSDB = ToolUtil::getMSDBObj(self::$ERPName_Categroy);
        if ($MSDB == false) {
            self::$errCode = 1000;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1000];
            return false;
        }

        $categorys = $MSDB->getRows("SELECT C1SysNo,C2Name,SysNo FROM Category2 where C1SysNo=" . $C1SysNo . "AND Status=0");

        if ($categorys === false) {
            self::$errCode = 1102;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1102];
            return false;
        }

        if (empty($categorys)) {
            return false;
        }
        return $categorys;
    }

    /**
     * 由C2SysNo从数据库中查找category3的数据
     *
     * @param	string C2SysNo C2类目的系统编号
     *
     * 返回值：正确返回查找到的类目，错误返回false
     * array(
     * 		'C2SysNo' =>  XXX ,
     * 		'C3Name'    =>  XXX ,
     * 		'SysNo'    =>  XXX ,
     * 		)
     */
    public static function selectCategory3($C2SysNo)
    {
        if (!isset($C2SysNo)) {
            self::$errCode = ERR_PARAM_BATCH_MISS;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[ERR_PARAM_BATCH_MISS];
            return false;
        }
        $MSDB = ToolUtil::getMSDBObj(self::$ERPName_Categroy);
        if ($MSDB == false) {
            self::$errCode = 1000;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1000];
            return false;
        }

        $categorys = $MSDB->getRows("SELECT C2SysNo,C3Name,SysNo FROM Category3 WHERE C2SysNo=" . $C2SysNo . "AND Status=0");

        if ($categorys === false) {
            self::$errCode = 1102;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1102];
            return false;
        }

        if (empty($categorys)) {
            return false;
        }
        return $categorys;
    }

    /**
     * 查询商品信息
     *
     * @param string KEYWORD	要查询的关键字
     * @param string FIELD		要查询的列名称
     * @param string METHOD		查询的方式，是否是模糊查询
     *
     * 返回值：正确返回数据，错误返回false
     * array(
     * 		'SysNo' =>  XXX ,
     * 		'ProductID'    =>  XXX ,
     * 		'ProductName'    =>  XXX ,
     * 		'BriefName'    =>  XXX ,
     * 		)
     */
    public static function searchProduct($KEYWORD,$FIELD,$METHOD=false,$WH_ID=1)
    {
        $MSDB = ToolUtil::getMSDBObj(self::$ERPName_Product);
        if ($MSDB == false) {
            self::$errCode = 1000;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1000];
            Logger::err(self::$errMsg);
            return false;
        }

        if ($METHOD == false) {
            $sqlStr = "SELECT SysNo,ProductID,ProductName,BriefName FROM Product WHERE " . $FIELD ."='" . $KEYWORD . "'";
        }
        else
        {
            //取出所有关键字
            $strArray = self::getConfuseKey($KEYWORD);
            $sqlStr = 'SELECT SysNo,ProductID,ProductName,BriefName FROM Product WHERE ';
            foreach ($strArray as $key => $data)
            {
                if($key == 0)
                {
                    $sqlStr .= $FIELD ." LIKE '%" . $data . "%'";
                }
                else
                {
                    $sqlStr .= 	" AND " . $FIELD ." LIKE '%" . $data . "%'";
                }
            }
        }
        $products = $MSDB->getRows($sqlStr);
        if ($products === false) {
            self::$errCode = 1102;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1102];
            return false;
        }
        if (empty($products)) {
            return false;
        }
        //验证分站是否有该商品
        foreach($products as $k=>$product){
            $sqlStr = "SELECT SysNo,PMUserSysNo FROM Product_SubStation WHERE ProductSysNo ='" . $product['SysNo'] . "' and SubStationSysNo = " . $WH_ID;
            $substation = $MSDB->getRows($sqlStr);
            if ($substation === false) {
                self::$errCode = 1102;
                self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1102];
                return false;
            }
            else if (empty($substation)) {
                unset($products[$k]);
            }
            else {
                $products[$k]['PMUserSysNo'] = $substation[0]['PMUserSysNo'];
            }
        }
        return $products;
    }

    /**
     * 获取易迅价、当前价、成本价
     * Enter description here ...
     * @param $product_id
     * @param $wh_id
     * @param $price_id
     */
    public static function getProductPrices($product_id, $wh_id=1){
        // 获取易迅价、当前价、成本价
        $db = ToolUtil::getMSDBObj(self::$ERPName_Product);
        if ($db == false) {
            self::$errCode = MP_1000;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[MP_1000];
            Logger::err(self::$errMsg);
            return false;
        }
        $sqlStr = "SELECT BasicPrice,CurrentPrice,UnitCost FROM Product_Price WHERE ProductSysNo ='" . $product_id . "' and SubStationSysNo = '" . $wh_id . "'";
        $price = $db->getRows($sqlStr);
        if ($price === false) {
            self::$errCode = 1102;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1102];
            return false;
        }
        if (empty($price)) {
            return false;
        }

        return $price[0];
    }

    /**
     * 由品牌名称从数据库中查找品牌的数据
     *
     * @param	string $Name 品牌名称关键字
     *
     * 返回值：正确返回查找到的品牌，错误返回false
     * array(
     * 		'SysNo' =>  XXX ,
     * 		'ManufacturerID'    =>  XXX ,
     * 		'ManufacturerName'    =>  XXX ,
     * 		'BriefName'    =>  XXX ,
     * 		)
     */
    public static function searchMenufactor($Name)
    {
        $MSDB = ToolUtil::getMSDBObj(self::$ERPName_Categroy);
        if ($MSDB == false) {
            self::$errCode = 1000;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ .  self::$errArray[1000];
            return false;
        }

        $menufactors = $MSDB->getRows("SELECT SysNo,ManufacturerID, ManufacturerName, BriefName FROM Manufacturer WHERE ManufacturerName LIKE '%" . $Name . "%'");
        if ($menufactors === false) {
            self::$errCode = 1102;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . self::$errArray[1102];
            return false;
        }

        if (empty($menufactors)) {
            return false;
        }
        return $menufactors;
    }

    /**
     * 转换成%XXX%XXX%XXX%关键字
     *
     * @param string  KEYWORD  要查询的数据库关键字
     *
     * 返回值：返回%XXX%XXX%XXX%
     */
    private function getConfuseKey($KEYWORD)
    {
        if(strlen($KEYWORD) != 0)
        {
            $KEYWORD = str_replace(' ','%',$KEYWORD);
            $indexStart = 0;
            $indexEnd = 0;
            $strArray = array();
            $dataStr = $KEYWORD;
            $dataStr = $dataStr.'%';
            while ($indexEnd != strlen($KEYWORD) && strlen($dataStr)!=0) {
                $indexEnd = strpos($dataStr,'%');
                $tempStrSub = substr($dataStr,$indexStart,$indexEnd);
                $strArray[] = $tempStrSub;
                $dataStr = substr($dataStr,$indexEnd+1);
            }
            return $strArray;
        }
        else {
            return '%%';
        }
    }

}