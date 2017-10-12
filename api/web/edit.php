<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('wid',$_POST)&&array_key_exists('name',$_POST)&&array_key_exists('url',$_POST)&&array_key_exists('icon',$_POST)&&array_key_exists('msg',$_POST)&&array_key_exists('sort',$_POST)&&array_key_exists('gid',$_POST)){
		$arr=['web_name'=>$_POST['name'],'web_url'=>$_POST['url'],'web_icon'=>$_POST['icon'],'web_msg'=>$_POST['msg'],'web_sort'=>$_POST['sort'],'web_gid'=>$_POST['gid']];
		$arrWhere=['web_id'=>$_POST['wid'],'web_uid'=>$uid];
		$result=mysql_upd("web",$arr,$arrWhere);
		echo '{"result":"success","msg":"修改成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>