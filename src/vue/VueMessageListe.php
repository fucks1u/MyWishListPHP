<?php

namespace wishlist\vue;

class VueMessageListe{

    public function render() : string{

        $html = <<<END
<!DOCTYPE html> 
 <head>
      <title>Message Liste</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/styleListe.css">
    </head>
    <body>
    <div id="container">
 <form action="message" method="post">
   <h1>Ajout du message</h1>
        <label for="desc"><b>Message:</b></label>
        <textarea id="descItem" placeholder="Ceci est un exemple de message" 
        name="list_description"></textarea>
        
        <input type="submit" id='submit' value="Créer le message">
    
</form>
</div>
</body><html>
END;

        return $html;
    }


}