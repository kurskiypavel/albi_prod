<?php


// Connection with DB
require_once '../config.php';
require_once '../classes/eventClass.php';

//get id of clicked item from url
$id = $_GET['id'];
$user = $_GET['user'];
$page = $_GET['page'];

$obj = new eventClass($conn);

$queryEvent = "SELECT * FROM events WHERE id='$id'";
$resultEvent = $conn->query($queryEvent);
if (!$resultEvent) die($conn->connect_error);
$rowsEvent = $resultEvent->num_rows;
$objEvent = $resultEvent->fetch_object();


if ($_POST) {
    if (isset($_POST['changePrivateEvent'])) {


        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']);
        $comment = htmlspecialchars($_POST['comment']);


        //changePrivateEvent
        $obj->updatePrivate($date, $time, $id, $comment);


        if ($page == 'instructor') {
            echo "<script>location.href = 'instructor.php?user=" . $user . "&id=" . $objEvent->instructor . "';</script>";
        } elseif ($page == 'events') {
            echo "<script>location.href = 'events.php?user=" . $user . "';</script>";
        }

    } elseif (isset($_POST['deletePrivateEvent'])) {

        //deletePrivateEvent
        $obj->delete($id);
        if ($page == 'instructor') {
            echo "<script>location.href = 'instructor.php?user=" . $user . "&id=" . $objEvent->instructor . "';</script>";
        } elseif ($page == 'events') {
            echo "<script>location.href = 'events.php?user=" . $user . "';</script>";
        }

    }

}


echo "<a href='events.php?user=" . $user . "'>back</a>";


?>

    <h4>Change booking</h4>

    <form method="post">
        <p>Choose date</p><input name='date' type="date" placeholder="date" value="<?php echo $objEvent->date; ?>">
        <p>Choose time</p><input name='time' type="time" placeholder="time" value="<?php echo $objEvent->time; ?>">
        <p>Comment</p><input name='comment' type="text" placeholder="comment" value="<?php echo $objEvent->comment; ?>">

        <input name="changePrivateEvent" type="submit" value="Change">
        <input name="deletePrivateEvent" type="submit" value="Cancel booking">
        </br>
    </form>

<?php include_once '../parts/footer.php' ?>