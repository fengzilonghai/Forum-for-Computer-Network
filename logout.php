<?php
	session_start();
	unset($_SESSION['u']);
	setcookie('u_name', $u, time() - 3600 * 24);
	setcookie('v_token', $t, time() - 3600 * 24);
	$ret = array(
		'errcode' => '0',
		'tip' => '登出成功'
	);
	echo json_encode($ret);
?>

