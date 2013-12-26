<?php
	//Get category name
	$sql = "SELECT s_topic_zh FROM topics WHERE s_topic='$category'";
	$query = $DAO->query($sql);
	$ret = $DAO->fetch($query);
	$topic_zh = $ret['s_topic_zh'];
	//get avatar
	function get_avatar($un){
		global $DAO;
		$sql = "SELECT avatar FROM users WHERE username='$un'";
		$query = $DAO->query($sql);
		$ret = $DAO->fetch($query);
		return $ret['avatar'];
	}
	function formatTime($time){
		return strtoupper(date('M ', $time)) . date('d Y H:i', $time);
	}
	function get_subtopic_items($subTopic){
		global $DAO,$topic_zh;
		//$topicTranslate = array(
		//	'link' => '链路层',
		//	'network' => '网络层',
		//	'transport' => '传输层',
		//	'application' => '应用层'
		//);
		$sql = "SELECT * FROM articles WHERE s_topic='$subTopic' ORDER BY post_time ASC LIMIT 10";
		$query = $DAO->query($sql);
		$ret = $DAO->fetch($query);
		while($ret){
			$author = $ret['author_name'];
			$sql = "SELECT avatar FROM users WHERE username='$author'";
			$avtret = $DAO->fetch($DAO->query($sql));
			$output = '<div class="item"><div class="inner"><ul><li class="avatar"><img src="../static/image/' . $avtret['avatar'] . '" alt="avatar" /></li><li class="title"><a href="/t/' . $ret['tid'] . '">' . $ret['post_title'] . '</a></li><li class="category">Category / ' . $topic_zh . '</li><li class="postdate">Post Time / ' . formatTime($ret['post_time']) . '</li><li class="replynum">Reply / ' . $ret['reply_count'] . '</li><li class="author"></li></ul></div></div>';
			echo $output;
			$ret = $DAO->fetch($query);
		}
	}
	function get_recommand_items(){
		global $DAO;
		$sql = "SELECT * FROM articles  ORDER BY reply_count DESC,post_time DESC LIMIT 5";
		$query = $DAO->query($sql);
		$ret = $DAO->fetch($query);
		while($ret){
			$output = '<li><a href="http://' . $_SERVER['HTTP_HOST'] . '/t/' . $ret['tid'] . '">' . $ret['post_title'] . '</a></li>';
			echo $output;
			$ret = $DAO->fetch($query);
		}
	}
	
?>

	<div id="main">
		<div id="content">
			<ul class="category-meta">
				<li class="category-name">
					<a href="../">首页</a> / <a href="../go/<?php echo $category; ?>"><?php echo $topic_zh; ?></a>
				</li>
			</ul>
			<div class="category-body">
				<div id="editor">
					<input class="poster-category" type="hidden" name="category" value="<?php echo $category; ?>" />
					<div class="poster-title">
						<input type="text" name="title" value="" />
					</div>
					<div class="poster-reply">
						<div class="poster-content" contenteditable="true">
							
						</div>
						<div class="poster-smiley">
							<ul>
								<li>
									<img src="../static/image/smiley/1.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/2.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/3.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/4.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/5.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/6.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/7.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/8.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/9.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/10.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/11.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/12.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/13.gif" alt="" />
								</li>
								<li>
									<img src="../static/image/smiley/14.gif" alt="" />
								</li>
							</ul>
						</div>
						<a class="poster-submit">发表</a>
					</div>
				</div>
			</div>
		</div>
		<div id="widget-wrapper">
			<?php
				if($curUser != ''){
			?>
			<div class="widget widget-userinfo">
				<div class="widget-header">
					<span>个人信息</span>
					<a class="logout-widget" onclick="return false;">登出</a>
				</div>
				<div class="widget-body">
					<ul>
						<li class="avatar-widget">
							<img src="/static/image/avatar_sample.jpg" alt="avatar" />
						</li>
						<li class="username-widget">
							<?php echo $curUser; ?>
						</li>
						<li class="ucenter-widget">个人中心</li>
					</ul>
				</div>
			</div>
			<?php
				}
			?>
			<div class="widget widget-recommand">
				<div class="widget-header">
					推荐阅读
				</div>
				<div class="widget-body">
					<ul>
						<?php get_recommand_items(); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div id="share-panel">
		<h3>分享</h3>
		<a class="share-close"></a>
		<ul>
			<li>
				<a rel="nofollow" class="shareitem share-tencent" href=""></a>
			</li>
			<li>
				<a rel="nofollow" class="shareitem share-googleplus" href=""></a>
			</li>
			<li>
				<a rel="nofollow" class="shareitem share-weibo" href=""></a>
			</li>
			
			<li>
				<a rel="nofollow" class="shareitem share-renren" href=""></a>
			</li>
		</ul>
	</div>

	<div id="quick-access">
		<ul>
			<li class="quicktool go-share invisible">
				<div class="qttip">分享</div>
			</li>
			<li class="quicktool go-comment invisible">
				<div class="qttip">吐槽</div>
			</li>
			<li class="quicktool go-move">
				<div class="qttip">滚动</div>
			</li>
		</ul>
	</div>

	<script type="text/javascript" src="/static/js/animate.js"></script>
	<script type="text/javascript" src="/static/js/post.js"></script>