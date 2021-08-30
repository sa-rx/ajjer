<?php

$title = 'التواصل';
 require_once 'template/haeder.php';
 require_once 'includes/uploader.php';
 require 'classec/Service.php';



$s= new service;
$s->taxRate = .05;

$services = $mysqli->query("select id, name from services order by 'name' ")
                   ->fetch_all(MYSQLI_ASSOC)
?>





<?php if($s->available) { ?>
<h1>التواصل </h1>


<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >



  <div class=" form-group">
    <label for="name">اسمك</label>
    <input type="text" name="name" value="<?php if(isset($_SESSION['contact_form']['name'])) echo $_SESSION['contact_form']['name'] ?>" class="form-control" >
    <span class="text-danger"><?php echo $nameError ?></span>
  </div>


  <div class=" form-group">
    <label for="email">الايميل</label>
    <input type="email" name="email" value="<?php if(isset($_SESSION['contact_form']['email'])) echo $_SESSION['contact_form']['email'] ?>" class="form-control" >
      <span class="text-danger"><?php echo $emailError ?></span>
  </div>


  <div class=" form-group">
    <label for="document">رفع صوره </label>
    <input type="file" name="document" class="form-control" >
    <span class="text-danger"><?php echo $documentError ?></span>
  </div>
 

  <div class=" form-group">
    <label for="services"> سبب التواصل</label>
    <select name="service_id" id="services" class="form-control">
      <?php foreach($services as $service){ ?>
          <option value="<?php echo $service['id'] ?>">
            <?php echo $service['name'] ?>

          </option>
      <?php } ?>
    </select>
  </div>


  <div class=" form-group">
    <label for="name">رسالتك</label>
    <textarea name="message" class="form-control" placeholder="your message" <?php if(isset($_SESSION['contact_form']['message'])) echo $_SESSION['contact_form']['message'] ?>></textarea>
    <span class="text-danger"><?php echo $messageError ?></span>
  </div>


  <button type="submit" class="btn btn-info">ارسال</button>

</form>

<?php }
?>

<?php  require_once 'template/footer.php' ?>
