<?php
class MSSQL
{
	/**
	 * 数据库机器ip
	 *
	 * @var string
	 */
	private $host;

	/**
	 * 数据库端口
	 *
	 * @var string
	 */
	private $port;

	/**
	 * 数据库名称
	 *
	 * @var string
	 */
	private $database;

	/**
	 * 用户名
	 *
	 * @var string
	 */
	private $user;

	/**
	 * 密码
	 *
	 * @var string
	 */
	private $password;

	/**
	 * 数据库名称
	 */
	private $db_name;

	/**
	 * 数据库连接
	 *
	 * @var object
	 */
	private $con;

	/**
	 * db对象
	 *
	 * @var string
	 */
	private $db;

	/**
	 * 错误编码
	 *
	 * @var int
	 */
	public $errCode = 0;

	/**
	 * 错误信息
	 *
	 * @var string
	 */
	public $errMsg = '';

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private function clearERR()
	{
		$this->errCode = 0;
		$this->errMsg  = '';
	}

	/**
	 *
	 * @param string host     机器ip
	 * @param int    port     端口
	 * @param string db_name  数据库名称
	 * @param string user     用户名称
	 * @param string password 密码
	 */
	public function __construct($host, $port, $db_name, $user, $password)
	{
		$this->host = $host;
		$this->port = $port;
		$this->db_name = $db_name;
		$this->user = $user;
		$this->password = $password;
	}

	public function __destruct()
	{
		$this->closeDB();
	}

	/**
	 * 初始化对象
	 */
	public  function init()
	{
		@$this->con = mssql_connect($this->host . (empty($this->port) ? '' : (':' . $this->port)), $this->user, $this->password);
		if (!$this->con)
		{
			$this->errCode = 10301;
			$this->errMsg="srv:{$this->host}:{$this->port}} error:".@mssql_get_last_message();
			return false;
		}

		if(!@mssql_select_db($this->db_name, $this->con)){
			$this->errCode = 10302;
			$this->errMsg="db:{$this->host}:{$this->port}:{$this->db_name} error:".@mssql_get_last_message();
			return false;
		}
		return true;
	}


	/**
	 * 更换默认数据库名称
	 */
	function selectDB($db_name){
		$this->db_name = $db_name;
		return mssql_select_db($this->db_name, $this->con);
	}

	/**
	 * 关闭数据库连接
	 */
	function closeDB()
	{
		if ($this->con) {
			return @mssql_close($this->con);
		}
		return true;
	}

	/**
	 * 根据查询sql语句获得指定的数据
	 *
	 * @param  string sql    sql语句
	 * @return bool 正确返回数据,错误返回false
	 */
	public function getRows($sql)
	{
		$this->clearERR();
		for ($i = 0; $i < 2; $i++)
		{
			$result = @mssql_query($sql, $this->con);

			if($result === false){
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:'.@mssql_get_last_message();
				return false;
			}
			break;
		}

		$data = array();
		do
		{
			while ($row = mssql_fetch_array($result, MSSQL_ASSOC))
			{
				$data[] = $row;
			}
		} while(mssql_next_result($result));

		@mssql_free_result($result);
		return $data;
	}

	/**
	 * 获得数据库表的指定行数
	 *
	 * @param   string table    表名称
	 * @param   array fields    需要获取的列名称
	 * @param   string condition    查询条件
	 * @param   int startIndex    开始记录位置
	 * @param   int length    需要取得的条数量
	 *
	 * @return  bool 正确返回true，否则返回false
	 */
	public function getRows2($table, $fields, $condition, $startIndex, $length)
	{
		$this->clearERR();
		$n_str = '';
		$table = $this->msEscapeStr($table);
		if (!empty($fields) && is_array($fields))
		{
			foreach ($fields as $v)
			{
				$n_str .= $this->msEscapeStr($v).',';
			}
			$n_str = preg_replace("/,$/", "", $n_str);
		}
		if (empty($n_str))
		{
			$n_str = '*';
		}

		if(is_int($startIndex) && is_int($length) && $startIndex >= 0 && $length > 0){
			$sql = 'SELECT ' . $n_str.' FROM (SELECT ' . $n_str . ', row_number() over (order by SysNo ASC) rn from '.$table . (!empty($condition) ? (' WHERE '.$condition) : '') .") tmpres where rn > $startIndex and rn <= " . ($startIndex+$length) . "";
		} else {
			$sql = 'SELECT ' . $n_str.' FROM '.$table . (!empty($condition) ? (' WHERE '.$condition) : '');
		}

		for ($i = 0; $i < 2; $i++)
		{
			$result = @mssql_query($sql, $this->con);
			if($result === false){
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:'.@mssql_get_last_message();
				return false;
			}
			break;
		}

		$rows = mssql_num_rows($result);
		if($rows === false){
			$this->errCode = 10305;
			$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:'.@mssql_get_last_message();
			return false;
		}

		$data = array();
		do
		{
			while ($row =  mssql_fetch_array($result, MSSQL_ASSOC))
			{
				$data[] = $row;
			}
		} while(mssql_next_result($result));

		@mssql_free_result($result);
		return $data;
	}

