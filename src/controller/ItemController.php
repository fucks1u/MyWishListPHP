<?php

namespace wishlist\controller;

use wishlist\modele\Item;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use wishlist\modele\Liste;
use wishlist\vue\VueFormulaireItem;
use wishlist\vue\VueRecapItem;
use wishlist\vue\VueRecapInvalide;

class ItemController{

    private $container; //conteneur de dependances de l'application

    public function __construct(\Slim\Container $c){

        $this->container = $c;

 }
 /* Exemple
public function hello(Request $request, Response $response, array $args) : Response{
    $name = $args['name'];
    $response->getBody()->write("<h1>Hello, $name</h1>");
    return $response;
}*/

    public function getItem($rq, $rs, $args) : Response{
        $base = $rq->getUri()->getBasePath();
        $id = $args['id'];
        $item = Item::where('id','=',$args['id'])->first();
        $v = new \wishlist\vue\VueParticipant([$item]);
        $rs->getBody()->write($v->render(3,$base));
        return $rs;
    }


    public function getList($rq, $rs, $args){
        $base = $rq->getUri()->getBasePath();
        $id = $args['id'];
        $list = Liste::where('no', '=',$args['id'])->get();
        $v = new \wishlist\vue\VueParticipant([$list]);
        $rs->getBody()->write($v->render(1,$base));
        return $rs;
    }

    public function getListItem($rq, $rs, $args){
        $list = Liste::where('no', '=',$args['id'])->with('items')->first();
        $v = new \wishlist\vue\VueParticipant([$list]);
        $rs->getBody()->write($v->render(2));
        return $rs;
    }

    /*
     * Methode permettant d'afficher visuellement le formulaire
     */
    public function createItem($rq,$rs,$args){
        //$list = Item::query('SELECT * FROM ITEM');
        $v = new VueFormulaireItem();
        $rs->getBody()->write($v->render());
        return $rs;
    }

    /*
     * Methode permettant de recuperer les données présentes dans le formulaire
     * et egalement l'afficher sur une page annexe
     */
    public function resumeItem($rq,$rs,$args){
        //récupération des données du post
        $data = $rq->getParsedBody();
        $nom = $data['item_name'];
        $description = $data['item_description'];
        $tarif = $data['item_price'];

        //filtrage des données du post
        if(!filter_var($nom,FILTER_SANITIZE_STRING)||!filter_var($description
                ,FILTER_SANITIZE_STRING)||!filter_var($tarif,FILTER_SANITIZE_NUMBER_INT))
        {
            $v = new VueRecapInvalide($data);
            $rs->getBody()->write($v->render());
        } else {
            //ajout dans la base de donnée
            try{
                Item::insert(['nom'=>$nom,'descr'=>$description,'tarif'=>$tarif]);
            } catch(PDOException $e){
                throw new DBException('Ajout impossible : ' .$e->getMessage());
            }
            //création de la vue racapitulative
            $v = new VueRecapItem($data);
            $rs->getBody()->write($v->render());

        }
        return $rs;
    }




}