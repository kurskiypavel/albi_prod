<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/userClass.php';


//get id of clicked item from url

$user = $_GET['user'];

$obj = new userClass($conn);

if (isset($_POST['update'])) {
    echo 'update';

    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $location = htmlspecialchars($_POST['location']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $about = htmlspecialchars($_POST['about']);
    $password = htmlspecialchars($_POST['password']);


    //update video
    $obj->update($user, $first_name, $last_name, $gender, $birthdate, $location, $email, $phone, $about, $password);
    echo "<script>location.href = 'user.php?user=".$user."';</script>";
}


$query = "SELECT * FROM users WHERE id='$user'";
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
    <title>Settings</title>
    <style>

        body {
            width: 320px;
        }
    </style>
</head>
<body>

<h3>Settings</h3>

<form method="post">
    <p>first_name</p><input name='first_name' value="<?php echo $obj->first_name; ?>" type="text" placeholder="">
    <p>last_name</p><input name='last_name' value="<?php echo $obj->last_name; ?>" type="text" placeholder="">
    <p>gender</p><input name='gender' value="<?php echo $obj->gender; ?>" type="text" placeholder="">
    <h4>birthdate</h4><input name='birthdate' value="<?php echo $obj->birthdate; ?>" type="text" placeholder="">
    <p>location</p><input name='location' value="<?php echo $obj->location; ?>" type="text" placeholder="">
    <p>email</p><input name='email' value="<?php echo $obj->email; ?>" type="text" placeholder="">
    <p>phone</p><input name='phone' value="<?php echo $obj->phone; ?>" type="text" placeholder="">
    <p>about</p><input name='about' value="<?php echo $obj->about; ?>" type="text" placeholder="">
    <p>password</p><input name='password' value="<?php echo $obj->password; ?>" type="password" placeholder="">

    <input name="update" type="submit" value="Done">
    <a href="user.php?user=<?php echo $user; ?>">Cancel</a>
</form>

<br>
<br>
<!--when clicked on event pass id over url-->
<?php include_once '../parts/footer.php' ?>
</body>
</html>