<?php

namespace wishlist\vue;

class VueAccueil
{
    public static function render():string{


        return <<<END
<!DOCTYPE html> 
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/styleAccueil.css">
    </head>
<body>

<h1><strong><u>MyWishList</u></strong></h1>
<form>
    <a href="list" style="text-decoration:none">
        <input type="button" value="Afficher une liste">
    </a>
    <a href="list/mylist" style="text-decoration:none">
        <input type="button" value="Afficher mes listes">
    </a>
    <a href="list/createList" style="text-decoration:none">
        <input type="button" value="Créer une liste">
    </a>
</form>
<br></br>
<br></br>
<p> Bienvenue sur MyWishList , sur ce site vous avez la possibilité de créer la liste de souhaits regroupant toutes vos envies.<br></br> 
Vous pouvez notamment consulter les listes publiques si vous avez besoins d'inspirations où pour y reserver un item de cette liste, <br> </br> en 
vous souhaitant une bonne Experience sur notre site </p>

</body>
</html>
END;
}
}

