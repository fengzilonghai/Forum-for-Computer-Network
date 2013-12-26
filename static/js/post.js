(function(){
	$(function(){
		$('.poster-submit').click(function(){
			var title,content,subTopic,postData;
			title = $('.poster-title input').get(0).value;
			content = $('.poster-content').html();
			subTopic = $('.poster-category').get(0).value;
			postData = 'st=' + subTopic + '&t=' + title + '&c=' + content;
			$.post('/post.php?type=article', postData, function(res){
				res = $.parseJSON(res);
				if(res.errcode == '0'){
					location.href = location.href.replace('new', 'go');
				}
			});
		});
		$('.reply-submit').click(function(){
			var tid, replyto, content, postData;
			tid = $('.reply-tid').get(0).value;
			replyto = $('.reply-to').get(0).value;
			content = $('.reply-content').get(0).value;
			postData = 'tid=' + tid + '&replyto=' + replyto + '&c=' + content;
			$.post('/post.php?type=reply', postData, function(res){
				res = $.parseJSON(res);
				if(res.errcode == '0'){
					location.reload();
				}
			})
		});
	});
})();