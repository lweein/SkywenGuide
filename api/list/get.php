<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('lid',$_POST)){
		$arrWhere=['list_id'=>$_POST['lid'],'list_uid'=>$uid];
		$sort=['list_sort'=>'DESC'];
		$result= mysql_get('list','*',$arrWhere,$sort);
		echo '{"result":"success","msg":'.$result.'}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>