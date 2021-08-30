<?php
$title =' الصفحه الرئيسيه';
 require_once 'template/haeder.php';
 require 'classec/Service.php';
 require 'classec/Product.php';
 require 'config/app.php';
 require_once 'config/database.php';
 include __DIR__.'/classec/Upload.php';
 ?>
  <?php if(isset($_SESSION['Logged_in'])): ?>
<?php
if ( $_GET['id']= $_SESSION['user_id']) {
}
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
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $st = $mysqli->prepare('delete from products where id = ?');
   $st->bind_param('i', $productId);
   $productId = $_POST['product_id'];
   $st->execute();
   if($_POST['image']){
       unlink($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR . 'php/'.$_POST['image']);
   }
   echo "<script>location.href = 'settings_user.php'</script>";
 }
 ?>


<div class="jumbotron" style="text-align: center; background-image: url(aaa.jpg)">
  <i class="asd far fa-user  text-secondary" style="font-size:88px;"></i>
  <h1 class="display-4 text-secondary"><?php echo $user['name'] ?></h1>
  <p class="lead text-secondary"><?php echo $user['email'] ?></p>
  <p class="lead text-secondary">ID : <?php echo $user['id'] ?></p>
  <p class="lead text-secondary">عدد المنتجات : <?php echo count($products) ?></p>
  <a href="addProduct.php" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i> اضافه منتج</a>
</div>







            <div class="row">
            <?php foreach($products as $product) { ?>

                  <div class="col-md-4 pt-4">
                    <div class="card md-3  shadow">
                      <div class="custom-card-image" style="background-image: url('<?php echo $config['app_url'].$product['image'] ?>')"></div>
                      <div class="card-body ">
                        <div class="card-title"> <h3 class=" text-info"> <?php echo $product['name'] ?></h3>  </div>
                        <div class="row">
                        <div class="col-md-6  text-secondary"><i class="fas fa-user"></i> <?php echo $product['nameusr'] ?> </div>
                        <div class="col-md-6  text-secondary"><i class="fas fa-user"></i> <?php echo $product['by_user'] ?> </div>





                        <div class="col-md-6 text-secondary"><i class="fas fa-city"></i> <?php echo $product['city'] ?>  </div>
                        <div class="text-success col-md-6"><?php echo $product['price'] ?> ريال </div>
                        <div class="col-md-6 text-secondary"><i class="fas fa-phone-square-alt"></i> <?php echo $product['number'] ?>  </div>

                        </div>
                        <br>
                        <a href=" vprod.php?id= <?php echo $product['id'] ?> " style=" background-color: #b4dadd;" class="btn btn-sm btn-block text-secondary">عرض</a>
                        <br>
                        <a href="edit_product_user.php?id=<?php echo $product['id'] ?>" class="btn btn-outline-info">تعديل</a>

                        <form method="post" style="display: inline">
                          <input type="hidden" value="<?php echo $product['id'] ?>" name="product_id">
                          <input type="hidden" value="<?php echo $product['image'] ?>" name="image">
                          <button onclick="return confirm('هل انت متاكد')" class="btn btn-outline-danger" type="submit">حذف</button>
                        </form>
                      </div>



                    </div>

                  </div>
                <?php } ?>

            </div>

          <?php else :?>
            <?php echo "<div class='alert alert-danger' role='alert'> لاتمتلك صلاحيات للوصول </div>" ?>
          <?php endif; ?>

          <?php


 require_once 'template/footer.php' ?>
