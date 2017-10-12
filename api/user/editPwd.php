<?php

	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('pwd',$_POST)&&array_key_exists('npwd',$_POST)){
		$arrWhere=['user_id'=>$uid];
		$arr=['user_pwd'];
		$result= mysql_get('user',$arr,$arrWhere,null);
		$result=json_decode($result);
		if(count($result)){
			$pwd= $result["0"]->user_pwd;//原加密密码
			if($pwd==md5($_POST['pwd'])){
				if(check_pwd($_POST['npwd'])){
					$arr2=['user_pwd'=>md5($_POST['npwd'])];
					$result=mysql_upd('user',$arr2,$arrWhere);
					echo '{"result":"success","msg":"修改成功"}';
				}
				else{
					echo '{"result":"faild","msg":"新密码格式有误"}';	
				}
			}
			else{
				echo '{"result":"faild","msg":"原密码输入有误"}';
			}
		}
		else{
			echo '{"result":"faild","msg":"无此账号"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';

	}
?>