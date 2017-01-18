<?php
/**
 * Created by PhpStorm.
 * User: uoouki
 * Date: 2017/1/15
 * Time: 17:34
 */

namespace Uooki\Validor;


trait ValidationTrait
{

     static  public  function name($name){
         //
         $valid = preg_match(ValidConst::REG_NAME, $name);
         return $valid;
     }

     static public function email($email){
         return (false===filter_var($email,FILTER_VALIDATE_EMAIL))?false:true;
     }

     static public function  phone($phone){
         $valid = preg_match(ValidConst::REG_PHONE, $phone);
         return $valid;
     }

     static  public function ip($ip){
         return (false===filter_var($ip,FILTER_VALIDATE_IP))?false:true;
     }
}