    	/**
	 * 获得数据库表的指定行数
	 *
	 * @param   string table    表名称
	 * @param   array fields    需要获取的列名称
	 * @param   string condition    查询条件
	 * @param   int startIndex    开始记录位置
	 * @param   int length    需要取得的条数量
	 *
	 * @return  bool 正确返回true，否则返回false
	 */
	public function getRows3($table, $fields, $condition, $startIndex, $length,$order='order by SysNo ASC')
	{
		$this->clearERR();
		$n_str = '';
		$table = $this->msEscapeStr($table);
		if (!empty($fields) && is_array($fields))
		{
			foreach ($fields as $v)
			{
				$n_str .= $this->msEscapeStr($v).',';
			}
			$n_str = preg_replace("/,$/", "", $n_str);
		}
		if (empty($n_str))
		{
			$n_str = '*';
		}

        if(''==$order) $order='order by SysNo ASC';
		if(is_int($startIndex) && is_int($length) && $startIndex >= 0 && $length > 0){
			$sql = 'SELECT ' . $n_str.' FROM (SELECT ' . $n_str . ', row_number() over ('.$order.') rn from '.$table . (!empty($condition) ? (' WHERE '.$condition) : '') .") tmpres where rn > $startIndex and rn <= " . ($startIndex+$length) . "";
		} else {
			$sql = 'SELECT ' . $n_str.' FROM '.$table . (!empty($condition) ? (' WHERE '.$condition) : '');
		}

		for ($i = 0; $i < 2; $i++)
		{
			$result = @mssql_query($sql, $this->con);
			if($result === false){
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:'.@mssql_get_last_message();
				return false;
			}
			break;
		}

		$rows = mssql_num_rows($result);
		if($rows === false){
			$this->errCode = 10305;
			$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:'.@mssql_get_last_message();
			return false;
		}

		$data = array();
		do
		{
			while ($row =  mssql_fetch_array($result, MSSQL_ASSOC))
			{
				$data[] = $row;
			}
		} while(mssql_next_result($result));

		@mssql_free_result($result);
		return $data;
	}

	/**
	 * 获得满足条件的记录数量
	 *
	 * @param  string table     表名称
	 * @param  string condition  查询条件
	 *
	 * @return  bool 正确返回true,否则返回false
	 */
	public function getRowsCount($table, $condition)
	{
		$table = $this->msEscapeStr($table);
		$sql = 'SELECT count(*) as c FROM '.$table;
		if (!empty($condition))
		{
			$sql .= ' WHERE '.$condition;
		}
		$data = $this->getRows($sql);
		if ($data === false)
		{
			return false;
		}
		return ((count($data)<=0) ? 0 : $data[0]['c']);
	}

	/**
	 * 直接返回结果集, 以便在特殊应用场景下, 业务逻辑可自行处理返回结果集
	 *
	 * @param		string		$sql, sql语句
	 *
	 * @return		object/bool	正确返回数据,错误返回false
	 */
	public function getRS($sql) {
		$this->clearERR();
		for ($i = 0; $i < 2; $i++)
		{
			$result = @mssql_query($sql, $this->con);
			if($result === false){
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:'.@mssql_get_last_message();
				return false;
			}
			break;
		}
		return $result;
	}

		/**
	 * 执行指定的sql语句,,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 * data:结果数据
	 *
	 * @param  string sql    	sql语句
	 * @return bool 正确返回true 否则返回false
	 */
	public function execSql($sql)
	{
		$this->clearERR();
/*
		if(!preg_match("/^((INSERT)|(UPDATE)|(DELETE)|(select)|(start)|(commit)|())\s/i", $sql))
		{
			$this->errCode = 10302;
			$this->errMsg = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:method cannot support INSERT UPDATE DELETE';
			return false;
		}  */
		for ($i = 0; $i < 2; $i++)
		{
			$result = @mssql_query($sql, $this->con);
			if($result === false){
				$this->errCode = 10303;
				$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql.',error:'.@mssql_get_last_message();
				return false;
			}
			break;
		}
		if ($result === true) return true;
		$this->errCode = 10304;
		$this->errMsg  = 'host:'.$this->host.',port:'.$this->port.',db:'.$this->db_name.',sql:'.$sql;//." affected_rows = {$n}";
		return false;
	}

