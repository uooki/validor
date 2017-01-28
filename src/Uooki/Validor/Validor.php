<?php
/**
 *  This is a set of API for validor , The user call validor by this API.
 *  Just like laravel's API  or composer's API.
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
class Validor
{

    use ValidationTrait;

    /**
     * @var
     */
    protected  $result;

    //static protected  $_validation;

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
     *  valid  single data
     *
     * @param $data   ['field1'=>'val1','field2'=>'val2','field3'=>'val3']
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
     *  valid form
     *
     * @param $form
     * @param $rule
     * @return mixed
     */
    public function  validForm($rule,$form=null){

        // According to the form's field name to look up "rule".
        // If no match is found in the "rule"  , will return an error.
        foreach($rule as $k=>$v){
            $rule[$k]=$this->parseRule($v);
        }
        $result = $this->_validation->validForm($rule,$form);
        $this->setResult($result);
        return $this;
    }

    /**
     * @param $rule  ['require','regex:xxx','unique','same','min:xxx','functions:xxx1|xxx2|xxx3|...']
     * @return mixed
     *
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