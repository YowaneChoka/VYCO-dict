

<?php
include './header.php';

// include 'sql_connect.inc.php';
session_start();
$connect = OpenCon();


$email = $_POST['email'];
$pw = $_POST['pw'];


// echo $userName.$email.$pw;
$sql = "SELECT * FROM `user` WHERE uemail = '".$email."' and password = '".$pw."'";

$result = search($connect, $sql);

if ($result->num_rows == 1) {
    if($row = $result->fetch_assoc())
        $_SESSION['userID'] = $row['UID'];
    echo '<script>alert("Login Completed!\nWelcome!")
    window.location="./index.php";</script>';
}

echo '<script>alert("Login Failed!")
    window.location="./form.php";</script>';

CloseCon($connect);

?>
 
 