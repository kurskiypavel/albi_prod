<?php
// Connection with DB
require_once '../config.php';

//instructor id
$instructor = '1';

$user = $_GET['user'];
$page = $_GET['page'];
?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Instructor</title>

</head>
<body>
<?php


//select user data
$query = "SELECT * FROM users WHERE id='$instructor'";
$result = $conn->query($query);
if (!$result) die($conn->connect_error);
$rows = $result->num_rows;
$obj = $result->fetch_object();

$email = $obj->email;
$phone = $obj->phone;
$facebook = $obj->facebook;
$instagram = $obj->instagram;

if ($page == 'events') {

    echo '<a href="events.php?user=' . $user . '">Back</a>';
} elseif ($page == 'instructor') {
    echo '<a href="instructor.php?user=' . $user . '&id=' . $instructor . '">Back</a>';

}

if ($email) {
    echo '<a href="mailto:' . $email . '?Subject=Hello%20again" target="_top">Write Message</a> </br>';
}

if ($phone) {
    echo '<a href="tel:' . $phone . '">Call</a> </br>';
}
if (($email || $phone) && ($facebook || $instagram)) {
    echo '<p>- OR -</p>';
}
if ($facebook) {
    echo '<a href="https://www.facebook.com/' . $facebook . '">Facebook</a>';
}

if ($instagram) {
    echo '<a href="https://www.instagram.com' . $instagram . '">Instagram</a>';
}
?>

</br>
<?php include_once '../parts/footer.php' ?>
</body>
</html>