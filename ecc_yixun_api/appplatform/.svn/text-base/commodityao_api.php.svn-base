<?php

require_once('platform/web_stub_cntl.php');
require_once('platform/lang_util.php');
require_once('commodityao_stub4php.php');

class CommodityWg{
	public static $errMsg = "";
	public static $errCode = 0;

	public static function UploadIcsonPic($productId, $picIdx, $picUrl) {
		$cntl = new WebStubCntl();
		$cntl->setDwOperatorId(855006089);
		// $cntl->setPeerIPPort('10.12.193.181', 53101);
		$cntl->setCallerName('UPLOADICSONPIC');

		$item = new SkuPicPo();
		$item->cSkuPicIndex = $picIdx; // uint8_t
		$item->cSkuPicType = 0; // uint8_t
		$item->strContent = ""; // std::string
		$item->strSkuPicDesc = ""; // std::string
		$item->strReserve = ""; // std::string
		$item->dwOption = 1; // uint32_t
		$item->strSkuPicUrl = $picUrl; // std::string
		$item->cIsMainLogo = ($picIdx == 0) ? 1 : 0; // uint8_t

		$req = new UploadIcsonPictureReq();
		$req->machineKey = 'icsonpic'; // std::string
		$req->source = $productId; // std::string
		$req->sceneId = 0; // uint32_t
		$req->option = 0; // uint32_t
		$req->skuPic = $item;
		$req->icsonId = 'pid:' . $productId;
		$req->cooperatorId = 855006089;
		$req->inReserve = ""; // std::string

		$resp = new UploadIcsonPictureResp();
		$ret = $cntl->invoke($req, $resp);
		return $resp;
	}
}

?>
