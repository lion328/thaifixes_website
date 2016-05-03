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

$filesMD5 = [];

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

    $filesMD5[$v] = $md5;
}

// Screenshot

$screenShotFiles = scandir('screenshots');

foreach ($screenShotFiles as $k => $v)
{
    if ($v == '.' || $v == '..')
    {
        unset($screenShotFiles[$k]);
    }
}

$screenShotFiles = array_values($screenShotFiles);
$screenShotFile = 'screenshots/' . $screenShotFiles[time() / 5 % count($screenShotFiles)];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ThaiFixes</title>

        <meta property="og:title" content="ThaiFixes">
        <meta property="og:description" content="ThaiFixes คือการปรับแต่งโค้ดของ Minecraft ให้สามารถใช้งานภาษาไทยได้อย่างเต็มรูปแบบและแสดงผลได้ถูกต้อง">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai' rel='stylesheet' type='text/css'>
        <link href="assets/css/thaifixes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <main class="wrapper">
            <header class="header">
                <h1>ThaiFixes</h1>
                <p>ThaiFixes คือการปรับแต่งโค้ดของ Minecraft ให้สามารถใช้งานภาษาไทยได้อย่างเต็มรูปแบบและแสดงผลได้ถูกต้อง</p>
            </header>

            <figure>
                <img class="screenshot" src="<?php echo $screenShotFile; ?>" alt='ThaiFixes screenshot'>
            </figure>

            <section id="stable-release">
                <h2>รุ่นเสถียร</h2>
                <table id="releases-table">
<?php foreach ($files as $v): ?>
                    <tbody>
                        <tr>
                            <td><?php echo $v; ?></td>
                            <td>MD5: <?php echo $filesMD5[$v]; ?></td>
                            <td>
                                <a href="http://adf.ly/6047434/https://minecraft.lion328.com/thaifixes/files/<?php echo $v; ?>">ดาวน์โหลด</a>
                                <a href="https://minecraft.lion328.com/thaifixes/files/<?php echo $v; ?>">(Direct)</a>
                            </td>
                        </tr>
                    </tbody>
<?php endforeach; ?>
                </table>
            </section>

            <section id="pre-release">
                <h2>รุ่นทดลอง</h2>
                <p>รุ่นทดลองเป็นรุ่นที่ยังไม่เสถียรพอที่จะสามารถใช้ในชีวิตประจำวันได้ สามารถดาวน์โหลดได้ที่ <a href="https://github.com/lion328/ThaiFixes/releases">Github</a></p>
            </section>

            <section id="source-code">
                <h2>รหัสต้นฉบับ</h2>
                <p>สามารถหารหัสต้นฉบับของรุ่นที่ใช้งานกับ MinecraftForge ได้ที่ <a href="https://github.com/lion328/ThaiFixes/">Github</a></p>
            </section>

            <section id="contract">
                <h2>ติดต่อ</h2>
                <ul>
                    <li><a href="https://github.com/lion328">Github</a></li>
                    <li><a href="https://facebook.com/lion328.mcd">Facebook</a></li>
                </ul>
            </section>

            <footer>
                <hr>
                <p class="copyright">&copy; <?php echo date('Y'); ?> lion328</p>
            </footer>
        </main>

        <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
        <script src="https://files-stackablejs.netdna-ssl.com/stacktable.min.js"></script>
        <script src="assets/js/thaifixes.js"></script>
    </body>
</html>
