<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
<!-- 	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="renderer" content="webkit"> -->
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <title>OA系统</title>
		<link href="/work/Public/admin/rol/css/main.css?v=1.0" rel="stylesheet">
	      <!-- Bootstrap -->
	    <link href="/work/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
			    	<li><button style="outline: none;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">添加角色 <span class="glyphicon glyphicon-plus"></span></button ></li>
					<!-- <li><button style="outline: none;" type="button" class="btn btn-danger">批量删除 <span class="glyphicon glyphicon-trash"></span></button ></li> -->
				</ul>
			</div>
		</div>
		<!-- 添加角色模态框（Modal） -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
						</button>
						<h4 class="modal-title" id="myModalLabel">
							添加新的角色
						</h4>
					</div>
					<div class="modal-body">
						<div class="input-group">
				            <span class="input-group-addon">角色名称</span>
				            <input ng-model="add_name" type="text" class="form-control" placeholder="">
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">角色描述</span>
				            <input ng-model="add_des" type="text" class="form-control" placeholder="">
				        </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" 
								data-dismiss="modal">关闭
						</button>
						<button ng-click="addRoles()" type="button" class="btn btn-primary">
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
				        	<th width="250px">角色ID</th>
				        	<th width="250px">角色名称</th>
				        	<th width="250px">角色描述</th>
				        	<th width="250px">操作</th>
				        </tr>
				    </thead>
				    <tbody>
						<tr ng-repeat="x in res.rolesData">
							<td><span ng-bind="x.r_id"></span></td>
							<td><span ng-bind="x.rolesname"></span></td>
							<td><span ng-bind="x.r_des"></span></td>
							<td>
								<span ng-show="x.r_id != '1'">
									<span title="修改信息" class="glyphicon glyphicon-pencil" ng-click='cgInfo(x)'></span>&nbsp;&nbsp;
									<span title="修改权限" class="glyphicon glyphicon-wrench" ng-click='cgPower(x)'></span>&nbsp;&nbsp;
									<span title="删除角色" class="glyphicon glyphicon-trash" ng-click='del(x)'></span>
								</span>
							</td>
						</tr>
				    </tbody>
				</table>
			</div>
		</div>
		<!-- 修改信息模态框（Modal） -->
		<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
						</button>
						<h4 class="modal-title" id="myModalLabel">
							修改角色信息
						</h4>
					</div>
					<div class="modal-body">
						<div class="input-group">
				            <span class="input-group-addon">角色名称</span>
				            <input ng-model="cg_name" type="text" class="form-control" placeholder="">
				        </div><br>
				        <div class="input-group">
				            <span class="input-group-addon">角色描述</span>
				            <input ng-model="cg_des" type="text" class="form-control" placeholder="">
				        </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" 
								data-dismiss="modal">关闭
						</button>
						<button ng-click="infoUp()" type="button" class="btn btn-primary">
							确定
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- 修改权限模态框（Modal） -->
		<div class="modal fade" id="powerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
						</button>
						<h4 class="modal-title" id="myModalLabel">
							修改<span ng-bind="cg_name"></span>权限
						</h4>
					</div>
					<div class="modal-body">
						<ul style="list-style-type:none;">
		                    <li ng-repeat="x in menuData | filter:{pid:0}">
		                        <input type='checkbox' ng-model='x.checked' ng-change="checkPid(x)"><span ng-bind='x.m_name'></span>
		                        <ul style="list-style-type:none;">
		                        	<li ng-repeat="i in menuData | filter:{pid:x.m_id}">
		                            <input type='checkbox' ng-model='i.checked' ng-change="checkDo(x)"><span ng-bind='i.m_name'></span>
		                        	</li>
		                        </ul>
		                    </li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" 
								data-dismiss="modal">关闭
						</button>
						<button ng-click="powerUp()" type="button" class="btn btn-primary">
							确定
						</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
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
	    	    url:"<?php echo U('roles/nowpage');?>",
	    	    method:'post',
	    	      	data:{
	        	      	nowPage:nowPage,
	        	      	pageSize:pageSize
	        	    },
	        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
	        	    transformRequest: transform
	    	    }).then(function(res){
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
    		//添加角色
    		$scope.addRoles = function(){
    			//console.log('add');
    			//console.log($scope.add_name);
    			//console.log($scope.add_des);
    			if ($scope.add_name == undefined || $scope.add_name == '' || $scope.add_des == undefined || $scope.add_des == '') {
    				alert('请先完善信息');
    			}else{
    				$http({
		    	    url:"<?php echo U('roles/addRoles');?>",
		    	    method:'post',
		    	      	data:{
		        	      	addName : $scope.add_name,
		        	      	addDes : $scope.add_des
		        	    },
		        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
		        	    transformRequest: transform
		    	    }).then(function(res){
		    	    	if (res.data.rol == 0) {
		    	    		alert(res.data.Msg);
		    	    	}else{
		    	    		$('#addModal').modal('hide');
		    	    		$scope.add_name = '';
		    	    		$scope.add_des	= '';
		    	    		nowPage($scope.res.nowPage,pageSize);
		    	    		alert(res.data.Msg);
		    	    	}
		    	    }).catch(function (err) {
		    	    	console.log(err);
		    	    });
    			}
    		}
    		//删除角色
    		$scope.del = function($i){
        		if(window.confirm('你确定要删除吗？')){
        			//console.log($i.r_id);
        			$http({
		    	    url:"<?php echo U('roles/del');?>",
		    	    method:'post',
		    	      	data:{
		        	      	'r_id' : $i.r_id
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
        			console.log($i.r_id);
        			$scope.cg_id = $i.r_id;
        			$scope.cg_name = $i.rolesname;
        			$scope.cg_des = $i.r_des;
        			$('#infoModal').modal('show');
        		}
    		}
    		//上传修改后的信息
    		$scope.infoUp = function(){
    			if ($scope.cg_name == '' || $scope.cg_des == '') {
    				alert('请先完善信息');
    			}else{
    				$http({
		    	    url:"<?php echo U('roles/infoUp');?>",
		    	    method:'post',
		    	      	data:{
		    	      		cg_id : $scope.cg_id,
		        	      	cg_name : $scope.cg_name,
		        	      	cg_des : $scope.cg_des
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
    		//修改权限
    		$scope.cgPower = function($i){
    			//console.log($i.r_id);
    			$scope.cg_id = $i.r_id;
    			$scope.cg_name = $i.rolesname;
    			$('#powerModal').modal('show');
    			//获取权限表数据
    			$http({
	    	    url:"<?php echo U('roles/cgPower');?>",
	    	    method:'post',
	    	      	data:{
	    	      		cg_id : $scope.cg_id
	        	    },
	        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
	        	    transformRequest: transform
	    	    }).then(function(res){
	    	    	//console.log(res.data);
	    	    	if (res.data.rol == 0) {
	    	    		alert(res.data.Msg);
	    	    	}else{
	    	    		$scope.menuData = res.data.menuData;
		    	    	$scope.powerArr = res.data.powerArr;
		    	    	//console.log($scope.menuData[2].m_id);
		    	    	for (var i = 0; i < $scope.menuData.length; i++) {
		    	    		$scope.menuData[i].checked = false;
		    	    		for (var t = 0; t < $scope.powerArr.length; t++) {
		    	    			if ($scope.menuData[i].m_id == $scope.powerArr[t]) {
		    	    				$scope.menuData[i].checked = true;
		    	    			}
		    	    		}
		    	    	}
	    	    	}
	    	    	
	    	    }).catch(function (err) {
	    	    	console.log(err);
	    	    });
    		}
    		//保存修改权限
    		$scope.powerUp = function(){
				//console.log('保存修改权限');
				var powerArr = [];
				for (var i = 0; i < $scope.menuData.length; i++) {
    	    		if($scope.menuData[i].checked == true){
    	    			powerArr.push(i+1);
    	    		}
    	    	}
    	    	console.log(powerArr);
    	    	$http({
	    	    url:"<?php echo U('roles/powerUp');?>",
	    	    method:'post',
	    	      	data:{
	    	      		cg_id : $scope.cg_id,
	        	      	powerArr : powerArr
	        	    },
	        	    headers:{'Content-Type':'application/x-www-form-urlencoded'},
	        	    transformRequest: transform
	    	    }).then(function(res){
	    	    	console.log(res.data);
	    	    	if (res.data.rol == 0) {
	    	    		alert(res.data.Msg);
	    	    	}else{
	    	    		$('#powerModal').modal('hide');
	    	    		alert(res.data.Msg);
	    	    	}
	    	    }).catch(function (err) {
    	    		console.log(err);
	    	    });
    		}
    		//权限model操作
    		$scope.checkDo = function(x){
        		var mybool = false;
    			for(var i=0;i<$scope.menuData.length;i++){
        			if($scope.menuData[i].pid == x.m_id){
        				mybool = mybool || $scope.menuData[i].checked;
            		}
        		}
            		x.checked = mybool;
        	}
        	//权限model操作
    		$scope.checkPid = function(x){
    			for(var i=0;i<$scope.menuData.length;i++){
        			if($scope.menuData[i].pid == x.m_id){
        				$scope.menuData[i].checked = x.checked;
            		}
        		}
        	}
		})
    </script>
</html>