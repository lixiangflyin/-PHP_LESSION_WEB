<?php
namespace ECC\Order;

require_once (PHPLIB_ROOT . 'inc/uniorder.inc.php');
require_once (PHPLIB_ROOT . 'api/appplatform/deal51buyao_php5_stub.php');
require_once (PHPLIB_ROOT . 'api/appplatform/iasgatewayao_php5_stub.php');
require_once (PHPLIB_ROOT . 'api/IUniUser.php');

use \Logger;
use \ToolUtil;

Logger::init();

class IcsonOrder {
    //订单基础参数
    private static $baseData = array();

    private static $err_arr = array(
        '1000' => array(
            'code' => 1000,
            'msg' => '用户ID为空'
        ),
        '1001' => array(
            'code' => 1001,
            'msg' => '获取统一用户ID失败'
        ),
        '1002' => array(
            'code' => 1002,
            'msg' => '获取统一订单信息失败'
        ),
        '1003' => array(
            'code' => 1003,
            'msg' => '调用AO服务失败'
        ),
        '1004' => array(
            'code' => 1004,
            'msg' => '订单已支付'
        ),
        '1005' => array(
            'code' => 1005,
            'msg' => '查询无此订单'
        ),
        '1006' => array(
            'code' => 1006,
            'msg' => '订单状态不正确'
        ),
        '1007' => array(
            'code' => 1007,
            'msg' => ''
        ),
        '1008' => array(
            'code' => 1008,
            'msg' => ''
        )
    );
    /**
     * 设置订单基础参数
     * @param $uid int 易迅平台用户id
     * @param $wgid int 统一平台用户id
     */
    private static function setBaseData($uid, $wgid) {
        self::$baseData = array(
            'uid' => $uid,
            'buyerId' => $wgid,
            'eventSource' => __FILE__,
            'machineKey' => isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : '',
            'clientIp' => ToolUtil::getClientIP()
        );
    }

    /**
     * 创建订单
     * @param $data Array
     * @return array
     */
    public static function create($data) {
        Logger::info("ECC\Order\IcsonOrder::create(" . ToolUtil::gbJsonEncode($data) . ")");
        if (empty($data['uid'])) {
            Logger::err("ECC\Order\IcsonOrder::create failed, uid is empty.");
            return array(
                'retCode' => self::$err_arr['1000']['code'],
                'retMsg' => self::$err_arr['1000']['msg']
            );
        }
        else {
            $uid = $data['uid'];
        }
        if (empty($data['wgid'])) {
            $wgid = \ECC\User\IcsonUser::GetWgUidByIcsonUid($uid);
            if ($wgid === false) {
                Logger::err("ECC\Order\IcsonOrder::create->IcsonUser::GetWgUidByIcsonUid failed, uid:{$uid}, wgid:{$wgid}");
                return array(
                    'retCode' => self::$err_arr['1001']['code'],
                    'retMsg' => self::$err_arr['1001']['msg']
                );
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::create->IcsonUser::GetWgUidByIcsonUid success, uid:{$uid}, wgid:{$wgid}");
            }
        }
        else {
            $wgid = $data['wgid'];
        }
        self::setBaseData($uid, $wgid);
        $reqData = array(
            'opt' => array(
                'uin' => $wgid,
                'operator' => $wgid,
                'itil' => '631525|631526|631527'//对应setItilId(success|fail|timeout)
            ),
            'req' => array(
                "source" => __FILE__,
                "machineKey" => self::$baseData['machineKey'],
                "verifyToken" => "",
                "baseParams" => self::getEventParamsBaseBo(),
                "orderList" => self::getOrderPoList($data['orderInfoList']),
                "reserveIn" => ""
            )
        );
        //Logger::info("ECC\Order\IcsonOrder::create(" . var_export($reqData, true) . ")");
        $result = \WebStubCntl2::request('ecc\deal\ao\CreateBuyDeal', $reqData);
        if ($result === false) {
            Logger::err("ECC\Order\IcsonOrder::create->WebStubCntl2::request failed, uid:{$uid}, wgid:{$wgid}");
            return array(
                'retCode' => self::$err_arr['1003']['code'],
                'retMsg' => self::$err_arr['1003']['msg']
            );
        }
        else {
            if ($result['code'] != 0) {
                $msg = iconv('UTF-8', 'GBK', $result['msg']);
                Logger::err("ECC\Order\IcsonOrder::create->WebStubCntl2::request failed, uid:{$uid}, wgid:{$wgid}, code:{$result['code']}, msg:{$msg}");
                return array(
                    'retCode' => self::$err_arr['1008']['code'],
                    'retMsg' => $msg . "({$result['code']})"
                );
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::create->WebStubCntl2::request success, uid:{$uid}, wgid:{$wgid}");
                return array(
                    'retCode' => 0,
                    'retMsg' => '',
                    'data' => $result['data']['bdealInfo']
                );
            }
        }
    }

    /**
     * 取消订单
     * @param $uid
     * @param $bdealId 统一平台父订单号，灰度期间传易迅父订单
     * @param $dealId 统一平台子订单号，灰度期间传易迅子订单
     * @param $wgid int 统一平台用户id
     * @return array
     */
    public static function cancel($uid, $bdealId, $dealId = '', $wgid = 0) {
        if (empty($wgid)) {
            $wgid = \ECC\User\IcsonUser::GetWgUidByIcsonUid($uid);
            if ($wgid === false) {
                Logger::err("ECC\Order\IcsonOrder::cancel->IcsonUser::GetWgUidByIcsonUid failed, uid:{$uid}, bdealId:{$bdealId}, dealId:{$dealId}, wgid:{$wgid}");
                return array(
                    'retCode' => self::$err_arr['1001']['code'],
                    'retMsg' => self::$err_arr['1001']['msg']
                );
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::cancel->IcsonUser::GetWgUidByIcsonUid success, uid:{$uid}, bdealId:{$bdealId}, dealId:{$dealId}, wgid:{$wgid}");
            }
        }
        self::setBaseData($uid, $wgid);

        //通过易迅订单查询统一订单信息
        $deal = self::queryBdeal($uid, $bdealId, 1, 0, $wgid);
        if ($deal['retCode'] !== 0) {
            Logger::err("ECC\Order\IcsonOrder::cancel->IcsonOrder::queryBdeal failed, uid:{$uid}, bdealId:{$bdealId}, dealId:{$dealId}, wgid:{$wgid}");
            return array(
                'retCode' => $deal['retCode'],
                'retMsg' => $deal['retMsg']
            );
            return false;
        }
        else {
            Logger::info("ECC\Order\IcsonOrder::cancel->IcsonOrder::queryBdeal success, uid:{$uid}, bdealId:{$bdealId}, dealId:{$dealId}, wgid:{$wgid}, bdealCode:{$deal['data']['bdealCode']}");
            //获取统一订单的父单id
            $bdealId = $deal['data']['bdealCode'];
            //获取统一订单的子单id
            $dealInfoList = $deal['data']['dealInfoList']['dealInfoList'];
            if (!empty($dealId) && !empty($dealInfoList)) {
                for ($i = 0, $len = count($dealInfoList); $i < $len; $i++) {
                    if ($dealInfoList[$i]['businessDealId'] == $dealId) {
                        $dealId = $dealInfoList[$i]['dealId'];
                        break;
                    }
                }
            }
        }
        $result = \WebStubCntl2::request('ecc\deal\ao\CancelBuyDeal', array(
            'opt' => array(
                'uin' => $wgid,
                'operator' => $wgid,
                'itil' => '631531|631532|631533'//对应setItilId(success|fail|timeout)
            ),
            'req' => array(
                "source" => __FILE__,
                "machineKey" => self::$baseData['machineKey'],
                "verifyToken" => "",
                "baseParams" => self::getEventParamsBaseBo(array(
                    'bdealId' => $bdealId,
                    'dealId' => $dealId,
                )),
                "reserveIn" => "",
            )
        ));
        if ($result === false) {
            Logger::err("ECC\Order\IcsonOrder::cancel->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, dealId:{$dealId}, wgid:{$wgid}");
            return array(
                'retCode' => self::$err_arr['1003']['code'],
                'retMsg' => self::$err_arr['1003']['msg']
            );
        }
        else {
            if ($result['code'] != 0) {
                $msg = iconv('UTF-8', 'GBK', $result['msg']);
                Logger::err("ECC\Order\IcsonOrder::cancel->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, dealId:{$dealId}, wgid:{$wgid}, code:{$result['code']}, msg:{$msg}");
                if ($result['code'] == 177) {//状态不对，不能取消
                    return array(
                        'retCode' => self::$err_arr['1006']['code'],
                        'retMsg' => self::$err_arr['1006']['msg'] . "({$result['code']})"
                    );
                }
                else {
                    return array(
                        'retCode' => self::$err_arr['1008']['code'],
                        'retMsg' => $msg . "({$result['code']})"
                    );
                }
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::cancel->WebStubCntl2::request success, uid:{$uid}, bdealId:{$bdealId}, dealId:{$dealId}, wgid:{$wgid}");
                return array(
                    'retCode' => 0,
                    'retMsg' => '',
                    'data' => $result['data']['bdealInfo']
                );
            }
        }
    }

    /**
     * 通知订单支付状态
     * @param $uid int
     * @param $bdealId 购买单号，灰度期间传易迅单号
     * @param $payCash int 现金支付金额
     * @param $payTime int 支付时间
     * @param $payDealId string 支付订单号,如财付通单号
     * @param $paySeqId string  统一支付平台支付单id
     * @param $payBusinessId string  支付业务单号，灰度期间传易迅单号， 后面是要传统一订单的（订单号+支付单号）
     * @param $bank string 银行类型
     * @param $receiveAccount int 收款银行帐号
     * @param $wgid int 统一平台用户id
     * @return array
     */
    public static function notifyPayment($uid, $bdealId, $payCash, $payTime, $payDealId, $paySeqId, $payBusinessId, $bank, $receiveAccount, $wgid = 0) {
        if (empty($wgid)) {
            $wgid = \ECC\User\IcsonUser::GetWgUidByIcsonUid($uid);
            if ($wgid === false) {
                Logger::err("ECC\Order\IcsonOrder::notifyPayment->IcsonUser::GetWgUidByIcsonUid failed, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, payDealId:{$payDealId}, paySeqId:{$paySeqId}, payBusinessId:{$payBusinessId}, bank:{$bank}, receiveAccount:{$receiveAccount}, wgid:{$wgid}");
                return array(
                    'retCode' => self::$err_arr['1001']['code'],
                    'retMsg' => self::$err_arr['1001']['msg']
                );
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::notifyPayment->IcsonUser::GetWgUidByIcsonUid success, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, payDealId:{$payDealId}, paySeqId:{$paySeqId}, payBusinessId:{$payBusinessId}, bank:{$bank}, receiveAccount:{$receiveAccount}, wgid:{$wgid}");
            }
        }
        self::setBaseData($uid, $wgid);

        //通过易迅订单查询统一订单信息
        $deal = self::queryBdeal($uid, $bdealId, 1, 0, $wgid);
        if ($deal['retCode'] !== 0) {
            Logger::err("ECC\Order\IcsonOrder::notifyPayment->IcsonOrder::queryBdeal failed, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, payDealId:{$payDealId}, paySeqId:{$paySeqId}, payBusinessId:{$payBusinessId}, bank:{$bank}, receiveAccount:{$receiveAccount}, wgid:{$wgid}");
            return array(
                'retCode' => $deal['retCode'],
                'retMsg' => $deal['retMsg']
            );
            return false;
        }
        else {
            Logger::info("ECC\Order\IcsonOrder::notifyPayment->IcsonOrder::queryBdeal success, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, payDealId:{$payDealId}, paySeqId:{$paySeqId}, payBusinessId:{$payBusinessId}, bank:{$bank}, receiveAccount:{$receiveAccount}, wgid:{$wgid}, bdealCode:{$deal['data']['bdealCode']}");
            $bdealId = $deal['data']['bdealCode'];
        }
        $result = \WebStubCntl2::request('ecc\deal\ao\NotifyBuyDealPayment', array(
            'opt' => array(
                'uin' => self::$baseData['buyerId'],
                'operator' => self::$baseData['buyerId'],
                'itil' => '631534|631535|631536'//对应setItilId(success|fail|timeout)
            ),
            'req' => array(
                "source" => __FILE__,
                "machineKey" => self::$baseData['machineKey'],
                "verifyToken" => "",
                "baseParams" => self::getEventParamsBaseBo(array('bdealId' => $bdealId)),
                "payParams" => self::getEventParamsPayBo(array(
                    'feeCash' => $payCash, //现金支付金额
                    'payTime' => $payTime, //支付时间
                    'payDealId' => $payDealId, //支付订单号,如财付通单号
                    'paySeqId' => $paySeqId, //统一支付平台支付单id
                    'payBusinessId' => $payBusinessId, //支付业务单号，支付系统的业务订单号
                    'bankType' => $bank, //银行类型
                    'receiveAccount' => $receiveAccount, //收款帐号
                )),
                "reserveIn" => "",
            )
        ));

        if ($result === false) {
            Logger::err("ECC\Order\IcsonOrder::notifyPayment->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, payDealId:{$payDealId}, paySeqId:{$paySeqId}, payBusinessId:{$payBusinessId}, bank:{$bank}, receiveAccount:{$receiveAccount}, wgid:{$wgid}");
            return array(
                'retCode' => self::$err_arr['1003']['code'],
                'retMsg' => self::$err_arr['1003']['msg']
            );
        }
        else {
            if ($result['code'] != 0) {
                $msg = iconv('UTF-8', 'GBK', $result['msg']);
                Logger::err("ECC\Order\IcsonOrder::notifyPayment->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, payDealId:{$payDealId}, paySeqId:{$paySeqId}, payBusinessId:{$payBusinessId}, bank:{$bank}, receiveAccount:{$receiveAccount}, wgid:{$wgid}, code:{$result['code']}, msg:{$msg}");

                if ($result['code'] == 190) {//190为统一订单平台返回的已支付成功
                    return array(
                        'retCode' => self::$err_arr['1004']['code'],
                        'retMsg' => self::$err_arr['1004']['msg'] . "({$result['code']})"
                    );
                }
                else if ($result['code'] == 255) {//没有此订单
                    return array(
                        'retCode' => self::$err_arr['1005']['code'],
                        'retMsg' => self::$err_arr['1005']['msg'] . "({$result['code']})"
                    );
                }
                else {
                    return array(
                        'retCode' => self::$err_arr['1008']['code'],
                        'retMsg' => $msg . "({$result['code']})"
                    );
                }
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::notifyPayment->WebStubCntl2::request success, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, payDealId:{$payDealId}, paySeqId:{$paySeqId}, payBusinessId:{$payBusinessId}, bank:{$bank}, receiveAccount:{$receiveAccount}, wgid:{$wgid}");
                return array(
                    'retCode' => 0,
                    'retMsg' => '',
                    'data' => $result['data']['bdealInfo']
                );
            }
        }
    }

