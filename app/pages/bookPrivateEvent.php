<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/eventClass.php';

//get id of clicked item from url
$student = $_GET['student'];
$instructor = '1';
$user = $_GET['user'];

$obj = new eventClass($conn);


if ($_POST) {
    if (isset($_POST['createPrivateEvent'])) {


        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']);
        $comment = htmlspecialchars($_POST['comment']);
        $confirmed = '0';
        $canceled = '0';
        $repeatable = $_POST['repeatable'];

        //createPrivateEvent
        $obj->createPrivateEvent(
            $student,$instructor,
            $date,$time,$comment,
            $confirmed,$canceled,$repeatable);
            echo "<script>location.href = 'instructor.php?user=".$user."&id=".$instructor."';</script>";


    }
}


?>

<h4>Book private lesson</h4>

<form  method="post">
    <p>Choose date</p><input name='date'  type="date" placeholder="date">
    <p>Choose time</p><input name='time'  type="time" placeholder="time">
    <p>Comment</p><input name='comment'  type="text" placeholder="comment">
    <label for="repeatable">Make repeatable</label>
    <input id='repeatable' name="repeatable" type="checkbox"  value="1">

    <input name="createPrivateEvent" type="submit" value="Book">
</form>

<?php include_once '../parts/footer.php'?>