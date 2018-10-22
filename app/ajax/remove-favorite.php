<?php


require_once '../config.php';

$program = $_POST['title'];


// prepare an insert statement
$sql = "DELETE FROM programs WHERE title='$program'";

if ($stmt = $conn->prepare($sql)) {
    // bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_pNumber);
    // attempt to execute the prepared statement
    $stmt->execute();
}
// close statement
$stmt->close();

