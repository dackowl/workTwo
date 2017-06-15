<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	
	<title>个人中心</title>
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


	<link href="/work/Public/Home/CSS/personalCenter.css" rel="stylesheet" type="text/css">	
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
	<div class="item_bg">
		<div class="container">
			<nav class="navbar ">
			    <div class="container-fluid">
			    	<span class="col-xs-0 col-lg-3"></span>
				    <div class="navbar-header">
				        <button type="button" class="navbar-toggle" data-toggle="collapse"
				                data-target="#example-navbar-collapse">
				            <span class="sr-only">切换导航</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				        </button>
				        <a class="navbar-brand" href="#">我的信息</a>
				    </div>
				    <div class="collapse navbar-collapse" id="example-navbar-collapse">
				        <ul class="nav navbar-nav">
				            <li class=""><a href="#">我的窝</a></li>
				            <li class=""><a href="#">我的游记</a></li>
				            <li class=""><a href="#">我的问答</a></li>
				            <li class=""><a href="#">我的足迹</a></li>
				            <li class=""><a href="#">我的点评</a></li>
				            <li class="dropdown">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
				                <ul class="dropdown-menu">
				                    <li><a href="#">我的收藏</a></li>
				                    <li><a href="<?php echo U('Dingdan/index');?>">我的订单</a></li>
				                    <li><a href="#">常用信息</a></li>
				                </ul>
				            </li>
				        </ul>
				    </div>
			    </div>
			</nav>
		</div>
	</div>
	<div class="container go_to">
		<div class="row">
			<div class="col-lg-3 item_info">
				<div class="item_img">
					<div class="myImg">
						<img src="http://a3-q.mafengwo.net/s10/M00/48/B5/wKgBZ1kAeeiAXfnNAABXZKqrvCE90.jpeg" alt="">
					</div>
					<div class="myName">
						<span>马蜂窝用户</span>
						<img src="/work/Public/HomeEd/img/sexn.png" id="my_sex">
					</div>
					<div class="myAdd">
						<span>等级：</span>
						<span>Lv.1</span> | 
						<span>现居：</span>
						<span>福州</span> | 
						<img src="/work/Public/HomeEd/img/set_up.png" id="set_up">
					</div>
					<div class="myNota">
						<span>填写个人简介</span>
					</div>
					<div class="nota">
						<textarea></textarea>
						<span class="preserved">保存</span>
					</div>
					<div class="myFollow">
						<div class="follow">
							<strong>1</strong>
							<p>关注</p>
						</div>
						<div class="fans">
							<strong>0</strong>
							<p>粉丝</p>
						</div>
						<div class="honey">
							<strong>0</strong>
							<p>蜂蜜</p>
						</div>
					</div>
					<div class="item_follow">
						<span class="item_follow_title">我的关注</span>
						<div class="item_follow_character">
							<img src="http://a4-q.mafengwo.net/s10/M00/E8/CD/wKgBZ1iZk2SAGbKsAAME0TWzCHE45.jpeg">
							<p><a href="#">蚂小蜂</a></p>
						</div>
					</div>
					<div class="item_message_board">
						<span class="item_follow_title">留言板</span>
						<div class="message_board">
							<textarea placeholder="说点什么吧..."></textarea>
						</div>
						<span class="preserved">留言</span>
					</div>
					<!--留言板-->
					<div class="nota_show">
						
					</div>	
				</div>
			</div>
			<!--右内容区-->
			<div class="col-lg-9">
				<div class="common_block">
					<ul>
						<li><a href="#">写游记</a></li>
						<li><a href="#">问达人</a></li>
						<li><a href="#">添加足迹</a></li>
						<li><a href="#">发布结伴</a></li>
					</ul>
				</div>
				<div class="travel_notes">
					<div class="travel_notes_btn">
						<h3>我的游记</h3>
						<button type="button" class="btn btn-warning glyphicon glyphicon-edit" id="travel_notes">写游记</button>
					</div>
					<img src="/work/Public/HomeEd/img/tn.png">
				</div>
				<div class="travel_notes my_answer">
					<div class="travel_notes_btn">
						<h3>我的回答</h3>
						<div id="my_answer">
							<span class="wer">蚂蜂窝问答是一个所有人帮所有人的平台，</span>
							<span>用你的旅行经验，去帮助其他蜂蜂。</span>
						</div>
						
					</div>
				</div>
				<div class="travel_notes my_comment">
					<div class="travel_notes_btn">
						<h3>我的点评</h3>
						<div id="my_comment">
							<span class="wer">点评，不仅是旅途记忆，</span>
							<span>更是帮助他人的宝贵财富。</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--返回顶部-->
		<div id="top">
			<div class="code_return">
				<img src="/work/Public/HomeEd/img/top.png">
			</div>
			<div class="code_return code">
				<img src="/work/Public/HomeEd/img/code.png">
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
<script>
	angular.module('myApp', []).controller('home', function($scope, $http) {
		$scope.login="<?php echo ($login); ?>";
		
		$http({
            url:"<?php echo U('user/scech');?>",
            method:'post',   
              data:{'id':$scope.login.id},
              headers:{'Content-Type':'application/x-www-form-urlencoded'},
              transformRequest: transform 
            }).then(function(response){
               console.log(response.data.data);
               $scope.user=response.data.data;
               // console.log($scope.chn);
            }).catch(function (res) {
              // alert('修改失败未知错误');
              console.log(res);
          });
	})


</script>
</html>