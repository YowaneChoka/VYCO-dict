

<?php
include './header.php';

// include 'sql_connect.inc.php';
session_start();
$connect = OpenCon();


$eid = $_GET['EID'];
// $userID = 2;
echo $eid . '<br>' . $userID . '<hr>';

$sql = "SELECT * FROM `likes` WHERE User_ID = '" . $userID . "' and Exercise_ID = '" . $eid . "'";

$result = search($connect, $sql);

if ($result->num_rows > 0) {
    //found like remove likes
    $sql = "DELETE FROM `likes` WHERE User_ID = '" . $userID . "' and Exercise_ID = '" . $eid . "'";
    $result = search($connect, $sql);

}
else{
    //Havent liked
    $sql = "INSERT `likes` (`User_ID`, `Exercise_ID`) VALUES ( '" . $userID . "',  '" . $eid . "')";
    echo $sql;
    $result = search($connect, $sql);

}

echo '<script>
// alert("Toggle Likes Succesful!")
window.location="./detailsExercise.php?EID='.$eid.'";
// window.close();
</script>';

CloseCon($connect);

?>
 
 