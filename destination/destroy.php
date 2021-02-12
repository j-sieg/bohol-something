<?php
  session_start();
  include('../db/connection.php');
  include('../actions/redirects.php');
  notFoundIfNotAdmin();

  if(isAdmin() && isset($_POST['dest_id'])) {
    $dest_query = mysqli_prepare($db_conn, 'DELETE FROM destinations where id = ?');
    mysqli_stmt_bind_param($dest_query, 'i', $_POST['dest_id']);
    $deleted_dest = mysqli_stmt_execute($dest_query);
    if ($deleted_dest) {
      $_SESSION['flash'] = 'Deleted the destination';
    } else {
      $_SESSION['flash'] = 'Could not delete the destination';
    }
    header('Location: /destinations.php');
  }

?>