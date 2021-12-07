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
    $q1 = Item::select('nom')->where('id','=', 1);
    $item = $q1->first();
    $name = $item->nom;
    //$name = $args['name'];
    $response->getBody()->write("<h1>Hello, $name</h1>");
    return $response;
});

$app->run();
/*
Item::get();
$q1 = Item::select('nom')->where('id','=', 1);

*/