<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Upload - VYCO</title>
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <link rel="stylesheet" href="../css/uploadExercise.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
</head>

<body>

    <?php
    include('./header.php');
    // include('./sql_connect.inc.php');
    if(!$isAdmin){
        echo '<script>noAdmin()</script>';
        
    }
    ?>
    
    <main>

        <form action="./exeUploadExer.php" method="post" enctype="multipart/form-data">
            <fieldset class="container">
                <label>Name: <input type="text" name="name" placeholder="Enter Exercise Name" required /></label>

                <div class="break"></div>
                
                <label for="file">Upload Exercise Picture:</label>
                <input type="file" name="file" id="fileToUpload" accept="image/png, image/jpeg" required>
                        

                <div class="break"></div>


                <label class="top-cat"><img class="icon" src="../Image/youtube-icon.png" alt="Youtube Icon">
                    <input class="url" type="text" name="url" placeholder="Youtube URL" />
                </label>

                <label class="top-cat">Type of Exercise:

                    <select name="type" id="type">
                        <?php

                        $connection = OpenCon();

                        $sql = "SELECT TPID,TPNAME FROM type ";

                        $result = search($connection, $sql);



                        while ($row = $result->fetch_assoc()) {
                            // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                            // print_r($row);
                            $typeID = $row["TPID"];
                            $typeName = $row["TPNAME"];
                            echo " <option value=" . $typeID . ">  " . $typeName . "</option><br>";
                        }


                        ?>
                    </select>
                </label>

                <!-- 
                    https://stackoverflow.com/questions/17714705/how-to-use-checkbox-inside-select-option
                 -->

                <div class="break"></div>
                <div class="checkbox-list muscle">
                    <span>Trained Muscle (Minimum 1 trained)</span><br />
                    <?php


                    $sql = "SELECT MID,MNAME FROM muscle ";

                    $result = search($connection, $sql);



                    while ($row = $result->fetch_assoc()) {
                        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                        // print_r($row);
                        $muscleID = $row["MID"];
                        $muscleName = $row["MNAME"];
                        echo "<input type=checkbox name='muscle[]' value=" . $muscleID . ">  " . $muscleName . "<br>";
                    }


                    ?>
                </div>


                <div class="checkbox-list tools">
                    <span>Tools Used (Optional)</span><br />
                    <?php
                    // <input type="checkbox" name='muscle[]' value="Red"> Red <br />
                    $sql = "SELECT TID,TNAME FROM TOOLS ";

                    $result = search($connection, $sql);


                    while ($row = $result->fetch_assoc()) {
                        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                        // print_r($row);
                        $toolsID = $row["TID"];
                        $toolsName = $row["TNAME"];
                        echo "<input type=checkbox name='tools[]' value=" . $toolsID . ">  " . $toolsName . "<br>";
                    }

                    CloseCon($connection);
                    ?>

                    <!-- a button to upload new Tools -> link -->
                    <button type="button" class="addTools" onclick="window.location.href='./uploadTools.php'">
                        <i class="ri-add-circle-line "></i>
                        <span class="addTools">New Tools</span>
                    </button>


                </div>


                <div class="desc">
                    <label>Exercise Description:<br>
                        <textarea name="bio" rows="5" cols="50" placeholder="Please Describe the Exercise"></textarea>
                    </label>
                </div>
                <div class="break"></div>
                <input type="submit" id="submit" value="Submit" />
            </fieldset>

        </form>
    </main>

    <!-- <script src="../js/bootstrap-select.min.js"></script> -->
    <script src="../js/uploadExercise.js"></script>

</body>


</html>