    /**
     * 添加订单支付流水
     * @param $uid int
     * @param $bdealId 购买单号，灰度期间传易迅单号
     * @param $payCash int 现金支付金额
     * @param $payTime int 支付时间
     * @param $isMerge string  0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单)
     * @param $dealPayList string  支付同步入参订单列表
     * @param $wgid int 统一平台用户id
     * @return array
     */
    public static function addNetPayFlow($uid, $bdealId, $payCash, $payTime, $isMerge, $dealPayList, $wgid = 0) {
        if (empty($wgid)) {
            $wgid = \ECC\User\IcsonUser::GetWgUidByIcsonUid($uid);
            if ($wgid === false) {
                Logger::err("ECC\Order\IcsonOrder::addNetPayFlow->IcsonUser::GetWgUidByIcsonUid failed, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, isMerge:{$isMerge}, wgid:{$wgid}");
                return array(
                    'retCode' => self::$err_arr['1001']['code'],
                    'retMsg' => self::$err_arr['1001']['msg']
                );
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::addNetPayFlow->IcsonUser::GetWgUidByIcsonUid success, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, isMerge:{$isMerge}, wgid:{$wgid}");
            }
        }
        self::setBaseData($uid, $wgid);

        $result = \WebStubCntl2::request('ecc\deal\ao\OnlinePayNotify', array(
            'opt' => array(
                'uin' => self::$baseData['buyerId'],
                'operator' => self::$baseData['buyerId'],
                //'itil' => ''//对应setItilId(success|fail|timeout)
            ),
            'req' => array(
                "source" => __FILE__,
                "bdealParams" => self::getOnlinePayBdealParams($bdealId, $payCash, $payTime, $isMerge, $dealPayList),
                "reserveIn" => ""
            )
        ));
        if ($result === false) {
            Logger::err("ECC\Order\IcsonOrder::addNetPayFlow->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, isMerge:{$isMerge}, wgid:{$wgid}");
            return array(
                'retCode' => self::$err_arr['1003']['code'],
                'retMsg' => self::$err_arr['1003']['msg']
            );
        }
        else {
            if ($result['code'] != 0) {
                $msg = iconv('UTF-8', 'GBK', $result['msg']);
                Logger::err("ECC\Order\IcsonOrder::addNetPayFlow->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, isMerge:{$isMerge}, wgid:{$wgid}, code:{$result['code']}, msg:{$msg}");
                return array(
                    'retCode' => self::$err_arr['1008']['code'],
                    'retMsg' => $msg . "({$result['code']})"
                );
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::addNetPayFlow->WebStubCntl2::request success, uid:{$uid}, bdealId:{$bdealId}, payCash:{$payCash}, payTime:{$payTime}, isMerge:{$isMerge}, wgid:{$wgid}");
                return array(
                    'retCode' => 0,
                    'retMsg' => ''
                );
            }
        }
    }

    /**
     * 通过易迅订单号获取统一平台的订单信息
     * @param $uid int
     * @param $bdealId string 易迅订单号
     * @param $type int 查询类型
     * @param $history int
     * @param $wgid int 统一平台用户id
     * @return array
     */
    public static function queryBdeal($uid, $bdealId, $type = 5, $history = 0, $wgid = 0) {
        if (empty($wgid)) {
            $wgid = \ECC\User\IcsonUser::GetWgUidByIcsonUid($uid);
            if ($wgid === false) {
                Logger::err("ECC\Order\IcsonOrder::queryBdeal->IcsonUser::GetWgUidByIcsonUid failed, uid:{$uid}, bdealId:{$bdealId}, wgid:{$wgid}");
                return array(
                    'retCode' => self::$err_arr['1001']['code'],
                    'retMsg' => self::$err_arr['1001']['msg']
                );
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::queryBdeal->IcsonUser::GetWgUidByIcsonUid success, uid:{$uid}, bdealId:{$bdealId}, wgid:{$wgid}");
            }
        }
        self::setBaseData($uid, $wgid);

        $result = \WebStubCntl2::request('ecc\deal\ao\SysQueryBdeal', array(
            'opt' => array(
                'uin' => self::$baseData['buyerId'],
                'operator' => self::$baseData['buyerId'],
                'itil' => '631528|631529|631530'//对应setItilId(success|fail|timeout)
            ),
            'req' => array(
                "source" => __FILE__,
                "machineKey" => self::$baseData['machineKey'],
                "verifyToken" => "",
                "infoType" => $type, //信息类型  $UNPDealInfoType_E
                "historyFlag" => $history, //历史订单标识，0当前订单 1历史订单
                "version" => 0,
                "queryFilter" => self::getDealQueryBo($bdealId),
                "reserveIn" => ""
            )
        ));
        if ($result === false) {
            Logger::err("ECC\Order\IcsonOrder::queryBdeal->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, type:{$type}, history:{$history}, wgid:{$wgid}");
            return array(
                'retCode' => self::$err_arr['1003']['code'],
                'retMsg' => self::$err_arr['1003']['msg']
            );
        }
        else {
            if ($result['code'] != 0) {
                $msg = iconv('UTF-8', 'GBK', $result['msg']);
                Logger::err("ECC\Order\IcsonOrder::queryBdeal->WebStubCntl2::request failed, uid:{$uid}, bdealId:{$bdealId}, type:{$type}, history:{$history}, wgid:{$wgid}, code:{$result['code']}, msg:{$msg}");
                if ($result['code'] == 255) {//没有此订单
                    return array(
                        'retCode' => self::$err_arr['1005']['code'],
                        'retMsg' => self::$err_arr['1005']['msg'] . "({$result['code']})"
                    );
                }
                else {
                    return array(
                        'retCode' => self::$err_arr['1008']['code'],
                        'retMsg' => $msg . "({$result['code']})"
                    );
                }
            }
            else {
                Logger::info("ECC\Order\IcsonOrder::queryBdeal->WebStubCntl2::request success, uid:{$uid}, bdealId:{$bdealId}, type:{$type}, history:{$history}, wgid:{$wgid}");
                return array(
                    'retCode' => 0,
                    'retMsg' => '',
                    'data' => $result['data']['bdealInfo']
                );
            }
        }
    }

    /**
     * 获取订单列表对象
     * @param $data Array
     * @return OrderPoList
     */
    private static function getOrderPoList($data) {
        //$poList = new \ecc\deal\po\OrderPoList();
        $poList = array();

        $orderPoList = array();
        for ($i = 0, $len = count($data); $i < $len; $i++) {
            $orderPoList[] = self::getOrderPo($data[$i]);
        }
        $poList['orderInfoList'] = $orderPoList;

        return $poList;
    }

