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
    echo "<script>location.href = 'user.php?user=" . $user . "';</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/flexiblegrid@v1.2.2/dist/css/flexible-grid.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/styleApp.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">


    <!-- FONTS IMPORT -->
    <script>
        (function (d) {
            var config = {
                    kitId: 'wkb3jgo',
                    scriptTimeout: 3000,
                    async: true
                },
                h = d.documentElement,
                t = setTimeout(function () {
                    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                }, config.scriptTimeout),
                tk = d.createElement("script"),
                f = false,
                s = d.getElementsByTagName("script")[0],
                a;
            h.className += " wf-loading";
            tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
            tk.async = true;
            tk.onload = tk.onreadystatechange = function () {
                a = this.readyState;
                if (f || a && a != "complete" && a != "loaded") return;
                f = true;
                clearTimeout(t);
                try {
                    Typekit.load(config)
                } catch (e) {
                }
            };
            s.parentNode.insertBefore(tk, s)
        })(document);
    </script>


</head>

<body style="background: unset;">
<div class="settingsPage">
    <div class="header">

        <a href='user.php?user=<?php echo $user;?>'><i class="fas fa-arrow-left"></i></a>
        <h3>Settings</h3>
    </div>

    <div class="set">
        <h4>Your profile</h4>
    </div>
    <form method="post">
        <ul class="settingsContent">
            <li>
                <div class="subContent">
                    <span class="bold">First name</span>
                    <input name='first_name' value="<?php echo $obj->first_name; ?>" type="text" placeholder="—">
                </div>
            </li>
            <li>
                <div class="subContent">
                    <span class="bold">Last name</span>
                    <input name='last_name' value="<?php echo $obj->last_name; ?>" type="text" placeholder="—">
                </div>
            </li>
            <li>
                <div class="subContent">
                    <span class="bold">Gender</span>
                    <input name='gender' value="<?php echo $obj->gender; ?>" type="text" placeholder="—">
                </div>
            </li>
            <li>
                <div class="subContent">
                    <span class="bold">Birthdate</span>
                    <input name='birthdate' value="<?php echo $obj->birthdate; ?>" type="text" placeholder="—">
                </div>
            </li>
            <li>
                <div class="subContent">
                    <span class="bold">Location</span>
                    <input name='location' value="<?php echo $obj->location; ?>" type="text" placeholder="—">
                </div>
            </li>
            <li>
                <div class="subContent">
                    <span class="bold">Email</span>
                    <input name='email' value="<?php echo $obj->email; ?>" type="text" placeholder="—">
                </div>
            </li>
            <li>
                <div class="subContent">
                    <span class="bold">Phone</span>
                    <input name='phone' value="<?php echo $obj->phone; ?>" type="text" placeholder="—">
                </div>
            </li>
            <li>
                <div class="subContent">
                    <span class="bold">Password</span>
                    <input id='what' type="password" value="123456">
                </div>
            </li>
        </ul>
        <input name="update" type="submit" value="Done">
        <a href="user.php?user=<?php echo $user; ?>">Cancel</a>
    </form>
    <?php include_once '../parts/footer.php' ?>
</div>

</body>

</html>