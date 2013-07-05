<?php
namespace ECC\User;

require_once ('appplatform/usericsonao_php5_stub.php');

use \Logger;

Logger::init();

class IcsonUser {
    /**
     * ��ȡͳһƽ̨�û�ID
     * @param $uid int
     * @return $wgUid int
     */
    public static function GetWgUidByIcsonUid($uid) {
        $result = \WebStubCntl2::request('b2b2c\user\ao\GetWgUidByIcsonUid', array(
            'opt' => array(
                'uin' => $uid,
                'operator' => $uid,
            ),
            'req' => array(
                'source' => __FILE__,
                'sceneId' => 0, //����id��������Ĭ����0����
                'machineKey' => isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : '',
                'icsonUid' => $uid, //��Ѹ�û�id��Ŀǰ��֧��32λ
                'inReserve' => ''
            )
        ));
        //var_dump($result);
        if ($result === false) {
            Logger::err("ECC\User\IcsonUser\::GetWgUidByIcsonUid failed, WebStubCntl2::request request error, uid:{$uid}");
            return false;
        }
        else {
            if ($result['code'] != 0) {
                Logger::err("ECC\User\IcsonUser\::GetWgUidByIcsonUid failed, code:{$result['code']}, msg:{$result['msg']}, uid:{$uid}");
                return false;
            }
            else {
                Logger::info("ECC\User\IcsonUser\::GetWgUidByIcsonUid success, wgid:{$result['data']['wgUid']}, uid:{$uid}");
                return $result['data']['wgUid'];
            }
        }
    }

}
