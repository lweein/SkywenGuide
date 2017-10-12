<?php
	/*验证手机号*/
	function check_phone($tel){
		return preg_match('/^0?(13|14|15|17|18)[0-9]{9}$/', $tel);
	}
	/*验证账号*/
	function check_account($act){
		return preg_match('/^[a-zA-Z][a-zA-Z0-9\d_]{0,15}$/', $act);
	}
	/*验证密码*/
	function check_pwd($pwd){
		return preg_match('/^[a-zA-Z\d_]{6,20}$/', $pwd);
	}
	/*判断数组类型*/
	function check_arr($array) {
        if(is_array($array)) {
			$keys = array_keys($array);
            return $keys != array_keys($keys);
        }
        return  false;
    }
?>