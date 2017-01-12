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
namespace  Uooki\Validor;


class Validation extends  AbstractValidation  implements  ValidationInterface
{

	protected  function  required($data){
		$nd=strval($data);
        $d=trim($nd);
		return  !empty($d);
     }

	protected function min($data,$len){
		$length=mb_strlen($data,"UTF-8");
		return ($length>$len );
	}

	protected function max($data,$len){

		 $length=mb_strlen($data,"UTF-8");  // 内部编码请统一使用UTF-8，设置项目内部编码为UTF-8 ：mb_internal_encoding("UTF-8");
		 return ($length<$len );

	}

	protected function regular($data,$regex){
		// 正则验证
		$valid = preg_match($regex, $data);
		return $valid;
	}

	protected function same($first,$second=null){

		if(is_array($first)){
			$flag=true;
			foreach($first as $v){
				if($first[0]!==$v){
					$flag=false;
				}
			}
			return $flag;
		}else{
			return ($first === $first);
		}
	}

	protected function unique($data,$connect,$table,$field){


		  $sql="select * from ".$table." where ".$field."='".$data."' ";

		 $flag=true;
		 if($result=$connect->query($sql)){
			 if($result->num_rows>0){
				 $flag=false;
			 }
			 $result->close();
		 }
		 return $flag;
	}

	public function email($data){
		return (false===filter_var($data,FILTER_VALIDATE_EMAIL))?false:true;
	}

	protected  function  parseRule($rule){
	  //  ['require','regex:xxx','unique','same','min:xxx']

		   foreach($rule as &$v){
			   if(is_array($v)){
				    $v=explode(":",$v);
			   }
		   }
		   unset($v);
           return $rule;
     }

	function __call($name,$args){

		 $data=$args[0];
		 $rule=$this->parseRule($args[1]);


		// 根据rule 调用不同的方法验证数据
		foreach($rule as $v){
			if(is_array($v)){
				$this->$v[0]($data,$v[1]);
			}else{
				$this->$v($data);
			}
		}

		/*
         switch ($name){

             case ValidConst::VALID_TYPE_NAME:



                // $this->_validation->username($data,$rule);
                 break;
             case ValidConst::VALID_TYPE_EMAIL:

				  $this->email($data);
                 break;
             case ValidConst::VALID_TYPE_PHONE:
                 break;
             case ValidConst::VALID_TYPE_PWD:
                 break;
             case ValidConst::VALID_TYPE_REPWD:
                 break;
             default:

                 break;
         }
*/
	}

}
