<?php
$title ="عرض المنتج";
 require_once 'template/haeder.php';
 require 'classec/Service.php';
 require 'classec/Product.php';
 require 'config/app.php';
 require_once 'config/database.php';
 include __DIR__.'/classec/Upload.php';
 ?>

<?php
$comment_name = '';
$id_comment_product = '';
$user_name = '';
$user_id = '';
$errors = [];

 ?>

 <?php
 if(!isset($_GET['id'])){
 ?>

 <?php
 }else{
 $productQuery = "select * from products where id=".$_GET['id']." limit 1";
 $product = $mysqli->query($productQuery)->fetch_array(MYSQLI_ASSOC);
   ?>


<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $comment_name = mysqli_real_escape_string($mysqli, $_POST['comment_name']);
  if(empty($comment_name)){array_push($errors, "Name is required");}

  if(!count($errors)){

$commentQuery = "insert into comments (comment_name, id_comment_product, user_name, user_id) values ('$comment_name', '$id_comment_product".$_GET['id']."', '$user_name".$_SESSION['user_name']."', '$user_id".$_SESSION['user_id']."')";
    $mysqli->query($commentQuery);
    if($mysqli->error){
        array_push($errors, $mysqli->error);
        echo "string";
    }else{
        echo "<script>location.href = ''</script>";
    }

  }

}
 ?>

 <?php
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
 $st = $mysqli->prepare('delete from comments where id = ?');
 $st->bind_param('i', $commentId);
 $commentId = $_POST['comment_id'];
 $st->execute();
 echo "<script>location.href = ''</script>";
}
?>

 <?php
 $query = "select * from comments where id_comment_product=".$_GET['id']."  ";
 $comments= $mysqli->query($query)
 ->fetch_all(MYSQLI_ASSOC) ;
  ?>


   <div class="card mb-3">
     <div class="row no-gutters">
       <div class="col-md-4">
         <a target="_blank" href="<?php echo $config['app_url'].$product['image'] ?>">
           <img src="<?php echo $config['app_url'].$product['image'] ?>" class="card-img" alt="...">
         </a>
        </div>
       <div class="col-md-8">
         <div class="card-body">
           <h2 class="card-title text-info"><?php echo $product['name'] ?></h2>
           <h4 class="card-text text-secondary"><i class="fas fa-user"></i> <?php echo $product['nameusr'] ?></h4>
           <h4 class="card-text text-secondary"><i class="fas fa-city"></i> <?php echo $product['city'] ?></h4>
           <h4 class="card-text text-secondary"><i class="fas fa-phone-square-alt"></i> <?php echo $product['number'] ?></h4>
           <h4 class="card-text text-secondary"><i class="fas fa-sticky-note"></i> <?php echo $product['description'] ?></h4>
           <h5 class="card-text text-success">السعر : <?php echo $product['price'] ?></small></h5>
           <span>لرؤويه اوضح انقر على الصوره</span>
         </div>
       </div>
     </div>
   </div>


   <?php if(isset($_SESSION['Logged_in'])): ?>

   <form class="" action="" method="post" enctype="multipart/form-data">

             <div class="form-group ">
                 <label for="comment_name"> </label>
                 <textarea name="comment_name"  id="comment_name" placeholder="اكتب تعليقك هنا" class="form-control" cols="30" rows="3"></textarea>
             </div>

                 <button class="btn btn-info"> اضافه تعليق</button>

                 </form>
                 <?php else: ?>
                 <?php echo 'يجب عليك تسجيل الدخول حتى تتمكن من إضافة رد.' ?>
                 <?php endif ?>


                 <br>
                 <br>
                 <?php foreach($comments as $comment) { ?>
                 <div class="card  ">

                   <div class="card-header"><a class="text-info" href="profile.php?id=<?php echo $comment['user_id'] ?>"><?php echo $comment['user_name'] ?></a></div>
                   <div class="card-body ">
                     <h5 class=""><?php echo $comment['comment_name'] ?></h5>
                   </div>
                     <div class="card-footer bg-transparent text-muted text-center">
                       <?php
                       if ($comment['user_id'] == $_SESSION['user_id']) {    ?>
                         <form method="post" style="display: inline">
                           <input type="hidden" value="<?php echo $comment['id'] ?>" name="comment_id">
                           <button onclick="return confirm('هل انت متاكد')" class="btn btn-outline-danger btn-sm " type="submit">حذف</button>
                         </form>
                         <?php
                         }
                        ?>
                     </div>


                   </div>
                 <br>
               <?php } ?>


  <?php
  }
?>



<?php
 require_once 'template/footer.php' ?>
