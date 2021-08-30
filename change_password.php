<?php
$title =' password Reset';
 require_once 'template/haeder.php';
 require 'config/app.php';
 require_once 'config/database.php';
?>

<?php
if(isset($_SESSION['Logged_in'])){
  header('location: index.php');
}

if(!isset($_GET['token'])  ||  !$_GET['token']){
   die('token parameter is missing');
}

$now = date('Y-m-d H:i:s');

$stmt = $mysqli->prepare("select * from password_reset where token =? and expires_at > '$now'");
$stmt->bind_param('s', $token);
$token = $_GET['token'];

$stmt->execute();
$result = $stmt->get_result();
if(!$result->num_rows){
  die('token is not valid');
}


$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){


  $password = mysqli_real_escape_string($mysqli, $_POST['password']) ;
  $password_confirmation = mysqli_real_escape_string($mysqli, $_POST['password_confirmation']) ;

  if(empty($password)){array_push($errors, "خاء في كلمة المرور");}
  if(empty($password_confirmation)){array_push($errors, "خطاء في تاكيد كلمة المرور");}
  if($password != $password_confirmation){
    array_push($errors,"كلمة المرور لا تتطابق");
  }


    if(!count($errors)){

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $userId = $result->fetch_assoc()['user_id'];
        $mysqli->query("update users set password = '$hashed_password' where id = '$userId'");
        $mysqli->query("delete from password_reset where user_id='$userId'");
        $_SESSION['success_message'] = 'تم تغير كلمه المرور بنجاح';
        echo "<script>location.href = 'login.php'</script>";
        die();
          }

    }



 ?>

<div id="password_reset">

  <h4 class="">تغيير كلمة المرور </h4>
  <hr>


<?php include 'template/errors.php' ?>
    <form class="" action="" method="post">
        <div class="form-group">
            <label for="password">كلمة مرور جديدة</label>
            <input type="password" name="password" class="form-control" placeholder="" id="password"  >
        </div>

        <div class="form-group">
            <label for="password_confirmation">تأكيد كلمة المرور الجديدة</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="" id="password"  >
        </div>

        <div class="form-group">
            <button class="btn btn-info">تغير كلمه المرور</button>
        </div>

    </form>

</div>

<?php
include 'template/footer.php'
 ?>
