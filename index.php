<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="UTF-8">
    <title>ThaiFixes</title>
    </head>
    <body>
        <img src="screenshots/01_main_menu.png" width="683" height="351">

        <h1>ThaiFixes</h1>
        <p>ThaiFixes คือการปรับแต่งโค้ดของ Minecraft ให้สามารถใช้งานภาษาไทยได้อย่างเต็มรูปแบบและแสดงผลได้ถูกต้อง</p>

        <h2>รุ่นเสถียร</h2>
<?php

$filesDir = "files/";

$files = scandir($filesDir);

foreach($files as $k => $v)
{
    if(($v == '.' || $v == '..') || (strpos($v, '.md5', strlen($v) - 4) !== false))
    {
        unset($files[$k]);
    }
}

usort($files, function($b, $a)
{
    $pattern = '/ThaiFixes_(\d+)\.(\d+)(?:\.(\d+))?(?:_(.*))?\.(?:jar|zip)/';

    preg_match($pattern, $a, $a_matches);
    preg_match($pattern, $b, $b_matches);

    for ($i = 1; $i <= 3; $i++)
    {
        if (empty($a_matches[$i]))
        {
            $a_matches[$i] = 0;
        }

        if (empty($b_matches[$i]))
        {
            $b_matches[$i] = 0;
        }

        $a_matches[$i] = intval($a_matches[$i]);
        $b_matches[$i] = intval($b_matches[$i]);


        if ($a_matches[$i] != $b_matches[$i])
        {
            return $a_matches[$i] - $b_matches[$i];
        }
    }

    if (empty($a_matches[3]))
    {
        return 1;
    }

    if (empty($b_matches[3]))
    {
        return -1;
    }

    return strcmp($a_matches[3], $b_matches[3]);
});

foreach($files as $k => $v)
{
    $file = "{$filesDir}{$v}";
    $md5file = "{$file}.md5";

    if (!file_exists($md5file))
    {
        $md5 = md5_file($file);
        file_put_contents($md5file, $md5);
    }
    else
    {
        $md5 = file_get_contents($md5file);
    }

    echo "        <p>\n";
    echo "            Filename: {$v}<br>\n";
	echo "        	  MD5: {$md5}<br>\n";
	echo "        	  <a href=\"http://adf.ly/6047434/https://minecraft.lion328.com/thaifixes/files/{$v}\">ดาวน์โหลด</a> <a href=\"https://minecraft.lion328.com/thaifixes/files/{$v}\">(Direct)<a>\n";
    echo "        </p>\n\n";
}
?>
        <h2>รุ่นทดลอง</h2>
        <p>รุ่นทดลองเป็นรุ่นที่ยังไม่เสถียรพอที่จะสามารถใช้ในชีวิตประจำวันได้ สามารถดาวน์โหลดได้ที่ <a href="https://github.com/lion328/ThaiFixes/releases">Github</a></p>

        <h2>รหัสต้นฉบับ</h2>
        <p>สามารถหารหัสต้นฉบับของรุ่นที่ใช้งานกับ MinecraftForge ได้ที่ <a href="https://github.com/lion328/ThaiFixes/">Github</a></p>

        <h2>ติดต่อ</h2>
        <ul>
            <li><a href="https://github.com/lion328">Github</a></li>
            <li><a href="https://facebook.com/lion328.mcd">Facebook</a></li>
        </ul>
    </body>
</html>
