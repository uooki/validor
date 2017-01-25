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


    // 存储最终结果
    public $result;
    /**
     * @var
     */
    public $status=true;
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
     * 存储最近一次进行单项验证的结果
     */
    protected $lastResult;

    // 表单标记
    private $formFlag=false;

    /**
     * @param $result
     * @param $data
     * @param $rule
     */
    public function  __construct($result,$data,$rule){

        $this->data=$data;
        $this->rule=$rule;
        $len=count($result);
        if(isset($result[0])&&(1==$len)){
            $this->setStatus($result[0]['status']);
            $this->setResult($result[0]['data']);
        }else{
            $this->setResult($result);
            foreach($result as $k=>$v){
                 if(false===$v['status']){
                     $this->setStatus(false);
                     break;
                 }
            }
        }
    }

    /**
     * @param $status
     */
    public function  setStatus($status){
          // true or false
          $this->status=$status;
    }

    public  function  getResult(){
        return $this->result;
    }
    public  function setResult($result){

         return  $this->result=$result;
    }

    public  function  conventToFormResult($key=null){
    }
    /**
     * @param $result
     */
    public function setLastResult($result){
         $this->lastResult=$result;
    }

    public function  getLastResult(){

          return $this->lastResult;
    }




}