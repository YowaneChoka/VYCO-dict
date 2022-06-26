<?php
include './header.php';

// include('sql_connect.inc.php');

$name = $_POST['name'];
$url = $_POST['url'];
$bio = $_POST['bio'];
$tools = $_POST['tools'];
$muscle = $_POST['muscle'];
$type = $_POST['type'];

echo $bio;
echo '<hr>';

// Use get_headers() function
$headers = @get_headers($url);

// Use condition to check the existence of URL
if ($headers && strpos($headers[0], '200')) {
    $status = true;
} else {
    $status = false;
}

if ($url != "" && !$status) {
    die("Youtube URL invalid");
}


if (!isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    die("No file Receiveed");
}

$fileName = basename($_FILES["file"]["name"]);
$target_dir = "../Image/exercise/";

$target_file = $target_dir . $fileName;



echo '<br>' . $target_file;

if (file_exists($target_file)) {
    $uploadOk = 0;
    // die("<script>alert('Sorry, file already exists.')</script>)");
    echo "<script>alert('File already exists.')</script>)";
}

$uploadOk = 1;
$fileNameCmps = explode(".", $fileName);

echo '<hr>' . $fileNameCmps[1];
//check if jpg
if ($fileNameCmps[1] != "jpg" && $fileNameCmps[1] != "png" && $fileNameCmps[1] != "jpeg") {
    die("Image must be in jpg or png");
}

$fileTmpPath = $_FILES['file']['tmp_name'];
// echo '<hr>' . $fileTmpPath;


// save target_file

if (!file_exists($target_file) and move_uploaded_file($fileTmpPath, $target_file)) {
    $message = 'File is successfully uploaded.';
} else {
    $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
}

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

$sql = "INSERT INTO `exercise` (`EID`, `ENAME`, `Demo_Path`, `EIMGPATH`, `Type_ID`,`Description`) 
VALUES (NULL, '" . $name . "', '" . $url . "', '" . $target_file . "', '" . $type . "', '" . $bio . "');";

// echo $sql;

$c += insert($connection, $sql);
$eid = $connection->insert_id;
if ($connection->error) {
    die ("Error: " . $sql . "<br>" . $connection->error);
}
// echo $eid;

echo '<hr>';
for ($i = 0; $i < count($muscle); $i++) {
    // echo $muscle[$i] . 'a';
    $mid = $muscle[$i];
    //insert to train

    $sql = "INSERT INTO `train` (`Muscle_ID`, `Exercise_ID`) 
     VALUES ('" . $mid . "', '" . $eid . "')";

    $c += insert($connection, $sql);
    echo "Error: " . $sql . "<br>" . $connection->error;
}

for ($i = 0; $i < count($tools); $i++) {
    // echo $tools[$i] . 'a';
    $tid = $tools[$i];
    //insert to train

    $sql = "INSERT INTO `uses` (`Tools_ID`, `Exercise_ID`) 
     VALUES ('" . $tid . "', '" . $eid . "')";

    $c +=  insert($connection, $sql);
    echo "Error: " . $sql . "<br>" . $connection->error;
}

echo $c;
if ($c != count($muscle) + count($tools) + 1) {
    echo 'Insert Failed';
}


CloseCon($connection);

?>

<script>
    alert("Insert Succesful")
    window.location='./uploadExercise.php';
</script>