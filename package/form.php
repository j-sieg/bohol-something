<?php
  $errors = array('name' => '', 'good_for' => '' , 'price' => '', 'perks' => '');

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $good_for = $_POST['good_for'];
    $perks = $_POST['perks'];

    if (empty($name)) {
      $errors['name'] = "can't be blank";
    }

    if (empty($price)) {
      $errors['price'] = "can't be blank";
    }
  }

  if (isset($_POST['submit']) && !array_filter($errors) && isAdmin()) {
    include('../db/connection.php');

    // package create & delete
    if ($method == 'Create') {
      $package_query = mysqli_prepare($db_conn, 'INSERT INTO packages (name, good_for, price, perks) values (?, ?, ?, ?)');
      mysqli_stmt_bind_param($package_query, "siis", $name, $good_for, $price, $perks);
      mysqli_stmt_execute($package_query);
      $inserted = mysqli_stmt_get_result($package_query);
      $last_id = mysqli_insert_id($db_conn);
      $url = '/package/index.php?package=' . $last_id;
      $_SESSION['flash'] = 'Add activities to your package!';
    } else if ($method == 'Update') {
      $package_id = (int) htmlspecialchars($_POST['package_id']);
      $package_query = mysqli_prepare($db_conn, 'UPDATE packages SET name=?, good_for=?, price=?, perks=? WHERE id=?');
      mysqli_stmt_bind_param($package_query, "siisi", $name, $good_for, $price, $perks, $package_id);
      mysqli_stmt_execute($package_query);
      $inserted = mysqli_stmt_get_result($package_query);
      $url = '/package/index.php?package=' . $package_id;
      $_SESSION['flash'] = 'Updated the package';
    }
    header("Location: $url");
  }
?>

<div class="card shadow bg-light rounded col-6 mx-auto">
  <form class='p-2' action='' method='post'>
    <input type='hidden' name='package_id' value='<?php echo $package['id']?>' />
    <div class='form-group'>
      <label for='name'> Name </label>
      <input class='form-control' type='text' name='name'
        value="<?php echo htmlspecialchars($package['name']) ?>" placeholder="Name"/>
      <span class='text-danger'><?php echo $errors['name'] ?></span>
    </div>

    <div class='form-group mt-3'>
      <label for='good_for'> Good for? </label>
      <input class='form-control' type='number' name='good_for'
        value="<?php echo htmlspecialchars($package['good_for']) ?>" placeholder="How many?"/>
    </div>

    <div class='form-group mt-3'>
      <label for='price'> Price (in Php) </label>
      <input class='form-control' type='number' name='price'
        value="<?php echo htmlspecialchars($package['price']) ?>" placeholder="How many?"/>
      <span class='text-danger'><?php echo $errors['price'] ?></span>
    </div>

    <div class='form-group mt-3'>
      <label for='perks'> Perks </label>
      <textarea class='form-control' type='text' name='perks' placeholder="Perks"><?php echo htmlspecialchars($package['perks']) ?></textarea>
    </div>

    <div class='form-group mt-3'>
      <input class='btn btn-sm btn-success' type='submit' name='submit' value="<?php echo $method ?>" />
      <?php if ($method != 'Create') { ?>
        <a class="btn btn-sm btn-primary text-decoration-none"
          href="/package/index.php?package=<?php echo htmlspecialchars($package['id']); ?>">
          Show
        </a>
      <?php } ?>
    </div>
  </form>
</div>
