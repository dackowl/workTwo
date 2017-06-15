<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <title>注册</title>
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


  <link rel="stylesheet" type="text/css" href="/work/Public/Home/CSS/reg.css">
</head>
<body ng-app="myApp" ng-controller="user">
  <div class="container">
  <div class="row row-centered">
    <div class="well col-md-6 col-centered">
      <h2 class="text-center">欢迎注册</h2>
      <form role="form" name="reg">
        <div class="input-group input-group-md">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
          <input type="text" class="form-control" id="account" placeholder="账号" name="user" ng-model="account" pattern="^[A-Za-z0-9]{6,18}$"  ng-blur='checkName()' required>
          <label class="" style="color:red" ng-show="reg.user.$dirty && (reg.user.$invalid || chn.sta =='0')" >
            <label ng-show="reg.user.$error.required">*</label>
            <label ng-show="reg.user.$error.pattern">6-18位英文或数字</label>
            <label ng-show="chn.sta=='0'">{{chn.data}}</label>
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
        <div class="input-group input-group-md">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" class="form-control" id="pwds" placeholder="重复密码" name="pwds" ng-model="pwds" required>
          <label style="color:red" ng-show="reg.pwds.$dirty && (reg.pwds.$invalid || pwd!=pwds) " >
            <label ng-show="reg.pwd.$error.required">*</label>
            <label ng-show="pwd!=pwds">密码不一致</label>
          </label>
        </div>
        <br/>
        <p class="text-right">注册视为同意《蜜蜂窝用户使用协议》</p>
        <button class="btn btn-warning btn-block" ng-disabled="reg.user.$invalid || reg.pwd.$invalid || reg.pwds.$invalid || pwd!=pwds || chn=='false'" type="button" ng-click='regf()'>注册</button>
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
    <h4  class="text-center">已有账号？<a href="<?php echo U('User/login');?>">马上登陆</a></h4>
  </div>
</div>
</body>
<script>
  checkNameUrl="<?php echo U('User/checkName');?>";
  regUrl="<?php echo U('User/reg');?>";
</script>

<script>
  angular.module('myApp', []).controller('user', function($scope,$http) {
    $scope.account = '';
    $scope.pwd = '';
    $scope.pwds = '';
    $scope.chn='';
    $scope.checkName=function(){
      // console.log(0);
      $http({
            url:"<?php echo U('User/checkName');?>",
            method:'post',   
              data:{
                data:$scope.account
              },
              headers:{'Content-Type':'application/x-www-form-urlencoded'},
              transformRequest: transform 
            }).then(function(response){
               console.log(response.data);
               $scope.chn=response.data;
               // console.log($scope.chn);
            }).catch(function (res) {
              // alert('修改失败未知错误');
              console.log(res);
          });
    }
    $scope.regf=function(){
      var user= {
        account:$scope.account,
        pwd:$scope.pwd
      }
      // console.log(user)
       $http({
            url:"<?php echo U('User/reg');?>",
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
                  window.location.href="<?php echo U('User/login');?>"
               }else{
                  alert(response.data.data);
               }
              
            }).catch(function (res) {
              alert('修改失败未知错误');
              console.log(res);
          });
      }  
  })
  var transform = function(data){  
    return $.param(data);  
  }  
</script>

</html>