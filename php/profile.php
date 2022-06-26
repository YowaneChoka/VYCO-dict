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
    if(!isset($userID)){ 
        echo '<script>
        alert("Please Log in first!")
        window.location="./form.php";
    </script>';
    }
    
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
        if (!isset($uage)) {
            $uage = 18;
        }
        $ugender = $row["UGENDER"];
        $type = $row["TYPE_ID"];
        if (isset($type)) {
            $type = 1;
        }
        $password = $row["PASSWORD"];

        echo '    <script>let password ="'.$password.'"</script>';

        // echo $uid . $uname . $isAdmin . $email . $uage . $ugender . $type . $password;
    }

    echo '<script>let id = "'.'UID'.'='.$uid.'"</script>';
    


    $sql = "SELECT DISTINCT EID,ENAME,exercise.EIMGPATH from user,likes,exercise where  likes.Exercise_ID=exercise.EID and likes.User_ID = user.UID and user.UID = '" . $uid . "'";

    //select EID,ENAME,exercise.EIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = "4"
    $favourite = search($connection, $sql);

    $sql = "SELECT TPID,TPNAME FROM type,user where UID='" . $uid . "' and TYPE_ID = TPID";
    // echo $sql;

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

        <button type="button" id="logout" class="ri-logout-box-line">
            Log Out
        </button>

        <div class="break"></div>
        <h1>Profile Details</h1>
        <fieldset class="adminOnly" id="adminOnly" disabled>
            <form action="./updateProfile.php" method="post" onsubmit="return checkRegister()">

                <input type="hidden" name="uid" value=<?php echo $uid ?>>
                <label for="name">Name:</label>
                <input type="text" name="name" value=<?php echo '"' . $uname . '"' ?> />
                <br>
                <label for="email">Email:</label>
                <input type="text" name="email" value=<?php echo '"' . $email . '"' ?> />
                <br>
                <label for="age">Age:</label>
                <input type="number" name="age" value=<?php echo '"' . $uage . '"' ?> />
                <br>
                <label class="top-cat">Type:

                    <select name="type" id="type">
                        <?php

                        $connection = OpenCon();

                        $sql = "SELECT TPID,TPNAME FROM type,user where UID='" . $uid . "' and TYPE_ID = TPID";

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

                <div class="formGroup">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" placeholder="Password" name="pw" autocomplete="off">
                </div>
                <div class="formGroup">
                    <label for="confirmPassword">Confirm New Password:</label>
                    <input type="password" id="confirmPassword" placeholder="Confirm Password" name="pw2" autocomplete="off">
                </div>
                <label for="confirmPassword">Enter Old Password:</label>
                <input type="password" id="oldPassword" placeholder="Old Password" name="oldpw" required autocomplete="off">
                </div>
                <br>

                <br>
                <input type=submit id="submit-btn">
            </form>
        </fieldset> 

        <h1>Favourite:</h1>
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