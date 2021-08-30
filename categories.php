<?php
$title =' الفئات';
 require_once 'template/haeder.php';
 require 'config/app.php';
 require_once 'config/database.php';
 include __DIR__.'/classec/Upload.php';
 ?>

 <?php
 if(!isset($_GET['id'])){
 ?>

 <?php
 }else{
  ?>








  <?php
  $query = "select *,p.id as Product_id from products p left join categories c on p.categori_id = c.id  where categori_id=".$_GET['id']."
";
  $products = $mysqli->query($query)
   ->fetch_all(MYSQLI_ASSOC) ;
   ?>



   <?php
   $categories = $mysqli->query("select cname, id from categories where id =".$_GET['id']." ")->fetch_array(MYSQLI_ASSOC) ;
   ?>
   <div class="jumbotron" style="text-align: center; background-image: url(aaa.jpg)">
     <p class="asd far fa-user  text-secondary" style="font-size:25px;">الفئه : </p>
     <h1 class="display-4 text-secondary"><?php echo  $categories['cname'] ?></h1>
     <p class="lead text-secondary">عدد المنتجات : <?php echo count($products) ?></p>

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
             <div class="col-md-6 text-center">
                <a style="margin: 0 14px 0 0; background-color: #b4dadd;" href="profile.php?id=<?php echo $product['by_user'] ?>" class="btn btn-info  "> <i class="fas fa-user"></i> <?php echo $product['nameusr'] ?> </a>
             </div>
               <div class="col-md-6 text-secondary text-center"><i class="fas fa-city"></i> <?php echo $product['city'] ?>  </div>
               <div class="col-md-6 text-secondary text-center"><i class="fas fa-phone-square-alt"></i> <?php echo $product['number'] ?>  </div>
               <div class="text-success col-md-6 text-center"><?php echo $product['price'] ?> ريال </div>
             <div class="col-md-6 text-center">
               <a value="<?php echo $product['categori_id'] ?>" style="margin: 0 14px 0 0; background-color: #b4dadd;" href="categories.php?id=<?php echo $product['categori_id'] ?>" class="btn btn-sm btn-info "> <?php echo $product['cname']?> </a>
             </div>
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
  }
  ?>







<?php
 require_once 'template/footer.php' ?>
