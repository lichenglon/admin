<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>@lang('layouts_aside.Intermediate')</title>
		<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta name="robots" content="noindex,nofollow">
		<link href="{{ asset('css/admin_login.css') }}" rel="stylesheet" />
		<style>
			#login_btn_wraper{
				text-align: center;
			}
			#login_btn_wraper .tips_success{
				color:#fff;
			}
			#login_btn_wraper .tips_error{
				color:#DFC05D;
			}
			#login_btn_wraper button:focus{outline:none;}

			body{
				margin:0;
				background-size:100%;
			}

		</style>

	</head>
<body onload="refresh()">

	<div class="wrap">
		<h1>
			<a href="http://www.home.com">ULzz.com</a>
			<a>@lang('layouts_aside.Intermediate')</a>
		</h1>
		<form method="post" name="login" autoComplete="off" class="js-ajax-form">
			<div class="login">
				<ul>
					<li>
						<input type="hidden" name="_token"  value="{{csrf_token()}}"/>
						<input class="input" name="username" type="text"  placeholder="User Name"/>
					</li>

				</ul>
				<ul>
					<li>
						<input class="input" type="password" name="password" placeholder="Password"/>
					</li>
				</ul>

				<div class="tips_error"></div>
				<div id="login_btn_wraper">
					<button type="submit" name="submit" class="btn js-ajax-submit">Login</button>
				</div>
			</div>
		</form>
	</div>



	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('static/layer/layer.js') }}"></script>

<script>

$(function(){
	$('.js-ajax-form').submit(function () {
		var data  ={
			_token : $('input[name=_token]').val(),
			username : $('input[name=username]').val(),
			password : $('input[name=password]').val()
		};
		if(!data.username){
			$('.tips_error').html('The user name cannot be empty.');
			return false;
		}
		if(!data.password){
			$('.tips_error').html('The password cannot be empty.');
			return false;
		}
		$.post("{{asset('users/login')}}",data,function(msg){
			if(msg.status == 1){
//				$('.tips_error').html('登录成功');
				$('.tips_error').html();
				window.location.href = "{{asset('/')}}";
			}else{
				$('.tips_error').html(msg.info);
//				showMsg(msg.info);
			}
		},'json');
		return false;
	});

});
/**
 * layer提示
 */
function showMsg(msg){
	layer.alert(msg, {
		skin: 'layer-ext-moon',
		title: '提示',
		icon: 2,
	});
}

</script>
	<script>

		var imgs =[
			"{{asset('images/0.jpg')}}",
			"{{asset('images/1.jpg')}}",
			"{{asset('images/2.jpg')}}",
			"{{asset('images/3.jpg')}}",
			"{{asset('images/4.jpg')}}",
			"{{asset('images/5.jpg')}}",
			"{{asset('images/6.jpg')}}",
			"{{asset('images/7.png')}}",
			"{{asset('images/8.jpg')}}",
			"{{asset('images/9.jpg')}}",
		];
		var caution = false
		function setCookie(name, value, expires, path, domain, secure)
		{
			var curCookie = name + "=" + escape(value) +
					((expires) ? "; expires=" + expires.toGMTString() : "") +
					((path) ? "; path=" + path : "") +
					((domain) ? "; domain=" + domain : "") +
					((secure) ? "; secure" : "")
			if (!caution || (name + "=" + escape(value)).length <= 4000)
				document.cookie = curCookie
			else if (confirm("Cookie exceeds 4KB and will be cut!"))
				document.cookie = curCookie
		}
		function getCookie(name)
		{
			var prefix = name + "="
			var cookieStartIndex = document.cookie.indexOf(prefix)
			if (cookieStartIndex == -1)
				return null
			var cookieEndIndex = document.cookie.indexOf(";", cookieStartIndex + prefix.length);
			if (cookieEndIndex == -1)
				cookieEndIndex = document.cookie.length
			return unescape(document.cookie.substring(cookieStartIndex + prefix.length, cookieEndIndex));
		}
		var now = new Date();
		now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);
		var imagsNum = getCookie('imageNumber');
		if(Number(imagsNum) > 8)
		{
			setCookie('imageNumber',0,now);
		}
		else if(getCookie('imageNumber'))
		{
			var i = getCookie('imageNumber');
			var ii = Number(i)+1;
			setCookie('imageNumber',ii,now);
		}
		else
		{
			setCookie('imageNumber',0,now);
		}
		function refresh()
		{
			var index = getCookie('imageNumber');
			//console.log(index);
			var img = imgs[index];
			document.body.style.backgroundImage="url("+img+")";
		}
	</script>



</body>
</html>
