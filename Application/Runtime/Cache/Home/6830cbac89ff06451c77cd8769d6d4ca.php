<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- 引用bootstrap,angular,jquery.j及默认样式 -->
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/work/Public/Home/CSS/user.css">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__STATIC__/bootstrap/js/html5shiv.js"></script>
<![endif]-->
<script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>

<!-- Bootstrap JavaScript -->
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js"></script>


</head>
<body>
	<!-- 头部nav -->
	<!-- 导航条
================================================== -->
<nav class="navbar navbar-default" role="navigation">
      <div class="sf">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle navbtn" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">菜单</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.html">
              <img src="https://www.sojump.com/images/index2016/sojumpwjxlogonew.png" class="img-responsive" alt="Image">
            </a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a class="text-center" href="home.php">首页</a></li>
              <li><a class="text-center" href="#">应用展示</a></li>
              <li><a class="text-center" href="#">企业版服务</a></li>
              <li><a class="text-center" href="#">样本服务</a></li>
              <li><a class="text-center" href="#">问卷中心</a></li>
              <li></li>
              <li>
                <button type="button" class="btn btn-default pull-right nbt"><a href="QQlogin.html">QQ登录</a></button>
                <button type="button" class="btn btn-default pull-right nbt"><a href="<?php echo U('User/reg');?>">注册</a></button>
                <button type="button" class="btn btn-default pull-right nbt"><a href="<?php echo U('User/login');?>">登录</a></button>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div>
      </div>
</nav>
	<!-- 主要内容区 -->
	<div id="content">
	<div id="carousel-id" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-id" data-slide-to="0" class=""></li>
			<li data-target="#carousel-id" data-slide-to="1" class=""></li>
			<li data-target="#carousel-id" data-slide-to="2" class="active"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item">
				<img alt="First slide" src="/work/Public/Home/IMG/ico/29.jpg">
				<div class="container">
					<div class="carousel-caption">
						<div class="searchbar" id="_j_index_search_bar_all" style="display: block;">
                <div class="search-wrapper">
                    <div class="search-input">
                        <input name="q" type="text" placeholder="搜目的地/攻略/酒店/旅行特价" id="_j_index_search_input_all" autocomplete="off">
                    </div>
                </div>
                <div class="search-button" id="_j_index_search_btn_all">
                    <a role="button" href="javascript:"><i class="icon-search"></i></a>
                </div>
            </div>
					</div>
				</div>
			</div>
			<div class="item">
				<img alt="Second slide" src="/work/Public/Home/IMG/ico/29.jpg">
				<div class="container">
					<div class="carousel-caption">
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
					</div>
				</div>
			</div>
			<div class="item active">
				<img alt="Third slide" src="/work/Public/Home/IMG/ico/29.jpg">
				<div class="container">
					<div class="carousel-caption">
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>
	<!-- 底部版本信息等 -->
	<footer>
	Contact USTel：400-839-8080E-mail：cs@sojump.com			
</footer>
</body>
<script>
	checkImg="<?php echo U('User/VerifyImg');?>"+"?"+Math.random(); 
</script>
<script src="/work/Public/Home/JS/login.js" type="text/javascript" charset="utf-8" async defer></script>
</html>