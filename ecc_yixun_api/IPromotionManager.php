<?php
require_once('constant.inc.php');
require_once('MSSQL.php');
require_once('ToolUtil.php');
require_once('inc/IIdGenerator.php');
require_once(PHPLIB_ROOT . 'api/IProductInventory.php');

/**
 * “促销模版”管理类，对应erp中多张表。目前的功能仅限于读取。
 * 如果要做添加的话，erp中的表应该添加额外的ID字段。
 */
class IPromotionManager {
	public static $FixedTemplateItemTag = 'Product_Fixed_Template';
	public static $TemplateBannerImgPath = 'http://img2.icson.com/images/Promotion/';

	public static $FixedTemplateBgImg = array(
		'path' => 'http://121.9.221.115/IcsonPic/Fixed_Template/',
		'ip' => '121.9.221.115',
		'host' => 'img2.icson.com',
	);

	public static $errCode = 0;
	public static $errMsg = '';

	public static $MaxGuessNum = 100; //猜图片的最大次数

	//促销页面评论相关
	public static $ReviewsPerPage = 10;

	public static $PromoSubsiteMap = array( //子站对应
		'sh' => 1,
		'sz' => 1001,
		'bj' => 2001,
		'wh' => 3001,
		'cq' => 4001,
		'xa' => 5001
	);

	public static $MessageNonePromo = array( '该活动不存在，感谢您的关注。', '<a href="http://51buy.com/">返回首页</a>', );
	public static $MessageUnReleasePromo = array( '该活动尚未发布，感谢您的关注。', '<a href="http://51buy.com/">返回首页</a>', );

	/**
	 * 根据编号获取促销模板信息, 依据 SysNo 排序.
	 * @tutorial col 尽量赋值, 避免大数据量传输! 这里我没用top对选取行做LIMIT, 留个 TODO 吧.
	 *
	 * @param int $whId 根据cookie中的标记或IP定位的子站ID
	 * @param array $cols 查询活动的列
	 * @param array $conds 查询活动需要的参数
	 * 		促销活动状态(Status)：0 valid / -1 invalid
	 * 		促销活动发布状态(ReleaseStatus)：1 valid
	 * 		模板类型(TemplateType)：1 固定模板
	 * @return mixed false 查询DB失败；array 促销模板信息
	 */
	public static function fetchAllPromotions($whId, $cols = array(), $conds=array()) {
		$msdb = Config::getMSDB("ERP_{$whId}"); //注意：erp名称由子站ID决定！
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = 'init ms db failed' . Config::$errMsg;
			return false;
		}

		$column = empty($cols) ? ' * ' : implode(', ', $cols);
		$where = '';
		if (! empty($conds)) {
			$where = 'WHERE ' . implode(' AND ', $conds);
		}

