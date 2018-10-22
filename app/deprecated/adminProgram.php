<?php

// Connection with DB
require_once '../config.php';
require_once '../classes/programClass.php';

//get id of clicked item from url
$id = $_GET['id'];
$user = $_GET['user'];

$obj = new programClass($conn);

if ($_POST) {
    if (isset($_POST['create'])) {
        echo 'create';
        $title = htmlspecialchars($_POST['title']);
        $schedule = htmlspecialchars($_POST['schedule']);
        $description = htmlspecialchars($_POST['description']);
        $created_at = date('Y-m-d H:i:s');
        $focus = htmlspecialchars($_POST['focus']);
        $level = htmlspecialchars($_POST['level']);
        $duration = htmlspecialchars($_POST['duration']);
        $instructor_id = htmlspecialchars($_POST['instructor']);
        //create program
        $obj->create($title, $schedule, $description, $created_at, $focus, $level, $duration, $instructor_id);

    } elseif (isset($_POST['update']))  {
        echo 'update';
        $title = htmlspecialchars($_POST['title']);
        $schedule = htmlspecialchars($_POST['schedule']);
        $description = htmlspecialchars($_POST['description']);
        $created_at = date('Y-m-d H:i:s');
        $focus = htmlspecialchars($_POST['focus']);
        $level = htmlspecialchars($_POST['level']);
        $duration = htmlspecialchars($_POST['duration']);
        $instructor_id = htmlspecialchars($_POST['instructor']);
        //update program
        $obj->update($id,$title,$schedule,$description,$created_at,$focus,$level,$duration,$instructor_id);
    } elseif (isset($_POST['delete']))  {
        echo 'delete';
        //delete program
        $obj->delete($id);
    }
}


$query = "SELECT * FROM programs WHERE id='$id'";
$result = $conn->query($query);
if (!$result) die($conn->connect_error);
$rows = $result->num_rows;
$obj = $result->fetch_object();
?>

<form  method="post">
    <p>Title</p><input name='title' value="<?php echo $obj->title; ?>" type="text" placeholder="">
    <p>Focus</p><input name='focus' value="<?php echo $obj->focus; ?>" type="text" placeholder="">
    <p>Level</p><input name='level' value="<?php echo $obj->level; ?>" type="text" placeholder="">
    <p>Schedule</p><input name='schedule' value="<?php echo $obj->schedule; ?>" type="text" placeholder="">
    <p>Duration: min</p><input name='duration' value="<?php echo $obj->duration; ?>" type="text" placeholder="">
    <h4>Description</h4><input name='description' value="<?php echo $obj->description; ?>" type="text" placeholder="">
    <h4>Instructor</h4><input name='instructor' value="<?php echo $obj->instructor_id; ?>" type="text" placeholder="">

    <input name="create" type="submit" value="Create">
    <input name="update" type="submit" value="Update">
    <input name="delete" type="submit" value="Delete">
</form>

<?php include_once '../parts/footer.php' ?>