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
        <title>Recapitulatif liste</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/styleRecapListe.css">
    </head>
    <body>

        <h1>Dans le formulaire précédent, vous avez fourni les
        informations suivantes concernant la liste:</h1>

        <div class="fond">
        
        <p><b>Titre:</b> $titre</p>
        <p><b>Date d'expiration :</b> $date</p>
        <p><b>Description:</b><br></br>$desc</p>
    <input type="button" value="Acceuil" onclick="history.go(-2)">
    <input type="button" value="Copier URL" onclick="">
        </div>
    </body>
</html>
END;

        return $html;
    }
}