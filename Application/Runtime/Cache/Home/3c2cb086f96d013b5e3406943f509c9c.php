<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>蜜蜂窝</title>
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


	<link rel="stylesheet" type="text/css" href="/work/Public/Home/CSS/home.css">
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
	<!-- 轮播 -->
	<div id="content">
	<div id="carousel-id" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-id" data-slide-to="0" class=""></li>
			<li data-target="#carousel-id" data-slide-to="1" class=""></li>
			<li data-target="#carousel-id" data-slide-to="2" class="active"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item">
				<img alt="First slide" src="/work/Public/Home/IMG/adr/adr_21.jpg">
				<div class="container">
					<div class="carousel-caption">
						<div class="input-group">  
					       <input type="text" class="form-control" placeholder="请输入字段名" / >  
				            <span class="input-group-btn">  
				               <button class="btn btn-info btn-search"><span class="glyphicon glyphicon-search"></span></button> 
				            </span>  
						</div> 
					</div>
				</div>
			</div>
			<div class="item">
				<img alt="Second slide" src="/work/Public/Home/IMG/adr/adr_23.jpg">
				<div class="container">
					<div class="carousel-caption">
						<div class="input-group">  
					       <input type="text" class="form-control" placeholder="请输入字段名" / >  
				            <span class="input-group-btn">  
				               <button class="btn btn-info btn-search"><span class="glyphicon glyphicon-search"></span></button> 
				            </span>  
						</div> 
					</div>
				</div>
			</div>
			<div class="item active">
				<img alt="Third slide" src="/work/Public/Home/IMG/adr/adr_25.jpg">
				<div class="container">
					<div class="carousel-caption">
						<div class="input-group">  
					       <input type="text" class="form-control" placeholder="请输入字段名" / >  
				            <span class="input-group-btn">  
				               <button class="btn btn-info btn-search"><span class="glyphicon glyphicon-search"></span></button> 
				            </span>  
						</div> 
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>
	<!-- 主要内容区 -->
	<div class="container" ng-app="myApp" ng-controller="home">
	<div class="row">
		<h2 class="hotTop">热卖</h2>
	</div>
	<ul class="list-inline">
		<div class="row">
			<li ng-repeat="x in pro">
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<div class="center" style="width: 220px" ng-click="goto(x.s_id)">
						<img width="220px" src="/work/Public/Home/IMG/pro/{{x.s_img}}" alt="">
			 			<p>{{x.s_name}}</p>
			 			<p class="text-right"><span class="pull-right">{{x.s_pri}}￥/人</span></p>
					</div>
				</div>
			</li>
		</div>				
	</ul>
	<hr style="margin-bottom:42px; ">

	<div class="row">
		<ul id="myTab" class="nav nav-tabs">
			<li class="active col-xs-2 col-sm-2 col-md-3 col-lg-3">
				<h3>热门游记</h3>
			</li>
			<li class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
			
			</li>
			<li class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
			<a href="<?php echo U('Publish/Publish');?>">写游记</a>
				<!-- <button type="button" class="btn btn-warning">写游记</button> -->
			</li>

		</ul>
	</div>
	
</div>
	
	<!-- 聊天工具按钮 -->
	<a id="beecli" href="<?php echo U('bee/Index/user');?>" style="
	position: fixed;
	top: calc(50% - 150px);right: 0px;
	color: rgba(255,255,255,1);
    text-decoration: none;
    background-color: rgba(219,87,5,1);
    font-family: 'Yanone Kaffeesatz';
    font-weight: 700;
    font-size: 1em;
    display: block;
    padding: 4px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -webkit-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
    -moz-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
    box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
    margin: 100px auto;
	width: 60px;
	text-align: center;" target="view_window">联系<br/>客服</a>
	<!-- 底部版本信息等 -->
	<footer>
	<div class="container">
		
		<h4 style="color: white">Contact USTel：400-839-8080E-mail：cs@sojump.com	</h4>
	</div>		
</footer>
</body>
<script src="/work/Public/Home/JS/home.js" type="text/javascript" charset="utf-8"></script>
<script> 
	checkImg="<?php echo U('User/VerifyImg');?>"+"?"+Math.random(); 
</script>
<script>
	angular.module('myApp', []).controller('home', function($scope,$http) {
		$scope.login="<?php echo ($login); ?>";
		$http({
            url:"<?php echo U('Home/Pro/scech');?>",
            method:'post',   
              data:{},
              headers:{'Content-Type':'application/x-www-form-urlencoded'},
              transformRequest: transform 
            }).then(function(response){
               $scope.pro=response.data.data;
            }).catch(function (res) {
              // alert('修改失败未知错误');
              console.log(res);
          });
        $http({
            url:"<?php echo U('Home/Travel/sc');?>",
            method:'post',   
              data:{},
              headers:{'Content-Type':'application/x-www-form-urlencoded'},
              transformRequest: transform 
            }).then(function(response){
               $scope.Travel=response.data;
				console.log($scope.Travel);
            }).catch(function (res) {
              // alert('修改失败未知错误');
              console.log(res);
          });    
        $scope.goto=function(name){
			console.log(name);
			window.location.href="<?php echo U('Details/Details');?>"+"?id="+name;
        }
	})
</script>
</html>