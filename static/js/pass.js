(function(){
	function login(){
		var u,p,d;
		u = $("#login-username input").get(0).value;
		c = getCookie("e_code");
		p = md5(md5(md5($("#login-pwd input").get(0).value)) + c);
		d = "u=" + u + "&p=" + p + "&c=" + c;
		$.post("/pass?action=login", d, function(res){
			res = $.parseJSON(res);
			if(res.errcode == '0'){
				location.reload();
				return;
			}
			switch(res.errcode){
				case '1':
				case '3':
					$("#login-box .tooltip").removeClass("hide uerr perr").addClass("uerr");
				break;
				case '2':
					$("#login-box .tooltip").removeClass("hide uerr perr").addClass("perr");
				break;
				//default:
				//break;
			}
			$("#login-box .tooltip-inner").html(res.tip);
			
		});
	}
	function getCookie(key) {
        document.cookie.match(new RegExp(key + "=([^;]*)"));
        return RegExp.$1;
    }

	$("#login-username input").blur(function(){
		var u = this.value;
		if(u){
			$.getJSON("/check?u=" + $("#login-username input").get(0).value);
		}
	});
	$("#login-auth a").click(function(){
		//var m = false,
		//	n;
		//n = document.createElement("script");
		//n.onload = n.onreadystatechange = function(){
		//	var postData;
		//	if(!m && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")){
		//		m = true;
		//		n.onload = n.onreadystatechange = null;
		//		postData = $("");
		//		$.post("/pass?action=login", $("#login-form").serialize());
		//	}
		//};
		//n.src = "/static/js/md5.js";
		//n.type = "text/javascript";
		//document.head.appendChild(n);
		if(typeof(md5) == 'function'){
			login();
		} else {
			$.getScript("/static/js/md5.js", function(data, textStatus, jqxhr){
				login();
			});
		}
	});
	$("#reg-auth a").click(function(){
		$.post("/pass?action=reg", $("#reg-form").serialize(),function(res){
			res = $.parseJSON(res);
			if(res.errcode == '0'){
				location.reload();
			}
		});
	});
})();