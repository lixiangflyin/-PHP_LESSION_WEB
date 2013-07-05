<?php
require_once(PHPLIB_ROOT . 'lib/Logger.php');
require_once(PHPLIB_ROOT . 'api/inc/IPromotionRuleValidTTC.php');
require_once(PHPLIB_ROOT . 'api/inc/IPromotionProductRuleMapTTC.php');
require_once(PHPLIB_ROOT . 'api/inc/IPromotionUserRuleMapTTC.php');
require_once(PHPLIB_ROOT . 'api/inc/IPromotionSendCouponTTC.php');
require_once(PHPLIB_ROOT . 'api/inc/ICouponResourceTTC.php');


class EA_Promotion
{
	public static $errCode = 0;
	public static $errMsg = "";

	public function setErr($code, $msg)
	{
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	public function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg = "";
	}

	/**
	 * 批量获取促销规则信息(单品赠券)
	 * @param array $pids    商品列表
	 * @param int $wh_id    商品所在站点
	 * @param $append_detail
	 * @return mixed false 失败； array 成功
	 */
	public static function getPromotionRulesBatch($pids, $wh_id = 0, $append_detail = false)
	{ //此处每个商品对应一条规则，每个规则只返回一张券（前台的限制）
		self::clearErr();
		//检测参数传递情况
		if (empty($pids) || !is_array($pids)) {
			self::setErr(1001, "pids参数传递错误");
			return false;
		}
		if (is_null($wh_id) || !is_numeric($wh_id)) {
			self::setErr(1002, "wh_id参数传递错误");
			return false;
		}

		//先根据商品id批量获取规则编号
		$rules = IPromotionProductRuleMapTTC::gets($pids);
		if (false === $rules) {
			self::setErr(IPromotionProductRuleMapTTC::$errCode, IPromotionProductRuleMapTTC::$errMsg);
			return false;
		} else if (empty($rules)) {
			return array();
		}

		//再根据规则编号获取规则详情$infos
		$rule_ids = array();
		foreach ($rules as $rule) {
			$rule_ids[] = intval($rule['rule_id']);
		}
		$infos = IPromotionRuleValidTTC::gets($rule_ids);
		if (false === $infos) {
			self::setErr(IPromotionRuleValidTTC::$errCode, IPromotionRuleValidTTC::$errMsg);
			return false;
		} else if (empty($infos)) {
			return array();
		}

		//根据分仓号wh_id过滤,根据时间过滤,根据优惠券数量过滤
		$now = time();
		foreach ($infos as $k => $info) {
			if (($info['wh_id'] == 0 || $info['wh_id'] == $wh_id) && $now >= $info['time_begin'] && $now <= $info['time_end'] && $info['coupon_total'] > $info['coupon_used'] && $info['type'] == 1) {
				$coupon_list = explode(",", $info['coupon_list']);
				$info['coupon_list'] = self::getCouponNameBatch($coupon_list);
				if (!is_array($info['coupon_list']) || count($info['coupon_list']) == 0) {
					unset($infos[$k]);
				} else {
					//如果该优惠券的状态不为1，注销这条规则
					$_is_unset = 0;
					foreach ($info['coupon_list'] as $coupon_info) {
						if ($coupon_info['status'] != 1) {
							$_is_unset = 1;
						}
					}
					if ($_is_unset == 1) {
						unset($infos[$k]);
					} else {
						//屏蔽部分信息不显示
						//每个规则只返回一张券
						$infos[$k]['coupon_list'] = array();
						$infos[$k]['coupon_list'][0]['batch'] = $info['coupon_list'][0]['batch'];
						$infos[$k]['coupon_list'][0]['coupon_name'] = $info['coupon_list'][0]['coupon_name'];
						$infos[$k]['coupon_list'][0]['coupon_amt'] = $info['coupon_list'][0]['coupon_amt'];
						/*有多少规则就返回多少券
						foreach($info['coupon_list'] as $t => $coupon_info){
							$infos[$k]['coupon_list'][$t]['batch'] = $coupon_info['batch'];
							$infos[$k]['coupon_list'][$t]['coupon_name'] = $coupon_info['coupon_name'];
							$infos[$k]['coupon_list'][$t]['coupon_amt'] = $coupon_info['coupon_amt'];
						}
						*/
						$info['pid_list'] = unpack('L*', $info['pid_list']);
						if (is_array($info['pid_list']) && !empty($info['pid_list'])) {
							$infos[$k]['pid_list'] = array_values($info['pid_list']);
						}
						unset($infos[$k]['create_user']);
						unset($infos[$k]['create_time']);
						unset($infos[$k]['update_user']);
						unset($infos[$k]['update_time']);
						unset($infos[$k]['active_user']);
						unset($infos[$k]['active_time']);
						unset($infos[$k]['coupon_total']);
						unset($infos[$k]['coupon_used']);
						unset($infos[$k]['user_include']);
					}
				}
			} else {
				unset($infos[$k]);
			}
		}
		return $infos;
	}

