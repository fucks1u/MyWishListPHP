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
      <link rel="stylesheet" href="css/styleIndex.css">
    </head>
<body>

<h1><strong><u>MyWishList</u></strong></h1>
<form>
    <a href="list" style="text-decoration:none">
        <input type="button" value="Afficher une liste">
    </a>
    <a href="list/createList" style="text-decoration:none">
        <input type="button" value="Créer une liste">
    </a>
</form>
</body>
</html>
END;
}
}

