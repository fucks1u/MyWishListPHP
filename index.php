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

$app->get('/liste/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\ItemController($this);
    return $c->getList($request,$response,$args);
});

$app->get('/listeItems/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\ItemController($this);
    return $c->getListItem($request,$response,$args);
});

/*
 * Methode GET pour envoyer le formulaire dans la classe ItemController
 * et utilisation de la fonction createItem
 */
$app->get('/formlist', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\ItemController($this);
    return $c->createItem($request,$response,$args);
});

/*
 * Methode POST pour récupérer les données du formulaire apres l'appui du bouton valider
 * et appel de la fonction resumeItem
 */
$app->post('/formlist',function(Request $request, Response $response, array $args){
    $c = new \wishlist\controller\ItemController($this);
    return $c->resumeItem($request,$response,$args);
});


/*
 * page d'acceuil
 */
$app->get('/', function (Request $request, Response $response, array $args) {
    $vIndex = new \wishlist\vue\VueIndex();
    $response->getBody()->write(VueIndex::render());
    return $response;
});
//poser question au prof pour le controleur, si il en faut que 1 ou alors dissocier
$app->post('/',function(Request $request, Response $response, array $args){
    $c = new \wishlist\controller\ItemController($this);
    return $c->resumeItem($request,$response,$args);
});


$app->run();

/*
 * a faire : aspect visuel de la page d'acceuil
 */