	/**
	 * 根据商品id获得促销信息
	 * @param int $product_id    商品ID
	 * @param int $wh_id    分站id
	 * @param bool $append_detail    是否添加赠券详细信息
	 * @return mixed false 失败； array 成功
	 */
	public static function getPromotionRules($product_id, $wh_id = 0, $append_detail = false)
	{ //有多少券都返回一张券（前台限制）
		self::clearErr();
		//检测参数传递情况
		if (is_null($product_id) || !is_numeric($product_id)) {
			self::setErr(1001, "product_id参数传递错误");
			return false;
		}
		if (is_null($wh_id) || !is_numeric($wh_id)) {
			self::setErr(1002, "wh_id参数传递错误");
			return false;
		}

		//先根据商品id获取规则编号
		$rules = IPromotionProductRuleMapTTC::get($product_id);
		if (false === $rules) {
			self::setErr(IPromotionProductRuleMapTTC::$errCode, IPromotionProductRuleMapTTC::$errMsg);
			return false;
		} else if (empty($rules)) {
			return array();
		}

		//再根据规则编号获取规则详情
		$rule_ids = array();
		foreach ($rules as $rule) {
			$rule_ids[] = intval($rule['rule_id']);
		}
		$infos = IPromotionRuleValidTTC::gets($rule_ids);
		if (false === $infos) {
			self::setErr(IPromotionProductRuleMapTTC::$errCode, IPromotionProductRuleMapTTC::$errMsg);
			return false;
		} else if (empty($infos)) {
			return array();
		}
		$package_infos = array();
		$coupon_infos = array();
		foreach ($infos as $k => $info) {
			$infos[$k] = array_merge($infos[$k], array('order' => $rules[$k]['package_order']));
			if ($info['type'] == 1) {
				$coupon_infos[] = $infos[$k];
			} else if ($info['type'] == 2) {
				$package_infos[] = $infos[$k];
			}
		}
		//Logger::info(var_export($package_infos,true));
		//根据分仓号wh_id过滤,根据时间过滤,根据优惠券数量过滤
		$now = time();
		foreach ($coupon_infos as $k => $info) {
			if (($info['wh_id'] == 0 || $info['wh_id'] == $wh_id) && $now >= $info['time_begin'] && $now <= $info['time_end'] && $info['coupon_total'] > $info['coupon_used']) {
				$coupon_list = explode(",", $info['coupon_list']);
				$info['coupon_list'] = self::getCouponNameBatch($coupon_list);
				if (!is_array($info['coupon_list']) || count($info['coupon_list']) == 0) {
					unset($coupon_infos[$k]);
				} else {
					//如果该优惠券的状态不为1，注销这条规则
					$_is_unset = 0;
					foreach ($info['coupon_list'] as $coupon_info) {
						if ($coupon_info['status'] != 1) {
							$_is_unset = 1;
						}
					}
					if ($_is_unset == 1) {
						unset($coupon_infos[$k]);
					} else {
						//屏蔽部分信息不返回给前台
						//每个规则只返回一张券
						$coupon_infos[$k]['coupon_list'] = array();
						$coupon_infos[$k]['coupon_list'][0]['batch'] = $info['coupon_list'][0]['batch'];
						$coupon_infos[$k]['coupon_list'][0]['coupon_name'] = $info['coupon_list'][0]['coupon_name'];
						$coupon_infos[$k]['coupon_list'][0]['coupon_amt'] = $info['coupon_list'][0]['coupon_amt'];
						/*有多少规则就返回多少券
						foreach($info['coupon_list'] as $t => $coupon_info){
							$coupon_infos[$k]['coupon_list'][$t]['batch'] = $coupon_info['batch'];
							$coupon_infos[$k]['coupon_list'][$t]['coupon_name'] = $coupon_info['coupon_name'];
							$coupon_infos[$k]['coupon_list'][$t]['coupon_amt'] = $coupon_info['coupon_amt'];
						}
						*/
						unset($coupon_infos[$k]['pid_list']);
						unset($coupon_infos[$k]['create_user']);
						unset($coupon_infos[$k]['create_time']);
						unset($coupon_infos[$k]['update_user']);
						unset($coupon_infos[$k]['update_time']);
						unset($coupon_infos[$k]['active_user']);
						unset($coupon_infos[$k]['active_time']);
						unset($coupon_infos[$k]['coupon_total']);
						unset($coupon_infos[$k]['coupon_used']);
						unset($coupon_infos[$k]['user_include']);
					}
				}
			} else {
				unset($coupon_infos[$k]);
			}
		}
		$package = array();
		$temp = self::array_sort($package_infos, 'order');
		$package_infos = array_values($temp);
		foreach ($package_infos as $k => $info) {
			if (($info['wh_id'] == 0 || $info['wh_id'] == $wh_id) && $now >= $info['time_begin'] && $now <= $info['time_end']) {
				$pid_list = unpack('L*', $info['pid_list']);
				$package_base_price = 0;
				$package_price = 0;
				$num_limit = 0;
				$pid_and_display = explode(";", $info['coupon_list']);

				$count = 0; //用来记数返回的pidlist的key，除去main_product
				$is_repeat = 0;
                $ret = IProductInventory::checkInventoryProducts($product_id,$pid_list,$wh_id);
                if(false === $ret){
                    self::setErr(IProductInventory::$errCode, IProductInventory::$errMsg);
                    continue;
                }
                else if(count($pid_list) == count($ret)){
                    $package[$k]['pidlist'] = array();
                    foreach ($pid_list as $t => $pid_single) {
                        $temp = IProduct::getProductsInfo(array($pid_single), $wh_id, false, false);
                        $pid = $temp[$pid_single];
                        if ($pid_single == $product_id && $is_repeat == 0) {
                            $discount = explode(",", $pid_and_display[$t - 1]);
                            $package_base_price += $pid['price'] + $pid['cash_back'];
                            $package_price += $pid['price'] + $pid['cash_back'] - $discount[0];
                            $package[$k]['main_product'] = array();
                            $package[$k]['main_product']['pid'] = $pid['product_id'];
                            $package[$k]['main_product']['product_char_id'] = $pid['product_char_id'];
                            $package[$k]['main_product']['name'] = $pid['name'];
                            $package[$k]['main_product']['main_price'] = number_format($pid['price'] / 100, 2, '.', '');
                            if ($pid['num_limit'] > 0) {
                                if ($num_limit == 0) {
                                    $num_limit = $pid['num_limit'];
                                } else if ($num_limit > $pid['num_limit']) {
                                    $num_limit = $pid['num_limit'];
                                }
                            }
                            $is_repeat = 1;
                        } else {
                            $discount = explode(",", $pid_and_display[$t - 1]);
                            $package_base_price += $pid['price'] + $pid['cash_back'];
                            $package_price += $pid['price'] + $pid['cash_back'] - $discount[0];
                            $package[$k]['pidlist'][$count]['pid'] = $pid['product_id'];
                            $package[$k]['pidlist'][$count]['product_char_id'] = $pid['product_char_id'];
                            $package[$k]['pidlist'][$count]['name'] = $pid['name'];
                            $package[$k]['pidlist'][$count]['price'] = number_format($pid['price'] / 100, 2, '.', '');
                            $count++;
                            if ($pid['num_limit'] > 0) {
                                if ($num_limit == 0) {
                                    $num_limit = $pid['num_limit'];
                                } else if ($num_limit > $pid['num_limit']) {
                                    $num_limit = $pid['num_limit'];
                                }
                            }
                        }

                    }
                    //Logger::info(var_export($pids_info,true));
                    $package[$k]['package_name'] = $info['name'];
                    $package[$k]['package_id'] = $info['id'];
                    $package[$k]['package_base_price'] = number_format($package_base_price / 100, 2, '.', '');
                    $package[$k]['package_price'] = number_format($package_price / 100, 2, '.', '');
                    $package[$k]['package_discount_price'] = number_format(($package_base_price - $package_price) / 100, 2, '.', '');
                    $package[$k]['num_limit'] = $num_limit;
                }
			} else {
				continue;
			}
		}
		if (count($package) > 4) {
			$package = array_slice($package, 0, 4);
		}
		$result = array();
		$result['coupon'] = $coupon_infos;
		$result['package'] = $package;
		return $result;
	}

