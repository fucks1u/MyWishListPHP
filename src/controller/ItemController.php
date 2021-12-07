<?php

namespace wishlist\controller;

use wishlist\modele\Item;

class ItemController{

    public function __construct(){

 }


    public function getItem($rq, $rs, $args){
        $item = Item::where('id','=',$args['id'])->first();
        $v = new \VueParticipant($item, ITEM_VIEW);
        $rs->getBody()->write($v->render());
        return $rs;
    }

    public function listItem($rq, $rs, $args){
        $list = Item::OrderBy('titre')->get();

        $v = new \VueParticipant($list, LIST_VIEW);
        $rs->getBody()->write($v->render());
        return $rs;
    }

}