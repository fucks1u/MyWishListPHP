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
            $listeitem = $this->array[0];
            foreach($listeitem as $value){
                $content = $content ."\n" .'<h1>' .$value->titre .'</h1>';
            }
                break;
            }
            case 2 : {
                //Affichage liste de souhaits et items
                break;
            }

            case 3 : {
                $item = $this->array[0];
                $content = '<h1>' .$item->nom .'</h1>';
                $desc = '<p>' .$item->descr .'</p>';
                break;
            }
        }

        $html = <<<END
<!DOCTYPE html> <html>
<body>
<div class="content">
 $content
 $desc
</div>
</body><html>
END ;
return $html;

    }


}