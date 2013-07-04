<?php
/*
 *---------------------------------------------------------------------------
 *
 *                  T E N C E N T   P R O P R I E T A R Y
 *
 *     COPYRIGHT (c)  2008 BY  TENCENT  CORPORATION.  ALL RIGHTS
 *     RESERVED.   NO  PART  OF THIS PROGRAM  OR  PUBLICATION  MAY
 *     BE  REPRODUCED,   TRANSMITTED,   TRANSCRIBED,   STORED  IN  A
 *     RETRIEVAL SYSTEM, OR TRANSLATED INTO ANY LANGUAGE OR COMPUTER
 *     LANGUAGE IN ANY FORM OR BY ANY MEANS, ELECTRONIC, MECHANICAL,
 *     MAGNETIC,  OPTICAL,  CHEMICAL, MANUAL, OR OTHERWISE,  WITHOUT
 *     THE PRIOR WRITTEN PERMISSION OF :
 *
 *                        TENCENT  CORPORATION
 *
 *       Advertising Platform R&D Team, Advertising Platform & Products
 *       Tencent Ltd.
 *---------------------------------------------------------------------------
 */

/**
 * Used to load all the class automatically
 *
 * @package PHPLIB.lib
 * @author  Oscarzhu <oscarzhu@tencent.com>
 */
/**
 * Usage:
 *
 *   1. Scan class file and cache
 *   TMAutoload::getInstance()
 *       ->setDirs(array(ROOT_PATH, LIB_PATH))         // dirs needed to scan
 *       ->setSavePath(CACHE_PATH.'autoload/')         // cache file's full path
 *       ->setSaveName('autoloader.cache.php')         // cache file's name
 *       ->execute();
 *
 *   2. Rescan dirs forcly
 *   TMAutoload::getInstance()->execute(true);
 **/
class TMAutoload
{
    private
        $includeFile,
        $cacheFile,
        $savePath,
        $saveName,
        $ignore,
        $dirs;

    public $autoloadPaths;

     /**
     *@var TMAutoload
     *@access private
     */
    private static $instance;

    /**
     * 构造函数
     *
     * @param string $scanDirs
     * @param string $savePath
     * @param string $saveName
     */
    protected function __construct($scanDirs = null, $savePath = null, $saveName = null)
    {
        spl_autoload_register(array('TMAutoload', '__autoload'));

        $this->initialize($scanDirs, $savePath, $saveName);
    }

