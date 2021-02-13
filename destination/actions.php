<?php if (isAdmin()) { ?>
  <section class='actions m-4 d-flex'>
    <a href="/destination/edit.php?dest=<?php echo htmlspecialchars($dest['id']) ?>"
    class='btn btn-sm btn-success mx-2'>edit</a>
    <form action='/destination/destroy.php' method='post'>
      <input type='hidden' name='method' value='delete' />
      <input type='hidden' name='dest_id' value='<?php echo htmlspecialchars($dest['id']) ?>' />
      <input class='btn btn-sm btn-danger' type='submit' name='submit' value='delete' />
    </form>
      <button class='btn btn-sm btn-info ms-2'> 
        <?php
          if ($dest['available']) {
            echo 'available';
          } else {
            echo 'not available';
          }
        ?>
      </button>
  </section>
<?php } ?>
