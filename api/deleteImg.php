<?php   //文件上传
	require_once('../fn/session.php');
	require_once('../fn/var.php');
	if($_POST&&array_key_exists('icon',$_POST)){
		$name=$_POST['icon'];
		if($name==""){
		die('{"result":"faild","msg":"参数错误"}');
		}
		$route="../data/".$uid."/webIcon/";
		$file=$route.$name;
		if (file_exists($route)){//判断是否有用户id的文件夹
			if(file_exists($file)){
				unlink ($file);
				echo '{"result":"success","msg":"删除成功"}';
			}
			else{
				echo '{"result":"faild","msg":"文件不存在"}';
			}
		}
		else{
			echo '{"result":"faild","msg":"文件夹不存在"}';
		}
	}
?> 