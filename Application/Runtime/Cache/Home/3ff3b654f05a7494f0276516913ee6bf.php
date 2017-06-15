<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>活动详情</title>

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


	<link href="/work/Public/HomeEd/css/eventDetails.css" rel="stylesheet" type="text/css"></head>
<body data-spy="scroll" data-target=".navbar" data-offset="50" ng-app="myApp" ng-controller="validateCtrl">
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
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 text-center">
				<img ng-src="/work/Public/home/IMG/pro/{{res.s_img}}" class="img-responsive"/>
			</div>
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
				<h1>{{res.s_name}}</h1>
				<div class="item_fix">
					<!--关键词-->
				</div> 
				<div class="item_price">
					<ul style="padding:0 0 0 10px;">
						<li><span>￥</span><strong>{{res.s_pri}}</strong>起/人</li>
						<li class="item_explain"><a href='#'>价格说明</a></li>
						<li class="item_sold">近三月售出{{res.s_sum}}份</li>
					</ul>
				</div>
				<div class="item_notice">
					<span class="lable">预定须知</span>
					<p class="info-tips-box">此产品为二次确认产品，在支付成功时间起24小时内供应商将进行二次确认，核实是否有位。</p>
				</div>
				<div class="item_notice">
					<span class="lable">产品类型</span>
					<div class="info-tips-box ">
						<!--产品类型-->
					</div>
				</div>
				<div class="item_notice">
					<span class="lable">选择日期</span>
					<div class="ui_data">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							选择日期
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li><a href="#">日历</a></li>
						</ul>
					</div>
				</div>
				<div class="item_opt">
					<span class="lable">数量选择</span>
					<div class="item_opt_box">
						<span class="item_input">
							<span class="itm_adult">数量</span>
							<span class="num">{{count}}</span>
						</span>
						<div class="item_btns">
							<a class="btn-plus" ng-click="plus()">+</a>
							<a class="btn-minus" ng-click="minus()">-</a>
						</div>
					</div>
				</div>
				<div class="item_action">
					<div class="pull_price">
						<span>￥</span><strong>{{res.s_pri}}</strong>
					</div>
					<div class="">
						<button ng-click="buy()" type="button" class="btn btn-warning pull-right item_buy">立即购买</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" >
		<div class="row">
			<div class="navbar navbar-default" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="item_pi active"><a href="#product_introduction">产品介绍</a></li>
					<li><a href="#cost_statement">费用说明</a></li>
					<li class="hidden-xs"><a href="#purchase_notes">购买须知</a></li>
					<li class="hidden-xs"><a href="#user_reviews">用户点评</a></li>
					<li><a href="#closing_record">成交记录</a></li>
				</ul>
			</div>
			<!--详情介绍-->
			<div id="contents"></div>
			<div id="user_reviews" class="container-fluid">
				<blockquote>
					<h2>用户点评</h2>
				</blockquote>
				<ul class="item_comment">
					<li class="item_discuss item_default">全部</li>
					<li class="item_discuss">推荐 <span>(0)</span></li>
					<li class="item_discuss">一般 <span>(0)</span></li>
					<li class="item_discuss">不推荐 <span>(0)</span></li>
				</ul><br />
				<hr />
				<div class="comment_content">
					<span class="empty-msg">暂无点评</span>
				</div>
			</div>
			<div id="closing_record" class="container-fluid">
				<blockquote>
					<h2>成交记录</h2>
				</blockquote>
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>用户名</th>
								<th>拍下价格</th>
								<th>数量</th>
								<th>付款时间</th>
								<th>产品名称</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="v in suc.orderlist">
								<td>{{v.u_id}}</td>
								<td>{{v.ol_money}}</td>
								<td>{{v.ol_num}}</td>
								<td>{{v.ol_ordertime}}</td>
								<td>{{v.s_id}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="item_page">
					<span>共<span ng-bind='suc.count'></span>条</span>
		            <span>当前第<span ng-bind='suc.nowPage'></span>/<span ng-bind='suc.totalPage'></span>页</span>
		            <input type='button' class="btn btn-default" value='首页' ng-click='firsPage()'/>
		            <input type='button' class="btn btn-default" value='上一页' ng-click='upPage()'/>
		            <input type='button' class="btn btn-default" value='下一页' ng-click='downPage()'/>
		            <input type='button' class="btn btn-default" value='末页' ng-click='finallyPage()'/>
				</div>  
			</div>
		</div>
	</div>
</body>
	<script>
		var pro_id="<?php echo ($pro); ?>";
		console.log(pro_id);
		var eventDetails_url = "<?php echo U('Home/Details/Details');?>";
		var closing_record_url = "<?php echo U('Home/Details/closing_record');?>";//成交记录
		var bubefor="<?php echo U('home/Buy/before');?>";
		var buyUrl="<?php echo U('home/Buy/buy');?>";
	</script>
  	<script src="/work/Public/HomeEd/js/eventDetails.js"></script>
</html>