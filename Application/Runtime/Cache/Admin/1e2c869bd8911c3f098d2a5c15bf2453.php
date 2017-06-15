<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equvi="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="render" content="webkit">
<title>Insert title here</title>
<style type="text/css">

 </style>
<link rel="stylesheet" type="text/css" href="/work/Public/lwd/edit/css/after-oder.css"/>
<link rel="stylesheet" href="/work/Public/lwd/lay/css/x-admin.css" media="all">
<script src="/work/Public/lwd/js/angular.min.js"></script> 
<link href="/work/Public/lwd/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body ng-app="App" ng-controller="link">
	<div class="x-nav">
         <div class="row">
			<div class="col-lg-4"><span >当前位置  : / 友情链接</span></div>
			<div class="col-lg-6"></div>
			<div class="col-lg-2">
				<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
			</div>
		</div>
     </div>
<!-- Button trigger modal -->
<div class="container">
	<div class="row">
		<div class="col-lg-1">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
			  <i class="layui-icon"></i>添加
			</button>
		</div>
		<div class="col-lg-11"></div>
	</div>
</div>
<!-- Modal 添加链接-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加链接</h4>
      </div>
      <div class="modal-body text-center" >
			<div class="input-group">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button">链接地址:</button>
			  </span>
			  <input type="text" class="form-control" aria-label="..."  ng-model="pro.f_adr">
			</div><br>
			<div class="input-group">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button">连接名称:</button>
			  </span>
			  <input type="text" class="form-control" aria-label="..." ng-model="pro.f_name">
			</div><br>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary join">提交</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal 查看并修改-->
<div class="modal fade" id="mendModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalLabel">查看链接详情</h4>
      </div>
      <div class="modal-body text-center" >
      		  <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">链接 I D:</button>
			      </span>
			      <input type="text" class="form-control" aria-label="..." id="f_id" disabled="disabled" name="f_id" ng-model="pro.f_id">
			   </div><br>
	          <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">链接地址:</button>
			      </span>
			      <input type="text" class="form-control" aria-label="..." id="f_adr" name="f_adr" ng-model="pro.f_adr">
			  </div><br>
	          <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">链接名称:</button>
			      </span>
			      <input type="text" class="form-control" aria-label="..." id="f_name" name="f_name" ng-model="pro.f_name">
			  </div><br>
         </div>
		<div class="modal-footer">
		  <button type="button"  class="btn btn-default" data-dismiss="modal">关闭</button>
		  <button type="button" class="btn btn-primary save">保存</button>
		</div>
    </div>
  </div>
</div>	
<table class="container layui-table">
      <thead>
          <tr>
              <th style="text-align:center;">ID</th>
              <th style="text-align:center;">链接地址</th>
              <th style="text-align:center;">链接名称</th>
              <th style="text-align:center;">操作</th>
          </tr>
      </thead>
      <tbody>
      <?php if(is_array($Link)): foreach($Link as $key=>$f): ?><tr>
          	  <td class="text-center"><?php echo ($f["f_id"]); ?></td>
              <td class="text-center"><?php echo ($f["f_adr"]); ?></td>
              <td class="text-center"><?php echo ($f["f_name"]); ?></td>
              <td class="td-manage text-center">
                  <a title="编辑" href="javascript:;" class="ml-5" style="text-decoration:none">
                      <i class="layui-icon look" data-toggle="modal" data-target="#mendModal">&#xe642;</i>
                  </a>
                  <a title="删除" href="javascript:;" style="text-decoration:none">
                      <i class="layui-icon remove">&#xe640;</i>
                  </a>
              </td><?php endforeach; endif; ?>
          </tr>
      </tbody>
</table>
	<div class="container text-center" >
		<div class="row">
			 <nav>
				<ul class="pagination">
				    <li>
				     <?php echo ($page); ?>
				    </li>
				  </ul>
			</nav> 
		</div>
	</div>  
	<div id="pageDiv" class="text-center">
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
<script>
$link_url="<?php echo U('Link/link');?>";
$alter_url="<?php echo U('Link/alter');?>";
$remove_url="<?php echo U('Link/remove');?>";
$join_url="<?php echo U('Link/join');?>";
var transform = function(data){
	  return $.param(data);
	}
angular.module('App', []).controller('link', function($scope, $http) {
	$scope.pro={
			
	};
	$(".join").on("click",function(){/*添加链接*/
		if(confirm("确定添加？")){
			 $http({
		         url:$join_url,
		         method:'post',
		         data:{'data':$scope.pro},
		         headers:{'Content-Type':'application/x-www-form-urlencoded'},
		         transformRequest: transform 
		         }).then(function(response){
		            if(response.data.statu=='1'){
		         	   alert(response.data.msg);
		         	   location.reload();
		            }else{
		         	   alert(response.data.msg);
		            }
		         }).catch(function (res) {
		           console.log(res);
		       });
        }
	})
	 $('.look').on("click",function(){/*查看链接*/
	   $listId=$(this).parent().parent().parent().children().eq(0).html();
	   $http({
            url:$link_url,
            method:'post', 
            data:{'id':$listId},
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            transformRequest: transform 
            }).then(function(response){
               $scope.pro=response.data;
            }).catch(function (res) {
              console.log(res);
          });  
	 })
	  $('.save').on("click",function(){/*修改链接*/
 		if(confirm("确定修改？")){
			 $http({
		         url:$alter_url,
		         method:'post',
		         data:{'data':$scope.pro},
		         headers:{'Content-Type':'application/x-www-form-urlencoded'},
		         transformRequest: transform 
		         }).then(function(response){
		            if(response.data.statu=='1'){
		         	   alert(response.data.msg);
		         	   location.reload();
		            }else{
		         	   alert(response.data.msg);
		            }
		         }).catch(function (res) {
		           console.log(res);
		       });
         }
	 }) 
	 $('.remove').on("click",function(){/*删除链接*/
		 $lid=$(this).parent().parent().parent().children().eq(0).html();
		 if(confirm("确定删除？")){
			 $http({
		         url:$remove_url,
		         method:'post',
		         data:{'id':$lid},
		         headers:{'Content-Type':'application/x-www-form-urlencoded'},
		         transformRequest: transform 
		         }).then(function(response){
		             console.log(response.data); 
		            if(response.data.statu=='1'){
		         	   alert(response.data.rmsg);
		         	   location.reload();
		            }else{
		         	   alert(response.data.rmsg);
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
<script src="/work/Public/lwd/edit/js/order.js"></script> 
<script src="/work/Public/lwd/lay/lib/layui/layui.js" charset="utf-8"></script>
<script src="/work/Public/lwd/lay/js/x-layui.js" charset="utf-8"></script>
</html>