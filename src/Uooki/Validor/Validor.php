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


class Validor
{

    use ValidationTrait;

    public function __construct(Validation $validation){
        $this->_validation=$validation;
    }

    public  function  valid($data,$rule){
        $this->_validation->valid($data,$rule)->result();
    }

    public function  validForm($form,$rule){
        //todo
    }


}