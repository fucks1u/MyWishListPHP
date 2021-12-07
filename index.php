<?php

use \wishlist\modele\Liste as Liste; //utilisation du namespace pour les use
use \wishlist\modele\Item as Item;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ .'/vendor/autoload.php'; //utilsation du chemin pour les require
require __DIR__ .'/src/conf/conf.php';

boot_eloquent(__DIR__ . '/src/conf/conf.ini');

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("<h1>Hello, $name</h1>");
    return $response;
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


$app->get('/item/{id}', function (Request $request, Response $response, array $args) {
    $valeur = $args['id'];
    $item = Item::find( $valeur ) ;
    $vue = VueParticipant( [ $item ] ) ;
    $vue->render( 3 ) ;
    return $vue;
});




$app->run();
/*
Item::get();
$q1 = Item::select('nom')->where('id','=', 1);

*/