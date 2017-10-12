<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('sort',$_POST)&&array_key_exists('name',$_POST)&&array_key_exists('gid',$_POST)&&array_key_exists('url',$_POST)&&array_key_exists('msg',$_POST)&&array_key_exists('icon',$_POST)){
		$arr=['web_sort'=>$_POST['sort'],'web_name'=>$_POST['name'],'web_gid'=>$_POST['gid'],'web_url'=>$_POST['url'],'web_msg'=>$_POST['msg'],'web_icon'=>$_POST['icon'],'web_uid'=>$uid];
		$result=mysql_add("web",$arr);
		echo '{"result":"success","msg":"添加成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>