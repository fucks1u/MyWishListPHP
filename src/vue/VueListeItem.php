<?php

namespace wishlist\vue;

class VueListeItem
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

<h1><strong><u>Liste</u></strong></h1>
       
        <form>
    <a href="list/createList">
        <input type="button" value="Créer une liste">
    </a>
    <a href="viewList">
        <input type="button" value="Visualiser une liste">
    </a>
    
</form>
</body>
</html>
END;
    }
}