    /**
     * Get a instance of TMAutoload
     * @access public
     * @param bool $newInstance   create a new instance or not
     * @return TMAutoload
     */
    public static function getInstance($newInstance = false)
    {
        if($newInstance || self::$instance == null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 进行初始化
     *
     * @param string $scanDirs
     * @param string $savePath
     * @param string $saveName
     */
    private function initialize($scanDirs = null, $savePath = null, $saveName = null)
    {
        $this->autoloadPaths = array();
        $this->includeFile = array();
        $this->savePath = $savePath ? $savePath : (empty($this->savePath) ? '/tmp/' : $this->savePath);
        $this->saveName = $saveName ? $saveName : (empty($this->saveName) ? 'autoloader.php' : $this->saveName);
        $this->ignore = array('.', '..', '.svn', '_config', "test", "template");
        $this->dirs = $scanDirs && is_array($scanDirs) ? $scanDirs : (empty($this->dirs) ? array() : $this->dirs);
    }

    /**
     * Customized __autoload function:Autoload the class which registered in autoload.php
     * @access public
     * @param string $className    the class name
     * @return void|string    the error information
     */
    public static function __autoload($className)
    {
        $filePath = self::getInstance()->getClassPath($className);
        if($filePath)
        {
            include_once($filePath);
        }
        else
        {
            self::getInstance()->initialize();
            self::getInstance()->execute(true);
            $filePath = self::getInstance()->getClassPath($className);
            if($filePath)
            {
                include_once($filePath);
            }
            else
            {
                //echo 'Cant find class: '.$className;
            }
        }
    }

    /**
     * add dir to scan dirs dynamically
     * @access public
     * @param string $dir    the dir needs scan
     * @return void
     */
    public function addDir($dir) {
        array_push($this->dirs, $dir);
        return self::$instance;
    }

    /**
     * 增加多个扫描目录
     *
     * @param array $scanDirs
     * @return TMAutoload
     */
    public function addDirs($scanDirs) {
        $scanDirs = is_array($scanDirs) ? $scanDirs : array($scanDirs);
        $this->dirs = array_merge($this->dirs,$scanDirs);
        return self::$instance;
    }

    /**
     * create autoload.php and add customized __autoload function to spl__autoload stack
     * @access public
     * @param bool $reload Reload the autoload file if this parameter is true
     * @return void
     */
    public function execute($reload = false)
    {
        if ($reload)
        {
            if (is_file($this->savePath.$this->saveName))
            {
                unlink($this->savePath.$this->saveName);
            }
        }

        if (!is_file($this->savePath.$this->saveName))
        {
            foreach ($this->dirs as $dir) {
                $this->opendir($dir);
            }

            $this->commit();
            $this->autoloadPaths = include($this->savePath . $this->saveName);
        }
        return self::$instance;
    }

    /**
     * Used to get the path for a unknow class
     * @access public
     * @param string $className the class name
     * @return string|false
     */
    public function getClassPath($className)
    {
        if (!$this->autoloadPaths)
        {
            if (!is_file($this->savePath . $this->saveName))
            {
                $this->execute();
            }
        }

        $this->autoloadPaths = include($this->savePath . $this->saveName);

        if (isset($this->autoloadPaths[$className]))
        {
            return $this->autoloadPaths[$className];
        }
        else
        {
            return false;
        }
    }

    /**
     * Used to save the autoload file:autoload.php
     * @access private
     * @return void
     */
    private function commit()
    {
        $files = array();
        foreach ($this->includeFile as $key => $file)
        {
            if (preg_match('/(\.class){0,1}\.php$/', $key))
            {
                $className = preg_replace('/(\.class){0,1}\.php/', '', $key);
                
                $files[$className] = is_array($file) ? $file[0] : $file;
            }
        }

        $path = $this->savePath;
        $name = $this->saveName;
        $content = "<?php\nreturn ".var_export($files, true).';';

        //include_once LIB_PATH.'cache/TMFileCache.class.php';
        //TMFileCache::getInstance()->execute($path, $name, $content);
        $this->saveCacheFile($path, $name, $content);
    }

    /**
     * Open dir and save to property
     * @access private
     * @param string $dir the dir needs scan
     * @return void
     */
    private function opendir($dir)
    {
        $dir = rtrim($dir,'/ ').'/';
        $handle = opendir($dir);
        while (false !== ($file = readdir($handle)))
        {
            if (!in_array($file, $this->ignore))
            {
                if (is_file($dir.$file))
                {
                    if (isset($this->includeFile[$file])) {//处理不同文件夹下具有相同文件名的类文件 存成数组
                        // the third one
                        // do nothing here
                    }
                    else
                    {
                        $this->includeFile[$file] = $dir.$file;
                    }
                }
                else
                {
                    $this->opendir($dir.$file.'/');
                }
            }
        }
    }

    /**
     * save "class_name => file_path" array into cache file
     * @param string $path the path of cache file
     * @param string $file the name of cache file
     * @param string $content content needed to be cached
     * @return void
     **/
    private function saveCacheFile($path, $name, $content) {
        if (!is_dir($path)) {
            $oldumask = umask(0);
            mkdir($path, 0777, true);
            umask($oldumask);
        }
        file_put_contents($path.$name, $content);
        chmod($path.$name, 0777);
    }

    /**
     * 设置扫描目录
     *
     * @param array $scanDirs
     * @return TMAutoload
     */
    public function setDirs($scanDirs) {
        $this->dirs = is_array($scanDirs) ? $scanDirs : array($scanDirs);
        return self::$instance;
    }

    /**
     * 设置文件保存路径
     *
     * @param string $savePath
     * @return TMAutoload
     */
    public function setSavePath($savePath) {
        $this->savePath = rtrim($savePath,'/ ').'/';
        return self::$instance;
    }

    /**
     * 设置保存缓存文件名
     *
     * @param string $saveName
     * @return TMAutoload
     */
    public function setSaveName($saveName) {
        $this->saveName = $saveName;
        return self::$instance;
    }
}