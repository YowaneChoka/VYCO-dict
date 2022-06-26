<?php
include './header.php';

// include('sql_connect.inc.php');

$uid = $_POST['uid'];
$name = $_POST['name'];
$type = $_POST['type'];
$age = $_POST['age'];
$password = $_POST['pw'];



echo $uid.$name.$age.$type.$password;
echo '<hr>';

// print_r($tools);
// echo '<hr>';
// print_r($muscle);
// echo '<hr>';
// print_r($type);


//insert new exercise
//use relation
//train relation

$connection = OpenCon();

$c = 0;

$sql = "UPDATE user
SET UNAME = '".$name."', PASSWORD = '".$password."', TYPE_ID = ".$type.", UAGE = ".$age
." WHERE UID =".$uid.";";

echo $sql;

insert($connection,$sql);
if ($connection->error) {
    echo "Error: " . $sql . "<br>" . $connection->error;
    echo '<script>
    alert("Insert Failed")
    window.location="./updateExercise.php?EID="'.$eid.';
</script>';
}



CloseCon($connection);

?>

<script>
   
    alert("Insert Succesfull")
    window.location='./index.php';
</script>