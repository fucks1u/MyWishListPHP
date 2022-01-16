<?php

namespace wishlist\vue;

class VueRecapListe{
    private array $array;

    public function __construct(array $a){
        $this->array = $a;
    }

    public function render() : mixed{
        $titre = $this->array['list_title'];
        $date = $this->array['list_date'];
        $desc = $this->array['list_description'];
        $html = <<<END
<!DOCTYPE html> 
<html>
    <head>
        <title>Page de traitement</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/styleRecapListe.css">
    </head>
    <body>

        <h1>Dans le formulaire précédent, vous avez fourni les
        informations suivantes:</h1>

        <div class="fond">
        
        <p><b>Titre:</b> $titre</p>
        <p><b>Date d'expiration:</b> $date</p>
        <p><b>Description:</b><br></br>$desc</p>

        </div>
    </body>
</html>
END;

        return $html;
    }
}