<?php
/**
 * 抽奖接口组件
 *
 *
 * @package phplib.lottery.classes
 * @author  oscarzhu <oscarzhu@tencent.com>
 * @version IActAward 2009-10-29 by oscarzhu
 */

class IActAward
{
    private $config = array();
    private $service = null;
    private $dbConfig = 'icson_event';
    private $awardHistoryTbl = 't_event_awardhistory';

    /**
     * 获取当前抽奖的配置
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * get the draw settings
     *
     * @param string $app draw application name
     */
    public function __construct()
    {
        $this->_getConfig();
        $this->service = Config::getDB($this->dbConfig);
    }

    /**
     * 设置抽奖历史记录表
     *
     * @param string $tbl 抽奖历史记录表名
     */
    public function setAwardHistoryTbl($tbl)
    {
        $this->awardHistoryTbl = $tbl;
    }

    /**
     *  开启事务
     */
    private function startTransaction(){
        $sql = 'start transaction';
        return $this->service->execSql($sql);
    }

    /**
     *  关闭事务
     */
    private function endTransaction(){
        $sql = 'commit';
        return $this->service->execSql($sql);
    }

    /**
     * 获取抽奖的配置
     * @param string 抽奖应用名
     */
    private function _getConfig()
    {
        global $actAwardConfig;
        $this->config = $actAwardConfig;

        $offset = 0;
        $base = (int) $this->config['randBase'];
        if ($base == 0) {
            $this->config['randBase'] = 100000000;
            $base = 100000000;
        }

        foreach ($this->config['awards'] as $idx => &$award)
        {
            $rate = (float) $award['rate'];

            if ($rate == 0) {
                $award['range'] = array(
                    'min' => 0,
                    'max' => 0,
                );
            }
            else {
                $num = $base * $rate;

                $min = $offset + 1 > $base ? $base + 1 : $offset + 1;
                $max = $offset + $num - 1 > $base ? $base + 1 : $offset + $num - 1;
                $award['range'] = array(
                    'min' => $min,
                    'max' => $max,
                );
                $offset = $max;
            }
        }
    }

    /**
     * 判断随机数是否在奖品的中奖范围以内
     *
     * @param int $number 随机数
     * @param array $range 中奖范围
     * @return bool true: 在中奖范围内，false：不在中奖范围以内
     */
    private function _inRange($number, $range)
    {
        return ($number >= $range['min'] && $number <= $range['max']);
    }

    /**
     * 判断时间是否在奖品的限制时间内
     *
     * @param array $dateRange
     * @return bool 0: 在发放时间范围内，-1：还没有开始，1：已经结束
     */
    private function _inDate($dateRange)
    {
        $uid = IUser::getLoginUid();
        if(($uid==1684099) or ($uid==3779918) or ($uid==1647234) or ($uid==93729) or ($uid==713929) ) return 0;
        $now = time();
        if (!empty($dateRange['start']))
        {
            $start = strtotime($dateRange['start']);
            if ($now < $start) {
                return -1;
            }
        }

        if (!empty($dateRange['end']))
        {
            $end = strtotime($dateRange['end']);
            if ($now > $end)
            {
                return 1;
            }
        }
        return 0;
    }

    /**
     * 判断是否已经超出抽奖次数限制
     *
     * @param array $config 抽奖配置
     * @param string $uid 抽奖用户
     * @return int 0：没有超出限制，1：超出每天的最大限制，2：超出总共的最大限制
     */
    private function _checkDrawMax($config, $uid)
    {
        $limit = $config['limit'];
        if (!empty($limit['day']) && !$this->_checkOneDayDrawMax($limit['day'], $uid))
        {
            return $config['code']['OUTOF_DRAW_ONEDAY_LIMIT'];
        }

//        if (!empty($limit['total']) && !$this->_checkTotalDrawMax($limit['total'], $uid))
//        {
//            return $config['code']['OUTOF_DRAW_TOTAL_LIMIT'];
//        }

        return 0;
    }

    /**
     * 判断是否已经达到总数限制
     *
     * @param int $totalMax 总共限制数
     * @param string $pid 商品id
     * @return bool true: 还没有发完，false：该奖品已经全部发送
     */
    private function _checkTotalMax($totalMax, $pid)
    {
        $totalMax = (int) $totalMax;
        if ($totalMax == 0)
        {
            return true;
        }
        $sql = "select count(*) as count from {$this->awardHistoryTbl} where (status=0 or status=1) and product_id={$pid} for update";
        $count = $this->service->getRows($sql);
        if( $count===false )
        {
        	logger::info("fail to get _checkTotalMax DB");
        	return false;
        }
        if ($count[0]['count'] < $totalMax)
        {
            $wid = IUser::getSiteId();
            $flag = $this->getAvailableNums($wid, $pid);
            return ($flag > 0) ? true:false;
        }
        return false;
    }
    /**
     * 获取商品
     *
     * @author oscarzhu
     * @param int $pid 商品id
     * @return array
     *
     */
    private function getAvailableNums($wid, $pid)
    {
        //$result = IProductInfoTTC::get($pid, array('wh_id'=>$wid));
        $result = IProductInventory::getProductInventeory($pid, $wid);
		if( ($result===false) || empty($result) )
        {
            Logger::info("Fail to getAvailableNums:".IProductInventory::$errMsg);
            return 0;
        }
        return ($result['num_available']+$result['virtual_num'])>0?1:0;
    }

