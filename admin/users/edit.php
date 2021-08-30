<?php
$title = 'edit user';
$icon = 'circle-09';
include __DIR__.'/../template/header.php';


$errors = [];
$email ='';
$name = '';
$role = '';


if(!isset($_GET['id']) || !$_GET['id']){
  die('حساب غير موجود');
}

$st = $mysqli->prepare('select * from users where id = ? limit 1');
$st->bind_param('i', $userId);
$userId = $_GET['id'];
$st->execute();
$user = $st->get_result()->fetch_assoc();

$name = $user['name'];
$email = $user['email'];
$role = $user['role'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(empty($_POST['email'])){array_push($errors, "خطاء في الايميل");}
  if(empty($_POST['name'])){array_push($errors, "خطاء في الاسم");}
  if(empty($_POST['role'])){array_push($errors, "role is required");}


    if(!count($errors)){

      $st = $mysqli->prepare('update users set name = ?, email = ?, role = ?, password = ? where id = ?');
      $st->bind_param('ssssi', $dbName, $dbEmail, $dbRole, $dbPassword, $dbId);
      $dbName = $_POST['name'];
      $dbEmail = $_POST['email'];
      $dbRole = $_POST['role'];
      $_POST['password'] ? $dbPassword = password_hash($_POST['password'], PASSWORD_DEFAULT) : $dbPassword = $user['password'];
      $dbId = $_GET['id'];

      $st->execute();

      if($st->error){
        array_push($errors, $st->error);
      }else {
        echo "<script>location.href = 'index.php'</script>";
      }

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
            <button class="btn btn-info">تحديث</button>
        </div>

    </form>


  </div>

</div>



<?php
include __DIR__.'/../template/footer.php';

 ?>
