<?php
/*
* 库功能实现代码
* 我希望还能提供一组api ,用户使用这组api 来调用库，而不是直接调用库
* 类似于laravel 为自己的核心组件提供的那组API
*
* 使用一个门面类到是可以做到隐藏库功能细节的目的，那就使用门面吧：
*
* validor， helper功能各使用一个门面类来给外界调用  
*
*
*/
namespace Uooki\Validor;


class Validation extends ValidationAbstract implements ValidationInterface
{


    protected $data;
    protected $rule;
    protected $result;

    public function  __construct()
    {

    }

    public function getData()
    {


    }

    public function getRule(){


    }
    public function result()
    {
        return $this->getResult();
    }
    public function getResult()
    {
        return $this->result;
    }
    /**
     * @param $data
     * @return bool
     */
    protected function  required($data)
    {
        $nd = strval($data);
        $d = trim($nd);
        return !empty($d);
    }

    /**
     * @param $data
     * @param $len
     * @return bool
     */
    protected function min($data, $len)
    {
        $length = mb_strlen($data, "UTF-8");
        return ($length >= $len);
    }

    /**
     * @param $data
     * @param $len
     * @return bool
     */
    protected function max($data, $len)
    {
        //内部编码请统一使用UTF-8，设置项目内部编码为UTF-8 ：mb_internal_encoding("UTF-8");
        $length = mb_strlen($data, "UTF-8");
        return ($length < $len);
    }

    /**
     * @param $data
     * @param $regex
     * @return int
     */
    protected function regular($data, $regex)
    {
        // 正则验证
        $valid = preg_match($regex, $data);
        return $valid ? true : false;
    }

    /**
     * @param $first
     * @param null $second
     * @return bool
     */
    protected function same($first, $second = null)
    {

        if (is_array($first)) {
            $flag = true;
            foreach ($first as $v) {
                if ($first[0] !== $v) {
                    $flag = false;
                }
            }
            return $flag;
        } else {
            return ($first === $first);
        }
    }

    /**
     * @param $data
     * @param $connect
     * @param $table
     * @param $field
     * @return bool
     */
    protected function unique($data, $connect, $table, $field)
    {
        $sql = "select * from " . $table . " where " . $field . "='" . $data . "' ";

        $flag = true;
        if ($result = $connect->query($sql)) {
            if ($result->num_rows > 0) {
                $flag = false;
            }
            $result->close();
        }
        return $flag;
    }

    /**
     * @param $data
     * @return bool
     */

    public function email($data)
    {
        return (false === filter_var($data, FILTER_VALIDATE_EMAIL)) ? false : true;
    }

    /**
     * @param $val
     * @param $rule
     * @return object
     *
     *
     */
    public function valid($val, $rule)
    {
        $data = $val;
        $result = new ValidResult($data, $rule);
        // 根据rule 调用不同的方法验证数据
        foreach ($rule as $v) {
            if (is_array($v)) {
                // 使用指定的函数做验证
                if (ValidConst::VALID_RULE_CALLBACK === $v[0]) {
                    $callbacks = explode("|", $v[1]);
                    foreach ($callbacks as $v1) {
                        $temp = $this->$v1($data);
                        if (!$temp) {
                            $result->setStatus($temp);
                        }
                        $result->setResult([ValidConst::VALID_RULE_CALLBACK, [$v1 => $temp]]);
                    }
                } else {
                    $temp = $this->$v[0]($data, $v[1]);
                    if (!$temp) {
                        $result->setStatus($temp);
                    }
                    $result->setResult([$v[0], $temp]);
                }
            } else {
                $temp = $this->$v($data);
                if (!$temp) {
                    $result->setStatus($temp);
                }
                $result->setResult([$v, $temp]);
            }
        }
        $this->result = $result;
        return $this;

    }

    protected  function setResult($value){
         $this->result=$value;
    }

    protected  function  addResult($data){
         $this->result[]=$data;
    }

    protected  function conventToFormResult($k){

        // 存储的单项结果转换为表单结果
        $res=$this->getResult();

        $this->setResult(null);
        $this->addResult([$k=>$res]);
    }

    public function validForm($rule,$form){

        $data=empty($form)?$_POST:$form;

        foreach($data as $k=>$v){
             if(isset($rule[$k])){
                  $this->valid($v,$rule[$k])->conventToFormResult($k);
             }
        }
        return $this;

    }

}
