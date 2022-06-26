<?php
// include './header.php';

include('sql_connect.inc.php');

$tid = $_POST['tid'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$price = $_POST['price'];

echo $tid.'<hr>'.$name.$bio.$price;
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

$sql = "UPDATE tools
SET TNAME = '".$name."', Description = '".$desc."', TPRICE = ".$price."
WHERE TID = ".$tid.";";

echo $sql;
insert($connection,$sql);
if ($connection->error) {
    echo "Error: " . $sql . "<br>" . $connection->error;
    echo '<script>
    alert("Insert Succesfull")
    window.location="./detailsTool.php?TID='.$tid.'</script>';
}
echo $eid;



CloseCon($connection);

?>

<script>
   
    alert("Insert Succesfull")
    window.location='./detailsTool.php?TID='+<?php echo $tid; ?>;
</script>