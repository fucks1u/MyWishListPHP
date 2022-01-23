<?php

namespace wishlist\modele;

class Reservation extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'no';
    public $timestamps = 'false';
}

