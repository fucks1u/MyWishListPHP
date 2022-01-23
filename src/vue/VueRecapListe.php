<?php

namespace wishlist\vue;

class VueRecapListe{
    private array $array;
    private $id;

    public function __construct(array $a,$i){
        $this->array = $a;
        $this->id = $i;
    }


    public function render() : mixed{
        $titre = $this->array['list_title'];
        $date = $this->array['list_date'];
        $desc = $this->array['list_description'];
        $tokenPartage= $this->array['list_token_partage'];
        $html = <<<END
<!DOCTYPE html> 
<html>
    <head>
        <title>Recapitulatif liste</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../../css/styleRecapListe.css">
    </head>
    <body>

        <h1>Dans le formulaire précédent, vous avez fourni les
        informations suivantes concernant la liste:</h1>

        <div class="fond">
        
        <p><b>Titre:</b> $titre</p>
        <p><b>Numéro de la liste :</b> $this->id</p>
        <p><b>Date d'expiration:</b> $date</p>
        <p><b>Description:</b><br></br><div class="desc">$desc</div></p>
        <p><b>Lien partage:</b><br></br><div class="desc">$tokenPartage</div></p>

        </div>
        <div class="button">
    <input type="button" value="Accueil" onclick="history.go(-2)">
    </div>
    </body>
</html>
END;

        return $html;
    }
}