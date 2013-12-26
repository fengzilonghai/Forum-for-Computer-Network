<?php
	//Common
	include dirname(__FILE__) . '/common.php';

	$errInfo = array(
		'article' => array(
			'0' => '发表成功',
			'1' => '话题不存在',
			'2' => '未登录'
		),
		'reply' => array(
			'0' => '发表成功',
			'1' => '帖子不存在',
			'2' => '目标回复不存在',
			'3' => '未登录'
		)
	);
	//Article or Reply
	$type = $_GET['type'];
	switch($type) {
		case 'article' :
			$subTopic = $_POST['st'];
			$sql = "SELECT * FROM topics WHERE s_topic='$subTopic'";
			$ret = $DAO->fetch($DAO->query($sql));
			if(!$ret['f_topic']){
				$errCode = '1';
			} else if($curUser == '') {
				$errCode = '2';
			} else {
				$errCode = '0';
				$fatherTopic = $ret['f_topic'];
				$author = $curUser;
				$title = $_POST['t'];
				$content = $_POST['c'];
				$time = time();
				$sql = "INSERT INTO articles (f_topic,s_topic,author_name,post_time,post_title,post_content) VALUES('$fatherTopic','$subTopic','$author','$time','$title','$content')";
				$DAO->query($sql);
			}
		break;
		case 'reply' :
			$tid = $_POST['tid'];
			$replyto = $_POST['replyto'];
			$content = $_POST['c'];
			$sql = "SELECT * FROM articles WHERE tid='$tid'";
			$tidret = $DAO->fetch($DAO->query($sql));
			$sql = "SELECT * FROM replys WHERE reply_id='$replyto'";
			$ridret = $DAO->fetch($DAO->query($sql));
			if(!$tidret){
				$errCode = '1';
			} else if(!$ridret && $replyto != '-1') {
				$errCode = '2';
			} else if($curUser == ''){
				$errCode = '3';
			} else {
				$time = time();
				$sql = "INSERT INTO replys (tid,reply_to,reply_username,reply_content,reply_time) VALUES('$tid','$replyto','$curUser','$content','$time')";
				$DAO->query($sql);
				$sql = "UPDATE articles set reply_count=reply_count+1,last_reply_un='$curUser',last_reply_time='$time' WHERE tid='$tid'";
				$DAO->query($sql);
				$errCode = '0';
			}
		break;
	}
	$ret = array(
		'errcode' => $errCode,
		'tip' => $errInfo[$type][$errCode]
	);
	echo json_encode($ret);
	
?>
