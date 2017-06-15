<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>目的地详情</title>
<link rel="stylesheet" type="text/css" href="/work/Public/Home/CSS/home.css">
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


<link href="/work/Public/lwd/css/bootstrap.min.css"  rel="stylesheet"/>
<link href="/work/Public/lwd/edit/css/des_detail.css?Ver=1.0" rel="stylesheet"/>
<script src="/work/Public/lwd/js/angular.min.js"></script> 
</head>
<body ng-app="myApp" ng-controller="detail" ng-cloak class="ng-cloak">
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
<div class="container crumb">
	<div class="row">
		<div class="col-lg-6">
			<div class="ite">
		    	<a href="<?php echo U('Des/index');?> ">目的地（返回）</a>
		    	<em>&gt;</em>
		    </div>
			<div class="ite">
			    <span class="hd">
			    	<a href="#" >中国<i></i></a>
			    </span>
				<em>&gt;</em>
			</div>
			<div class="ite">
				<div class="ite">
				     <span class="hd">
				     	<a href=""><span class="city"><?php echo ($Det["d_city"]); ?></span><i></i></a>
				     </span>
				</div>
				<em>&gt;</em>
			</div>
		    <div class="ite cur"><strong><?php echo ($Det["d_city"]); ?>简介</strong></div>
			</div>
		<div class="col-lg-6"></div>
	</div>
</div>
<div class="container ">
	<div class="row ">
		<div class="col-lg-4 col-md-4 col-sm-4"></div>
		<div class="col-lg-4 col-md-4 col-sm-4"><h2 class="text-center">地区简介</h2></div>
		<div class="col-lg-4 col-md-4 col-sm-4"></div>
	</div>
</div>
<div class="container" data-cs-t="目的地详情页">
		<div class="col-lg-6 left">
			<img src="/work/Public/lwd/edit/img/<?php echo ($Det["d_img"]); ?> " class="left">
		</div>
		<div class="col-lg-6 right">
			<div class="right">
				<?php echo ($Det["d_con"]); ?>
			</div>
		</div>
	</div>	
	<hr>
</div>	
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4"></div>
		<div class="col-lg-4 col-md-4 col-sm-4"><h2 class="text-center">讨论区</h2></div>
		<div class="col-lg-4 col-md-4 col-sm-4"></div>
	</div>
	<div class="row">
		<div class="col-lg-10 ">
			<textarea class="change"></textarea>
		</div>
		<div class="col-lg-2 ">
			<input type="button" value="发布" class="btn">
		</div>
	</div>
	<div class="row">
		<ul class="comment-list">
			<li class="item" ng-repeat="x in com">                                                            
				<div class="c-bar">
					<a class="user" href="/u/5063706.html">
						<img src="http://b1-q.mafengwo.net/s2/M00/D3/9B/wKgBpU5rikb5liLkAAAGbKJTJYY925.gif" height="48" width="48">
						<span class="name" ng-bind="x.account"></span>
					</a>
					<span class="time" ng-bind="x.create_time"></span>
					<!-- <span class="opt">
						<a class="reply J_replyUser" ng-click="reply(x.account)">回复</a>
					</span> -->
				</div>
				<div class="c-txt" ng-bind="x.content">内容发表</div>
			</li>
		</ul>
	</div>
</div>
<script src="/work/Public/lwd/js/jquery-3.1.0.min.js"></script>
<script src="/work/Public/lwd/js/bootstrap.min.js"></script>
<script>
$comment_url="<?php echo U('Des/comment');?>";
$commen_url="<?php echo U('Des/commen');?>";
var transform = function(data){
	  return $.param(data);
	}
angular.module('myApp', []).controller('detail', function($scope, $http) {
	$scope.pro={
		u_id:'u_id',
		d_city:'d_city',
		create_time:'create_time',
		content:'content'
	};
	 $http({
         url:$comment_url,
         method:'post',
         data:{'data':$scope.pro},
         headers:{'Content-Type':'application/x-www-form-urlencoded'},
         transformRequest: transform 
         }).then(function(response){
        	 console.log(response.data);
        	 $scope.com=response.data;
         }).catch(function (res) {
           console.log(res);
       });
	 $('.btn').on('click',function(){/*发布*/
		 $change=$('.change').val();
		 $time=new Date();
		 $now_time=$time.getFullYear()+"-"+eval($time.getMonth()+1)+"-"+$time.getDate()+" "+$time.getHours()+":"+$time.getMinutes()+":"+$time.getSeconds();
		 $city=$('.city').html();
		 $scope.por={
			content:$change,
			create_time:$now_time,
			d_city:$city,
			account:"王五"
		}
		$http({
	         url:$commen_url,
	         method:'post',
	         data:{'data':$scope.por},
	         headers:{'Content-Type':'application/x-www-form-urlencoded'},
	         transformRequest: transform 
	         }).then(function(response){
	        	 if(response.data.statu=='0'){
		         	   alert(response.data.msg);
			            }
	        	 else if(response.data.statu=='1'){
		         	   alert(response.data.msg);
		         	  $scope.com.unshift($scope.por);
		            }else{
		         	   alert(response.data.msg);
		            }
	         }).catch(function (res) {
	           console.log(res);
	       });
		 $change=$('.change').val("");
	 })
	 
})
 
</script>
</body>
</html>