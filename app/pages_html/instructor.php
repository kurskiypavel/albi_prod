<?php

// Connection with DB
require_once '../config.php';


//get id of clicked item from url

$id = $_GET['id'];
$user = $_GET['user'];


//select user data
//$query = "SELECT * FROM users WHERE id='$id'";
$query = "SELECT * , count(programs.id) programsCount
    FROM users
    JOIN programs ON users.id = programs.instructor_id WHERE users.id='$id'";
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
    <title>User</title>
    <style>

        body {
            width: 320px;
        }
    </style>
</head>
<body>


<h3>Instructor</h3>


<img src="../<?php echo $obj->avatar; ?>" alt="Avatar">
<p><?php echo $obj->first_name . ' ' . $obj->last_name ?></p>
<div class="stats">

    <?php
//    echo 'Offers ' . $obj->programsCount . ' program' . ($obj->programsCount != 1 ? 's' : '');

    echo '<a href="bookPrivateEvent.php?user=' . $user . '&student=' . $user . '&instructor=' . $id . '">Book private lesson</a>';
    ?>


</div>
<div class="personalInfo">
    <h4>About instructor</h4>
    <p><?php echo $obj->about; ?></p>
    <div class="location">
<!--        <a href=""><h4>Get Instructor Location</h4></a>-->
        <p>Located in <?php echo $obj->location; ?></p>
    </div>


    <a href='contact-instructor.php?user=<?php echo $user; ?>&page=instructor&instructor=<?php echo $id; ?>&student=<?php echo $user; ?>'>
        <p>Contact
            Instructor</p></a>
</div>


<?php include_once '../parts/footer.php' ?>

</body>
</html>
