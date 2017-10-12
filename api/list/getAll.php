<?php
	require_once("../../fn/mysqli.php");
	$arrWhere=['list_uid'=>$uid];
	$sort=['list_sort'=>'DESC'];
	$result= mysql_get('list','*',$arrWhere,$sort);
	echo '{"result":"success","msg":'.$result.'}';
?>