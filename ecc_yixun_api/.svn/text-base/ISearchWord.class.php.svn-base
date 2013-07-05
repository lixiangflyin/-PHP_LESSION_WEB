<?php
/**
 * 前台用户获取<font color="#010101">DIY</font>相关信息类
 * @author oscarzhu
 * @version 1.0
 * @created 03-五月-2011 15:26:06
 */

class ISearchWord
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 设置缓存中保存时间
	 */
	private static $saveTime = 1;
	
	/**
	 * 设置缓存中保存时间
	 */
	private static $debug = true;
		
	private static $biz = 1;
	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * 获取错误信息
	 */
	public static function getErrMsg()
	{
		return self::$errMsg;
	}
	
	/**
	 * 控制日志
	 */
	public static function log($str)
	{
		if(self::$debug)
			Logger::info($str);
	}
		
	/*
	 * 根据词取出相对应的组号
	 * @param string $word 词
	 * @return int
	 * 
	 */		
	public static function getSearchWordGroup($word)
	{
		$word = strtolower($word);
		$result = ISearchWordTTC::get(self::$biz, array('word'=>$word,'status'=>0));
		if( $result === false )
		{
			self::log("code:".ISearchWordTTC::$errCode." msg:".ISearchWordTTC::$errMsg);
			self::$errCode = ISearchWordTTC::$errCode;
			self::$errMsg  = ISearchWordTTC::$errMsg;
			return false;
		}
		if( empty($result) )
		{
			return 0;
		}
		return $result[0]['group'];
	}
		
	/*
	 * 根据组号拉取所有相近词
	 * @param int $id 
	 * @return array
	 * 
	 */		
	public static function getSearchWords($id)
	{
		$result = ISearchWordTTC::get(self::$biz, array('group'=>$id,'status'=>0));
		if( $result === false )
		{
			self::log("code:".ISearchWordTTC::$errCode." msg:".ISearchWordTTC::$errMsg);
			self::$errCode = ISearchWordTTC::$errCode;
			self::$errMsg  = ISearchWordTTC::$errMsg;
			return false;
		}
		return $result;
	}
		
	/*
	 * 添加新词
	 * @param int $id  
	 * @param string $word 
	 * @return bool
	 * 
	 */		
	public static function addSearchWord($word, $id='')
	{
		$word = strtolower($word);
		$insertArray = array(
			'biz'	=>	self::$biz,
			'word'	=>	$word,
			'group'	=>	$id,
			'status'	=>	0,
			'updatetime'	=>	date('Y-m-d H:i:s',time()),
			'createtime'	=>	date('Y-m-d H:i:s',time()),
			'user_id'			=>	$_COOKIE['CurrentUserID'],
		);
		$ret = ISearchWordTTC::insert($insertArray);
		if( $ret === false )
		{
			self::log("code:".ISearchWordTTC::$errCode." msg:".ISearchWordTTC::$errMsg);
			self::$errCode = ISearchWordTTC::$errCode;
			self::$errMsg  = ISearchWordTTC::$errMsg;
			return false;
		}
		if(empty($id))
		{
			$data = ISearchWordTTC::get(self::$biz, array('word'=>$word,'status'=>0));
			$updateArray = array(
				'biz'	=>	self::$biz,
				'group'	=>	$data[0]['id'],
			);
			$filter = array('id'	=>	$data[0]['id']);
			$ret = ISearchWordTTC::update($updateArray, $filter);
			if( $ret === false )
			{
				self::log("code:".ISearchWordTTC::$errCode." msg:".ISearchWordTTC::$errMsg);
				self::$errCode = ISearchWordTTC::$errCode;
				self::$errMsg  = ISearchWordTTC::$errMsg;
				return false;
			}
			$data[0]['group'] = $data[0]['id'];
		} else {
			$data[0] = $insertArray;
		}
		return $data;
	}

	/*
	 * 删除
	 * @param int $id
	 * @return bool
	 * 
	 */
	public static function deleteSearchWord($id)
	{	
		$updateArray = array(
			'biz'	=>	self::$biz,
			'status'=>	-101,
		);
		$filter = array('id'	=>	$id);
		$ret = ISearchWordTTC::update($updateArray, $filter);
		if( $ret === false )
		{
			self::log("code:".ISearchWordTTC::$errCode." msg:".ISearchWordTTC::$errMsg);
			self::$errCode = ISearchWordTTC::$errCode;
			self::$errMsg  = ISearchWordTTC::$errMsg;
			return false;
		}
		
		return true;
	}

	/*
	 * 查找出同义词，并组合返回
	 * @param string $word
	 * @return string
	 * 
	 */
	public static function getSearchWordsForS($word)
	{	
		$ret = array();
		$word = strtolower($word);
		$id = self::getSearchWordGroup(trim($word));
		if( ($id===false) || empty($id) )
			return $word;
		$result = self::getSearchWords($id);
		if( count($result)==1 ) return $word;
		foreach( $result as $data )
		{
			$ret[] = "(".$data['word'].")";
		}
		
		return implode(" OR ",$ret);
	}
		
}