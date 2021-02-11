<?php
  include('../views/header.php');
  include('../actions/redirects.php');
  notFoundIfNotAdmin();

  $package = array(
    'id' => '', 'name' => '', 'good_for' => 0, 'price' => 0, 'perks' => ''
  );
?>

<main class='mt-4'>
  <div class='m-auto text-center p-2 mb-2' style='width: max-content;'> 
    <a class='text-warning fw-bolder fs-3' href='/packages.php'> back to packages </a>
  </div>
  <?php
    $method = 'Create';
    include('form.php');
  ?>
</main>

<?php
  include('../views/footer.php');
?>

<?php
  if (isset($_POST['submit']) && !array_filter($errors)) {
    include('../db/connection.php');
    $package_query = mysqli_prepare($db_conn, 'INSERT INTO packages (name, good_for, price, perks) values (?, ?, ?, ?)');
    mysqli_stmt_bind_param($package_query, "siis", $name, $good_for, $price, $perks);
    mysqli_stmt_execute($package_query);
    $inserted = mysqli_stmt_get_result($package_query);
    $last_id = mysqli_insert_id($db_conn);
    $url = '/package/index.php?package=' . $last_id;
    header("Location: $url");
  }
?>
