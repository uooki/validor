<?php
/**
 *
 * validor 功能的API , 为外部调用 validor 功能提供的接口
 *
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/12
 * Time: 15:32
 */

namespace Uooki\Validor;

//use Uooki\Validor\ValidConst;

class Validor
{


    public function __construct($request,Validation $validation){

        $this->_request=$request;
        $this->_validation=$validation;
    }

    public  function  valid($data,$rule,$type){

        $this->_validation->$type($data,$rule);

    }


}