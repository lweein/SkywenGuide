<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('uid',$_POST)&&array_key_exists('key',$_POST)&&array_key_exists('token',$_POST)){
		$arr=['user_pwd','user_level','user_name','user_id'];
		$arrWhere=['user_id'=>$_POST['uid']];
		$result=mysql_get("user",$arr,$arrWhere,null);
		$result=json_decode($result);
		$token=md5($_POST['key'].$result[0]->user_pwd);
		if(count($result)&&$_POST['token']==$token){
			echo '{"result":"success","msg":'.json_encode($result).'}';
			$_SESSION['user']=$result[0]->user_name;
			$_SESSION['uid']=$result[0]->user_id;
			$_SESSION['ulv']=$result[0]->user_level;
		}
		else{
			echo '{"result":"falid","msg":"口令错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>