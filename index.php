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

$app->get('/list/view/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getListId($request,$response,$args);
});

/*
 * Partie reservation des items
 */
$app->get('/list/reserve/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->reservationItem($request,$response,$args);
});

$app->get('/list/reserved/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getItem($request,$response,$args);
})->setName('item_recap');

/*
 * ici
 */
$app->get('/list/createList', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getFormList($request,$response,$args);
});

$app->post('/list/createList', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->createList($request,$response,$args);
});

$app->get('/list/recap/{list}/', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->recap($request,$response,$args);
})->setName('list_recap');

/*
 * ajout item
 */
$app->get('/list/addItem/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getFormItem($request,$response,$args);
});

$app->post('/list/addItem/{id}',function(Request $request, Response $response, array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->createItem($request,$response,$args);
});

$app->get('/list/recapItem/{item}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->recapItem($request,$response,$args);
})->setName('item_recap');


$app->post('list/view/message', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessageList($request,$response,$args);
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

$app->get('/list/mylist', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMyList($request,$response,$args);
});


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

$app->run();

/*
 * a faire : aspect visuel de la page d'acceuil
 */

