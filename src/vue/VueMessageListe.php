<?php

namespace wishlist\vue;

class VueMessageListe{

    private array $array;

    public function __construct($a){
        $this->array = $a;
    }

    public function render() : string{

        $html = <<<END
<!DOCTYPE html> 
 <head>
      <title>Message Liste</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../../css/styleListe.css">
    </head>
    <body>
    <div id="container">
 <form action="" method="post">
   <h1>Ajout du message</h1>
        <label for="desc"><b>Message:</b></label>
        <textarea id="descItem" placeholder="Ceci est un exemple de message" 
        name="message"></textarea>
        
        <input type="submit" id='submit' value="Créer le message">
    
</form>
</div>
</body><html>
END;

        return $html;
    }

    public function renderRecap(){
        $html = <<<END
<!DOCTYPE html> 
 <head>
      <title>Message Liste</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../../css/styleListe.css">
    </head>
    <body>
    <div id="container">
 <form action="" method="post">
   <h1>Message enregistré avec succés</h1>
        <label for="fin"><b>Votre message a bien été enregistré dans la base de donnée</b></label>
        <label for="fin"><b>Vous pouvez retourner à la page précédente </b></label>
        
        <input type="button" value="Retour" onclick="history.go(-2)">
</form>
</div>
</body><html>
END;

        return $html;
    }


}