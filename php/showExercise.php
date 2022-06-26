<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Exercise List | VYCO</title>
</head>
<?php

include './header.php';
// include './sql_connect.inc.php';



?>
<link rel="stylesheet" href="../css/detailsTools.css"> 

<body>


    <?php

    $connection = OpenCon();


    $sql = "SELECT DISTINCT EID,ENAME,exercise.EIMGPATH from exercise";
    // echo $sql;
    // die();

    //select EID,ENAME,exercise.EIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = "4"
    $exercise = search($connection, $sql);


    ?>
    <!-- <script>alert("OK")</script> -->


    <main>


        <h1>List of Exercise</h1>
        <fieldset class="readOnly" id="exercise" disabled>
            <!-- <div class="wrapper"> -->
            <ul>
                <?php

                if ($exercise->num_rows > 0) {

                    while ($row = $exercise->fetch_assoc()) {
                        //link to exercise details
                        $link = "./detailsExercise.php?EID=" . $row['EID'];


                        $img = '<img src="' . $row["EIMGPATH"] . '" alt="' . $row["ENAME"] . '" title="' . $row["ENAME"] . '">';
                        echo '<li><a href="' . $link . '">';
                        echo $img;
                        echo '</a><br>' . $row["ENAME"];
                    }
                } else
                    echo 'No Exercise Used Currently Stored!';
                ?>
            </ul>

            <!-- </div> -->
        </fieldset>



    </main>

    <!-- <script>
    document.getElementById('adminOnly').disabled = false
  </script> -->

    <?php


      include './footer.php';

    ?>
    <script src="../js/detailsTools.js"></script>

</body>

</html>