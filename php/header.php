<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/swiper-bundle.min.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<!-- Header -->
<header class="header" id="header">

    <?php
    error_reporting(E_ALL ^ E_NOTICE);
    include 'sql_connect.inc.php';
    session_start();

    $logOut = $_GET['logout'];

    if(isset($_GET['logout'])&&isset($_SESSION['userID'])){
        unset($_SESSION['userID']);
    }



    $userID = $_SESSION['userID'];
    $_SESSION['userID'] = $userID;
    if (!isset($userID)) {
        $isAdmin = false;
        $isLogin = false;
        echo "<script>let isLogin = false;</script>";
    } else {
        $isLogin = true;
        echo "<script>let isLogin = true;</script>";
        // $userID = 1;
        $checkCon = OpenCon();
        $sql  = "SELECT ISADMIN from user where UID = '" . $userID . "'";
        $check = search($checkCon, $sql);

        if ($row = $check->fetch_assoc()) {
            $isAdmin = $row['ISADMIN'];
        }
    }

    // $isAdmin = true;
    if ($isAdmin) {
        echo "<script>let isAdmin = true;</script>";
    } else
        echo "<script>let isAdmin = false;</script>";

    // echo "<script> isAdmin = true;</script>";
    ?>
    <script>
        function noAdmin() {
            alert("Not Admin\nPlease Login as Admin!");
            window.location = "./form.php";
        }
    </script>

    <nav class="navbar hcontainer" >
        <a href="./index.php">
            <h2 class="logo">VYCO</h2>
            <!-- <img src="../Image/vyconew.png" class="logo" alt="VYCO"> -->
        </a>

        <div class="hmenu" id="hmenu">
            <ul class="list">
                <li class="list-item">
                    <a href="./index.php" class="list-link current">Home</a>
                </li>
                <li class="list-item">
                    <a href="./showExercise.php" class="list-link">Exercises</a>
                </li>
                <li class="list-item">
                    <a href="./showTools.php" class="list-link">Tools</a>
                </li>
                <li class="list-item">
                    <a href="./uploadExercise.php" class="list-link admin">Upload</a>
                </li>
                <li class="list-item screen-lg-hidden" id="signInMenu">
                    <a href="./form.php" class="list-link">Sign in</a>
                </li>
                <li class="list-item screen-lg-hidden" id="signUpMenu">
                    <a href="./form.php" class="list-link">Sign up</a>
                </li>
                <li class="list-item screen-lg-hidden" id="profileMenu">
                    <a href="./profile.php" class="list-link">Profile</a>
                </li>
            </ul>
        </div>

        <div class="list list-right">



            <button class="btn place-items-center" id="theme-toggle-btn">
                <i class="ri-sun-line sun-icon"></i>
                <i class="ri-moon-line moon-icon"></i>
            </button>

            <button class="btn place-items-center love-icon" id="love-icon">
                <a href="./fav.php"><i class="ri-heart-3-fill "></i></a>
            </button>

            <button class="btn place-items-center" id="search-icon">
                <i class="ri-search-line"></i>
            </button>

            <button class="btn place-items-center screen-lg-hidden menu-toggle-icon" id="menu-toggle-icon">
                <i class="ri-menu-3-line open-menu-icon"></i>
                <i class="ri-close-line close-menu-icon"></i>
            </button>

            <a href="./form.php" id="signUp-btn" class="btn sign-up-btn fancy-border screen-sm-hidden">
                <span>LOGIN</span>
            </a>

            <a href="./profile.php" id="profile" class="btn profile-btn screen-sm-hidden">
                <i class="ri-account-circle-line profile screen-sm-hidden"></i>
            </a>
        </div>

    </nav>

</header>

<!-- Search -->
<div class="search-form-container hcontainer" id="search-form-container">
    <div class="form-container-inner">
        <form action="searchQuery.php" class="form" method="post">
            <input type="text" name="query" class="form-input" placeholder="Search Exercise?">
            <button class="btn form-btn" type="submit">
                <i class="ri-search-line"></i>
            </button>
        </form>
        <span class="form-note">Or press Esc to close.</span>
    </div>
    <button class="btn form-close-btn place-items-center" id="form-close-btn">
        <i class="ri-close-line"></i>
    </button>
</div>

<script src="../js/header.js"></script>
<script src="../js/jquery-2.1.0.min.js"></script>