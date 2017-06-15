<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="renderer" content="webkit">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <title>OA系统</title>

	    <!-- Bootstrap -->
	    <link href="/work/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="/work/Public/admin/rol/css/main.css?v=1.0" rel="stylesheet">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
	    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
	    <script src="/work/Public/bootstrap/js/bootstrap.min.js"></script>
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body ng-app='myApp' ng-controller="myCtrl" ng-cloak class="ng-cloak">
		
		<div id="seac_div" style="margin-top: 24px">
			<div class="container">
				<ul class="nav nav-pills" style="width: 100%;background-color: #f2f2f2;padding: 5px">
			    	<li><button style="outline: none;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">添加员工 <span class="glyphicon glyphicon-plus"></span></button ></li>
					<!-- <li><button style="outline: none;" type="button" class="btn btn-danger">批量删除 <span class="glyphicon glyphicon-trash"></span></button ></li> -->
				</ul>
			</div>
		</div>
		<!-- 添加员工模态框（Modal） -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
						</button>
						<h4 class="modal-title" id="myModalLabel">
							添加新的员工
						</h4>
					</div>
					<div class="modal-body">
						<div class="input-group">
				            <span class="input-group-addon">员工名称</span>
				            <input ng-model="addName" type="text" class="form-control" placeholder="">
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">员工角色</span>
				            <select class="form-control" ng-model="addRoles">
				            	<option ng-repeat="x in res.rolesData" value="{{x.r_id}}">{{x.rolesname}}</option>
                            </select>
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">员工账号</span>
				            <input ng-model="addAccount" type="text" class="form-control" placeholder="">
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">员工状态</span>
				            <select class="form-control" ng-model="addSt">
				            	<option ng-repeat="x in res.stData" value="{{x.s_id}}">{{x.s_name}}</option>
                            </select>
				        </div><br>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" 
								data-dismiss="modal">关闭
						</button>
						<button ng-click="addStaff()" type="button" class="btn btn-primary">
							确定
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div id="content" style="height: 300px;margin-top: 15px;">
			<div class="container">
				<table class="table ">
				    <thead>
				        <tr class="active">
				        	<th width="15%">员工ID</th>
				        	<th width="15%">员工名称</th>
				        	<th width="15%">员工角色</th>
				        	<th width="15%">员工账号</th>
				        	<th width="15%">员工状态</th>
				        	<th width="15%">操作</th>
				        </tr>
				    </thead>
				    <tbody>
						<tr ng-repeat="x in res.staffData">
							<td><span ng-bind="x.s_id"></span></td>
							<td><span ng-bind="x.s_name"></span></td>
							<td><span ng-bind="res.rolesData[x.roles-1].rolesname"></span></td>
							<td><span ng-bind="x.account"></span></td>
							<td><span ng-bind="res.stData[x.st-1].s_name"></span></td>
							<td>
								<span ng-show="x.s_id != '1'">
									<span title="修改信息" class="glyphicon glyphicon-pencil" ng-click='cgInfo(x)'></span>&nbsp;&nbsp;
									<span title="重置密码" class="glyphicon glyphicon-wrench" ng-click='cgPwd(x)'></span>&nbsp;&nbsp;
									<span title="删除角色" class="glyphicon glyphicon-trash" ng-click='del(x)'></span>
								</span>
							</td>
						</tr>
				    </tbody>
				</table>
			</div>
		</div>
		<!-- 修改员工信息模态框（Modal） -->
		<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
						</button>
						<h4 class="modal-title" id="myModalLabel">
							修改员工信息
						</h4>
					</div>
					<div class="modal-body">
						<div class="input-group">
				            <span class="input-group-addon">员工名称</span>
				            <input ng-model="cgName" type="text" class="form-control" placeholder="">
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">员工角色</span>
				            <select class="form-control" ng-model="cgRoles">
				            	<option ng-repeat="x in res.rolesData" value="{{x.r_id}}">{{x.rolesname}}</option>
                            </select>
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">员工账号</span>
				            <input ng-model="cgAccount" type="text" class="form-control" placeholder="" readonly>
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">员工状态</span>
				            <select class="form-control" ng-model="cgSt">
				            	<option ng-repeat="x in res.stData" value="{{x.s_id}}">{{x.s_name}}</option>
                            </select>
				        </div><br>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" 
								data-dismiss="modal">关闭
						</button>
						<button ng-click="cgStaff()" type="button" class="btn btn-primary">
							确定
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- 分页按键 -->
		<div id="pageDiv" style="text-align: center;">
			<div class="container">
				<div>
		            <span>当前第<span ng-bind='res.nowPage'></span>/<span ng-bind='res.totalPage'></span>页</span>
		            <input type='button' value='首页' ng-click='firsPage()'>
		            <input type='button' value='上一页' ng-click='upPage()'>
		            <input type='button' value='下一页' ng-click='downPage()'>
		            <input type='button' value='末页' ng-click='finallyPage()'>
		        </div>
			</div>
		</div>
		<!-- /分页按键 -->
	</body>
	<script type="text/javascript">
		var transform = function(data) {
		  	return $.param(data);
		}
    	var app = angular.module('myApp', []);
		app.controller('myCtrl', function($scope, $http) {
			var pageSize = '5';	//定义每页5条数据
			//获取当前页的数据
			function nowPage(nowPage,pageSize){
    	    	$http({
	    	    url:"<?php echo U('staff/nowpage');?>",
	    	    method:'post',
	    	      	data:{
	        	      	nowPage:nowPage,
	        	      	pageSize:pageSize
	        	    },
	        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
	        	    transformRequest: transform
	    	    }).then(function(res){
	    	    	//console.log(res.data);
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
    		//添加员工
    		$scope.addStaff = function(){
    			// console.log($scope.addName);
    			// console.log($scope.addRoles);
    			// console.log($scope.addAccount);
    			// console.log($scope.addSt);

    			if ($scope.addName == '' || $scope.addName == undefined || $scope.addRoles == '' || $scope.addRoles == undefined || $scope.addAccount == '' || $scope.addAccount == undefined || $scope.addSt == '' || $scope.addSt == undefined) {
    				alert('请先完善信息');
    			}else{
    				$http({
		    	    url:"<?php echo U('staff/addStaff');?>",
		    	    method:'post',
		    	      	data:{
		        	      	addName : $scope.addName,
		        	      	addRoles : $scope.addRoles,
		        	      	addAccount : $scope.addAccount,
		        	      	addSt : $scope.addSt
		        	    },
		        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
		        	    transformRequest: transform
		    	    }).then(function(res){
		    	    	//console.log(res.data);
		    	    	if (res.data.rol == 0) {
		    	    		alert(res.data.Msg);
		    	    	}else{
		    	    		$('#addModal').modal('hide');
		    	    		$scope.addName = '';
		    	    		$scope.addRoles	= '';
		    	    		$scope.addAccount = '';
		    	    		$scope.addSt	= '';
		    	    		nowPage($scope.res.nowPage,pageSize);
		    	    		alert(res.data.Msg+"，初始密码为123456");
		    	    	}
		    	    }).catch(function (err) {
		    	    	console.log(err);
		    	    });
    			}
    		}
    		//删除员工
    		$scope.del = function($i){
        		if(window.confirm('你确定要删除吗？')){
        			//console.log($i.s_id);
        			$http({
		    	    url:"<?php echo U('staff/del');?>",
		    	    method:'post',
		    	      	data:{
		        	      	's_id' : $i.s_id
		        	    },
		        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
		        	    transformRequest: transform
		    	    }).then(function(res){
		    	    	if (res.data.rol == 0) {
		    	    		alert(res.data.Msg);
		    	    	}else{
		    	    		nowPage($scope.res.nowPage,pageSize);
		    	    		alert(res.data.Msg);
		    	    	}
		    	    }).catch(function (err) {
		    	    	console.log(err);
		    	    });
        		}
    		}
    		//重置密码
    		$scope.cgPwd = function($i){
        		if(window.confirm('你确定要重置密码吗？')){
        			//console.log($i.s_id);
        			$http({
		    	    url:"<?php echo U('staff/cgPwd');?>",
		    	    method:'post',
		    	      	data:{
		        	      	's_id' : $i.s_id
		        	    },
		        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
		        	    transformRequest: transform
		    	    }).then(function(res){
		    	    	if (res.data.rol == 0) {
		    	    		alert(res.data.Msg);
		    	    	}else{
		    	    		nowPage($scope.res.nowPage,pageSize);
		    	    		alert(res.data.Msg);
		    	    	}
		    	    }).catch(function (err) {
		    	    	console.log(err);
		    	    });
        		}
    		}
    		//修改信息
    		$scope.cgInfo = function($i){
        		if(window.confirm('你确定要修改信息吗？')){
        			console.log($i.s_id);
        			$scope.cg_id = $i.s_id;
        			$scope.cgName = $i.s_name;
        			$scope.cgRoles = $i.roles;
        			$scope.cgAccount = $i.account;
        			$scope.cgSt = $i.st;
        			$('#infoModal').modal('show');
        		}
    		}
    		$scope.cgStaff = function(){
    			if ($scope.cgName == '' || $scope.cgRoles == '' || $scope.cgAccount == '' || $scope.cgSt == '') {
    				alert('请先完善信息');
    			}else{
    				$http({
		    	    url:"<?php echo U('staff/cgStaff');?>",
		    	    method:'post',
		    	      	data:{
		    	      		cg_id : $scope.cg_id,
		        	      	cgName : $scope.cgName,
		        	      	cgRoles : $scope.cgRoles,
		        	      	cgAccount : $scope.cgAccount,
		        	      	cgSt : $scope.cgSt
		        	    },
		        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
		        	    transformRequest: transform
		    	    }).then(function(res){
		    	    	console.log(res.data);
		    	    	if (res.data.rol == 0) {
		    	    		alert(res.data.Msg);
		    	    	}else{
		    	    		$('#infoModal').modal('hide');
		    	    		nowPage($scope.res.nowPage,pageSize);
		    	    		alert(res.data.Msg);
		    	    	}
		    	    }).catch(function (err) {
		    	    	console.log(err);
		    	    });
    			}
    		}
		})
    </script>
</html>