<?php
	require_once("../../fn/mysqli.php");
	if($ulv>8){
		if($_POST&&array_key_exists('uid',$_POST)){
			$arrWhere=['user_id'=>$_POST['uid']];
			$result=mysql_del("user",$arrWhere);
			echo '{"result":"success","msg":"删除成功"}';
		}
		else{
			echo '{"result":"faild","msg":"参数错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"权限限制"}';
	}
?>