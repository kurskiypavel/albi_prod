<?php
/**
 * Created by PhpStorm.
 * User: pavelkurskiy
 * Date: 2018-09-02
 * Time: 6:13 PM
 */


// Connection with DB
require_once '../config.php';


//get id of clicked item from url
$id = $_GET['id'];


$query = "SELECT * FROM videos WHERE id='$id'";
$result = $conn->query($query);
if (!$result) die($conn->connect_error);
$rows = $result->num_rows;
$obj = $result->fetch_object();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video</title>
    <style>
        body,.mediaVideo {
            width: 320px;
        }
    </style>
</head>
<body>

<h3><?php echo $obj->title; ?></h3>
<video class="mediaVideo" id="myVideo" autoplay>

    <source src="/videos/<?php echo $obj->source; ?>" type="video/mp4">

</video>
<div class='mediaControls'>
    <button onclick="playVideo()">Play</button>
    <button onclick="pauseVideo()">Pause</button>
</div>

<script>
    var video = document.querySelector("#myVideo");


    function playVideo() {
        video.play();
    }

    function pauseVideo() {
        video.pause();
    }
</script>

</body>
</html>
