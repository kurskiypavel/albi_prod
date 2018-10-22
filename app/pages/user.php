<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/programClass.php';


$user = $_GET['user'];
$classProgram = new programClass($conn);

//select userd data
$query = "SELECT * FROM users WHERE id='$user'";
$result = $conn->query($query);
if (!$result) die($conn->connect_error);
$rows = $result->num_rows;
$obj = $result->fetch_object();


//delete favorite program

//add dynamic favorite
if ($_POST) {

    foreach ($_POST as $name => $value) {
        //pass dynamic name from $_POST input
        $classProgram->deleteFromFavorites($name);
    }

}


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


<h3>My profile</h3>
<a href="adminUser.php?user=<?php echo $user; ?>">Settings</a>

<img src="../<?php echo $obj->avatar; ?>" alt="Avatar">
<p><?php echo $obj->first_name . ' ' . $obj->last_name ?></p>
<div class="stats">
    <!--    <p> Lessons Completed</p>-->
    <!--    <p> Favorites</p>-->
    <p>Member Since <?php echo $obj->created_at; ?></p>
</div>
<div class="personalInfo">
    <h4>Personal information</h4>
    <p>Gender: <?php echo $obj->gender; ?></p>
    <p>Birthdate: <?php echo $obj->birthdate; ?></p>
    <?php if ($obj->level == 'Instructor') {
        echo '<p>Level: ' . $obj->level . '</p>';
    }
    ?>

    <p>Location: <?php echo $obj->location; ?></p>
    <p>Email: <?php echo $obj->email; ?></p>
    <p>Phone: <?php echo $obj->phone; ?></p>
</div>
<div class="about">
    <p>About me</p>
    <p><?php echo $obj->about; ?></p>
</div>
<div class="favorites">
    <h4>My favorite programs</h4>
    <!--    select favorites titles -->

    <?php

    $query = "SELECT DISTINCT programs.title, `favorite-programs`.program as favoriteId
    FROM programs
    JOIN `favorite-programs` ON programs.id = `favorite-programs`.program WHERE `favorite-programs`.user='$user'";
    $result = $conn->query($query);
    if (!$result) die($conn->connect_error);
    $rows = $result->num_rows;

    for ($i = 0; $i < $rows; ++$i) {
        $result->data_seek($i);
        $obj = $result->fetch_object();
        echo '<a href="program.php?user=' . $user . '&id=' . $obj->favoriteId . '"><p>' . $obj->title . '</p></a>';
        echo '<form  method="post"><input name="' . $obj->favoriteId . '" type="submit" value="Dislike"></form>';
    }
    ?>

</div>

<?php include_once '../parts/footer.php' ?>

</body>
</html>