	/**
	 * @param array $rule_ids
	 * @param int $wh_id
	 * @return multitype:    false;    array;
	 */
	public static function getPackageInfoBatch($rule_ids, $wh_id)
	{
		//检测参数传递情况
		if (empty($rule_ids) || !is_array($rule_ids)) {
			self::setErr(1001, "rule_ids参数传递错误");
			return false;
		}
		if (is_null($wh_id) || !is_numeric($wh_id)) {
			self::setErr(1002, "wh_id参数传递错误");
			return false;
		}

		//再根据规则编号获取规则详情$infos
		$infos = IPromotionRuleValidTTC::gets($rule_ids);

		if (false === $infos) {
			self::setErr(IPromotionRuleValidTTC::$errCode, IPromotionRuleValidTTC::$errMsg);
			return false;
		} else if (empty($infos)) {
			return array();
		}
		//TODO  可能需要的检查
		foreach ($infos as $k => $info) {
			$info['pid_list'] = unpack('L*', $info['pid_list']);
			if (is_array($info['pid_list']) && !empty($info['pid_list'])) {
				$infos[$k]['pid_list'] = array_values($info['pid_list']);
			}
			if ($info['wh_id'] != 0 && $info['wh_id'] != $wh_id) {
				unset($infos[$k]);
			}
		}
		return $infos;
	}

