<?php

namespace wishlist\vue;

class VueRecapInvalide{
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
        <h2>Dans le formulaire précédent, vous avez fourni des informations invalide :</h2>
        
        <p><b>Nom : </b>$nom, doit etre du type texte => "Caramel"</p>
        <p><b>Prix : </b>$prix, doit etre du type nombre => "15"</p>
        <p><b>Description : </b>$desc, doit etre du type texte => "Ceci est un exemple"</p>
    </body>
</html>
END;

        return $html;
    }
}