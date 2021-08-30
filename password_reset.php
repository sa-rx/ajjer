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

$errors = [];
$email = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($mysqli, $_POST['email']) ;

    if(empty($email)){array_push($errors, "خطأ في الايميل");}


    if(!count($errors)){
        $userExists = $mysqli->query("select id, email name from users where email='$email' limit 1");

        if($userExists->num_rows){

          $userId = $userExists->fetch_assoc()['id'];
          $tokenExists = $mysqli->query("delete from password_reset where user_id='$userId'");

          $token = bin2hex(random_bytes(16));

          $expires_at = date('Y-m-d  H:i:s' , strtotime('+1 day'));

          $mysqli->query("insert into password_reset (user_id, token, expires_at)
          values('$userId', '$token', '$expires_at');
          ");
          $changePasswordUrl = $config['app_url'].'change_password.php?token='.$token;
          $headers = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=UFT-8' . "\r\n";

          $headers .='from: '.$config['admin_email']."\r\n";
                'Reply-To: '.$config['admin_email']. "\r\n";
                'X-Mailer: PHP/' . phpversion();

                $htmlMessage = '<html><body>';
                $htmlMessage .= '<p style="color:#ff0000;">'.$changePasswordUrl.'</p>';
                $htmlMessage .= '</body></html>';

              mail($email, 'رابط تغير كلمه المرور', $htmlMessage, $headers);


          $_SESSION['success_message'] = ' تم إرسال رابط استعادة كلمة المرور الخاصة بك إلى بريدك الإلكتروني "تحقق من البريد الالكتروني الغير هام" ';

          echo "<script>location.href = 'password_reset.php'</script>";

        }

    }


}
 ?>

<div id="password_reset">

  <h4 class="">استعادة كلمة المرور </h4>
  <h5 class="text-info">ادخل ايميلك لاستعادة كلمة المرور</h5>
  <hr>


<?php include 'template/errors.php' ?>
    <form class="" action="" method="post">
        <div class="form-group">
            <label for="email">الايميل</label>
            <input type="email" name="email" class="form-control"  id="email" value="<?php echo $email; ?>">
        </div>

        <div class="form-group">
            <button class="btn btn-info">استعادة كلمه المرور</button>
        </div>

    </form>

</div>

<?php
include 'template/footer.php'
 ?>
