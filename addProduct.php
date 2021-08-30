<?php
$title =' اضافه منتج';
 require_once 'template/haeder.php';
 require 'config/app.php';
 require_once 'config/database.php';
 include __DIR__.'/classec/Upload.php';





 $errors = [];
 $name = '';
 $description = '';
 $price = '';
 $city = '';
 $nameuser = '';
 $number = '';



 if($_SERVER['REQUEST_METHOD'] == 'POST'){


     $name = mysqli_real_escape_string($mysqli, $_POST['name']);
     $price = mysqli_real_escape_string($mysqli, $_POST['price']);
     $description = mysqli_real_escape_string($mysqli, $_POST['description']);

     $categori_id = mysqli_real_escape_string($mysqli, $_POST['categori_id']);
     $city = mysqli_real_escape_string($mysqli, $_POST['city']);
     $number = mysqli_real_escape_string($mysqli, $_POST['number']);

     if(empty($name)){array_push($errors, "Name is required");}
     if(empty($price)){array_push($errors, "Price is required");}
     if(empty($description)){array_push($errors, "Description is required");}

     if(empty($categori_id)){array_push($errors, "city is required");}
     if(empty($city)){array_push($errors, "city is required");}
     if(empty($number)){array_push($errors, "number is required");}


     if(empty($_FILES['image']['name'])){array_push($errors, "Images is required");}

     if(!count($errors)){
         $date = date('Ym');
         $upload = new Upload('uploads/products/'.$date);
         $upload->file = $_FILES['image'];
         $errors = $upload->upload();
     }



///////////////////////////////////////////////////
  //   $products_user = $mysqli->query("select id, email name from users where id=".$_SESSION['user_id']." limit 1");
    // if($products_user->num_rows){
      // $by_user = $products_user->fetch_assoc()['id'];
       //echo $by_user;

    // $mysqli->query("insert into products (by_user, name, number, description, price, city, nameusr)
     //values('$by_user=".$_SESSION['user_id']."', '$nameP', '$number', '$description', '$price', '$city', '$nameusr',);
       //");
     //}

     ////////////////////////////////////////////////

     if(!count($errors)){

       $products_user = $mysqli->query("select id, email name from users where id=".$_SESSION['user_id']." limit 1");
       if($products_user->num_rows){
         $by_user = $products_user->fetch_assoc()['id'];

       $products_categori= $mysqli->query("select id, cname from categories");
       if($products_categori->num_rows){
         $categori_id = $products_categori->fetch_assoc()['id'];
         $categori_id = $_POST['categori_id'];


         $query = "insert into products (by_user, categori_id, name, description, price, city, nameusr, number, image) values ('$by_user', '$categori_id', '$name', '$description', '$price', '$city', '$nameuser".$_SESSION['user_name']."', '$number', '$upload->filePath')";
         $mysqli->query($query);
}
}


         if($mysqli->error){
             array_push($errors, $mysqli->error);
         }else{
             echo "<script>location.href = 'index.php'</script>";
         }


     }
 }
 ?>















<?php
$users = $mysqli->query('select * from users order by id')->fetch_all(MYSQLI_ASSOC);

?>

<?php foreach ($users as $user ); ?>





<?php $products = $mysqli->query("select * from products  ORDER BY `name` ASC")->fetch_all(MYSQLI_ASSOC) ?>



<?php $categories = $mysqli->query("select * from categories  ")->fetch_all(MYSQLI_ASSOC) ?>









<div class="card">

  <div class="container pt-3">
    <?php include __DIR__.'/template/errors.php'


     ?>
     <?php if(isset($_SESSION['Logged_in'])): ?>



    <form class="" action="" method="post" enctype="multipart/form-data">
      <div class="row">


        <div class="form-group col-md-6">
            <label for="name">اسم المنتج</label>
            <input type="text" name="name" class="form-control"  id="name" value="<?php echo $name; ?>">
        </div>


        <div class=" form-group">
          <label for="categori_id">نوع المنتج</label>
          <select name="categori_id" id="categori_id" class="form-control">
            <?php foreach($categories as $categori) { ?>
                <option value="<?php echo $categori['id'] ?>">
                  <?php echo $categori['cname'] ?>
                </option>
            <?php } ?>
          </select>
        </div>


        <div class="form-group col-md-6">
            <label for="name">المدينه</label>
            <input type="text" name="city" class="form-control"  id="city" value="<?php echo $city; ?>">
        </div>



        <div class="form-group col-md-6">
            <label for="name">رقم الجوال</label>
            <input type="number" name="number" class="form-control"  id="number" value="<?php echo $number; ?>">
        </div>

        <div class="form-group col-md-6">
            <label for="description">وصف المنتج</label>
            <textarea name="description"  id="description"  class="form-control" cols="30" rows="1"><?php echo $description?></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="price">السعر</label>
            <input type="number" name="price" class="form-control" id="price" value="<?php echo $price; ?>">
        </div>

        <div class="form-group col-md-6">
            <label for="image">صوره المنتج:</label>
            <input type="file" name="image">
        </div>


        <div class="form-group col-md-6">
          <button class="btn btn-info">اضافه منتج</button>
        </div>


</div>
    </form>



  </div>

</div>

<?php else: ?>
<?php echo 'قم بتسجيل الدخول لعرض المنتجات' ?>
<?php endif ?>






<?php
$mysqli->close();

 ?>
