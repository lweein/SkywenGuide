<?php
	require_once("../../fn/mysqli.php");
	if($ulv>8){
		if($_POST&&array_key_exists('sid',$_POST)&&array_key_exists('name',$_POST)&&array_key_exists('url',$_POST)){
			$arr=['search_name'=>$_POST['name'],'search_url'=>$_POST['url']];
			$arrWhere=['search_id'=>$_POST['sid']];
			$result= mysql_upd('search',$arr,$arrWhere);
			echo '{"result":"success","msg":"修改成功"}';
		}
		else{
			echo '{"result":"faild","msg":"参数错误"}';
		}
	}
	else{
		echo '{"result":"faild","msg":"权限限制"}';
	}
?>