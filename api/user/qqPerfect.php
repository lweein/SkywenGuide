<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('name',$_POST)&&array_key_exists('pwd',$_POST)&&array_key_exists('phone',$_POST)&&array_key_exists('qq_id',$_POST)&&array_key_exists('key',$_POST)&&array_key_exists('nick',$_POST)&&array_key_exists('icon',$_POST)){
		if(check_account($_POST['name'])&&check_pwd($_POST['pwd'])&&check_phone($_POST['phone'])){	
			/*注册操作*/
			$arr=['user_name'=>$_POST['name'],'user_pwd'=>md5($_POST['pwd']),'user_phone'=>$_POST['phone'],'qq_id'=>$_POST['qq_id'],'user_nick'=>$_POST['nick'],'user_icon'=>$_POST['icon']];
			$result=mysql_add("user",$arr);
			/*↓登录操作*/
			$result2=mysql_get("user",['user_id','user_level','user_name'],['qq_id'=>$_POST['qq_id']],null);
			$result2=json_decode($result2);
			$result2[0]->user_token=md5($_POST['key'].md5($_POST['pwd']));
			echo '{"result":"success","msg":'.json_encode($result2).'}';
			$_SESSION['user']=$result2[0]->user_name;
			$_SESSION['uid']=$result2[0]->user_id;
			$_SESSION['ulv']=$result2[0]->user_level;
		}
		else{
			echo '{"result":"faild","msg":"参数错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"参数缺少"}';
	}
?>