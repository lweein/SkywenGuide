<?php
	session_start();
	if($_SESSION){
		$uid=$_SESSION['uid'];
		$ulv=$_SESSION['ulv'];
	}
	else{
		$uid=1;
		$ulv=0;
	}
?>