<?php
/**
 * ǰ̨�û���ȡ<font color="#010101">DIY</font>�����Ϣ��
 * @author oscarzhu
 * @version 1.0
 * @created 03-����-2011 15:26:06
 */

class ISearchWord
{
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ���û����б���ʱ��
	 */
	private static $saveTime = 1;
	
	/**
	 * ���û����б���ʱ��
	 */
	private static $debug = true;
		
	private static $biz = 1;
	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * ��ȡ������Ϣ
	 */
	public static function getErrMsg()
	{
		return self::$errMsg;
	}
	
	/**
	 * ������־
	 */
	public static function log($str)
	{
		if(self::$debug)
			Logger::info($str);
	}
		
	/*
	 * ���ݴ�ȡ�����Ӧ�����
	 * @param string $word ��
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
	 * ���������ȡ���������
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
	 * ����´�
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
	 * ɾ��
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
	 * ���ҳ�ͬ��ʣ�����Ϸ���
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