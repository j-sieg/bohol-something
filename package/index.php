<?php
  include('../views/header.php');
?>

<main class='mt-4'>
  <?php
    include('../db/connection.php');
    include('../actions/helpers.php');
    $package_id = (int) htmlspecialchars($_GET['package']);

    $package_query = mysqli_prepare($db_conn, 'SELECT * FROM packages where id = ? LIMIT 1');
    mysqli_stmt_bind_param($package_query, "i", $package_id);
    mysqli_stmt_execute($package_query);
    $package_result = mysqli_stmt_get_result($package_query);
    $package = mysqli_fetch_assoc($package_result);
  ?>

  <?php
    if (isset($_POST['add_activity']) && $package && isAdmin()) {
      $description = $_POST['description'];
      if (!empty($description)) {
        $add_activity_query = mysqli_prepare($db_conn, 'INSERT INTO activities (description, package_id) VALUES (?, ?)');
        mysqli_stmt_bind_param($add_activity_query, "si", $description, $package_id);
        mysqli_stmt_execute($add_activity_query);
      }
    }

    if (isset($_POST['remove_activity']) && $package && isAdmin()) {
      $activity_id = $_POST['activity_id'];
      $delete_activity_query = mysqli_prepare($db_conn, 'DELETE FROM activities WHERE id=?');
      mysqli_stmt_bind_param($delete_activity_query, "i", $activity_id);
      mysqli_stmt_execute($delete_activity_query);
    }
  ?>

  <?php
    $activities_query = mysqli_prepare($db_conn, 'SELECT * FROM activities where package_id = ?');
    if ($package) {
      mysqli_stmt_bind_param($activities_query, "i", $package_id);
      mysqli_stmt_execute($activities_query);
      $activities = mysqli_stmt_get_result($activities_query);
    }
  ?>

  <div class='m-auto text-center p-2 mb-2' style='width: max-content;'>
    <a class='text-warning fw-bolder fs-3' href='/packages.php'> back to packages </a>
  </div>

  <?php if ($package) { ?>
    <div class="card shadow bg-light rounded col-8 mx-auto">
      <div class="card-body">
        <h5 class="card-title">
          <?php echo htmlspecialchars($package['name']); ?>
        </h5>

        <?php if (mysqli_num_rows($activities) != 0) { ?>
          <p class='card-text'>
            <span class='fw-bold'> Activities include: </span>
            <ul class='col-md-6'>
              <?php foreach($activities as $activity) { ?>
                <li>
                  <div class='d-flex justify-content-between'>
                    <span> <?php echo htmlspecialchars($activity['description']) ?> </span>
                    <?php if (isAdmin()) { ?>
                      <form action='' method='post' class=''>
                        <input type='hidden' name='activity_id' value='<?php echo htmlspecialchars($activity['id']) ?>' />
                        <input class='btn--remove--activity fw-bolder text-danger' type='submit' name='remove_activity' value='remove' />
                      </form>
                    <?php } ?>
                  </div>
                </li>
              <?php } ?>
            </ul>
          </p>
        <?php } else { ?>
          <h5 class='text-muted'>No activities included</h5>
        <?php } ?>

        <?php if (isAdmin()) { ?>
          <section>
            <form action='' method='post' class='col-md-6'>
              <div class='form-group'>
                <label for='description'> Add an activity </label>
                <div class='d-flex'>
                  <input class='form-control' type='text' name='description' placeholder='E.g. Hiking'/>
                  <input class='btn btn-dark' type='submit' name='add_activity' value='+' />
                </div>
              </div>
            </form>
          </section>
        <?php } ?>

        <p class="card-text text-muted">
          <?php echo "*" . htmlspecialchars($package['perks']); ?>
        </p>

        <p class='card-text mb-0'>
          <span class='fw-bold'> Good for: </span>
          <?php echo htmlspecialchars($package['good_for']) ?>
        </p>

        <p class='card-text'>
          <span class='fw-bold'> Price: Php</span>
          <?php echo htmlspecialchars($package['price']) ?>
        </p>

      </div>
      <?php include('./actions.php'); ?>
    </div>


  <?php } else { ?>
    <h1 class='text-center'> The package does not exist :( </h1>
  <?php } ?>


</main>

<div style='position: absolute; bottom:0;width: 98.2%;'>
  <?php
    include('../views/footer.php');
  ?>
</div>
