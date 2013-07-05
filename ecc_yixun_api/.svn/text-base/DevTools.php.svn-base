<?php
class DevTools
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static function insertProductStock($product_ids)
	{
		if( !is_array($product_ids) )
			return false;
			
		$msDB = ToolUtil::getMSDBObj("Inventory_Manager");
		if( false === $msDB )
		{
			self::$errMsg = ToolUtil::$errMsg;
			self::$errCode = -1;
			return false;
		}
		
		$ret = $msDB->getRows("select MAX(sysno) as max_sysno from product_stock");
		if( $ret === false )
		{
			self::$errMsg = ToolUtil::$errMsg;
			self::$errCode = -2;
			Logger::err("select MAX(sysno), error:".self::$errMsg);
			return false;
		}
			
		$i = intval($ret[0]['max_sysno']) + 1;

		$now = date("Y-m-d H:i:s");
		foreach($product_ids as $pid)
		{			
			$product_stock_data = array(
				'SysNo' =>  $i,
				'ProductSysNo' => $pid,
				'StockSysNo' => 1,
				'SaleStockSysNo' => 1,
				'rowCreateDate' => $now,
				'rowModifyDate' => $now,
				'Status' => 0,				
			);
			
			$ret = $msDB->insert("Product_Stock", $product_stock_data);
			
			if( $ret === false )
			{
				self::$errMsg = ToolUtil::$errMsg;
				self::$errCode = -3;
				echo(self::$errMsg);
				continue;
			}
			$i++;
		}
		
		$inventory_stock_data = array(
			'AvailableQty' => 100000,
			'rowModifyDate' => $now,
		);
		
		$condition = "StockSysNo=1 and ProductSysNo in (" . implode(',',$product_ids). " )";


		$sql = $msDB->getUpdateString("Inventory_Stock", $inventory_stock_data, $condition);
		echo $sql;
		$ret = $msDB->execSql($sql);
		if( $ret === false )
		{
			self::$errMsg = ToolUtil::$errMsg;
			self::$errCode = -4;
			Logger::err(self::$errMsg);
		}
		return true;
	}
}
