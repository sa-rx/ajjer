<?php
$title = 'products';
$icon = 'paper-2';
include __DIR__.'/../template/header.php';

$products = $mysqli->query('select * from products order by id')->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $st = $mysqli->prepare('delete from products where id = ?');
  $st->bind_param('i', $productId);
  $productId = $_POST['product_id'];
  $st->execute();

  if($_POST['image']){
      unlink($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR . 'php/'.$_POST['image']);
  }

  echo "<script>location.href = 'index.php'</script>";
}
?>

  <div class="card">
      <div class="container pt-3">
          <a href="create.php" class="btn btn-info ">اضافه منتج</a>
        <p class="header pt-2">products: <?php echo count($products) ?></p>
      <div class="table-responsive">

        <table class="table table-striped">
          <thead>
            <tr>
              <th width="0">#</th>
              <th>Name</th>
              <th >description</th>
              <th >price</th>
              <th >img</th>
              <th width="150">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($products as $product ): ?>
            <tr>
              <td><?php echo $product['id'] ?></td>
              <td><?php echo $product['name'] ?></td>
              <td><?php echo $product['description'] ?></td>
              <td><?php echo $product['price'] ?></td>
              <td> <img src="<?php echo $config['app_url'].'/'.$product['image'] ?>" alt="" width="50"> </td>
              <td>
                <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-info">تعديل</a>
                <form method="post" style="display: inline">
                  <input type="hidden" value="<?php echo $product['id'] ?>" name="product_id">
                  <input type="hidden" value="<?php echo $product['image'] ?>" name="image">
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
