<?php
namespace \wishlist\vue;

class VueParticipant{

    private array $array;
    private string $selecteur;

    function __construct(array $a){
        $this->array = $a;
    }

    public function render(mixed $nb){
        switch($nb){

            case 1 : {
                //affichage liste de souhaits
                break;
            }

            case 2 : {
                //affichaffe liste de souhaits et items
                break;
            }

            case 3 : {
                $content = $this->itemRenderHTML($this->array);
                break;
            }
        }

        $html = <<<END
<!DOCTYPE html> <html>
<body> …
<div class="content">
 $content
</div>
</body><html>
END ;

    }

    public function itemRenderHTML($item):string{
        return('<h2>Item : $item</h2>');
    }

}