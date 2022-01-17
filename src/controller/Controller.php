<?php

namespace wishlist\controller;

use wishlist\controller\DBException;
use wishlist\modele\Item;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use wishlist\modele\Liste;
use wishlist\vue\VueFormulaireItem;
use wishlist\vue\VueAjoutListe;
use wishlist\vue\VueListeItem;
use wishlist\vue\VueMessages;
use wishlist\vue\VueRecapItem;
use wishlist\vue\VueRecapListeInvalide;
use wishlist\vue\VueRecapItemInvalide;
use wishlist\vue\VueRecapListe;
use wishlist\vue\VueRechercheListe;
use wishlist\modele\Message;

class Controller{

    private $container;
    private $cookie;

    public function __construct(\Slim\Container $c){
        $this->container = $c;
 }


    public function getItem($rq, $rs, $args) : Response{
        $base = $rq->getUri()->getBasePath();
        $id = $args['id'];
        $item = Item::where('id','=',$args['id'])->first();
        $v = new \wishlist\vue\VueItem([$item]);
        $rs->getBody()->write($v->render($base));
        return $rs;
    }

    /*
     * -------------------------------------------------
     * - Methodes pour la gestion et creation de Liste -
     * -------------------------------------------------
     */
    public function getFormList($rq, $rs, $args){
        $v = new VueAjoutListe();
        $rs->getBody()->write($v->render());
        return $rs;
}

    public function getFormListId($rq, $rs, $args){
        $v = new VueRechercheListe();
        $rs->getBody()->write($v->render());
        return $rs;
    }

    public function getList($rq, $rs, $args){
        $data = $rq->getParsedBody();
        $base = $rq->getUri()->getBasePath();
        $list = Liste::where('no', '=',$data['list_id'])->get();
        $items = Item::where('liste_id', '=',$data['list_id'])->get();
        $v = new \wishlist\vue\VueListe([$list]);
        $v->setItems($items);
        $rs->getBody()->write($v->render(1,$base));
        return $rs;
    }

    public function createList($rq,$rs, $args){
        $this->verifCookie();
        $data = $rq->getParsedBody();

        $titre = $data['list_title'];
        $date = $data['list_date'];
        $desc = $data['list_description'];

        if(!filter_var($titre,FILTER_SANITIZE_STRING)||!filter_var($desc,FILTER_SANITIZE_STRING)){
            $v = new VueRecapListeInvalide($data);
            $rs->getBody()->write($v->render());
        } else {
            //ajout dans la base de donnée
            try{
                Liste::insert(['titre'=>$titre,'description'=>$desc,'expiration'=>$date,'token'=>$_COOKIE['participant_cookie']]);
            } catch(PDOException $e){
                throw new DBException('Ajout impossible : ' .$e->getMessage());
            }
            //création de la vue racapitulative
            $v = new VueRecapListe($data);
            $rs->getBody()->write($v->render());
        }
        return $rs;
    }


    public function getListItem($rq, $rs, $args){
        $list = Liste::where('no', '=',$args['id'])->with('items')->first();
        $v = new \wishlist\vue\VueListe([$list]);
        $rs->getBody()->write($v->render(2));
        return $rs;
    }

    public function getMessageList($rq, $rs, $args){
        $v = new \wishlist\vue\VueAjoutMessage($args);
        $rs->getBody()->write($v->render());
        return $rs;
    }

    public function getMessages($rq, $rs, $args){
        $id = $args['id'];
        $mess = Message::where('id_liste', '=',$id)->get();
        $v = new \wishlist\vue\VueMessages([$mess]);
        $rs->getBody()->write($v->render());
        return $rs;
    }


    public function getMessageRecap($rq, $rs, $args){
        $data = $rq->getParsedBody();
        $token = $_COOKIE['participant_cookie'];
        try{
            Message::insert(['id_liste'=>$args['id'],'message'=>$data['message'],'token'=>$token]);
        } catch(PDOException $e){
            throw new DBException('Ajout impossible : ' .$e->getMessage());
        }
        $v = new \wishlist\vue\VueAjoutMessage($args);
        $rs->getBody()->write($v->renderRecap());
        return $rs;
    }

    /*
     * ------------------------------------------------------------
     * - Methode permettant d'afficher visuellement le formulaire -
     * ------------------------------------------------------------
     */
    public function getFormItem($rq, $rs, $args){
        //TODO verification createur
        $v = new VueFormulaireItem($args['id']);
        $rs->getBody()->write($v->render());
        return $rs;
    }

    /*
     * Methode permettant de recuperer les données présentes dans le formulaire
     * et egalement l'afficher sur une page annexe
     */
    public function resumeCreateItem($rq, $rs, $args){
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

    public function verifCookie(){
        if($_COOKIE["participant_cookie"] == null){
            $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
            setcookie("participant_cookie",$token);
        }
    }
// filtrer les données remplies dans les champs
    //ajouter les données dans la base de donnée (a faire)




}