<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('qq_id',$_POST)&&array_key_exists('key',$_POST)){
		$arr=['user_name','user_level','user_id','user_pwd'];
		$arrWhere=['qq_id'=>$_POST['qq_id']];
		$result=mysql_get("user",$arr,$arrWhere,null);
		$result=json_decode($result);
		if(count($result)){//如果有数据则登陆操作
			$result[0]->user_token=md5($_POST['key'].$result[0]->user_pwd);
			echo '{"result":"success","event":"login","msg":'.json_encode($result).'}';
			$_SESSION['user']=$result[0]->user_name;
			$_SESSION['uid']=$result[0]->user_id;
			$_SESSION['ulv']=$result[0]->user_level;
		}
		else{//没有数据，注册操作并登陆
			echo '{"result":"success","event":"perfectOrBind","msg":"没有绑定用户"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"参数缺少"}';
	}
?>