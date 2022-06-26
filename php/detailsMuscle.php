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

  $mName = $_GET['mName'];
  $mid = $_GET['MID'];
  // echo $mName;

  // $mName = "Recte major de l'abdomen";
  // $mName = "Romboide";

  $connection = OpenCon();

  $index = 0;
  $tempSearch = "";
  while ($result->num_rows != 1 && $index < strlen($mName) && !isset($mid)) {
    $tempSearch .= $mName[$index];

    // echo $tempSearch.'<br>';
    if (strlen($tempSearch) > 10) {
      $tempSearch = substr($tempSearch, 1);
    }
    $sql = "SELECT * FROM muscle  where MNAME LIKE '%" . $tempSearch . "%'";
    if ($mName == "Braquial") {
      // echo 'acc bra';
      $sql = "SELECT * FROM muscle where MNAME='Braquial'";
    }
    $result = search($connection, $sql);
    $index++;
    // echo $tempSearch.'<hr>';
  }

  if (isset($mid)) {
    $sql = "SELECT * FROM muscle  where MID =" . $mid;
    $result = search($connection, $sql);
  }
  if ($result->num_rows == 0) {
    echo '<script>
    alert("Muscle Not Found")
    window.location="./index.php";
</script>';
  }


  while ($row = $result->fetch_assoc()) {
    // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    // print_r($row);
    $mid = $row["MID"];
    $mname = $row["MNAME"];
    $mpath = $row["MIMGPATH"];
    $partid = $row["Part_ID"];
    $desc = $row["Description"];
    // echo "id: " . $row["MID"] . " - Name: " . $row["MNAME"] . " " . $row["MIMGPATH"] . $row["Part_ID"] . "<br>";
  }


  //all muscle
  $mpath = "../Image/muscle/" . $mpath;
  // echo $mid . $mname . $mpath . $partid;

  $sql = "SELECT DISTINCT EID,ENAME,exercise.EIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = '" . $mid . "'";

  //select EID,ENAME,exercise.EIMGPATH from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = "4"
  $exercise = search($connection, $sql);

  $sql = "SELECT DISTINCT TID,TNAME,TIMGPATH from tools,uses,exercise WHERE TID=uses.Tools_ID and uses.Exercise_ID=exercise.EID and EID IN 
  (select EID from muscle,train,exercise where train.Muscle_ID=muscle.MID and train.Exercise_ID=exercise.EID and muscle.MID = '" . $mid . "')";

  $tools = search($connection, $sql);

  ?>
  <!-- <script>alert("OK")</script> -->


  <main>

    <!-- https://stackoverflow.com/questions/3507958/how-can-i-make-an-entire-html-form-readonly -->

    <button type="button" id="isEdit" class="ri-edit-box-line">
      Edit
    </button>

    <div class="break"></div>
    <h1>Muscle Details</h1>
    <fieldset class="adminOnly" id="adminOnly" disabled>
      <form action="./updateMuscle.php" method="post">

        <img src=<?php echo '"' . $mpath . '"' ?> alt=<?php echo '"' . $mName . '"' ?>>
        <input type="hidden" name="mid" value=<?php echo $mid ?>>
        <label for="name">Name</label>
        <input type="text" name="name" value=<?php echo '"' . $mname . '"' ?> />

        <label class="top-cat">Part of:

          <select name="part" id="type">
            <?php

            $connection = OpenCon();

            $sql = "SELECT PID,PNAME FROM bodypart,muscle where  Part_ID = PID and MID='" . $mid . "'";

            $result = search($connection, $sql);



            while ($row = $result->fetch_assoc()) {
              // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
              // print_r($row);
              $typeID = $row["PID"];
              $typeName = $row["PNAME"];
              echo " <option value=" . $typeID . ">  " . $typeName . "</option><br>";
            }

            // echo $desc;
            ?>
          </select>
        </label>
        <br>
        <!-- <?php echo '"' . $mpath . '"' ?> -->


        <label for="desc">Description:</label><br>

        <textarea id="desc" name="desc" rows="5" cols="50"><?php echo $desc ?></textarea>
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