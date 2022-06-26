<?php
// include './header.php';

include('sql_connect.inc.php');

$mid = $_POST['mid'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$part = $_POST['part'];

echo $mid.'<hr>'.$name.$desc.$part;
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

$sql = "UPDATE muscle
SET MNAME = '".$name."', Description = '".$desc."', Part_ID = ".$part."
WHERE MID = ".$mid.";";

echo $sql;
insert($connection,$sql);
if ($connection->error) {
    echo "Error: " . $sql . "<br>" . $connection->error;
    echo '<script>
    alert("Insert Failed")
    window.location="./detailsMuscle.php?MID='.$mid.'";
</script>';
}
echo $eid;



CloseCon($connection);

?>

<script>
   
    alert("Insert Succesfull")
    window.location='./detailsMuscle.php?MID='+<?php echo $mid; ?>;
</script>