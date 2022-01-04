<?php

namespace wishlist\controller;

use wishlist\modele\Item;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use wishlist\modele\Liste;

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
        $list = Liste::where('no', '=',$args['id'])->get();
        $v = new \wishlist\vue\VueParticipant([$list]);
        $rs->getBody()->write($v->render(1));
        return $rs;
    }

    public function getListItem($rq, $rs, $args){
        $list = Liste::where('no', '=',$args['id'])->with('items')->first();
        $v = new \wishlist\vue\VueParticipant([$list]);
        $rs->getBody()->write($v->render(2));
        return $rs;
    }




}