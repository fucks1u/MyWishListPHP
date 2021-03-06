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
use wishlist\vue\VueTokenPartage;
use wishlist\modele\Message;

class Controller{

    private $container;
    private $cookie;

    public function __construct(\Slim\Container $c){
        $this->container = $c;
 }

 /******************************
  *   Partie Liste
  *******************************/

    /*
     * recuperer une liste avec les donnees fournis par un formulaire
     */
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

    /*
     * recuperer un formulaire pour la recherche d'une liste grace a son id
     */
    public function getFormListId($rq, $rs, $args){
        $v = new VueRechercheListe();
        $rs->getBody()->write($v->render());
        return $rs;
    }

    /*
     * Methode pour recuperer une liste grace a son id
     */
    public function getListId($rq, $rs, $args){
        $id = $args['id'];
        $list = Liste::where('no', '=',$id)->get();
        $items = Item::where('liste_id', '=',$id)->get();
        $v = new \wishlist\vue\VueListeParticipant([$list]);
        $v->setItems($items);
        if($_COOKIE["participant_cookie"]){
            $rs->getBody()->write($v->renderMesListes());
        } else{
            $rs->getBody()->write($v->renderCookie());
        }


        return $rs;
    }

    /*
     * Methode pour retourner toutes les listes d'un participant grace a son token
     */
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

    /*
     * Methode qui retourne un formulaire pour la creation d'une liste
     */
    public function getFormList($rq, $rs, $args){
        $v = new VueFormulaireListe();
        $rs->getBody()->write($v->render());
        return $rs;
    }
    

    /*
    * Methode qui retourne une liste pour le token partage 
    */
    public function getListToken($rq, $rs, $args){
        $list = Liste::where('token_partage','=',$args['token'])->get();
        $l = $list[0];
        $id = $l->no;
        $items = Item::where('liste_id','=',$id)->get();
            $v = new VueTokenPartage([$list]);
            $v->setItems($items);
            $rs->getBody()->write($v->render());
            return $rs;
        }
    

    /*
     * Methode qui creer une liste grace aux donnees fournis dans le formulaire
     */
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
            //ajout dans la base de donn??e
            try{
                $token_partage = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
                Liste::insert(['titre'=>$titre,'description'=>$desc,'expiration'=>$date,'token'=>$_COOKIE['participant_cookie'],'token_partage'=>$token_partage]);
                $list = Liste::where('titre', '=',$titre)->first();
            } catch(PDOException $e){
                throw new DBException('Ajout impossible : ' .$e->getMessage());
            }

            return $rs->withRedirect($this->container->router->pathFor('list_recap', ['list' => $list->no]));
        }
        return $rs;
    }

    /*
     * Vue recapitulative des donnees du formulaire pour la creation d'une liste
     */
    public function recap($rq, $rs, $args){
        //cr??ation de la vue racapitulative
        $list = Liste::where('no', '=', $args['list'])->first();
        $token = $list['token_partage'];
        $data = array(
            'list_title' => $list->titre,
            'list_date' => $list->expiration,
            'list_description' => $list->description,
        );
        $v = new VueRecapListe($data,$list['no']);
        $v->setToken($token);
        $rs->getBody()->write($v->render());
    }



    /******************************
     *   Partie Item
     *******************************/

    /*
     * Methode permettant de recuperer un item et de l'afficher
     */
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
     * Methode permettant de reserver un item dans la bdd
     */
    public function reservationItem($rq, $rs, $args){
        $iditem = $args['id'];
        $item = Item::where('id','=',$iditem)->get();
        $i = $item[0];
        $idlist = $i->liste_id;
        Reservation::insert(['id_list'=>$idlist,'id_item'=>$iditem,'token'=>$_COOKIE["participant_cookie"]]);
        return $rs->withRedirect($this->container->router->pathFor('reserv', ['id' => $iditem]));
    }

    /*
     * Methode permettant de retourner un formulaire pour l'ajout d'un item dans une liste
     */
    public function getFormItem($rq, $rs, $args){
        $v = new VueFormulaireItem($args['id']);
        $rs->getBody()->write($v->render());
        return $rs;
    }

    /*
    * Methode permettant de recuperer les donn??es pr??sentes dans le formulaire
     * et egalement l'afficher sur une page annexe
     */
    public function createItem($rq, $rs, $args){
        //r??cup??ration des donn??es du post
        $data = $rq->getParsedBody();
        $nom = $data['item_name'];
        $description = $data['item_description'];
        $tarif = $data['item_price'];
        $id = $args['id'];

        //filtrage des donn??es du post
        if(!filter_var($nom,FILTER_SANITIZE_STRING)||!filter_var($description
                ,FILTER_SANITIZE_STRING)||!filter_var($tarif,FILTER_SANITIZE_NUMBER_INT))
        {
            $v = new VueRecapItemInvalide($data);
            $rs->getBody()->write($v->render());
        } else {
            //ajout dans la base de donn??e
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

    /*
     * Vuez recapitulative apres la creation d'un item
     */
    public function recapItem($rq, $rs, $args){
        $item = Item::where('id', '=', $args['item'])->first();
        $data = array (
            'item_name'=> $item->nom,
            'item_description'=>$item->descr,
            'item_price'=>$item->tarif,
        );
        $v = new VueRecapItem($data);
        $rs->getBody()->write($v->render());

    }


    /******************************
     *   Partie Message
     *******************************/

    /*
     * Methode permettant de retourner un formulaire pour l'ajout d'un message sur une liste donnee
     */
    public function getMessageList($rq, $rs, $args){
        $v = new \wishlist\vue\VueAjoutMessage($args);
        $rs->getBody()->write($v->render());
        return $rs;
    }

    /*
     * Methode retournant une vue avec tout les messages de la liste
     */
    public function getMessages($rq, $rs, $args){
        $id = $args['id'];
        $mess = Message::where('id_list', '=',$id)->get();
        $v = new \wishlist\vue\VueMessages([$mess]);
        $rs->getBody()->write($v->render());
        return $rs;
    }

    /*
     * Vue de confirmation de l'ajout d'un message en bdd
     */
    public function getMessageRecap($rq, $rs, $args){
        $data = $rq->getParsedBody();
        $token = $_COOKIE['participant_cookie'];
        try{
            Message::insert(['id_list'=>$args['id'],'message'=>$data['message'],'token'=>$token]);
        } catch(PDOException $e){
            throw new DBException('Ajout impossible : ' .$e->getMessage());
        }
        $v = new \wishlist\vue\VueAjoutMessage($args);
        $rs->getBody()->write($v->renderRecap());
        return $rs;
    }


    /*
     * Methode permettant de savoir si le participant a deja un cookie ou non
     */
    public function verifCookie(){
        if($_COOKIE["participant_cookie"] == null){
            $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
            setcookie("participant_cookie",$token,time()+60*60*24*30);
        }
    }
}