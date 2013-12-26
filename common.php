<?php
	//Configure
	include dirname(__FILE__) . '/config.php';
	
	//DAO
	include dirname(__FILE__) . '/include/DB.class.php';
	$DAO = DB::getInstance();
	$DAO->connect($Config['host'], $Config['port'], $Config['username'], $Config['password'], $Config['dbName'], $Config['dbCharset']);

	//Memcache
	require 'BaeMemcache.class.php';
	$MC = new BaeMemcache();
	
	//current user
	session_start();
	//from session
	if(isset($_SESSION['u'])) {
		$curUser = $_SESSION['u'];
		//echo 'From Session -> ';
	//by auth
	} else if(isset($_COOKIE['u_name']) && isset($_COOKIE['v_token'])) {
		$cu = $_COOKIE['u_name'];
		$ct = $_COOKIE['v_token'];
		$sql = "SELECT token FROM users WHERE username='$cu'";
		$result = $DAO->fetch($DAO->query($sql));
		if($result['token'] == $ct) {
			$_SESSION['u'] = $cu;
			$curUser = $cu;
			//echo 'By Auth -> ';
		} else {
			$curUser = '';
		}
		
	//null
	} else {
		$curUser = '';
	}
	//echo $curUser;

	//redirect .php to 404
	//$noRedirect = array('pass.php');
	//function redirect_filter($value) {
	//	if(strpos($_SERVER['REQUEST_URI'],$value)){
	//		return true;
	//	}
	//}
	//if(strpos($_SERVER['REQUEST_URI'], '.php') && count(array_filter($noRedirect, 'redirect_filter')) == 0) {
	//	header('location: /404');
	//}

	
	//if(strpos($_SERVER['REQUEST_URI'], '.php')) {
	//	header('location: /404');
	//}

?>
