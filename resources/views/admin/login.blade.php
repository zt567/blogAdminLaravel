<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>歡迎使用Blog管理平臺s</h2>
		<div class="form">
			@if(session('msg'))
			<!-- 
			web中間件從laravel 5.2.27版本以後預設全域載入，不需要自己手動載入，如果自己手動重複載入，會導致session無法載入的情況
			 -->
			<p style="color: red;">{{ session('msg') }}</p>
			@endif 
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="user_name" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="user_pass" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('/makecode')}}" alt="" onclick="this.src='{{url('/makecode')}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p><a href="#">返回首页</a> &copy; 2016 Powered by <a href="http://www.chenhua.club" target="_blank">http://www.chenhua.club</a></p>
		</div>
	</div>
</body>
</html>