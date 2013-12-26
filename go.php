<?php
	//Common
	include dirname(__FILE__) . '/common.php';

	//Category
	$category = $_GET['category'];
	
	include TEMPLATE . '/header.php';
	include TEMPLATE . '/category.php';
	include TEMPLATE . '/footer.php';
?>
