<?php
require_once __DIR__."/../config/database.php";

$uploadDir = 'uploads';
$fileName = '';


$_SESSION['sender_name'] = "rawan";


function filterString($field){
  $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
if(empty($field)){
  return false;
}else{
  return $field ;
}
}



function  filterEmail($field){
$field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);

if(filter_var($field ,  FILTER_VALIDATE_EMAIL)){
return $field;
} else{
return false;
}

}


function canUpload ($file){
$allowed =[
 'jpg' => 'image/jpeg' ,
  'png' => 'image/png' ,
  'gif' => 'image/gif'
];

$MaxFileSize = 100 * 1024 * 1024 ;

$fileMimeType = mime_content_type($file['tmp_name']);  //صيغه اللف
$fileSize =$file['size'];

  if(!in_array($fileMimeType, $allowed)){
    return '*صيغه خاطئه';
  }
  if($fileSize > $MaxFileSize) {
    return 'صيغه كبيره';
  }

  return true;
}




$nameError =  $emailError = $messageError = $documentError = '';
$name = $email = $message = $document = '';





if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = filterString($_POST['name']);
    if(! $name){
        $_SESSION['contact_form']['name'] = '';
        $nameError = '*يوجد خطأ في الاسم';
    }else {
        $_SESSION['contact_form']['name'] = $name;
    }



    $email = filterEmail($_POST['email']);
    if(! $email){
        $_SESSION['contact_form']['email'] = '';
        $emailError = 'الايميل خطأ';
    }else {
        $_SESSION['contact_form']['email'] = $email;
    }



    $message = filterString($_POST['message']);
    if(! $message){
        $_SESSION['contact_form']['message'] = '';
        $messageError = 'خطأ';
    }else {
        $_SESSION['contact_form']['message'] = $message;
    }


 if(isset($_FILES['document'])  && $_FILES['document']['error'] == 0 ){

    $canUpload = canUpload($_FILES['document']);

    if($canUpload === true){

        if(!is_dir($uploadDir)){
            umask(0);
            mkdir($uploadDir, 775);
        }
    $fileName = time().$_FILES['document']['name'];
      move_uploaded_file($_FILES['document']['tmp_name'], $uploadDir.'/'.$fileName);


    }else{
      $documentError = $canUpload;
    }

 }
if(!$nameError && !$emailError && !$documentError && !$messageError){


    $fileName ? $filePath = $uploadDir.'/'.$fileName : $filePath = '';



    $statement = $mysqli->prepare("insert into messages
          (contact_name, email, document, message , service_id)
          values (?, ?, ?, ?, ?)");
    $statement->bind_param('ssssi', $dbContactName, $dbEmail, $dbDocument, $dbMessage, $dbServiceId);

    $dbContactName = $name;
    $dbEmail = $email;
    $dbDocument = $fileName;
    $dbMessage = $message;
    $dbServiceId = $_POST['service_id'];

  $statement->execute();
//    $insertMessage =
//    "insert into messages (contact_name, email, document, message, service_id)".
//    "values ('$name',  '$email',   '$fileName',   '$message', ".$_POST['service_id']."    )";
//    $mysqli->query($insertMessage);


  $headers = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UFT-8' . "\r\n";

  $headers .='from: '.$email."\r\n";
        'Reply-To: '.$email. "\r\n";
        'X-Mailer: PHP/' . phpversion();

        $htmlMessage = '<html><body>';
        $htmlMessage .= '<p style="color:#ff0000;">'.$message.'</p>';
        $htmlMessage .= '</body></html>';

      if(mail($config['admin_email'], 'you have new message', $htmlMessage, $headers)){
        //  session_destroy();
         echo "تم ارسال ملاحظتك";
           echo "<script>location.href = 'index.php'</script>";
          die();
      //  }else {
        //    echo "error sending your email";
       }

      }

}
