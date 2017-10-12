<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('lid',$_POST)&&array_key_exists('name',$_POST)&&array_key_exists('sort',$_POST)&&array_key_exists('icon',$_POST)){
		$arr=['list_sort'=>$_POST['sort'],'list_name'=>$_POST['name'],'list_icon'=>$_POST['icon']];
		$arrWhere=['list_id'=>$_POST['lid'],'list_uid'=>$uid];
		$result=mysql_upd("list",$arr,$arrWhere);
		echo '{"result":"success","msg":"修改成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>