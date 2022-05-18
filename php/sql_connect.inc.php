<!doctype html>
<html>

<head>
        <title>connect</title>
        <meta charset="utf-8">
</head>


<?php
function sidebar_query($query)
{
        $rValue = "";
        // $query = ("SELECT sidebarposts FROM table;");
        $result = mysql_query($query);
        if ($row = mysql_fetch_array($result)) {
                // $rValue = $row['sidebarposts'];
                return $row;
        }
        else
                die("Query Unsuccessful")
        
}

// $sql_query = " select * from music where id='".$Na[0]."'  ";
// $result = mysql_query($sql_query);
// $row = mysql_fetch_array($result);

?>

<?php
$location = "127.0.0.1:5050";                                        
$account = "root"; 
$password = "12345678"; 


if (isset($location) && isset($account) && isset($password)) {     
        $link = mysql_pconnect($location, $account, $password);    
        mysql_query("SET NAMES 'utf8'");
        if (!$link) { 
                echo "<hr>MYSQL<hr>";
                exit();
        } else {
                


        }
}
$select_db = @mysql_select_db("dbms"); 

if (!$select_db) {
        echo '<br>DB not selected<br>';
        exit();
}

?>