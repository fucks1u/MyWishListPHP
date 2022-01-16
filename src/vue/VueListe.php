<?php
namespace wishlist\vue;

class VueListe{

    private array $array;
    private $items;

    function __construct(array $a){
        $this->array = $a;
    }

    public function setItems($a):void{
        $this->items = $a;
    }
    public function render() : mixed{
        $content = '';
        $desc = '';
        $items = '';
            $liste = $this->array[0];
            foreach($liste as $value){
                $idlist = $value->no;
                $content = $content ."\n" .'<h1>' .$value->titre .'</h1>';
                $content = $content ."\n" .'<h2>' .$value->description .'</h2>';
                $content = $content ."\n" .'<p>Attention la liste expire le : ' .$value->expiration .'</p>';
                $content = $content ."\n" .'<p>Voici la liste des items présent dans la liste : </p>';
            }
            foreach ($this->items as $v) {
                $iditem = $v['id'];
                $nomitem = $v['nom'];
                $items = $items .'<form action="item/' .$iditem .'">
                 <button type="submit">' .$nomitem .'</button>
                </form>';
            }
            $im ="";



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
 $content
 $desc
 $items
 <br>
</div>
<br>
<form>
    <a href="createMessage/$idlist">
        <input type="button" value="Ajouter un message">
    </a>
    <a href="viewMessages/$idlist">
        <input type="button" value="Listes des messages">
    </a>
    <input type="button" value="Retour" onclick="history.go(-1)">
</form>
</body></html>
END ;
return $html;

    }


}
