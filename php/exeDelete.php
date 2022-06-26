

<?php
// include './header.php';

include 'sql_connect.inc.php';
session_start();
$connect = OpenCon();


$eid = $_GET['EID'];
$tid = $_GET['TID'];
if (!isset($userID)) {
    $uid = $_GET['UID'];
} else
    $uid = $userID;

// $userID = 2;
echo $eid . $tid .  $uid;

    $isAdmin = true;

if (isset($uid)) {
    $sql = "DELETE FROM `user` WHERE UID = " . $uid;
}else if (!isset($isAdmin)) {
    echo '<script>
alert("Not Admin Not available to delete!")
window.location="./form.php";
// window.close();
</script>';
}
if (isset($eid)) {
    $sql = "DELETE FROM `exercise` WHERE EID = " . $eid;
} else if (isset($tid)) {
    $sql = "DELETE FROM `tools` WHERE TID = " . $tid;
} 

echo $sql;

$result = search($connect, $sql);

if ($result) {
    echo '<script>
    alert("Deletion Succesful!");
    window.location="./index.php";
   
    </script>';
}

echo '<script>
alert("Deletion Unsuccesful!")
window.location="./index.php";
</script>';

CloseCon($connect);

?>
 
 