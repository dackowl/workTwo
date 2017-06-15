<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>游记发表</title>
	<link href="/work/Public/Home/pro/css/bootstrap.min.css" rel="stylesheet">
	<script src="/work/Public/Home/pro/js/jquery.min.js" type="text/javascript"></script>
	<script src="/work/Public/Home/pro/js/angular.min.js"></script>
  <script src="/work/Public/Home/pro/js/ng-file-upload.min.js"></script>
  <script src="/work/Public/Home/pro/js/ng-file-upload-shim.min.js"></script>
	<link href="/work/Public/Home/pro/scss/publish.css" rel="stylesheet">
</head>
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
                  <a role="menuitem" tabindex="-1" href="<?php echo U('User/userCanter');?>">个人中心</a>
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
  	<div class='container'>
		<divw class='row'>
			<div class='col-lg-1'></div>
			<div class='col-lg-10'>
				<!-- <span style='color:#7fc55d;font-size: 22px;'>标题</span>
				<textarea ng-model='insert' id='text1' contenteditable="true" style="height:60px;width:928px;box-shadow: 2px 2px 2px black;" placeholder="在此输入标题..."></textarea> -->
        <div class="input-group input-group-lg">
          <span class="input-group-addon" id="sizing-addon1">标题</span>
          <input id='text1' ng-model='insert' type="text" class="form-control" placeholder="填写游记标题" aria-describedby="sizing-addon1">
        </div>
			</div>
			<div class='col-lg-1'></div>
		</div>
  	</div>
  	<div class='container'>
  		<div class='row'>
  			<div class='col-lg-1'></div>
  			<div class='col-lg-2' id='col'>
          <button style="margin-left:20px;" id='img' class='btn btn-danger'>添加文字</button>
        </div>
  			<div class='col-lg-2' id='col2'>
          <button id='img2' class='btn btn-success'>添加照片</button>
        </div>
  			<div class='col-lg-7'></div>
  		</div>
  	</div>
  	<div id='ctn1' class='container' style="margin-top:20px;margin-left:120px;display: none;">
		<div class='row'>
			<div class='col-lg-1'></div>
			<textarea ng-model='insert2' id='text2' class='col-lg-10' contenteditable='true' style='width:928px;height:240px;' placeholder="请在此输入文字..."></textarea>
			<div class='col-lg-1'></div>
		</div>
  	</div>
  	<!--图片上传-->
  	<div id='pic' class='container' style="margin-top:20px;display: none;">
  		<div class='row'>
			<div class='col-lg-1'></div>
  			<div class='col-lg-10' style="border:1px solid grey;height:240px;width:928px;margin-left:33px;">
  				<div id='result'></div><!--图片位置-->
          <a href="javascript:;" class="file">
  				<input style="margin-left: 639px;" type="file" name="file" onchange="reluo()" multiple="multiple" id="item_detail_img" name="item_detail_img"  accept="image/gif, image/png, image/jpeg, image/jpg"  ng-model='item_detail_img' required">选择文件
          </a>
  			</div>
  			<div class='col-lg-1'></div>
  		</div>
  	</div>
  	<div id='ctn2' class='container' style='margin-top:20px;display: none;'>
  		<div class='row'>
  			<div class='col-lg-9'></div>
  			<div class='col-lg-1'><button ng-click='add()' id='btn' class="btn btn-info">发表游记</button></div>
  			<div class='col-lg-2'></div>
  		</div>
  	</div>
</body>
<script>
	$("#img").on("click",function(){
		$("#ctn1").css({"display":"block"});
		$("#ctn2").css({"display":"block"});
    $("#pic").css({"display":"none"});
	})
	$("#img2").on("click",function(){
		$("#pic").css({"display":"block"});
    $("#ctn1").css({"display":"none"});
      $("#ctn2").css({"display":"block"});
	})
	//图片上传
	var result=document.getElementById("result");  
	var file=document.getElementById("item_detail_img");      
	function reluo(){ 
	    var file = document.getElementById("item_detail_img").files[0];  
	    if(!/image\/\w+/.test(file.type)){
	        alert("请选择图片文件!");  
	        return false;  
    	}  
    var reader = new FileReader(); 
    reader.readAsDataURL(file);  
	    reader.onload=function(e){  
	        var result=document.getElementById("result");    
	        result.innerHTML='<img src="' + this.result +'" alt="" />';
	    }          
	}
	//游记发表
	var transform = function(data) {
            return $.param(data);
        }
        var app = angular.module('myApp', ['ngFileUpload']);
        app.controller('myCtrl', function($scope, $http, Upload) {
        	$scope.add = function(){
            var item_detail_img = document.getElementById('item_detail_img');
            if (item_detail_img.files.length > 4) {
                item_detail_img.files.length = 4;
                console.log(item_detail_img.files.length);
                console.log(item_detail_img.files);
            }
            Upload.upload({
                //服务端接收
                url: "<?php echo U('Home/Publish/picturePreview');?>",
                //上传的同时带的参数
                data: {
                    type: 'type',
                    data: 'adr'
                },
                //上传的文件
                file: item_detail_img.files
            }).progress(function(evt) {
                // 进度条
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                console.log('progess:' + progressPercentage + '%');
            }).success(function(data, status, headers, config) {
                //上传成功
                console.log(data);
                $http({
                url:"<?php echo U('Home/Publish/add');?>",
                method:'post',
                    data:{
                        't_title' : $scope.insert,
                        't_con' : $scope.insert2,
                        't_img' : data,
                        'u_id':$login
                    },
                    headers:{'Content-Type':'application/x-www-form-urlencoded'},
                    transformRequest: transform
                }).then(function(res){
                    if (res.data.rol == 0) {
                        alert(res.data.Msg);
                    }else{
                        alert(res.data.Msg);
                    }
                }).catch(function (err) {
                    console.log(err);
                });
            }).error(function(data, status, headers, config) {
                //上传失败
                console.log('error status: ' + status);
            });
        	}
       	})
</script>
<style>
	#result{
	height:200px;
    width:400px;
    }
    #result img{
	height:200px;
    width:400px;
    }
    .file {
    position: relative;
    display: inline-block;
    background: #D0EEFF;
    border: 1px solid #99D3F5;
    border-radius: 4px;
    padding: 4px 12px;
    overflow: hidden;
    color: #1E88C7;
    text-decoration: none;
    text-indent: 0;
    line-height: 20px;
}
.file input {
    position: absolute;
    font-size: 100px;
    right: 0;
    top: 0;
    opacity: 0;
}
.file:hover {
    background: #AADFFD;
    border-color: #78C3F3;
    color: #004974;
    text-decoration: none;
}
</style>
</html>