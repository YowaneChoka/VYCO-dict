<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools Upload - VYCO</title>
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <link rel="stylesheet" href="../css/uploadTools.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
</head>

<body>

    <?php
    include('./header.php');
    // include('./sql_connect.inc.php');
    ?>

    <main>

        <form action="./exeUploadTools.php" method="post" enctype="multipart/form-data">
            <fieldset class="container">

                <label>Name: <input type="text" name="name" placeholder="Enter Tool Name" required /></label>
                <label>Price: <input type="text" name="price" placeholder="Enter Tool Price" /></label>

                <label>Upload Tool Picture:

                    <div class="img-upload">
                        <input type="file" name="file" id="fileToUpload"  accept="image/png, image/jpeg" required>
                    </div>
                   
                </label>
      
               
                <div class="checkbox-list muscle">
                    <h3>Exercise Used (Minimum 1 used)</h3>

                    <?php
                    $connection = OpenCon();

                    $sql = "SELECT EID,ENAME FROM exercise ";

                    $result = search($connection, $sql);



                    while ($row = $result->fetch_assoc()) {
                        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                        // print_r($row);
                        $eID = $row["EID"];
                        $eName = $row["ENAME"];
                        echo "<input type=checkbox name='exercise[]' value=" . $eID . ">  " . $eName . "<br>";
                    }


                    ?>
                </div>

                <div class="break"></div>
                <div class="desc">
                    <label>Exercise Description:<br>
                        <textarea name="bio" rows="5" cols="50" placeholder="Please Describe the Tools..."></textarea>
                    </label>
                </div>
                <div class="break"></div>


                <input type="submit" id="submit" value="Submit" />



            </fieldset>

        </form>
    </main>

    <!-- <script src="../js/bootstrap-select.min.js"></script> -->

</body>




</html>