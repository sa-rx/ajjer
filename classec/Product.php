<?php

class Product extends Service {

    public static function all(){
        return [
            ['name'=> 'iphone',   'price' => 500, ],
            ['name'=> 'mouse',   'price' => 50, ],
            ['name'=> 'keyboard',   'price' => 100, ]
          ];
    }
}


 ?>
