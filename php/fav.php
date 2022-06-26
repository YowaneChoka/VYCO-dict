<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Profile - VYCO</title>
</head>
<?php

include './header.php';
// include './sql_connect.inc.php';
?>
<link rel="stylesheet" href="../css/profile.css">

<body>




    <?php

    //link+?mName=dadada
    //localhost/vyco/php/detailsMuscle.php?mName=dadada
    //../php/detailsMuscle.php?mName=dadada

    // $EID = $_GET['EID'];
    //   echo $EID;W

    // $mName = "Recte major de l'abdomen";
    // $mName = "Romboide";
    // $userID = 1;
    // echo $userID;

    $connection = OpenCon();
    $index = 0;
    $sql = "SELECT * FROM user  where UID = " . $userID;
    $result = search($connection, $sql);

    while ($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        // print_r($row);
        $uid = $row["UID"];
        $uname = $row["UNAME"];
        $isAdmin = $row["ISADMIN"];
        $email = $row["UEMAIL"];
        $uage = $row["UAGE"];
        $ugender = $row["UGENDER"];
        $type = $row["TYPE_ID"];
        $password = $row["PASSWORD"];

        // echo $uid . $uname . $isAdmin . $email . $uage . $ugender . $type . $password;
    }
    
    $sql = "SELECT DISTINCT EID,ENAME,exercise.EIMGPATH from user,likes,exercise where  likes.Exercise_ID=exercise.EID and likes.User_ID = user.UID and user.UID = '" . $uid . "'";

    //select EID,ENAME,exercise.EIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = "4"
    $favourite = search($connection, $sql);


    ?>
    <!-- <script>alert("OK")</script> -->


    <main>

        <!-- https://stackoverflow.com/questions/3507958/how-can-i-make-an-entire-html-form-readonly -->

        <button type="button" id="isEdit" class="ri-edit-box-line">
            Edit
        </button>

        <div class="break"></div>

        <h1>Favourite Exercises:</h1>
        <fieldset class="readOnly" id="exercise" disabled>
            <!-- <div class="wrapper"> -->
            <ul>
                <?php
                if ($favourite->num_rows > 0) {
                    while ($row = $favourite->fetch_assoc()) {
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

    </main>

    <!-- <script>
    document.getElementById('adminOnly').disabled = false
  </script> -->

    <?php



    include './footer.php';

    ?>
    <script src="../js/profile.js"></script>

</body>

</html>