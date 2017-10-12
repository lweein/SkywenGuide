<?php
	require_once("../../fn/mysqli.php");
	if($ulv>8){
		if($_POST&&array_key_exists('pwd',$_POST)&&array_key_exists('nick',$_POST)&&array_key_exists('phone',$_POST)&&array_key_exists('level',$_POST)&&array_key_exists('uid',$_POST)){
			$arr=['user_pwd'=>$_POST['pwd'],'user_nick'=>$_POST['nick'],'user_phone'=>$_POST['phone'],'user_level'=>$_POST['level']];
			$arrWhere=['user_id'=>$_POST['uid']];
			$result= mysql_upd('user',$arr,$arrWhere);
			echo '{"result":"success","msg":"修改成功"}';
		}
		else{
			echo '{"result":"faild","msg":"参数错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"权限限制"}';
	}
?>