<?php
	require_once("../../fn/mysqli.php");
		$result= mysql_get('search','*',null,null);
		echo '{"result":"success","msg":'.$result.'}';

?>