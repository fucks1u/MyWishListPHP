<?php
namespace wishlist\vue;

class VueFormulaireListe{

    public function render() : string{

        $html = <<<END
<!DOCTYPE html> 
 <head>
      <title>Création Liste</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/styleListe.css">
    </head>
    <body>
    <div id="container">
 <form action="createList" method="post">
   <h1>Création d'une liste</h1>
        <label for="titre"><b>Titre de la liste:</b></label>
        <input type="text" id="title" name="list_title" placeholder="Ma Liste">

        <label for="date"><b>Date d'expiration :</b></label>
       <input type="date" name="list_date">

        <label for="desc"><b>Description de la liste:</b></label>
        <textarea id="descItem" placeholder="Ceci est un exemple de description" 
        name="list_description"></textarea>
        
        <input type="submit" id='submit' value="Créer la liste">
        <input type="button" value="Retour" onclick="history.go(-1)">
    
</form>
</div>
</body><html>
END;

        return $html;
    }






}
