<?php

namespace wishlist\vue;

class VueItem{

    private array $array;

    public function __construct($a){
        $this->array = $a;
    }

    public function render($b){

        $item = $this->array[0];
        $content = '<h1>' .$item->nom .'</h1>';
        $desc = '<p>Description : ' .$item->descr .'</p>';
        $im = '<img src="' .$b .'/img/'.$item->img .'">';

        $html = <<<END
<!DOCTYPE html>
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/styleItem.css">
    </head>
<body>
<div class="content">
 $content
 $desc
 $im
 <br>
</div>
<br>
</body></html>
END ;
        return $html;
    }

}