	/**
	 * 获取购物车中的套餐信息
	 * @param array $rule_ids
	 * @param int $wh_id
	 * @return mixed
	 */
	public static function getPackageInfoForCart($pkg_ids, $wh_id)
	{
		if (empty($pkg_ids) || !is_array($pkg_ids)) {
			self::setErr(1001, "rule_ids参数传递错误");
			return false;
		}
		if (is_null($wh_id) || !is_numeric($wh_id)) {
			self::setErr(1002, "wh_id参数传递错误");
			return false;
		}
		$packages = self::getPackageInfoBatch($pkg_ids, $wh_id);
		if (false === $packages) {
			self::setErr(self::$errCode, self::$errMsg);
			return false;
		}
		if (empty($packages)) { //未拉取到套餐信息，直接返回
			return array();
		}

		$result = array();
		//验证 & 拉取具体信息
		$now = time();
		foreach ($packages as $k => &$pkg) {
			if (1 == $pkg['status'] && $pkg['time_begin'] <= $now && $now <= $pkg['time_end']) {
				$result[$k]['name'] = $pkg['name'];
				$result[$k]['pid'] = $pkg['id'];
				$result[$k]['product_list'] = array();
				$pids_info = IProduct::getProductsInfo($pkg['pid_list'], $wh_id, false, false); //每个套餐需要拉取一次
				$coupon_info = explode(';', $pkg['coupon_list']); //分割具体优惠信息
				$count = 0;
				foreach ($pids_info as $idx => $pid) {
					$tmp = explode(',', $coupon_info[$count]);
					$result[$k]['product_list'][$pkg['pid_list'][$count]] = array();
					$result[$k]['product_list'][$pkg['pid_list'][$count]]['product_id'] = $pid['product_id']; //商品id
					$result[$k]['product_list'][$pkg['pid_list'][$count]]['product_name'] = $pid['name']; //商品名
					$result[$k]['product_list'][$pkg['pid_list'][$count]]['product_char_id'] = $pid['product_char_id']; //商品varcharid
					$result[$k]['product_list'][$pkg['pid_list'][$count]]['product_amount'] = $pid['price']; //商品原价(单位分)
					$result[$k]['product_list'][$pkg['pid_list'][$count]]['product_saving_amount'] = $tmp[0]; //套餐减免价格
					$count++;
				}
			}
		}
		return $result;
	}

