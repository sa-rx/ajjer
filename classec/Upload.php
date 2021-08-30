<?php

class Upload{

    protected $uploadDir;
    protected $defaultUploadDir = 'uploads';
    public $file;
    public $fileName;
    public $filePath;
    protected $rootDir;
    protected $errors = [];


    public function __construct($uploadDir, $rootDir = false)
    {

          if($rootDir){
            $this->rootDir = $rootDir;
          }else{
              $this->rootDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'php';
          }

          $this->filePath = $uploadDir;
          $this->uploadDir = $this->rootDir.'/'.$uploadDir;

        }

    protected function validate(){

      if(!$this->isSizeAllowed()){
          array_push($this->errors, 'file size not allowed');
      }elseif(!$this->isSizeAllowed()){
          array_push($this->errors, 'file type notallowed');
      }

      return $this->errors;

    }


    protected function createUploadDir(){

        if(!is_dir($this->uploadDir)){
          umask(0);

          if(!mkdir($this->uploadDir, 0775)){
            array_push($this->errors, 'could not create upload dir');
            return false;
          }

        }

        return true;


    }

    public function upload(){

      $this->fileName = time().$this->file['name'];
      $this->filePath .= '/'.$this->fileName;

      if($this->validate()){
          return $this->errors;
      }elseif(!$this->createUploadDir()){
          return $this->errors;
      }elseif(!move_uploaded_file($this->file['tmp_name'], $this->uploadDir.'/'.$this->fileName)){
          array_push($this->errors, 'Error uploading your file');
      }
  // التعديل هنا لتحسين سلسلة الشروط + ارجاع مصفوفة الأخطاء في حال عدم وجود أخطاء لكي يمكن استخدامها والتأكد منها في الملفات الأخرى
      return $this->errors;
  }


    protected function isMimeAllowed(){
         $allowed = [

           'jpg' => 'image/jpeg' ,
            'png' => 'image/png' ,
            'gif' => 'image/gif'

        ];

        $fileMimeType = mime_content_type($this->file['tmp_name']);

        if(!in_array($fileMimeType, $allowed)){
            return false;
        };
          return true;

    }


  protected function isSizeAllowed(){

    $MaxFileSize = 1000 * 1024 * 1024 ;

    $fileSize = $this->file['size'];

    if($fileSize > $MaxFileSize){
        return false;
    }
    return true;
  }


}
