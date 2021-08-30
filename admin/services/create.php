<?php
$title = 'create services';
$icon = 'notes';
include __DIR__.'/../template/header.php';



$errors = [];
$name = '';
$description = '';
$price = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = mysqli_real_escape_string($mysqli, $_POST['name']) ;
    $description = mysqli_real_escape_string($mysqli, $_POST['description']) ;
    $price = mysqli_real_escape_string($mysqli, $_POST['price']) ;

    if(empty($name)){array_push($errors, "خطاء في الاسم ");}
    if(empty($description)){array_push($errors, "خطاء في الوصف");}
    if(empty($price)){array_push($errors, "خطاء في السعر");}




    if(!count($errors)){
      $query = "insert into services (name, description, price) values ( '$name', '$description', '$price')";
      $mysqli->query($query);

      if($mysqli->error){
        array_push($errors, $mysqli->error);
      }else {
        echo "<script>location.href='index.php'</script>";

      }
  //    header('location: index.php');

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
            <label for="description">Your description</label>
            <textarea name="description"  id="description"  class="form-control" cols="30" rows="10"><?php echo $description?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Your price</label>
            <input type="number" name="price" class="form-control" id="price" value="<?php echo $name; ?>">
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
