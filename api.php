<?php
require_once 'shared.php';
header('Content-Type: text/plain');
$files = filesListWithTime('files');
arsort($files);
$arr = array();
foreach($files as $k => $v){
	if($k == '.' || $k == '..') continue;
	$arr['files'][] = array('name' => $k, 'md5' => md5_file("files/{$k}"), 'download_url' => "http://adf.ly/6047434/thaifixes.lion328.com/files/{$k}");
}
$files = scandir('screenshots');
foreach($files as $v){
	if($v == '.' || $v == '..') continue;
	$arr['screenshots'][] = array('name' => $v, 'image_url' => "http://thaifixes.lion328.com/screenshots/{$v}");
}
echo json_encode($arr);
?>