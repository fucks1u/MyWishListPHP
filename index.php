<?php

use \wishlist\modele\Liste as Liste; //utilisation du namespace pour les use
use \wishlist\modele\Item as Item;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ .'/vendor/autoload.php'; //utilsation du chemin pour les require
require __DIR__ .'/src/conf/conf.php';

boot_eloquent(__DIR__ . '/src/conf/conf.ini');

$c = new \Slim\Container(['settings'=>[
    'displayErrorDetails'=>true
]]);

$app = new \Slim\App($c);

$app->get('/item/{id}', function (Request $request, Response $response, array $args) {

    $c = new wishlist\controller\ItemController($this);
    return $c->getItem($request,$response,$args);

    /*$name = $args['name'];
    $response->getBody()->write("<h1>Hello, $name</h1>");
    return $response;*/
});

$app->get('/vue/{id}', function (Request $request, Response $response,array $args){
    $id = $args['id'];
    $req = Item::select('nom')->where('id','=',$id );
    $item = $req->first();
    $name = $item->nom;
    $response->getBody()->write("<h2>L'object à l'id $id est $name</h2>");
    return $response;
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("<h1>Welcome</h1>");
    return $response;
});

/*
$app->get('/item/{id}', function (Request $request, Response $response, array $args) {
    $valeur = $args['id'];
    $item = Item::find( $valeur ) ;
    $vue = VueParticipant( [ $item ] ) ;
    $vue->render( 3 ) ;
    return $vue;
});

$app->get('/items/{item}[/]', function ($rq,$rs,$args){
    $c = new \wishlist\controller\ItemController($args);
    return $c->render();
});*/




$app->run();
/*
Item::get();
$q1 = Item::select('nom')->where('id','=', 1);

*/