    /**
     * 获取订单对象
     * @param $data Array
     * @return OrderPo
     */
    private static function getOrderPo($data) {
        //$po = new \ecc\deal\po\OrderPo();
        $po = array();

        $tmp_data = self::getMappingOrderPoRequiredFields($data);
        foreach ($tmp_data as $key => $val) {
            $data[$key] = $val;
        }
        $po['dealId'] = '';
        //<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702，可为空(版本>=0)
        $po['dealId64'] = 0;
        //<uint64_t> 订单单号，拍拍订单同步可使用，可为空(版本>=0)
        $po['bdealId'] = 0;
        //<uint64_t> 交易单号，可为空(版本>=0)
        $po['businessDealId'] = $data['businessDealId'];
        //<std::string> 业务订单编号，第三方托管订单(版本>=0)灰度双写期间需要购物流程设置易迅网站端订单号到该字段；灰度完之后由OMS返回进行设置，购物流程不需要设置
        $po['buyerId'] = $data['buyerId'];
        //<uint64_t> 买家ID(版本>=0)
        $po['buyerAccount'] = $data['buyerAccount'];
        //<std::string> 买家帐号(版本>=0)
        $po['buyerNickName'] = iconv('GBK', 'UTF-8', $data['buyerNickName']);
        //<std::string> 买家姓名(版本>=0)
        $po['buyerNick'] = iconv('GBK', 'UTF-8', $data['buyerNick']);
        //<std::string> 买家昵称(版本>=0)
        $po['sellerId'] = $data['sellerId'];
        //<uint64_t> 商家ID(版本>=0)
        $po['sellerTitle'] = iconv('GBK', 'UTF-8', $data['sellerTitle']);
        //<std::string> 商家真实名称(版本>=0)
        $po['sellerNick'] = iconv('GBK', 'UTF-8', $data['sellerNick']);
        //<std::string> 卖家昵称(版本>=0)
        $po['businessId'] = $data['businessId'];
        //<uint32_t> 业务ID(版本>=0)
        $po['dealType'] = $data['dealType'];
        //<uint8_t> 订单类型(版本>=0)
        $po['dealSource'] = $data['dealSource'];
        //<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
        $po['dealPayType'] = $data['dealPayType'];
        //<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
        $po['dealState'] = $data['dealState'];
        //<uint32_t> 订单状态(版本>=0)
        $po['dealProperty'] = 0;
        //<uint32_t> 订单属性值，通用(版本>=0)
        $po['dealProperty1'] = 0;
        //<uint32_t> 订单属性值，业务1扩展用(版本>=0)
        $po['dealProperty2'] = $data['dealProperty2'];
        //<uint32_t> 订单属性值，业务2扩展用(版本>=0)
        $po['dealProperty3'] = 0;
        //<uint32_t> 订单属性值，业务3扩展用(版本>=0)
        $po['dealProperty4'] = 0;
        //<uint32_t> 订单属性值，业务4扩展用(版本>=0)
        $po['itemSkuidList'] = '';
        //<std::string> 商品skuID列表(版本>=0)
        $po['itemTitleList'] = '';
        //<std::string> 商品标题列表(版本>=0)
        $po['dealTotalFee'] = $data['dealTotalFee'];
        //<uint32_t> 订单总金额,下单金额(版本>=0)
        $po['dealAdjustFee'] = $data['dealAdjustFee'];
        //<int> 调价金额(版本>=0)
        $po['dealPayment'] = $data['dealPayment'];
        //<uint32_t> 实付总金额(版本>=0)
        $po['dealDownPayment'] = 0;
        //<uint32_t> C2B预售定金金额(版本>=0)
        $po['dealDiscountTotal'] = $data['dealDiscountTotal'];
        //<int> 优惠总金额; 活动列表优惠金额汇总(版本>=0)
        $po['dealItemTotalFee'] = $data['dealItemTotalFee'];
        //<uint32_t> 商品子单总金额(版本>=0)
        $po['dealWhoPayShippingFee'] = $data['dealWhoPayShippingFee'];
        //<uint32_t> 谁支付邮费，1：卖家；2：买家(版本>=0)
        $po['dealShippingFee'] = $data['dealShippingFee'];
        //<uint32_t> 邮费金额(版本>=0)
        $po['dealWhoPayCodFee'] = 0;
        //<uint32_t> 谁承担COD手续费，1：卖家承担；2：买家；3：平台承担(版本>=0)
        $po['dealCodFee'] = 0;
        //<uint32_t> COD手续额(版本>=0)
        $po['dealWhoPayInsuranceFee'] = 0;
        //<uint32_t> 谁支付保险费，1：卖家赠送；2：买家；3：平台承担(版本>=0)
        $po['dealInsuranceFee'] = $data['dealInsuranceFee'];
        //<uint32_t> 运费保险费(版本>=0)
        $po['dealSysAdjustFee'] = 0;
        //<int> 系统调价金额，用于区分COD卖家调价金额和用于凑整的COD优惠金额(版本>=0)
        $po['payScore'] = $data['payScore'];
        //<uint32_t> 积分支付值(版本>=0)
        $po['obtainScore'] = $data['obtainScore'];
        //<uint32_t> 获得积分值(版本>=0)
        $po['dealGenTime'] = $data['dealGenTime'];
        //<uint32_t> 订单生成时间(版本>=0)
        $po['sendFromDesc'] = $data['sendFromDesc'];
        //<std::string> 订单发货地描述(版本>=0)
        $po['dealSeq'] = $data['dealSeq'];
        //<uint64_t> 下单时间戳(版本>=0)
        $po['dealMd5'] = $data['dealMd5'];
        //<uint64_t> 下单md5(版本>=0)
        $po['dealIp'] = $data['dealIp'];
        //<std::string> 下单IP(版本>=0)
        $po['dealRefer'] = $data['dealRefer'];
        //<std::string> refer(版本>=0)
        $po['dealVisitKey'] = $data['dealVisitKey'];
        //<std::string> visitkey(版本>=0)
        $po['promotionDesc'] = '';
        //<std::string> 订单促销信息描述(版本>=0)
        $po['recvName'] = iconv('GBK', 'UTF-8', $data['recvName']);
        //<std::string> 收货人(版本>=0)
        $po['recvRegionCode'] = $data['recvRegionCode'];
        //<uint32_t> 地区编码(版本>=0)
        $po['recvAddress'] = iconv('GBK', 'UTF-8', $data['recvAddress']);
        //<std::string> 地址(版本>=0)
        $po['recvPostCode'] = $data['recvPostCode'];
        //<std::string> 邮编(版本>=0)
        $po['recvPhone'] = $data['recvPhone'];
        //<std::string> 电话(版本>=0)
        $po['recvMobile'] = $data['recvMobile'];
        //<uint64_t> 手机(版本>=0)
        $po['expectRecvTime'] = $data['expectRecvTime'];
        //<uint32_t> 期望收货时间,天(版本>=0)
        $po['expectRecvTimeSpan'] = $data['expectRecvTimeSpan'];
        //<std::string> 期望收货时段(版本>=0)
        $po['recvRemark'] = iconv('GBK', 'UTF-8', $data['recvRemark']);
        //<std::string> 收货附言(版本>=0)
        $po['recvMask'] = $data['recvMask'];
        //<uint32_t> 收货属性值(版本>=0)
        $po['expressType'] = 0;
        //<uint8_t> 配送方式；1：平邮；2：快递；3：EMS；4：B2C自建物流；5：用户配送点自提(版本>=0)
        $po['expressCompanyID'] = '';
        //<std::string> 物流公司ID(版本>=0)
        $po['expressCompanyName'] = '';
        //<std::string> 物流公司名称(版本>=0)
        $po['invoiceType'] = $data['invoiceType'];
        //<uint8_t> 发票类型(版本>=0)
        $po['invoiceHead'] = iconv('GBK', 'UTF-8', $data['invoiceHead']);
        //<std::string> 发票抬头(版本>=0)
        $po['invoiceContent'] = iconv('GBK', 'UTF-8', $data['invoiceContent']);
        //<std::string> 发票内容(版本>=0)
        $po['cftDealId'] = '';
        //<std::string> Cft支付单号(版本>=0)
        $po['lastUpdateTime'] = 0;
        //<uint32_t> 最后更新时间(版本>=0)
        $po['tradeInfoList'] = self::getOrderTradePoList($data['tradePoList']);
        //<ecc::deal::po::COrderTradePoList> 商品子单列表(版本>=0)
        //$po['payInfoList'] =new \ecc\deal\po\OrderPayInfoPoList();
        //<ecc::deal::po::COrderPayInfoPoList> 支付信息表(版本>=0)
        //$po['actionLogInfoList'] =new \ecc\deal\po\DealActionLogPoList();
        //<ecc::deal::po::CDealActionLogPoList> 流水日志表(版本>=0)
        //$po['dealExtInfoMap'] = new \stl_multimap2();
        //<std::multimap<uint32_t,std::string> > 订单扩展信息 (版本>=0)
        $po['bdealCode'] = '';
        //<std::string> 交易单编号，即字符串格式的交易单号，可为空(版本>=1)
        $po['businessBdealId'] = $data['businessBdealId'];
        //<std::string> 业务交易单号，可为空(版本>=1)
        $po['siteId'] = $data['siteId'];
        //<uint32_t> 分站ID(版本>=1)
        $po['dealCouponFee'] = $data['dealCouponFee'];
        //<int> 优惠券金额(版本>=1)
        $po['cashScore'] = $data['cashScore'];
        //<uint32_t> 现金积分支付值(版本>=1)
        $po['promotionScore'] = $data['promotionScore'];
        //<uint32_t> 促销积分支付值(版本>=1)
        $po['recvRegionCodeExt'] = $data['recvRegionCodeExt'];
        //<std::string> 扩展地区编码(版本>=1)
        $po['dealDigest'] = '';
        //<std::string> 订单摘要(版本>=1)
        $po['payInstallmentBank'] = $data['payInstallmentBank'];
        //<std::string> 分期付款银行  对应于易迅网站端订单installment_bank字段
        $po['payInstallmentNum'] = $data['payInstallmentNum'];
        //<uint16_t> 分期付款期数; 对应于易迅网站端订单installment_num字段
        $po['payInstallmentPayment'] = $data['payInstallmentPayment'];
        //<uint32_t> 分期付款每期金额; 对应于易迅网站端订单cash_per_month字段
        $po['icsonShippingType'] = $data['icsonShippingType'];
        //<std::string> 易迅配送方式(版本>=1)
        $po['icsonPayType'] = $data['icsonPayType'];
        //<std::string> 易迅支付方式(版本>=1)
        $po['icsonAccount'] = $data['icsonAccount'];
        //<std::string> 易迅内部帐号ID(版本>=1)
        $po['icsonMasterLs'] = $data['icsonMasterLs'];
        //<std::string> 易迅跟踪信息(版本>=1)
        $po['icsonRate'] = $data['icsonRate'];
        //<std::string> 易迅平衡比率(版本>=1)
        $po['icsonBankRate'] = $data['icsonBankRate'];
        //<std::string> 易迅银行利率(版本>=1)
        $po['icsonShopId'] = $data['icsonShopId'];
        //<std::string> 易迅店铺id(版本>=1)
        $po['icsonShopGuideId'] = $data['icsonShopGuideId'];
        //<std::string> 易迅店铺导购id(版本>=1)
        $po['icsonShopGuideCost'] = $data['icsonShopGuideCost'];
        //<std::string> 易迅店铺导购费用(版本>=1)
        $po['icsonShopGuideName'] = iconv('GBK', 'UTF-8', $data['icsonShopGuideName']);
        //<std::string> 易迅店铺导购名称(版本>=1)
        $po['icsonSubsidyType'] = $data['icsonSubsidyType'];
        //<std::string> 易迅节能补贴类型(版本>=1)
        $po['icsonSubsidyName'] = iconv('GBK', 'UTF-8', $data['icsonSubsidyName']);
        //<std::string> 易迅节能补贴名称(版本>=1)
        $po['icsonSubsidyIdCard'] = $data['icsonSubsidyIdCard'];
        //<std::string> 易迅节能补贴编号(版本>=1)
        $po['icsonCSOrderOperatorId'] = '';
        //<std::string> 易迅客服下单操作员ID(版本>=1)
        $po['icsonCSOrderOperatorName'] = '';
        //<std::string> 易迅客服下单操作员名称(版本>=1)
        $po['icsonInvoiceCompanyName'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceCompanyName']);
        //<std::string> 易迅发票公司名称(版本>=1)
        $po['icsonInvoiceCompanyAddr'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceCompanyAddr']);
        //<std::string> 易迅发票公司地址(版本>=1)
        $po['icsonInvoiceCompanyPhone'] = $data['icsonInvoiceCompanyPhone'];
        //<std::string> 易迅发票公司电话(版本>=1)
        $po['icsonInvoiceCompanyTaxNo'] = $data['icsonInvoiceCompanyTaxNo'];
        //<std::string> 易迅发票公司税号(版本>=1)
        $po['icsonInvoiceCompanyBankNo'] = $data['icsonInvoiceCompanyBankNo'];
        //<std::string> 易迅发票公司银行账户(版本>=1)
        $po['icsonInvoiceCompanyBankName'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceCompanyBankName']);
        //<std::string> 易迅发票公司银行名称(版本>=1)
        $po['icsonInvoiceRecvName'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceRecvName']);
        //<std::string> 易迅发票收货人(版本>=1)
        $po['icsonInvoiceRecvAddr'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceRecvAddr']);
        //<std::string> 易迅发票收货地址(版本>=1)
        $po['icsonInvoiceRecvRegionId'] = $data['icsonInvoiceRecvRegionId'];
        //<std::string> 易迅发票收货地址ID(版本>=1)
        $po['icsonInvoiceRecvMobile'] = $data['icsonInvoiceRecvMobile'];
        //<std::string> 易迅发票收货手机(版本>=1)
        $po['icsonInvoiceRecvTel'] = $data['icsonInvoiceRecvTel'];
        //<std::string> 易迅发票收货电话(版本>=1)
        $po['icsonInvoiceRecvZip'] = $data['icsonInvoiceRecvZip'];
        //<std::string> 易迅发票收货邮编(版本>=1)
        $po['icsonInvoiceShipType'] = $data['icsonInvoiceShipType'];
        //<std::string> 易迅发票配送方式(版本>=1)
        $po['icsonInvoiceShipFee'] = $data['icsonInvoiceShipFee'];
        //<std::string> 易迅发票配送费用(版本>=1)
        $po['icsonDealFlag'] = $data['icsonDealFlag'];
        //<std::string> 易迅订单flag(版本>=1)
        $po['icsonStockNo'] = $data['icsonStockNo'];
        //<std::string> 易迅订单物流仓库编号(版本>=1)
        $po['payChannel'] = $data['payChannel'];
        //<uint8_t> 支付渠道(版本>=2)
        $po['payServiceFee'] = $data['payServiceFee'];
        //<uint32_t> 支付手续费(版本>=2)
        $po['icsonDealCashBack'] = $data['icsonDealCashBack'];
        //<uint32_t> 订单返现金额(版本>=2)
        $po['payInstallmentFee'] = $data['payInstallmentFee'];
        //<uint32_t> 分期付款手续费(版本>=3)
        $po['icsonDealCode'] = $data['icsonDealCode'];
        //<std::string> 易迅订单号，带10开头(版本>=4)
        $po['icsonInvoiceStockNo'] = $data['icsonInvoiceStockNo'];
        //<std::string> 易迅货票分离仓库id(版本>=5)
        $po['icsonInvoiceSiteId'] = $data['icsonInvoiceSiteId'];
        //<std::string> 易迅货票分离分站id(版本>=5)
        $po['sellerCorpId'] = $data['sellerCorpId'];
        //<uint64_t> 易迅联营商家id(版本>=6)
        $po['lmsVolume'] = $data['lmsVolume'];
        //<std::string> 易迅联营体积(版本>=6)
        $po['lmsWeight'] = $data['lmsWeight'];
        //<std::string> 易迅联营重量(版本>=6)
        $po['lmsLongest'] = $data['lmsLongest'];
        //<std::string> 易迅联营最长边(版本>=6)
        $po['dealActiveInfoList'] = $data['dealActiveInfoList'];
        //<ecc::deal::po::CTradeActivePoList> 订单活动列表(版本>=7)

        return $po;
    }

    /**
     * 获取订单字段，将易迅字段映射为统一订单的必填字段
     * @param $data Array
     * @return
     */
    private static function getMappingOrderPoRequiredFields($data) {
        global $UNPSellerAccount51Buy_E, $UNPDealBusiness_E, $UNPDealType_E, $UNPDealState_E, $UNPDealRecvMask_E, $UNPDealProperty51Buy_E, $UNPDealPayType_E;
        $order = array();

        //灰度双写期间需要购物流程设置易迅网站端订单号到该字段；灰度完之后由OMS返回进行设置，购物流程不需要设置
        $order['businessDealId'] = $data['order_id'];
        //<std::string> 业务订单编号，第三方托管订单(版本>=0)
        $order['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> 买家ID(版本>=0)
        $order['buyerAccount'] = isset($data['buyerAccount']) ? $data['buyerAccount'] : '';
        //<std::string> 买家帐号(版本>=0)
        $order['buyerNickName'] = isset($data['buyerNickName']) ? $data['buyerNickName'] : '';
        //<std::string> 买家姓名(版本>=0)
        $order['buyerNick'] = isset($data['buyerNick']) ? $data['buyerNick'] : '';
        //<std::string> 买家昵称(版本>=0)
        $order['sellerId'] = $GLOBALS['UNPSellerAccount51Buy_E']['sellerId'];
        //<uint64_t> 商家ID(版本>=0)
        $order['sellerTitle'] = $GLOBALS['UNPSellerAccount51Buy_E']['sellerTitle'];
        //<std::string> 商家真实名称(版本>=0)
        $order['sellerNick'] = $GLOBALS['UNPSellerAccount51Buy_E']['sellerNick'];
        //<std::string> 卖家昵称(版本>=0)
        $order['businessId'] = $UNPDealBusiness_E['UNP_DEAL_BUSINESS_51BUY'];
        //<uint32_t> 业务ID(版本>=0)
        $order['dealType'] = $UNPDealType_E['UNP_DEAL_TYPE_SHOPCART'];
        //<uint8_t> 订单类型(版本>=0)
        $order['dealSource'] = self::getMappingUniDealSource($data['ls']);
        //<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
        $order['dealPayType'] = 0;
        //<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)

        //在线支付和线下支付（邮局汇款vs银行电汇）初始状态为：UNP_DEAL_STATE_WAIT_PAY（未付款待审核）；
        $dealState = $UNPDealState_E['UNP_DEAL_STATE_WAIT_PAY'];
        //货到付款初始状态为：UNP_DEAL_STATE_WAIT_CHECK（待审核）；
        //0元订单处理逻辑：初始状态UNP_DEAL_STATE_WAIT_CHECK（待审核）
        if ($order['dealPayType'] === $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_COD'] || $data['cash'] === 0) {
            $dealState = $UNPDealState_E['UNP_DEAL_STATE_WAIT_CHECK'];
        }
        $order['dealState'] = $dealState;
        //<uint32_t> 订单状态(版本>=0)
        $order['dealProperty2'] |= self::getDealProperty2($data['flag'], $data['bits']);

        /**
         * 【订单】
         * 下单时: DealTotalFee = DealPayment
         * DealPayment =DealItemTotalFee + DealShippingFee + DealCodFee + DealInsuranceFee + DealAdjustFee + DealSysAdjustFee
         * DealDiscountTotal = 各个商品子单TradeDiscountTotal之和
         * DealItemTotalFee = 各个商品子单TradePayment之和
         */
        $order['dealTotalFee'] = $data['cash'];
        //<uint32_t> 订单总金额,下单金额(版本>=0) 下单时: DealTotalFee = DealPayment
        $order['dealAdjustFee'] = isset($data['dealAdjustFee']) ? $data['dealAdjustFee'] : 0;
        //<int> 调价金额(版本>=0)
        $order['dealPayment'] = $data['cash'];
        //<uint32_t> 实付总金额(版本>=0)
        $order['dealDiscountTotal'] = $data['discount'];
        //<int> 优惠总金额; 活动列表优惠金额汇总(版本>=0)  各个商品子单TradeDiscountTotal之和
        $order['dealItemTotalFee'] = isset($data['totalFee']) ? $data['totalFee'] : 0;
        //<uint32_t> 商品子单总金额(版本>=0) 各个商品子单TradePayment之和

        $order['dealWhoPayShippingFee'] = 2;
        //<uint32_t> 谁支付邮费，1：卖家；2：买家(版本>=0)
        $order['dealShippingFee'] = $data['shipping_cost'];
        //<uint32_t> 邮费金额(版本>=0)
        $order['dealInsuranceFee'] = $data['premium_cost'];
        //<uint32_t> 运费保险费(版本>=0)
        $order['payScore'] = $data['point_pay'];
        //<uint32_t> 积分支付值(版本>=0)
        $order['obtainScore'] = $data['point'];
        //<uint32_t> 获得积分值(版本>=0)
        $order['dealGenTime'] = time();
        //<uint32_t> 订单生成时间(版本>=0)
        $order['sendFromDesc'] = isset($data['seller_address_id']) ? $data['seller_address_id'] : '';
        //<std::string> 卖家仓地址
        $order['dealSeq'] = $order['dealGenTime'];
        //<uint64_t> 下单时间戳(版本>=0)
        $order['dealMd5'] = self::md5Int($order['buyerId'] . $order['dealSeq'] . $data['item_ids']);
        //<uint64_t> 下单md5(版本>=0) BuyerId,DealSeq,DealMd5这三个的组合是唯一的，且是每个OrderPo中的都是三值组合唯一的
        $order['dealIp'] = $data['customer_ip'];
        //<std::string> 下单IP(版本>=0)
        $order['dealRefer'] = isset($data['cpsinfo']) ? $data['cpsinfo'] : '';
        //<std::string> refer(版本>=0)
        $order['dealVisitKey'] = self::$baseData['machineKey'];
        //<std::string> visitkey(版本>=0)
        $order['recvName'] = $data['receiver'];
        //<std::string> 收货人(版本>=0)
        $order['recvRegionCode'] = 0;
        //<uint32_t> 地区编码(版本>=0)统一用户系统获取的地址编码
        $order['recvAddress'] = $data['receiver_addr'];
        //<std::string> 地址(版本>=0)
        $order['recvPostCode'] = $data['receiver_zip'];
        //<std::string> 邮编(版本>=0)
        $order['recvPhone'] = $data['receiver_tel'];
        //<std::string> 电话(版本>=0)
        $order['recvMobile'] = $data['receiver_mobile'];
        //<uint64_t> 手机(版本>=0)
        $order['expectRecvTime'] = $data['expect_dly_date'];
        //<uint32_t> 期望收货时间,天(版本>=0)
        $order['expectRecvTimeSpan'] = $data['expect_dly_time_span'];
        //<std::string> 期望收货时段(版本>=0)
        $order['recvRemark'] = $data['comment'];
        //<std::string> 收货附言(版本>=0)
        if ($data['sign_by_other'] == 1) {
            $order['recvMask'] = $UNPDealRecvMask_E[1];
        }
        else {
            $order['recvMask'] = $UNPDealRecvMask_E[0];
        }
        if ($data['shipping_flag'] == 2) {
            $order['recvMask'] |= $UNPDealRecvMask_E[6];
        }
        //<uint32_t> 收货属性值(版本>=0) 易迅网站端订单的sign_by_other设置在该属性；如果sign_by_other的值为1,设置为0x00000001
        $order['businessBdealId'] = $data['orderNum'] > 1 ? $data['parentOrderId'] : $data['order_id'];
        //<std::string> 业务交易单号，可为空(版本>=1)灰度期间：如果存在分单填入易迅网站端订单父订单号，否则填入易迅网站端订单号；灰度完之后不用填充此字段
        $order['siteId'] = $data['hw_id'];
        //<uint32_t> 分站ID(版本>=1)
        $order['dealCouponFee'] = $data['coupon_amt'];
        //<int> 优惠券金额(版本>=1)
        $order['cashScore'] = $data['cash_point'];
        //<uint32_t> 现金积分支付值(版本>=1)
        $order['promotionScore'] = $data['promotion_point'];
        //<uint32_t> 促销积分支付值(版本>=1)
        $order['recvRegionCodeExt'] = $data['receiver_addr_id'];
        //<std::string> 扩展地区编码(版本>=1)
        $order['icsonDealFlag'] = $data['flag'];
        //<std::string> 易迅订单flag(版本>=1)，不用转换
        $order['icsonStockNo'] = $data['stockNo'];
        //<std::string> 易迅订单物流仓库编号(版本>=1)
        $order['payChannel'] = 0;
        //<uint8_t> 支付渠道(版本>=2)暂不填写
        $order['payServiceFee'] = 0;
        //<uint32_t> 支付手续费(版本>=2)
        $order['icsonDealCashBack'] = $data['price_cut'];
        //<uint32_t> 订单返现金额(版本>=2)

        //******************************分期付款**********************************
        if (isset($data['installment'])) {
            $order['payInstallmentBank'] = $data['installment']['installment_bank'];
            //<std::string> 分期付款银行  对应于易迅网站端订单installment_bank字段
            $order['payInstallmentNum'] = $data['installment']['installment_num'];
            //<uint16_t> 分期付款期数; 对应于易迅网站端订单installment_num字段
            $order['payInstallmentPayment'] = $data['installment']['cash_per_month'];
            //<uint32_t> 分期付款每期金额; 对应于易迅网站端订单cash_per_month字段
            $order['payInstallmentFee'] = $order['payInstallmentNum'] * $order['payInstallmentPayment'] - $data['cash'];
            //<uint32_t> 分期付款手续费(版本>=3) installment_num*cash_per_month-cash
        }
        else {
            $order['payInstallmentBank'] = '';
            //<std::string> 分期付款银行  对应于易迅网站端订单installment_bank字段
            $order['payInstallmentNum'] = 0;
            //<uint16_t> 分期付款期数; 对应于易迅网站端订单installment_num字段
            $order['payInstallmentPayment'] = 0;
            //<uint32_t> 分期付款每期金额; 对应于易迅网站端订单cash_per_month字段
            $order['payInstallmentFee'] = 0;
            //<uint32_t> 分期付款手续费(版本>=3) installment_num*cash_per_month-cash
        }

        //******************************易迅字段**********************************
        $order['icsonShippingType'] = $data['shipping_type'];
        //<std::string> 易迅配送方式(版本>=1)
        $order['icsonPayType'] = $data['pay_type'];
        //<std::string> 易迅支付方式(版本>=1)
        $order['icsonAccount'] = self::$baseData['uid'];
        //<std::string> 易迅内部帐号ID(版本>=1)
        $order['icsonMasterLs'] = $data['ls'];
        //<std::string> 易迅跟踪信息(版本>=1)
        $order['icsonRate'] = isset($data['rate']) ? $data['rate'] : '';
        //<std::string> 易迅平衡比率(版本>=1)
        $order['icsonBankRate'] = isset($data['back_rate']) ? $data['back_rate'] : '';
        //<std::string> 易迅银行利率(版本>=1)
        $order['icsonShopId'] = isset($data['shop_id']) ? $data['shop_id'] : '';
        //<std::string> 易迅店铺id(版本>=1)
        $order['icsonShopGuideId'] = isset($data['shop_guide_id']) ? $data['shop_guide_id'] : '';
        //<std::string> 易迅店铺导购id(版本>=1)
        $order['icsonShopGuideCost'] = isset($data['shop_guide_cost']) ? $data['shop_guide_cost'] : '';
        //<std::string> 易迅店铺导购费用(版本>=1)
        $order['icsonShopGuideName'] = isset($data['shop_guide_name']) ? $data['shop_guide_name'] : '';
        //<std::string> 易迅店铺导购名称(版本>=1)

        //******************************节能补贴，可选**********************************
        if (isset($data['subsidy'])) {
            $order['icsonSubsidyType'] = $data['subsidy']['type'];
            //<std::string> 易迅节能补贴类型(版本>=1)对应t_order_energy_subsidy表0-个人 1-企业 2-事业单位
            $order['icsonSubsidyName'] = $data['subsidy']['name'];
            //<std::string> 易迅节能补贴名称(版本>=1)对应t_order_energy_subsidy表
            $order['icsonSubsidyIdCard'] = $data['subsidy']['idCard'];
            //<std::string> 易迅节能补贴编号(版本>=1)对应t_order_energy_subsidy表
        }
        else {
            $order['icsonSubsidyType'] = '';
            //<std::string> 易迅节能补贴类型(版本>=1)对应t_order_energy_subsidy表
            $order['icsonSubsidyName'] = '';
            //<std::string> 易迅节能补贴名称(版本>=1)对应t_order_energy_subsidy表
            $order['icsonSubsidyIdCard'] = '';
            //<std::string> 易迅节能补贴编号(版本>=1)对应t_order_energy_subsidy表
        }

        //******************************发票，必填**********************************
        if (isset($data['invoice']) && $data['is_vat'] == 1) {
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_IS_VAT"];
            if (trim($data['invoice']['content']) != "商品明细") {
                $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_IS_HAZY_VAT"];
            }
            $order['invoiceType'] = self::getInvoiceType($data['invoice']['type']);
            //<uint8_t> 发票类型(版本>=0)对应于易迅网站端订单is_vat字段以及发票表的type字段；如果is_vat为0，设置为0；否则，设置值为发票表的type字段
            $order['invoiceHead'] = $data['invoice']['title'];
            //<std::string> 发票抬头(版本>=0)
            $order['invoiceContent'] = $data['invoice']['content'];
            //<std::string> 发票内容(版本>=0)
            $order['icsonInvoiceCompanyName'] = $data['invoice']['name'];
            //<std::string> 易迅发票公司名称(版本>=1)
            $order['icsonInvoiceCompanyAddr'] = $data['invoice']['addr'];
            //<std::string> 易迅发票公司地址(版本>=1)
            $order['icsonInvoiceCompanyPhone'] = $data['invoice']['phone'];
            //<std::string> 易迅发票公司电话(版本>=1)
            $order['icsonInvoiceCompanyTaxNo'] = $data['invoice']['taxno'];
            //<std::string> 易迅发票公司税号(版本>=1)
            $order['icsonInvoiceCompanyBankNo'] = $data['invoice']['bankno'];
            //<std::string> 易迅发票公司银行账户(版本>=1)
            $order['icsonInvoiceCompanyBankName'] = $data['invoice']['bankname'];
            //<std::string> 易迅发票公司银行名称(版本>=1)
        }
        else {
            $order['invoiceType'] = 0;
            //<uint8_t> 发票类型(版本>=0)对应于易迅网站端订单is_vat字段以及发票表的type字段；如果is_vat为0，设置为0；否则，设置值为发票表的type字段
            $order['invoiceHead'] = '';
            //<std::string> 发票抬头(版本>=0)
            $order['invoiceContent'] = '';
            //<std::string> 发票内容(版本>=0)
            $order['icsonInvoiceCompanyName'] = '';
            //<std::string> 易迅发票公司名称(版本>=1)
            $order['icsonInvoiceCompanyAddr'] = '';
            //<std::string> 易迅发票公司地址(版本>=1)
            $order['icsonInvoiceCompanyPhone'] = '';
            //<std::string> 易迅发票公司电话(版本>=1)
            $order['icsonInvoiceCompanyTaxNo'] = '';
            //<std::string> 易迅发票公司税号(版本>=1)
            $order['icsonInvoiceCompanyBankNo'] = '';
            //<std::string> 易迅发票公司银行账户(版本>=1)
            $order['icsonInvoiceCompanyBankName'] = '';
            //<std::string> 易迅发票公司银行名称(版本>=1)
        }
        //******************************货票分离订单，可选**********************************
        if (isset($data['invoiceSeparate'])) {
            $order['icsonInvoiceRecvName'] = $data['invoiceSeparate']['receiver'];
            //<std::string> 易迅发票收货人(版本>=1)
            $order['icsonInvoiceRecvAddr'] = $data['invoiceSeparate']['receiver_addr'];
            //<std::string> 易迅发票收货地址(版本>=1)
            $order['icsonInvoiceRecvRegionId'] = $data['invoiceSeparate']['receiver_addr_id'];
            //<std::string> 易迅发票收货地址ID(版本>=1)
            $order['icsonInvoiceRecvMobile'] = $data['invoiceSeparate']['receiver_mobile'];
            //<std::string> 易迅发票收货手机(版本>=1)
            $order['icsonInvoiceRecvTel'] = $data['invoiceSeparate']['receiver_tel'];
            //<std::string> 易迅发票收货电话(版本>=1)
            $order['icsonInvoiceRecvZip'] = $data['invoiceSeparate']['receiver_zip'];
            //<std::string> 易迅发票收货邮编(版本>=1)
            $order['icsonInvoiceShipType'] = $data['invoiceSeparate']['shipping_type'];
            //<std::string> 易迅发票配送方式(版本>=1)
            $order['icsonInvoiceShipFee'] = $data['invoiceSeparate']['shipping_cost'];
            //<std::string> 易迅发票配送费用(版本>=1)
            $order['icsonInvoiceStockNo'] = $data['invoiceSeparate']['stockNo'];
            //<std::string> 易迅货票分离仓库id(版本>=5)
            $order['icsonInvoiceSiteId'] = $data['invoiceSeparate']['siteId'];
            //<std::string> 易迅货票分离分站id(版本>=5)
        }
        else {
            $order['icsonInvoiceRecvName'] = '';
            //<std::string> 易迅发票收货人(版本>=1)
            $order['icsonInvoiceRecvAddr'] = '';
            //<std::string> 易迅发票收货地址(版本>=1)
            $order['icsonInvoiceRecvRegionId'] = '';
            //<std::string> 易迅发票收货地址ID(版本>=1)
            $order['icsonInvoiceRecvMobile'] = '';
            //<std::string> 易迅发票收货手机(版本>=1)
            $order['icsonInvoiceRecvTel'] = '';
            //<std::string> 易迅发票收货电话(版本>=1)
            $order['icsonInvoiceRecvZip'] = '';
            //<std::string> 易迅发票收货邮编(版本>=1)
            $order['icsonInvoiceShipType'] = '';
            //<std::string> 易迅发票配送方式(版本>=1)
            $order['icsonInvoiceShipFee'] = '';
            //<std::string> 易迅发票配送费用(版本>=1)
            $order['icsonInvoiceStockNo'] = '';
            //<std::string> 易迅货票分离仓库id(版本>=5)
            $order['icsonInvoiceSiteId'] = '';
            //<std::string> 易迅货票分离分站id(版本>=5)
        }

        $order['icsonDealCode'] = $data['order_char_id'];
        //<std::string> 易迅订单号，带10开头(版本>=4)
        //是联营商户，打标 1自营 2 联营
        if ($data['sale_model'] == 2) {
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E['UNP_DEAL_PROP_51BUY_NEW_COOP_SALE'];
        }
        $order['sellerCorpId'] = isset($data['seller_id']) ? $data['seller_id'] : 0;
        //<uint64_t> 商家id(版本>=6)
        if ($data['SaleSpec'] == 1) {//小件
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_DEAL_SIZE_SMALL"];
        }
        else if ($data['SaleSpec'] == 2) {//中件
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_DEAL_SIZE_MIDDLE"];
        }
        else if ($data['SaleSpec'] == 3) {//大件
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_DEAL_SIZE_LARGE"];
        }
        //大中小件
        $order['lmsVolume'] = isset($data['Volume']) ? $data['Volume'] : 0;
        //<std::string> 体积(版本>=6)
        $order['lmsWeight'] = isset($data['Weight']) ? $data['Weight'] : 0;
        //<std::string> 重量(版本>=6)
        $order['lmsLongest'] = isset($data['LongestEdge']) ? $data['LongestEdge'] : 0;
        //<std::string> 最长边(版本>=6)
        $order['dealActiveInfoList'] = self::getTradeActivePoList($data['dealActiveInfoList']);
        //<ecc::deal::po::CTradeActivePoList> 订单活动列表(版本>=7)

        return $order;
    }

    /**
     * 获取统一平台发票类型
     * @param $type int
     * @return
     */
    private static function getInvoiceType($type) {
        if (2 == $type) {//增值税发票
            //INVOICE_TYPE_VAT = 2
            return 1;
        }
        else if (4 == $type) {//增值税普通发票
            // INVOICE_TYPE_VAT_NORMAL = 4
            return 2;
        }
        else if (8 == $type) {//冠名发票  增值税普通发票,替代发票类型ID为4
            // INVOICE_TYPE_VAT_NORMAL_NEW = 8
            return 4;
        }
        else {//商业零售发票(公司)商业零售发票(个人)
            // 1,3
            return 3;
        }
    }

    /**
     * 获取订单属性,对应原易迅网站端订单flag字段,货票分离订单的设置需要根据易迅网站订单的bits字段进行判断设置；
     * @param $flag int
     * @param $bits int 订单表中bits字段
     * @return
     */
    private static function getDealProperty2($flag, $bits) {
        global $UNPDealProperty51Buy_E;
        $property = $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_NULL"];

        //灰度期间订单
        $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_GRAY_RELEASE_DEAL"];

        //订单表中flag字段定义
        //define('ORDER_INSTALLMENT_FLAG', 0X1);
        if ($flag & 0X1) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_PAY_INSTALLMENT"];
        }
        //分期付款订单

        //define('ORDER_HAS_SERVICE', 0X2);
        if ($flag & 0X2) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_SERVICE_PRODUCT"];
        }
        //订单中含有服务商品,需要根据订单是否包含服务商品进行判断    或者   根据网站订单的flag字段判断（ORDER_HAS_SERVICE）

        //define('ORDER_CP', 0X4);
        if ($flag & 0X4) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_CONTRACT_PHONE"];
        }
        //合约机订单

        //define('ORDER_RUSHING_BUY_ONLINE_PAY', 0X8);
        if ($flag & 0X8) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_RUSH_BUY_ONLINE_PAY"];
        }
        // 订单中含有抢购商品且为在线支付

        /*分销商的订单是易金商平台下单的，不会同步到统一后台的
         //define('ORDER_ENTERPRISE_USER', 0X10);
         if ($flag & 0X10) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（企业用户）订单
         //define('ORDER_CHAOHUO_USER', 0X20);
         if ($flag & 0X20) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（炒货商）订单
         //define('ORDER_WHOLESALER_USER', 0X40);
         if ($flag & 0X40) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（批发商）订单
         //define('ORDER_RETAILERS_USER', 0X80);
         if ($flag & 0X80) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（零售商）订单
         //define('ORDER_FROM_NEW_SH', 0x40000000);
         if ($flag & 0x40000000) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         */

        //define('ORDER_ENERGY_SUBSIDY', 0x100);
        if ($flag & 0x100) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_ENERGY_SUBSIDY"];
        }
        // 节能补贴订单

        //define('ORDER_SHANGQI_USER', 0x200);
        if ($flag & 0x200) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SHANGQI_DEAL"];
        }
        //上汽订单

        //define('ORDER_EXCHANGE_GOODS_FOR_ERP', 0x400);
        if ($flag & 0x400) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_EXCHANGE_GOODS_FOR_ERP"];
        }
        //客服换货订单，前台未使用占住该类型

