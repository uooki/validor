<?php
/**
 *
 * validor ���ܵ�API , Ϊ�ⲿ���� validor �����ṩ�Ľӿ�
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