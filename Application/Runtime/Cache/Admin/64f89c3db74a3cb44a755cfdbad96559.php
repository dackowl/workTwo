<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>用户管理</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    <body ng-app='myApp' ng-controller="myCtrl" ng-cloak class="ng-cloak">
        <!-- 面包屑 -->
        <ol class="breadcrumb">
            <li>首页</li>
            <li>用户管理</li>
        </ol>
        <div id="content" style="height: 250px;margin-top: 15px;">
            <div class="container">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="active">
                            <th width="5%">ID</th>
                            <th width="10%">用户名</th>
                            <th width="10%">昵称</th>
                            <th width="15%">邮箱</th>
                            <th width="10%">QQ</th>
                            <th width="5%">余额</th>
                            <th width="15%">注册时间</th>
                            <th width="15%">登录时间</th> 
                            <th width="5%">状态</th>
                            <th width="10%">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="success" ng-repeat="x in res.usersData">
                            <td class="success"><span ng-bind="x.u_id"></span></td>
                            <td><span ng-bind="x.account"></span></td>
                            <td><span ng-bind="x.nick"></span></td>
                            <td><span ng-bind="x.email"></span></td>
                            <td><span ng-bind="x.qq"></span></td>
                            <td><span ng-bind="x.u_money"></span></td>
                            <td><span ng-bind="x.regtime"></span></td>
                            <td><span ng-bind="x.lasttime"></span></td>
                            <td>
                            <span ng-bind="x.u_st"></span>
                            </td>
                            <td class="danger">
                                <span style='margin-left:10px;' title="密码重置" class="glyphicon glyphicon-wrench" ng-click='cgPwd(x)'></span>
                                <span style='margin-left:20px;' title="用户锁定" class="glyphicon glyphicon-lock" ng-click='lock(x,$index)'></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            var pageSize = '5'; //定义每页5条数据
            //获取当前页的数据
            function nowPage(nowPage,pageSize){
                $http({
                url:"<?php echo U('Admin/user/nowpage');?>",
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

            //密码重置
            $scope.cgPwd = function($i){
                if(window.confirm('你确定要重置密码吗？')){
                    //console.log($i.u_id);
                    $http({
                    url:"<?php echo U('Admin/user/cgPwd');?>",
                    method:'post',
                        data:{
                            'u_id' : $i.u_id
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
                }
            }
            //用户锁定
            $scope.lock = function($i,$index){
                if($i.u_st == 1)
                {
                    if(window.confirm('你确定要锁定吗？')){
                    $http({
                    url:"<?php echo U('Admin/user/lock');?>",
                    method:'post',
                        data:{
                            'u_id' : $i.u_id,
                            'u_st' : $i.u_st
                        },
                        headers:{'Content-Type':'application/x-www-form-urlencoded'},
                        transformRequest: transform
                    }).then(function(res){
                        if (res.data.rol == 0) {
                            alert(res.data.Msg);
                        }else{
                            alert(res.data.Msg);
                            $scope.res.usersData[$index]['u_st'] = res.data.ree;
                        }
                    }).catch(function (err) {
                        console.log(err);
                    });
                }
                }else{
                    if(window.confirm('你确定要解锁吗？')){
                    $http({
                    url:"<?php echo U('Admin/user/lock');?>",
                    method:'post',
                        data:{
                            'u_id' : $i.u_id,
                            'u_st' : $i.u_st
                        },
                        headers:{'Content-Type':'application/x-www-form-urlencoded'},
                        transformRequest: transform
                    }).then(function(res){
                        if (res.data.rol == 0) {
                            alert(res.data.Msg);
                        }else{
                            alert(res.data.Msg);
                            $scope.res.usersData[$index]['u_st'] = res.data.ree;
                        }
                    }).catch(function (err) {
                        console.log(err);
                    });
                }
                }
            }
                
        })
    </script>
</html>