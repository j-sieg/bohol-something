<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="/styles/main.css" rel="stylesheet" />
  <script defer src="/main.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body class="theme1">

  <header class='odix-color-base odix-bg-base p-2'>
    <section class="container navbar">
      <a class="navbar-brand " href="/">Odicta Gang</a>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/packages.php">Packages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/destinations.php">Destinations</a>
        </li>
        <?php if (!(isset($_SESSION['user_id']) || isset($_SESSION['admin_id']))) { ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/views/user/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/views/user/sign_up.php">Sign up</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link text-danger" href="/actions/logout.php">Log out</a>
          </li>
        <?php } ?>

      </ul>
    </section>
  </header>
  <div id='root' class='container-fluid'>
    <section class='flash-messages text-center m-0'>
      <?php
      if (isset($_SESSION['flash'])) {
        $flash_message = $_SESSION['flash'];
        print "<p class='flash-message'> $flash_message </p>";
        unset($_SESSION['flash']);
      }
      ?>
    </section>