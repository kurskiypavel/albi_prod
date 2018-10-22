<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/eventClass.php';

//get id of clicked item from url
$program = $_GET['program'];
$student = $_GET['student'];
$instructor = '1';
$page = $_GET['page'];
$user = $_GET['user'];



$obj = new eventClass($conn);

if ($_POST) {
    if (isset($_POST['createGroupEvent'])) {


        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']);
        $comment = htmlspecialchars($_POST['comment']);
        $confirmed = '0';
        $canceled = '0';
        $group_event_id=$program.'and'.$date.'and'.$time;

        //createGroupEvent
        $obj->createGroupEvent($group_event_id,$program,
            $student,$instructor,
            $date,$time,$comment,
            $confirmed,$canceled);
        if($page=='programs') {
            echo "<script>location.href = 'programs.php?user=".$user."';</script>";
        } elseif ($page=='program') {
            echo "<script>location.href = 'program.php?user=".$user."&id=".$program."';</script>";

        }

    }

}

if($page=='programs') {
    echo "<a href='programs.php?user=$user'>back</a>";
} elseif ($page=='program') {
    echo "<a href='program.php?user=$user&id=$program'>back</a>";
}

?>

<h4>Book place in group</h4>

<form  method="post">
    <p>Choose date</p><input name='date'  type="date" placeholder="date">
    <p>Choose time</p><input name='time'  type="time" placeholder="time">
    <p>Comment</p><input name='comment'  type="text" placeholder="comment">

    <input name="createGroupEvent" type="submit" value="Book">
</form>

<?php include_once '../parts/footer.php'?>