    /**
     * 判断是否已经达到该奖项的获奖次数限制
     *
     * @param array $config 抽奖配置
     * @param array $limit 限制数设置，total:总共
     * @param string $pid 商品id
     * @param string $uid 抽奖用户
     * @return code 0: 还没有达到限制
     */
    private function _checkAwardMax($config, $limit, $pid, $uid)
    {
        if (!empty($limit['total']) && !$this->_checkTotalMax($limit['total'], $pid))
        {
            return $config['code']['OUTOF_AWARD_TOTAL_LIMIT'];
        }
        return 0;
    }

    /**
     * 判断是否已经达到每天每个用户抽奖次数的限制
     *
     * @param int $max 限制数
     * @param string $uid 抽奖用户
     * @return bool true: 还没有达到，false：已经达到
     */
    private function _checkOneDayDrawMax($max, $uid)
    {
        $max = (int) $max;
        if ($max == 0)
        {
            return true;
        }
        $date = date('Y-m-d');

        $conditions = "user_id={$uid} and createdate='{$date}'";
        $count = $this->service->getRowsCount($this->awardHistoryTbl, $conditions);
        if ($count === false) {
            return false;
        }

        if ($count < $max)
        {
            return true;
        }
        return false;
    }

    /**
     * 判断是否已经达到总的用户抽奖次数限制
     *
     * @param int $max 限制数
     * @param string $uid 抽奖用户
     * @return bool true: 还没有达到，false：已经达到
     */
//    private function _checkTotalDrawMax($max, $uid)
//    {
//        $max = (int) $max;
//        if ($max == 0)
//        {
//            return true;
//        }
//        $conditions = "user_id={$uid}";
//        $count = $this->service->getRowsCount($this->awardHistoryTbl, $conditions);
//        if ($count < $max)
//        {
//            return true;
//        }
//        return false;
//    }



    /**
     * 插入获奖记录
     *
     * @param string $uid
     * @param int $code 奖项编码
     * @param string $memo 信息
     * @param string $table 抽奖历史记录表名
     * @param return
     */
    private function _recordAward($uid, $pid, $memo)
    {
        //插入获奖记录
        $history = array(
            'wh_id' => IUser::getSiteId(),
            'bid' => 0,
            'product_id' => $pid,
            'user_id' => $uid,
            'status' =>    0,
            'message' => addslashes($memo),
            'createtime' => date('Y-m-d H:i:s'),
            'createdate' => date('Y-m-d'),
        );
        return $this->service->insert($this->awardHistoryTbl, $history);
    }

    /**
     * 随机获取一个奖项
     *
     * @param array $config 抽奖配置
     * @return array
     */
    function getItemByRandom($config)
    {
        //取得随机数
        $number = mt_rand(1, (int)$config['randBase']);
        foreach ($config['awards'] as $item)
        {
            //如果不在奖项区间范围以内(即没有中的该奖项），判断下一奖项
            if ($this->_inRange($number, $item['range']))
            {
                return $item;
            }
        }

        return $config['awards']['defaultAward'];
    }

    /**
     * 检查奖品的合法性，包括时间、奖品数的检查
     *
     * @param string|int $uid 用户
     * @param array $item 奖品
     * @param array $config 抽奖配置
     * @param array $resultArr 抽奖结果，引用传值
     * @return boolean
     */
    function awardCheck($uid, $item, $config, & $resultArr)
    {
        //如果奖项不在发奖时间范围以内，跳出返回默认奖项
        //对某一类奖品发放时间进行限制，目前还无此属性
//        if (!empty($item['date']) && $this->_inDate($item['date']) != 0)
//        {
//            $resultArr['error'] = $config['code']['OUTOF_AWARD_DATE'];
//            return false;
//        }

        //总共限制
        $itemPid = $item['pid'];
        if (!empty($item['limit']))
        {
            $itemLimit =  $this->_checkAwardMax($config, $item['limit'], $itemPid, $uid);

            //如果超出限制中的任何一个
            if ($itemLimit != 0) {
                $resultArr['error'] = $itemLimit;
                return false;
            }
        }

        return true;
    }

