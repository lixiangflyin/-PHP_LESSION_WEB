<?php
namespace ECC\User;

require_once ('appplatform/usericsonao_php5_stub.php');

use \Logger;

Logger::init();

class IcsonUser {
    /**
     * 获取统一平台用户ID
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
                'sceneId' => 0, //场景id，保留，默认填0即可
                'machineKey' => isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : '',
                'icsonUid' => $uid, //易迅用户id，目前仅支持32位
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