		$sql = "SELECT {$column} FROM Promotion_Master {$where} ORDER BY SysNo DESC";
		$ret = $msdb->getRows($sql);
		if (false === $ret) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = 'query ms db failed ' . $msdb->errMsg . $sql;
			return false;
		}
		else {
			if (count($ret) > 0 && array_key_exists('StyleSettings', $ret[0])) { //处理 StyleSettings 列
				foreach ($ret as &$row) {
					$row['StyleSettings'] = explode('&', $row['StyleSettings']); //ERP中，该字段有 & 分割。
				}
			}

			return $ret;
		}
	}

	/**
	 * 根据编号获取促销模板信息。(促销活动状态：0 valid / -1 invalid)
	 * @param int $promoId 促销编号
	 * @param int $whId 根据cookie中的标记或IP定位的子站ID
	 * @return mixed false 查询DB失败；array 促销模板信息
	 */
	public static function fetchPromotionMasterInfo($promoId, $whId) {
		$msdb = Config::getMSDB("ERP_{$whId}"); //注意：erp名称由子站ID决定！
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = 'init ms db failed' . Config::$errMsg;
			return false;
		}

		$sql = "SELECT * FROM Promotion_Master WHERE SysNo = {$promoId}";
		$row = $msdb->getRows($sql);
		if (false === $row || count($row) == 0) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = 'query ms db failed ' . $msdb->errMsg . $sql;
			return false;
		}

		$row[0]['StyleSettings'] = explode('&', $row[0]['StyleSettings']); //ERP中，该字段有 & 分割。
		return $row[0];
	}

	/**
	 * 根据促销活动ID，获得促销组。
	 * @param int $promoId 促销编号
	 * @param int $whId 根据cookie中的标记或IP定位的子站ID
	 * @return mixed false 查询DB失败；array 促销组信息
	 */
	public static function fetchPromotionGroups($promoId, $whId) {
		$msdb = Config::getMSDB("ERP_{$whId}"); //注意：erp名称由子站ID决定！
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = 'init ms db failed' . Config::$errMsg;
			return false;
		}

		$sql = "SELECT Promotion_Item_Group.GroupName,
							Promotion_Item_Group.SysNo,
							Promotion_Item_Group.OrderNum,
							Promotion_Item_Group.Status
					FROM Promotion_Item_Group
			LEFT JOIN Promotion_Master ON Promotion_Item_Group.PromotionSysNo = Promotion_Master.SysNo
				WHERE PromotionSysNo = {$promoId}
					AND Promotion_Item_Group.status = 0
					AND Promotion_Master.Status = 0
			ORDER BY OrderNum";

		$row = $msdb->getRows($sql);
		if (false === $row || !is_array($row)) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = 'query ms db failed' . $msdb->errMsg;
			return false;
		}

		return $row;
	}

	/**
	 * 根据促销活动ID，获得“活动模板”的促销产品列表。
	 * @param int $promoId 促销编号
	 * @param int $whId 根据cookie中的标记或IP定位的子站ID
	 * @return mixed false 查询DB失败；array 促销产品信息
	 */
	public static function fetchPromotionProducts($promoId, $whId) {
		$msdb = Config::getMSDB("ERP_{$whId}"); //erp名称由子站ID决定
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = 'init ms db failed' . Config::$errMsg;
			return false;
		}

		$sql = "SELECT Product.SysNo,
							Product.ProductID AS ProductID,
							Product.ProductName,
							promotion_product.OrderNum AS InsideGroupOrder,
							Promotion_Item_Group.OrderNum AS GroupOrder,
							Promotion_Item_Group.GroupName,
							Product.BriefName,
							Product.PromotionWord,
							Product_Price.BasicPrice,
							Product_Price.CurrentPrice,
							Product_Price.Point,
							Product_Price.CashRebate,
							ISNULL(promotion_product.PromotionDiscount, 0) AS PromotionDiscount,
							Product.MasterProductSysNo,
							Product.Product2ndType,
							promotion_product.PromotionItemGroupSysNo
					FROM Promotion_Item_Product promotion_product (NOLOCK)
					INNER JOIN Product (NOLOCK) ON promotion_product.productsysno = product.SysNo
					INNER JOIN Product_Price (NOLOCK) ON promotion_product.productsysno = Product_Price.productsysno
					INNER JOIN Promotion_Item_Group (NOLOCK) ON promotion_product.PromotionItemGroupSysNo = Promotion_Item_Group.SysNo
					INNER JOIN Promotion_Master (NOLOCK) ON Promotion_Item_Group.PromotionSysNo = Promotion_Master.SysNo
					WHERE PromotionSysNo = {$promoId}
						AND Promotion_Item_Group.Status = 0
						AND Promotion_Master.Status = 0
						AND Product.Status=" . PRODUCT_STATUS_NORMAL . " ORDER BY Promotion_Item_Group.OrderNum, promotion_product.OrderNum";

		$row = $msdb->getRows($sql);

		if (false === $row || !is_array($row)) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = 'query ms db failed' . $msdb->errMsg;
			return false;
		}
		
		//ixiuzeng添加，多分仓项目库存获取
		if (count($row) == 0)
		{
			return $row;
		}
		$pids = array();
		foreach($row as $rt)
		{
			$pids[] = $rt['SysNo'];
		}
		
		$productsInventoryInfo = IProductInventory::getProductsInventeory(array_unique($pids), $whId);
		if (false === $productsInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
		
			foreach ($row as $key => $wi)
			{
				$row[$key]['OnlineQty'] = 0;
			}
		}
		else
		{
			foreach ($row as $key => $wi)
			{
				foreach ($productsInventoryInfo as $psii)
				{
					if ($psii['product_id'] == $wi['SysNo'])
					{
						$row[$key]['OnlineQty'] = $psii['virtual_num'] + $psii['num_available'];
						break;
					}
				}
			}
		}
		return $row;
	}

	/**
	 * 根据促销活动ID，获得促销活动那个相关的“专题广告”。
	 * 注意参数顺序！
	 * @param int $whId 根据cookie中的标记或IP定位的子站ID
	 * @param int $promoId 促销活动ID，如果是NULL，就选取系统中可用的“专题广告”
	 * @return mixed false 查询DB失败；array 促销产品信息
	 */
	public static function fetchPromotionActivity($whId, $promoId=NULL) {
		$msdb = Config::getMSDB("ERP_{$whId}"); //注意：erp名称由子站ID决定！
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = 'init ms db failed' . Config::$errMsg;
			return false;
		}

		$sql = 'SELECT SysNo,
							PromotionSysNo,
							ActivityDes,
							LinkUrl,
							ImageUrl,
							Status
					FROM PromotionActivities
					WHERE Status = 0 '
					. (empty($promoId) ? '' : "AND PromotionSysNo = {$promoId}");
		$row = $msdb->getRows($sql);

		if (false === $row || !is_array($row)) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = 'query ms db failed' . $msdb->errMsg;
			return false;
		}

		return $row;
	}

	/**
	 * 根据促销活动ID，获得“固定模板”的促销模板。
	 * @param int $promoId 促销编号
	 * @param int $whId 根据cookie中的标记或IP定位的子站ID
	 * @return mixed false 查询DB失败；array 促销产品信息
	 */
	public static function fetchPromotionTemplate($promoId, $whId) {
		$msdb = Config::getMSDB("ERP_{$whId}"); //erp名称由子站ID决定
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = 'init ms db failed' . Config::$errMsg;
			return false;
		}

		$sql = "SELECT SysNo
							,PromotionLayout
							,TemplateName
							,CreateTime
							,Status
							,P_Quantity
					FROM PromotionTemplate pt
					WHERE pt.SysNo = (SELECT TOP 1 TemplateSysNo FROM PromotionTemplate_Item WHERE PromotionSysNo = '{$promoId}')";

		$row = $msdb->getRows($sql);

		if (false === $row || count($row) == 0) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = 'query ms db failed ' . $msdb->errMsg . $sql;
			return false;
		}

		return $row[0];
	}

	/**
	 * 根据促销活动ID，获得“固定模板”中要显示的商品。
	 * @param int $promoId 促销编号
	 * @param int $whId 根据cookie中的标记或IP定位的子站ID
	 * @return mixed false 查询DB失败；array 促销产品信息
	 */
	public static function fetchPromotionTemplateItems($promoId, $whId) {
		$msdb = Config::getMSDB("ERP_{$whId}"); //erp名称由子站ID决定
		if (empty($msdb)) {
			self::$errCode = Config::$errCode;
			self::$errMsg = 'init ms db failed' . Config::$errMsg;
			return false;
		}

		/* $sql = "SELECT item.SysNo,
							TemplateSysNo,
							ProductSysNo,
							Location,
							item.Status,
							Style_Content,
							product.Status AS ProductStatus,
							product.ProductID AS ProductID,
							product.ProductName,
							product.PromotionWord,
							product.BasicPrice,
							product.CurrentPrice,
							product.Point,
							product.CashRebate,
							( product.AvailableQty + product.VirtualQty ) AS OnlineQty,
							product.MasterProductSysNo
					FROM PromotionTemplate_Item item
			INNER JOIN dbo.vwProductC3 product ON item.ProductSysNo = product.SysNo
				WHERE PromotionSysNo = '{$promoId}'
			ORDER BY Location"; */

		$sql = "SELECT	item.SysNo, item.TemplateSysNo, item.ProductSysNo, item.Location, item.Status, item.Style_Content,
				product.Status AS ProductStatus, product.ProductID AS ProductID, product.ProductName, product.PromotionWord,Product.MasterProductSysNo,
				Product_Price.BasicPrice, Product_Price.CurrentPrice, Product_Price.Point, Product_Price.CashRebate		
				FROM	PromotionTemplate_Item item (NOLOCK)
						INNER JOIN Product (NOLOCK) ON item.ProductSysNo = Product.SysNo
						INNER JOIN Product_Price (NOLOCK) ON Product.SysNo = Product_Price.ProductSysNo
				WHERE	Product.Status = 1 AND item.PromotionSysNo = '{$promoId}'
				ORDER BY Location";
		$row = $msdb->getRows($sql);

		if (false === $row || !is_array($row)) {
			self::$errCode = $msdb->errCode;
			self::$errMsg = 'query ms db failed' . $msdb->errMsg;
			return false;
		}
		
		//ixiuzeng添加，多分仓项目库存获取
		if (count($row) == 0)
		{
			return $row;
		}
		$pids = array();
		foreach($row as $rt)
		{
			$pids[] = $rt['ProductSysNo'];
		}
		
		$productsInventoryInfo = IProductInventory::getProductsInventeory(array_unique($pids), $whId);
		if (false === $productsInventoryInfo)
		{
			self::$errCode = IProductInventory::$errCode;
			self::$errMsg = IProductInventory::$errMsg;
		
			foreach ($row as $key => $wi)
			{
				$row[$key]['OnlineQty'] = 0;
			}
		}
		else
		{
			foreach ($row as $key => $wi)
			{
				foreach ($productsInventoryInfo as $psii)
				{
					if ($psii['product_id'] == $wi['ProductSysNo'])
					{
						$row[$key]['OnlineQty'] = $psii['virtual_num'] + $psii['num_available'];
						break;
					}
				}
			}
		}

		return $row;
	}

	/**
	 * 生成“固定模板”中的可能存在的背景图地址
	 * @param int $promoId 促销专题编号
	 * @param int $templateId 模板编号
	 * @param int $num 固定模板中可能存在的背景图顺序
	 * @param int $imgType 固定模板中可能存在的背景图类型
	 * @return string 占位符
	 */
	public static function convertFixedTemplateBgImg($promoId, $templateId, $num, $imgType='jpg') {
		return self::$FixedTemplateBgImg['path'] . "{$promoId}_{$templateId}_{$num}.{$imgType}";
	}

	/**
	 * 生成“固定模板”中的占位符
	 * @param int $num 固定模板中的条目顺序
	 * @return string 占位符
	 */
	public static function convertFixedTemplateTag($num) {
		return self::$FixedTemplateItemTag . $num . '_pro';
	}
}