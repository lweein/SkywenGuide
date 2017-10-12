<?php
	require_once('mysqli.php');
	function getGroup($uid){
		$str="SELECT * FROM groups WHERE group_uid='$uid' ORDER BY group_sort DESC";
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
		return json_encode($arr);		
	}

	function getList($uid){
		$str="SELECT * FROM list WHERE list_uid='$uid' ORDER BY list_sort DESC";
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
		$first_lid=empty($arr)?null:$arr[0]['list_id'];
		$obj=["first_lid"=>$first_lid,"data"=>$arr];
		return  json_encode($obj);
	}
	
	function getSeo(){
		$result=mysql_get('seo',"*",['id'=>1],null);
		return json_decode($result)[0]
			;
	}
	
?>