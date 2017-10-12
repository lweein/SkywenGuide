<?php
	require_once("../../fn/mysqli.php");
	if($ulv>8){
		$result= mysql_get('user','*',null,null);
		echo '{"result":"success","msg":'.$result.'}';
	}
	else{
		echo '{"result":"falid","msg":"权限限制"}';
	}
?>