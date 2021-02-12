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

