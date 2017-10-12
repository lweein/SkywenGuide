<?php
	require_once("../../fn/mysqli.php");
	if($ulv>8){
		if($_POST&&array_key_exists('keywords',$_POST)&&array_key_exists('description',$_POST)){
			$arr=['keywords'=>$_POST['keywords'],'description'=>$_POST['description']];
			$arrWhere=['id'=>1];
			$result= mysql_upd('seo',$arr,$arrWhere);
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