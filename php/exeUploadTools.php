<?php
include './header.php';

// include('sql_connect.inc.php');

$name = $_POST['name'];
$price = $_POST['price'];
$bio = $_POST['bio'];
$exercise = $_POST['exercise'];

echo $name.$price.$bio;
print_r($exercise);
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
$target_dir = "../Image/tools/";

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


//insert new tools
//use relation

$connection = OpenCon();

$c = 0;

$sql = "INSERT INTO `tools` (`TID`, `TNAME`, `TPRICE`, `TIMGPATH`,`Description`) 
VALUES (NULL, '" . $name . "', '" . $price . "', '" . $target_file . "', '" . $bio . "');";

echo $sql;



$c += insert($connection, $sql);
$tid = $connection->insert_id;
if ($connection->error) {
    die ("Error: " . $sql . "<br>" . $connection->error);
}

echo '<hr>';


for ($i = 0; $i < count($exercise); $i++) {
    // echo $tools[$i] . 'a';
    $eid = $exercise[$i];
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
    window.location='./uploadTools.php';
</script>