<?php
  $errors = array('name' => '', 'description' => '', 'best_visit_time' => '',
  'available' => FALSE, 'url' => '', 'price' => '');

  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $best_visit_time = $_POST['best_visit_time'];
    $url = $_POST['url'];
    $price = $_POST['price'];
    $available = isset($_POST['available']) ? TRUE : FALSE;

    if (empty($name)) $errors['name'] = "can't be blank";
    if (empty($description)) $errors['description'] = "can't be blank";
    if (empty($url)) $errors['url'] = "can't be blank";
    if (empty($best_visit_time)) $errors['best_visit_time'] = "can't be blank";
    if (empty($price)) $errors['price'] = "can't be blank";
  }

  if (isset($_POST['submit']) && !array_filter($errors) && isAdmin()) {
    include('../db/connection.php');
    if ($method == 'Create') {
      // creating a destination
      $dest_id = (int) htmlspecialchars($_POST['dest_id']);
      $dest_query = mysqli_prepare($db_conn, 'INSERT INTO destinations set name=?, description=?, best_visit_time=?, url=?, price=?, available=?');
      mysqli_stmt_bind_param($dest_query, "ssssii", $name, $description, $best_visit_time, $url, $price, $available);
      mysqli_stmt_execute($dest_query);
      $inserted = mysqli_stmt_get_result($dest_query);
      $_SESSION['flash'] = 'Created a new destination';
    } else if ($method == 'Update') {
      // updating a destination
      $dest_id = (int) htmlspecialchars($_POST['dest_id']);
      $dest_query = mysqli_prepare($db_conn, 'UPDATE destinations set name=?, description=?, best_visit_time=?, url=?, price=?, available=? WHERE id=?');
      mysqli_stmt_bind_param($dest_query, "ssssiii", $name, $description, $best_visit_time, $url, $price, $available, $dest_id);
      mysqli_stmt_execute($dest_query);
      $inserted = mysqli_stmt_get_result($dest_query);
      $_SESSION['flash'] = 'Updated the destination';
    }
    header("Location: /destinations.php");
  }

?>

<div class="card shadow bg-light rounded col-6 mx-auto mb-4">
  <form class='p-2' action='' method='post'>
    <input type='hidden' name='dest_id' value='<?php echo $dest['id']?>' />

    <div class='form-group'>
      <label for='name'> Name </label>
      <input class='form-control' type='text' name='name'
        value="<?php echo htmlspecialchars($dest['name']) ?>" placeholder="Name"/>
      <span class='text-danger'><?php echo $errors['name'] ?></span>
    </div>

    <div class='form-group mt-3'>
      <label for='url'> Image Url </label>
      <input class='form-control' type='text' name='url'
        value="<?php echo htmlspecialchars($dest['url']) ?>" placeholder="url"/>
      <span class='text-danger'><?php echo $errors['url'] ?></span>
    </div>

    <div class='form-group mt-3'>
      <label for='description'> Description </label>
      <input class='form-control' type='text' name='description'
        value="<?php echo htmlspecialchars($dest['description']) ?>" placeholder="Description"/>
      <span class='text-danger'><?php echo $errors['description'] ?></span>
    </div>

    <div class='form-group mt-3'>
      <label for='best_visit_time'> Best Visit Time </label>
      <input class='form-control' type='text' name='best_visit_time'
        value="<?php echo htmlspecialchars($dest['best_visit_time']) ?>" placeholder="E.g. 9 AM to 11 AM"/>
      <span class='text-danger'><?php echo $errors['best_visit_time'] ?></span>
    </div>

    <div class='form-check mt-3'>
      <input class='form-check-input' type='checkbox' name='available'
        <?php if ($dest['available']) echo 'checked' ?>
      />
      <label class='form-check-label' for='available'> Available </label>
      <span class='text-danger'><?php echo $errors['available'] ?></span>
    </div>

    <div class='form-group mt-3'>
      <label for='price'> Price (in Php) </label>
      <input class='form-control' type='number' name='price'
        value="<?php echo htmlspecialchars($dest['price']) ?>" placeholder="How much?"/>
      <span class='text-danger'><?php echo $errors['price'] ?></span>
    </div>

    <div class='form-group mt-3'>
      <input class='btn btn-sm btn-success' type='submit' name='submit' value="<?php echo $method ?>" />
    </div>

  </form>
</div>
