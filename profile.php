<?php
$title =' الصفحه الرئيسيه';
 require_once 'template/haeder.php';
 require 'classec/Service.php';
 require 'classec/Product.php';
 require 'config/app.php';
 require_once 'config/database.php';
 include __DIR__.'/classec/Upload.php';
 ?>

<?php
$st = $mysqli->prepare('select * from users where id = ? limit 1');
$st->bind_param('i', $userId);
$userId = $_GET['id'];
$st->execute();
$user = $st->get_result()->fetch_assoc();

 ?>

<?php
$productsQuery = "select * from users inner join products on users.id=products.by_user where users.id=".$_GET['id']."";
$products = $mysqli->query($productsQuery)->fetch_all(MYSQLI_ASSOC);
?>

<?php
$query = "select *,p.id as Product_id from products p left join categories c on p.categori_id = c.id where p.by_user=".$_GET['id']."";
$products = $mysqli->query($query)
 ->fetch_all(MYSQLI_ASSOC) ;
 ?>



<div class="jumbotron" style="text-align: center; background-image: url(aaa.jpg)">
  <i class="asd far fa-user  text-secondary" style="font-size:88px;"></i>
  <p class="lead text-secondary">المستخدم : </p>
  <h1 class="display-4 text-secondary"><?php echo $user['name'] ?></h1>
  <p class="lead text-secondary">عدد المنتجات : <?php echo count($products) ?></p>
  <a href="addProduct.php" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i> اضافه منتج</a>

</div>







<div class="row">

  <?php foreach($products as $product) { ?>
      <div class="col-md-4 pt-4 ">
        <div class="card  md-3  shadow">
          <div class="custom-card-image" style="background-image: url('<?php echo $config['app_url'].$product['image'] ?>')"></div>
          <div class="card-body ">
            <div class="card-title"> <h3 class=" text-info" style="text-align: center;">  <?php echo $product['name'] ?></h3>  </div>
            <hr>
            <div class="row">
             <p  class="col-md-6 text-secondary "> <i class="fas fa-user"></i> <?php echo $product['nameusr'] ?> </p>
            <div class="col-md-6 text-secondary "><i class="fas fa-city"></i> <?php echo $product['city'] ?>  </div>
            <div class="col-md-6 text-secondary "><i class="fas fa-phone-square-alt"></i> <?php echo $product['number'] ?>  </div>
            <div class="text-success col-md-6 "><?php echo $product['price'] ?> ريال </div>
            <a value="<?php echo $product['categori_id'] ?>" style="margin: 0 14px 0 0; background-color: #b4dadd;" href="categories.php?id=<?php echo $product['categori_id'] ?>" class="btn btn-sm btn-info "> <?php echo $product['cname']?> </a>
            </div>
            <br>
            <hr>
            <a href="vprod.php?id=<?php echo $product['Product_id'] ?>" style=" background-color: #b4dadd;" class="btn btn-sm btn-block text-secondary">عرض</a>
          </div>
        </div>
      </div>
  <?php } ?>
</div>


          <?php


 require_once 'template/footer.php' ?>
