<?php
  include('./views/header.php');
?>

<main class='mt-4' style='height: 100%;'>
  <?php
    // query tall
    include('./db/connection.php');
    include('./actions/helpers.php');
    $query = "select * from packages";
    $results = mysqli_query($db_conn, $query);
  ?>

  <?php if (isAdmin()) { ?>
    <div class='m-auto text-center p-2 mb-2' style='width: max-content;'>
      <a class='text-success fw-bolder fs-3' href="/package/new.php"> new package </a>
    </div>
  <?php } ?>

  <?php if (mysqli_num_rows($results) != 0) { ?>

    <div class='mb-4 text-center'>
        <?php if (!isLoggedIn()) { ?>
          <a class='text-white' href='/views/user/sign_up.php'>
            <h1 class='bg-dark m-auto p-3 rounded' style='width: max-content;'>
              Sign up to avail now!
            </h1>
          </a>
        <?php } ?>
    </div>

    <div class='row mx-auto w-100 p-4'>
      <?php foreach($results as $package) { ?>
        <div class='col-md-4 mb-4'>
          <div class="card shadow bg-light rounded">
            <a class="text-decoration-none text-dark"
              href="/package/index.php?package=<?php echo htmlspecialchars($package['id']); ?>">
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo htmlspecialchars($package['name']); ?>
                </h5>
                <p class='card-text mb-0'>
                  <span class='fw-bold'> Good for: </span>
                  <?php echo htmlspecialchars($package['good_for']) ?>
                </p>
                <p class='card-text'>
                  <span class='fw-bold'> Price: Php</span>
                  <?php echo htmlspecialchars($package['price']) ?>
                </p>
                <p class="card-text">
                  <?php echo "*" . htmlspecialchars($package['perks']); ?>
                </p>
              </div>
            </a>
            <?php include('./package/actions.php'); ?>
          </div> <!-- card -->
        </div> <!-- col -->
      <?php } ?>
    </div>
  <?php } else { ?>
    <h1 class='text-center'> There are currently no packages </h1>
  <?php } ?>

</main>

<?php
  include('./views/footer.php');
?>
