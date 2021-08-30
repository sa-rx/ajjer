<?php
$title =' login';
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
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($mysqli, $_POST['email']) ;
    $password = mysqli_real_escape_string($mysqli, $_POST['password']) ;

    if(empty($email)){array_push($errors, "خطأ في الايميل");}
    if(empty($password)){array_push($errors, "كلمة مرور خاطئه");}


    if(!count($errors)){
        $userExists = $mysqli->query("select id, email, password, name, role from users where email='$email' limit 1");

        if(!$userExists->num_rows){
          array_push($errors, "الايميل غير مسجل, $email");

        }else {

          $foundUser = $userExists->fetch_assoc();

          if(password_verify($password, $foundUser['password'])){

            $_SESSION['Logged_in'] = true;
            $_SESSION['user_id'] = $foundUser[id];
            $_SESSION['user_name'] = $foundUser['name'];
            $_SESSION['user_role'] = $foundUser['role'];

            if($foundUser['role'] == 'admin'){
              echo "<script>location.href = 'admin'</script>";

            }else{
              $_SESSION['success_message'] = "مرحبا بك  $foundUser[name]";

              echo "<script>location.href = 'index.php'</script>";
            }


          }else {
            array_push($errors, "كلمة المرور خطاء");
          }

        }

    }

  //  if(!count($errors)){
    //  $password = password_hash($password, PASSWORD_DEFAULT);

    //  $query = "insert into users (email, name, password) values ('$email', '$name', '$password')";
    //  $mysqli->query($query);

    //

    //}


}
 ?>

<div id="login">

  <h4 class="">مرحبا بك مجددا </h4>
  <h5 class="text-info">سجل دخولك</h5>
  <hr>


<?php include 'template/errors.php' ?>
    <form class="" action="" method="post">
        <div class="form-group">
            <label for="email">الايميل</label>
            <input type="email" name="email" class="form-control"  id="email" value="<?php echo $email; ?>">
        </div>


        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password" name="password" class="form-control"  id="password">
        </div>


        <div class="form-group">
            <button class="btn btn-info">دخول</button>
            <a href="password_reset.php">نسيت كلمه المرور؟</a>
            <a href="register.php">ليس لديك حساب؟</a>

        </div>

    </form>

</div>

<?php
include 'template/footer.php'
 ?>
