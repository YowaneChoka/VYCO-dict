<html>

<head>
  <title>VYCO - Exercise Dictionary</title>
  <link rel="stylesheet" type="text/css" href="../css/index.css">


</head>

<body>


  <?php

  $userID = $_SESSION['userID'];

  if (isset($userID)) {
    //die();
  }



  include './header.php';

  ?>

  <main>


    <?php


    ?>

    <div class="center">
      <div class="image">
        <object id="back-view" style="display:none" aria-label="SVG Posterior" data="../Image/posterior.svg"></object>
        <object id="front-view" aria-label="SVG Anterior" data="../Image/anterior.svg"></object>

      </div>
      <button id="toggle">Toggle View</button>

    </div>




  </main>
  <?php

  include './footer.php';

  ?>
  <script src="../js/index.js"></script>

</body>


</html>