<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('wid',$_POST)){
		$arrWhere=['web_id'=>$_POST['wid'],'web_uid'=>$uid];
		$sort=['web_sort'=>'DESC'];
		$result= mysql_get('web','*',$arrWhere,$sort);
		echo '{"result":"success","msg":'.$result.'}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>