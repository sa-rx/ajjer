<?php
$title =' Register';
 require_once 'template/haeder.php';
 require 'config/app.php';
 require_once 'config/database.php';
?>

<?php
if(isset($_SESSION['Logged_in'])){
  header('location: index.php');
}

$errors = [];
$email ='';
$name = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($mysqli, $_POST['email']) ;
    $name = mysqli_real_escape_string($mysqli, $_POST['name']) ;
    $password = mysqli_real_escape_string($mysqli, $_POST['password']) ;
    $password_confirmation = mysqli_real_escape_string($mysqli, $_POST['password_confirmation']) ;

    if(empty($email)){array_push($errors, "خطأ في الايميل");}
    if(empty($name)){array_push($errors, "خطأ في الاسم");}
    if(empty($password)){array_push($errors, "خطأ في كلمة المرور");}
    if(empty($password_confirmation)){array_push($errors, "خطأ في تاكيد كلمة المرور");}
    if($password != $password_confirmation){
      array_push($errors,"كلمة المرور لا تتطابق");
    }

    if(!count($errors)){
        $userExists = $mysqli->query("select id, email from users where email='$email' limit 1");

        if($userExists->num_rows){
          array_push($errors, "الايميل موجود مسبقا");

        }

    }

    if(!count($errors)){
      $password = password_hash($password, PASSWORD_DEFAULT);

      $query = "insert into users (email, name, password) values ('$email', '$name', '$password')";
      $mysqli->query($query);

      $_SESSION['Logged_in'] = true;
      $_SESSION['user_id'] = $mysqli->insert_id;
      $_SESSION['user_name'] = $name;
      $_SESSION['success_message'] = "مرحبا بك  $name";

     echo "<script>location.href = 'index.php'</script>";

    }


}
 ?>

<div id="register">

  <h4 class="">مرحبا بك </h4>
  <h5 class="text-info">انشاء حساب جديد</h5>
  <hr>


<?php include 'template/errors.php' ?>
    <form class="" action="" method="post">
        <div class="form-group">
            <label for="email">الايميل</label>
            <input type="email" name="email" class="form-control"  id="email" value="<?php echo $email; ?>">
        </div>

        <div class="form-group">
            <label for="name">اسمك</label>
            <input type="text" name="name" class="form-control"  id="name" value="<?php echo $name; ?>">
        </div>

        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password" name="password" class="form-control"  id="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">تاكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" class="form-control"  id="password_confirmation">
        </div>

        <div class="form-group">
            <button class="btn btn-info">تسجيل</button>
            <a href="login.php">لدي حساب</a>
        </div>

    </form>

</div>

<?php
include 'template/footer.php'
 ?>
