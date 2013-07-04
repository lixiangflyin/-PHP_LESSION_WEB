<?php
require_once ROOT_DIR . 'lib/Logger.php';
define('DIRTY_FILE', ROOT_DIR . 'etc/dirty.txt');

/**
 * 脏话库的过滤
 * @author 付学宝
 * @version 1.0
 * @created 20-七月-2008 23:11:54
 */
class Dirty
{
	// 错误编码
	public static $errCode = 0;

	//错误信息, 无错误为''
	public static $errMsg  = '';

	// 单例模式
	private static $dirty;

	// 脏话库关键字文件
	private static $fileName;

	// 保存脏话的数组
	private static $dirtyWords;

	private static $sep	= '|';
	private static $cmmt	= '#';
	private static $level	= 0;

	public function __construct($filename = DIRTY_FILE, $level = 0, $sep = '|', $cmmt = '#') 
	{
		if ( !empty(self::$dirty) ) {
			return;
		}

		self::$fileName		= $filename;
		self::$level		= $level;
		self::$sep			= $sep;
		self::$cmmt			= $cmmt;
		self::$dirtyWords	= array();

        if ( !empty(self::$fileName) ) {
        	self::init();
        }

        self::$dirty = $this;
	}

	/**
	 * 清除错误信息, 在每个函数的开始调用
	 */
	private static function clearError() {
		self::$errCode	= 0;
		self::$errMsg	= '';
	}

	/**
	 * 初始化
	 */
	private function init() {
		$lines = file(self::$fileName);

		if ( empty($lines) ) {
			self::$errCode	= 10701;
			self::$errMsg	= 'open file ' . self::$fileName . ' error';
			Logger::err(self::$errMsg);
			return;
		}

		$line_num = 0;

        foreach ($lines as $line) {
        	$line_num++;
        	$line = trim($line);

            if ( empty($line) ) {
            	continue;
            }

			// 忽略注释行
			if ( $line[0] == self::$cmmt ) {
				continue;
			}

            $word = explode(self::$sep, $line);
			if ( !is_array($word) || count($word) != 2 ) {
				self::$errCode	= 10702;
				self::$errMsg	= 'dirty file ' . self::$fileName . " line {$line_num} has error";
				Logger::err(self::$errMsg);
				continue;
			}

			self::$dirtyWords[$word[0]] = $word[1];
        }
	}

	/**
	 * 检查字符串中是否有脏话
	 *
	 * @param string	str    字符串
	 * @return int		如果字符串中包含脏话的话返回脏话等级,否则返回false
	 */
	public static function hasDirty($str) {
		self::clearError();

		if ( empty(self::$dirty) ) {
			self::$dirty = new Dirty();
		}

		reset(self::$dirtyWords);

        while ( list($key, $v) = each(self::$dirtyWords) ) {
            if ( strpos($str, $key) !== false && ($v <= self::$level || 0 == self::$level) ) {
            	return $v;
            }
        }

        return false;
	}

	/**
	 * 检查一个单词是否是脏话
	 *
	 * @param string word    单词
	 * @return int		如果字符串中包含脏话的话返回脏话等级,否则返回false
	 */
	public static function isDirty($word) {
		self::clearError();

		if ( empty(self::$dirty) ) {
			self::$dirty = new Dirty();
		}

        if ( isset(self::$dirtyWords[$word]) && (self::$dirtyWords[$word] <= self::$level || 0 == self::$level) ) {
        	return self::$dirtyWords[$word];
        }

        return false;
	}

	/**
	 * 把字符串中的脏话替换成指定的字符
	 *
	 * @param string	str    字符串
	 * @param string	rChar    脏话需要替换的字符
	 *
	 * @return string
	 */
	public static function replaceDirty($str, $rChar='*') {
		self::clearError();

		if ( empty(self::$dirty) ) {
			self::$dirty = new Dirty();
		}

		reset(self::$dirtyWords);

        while ( list($key, $v) = each(self::$dirtyWords) ) {
            if ( strpos($str, $key) !== false && ($v <= self::$level || 0 == self::$level) ) {
            	$rStr = str_pad('', mb_strlen($key, 'utf-8'), $rChar);
				$str  = mb_str_replace($key, $rStr, $str);
            }
        }

        return $str;
	}
}

//End of script

