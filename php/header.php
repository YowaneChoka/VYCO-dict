<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/swiper-bundle.min.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<!-- Header -->
<header class="header" id="header">

    <nav class="navbar hcontainer">
        <a href="./index.html">
            <h2 class="logo">VYCO</h2>
            <!-- <img src="../Image/vyconew.png" class="logo" alt="VYCO"> -->
        </a>

        <div class="menu" id="menu">
            <ul class="list">
                <li class="list-item">
                    <a href="#" class="list-link current">Home</a>
                </li>
                <li class="list-item">
                    <a href="#" class="list-link">Categories</a>
                </li>
                <li class="list-item">
                    <a href="#" class="list-link">Reviews</a>
                </li>
                <li class="list-item">
                    <a href="#" class="list-link">News</a>
                </li>
                <li class="list-item">
                    <a href="#" class="list-link">Membership</a>
                </li>
                <li class="list-item">
                    <a href="#" class="list-link">Contact</a>
                </li>
                <li class="list-item screen-lg-hidden">
                    <a href="./signin.html" class="list-link">Sign in</a>
                </li>
                <li class="list-item screen-lg-hidden">
                    <a href="./signup.html" class="list-link">Sign up</a>
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

            <a href="#" class="list-link screen-sm-hidden">Sign in</a>
            <a href="#" class="btn sign-up-btn fancy-border screen-sm-hidden">
                <span>Sign up</span>
            </a>
        </div>

    </nav>

</header>

<!-- Search -->
<div class="search-form-container hcontainer" id="search-form-container">
    <div class="form-container-inner">
        <form action="" class="form">
            <input type="text" class="form-input" placeholder="What are you looking for?">
            <button class="btn form-btn" type="submit">
                <i class="ri-search-line"></i>
            </button>
        </form>
        <span class="form-note">Or press Esc to close.</span>
    </div>
    <button class="btn form-close-btn place-items-center" id="form-close-btn">
        <i class="ri-close-line">

        </i>
    </button>
</div>