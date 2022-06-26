<?php
// include './header.php';

include('sql_connect.inc.php');

$eid = $_POST['eid'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$type = $_POST['type'];

echo $eid.'<hr>'.$name.$bio.$type;
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

$sql = "UPDATE exercise
SET ENAME = '".$name."', Description = '".$desc."', Type_ID = ".$type."
WHERE EID = ".$eid.";";

echo $sql;
insert($connection,$sql);
if ($connection->error) {
    echo "Error: " . $sql . "<br>" . $connection->error;
    echo '<script>
    alert("Insert Failed")
    window.location="./updateExercise.php?EID="'.$eid.';
</script>';
}
echo $eid;



CloseCon($connection);

?>

<script>
   
    alert("Insert Succesfull")
    window.location='./detailsExercise.php?EID='+<?php echo $eid; ?>;
</script>