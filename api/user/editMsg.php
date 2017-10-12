<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('nick',$_POST)&&array_key_exists('birthday',$_POST)&&array_key_exists('degree',$_POST)&&array_key_exists('company',$_POST)&&array_key_exists('sex',$_POST)&&array_key_exists('area',$_POST)&&array_key_exists('school',$_POST)&&array_key_exists('work',$_POST)){
		$arr=['user_nick'=>$_POST['nick'],'user_birthday'=>$_POST['birthday'],'user_degree'=>$_POST['degree'],'user_company'=>$_POST['company'],'user_sex'=>$_POST['sex'],'user_area'=>$_POST['area'],'user_school'=>$_POST['school'],'user_work'=>$_POST['work']];
		$arrWhere=['user_id'=>$uid];
		$result=mysql_upd('user',$arr,$arrWhere);
		$result=json_decode($result);
		echo '{"result":"success","msg":"修改成功"}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>