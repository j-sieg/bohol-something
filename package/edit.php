<?php
  include('../views/header.php');
  include('../actions/redirects.php');
  notFoundIfNotAdmin();
?>

<main class='mt-4'>
  <?php
    include('../db/connection.php');
    // setting the package on a GET request
    $package_id = (int) htmlspecialchars($_GET['package']);
    $package_query = mysqli_prepare($db_conn, 'SELECT * FROM packages where id = ? LIMIT 1');
    mysqli_stmt_bind_param($package_query, "i", $package_id);
    mysqli_stmt_execute($package_query);
    $package_result = mysqli_stmt_get_result($package_query);
    $package = mysqli_fetch_assoc($package_result);
  ?>

  <div class='m-auto text-center p-2 mb-2' style='width: max-content;'> 
    <a class='text-warning fw-bolder fs-3' href='/packages.php'> back to packages </a>
  </div>
  
  <?php if ($package) { ?>
    <?php
      $method = 'Update';
      include('form.php');
    ?>
  <?php } else { ?>
    <h1 class='text-center'> The package does not exist :( </h1>
  <?php } ?>
</main>

<?php
  include('../views/footer.php');
?>

<?php
  if (isset($_POST['submit']) && !array_filter($errors)) {
    $package_id = (int) htmlspecialchars($_POST['package_id']);
    $redirect_to = "/package/index.php?package=" . $package_id;
    $package_query = mysqli_prepare($db_conn, 'UPDATE packages SET name=?, good_for=?, price=?, perks=? WHERE id=?');
    mysqli_stmt_bind_param($package_query, "siisi", $name, $good_for, $price, $perks, $package_id);
    mysqli_stmt_execute($package_query);
    $inserted = mysqli_stmt_get_result($package_query);
    $url = '/package/index.php?package=' . $package_id;
    $_SESSION['flash'] = 'Updated the package';
    header("Location: $url");
  }
?>
