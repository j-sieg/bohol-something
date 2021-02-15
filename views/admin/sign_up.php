<?php
  $user_type = 'user';
  include('../header.php');
?>

<h1 class='text-center'> Sign up </h1>

<?php
  $user_type = 'admin';
  $method = 'Sign up';
  include('../shared/login_form.php');
?>