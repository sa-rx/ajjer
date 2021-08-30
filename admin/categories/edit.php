<?php
$title = 'edit categories';
$icon = 'notes';
include __DIR__.'/../template/header.php';


$errors = [];
$name = '';


if(!isset($_GET['id']) || !$_GET['id']){
  die('حساب غير موجود');
}

$st = $mysqli->prepare('select * from categories where id = ? limit 1');
$st->bind_param('i', $categoriId);
$categoriId = $_GET['id'];
$st->execute();
$categori = $st->get_result()->fetch_assoc();

$name = $categori['cname'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty($_POST['name'])){array_push($errors, "خطاء في الاسم");}

    if(!count($errors)){

      $st = $mysqli->prepare('update categories set cname = ? where id = ?');
      $st->bind_param('si', $dbName, $dbId);
      $dbName = $_POST['name'];

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
            <button class="btn btn-info">create</button>
        </div>

    </form>


  </div>

</div>




<?php
include __DIR__.'/../template/footer.php';

 ?>
