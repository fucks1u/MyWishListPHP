<?php

namespace wishlist\vue;

class VueRecapListeInvalide{


    public function render() : mixed{
           
        $html = <<<END
<!DOCTYPE html> 
<html>
    <head>
        <title>Page de traitement</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/styleRecapListeInvalide.css">
    </head>
    <body>
    
        <h1>Dans le formulaire précédent, vous avez fourni des informations invalides :</h1>
        <div class="fond"> 
        
        <p><b>Nom:</b> Caramel, doit etre du type <span class="check">texte</span>=> <span class="solution">"Caramel"</span></p>
        <p><b>Date:</b> doit etre remplie avec des <span class="check">nombres</span> comme par exemple <span class="solution"> 25/12/2022</span></p>
        <p><b>Description:</b><br></br>doit comporter du <span class="check">texte</span> pour décrire la liste comme par exemple :<br></br>  <span class="solution">
        Cette liste regroupe les Items de mes rêves! </span></p>
        </div>
    </body>
</html>
END;

        return $html;
    }
}