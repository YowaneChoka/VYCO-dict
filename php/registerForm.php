<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/form.css">
 
  <!-- jQuery CDN Link -->
  <script src="../js/jquery-2.1.0.min.js"></script>
  <title>Transparent form</title>
</head>
 
<body>


    <!-- use grid 1st -->
    <!-- make grid then to contain header and rest of file -->
    <?php
    
    // include './header.php';

    ?>

  <div class="container">
    <div class="form">
      <div class="btn">
        <button class="signUpBtn">REGISTER</button>
        <button class="loginBtn">LOG IN</button>
      </div>
      <form class="signUp" action="" method="get">
        <div class="formGroup">
          <input type="text" id="userName" placeholder="User Name" autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="password" id="password" placeholder="Password" required autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="password" id="confirmPassword" placeholder="Confirm Password" required autocomplete="off">
        </div>
        <div class="checkBox">
          <input type="checkbox" name="checkbox" id="checkbox">
          <span class="text">I agree with term & conditions</span>
        </div>
        <div class="formGroup">
          <button type="button" class="btn2">REGISTER</button>
        </div>
 
      </form>
        
      <!------ Login Form -------- -->
      <form class="login" action="" method="get">
        
        <div class="formGroup">
          <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="password" id="password" placeholder="Password" required autocomplete="off">
         
        </div>
        <div class="checkBox">
          <input type="checkbox" name="checkbox" id="checkbox">
          <span class="text">Keep me signed in on this device</span>
        </div>
        <div class="formGroup">
          <button type="button" class="btn2">REGISTER</button>
        </div>
 
      </form>
 
    </div>
  </div>
 
  <script src="../js/form.js"></script>
</body>
 
</html>