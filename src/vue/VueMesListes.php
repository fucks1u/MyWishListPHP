<?php
namespace wishlist\vue;

class VueMesListes{

    private array $array;

    public function setList($a){
        $this->array = $a;
    }

    public function render() : mixed{
    $listes = $this->array[0];
    $content = '';
    foreach($listes as $l){
        $content = $content .'<form action="view/' .$l['no'] .'">
                 <button type="submit">' .$l['titre'] .'</button>
                </form>';
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

    public function renderVide() : mixed{
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
<u><h1>Vous n'avez aucune liste</h1></u>
<p>Vous pouvez retourner à l'acceuil et cliquer sur le bouton pour créer une liste afin d'en afficher ici</p>
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
