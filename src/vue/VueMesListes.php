<?php
namespace wishlist\vue;

class VueMesListes{

    private array $array;

    function __construct(array $a){
        $this->array = $a;
    }

    public function setItems($a):void{
        $this->items = $a;
    }
    public function render() : mixed{
    $listes = $this->array[0];
    foreach($listes as $l){
        $content = $content ."\n" .'<h2>' .$l['titre'] .'</h2>';
    }

        $html = <<<END
<!DOCTYPE html>
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/styleContenuListe.css">
    </head>
<body>
    <a href="/MyWishListPHP">
        <input type="button" name="accueil">
    </a>
<div class="content">
<u><h1>Voici vos listes :</h1></u>
$content
 <br>
</div>
<br>
<form>
    <input type="button" value="Retour" onclick="history.go(-1)">
</form>
</body></html>
END ;
        return $html;

    }

}
