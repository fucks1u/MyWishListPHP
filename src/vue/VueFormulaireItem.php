<?php
namespace wishlist\vue;

class VueFormulaireItem{

    public function render() : mixed{


        $html = <<<END
<!DOCTYPE html> <html>
 <form action="/creationItem" method="post">
    <div>
        <label for="name">Nom :</label>
        <input type="text" id="nomItem" name="item_name">
    </div>
    <div>
        <label for="prix">Prix :</label>
        <input type="text" id="prixItem" name="item_price">
    </div>
    <div>
        <label for="desc">Description :</label>
        <textarea id="descItem" name="item_description"></textarea>
    </div>
    <div class="button">
        <button type="submit">Valider</button>
    </div>
</form>
</body><html>
END;

        return $html;
    }






}
