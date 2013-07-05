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
    //������������
    private static $baseData = array();

    private static $err_arr = array(
        '1000' => array(
            'code' => 1000,
            'msg' => '�û�IDΪ��'
        ),
        '1001' => array(
            'code' => 1001,
            'msg' => '��ȡͳһ�û�IDʧ��'
        ),
        '1002' => array(
            'code' => 1002,
            'msg' => '��ȡͳһ������Ϣʧ��'
        ),
        '1003' => array(
            'code' => 1003,
            'msg' => '����AO����ʧ��'
        ),
        '1004' => array(
            'code' => 1004,
            'msg' => '������֧��'
        ),
        '1005' => array(
            'code' => 1005,
            'msg' => '��ѯ�޴˶���'
        ),
        '1006' => array(
            'code' => 1006,
            'msg' => '����״̬����ȷ'
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
     * ���ö�����������
     * @param $uid int ��Ѹƽ̨�û�id
     * @param $wgid int ͳһƽ̨�û�id
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
     * ��������
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
                'itil' => '631525|631526|631527'//��ӦsetItilId(success|fail|timeout)
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
     * ȡ������
     * @param $uid
     * @param $bdealId ͳһƽ̨�������ţ��Ҷ��ڼ䴫��Ѹ������
     * @param $dealId ͳһƽ̨�Ӷ����ţ��Ҷ��ڼ䴫��Ѹ�Ӷ���
     * @param $wgid int ͳһƽ̨�û�id
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

        //ͨ����Ѹ������ѯͳһ������Ϣ
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
            //��ȡͳһ�����ĸ���id
            $bdealId = $deal['data']['bdealCode'];
            //��ȡͳһ�������ӵ�id
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
                'itil' => '631531|631532|631533'//��ӦsetItilId(success|fail|timeout)
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
                if ($result['code'] == 177) {//״̬���ԣ�����ȡ��
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
     * ֪ͨ����֧��״̬
     * @param $uid int
     * @param $bdealId ���򵥺ţ��Ҷ��ڼ䴫��Ѹ����
     * @param $payCash int �ֽ�֧�����
     * @param $payTime int ֧��ʱ��
     * @param $payDealId string ֧��������,��Ƹ�ͨ����
     * @param $paySeqId string  ͳһ֧��ƽ̨֧����id
     * @param $payBusinessId string  ֧��ҵ�񵥺ţ��Ҷ��ڼ䴫��Ѹ���ţ� ������Ҫ��ͳһ�����ģ�������+֧�����ţ�
     * @param $bank string ��������
     * @param $receiveAccount int �տ������ʺ�
     * @param $wgid int ͳһƽ̨�û�id
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

        //ͨ����Ѹ������ѯͳһ������Ϣ
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
                'itil' => '631534|631535|631536'//��ӦsetItilId(success|fail|timeout)
            ),
            'req' => array(
                "source" => __FILE__,
                "machineKey" => self::$baseData['machineKey'],
                "verifyToken" => "",
                "baseParams" => self::getEventParamsBaseBo(array('bdealId' => $bdealId)),
                "payParams" => self::getEventParamsPayBo(array(
                    'feeCash' => $payCash, //�ֽ�֧�����
                    'payTime' => $payTime, //֧��ʱ��
                    'payDealId' => $payDealId, //֧��������,��Ƹ�ͨ����
                    'paySeqId' => $paySeqId, //ͳһ֧��ƽ̨֧����id
                    'payBusinessId' => $payBusinessId, //֧��ҵ�񵥺ţ�֧��ϵͳ��ҵ�񶩵���
                    'bankType' => $bank, //��������
                    'receiveAccount' => $receiveAccount, //�տ��ʺ�
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

                if ($result['code'] == 190) {//190Ϊͳһ����ƽ̨���ص���֧���ɹ�
                    return array(
                        'retCode' => self::$err_arr['1004']['code'],
                        'retMsg' => self::$err_arr['1004']['msg'] . "({$result['code']})"
                    );
                }
                else if ($result['code'] == 255) {//û�д˶���
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
     * ��Ӷ���֧����ˮ
     * @param $uid int
     * @param $bdealId ���򵥺ţ��Ҷ��ڼ䴫��Ѹ����
     * @param $payCash int �ֽ�֧�����
     * @param $payTime int ֧��ʱ��
     * @param $isMerge string  0-�Ǻϲ�֧��(������+1�ӵ�)��1-�ϲ�֧��(������+n�ӵ�)
     * @param $dealPayList string  ֧��ͬ����ζ����б�
     * @param $wgid int ͳһƽ̨�û�id
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
                //'itil' => ''//��ӦsetItilId(success|fail|timeout)
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
     * ͨ����Ѹ�����Ż�ȡͳһƽ̨�Ķ�����Ϣ
     * @param $uid int
     * @param $bdealId string ��Ѹ������
     * @param $type int ��ѯ����
     * @param $history int
     * @param $wgid int ͳһƽ̨�û�id
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
                'itil' => '631528|631529|631530'//��ӦsetItilId(success|fail|timeout)
            ),
            'req' => array(
                "source" => __FILE__,
                "machineKey" => self::$baseData['machineKey'],
                "verifyToken" => "",
                "infoType" => $type, //��Ϣ����  $UNPDealInfoType_E
                "historyFlag" => $history, //��ʷ������ʶ��0��ǰ���� 1��ʷ����
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
                if ($result['code'] == 255) {//û�д˶���
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
     * ��ȡ�����б����
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
     * ��ȡ��������
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
        //<std::string> ������ţ���ʽ:�������XXXXYYYY����:101041051509351702����Ϊ��(�汾>=0)
        $po['dealId64'] = 0;
        //<uint64_t> �������ţ����Ķ���ͬ����ʹ�ã���Ϊ��(�汾>=0)
        $po['bdealId'] = 0;
        //<uint64_t> ���׵��ţ���Ϊ��(�汾>=0)
        $po['businessDealId'] = $data['businessDealId'];
        //<std::string> ҵ�񶩵���ţ��������йܶ���(�汾>=0)�Ҷ�˫д�ڼ���Ҫ��������������Ѹ��վ�˶����ŵ����ֶΣ��Ҷ���֮����OMS���ؽ������ã��������̲���Ҫ����
        $po['buyerId'] = $data['buyerId'];
        //<uint64_t> ���ID(�汾>=0)
        $po['buyerAccount'] = $data['buyerAccount'];
        //<std::string> ����ʺ�(�汾>=0)
        $po['buyerNickName'] = iconv('GBK', 'UTF-8', $data['buyerNickName']);
        //<std::string> �������(�汾>=0)
        $po['buyerNick'] = iconv('GBK', 'UTF-8', $data['buyerNick']);
        //<std::string> ����ǳ�(�汾>=0)
        $po['sellerId'] = $data['sellerId'];
        //<uint64_t> �̼�ID(�汾>=0)
        $po['sellerTitle'] = iconv('GBK', 'UTF-8', $data['sellerTitle']);
        //<std::string> �̼���ʵ����(�汾>=0)
        $po['sellerNick'] = iconv('GBK', 'UTF-8', $data['sellerNick']);
        //<std::string> �����ǳ�(�汾>=0)
        $po['businessId'] = $data['businessId'];
        //<uint32_t> ҵ��ID(�汾>=0)
        $po['dealType'] = $data['dealType'];
        //<uint8_t> ��������(�汾>=0)
        $po['dealSource'] = $data['dealSource'];
        //<uint32_t> �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap(�汾>=0)
        $po['dealPayType'] = $data['dealPayType'];
        //<uint8_t> ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������(�汾>=0)
        $po['dealState'] = $data['dealState'];
        //<uint32_t> ����״̬(�汾>=0)
        $po['dealProperty'] = 0;
        //<uint32_t> ��������ֵ��ͨ��(�汾>=0)
        $po['dealProperty1'] = 0;
        //<uint32_t> ��������ֵ��ҵ��1��չ��(�汾>=0)
        $po['dealProperty2'] = $data['dealProperty2'];
        //<uint32_t> ��������ֵ��ҵ��2��չ��(�汾>=0)
        $po['dealProperty3'] = 0;
        //<uint32_t> ��������ֵ��ҵ��3��չ��(�汾>=0)
        $po['dealProperty4'] = 0;
        //<uint32_t> ��������ֵ��ҵ��4��չ��(�汾>=0)
        $po['itemSkuidList'] = '';
        //<std::string> ��ƷskuID�б�(�汾>=0)
        $po['itemTitleList'] = '';
        //<std::string> ��Ʒ�����б�(�汾>=0)
        $po['dealTotalFee'] = $data['dealTotalFee'];
        //<uint32_t> �����ܽ��,�µ����(�汾>=0)
        $po['dealAdjustFee'] = $data['dealAdjustFee'];
        //<int> ���۽��(�汾>=0)
        $po['dealPayment'] = $data['dealPayment'];
        //<uint32_t> ʵ���ܽ��(�汾>=0)
        $po['dealDownPayment'] = 0;
        //<uint32_t> C2BԤ�۶�����(�汾>=0)
        $po['dealDiscountTotal'] = $data['dealDiscountTotal'];
        //<int> �Ż��ܽ��; ��б��Żݽ�����(�汾>=0)
        $po['dealItemTotalFee'] = $data['dealItemTotalFee'];
        //<uint32_t> ��Ʒ�ӵ��ܽ��(�汾>=0)
        $po['dealWhoPayShippingFee'] = $data['dealWhoPayShippingFee'];
        //<uint32_t> ˭֧���ʷѣ�1�����ң�2�����(�汾>=0)
        $po['dealShippingFee'] = $data['dealShippingFee'];
        //<uint32_t> �ʷѽ��(�汾>=0)
        $po['dealWhoPayCodFee'] = 0;
        //<uint32_t> ˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е�(�汾>=0)
        $po['dealCodFee'] = 0;
        //<uint32_t> COD������(�汾>=0)
        $po['dealWhoPayInsuranceFee'] = 0;
        //<uint32_t> ˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е�(�汾>=0)
        $po['dealInsuranceFee'] = $data['dealInsuranceFee'];
        //<uint32_t> �˷ѱ��շ�(�汾>=0)
        $po['dealSysAdjustFee'] = 0;
        //<int> ϵͳ���۽���������COD���ҵ��۽������ڴ�����COD�Żݽ��(�汾>=0)
        $po['payScore'] = $data['payScore'];
        //<uint32_t> ����֧��ֵ(�汾>=0)
        $po['obtainScore'] = $data['obtainScore'];
        //<uint32_t> ��û���ֵ(�汾>=0)
        $po['dealGenTime'] = $data['dealGenTime'];
        //<uint32_t> ��������ʱ��(�汾>=0)
        $po['sendFromDesc'] = $data['sendFromDesc'];
        //<std::string> ��������������(�汾>=0)
        $po['dealSeq'] = $data['dealSeq'];
        //<uint64_t> �µ�ʱ���(�汾>=0)
        $po['dealMd5'] = $data['dealMd5'];
        //<uint64_t> �µ�md5(�汾>=0)
        $po['dealIp'] = $data['dealIp'];
        //<std::string> �µ�IP(�汾>=0)
        $po['dealRefer'] = $data['dealRefer'];
        //<std::string> refer(�汾>=0)
        $po['dealVisitKey'] = $data['dealVisitKey'];
        //<std::string> visitkey(�汾>=0)
        $po['promotionDesc'] = '';
        //<std::string> ����������Ϣ����(�汾>=0)
        $po['recvName'] = iconv('GBK', 'UTF-8', $data['recvName']);
        //<std::string> �ջ���(�汾>=0)
        $po['recvRegionCode'] = $data['recvRegionCode'];
        //<uint32_t> ��������(�汾>=0)
        $po['recvAddress'] = iconv('GBK', 'UTF-8', $data['recvAddress']);
        //<std::string> ��ַ(�汾>=0)
        $po['recvPostCode'] = $data['recvPostCode'];
        //<std::string> �ʱ�(�汾>=0)
        $po['recvPhone'] = $data['recvPhone'];
        //<std::string> �绰(�汾>=0)
        $po['recvMobile'] = $data['recvMobile'];
        //<uint64_t> �ֻ�(�汾>=0)
        $po['expectRecvTime'] = $data['expectRecvTime'];
        //<uint32_t> �����ջ�ʱ��,��(�汾>=0)
        $po['expectRecvTimeSpan'] = $data['expectRecvTimeSpan'];
        //<std::string> �����ջ�ʱ��(�汾>=0)
        $po['recvRemark'] = iconv('GBK', 'UTF-8', $data['recvRemark']);
        //<std::string> �ջ�����(�汾>=0)
        $po['recvMask'] = $data['recvMask'];
        //<uint32_t> �ջ�����ֵ(�汾>=0)
        $po['expressType'] = 0;
        //<uint8_t> ���ͷ�ʽ��1��ƽ�ʣ�2����ݣ�3��EMS��4��B2C�Խ�������5���û����͵�����(�汾>=0)
        $po['expressCompanyID'] = '';
        //<std::string> ������˾ID(�汾>=0)
        $po['expressCompanyName'] = '';
        //<std::string> ������˾����(�汾>=0)
        $po['invoiceType'] = $data['invoiceType'];
        //<uint8_t> ��Ʊ����(�汾>=0)
        $po['invoiceHead'] = iconv('GBK', 'UTF-8', $data['invoiceHead']);
        //<std::string> ��Ʊ̧ͷ(�汾>=0)
        $po['invoiceContent'] = iconv('GBK', 'UTF-8', $data['invoiceContent']);
        //<std::string> ��Ʊ����(�汾>=0)
        $po['cftDealId'] = '';
        //<std::string> Cft֧������(�汾>=0)
        $po['lastUpdateTime'] = 0;
        //<uint32_t> ������ʱ��(�汾>=0)
        $po['tradeInfoList'] = self::getOrderTradePoList($data['tradePoList']);
        //<ecc::deal::po::COrderTradePoList> ��Ʒ�ӵ��б�(�汾>=0)
        //$po['payInfoList'] =new \ecc\deal\po\OrderPayInfoPoList();
        //<ecc::deal::po::COrderPayInfoPoList> ֧����Ϣ��(�汾>=0)
        //$po['actionLogInfoList'] =new \ecc\deal\po\DealActionLogPoList();
        //<ecc::deal::po::CDealActionLogPoList> ��ˮ��־��(�汾>=0)
        //$po['dealExtInfoMap'] = new \stl_multimap2();
        //<std::multimap<uint32_t,std::string> > ������չ��Ϣ (�汾>=0)
        $po['bdealCode'] = '';
        //<std::string> ���׵���ţ����ַ�����ʽ�Ľ��׵��ţ���Ϊ��(�汾>=1)
        $po['businessBdealId'] = $data['businessBdealId'];
        //<std::string> ҵ���׵��ţ���Ϊ��(�汾>=1)
        $po['siteId'] = $data['siteId'];
        //<uint32_t> ��վID(�汾>=1)
        $po['dealCouponFee'] = $data['dealCouponFee'];
        //<int> �Ż�ȯ���(�汾>=1)
        $po['cashScore'] = $data['cashScore'];
        //<uint32_t> �ֽ����֧��ֵ(�汾>=1)
        $po['promotionScore'] = $data['promotionScore'];
        //<uint32_t> ��������֧��ֵ(�汾>=1)
        $po['recvRegionCodeExt'] = $data['recvRegionCodeExt'];
        //<std::string> ��չ��������(�汾>=1)
        $po['dealDigest'] = '';
        //<std::string> ����ժҪ(�汾>=1)
        $po['payInstallmentBank'] = $data['payInstallmentBank'];
        //<std::string> ���ڸ�������  ��Ӧ����Ѹ��վ�˶���installment_bank�ֶ�
        $po['payInstallmentNum'] = $data['payInstallmentNum'];
        //<uint16_t> ���ڸ�������; ��Ӧ����Ѹ��վ�˶���installment_num�ֶ�
        $po['payInstallmentPayment'] = $data['payInstallmentPayment'];
        //<uint32_t> ���ڸ���ÿ�ڽ��; ��Ӧ����Ѹ��վ�˶���cash_per_month�ֶ�
        $po['icsonShippingType'] = $data['icsonShippingType'];
        //<std::string> ��Ѹ���ͷ�ʽ(�汾>=1)
        $po['icsonPayType'] = $data['icsonPayType'];
        //<std::string> ��Ѹ֧����ʽ(�汾>=1)
        $po['icsonAccount'] = $data['icsonAccount'];
        //<std::string> ��Ѹ�ڲ��ʺ�ID(�汾>=1)
        $po['icsonMasterLs'] = $data['icsonMasterLs'];
        //<std::string> ��Ѹ������Ϣ(�汾>=1)
        $po['icsonRate'] = $data['icsonRate'];
        //<std::string> ��Ѹƽ�����(�汾>=1)
        $po['icsonBankRate'] = $data['icsonBankRate'];
        //<std::string> ��Ѹ��������(�汾>=1)
        $po['icsonShopId'] = $data['icsonShopId'];
        //<std::string> ��Ѹ����id(�汾>=1)
        $po['icsonShopGuideId'] = $data['icsonShopGuideId'];
        //<std::string> ��Ѹ���̵���id(�汾>=1)
        $po['icsonShopGuideCost'] = $data['icsonShopGuideCost'];
        //<std::string> ��Ѹ���̵�������(�汾>=1)
        $po['icsonShopGuideName'] = iconv('GBK', 'UTF-8', $data['icsonShopGuideName']);
        //<std::string> ��Ѹ���̵�������(�汾>=1)
        $po['icsonSubsidyType'] = $data['icsonSubsidyType'];
        //<std::string> ��Ѹ���ܲ�������(�汾>=1)
        $po['icsonSubsidyName'] = iconv('GBK', 'UTF-8', $data['icsonSubsidyName']);
        //<std::string> ��Ѹ���ܲ�������(�汾>=1)
        $po['icsonSubsidyIdCard'] = $data['icsonSubsidyIdCard'];
        //<std::string> ��Ѹ���ܲ������(�汾>=1)
        $po['icsonCSOrderOperatorId'] = '';
        //<std::string> ��Ѹ�ͷ��µ�����ԱID(�汾>=1)
        $po['icsonCSOrderOperatorName'] = '';
        //<std::string> ��Ѹ�ͷ��µ�����Ա����(�汾>=1)
        $po['icsonInvoiceCompanyName'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceCompanyName']);
        //<std::string> ��Ѹ��Ʊ��˾����(�汾>=1)
        $po['icsonInvoiceCompanyAddr'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceCompanyAddr']);
        //<std::string> ��Ѹ��Ʊ��˾��ַ(�汾>=1)
        $po['icsonInvoiceCompanyPhone'] = $data['icsonInvoiceCompanyPhone'];
        //<std::string> ��Ѹ��Ʊ��˾�绰(�汾>=1)
        $po['icsonInvoiceCompanyTaxNo'] = $data['icsonInvoiceCompanyTaxNo'];
        //<std::string> ��Ѹ��Ʊ��˾˰��(�汾>=1)
        $po['icsonInvoiceCompanyBankNo'] = $data['icsonInvoiceCompanyBankNo'];
        //<std::string> ��Ѹ��Ʊ��˾�����˻�(�汾>=1)
        $po['icsonInvoiceCompanyBankName'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceCompanyBankName']);
        //<std::string> ��Ѹ��Ʊ��˾��������(�汾>=1)
        $po['icsonInvoiceRecvName'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceRecvName']);
        //<std::string> ��Ѹ��Ʊ�ջ���(�汾>=1)
        $po['icsonInvoiceRecvAddr'] = iconv('GBK', 'UTF-8', $data['icsonInvoiceRecvAddr']);
        //<std::string> ��Ѹ��Ʊ�ջ���ַ(�汾>=1)
        $po['icsonInvoiceRecvRegionId'] = $data['icsonInvoiceRecvRegionId'];
        //<std::string> ��Ѹ��Ʊ�ջ���ַID(�汾>=1)
        $po['icsonInvoiceRecvMobile'] = $data['icsonInvoiceRecvMobile'];
        //<std::string> ��Ѹ��Ʊ�ջ��ֻ�(�汾>=1)
        $po['icsonInvoiceRecvTel'] = $data['icsonInvoiceRecvTel'];
        //<std::string> ��Ѹ��Ʊ�ջ��绰(�汾>=1)
        $po['icsonInvoiceRecvZip'] = $data['icsonInvoiceRecvZip'];
        //<std::string> ��Ѹ��Ʊ�ջ��ʱ�(�汾>=1)
        $po['icsonInvoiceShipType'] = $data['icsonInvoiceShipType'];
        //<std::string> ��Ѹ��Ʊ���ͷ�ʽ(�汾>=1)
        $po['icsonInvoiceShipFee'] = $data['icsonInvoiceShipFee'];
        //<std::string> ��Ѹ��Ʊ���ͷ���(�汾>=1)
        $po['icsonDealFlag'] = $data['icsonDealFlag'];
        //<std::string> ��Ѹ����flag(�汾>=1)
        $po['icsonStockNo'] = $data['icsonStockNo'];
        //<std::string> ��Ѹ���������ֿ���(�汾>=1)
        $po['payChannel'] = $data['payChannel'];
        //<uint8_t> ֧������(�汾>=2)
        $po['payServiceFee'] = $data['payServiceFee'];
        //<uint32_t> ֧��������(�汾>=2)
        $po['icsonDealCashBack'] = $data['icsonDealCashBack'];
        //<uint32_t> �������ֽ��(�汾>=2)
        $po['payInstallmentFee'] = $data['payInstallmentFee'];
        //<uint32_t> ���ڸ���������(�汾>=3)
        $po['icsonDealCode'] = $data['icsonDealCode'];
        //<std::string> ��Ѹ�����ţ���10��ͷ(�汾>=4)
        $po['icsonInvoiceStockNo'] = $data['icsonInvoiceStockNo'];
        //<std::string> ��Ѹ��Ʊ����ֿ�id(�汾>=5)
        $po['icsonInvoiceSiteId'] = $data['icsonInvoiceSiteId'];
        //<std::string> ��Ѹ��Ʊ�����վid(�汾>=5)
        $po['sellerCorpId'] = $data['sellerCorpId'];
        //<uint64_t> ��Ѹ��Ӫ�̼�id(�汾>=6)
        $po['lmsVolume'] = $data['lmsVolume'];
        //<std::string> ��Ѹ��Ӫ���(�汾>=6)
        $po['lmsWeight'] = $data['lmsWeight'];
        //<std::string> ��Ѹ��Ӫ����(�汾>=6)
        $po['lmsLongest'] = $data['lmsLongest'];
        //<std::string> ��Ѹ��Ӫ���(�汾>=6)
        $po['dealActiveInfoList'] = $data['dealActiveInfoList'];
        //<ecc::deal::po::CTradeActivePoList> ������б�(�汾>=7)

        return $po;
    }

    /**
     * ��ȡ�����ֶΣ�����Ѹ�ֶ�ӳ��Ϊͳһ�����ı����ֶ�
     * @param $data Array
     * @return
     */
    private static function getMappingOrderPoRequiredFields($data) {
        global $UNPSellerAccount51Buy_E, $UNPDealBusiness_E, $UNPDealType_E, $UNPDealState_E, $UNPDealRecvMask_E, $UNPDealProperty51Buy_E, $UNPDealPayType_E;
        $order = array();

        //�Ҷ�˫д�ڼ���Ҫ��������������Ѹ��վ�˶����ŵ����ֶΣ��Ҷ���֮����OMS���ؽ������ã��������̲���Ҫ����
        $order['businessDealId'] = $data['order_id'];
        //<std::string> ҵ�񶩵���ţ��������йܶ���(�汾>=0)
        $order['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> ���ID(�汾>=0)
        $order['buyerAccount'] = isset($data['buyerAccount']) ? $data['buyerAccount'] : '';
        //<std::string> ����ʺ�(�汾>=0)
        $order['buyerNickName'] = isset($data['buyerNickName']) ? $data['buyerNickName'] : '';
        //<std::string> �������(�汾>=0)
        $order['buyerNick'] = isset($data['buyerNick']) ? $data['buyerNick'] : '';
        //<std::string> ����ǳ�(�汾>=0)
        $order['sellerId'] = $GLOBALS['UNPSellerAccount51Buy_E']['sellerId'];
        //<uint64_t> �̼�ID(�汾>=0)
        $order['sellerTitle'] = $GLOBALS['UNPSellerAccount51Buy_E']['sellerTitle'];
        //<std::string> �̼���ʵ����(�汾>=0)
        $order['sellerNick'] = $GLOBALS['UNPSellerAccount51Buy_E']['sellerNick'];
        //<std::string> �����ǳ�(�汾>=0)
        $order['businessId'] = $UNPDealBusiness_E['UNP_DEAL_BUSINESS_51BUY'];
        //<uint32_t> ҵ��ID(�汾>=0)
        $order['dealType'] = $UNPDealType_E['UNP_DEAL_TYPE_SHOPCART'];
        //<uint8_t> ��������(�汾>=0)
        $order['dealSource'] = self::getMappingUniDealSource($data['ls']);
        //<uint32_t> �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap(�汾>=0)
        $order['dealPayType'] = 0;
        //<uint8_t> ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������(�汾>=0)

        //����֧��������֧�����ʾֻ��vs���е�㣩��ʼ״̬Ϊ��UNP_DEAL_STATE_WAIT_PAY��δ�������ˣ���
        $dealState = $UNPDealState_E['UNP_DEAL_STATE_WAIT_PAY'];
        //���������ʼ״̬Ϊ��UNP_DEAL_STATE_WAIT_CHECK������ˣ���
        //0Ԫ���������߼�����ʼ״̬UNP_DEAL_STATE_WAIT_CHECK������ˣ�
        if ($order['dealPayType'] === $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_COD'] || $data['cash'] === 0) {
            $dealState = $UNPDealState_E['UNP_DEAL_STATE_WAIT_CHECK'];
        }
        $order['dealState'] = $dealState;
        //<uint32_t> ����״̬(�汾>=0)
        $order['dealProperty2'] |= self::getDealProperty2($data['flag'], $data['bits']);

        /**
         * ��������
         * �µ�ʱ: DealTotalFee = DealPayment
         * DealPayment =DealItemTotalFee + DealShippingFee + DealCodFee + DealInsuranceFee + DealAdjustFee + DealSysAdjustFee
         * DealDiscountTotal = ������Ʒ�ӵ�TradeDiscountTotal֮��
         * DealItemTotalFee = ������Ʒ�ӵ�TradePayment֮��
         */
        $order['dealTotalFee'] = $data['cash'];
        //<uint32_t> �����ܽ��,�µ����(�汾>=0) �µ�ʱ: DealTotalFee = DealPayment
        $order['dealAdjustFee'] = isset($data['dealAdjustFee']) ? $data['dealAdjustFee'] : 0;
        //<int> ���۽��(�汾>=0)
        $order['dealPayment'] = $data['cash'];
        //<uint32_t> ʵ���ܽ��(�汾>=0)
        $order['dealDiscountTotal'] = $data['discount'];
        //<int> �Ż��ܽ��; ��б��Żݽ�����(�汾>=0)  ������Ʒ�ӵ�TradeDiscountTotal֮��
        $order['dealItemTotalFee'] = isset($data['totalFee']) ? $data['totalFee'] : 0;
        //<uint32_t> ��Ʒ�ӵ��ܽ��(�汾>=0) ������Ʒ�ӵ�TradePayment֮��

        $order['dealWhoPayShippingFee'] = 2;
        //<uint32_t> ˭֧���ʷѣ�1�����ң�2�����(�汾>=0)
        $order['dealShippingFee'] = $data['shipping_cost'];
        //<uint32_t> �ʷѽ��(�汾>=0)
        $order['dealInsuranceFee'] = $data['premium_cost'];
        //<uint32_t> �˷ѱ��շ�(�汾>=0)
        $order['payScore'] = $data['point_pay'];
        //<uint32_t> ����֧��ֵ(�汾>=0)
        $order['obtainScore'] = $data['point'];
        //<uint32_t> ��û���ֵ(�汾>=0)
        $order['dealGenTime'] = time();
        //<uint32_t> ��������ʱ��(�汾>=0)
        $order['sendFromDesc'] = isset($data['seller_address_id']) ? $data['seller_address_id'] : '';
        //<std::string> ���Ҳֵ�ַ
        $order['dealSeq'] = $order['dealGenTime'];
        //<uint64_t> �µ�ʱ���(�汾>=0)
        $order['dealMd5'] = self::md5Int($order['buyerId'] . $order['dealSeq'] . $data['item_ids']);
        //<uint64_t> �µ�md5(�汾>=0) BuyerId,DealSeq,DealMd5�������������Ψһ�ģ�����ÿ��OrderPo�еĶ�����ֵ���Ψһ��
        $order['dealIp'] = $data['customer_ip'];
        //<std::string> �µ�IP(�汾>=0)
        $order['dealRefer'] = isset($data['cpsinfo']) ? $data['cpsinfo'] : '';
        //<std::string> refer(�汾>=0)
        $order['dealVisitKey'] = self::$baseData['machineKey'];
        //<std::string> visitkey(�汾>=0)
        $order['recvName'] = $data['receiver'];
        //<std::string> �ջ���(�汾>=0)
        $order['recvRegionCode'] = 0;
        //<uint32_t> ��������(�汾>=0)ͳһ�û�ϵͳ��ȡ�ĵ�ַ����
        $order['recvAddress'] = $data['receiver_addr'];
        //<std::string> ��ַ(�汾>=0)
        $order['recvPostCode'] = $data['receiver_zip'];
        //<std::string> �ʱ�(�汾>=0)
        $order['recvPhone'] = $data['receiver_tel'];
        //<std::string> �绰(�汾>=0)
        $order['recvMobile'] = $data['receiver_mobile'];
        //<uint64_t> �ֻ�(�汾>=0)
        $order['expectRecvTime'] = $data['expect_dly_date'];
        //<uint32_t> �����ջ�ʱ��,��(�汾>=0)
        $order['expectRecvTimeSpan'] = $data['expect_dly_time_span'];
        //<std::string> �����ջ�ʱ��(�汾>=0)
        $order['recvRemark'] = $data['comment'];
        //<std::string> �ջ�����(�汾>=0)
        if ($data['sign_by_other'] == 1) {
            $order['recvMask'] = $UNPDealRecvMask_E[1];
        }
        else {
            $order['recvMask'] = $UNPDealRecvMask_E[0];
        }
        if ($data['shipping_flag'] == 2) {
            $order['recvMask'] |= $UNPDealRecvMask_E[6];
        }
        //<uint32_t> �ջ�����ֵ(�汾>=0) ��Ѹ��վ�˶�����sign_by_other�����ڸ����ԣ����sign_by_other��ֵΪ1,����Ϊ0x00000001
        $order['businessBdealId'] = $data['orderNum'] > 1 ? $data['parentOrderId'] : $data['order_id'];
        //<std::string> ҵ���׵��ţ���Ϊ��(�汾>=1)�Ҷ��ڼ䣺������ڷֵ�������Ѹ��վ�˶����������ţ�����������Ѹ��վ�˶����ţ��Ҷ���֮���������ֶ�
        $order['siteId'] = $data['hw_id'];
        //<uint32_t> ��վID(�汾>=1)
        $order['dealCouponFee'] = $data['coupon_amt'];
        //<int> �Ż�ȯ���(�汾>=1)
        $order['cashScore'] = $data['cash_point'];
        //<uint32_t> �ֽ����֧��ֵ(�汾>=1)
        $order['promotionScore'] = $data['promotion_point'];
        //<uint32_t> ��������֧��ֵ(�汾>=1)
        $order['recvRegionCodeExt'] = $data['receiver_addr_id'];
        //<std::string> ��չ��������(�汾>=1)
        $order['icsonDealFlag'] = $data['flag'];
        //<std::string> ��Ѹ����flag(�汾>=1)������ת��
        $order['icsonStockNo'] = $data['stockNo'];
        //<std::string> ��Ѹ���������ֿ���(�汾>=1)
        $order['payChannel'] = 0;
        //<uint8_t> ֧������(�汾>=2)�ݲ���д
        $order['payServiceFee'] = 0;
        //<uint32_t> ֧��������(�汾>=2)
        $order['icsonDealCashBack'] = $data['price_cut'];
        //<uint32_t> �������ֽ��(�汾>=2)

        //******************************���ڸ���**********************************
        if (isset($data['installment'])) {
            $order['payInstallmentBank'] = $data['installment']['installment_bank'];
            //<std::string> ���ڸ�������  ��Ӧ����Ѹ��վ�˶���installment_bank�ֶ�
            $order['payInstallmentNum'] = $data['installment']['installment_num'];
            //<uint16_t> ���ڸ�������; ��Ӧ����Ѹ��վ�˶���installment_num�ֶ�
            $order['payInstallmentPayment'] = $data['installment']['cash_per_month'];
            //<uint32_t> ���ڸ���ÿ�ڽ��; ��Ӧ����Ѹ��վ�˶���cash_per_month�ֶ�
            $order['payInstallmentFee'] = $order['payInstallmentNum'] * $order['payInstallmentPayment'] - $data['cash'];
            //<uint32_t> ���ڸ���������(�汾>=3) installment_num*cash_per_month-cash
        }
        else {
            $order['payInstallmentBank'] = '';
            //<std::string> ���ڸ�������  ��Ӧ����Ѹ��վ�˶���installment_bank�ֶ�
            $order['payInstallmentNum'] = 0;
            //<uint16_t> ���ڸ�������; ��Ӧ����Ѹ��վ�˶���installment_num�ֶ�
            $order['payInstallmentPayment'] = 0;
            //<uint32_t> ���ڸ���ÿ�ڽ��; ��Ӧ����Ѹ��վ�˶���cash_per_month�ֶ�
            $order['payInstallmentFee'] = 0;
            //<uint32_t> ���ڸ���������(�汾>=3) installment_num*cash_per_month-cash
        }

        //******************************��Ѹ�ֶ�**********************************
        $order['icsonShippingType'] = $data['shipping_type'];
        //<std::string> ��Ѹ���ͷ�ʽ(�汾>=1)
        $order['icsonPayType'] = $data['pay_type'];
        //<std::string> ��Ѹ֧����ʽ(�汾>=1)
        $order['icsonAccount'] = self::$baseData['uid'];
        //<std::string> ��Ѹ�ڲ��ʺ�ID(�汾>=1)
        $order['icsonMasterLs'] = $data['ls'];
        //<std::string> ��Ѹ������Ϣ(�汾>=1)
        $order['icsonRate'] = isset($data['rate']) ? $data['rate'] : '';
        //<std::string> ��Ѹƽ�����(�汾>=1)
        $order['icsonBankRate'] = isset($data['back_rate']) ? $data['back_rate'] : '';
        //<std::string> ��Ѹ��������(�汾>=1)
        $order['icsonShopId'] = isset($data['shop_id']) ? $data['shop_id'] : '';
        //<std::string> ��Ѹ����id(�汾>=1)
        $order['icsonShopGuideId'] = isset($data['shop_guide_id']) ? $data['shop_guide_id'] : '';
        //<std::string> ��Ѹ���̵���id(�汾>=1)
        $order['icsonShopGuideCost'] = isset($data['shop_guide_cost']) ? $data['shop_guide_cost'] : '';
        //<std::string> ��Ѹ���̵�������(�汾>=1)
        $order['icsonShopGuideName'] = isset($data['shop_guide_name']) ? $data['shop_guide_name'] : '';
        //<std::string> ��Ѹ���̵�������(�汾>=1)

        //******************************���ܲ�������ѡ**********************************
        if (isset($data['subsidy'])) {
            $order['icsonSubsidyType'] = $data['subsidy']['type'];
            //<std::string> ��Ѹ���ܲ�������(�汾>=1)��Ӧt_order_energy_subsidy��0-���� 1-��ҵ 2-��ҵ��λ
            $order['icsonSubsidyName'] = $data['subsidy']['name'];
            //<std::string> ��Ѹ���ܲ�������(�汾>=1)��Ӧt_order_energy_subsidy��
            $order['icsonSubsidyIdCard'] = $data['subsidy']['idCard'];
            //<std::string> ��Ѹ���ܲ������(�汾>=1)��Ӧt_order_energy_subsidy��
        }
        else {
            $order['icsonSubsidyType'] = '';
            //<std::string> ��Ѹ���ܲ�������(�汾>=1)��Ӧt_order_energy_subsidy��
            $order['icsonSubsidyName'] = '';
            //<std::string> ��Ѹ���ܲ�������(�汾>=1)��Ӧt_order_energy_subsidy��
            $order['icsonSubsidyIdCard'] = '';
            //<std::string> ��Ѹ���ܲ������(�汾>=1)��Ӧt_order_energy_subsidy��
        }

        //******************************��Ʊ������**********************************
        if (isset($data['invoice']) && $data['is_vat'] == 1) {
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_IS_VAT"];
            if (trim($data['invoice']['content']) != "��Ʒ��ϸ") {
                $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_IS_HAZY_VAT"];
            }
            $order['invoiceType'] = self::getInvoiceType($data['invoice']['type']);
            //<uint8_t> ��Ʊ����(�汾>=0)��Ӧ����Ѹ��վ�˶���is_vat�ֶ��Լ���Ʊ���type�ֶΣ����is_vatΪ0������Ϊ0����������ֵΪ��Ʊ���type�ֶ�
            $order['invoiceHead'] = $data['invoice']['title'];
            //<std::string> ��Ʊ̧ͷ(�汾>=0)
            $order['invoiceContent'] = $data['invoice']['content'];
            //<std::string> ��Ʊ����(�汾>=0)
            $order['icsonInvoiceCompanyName'] = $data['invoice']['name'];
            //<std::string> ��Ѹ��Ʊ��˾����(�汾>=1)
            $order['icsonInvoiceCompanyAddr'] = $data['invoice']['addr'];
            //<std::string> ��Ѹ��Ʊ��˾��ַ(�汾>=1)
            $order['icsonInvoiceCompanyPhone'] = $data['invoice']['phone'];
            //<std::string> ��Ѹ��Ʊ��˾�绰(�汾>=1)
            $order['icsonInvoiceCompanyTaxNo'] = $data['invoice']['taxno'];
            //<std::string> ��Ѹ��Ʊ��˾˰��(�汾>=1)
            $order['icsonInvoiceCompanyBankNo'] = $data['invoice']['bankno'];
            //<std::string> ��Ѹ��Ʊ��˾�����˻�(�汾>=1)
            $order['icsonInvoiceCompanyBankName'] = $data['invoice']['bankname'];
            //<std::string> ��Ѹ��Ʊ��˾��������(�汾>=1)
        }
        else {
            $order['invoiceType'] = 0;
            //<uint8_t> ��Ʊ����(�汾>=0)��Ӧ����Ѹ��վ�˶���is_vat�ֶ��Լ���Ʊ���type�ֶΣ����is_vatΪ0������Ϊ0����������ֵΪ��Ʊ���type�ֶ�
            $order['invoiceHead'] = '';
            //<std::string> ��Ʊ̧ͷ(�汾>=0)
            $order['invoiceContent'] = '';
            //<std::string> ��Ʊ����(�汾>=0)
            $order['icsonInvoiceCompanyName'] = '';
            //<std::string> ��Ѹ��Ʊ��˾����(�汾>=1)
            $order['icsonInvoiceCompanyAddr'] = '';
            //<std::string> ��Ѹ��Ʊ��˾��ַ(�汾>=1)
            $order['icsonInvoiceCompanyPhone'] = '';
            //<std::string> ��Ѹ��Ʊ��˾�绰(�汾>=1)
            $order['icsonInvoiceCompanyTaxNo'] = '';
            //<std::string> ��Ѹ��Ʊ��˾˰��(�汾>=1)
            $order['icsonInvoiceCompanyBankNo'] = '';
            //<std::string> ��Ѹ��Ʊ��˾�����˻�(�汾>=1)
            $order['icsonInvoiceCompanyBankName'] = '';
            //<std::string> ��Ѹ��Ʊ��˾��������(�汾>=1)
        }
        //******************************��Ʊ���붩������ѡ**********************************
        if (isset($data['invoiceSeparate'])) {
            $order['icsonInvoiceRecvName'] = $data['invoiceSeparate']['receiver'];
            //<std::string> ��Ѹ��Ʊ�ջ���(�汾>=1)
            $order['icsonInvoiceRecvAddr'] = $data['invoiceSeparate']['receiver_addr'];
            //<std::string> ��Ѹ��Ʊ�ջ���ַ(�汾>=1)
            $order['icsonInvoiceRecvRegionId'] = $data['invoiceSeparate']['receiver_addr_id'];
            //<std::string> ��Ѹ��Ʊ�ջ���ַID(�汾>=1)
            $order['icsonInvoiceRecvMobile'] = $data['invoiceSeparate']['receiver_mobile'];
            //<std::string> ��Ѹ��Ʊ�ջ��ֻ�(�汾>=1)
            $order['icsonInvoiceRecvTel'] = $data['invoiceSeparate']['receiver_tel'];
            //<std::string> ��Ѹ��Ʊ�ջ��绰(�汾>=1)
            $order['icsonInvoiceRecvZip'] = $data['invoiceSeparate']['receiver_zip'];
            //<std::string> ��Ѹ��Ʊ�ջ��ʱ�(�汾>=1)
            $order['icsonInvoiceShipType'] = $data['invoiceSeparate']['shipping_type'];
            //<std::string> ��Ѹ��Ʊ���ͷ�ʽ(�汾>=1)
            $order['icsonInvoiceShipFee'] = $data['invoiceSeparate']['shipping_cost'];
            //<std::string> ��Ѹ��Ʊ���ͷ���(�汾>=1)
            $order['icsonInvoiceStockNo'] = $data['invoiceSeparate']['stockNo'];
            //<std::string> ��Ѹ��Ʊ����ֿ�id(�汾>=5)
            $order['icsonInvoiceSiteId'] = $data['invoiceSeparate']['siteId'];
            //<std::string> ��Ѹ��Ʊ�����վid(�汾>=5)
        }
        else {
            $order['icsonInvoiceRecvName'] = '';
            //<std::string> ��Ѹ��Ʊ�ջ���(�汾>=1)
            $order['icsonInvoiceRecvAddr'] = '';
            //<std::string> ��Ѹ��Ʊ�ջ���ַ(�汾>=1)
            $order['icsonInvoiceRecvRegionId'] = '';
            //<std::string> ��Ѹ��Ʊ�ջ���ַID(�汾>=1)
            $order['icsonInvoiceRecvMobile'] = '';
            //<std::string> ��Ѹ��Ʊ�ջ��ֻ�(�汾>=1)
            $order['icsonInvoiceRecvTel'] = '';
            //<std::string> ��Ѹ��Ʊ�ջ��绰(�汾>=1)
            $order['icsonInvoiceRecvZip'] = '';
            //<std::string> ��Ѹ��Ʊ�ջ��ʱ�(�汾>=1)
            $order['icsonInvoiceShipType'] = '';
            //<std::string> ��Ѹ��Ʊ���ͷ�ʽ(�汾>=1)
            $order['icsonInvoiceShipFee'] = '';
            //<std::string> ��Ѹ��Ʊ���ͷ���(�汾>=1)
            $order['icsonInvoiceStockNo'] = '';
            //<std::string> ��Ѹ��Ʊ����ֿ�id(�汾>=5)
            $order['icsonInvoiceSiteId'] = '';
            //<std::string> ��Ѹ��Ʊ�����վid(�汾>=5)
        }

        $order['icsonDealCode'] = $data['order_char_id'];
        //<std::string> ��Ѹ�����ţ���10��ͷ(�汾>=4)
        //����Ӫ�̻������ 1��Ӫ 2 ��Ӫ
        if ($data['sale_model'] == 2) {
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E['UNP_DEAL_PROP_51BUY_NEW_COOP_SALE'];
        }
        $order['sellerCorpId'] = isset($data['seller_id']) ? $data['seller_id'] : 0;
        //<uint64_t> �̼�id(�汾>=6)
        if ($data['SaleSpec'] == 1) {//С��
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_DEAL_SIZE_SMALL"];
        }
        else if ($data['SaleSpec'] == 2) {//�м�
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_DEAL_SIZE_MIDDLE"];
        }
        else if ($data['SaleSpec'] == 3) {//���
            $order['dealProperty2'] |= $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_DEAL_SIZE_LARGE"];
        }
        //����С��
        $order['lmsVolume'] = isset($data['Volume']) ? $data['Volume'] : 0;
        //<std::string> ���(�汾>=6)
        $order['lmsWeight'] = isset($data['Weight']) ? $data['Weight'] : 0;
        //<std::string> ����(�汾>=6)
        $order['lmsLongest'] = isset($data['LongestEdge']) ? $data['LongestEdge'] : 0;
        //<std::string> ���(�汾>=6)
        $order['dealActiveInfoList'] = self::getTradeActivePoList($data['dealActiveInfoList']);
        //<ecc::deal::po::CTradeActivePoList> ������б�(�汾>=7)

        return $order;
    }

    /**
     * ��ȡͳһƽ̨��Ʊ����
     * @param $type int
     * @return
     */
    private static function getInvoiceType($type) {
        if (2 == $type) {//��ֵ˰��Ʊ
            //INVOICE_TYPE_VAT = 2
            return 1;
        }
        else if (4 == $type) {//��ֵ˰��ͨ��Ʊ
            // INVOICE_TYPE_VAT_NORMAL = 4
            return 2;
        }
        else if (8 == $type) {//������Ʊ  ��ֵ˰��ͨ��Ʊ,�����Ʊ����IDΪ4
            // INVOICE_TYPE_VAT_NORMAL_NEW = 8
            return 4;
        }
        else {//��ҵ���۷�Ʊ(��˾)��ҵ���۷�Ʊ(����)
            // 1,3
            return 3;
        }
    }

    /**
     * ��ȡ��������,��Ӧԭ��Ѹ��վ�˶���flag�ֶ�,��Ʊ���붩����������Ҫ������Ѹ��վ������bits�ֶν����ж����ã�
     * @param $flag int
     * @param $bits int ��������bits�ֶ�
     * @return
     */
    private static function getDealProperty2($flag, $bits) {
        global $UNPDealProperty51Buy_E;
        $property = $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_NULL"];

        //�Ҷ��ڼ䶩��
        $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_GRAY_RELEASE_DEAL"];

        //��������flag�ֶζ���
        //define('ORDER_INSTALLMENT_FLAG', 0X1);
        if ($flag & 0X1) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_PAY_INSTALLMENT"];
        }
        //���ڸ����

        //define('ORDER_HAS_SERVICE', 0X2);
        if ($flag & 0X2) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_SERVICE_PRODUCT"];
        }
        //�����к��з�����Ʒ,��Ҫ���ݶ����Ƿ����������Ʒ�����ж�    ����   ������վ������flag�ֶ��жϣ�ORDER_HAS_SERVICE��

        //define('ORDER_CP', 0X4);
        if ($flag & 0X4) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_CONTRACT_PHONE"];
        }
        //��Լ������

        //define('ORDER_RUSHING_BUY_ONLINE_PAY', 0X8);
        if ($flag & 0X8) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_RUSH_BUY_ONLINE_PAY"];
        }
        // �����к���������Ʒ��Ϊ����֧��

        /*�����̵Ķ������׽���ƽ̨�µ��ģ�����ͬ����ͳһ��̨��
         //define('ORDER_ENTERPRISE_USER', 0X10);
         if ($flag & 0X10) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣���ҵ�û�������
         //define('ORDER_CHAOHUO_USER', 0X20);
         if ($flag & 0X20) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣������̣�����
         //define('ORDER_WHOLESALER_USER', 0X40);
         if ($flag & 0X40) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣������̣�����
         //define('ORDER_RETAILERS_USER', 0X80);
         if ($flag & 0X80) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣������̣�����
         //define('ORDER_FROM_NEW_SH', 0x40000000);
         if ($flag & 0x40000000) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         */

        //define('ORDER_ENERGY_SUBSIDY', 0x100);
        if ($flag & 0x100) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_ENERGY_SUBSIDY"];
        }
        // ���ܲ�������

        //define('ORDER_SHANGQI_USER', 0x200);
        if ($flag & 0x200) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SHANGQI_DEAL"];
        }
        //��������

        //define('ORDER_EXCHANGE_GOODS_FOR_ERP', 0x400);
        if ($flag & 0x400) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_EXCHANGE_GOODS_FOR_ERP"];
        }
        //�ͷ�����������ǰ̨δʹ��ռס������

        //define('ORDER_NONGHANG', 0x1000);
        if ($flag & 0x1000) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_ABCCHINA_SALE"];
        }
        //����ũ�л��Ʒ�Ķ�����������󣬸��ֶλ�ȥ��

        //��������bits�ֶζ���
        //define('ORDER_SEPARATE_GOODS_INVOICE', 0x1);
        if ($bits & 0x1) {
            $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SEPARATE_GOODS_INVOICE"];
        }
        //��Ʊ���붩����ǰ̨δʹ��ռס������

        return $property;
    }

    /**
     * ��ȡ֧����ʽ������Ѹ֧����ʽӳ��Ϊͳһƽ̨��֧����ʽ
     * @param $payType int
     * @return $uniPayType int
     */
    private static function getMappingUniPayType($payType) {
        global $UNPDealPayType_E;
        switch ((int)$payType) {
            case 1 :
                //��������
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_COD'];
                break;
            case 3 :
                //���е��
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_BANK_TRANS'];
                break;
            case 4 :
                //�ʾֻ��
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POST_TRANS'];
                break;
            case 5 :
                //���л���  �������ʺ���ֱ��ת�ʵ���Ѹ��ָ�����п���  ��ʱ����
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                break;
            case 6 :
                //����  ���������ڸ���
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                break;
            default :
                $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POL'];
                break;
        }

        return $uniPayType;
    }

    /**
     * ��ȡ�µ���Դ������Ѹ��Դӳ��Ϊͳһƽ̨����Դ
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
                //ҵ����վ
                return $UNPDealSource_E['UNP_DEAL_SOURCE_WEB'];
            default :
                return $UNPDealSource_E['UNP_DEAL_SOURCE_WEB'];
            //$UNPDealSource_E['UNP_DEAL_SOURCE_NULL'];
        }
    }

    /**
     * ��ȡ��Ʒ���б����
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
     * ��ȡ��Ʒ������
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
        //<std::string> ������ţ���Ϊ��(�汾>=0)
        $po['dealId64'] = 0;
        //<uint64_t> �������ţ����Ķ���ͬ����ʹ�ã���Ϊ��(�汾>=0)
        $po['bdealId'] = 0;
        //<uint64_t> ���׵��ţ���Ϊ��(�汾>=0)
        $po['tradeId'] = 0;
        //<uint64_t> ��Ʒ�����ţ����Ķ���ͬ����ʹ�ã���Ϊ��(�汾>=0)
        $po['buyerId'] = $data['buyerId'];
        //<uint64_t> ���ID(�汾>=0)
        $po['buyerNickName'] = iconv('GBK', 'UTF-8', $data['buyerNickName']);
        //<std::string> ����ǳ�(�汾>=0)
        $po['sellerId'] = $data['sellerId'];
        //<uint64_t> �̼�ID(�汾>=0)
        $po['sellerTitle'] = iconv('GBK', 'UTF-8', $data['sellerTitle']);
        //<std::string> �̼�����(�汾>=0)
        $po['businessId'] = $data['businessId'];
        //<uint32_t> ҵ��ID(�汾>=0)
        $po['tradeType'] = $data['tradeType'];
        //<uint8_t> ��������(�汾>=0)
        $po['tradeSource'] = $data['tradeSource'];
        //<uint32_t> �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap(�汾>=0)
        $po['tradePayType'] = $data['tradePayType'];
        //<uint8_t> ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������(�汾>=0)
        $po['shippingfeeTemplateId'] = '';
        //<std::string> �˷�ģ��ID(�汾>=0)
        $po['shippingfeeDesc'] = '';
        //<std::string> �˷�����(�汾>=0)
        $po['itemShippingfee'] = 0;
        //<uint32_t> ��Ʒ�˷�,����������㣬ֻ��չʾ����Ʒϵͳ����(�汾>=0)
        $po['itemType'] = $data['itemType'];
        //<uint32_t> ��Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ',0; 6: ���(�汾>=0)
        $po['itemClassId'] = $data['itemClassId'];
        //<uint32_t> Ʒ�ࣨ��Ŀ��ID(�汾>=0)
        $po['itemTitle'] = iconv('GBK', 'UTF-8', $data['itemTitle']);
        //<std::string> ��Ʒ����(�汾>=0)
        $po['itemAttrCode'] = $data['itemAttrCode'];
        //<std::string> ��Ʒ�������Ա���(�汾>=0)
        $po['itemAttr'] = iconv('GBK', 'UTF-8', $data['itemAttr']);
        //<std::string> ��Ʒ������������(�汾>=0)
        $po['itemId'] = $data['itemId'];
        //<std::string> ��ƷID����ҵ����(�汾>=0)
        $po['itemSkuId'] = $data['itemSkuId'];
        //<uint64_t> ��ƷSKUID(�汾>=0)
        $po['itemLocalCode'] = $data['itemLocalCode'];
        //<std::string> ��Ʒ�̼ұ��ر���(�汾>=0)
        $po['itemLocalStockCode'] = '';
        //<std::string> ��Ʒ�̼ұ��ؿ�����(�汾>=0)
        $po['itemBarCode'] = '';
        //<std::string> ��Ʒ������(�汾>=0)
        $po['itemSpuId'] = $data['itemSpuId'];
        //<uint64_t> ��ƷSPUID(�汾>=0)
        $po['itemStockId'] = $data['itemStockId'];
        //<uint64_t> ��Ʒ���ID(�汾>=0)
        $po['itemStoreHouseId'] = $data['itemStoreHouseId'];
        //<uint32_t> ��Ʒ�ֿ�ID(�汾>=0)
        $po['itemPhyisicalStorage'] = $data['itemPhyisicalStorage'];
        //<std::string> ��Ʒ���������(�汾>=0)
        $po['itemLogo'] = $data['itemLogo'];
        //<std::string> ��ƷͼƬLogo(�汾>=0)
        $po['itemSnapVersion'] = $data['itemSnapVersion'];
        //<uint32_t> ��Ʒ���հ汾��(�汾>=0)
        $po['itemResetTime'] = $data['itemResetTime'];
        //<uint32_t> ��Ʒ����ʱ���(�汾>=0)
        $po['itemWeight'] = $data['itemWeight'];
        //<uint32_t> ��Ʒ����(�汾>=0)
        $po['itemVolume'] = 0;
        //<uint32_t> ��Ʒ���(�汾>=0)
        $po['mainItemId'] = $data['mainItemId'];
        //<uint64_t> ��Ʒ�ײ�����ƷID(�汾>=0)
        $po['itemAccessoryDesc'] = '';
        //<std::string> ��Ʒ����˵��(�汾>=0)
        $po['itemCostPrice'] = $data['itemCostPrice'];
        //<uint32_t> ��Ʒ�ɱ���(�汾>=0)
        $po['itemOriginPrice'] = 0;
        //<uint32_t> ��Ʒ�г���(�汾>=0)
        //$po['itemSoldPrice'] =$data['itemSoldPrice'];
        //<uint32_t> ��Ʒ���۵���(�汾>=0)
        $po['itemB2CMarket'] = $data['itemB2CMarket'];
        //<std::string> ��ӪB2C�г�(�汾>=0)
        $po['itemB2CPM'] = $data['itemB2CPM'];
        //<std::string> ��ӪB2CPM(�汾>=0)
        $po['itemUseVirtualStock'] = $data['itemUseVirtualStock'];
        //<uint8_t> ��ӪB2C�Ƿ�ռ�����(�汾>=0)
        $po['buyPrice'] = $data['buyPrice'];
        //<uint32_t> ��Ʒ�ɽ���(�汾>=0)
        $po['buyNum'] = $data['buyNum'];
        //<uint32_t> ��Ʒ�ɽ�����(�汾>=0)
        $po['tradeTotalFee'] = $data['tradeTotalFee'];
        //<uint32_t> ��Ʒ���ܽ��,�µ����(�汾>=0)
        $po['tradeAdjustFee'] = 0;
        //<int> ��Ʒ�����۽��(�汾>=0)
        $po['tradePayment'] = $data['tradePayment'];
        //<uint32_t> ʵ���ܽ��(�汾>=0)
        $po['tradeDiscountTotal'] = $data['tradeDiscountTotal'];
        //<int> �Ż��ܽ��(�汾>=0)
        $po['tradePaipaiHongbaoUsed'] = 0;
        //<uint32_t> Paipai���ʹ�ý��(�汾>=0)
        $po['payScore'] = $data['payScore'];
        //<uint32_t> ����֧��ֵ(�汾>=0)
        $po['tradeGenTime'] = $data['tradeGenTime'];
        //<uint32_t> ��Ʒ������ʱ��(�汾>=0)
        $po['tradeOpSerialNo'] = 0;
        //<uint16_t> ��Ʒ�����������к�(�汾>=0)
        $po['obtainScore'] = $data['obtainScore'];
        //<uint32_t> ��û���ֵ(�汾>=0)
        $po['tradeState'] = 0;
        //<uint32_t> ��Ʒ��״̬(�汾>=0)
        $po['tradeProperty'] = 0;
        //<uint32_t> ��Ʒ������ֵ(�汾>=0)
        $po['tradeProperty1'] = 0;
        //<uint32_t> ��Ʒ������ֵ1(�汾>=0)
        $po['tradeProperty2'] = $data['tradeProperty2'];
        //<uint32_t> ��Ʒ������ֵ2(�汾>=0)
        $po['tradeProperty3'] = $data['tradeProperty3'];
        //<uint32_t> ��Ʒ������ֵ3(�汾>=0)
        $po['tradeProperty4'] = 0;
        //<uint32_t> ��Ʒ������ֵ4(�汾>=0)
        $po['itemTimeoutFlag'] = 0;
        //<uint32_t> ��Ʒ��ʱ��ʶ(�汾>=0)
        $po['lastUpdateTime'] = 0;
        //<uint32_t> ������ʱ��(�汾>=0)
        $po['activeInfoList'] = self::getTradeActivePoList($data['tradeActiveInfoList']);
        //<ecc::deal::po::CTradeActivePoList> ��Ʒ��б�(�汾>=0)
        //$po['dealExtInfoMap'] =new \stl_multimap2('uint32_t,stl_string');
        //<std::multimap<uint32_t,std::string> > ������չ��Ϣ (�汾>=0)
        $po['warranty'] = iconv('GBK', 'UTF-8', $data['warranty']);
        //<std::string> ��������(�汾>=1)
        $po['productId'] = $data['productId'];
        //<uint64_t> ��Ʒid(�汾>=1)
        $po['productCode'] = $data['productCode'];
        //<std::string> ��Ʒid����(�汾>=1)
        $po['icsonEdmCode'] = $data['icsonEdmCode'];
        //<std::string> ��Ѹedm����(�汾>=1)
        $po['icsonOTag'] = $data['icsonOTag'];
        //<std::string> ��ѸOTag(�汾>=1)
        $po['icsonTradeShopGuideCost'] = $data['icsonTradeShopGuideCost'];
        //<std::string> ��Ѹ���̵�������(�汾>=1)

        /*���ƻ����ߴ���ͨ���ﳵ�߼�����ע��
         $po['icsonCSPhoneType'] =$data['icsonCSPhoneType'];
         //<std::string> ��Ѹ���ƻ�����(�汾>=1)
         $po['icsonCSPhoneOperator'] =$data['icsonCSPhoneOperator'];
         //<std::string> ��Ѹ���ƻ���Ӫ��(�汾>=1)
         $po['icsonCSPhoneNumber'] =$data['icsonCSPhoneNumber'];
         //<std::string> ��Ѹ���ƻ�����(�汾>=1)
         $po['icsonCSPhoneArea'] =$data['icsonCSPhoneArea'];
         //<std::string> ��Ѹ���ƻ�������(�汾>=1)
         $po['icsonCSPhonePackageId'] =$data['icsonCSPhonePackageId'];
         //<std::string> ��Ѹ���ƻ��ײ�id(�汾>=1)
         $po['icsonCSPhoneUserName'] =$data['icsonCSPhoneUserName'];
         //<std::string> ��Ѹ���ƻ��û�����(�汾>=1)
         $po['icsonCSPhoneUserAddr'] =$data['icsonCSPhoneUserAddr'];
         //<std::string> ��Ѹ���ƻ��û���ַ(�汾>=1)
         $po['icsonCSPhoneUserMobile'] =$data['icsonCSPhoneUserMobile'];
         //<std::string> ��Ѹ���ƻ��û���ϵ�ֻ�(�汾>=1)
         $po['icsonCSPhoneUserTel'] =$data['icsonCSPhoneUserTel'];
         //<std::string> ��Ѹ���ƻ��û���ϵ�绰(�汾>=1)
         $po['icsonCSPhoneIdCardNo'] =$data['icsonCSPhoneIdCardNo'];
         //<std::string> ��Ѹ���ƻ����֤����(�汾>=1)
         $po['icsonCSPhoneIdCardAddr'] =$data['icsonCSPhoneIdCardAddr'];
         //<std::string> ��Ѹ���ƻ����֤��ַ(�汾>=1)
         $po['icsonCSPhoneIdCardDate'] =$data['icsonCSPhoneIdCardDate'];
         //<std::string> ��Ѹ���ƻ����֤��Ч��(�汾>=1)
         $po['icsonCSPhoneZipCode'] =$data['icsonCSPhoneZipCode'];
         //<std::string> ��Ѹ���ƻ���������(�汾>=1)
         $po['icsonCSPhoneCardPrice'] =$data['icsonCSPhoneCardPrice'];
         //<std::string> ��Ѹ���ƻ����۸�(�汾>=1)
         $po['icsonCSPhonePackagePrice'] =$data['icsonCSPhonePackagePrice'];
         */

        //<std::string> ��Ѹ���ƻ��ײͼ۸�(�汾>=1)
        $po['icsonTradeFlag'] = $data['icsonTradeFlag'];
        //<std::string> ��Ѹ��Ʒ�ӵ�flag(�汾>=1)
        $po['icsonPointType'] = $data['icsonPointType'];
        //<std::string> ��Ѹ���ֶһ�����(�汾>=1)
        $po['icsonPackageIds'] = $data['icsonPackageIds'];
        //<std::string> ��Ѹ��Ʒ�ӵ��ײ�id(�汾>=1)
        $po['icsonTradeCashBack'] = $data['icsonTradeCashBack'];
        //<uint32_t> �ӵ����ֽ��(�汾>=2)
        //$po['icsonUnitCostInvoice'] =$data['icsonUnitCostInvoice'];
        //<std::string> ȥ˰��ɱ�(�汾>=3)

        return $po;
    }

    /**
     * ��ȡ��Ʒ�����ֶΣ�����Ѹ�ֶ�ӳ��Ϊͳһ��������Ʒ���ı����ֶ�
     * @param $data Array
     * @return
     */
    private static function getMappingOrderTradePoRequiredFields($data) {
        global $UNPSellerAccount51Buy_E, $UNPDealBusiness_E, $UNPDealType_E, $UNPDealItemType_E;
        $trade = array();

        $trade['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> ���ID(�汾>=0)
        $trade['buyerNickName'] = isset($data['buyerNickName']) ? $data['buyerNickName'] : '';
        //<std::string> ����ǳ�(�汾>=0)
        $trade['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> �̼�ID(�汾>=0)
        $trade['sellerTitle'] = $UNPSellerAccount51Buy_E['sellerTitle'];
        //<std::string> �̼�����(�汾>=0)
        $trade['businessId'] = $UNPDealBusiness_E['UNP_DEAL_BUSINESS_51BUY'];
        //<uint32_t> ҵ��ID(�汾>=0)
        $trade['tradeType'] = $UNPDealType_E['UNP_DEAL_TYPE_SHOPCART'];
        //<uint8_t> ��������(�汾>=0)
        $trade['tradeSource'] = self::getMappingUniDealSource($data['ls']);
        //<uint32_t> �µ�������1��ҵ����վ��2���ƶ�app��3���ƶ�wap(�汾>=0)
        $trade['tradePayType'] = 0;
        //<uint8_t> ֧����ʽ��1�����߸��2��B2C�������3��C2C�������4���û����ύ�ף�5������ת�ˣ�6���������(�汾>=0)

        //��Ӧ����Ѹ��վ����Ʒ������product_type�ֶΣ�
        //��ѸĿǰֻ������������0:����Ʒ 1����� 2����Ʒ��
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
        //<uint32_t> ��Ʒ���ͣ�1����ͨ��Ʒ��2���ײ�����Ʒ��3���ײ͸���Ʒ��4����Ʒ����Ʒ��5����Ʒ����Ʒ=0; 6: ���(�汾>=0)

        $trade['itemClassId'] = 0;
        //<uint32_t> Ʒ�ࣨ��Ŀ��ID(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemTitle'] = $data['name'];
        //<std::string> ��Ʒ����(�汾>=0)
        $trade['itemAttrCode'] = '';
        //<std::string> ��Ʒ�������Ա���(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemAttr'] = '';
        //<std::string> ��Ʒ������������(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemId'] = $data['item_id'];
        //<std::string> ��ƷID����ҵ����(�汾>=0)
        $trade['itemSkuId'] = 0;
        //<uint64_t> ��ƷSKUID(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemLocalCode'] = $data['product_char_id'];
        //<std::string> ��Ʒ�̼ұ��ر���(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemSpuId'] = 0;
        //<uint64_t> ��ƷSPUID(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemStockId'] = 0;
        //<uint64_t> ��Ʒ���ID(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemStoreHouseId'] = 0;
        //<uint32_t> ��Ʒ�ֿ�ID(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemPhyisicalStorage'] = $data['stockNo'];
        //<std::string> ��Ʒ���������(�汾>=0)�����id��stockNo��Ŀǰ��Ѹ��Ʒû�м�¼��������γ�������ø��ֶΣ�
        $trade['itemLogo'] = '';
        //<std::string> ��ƷͼƬLogo(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemSnapVersion'] = 0;
        //<uint32_t> ��Ʒ���հ汾��(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemResetTime'] = 0;
        //<uint32_t> ��Ʒ����ʱ���(�汾>=0)  ͳһ��Ʒ��������д
        $trade['itemWeight'] = $data['weight'];
        //<uint32_t> ��Ʒ����(�汾>=0)
        $trade['mainItemId'] = $data['main_product_id'];
        //<uint64_t> ��Ʒ�ײ�����ƷID(�汾>=0)��Ӧ��Ѹ����������Ʒid����Ӧ����Ѹ��վ����Ʒ��main_product_id�ֶ�
        $trade['itemCostPrice'] = $data['cost'];
        //<uint32_t> ��Ʒ�ɱ���(�汾>=0)
        //$trade['itemSoldPrice'] = $data['price'];
        //<uint32_t> ��Ʒ���۵���(�汾>=0)
        $trade['itemB2CMarket'] = $data['apportToMkt'];
        //<std::string> ��ӪB2C�г�(�汾>=0)
        $trade['itemB2CPM'] = $data['apportToPm'];
        //<std::string> ��ӪB2CPM(�汾>=0)
        $trade['itemUseVirtualStock'] = $data['use_virtual_stock'];
        //<uint8_t> ��ӪB2C�Ƿ�ռ�����(�汾>=0)
        $trade['buyPrice'] = $data['price'];
        //<uint32_t> ��Ʒ�ɽ���(�汾>=0)
        $trade['buyNum'] = $data['buy_num'];
        //<uint32_t> ��Ʒ�ɽ�����(�汾>=0)

        /*
         *����Ʒ�ӵ���
         *�µ�ʱ: TradeTotalFee = TradePayment
         *TradePayment = (BuyPrice*BuyNum) - TradeDiscountTotal + TradeAdjustFee
         *TradeDiscountTotal = ��̯������Ʒ�ӵ��ϵ��Ż��ܺͣ����ɻ�б���ܵõ�
         */
        $trade['tradeTotalFee'] = $data['totalFee'];
        //<uint32_t> ��Ʒ���ܽ��=�µ����(�汾>=0)�ɽ���*�ɽ�����-�Ż��ܽ����������֣�
        $trade['tradePayment'] = $data['payment'];
        //<uint32_t> ʵ���ܽ��(�汾>=0)�ɽ���*�ɽ�����-�Ż��ܽ����������֣�
        $trade['tradeDiscountTotal'] = $data['discount'];
        //<int> �Ż��ܽ��(�汾>=0)����·���Ż��ܽ��֮�ͣ����������֣���̯������Ʒ�ӵ��ϵ��Ż��ܺͣ����ɻ�б���ܵõ�

        $trade['payScore'] = $data['points_pay'];
        //<uint32_t> ����֧��ֵ(�汾>=0)
        $trade['tradeGenTime'] = time();
        //<uint32_t> ��Ʒ������ʱ��(�汾>=0)
        $trade['obtainScore'] = $data['points'];
        //<uint32_t> ��û���ֵ(�汾>=0)
        $trade['tradeProperty2'] = self::getTradeProperty2($data['flag']);
        //<uint32_t> ��Ʒ������ֵ2(�汾>=0)
        $trade['tradeProperty3'] = self::getTradeProperty3($data['type']);
        //<uint32_t> ��Ʒ������ֵ3(�汾>=0)
        $trade['warranty'] = $data['warranty'];
        //<std::string> ��������(�汾>=1)
        $trade['productId'] = $data['product_id'];
        //<uint64_t> ��Ʒid(�汾>=1)
        $trade['productCode'] = $data['product_char_id'];
        //<std::string> ��Ʒid����(�汾>=1)

        //******************************��Ѹ�ֶ�**********************************
        $trade['icsonEdmCode'] = $data['edm_code'];
        //<std::string> ��Ѹedm����(�汾>=1)
        $trade['icsonOTag'] = $data['OTag'];
        //<std::string> ��ѸOTag(�汾>=1)
        $trade['icsonTradeShopGuideCost'] = $data['shop_guide_cost'];
        //<std::string> ��Ѹ���̵�������(�汾>=1)
        $trade['icsonTradeFlag'] = $data['flag'];
        //<std::string> ��Ѹ��Ʒ�ӵ�flag(�汾>=1)
        $trade['icsonPointType'] = $data['point_type'];
        //<std::string> ��Ѹ���ֶһ�����(�汾>=1)
        $trade['icsonPackageIds'] = $data['package_ids'];
        //<std::string> ��Ѹ��Ʒ�ӵ��ײ�id(�汾>=1)
        $trade['icsonTradeCashBack'] = $data['cash_back'];
        //<uint32_t> �ӵ����ֽ��(�汾>=2)

        //******************************��Ѹ��Լ������**********************************
        if (isset($data['CSPhone'])) {
            $trade['icsonCSPhoneType'] = $data['CSPhone']['service_type'];
            //<std::string> ��Ѹ���ƻ�����(�汾>=1)
            $trade['icsonCSPhoneOperator'] = $data['CSPhone']['sp_id'];
            //<std::string> ��Ѹ���ƻ���Ӫ��(�汾>=1)
            $trade['icsonCSPhoneNumber'] = $data['CSPhone']['num'];
            //<std::string> ��Ѹ���ƻ�����(�汾>=1)
            $trade['icsonCSPhoneArea'] = '';
            //<std::string> ��Ѹ���ƻ�������(�汾>=1)
            $trade['icsonCSPhonePackageId'] = $data['CSPhone']['package_id'];
            //<std::string> ��Ѹ���ƻ��ײ�id(�汾>=1)
            $trade['icsonCSPhoneUserName'] = $data['CSPhone']['name'];
            //<std::string> ��Ѹ���ƻ��û�����(�汾>=1)
            $trade['icsonCSPhoneUserAddr'] = $data['CSPhone']['user_addr'];
            //<std::string> ��Ѹ���ƻ��û���ַ(�汾>=1)
            $trade['icsonCSPhoneUserMobile'] = $data['CSPhone']['user_mobile'];
            //<std::string> ��Ѹ���ƻ��û���ϵ�ֻ�(�汾>=1)
            $trade['icsonCSPhoneUserTel'] = $data['CSPhone']['user_tel'];
            //<std::string> ��Ѹ���ƻ��û���ϵ�绰(�汾>=1)
            $trade['icsonCSPhoneIdCardNo'] = $data['CSPhone']['idcard_num'];
            //<std::string> ��Ѹ���ƻ����֤����(�汾>=1)
            $trade['icsonCSPhoneIdCardAddr'] = $data['CSPhone']['idcard_address'];
            //<std::string> ��Ѹ���ƻ����֤��ַ(�汾>=1)
            $trade['icsonCSPhoneIdCardDate'] = $data['CSPhone']['idcard_date'];
            //<std::string> ��Ѹ���ƻ����֤��Ч��(�汾>=1)
            $trade['icsonCSPhoneZipCode'] = $data['CSPhone']['zip_code'];
            //<std::string> ��Ѹ���ƻ���������(�汾>=1)
            $trade['icsonCSPhoneCardPrice'] = $data['CSPhone']['card_price'];
            //<std::string> ��Ѹ���ƻ����۸�(�汾>=1)
            $trade['icsonCSPhonePackagePrice'] = $data['CSPhone']['package_price'];
            //<std::string> ��Ѹ���ƻ��ײͼ۸�(�汾>=1)
        }

        return $trade;
    }

    /**
     * ������Ʒ��flag�ֶ�ת������Ѹ��վ����constant.inc.php�ж���
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
        //�ؼ���Ʒ��־

        //define("OTHER_TIME_LIMITED_RUSHING_BUY", 0x4);
        if ($flag & 0x4) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_OTHER_TIMELIMITED_BUY'];
        }
        //�����������ͱ�ʶ

        //define('CAN_VAT_INVOICE', 0X8);
        if ($flag & 0X8) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CAN_VAT_INVOICE'];
        }
        //�Ƿ��ܿ���Ʊ

        //define('IS_DEFAULT_INVOICE', 0X10);
        if ($flag & 0X10) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_IS_DEFAULT_INVOICE'];
        }
        //�Ƿ�Ĭ�Ͽ�Ʊ

        //define("TIME_LIMITED_RUSHING_BUY", 0x20);
        if ($flag & 0x20) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_TIMELIMITED_BUY'];
        }
        //��ʾ������־

        //define('FORBID_SET_VIRTUAL', 0x40);
        if ($flag & 0x40) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_FORBID_SET_VIRTUAL'];
        }
        //�Ƿ��ֹ�����

        //define('PRODUCT_ENERGY_SUBSIDY', 0x80);
        if ($flag & 0x80) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_ENERGY_SUBSIDY'];
        }
        //���ܲ�����Ʒ

        //define('CP_YCHF', 0x100);
        if ($flag & 0x100) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ��������Ԥ�滰�����ֻ�

        //define('CP_GJRW', 0x200);
        if ($flag & 0x200) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ�����������������ͻ���

        //define('CP_XHRW', 0x400);
        if ($flag & 0x400) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ��������ѡ������

        //define('CP_GMLJ', 0x800);
        if ($flag & 0x800) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ���������������

        //define('PRODUCT_EXTENDED_INSURANCE', 0x1000);
        if ($flag & 0x1000) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_EXTENDED_INSURANCE'];
        }
        //�ӱ���Ʒ

        //define('PROMOTION_PRODUCT', 0x2000);
        if ($flag & 0x2000) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_PROMOTION_PRODUCT'];
        }
        //������Ʒ

        //define('APPOINT_PRODUCT', 0x8000);
        if ($flag & 0x8000) {
            $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_APPOINT_PRODUCT'];
        }
        // Ԥ����Ʒ

        return $property;
    }

    /**
     * ������Ʒ������ת��
     * @param $type int
     * @return
     */
    private static function getTradeProperty3($type) {
        global $UNPTradeProperty51Buy3_E;
        $property = 0x00000000;

        switch ((int)$type) {
            case 0 :
                //Normal��ͨ��Ʒ
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_NORMAL'];
                break;
            case 1 :
                //SecondHand������Ʒ
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SECOND_HAND'];
                break;
            case 2 :
                //Bad��Ʒ
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_BAD'];
                break;
            case 3 :
                //Service����
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SERVICE'];
                break;
            case 4 :
                //OnlyViewNoSaleչʾ����
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ONLY_VIEW'];
                break;
            case 9 :
                //OtherProduct������Ʒ
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_OTHER'];
                break;
            case 10 :
                //AdjustProduct�ļ���Ʒ
                $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ADJUST'];
                break;
            default :
                break;
        }

        return $property;
    }

    /**
     * ��ȡ��б����
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
     * ��ȡ�����
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
        //<uint64_t> ��¼id(�汾>=0)
        $po['tradeId'] = 0;
        //<uint64_t> ��Ʒ�������(�汾>=0)
        $po['dealId'] = '';
        //<std::string> ������ţ���ʽ:�������XXXXYYYY����:101041051509351702(�汾>=0)
        $po['dealId64'] = 0;
        //<uint64_t> �������ţ�ͳһƽ̨�ڲ�����(�汾>=0)
        $po['bdealId'] = 0;
        //<uint64_t> ���׶������(�汾>=0)
        $po['buyerId'] = $data['buyerId'];
        //<uint64_t> ���ID(�汾>=0)
        $po['sellerId'] = $data['sellerId'];
        //<uint64_t> �̼�ID(�汾>=0)
        $po['activeType'] = $data['activeType'];
        //<uint16_t> ����ͣ�ƽ̨ͳһ����.1:VIP�� 2:����  3:���� 4:������ 5:�Ż�ȯ (�汾>=0)
        $po['activeNo'] = $data['activeNo'];
        //<uint64_t> ����(�汾>=0)
        $po['activeRuleId'] = $data['activeRuleId'];
        //<uint32_t> ����й�����(�汾>=0)
        $po['activeDesc'] = iconv('GBK', 'UTF-8', $data['activeDesc']);
        //<std::string> �����(�汾>=0)
        $po['adjustFee'] = $data['adjustFee'];
        //<int> ���۽���Ʒ���ۼ�¼�ã������(�汾>=0)
        $po['preActiveFee'] = $data['preActiveFee'];
        //<uint32_t> �ǰ����Ʒ�������(�汾>=0)
        $po['favorFee'] = $data['favorFee'];
        //<int> �����Ʒ�����Żݽ�������ʾ�Żݣ�������ʾ��Ǯ(�汾>=0)
        $po['activeParam1'] = $data['activeParam1'];
        //<uint32_t> �����1(�汾>=0)
        $po['activeParam2'] = $data['activeParam2'];
        //<uint32_t> �����2(�汾>=0)
        $po['activeParam3'] = $data['activeParam3'];
        //<uint32_t> �����3(�汾>=0)
        $po['activeParam4'] = $data['activeParam4'];
        //<uint32_t> �����4(�汾>=0)
        $po['activeParam5'] = $data['activeParam5'];
        //<uint64_t> �����5(�汾>=0)
        $po['activeParam6'] = $data['activeParam6'];
        //<uint64_t> �����6(�汾>=0)
        $po['activeParam7'] = $data['activeParam7'];
        //<std::string> �����7(�汾>=0)
        $po['activeParam8'] = $data['activeParam8'];
        //<std::string> �����8(�汾>=0)

        return $po;
    }

    /**
     * ��ȡ����ֶΣ�����Ѹ�ֶ�ӳ��Ϊͳһ��Ʒ���л�ı����ֶ�
     * @param $data Array
     * @return
     */
    private static function getMappingTradeActivePoRequiredFields($data) {
        global $UNPSellerAccount51Buy_E;
        $active = array();

        $active['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> ���ID(�汾>=0)
        $active['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> �̼�ID(�汾>=0)
        $active['activeType'] = $data['activeType'];
        //<uint16_t> ����ͣ�ƽ̨ͳһ����.1:VIP�� 2:����  3:���� 4:������ 5:�Ż�ȯ (�汾>=0)
        $active['activeNo'] = isset($data['activeNo']) ? $data['activeNo'] : 0;
        //<uint64_t> ����(�汾>=0)
        $active['activeRuleId'] = isset($data['activeRuleId']) ? $data['activeRuleId'] : 0;
        //<uint32_t> ����й�����(�汾>=0)
        $active['activeDesc'] = isset($data['activeDesc']) ? $data['activeDesc'] : '';
        //<std::string> �����(�汾>=0)
        $active['adjustFee'] = isset($data['adjustFee']) ? $data['adjustFee'] : 0;
        //<int> ���۽���Ʒ���ۼ�¼�ã������(�汾>=0)
        $active['preActiveFee'] = isset($data['preActiveFee']) ? $data['preActiveFee'] : 0;
        //<uint32_t> �ǰ����Ʒ�������(�汾>=0)
        $active['favorFee'] = isset($data['favorFee']) ? $data['favorFee'] : 0;
        //<int> �����Ʒ�����Żݽ�������ʾ�Żݣ�������ʾ��Ǯ(�汾>=0)
        $active['activeParam1'] = isset($data['activeParam1']) ? $data['activeParam1'] : 0;
        //<uint32_t> �����1(�汾>=0)
        $active['activeParam2'] = isset($data['activeParam2']) ? $data['activeParam2'] : 0;
        //<uint32_t> �����2(�汾>=0)
        $active['activeParam3'] = isset($data['activeParam3']) ? $data['activeParam3'] : 0;
        //<uint32_t> �����3(�汾>=0)
        $active['activeParam4'] = isset($data['activeParam4']) ? $data['activeParam4'] : 0;
        //<uint32_t> �����4(�汾>=0)
        $active['activeParam5'] = isset($data['activeParam5']) ? $data['activeParam5'] : 0;
        //<uint64_t> �����5(�汾>=0)
        $active['activeParam6'] = isset($data['activeParam6']) ? $data['activeParam6'] : 0;
        //<uint64_t> �����6(�汾>=0)
        $active['activeParam7'] = isset($data['activeParam7']) ? iconv('GBK', 'UTF-8', $data['activeParam7']) : '';
        //<std::string> �����7(�汾>=0)
        $active['activeParam8'] = isset($data['activeParam8']) ? iconv('GBK', 'UTF-8', $data['activeParam8']) : '';
        //<std::string> �����8(�汾>=0)

        return $active;
    }

    /**
     * ��ȡ������������
     * @param $data array
     * @return EventParamsBaseBo
     */
    private static function getEventParamsBaseBo($data = array()) {
        global $UNPSellerAccount51Buy_E;
        //$bo = new \ecc\deal\bo\EventParamsBaseBo();
        $bo = array();

        $bo['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> ���id(�汾>=0)
        $bo['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> ����id(�汾>=0)
        $bo['eventId'] = 0;
        //<uint32_t> �¼�id,����ϵͳ����(�汾>=0)
        $bo['operatorRole'] = 1;
        //<uint32_t> �����߽�ɫ(�汾>=0) 1����ң�2�����ң�3��ϵͳ��4����Ӫϵͳ��5��֧��ϵͳ�������ṩ��IDL����
        $bo['eventSource'] = self::$baseData['eventSource'];
        //<std::string> �¼���Դ��ҵ��������д���÷��������ļ���(�汾>=0)
        $bo['dealId'] = isset($data['dealId']) ? $data['dealId'] : '';
        //<std::string> ����id(�汾>=0)
        $bo['tradeId'] = 0;
        //<uint64_t> �ӵ�id(�汾>=0)
        $bo['clientIp'] = self::$baseData['clientIp'];
        //<std::string> ��Դip(�汾>=0)
        $bo['machineKey'] = self::$baseData['machineKey'];
        //<std::string> ������(�汾>=0)
        $bo['operatorName'] = '';
        //<std::string> ������(�汾>=0)
        $bo['reserve'] = '';
        //<std::string> �����ֶ�(�汾>=0)
        $bo['bdealId'] = isset($data['bdealId']) ? $data['bdealId'] : '';
        //<std::string> ���׵���(�汾>=1)

        return $bo;
    }

    /**
     * ��ȡ֧����������
     * @param $data array
     * @return EventParamsPayBo
     */
    private static function getEventParamsPayBo($data) {
        //$bo = new \ecc\deal\bo\EventParamsPayBo();
        $bo = array();

        $bo['feeCash'] = $data['feeCash'];
        //<uint32_t> �ֽ�֧�����(�汾>=0)
        $bo['feeTicket'] = 0;
        //<uint32_t> �Ƹ�ͨ�ֽ�ȯ֧�����(�汾>=0)
        $bo['feeVFee'] = 0;
        //<uint32_t> �ۿ�ȯ֧�����(�汾>=0)
        $bo['feeScore'] = 0;
        //<uint32_t> ����֧�����(�汾>=0)
        $bo['feeCaibei'] = 0;
        //<uint32_t> �ʱ�֧�����(�汾>=0)
        $bo['feeOther'] = 0;
        //<uint32_t> ����֧�����(�汾>=0)
        $bo['procedureFee'] = 0;
        //<uint32_t> ���������ѣ�������֧��ƽ̨������֧��ʱ����(�汾>=0)
        $bo['payTime'] = $data['payTime'];
        //<uint32_t> ֧��ʱ��(�汾>=0)
        $bo['payId'] = 0;
        //<uint64_t> ֧�����ţ�ͳһ������̨��֧����id��û���򲻴�(�汾>=0)
        $bo['payDealId'] = $data['payDealId'];
        //<std::string> ֧��������,֧�������ţ���Ƹ�ͨ���ţ�֧�������ŵ�(�汾>=0)
        $bo['bankType'] = $data['bankType'];
        //<std::string> ��������(�汾>=0)
        $bo['otherPayAccount'] = '';
        //<std::string> ���˴����ʺ�(�汾>=0)
        $bo['bindAccount'] = $data['receiveAccount'];
        //<std::string> ���˻�(�汾>=0)
        $bo['payBusinessId'] = $data['payBusinessId'];
        //<std::string> ֧��ҵ�񵥺ţ�֧��ϵͳ��ҵ�񶩵���(�汾>=0)
        $bo['paySeqId'] = $data['paySeqId'];
        //<std::string> ͳһ֧��ƽ̨��֧������(�汾>=1)

        return $bo;
    }

    /**
     * ��ȡ��ѯ��������
     * @param $bdealId string  ��Ѹ������
     * @return DealQueryBo
     */
    private static function getDealQueryBo($bdealId) {
        global $UNPSellerAccount51Buy_E;
        //$bo = new \ecc\deal\bo\DealQueryBo();
        $bo = array();

        //<uint16_t> �汾��(�汾>=0)
        $bo['dealId'] = 0;
        //<uint64_t> ����id(�汾>=0)
        $bo['tradeId'] = 0;
        //<uint64_t> �ӵ�id(�汾>=0)
        $bo['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];
        //<uint64_t> ����id(�汾>=0)
        $bo['buyerId'] = self::$baseData['buyerId'];
        //<uint64_t> ���id(�汾>=0)
        $bo['dealCode'] = '';
        //<std::string> ��������(�汾>=0)
        $bo['tradeCode'] = '';
        //<std::string> �ӵ�����(�汾>=0)
        $bo['businessDealId'] = $bdealId;
        //<std::string> ҵ�񶩵���(�汾>=0)
        $bo['bdealId'] = 0;
        //<uint64_t> ���׵�id(�汾>=1)
        $bo['bdealCode'] = '';
        //<std::string> ���׵�����(�汾>=1)

        return $bo;
    }

    /**
     * ��ȡ����֧��������������
     * @param $bdealId string  ��Ѹҵ�񸸶�����
     * @param $totalPayAmt string  ֧���ܽ��
     * @param $payTime int  ֧��ʱ��
     * @param $isMerge string  0-�Ǻϲ�֧��(������+1�ӵ�)��1-�ϲ�֧��(������+n�ӵ�)
     * @param $dealPayList string  ֧��ͬ����ζ����б�
     * @return OnlinePayBdealParams
     */
    private static function getOnlinePayBdealParams($bdealId, $totalPayAmt, $payTime, $isMerge, $dealPayList) {
        $po = array();

        //$po['version'] = 0;
        //<uint16_t> Э��汾��(�汾>=0)
        $po['bdealId'] = 0;
        //<uint64_t> ���׶�����(�汾>=0)
        $po['bdealCode'] = '';
        //<std::string> ���׶�����,�������Һ�(�汾>=0)
        $po['businessBdealId'] = $bdealId;
        //<std::string> ҵ�񸸶�����,����(�汾>=0)
        $po['payTime'] = $payTime;
        //<uint32_t> ֧��ʱ�䣬����(�汾>=0)
        $po['totalPayAmt'] = $totalPayAmt;
        //<uint32_t> ֧���ܽ��,����(�汾>=0)
        $po['isMerge'] = $isMerge;
        //<uint32_t> 0-�Ǻϲ�֧��(������+1�ӵ�)��1-�ϲ�֧��(������+n�ӵ�),����(�汾>=0)
        $po['payId'] = 0;
        //<uint64_t> ͳһ����֧������,����(�汾>=0)
        $po['dealParamsList'] = self::getOnlinePayDealParamsList($dealPayList);
        //<ecc::deal::po::COnlinePayDealParamsList> ֧��ͬ����ζ����б�(�汾>=0)
        $po['icsonAccount'] = '';
        //<std::string> ��Ѷ�ڲ��˺�(�汾>=0)
        $po['buyerId'] = '';
        //<std::string> ͳһ�û���(�汾>=0)

        return $po;
    }

    /**
     * ��ȡ����֧��������������
     * @param $list string  ֧�����б���Ϣ
     * @return OnlinePayDealParams
     */
    private static function getOnlinePayDealParamsList($list) {
        $poList = array();

        //$poList['version'] = 1;
        //<uint16_t> �汾��(�汾>=0)
        $OnlinePayDealParamsList = array();
        for ($i = 0, $len = count($list); $i < $len; $i++) {
            $OnlinePayDealParamsList[] = self::getOnlinePayDealParams($list[$i]['bdealId'], $list[$i]['payAmt'], $list[$i]['account'], $list[$i]['payType'], $list[$i]['payTime'], $list[$i]['tradeNo'], $list[$i]['seqId'], $list[$i]['sourceType'], $list[$i]['billType']);
        }
        $poList['dealParamsList'] = $OnlinePayDealParamsList;
        //new \stl_vector2('\ecc\deal\po\OnlinePayDealParams') ֧�����б�(�汾>=0)

        return $poList;
    }

    /**
     * ��ȡ����֧��������������
     * @param $bdealId string  ��Ѹ�Ӷ�����
     * @param $payAmt int ֧�����
     * @param $account string �տ��˻�
     * @param $payType string ֧������
     * @param $payTime int ֧��ʱ��
     * @param $tradeNo string �տ���ף���ˮ��
     * @param $seqId string ֧���ݵ�
     * @param $sourceType int ��Դ����
     * @param $billType int ��������
     * @param $dealId string ������
     * @return OnlinePayDealParams
     */
    private static function getOnlinePayDealParams($bdealId, $payAmt, $account, $payType, $payTime, $tradeNo, $seqId, $sourceType, $billType, $dealId = '') {
        $po = array();

        //$po['version'] = 0;
        //<uint16_t> Э��汾��(�汾>=0)
        $po['dealId'] = $dealId;
        //<std::string> ������(�汾>=0)
        $po['businessDealId'] = $bdealId;
        //<std::string> ������Ѹҵ�񵥺�,����(�汾>=0)
        $po['payAmt'] = $payAmt;
        //<uint32_t> ֧�����,����(�汾>=0)
        $po['account'] = $account;
        //<std::string> �տ��˻�������,ͳһ��̨(payAccount)(�汾>=0)
        $po['payType'] = $payType;
        //<std::string> ֧������ϵͳ���()������,ͳһ��̨(icsonPayType)(�汾>=0)
        $po['payTime'] = $payTime;
        //<uint32_t> ֧��ʱ�䣬����(�汾>=0)
        $po['tradeNo'] = $tradeNo;
        //<std::string> �տ���ף���ˮ�ţ�����,ͳһ��̨(paydealid)(�汾>=0)
        $po['key'] = $seqId;
        //<std::string> ֧���ݵȣ�����(�汾>=0)
        $po['sourceType'] = $sourceType;
        //<uint32_t> ��Դ����(1:ʵ��,2:����,3:����),����(�汾>=1)
        $po['billType'] = $billType;
        //<uint32_t> ��������(1:��ͨ����,2:��Ʒ��),����(�汾>=1)

        return $po;
    }

    /**
     * ��ȡmd5��ת��������
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
