<?php

namespace wishlist\vue;

class VueRecapItemInvalide{


    public function render() : mixed{
        $html = <<<END
<!DOCTYPE html> 
<html>
    <head>
        <title>Page de traitement</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Dans le formulaire précédent, vous avez fourni des informations invalides :</h2>
        
        <p>Nom : <b>Caramel</b>, doit etre du type texte => "Caramel"</p>
        <p>Prix : <b>15</b></p>
        <p>Description : <b>Description pour l'item Caramel</b></p>
    </body>
</html>
END;

        return $html;
    }
}