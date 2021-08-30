<?php
session_start();

require_once __DIR__.'/../../config/app.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../classec/user.php';

$user = new User;

if(!$user->isAdmin()){
    die('لا تمتلك صلاحيات للوصول لهذه الصفحه ');
}
 ?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo $config['admin_assets']?>/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php echo $config['app_name']." | ". $title ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="<?php echo $config['admin_assets']?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $config['admin_assets']?>/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />

    <link href="<?php echo $config['admin_assets']?>/css/demo.css" rel="stylesheet" />
</head>

<body>




  <div class="wrapper">
      <div class="sidebar" data-image="<?php echo $config['admin_assets']?>/img/sidebar-5.jpg">


  <?php include 'sidebar.php' ?>

      </div>
      <div class="main-panel">

          <nav class="navbar navbar-expand-lg " color-on-scroll="500">
              <div class="container-fluid">
                  <a class="navbar-brand" href="/../../php/index.php"> <?php echo $config['app_name']." | ". $title ?> </a>

                  <div class="collapse navbar-collapse justify-content-end" id="navigation">
                      <ul class="nav navbar-nav mr-auto">
                          <li class="nav-item">
                              <a href="#" class="nav-link" data-toggle="dropdown">
                                  <i class="nc-icon nc-<?php echo $icon ?>"></i>
                                  <span class="d-lg-none">Dashboard</span>
                              </a>
                          </li>
                      </ul>


                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item">
                              <a class="nav-link" href="#pablo">
                                  <span><?php echo $user->name() ?></span>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo $config['app_url'].'logout.php'; ?>">
                                  <span class="no-icon">Log out</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>


          <div class="content">
              <div class="container-fluid">
