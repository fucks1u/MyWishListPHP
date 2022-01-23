<?php

namespace wishlist\vue;

class VueTokenPartage{
    private array $array;

    public function __construct(array $a){
        $this->array = $a;
       
    }
    public function setItems($a):void{
        $this->items = $a;
    }

    public function render() : mixed{
        $content='';
        $l=$this->array[0];
        $items = '';
        foreach($l as $value){
            $content = $content ."\n" .'<h1><u>' .$value->titre .'</u></h1>';
            $content = $content ."\n" .'<h1>' .$value->description .'</h1>';
            $content = $content ."\n" .'<p>Attention la liste expire le : ' .$value->expiration .'</p>';
            $content = $content ."\n" .'<p>Voici la liste des items présent dans la liste : </p>';
        }
        foreach ($this->items as $v) {
            $iditem = $v['id'];
            $nomitem = $v['nom'];
            $items = $items .'<form action="item/' .$iditem .'">
                 <button type="submit">' .$nomitem .'</button>
                </form>';
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
         $items
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