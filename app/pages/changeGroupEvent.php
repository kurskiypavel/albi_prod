<?php


// Connection with DB
require_once '../config.php';
require_once '../classes/eventClass.php';

//get id of clicked item from url
$id = $_GET['id'];
$page = $_GET['page'];
$user = $_GET['user'];


$obj = new eventClass($conn);

$queryEvent = "SELECT * FROM events WHERE id='$id'";
$resultEvent = $conn->query($queryEvent);
if (!$resultEvent) die($conn->connect_error);
$rowsEvent = $resultEvent->num_rows;
$objEvent = $resultEvent->fetch_object();


if ($_POST) {
    if (isset($_POST['changeGroupEvent'])) {


        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']);
        $comment = htmlspecialchars($_POST['comment']);
        $group_event_id = $objEvent->program . 'and' . $date . 'and' . $time;

        //changeGroupEvent
        $obj->updateGroup($date, $time, $id, $group_event_id, $comment);
        if($page=='programs') {
            echo "<script>location.href = 'programs.php?user=".$user."';</script>";
        } elseif ($page=='program') {
            echo "<script>location.href = 'program.php?user=".$user."&id=".$objEvent->program."';</script>";
        } elseif ($page=='events') {
            echo "<script>location.href = 'events.php?user=".$user."';</script>";
        }

    } elseif (isset($_POST['deleteGroupEvent'])) {

        //deleteGroupEvent
        $obj->delete($id);
        if($page=='programs') {
            echo "<script>location.href = 'programs.php?user=".$user."';</script>";
        } elseif ($page=='program') {
            echo "<script>location.href = 'program.php?user=".$user."&id=".$objEvent->program."';</script>";

        }elseif ($page=='events') {
            echo "<script>location.href = 'events.php?user=".$user."';</script>";
        }

    }

}


if ($page == 'programs') {
    echo "<a href='programs.php?user=".$user."'>back</a>";
} elseif ($page == 'program') {
    echo "<a href='program.php?user=".$user."&id=" . $objEvent->program . "'>back</a>";
}
?>

    <h4>Change booking</h4>

    <form method="post">
        <p>Choose date</p><input name='date' type="date" placeholder="date" value="<?php echo $objEvent->date; ?>">
        <p>Choose time</p><input name='time' type="time" placeholder="time" value="<?php echo $objEvent->time; ?>">
        <p>Comment</p><input name='comment' type="text" placeholder="comment" value="<?php echo $objEvent->comment; ?>">

        <input name="changeGroupEvent" type="submit" value="Change">
        <input name="deleteGroupEvent" type="submit" value="Cancel booking">
        </br>
    </form>

<?php include_once '../parts/footer.php' ?>