<?php   //文件上传
	require_once('../fn/session.php');
	require_once('../fn/var.php');
	if($_FILES&&array_key_exists('file',$_FILES)){
		if (($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/png")) 
		{ 
			if ($_FILES["file"]["error"] > 0) 
			{ 
				echo '{"result":"faild","msg":' . $_FILES["file"]["error"] .'"}';
			} 
			else 
			{ 
				//echo "名称: " . $_FILES["file"]["name"] . "<br />"; 
				//echo "类型: " . $_FILES["file"]["type"] . "<br />"; 
				//echo "大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />"; 
				//echo "缓存地址: " . $_FILES["file"]["tmp_name"] . "<br />"; 
				if (file_exists("img/" . $_FILES["file"]["name"])) 
				{ 
					echo '{"result":"faild","msg":"'.$_FILES["file"]["name"] . '文件已存在"}'; 
				} 
				else 
				{ 
					if (!file_exists("../data/".$uid)){//判断是否有用户id的文件夹
						mkdir ("../data/".$uid);
						mkdir ("../data/".$uid."/webIcon/");
					}
					$name=time().rand(10000,99999).".png";
					move_uploaded_file($_FILES["file"]["tmp_name"],"../data/".$uid."/webIcon/".$name); //移动文件
					echo '{"result":"success","msg":"'.$URL."/data/".$uid."/webIcon/".$name.'"}';
				} 
			} 
		} 
		else 
		{ 
			echo '{"result":"faild","msg":"上传失败"}';
		} 
	}
	else{
		echo '{"result":"faild","msg":"未接受到文件"}';
	}
?> 