<?php
	Class IPSFPackageUtils {
		public static $errCode = 0;
		public static $errMsg = '';
		public static function checkPackEnd($data) {
			$arr = unpack('Ilength',substr($data, 0, 4));
			$len = $arr['length'];
			if(strlen($data) >= $len)
				return true;
			return false;
		}
		public static function packData($data) {
			if(!is_array($data)) {
				return false;
			}
			$signData = self::getDataForSign($data);
			$sign = self::genSig($signData, 'k34h&32#');
			$data['sign'] = $sign;
			//$data = self::gbJsonEncode($data);
			$data = json_encode($data);
			$len = pack("I",strlen($data) + 4);
			return $len.$data;
		}
		public static function unPackData($data) {
			$data = substr($data,4);
			//$data = self::gbJsonDecode($data,true);
			$data = json_decode($data, true);
			if(!$data) {
				self::$errMsg = 'decode error';
				return false;
			}
			$signData = self::getDataForSign($data);
			$sign = self::genSig($signData, 'k34h&32#');
			if($data['sign'] != $sign) {
				self::$errMsg = 'sign not match,sign:'.$sign.' dataSign:'.$data['sign'];
				return false;
			}
			return $data;
		}
		public static function getDataForSign($data) {
			$ret = array();
			foreach($data as $k => $v) {
				if(is_array($v)) {
					//$ret[$k] = self::gbJsonEncode($v);
					$ret[$key] = json_encode($v);
				}
				else {
					$ret[$k] = $v;
				}
			}
			return $ret;
		}
		public static function gbJsonDecode($data)
		{
			$data = str_replace("\r\n", "", $data);
			$data = str_replace("\t", "", $data);
			$data = mb_convert_encoding($data, 'UTF-8', 'GBK');
			$data = json_decode($data, true);
			return empty($data) ? "" : self::_gbJsonDecode($data);
		}

		private static function _gbJsonDecode($data)
		{
			if (is_array($data)) {
				$res = array();

				foreach ($data as $key => $value)
					$res[$key] = self::_gbJsonDecode($value);
				return $res;
			} else {
				if(is_string($data)) {
					return mb_convert_encoding($data, 'GBK', 'UTF-8');
				}
				else {
					return $data;
				}
			}
		}
		
		public static function gbJsonEncode($data)
		{
			if (is_object($data)) {
				$data = get_object_vars($data);
			}
			if (is_array($data)) {
				$data = self::_gbkToUtf8($data);
				$data = json_encode($data);
			} else if (is_string($data)) {
				$data = json_encode(iconv("GBK", "UTF-8", $data));
			} else {
				return json_encode($data);
			}

			return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
				create_function(
					'$matches',
					'return iconv("UCS-2BE", "GBK//IGNORE", pack("H*", $matches[1]));'
				),
				$data);
		}

		public static function _gbkToUtf8($data)
		{
			if (is_object($data)) {
				$data = get_object_vars($data);
			}

			if (is_array($data)) {
				$res = array();

				foreach ($data as $key => $val) {
					$key = iconv('GBK', 'UTF-8', $key);
					$res[$key] = self::_gbkToUtf8($val);
				}

				return $res;
			} else if (is_string($data)) {
				return iconv('GBK', 'UTF-8', $data);
			} else {
				return $data;
			}
		}
		public static function genSig($var,$skey,$extra=array(),$sign_type='MD5'){

			if(!is_array($var) || count($var)<1 || empty($skey)){
				return '0';
			}

			$rmKeys = array('callback','sign');

			if(count($extra)>=1){
				$rmKeys = array_merge($rmKeys,$extra);
			}

			ksort($var);
			reset($var);


			$var = array_map('trim',$var);

			$t = '';

			 foreach($var AS $k=>$v){
				#modified by EdisonTsai on 11:28 2012/09/07 for replace '@' to '&'
				#Added by Edison tsai on 15:34 2011/05/07 for remove callback params
				//$k	= strtolower($k);
				$t .= !in_array($k, $rmKeys) ? $k.'='.urlencode($v).'&' : '';
			 } #end foreach

			 switch($sign_type){
					case 'MD5':
								$t = md5($t.$skey);break;
					//TODO: Only support MD5 for now, add new encrypt what you need.
					default:
								$t = md5($t.$skey);break;
			 }

				unset($var,$k,$v);

			return $t;
		}
	}
?>