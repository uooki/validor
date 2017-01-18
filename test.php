<?php
require './vendor/autoload.php';

use Uooki\Validor\Validor;

$valid=new Validor();

$d="hi!";

$res=$valid->valid($d,['min:3','regular:/^[a-z0-9]+$/','required']);

var_dump($res);
