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
