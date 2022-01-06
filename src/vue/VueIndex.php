<?php

namespace wishlist\vue;

class VueIndex
{
    //a faire :
    //creer une vue pour choisir un item et une vue pour la liste
    //remplacer l'appel ci-dessous avec la fonction du get dans le controller
    //vue avec un input text et bouton valider
    //padding ou margin pour le textarea (comme les input text du haut)

    //ancien : public function render():mixed{
    public static function render():string{


        return <<<END
<!DOCTYPE html> 
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/styleIndex.css">
    </head>
<body>

<h1><strong><u>MyWishList</u></strong></h1>
        <form action="controller/ItemController.php">
            <input type="submit" name="b_liste" value="Listes" onclick="fliste()" />
            <input type="submit" name="b_item" value="Items" onclick="fitem()" />
        </form>
<button name="listes"><strong>Listes</strong><br>Afficher le menu des listes</button><br>
<button name="items"><strong>Items</strong><br>Afficher le menu des items</button>


</body>
</html>
END;
}
}