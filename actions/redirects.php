<?php
  include('helpers.php');

  function redirectIfAuthenticated() {
    if (isLoggedIn()) {
      $_SESSION['flash'] = 'You are already logged in';
      header('Location: /');
    }
  }

  function requireLogin() {
    if (!isLoggedIn()) {
      $_SESSION['flash'] = 'You must log in first';
      header('Location: /views/user/login.php');
    }
  }

  function notFoundIfNotAdmin() {
    if (!isAdmin()) {
      header('Location: /404.php');
    }
  }
?>