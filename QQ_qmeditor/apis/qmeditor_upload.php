<?php
define('ROOT', 'K:/opt/web/QQ_qmeditor');

if (!defined('TOP_PATH')) {
       define('TOP_PATH', 'http://127.0.0.1/');
}


$params = array_merge($_GET, $_POST);

//支持file name prefix设置
if (isset($params['prefix']) && !empty($params['prefix'])) {
    $prefix = $params['prefix'];
} else {
    $prefix = '';
}

//是否返回相对路径
if (isset($params['show_relative_path']) && $params['show_relative_path']) {
    $show_relative_path = true;
    if (isset($params['relative_base_path']) && $params['relative_base_path']) {
        $relative_base_path = $params['relative_base_path'];
    } else {
        $relative_base_path = '/';
    }
} else {
    $show_relative_path = false;
}

$type = '';

if (isset($params['from']) && $params['from'] == "snapscreen") {
    $upload_dir = ROOT . '/captures/' . date('Ym') . '/';
    $web_uri = 'captures/' . date('Ym') . '/';
    $file_name = $prefix . time() . '_' . rand(1, 100) . '.jpg';
    $type = 'capture';
} else {
    $upload_dir = ROOT . '/captures/' . date('Ym') . '/';
    $web_uri = 'pictures/' . date('Ym') . '/';
    $type = 'upload';
}

if (isset($params['domain']) && !empty($params['domain'])) {
    $domain = $params['domain'];
} else {
    $domain = 'oa.com';
}

if (isset($_FILES) && isset($_FILES['UploadFile']) && $_FILES['UploadFile']['size']>0) {
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if ($type != 'capture' && !empty($_FILES['UploadFile']['name'])) {
        $file_parts = pathinfo($_FILES['UploadFile']['name']);
        $file_ext = empty($file_parts['extension']) ? 'jpg' : $file_parts['extension'];
        $file_name = $prefix . time() . '_' . rand(1, 100) . '.' . $file_ext;
    }

    if (@move_uploaded_file($_FILES['UploadFile']['tmp_name'], $upload_dir . $file_name)) {
        if($show_relative_path) {
            $ret = $relative_base_path . $web_uri . $file_name;
        } else {
            $ret = TOP_PATH . $web_uri . $file_name;
        }
    } else {
        $ret = TOP_PATH . "img/lose.png";
    }
} else {
    $ret = TOP_PATH . "img/lose.png";
}
?>
<?php if ($_SERVER["HTTP_USER_AGENT"] == 'QMO Uploader') { ?>
<?php echo $ret; ?>
<?php } else { ?>
<html><head><script>document.domain = '<?php echo $domain;?>';</script></head><body><?php echo $ret?></body></html><? } ?>