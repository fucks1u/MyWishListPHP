<?php
namespace wishlist\vue;

class VueParticipant{

    private array $array;
    private $items;

    function __construct(array $a){
        $this->array = $a;
    }

    public function setItems($a):void{
        $this->items = $a;
    }
    public function render(int $nb,string $base) : mixed{
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
                $content = $content ."\n" .'<p>Voici la liste des items présent dans la liste : </p>';
            }
            foreach ($this->items as $v){
                $content = $content ."\n" .'<p>' .$v['nom'] .'</p>';
            }
            $im ="";
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
                $desc = '<p>Description : ' .$item->descr .'</p>';
                $im = '<img src="' .$base .'/img/'.$item->nom .'.jpg">';
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
<form>
    <a href="message">
        <input type="button" value="Ajouter un message">
    </a>
</form>
</body><html>
END ;
return $html;

    }


}