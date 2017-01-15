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


class Validation extends  ValidationAbstract  implements  ValidationInterface
{

	protected  $data;
	protected  $rule;
	protected  $result;


	public function  __construct(){

	}

	public function getData(){


	}

	public function getRule(){


	}

	public function result(){
             return $this->result;
	}
	/**
	 * @param $data
	 * @return bool
     */
	protected  function  required($data){
		$nd=strval($data);
        $d=trim($nd);
		return  !empty($d);
     }

	/**
	 * @param $data
	 * @param $len
	 * @return bool
     */
	protected function min($data,$len){
		$length=mb_strlen($data,"UTF-8");
		return ($length>$len );
	}

	/**
	 * @param $data
	 * @param $len
	 * @return bool
     */
	protected function max($data,$len){

		 $length=mb_strlen($data,"UTF-8");  // 内部编码请统一使用UTF-8，设置项目内部编码为UTF-8 ：mb_internal_encoding("UTF-8");
		 return ($length<$len );

	}

	/**
	 * @param $data
	 * @param $regex
	 * @return int
     */
	protected function regular($data,$regex){
		// 正则验证
		$valid = preg_match($regex, $data);
		return $valid;
	}

	/**
	 * @param $first
	 * @param null $second
	 * @return bool
     */
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

	/**
	 * @param $data
	 * @param $connect
	 * @param $table
	 * @param $field
	 * @return bool
     */
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

	/**
	 * @param $data
	 * @return bool
     */
	public function email($data){
		return (false===filter_var($data,FILTER_VALIDATE_EMAIL))?false:true;
	}

	/**
	 * @param $rule
	 * @return mixed
	 *  ['require','regex:xxx','unique','same','min:xxx','functions:xxx|xxx|']
     */
	protected  function  parseRule($rule){
	  //
		   foreach($rule as &$v){
			   $is=strpos($v,":");
			   if(false!==$is){
				    $v[0]=substr($v,0,$is);
				    $v[1]=substr($v,$is+1);
			   }
		   }
		   unset($v);
           return $rule;
     }

	/**
	 * @param $val
	 * @param $rul
	 * @return object
     */
	public function valid($val,$rul){

		 $data=$val;
		 $rule=$this->parseRule($rul);
		 $result=new ValidResult($data);
		// 根据rule 调用不同的方法验证数据
		foreach($rule as $v){

			if(is_array($v)){

				$result->setRule($v[0]);
				$result->setStatus(true);

				// 使用指定的函数做验证
				if(ValidConst::VALID_RULE_CALLBACK===$v[0]){

					$callbacks=explode("|",$v[1]);
					$result->setParams($callbacks);
					foreach($callbacks as $v1){
						$temp = $this->$v1($data);
						$result->setStatus($temp);
						$result->setResult([$v1,$temp]);
					}

				}else{

					$temp = $this->$v[0]($data,$v[1]);
					$result->setStatus($temp);
					$result->setParams($v[1]);
					$result->setResult($temp);
				}
			}else{

                 $temp = $this->$v($data);
				 $result->setRule($v);
				 $result->setStatus($temp);
				 $result->setResult($temp);
			}
		}
		$this->result=$result;
		return  $this;

	}

}
