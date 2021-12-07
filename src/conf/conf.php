<?php
use Illuminate\Database\Capsule\Manager as DB;

function boot_eloquent($file)
{
    $db = new DB();
    $conf = parse_ini_file($file);
    $db->addConnection($conf);
    $db->setAsGlobal();
    $db->bootEloquent();
}