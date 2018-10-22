<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/programClass.php';

$user = $_GET['user'];

$classProgram = new programClass($conn);


//add dynamic favorite
if ($_POST) {

    foreach ($_POST as $name => $value) {
        //pass dynamic name from $_POST input

        if (strpos($name,'DISLIKE') !== false) {
            $name = str_replace('DISLIKE', '', $name);
            $classProgram->deleteFromFavorites($name);
        } else{
            $classProgram->addToFavorite($user,$name);
        }
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
//select user data
$queryUser = "SELECT level FROM users WHERE level='Instructor' AND id='$user'";
$result = $conn->query($queryUser);
if (!$result) die($conn->connect_error);
$rows = $result->num_rows;
$objUser = $result->fetch_object();


?>
<div class="newPrograms">
    <h2>New Programs</h2>

    <?php
    //    instructor programs filter
    $query = "SELECT * FROM programs WHERE new='1'";
    $result = $conn->query($query);
    if (!$result) die($conn->connect_error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $obj = $result->fetch_object();
        echo '<div class="program">';
        echo '<img src="../' . $obj->image . '" alt="program avatar">';
        echo '<p>Share this ID ='.$obj->id.' </p>';

        //        select favorite programs BEGINS
        $queryFavoriteProgram = "SELECT * FROM `favorite-programs` WHERE user='$user' AND program='$obj->id'";
        $resultFavoriteProgram = $conn->query($queryFavoriteProgram);
        $rowsFavoriteProgram = $resultFavoriteProgram->num_rows;
        $objFavoriteProgram = $resultFavoriteProgram->fetch_object();
        if (!$objFavoriteProgram){
            echo '<form  method="post"><input name="'.$obj->id.'" type="submit" value="Like"></form>';
        } elseif ($objFavoriteProgram){
            echo '<form  method="post"><input name="DISLIKE'.$obj->id.'" type="submit" value="Dislike"></form>';
        }
        //        select favorite programs ENDS

        echo '<a href="program.php?user=' . $user . '&id=' . $obj->id . '"><h2>' . $obj->title . '</h2></a>';
        echo '<p>Every ' . $obj->schedule . '</p>';
        echo '<p>Level: ' . $obj->level . '</p>';
        echo '<p>Duration: ' . $obj->duration . ' min</p>';
        echo '<h3>Description</h3>';
        echo '<p>' . $obj->description . '</p>';
        echo '<a href="program.php?user=' . $user . '&id=' . $obj->id . '"><p>read more</p></a>';
        echo '</div>';

        //        booking functionality
        $queryEvent = "select id from events WHERE program='$obj->id' AND student='$user'";
        $resultEvent = $conn->query($queryEvent);
        $rowsEvent = $resultEvent->num_rows;
        $objEvent = $resultEvent->fetch_object();
        //book place - redirect to bookGroupevent
        if (!$objEvent) {
            echo '<a href="bookGroupEvent.php?user=' . $user . '&page=programs&program=' . $obj->id . '&student=' . $user . '&instructor=' . $obj->instructor_id . '"><p>Book place in group</p></a>';
        } elseif ($objEvent) {
            //already booked - event query
            echo '<a href="changeGroupEvent.php?user=' . $user . '&page=programs&id=' . $objEvent->id . '"><p>Change booking</p></a>';
        }

    }
    ?>
</div>

<div class="allPrograms">
    <h2>All Programs</h2>
    <?php
    //    show allPrograms for students
    $query = "SELECT * FROM programs";
    $result = $conn->query($query);
    if (!$result) die($conn->connect_error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $obj = $result->fetch_object();
        echo '<div class="program">';
        echo '<p>Share this ID ='.$obj->id.' </p>';

//        select favorite programs BEGINS
        $queryFavoriteProgram = "SELECT * FROM `favorite-programs` WHERE user='$user' AND program='$obj->id'";
        $resultFavoriteProgram = $conn->query($queryFavoriteProgram);
        $rowsFavoriteProgram = $resultFavoriteProgram->num_rows;
        $objFavoriteProgram = $resultFavoriteProgram->fetch_object();
        if (!$objFavoriteProgram){
            echo '<form  method="post"><input name="'.$obj->id.'" type="submit" value="Like"></form>';
        } elseif ($objFavoriteProgram){
            echo '<form  method="post"><input name="DISLIKE'.$obj->id.'" type="submit" value="Dislike"></form>';
        }
        //        select favorite programs ENDS

        echo '<a href="program.php?user=' . $user . '&id=' . $obj->id . '"><h2>' . $obj->title . '</h2></a>';
        echo '<p>Every ' . $obj->schedule . '</p>';
        echo '<p>Level: ' . $obj->level . '</p>';
        echo '<p>Duration: ' . $obj->duration . ' min</p>';
        echo '<h3>Description</h3>';
        echo '<p>' . $obj->description . '</p>';
        echo '<a href="program.php?user=' . $user . '&id=' . $obj->id . '"><p>read more</p></a>';
        echo '</div>';
        //        booking functionality
        $queryEvent = "select id from events WHERE program='$obj->id' AND student='$user'";
        $resultEvent = $conn->query($queryEvent);
        $rowsEvent = $resultEvent->num_rows;
        $objEvent = $resultEvent->fetch_object();
        //book place - redirect to bookGroupevent
        if (!$objEvent) {
            echo '<a href="bookGroupEvent.php?user=' . $user . '&page=programs&program=' . $obj->id . '&student=' . $user . '&instructor=' . $obj->instructor_id . '"><p>Book place in group</p></a>';
        } elseif ($objEvent) {
            //already booked - event query
            echo '<a href="changeGroupEvent.php?user=' . $user . '&page=programs&id=' . $objEvent->id . '"><p>Change booking</p></a>';
        }
    }
    ?>
</div>


<br>
<br>
<!--when clicked on program pass id over url-->
<?php include_once '../parts/footer.php' ?>
</body>
</html>

