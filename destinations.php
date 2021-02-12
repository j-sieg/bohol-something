<?php
  include('./views/header.php');
  include('./db/connection.php');
  include('./actions/helpers.php');
  if (isAdmin()) {
    $query = "select id, url, name, description, best_visit_time, price, available from destinations";
  } else {
    $query = "select id, url, name, description, best_visit_time, price from destinations where available = true";
  }
  $results = mysqli_query($db_conn, $query);
?>

<main class='mt-4'>

  <?php if (isAdmin()) { ?>
    <div class='m-auto text-center p-2 mb-2' style='width: max-content;'>
      <a class='text-success fw-bolder fs-3' href="/destination/new.php"> new destination</a>
    </div>
  <?php } ?>

  <?php if (mysqli_num_rows($results) != 0) { ?>
    <section class='row mx-auto'>
      <?php foreach($results as $dest) { ?>
        <article class='col-md-6 mx-auto'>
          <div class='d-flex align-items-end'>
            <h3> <?php echo htmlspecialchars($dest['name']) ?> </h3>
            <?php include('./destination/actions.php'); ?>
          </div>
          <?php if ($dest['url'])  { ?>
            <div class='d-flex justify-content-center mb-4'>
              <img class='img-fluid'
                alt='<?php echo htmlspecialchars($dest['name']) ?>'
                src='<?php echo htmlspecialchars($dest['url']) ?>'
              />
            </div>
          <?php } ?>
          <p><?php echo htmlspecialchars($dest['description']) ?></p>
          <p class='text-muted'>
            Best visit time:&nbsp;
            <?php echo htmlspecialchars($dest['best_visit_time']) ?>
          </p>
          <p class='fw-bolder'>Price: Php <?php echo htmlspecialchars($dest['price']) ?></p>
        </article>
      <?php } ?>
    </section>
  <?php } else { ?>
    <h1 class='text-center'> There are no destinations available at the moment </h1>
  <?php } ?>
</main>

<?php
  include('./views/footer.php');
?>
