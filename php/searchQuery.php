<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Muscle Details</title>
</head>
<?php

include './header.php';
// include './sql_connect.inc.php';
?>
<link rel="stylesheet" href="../css/detailsMuscle.css">

<body>




    <?php

    //link+?mName=dadada
    //localhost/vyco/php/detailsMuscle.php?mName=dadada
    //../php/detailsMuscle.php?mName=dadada

    $query = $_POST['query'];
    $query = strtolower($query);
    // echo $query.'<hr>';

    // $mName = "Recte major de l'abdomen";
    // $mName = "Romboide";


    $index = 0;
    $count = 0;
    $tempSearch = "";

    $maxCount = 0;
    
    $connection = OpenCon();
    while ($index < strlen($query)) {
        $tempSearch .= $query[$index];

        // echo $tempSearch.'<br>';
        if (strlen($tempSearch) >= 3) {
            //dec if more than 3 sliding window
            $temp = "SELECT DISTINCT EID,ENAME,EIMGPATH FROM exercise  where LOWER(ENAME) LIKE '%" . $tempSearch . "%'";
            

            // echo $temp.$maxCount.'<br>';
            $tempQuery = search($connection, $temp);
            if($tempQuery->num_rows>$maxCount){
                $max=$tempQuery;
                $maxCount = $max->num_rows;
                $maxSearch = $tempSearch;
            }
            $tempSearch = substr($tempSearch, 1);
        }
        // echo $temp.'<hr>';



        $index++;
        // echo $tempSearch.'<hr>';
    }

    if ($max->num_rows == 0) {
        echo '<script>
        alert("Exercise Not Found")
        window.location="./index.php";
    </script>';
      }

    $exercise = $max;

      $nestedQuery =  "SELECT DISTINCT EID FROM exercise  where LOWER(ENAME) LIKE '%" . $maxSearch . "%'";

    $sql = "SELECT DISTINCT TID,TNAME,TIMGPATH from tools,uses,exercise WHERE TID=uses.Tools_ID and uses.Exercise_ID=exercise.EID and EID IN 
  (".$nestedQuery.")";

    $tools = search($connection, $sql);

    ?>
    <!-- <script>alert("OK")</script> -->


    <main>

        <!-- https://stackoverflow.com/questions/3507958/how-can-i-make-an-entire-html-form-readonly -->



        <h1>Do you mean These Exercise(s)?</h1>
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
                    echo 'No Exercises Currently Stored!';
                ?>
            </ul>

            <!-- </div> -->
        </fieldset>



        <h1>Tools Used</h1>
        <fieldset class="readOnly" id="Tools" disabled>
            <ul>
                <?php
                if ($tools->num_rows > 0) {
                    while ($row = $tools->fetch_assoc()) {
                        //link to exercise details
                        $link = "./detailsTool.php?TID=" . $row['TID'];




                        $img = '<img src="' . $row["TIMGPATH"] . '" alt="' . $row["TNAME"] . '" title="' . $row["TNAME"] . '">';
                        echo '<li><a href="' . $link . '">';
                        echo $img;
                        echo '</a><br>' . $row["TNAME"];
                    }
                } else
                    echo 'No Tools Found Used!';
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
    <script src="../js/detailsMuscle.js"></script>

</body>

</html>