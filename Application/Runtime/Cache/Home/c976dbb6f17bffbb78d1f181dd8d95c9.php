<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
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
<!-- <script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script> -->
<script src="http://apps.bdimg.com/libs/angular.js/1.4.6/angular.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>

<!-- Bootstrap JavaScript -->
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js"></script>


	    <title>游记</title>
	</head>
	<body>
		<!-- 头部nav -->
		<!-- 导航条
================================================== -->
<nav class="navbar navbar-default" role="navigation">
  <div class="sf">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle navbtn" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">菜单</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.html">
          <p>蜂窝网</p>
        </a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a class="text-center" href="<?php echo U('User/home');?>">首页</a></li>
          <li><a class="text-center" href="<?php echo U('Des/index');?>">目的地</a></li>
          <li><a class="text-center" href="<?php echo U('Travel/index');?>">游记</a></li>
          <li><a class="text-center" href="<?php echo U('shop/index');?>">活动</a></li>
          <li class="out dropdown">
            <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"><?php echo ($login["nick"]); ?>
                <span class="caret"></span>
            <a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
              <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo U('Personal/personalCenter');?>">个人中心</a>
              </li>
              <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="#" onclick="out()">退出</a>
              </li>
            </ul>
          </li>
          <li class="other">
            <button type="button" class="btn btn-default pull-right nbt"><a href="QQlogin.html">QQ登录</a></button>
            <button type="button" class="btn btn-default pull-right nbt"><a href="<?php echo U('User/reg');?>">注册</a></button>
            <button type="button" class="btn btn-default pull-right nbt"><a href="<?php echo U('User/login');?>">登录</a></button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<script>
$out_url="<?php echo U('User/out');?>";
var transform = function(data) {
  return $.param(data);
}
$login="<?php echo ($login["id"]); ?>";
// console.log($login);
if($login!=""){
    $('.other').hide();
    $('.out').show();
  }else{
    console.log(1212313);
    $('.other').show();
    $('.out').hide();
  }
function out(){
  window.location.href="<?php echo U('User/out');?>";
}

</script>
		<div id="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<div id='mdd_nav'>
							<div id="mysee">
						        <div class="input-group">
						            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
						            <input type="text" class="form-control" placeholder="请输入想去的地方，如:香港">
						        </div>
							</div>
							<div class="app_d">
				                <h4><a href="#"><img src="http://images.mafengwo.net/images/app/m/logo_gonglve_v6.png?v=20150825" alt="" width="50" height="50"/></a></h4>
				                <div class="domn_in">
				                    <h5><a href="#">蚂蜂窝自由行APP下载</a></h5>
				                    <p>
				                        <a style="cursor: auto;">iPhone版</a>
				                        <span>|</span>
				                        <a style="cursor: auto;">Android版</a>
				                        <span>|</span>
				                        <a style="cursor: auto;">iPad版</a>
				                    </p>
				                </div>
				            </div>
						</div>
					</div>
					<div class="col-lg-9">
						<div>
							<div id="myCarousel" class="carousel slide" data-ride="carousel">
							    <!-- 轮播（Carousel）指标 -->
							    <ol class="carousel-indicators">
							        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							        <li data-target="#myCarousel" data-slide-to="1"></li>
							        <li data-target="#myCarousel" data-slide-to="2"></li>
							    </ol>   
							    <!-- 轮播（Carousel）项目 -->
							    <div class="carousel-inner">
							        <div class="item active">
							            <img src="https://b3-q.mafengwo.net/s10/M00/5F/84/wKgBZ1kC56qAXcSsAAOzdR07ckA15.jpeg" alt="First slide">
							        </div>
							        <div class="item">
							            <img src="https://n4-q.mafengwo.net/s10/M00/5E/2A/wKgBZ1kC5aOAEN2gAARoWlORjbE86.jpeg" alt="Second slide">
							        </div>
							        <div class="item">
							            <img src="https://n4-q.mafengwo.net/s10/M00/5E/4D/wKgBZ1kC5cqAfjLfAAL0iqzUcnM01.jpeg" alt="Third slide">
							        </div>
							    </div>
							    <!-- 轮播（Carousel）导航 -->
							    <a class="carousel-control left" href="#myCarousel" 
							        data-slide="prev">&lsaquo;
							    </a>
							    <a class="carousel-control right" href="#myCarousel" 
							        data-slide="next">&rsaquo;
							    </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="matter">
			<div class="container">
				<div class="row">
					<div class="col-lg-2">
						<div id="sidebar">
							<h4>旅游攻略导航</h4>
						</div>
						<ul id="side_ul">
							<li><a href="#">北京</a></li>
							<li><a href="#">上海</a></li>
							<li><a href="#">广州</a></li>
							<li><a href="#">深圳</a></li>
							<li><a href="#">福州</a></li>
							<li><a href="#">西安</a></li>
							<li><a href="#">香港</a></li>
							<li><a href="#">杭州</a></li>
							<li><a href="#">苏州</a></li>
							<li><a href="#">青海</a></li>
						</ul>
					</div>
					<div class="col-lg-10">
						<div id="worth_nav">
							<h3>推荐游记</h3>
						</div>
						<div id="myshow">
							<div class="panel panel-default show_div">
							    <div class="panel-heading">
							        <h3 class="panel-title show_title">
							            1212
							        </h3>
							    </div>
							    <div class="panel-body">
						    		<p class="show_content">121</p>
							    </div>
							</div>
							
						
					</div>
				</div>
			</div>
		</div>
		<!-- 底部版本信息等 -->
		<footer>
	<div class="container">
		
		<h4 style="color: white">Contact USTel：400-839-8080E-mail：cs@sojump.com	</h4>
	</div>		
</footer>
	</body>
</html>