<?php
// Connection with DB
require_once 'config.php';
// define variables and initialize with empty values
$phone = $password = $confirm_password = "";
$phone_err = $password_err = $confirm_password_err = "";

// processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validate phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter a phone.";
    } else {
        // prepare a select statement
        $sql = "SELECT id FROM users WHERE phone = ?";

        if ($stmt = $conn->prepare($sql)) {
            // bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_phone);
            // set parameters
            $param_phone = trim($_POST["phone"]);

            // attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $phone_err = "This phone is already taken.";
                } else {
                    $phone = trim($_POST["phone"]);
                }
            }
        }
        // close statement
        $stmt->close();
    }

    // validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = 'Please confirm password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'Password did not match.';
        }
    }

    // check input errors before inserting in database
    if (empty($phone_err) && empty($password_err) && empty($confirm_password_err)) {
        // prepare an insert statement
        $sql = "INSERT INTO users (phone, password) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_phone, $param_password);
            // set parameters
            $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // attempt to execute the prepared statement
            if ($stmt->execute()) {
                //get new user id
                // prepare a select statement
                $sql = "SELECT id FROM users WHERE phone = ?";

                if ($stmt = $conn->prepare($sql)) {
                    // bind variables to the prepared statement as parameters
                    $stmt->bind_param("s", $param_phone);
                    // set parameters
                    $param_phone = $phone;

                    // attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        // store result
                        $stmt->store_result();

                        // check if phone exists, if yes then verify password
                        if ($stmt->num_rows == 1) {
                            // bind result variables
                            $stmt->bind_result($user_id);

                            if ($stmt->fetch()) {
                                $_SESSION['user_id'] = $user_id;
                            }
                        }
                    }
                }

                //check if session
                if (!$_SESSION['phone']) {
                    //new session
                    session_start();
                    $_SESSION['phone'] = $phone;
                    $_SESSION['user_id'] = $user_id;
                }
                // redirect to home page
                header("location: pages_styled/programs.php?user=".$user_id);
            }
        }
        // close statement
        $stmt->close();
    }

// close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>

</head>
<body>
<div class="container">

</div>
<div class="container">
    <div class="row">
        <div class="col s4"></div>
        <div class="col s4 userForm">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                    <label>Phone number</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                    <span class="help-block"><?php echo $phone_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control"
                           value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn red darken-1" value="Reset">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>
        <div class="col s4"></div>
    </div>

    

</body>
</html>