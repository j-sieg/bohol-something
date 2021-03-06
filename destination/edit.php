<?php
  include('../views/header.php');
  include('../actions/redirects.php');
  notFoundIfNotAdmin();
?>

<main class='mt-4'>
  <?php
    include('../db/connection.php');

    $dest_id = (int) htmlspecialchars($_GET['dest']);
    $dest_query = mysqli_prepare($db_conn, 'SELECT * FROM destinations where id = ? LIMIT 1');
    mysqli_stmt_bind_param($dest_query, "i", $dest_id);
    mysqli_stmt_execute($dest_query);
    $dest_result = mysqli_stmt_get_result($dest_query);
    $dest = mysqli_fetch_assoc($dest_result);
  ?>

  <div class='m-auto text-center p-2 mb-2' style='width: max-content;'> 
    <a class='text-warning fw-bolder fs-3' href='/destinations.php'> back to destinations </a>
  </div>

  <?php if ($dest) { ?>
    <?php
      $method = 'Update';
      include('form.php');
    ?>
  <?php } else { ?>
    <h1 class='text-center'> The destination does not exist :( </h1>
  <?php } ?>

</main>

<?php
  include('../views/footer.php');
?>

