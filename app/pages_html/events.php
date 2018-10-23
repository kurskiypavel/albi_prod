<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/eventClass.php';


$user = $_GET['user'];



$classEvent = new eventClass($conn);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Events</title>
    <style>

        body {
            width: 320px;
        }
    </style>
</head>
<body>

<?php
if ($user) {
    echo '<div class="group"><h3>Group</h3>';
    $query = "SELECT DISTINCT *,events.id event
    FROM events
    JOIN programs ON programs.id = events.program WHERE events.student='$user' AND events.private ='0'";

    $result = $conn->query($query);
    if (!$result) die($conn->connect_error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $obj = $result->fetch_object();
        echo '<div class="event">';
        echo '<a href="program.php?user='.$user.'&id=' . $obj->program . '"><h1>' . $obj->title . '</h1></a>';
        echo '<p>Every ' . $obj->schedule . '</p>';
        echo '<p>Level ' . $obj->level . '</p>';
        echo '<p>Duration ' . $obj->duration . '</p>';
        echo '<div class="nextLesson"><p>Next lesson: ' . $obj->date . ' at ' . $obj->time . '</p></div>';
        echo '<a href="changeGroupEvent.php?user='.$user.'&page=events&id='.$obj->event.'"><p>Change booking</p></a>';
        if ($obj->confirmed == 0) {
            echo '<p>Booking not confirmed yet.</p><p>Please, wait for confirmation</p><p>- OR -</p>';
        }
        echo '<a href="contact-instructor.php?user='.$user.'&page=events&instructor=' . $obj->instructor . '&student=' . $obj->student . '"><p>Contact Instructor</p></a>';
        echo '</div>';
    }
    echo '</div><div class="personal"><h3>Personal</h3>';
    $query = "SELECT *,events.id event
    FROM events
    JOIN users ON users.id = events.instructor WHERE events.student='$user' AND events.private ='1'";

    $result = $conn->query($query);
    if (!$result) die($conn->connect_error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $obj = $result->fetch_object();
        echo '<div class="event">';
        echo '<p>Lesson with <b>
                <a href="instructor.php?user='.$user.'&id=' . $obj->instructor . '&student=' . $obj->student . '&event=' . $obj->event . '">' . $obj->first_name . ' ' . $obj->last_name . '</a>
            </b></p>';
        echo '<div class="nextLesson"><p>Next lesson: ' . $obj->date . ' at ' . $obj->time . '</p></div>';
        echo '<a href="changePrivateEvent.php?user='.$user.'&page=events&id='.$obj->event.'"><p>Change booking</p></a>';
        if ($obj->confirmed == 0) {
            echo '<p>Booking not confirmed yet.</p><p>Please, wait for confirmation</p><p>- OR -</p>';
        }
        echo '<a href="contact-instructor.php?user='.$user.'&page=events&instructor=' . $obj->instructor . '&student=' . $user . '"><p>Contact Instructor</p></a>';
        echo '</div>';
    }

    echo '</div>';
}



?>


<br>
<br>
<!--when clicked on event pass id over url-->
<?php include_once '../parts/footer.php' ?>
</body>
</html>

