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
$users = $mysqli->query('select * from users order by id')->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($users as $user ); ?>


<?php
$query = "select *,p.id as Product_id from products p left join categories c on p.categori_id = c.id";
$products = $mysqli->query($query)
 ->fetch_all(MYSQLI_ASSOC) ;
 ?>





<div class="jumbotron" style="text-align: center; background-image: url(aaa.jpg)">
  <h3 class="card-title display-4 text-secondary"><?php echo $config['app_name']?></h3>
  <p class="card-text text-secondary" style="font-size: 21px;"><?php echo $config['app_note']?></p>
  <a href="addProduct.php" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i> اضافه منتج</a>

  <form action="search.php" method="post">
    <input style="width: 193px; display: inline; margin: 20px 0 0 0px;"  class="form-control " name="search" type="text" placeholder="Search" aria-label="Search">
         <button class="btn btn-outline-secondary my-2 my-sm-0"   type="submit">Search</button>
  </form>

</div>



<br>



<div class="alert alert-dark" role="alert" style="text-align: center; background-image: url(aaa.jpg)">
<?php
$categories = $mysqli->query("select cname, id from categories")->fetch_all(MYSQLI_ASSOC) ;
 foreach($categories as $categori) {
  ?>
  <a  href="categories.php?id=<?php echo $categori['id'] ?>"   class="btn btn-sm btn-secondary  m-1"><?php echo $categori['cname'] ?></a>
<?php } ?>
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
             <a style="margin: 0 14px 0 0; background-color: #b4dadd;" href="profile.php?id=<?php echo $product['by_user'] ?>" class="btn btn-info  "> <i class="fas fa-user"></i> <?php echo $product['nameusr'] ?> </a>
            <div class="col-md-6 text-secondary "><i class="fas fa-city"></i> <?php echo $product['city'] ?>  </div>
            <div class="col-md-6 text-secondary"><i class="fas fa-phone-square-alt"></i> <?php echo $product['number'] ?>  </div>
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
