<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>目的地</title>
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
<link href="/work/Public/lwd/edit/css/des.css" rel="stylesheet"/>  
<link href="/work/Public/lwd/css/bootstrap.min.css" rel="stylesheet"/>
<script src="/work/Public/lwd/js/angular.min.js"></script> 
</head>
<body ng-app="App" ng-controller="destin"> 
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
    <div class="container-fluid" >
    <hr/>
   <!-- Button trigger modal -->
<div class="container">
	<div class="row">
		<div class="col-lg-2">
			<button type="button" class="btn btn-info btn-lg addin" data-toggle="modal" data-target="#myModal">
			 添加
			</button>
		</div>
		<div class="col-lg-10"></div>
	</div>
</div>
<!-- Modal 添加目的地-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title " id="myModalLabel">添加目的地</h4>
      </div>
      <div class="modal-body text-center" >
			<div class="text-center ">
			   <img class='st' src="/work/Public/lwd/edit/img/logo.png">	      	     
			</div><br>
			<div class="input-group">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button">城市:</button>
			  </span>
			  <input type="text" class="form-control" aria-label="..." ng-model="pro.d_city">
			</div><br>
			<div class="input-group">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button">区域:</button>
			  </span>
			  <select class="form-control" ng-model='pro.d_area'>
			  	<?php if(is_array($Are)): foreach($Are as $key=>$a): ?><option value="<?php echo ($a["a_id"]); ?>"><?php echo ($a["a_name"]); ?></option><?php endforeach; endif; ?>
			  </select>
			</div><br>
			<div class="input-group">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button">人气:</button>
			  </span>
			  <input type="text" class="form-control" aria-label="..." ng-model="pro.d_man">
			</div><br>
			<div class="input-group" >
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">状态:</button>
			      </span>
		      	  <span class="form-control"><?php echo ($Stat["s_name"]); ?></span>
			   </div><br>
			<span>介绍:</span><br>
			<textarea id="val" style="height: 110px;width: 519px;resize: none;overflow:scroll-y;" name="con" ng-model="pro.d_con"></textarea>
			<br>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary sub">提交</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="col-lg-4 col-md-4 col-sm-4"></div>
	<div class="col-lg-4 col-md-4 col-sm-4 fon"><h2 class="hot_des text-center">热门目的地</h2></div>
	<div class="col-lg-4 col-md-4 col-sm-4"></div>   
</div>
<div class="container">
	<div class="row">
		<?php if(is_array($Area)): foreach($Area as $key=>$a): ?><div class="col-lg-6 text-center"><h3><?php echo ($a["a_name"]); ?></h3></div><?php endforeach; endif; ?>
	</div>
	<div class="row">
		 <div class="col-lg-6 left">
	         <?php if(is_array($City)): foreach($City as $key=>$d): ?><span style="width:100px; float:left;margin-top:20px;text-align: center;">
	         		<a href="#" class="cname"><?php echo ($d["d_city"]); ?></a>
	         	</span><?php endforeach; endif; ?>
	    </div>
	    <div class="col-lg-6 right">
	        <?php if(is_array($Des_name)): foreach($Des_name as $key=>$c): ?><span style="width:100px; float:left;margin-top:20px;text-align: center;">
	            	<a href="#" class="cname"><?php echo ($c["d_city"]); ?></a>
	            </span><?php endforeach; endif; ?>
	    </div>
	</div>
</div>

<script>
$reset="<?php echo ($Stat["s_id"]); ?>";
$sub_url="<?php echo U('Des/sub');?>";
$detail_url="<?php echo U('Des/detail');?>";
var transform = function(data){
	  return $.param(data);
	}
angular.module('App', []).controller('destin', function($scope, $http) {
	$scope.pro={
			
	};
	
	$('.addin').on("click",function(){/* 初始化添加信息 */
		$scope.pro={
				 d_city:'',
				 d_st:$reset,
				 d_area:'',
				 d_con:'',
				 d_man:''
				 
		 	}
		console.log($scope.pro);
	})
	$(".cname").on("click",function(){/*跳转到详情页*/
		$c_name=$(this).html();
		var url = $detail_url + "?cname="+$c_name;
		location.href=url;
	})
	$(".sub").on("click",function(){/*添加链接*/
		 if(confirm("确定添加？")){
			 $http({
		         url:$sub_url,
		         method:'post',
		         data:{'data':$scope.pro},
		         headers:{'Content-Type':'application/x-www-form-urlencoded'},
		         transformRequest: transform 
		         }).then(function(response){
		        	 console.log(response);
		            if(response.data.statu=='1'){
		         	   alert(response.data.sub);
		         	   location.reload();
		            }else{
		         	   alert(response.data.sub);
		            }
		         }).catch(function (res) {
		           console.log(res);
		       });
        }
	})
	
})
</script>
<script src="/work/Public/lwd/js/jquery-3.1.0.min.js"></script>
<script src="/work/Public/lwd/js/bootstrap.min.js"></script>
</body>
</html>