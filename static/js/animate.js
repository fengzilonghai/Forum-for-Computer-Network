(function(){
	jQuery.extend(jQuery.easing, {
		mcsEaseOut: function(x, t, b, c, d){var ts=(t/=d)*t,tc=ts*t;return b+c*(0.499999999999997*tc*ts + -2.5*ts*ts + 5.5*tc + -6.5*ts + 4*t);}
	});
	function slidePassBox(){
		$('#pass-box-wrapper').animate({top:0},'normal','mcsEaseOut',function(){
			$(document).bind('click',function(e){
				var tar;
				tar = e.target || e.srcElement;
				console.log($(tar).parents('#pass-box-wrapper').length);
				if($(tar).parents('#pass-box-wrapper').length == 0 && !$(tar).hasClass('login') && !$(tar).hasClass('reg')){
					$('#pass-box-wrapper').animate({top:'-500px'},'normal','mcsEaseOut');
					$(document).unbind(e);
				}
			});
		});
	}
	$(function(){
		//Items
		$(".item").each(function(index){
			$(this).animate({top:0}, 220 + index * 50, "mcsEaseOut");
		});
		//Login
		$('.login').click(function(){
			if(parseFloat($('#pass-box-wrapper').css('top')) < -100){
				$('#pass-box').attr('style','-webkit-transition:initial').attr('style','-webkit-transition:initial');
				$('#pass-box').hasClass('flipIt') && $('#pass-box').removeClass('flipIt');
				slidePassBox();
			} else {
				$('#pass-box').attr('style','');
				$('#pass-box').hasClass('flipIt') && $('#pass-box').removeClass('flipIt');
			}
			
		});
		//Register
		$('.reg').click(function(){
			if(parseFloat($('#pass-box-wrapper').css('top')) < -100){
				$('#pass-box').attr('style','-webkit-transition:initial').attr('style','-webkit-transition:initial');
				!$('#pass-box').hasClass('flipIt') && $('#pass-box').addClass('flipIt');
				slidePassBox();
			} else {
				$('#pass-box').attr('style','');
				!$('#pass-box').hasClass('flipIt') && $('#pass-box').addClass('flipIt');
			}
			
			
		});
		//Logout
		$('.logout-widget').click(function(){
			$.getJSON('/logout.php',function(res){
				if(res.errcode == '0'){
					$('.widget-userinfo').animate({opacity:0},'normal','linear',function(){
						$(this).remove();
						$('.nav-pass').css('top', '-50px').removeClass('hide').animate({'top':0}, 'slow', 'mcsEaseOut');
					});
					
				}
			});
		});
		//3D Flip
		if($("html").hasClass("csstransforms3d")){
			$("#pass-box-wrapper").addClass("flip");
			$("#register-link a").click(function(){
				$('#pass-box').attr('style','');
				!$('#pass-box').hasClass('flipIt') && $('#pass-box').addClass('flipIt');
			});
			$("#back-to-login").click(function(){
				$('#pass-box').attr('style','');
				$('#pass-box').hasClass('flipIt') && $('#pass-box').removeClass('flipIt');
			});
			//$("#pass-box").hover(function(){
			//$(this).addClass("flipIt");
			//},function(){
			//	$(this).removeClass("flipIt");
			//});
		} else {
			$("#pass-box-wrapper").addClass("scroll");
		}
		//To top & To bottom
		$(window).bind('scroll',function(){
			var bottomHeight;
			bottomHeight = document.body.scrollHeight - document.documentElement.clientHeight;
			if($(document.body).scrollTop() == bottomHeight){
				$('.go-move').css('background-position', '-55px -55px');
			} else {
				$('.go-move').attr('style', '');
			}
		});
		$('.go-move').click(function(){
			var bottomHeight;
			bottomHeight = document.body.scrollHeight - document.documentElement.clientHeight;
			if($(document.body).scrollTop() == bottomHeight){
				$(document.body).animate({scrollTop : 0},'slow','mcsEaseOut');
			} else {
				$(document.body).animate({scrollTop : bottomHeight + 5},'slow','mcsEaseOut');
			}
			
		});
		//Share
		$('.go-share').click(function(){
			$('#share-panel').css({'opacity':'0','display':'block'}).animate({opacity:1},'normal','mcsEaseOut');
		});
		$('.share-close').click(function(){
			$('#share-panel').attr('style','');
		});
		//Reply
		$('.go-comment').click(function(){
			$('.reply-to').get(0).value = '-1';
			$('#reply-box').css({'opacity':'0','display':'block'}).animate({opacity:1},'normal','mcsEaseOut');
		});
		$('.reply-close').click(function(){
			$('#reply-box').attr('style','');
		});
		$('.replyto').click(function(){
			var replyto = $(this).parents('.comment').last().attr('id').replace('comment-', '');
			$('.reply-to').get(0).value = replyto;
			$('#reply-box').css({'opacity':'0','display':'block'}).animate({opacity:1},'normal','mcsEaseOut');
		});
	});
})();