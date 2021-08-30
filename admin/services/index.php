<?php
$title = 'services';
$icon = 'notes';
include __DIR__.'/../template/header.php';

$services = $mysqli->query('select * from services order by id')->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $st = $mysqli->prepare('delete from services where id = ?');
  $st->bind_param('i', $serviceId);
  $serviceId = $_POST['service_id'];
  $st->execute();
  echo "<script>location.href = 'index.php'</script>";
}
?>

  <div class="card">
      <div class="container pt-3">
          <a href="create.php" class="btn btn-info ">اضافه خدمه</a>
        <p class="header pt-2">services: <?php echo count($services) ?></p>
      <div class="table-responsive">

        <table class="table table-striped">
          <thead>
            <tr>
              <th width="0">#</th>
              <th>Name</th>
              <th >description</th>
              <th >price</th>
              <th width="150">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($services as $service ): ?>
            <tr>
              <td><?php echo $service['id'] ?></td>
              <td><?php echo $service['name'] ?></td>
              <td><?php echo $service['description'] ?></td>
              <td><?php echo $service['price'] ?></td>
              <td>
                <a href="edit.php?id=<?php echo $service['id'] ?>" class="btn btn-info">تعديل</a>
                <form method="post" style="display: inline">
                  <input type="hidden" value="<?php echo $service['id'] ?>" name="service_id">
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
