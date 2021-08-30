<?php
$title = 'edit product';
$icon = 'paper-2';
include __DIR__.'/../template/header.php';
require_once __DIR__.'/../../classec/Upload.php';



$errors = [];
$name = '';
$description = '';
$price = '';
$city = '';
$nameusr = '';
$number = '';

if(!isset($_GET['id']) || !$_GET['id']){
  die('حساب غير موجود');
}

$st = $mysqli->prepare('select * from products where id = ? limit 1');
$st->bind_param('i', $productId);
$productId = $_GET['id'];
$st->execute();
$product = $st->get_result()->fetch_assoc();

$name = $product['name'];
$description = $product['description'];
$price = $product['price'];

$city = $product['city'];
$nameusr = $product['nameusr'];
$number = $product['number'];

$image = $product['image'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty($_POST['name'])){array_push($errors, "خطاء في الاسم");}
  if(empty($_POST['description'])){array_push($errors, "خطاء في الوصف");}
  if(empty($_POST['price'])){array_push($errors, "خطاء في السعر ");}

  if(empty($city)){array_push($errors, "city is required");}
  if(empty($nameusr)){array_push($errors, "user name is required");}
  if(empty($number)){array_push($errors, "number is required");}

  if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

    $upload = new Upload('uploads/products');
    $upload->file = $_FILES['image'];
    $errors = $upload->upload();

    if(!count($errors)){

      unlink($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'/php/'.$image);

      $image = $upload->filePath;
    }

  }

    if(!count($errors)){

      $st = $mysqli->prepare('update products set   categori_id= ?, name = ?, description = ?, price = ?, city = ?, nameusr = ?, number = ?, image = ? where id = ?');
      $st->bind_param('sssdssisi', $categori_id, $dbName, $dbDescription, $dbPrice, $dbCity, $dbNameusr, $dbnumber, $dbImage, $dbId);
      $categori_id = $_POST['categori_id'];
      $dbName = $_POST['name'];
      $dbDescription = $_POST['description'];
      $dbPrice = $_POST['price'];

      $dbCity =  $_POST['city'];
      $dbNameusr =  $_POST['nameusr'];
      $dbnumber =  $_POST['number'];


      $dbImage = $image;
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

<?php $categories = $mysqli->query("select * from categories  ORDER BY `cname` ASC")->fetch_all(MYSQLI_ASSOC) ?>



<div class="card">

  <div class="container pt-3">
    <?php include __DIR__.'/../template/errors.php' ?>

    <form class="" action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="your name" id="name" value="<?php echo $name; ?>">
        </div>

        <div class=" form-group">
          <label for="categori">نوع المنتج</label>
          <select name="categori_id" id="categori" class="form-control">
            <?php foreach($categories as $categori) { ?>
                <option value="<?php echo $categori['id'] ?>">
                  <?php echo $categori['cname'] ?>
                </option>
            <?php } ?>
          </select>
        </div>


        <div class="form-group">
            <label for="name">المدينه</label>
            <input type="text" name="city" class="form-control"  id="city" value="<?php echo $city; ?>">
        </div>

        <div class="form-group">
            <label for="name">اسمك</label>
            <input type="text" name="nameusr" class="form-control"  id="nameusr" value="<?php echo $nameusr; ?>">
        </div>

        <div class="form-group">
            <label for="name">رقم الجوال</label>
            <input type="number" name="number" class="form-control"  id="number" value="<?php echo $number; ?>">
        </div>

        <div class="form-group">
            <label for="description">Your description</label>
            <textarea name="description"  id="description"  class="form-control" cols="30" rows="10"><?php echo $description?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Your price</label>
            <input type="number" name="price" class="form-control" id="price" value="<?php echo $price; ?>">
        </div>

        <div class="form-group">
            <img src="<?php echo $config['app_url'].'/'.$image; ?>" width="150" alt="">
            <label for="image">Image:</label>
            <input type="file" name="image">
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
