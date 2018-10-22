<?php

// Connection with DB
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Videos</title>
    <style>

        .mediaVideo, body {
            width: 320px;
        }
    </style>
</head>
<body>

<!--SEARCH BAR HERE-->



<!--VIDEOS-->
<div class="newVideos">New Videos
    <!--new videos-->
    <?php
    $query = "SELECT * FROM videos WHERE new='1'";
    $result = $conn->query($query);
    if (!$result) die($conn->connect_error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $obj = $result->fetch_object();
        echo '<p>Episode ' . $obj->episode . ' Season ' . $obj->season . '</p>';
        echo '<a href="video.php?id='.$obj->id.'"><img src="" alt="Video image"></a>';
        echo '<h4>' . $obj->title . ' Episode ' . $obj->episode . ' Season ' . $obj->season . '</h4>';
        echo '<p>' . $obj->description . '</p>';
        echo '<a href="../adminVideo.php?id='. $obj->id .'">Manage this video</a>';
    }
    ?>
</div>

<div class="allVideos" style="display: none;">All Videos
    <!--all videos-->
    <?php
    $query = "SELECT * FROM videos";
    $result = $conn->query($query);
    if (!$result) die($conn->connect_error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $obj = $result->fetch_object();
        echo '<p>Episode ' . $obj->episode . ' Season ' . $obj->season . '</p>';
        echo '<a href="video.php?id='.$obj->id.'"><img src="" alt="Video image"></a>';
        echo '<h4>' . $obj->title . ' Episode ' . $obj->episode . ' Season ' . $obj->season . '</h4>';
        echo '<p>' . $obj->description . '</p>';
        echo '<a href="../adminVideo.php?id='. $obj->id .'">Manage this video</a>';
    }
    ?>
</div>

<!--FOOTER-->

<a href="programs.php">programs</a>
<a href="videos.php">videos</a>
<a href="events.php">events</a>
<a href="user.php">my profile</a>
</body>
</html>

