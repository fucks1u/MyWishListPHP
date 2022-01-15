<?php

namespace wishlist\vue;

class VueListe
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

 <form action="list/view" method="post">
   <h1>Affichage d'une liste</h1>

        <label for="titre"><b>Numéro de liste:</b></label>
        <input type="text" id="id" name="list_id" placeholder="5">
        
        <input type="submit" id='submit' value="Afficher la liste">
    
</form>
</body>
</html>
END;
    }
}