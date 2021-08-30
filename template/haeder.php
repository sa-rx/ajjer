<?php
session_start();

 require_once __DIR__.'/../config/app.php' ?>


<!DOCTYPE html>
<html  dir="<?php echo $config ['dir'] ?>"  lang="<?php echo $config['lang'] ?>">
    <head>





      <title><?php echo $config['app_name']. " | ". $title  ?></title>


     <meta name="google-site-verification" content="edPM4Q5bQyDs3jiuUbROjo3tvrPpDcs8jC24XlxSXCc" />

      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

      <meta name="لتاجير الاغراص اللي ما تحتاجها" content="description" />



      <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>
      <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

      <style media="screen">
        .custom-card-image{
         height: 200px;
         background-size:cover;
         background-position:center;
         background-size: contain;
         background-repeat: no-repeat;
        }
       body{
          font-family: 'Cairo', sans-serif;
        }
             </style>
        </head>

<body dir="rtl" >

<div class="container my-grid">



  <nav style="background-color: #b4dadd;" class="navbar navbar-expand-lg navbar-dark shadow rounded-bottom">
    <a class="navbar-brand text-secondary" href="<?php echo $config['app_url'] ?>"><?php echo $config['app_name']?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link text-secondary" href="<?php echo $config['app_url'] ?>">الرئيسيه <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link text-secondary" href="<?php echo $config['app_url'] ?>contact.php">تواصل معنا</a>
        </li>
       <li class="nav-item active">
          <a class="nav-link text-secondary" href="<?php echo $config['app_url'] ?>About.php">فكرة الموقع</a>
        </li>
      </ul>


      <ul class="navbar-nav ml-auto">
        <?php if(!isset($_SESSION['Logged_in'])): ?>
        <li class="nav-item active">
          <a class="nav-link text-secondary" href="<?php echo $config['app_url'] ?>login.php">دخول</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link text-secondary" href="<?php echo $config['app_url'] ?>register.php">تسجيل</a>
        </li>

      <?php else: ?>
        <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <?php echo $_SESSION['user_name'] ?>
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['user_id'] ?>"> <?php echo $_SESSION['user_name'] ?> </a>
                 <a class="dropdown-item" href="settings_user.php?id=<?php echo $_SESSION['user_id'] ?>"> الاعدادات </a>
                 <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" href="<?php echo $config['app_url'] ?>logout.php">خروج</a>
               </div>
             </li>
      <?php endif ?>
      </ul>
    </div>
  </nav>
</div>







  <div class="container pt-5">
<?php include 'message.php' ?>
