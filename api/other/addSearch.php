<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('name',$_POST)&&array_key_exists('url',$_POST)){
		$arr=['search_name'=>$_POST['name'],'search_url'=>$_POST['url']];
		$result=mysql_add("search",$arr);
		echo '{"result":"success","msg":"添加成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>