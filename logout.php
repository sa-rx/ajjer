<?php
session_start();

if(isset($_SESSION['Logged_in'])){

    $_SESSION = [];
    $_SESSION['success_message'] = 'تم تسجيل الخروج ,نراك قريبا';
    header('location: login.php');
    die();
}





 ?>
