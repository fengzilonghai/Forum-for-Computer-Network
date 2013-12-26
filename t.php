<?php
	//Common
	include dirname(__FILE__) . '/common.php';

	//tid
	$tid = $_GET['tid'];
	
	include TEMPLATE . '/header.php';
	include TEMPLATE . '/article.php';
	include TEMPLATE . '/footer.php';
?>
