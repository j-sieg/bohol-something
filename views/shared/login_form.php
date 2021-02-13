<?php
  $errors = ['email' => '', 'password' => '', 'invalid' => ''];

  if (isset($_POST['submit'])) {
    // email field validation
    if (empty($_POST['email'])) {
      $errors['email'] = "can't be blank";
    } else {
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'must be a valid email address';
      }
    }

    // password validation
    if (empty($_POST['password'])) {
      $errors['password'] = 'you must have a password!';
    } else if ($method !== 'login') {
      // FIXME: feel free to replace this with a regex or something better
      if (strlen($_POST['password']) < 8) {
        $errors['password'] = 'password must not be less than 8 characters';
      }
    }

    // valid form
    if (!array_filter($errors)) {
      include('../../db/connection.php');
      $stmt = '';

      if ($user_type !== 'admin') {
        // user login
        $stmt = mysqli_prepare($db_conn, 'SELECT id, email, password_digest FROM users WHERE email = ? LIMIT 1;');
      } else {
        // admin login
        $stmt = mysqli_prepare($db_conn, 'SELECT id, email, password_digest FROM admins WHERE email = ? LIMIT 1;');
      }

      mysqli_stmt_bind_param($stmt, "s", $_POST['email']);
      mysqli_stmt_execute($stmt);
      $results = mysqli_stmt_get_result($stmt);

      // redirect on success
      if ($method == 'login') {
        if (mysqli_num_rows($results) > 0) {
          $current_user = mysqli_fetch_assoc($results);
          $hash = $current_user['password_digest'];
          $password = $_POST['password'];
          if (password_verify($password, $hash)) {
            $_SESSION[$user_type . "_id"] = $current_user['id'];
            $_SESSION['flash'] = 'Successfully logged in!';
            header('Location: /');
          } else {
            $errors['invalid'] = 'Invalid email/password';
          }
        } else {
          $errors['invalid'] = 'Invalid email/password';
        }
      } else {
        // sign up
        $table_name = $user_type . "s";
        $sql = mysqli_prepare($db_conn, "INSERT INTO $table_name (email, password_digest) VALUES (?, ?)");
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($sql, "ss", $_POST['email'], $hash);
        $succes = mysqli_stmt_execute($sql);

        if ($succes) {
          $_SESSION['flash'] = 'Try logging in with your account!';
          header("Location: /views/$user_type/login.php");
        } else {
          $errors['invalid'] = 'Email has already been taken';
        }
      }

    } // valid form
  } else { // isset
    require('../../actions/redirects.php');
    redirectIfAuthenticated();
  }
?>

<div class='row mx-auto justify-content-center mt-2'>

  <form class='col-md-6 border border-dark border-3 p-2'
    action=''
    method='POST'>

    <div class='text-center'>
      <span class='text-danger'><?php echo $errors['invalid'] ?></span>
    </div>

    <div class='form-group'>
      <label class='form-label' for='email'>Email</label>
      <input class='form-control' type='email' name='email' placeholder='Email' autofocus/>
      <span class='text-danger'><?php echo $errors['email'] ?></span>
    </div>

    <div class='form-group'>
      <label class='form-label' for='password'> Password </label>
      <input class='form-control' type='password' name='password' placeholder='Password' />
      <span class='text-danger'><?php echo $errors['password'] ?></span>
    </div>

    <div class='form-group mt-2'>
      <input class='btn btn-dark' type='submit' name='submit' value='Login' />
    </div>

  </form>
</div>
