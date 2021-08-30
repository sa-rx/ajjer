<?php
$title = 'edit services';
$icon = 'notes';
include __DIR__.'/../template/header.php';


$errors = [];
$name = '';
$description = '';
$price = '';

if(!isset($_GET['id']) || !$_GET['id']){
  die('حساب غير موجود');
}

$st = $mysqli->prepare('select * from services where id = ? limit 1');
$st->bind_param('i', $serviceId);
$serviceId = $_GET['id'];
$st->execute();
$service = $st->get_result()->fetch_assoc();

$name = $service['name'];
$description = $service['description'];
$price = $service['price'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty($_POST['name'])){array_push($errors, "خطاء في الاسم");}
  if(empty($_POST['description'])){array_push($errors, "خطاء في الوصف");}
  if(empty($_POST['price'])){array_push($errors, "خطاء في السعر ");}

    if(!count($errors)){

      $st = $mysqli->prepare('update services set name = ?, description = ?, price = ? where id = ?');
      $st->bind_param('ssii', $dbName, $dbDescription, $dbPrice, $dbId);
      $dbName = $_POST['name'];
      $dbDescription = $_POST['description'];
      $dbPrice = $_POST['price'];
      $dbId = $_GET['id'];

      $st->execute();

      if($st->error){
        array_push($errors, $st->error);
      }else {
        echo "<script>location.href = 'index.php'</script>";
      }

    }


}
?>

<div class="card">

  <div class="container pt-3">
    <?php include __DIR__.'/../template/errors.php' ?>

    <form class="" action="" method="post">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="your name" id="name" value="<?php echo $name; ?>">
        </div>

        <div class="form-group">
            <label for="description">Your description</label>
            <textarea name="description"  id="description"  class="form-control" cols="30" rows="10"><?php echo $description?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Your price</label>
            <input type="number" name="price" class="form-control" id="price" value="<?php echo $name; ?>">
        </div>




        <div class="form-group">
            <button class="btn btn-info">create</button>
        </div>

    </form>


  </div>

</div>




<?php
include __DIR__.'/../template/footer.php';

 ?>