        //define('ORDER_NONGHANG', 0x1000);
        if ($flag & 0x1000) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_ABCCHINA_SALE"];
        }
        //包含农行活动商品的订单，活动结束后，该字段会去掉

        //订单表中bits字段定义
        //define('ORDER_SEPARATE_GOODS_INVOICE', 0x1);
        if ($bits & 0x1) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SEPARATE_GOODS_INVOICE"];
        }
        //货票分离订单，前台未使用占住该类型

        return $property;
    }

    /**
     * 获取支付方式，将易迅支付方式映射为统一平台的支付方式
     * @param $payType int
     * @return $uniPayType int
     */
    private static function getMappingUniPayType($payType) {
        global $UNPDealPayType_E;
        switch ((int)$payType) {
            case 1 :
                //货到付款
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_COD'];
                break;
            case 3 :
                //银行电汇
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_BANK_TRANS'];
                break;
            case 4 :
                //邮局汇款
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POST_TRANS'];
                break;
            case 5 :
                //银行划帐  从银行帐号中直接转帐到易迅网指定银行卡上  即时到帐
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                break;
            case 6 :
                //帐期  货到后延期付款
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                break;
            default :
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POL'];
                break;
        }

        return $uniPayType;
    }

    /**
     * 获取下单来源，将易迅来源映射为统一平台的来源
     * @param $source int
     * @return int
     */
    private static function getMappingUniDealSource($source) {
        global $UNPDealSource_E;
        switch ($source) {
            case '--mobile--' :
                return $UNPDealSource_E['UNP_DEAL_SOURCE_MOBILE_WAP'];
            case '--android--' :
            case '--androidpad--' :
            case '--iphone--' :
            case '--ipad--' :
            case '--winphone--' :
            case '--winpad--' :
                return $UNPDealSource_E['UNP_DEAL_SOURCE_MOBILE_APP'];
            case 1 :
                //业务主站
                return $UNPDealSource_E['UNP_DEAL_SOURCE_WEB'];
            default :
                return $UNPDealSource_E['UNP_DEAL_SOURCE_WEB'];
            //$UNPDealSource_E['UNP_DEAL_SOURCE_NULL'];
        }
    }

    /**
     * 获取商品单列表对象
     * @param $data Array
     * @return OrderTradePoList
     */
    private static function getOrderTradePoList($data) {
        //$poList = new \ecc\deal\po\OrderTradePoList();
        $poList = array();

        $tradeInfoList = array();
        for ($i = 0, $len = count($data); $i < $len; $i++) {
            $tradeInfoList[] = self::getOrderTradePo($data[$i]);
        }
        $poList['tradeInfoList'] = $tradeInfoList;

        return $poList;
    }

    /**
     * 获取商品单对象
     * @param $data Array
     * @return OrderTradePo
     */
    private static function getOrderTradePo($data) {
        //$po = new \ecc\deal\po\OrderTradePo();
        $po = array();

        $tmp_data = self::getMappingOrderTradePoRequiredFields($data);
        foreach ($tmp_data as $key => $val) {
            $data[$key] = $val;
        }

        $po['dealId'] = '';
        //<std::string> 订单编号，可为空(版本>=0)
        $po['dealId64'] = 0;
        //<uint64_t> 订单单号，拍拍订单同步可使用，可为空(版本>=0)
        $po['bdealId'] = 0;
        //<uint64_t> 交易单号，可为空(版本>=0)
        $po['tradeId'] = 0;
        //<uint64_t> 商品订单号，拍拍订单同步可使用，可为空(版本>=0)
        $po['buyerId'] = $data['buyerId'];
        //<uint64_t> 买家ID(版本>=0)
        $po['buyerNickName'] = iconv('GBK', 'UTF-8', $data['buyerNickName']);
        //<std::string> 买家昵称(版本>=0)
        $po['sellerId'] = $data['sellerId'];
        //<uint64_t> 商家ID(版本>=0)
        $po['sellerTitle'] = iconv('GBK', 'UTF-8', $data['sellerTitle']);
        //<std::string> 商家名称(版本>=0)
        $po['businessId'] = $data['businessId'];
        //<uint32_t> 业务ID(版本>=0)
        $po['tradeType'] = $data['tradeType'];
        //<uint8_t> 订单类型(版本>=0)
        $po['tradeSource'] = $data['tradeSource'];
        //<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
        $po['tradePayType'] = $data['tradePayType'];
        //<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)
        $po['shippingfeeTemplateId'] = '';
        //<std::string> 运费模版ID(版本>=0)
        $po['shippingfeeDesc'] = '';
        //<std::string> 运费描述(版本>=0)
        $po['itemShippingfee'] = 0;
        //<uint32_t> 商品运费,不参与金额计算，只做展示，商品系统传入(版本>=0)
        $po['itemType'] = $data['itemType'];
        //<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品',0; 6: 组件(版本>=0)
        $po['itemClassId'] = $data['itemClassId'];
        //<uint32_t> 品类（类目）ID(版本>=0)
        $po['itemTitle'] = iconv('GBK', 'UTF-8', $data['itemTitle']);
        //<std::string> 商品标题(版本>=0)
        $po['itemAttrCode'] = $data['itemAttrCode'];
        //<std::string> 商品销售属性编码(版本>=0)
        $po['itemAttr'] = iconv('GBK', 'UTF-8', $data['itemAttr']);
        //<std::string> 商品销售属性描述(版本>=0)
        $po['itemId'] = $data['itemId'];
        //<std::string> 商品ID，由业务定义(版本>=0)
        $po['itemSkuId'] = $data['itemSkuId'];
        //<uint64_t> 商品SKUID(版本>=0)
        $po['itemLocalCode'] = $data['itemLocalCode'];
        //<std::string> 商品商家本地编码(版本>=0)
        $po['itemLocalStockCode'] = '';
        //<std::string> 商品商家本地库存编码(版本>=0)
        $po['itemBarCode'] = '';
        //<std::string> 商品条形码(版本>=0)
        $po['itemSpuId'] = $data['itemSpuId'];
        //<uint64_t> 商品SPUID(版本>=0)
        $po['itemStockId'] = $data['itemStockId'];
        //<uint64_t> 商品库存ID(版本>=0)
        $po['itemStoreHouseId'] = $data['itemStoreHouseId'];
        //<uint32_t> 商品仓库ID(版本>=0)
        $po['itemPhyisicalStorage'] = $data['itemPhyisicalStorage'];
        //<std::string> 商品所属物理仓(版本>=0)
        $po['itemLogo'] = $data['itemLogo'];
        //<std::string> 商品图片Logo(版本>=0)
        $po['itemSnapVersion'] = $data['itemSnapVersion'];
        //<uint32_t> 商品快照版本号(版本>=0)
        $po['itemResetTime'] = $data['itemResetTime'];
        //<uint32_t> 商品重置时间戳(版本>=0)
        $po['itemWeight'] = $data['itemWeight'];
        //<uint32_t> 商品重量(版本>=0)
        $po['itemVolume'] = 0;
        //<uint32_t> 商品体积(版本>=0)
        $po['mainItemId'] = $data['mainItemId'];
        //<uint64_t> 商品套餐主商品ID(版本>=0)
        $po['itemAccessoryDesc'] = '';
        //<std::string> 商品标配说明(版本>=0)
        $po['itemCostPrice'] = $data['itemCostPrice'];
        //<uint32_t> 商品成本价(版本>=0)
        $po['itemOriginPrice'] = 0;
        //<uint32_t> 商品市场价(版本>=0)
        //$po['itemSoldPrice'] =$data['itemSoldPrice'];
        //<uint32_t> 商品销售单价(版本>=0)
        $po['itemB2CMarket'] = $data['itemB2CMarket'];
        //<std::string> 自营B2C市场(版本>=0)
        $po['itemB2CPM'] = $data['itemB2CPM'];
        //<std::string> 自营B2CPM(版本>=0)
        $po['itemUseVirtualStock'] = $data['itemUseVirtualStock'];
        //<uint8_t> 自营B2C是否占用虚库(版本>=0)
        $po['buyPrice'] = $data['buyPrice'];
        //<uint32_t> 商品成交价(版本>=0)
        $po['buyNum'] = $data['buyNum'];
        //<uint32_t> 商品成交件数(版本>=0)
        $po['tradeTotalFee'] = $data['tradeTotalFee'];
        //<uint32_t> 商品单总金额,下单金额(版本>=0)
        $po['tradeAdjustFee'] = 0;
        //<int> 商品单调价金额(版本>=0)
        $po['tradePayment'] = $data['tradePayment'];
        //<uint32_t> 实付总金额(版本>=0)
        $po['tradeDiscountTotal'] = $data['tradeDiscountTotal'];
        //<int> 优惠总金额(版本>=0)
        $po['tradePaipaiHongbaoUsed'] = 0;
        //<uint32_t> Paipai红包使用金额(版本>=0)
        $po['payScore'] = $data['payScore'];
        //<uint32_t> 积分支付值(版本>=0)
        $po['tradeGenTime'] = $data['tradeGenTime'];
        //<uint32_t> 商品单生成时间(版本>=0)
        $po['tradeOpSerialNo'] = 0;
        //<uint16_t> 商品单库存操作序列号(版本>=0)
        $po['obtainScore'] = $data['obtainScore'];
        //<uint32_t> 获得积分值(版本>=0)
        $po['tradeState'] = 0;
        //<uint32_t> 商品单状态(版本>=0)
        $po['tradeProperty'] = 0;
        //<uint32_t> 商品单属性值(版本>=0)
        $po['tradeProperty1'] = 0;
        //<uint32_t> 商品单属性值1(版本>=0)
        $po['tradeProperty2'] = $data['tradeProperty2'];
        //<uint32_t> 商品单属性值2(版本>=0)
        $po['tradeProperty3'] = $data['tradeProperty3'];
        //<uint32_t> 商品单属性值3(版本>=0)
        $po['tradeProperty4'] = 0;
        //<uint32_t> 商品单属性值4(版本>=0)
        $po['itemTimeoutFlag'] = 0;
        //<uint32_t> 商品超时标识(版本>=0)
        $po['lastUpdateTime'] = 0;
        //<uint32_t> 最后更新时间(版本>=0)
        $po['activeInfoList'] = self::getTradeActivePoList($data['tradeActiveInfoList']);
        //<ecc::deal::po::CTradeActivePoList> 商品活动列表(版本>=0)
        //$po['dealExtInfoMap'] =new \stl_multimap2('uint32_t,stl_string');
        //<std::multimap<uint32_t,std::string> > 订单扩展信息 (版本>=0)
        $po['warranty'] = iconv('GBK', 'UTF-8', $data['warranty']);
        //<std::string> 保修条款(版本>=1)
        $po['productId'] = $data['productId'];
        //<uint64_t> 产品id(版本>=1)
        $po['productCode'] = $data['productCode'];
        //<std::string> 产品id编码(版本>=1)
        $po['icsonEdmCode'] = $data['icsonEdmCode'];
        //<std::string> 易迅edm编码(版本>=1)
        $po['icsonOTag'] = $data['icsonOTag'];
        //<std::string> 易迅OTag(版本>=1)
        $po['icsonTradeShopGuideCost'] = $data['icsonTradeShopGuideCost'];
        //<std::string> 易迅店铺导购费用(版本>=1)

        /*定制机不走此普通购物车逻辑，暂注释
         $po['icsonCSPhoneType'] =$data['icsonCSPhoneType'];
         //<std::string> 易迅定制机类型(版本>=1)
         $po['icsonCSPhoneOperator'] =$data['icsonCSPhoneOperator'];
         //<std::string> 易迅定制机运营商(版本>=1)
         $po['icsonCSPhoneNumber'] =$data['icsonCSPhoneNumber'];
         //<std::string> 易迅定制机号码(版本>=1)
         $po['icsonCSPhoneArea'] =$data['icsonCSPhoneArea'];
         //<std::string> 易迅定制机归属地(版本>=1)
         $po['icsonCSPhonePackageId'] =$data['icsonCSPhonePackageId'];
         //<std::string> 易迅定制机套餐id(版本>=1)
         $po['icsonCSPhoneUserName'] =$data['icsonCSPhoneUserName'];
         //<std::string> 易迅定制机用户姓名(版本>=1)
         $po['icsonCSPhoneUserAddr'] =$data['icsonCSPhoneUserAddr'];
         //<std::string> 易迅定制机用户地址(版本>=1)
         $po['icsonCSPhoneUserMobile'] =$data['icsonCSPhoneUserMobile'];
         //<std::string> 易迅定制机用户联系手机(版本>=1)
         $po['icsonCSPhoneUserTel'] =$data['icsonCSPhoneUserTel'];
         //<std::string> 易迅定制机用户联系电话(版本>=1)
         $po['icsonCSPhoneIdCardNo'] =$data['icsonCSPhoneIdCardNo'];
         //<std::string> 易迅定制机身份证号码(版本>=1)
         $po['icsonCSPhoneIdCardAddr'] =$data['icsonCSPhoneIdCardAddr'];
         //<std::string> 易迅定制机身份证地址(版本>=1)
         $po['icsonCSPhoneIdCardDate'] =$data['icsonCSPhoneIdCardDate'];
         //<std::string> 易迅定制机身份证有效期(版本>=1)
         $po['icsonCSPhoneZipCode'] =$data['icsonCSPhoneZipCode'];
         //<std::string> 易迅定制机邮政编码(版本>=1)
         $po['icsonCSPhoneCardPrice'] =$data['icsonCSPhoneCardPrice'];
         //<std::string> 易迅定制机卡价格(版本>=1)
         $po['icsonCSPhonePackagePrice'] =$data['icsonCSPhonePackagePrice'];
         */

        //<std::string> 易迅定制机套餐价格(版本>=1)
        $po['icsonTradeFlag'] = $data['icsonTradeFlag'];
        //<std::string> 易迅商品子单flag(版本>=1)
        $po['icsonPointType'] = $data['icsonPointType'];
        //<std::string> 易迅积分兑换类型(版本>=1)
        $po['icsonPackageIds'] = $data['icsonPackageIds'];
        //<std::string> 易迅商品子单套餐id(版本>=1)
        $po['icsonTradeCashBack'] = $data['icsonTradeCashBack'];
        //<uint32_t> 子单返现金额(版本>=2)
        //$po['icsonUnitCostInvoice'] =$data['icsonUnitCostInvoice'];
        //<std::string> 去税后成本(版本>=3)

        return $po;
    }

    /**
     * 获取商品单的字段，将易迅字段映射为统一订单中商品单的必填字段
     * @param $data Array
     * @return
     */
    private static function getMappingOrderTradePoRequiredFields($data) {
        global $UNPSellerAccount51Buy_E, $UNPDealBusiness_E, $UNPDealType_E, $UNPDealItemType_E;
        $trade = array();

        $trade['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> 买家ID(版本>=0)
        $trade['buyerNickName'] = isset($data['buyerNickName']) ? $data['buyerNickName'] : '';
        //<std::string> 买家昵称(版本>=0)
        $trade['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> 商家ID(版本>=0)
        $trade['sellerTitle'] = $UNPSellerAccount51Buy_E['sellerTitle'];
        //<std::string> 商家名称(版本>=0)
        $trade['businessId'] = $UNPDealBusiness_E['UNP_DEAL_BUSINESS_51BUY'];
        //<uint32_t> 业务ID(版本>=0)
        $trade['tradeType'] = $UNPDealType_E['UNP_DEAL_TYPE_SHOPCART'];
        //<uint8_t> 订单类型(版本>=0)
        $trade['tradeSource'] = self::getMappingUniDealSource($data['ls']);
        //<uint32_t> 下单渠道：1：业务主站；2：移动app；3：移动wap(版本>=0)
        $trade['tradePayType'] = 0;
        //<uint8_t> 支付方式，1：在线付款；2：B2C货到付款；3：C2C货到付款；4：用户自提交易；5：银行转账；6：邮政汇款(版本>=0)

        //对应于易迅网站端商品订单的product_type字段；
        //易迅目前只区分三种类型0:主商品 1：组件 2：赠品；
        switch((int)$data['product_type']) {
            case 0 :
                $itemType = $UNPDealItemType_E['UNP_DEAL_ITEM_TYPE_NORMAL'];
                break;
            case 1 :
                $itemType = $UNPDealItemType_E['UNP_DEAL_ITEM_TYPE_ASSEMBLY'];
                break;
            case 2 :
                $itemType = $UNPDealItemType_E['UNP_DEAL_ITEM_TYPE_GIFT_FOLLOW'];
                break;
        }
        $trade['itemType'] = $itemType;
        //<uint32_t> 商品类型；1：普通商品；2：套餐主商品；3：套餐副商品；4：赠品主商品；5：赠品副商品=0; 6: 组件(版本>=0)

        $trade['itemClassId'] = 0;
        //<uint32_t> 品类（类目）ID(版本>=0)  统一商品接入再填写
        $trade['itemTitle'] = $data['name'];
        //<std::string> 商品标题(版本>=0)
        $trade['itemAttrCode'] = '';
        //<std::string> 商品销售属性编码(版本>=0)  统一商品接入再填写
        $trade['itemAttr'] = '';
        //<std::string> 商品销售属性描述(版本>=0)  统一商品接入再填写
        $trade['itemId'] = $data['item_id'];
        //<std::string> 商品ID，由业务定义(版本>=0)
        $trade['itemSkuId'] = 0;
        //<uint64_t> 商品SKUID(版本>=0)  统一商品接入再填写
        $trade['itemLocalCode'] = $data['product_char_id'];
        //<std::string> 商品商家本地编码(版本>=0)  统一商品接入再填写
        $trade['itemSpuId'] = 0;
        //<uint64_t> 商品SPUID(版本>=0)  统一商品接入再填写
        $trade['itemStockId'] = 0;
        //<uint64_t> 商品库存ID(版本>=0)  统一商品接入再填写
        $trade['itemStoreHouseId'] = 0;
        //<uint32_t> 商品仓库ID(版本>=0)  统一商品接入再填写
        $trade['itemPhyisicalStorage'] = $data['stockNo'];
        //<std::string> 商品所属物理仓(版本>=0)物理仓id：stockNo（目前易迅商品没有记录，但订单纬度有设置该字段）
        $trade['itemLogo'] = '';
        //<std::string> 商品图片Logo(版本>=0)  统一商品接入再填写
        $trade['itemSnapVersion'] = 0;
        //<uint32_t> 商品快照版本号(版本>=0)  统一商品接入再填写
        $trade['itemResetTime'] = 0;
        //<uint32_t> 商品重置时间戳(版本>=0)  统一商品接入再填写
        $trade['itemWeight'] = $data['weight'];
        //<uint32_t> 商品重量(版本>=0)
        $trade['mainItemId'] = $data['main_product_id'];
        //<uint64_t> 商品套餐主商品ID(版本>=0)对应易迅随心配主商品id，对应于易迅网站端商品单main_product_id字段
        $trade['itemCostPrice'] = $data['cost'];
        //<uint32_t> 商品成本价(版本>=0)
        //$trade['itemSoldPrice'] = $data['price'];
        //<uint32_t> 商品销售单价(版本>=0)
        $trade['itemB2CMarket'] = $data['apportToMkt'];
        //<std::string> 自营B2C市场(版本>=0)
        $trade['itemB2CPM'] = $data['apportToPm'];
        //<std::string> 自营B2CPM(版本>=0)
        $trade['itemUseVirtualStock'] = $data['use_virtual_stock'];
        //<uint8_t> 自营B2C是否占用虚库(版本>=0)
        $trade['buyPrice'] = $data['price'];
        //<uint32_t> 商品成交价(版本>=0)
        $trade['buyNum'] = $data['buy_num'];
        //<uint32_t> 商品成交件数(版本>=0)

        /*
         *【商品子单】
         *下单时: TradeTotalFee = TradePayment
         *TradePayment = (BuyPrice*BuyNum) - TradeDiscountTotal + TradeAdjustFee
         *TradeDiscountTotal = 分摊到此商品子单上的优惠总和，可由活动列表汇总得到
         */
        $trade['tradeTotalFee'] = $data['totalFee'];
        //<uint32_t> 商品单总金额=下单金额(版本>=0)成交价*成交件数-优惠总金额（不包含积分）
        $trade['tradePayment'] = $data['payment'];
        //<uint32_t> 实付总金额(版本>=0)成交价*成交件数-优惠总金额（不包含积分）
        $trade['tradeDiscountTotal'] = $data['discount'];
        //<int> 优惠总金额(版本>=0)批价路径优惠总金额之和（不包含积分）分摊到此商品子单上的优惠总和，可由活动列表汇总得到

        $trade['payScore'] = $data['points_pay'];
        //<uint32_t> 积分支付值(版本>=0)
        $trade['tradeGenTime'] = time();
        //<uint32_t> 商品单生成时间(版本>=0)
        $trade['obtainScore'] = $data['points'];
        //<uint32_t> 获得积分值(版本>=0)
        $trade['tradeProperty2'] = self::getTradeProperty2($data['flag']);
        //<uint32_t> 商品单属性值2(版本>=0)
        $trade['tradeProperty3'] = self::getTradeProperty3($data['type']);
        //<uint32_t> 商品单属性值3(版本>=0)
        $trade['warranty'] = $data['warranty'];
        //<std::string> 保修条款(版本>=1)
        $trade['productId'] = $data['product_id'];
        //<uint64_t> 产品id(版本>=1)
        $trade['productCode'] = $data['product_char_id'];
        //<std::string> 产品id编码(版本>=1)

        //******************************易迅字段**********************************
        $trade['icsonEdmCode'] = $data['edm_code'];
        //<std::string> 易迅edm编码(版本>=1)
        $trade['icsonOTag'] = $data['OTag'];
        //<std::string> 易迅OTag(版本>=1)
        $trade['icsonTradeShopGuideCost'] = $data['shop_guide_cost'];
        //<std::string> 易迅店铺导购费用(版本>=1)
        $trade['icsonTradeFlag'] = $data['flag'];
        //<std::string> 易迅商品子单flag(版本>=1)
        $trade['icsonPointType'] = $data['point_type'];
        //<std::string> 易迅积分兑换类型(版本>=1)
        $trade['icsonPackageIds'] = $data['package_ids'];
        //<std::string> 易迅商品子单套餐id(版本>=1)
        $trade['icsonTradeCashBack'] = $data['cash_back'];
        //<uint32_t> 子单返现金额(版本>=2)

        //******************************易迅合约机订单**********************************
        if (isset($data['CSPhone'])) {
            $trade['icsonCSPhoneType'] = $data['CSPhone']['service_type'];
            //<std::string> 易迅定制机类型(版本>=1)
            $trade['icsonCSPhoneOperator'] = $data['CSPhone']['sp_id'];
            //<std::string> 易迅定制机运营商(版本>=1)
            $trade['icsonCSPhoneNumber'] = $data['CSPhone']['num'];
            //<std::string> 易迅定制机号码(版本>=1)
            $trade['icsonCSPhoneArea'] = '';
            //<std::string> 易迅定制机归属地(版本>=1)
            $trade['icsonCSPhonePackageId'] = $data['CSPhone']['package_id'];
            //<std::string> 易迅定制机套餐id(版本>=1)
            $trade['icsonCSPhoneUserName'] = $data['CSPhone']['name'];
            //<std::string> 易迅定制机用户姓名(版本>=1)
            $trade['icsonCSPhoneUserAddr'] = $data['CSPhone']['user_addr'];
            //<std::string> 易迅定制机用户地址(版本>=1)
            $trade['icsonCSPhoneUserMobile'] = $data['CSPhone']['user_mobile'];
            //<std::string> 易迅定制机用户联系手机(版本>=1)
            $trade['icsonCSPhoneUserTel'] = $data['CSPhone']['user_tel'];
            //<std::string> 易迅定制机用户联系电话(版本>=1)
            $trade['icsonCSPhoneIdCardNo'] = $data['CSPhone']['idcard_num'];
            //<std::string> 易迅定制机身份证号码(版本>=1)
            $trade['icsonCSPhoneIdCardAddr'] = $data['CSPhone']['idcard_address'];
            //<std::string> 易迅定制机身份证地址(版本>=1)
            $trade['icsonCSPhoneIdCardDate'] = $data['CSPhone']['idcard_date'];
            //<std::string> 易迅定制机身份证有效期(版本>=1)
            $trade['icsonCSPhoneZipCode'] = $data['CSPhone']['zip_code'];
            //<std::string> 易迅定制机邮政编码(版本>=1)
            $trade['icsonCSPhoneCardPrice'] = $data['CSPhone']['card_price'];
            //<std::string> 易迅定制机卡价格(版本>=1)
            $trade['icsonCSPhonePackagePrice'] = $data['CSPhone']['package_price'];
            //<std::string> 易迅定制机套餐价格(版本>=1)
        }

        return $trade;
    }

    /**
     * 根据商品单flag字段转换，易迅网站侧在constant.inc.php中定义
     * @param $flag int
     * @return
     */
    private static function getTradeProperty2($flag) {
        global $UNPTradeProperty51Buy_E;
        $property = $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_NULL'];

        //define('COUPON_PRODUCT', 0X2);
        if ($flag & 0X2) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_COUPON_PRODUCT'];
        }
        //特价商品标志

        //define("OTHER_TIME_LIMITED_RUSHING_BUY", 0x4);
        if ($flag & 0x4) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_OTHER_TIMELIMITED_BUY'];
        }
        //其他抢购类型标识

        //define('CAN_VAT_INVOICE', 0X8);
        if ($flag & 0X8) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CAN_VAT_INVOICE'];
        }
        //是否能开增票

        //define('IS_DEFAULT_INVOICE', 0X10);
        if ($flag & 0X10) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_IS_DEFAULT_INVOICE'];
        }
        //是否默认开票

        //define("TIME_LIMITED_RUSHING_BUY", 0x20);
        if ($flag & 0x20) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_TIMELIMITED_BUY'];
        }
        //显示抢购标志

        //define('FORBID_SET_VIRTUAL', 0x40);
        if ($flag & 0x40) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_FORBID_SET_VIRTUAL'];
        }
        //是否禁止建虚库

        //define('PRODUCT_ENERGY_SUBSIDY', 0x80);
        if ($flag & 0x80) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_ENERGY_SUBSIDY'];
        }
        //节能补贴商品

        //define('CP_YCHF', 0x100);
        if ($flag & 0x100) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————预存话费送手机

        //define('CP_GJRW', 0x200);
        if ($flag & 0x200) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————购机入网送话费

        //define('CP_XHRW', 0x400);
        if ($flag & 0x400) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————选号入网

        //define('CP_GMLJ', 0x800);
        if ($flag & 0x800) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————购买裸机

        //define('PRODUCT_EXTENDED_INSURANCE', 0x1000);
        if ($flag & 0x1000) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_EXTENDED_INSURANCE'];
        }
        //延保商品

        //define('PROMOTION_PRODUCT', 0x2000);
        if ($flag & 0x2000) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_PROMOTION_PRODUCT'];
        }
        //促销商品

        //define('APPOINT_PRODUCT', 0x8000);
        if ($flag & 0x8000) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_APPOINT_PRODUCT'];
        }
        // 预购商品

        return $property;
    }

    /**
     * 根据商品的类型转换
     * @param $type int
     * @return
     */
    private static function getTradeProperty3($type) {
        global $UNPTradeProperty51Buy3_E;
        $property = 0x00000000;

        switch ((int)$type) {
            case 0 :
                //Normal普通商品
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_NORMAL'];
                break;
            case 1 :
                //SecondHand二手商品
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SECOND_HAND'];
                break;
            case 2 :
                //Bad坏品
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_BAD'];
                break;
            case 3 :
                //Service服务
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SERVICE'];
                break;
            case 4 :
                //OnlyViewNoSale展示非卖
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ONLY_VIEW'];
                break;
            case 9 :
                //OtherProduct其他商品
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_OTHER'];
                break;
            case 10 :
                //AdjustProduct改价商品
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ADJUST'];
                break;
            default :
                break;
        }

        return $property;
    }

    /**
     * 获取活动列表对象
     * @param $data Array
     * @return TradeActivePoList
     */
    private static function getTradeActivePoList($data) {
        //$poList = new \ecc\deal\po\TradeActivePoList();
        $poList = array();

        $tradeActiveInfoList = array();
        for ($i = 0, $len = count($data); $i < $len; $i++) {
            $tradeActiveInfoList[] = self::getTradeActivePo($data[$i]);
        }
        $poList['tradeActiveInfoList'] = $tradeActiveInfoList;

        return $poList;
    }

    /**
     * 获取活动对象
     * @param $data Array
     * @return TradeActivePo
     */
    private static function getTradeActivePo($data) {
        //$po = new \ecc\deal\po\TradeActivePo();
        $po = array();

        $tmp_data = self::getMappingTradeActivePoRequiredFields($data);
        foreach ($tmp_data as $key => $val) {
            $data[$key] = $val;
        }
        $po['id'] = 0;
        //<uint64_t> 记录id(版本>=0)
        $po['tradeId'] = 0;
        //<uint64_t> 商品订单编号(版本>=0)
        $po['dealId'] = '';
        //<std::string> 订单编号，格式:订单序号XXXXYYYY，如:101041051509351702(版本>=0)
        $po['dealId64'] = 0;
        //<uint64_t> 订单单号，统一平台内部单号(版本>=0)
        $po['bdealId'] = 0;
        //<uint64_t> 交易订单编号(版本>=0)
        $po['buyerId'] = $data['buyerId'];
        //<uint64_t> 买家ID(版本>=0)
        $po['sellerId'] = $data['sellerId'];
        //<uint64_t> 商家ID(版本>=0)
        $po['activeType'] = $data['activeType'];
        //<uint16_t> 活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券 (版本>=0)
        $po['activeNo'] = $data['activeNo'];
        //<uint64_t> 活动编号(版本>=0)
        $po['activeRuleId'] = $data['activeRuleId'];
        //<uint32_t> 活动命中规则编号(版本>=0)
        $po['activeDesc'] = iconv('GBK', 'UTF-8', $data['activeDesc']);
        //<std::string> 活动描述(版本>=0)
        $po['adjustFee'] = $data['adjustFee'];
        //<int> 调价金额，商品调价记录用，单件活动(版本>=0)
        $po['preActiveFee'] = $data['preActiveFee'];
        //<uint32_t> 活动前本商品订单金额(版本>=0)
        $po['favorFee'] = $data['favorFee'];
        //<int> 活动本商品订单优惠金额，正数表示优惠，负数表示加钱(版本>=0)
        $po['activeParam1'] = $data['activeParam1'];
        //<uint32_t> 活动参数1(版本>=0)
        $po['activeParam2'] = $data['activeParam2'];
        //<uint32_t> 活动参数2(版本>=0)
        $po['activeParam3'] = $data['activeParam3'];
        //<uint32_t> 活动参数3(版本>=0)
        $po['activeParam4'] = $data['activeParam4'];
        //<uint32_t> 活动参数4(版本>=0)
        $po['activeParam5'] = $data['activeParam5'];
        //<uint64_t> 活动参数5(版本>=0)
        $po['activeParam6'] = $data['activeParam6'];
        //<uint64_t> 活动参数6(版本>=0)
        $po['activeParam7'] = $data['activeParam7'];
        //<std::string> 活动参数7(版本>=0)
        $po['activeParam8'] = $data['activeParam8'];
        //<std::string> 活动参数8(版本>=0)

        return $po;
    }

    /**
     * 获取活动的字段，将易迅字段映射为统一商品单中活动的必填字段
     * @param $data Array
     * @return
     */
    private static function getMappingTradeActivePoRequiredFields($data) {
        global $UNPSellerAccount51Buy_E;
        $active = array();

        $active['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> 买家ID(版本>=0)
        $active['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> 商家ID(版本>=0)
        $active['activeType'] = $data['activeType'];
        //<uint16_t> 活动类型，平台统一定义.1:VIP价 2:满减  3:满送 4:满包邮 5:优惠券 (版本>=0)
        $active['activeNo'] = isset($data['activeNo']) ? $data['activeNo'] : 0;
        //<uint64_t> 活动编号(版本>=0)
        $active['activeRuleId'] = isset($data['activeRuleId']) ? $data['activeRuleId'] : 0;
        //<uint32_t> 活动命中规则编号(版本>=0)
        $active['activeDesc'] = isset($data['activeDesc']) ? $data['activeDesc'] : '';
        //<std::string> 活动描述(版本>=0)
        $active['adjustFee'] = isset($data['adjustFee']) ? $data['adjustFee'] : 0;
        //<int> 调价金额，商品调价记录用，单件活动(版本>=0)
        $active['preActiveFee'] = isset($data['preActiveFee']) ? $data['preActiveFee'] : 0;
        //<uint32_t> 活动前本商品订单金额(版本>=0)
        $active['favorFee'] = isset($data['favorFee']) ? $data['favorFee'] : 0;
        //<int> 活动本商品订单优惠金额，正数表示优惠，负数表示加钱(版本>=0)
        $active['activeParam1'] = isset($data['activeParam1']) ? $data['activeParam1'] : 0;
        //<uint32_t> 活动参数1(版本>=0)
        $active['activeParam2'] = isset($data['activeParam2']) ? $data['activeParam2'] : 0;
        //<uint32_t> 活动参数2(版本>=0)
        $active['activeParam3'] = isset($data['activeParam3']) ? $data['activeParam3'] : 0;
        //<uint32_t> 活动参数3(版本>=0)
        $active['activeParam4'] = isset($data['activeParam4']) ? $data['activeParam4'] : 0;
        //<uint32_t> 活动参数4(版本>=0)
        $active['activeParam5'] = isset($data['activeParam5']) ? $data['activeParam5'] : 0;
        //<uint64_t> 活动参数5(版本>=0)
        $active['activeParam6'] = isset($data['activeParam6']) ? $data['activeParam6'] : 0;
        //<uint64_t> 活动参数6(版本>=0)
        $active['activeParam7'] = isset($data['activeParam7']) ? iconv('GBK', 'UTF-8', $data['activeParam7']) : '';
        //<std::string> 活动参数7(版本>=0)
        $active['activeParam8'] = isset($data['activeParam8']) ? iconv('GBK', 'UTF-8', $data['activeParam8']) : '';
        //<std::string> 活动参数8(版本>=0)

        return $active;
    }

    /**
     * 获取订单基数对象
     * @param $data array
     * @return EventParamsBaseBo
     */
    private static function getEventParamsBaseBo($data = array()) {
        global $UNPSellerAccount51Buy_E;
        //$bo = new \ecc\deal\bo\EventParamsBaseBo();
        $bo = array();

        $bo['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> 买家id(版本>=0)
        $bo['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> 卖家id(版本>=0)
        $bo['eventId'] = 0;
        //<uint32_t> 事件id,订单系统分配(版本>=0)
        $bo['operatorRole'] = 1;
        //<uint32_t> 操作者角色(版本>=0) 1：买家，2：卖家，3：系统，4：运营系统，5：支付系统，订单提供的IDL服务
        $bo['eventSource'] = self::$baseData['eventSource'];
        //<std::string> 事件来源，业务必填，请填写调用服务名或文件名(版本>=0)
        $bo['dealId'] = isset($data['dealId']) ? $data['dealId'] : '';
        //<std::string> 订单id(版本>=0)
        $bo['tradeId'] = 0;
        //<uint64_t> 子单id(版本>=0)
        $bo['clientIp'] = self::$baseData['clientIp'];
        //<std::string> 来源ip(版本>=0)
        $bo['machineKey'] = self::$baseData['machineKey'];
        //<std::string> 机器码(版本>=0)
        $bo['operatorName'] = '';
        //<std::string> 操作人(版本>=0)
        $bo['reserve'] = '';
        //<std::string> 保留字段(版本>=0)
        $bo['bdealId'] = isset($data['bdealId']) ? $data['bdealId'] : '';
        //<std::string> 交易单号(版本>=1)

        return $bo;
    }

    /**
     * 获取支付基数对象
     * @param $data array
     * @return EventParamsPayBo
     */
    private static function getEventParamsPayBo($data) {
        //$bo = new \ecc\deal\bo\EventParamsPayBo();
        $bo = array();

        $bo['feeCash'] = $data['feeCash'];
        //<uint32_t> 现金支付金额(版本>=0)
        $bo['feeTicket'] = 0;
        //<uint32_t> 财付通现金券支付金额(版本>=0)
        $bo['feeVFee'] = 0;
        //<uint32_t> 折扣券支付金额(版本>=0)
        $bo['feeScore'] = 0;
        //<uint32_t> 积分支付金额(版本>=0)
        $bo['feeCaibei'] = 0;
        //<uint32_t> 彩贝支付金额(版本>=0)
        $bo['feeOther'] = 0;
        //<uint32_t> 其他支付金额(版本>=0)
        $bo['procedureFee'] = 0;
        //<uint32_t> 交易手续费，第三方支付平台或银行支付时返回(版本>=0)
        $bo['payTime'] = $data['payTime'];
        //<uint32_t> 支付时间(版本>=0)
        $bo['payId'] = 0;
        //<uint64_t> 支付单号，统一订单后台的支付单id，没有则不传(版本>=0)
        $bo['payDealId'] = $data['payDealId'];
        //<std::string> 支付订单号,支付订单号，如财付通单号，支付宝单号等(版本>=0)
        $bo['bankType'] = $data['bankType'];
        //<std::string> 银行类型(版本>=0)
        $bo['otherPayAccount'] = '';
        //<std::string> 他人代付帐号(版本>=0)
        $bo['bindAccount'] = $data['receiveAccount'];
        //<std::string> 绑定账户(版本>=0)
        $bo['payBusinessId'] = $data['payBusinessId'];
        //<std::string> 支付业务单号，支付系统的业务订单号(版本>=0)
        $bo['paySeqId'] = $data['paySeqId'];
        //<std::string> 统一支付平台的支付单号(版本>=1)

        return $bo;
    }

    /**
     * 获取查询订单对象
     * @param $bdealId string  易迅订单号
     * @return DealQueryBo
     */
    private static function getDealQueryBo($bdealId) {
        global $UNPSellerAccount51Buy_E;
        //$bo = new \ecc\deal\bo\DealQueryBo();
        $bo = array();

        //<uint16_t> 版本号(版本>=0)
        $bo['dealId'] = 0;
        //<uint64_t> 订单id(版本>=0)
        $bo['tradeId'] = 0;
        //<uint64_t> 子单id(版本>=0)
        $bo['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> 卖家id(版本>=0)
        $bo['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> 买家id(版本>=0)
        $bo['dealCode'] = '';
        //<std::string> 订单编码(版本>=0)
        $bo['tradeCode'] = '';
        //<std::string> 子单编码(版本>=0)
        $bo['businessDealId'] = $bdealId;
        //<std::string> 业务订单号(版本>=0)
        $bo['bdealId'] = 0;
        //<uint64_t> 交易单id(版本>=1)
        $bo['bdealCode'] = '';
        //<std::string> 交易单编码(版本>=1)

        return $bo;
    }

    /**
     * 获取在线支付订单参数对象
     * @param $bdealId string  易迅业务父订单号
     * @param $totalPayAmt string  支付总金额
     * @param $payTime int  支付时间
     * @param $isMerge string  0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单)
     * @param $dealPayList string  支付同步入参订单列表
     * @return OnlinePayBdealParams
     */
    private static function getOnlinePayBdealParams($bdealId, $totalPayAmt, $payTime, $isMerge, $dealPayList) {
        $po = array();

        //$po['version'] = 0;
        //<uint16_t> 协议版本号(版本>=0)
        $po['bdealId'] = 0;
        //<uint64_t> 交易订单号(版本>=0)
        $po['bdealCode'] = '';
        //<std::string> 交易订单号,带买卖家号(版本>=0)
        $po['businessBdealId'] = $bdealId;
        //<std::string> 业务父订单号,必填(版本>=0)
        $po['payTime'] = $payTime;
        //<uint32_t> 支付时间，必填(版本>=0)
        $po['totalPayAmt'] = $totalPayAmt;
        //<uint32_t> 支付总金额,必填(版本>=0)
        $po['isMerge'] = $isMerge;
        //<uint32_t> 0-非合并支付(父订单+1子单)，1-合并支付(父订单+n子单),必填(版本>=0)
        $po['payId'] = 0;
        //<uint64_t> 统一订单支付单号,必填(版本>=0)
        $po['dealParamsList'] = self::getOnlinePayDealParamsList($dealPayList);
        //<ecc::deal::po::COnlinePayDealParamsList> 支付同步入参订单列表(版本>=0)
        $po['icsonAccount'] = '';
        //<std::string> 易讯内部账号(版本>=0)
        $po['buyerId'] = '';
        //<std::string> 统一用户号(版本>=0)

        return $po;
    }

    /**
     * 获取在线支付订单参数对象
     * @param $list string  支付单列表信息
     * @return OnlinePayDealParams
     */
    private static function getOnlinePayDealParamsList($list) {
        $poList = array();

        //$poList['version'] = 1;
        //<uint16_t> 版本号(版本>=0)
        $OnlinePayDealParamsList = array();
        for ($i = 0, $len = count($list); $i < $len; $i++) {
            $OnlinePayDealParamsList[] = self::getOnlinePayDealParams($list[$i]['bdealId'], $list[$i]['payAmt'], $list[$i]['account'], $list[$i]['payType'], $list[$i]['payTime'], $list[$i]['tradeNo'], $list[$i]['seqId'], $list[$i]['sourceType'], $list[$i]['billType']);
        }
        $poList['dealParamsList'] = $OnlinePayDealParamsList;
        //new \stl_vector2('\ecc\deal\po\OnlinePayDealParams') 支付单列表(版本>=0)

        return $poList;
    }

    /**
     * 获取在线支付订单参数对象
     * @param $bdealId string  易迅子订单号
     * @param $payAmt int 支付金额
     * @param $account string 收款账户
     * @param $payType string 支付类型
     * @param $payTime int 支付时间
     * @param $tradeNo string 收款（交易）流水号
     * @param $seqId string 支付幂等
     * @param $sourceType int 来源类型
     * @param $billType int 订单类型
     * @param $dealId string 订单号
     * @return OnlinePayDealParams
     */
    private static function getOnlinePayDealParams($bdealId, $payAmt, $account, $payType, $payTime, $tradeNo, $seqId, $sourceType, $billType, $dealId = '') {
        $po = array();

        //$po['version'] = 0;
        //<uint16_t> 协议版本号(版本>=0)
        $po['dealId'] = $dealId;
        //<std::string> 订单号(版本>=0)
        $po['businessDealId'] = $bdealId;
        //<std::string> 订单易迅业务单号,必填(版本>=0)
        $po['payAmt'] = $payAmt;
        //<uint32_t> 支付金额,必填(版本>=0)
        $po['account'] = $account;
        //<std::string> 收款账户，必填,统一后台(payAccount)(版本>=0)
        $po['payType'] = $payType;
        //<std::string> 支付类型系统编号()，必填,统一后台(icsonPayType)(版本>=0)
        $po['payTime'] = $payTime;
        //<uint32_t> 支付时间，必填(版本>=0)
        $po['tradeNo'] = $tradeNo;
        //<std::string> 收款（交易）流水号，必填,统一后台(paydealid)(版本>=0)
        $po['key'] = $seqId;
        //<std::string> 支付幂等，必填(版本>=0)
        $po['sourceType'] = $sourceType;
        //<uint32_t> 来源类型(1:实物,2:虚拟,3:分销),必填(版本>=1)
        $po['billType'] = $billType;
        //<uint32_t> 订单类型(1:普通订单,2:礼品卡),必填(版本>=1)

        return $po;
    }

    /**
     * 获取md5后转换的数字
     * @param $str String
     * @return int
     */
    public static function md5Int($str) {
        $md5 = strtolower(md5($str));
        $int = array();
        $int[0] = $md5[0];
        $int[1] = $md5[2];
        $int[2] = $md5[3];
        $int[3] = $md5[5];
        $int[4] = $md5[7];
        $int[5] = $md5[10];
        $int[6] = $md5[13];
        $int[7] = $md5[15];
        $int = array_reverse($int);
        for ($i = 0; $i < count($int); $i++) {
            $int[$i] = dechex(ord($int[$i]));
        }
        $str = '0x' . implode('', $int);

        return intval($str, 16);
    }

}
