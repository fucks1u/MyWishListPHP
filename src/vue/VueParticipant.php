<?php
namespace wishlist\vue;

class VueParticipant{

    private array $array;

    function __construct(array $a){
        $this->array = $a;
    }

    public function render(int $nb) : mixed{
        $content = '';
        $desc = '';
        switch($nb){
            case 1 : {
            //Affichage de la liste
            $liste = $this->array[0];
            foreach($liste as $value){
                $content = $content ."\n" .'<h1>' .$value->titre .'</h1>';
                $content = $content ."\n" .'<h2>' .$value->description .'</h2>';
                $content = $content ."\n" .'<p>Attention la liste expire le : ' .$value->expiration .'</p>';
            }
                break;
            }
            case 2 : {
                //Affichage liste de souhaits et items
                $list = $this->array[0];
                $items = $list->items;
                $content = '<h1>' .$list->titre .'</h1>';
                $content = $content .'<ul>';
                foreach($items as $value){
                    $content = $content ."\n" .'<li>' .$value->nom .'</li>';
                }
                break;
            }
            //Affichage d'un item
            case 3 : {
                $item = $this->array[0];
                $content = '<h1>' .$item->nom .'</h1>';
                $desc = '<p>' .$item->descr .'</p>';
                $im = '<img src=../../img/dinosaur.jpg">';
                break;
            }
        }

        $html = <<<END
<!DOCTYPE html> <html>
<body>
<div class="content">
 $content
 $desc
 $im
</div>
</body><html>
END ;
return $html;

    }


}