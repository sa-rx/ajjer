<?php
$title = 'create products';
$icon = 'paper-2';
include __DIR__.'/../template/header.php';
include __DIR__.'/../../classec/Upload.php';




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

    $city = mysqli_real_escape_string($mysqli, $_POST['city']);
    $nameuser = mysqli_real_escape_string($mysqli, $_POST['nameusr']);
    $number = mysqli_real_escape_string($mysqli, $_POST['number']);

    if(empty($name)){array_push($errors, "Name is required");}
    if(empty($price)){array_push($errors, "Price is required");}
    if(empty($description)){array_push($errors, "Description is required");}

    if(empty($city)){array_push($errors, "city is required");}
    if(empty($nameuser)){array_push($errors, "user name is required");}
    if(empty($number)){array_push($errors, "number is required");}

    if(empty($_FILES['image']['name'])){array_push($errors, "Images is required");}

    if(!count($errors)){
        $date = date('Ym');
        $upload = new Upload('uploads/products/'.$date);
        $upload->file = $_FILES['image'];
        $errors = $upload->upload();
    }


    if(!count($errors)){

      $products_user = $mysqli->query("select id, email name from users where id=".$_SESSION['user_id']." limit 1");
      if($products_user->num_rows){
        $by_user = $products_user->fetch_assoc()['id'];


      $products_categori= $mysqli->query("select id, cname from categories");
      if($products_categori->num_rows){
        $categori_id = $products_categori->fetch_assoc()['id'];
        $categori_id = $_POST['categori_id'];



        $query = "insert into products (by_user, categori_id, name, description, price, city, nameusr, number, image) values ('$by_user', '$categori_id', '$name', '$description', '$price', '$city', '$nameuser', '$number', '$upload->filePath')";
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
            <input type="text" name="nameusr" class="form-control"  id="nameusr" value="<?php echo $nameuser; ?>">
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
