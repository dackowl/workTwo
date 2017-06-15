<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- 引用bootstrap,angular,jquery.j及默认样式 -->
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
	<link rel="stylesheet" type="text/css" href="/work/Public/Home/CSS/reg.css">

</head>
<body>
	<div class="container" ng-app="myApp" ng-controller="user">
  <div class="row row-centered">
    <div class="well col-md-6 col-centered">
      <h2 class="text-center">欢迎登录蜂窝控制台</h2>
      <form role="form" name="reg">
        <div class="input-group input-group-md">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
          <input type="text" class="form-control" id="account" placeholder="账号" name="user" ng-model="account" pattern="^[A-Za-z0-9]{5,18}$" required>
          <label class="" style="color:red" ng-show="reg.user.$dirty && reg.user.$invalid" >
            <label ng-show="reg.user.$error.required">*</label>
            <label ng-show="reg.user.$error.pattern">5-18位英文或数字</label>
          </label>
        </div>
        <div class="input-group input-group-md">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" class="form-control" id="pwd" placeholder="密码" name="pwd" ng-model="pwd" pattern="^[A-Za-z0-9]{6,18}$" required>
          <label style="color:red" ng-show="reg.pwd.$dirty && reg.pwd.$invalid" >
            <label ng-show="reg.pwd.$error.required">*</label>
            <label ng-show="reg.pwd.$error.pattern">6-18位英文或数字</label>
          </label>
        </div>
        <div class="form-group">
      <div class="input-group">
        <input type="text" id="checkImg" placeholder="验证码" name="checkImg" ng-model='code' ng-blur="checkImg()" required>
        <img src="<?php echo U('Index/VerifyImg');?>" alt="验证码" onclick="cgImg(this)">
      </div>
    </div>
        <button class="btn btn-warning btn-block" ng-disabled="reg.user.$invalid || reg.pwd.$invalid || reg.pwds.$invalid || reg.checkImg.$invalid || chn=='0'" type="button" ng-click='login()'>登录</button>
      </form>
      <hr>
      <p>用合作网站账户直接登录</p>
      <div class="col-xs-1 col-sm-1 col-md-2 col-lg-2">

      </div>
      <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3">
        <img src="/work/Public/Home/IMG/ico/qq.png" width="66px" alt="">
        <p class="text-center">QQ</p>
      </div>
      <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">

      </div>
      <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3">
        <img src="/work/Public/Home/IMG/ico/wc.png" width="66px" alt="">
        <p class="text-center">微信</p>
      </div>
    </div>
    <h4  class="text-center">没有账号？<a href="<?php echo U('User/reg');?>">马上注册</a></h4>
  </div>
</div>

</body>
<script>
	checkImg="<?php echo U('Index/VerifyImg');?>"+"?"+Math.random();
	angular.module('myApp', []).controller('user', function($scope,$http) {
    $scope.account = '';
    $scope.pwd = '';
    $scope.chn='';
    $scope.checkImg=function(){
      // console.log(0);
      $http({
            url:"<?php echo U('Home/User/VerifyImg');?>",
            method:'post',   
              data:{
                code:$scope.code
              },
              headers:{'Content-Type':'application/x-www-form-urlencoded'},
              transformRequest: transform 
            }).then(function(response){
               console.log(response.data);
               $scope.chn=response.data.sta;
               if ($scope.chn=='0') {
               	alert('验证码错误');
               }
               
               // console.log($scope.chn);
            }).catch(function (res) {
              // alert('修改失败未知错误');
              console.log(res);
          });
    }
    $scope.login=function(){
      var user= {
        account:$scope.account,
        pwd:$scope.pwd
      }
      // console.log(user)
       $http({
            url:"<?php echo U('Index/login');?>",
            method:'post',   
              data:{
                data:user
              },
              headers:{'Content-Type':'application/x-www-form-urlencoded'},
              transformRequest: transform  
            }).then(function(response){
               console.log(response.data);
               if (response.data.sta=='0') {
                  alert(response.data.data);
                  window.location.href="http://localhost:8888/work/index.php/admin"
               }else{
                  alert(response.data.data);
               }
              
            }).catch(function (res) {
              alert('服务器未响应');
              console.log(res);
          });
      }  
  })
  var transform = function(data){  
    return $.param(data);  
  }   
</script>
<script src="/work/Public/Home/JS/login.js" type="text/javascript" charset="utf-8" async defer></script>
</html>