	/**
	 * @param int $rule_id
	 * @param int $wh_id
	 * @return multitype:    false;    array;
	 */
	public static function getPackageInfo($rule_id, $wh_id)
	{
		//检测参数传递情况
		if (is_null($rule_id) || !is_numeric($rule_id)) {
			self::setErr(1001, "rule_id参数传递错误");
			return false;
		}
		if (is_null($wh_id) || !is_numeric($wh_id)) {
			self::setErr(1002, "wh_id参数传递错误");
			return false;
		}

		//再根据规则编号获取规则详情$info
		$info = IPromotionRuleValidTTC::get($rule_id);
		if (false === $info) {
			self::setErr(IPromotionRuleValidTTC::$errCode, IPromotionRuleValidTTC::$errMsg);
			return false;
		} else if (empty($info)) {
			return array();
		}
		//TODO  可能需要的检查
		$temp = unpack('L*', $info[0]['pid_list']);
		$info[0]['pid_list'] = array_values($temp);
		return $info[0];
	}


	/**
	 * @static 根据商品ID获取商品参加的预约活动信息
	 * @param $pids
	 * @param $wh_id
	 */
	public static function getAppointInfo($pids, $wh_id)
	{
		self::clearErr();
		//检测参数传递情况
		if (empty($pids) || !is_array($pids)) {
			self::setErr(1001, "pids参数传递错误");
			return false;
		}
		if (is_null($wh_id) || !is_numeric($wh_id)) {
			self::setErr(1002, "wh_id参数传递错误");
			return false;
		}

		//先根据商品id批量获取规则编号
		$rules = IPromotionProductRuleMapTTC::gets($pids);
		if (false === $rules) {
			self::setErr(IPromotionProductRuleMapTTC::$errCode, IPromotionProductRuleMapTTC::$errMsg);
			return false;
		} else if (empty($rules)) {
			return array();
		}

		//再根据规则编号获取规则详情$infos
		$rule_ids = array();
		foreach ($rules as $k => $rule) {
			$rule_ids[] = intval($rule['rule_id']);
		}
		$infos = IPromotionRuleValidTTC::gets($rule_ids);
		if (false === $infos) {
			self::setErr(IPromotionRuleValidTTC::$errCode, IPromotionRuleValidTTC::$errMsg);
			return false;
		} else if (empty($infos)) {
			return array();
		}
		//根据分仓号wh_id过滤,根据时间过滤,根据优惠券数量过滤
		$now = time();
		$result = array();
		foreach ($infos as $k => $info) {
			if (($info['wh_id'] == 0 || $info['wh_id'] == $wh_id) && $info['type'] == 3) {
				$infos[$k]['pid_list'] = unpack('A300', $info['pid_list']);
				$info_temp = explode(";", $infos[$k]['pid_list'][1]);
				$infos[$k]['pid_list'] = explode(",", $info_temp[0]);
				foreach ($infos[$k]['pid_list'] as $pid) {
					if (in_array($pid, $pids)) {
						$status = -1;
						$result[$pid] = $info;
						$result[$pid]['pid_list'] = $infos[$k]['pid_list'];

						$t1 = $result[$pid]['order_time_from'] = $info_temp[1];
						$t2 = $result[$pid]['order_time_to'] = $info_temp[2];
						$t3 = $result[$pid]['buy_time_from'] = $info_temp[3];
						$t4 = $result[$pid]['buy_time_to'] = $info_temp[4];

						// 确定该获活动的当前状态
						if ($now < $t1) {
							$status = 0;
						} // 比较$t2 和 $t3 的时间大小
						else if ($t2 < $t3) {
							if ($now < $t2) {
								$status = 1;
							} else if ($now < $t3) {
								$status = 4;
							} else if ($now < $t4) {
								$status = 3;
							} else {
								$status = 5;
							}
						} else {
							if ($now < $t3) {
								$status = 1;
							} else if ($now < $t2) {
								$status = 2;
							} else if ($now < $t4) {
								$status = 3;
							} else {
								$status = 5;
							}
						}

						$result[$pid]['eventid'] = $info_temp[5];
						$result[$pid]['status'] = $status;

						// 生成活动url
						//$name = $result[$pid]['eventid'] . substr(md5($result[$pid]['eventid']), 0, 4) . '.html';
						//$event_url = 'http://event.51buy.com/event/' . $name;
						$result[$pid]['event_url'] = $info['url'];

						unset($result[$pid]['time_begin']);
						unset($result[$pid]['time_end']);
						unset($result[$pid]['create_user']);
						unset($result[$pid]['create_time']);
						unset($result[$pid]['update_user']);
						unset($result[$pid]['update_time']);
						unset($result[$pid]['active_user']);
						unset($result[$pid]['active_time']);
						unset($result[$pid]['coupon_total']);
						unset($result[$pid]['coupon_used']);
						unset($result[$pid]['user_include']);
					}
				}
			}
		}

		return $result;
	}

