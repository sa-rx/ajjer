<?php

include_once 'database.php';

$settings = $mysqli->query('select * from settings')->fetch_array(MYSQLI_ASSOC);

if(count($settings)){
    $app_name = $settings['app_name'];
    $admin_email = $settings['admin_email'];
    $app_note = $settings['app_note'];
}else{
    $app_name = 'Service App';
    $admin_email = 'snazer658@gmail.com';
    $app_note = 'تاجير';

}
    $config =[
      'app_name' =>  $app_name,
      'admin_email' => $admin_email ,
      'lang' => 'eng' ,
      'dir' => 'ltr' ,
      'app_url' => 'http://127.0.0.1/php/',
      'upload_dir' => 'uploads/',
      'admin_assets' => 'http://127.0.0.1/php/admin/template/assets',
      'app_note' => $app_note,


    ];
 ?>
