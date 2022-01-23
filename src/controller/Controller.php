<?php

namespace wishlist\controller;

use wishlist\controller\DBException;
use wishlist\modele\Item;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use wishlist\modele\Liste;
use wishlist\modele\Reservation;
use wishlist\vue\VueFormulaireItem;
use wishlist\vue\VueFormulaireListe;
use wishlist\vue\VueListeItem;
use wishlist\vue\VueMesListes;
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
        $res = Reservation::where('id_item','=',$item->id)->first();
        $v = new \wishlist\vue\VueItem([$item]);
        if($res == null){
            $v->setReservation(false);
        } else {
            $v->setReservation(true);
        }
        $rs->getBody()->write($v->render($base));
        return $rs;
    }

    /*
     * -------------------------------------------------
     * - Methodes pour la gestion et creation de Liste -
     * -------------------------------------------------
     */
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
        $l= $list[0];
        $t= $l["token"];
        if($_COOKIE["participant_cookie"]==$t){
            $rs->getBody()->write($v->renderCookie());
        } else {
            $rs->getBody()->write($v->renderSansCookie());
        }
    }


    public function reservationItem($rq, $rs, $args){
        $iditem = $args['id'];
        $item = Item::where('id','=',$iditem)->get();
        $i = $item[0];
        $idlist = $i->liste_id;
        Reservation::insert(['id_list'=>$idlist,'id_item'=>$iditem,'token'=>$_COOKIE["participant_cookie"]]);
        return $rs->withRedirect($this->container->router->pathFor('item_recap', ['id' => $iditem]));
    }



    public function getListId($rq, $rs, $args){
        $id = $args['id'];
        $list = Liste::where('no', '=',$id)->get();
        $items = Item::where('liste_id', '=',$id)->get();
        $v = new \wishlist\vue\VueListeParticipant([$list]);
        $v->setItems($items);
        $rs->getBody()->write($v->renderCookie());
        return $rs;
    }

    public function getMyList($rq, $rs, $args){
        $token = $_COOKIE["participant_cookie"];
        if($token == null){
            //ajouter une vue quand il n'y pas de liste
            $v = new VueMesListes();
            $rs->getBody()->write($v->renderVide());
        } else {
            $list = Liste::where('token', '=',$token)->get();
            $v = new VueMesListes();
            $v->setList([$list]);
            $rs->getBody()->write($v->render());
        }
        return $rs;
    }

    public function getFormList($rq, $rs, $args){
        $v = new VueFormulaireListe();
        $rs->getBody()->write($v->render());
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
                $list = Liste::where('titre', '=',$titre)->first();
            } catch(PDOException $e){
                throw new DBException('Ajout impossible : ' .$e->getMessage());
            }

            return $rs->withRedirect($this->container->router->pathFor('list_recap', ['list' => $list->no]));
        }
        return $rs;
    }

    public function recap($rq, $rs, $args){
            //création de la vue racapitulative
            $list = Liste::where('no', '=', $args['list'])->first();
            $data = array(
                'list_title' => $list->titre,
                'list_date' => $list->expiration,
                'list_description' => $list->description,
            );
            $v = new VueRecapListe($data, $id = $list['no']);
            $rs->getBody()->write($v->render());
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
        $v = new VueFormulaireItem($args['id']);
        $rs->getBody()->write($v->render());
        return $rs;
    }

    /*
     * Methode permettant de recuperer les données présentes dans le formulaire
     * et egalement l'afficher sur une page annexe
     */
    public function createItem($rq, $rs, $args){
        //récupération des données du post
        $data = $rq->getParsedBody();
        $nom = $data['item_name'];
        $description = $data['item_description'];
        $tarif = $data['item_price'];
        $id = $args['id'];

        //filtrage des données du post
        if(!filter_var($nom,FILTER_SANITIZE_STRING)||!filter_var($description
                ,FILTER_SANITIZE_STRING)||!filter_var($tarif,FILTER_SANITIZE_NUMBER_INT))
        {
            $v = new VueRecapItemInvalide($data);
            $rs->getBody()->write($v->render());
        } else {
            //ajout dans la base de donnée
            try{
                Item::insert(['nom'=>$nom,'descr'=>$description, 'liste_id'=>$id,'tarif'=>$tarif]);
                $item = Item::where('nom', '=',$nom)->first();
            } catch(PDOException $e){
                throw new DBException('Ajout impossible : ' .$e->getMessage());
            }
             return $rs->withRedirect($this->container->router->pathFor('item_recap', ['item' => $item->id]));
        }
        return $rs;
    }

    public function recapItem($rq, $rs, $args){
        //création de la vue racapitulative
        $item = Item::where('id', '=', $args['item'])->first();
        $data = array (
            'item_name'=> $item->nom,
            'item_description'=>$item->descr,
            'item_price'=>$item->tarif,
        );
            $v = new VueRecapItem($data);
            $rs->getBody()->write($v->render());

    } 

    public function verifCookie(){
        if($_COOKIE["participant_cookie"] == null){
            $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
            setcookie("participant_cookie",$token);
        }
    }




}