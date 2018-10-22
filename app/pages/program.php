<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/programClass.php';

//class
$classProgram = new programClass($conn);

$user = $_GET['user'];
$id = $_GET['id'];

//add and delete favorite program
if ($_POST) {

    if (isset($_POST['like'])) {
        $classProgram->addToFavorite($user, $id);
    } elseif(isset($_POST['dislike'])) {
        $classProgram->deleteFromFavorites($id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Programs</title>
    <style>

        body {
            width: 320px;
        }
    </style>
</head>
<body>


<?php

$query = "SELECT *,programs.level level  FROM programs JOIN users ON programs.instructor_id=users.id WHERE programs.id='$id'";
$result = $conn->query($query);
$rows = $result->num_rows;
$obj = $result->fetch_object();

?>


<div class="program">

    <?php

    echo '<div class="program"><p>Share this ID =' . $id . '</p>';


    //        select favorite programs BEGINS
    $queryFavoriteProgram = "SELECT * FROM `favorite-programs` WHERE user='$user' AND program='$id'";
    $resultFavoriteProgram = $conn->query($queryFavoriteProgram);
    $rowsFavoriteProgram = $resultFavoriteProgram->num_rows;
    $objFavoriteProgram = $resultFavoriteProgram->fetch_object();
    if (!$objFavoriteProgram) {
        echo '<form  method="post"><input name="like" type="submit" value="Like"></form>';
    } elseif ($objFavoriteProgram) {
        echo '<form  method="post"><input name="dislike" type="submit" value="Dislike"></form>';
    }
    //        select favorite programs ENDS


    echo '<img src="../' . $obj->image . '" alt="program avatar">';
    echo '<h2>' . $obj->title . '</h2>';
    echo '<p>Every ' . $obj->schedule . '</p>';
    //        booking functionality
    $queryEvent = "SELECT * FROM events WHERE student='$user' AND program='$id'";
    $result = $conn->query($queryEvent);
    $rows = $result->num_rows;
    $objEvent = $result->fetch_object();
    if (!$objEvent) {
        echo '<a href="bookGroupEvent.php?user=' . $user . '&page=program&program=' . $id . '&student=' . $user . '&instructor=' . $obj->instructor_id . '"><p>Book place in group</p></a>';
    } elseif ($objEvent) {
        //already booked - event query
        echo '<a href="changeGroupEvent.php?user=' . $user . '&page=program&id=' . $objEvent->id . '"><p>Change booking</p></a>';
    }

    echo '<h3>Overview</h3>';
    echo '<p>Focus: ' . $obj->focus . '</p>';
    echo '<p>Level: <b>' . $obj->level . '</b></p>';
    echo '<p>Duration: <b>' . $obj->duration . ' min</b></p>';
    echo '<p>Group size:  <b>' . $obj->group_size . '</b> people</p>';
    echo '</div>';
    echo '<h3>Instructor</h3>';
    echo '<img src="../' . $obj->avatar . '" alt="Avatar">';
    echo '<p><b>' . $obj->first_name . ' ' . $obj->last_name . '</b></p>';
    echo '<p>' . $obj->about . ' <b>read more</b></p>';
    echo '<a href="instructor.php?user=' . $user . '&id=' . $obj->instructor_id . '"><p>read more</p></a>';

    ?>
</div>


<br>
<br>
<!--when clicked on program pass id over url-->
<?php include_once '../parts/footer.php' ?>
</body>
</html>

