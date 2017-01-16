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