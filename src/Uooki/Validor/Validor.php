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
class Validor
{

    use ValidationTrait;

    public function __construct(){
        $this->_validation=new Validation();
    }


    /**
     * 单项验证数据
     *
     * @param $data
     * @param $rule
     */
    public  function  valid($data,$rule){

       $rule=$this->parseRule($rule);
       return  $this->_validation->valid($data,$rule)->result();
    }

    /**
     * 表单验证
     * @param $form
     * @param $rule
     */
    public function  validForm($form,$rule){
        //todo
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