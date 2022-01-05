<?php
namespace wishlist\vue;

class VueFormulaireItem{

    public function render() : mixed{


        $html = <<<END
<!DOCTYPE html> 
 <head>
      <title>Création Item</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/styleItem.css">
    </head>
    <body>
    <div id="container">
 <form action="/creationItem" method="post">
   <h1>Création d'un Item</h1>

        <label for="name"><b>Nom de l'Item :</b></label>
        <input type="text" id="nomItem" name="item_name">

        <label for="prix"><b>Prix :</b></label>
        <input type="text" id="prixItem" name="item_price">

        <label for="desc"><b>Description :</b></label>
        <textarea id="descItem" name="item_description"></textarea>
        
        <input type="submit" id='submit' value="Créer l'item">
    
</form>
</div>
</body><html>
END;

        return $html;
    }






}
