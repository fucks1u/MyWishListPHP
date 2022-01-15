<?php

namespace wishlist\vue;

class VueIndex
{
    public static function render():string{


        return <<<END
<!DOCTYPE html> 
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet">
    </head>
<body>

<h1><strong><u>MyWishList</u></strong></h1>
<form>
    <a href="list">
        <input type="button" value="Afficher une liste">
    </a>
    <a href="list/createList">
        <input type="button" value="Créer une liste">
    </a>
</form>
</body>
</html>
END;
}
}

//<button name="listes"><strong>Listes</strong><br>Afficher le menu des listes</button><br>
//<button name="items"><strong>Items</strong><br>Afficher le menu des items</button>
