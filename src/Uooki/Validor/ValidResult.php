<?php
/**
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/15
 * Time: 15:36
 */

namespace Uooki\Validor;


/**
 * Class ValidResult
 * @package Uooki\Validor
 */
class ValidResult
{

    /**
     * @var
     */
    public $status;
    /**
     * @var
     */
    public $data;
    /**
     * @var
     */
    public $rule;
    /**
     * @var
     */
    public $result;

    /**
     * @param $data
     * @param $rule
     */
    public function  __construct($data,$rule){
        $this->data=$data;
        $this->rule=$rule;
        $this->status=true;
    }

    /**
     * @param $status
     */
    public function  setStatus($status){
          // true or false
          $this->status=$status;
    }

    /**
     * @param $result
     */
    public function setResult($result){
        // [min:false,regluar:false,callback:['fun1':fale,'fun2':true]]
        if(is_array($result[1])){
            $this->result[$result[0]][]=$result[1];
        }else{
            $this->result[$result[0]]=$result[1];
        }

    }
}