<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('wid',$_POST)){
		$arrWhere=['web_id'=>$_POST['wid'],'web_uid'=>$uid];
		$result=mysql_del("web",$arrWhere);
		echo '{"result":"success","msg":"删除成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>