	/**
	 * 拼装insert的sql语句
	 *
	 * @param string table    表名称
	 * @param array data    数据
	 *
	 * @return string
	 */
	public function getInsertString($table, $data)
	{
		$n_str = '';
		$v_str = '';
		$table = $this->msEscapeStr($table);
		foreach ($data as $k => $v)
		{
			$n_str .= "[".$this->msEscapeStr($k)."],";
			$v_str .= "'".$this->msEscapeStr($v)."',";
		}
		$n_str = preg_replace( "/,$/", "", $n_str );
		$v_str = preg_replace( "/,$/", "", $v_str );
		$str = 'INSERT INTO '.$table.' ('.$n_str.') VALUES('.$v_str.')';
		return $str;
	}

	/**
	 * 新增数据,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 *
	 *
	 * @param string table   表名称
	 * @param array  data    数据
	 * @return 正确返回true，否则返回false
	 */
	public function insert($table, $data)
	{
		$sql = $this->getInsertString($table, $data);
		return $this->execSql($sql);
	}

	public function  getAffectedRows()
	{
		return mssql_rows_affected($this->con);
	}

	/**
	 * 拼装update的sql语句
	 *
	 * @param string  table    表名称
	 * @param array data    数据
	 * @param string condition    条件
	 *
	 * @return string
	 */
	public function getUpdateString($table, $data, $condition)
	{
		$str = '';
		$table = $this->msEscapeStr($table);
		foreach ($data as $k => $v)
		{
			$str .= "[".$this->msEscapeStr($k)."]='".$this->msEscapeStr($v)."',";
		}
		$str = preg_replace("/,$/", "", $str);
    	$sql = 'UPDATE '.$table.' SET '.$str;
    	if (!empty($condition) && is_string($condition))
    	{
    		$sql .= ' WHERE '.$condition;
    	}
		return $sql;
	}

	/**
	 * ,更新数据,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 *
	 * @param string table    表名称
	 * @param array data    数据
	 * @param string condition    查询条件
	 * @return 正确返回true，否则返回false
	 */
	public function update($table, $data, $condition)
	{
		$sql = $this->getUpdateString($table, $data, $condition);
		return $this->execSql($sql);
	}

	/**
	 * 先UPDATE，如果@@ROWCOUNT为零，再INSERT。
	 * @param string $table 表名
	 * @param array $updateData 更新的数据
	 * @param string $condition 查询条件
	 * @param array $insertData 插入的数据
	 * @return 正确返回true，否则返回false
	 */
	public function updateOrInsert($table, $updateData, $condition, $insertData) {
		$updateSql = $this->getUpdateString($table, $updateData, $condition);
		$insertSql = $this->getInsertString($table, $insertData);

		$sql = "$updateSql
			IF @@ROWCOUNT = 0
			$insertSql";
		return $this->execSql($sql);
	}

	/**
	 * 删除指定条件的数据,,返回数组,格式:
	 * code:0为成功，其他为失败
	 * msg:错误消息
	 *
	 * @param  string table     表名称
	 * @param  string condition  查询条件
	 * @return bool 正确返回true，否则返回false
	 *
	 */
	public function remove($table, $condition)
	{
		$table = $this->msEscapeStr($table);
		$sql = 'DELETE FROM '.$table.' WHERE '.$condition;
		return $this->execSql($sql);
	}

	/**
	 * 返回自增字段值
	 *
	 */
	public function getLastId()
	{
		$this->clearERR();
		$table = $this->msEscapeStr($table);
		$sql = 'SELECT SCOPE_IDENTITY() as i';
		if (!empty($condition))
		{
			$sql .= ' WHERE '.$condition;
		}
		$data = $this->getRows($sql);
		if ($data === false)
		{
			return false;
		}
		return ((count($data)<=0) ? 0 : $data[0]['i']);
	}

	/**
	 * 过滤特殊字符
	 *
	 * @param string str    字符串
	 * @return string
	 */
	public function msEscapeStr($str)
	{
		if ( is_numeric($str) ) {
			return $str;
		} else {
			return str_replace("'", "''", $str);
		}
	}
}
//End of script

