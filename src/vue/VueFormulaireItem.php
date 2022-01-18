<?php
namespace wishlist\vue;

class VueFormulaireItem{

    protected int $idListe;

    public function __construct(int $id){
        $this->idListe=$id;
    }

    public function render() : mixed{

        $html = <<<END
<!DOCTYPE html> 
 <head>
      <title>Création Item</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../../css/styleItem.css">
    </head>
    <body>
    <div id="container">
 <form action="$this->idListe" method="post">
   <h1>Création d'un Item dans la liste $this->idListe</h1>

        <label for="name"><b>Nom de l'Item :</b></label>
        <input type="text" id="nomItem" name="item_name" placeholder="Caramel">

        <label for="prix"><b>Prix :</b></label>
        <input type="text" id="prixItem" name="item_price" placeholder="15">

        <label for="desc"><b>Description :</b></label>
        <textarea id="descItem" placeholder="Ceci est un exemple de description" 
        name="item_description"></textarea>
        
        <input type="submit" id='submit' value="Créer l'item">
    
</form>
</div>
</body><html>
END;

        return $html;
    }






}
