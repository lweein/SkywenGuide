<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('lid',$_POST)){
		$arrWhere=['list_id'=>$_POST['lid'],'list_uid'=>$uid];
		$result=mysql_del("list",$arrWhere);
		echo '{"result":"success","msg":"删除成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>