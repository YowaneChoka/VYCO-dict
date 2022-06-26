<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Exercise Details - VYCO</title>
</head>
<?php

include './header.php';
// include './sql_connect.inc.php';
?>
<link rel="stylesheet" href="../css/detailsExercise.css">

<body>




    <?php

    //link+?mName=dadada
    //localhost/vyco/php/detailsMuscle.php?mName=dadada
    //../php/detailsMuscle.php?mName=dadada

    $EID = $_GET['EID'];
    //   echo $EID;

    // $mName = "Recte major de l'abdomen";
    // $mName = "Romboide";

    $connection = OpenCon();
    $index = 0;
    $sql = "SELECT * FROM exercise  where EID = " . $EID;
    $result = search($connection, $sql);

    while ($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        // print_r($row);
        $eid = $row["EID"];
        $ename = $row["ENAME"];
        $eimgpath = $row["EIMGPATH"];
        $edemopath = $row["Demo_Path"];
        $type = $row["Type_ID"];
        $desc = $row["Description"];
        // echo $eid . $ename . $eimgpath . $edemopath . $type . $desc;
    }

    echo '<script>let id = "'.'EID'.'='.$eid.'"</script>';


    $sql = "SELECT DISTINCT MID,MNAME,MIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and exercise.EID = '" . $eid . "'";

    //select EID,ENAME,exercise.EIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = "4"
    $muscle = search($connection, $sql);

    $sql = "SELECT DISTINCT TID,TNAME,TIMGPATH from tools,uses,exercise WHERE TID=uses.Tools_ID and uses.Exercise_ID=exercise.EID and EID ='" . $eid . "'";

    $tools = search($connection, $sql);

    ?>
    <!-- <script>alert("OK")</script> -->


    <main>
 
        <!-- https://stackoverflow.com/questions/3507958/how-can-i-make-an-entire-html-form-readonly -->

        <button type="button" id="isEdit" class="ri-edit-box-line">
            Edit
        </button>

        <button type="button" id="delete" class="ri-delete-bin-line">
            Delete
        </button>

        <div class="break"></div>
        <h1>Exercise Details</h1>
        <fieldset class="adminOnly" id="adminOnly" disabled>
            <form action="./updateExercise.php" method="post">

                <?php
                // $edemopath = "";
                $headers = @get_headers($edemopath);

                // Use condition to check the existence of URL
                if ($headers && strpos($headers[0], '200')) {
                    $status = true;
                } else {
                    $status = false;
                }

                $embed = explode("=", $edemopath);

                if (!isset($edemopath) || $status == false) {
                ?>
                    <img src=<?php echo '"' . $eimgpath . '"' ?> alt=<?php echo '"' . $ename . '"' ?> title=<?php echo '"' . $ename . '"' ?>>
                <?php
                } else {
                    echo '<iframe width="100%"  height="500px" src="https://www.youtube.com/embed/' . $embed[1] . '">
                    </iframe><br>';
                }
                ?>
                <input type="hidden" name="eid" value=<?php echo $eid ?>>

                <?php
                if ($isLogin) {
                    echo '<button   class="btn love-icon love-btn" id="love-btn" ';


                    $sql = "SELECT * FROM `likes` WHERE User_ID = '" . $userID . "' and Exercise_ID = '" . $eid . "'";

                    $result = search($connection, $sql);

                    if ($result->num_rows > 0) {
                        echo 'style="color:red"';
                    }
                    
                    echo '>
                    <a href="./likeExercise.php?EID=' . $eid . '" ><i class="ri-heart-3-fill "></i></a>
                </button>';
                }
                ?>


                <label for="name">Name</label>
                <input type="text" name="name" value=<?php echo '"' . $ename . '"' ?> />



                <label class="top-cat">Type:

                    <select name="type" id="type">
                        <?php

                        $connection = OpenCon();
                        $sql = "SELECT TPID,TPNAME FROM type,exercise where  Type_ID = TPID and EID='" . $eid . "'";

                        // echo $sql;

                        $result = search($connection, $sql);
                        $selRow = $result->fetch_assoc();
                        $sql = "SELECT TPID,TPNAME FROM type";
                        $all = search($connection, $sql);


                        while ($row = $all->fetch_assoc()) {
                            // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                            // print_r($row);
                            $typeID = $row["TPID"];
                            $typeName = $row["TPNAME"];
                            if ($typeID == $selRow['TPID']) {
                                echo 'selected';
                            }
                            echo " <option value=" . $typeID;
                            if ($typeID == $selRow['TPID']) {
                                echo ' selected';
                            }
                            echo  "  >  " . $typeName . "</option><br>";
                        }

                        ?>
                    </select>
                </label>



                <br>
                <label for="desc">Description:</label>
                <br>
                <textarea id="desc" name="desc" rows="5" cols="50"><?php echo  $desc ?></textarea>
                <br>
                <input type=submit id="submit-btn">
            </form>
        </fieldset>





        <h1>Muscle Trained</h1>
        <fieldset class="readOnly" id="exercise" disabled>
            <!-- <div class="wrapper"> -->
            <ul>
                <?php
                if ($muscle->num_rows > 0) {
                    while ($row = $muscle->fetch_assoc()) {
                        //link to exercise details
                        $link = "./detailsMuscle.php?mName=" . $row['MNAME'];


                        $mpath = "../Image/muscle/" . $row["MIMGPATH"];
                        // echo $mpath;
                        $img = '<img src="' . $mpath . '" alt="' . $row["MNAME"] . '" title="' . $row["MNAME"] . '">';
                        echo '<li><a href="' . $link . '">';
                        echo $img;
                        echo '</a><br>' . $row["MNAME"];
                    }
                } else
                    echo 'No Muscle Trained Currently Stored!';
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