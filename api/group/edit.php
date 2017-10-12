<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('gid',$_POST)&&array_key_exists('name',$_POST)&&array_key_exists('sort',$_POST)&&array_key_exists('lid',$_POST)&&array_key_exists('icon',$_POST)){
		$arr=['group_sort'=>$_POST['sort'],'group_name'=>$_POST['name'],'group_lid'=>$_POST['lid'],'group_icon'=>$_POST['icon']];
		$arrWhere=['group_id'=>$_POST['gid'],'group_uid'=>$uid];
		$result=mysql_upd("groups",$arr,$arrWhere);
		echo '{"result":"success","msg":"修改成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>