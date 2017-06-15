<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>登录</title>
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


	<link href="/work/Public/Home/pro/scss/shop.css" rel="stylesheet">
	<script src="/work/Public/Home/pro/sjs/shop.js" type="text/javascript"></script>
</head>
<style type="text/css" media="screen">
  	
</style>
<body ng-app='myApp' ng-controller="myCtrl" ng-cloak class="ng-cloak">
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
 	<div class="container">
 	<div class="row">
 		<div class="col-lg-2 text-center"></div>
 		<div class="col-lg-1 text-center">机票+酒店</div>
 		<div class="col-lg-1 text-center">半自助游</div>
 		<div class="col-lg-1 text-center">当地游</div>
 		<div class="col-lg-1 text-center">国内机票</div>
 		<div class="col-lg-1 text-center">签证</div>
 		<div class="col-lg-1 text-center">全球WiFi</div>
 		<div class="col-lg-1 text-center">游轮</div>
 		<div class="col-lg-1 text-center">旅游保险</div>
 		<div class="col-lg-2 text-center"></div>
 	</div>
 	</div>
  	<div class='container' id='row'>
  	<div class='row'>
	  	<div class="col-lg-1"></div>
		<div class="col-lg-2">
			<img src="/work/Public/Home/pro/img/jpjd.png" alt="">
		</div>
		<div class="col-lg-8">
			<div id='sous'>
				<input type="text" placeholder="请输入目的地 / 产品名称">
				<a id='right_img' href=""><img src="/work/Public/Home/pro/img/sous2.png" alt=""></a>
			</div>
		</div>
			
	  	</div>
	</div>  	
  	</div>
  	<div class='container' id='bner'>
	<div class='row'>
		<div class="col-lg-1 text-center"></div>
		<div class="col-lg-3 text-center" id='bn_left'>
			<div id='banner_left'>

			</div>
		</div>
		<div class="col-lg-7">
			<div id='banner_right'>
				<ul id="ul">
					<li><img src="/work/Public/Home/pro/img/banner2.png" alt=""></li>
					<li><img src="/work/Public/Home/pro/img/banner4.png" alt=""></li>
					<li><img src="/work/Public/Home/pro/img/banner5.png" alt=""></li>
					<li><img src="/work/Public/Home/pro/img/banner3.png" alt=""></li>
					<li><img src="/work/Public/Home/pro/img/banner1.png" alt=""></li>
				</ul>
				<ol id="ol">
		           	<li class="ys">暑期大促5折起</li>
		            <li>夏日慧约</li>
		            <li>端午大出行</li>
		            <li>全场9元起</li>
		            <li>马代度假游</li>
		       </ol>
			</div>
		</div>
			<img id='banner_topimg' src="/work/Public/Home/pro/img/tm.png" alt="">
  	</div>
  	<div class="col-lg-1"></div>
  	<div class='container' id='ct'>
  	<div class='row'>
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div id='content'>
  				<span id='host'>正在热卖</span>
  				<span id='host2'>特价好货抢不停！</span>
  		
  			</div>
		</div>
		<div class="col-lg-1"></div>
  	</div>
  	</div>
  	<div class='container' id='host_container'>
	<div class='row'>
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div id='hostdiv'>
			<div id='top'>
				<?php if(is_array($attr)): foreach($attr as $key=>$v): ?><div class='sp' onclick="go(this)" id='<?php echo ($v["s_id"]); ?>'>
					<img src="/work/Public/Home/pro/img/<?php echo ($v["s_img"]); ?>" alt="">
					<div class='tk'>
						<div class='tk_01' style="background-color: white"><span style="background-color: white"><?php echo ($v["s_details"]); ?></span></div>
					</div>
					<span class='money'>￥<?php echo ($v["s_pri"]); ?></span><span class='qi'>起</span>
					</div><?php endforeach; endif; ?>
			</div>	
			</div>
		</div>
		<div class="col-lg-1"></div>
	</div>
  	</div>
  	<div class='container' id='sp_container'>
	<div class='row'>
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div id='shopin'>
				<span id='hostin'>正在进行</span>
  				<span id='hostin2'>为您的旅行全程服务！</span>
			</div>
			<div id='sp02'>
				<div class='sp' ng-repeat="x in res.usersData">
				<img  src="/work/Public/Home/pro/img/{{x.s_img}}" alt="">
				<div class='tkk' ng-click="tkk()">
					<div class='tkk_01' style="background-color: white"><span ng-bind="x.s_details" style="background-color: white"></span></div>
				</div>
				<span class='money' ng-bind="x.s_pri"></span><span class='qi'>起</span>
				</div>
			</div>
		</div>
		<div class="col-lg-1"></div>
	</div>
  	</div>
	<div id="pageDiv" style="text-align: center;">
        <div class="container">
          	<div>
                <span style='color:green;'>当前第<span ng-bind='res.nowPage'></span>/<span ng-bind='res.totalPage'></span>页</span>
                <button class='btn btn-info'  type='button' value='首页' ng-click='firsPage()'>首页</button>
                <button class='btn btn-info' type='button' value='上一页' ng-click='upPage()'>上一页</button>
                <button class='btn btn-info' type='button' value='下一页' ng-click='downPage()'>下一页</button>
                <button class='btn btn-info' type='button' value='末页' ng-click='finallyPage()'>末页</button>
            </div>
        </div>
    </div>
</body>
  	<script type="text/javascript">
		var transform = function(data) {
            return $.param(data);
        }
        var app = angular.module('myApp', []);
        app.controller('myCtrl', function($scope, $http) {
            var pageSize = '4'; //定义每页4条数据
            //获取当前页的数据
            function nowPage(nowPage,pageSize){
                $http({
                url:"<?php echo U('Home/shop/nowpage');?>",
                method:'post',
                    data:{
                        nowPage:nowPage,
                        pageSize:pageSize
                    },
                    headers:{'Content-Type':'application/x-www-form-urlencoded'},
                    transformRequest: transform
                }).then(function(res){
                    console.log(res.data);
                    if (res.data.rol == 0) {
                        alert(res.data.Msg);
                    }else{
                        $scope.res = res.data;
                    }
                }).catch(function (err) {
                    console.log(err);
                });
            }
            //第一页
            nowPage('1',pageSize);
            //跳转首页
            $scope.firsPage = function(){
                nowPage(1,pageSize);
            }
            //跳转末页
            $scope.finallyPage = function(){
                nowPage($scope.res.totalPage,pageSize);
            }
            //上一页
            $scope.upPage = function(){
                if($scope.res.nowPage>1){
                    $scope.res.nowPage--;
                    nowPage($scope.res.nowPage,pageSize);
                }else{
                    alert('当前已是第一页');
                }
            }
            //下一页
            $scope.downPage = function(){
                if($scope.res.nowPage<$scope.res.totalPage){
                    $scope.res.nowPage++;
                    nowPage($scope.res.nowPage,pageSize);
                }else{
                    alert('当前已是最后一页');
                }
            }
            $scope.tkk=function(){
              $(".tkk").on("mousemove",function(){
              $(this).children().eq(0).css({"margin-top":"5px"});
              })
              $(".tkk").on("mouseout",function(){
              $(this).children().eq(0).css({"margin-top":"63px"});
  })
            }
        })


        function go(e){
          window.location.href="<?php echo U('Details/Details');?>"+"?id="+e.id;
        }
  	</script>
</html>