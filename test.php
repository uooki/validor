<?php


require './vendor/autoload.php';

use Uooki\Validor\Validor;


$valid=new Validor();

$d="dfdqq5";

$res=$valid->valid($d,['min:6','regular:/^[0-9]+$/']);

var_dump($res);
