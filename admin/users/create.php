<?php
$title = 'create users';
$icon = 'circle-09';
include __DIR__.'/../template/header.php';



$errors = [];
$email ='';
$name = '';
$role = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($mysqli, $_POST['email']) ;
    $name = mysqli_real_escape_string($mysqli, $_POST['name']) ;
    $password = mysqli_real_escape_string($mysqli, $_POST['password']) ;
    $role = mysqli_real_escape_string($mysqli, $_POST['role']) ;

    if(empty($email)){array_push($errors, "خطاء في الايميل");}
    if(empty($name)){array_push($errors, "خطاء في الاسم");}
    if(empty($password)){array_push($errors, "خاء في كلمة المرور");}
    if(empty($role)){array_push($errors, "role is required");}




    if(!count($errors)){
      $password = password_hash($password, PASSWORD_DEFAULT);

      $query = "insert into users (email, name, password, role) values ('$email', '$name', '$password', '$role')";
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
            <label for="email">Your email</label>
            <input type="email" name="email" class="form-control" placeholder="your email" id="email" value="<?php echo $email; ?>">
        </div>

        <div class="form-group">
            <label for="name">Your name</label>
            <input type="text" name="name" class="form-control" placeholder="your name" id="name" value="<?php echo $name; ?>">
        </div>

        <div class="form-group">
            <label for="password">Your password</label>
            <input type="password" name="password" class="form-control" placeholder="your password" id="password">
        </div>




        <div class="form-group">
          <label for="role">Role:</label>
            <select class="form-control" name="role" id="role">
              <option value="user"
              <?php if($role == 'user') echo 'selected' ?>
              >User</option>


              <option value="admin"
              <?php if($role == 'admin') echo 'selected' ?>
              >Admin</option>

            </select>
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
