<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('sid',$_POST)){
		$arrWhere=['search_id'=>$_POST['sid']];
		$result=mysql_del("search",$arrWhere);
		echo '{"result":"success","msg":"删除成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>