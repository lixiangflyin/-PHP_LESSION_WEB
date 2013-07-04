<?php
//将数组转成csv格式输出
function array_to_csv($data, $filename = 'exported_file.csv'){
    header('Content-Type: application/vnd.ms-excel');
    $filename = htmlspecialchars_decode($filename);
    header('Content-Disposition: attachment;filename="'.$filename.'.csv"');
    header('Cache-Control: max-age=0');

    $fp = fopen('php://output', 'a');

    // 计数器
    $cnt = 0;
    // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
    $limit = 100000;

    foreach ($data as $row) {
        $cnt ++;
        if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
            ob_flush();
            flush();
            $cnt = 0;
        }

        foreach ($row as $i => $v) {
            $row[$i] = iconv('utf-8', 'gbk', $v);
        }
        fputcsv($fp, $row);
    }
}

/**
 * 将秒钟转成xx小时xx分钟xx秒的格式
 */
function time2hour($dt, $need_second = 1) {
	$dt_h = floor($dt / 3600);
	$dt_m = floor(($dt - 3600 * $dt_h) / 60);
	$dt_s = $dt % 60;
	$str = '';
	if ($dt_h > 0) {
		$str .= $dt_h . "小时";
	}
	if ($dt_m > 0) {
		$str .= $dt_m . "分钟";
	}
	if ($need_second) {
		$str .= $dt_s . "秒钟";
	}
	return $str;
}
