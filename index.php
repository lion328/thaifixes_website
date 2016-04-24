<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>ThaiFixes</title>
</head>
<body>
<img src="screenshots/01_main_menu.png" width="683" height="351">
<h1>ThaiFixes</h1>
<p>Mod Minecraft ที่สามารถทำให้ใช้งานภาษาไทยในเกมได้อย่างเต็มรูปแบบ</p>
<h2>Stable release</h2>
<?php
require_once 'shared.php';
$files = filesListWithTime('files');
arsort($files);
foreach($files as $k => $v){
	if($k == '.' || $k == '..') continue;
	echo "Filename: {$k}<br>";
	$md5 = md5_file("files/{$k}");
	echo "MD5: {$md5}<br>";
	echo "<a href=\"http://adf.ly/6047434/thaifixes.lion328.com/files/{$k}\">ดาวน์โหลด</a> <a href=\"http://thaifixes.lion328.com/files/{$k}\">(Mirror)<a><br><br>";
}
?>
</body>
</html>
