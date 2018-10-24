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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/flexiblegrid@v1.2.2/dist/css/flexible-grid.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/styleApp.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
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
                } catch (e) {}
            };
            s.parentNode.insertBefore(tk, s)
        })(document);
    </script>


</head>

<body class="userPage">
    <div class="header">
        <h3>My profile</h3>
        <a href="adminUser.php?user=<?php echo $user; ?>"><i class="fas fa-cog"></i></a>
    </div>
    <div class="body">
        <div class="card">
            <div class="subInstructor">
                <div class="headerInstructor" style="background-image: url(../../assets/images/App/user-images/<?php echo $obj->avatar; ?>);">
                </div>
                <div class="body">
                    <h3><?php echo $obj->first_name . ' ' . $obj->last_name ?></h3>
                </div>
            </div>
        </div>
        <div class="infoContainer">
            <div class="stats">
                <ul>
                    <!-- <li>
                                <p>17 Lessons Competed</p>
                            </li> -->
                    <li>
                        <!-- <p><span class="bold">6</span> Favorites</p> -->
                    </li>
                    <li>
<!--                        <p>Member Since <span class="bold">8 Months Ago</span></p>-->
                        <p>Member Since <span class="bold"><?php echo $obj->created_at; ?></span></p>
                    </li>
                </ul>
            </div>
            <div class="info">
                <h3>Personal information</h3>
                <ul>
                    <li>
                        <p><span class="bold">Gender: </span><?php echo $obj->gender; ?></p>
                        <p class="hide" style="display: none;"><span class="bold">Gender: </span>—</p>
                    </li>
                    <li>
<!--                        <p><span class="bold">Birthdate: </span>2011-11-11</p>-->
                        <p><span class="bold">Birthdate: </span><?php echo $obj->birthdate; ?></p>
                        <p class="hide" style="display: none;"><span class="bold">Birthdate: </span>—/—/— —</p>
                    </li>

                    <li>
<!--                        <p><span class="bold">Location: </span>Madrid, Spain</p>-->
                        <p><span class="bold">Location: </span><?php echo $obj->location; ?></p>
                        <p class="hide" style="display: none;"><span class="bold">Location: </span>—</p>
                    </li>
                    <li>
                        <p><span class="bold">Email: </span><?php echo $obj->email; ?></p>
                        <p class="hide" style="display: none;"><span class="bold">Email: </span>—</p>
                    </li>
                    <li>
<!--                        <p><span class="bold">Phone: </span>+1 (289) 830-1724</p>-->
                        <p><span class="bold">Phone: </span><?php echo $obj->phone; ?></p>
                        <p class="hide" style="display: none;"><span class="bold">Phone: </span>—</p>
                    </li>
                </ul>
            </div>
            <div class="about">
                <h3>About me</h3>
                <textarea class="aboutContent" placeholder="Tell your classmates about yourself…"><?php echo $obj->about; ?></textarea>
            </div>

        </div>
    </div>

    <?php include_once '../parts/footer.php' ?>
    <script src="//code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="/assets/js/jquery.nicescroll.min.js"></script>

</body>

</html>