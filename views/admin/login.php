<?php
  include('../header.php');
?>

<h1 class='text-center'> Admin Login </h1>

<?php
  $user_type = 'admin';
  $method = 'Login';
  include('../shared/login_form.php');
?>