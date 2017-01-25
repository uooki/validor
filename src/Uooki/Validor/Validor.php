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


/**
 * Class Validor
 * @package Uooki\Validor
 */
/**
 * Class Validor
 * @package Uooki\Validor
 */
class Validor
{

    use ValidationTrait;

    /**
     * @var
     */
    protected  $result;

    /**
     *
     */
    public function __construct(){
        $this->_validation=new Validation();
    }

    /**
     * @return mixed
     */
    protected function getResult()
    {
        return $this->result;
    }

    /**
     * @param $result
     */
    protected  function  setResult($result){

        $this->result=$result;
    }

    /**
     * @return mixed
     */
    public function result()
    {
        return $this->getResult()->getResult();
    }

    /**
     * @return mixed
     */
    public  function resultAll(){

        return  $this->getResult();
    }
    /**
     * 单项验证数据
     *
     * @param $data
     * @param $rule
     * @return mixed
     */
    public  function  valid($data,$rule){
        $rule=$this->parseRule($rule);
        $result=$this->_validation->validSingle($data,$rule);
        $this->setResult($result);
        return $this;
    }

    /**
     * 表单验证
     * @param $form
     * @param $rule
     * @return mixed
     */
    public function  validForm($rule,$form=null){
        //根据form 字段名 匹配到rule ,若没有皮匹配到，则返回错误
        foreach($rule as $k=>$v){
            $rule[$k]=$this->parseRule($v);
        }
        $result = $this->_validation->validForm($rule,$form);
        $this->setResult($result);
        return $this;
    }

    /**
     * @param $rule
     * @return mixed
     *  ['require','regex:xxx','unique','same','min:xxx','functions:xxx|xxx|']
     */
    protected  function  parseRule($rule){
        //
        foreach($rule as $k=>$v){
            $is=strpos($v,":");
            if(false!==$is){
                $rule[$k]=[substr($v,0,$is),substr($v,$is+1)];
            }
        }
        return $rule;
    }


}