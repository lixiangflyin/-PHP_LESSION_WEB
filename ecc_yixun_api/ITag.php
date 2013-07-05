<?php
class ITag
{
	public static $errCode = 0;
    public static $errMsg = "";

    //$pagename:  设置唯一能标致一个页面的字符串（取url可能同一个页面，url会发生变化）
	//建议取值格式   level-标识串  来  比如（2-生活电器）
    public static function getPageId($pagename, $pagetype=0) // pagetype用于标识新增的活动类型：强促销、引流、互动、资讯
    {
    	if (empty($pagename)) {
    		self::$errCode = -1;
    		self::$errMsg = "url is null";
    		return false;
    	}

    	$pagename = self::filterPagename($pagename);

    	//list页面，以小类id为依据
    	$isList = strpos($pagename, "list.51buy.com/");
    	if (FALSE !== $isList) {
    		$c3id = intval(substr($pagename, $isList + 15));
    		if (0 >= $c3id)
    		{
    			self::$errCode = -2;
    			self::$errMsg = "list url is invalid";
    			return false;
    		}
    		return ($c3id * 10 + PAGE_TYPE_LIST);
    	}
    	//商品详情页，以商品id为依据
    	$isProductDetail = strpos($pagename, "item.51buy.com/item");
    	if (FALSE !== $isProductDetail) {
			$pidend = strpos($pagename, ".html", $isProductDetail + 19);
			if(FALSE === $pidend)
			{
				return false;
			}
			$substr = substr($pagename,$isProductDetail + 19, $pidend - 19 - $isProductDetail );
			$pidstart = strrpos($substr, "-");
			if(FALSE === $pidstart)
			{
				return false;
			}
    		$product_id = intval(substr($substr, $pidstart + 1));
    		if (0 >= $product_id)
    		{
    			self::$errCode = -2;
    			self::$errMsg = "product detail url is invalid";
    			return false;
    		}
    		return ($product_id * 10 + PAGE_TYPE_PRODUCT_DETAIL);
    	}
		//act域名下活动
    	$isAct = strpos($pagename, "act.51buy.com/promo-");
    	if (FALSE !== $isAct) {
    		$actid = intval(substr($pagename, $isAct + 20));
    		if (0 >= $actid)
    		{
    			self::$errCode = -2;
    			self::$errMsg = "actid url is invalid";
    			return false;
    		}
    		return ($actid * 10 + PAGE_TYPE_ACT);
    	}
		//event域名下的活动
    	$isEvent = strpos($pagename, "event.51buy.com/event/");
    	if (FALSE !== $isEvent) {
    		$eventidstart = substr($pagename, $isEvent + 22);
			$eventend = strpos($eventidstart,".html");
			if(FALSE === $eventend)
			{
				return false;
			}
			$eventStr = substr($eventidstart, 0, $eventend - 4);
			$eventid = intval($eventStr);
    		if (0 >= $eventidstart)
    		{
    			self::$errCode = -2;
    			self::$errMsg = "eventid url is invalid";
    			return false;
    		}

            $pageid = ($eventid * 10 + PAGE_TYPE_EVENT);
            if ($pagetype <= 0) {
                $result = IEventInfo::getEventById($eventid);

                if (is_array($result)) {
                    if ($result['act_type'] !== NULL) {
                        $pagetype = $result['act_type'];
                        $pageid = ($eventid * 1000 + 0 * 100 + $pagetype * 10 + 7);
                    }
                }
            } else {
                $pageid = ($eventid * 1000 + 0 * 100 + $pagetype * 10 + 7);
            }

            return $pageid;
    	}
    	//其他普通页面，数据库生成
    	$mysql = ToolUtil::getDBObj('icson');
    	if (false === $mysql) {
    		self::$errCode = ToolUtil::$errCode;
    		self::$errMsg = ToolUtil::$errMsg;
    		return false;
    	}

    	$sql = "select page_id from t_tag_generator where url='$pagename'";
    	$rows = $mysql->getRows($sql);
    	if (false === $rows) {
    		self::$errCode = $mysql->errCode;
    		self::$errMsg = $mysql->errMsg;
    		return false;
    	}
    	if (count($rows) == 0) {
    		$ret = $mysql->insert('t_tag_generator', array('url'=>$pagename, 'page_id'=>0));
    		if (false === $ret) {
	    		self::$errCode = $mysql->errCode;
	    		self::$errMsg = $mysql->errMsg;
	    		return false;
	    	}
	    	return ($mysql->getInsertId() * 10 + PAGE_TYPE_COMMON);
    	}else
    	{
    		return (intval($rows[0]['page_id']) * 10 + PAGE_TYPE_COMMON);
    	}
    	return false;
    }

    //$page_id：当前页面的页面id，由上面的函数返回
    //$page_level:当前页面所在级别，取值（0，1，2，3）
    //$domain_id：页面上页面区域id，一个页面最多支持99个区域
    //$booth_id：页面区域内展位id，一个区域最多支持99个展位
    //$link_num：展位内链接个数，一个展位内最多支持9个链接
    public static function getTags($page_id, $page_level, $domain_id, $booth_id, $link_num=1)
    {
    	if ($page_id <= 0) {
    		self::$errCode = -10;
    		self::$errMsg = "page_id($page_id) is invalid";
    		return false;
    	}
    	if ($page_level < 0 || $page_level > 3) {
    		self::$errCode = -11;
    		self::$errMsg = "page_level($page_level) is invalid";
    		return false;
    	}
    	if ($domain_id <= 0 || $domain_id > 99) {
    		self::$errCode = -12;
    		self::$errMsg = "domain_id($domain_id) is invalid";
    		return false;
    	}
    	if ($booth_id <= 0 || $booth_id > 99) {
    		self::$errCode = -13;
    		self::$errMsg = "booth_id($booth_id) is invalid";
    		return false;
    	}
    	if ($link_num <= 0 || $link_num > 9) {
    		self::$errCode = -14;
    		self::$errMsg = "link_num($link_num) is invalid";
    		return false;
    	}

		$result = array();
		$pre =  $page_id * 100000 + $domain_id * 1000 + $booth_id * 10;
    	for ($i = 1; $i <= $link_num; ++$i)
    	{
    		$tag =  "$page_level." . ($i + $pre);
    		$result[$i] = $tag;
    	}
    	return $result;
    }

    /**
     *
     * 去掉http(s)前缀和?后面的字符，去掉末尾多余的/字符
     * @param string $pagename
     */
    public static function filterPagename($pagename) {
        return preg_replace('/yixun\.com/mi', '51buy.com', preg_replace('/(?:^https?:\/\/|(?:\/*)?\?.*|\/*$)/mi', '', $pagename));
    }
}


