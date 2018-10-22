<?php

// Connection with DB
require_once 'config.php';
require_once 'classes/videoClass.php';

//get id of clicked item from url
$id = $_GET['id'];


$obj = new videoClass($conn);

if ($_POST) {
    if (isset($_POST['create'])) {
        echo 'create';
        $episode = htmlspecialchars($_POST['episode']);
        $season = htmlspecialchars($_POST['season']);
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $source = htmlspecialchars($_POST['source']);
        $new = htmlspecialchars($_POST['new']);
        $created_at = date('Y-m-d H:i:s');

        //create video
        $obj->create($episode,
            $season,
            $title,
            $description,
            $source,
            $new, $created_at);

    }
    elseif (isset($_POST['update'])) {
        echo 'update';
        $episode = htmlspecialchars($_POST['episode']);
        $season = htmlspecialchars($_POST['season']);
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $source = htmlspecialchars($_POST['source']);
        $new = htmlspecialchars($_POST['new']);
        $created_at = date('Y-m-d H:i:s');

        //update video
        $obj->update($id, $episode,
            $season,
            $title,
            $description,
            $source,
            $new,
            $created_at);
    } elseif (isset($_POST['delete'])) {
        echo 'delete';
        //delete video
        $obj->delete($id);
    }
}


$query = "SELECT * FROM videos WHERE id='$id'";
$result = $conn->query($query);
if (!$result) die($conn->connect_error);
$rows = $result->num_rows;
$obj = $result->fetch_object();
?>

<form method="post">
    <p>Episode</p><input name='episode' value="<?php echo $obj->episode; ?>" type="text" placeholder="">
    <p>Season</p><input name='season' value="<?php echo $obj->season; ?>" type="text" placeholder="">
    <p>Title</p><input name='title' value="<?php echo $obj->title; ?>" type="text" placeholder="">
    <h4>Description</h4><input name='description' value="<?php echo $obj->description; ?>" type="text" placeholder="">
    <p>source</p><input name='source' value="<?php echo $obj->source; ?>" type="text" placeholder="">
    <p>new?</p><input name='new' value="<?php echo $obj->new; ?>" type="text" placeholder="1 или 0">
    <input name="create" type="submit" value="Create">
    <input name="update" type="submit" value="Update">
    <input name="delete" type="submit" value="Delete">
</form>

<a href="pages/programs.php">programs</a>
<a href="pages/videos.php">videos</a>
<a href="pages/events.php">events</a>
<a href="pages/user.php">my profile</a>