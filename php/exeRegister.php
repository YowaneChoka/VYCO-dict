

<?php
include './header.php';

// include 'sql_connect.inc.php';
session_start();

$connect = OpenCon();

$userName = $_POST['userName'];
$email = $_POST['email'];
$pw = $_POST['pw'];


// echo $userName.$email.$pw;

$sql = "INSERT INTO user(UNAME,ISADMIN,UEMAIL,TYPE_ID,password) 
VALUES ('" . $userName . "','0','" . $email . "','1','" . $pw . "');";

echo $sql;
$result = insert($connect, $sql);
echo $result; 

if (!$result) {
    die();
}

$_SESSION['userID'] = $connect->insert_id;
echo $connect->insert_id;
echo '<script>alert("Registration Completed!\nWelcome!")
window.location="./index.php";
</script>';

CloseCon($connect);

?>
 
