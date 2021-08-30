<?php
$title = ' user';
$icon = 'circle-09';
include __DIR__.'/../template/header.php';

$users = $mysqli->query('select * from users order by id')->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $st = $mysqli->prepare('delete from users where id = ?');
  $st->bind_param('i', $userId);
  $userId = $_POST['user_id'];
  $st->execute();
  echo "<script>location.href = 'index.php'</script>";
}
?>

  <div class="card">
      <div class="container pt-3">
          <a href="create.php" class="btn btn-info ">انشاء حساب جديد</a>
        <p class="header pt-2">Users: <?php echo count($users) ?></p>
      <div class="table-responsive">

        <table class="table table-striped">
          <thead>
            <tr>
              <th width="0">#</th>
              <th>Email</th>
              <th >Name</th>
              <th >Role</th>
              <th width="150">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($users as $user ): ?>
            <tr>
              <td><?php echo $user['id'] ?></td>
              <td><?php echo $user['email'] ?></td>
              <td><?php echo $user['name'] ?></td>
              <td><?php echo $user['role'] ?></td>
              <td>
                <a href="edit.php?id=<?php echo $user['id'] ?>" class="btn btn-info">تعديل</a>
                <form method="post" style="display: inline">
                  <input type="hidden" value="<?php echo $user['id'] ?>" name="user_id">
                  <button onclick="return confirm('هل انت متاكد')" class="btn btn-danger" type="submit">حذف</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>

      </div>

      </div>

  </div>

<?php
include __DIR__.'/../template/footer.php';



 ?>
