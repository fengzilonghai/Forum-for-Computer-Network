<?php
	//set default timezone
	date_default_timezone_set('PRC');

	//URL & Path
	define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
	define('TEMPLATE', ROOT . 'templates' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR);
	define('STATIC', ROOT . 'static' . DIRECTORY_SEPARATOR);

	//Site Info
	define('HOST', (empty($_SERVER["HTTPS"]) || $_SERVER['HTTPS'] == 'off' ? 'http://' : 'https://') . $_SERVER['HTTP_HOST']);
	define('SITE_NAME', 'Forum for Computer Network');

	//Database Configure
	$Config['host'] = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
	$Config['port'] = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
	$Config['username'] = getenv('HTTP_BAE_ENV_AK');
	$Config['password'] = getenv('HTTP_BAE_ENV_SK');
	$Config['dbName'] = 'qvkBdQpGfCmZyGXzsIss';
	$Config['dbCharset'] = 'utf8';
?>
