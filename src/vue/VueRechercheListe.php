<?php

namespace wishlist\vue;

class VueRechercheListe{

    public function render(){
        return <<<END
<!DOCTYPE html> 
 <head>
      <title>MyWishList</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/styleRechercheListe.css">
    </head>
<body>
    <a href="/MyWishListPHP">
        <input type="button" name="accueil">
    </a>
 <form action="list/view" method="post" name="affichage">
   <h1>Affichage d'une liste</h1>

        <label for="titre"><b>Numéro de liste:</b></label>
        <input type="text" id="id" name="list_id" placeholder="ex: 5">
        
        <input type="submit" id='submit' value="Afficher la liste">
    
</form>
</body>
</html>
END;
    }
}