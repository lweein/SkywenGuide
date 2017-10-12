<?php
	require_once("../../fn/mysqli.php");
	if($ulv>8){
		if($_POST&&array_key_exists('name',$_POST)&&array_key_exists('phone',$_POST)&&array_key_exists('email',$_POST)&&array_key_exists('pwd',$_POST)&&array_key_exists('level',$_POST)){
			if(check_account($_POST['name'])&&check_pwd($_POST['pwd'])&&check_phone($_POST['phone'])){
				$arr=['user_name'=>$_POST['name'],'user_phone'=>$_POST['phone'],'user_email'=>$_POST['email'],'user_pwd'=>$_POST['pwd'],'user_level'=>$_POST['level']];
				$result=mysql_add("user",$arr);
				echo '{"result":"success","msg":"添加成功"}';
			}
			else{
				echo '{"result":"faild","msg":"参数格式错误"}';
			}
		}
		else{
			echo '{"result":"faild","msg":"参数错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"权限问题"}';
	}
?>