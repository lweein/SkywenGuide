<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('sort',$_POST)&&array_key_exists('name',$_POST)&&array_key_exists('icon',$_POST)){
		$arr=['list_sort'=>$_POST['sort'],'list_name'=>$_POST['name'],'list_icon'=>$_POST['icon'],'list_uid'=>$uid];
		$result=mysql_add("list",$arr);
		echo '{"result":"success","msg":"添加成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>