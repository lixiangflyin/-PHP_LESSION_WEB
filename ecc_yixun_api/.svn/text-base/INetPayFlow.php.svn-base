<?php
class INetPayFlow {
    public static $errCode = 0;
    public static $errMsg = '';

    /**
     * 设置错误码和错误信息
     * @param int $code
     * @param string $msg
     * @return null
     */
    private static function setErr($code, $msg = '') {
        self::$errCode = $code;
        self::$errMsg = $msg;
    }

    /**
     * 根据cfg，检查输入数组合法性
     * @param array $check 检查配置
     * @param array $ary 需要检查的数据
     * @return bool
     */
    private static function checkRequireField($check, &$ary) {
        $pass = true;

        foreach ($check as $checkItem => $checkCfgs) {
            switch($checkItem) {
                case 'notEmpty' :
                    //非空检查
                    foreach ($checkCfgs as $checkCfg) {
                        if (!isset($ary[$checkCfg['key']]) || empty($ary[$checkCfg['key']])) {
                            self::setErr(903, "{$checkCfg['key']} empty");
                            $pass = false;
                            break;
                        }
                    }
                    break;

                case 'geZero' :
                    //数值检查
                    foreach ($checkCfgs as $checkCfg) {
                        if (!isset($ary[$checkCfg['key']]) || $ary[$checkCfg['key']] < 0) {
                            self::setErr(903, "{$checkCfg['key']} < 0");
                            $pass = false;
                            break;
                        }
                    }
                    break;

                case 'default' :
                    //设置默认值
                    foreach ($checkCfgs as $checkCfg) {
                        if (!isset($ary[$checkCfg['key']])) {
                            $ary[$checkCfg['key']] = $checkCfg['val'];
                        }
                    }
                    break;
            }
        }

        return $pass;
    }

    /**
     * 添加一条支付流水记录到网站端数据库
     * 增加pay_flow_id : 第三方支付平台的支付流水号
     * 增加ReceiveAccount ：易迅收款帐号的id
     * 增加IsMerge ： 是否拆单，合并支付前全部填写0
     * 增加suborderids ： 此支付流水对应的订单号，多个子单以逗号分隔，（合并支付前填写 order_id 或者 空字符串）
     * 修改order_id ：取订单父订单号
     * 合并支付需要 newFlow 信息，故传引用方式。
     * @param unknown_type $newFlow
     * @return boolean|Ambigous <正确返回true，否则返回false, boolean>
     */
    public static function addNetPayFlow(&$newFlow) {
        $pass = self::checkRequireField(array(
            'notEmpty' => array(
                array('key' => 'uid', ),
                array('key' => 'order_id', ),
                array('key' => 'pay_type', ),
                array('key' => 'pay_amt', ),
                array('key' => 'wh_id', ),
            ),
            'default' => array(
                array(
                    'key' => 'source',
                    'val' => 0,
                ),
                array(
                    'key' => 'note',
                    'val' => '',
                ),
                array(
                    'key' => 'seq_id',
                    'val' => '',
                ),
            ),
            'geZero' => array(
                array('key' => 'ReceiveAccount', ),
                array('key' => 'IsMerge', ),
                array('key' => 'suborderids', ),
            ),
        ), $newFlow);

        if (!$pass) {
            return false;
        }
        //else go through

        $db_tab_index = ToolUtil::getMSDBTableIndex($newFlow['uid'], 'ICSON_ORDER_CORE');
        $orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
        if (false === $orderDb) {
            EL_Flow::getInstance('netpay') -> append("connect to db ICSON_ORDER_CORE failed:" . ToolUtil::gbJsonEncode($flow));
            //记录原始失败
            self::setErr(906, basename(__FILE__, '.php') . " |" . __LINE__ . "connect to db ICSON_ORDER_CORE failed");
            return false;
        }
        $tableName = "t_netpay_flow_{$db_tab_index['table']}";
        $sql = "select sysno, order_char_id from {$tableName} where order_char_id = '{$newFlow['order_id']}'";
        $ret = $orderDb -> getRows($sql);
        if (false === $ret) {
            EL_Flow::getInstance('netpay') -> append("select db failed:" . ToolUtil::gbJsonEncode($flow));
            //记录原始失败
            self::setErr($orderDb -> errCode, $orderDb -> errMsg);
            return false;
        }

        if (count($ret) > 0) {
            $ret = $ret[0];
            if (isset($ret['sysno'])) {
                $newFlow['sysno'] = $ret['sysno'];
            }
            else {
                $auto_id = IIdGenerator::getNewId('Finance_NetPay_sequence');
                if (false === $auto_id) {
                    EL_Flow::getInstance('netpay') -> append("IIdGenerator failed:" . ToolUtil::gbJsonEncode($newFlow));
                    //记录原始失败
                    self::setErr(IIdGenerator::$errCode, IIdGenerator::$errMsg);
                    return false;
                }
                $newFlow['sysno'] = $auto_id;
            }
            return true;
        }
        //else insert

        $now = time();
        $auto_id = IIdGenerator::getNewId('Finance_NetPay_sequence');
        if (false === $auto_id) {
            EL_Flow::getInstance('netpay') -> append("IIdGenerator failed:" . ToolUtil::gbJsonEncode($newFlow));
            //记录原始失败
            self::setErr(IIdGenerator::$errCode, IIdGenerator::$errMsg);
            return false;
        }

        $newFlow['create_time'] = $now;
        $newFlow['sysno'] = $auto_id;

        $flow = array(
            'seq_id' => $newFlow['seq_id'],
            'order_char_id' => $newFlow['order_id'],
            'pay_type' => $newFlow['pay_type'],
            'pay_amt' => $newFlow['pay_amt'],
            'source' => $newFlow['source'],
            'create_time' => $newFlow['create_time'],
            'note' => $newFlow['note'],
            'status' => 0,
            'wh_id' => $newFlow['wh_id'],
            'pay_flow_id' => $newFlow['pay_flow_id'],
            'ReceiveAccount' => $newFlow['ReceiveAccount'],
            'IsMerge' => $newFlow['IsMerge'],
            'suborderids' => $newFlow['suborderids'],
            'sysno' => $newFlow['sysno'],
        );
        $ret = $orderDb -> insert($tableName, $flow);
        if ($ret === false) {
            EL_Flow::getInstance('netpay') -> append("insert {$tableName} failed:" . ToolUtil::gbJsonEncode($flow));
            //记录原始失败
            self::setErr($orderDb -> errCode, $orderDb -> errMsg);
            return false;
        }
        else {
            EL_Flow::getInstance('netpay') -> append("insert {$tableName} success:" . ToolUtil::gbJsonEncode($flow));
            //记录原始成功
            return $ret;
        }
    }

