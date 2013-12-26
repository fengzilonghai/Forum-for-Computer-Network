<?php
	//Common
	include dirname(__FILE__) . '/common.php';

	define('TOKEN_LEN', 32);
	
	function generateRandomString($n) {
		return substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, $n);
	}

	function isEmail($email) {
		return preg_match('/^\w[\w_]*@\w[\w_\.]*[a-zA-Z]$/', $email) == 1 ? true : false;
	}

	$errInfo = array(
		'login' => array(
			'0' => '登陆成功',
			'1' => '用户名不存在',
			'2' => '密码错误',
			'3' => 'token过期'
		),
		'reg' => array(
			'0' => '注册成功',
			'1' => 'email不能为空',
			'2' => '用户名不能为空',
			'3' => '密码不能为空',
			'4' => 'email格式错误',
			'5' => '用户名已存在'
		)
	);

	$action = $_GET['action'];
	switch($action) {
		case 'login' : 
			$u = $_POST['u'];
			$p = $_POST['p'];
			$c = $_POST['c'];
			//Also verify token
			$token = $_COOKIE['v_token'];
			$tokenCached = $MC->get($u);
			
			//get user data
			$sql = "SELECT * FROM users WHERE username='$u'";
			$query = $DAO->query($sql);
			$result = $DAO->fetch($query);

			//echo 'password in database:'.$result['password'];
			//echo 'token in Cookie:'.$token.' token in cache:'.$tokenCached;
			//echo 'pwd posted:'.$p.' pwd calcued:'.md5(md5(md5($result['password'])) . $c);

			if($DAO->get_row_num($query) == 0) {
				$errCode = '1';
			} else if(md5(md5(md5($result['password'])) . $c) != $p) {
				$errCode = '2';
			} else if(empty($tokenCached)) {
				$errCode = '3';
			} else if($tokenCached == $token){
				$errCode = '0';
				$sql = "UPDATE users SET token='$tokenCached' WHERE username='$u'";
				$DAO->query($sql);
				$_SESSION['u'] = $u;
			}
		break;
		case 'reg' :
			$e = $_POST['e'];
			$u = $_POST['u'];
			$p = $_POST['p'];

			//get user data
			$sql = "SELECT * FROM users WHERE username='$u'";
			$query = $DAO->query($sql);
			$result = $DAO->fetch($query);

			if(empty($e)) {
				$errCode = '1';
			} else if(empty($u)) {
				$errCode = '2';
			} else if(empty($p)) {
				$errCode = '3';
			} else if(!isEmail($e)) {
				$errCode = '4';
			} else if($DAO->get_row_num($query) != 0) {
				$errCode = '5';
			} else {
				$errCode = '0';
				$r = time();
				$t = generateRandomString(TOKEN_LEN);
				//$DAO->ping();
				$sql = "INSERT INTO users (username,password,email,regtime,token,email_verified) VALUES('$u','$p','$e','$r','$t',0)";
				$query = $DAO->query($sql);
				setcookie('u_name', $u, time() + 3600 * 24);
				setcookie('v_token', $t, time() + 3600 * 24);
			}
		break;
	}

	$DAO->close();
	
	$ret = array(
		'errcode' => $errCode,
		'tip' => $errInfo[$action][$errCode]
	);
	echo json_encode($ret);

	//token作为登陆的密钥，而email验证的密钥通过password(、token)和regtime临时生成，这样token就不会被影响使用了
?>
