<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Tools Details</title>
</head>
<?php

include './header.php';
// include './sql_connect.inc.php';
?>
<link rel="stylesheet" href="../css/detailsTools.css">

<body>




    <?php

    //link+?mName=dadada
    //localhost/vyco/php/detailsMuscle.php?mName=dadada
    //../php/detailsMuscle.php?mName=dadada
    $TID = $_GET['TID'];

    // echo $mName;

    // $mName = "Recte major de l'abdomen";
    // $mName = "Romboide";

    $connection = OpenCon();


    $sql = "SELECT * FROM tools  where TID = " . $TID;
    $result = search($connection, $sql);

    while ($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        // print_r($row);
        $tid = $row["TID"];
        $tname = $row["TNAME"];
        $tprice = $row["TPRICE"];
        $timgpath = $row["TIMGPATH"];
        $desc = $row["Description"];
        // echo $tid . $tname . $tprice . $timgpath  . $desc;
    }

    echo '<script>let id = "'.'TID'.'='.$tid.'"</script>';


    $sql = "SELECT DISTINCT EID,ENAME,exercise.EIMGPATH from tools,uses,exercise where uses.Exercise_ID=exercise.EID and uses.Tools_ID = '" . $tid . "'";
    // echo $sql;
    //select EID,ENAME,exercise.EIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = "4"
    $exercise = search($connection, $sql);


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
        <h1>Tools Details</h1>
        <fieldset class="adminOnly" id="adminOnly" disabled>
            <form action="./updateTools.php" method="post">

                <img src=<?php echo '"' . $timgpath . '"' ?> alt=<?php echo '"' . $tname . '"' ?> title=<?php echo '"' . $tname . '"' ?>>
                
                <input type="hidden" name="tid" value=<?php echo $tid?> >
                <label for="name">Name</label>
                <input type="text" name="name" value=<?php echo '"' . $tname . '"' ?> />
                <input type="text" name="price" value=<?php echo '"' . $tprice . '"' ?> />


                <br>

                <label for="desc">Description:</label>
                <br>
                <textarea id="desc" name="desc" rows="5" cols="50" ><?php echo $desc ?></textarea>
                
                <a href="https://www.amazon.com/s?k=<?php echo$tname?>" target="_blank">
                <img src="../Image/amazon-icon.png"  class="buy-icon" alt="Buy Icon from Amazon" >
                </a>

                <a href="https://shopee.tw/mall/search?keyword=<?php echo$tname?>" target="_blank">
                <img src="../Image/shoppee-icon.png" class="buy-icon" alt=alt="Buy Icon from Amazon" >
                </a>
                
                <br>
                <input type=submit id="submit-btn">
            </form>
        </fieldset>





        <h1>Exercise</h1>
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