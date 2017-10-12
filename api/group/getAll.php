<?php
	require_once("../../fn/mysqli.php");
		$arrWhere=['group_uid'=>$uid];
		$sort=['group_sort'=>'DESC'];
		$result= mysql_get('groups','*',$arrWhere,$sort);
		echo '{"result":"success","msg":'.$result.'}';

?>