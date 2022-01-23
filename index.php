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


            /***********************************************
            *                   Partie Liste
             ***********************************************/
/*
 * Chemin lie a la creation d'une liste
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
 * Chemin menant aux listes creer par le participant
 */
$app->get('/list/mylist', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMyList($request,$response,$args);
});
/*
 * Methode permettant de retourner le formulaire pour afficher une liste
 */
$app->get('/list', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getFormListId($request,$response,$args);
});

$app->get('/list/view/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getListId($request,$response,$args);
});
/*
 * Chemin pour afficher une liste avec un id donnee suite a clic du bouton submit du formulaire
 */
$app->post('/list/view', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getList($request,$response,$args);
});



            /***********************************************
            *                   Partie Item
            ***********************************************/
/*
 * Chemin lie a la creation d'un item paour une liste donnee en parametre
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

/*
 * Methode permettant d'afficher un item
 */
$app->get('/list/item/{id}', function (Request $request, Response $response, array $args) {

    $c = new wishlist\controller\Controller($this);
    return $c->getItem($request,$response,$args);
});


            /***********************************************
            *                Partie Message
            ***********************************************/
/*
 * Chemin pour creer un message a une liste donnee en parametre
 */
$app->get('/list/createMessage/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessageList($request,$response,$args);
});

/*
 * Methode pour afficher un message avec un id
 */
$app->get('/list/viewMessages/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessages($request,$response,$args);
});

$app->post('list/view/message', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessageList($request,$response,$args);
});

/*
 * Chemin qui renvoie le message recapitulatif inserer dans la bdd
 */
$app->post('/list/createMessage/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getMessageRecap($request,$response,$args);
});


            /***********************************************
            *               Partie Reservation
             ***********************************************/
/*
 * Chemin relatif a la reservation d'un item dans une liste donnee en parametre
 */
$app->get('/list/reserve/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->reservationItem($request,$response,$args);
});

$app->get('/list/reserved/{id}', function (Request $request, Response $response,array $args){
    $c = new \wishlist\controller\Controller($this);
    return $c->getItem($request,$response,$args);
})->setName('reserv');



            /******************************************
            *              Partie Accueil
             ****************************************/
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write(VueAccueil::render());
    return $response;
});


$app->run();


