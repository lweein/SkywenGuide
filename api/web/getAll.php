<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('gid',$_POST)){
		$arrWhere=['web_gid'=>$_POST['gid'],'web_uid'=>$uid];
		$sort=['web_sort'=>'DESC'];
		$result= mysql_get('web','*',$arrWhere,$sort);
		echo '{"result":"success","msg":'.$result.'}';
	}
	else{
		echo '{"result":"faild","msg":"²ÎÊý´íÎó"}';
	}
?>