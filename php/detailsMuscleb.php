<!DOCTYPE html>
<html lang="en">

<head>



  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/detailsMuscle.css">


  <title>Muscle Details</title>
</head>

<body>

  <?php

    include './header.php';
  // include './sql_connect.inc.php';

  //link+?mName=dadada
  //localhost/vyco/php/detailsMuscle.php?mName=dadada
  //../php/detailsMuscle.php?mName=dadada

  $mName = $_GET['mName'];
  // echo $mName;

  // $mName = "Recte major de l'abdomen";
  // $mName = "Romboide";

  $connection = OpenCon();

  $index = 0;
  $tempSearch = "";
  while ($result->num_rows != 1 && $index < strlen($mName)) {
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





  while ($row = $result->fetch_assoc()) {
    // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
    // print_r($row);
    $mid = $row["MID"];
    $mname = $row["MNAME"];
    $mpath = $row["MIMGPATH"];
    $partid = $row["Part_ID"];
    // echo "id: " . $row["MID"] . " - Name: " . $row["MNAME"] . " " . $row["MIMGPATH"] . $row["Part_ID"] . "<br>";
  }

  //all muscle
  $mpath = "../Image/muscle" . $mpath;
  echo $mid . $mname . $mpath . $partid;

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

    <button type="button" id="isEdit">
      Edit
    </button>


    <h1>Muscle Details</h1>
    <fieldset class="adminOnly" id="adminOnly" disabled>
      <input type="text" name="something" placeholder="enter some text" />
      <select>
        <option value="0" disabled="disabled" selected="selected">select somethihng</option>
        <option value="1">woot</option>
        <option value="2">is</option>
        <option value="3">this</option>
      </select>
    </fieldset>


    


    <h1>Exercise</h1>
    <fieldset class="readOnly" id="exercise" disabled>
      <div class="wrapper">
        <?php
        $sec_count = $exercise->num_rows / 5 + 1;

        for ($i = 1; $i <= $sec_count; $i++) {
          echo '<section id="section'.$i.'">';
          if($i==1)
            $href = '<a href="#section' . $sec_count . '" class="arrow__btn">‹</a>';
          else
            $href = '<a href="#section' . ($i-1) . '" class="arrow__btn">‹</a>';
          echo $href;
          //left arrow

          $j = 5;
          while($j--){
            $row = $exercise->fetch_assoc();

            $link = "#";
            $img = '<img src="'.$row["EIMGPATH"].'" alt="'.$row["ENAME"].'" title="'.$row["ENAME"].'">';
            echo '<div class="item"><a href="'.$link.'">';
            echo $img. '</a></div>';
            // echo $row['EIMGPATH'];
          }
          

          
          //right arrow
          if($i==$sec_count)
            $href = '<a href="#section' . 1 . '" class="arrow__btn">‹</a></section>';
          else
            $href = '<a href="#section' . ($i+1) . '" class="arrow__btn">‹</a></section>';
          echo $href;
          
             
        }

        ?>

        
      </div>
    </fieldset>


    <h1>Tools</h1>
    <fieldset class="readOnly" id="Tools" disabled>
      <input type="text" name="something" placeholder="enter some text" />
      <select>
        <option value="0" disabled="disabled" selected="selected">select somethihng</option>
        <option value="1">woot</option>
        <option value="2">is</option>
        <option value="3">this</option>
      </select>
    </fieldset>

  </main>

  <!-- <script>
    document.getElementById('adminOnly').disabled = false
  </script> -->

  <?php


  $isAdmin = true;
  if ($isAdmin) {
    echo "<script>let isAdmin = true;</script>";
  }
  //   include './footer.php';

  ?>
  <script src="../js/detailsMuscle.js"></script>

</body>

</html>