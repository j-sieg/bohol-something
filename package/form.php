<div class="card shadow bg-light rounded col-6 mx-auto">
  <form class='p-2' action='' method='post'>
    <input type='hidden' name='package_id' value='<?php echo $package['id']?>' />
    <div class='form-group'>
      <label for='name'> Name </label>
      <input class='form-control' type='text' name='name'
        value="<?php echo htmlspecialchars($package['name']) ?>" placeholder="Name"/>
    </div>

    <div class='form-group mt-3'>
      <label for='good_for'> Good for? </label>
      <input class='form-control' type='number' name='good_for'
        value="<?php echo htmlspecialchars($package['good_for']) ?>" placeholder="How many?"/>
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
