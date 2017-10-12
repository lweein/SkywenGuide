<?php

	//require_once("../config/config.php");
   require_once("session.php");

	require_once("check.php");

	/*基本数据库方法*/



	function mysqli($sqlStr){

		$config_mysql=[

			"host"=>"rm-bp1upbg0o793720vg.mysql.rds.aliyuncs.com",  //数据库地址

			"user"=>"skywenn",				      //数据库账号

			"pwd"=>"zyx9brfHvPww6i",						  //数据库密码

			"db"=>"skywenn",					  //数据库选择
							  //数据库选择
		];

		$conn = mysqli_connect($config_mysql['host'],$config_mysql['user'],$config_mysql['pwd']);

		if(!$conn ){

			die('{"result":"faild","msg":"'.mysqli_error($conn).'"}');

		}

		mysqli_query($conn , "set names utf8");// 设置编码，防止中文乱码

		mysqli_select_db( $conn, $config_mysql['db'] );//进入nav数据库

		$result = mysqli_query($conn,$sqlStr );

		if(!$result){

			die('{"result":"faild","msg":"'.mysqli_error($conn).'"}');

		}

		mysqli_close($conn);

		return $result;

	}



	/*添加数据*/

	function mysql_add($table,$arr){//(表名，添加的数据数组)

			$strKey=$strVal='';

			foreach ($arr as $key=>$val) {  

				$strKey.="$key,";

				$strVal.="'$val',";

			} 

			$strKey=substr($strKey,0, -1);

			$strVal=substr($strVal,0, -1);

			$strSql="INSERT INTO $table ($strKey)VALUES($strVal)";

			$result=mysqli($strSql);

			return $result;

	}

	/*删除数据*/

	function mysql_del($table,$arrWhere){//(表名，删除的关键字数组)

		$strWhere='';

		foreach ($arrWhere as $key=>$val) {  

			$strWhere.=" $key='$val' AND";

		} 

		$strWhere=substr($strWhere,0, -3);

		$strSql="DELETE FROM $table WHERE $strWhere";

		$result=mysqli($strSql);

		return $result;

	}



	/*修改数据*/

	function mysql_upd($table,$arr,$arrWhere){//(表名，修改的数据数组，修改的关键字数组)

		$str=$strWhere='';

		foreach ($arr as $key=>$val) {  

			$str.="$key='$val',";

		}

		foreach ($arrWhere as $key=>$val) {  

			$strWhere.=" $key='$val' AND";

		}

		$str=substr($str,0, -1);

		$strWhere=substr($strWhere,0, -3);

		$strSql="UPDATE $table SET $str WHERE $strWhere";

		$result=mysqli($strSql);

		return $result;

	}

	

	/*查找数据*/

	function mysql_get($table,$arr,$arrWhere,$sort){//(表名，查找的显示列名，查找的关键字数组),查找的排序数组

		if(is_array($arr)){

			$str="";

			foreach ($arr as $val) {  

				$str.="$val,";

			}

			$str=substr($str,0, -1);

		}

		else{

			$str="*";

		}
		$strSql="SELECT $str FROM $table";
		if(isset($arrWhere)){
			$strWhere='';

			foreach ($arrWhere as $key=>$val) {  

				$strWhere.=" $key='$val' AND";

			}

			$strWhere=substr($strWhere,0, -3);

			$strSql.=" WHERE ".$strWhere;
		}
		if(isset($sort)){

			$strSort=' ORDER BY ';

			foreach ($sort as $key=>$val) {  

				if(!check_arr($sort)){//判断为索引数组

					$strSort.="$key $val,";

				}

				else{

					$strSort.="$val,";

				}

			}

			$strSort=substr($strSort,0, -1);

			$strSql.=$strSort;
		}
		$result=mysqli($strSql);

		$json=array();

			while ($rows=mysqli_fetch_array($result)){

			//while ($rows=mysqli_fetch_array($result,MYSQL_ASSOC)){

				$count=count($rows);//不能在循环语句中，由于每次删除 row数组长度都减小  

				for($i=0;$i<$count;$i++){  

					unset($rows[$i]);//删除冗余数据  

				}

				array_push($json,$rows);

			}

			mysqli_free_result($result);//释放数据

			return json_encode($json);

	}

?>