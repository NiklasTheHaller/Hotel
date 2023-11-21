<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <title>
    <?= $pageTitle ?>
  </title>

  <meta charset="utf-8">
  <meta name="description" content="<?= $metaDesc ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">




  <link rel="stylesheet" href="css/custom.css">


  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</head>


<body class="bg-dark">



  <header class="p-3 text-bg-dark" data-bs-theme="dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="img/icons8-hotel-48.png" class="img-fluid" class="bi me-2" width="40" height="32" role="img">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary --bs-link-hover-color-rgb: 25, 135, 84;">Home</a>
          </li>
          <li><a href="rooms.php" class="nav-link px-2 text-white">Booking</a></li>
          <li><a href="news.php" class="nav-link px-2 text-white">News</a></li>
          <li><a href="faq.php" class="nav-link px-2 text-white">FAQs</a></li>
        </ul>

        <!-- If not logged in -->
        <?php if (!isset($_SESSION["active"]) || $_SESSION["active"] === false) : ?>
          <div class="text-end">
            <a class="btn btn-outline-info me-2" href="login.php" role="button">Login</a>
            <a class="btn btn-warning me-2" href="registration.php" role="button">Sign-up</a>
          </div>
        <?php endif; ?>

        <!-- If logged in -->
        <?php if (isset($_SESSION["active"]) && $_SESSION["active"] === true) : ?>
          <div class="dropdown text-end">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo isset($_SESSION["profile_picture"]) ? $_SESSION["profile_picture"] : 'img/profile-picture/default.png'; ?>" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small" style="">
              <?php if (isset($_SESSION["firstname"])) : ?>
                <li><a class="dropdown-item"> Welcome,
                    <?= $_SESSION["firstname"] ?>
                  </a></li>
              <?php endif; ?>
              <li><a class="dropdown-item" href="#">Bookings</a></li>
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </header>