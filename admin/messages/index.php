<?php
$title = 'message';
include __DIR__.'/../template/header.php';
include __DIR__.'/../../config/database.php';
include __DIR__.'/../../config/app.php';



//$query = "select *,m.id as message_id, s.id as service_id from messages m
 //left join services s
 //on m.service_id = s.id
//order by m.id
 //";

//$messages = $mysqli->query($query)
  //  ->fetch_all(MYSQLI_ASSOC);

  $st = $mysqli->prepare("select *,m.id as message_id, s.id as service_id from messages m
   left join services s
   on m.service_id = s.id
  order by m.id
   ");

   $st->execute();
   $messages = $st->get_result()->fetch_all(MYSQLI_ASSOC);


if(!isset($_GET['id'])){
?>
<h2>Received messages</h2>
<div class="table-responsive">
    <table class="table table-hover table-striped shadow">
      <thead>
        <tr>
          <th>#</th>
          <th>sender name</th>
          <th>sender email</th>
          <th>service</th>
          <th>document</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>


<?php

foreach ($messages as  $message) {
    ?>
<tr>
  <td><?php echo $message['message_id'] ?></td>
  <td><?php echo $message['contact_name'] ?></td>
  <td><?php echo $message['email'] ?></td>
  <td><?php echo $message['name'] ?></td>
  <td><?php echo $message['document'] ?></td>
  <td>
        <a href="?id=<?php echo $message['message_id']; ?>" class="btn btn-sm btn-primary">View</a>
        <form onsubmit="return confirm('هل انت متاكد')" class="" action="" method="post" style="display: inline-block">
            <input type="hidden" name="message_id" value="<?php echo $message['message_id']  ?>">
            <button class="btn btn-sm btn-danger">delete</button>
        </form>
  </td>
</tr>
  <?php
}

 ?>
    </tbody>
  </table>
</div>
<?php
}else {

  $messageQuery = "select * from messages m
  left join services s
  on m.service_id = s.id
   where m.id=".$_GET['id']." limit 1";
  $message = $mysqli->query($messageQuery)->fetch_array(MYSQLI_ASSOC);
  ?>

  <div class="card">
    <h5 class="card-header">
      Message from: <?php echo $message['contact_name'] ; ?>
      <div class="small"><?php echo $message['email']; ?></div>
    </h5>
    <div class="card-body">
      <div class=""> service: <?php
      if($message['name']){
        echo $message['name'];
      }else{echo "no service";} ?></div>
      <?php echo $message['message'] ?>
    </div>
    <?php if($message['document']){ ?>
    <div class="card-footer">
      Attachment: <a href="<?php
       echo $config['app_url']
       .$config['upload_dir']
       .$message['document'] ?>">تحميل الملف</a>
     </div>
   <?php } ?>
  </div>

  <?php
}

if(isset($_POST['message_id'])){
    $st = $mysqli->prepare("delete from messages where id= ? ");
    $st->bind_param('i',$messageId);
    $messageId = $_POST['message_id'];
    $st->execute();


echo "<script>location.href = 'index.php'</script>";
    die();
}
include __DIR__.'/../template/footer.php';
