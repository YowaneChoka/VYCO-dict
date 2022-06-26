<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Tools List | VYCO</title>
</head>
<?php

include './header.php';
// include './sql_connect.inc.php';
?>
<link rel="stylesheet" href="../css/detailsExercise.css">

<body>




    <?php


    $connection = OpenCon();
    


    $sql = "SELECT DISTINCT TID,TNAME,TIMGPATH from tools";

    $tools = search($connection, $sql);

    ?>
    <!-- <script>alert("OK")</script> -->


    <main>


        <h1>List of Tools</h1>
        <fieldset class="readOnly" id="Tools" disabled>
            <ul>
                <?php
                if ($tools->num_rows > 0) {
                    while ($row = $tools->fetch_assoc()) {
                        //link to exercise details
                        $link = "./detailsTool.php?TID=" . $row['TID'];

                        // echo $row['TIMGPATH'].'<br>';


                        $img = '<img src="' . $row["TIMGPATH"] . '" alt="' . $row["TNAME"] . '" title="' . $row["TNAME"] . '">';
                        echo '<li><a href="' . $link . '">';
                        echo $img;
                        echo '</a><br>' . strtoupper($row["TNAME"]);
                    }
                } else
                    echo 'No Tools Used!';
                ?>
            </ul>
        </fieldset>

    </main>

    <!-- <script>
    document.getElementById('adminOnly').disabled = false
  </script> -->

    <?php



    include './footer.php';

    ?>
    <script src="../js/detailsExercise.js"></script>

</body>

</html>