	/**
	 * 批量验证
	 * 提交订单前优惠券检查，池中数量&用户可参加数量
	 * 用户ID 、赠券规则ids,赠券数量数组
	 * 每条订单每条规则一个记录
	 * @param int $uid        用户id
	 * @param array $rules_counts 返券数组结构： pid => array{
	 *                                                        id => count,
	 *                                                    }
	 * @return mixed false 检查失败；
	 *                 array(
	 *                     'errno' => XXX,分为0，1，2，3
	 *                     ('info' => XXX) //根据上面结果决定是否有此数据,结果为0表示正确，info数据结构为array($coupon_list => $count,……)
	 *                 )
	 */
	public static function checkCouponNumBatch($uid, $promoCoupon)
	{

		if (!isset($uid) || $uid <= 0) {
			self::setErr(1001, "uid参数传递错误");
			return false; //参数传递错误
		}
		if (!is_array($promoCoupon) || empty($promoCoupon)) {
			self::setErr(1002, "promoCoupon参数传递错误");
			return false; //参数传递错误
		}

		$result = array(
			'errno'        => 0,
			'success_info' => array(),
			'record_info'  => array(),
		);
		$coupon_used = array();
		foreach ($promoCoupon as $pid => $rule_info) {
			$temp_rule_id = array();
			$temp_count = array();
			$temp_rule_id = array_keys($rule_info);
			$temp_count = array_values($rule_info);
			if (!isset($coupon_used[$temp_rule_id[0]])) {
				$coupon_used[$temp_rule_id[0]] = 0;
			}

			//先取出该规则信息
			$info = IPromotionRuleValidTTC::get($temp_rule_id[0]);
			if (false === $info) {
				self::setErr(IPromotionRuleValidTTC::$errCode, IPromotionRuleValidTTC::$errMsg);

				continue;
			} else if (empty($info)) {
				$result['errno'] = 1; //找不到该规则信息可能是被修改了，即失效了。
				continue;
			} else {
				$info = $info[0];

				$now = time();
				if ($info['time_begin'] > $now || $info['time_end'] < $now) {
					$result['errno'] = 1;
					continue;
					//部分规则已经失效，无法参加（添加错误码区分）
				}
			}

			//得到每个人的限制次数以及剩余优惠券数量
			$join_limit = $info['join_limit'];
			$coupon_remain = $info['coupon_total'] - $info['coupon_used'] - $coupon_used[$info['id']];
			$rule_count = $temp_count[0];
			$join_times_remain = 1;

			//取出该用户参与过该规则的记录，得到还能参与的次数,999为不限，可少调用一次ttc
			if ($join_limit != 999) {
				$filter = array(
					'rule_id' => $info['id'],
				);
				$rule = IPromotionUserRuleMapTTC::get($uid, $filter);
				if (false === $rule) {
					self::setErr(IPromotionUserRuleMapTTC::$errCode, IPromotionUserRuleMapTTC::$errMsg);
					continue;
				}

				$join_times = count($rule); //$rule 如果为空表示没参加过
				$join_times_remain = $join_limit - $join_times;
			}
			if ($join_times_remain <= 0) {
				$result['errno'] = 2;
				continue;
				//用户参与次数达到上限，无法参加（添加错误码区分）
			} else {
				if ($coupon_remain <= 0) {
					$result['errno'] = 3;
					continue;
				} else if ($rule_count > $coupon_remain) {
					//这个返券只能返 $coupon_remain 次
					$result['errno'] = 3;

					$coupon_list = explode(",", $info['coupon_list']);
					$list_temps = self::getCouponNameBatch($coupon_list);
					$result['success_info'][$pid] = array();
					$result['success_info'][$pid]['rule_id'] = $info['id'];
					$result['success_info'][$pid]['count'] = $coupon_remain;
					$coupon_used[$info['id']] += $coupon_remain;
					$result['success_info'][$pid]['coupons_name'] = array();
					$result['success_info'][$pid]['coupons_name'][0] = $list_temps[0]['coupon_name']; //每个规则只返回一张优惠券，写死
					//有多少优惠券就返回多少优惠券
					/*
					foreach($list_temps as $list_temp){
						$result['success_info'][$pid]['coupons_name'][] = $list_temp['coupon_name'];//用于给订单完成后返回给前台成功页面显示，同时在订单中记录该信息
					}
					*/
					$result['record_info'][$info['id']] = $info['coupon_list'];
				} else {
					//next round
					$coupon_list = explode(",", $info['coupon_list']);
					$list_temps = self::getCouponNameBatch($coupon_list);
					$result['success_info'][$pid] = array();
					$result['success_info'][$pid]['rule_id'] = $info['id'];
					$result['success_info'][$pid]['count'] = $rule_count;
					$coupon_used[$info['id']] += $rule_count;
					$result['success_info'][$pid]['coupons_name'] = array();
					$result['success_info'][$pid]['coupons_name'][0] = $list_temps[0]['coupon_name']; //每个规则只返回一张优惠券，写死
					//有多少优惠券就返回多少优惠券
					/*foreach($list_temps as $list_temp){
						$result['success_info'][$pid]['coupons_name'][] = $list_temp['coupon_name'];//用于给订单完成后返回给前台成功页面显示，同时在订单中记录该信息
					}
					*/
					$result['record_info'][$info['id']] = $info['coupon_list'];
				}
			}
		}
		return $result; //pass all check
	}

