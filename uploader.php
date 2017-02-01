<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h1>Dateienliste</h1>
<ul>
    <?php

    $ordner = "C:\Users\Anabel\Downloads\Joes stuff\Writing"; //Pfad, wo die Datein sind, hier müsste also
                                                              // Verbindung mit der Datenbank hergestellt werden


    $alledateien = scandir($ordner); // Sortierung A-Z

    foreach ($alledateien as $datei) {

        $dateiinfo = pathinfo($ordner."/".$datei);  //zeigt Typ der Datei an
        $size = ceil(filesize($ordner."/".$datei)/1024);//1024 steht für kb
        $date = date("d.m.Y - H:i",filemtime ($ordner."/".$datei));


        if ($datei != "." && $datei != ".."  && $datei != "_notes") {
            ?>
            <li><a href="<?php echo $dateiinfo['dirname']."/".$dateiinfo['basename'];?>"><?php echo $dateiinfo['filename']; ?></a> (<?php echo $dateiinfo['extension']; ?> |<?php echo $date; ?> | <?php echo $size ; ?>kb)</li>
            <?php
        };
    };
    ?>
</ul>



</body>
