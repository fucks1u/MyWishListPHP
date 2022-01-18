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
        <link rel="stylesheet" href="../../css/styleRecapItemInvalide.css">
    </head>
    <body>
        <h1>Dans le formulaire précédent, vous avez fourni des informations invalides :</h1>
        <div class="fond"> 
        
        <p><b>Nom:</b> Caramel, doit etre du type <span class="check">texte</span>=> <span class="solution">"Caramel"</span></p>
        <p><b>Prix:</b> doit etre remplie avec des <span class="check">nombres</span> comme par exemple <span class="solution"> 14, 11 ou encore 7 </span></p>
        <p><b>Description:</b><br></br>doit comporter du <span class="check">texte</span> pour décrire la liste comme par exemple :<br></br>  <span class="solution">
        Cette liste regroupe les Items de mes rêves! </span></p>
        <input type="button" value="Retour" onclick="history.go(-1)">
        </div>
    </body>
</html>
END;

        return $html;
    }
}