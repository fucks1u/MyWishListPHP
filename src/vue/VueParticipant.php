<?php
namespace wishlist\vue;

class VueParticipant{

    private array $array;

    function __construct(array $a){
        $this->array = $a;
    }

    public function render(int $nb) : mixed{
        switch($nb){
            case 1 : {

            }
            case 2 : {
                //affichaffe liste de souhaits et items
                break;
            }

            case 3 : {
                $name = $this->array['nom'];
                $content = '<h1>' .$name .'</h1>';
                break;
            }
        }

        $html = <<<END
<!DOCTYPE html> <html>
<body>
<div class="content">
 $content
</div>
</body><html>
END ;
return $html;

    }


}