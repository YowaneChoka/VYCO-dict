<!DOCTYPE html>
<html lang="en">

<head>

  <?php

  include './header.php';

  ?>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/form.css">

  
  <title>Transparent form</title>
</head>

<body>


  <!-- use grid 1st -->
  <!-- make grid then to contain header and rest of file -->


  <div class="Fcontainer">
    <div class="Fform">
      <div class="Fbtn">
        <button class="signUpBtn">REGISTER</button>
        <button class="loginBtn">LOG IN</button>
      </div>
      <form class="signUp" onsubmit="return checkRegister()" action="./exeRegister.php" name="register" method="post">
        <div class="formGroup">
          <input type="text" id="userName" name="userName" placeholder="User Name" autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="password" id="password" placeholder="Password" name="pw" required autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="password" id="confirmPassword" placeholder="Confirm Password" name="pw2" required autocomplete="off">
        </div>
        <div class="checkBox">
          <input type="checkbox" name="checkbox" id="checkbox" required>
          <span class="text">I agree with term & conditions</span>
        </div>
        <div class="formGroup">
          <button type="submit" class="btn2">REGISTER</button>
        </div>

      </form>

      <!------ Login Form -------- -->
      <form class="login" action="./exeLogin.php" method="post">

        <div class="formGroup">
          <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="password" id="password" placeholder="Password" name="pw" required autocomplete="off">

        </div>
        <div class="formGroup">
          <button type="submit" class="btn2">SIGN IN</button>
        </div>

      </form>

    </div>
  </div>

  
  <?php

  include './footer.php';

  ?>
  <script src="../js/form.js"></script>
</body>

</html>