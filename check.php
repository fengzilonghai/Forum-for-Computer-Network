<?php
	//Common
	include dirname(__FILE__) . '/common.php';

	define('TOKEN_LEN', 32);
	define('FACTOR_LEN', 4);
	define('EXPIRE_TIME', 3600);

	function generateRandomString($n) {
		return substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, $n);
	}
	
	//user
	if(isset($_GET['u']) && !empty($_GET['u'])){
		$user = $_GET['u'];
		//generate
		$token = generateRandomString(TOKEN_LEN);
		$factor = generateRandomString(FACTOR_LEN);
		//cache new token before auth. update token in database when authed
		$MC->delete($user);
		$MC->set($user, $token, 0, 3600);
		setcookie('u_name', $user, time() + 3600 * 24);
		setcookie('v_token', $token, time() + 3600 * 24);
		setcookie('e_code', $factor, time() + 3600 * 24);
	}
	
	//when verified, username and token will be used as user authority without verifying password 
?>
