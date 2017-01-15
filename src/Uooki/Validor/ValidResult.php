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
    public $params;
    /**
     * @var
     */
    public $result;

    /**
     * @param $data
     */
    public function  __construct($data){
        $this->data=$data;
    }

    /**
     * @param $rule
     */
    public  function setRule($rule){
       // regex callback require ...
           $this->rule=$rule;
    }

    /**
     * @param $status
     */
    public function  setStatus($status){
          // true or false
          $this->status=$status;
    }

    /**
     * @param $params
     */
    public function setParams($params){
          // ����paramesλ  ��������
          $this->params=$params;
    }

    /**
     * @param $result
     */
    public function setResult($result){
        //��ͬһ���������ж�������Ŀ���ڴ�����
        // fun1:false,fun2:false,fun3:true.
        if(is_array($result)){
            $this->result[$result[0]]=$result[1];
        }else{
            $this->result=$result;
        }

    }
}