<?php
namespace wishlist\vue;

class VueFormulaireItem{

    public function render() : mixed{


        $html = <<<END
<!DOCTYPE html> 
 <head>
      <title>Création Item</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
 <form action="/creationItem" method="post">
    <div>
        <label for="name">Nom :</label>
        <input type="text" id="nomItem" name="item_name">
    </div>
    <div>
        <label for="prix">Prix :</label>
        <input type="text" id="prixItem" name="item_price">
    </div>
    <div>
        <label for="desc">Description :</label>
        <textarea id="descItem" name="item_description"></textarea>
    </div>
    <div class="button">
        <button type="submit">Valider</button>
    </div>
</form>
</body><html>
END;

        return $html;
    }






}
