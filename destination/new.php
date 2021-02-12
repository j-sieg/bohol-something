<?php
  include('../views/header.php');
  include('../actions/redirects.php');
  notFoundIfNotAdmin();

  $dest = array('id' => '', 'name' => '', 'url' => '',
    'description' => '', 'price' => '', 'best_visit_time' => '', 'available' => FALSE);
?>

<main class='mt-4'>
  <div class='m-auto text-center p-2 mb-2' style='width: max-content;'> 
    <a class='text-warning fw-bolder fs-3' href='/destinations.php'> back to destinations </a>
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
    $dest_id = (int) htmlspecialchars($_POST['dest_id']);
    $redirect_to = "destination/index.php?dest=" . $dest_id;
    $dest_query = mysqli_prepare($db_conn, 'INSERT INTO destinations set name=?, description=?, best_visit_time=?, url=?, price=?, available=?');
    mysqli_stmt_bind_param($dest_query, "ssssii", $name, $description, $best_visit_time, $url, $price, $available);
    mysqli_stmt_execute($dest_query);
    $inserted = mysqli_stmt_get_result($dest_query);
    header("Location: /destinations.php");
  }
?>

