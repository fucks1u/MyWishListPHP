<?php

namespace wishlist\vue;

class VueItem{

    private array $array;
    private string $reservation;
    private string $bouton;
    private $bool;

    public function __construct($a){
        $this->array = $a;
    }
    public function setReservation($boolean){
    $this->bool = $boolean;
    }
    public function render($b){
        $item = $this->array[0];
        $content = '<h1>' .$item->nom .'</h1>';
        $desc = '<p>' .$item->descr .'</p>';
        $im = '<img src="' .$b .'/img/'.$item->img .'">';
            if($this->bool == true){
                $this->reservation = 'Cet item est reservé';
                $this->bouton = '';
            } else {
                $this->reservation = 'Cet item n\'est pas reservé';
                $this->bouton = '<a href="../reserve/'.$item->id .'">
<input type="button" value="Réserver cet item"></a>';
            }

        $html = <<<END
<!DOCTYPE html>
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../../css/styleItem.css">
    </head>
<body>
<h1>  $content </h1>
<div class="content">
<div class ="descr">
 $desc
 $this->reservation
 </div>
 $im
 
 <br>
</div>
<br>
<form action="" method="post">
<input type="button" value="Retour" onclick="history.go(-1)">
$this->bouton
</body></html>
END ;
        return $html;
    }

}