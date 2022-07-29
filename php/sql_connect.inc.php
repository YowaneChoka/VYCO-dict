<!doctype html>
<html>

<head>
        <title>connect</title>
        <meta charset="utf-8">
</head>


<?php

// $connect = OpenCon();

//$sqlTest = "INSERT INTO USER(ISADMIN,UEMAIL,TYPE_ID) VALUES ('0','JANCOK@TETEK.COM','1');";
//echo 'Jnacok'.insert($connect, $sqlTest);

// CloseCon($connect);
?>

<?php
function OpenCon()
{
        // echo 'connecting...<br>';

        $dbhost = "localhost";
        $xuehao = "A1073326";

        $dbuser = $xuehao;
        $dbpass = $xuehao;

        $dbuser = "root";
        $dbpass = "12345678";

        $db = "vyco";

        // $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }


        return $conn;
}

function insert($conn, $sql)
{
        if ($conn->query($sql) === TRUE) {
                // echo "New record created successfully";
                return true;
        }
        #echo "Error: " . $sql . "<br>" . $conn->error;

        return false;
}

function search($conn, $sql)
{
        
        $result = $conn->query($sql);
        
        if (!$result) {
                return 0;
        }
        return $result;
        /*
        README
        instruction of use
        $connection = OpenCon();

                $sql = "SELECT MID,MNAME FROM MUSCLE ";

                $result = search($connection, $sql);



                while ($row = $result->fetch_assoc()) {
                    // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                    // print_r($row);
                    $muscleID = $row["MID"];
                    $muscleName = $row["MNAME"];
                    echo "<input type=checkbox name='muscle[]' value=" . $muscleID . ">  " . $muscleName . "<br>";
                }
        
        CloseCon($connection)
        */
}

function CloseCon($conn)
{
        // echo '<br>Closing connection...<br>';
        $conn->close();
}


//include('sql_connect.inc.php');
?>
