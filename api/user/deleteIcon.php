<?php
	require_once()
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('pwd',$_POST)){
		if(array_key_exists('phone',$_POST)){
			$arr=['user_id','user_level'];
			$arrWhere=['user_phone'=>$_POST['phone'],'user_pwd'=>$_POST['pwd']];
		}
		else if(array_key_exists('name',$_POST)){
			$arr=['user_id','user_level'];
			$arrWhere=['user_name'=>$_POST['name'],'user_pwd'=>$_POST['pwd']];
		}
		else{
			die('{"result":"faild","msg":"参数错误"}');
		}
		$result=mysql_get("user",$arr,$arrWhere,null);
		echo '{"result":"success","msg":'.$result.'}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
	
?>