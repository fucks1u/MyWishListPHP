<?php

namespace wishlist\vue;

class VueTokenPartage{
    private array $array;
    private $id;

    public function __construct(array $a){
        $this->array = $a;
       
    }


    public function render() : mixed{
        $content='';
        $l=$this->array[0];
        foreach($l as $value){
            $content = $content ."\n" .'<h1><u>' .$value->titre .'</u></h1>';
            $content = $content ."\n" .'<h1>' .$value->description .'</h1>';
            $content = $content ."\n" .'<p>Attention la liste expire le : ' .$value->expiration .'</p>';
            $content = $content ."\n" .'<p>Voici la liste des items présent dans la liste : </p>';
        } 
        $html = <<<END
<!DOCTYPE html> 
<html>
    <head>
        <title>Recapitulatif liste</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/styleTokenPartage.css">
    </head>
    <body>

        <h1>Dans le formulaire précédent, vous avez fourni les
        informations suivantes concernant la liste:</h1>

        <div class="fond">
        
        $content
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