	/**
	 * 记录用户购买记录，记录发优惠券用表索引，更新规则中的已用优惠券数量
	 * @param int $uid    用户id
	 * @param int $rule_infos = array(
	 *             $rule_id => $coupon_list,
	 * )
	 * @param int $order_time    订单时间
	 * @param $orders_items_array = array(
	 *         $order_id => array(
	 *             $product_id => array(
	 *                 'count' => XXX,
	 *                 'rule_id' =>XXX,
	 *            ),
	 *         ),
	 * );
	 * @return true  中间的错误log记录
	 */
	public static function setUserJoinedRecord($uid, $order_time, $rule_infos, $orders_items_array)
	{
		self::clearErr();
		//检测参数传递情况
		if (empty($uid)) {
			Logger::err("setUserJoinedRecord uid MISS");
		}
		if (empty($order_time)) {
			Logger::err("setUserJoinedRecord order_time MISS");
		}
		if (!is_array($rule_infos) || empty($rule_infos)) {
			Logger::err("setUserJoinedRecord rule_infos MISS");
		}
		if (!is_array($orders_items_array) || empty($orders_items_array)) {
			Logger::err("setUserJoinedRecord orders_items_array MISS");
		}

		foreach ($orders_items_array as $id => $items_array) {
			$order_id = $id;
			$rule_ids = array();
			$rule_counts = array();
			$pid_lists = array();
			$coupon_lists = array();
			foreach ($items_array as $pid => $items_array_info) {
				if (!in_array($items_array_info['rule_id'], $rule_ids)) {
					$rule_ids[] = $items_array_info['rule_id'];
				}
				$rule_counts[$items_array_info['rule_id']] += $items_array_info['count'];
				$pid_lists[$items_array_info['rule_id']] .= $pid . ",";
			}
			foreach ($rule_ids as $rule_id) {
				//更新规则表中的已用优惠券数量
				$promotion_rule_valid_ttc = Config::getTTC('IPromotionRuleValidTTC'); //出错是否也要记录
				$ret = $promotion_rule_valid_ttc->increment(array('id' => $rule_id), 'coupon_used', $rule_counts[$rule_id]);
				if ($ret === false) {
					$ret = $promotion_rule_valid_ttc->increment(array('id' => $rule_id), 'coupon_used', $rule_counts[$rule_id]);
					if ($ret === false) {
						EL_Flow::getInstance('promotion')->append("increment coupon_used failed,rule_id:{$rule_id},num:{$rule_counts[$rule_id]}");
					}
				}
				$param_for_record = array(
					'uid'         => $uid,
					'order_id'    => $order_id,
					'rule_id'     => $rule_id,
					'coupon_list' => $rule_infos[$rule_id],
					'pid_list'    => $pid_lists[$rule_id],
					'rule_count'  => $rule_counts[$rule_id],
					'order_time'  => $order_time,
					'is_send'     => 0,
				);
				$ret_for_record = IPromotionUserRuleMapTTC::insert($param_for_record);
				if ($ret_for_record === false) {
					//错误则再执行一次
					$ret_for_record = IPromotionUserRuleMapTTC::insert($param_for_record);
					if ($ret_for_record === false) {
						self::setErr(IPromotionUserRuleMapTTC::$errCode, IPromotionUserRuleMapTTC::$errMsg);
						EL_Flow::getInstance('promotion')->append("insert IPromotionUserRuleMapTTC failed,uid:" . $param_for_record['uid'] . " order_id:" . $param_for_record['order_id'] . " ,error:" . IPromotionUserRuleMapTTC::$errMsg);
					}
				}
				//同时在t_send_coupon中写入$uid,$order_id,$rule_id
				$param_for_send = array(
					'uid'      => $uid,
					'order_id' => $order_id,
					'rule_id'  => $rule_id,
				);
				$ret_for_send = IPromotionSendCouponTTC::insert($param_for_send);
				if ($ret_for_send === false) {
					//错误则再执行一次
					$ret_for_send = IPromotionSendCouponTTC::insert($param_for_send);
					if ($ret_for_send === false) {
						self::setErr(IPromotionSendCouponTTC::$errCode, IPromotionSendCouponTTC::$errMsg);
						EL_Flow::getInstance('promotion')->append("insert IPromotionUserRuleMapTTC failed,uid:" . $param_for_record['uid'] . "order_id:" . $param_for_record['order_id'] . " ,error:" . IPromotionUserRuleMapTTC::$errMsg);
					}
				}
			}
		}
		return true;
	}

