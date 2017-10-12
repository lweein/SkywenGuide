<?php
	require_once("../../fn/mysqli.php");
	if($ulv>8){
		$arr=["user_id","user_name","user_nick","user_phone","user_level","user_time"];
		$result= mysql_get('user',$arr,null,null);
		echo '{"result":"success","msg":'.$result.'}';
	}
	else{
		echo '{"result":"falid","msg":"权限限制"}';
	}
?>