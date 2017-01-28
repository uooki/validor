<?php
/*
*  Here is validot library bussiess code .
*
*/
namespace Uooki\Validor;


/**
 * Class Validation
 * @package Uooki\Validor
 */
class Validation extends ValidationAbstract implements ValidationInterface
{

    /**
     * @var
     */
    protected $data;
    /**
     * @var
     */
    protected $rule;
    /**
     * @var
     */
    protected $result;

    /**
     *
     */
    public function  __construct(){}
    /**
     *
     */
    public function getData(){}

    /**
     *
     */
    public function getRule(){}

    /**
     * @param $data
     * @return bool
     */
    protected function  required($data)
    {
        return !empty($data);
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
     * @param $config
     * @return mixed
     */
    protected function unique($data, $config)
    {
        $table=$config['table'];
        $field=$config['field'];
        $host=$config['host'];
        $user=$config['username'];
        $pwd=$config['pwd'];
        $db=$config['db'];
        $port=is_int($config['port'])?$config['port']:3306;

        $connect = new \mysqli($host,$user,$pwd,$db,$port);

        /* check connection */
        if ($connect->connect_errno) {
            printf("Connect failed: %s\n", $connect->connect_error);
            exit();
        }
        $sql = "select * from ".$table."  where  ".$field."='".$data."'";
        $flag=null;
        /* Select queries return a resultset */
        if ($result = $connect->query($sql)) {
            $flag=($result->num_rows > 0)?false:true;
            $result->close();
        }
        $connect->close();
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
     */
    protected function valid($val, $rule)
    {
        $data = trim($val);
        $result =['status'=>true];
        // According to  the rules  to call different functions for valid corresponding data.
        foreach ($rule as $v) {
            if (is_array($v)) {
                // To use corresponding function
                if (ValidConst::VALID_RULE_CALLBACK === $v[0]) {
                    $callbacks = explode("|", $v[1]);
                    foreach ($callbacks as $v1) {
                        $temp = $this->$v1($data);
                        if (!$temp) {
                            $result['status']=$temp;
                        }
                        $result['data'][ValidConst::VALID_RULE_CALLBACK][]= [$v1 => $temp];
                    }
                } else {
                    $temp = $this->$v[0]($data, $v[1]);
                    if (!$temp) {
                        $result['status']=$temp;
                    }
                    $result['data'][$v[0]]=$temp;
                }
            } else {
                $temp = $this->$v($data);
                if (!$temp) {
                    $result['status']=$temp;
                }
                $result['data'][$v]=$temp;
            }
        }
        return $result;

    }

    /**
     * @param $val
     * @param $rule
     * @return ValidResult
     */
    public function  validSingle($val, $rule){

           $res[]=$this->valid($val,$rule);
           $result = new ValidResult($res,$val,$rule);
           return  $result;
    }

    /**
     * @param $rule
     * @param $form
     * @return ValidResult
     */
    public function validForm($rule,$form){

        $data=empty($form)?$_POST:$form;
        $res=[];
        foreach($data as $k=>$v){
             if(isset($rule[$k])){
                 $res[$k] = $this->valid($v,$rule[$k]);
             }
        }
        $result = new ValidResult($res,$data,$rule);
        return $result;

    }

}