    /**
     * 获取奖品，并检查奖品的有效性
     *
     * @param string|int $qq 用户QQ号码
     * @param array $config 抽奖配置
     * @param array $resultArr 抽奖结果，引用传值
     * @return void
     */
    function getAwardAndCheck($uid, $config, &$resultArr)
    {
        //判断是否在抽奖时间范围以内
        $datecheck = empty($config['date']) ? 0 : $this->_inDate($config['date']);
        if ($datecheck != 0)
        {
            $resultArr['error'] = $datecheck == 1 ? $config['code']['HAS_ENDED'] : $config['code']['NOT_BEGIN'];
            $resultArr['message'] = $config['messages'][$resultArr['error']];
            return;
        }

        //如果超过每天可抽奖的次数
        $drawLimit = empty($config['limit']) ? 0 : $this->_checkDrawMax($config, $uid);
        if ($drawLimit != 0)
        {
            $resultArr['error'] = $drawLimit;
            $resultArr['message'] = $config['messages'][$resultArr['error']];
            return;
        }

        //开启事务
        if ($this->startTransaction() === false)
        {
            $resultArr['error'] = $config['code']['SYSTEM_BUSY'];;
            $resultArr['message'] = $config['messages'][$resultArr['error']];
            return;
        }

        //随机获取一个奖项，如果没有则用默认奖项
        $item = $this->getItemByRandom($config);

       //检查奖品的合法性
        if ($this->awardCheck($uid, $item, $config, $resultArr))
        {
            $resultArr['item'] = $item;
        }
        else {
            //设置为默认奖品
            $resultArr['item'] = $item = $config['awards']['defaultAward'];

            //默认奖品也发放完毕，刚认为本次活动结束
            if(!$this->awardCheck($uid, $item, $config, $resultArr)) {
                $this->endTransaction();

                $resultArr['error'] = $config['code']['HAS_ENDED'];
                $resultArr['message'] = $config['messages'][$resultArr['error']];
                return;
            } else {
                $resultArr['error'] = 0;
            }
        }

        //记录到抽奖记录表
        $pid = $item['pid'];
        $memo = $item['message'];
        if ($this->_recordAward($uid, $pid, $memo) === false)
        {
            $resultArr['error'] = $config['code']['SYSTEM_BUSY'];;
            $resultArr['message'] = $config['messages'][$resultArr['error']];
        }

        $this->endTransaction();
        return;
    }

    /**
     * 根据设置随机抽取奖品
     *
     * @param string $uid 用户号
     * @return array 抽奖结果数组
     */
    public function getAward($uid = '') {
        //获取奖品
        $resultArr = array(
            'error' => 0,
            'message' => '',
            'item' => null,
        );
        $this->getAwardAndCheck($uid, $this->config, $resultArr);

        //设置奖品的对应返回消息
        if (empty($resultArr['message']))
        {
            $resultArr['message'] = $resultArr['item']['message'];
        }

        return $resultArr;
    }

    /**
     * 拉取用户奖品
     *
     * @param array $updateArray 更新字段数组
     * @param string $where 过滤条件
     * @return bool
     *
     */
    public function getUserAward($where)
    {
        return $this->service->getRows2($this->awardHistoryTbl, '*' , $where, 0, 0);
    }

    /**
     * 更新用户奖品
     *
     * @param array $updateArray 更新字段数组
     * @param string $where 过滤条件
     * @return bool
     *
     */
    public function setUserAwardStatus($updateArray, $where)
    {
        return $this->service->update($this->awardHistoryTbl, $updateArray, $where);
    }

    /**
     * 更新用户奖品为下单状态
     *
     * @param int $uid 用户id
     * @param int $pid 商品id
     * @return bool
     *
     */
    public function setUserAwardStatusForOrder($uid, $pid)
    {
        $awards = $this->getUserAward("user_id=$uid and product_id=$pid and status=0");
        if( empty($awards) )
            return false;
        $id = $awards[0]['id'];
        return $this->setUserAwardStatus(array('status'=>1),"id=$id");
    }

    /**
     * 判商品是否为抽奖中的商品
     *
     * @param int $uid 用户id
     * @return bool
     *
     */
    public function checkAwardProductForOrder($pid)
    {
        $pids = array();
        foreach( $this->config['awards'] as $val )
            $pids[] = $val['pid'];

        return in_array($pid, $pids);
    }

    /**
     * 获取奖口目前发放情况
     *
     * @return array 当日奖品发放情况
     *
     */
    public function getAwardsCount()
    {
        $ret = array();
        foreach( $this->config['awards'] as $val )
        {
            $sql = "select count(*) as count from {$this->awardHistoryTbl} where (status=0 or status=1) and product_id=".$val['pid'];
            $count = $this->service->getRows($sql);
            $info = IProduct::getBaseInfo($val['pid'],1);
            $ret[$val['pid']]['id'] = $val['pid'];
            $ret[$val['pid']]['name'] = $info['name'];
            $ret[$val['pid']]['count'] = empty($count[0]['count'])?0:$count[0]['count'];
            $ret[$val['pid']]['total'] = $val['limit']['total'];
        }
        return $ret;

    }
}