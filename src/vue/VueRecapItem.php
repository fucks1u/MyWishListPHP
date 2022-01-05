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
    </head>
    <body>
        <p>Dans le formulaire précédent, vous avez fourni les
        informations suivantes :</p>
        
        <p>Nom :$nom</p>
        <p>Prix :$prix</p>
        <p>Description :$desc</p>
    </body>
</html>
END;

return $html;
}
}