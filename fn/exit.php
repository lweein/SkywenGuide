<?php
	session_start();
	$_SESSION['uid']=1;
	$_SESSION['ulv']=0;
	$_SESSION['user']=null;
		//กýฬ๘ืชาณรๆ
	$url="../index.php"; 
	Header("HTTP/1.1 303 See Other"); 
	Header("Location: $url"); 
	exit; 
?>