    /**
     * 创建一条支付流水记录，用于插入数据库表t_netpay_flowitem
     * @param array $parentNewFlow 一条父订单支付流水记录
     * @param array $subOrder 子单信息
     * @return mixed
     */
    public static function createNetPayFlowItem(&$parentNewFlow, &$subOrder) {
        $now = time();

        $pass = self::checkRequireField(array(
            'notEmpty' => array(
                array('key' => 'sysno', ),
                array('key' => 'order_id', ),
                array('key' => 'wh_id', ),
                //array('key'=>'pay_flow_id', ), //创建子单流水的时候，不再检查流水pay_flow_id。因为：通联，掌捷，平安分期没有...
            ),
            'default' => array(
                array(
                    'key' => 'status',
                    'val' => 0,
                ),
                array(
                    'key' => 'create_time',
                    'val' => $now,
                ),
                array(
                    'key' => 'seq_id',
                    'val' => '',
                ),
            ),
            'geZero' => array( array('key' => 'ReceiveAccount', ), ),
        ), $parentNewFlow);

        if (!$pass) {
            return false;
        }

        $newFlowItem = array(
            'seq_id' => $parentNewFlow['seq_id'],
            'Netpay_Flow_Sysno' => $parentNewFlow['sysno'],
            'Order_Id' => $subOrder['order_id'], //子单ID
            'Parent_Order_Id' => $parentNewFlow['order_id'], //父单ID
            'wh_id' => $parentNewFlow['wh_id'],
            'pay_flow_id' => $parentNewFlow['pay_flow_id'],
            'ReceiveAccount' => $parentNewFlow['ReceiveAccount'],
            'pay_Type' => $parentNewFlow['pay_type'],
            'Amount' => $subOrder['cash'],
            'status' => $parentNewFlow['status'],
            'note' => $parentNewFlow['pay_flow_id'],
            'create_time' => $parentNewFlow['create_time'],
            'RowCreateDate' => date('Y-m-d H:i:s', $parentNewFlow['create_time']),
            'RowmodifyDate' => date('Y-m-d H:i:s', $parentNewFlow['create_time']),
        );

        return $newFlowItem;
    }

