<?php
$title =' الصفحه الرئيسيه';
 require_once 'template/haeder.php';
 require 'config/app.php';
 require_once 'config/database.php';
 include __DIR__.'/classec/Upload.php';

 ?>




<?php
$users = $mysqli->query('select * from users order by id')->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($users as $user ); ?>


<?php
$search= $_POST['search'];
//الاستعلام عن الكلمة المطلوبة من قاعدة البيانات
$products = $mysqli->query("SELECT *,p.id as Product_id FROM products p left join categories c on p.categori_id = c.id  WHERE name LIKE '%".$search."%' ");
?>










<div class="row">

  <?php foreach($products as $product) { ?>
      <div class="col-md-4 pt-4 ">
        <div class="card  md-3  shadow">
          <div class="custom-card-image" style="background-image: url('<?php echo $config['app_url'].$product['image'] ?>')"></div>
          <div class="card-body ">
            <div class="card-title"> <h3 class=" text-info" style="text-align: center;">  <?php echo $product['name'] ?></h3>  </div>
  <hr>
            <div class="row">

            <div class="col-md-6  text-secondary"><i class="fas fa-user"></i> <?php echo $product['nameusr'] ?> </div>

            <a style="margin: 0 14px 0 0; background-color: #b4dadd;" href="profile.php?id=<?php echo $product['by_user'] ?>" class="btn btn-info "> <i class="fas fa-user"></i> <?php echo $product['by_user'] ?> </a>
            <div class="col-md-6 text-secondary text-sm-left"><i class="fas fa-city"></i> <?php echo $product['city'] ?>  </div>







            <div class="text-success col-md-6"><?php echo $product['price'] ?> ريال </div>
            <div class="col-md-6 text-secondary"><i class="fas fa-phone-square-alt"></i> <?php echo $product['number'] ?>  </div>

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
