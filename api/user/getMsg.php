<?php
	require_once("../../fn/mysqli.php");
		$arrWhere=['user_id'=>$uid];
		$arr=['user_nick','user_icon'];
		$result= mysql_get('user',$arr,$arrWhere,null);
		echo '{"result":"success","msg":'.$result.'}';
?>