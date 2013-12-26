<?php
	function formatTime($time){
		return strtoupper(date('M ', $time)) . date('d Y H:i', $time);
	}
	function get_sub_topic($fatherTopic){
		global $DAO;
		$sql = "SELECT * FROM topics WHERE f_topic='$fatherTopic'";
		$query = $DAO->query($sql);
		$ret = $DAO->fetch($query);
		while($ret){
			echo '<a href="/go/' . $ret['s_topic'] . '">' . $ret['s_topic_zh'] . '</a>';
			$ret = $DAO->fetch($query);
		}
	}
	function get_topic_items($topic){
		global $DAO;
		//$topicTranslate = array(
		//	'link' => '链路层',
		//	'network' => '网络层',
		//	'transport' => '传输层',
		//	'application' => '应用层'
		//);
		if($topic == 'newest'){
			$sql = "SELECT * FROM articles ORDER BY post_time DESC LIMIT 10";
			$query = $DAO->query($sql);
			$ret = $DAO->fetch($query);
			while($ret){
				$author = $ret['author_name'];
				$sql = "SELECT avatar FROM users WHERE username='$author'";
				$avtret = $DAO->fetch($DAO->query($sql));
				$topic_en = $ret['s_topic'];
				$sql = "SELECT s_topic_zh FROM topics WHERE s_topic='$topic_en'";
				$topiczhret = $DAO->fetch($DAO->query($sql));
				$output = '<div class="item"><div class="inner"><ul><li class="avatar"><img src="../static/image/' . $avtret['avatar'] . '" alt="avatar" /></li><li class="title"><a href="/t/' . $ret['tid'] . '">' . $ret['post_title'] . '</a></li><li class="category">Category / ' . $topiczhret['s_topic_zh'] . '</li><li class="postdate">Post Time / ' . formatTime($ret['post_time']) . '</li><li class="replynum">Reply / ' . $ret['reply_count'] . '</li><li class="author"></li></ul></div></div>';
				echo $output;
				$ret = $DAO->fetch($query);
			}
			return;
		}
		$sql = "SELECT * FROM articles WHERE f_topic='$topic' ORDER BY post_time DESC LIMIT 10";
		$query = $DAO->query($sql);
		$ret = $DAO->fetch($query);
		while($ret){
			$author = $ret['author_name'];
			$sql = "SELECT avatar FROM users WHERE username='$author'";
			$avtret = $DAO->fetch($DAO->query($sql));
			$topic_en = $ret['s_topic'];
			$sql = "SELECT s_topic_zh FROM topics WHERE s_topic='$topic_en'";
			$topiczhret = $DAO->fetch($DAO->query($sql));
			$output = '<div class="item"><div class="inner"><ul><li class="avatar"><img src="../static/image/' . $avtret['avatar'] . '" alt="avatar" /></li><li class="title"><a href="/t/' . $ret['tid'] . '">' . $ret['post_title'] . '</a></li><li class="category">Category / ' . $topiczhret['s_topic_zh'] . '</li><li class="postdate">Post Time / ' . formatTime($ret['post_time']) . '</li><li class="replynum">Reply / ' . $ret['reply_count'] . '</li><li class="author"></li></ul></div></div>';
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
		<div class="tab-wrapper">
			<div class="tab-primary">
				<?php
					if($tab == 'newest'){
						echo '<a class="select" href="/">最新</a>';
					} else {
						echo '<a href="/">最新</a>';
					}
					$tabNames = array(
						'link' => '链路层',
						'network' => '网络层',
						'transport' => '传输层',
						'application' => '应用层'
					);
					foreach($tabNames as $key => $value){
						if($tab == $key){
							echo '<a class="select" href="/?tab=' . $key . '">' . $value . '</a>';
						} else {
							echo '<a href="/?tab=' . $key . '">' . $value . '</a>';
						}
					}
				?>
			</div>
			<?php if($tab != 'newest'){ ?>
			<div class="tab-sub">
			<?php get_sub_topic($tab); ?>
			</div>
			<?php } ?>
		</div>
		<div id="topic-box">
			<?php get_topic_items($tab); ?>
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

	
