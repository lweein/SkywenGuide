<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('pwd',$_POST)&&array_key_exists('key',$_POST)){
		$arr=['user_id','user_level','user_name'];
		if(array_key_exists('phone',$_POST)){
			$arrWhere=['user_phone'=>$_POST['phone'],'user_pwd'=>md5($_POST['pwd'])];
		}
		else if(array_key_exists('name',$_POST)){
			$arrWhere=['user_name'=>$_POST['name'],'user_pwd'=>md5($_POST['pwd'])];
		}
		else{
			die('{"result":"faild","msg":"参数错误"}');
		}
		$result=mysql_get("user",$arr,$arrWhere,null);
		$result=json_decode($result);
		if(count($result)){
			$result[0]->user_token=md5($_POST['key'].md5($_POST['pwd']));
			echo '{"result":"success","msg":'.json_encode($result).'}';
			$_SESSION['user']=$result[0]->user_name;
			$_SESSION['uid']=$result[0]->user_id;
			$_SESSION['ulv']=$result[0]->user_level;
		}
		else{
			echo '{"result":"falid","msg":"帐号密码错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>