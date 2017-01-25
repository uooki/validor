<?php
require './vendor/autoload.php';

use Uooki\Validor\Validor;

$valid=new Validor();

$d="hi!";

$res=$valid->valid($d,['min:3','regular:/^[a-z0-9]+$/','required'])->resultAll();

//var_dump($res);


$rule=['name'=>['min:3','max:6','regular:/^[a-z]+$/','required'],
       'pwd'=>['min:3','required','regular:/^[a-z]+$/'],
       'email'=>['callback:email']];

$form=['name'=>'    ','email'=>'qqqqq.com','pwd'=>'koui09'];

$result=$valid->validForm($rule,$form)->result();

var_dump($result);


