<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('gid',$_POST)){
		$arrWhere=['group_id'=>$_POST['gid'],'group_uid'=>$uid];
		$result=mysql_del("groups",$arrWhere);
		echo '{"result":"success","msg":"删除成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>