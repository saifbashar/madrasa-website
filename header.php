<?php
if (isset($_POST['logout'])) {

    $_SESSION = array();


    session_destroy();


    header("Location: login.php");
    exit;
}
?>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="./" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Safeer Academy
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '<a class="nav-link" href="./dashboard.php">Dashboard</a>';
                    } else {
                        echo '<a class="nav-link" href="./login.php">Login</a>';
                    }

                    ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./about_page.php">About Safeer Academy</a></li>
                        <li><a class="dropdown-item" href="#">Chairman Message</a></li>
                        <li><a class="dropdown-item" href="#">Secratary Message</a></li>
                        <li><a class="dropdown-item" href="#">Principle Message</a></li>
                        <li><a class="dropdown-item" href="#">FAQs</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admission
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Admission Procedures</a></li>
                        <li><a class="dropdown-item" href="#">Academic Calendar</a></li>
                        <li><a class="dropdown-item" href="#">Year Calendar</a></li>
                        <li><a class="dropdown-item" href="#">Student Year Group & Age Range</a></li>
                    </ul>
                </li>
            </ul>

            <?php
            if (isset($_SESSION['email'])) {
                echo '
                    <form class="d-flex" method="POST" role="search"><button class="btn btn-danger" type="submit" name="logout">Logout</button>  </form>';
            } else {
            } ?>


        </div>
    </div>
</nav>