<?php
	//Get article info
	$sql = "SELECT * FROM articles WHERE tid='$tid'";
	$query = $DAO->query($sql);
	$ret = $DAO->fetch($query);
	$article_author = $ret['author_name'];
	$article_title = $ret['post_title'];
	$article_content = $ret['post_content'];
	//Get category name
	$topic_en = $ret['s_topic'];
	$sql = "SELECT s_topic_zh FROM topics WHERE s_topic='$topic_en'";
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
	$article_author_avatar = get_avatar($article_author);
	function formatTime($time){
		return strtoupper(date('M ', $time)) . date('d Y H:i', $time);
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
	function get_replys($tid){
		global $DAO;
		$sql = "SELECT * FROM replys WHERE tid='$tid' and reply_to='-1'";
		$replyQuery = $DAO->query($sql);
		$ret = $DAO->fetch($replyQuery);
		$output = '';
		while($ret){
			$author = $ret['reply_username'];
			$avatar = get_avatar($author);
			$content = $ret['reply_content'];
			$time = $ret['reply_time'];
			$rid = $ret['reply_id'];
			$output .= '<li id="comment-' . $rid . '" class="comment"><div class="comment-body"><div class="comment-avatar"><img src="/static/image/' . $avatar . '" /></div><div class="comment-content-wrapper"><div class="comment-content"><a class="comment-author">' . $author . '</a><span>：</span><p>' . $content . '</p></div><div class="comment-time">' . formatTime($time) . '</div><a class="replyto">回复</a></div></div>';
			//echo '主楼回复rid：' . $rid;
			$sql = "SELECT * FROM replys WHERE tid='$tid' and reply_to='$rid'";
			$query = $DAO->query($sql);
			$subreplyret = $DAO->fetch($query);
			if($subreplyret){
				$output .= '<ul class="children">';
				while($subreplyret){
					$subAuthor = $subreplyret['reply_username'];
					$subAvatar = get_avatar($subAuthor);
					$subContent = $subreplyret['reply_content'];
					$subTime = $subreplyret['reply_time'];
					$subRid = $subreplyret['reply_id'];
					$output .= '<li id="comment-' . $subRid . '" class="comment"><div class="comment-body"><div class="comment-avatar"><img src="/static/image/' . $subAvatar . '" /></div><div class="comment-content-wrapper"><div class="comment-content"><a class="comment-author">' . $subAuthor . '</a><span>：</span><p>' . $subContent . '</p></div><div class="comment-time">' . formatTime($subTime) . '</div><a class="replyto">回复</a></div></div></li>';
					$subreplyret = $DAO->fetch($query);
				}
				$output .= '</ul>';
			}
			$output .= '</li>';
			echo $output;
			$ret = $DAO->fetch($replyQuery);
		}
	}
?>

	<div id="main">
		<div id="content">
			<ul class="article-meta">
				<li class="path">
					<a href="../">首页</a> / <a href="../go/<?php echo $topic_en; ?>"><?php echo $topic_zh; ?></a> / <?php echo $article_title; ?>
				</li>
				<li class="author-by">
					Authored By <a href="#"><?php echo $article_author; ?></a>
				</li>
				<li class="author-avatar">
					<img src="/static/image/<?php echo $article_author_avatar; ?>" alt="avatar" />
				</li>
			</ul>
			<div class="article-body">
				<?php echo $article_content;?>
			</div>
			<ul id="commentlist">
				<?php
					get_replys($tid);
				?>
			</ul>
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

	<div id="reply-box">
		<span>Reply</span>
		<input class="reply-tid" type="hidden" name="replytid" value="<?php echo $tid; ?>" />
		<input class="reply-to" type="hidden" name="replyto" value="-1" />
		<textarea class="reply-content" name="reply"></textarea>
		<button class="reply-submit">发布</button>
		<a class="reply-close"></a>
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
			<li class="quicktool go-share">
				<div class="qttip">分享</div>
			</li>
			<li class="quicktool go-comment">
				<div class="qttip">吐槽</div>
			</li>
			<li class="quicktool go-move">
				<div class="qttip">滚动</div>
			</li>
		</ul>
	</div>

	<script type="text/javascript" src="/static/js/animate.js"></script>
	<script type="text/javascript" src="/static/js/post.js"></script>