<?php
if(isset($_SESSION['success_message'])):?>

 <div class="alert alert-info">
   <?php
      echo $_SESSION['success_message'];
    ?>
 </div>

 <?php
    unset($_SESSION['success_message']);

  endif;
  ?>
