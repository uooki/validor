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
namespace  Uooki\validor\validation;


class validation
{

   const REG_NAME="";
	const REG_EMAIL="";
	const REG_PHONE="";
	const REG_IP="";
	const REG_URL="";

	public static function valid($type,$rule,$data){
	
	}

	protected function minStr($data,$len){
	
	}

   protected function maxStr($data,$len){
	   
	}

	protected function regular($data,$regex){
	
	}

	protected function same($data){
	
	}

	protected function unique($data,$table,$field){
	
	}

}
