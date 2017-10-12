<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('name',$_POST)&&array_key_exists('pwd',$_POST)&&array_key_exists('phone',$_POST)){
		if(check_account($_POST['name'])&&check_pwd($_POST['pwd'])&&check_phone($_POST['phone'])){	
			$arr=['user_name'=>$_POST['name'],'user_pwd'=>md5($_POST['pwd']),'user_phone'=>$_POST['phone']];
			$result=mysql_add("user",$arr);
			echo '{"result":"success"}';
		}
		else{
			echo '{"result":"faild","msg":"参数错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"参数缺少"}';
	}
?>