<?php

namespace wishlist\vue;

class VueMessages{

    private $array;

    public function __construct($a){
        $this->array = $a;
    }

    public function render(){
        $content = '';
        $messages = $this->array[0];
        foreach($messages as $m){
            $content = $content ."\n" .'<li>' .$m->message .'</li>';
        }

        $html = <<<END
<!DOCTYPE html>
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../../css/styleMessages.css">
    </head>
<body>
<div class="content">
<title>Messages</title>
<h1>Voici le(s) message(s) lié(s) avec la liste</h1>
 $content
 <br>
     <input type="button" value="Retour" onclick="history.go(-1)">
</div>
<br>
</body></html>
END ;
        return $html;

    }

}

//<a href="/MyWishListPHP">
//        <input type="button" name="accueil">
//    </a>