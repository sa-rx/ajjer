<?php


class Service {
  public $available = false;
  public $taxRate = 0;


  public function __construct()
  {
      $this->available = true;
  }

  public function __destruct()
  {
  }


  public static function all(){
    return[
        ['name'=> 'consultation',   'price' => 500,   'days'=> ['sun','mon'] ],
        ['name'=> 'training',   'price' => 250,   'days'=> ['tues','wed'] ],
        ['name'=> 'dseign',   'price' => 100,   'days'=> ['thu','fri'] ],
    ];
  }


  public function price($price){

    if($this->taxRate > 0){
          return $price + ($price * $this->taxRate);
        }

      return $price;

    }
  }


 ?>
