<?php
	//Common
	include dirname(__FILE__) . '/common.php';
	
	//$sql = 'SELECT * FROM users';
	//$ret = $DAO->fetch($DAO->query($sql));
	//$DAO->close();
	//var_dump($ret);
	//echo '<br />succeed';

	if(isset($_GET['tab'])){
		$tab = $_GET['tab'];
	} else {
		$tab = 'newest';
	}

	include TEMPLATE . '/header.php';
	include TEMPLATE . '/index.php';
	include TEMPLATE . '/footer.php';
?>
