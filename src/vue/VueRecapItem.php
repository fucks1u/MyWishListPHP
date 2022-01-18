<?php

namespace wishlist\vue;

class VueRecapItem{
    private array $array;

    public function __construct(array $a){
        $this->array = $a;
}

public function render() : mixed{
    $nom = $this->array['item_name'];
    $prix = $this->array['item_price'];
    $desc = $this->array['item_description'];
    $html = <<<END
<!DOCTYPE html> 
<html>
    <head>
        <title>Page de traitement</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../css/styleRecapItem.css">
    </head>
    <body>
        <h1>Dans le formulaire précédent, vous avez fourni les
        informations suivantes concernant l'item:</h1>

        <div class="rectangle">
        
        <p><b>Nom : </b>$nom</p>
        <p><b>Prix : </b>$prix</p>
        <p><b>Description : </b>$desc</p>
        </div>
    </body>
</html>
END;

return $html;
}
}