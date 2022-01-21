<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use wishlist\vue\VueAccueil;

require __DIR__ .'/vendor/autoload.php'; //utilsation du chemin pour les require
require __DIR__ .'/src/conf/conf.php';

boot_eloquent(__DIR__ . '/src/conf/conf.ini');

$c = new \Slim\Container(['settings'=>[
    'displayErrorDetails'=>true
]]);

$app = new \Slim\App($c);


/*
 * Listes
 */
$app->get('/list', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getFormListId($request,$response,$args);
});

$app->post('/list/view', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getList($request,$response,$args);
});

$app->get('/list/recap/{list}/', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->recap($request,$response,$args);
})->setName('list_recap');

$app->post('list/view/message', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessageList($request,$response,$args);
});


$app->get('/list/createList', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getFormList($request,$response,$args);
});

$app->post('/list/createList', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->createList($request,$response,$args);
});


$app->get('/list/createMessage/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessageList($request,$response,$args);
});

$app->post('/list/createMessage/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessageRecap($request,$response,$args);
});

$app->get('/list/viewMessages/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessages($request,$response,$args);
});

$app->get('/list/addItem/{id}/', function(Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->recapItem($request,$response,$args);
})->setName('item_recap');

/*
 * Methode POST pour récupérer les données du formulaire apres l'appui du bouton valider
 * et appel de la fonction resumeItem
 */

/*
 * Items
 */
$app->get('/list/item/{id}', function (Request $request, Response $response, array $args) {

    $c = new wishlist\controller\Controller($this);
    return $c->getItem($request,$response,$args);
});



/*
 * nouveauté
 */
//$app->get('list/vi', function (Request $request, Response $response,array $args){
//    $c = new \wishlist\controller\Controller($this);
//    return $c->getFormItem($request,$response,$args);
//});

/*
 * Liste et Items
 */
$app->get('/listeItems/view/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getListItem($request,$response,$args);
});





/*
 * page d'acceuil
 */
$app->get('/', function (Request $request, Response $response, array $args) {
    $vIndex = new \wishlist\vue\VueAccueil();
    $response->getBody()->write(VueAccueil::render());
    return $response;
});
//poser question au prof pour le controleur, si il en faut que 1 ou alors dissocier
$app->post('/',function(Request $request, Response $response, array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->resumeCreateItem($request,$response,$args);
});


$app->run();

/*
 * a faire : aspect visuel de la page d'acceuil
 */

