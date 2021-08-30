<?php
$title = 'create services';
$icon = 'notes';
include __DIR__.'/../template/header.php';



$errors = [];
$name = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = mysqli_real_escape_string($mysqli, $_POST['cname']) ;

    if(empty($name)){array_push($errors, "خطاء في الاسم ");}




    if(!count($errors)){
      $query = "insert into categories (cname) values ( '$name')";
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
            <label for="cname">Name</label>
            <input type="text" name="cname" class="form-control" placeholder="your name" id="cname" value="<?php echo $name; ?>">
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
