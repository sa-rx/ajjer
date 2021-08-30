<?php
$title = 'Settings';
$icon = 'paper-2';
include __DIR__.'/../template/header.php';





if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $st = $mysqli->prepare('update settings set admin_email = ?, app_name = ?, app_note = ? where id = 2');
  $st->bind_param('sss', $dbAdminEmail, $dbAppNmae, $dbAppNote);
  $dbAdminEmail = $_POST['admin_email'];
  $dbAppNmae = $_POST['app_name'];
  $dbAppNote = $_POST['app_note'];
  $st->execute();

  echo "<script>location.href = 'index.php'</script>";

}



?>

<div class="card">

    <div class="container">

      <h3>settings </h3>

        <form action="" method="post">

            <div class="form-group">
              <label for="app_name">app name</label>
              <input type="text" name="app_name" value="<?php echo $config['app_name']; ?>" id="app_name" class="form-control">
            </div>

            <div class="form-group">
              <label for="app_note">app note</label>
              <input type="text" name="app_note" value="<?php echo $config['app_note']; ?>" id="app_note" class="form-control">
            </div>

            <div class="form-group">
              <label for="admin_email">admin email</label>
              <input type="email" name="admin_email" value="<?php echo $config['admin_email']; ?>" id="admin_email" class="form-control">
            </div>




            <div class="form-group">
              <button class="btn btn-success" type="submit" >update settings</button>
            </div>
        </form>

    </div>

</div>

<?php
include __DIR__.'/../template/footer.php';
