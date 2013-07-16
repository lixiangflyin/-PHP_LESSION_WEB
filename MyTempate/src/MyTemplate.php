<?php

/**
 *
 * 基于正则表达式和文本替换的简易的PHP模板引擎
 *
 * 思路: 由于模板可能有多层嵌套的,所以先递归替换好所有模板, 得到合成之后的模板(此时只含有变量),然后进行一次变量替换,替换所有变量为实际的字符串即可^_^
 *
 * @author kenzfliang
 *
 */
class MyTemplate {

	// private internal variables
	var $_vars		= array();	// stores all internal assigned variables

	var $template_dir		= "templates";	// where the templates are to be found


	function assign($key, $value = null)
	{
		if (is_array($key))
		{
			foreach($key as $var => $val)
				if ($var != "")
				{
					$this->_vars[$var] = $val;
				}
		}
		else
		{
			if ($key != "")
			{
				$this->_vars[$key] = $value;
			}
		}
	}




	/**
	 * 替换模板,将.tpl里面的{file.tpl}替换为file.tpl的内容
	 * 并八递归替换
	 *
	 * @param unknown $content
	 */
	function replaceTemplate($content)
	{
		//查找模板,如{*.tpl}
		$pattern = '/\{([^\$].*)\}/';

		preg_match_all($pattern, $content,$templates);

		$len = count($templates[1]);

		//将每个要替换的符号替换为模板的内容
		for($i=0; $i < $len; $i++)
		{
			$fileSymble = $templates[0][$i];	//待替换的符号,如: {header.tpl}
			$filename   = $templates[1][$i];

			$file = $this->_get_dir($this->template_dir) . $filename;

			if (file_exists($file))
			{
				$tplContent = file_get_contents($file);

				//$tplContent里也可能include了模板,故递归替换模板
				$tplContent = self::replaceTemplate($tplContent);


				$content = str_ireplace($fileSymble, $tplContent, $content);
			}

		}


		//返回替换后的文本
		return $content;
	}


	/**
	 * 变量替换,将所有{$var}替换为实际的文本
	 * @param unknown $content
	 */
	function replaceVar($content)
	{
		//查找变量,如{$var}
		$pattern = '/\{\$(.*)\}/';

		preg_match_all($pattern, $content,$vars);

		//将每个要替换的符号替换为变量的内容
		$search  = $vars[0];
		$replace = array();


		$len = count($vars[1]);

		//将每个要替换的符号替换为模板的内容
		for($i=0; $i < $len; $i++)
		{
			$varSymble = $vars[0][$i];	//待替换的符号,如: {header.tpl}
			$varname   = $vars[1][$i];

			$replace[] = $this->_vars[$varname];
		}

		//将变量名 替换为 变量的内容
		$content = str_ireplace($search, $replace, $content);

		return $content;
	}


	function display($filename)
	{
		$file = $this->_get_dir($this->template_dir) . $filename;

		if (file_exists($file))
		{
			$content = file_get_contents($file);

			$content = self::replaceTemplate($content);

			$content = self::replaceVar($content);

			echo $content;
		}
	}

	function _get_dir($dir, $id = null)
	{
		if (empty($dir))
		{
			$dir = '.';
		}
		if (substr($dir, -1) != DIRECTORY_SEPARATOR)
		{
			$dir .= DIRECTORY_SEPARATOR;
		}
		if (!empty($id))
		{
			$_args = explode('|', $id);
			if (count($_args) == 1 && empty($_args[0]))
			{
				return $dir;
			}
			foreach($_args as $value)
			{
				$dir .= $value.DIRECTORY_SEPARATOR;
			}
		}
		return $dir;
	}

}
?>