	/**
	 * 根据优惠券批次号数组，批量获得对应的优惠券信息，返回优惠券名称数组
	 * @param array $batchs        券批次号数组
	 * @return  mix  false/array()/$result array        优惠券名称数组
	 */
	public static function getCouponNameBatch(array $batchs)
	{
		self::clearErr();
		$infos = ICouponResourceTTC::gets($batchs);
		if ($infos === false) {
			self::setErr(ICouponResourceTTC::$errCode, ICouponResourceTTC::$errMsg);
			return false;
		} else if (empty($infos)) {
			return array();
		} else {
			return $infos;
		}
	}

	/**
	 * 根据数组中的某个value，对一个数组中的子数组进行排序
	 * @param array $arr        要排序的一个数组
	 * @param  string $keys        value对应的key值
	 * @param  string $type        升序和降序
	 * @return   array        排序后的数组
	 */
	public static function array_sort($arr, $keys, $type = 'asc')
	{
		$keysvalue = $new_array = array();
		foreach ($arr as $k=> $v) {
			$keysvalue[$k] = $v[$keys];
		}
		if ($type == 'asc') {
			asort($keysvalue);
		} else {
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach ($keysvalue as $k=> $v) {
			$new_array[$k] = $arr[$k];
		}
		return $new_array;
	}

}

/*
1.1商详页
传商品ID  获取规则信息

通过优惠券ID获取优惠券信息（待一休确认）

1.2购物车
传商品ID（同商详页）

1.3订单页
将用户ID 、订单号、商品、赠券规则id、优惠券批次、赠券数量通过接口写入

更新规则记录接口，更新剩余赠券数量
是否参与下单事务（待确认）

1.4订单成功页
传用户ID、订单ID返回赠券信息
*/
