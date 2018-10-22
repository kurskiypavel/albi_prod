<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/eventClass.php';


$id = $_GET['id'];
$user = $_GET['user'];

$classEvent = new eventClass($conn);

$query = "SELECT *
    FROM events
    JOIN users ON users.id = events.student WHERE events.id='$id'";
$result = $conn->query($query);
if (!$result) die($conn->connect_error);
$rows = $result->num_rows;
$obj = $result->fetch_object();


if ($_POST) {
    if (isset($_POST['confirm'])) {
        //        confirm private event
        $classEvent->confirm($id);
        echo "<script>location.href = 'event.php?user=".$user."&id=" . $id . "';</script>";
    } elseif (isset($_POST['change'])) {
//        redirect to change private event page
        echo "<script>location.href = 'changePrivateEvent.php?user=".$user."&id=" . $id . "';</script>";
    } elseif (isset($_POST['delete'])) {
        //deletePrivateEvent
        $classEvent->delete($id);
        echo "<script>location.href = 'events.php?user=".$user."';</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event</title>
    <style>

        body {
            width: 320px;
        }
    </style>
</head>
<body>


<h3>Event</h3>


<img src="../<?php echo $obj->avatar; ?>" alt="Avatar">
<p>Student <?php echo $obj->first_name . ' ' . $obj->last_name ?></p>
<div class="nextLesson"><p>Next lesson: <?php echo $obj->date; ?> at <?php echo $obj->time; ?></p></div>
<form method="post">
    <?php
    if ($obj->confirmed != 1) {
        echo '<p>Booking not confirmed yet.</p>';
        echo '<input name="confirm" type="submit" value="Confirm">';
    }
    ?>
    <input name="change" type="submit" value="Change">
    <input name="delete" type="submit" value="Cancel booking">
    <p>- OR -</p>
    <a href="contact-student.php?id=<?php echo $obj->student; ?>&instructor=<?php echo $obj->instructor; ?>"><p>Contact
            student</p></a>
</form>


<?php include_once '../parts/footer.php' ?>

</body>
</html>
