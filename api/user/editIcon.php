<?php

	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('icon',$_POST)){
		
		$arr=['user_icon'=>$_POST['icon']];
		$arrWhere=['user_id'=>$uid];
		$result=mysql_upd('user',$arr,$arrWhere);
		$result=json_decode($result);
		echo '{"result":"success","msg":"修改成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>