<?php
	require_once("../../fn/mysqli.php");
	if($_POST&&array_key_exists('lid',$_POST)){
		$lid=$_POST['lid'];
		$str="SELECT * FROM web  LEFT JOIN groups ON web.web_gid=groups.group_id  WHERE web_uid='$uid' AND group_lid='$lid'  ORDER BY group_sort DESC,web_sort DESC";
		$result=mysqli($str);
		$arr=array();
		while ($rows=mysqli_fetch_array($result)){
			$count=count($rows);//不能在循环语句中，由于每次删除 row数组长度都减小  
			for($i=0;$i<$count;$i++){  
				unset($rows[$i]);//删除冗余数据  
			}
			array_push($arr,$rows);
		}
		mysqli_free_result($result);//释放数据
		echo '{"result":"success","msg":'. json_encode($arr).'}';
	}
	else{
		echo '{"result":"faild","msg":"参数错误"}';
	}
?>