    /**
     * 添加一条支付流水记录到ERP端数据库
     * 合并支付中，针对父单的支付流水，手动建立子单流水并添加到 Icson_Finance 的 t_netpay_flowitem 表。
     * 该表包含以下字段：seq_id, SysNo（自增）, Netpay_Flow_Sysno, Order_Id, Parent_Order_Id, create_time, wh_id,
     * pay_flow_id, ReceiveAccount, pay_Type, Amount, status, note, RowCreateDate, RowmodifyDate。
     * @param array $newFlowItems 合并支付需要插入该项数据。
     * @return bool 正确返回 true，否则返回 false
     */
    public static function addNetPayFlowItems($newFlowItems) {
        $now = time();
        $orderIds = array();

        foreach ($newFlowItems as &$newFlowItem) {//逐条检查
            $pass = self::checkRequireField(array(
                'notEmpty' => array(
                    array('key' => 'Netpay_Flow_Sysno', ),
                    array('key' => 'Order_Id', ),
                    array('key' => 'Parent_Order_Id', ),
                    array('key' => 'wh_id', ),
                    //array('key' => 'pay_flow_id', ),//创建子单流水的时候，不再检查流水pay_flow_id。因为：通联，掌捷，平安分期没有...
                ),
                'geZero' => array(
                    array('key' => 'ReceiveAccount', ),
                    array('key' => 'pay_Type', ),
                    array('key' => 'Amount', ),
                ),
                'default' => array(
                    array(
                        'key' => 'status',
                        'val' => 0,
                    ),
                    array(
                        'key' => 'note',
                        'val' => '',
                    ),
                    array(
                        'key' => 'create_time',
                        'val' => $now,
                    ),
                    array(
                        'key' => 'RowCreateDate',
                        'val' => date('Y-m-d H:i:s', $now),
                    ),
                    array(
                        'key' => 'RowmodifyDate',
                        'val' => date('Y-m-d H:i:s', $now),
                    ),
                    array(
                        'key' => 'seq_id',
                        'val' => '',
                    ),
                ),
            ), $newFlowItem);

            if (!$pass) {
                return false;
            }

            $orderIds[] = $newFlowItem['Order_Id'];
        }

        $finaceDb = ToolUtil::getMSDBObj('Icson_Finance');
        if (false === $finaceDb) {
            EL_Flow::getInstance('netpay_item') -> append("connect to db Icson_Finance failed:" . ToolUtil::gbJsonEncode($newFlowItems));
            //记录原始失败
            self::setErr(906, basename(__FILE__, '.php') . " |" . __LINE__ . "connect to db Icson_Finance failed");
            return false;
        }

        if (!empty($orderIds)) {
            $orderIdsStr = implode(',', $orderIds);
            $sql = "select count(*) as num from t_netpay_flowitem where Order_Id in ({$orderIdsStr})";
            $ret = $finaceDb -> getRows($sql);
            if (false === $ret) {
                EL_Flow::getInstance('netpay_item') -> append("select t_netpay_flowitem failed:" . ToolUtil::gbJsonEncode($newFlowItems));
                //记录原始失败
                self::setErr($finaceDb -> errCode, $finaceDb -> errMsg);
                return false;
            }
            else if ($ret[0]['num'] == count($orderIds)) {
                return true;
            }
        }

        $ret = $finaceDb -> insertMultiple('t_netpay_flowitem', $newFlowItems);
        if ($ret === false) {
            EL_Flow::getInstance('netpay_item') -> append("insert t_netpay_flowitem failed:" . ToolUtil::gbJsonEncode($newFlowItems));
            //记录原始失败
            self::setErr($finaceDb -> errCode, $finaceDb -> errMsg);
            return false;
        }
        else {
            EL_Flow::getInstance('netpay_item') -> append("insert t_netpay_flowitem success:" . ToolUtil::gbJsonEncode($newFlowItems));
            //记录原始成功
            return $ret;
        }
    }

}
